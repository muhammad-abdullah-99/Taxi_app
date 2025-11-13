<?php

namespace App\Http\Controllers\Transport;

use App\Http\Controllers\Controller;
use App\Models\BetweenCity;
use App\Models\StationWallet;
use App\Models\Travel;
use App\Models\Wallet;
use App\Models\PackageType;        
use App\Models\Subscription;       
use App\Models\Passenger;
use App\Models\WalletDetail;
use App\Jobs\SendDriverWarning;
use App\Jobs\CancelDriverSubscription;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use App\Http\Controllers\Transport\BetweenCityController;

class TravelController extends Controller
{

    private function getLanguageFromRequest(Request $request, $default = 'ar')
    {
        $lang = $request->header('lang') 
                ?? $request->header('Lang') 
                ?? $request->header('Accept-Language')
                ?? $request->get('lang', $default);
        
        return in_array($lang, ['en', 'ar', 'ur']) ? $lang : $default;
    }    

    private function getSaudiTime()
    {
        return \Carbon\Carbon::now('Asia/Riyadh');
    }

    public function travels(Request $request)
    {
        $status = $request->get('status');
        $query = Travel::with('appUser')->whereHas('appUser');

        if ($status) {
            $query->where('status', $status);
        }

        $travels = $query->get();
        return view('admin.transport.travel.travel', compact('travels', 'status'));
    }

    public function allUserTravell($user, $status)
    {
        $travels = Travel::where('user_id', $user)->where('status', $status)->get();
        return response()->json([
            'success' => true,
            'message' => 'User Travel',
            'data' => ['travels' => $travels->load('client')]
        ], 201);
    }

    public function updateTravellStatus(Request $request, $id)
    {
        $travel = Travel::find($id);

        if (!$travel) {
            return response()->json([
                'success' => false,
                'message' => 'Travel not found',
            ], 404);
        }

        if (!$request->has('status')) {
            return response()->json([
                'success' => false,
                'message' => 'Status is required',
            ], 400);
        }

        $travel->status = $request->status;
        $travel->save();

        return response()->json([
            'success' => true,
            'message' => 'Travel status updated successfully',
            'data' => ['travel' => $travel->load('client')]
        ], 200);
    }

    // ✅ NEW METHODS - TRAVEL CREATION LOGIC MOVED HERE

    /**
     * Create travel for unassigned ride (no driver yet)
     */
    public function createUnassignedTravel(array $data)
    {
        return Travel::create([
            'from' => $data['from'],
            'to' => $data['to'],
            'date' => $data['date'],
            'amount' => $data['amount'],
            'time' => $data['time'],
            'status' => 'Waiting',
            'user_id' => null, // No driver assigned yet
            'passengers' => $data['passengers'],
            'between_city_id' => $data['between_city_id'],
            'company_type' => $data['company_type'] ?? null,
            'selected_transport_type' => $data['selected_transport_type'] ?? null,
            'round_trip' => $data['round_trip'] ?? false
        ]);
    }

    /**
     * Create travel with driver assigned
     */
public function createAssignedTravel(array $data)
{
    $lang = $data['lang'] ?? 'ar';
    
    // ✅ CHECK 1: Active subscription
    if (isset($data['user_id']) && !$this->hasActiveIntercitySubscription($data['user_id'])) {
        $messages = [
            'ar' => 'تحتاج إلى باقة نشطة بين المدن لإنشاء الرحلات.',
            'en' => 'Driver needs an active intercity package to create rides.',
            'ur' => 'سفر بنانے کے لیے فعال انٹر سٹی پیکج کی ضرورت ہے۔'
        ];
        throw new \Exception($messages[$lang] ?? $messages['ar']);
    }
    
    // ✅ CHECK 2: Driver company type matches trip company type
    if (isset($data['user_id']) && isset($data['company_type'])) {
        $this->validateDriverCompanyTypeForTrip(
            $data['user_id'],
            $data['company_type'],
            $lang
        );
    }
    
    // ✅ CHECK 3: Driver company type allowed on route
    if (isset($data['user_id']) && isset($data['between_city_id'])) {
        $this->validateDriverCompanyTypeOnRoute(
            $data['user_id'],
            $data['between_city_id'],
            $lang
        );
    }
    
    // ✅ CHECK 4: CRITICAL FIX - Always validate capacity
    if (isset($data['user_id']) && isset($data['passengers'])) {
        $this->validateDriverCapacityForTrip(
            $data['user_id'],
            $data['passengers'],
            $lang
        );
    }
    
    // ✅ CHECK 5: Vehicle type (only if specified)
    // if (isset($data['user_id']) && isset($data['selected_transport_type'])) {
    //     $this->validateDriverVehicleTypeMatch(
    //         $data['user_id'],
    //         $data['selected_transport_type'],
    //         $lang
    //     );
    // }
    
    // ✅ ALL CHECKS PASSED - CREATE TRIP
    return Travel::create([
        'from' => $data['from'],
        'to' => $data['to'],
        'date' => $data['date'],
        'amount' => $data['amount'],
        'time' => $data['time'],
        'status' => 'Waiting',
        'user_id' => $data['user_id'],
        'passengers' => $data['passengers'],
        'between_city_id' => $data['between_city_id'],
        'company_type' => $data['company_type'] ?? null,
        'selected_transport_type' => $data['selected_transport_type'] ?? null,
        'round_trip' => $data['round_trip'] ?? false,
        'return_date' => $data['return_date'] ?? null,
        'return_time' => $data['return_time'] ?? null,
    ]);
}

    /**
     * Create travel with client (passenger who booked)
     */
    public function createClientTravel(array $data)
    {
        $currentTime = $this->getSaudiTime();

        // ✅ VALIDATE: Booking time must be at least 3 hours from now
        $travelDateTime = \Carbon\Carbon::parse($data['date'] . ' ' . $data['time'], 'Asia/Riyadh');
        $hoursFromNow = $currentTime->diffInHours($travelDateTime, false);
        
        // Multi-language error messages
        $bookingMessages = [
            'ar' => 'يجب أن يكون وقت الحجز 3 ساعات على الأقل من الوقت الحالي. يرجى اختيار وقت لاحق.',
            'en' => 'Booking time must be at least 3 hours from current time. Please select a later time.',
            'ur' => 'بکنگ کا وقت موجودہ وقت سے کم از کم 3 گھنٹے ہونا چاہیے۔ براہ کرم بعد کا وقت منتخب کریں۔'
        ];
        
        if ($hoursFromNow < 3) {
            $lang = $data['lang'] ?? 'en';
            throw new \Exception($bookingMessages[$lang] ?? $bookingMessages['en']);
        }  

        return Travel::create([
            'from' => $data['from'],
            'to' => $data['to'],
            'date' => $data['date'],
            'amount' => $data['amount'],
            'time' => $data['time'],
            'status' => 'Waiting',
            'user_id' => $data['user_id'] ?? null,
            'client_id' => $data['client_id'],
            'passengers' => $data['passengers'],
            'latitude_from' => $data['latitude_from'] ?? null,
            'longitude_from' => $data['longitude_from'] ?? null,
            'latitude_to' => $data['latitude_to'] ?? null,
            'longitude_to' => $data['longitude_to'] ?? null,
            'between_city_id' => $data['between_city_id'],
            'company_type' => $data['company_type'] ?? null,
            'selected_transport_type' => $data['selected_transport_type'] ?? null,
            'round_trip' => $data['round_trip'] ?? false,
            'return_date' => $data['return_date'] ?? null,
            'return_time' => $data['return_time'] ?? null
        ]);
    }

/**
 * Check if travel already exists
 */

public function findExistingTravel(array $criteria)
{
    $query = Travel::where('from', $criteria['from'])
        ->where('to', $criteria['to'])
        ->where('date', $criteria['date'])
        ->where('time', $criteria['time'])
        ->where('amount', $criteria['amount'])
        ->where('passengers', $criteria['passengers'])
        ->where('round_trip', $criteria['round_trip']);
    
    // ✅ FIX: Only match if BOTH user_id AND client_id match
    // Don't match trips with different users
    if (isset($criteria['user_id'])) {
        $query->where('user_id', $criteria['user_id']);
    } else {
        $query->whereNull('user_id');
    }
    
    if (isset($criteria['client_id'])) {
        $query->where('client_id', $criteria['client_id']);
    } else {
        $query->whereNull('client_id');
    }
    
    // ✅ CRITICAL: Only find ACTIVE trips (exclude cancelled/finished)
    $activeStatuses = ['Waiting', 'DriverAccepted', 'PassengerAccepted', 'InProgress'];
    $query->whereIn('status', $activeStatuses);
    
    return $query->first();
}

    /**
     * Validate and get BetweenCity ID
     */
    public function validateBetweenCity($from, $to, $betweenCityId = null, $lang = 'en')
    {
        if ($betweenCityId) {
            return $betweenCityId;
        }

        if ($from === $to) {
            return null;
        }

        $cleanFrom = rtrim(trim($from), '/');
        $cleanTo = rtrim(trim($to), '/');

        $betweenCity = BetweenCity::where(function($query) use ($cleanFrom, $cleanTo) {
            $query->where('city_one', $cleanFrom)->where('city_two', $cleanTo);
        })->orWhere(function($query) use ($cleanFrom, $cleanTo) {
            $query->where('city_one', $cleanTo)->where('city_two', $cleanFrom);
        })->first();

        if (!$betweenCity) {
            $messages = [
                'ar' => 'هذه المدن غير متاحة. يرجى اختيار من القائمة المتاحة',
                'ur' => 'یہ شہر دستیاب نہیں ہیں۔ برائے مہربانی دستیاب فہرست سے منتخب کریں',
                'en' => 'These cities are not available. Please select from available cities'
            ];

            throw new \Exception($messages[$lang] ?? $messages['en']);
        }

        return $betweenCity->id;
    }

    /**
     * Process client payment and create travel
     */
public function processClientPaymentAndTravel(array $data, $clientId, $lang = 'ar')
{
    $wallet = Wallet::where('user_id', $clientId)->first();

    $messages = [
        'ar' => [
            'no_wallet' => 'لا توجد محفظة لهذا العميل',
            'insufficient' => 'رصيد المحفظة غير كافٍ'
        ],
        'en' => [
            'no_wallet' => 'No wallet found for this client',
            'insufficient' => 'Insufficient wallet balance'
        ],
        'ur' => [
            'no_wallet' => 'اس کلائنٹ کے لیے والیٹ نہیں ملا',   
            'insufficient' => 'والیٹ میں ناکافی بیلنس'
        ]
    ];

    if (!$wallet) {
        throw new \Exception($messages[$lang]['no_wallet'] ?? $messages['ar']['no_wallet']);
    }

    if ($wallet->current_balance < $data['amount']) {
        throw new \Exception($messages[$lang]['insufficient'] ?? $messages['ar']['insufficient']);
    }        

    // ✅ CHECK IF PAYMENT ALREADY DEDUCTED FOR THIS TRIP
    // Use a unique identifier to prevent double deduction
    $cacheKey = "payment_processing_{$clientId}_{$data['date']}_{$data['time']}";
    
    if (\Cache::has($cacheKey)) {
        throw new \Exception('Payment already being processed. Please wait.');
    }
    
    // Lock for 10 seconds
    \Cache::put($cacheKey, true, 10);

    try {
        // Deduct payment ONCE
        $wallet->current_balance -= $data['amount'];
        $wallet->save();

        // Create travel
        $travel = $this->createClientTravel($data);
        
        // ✅ REMOVE CACHE AFTER SUCCESS
        \Cache::forget($cacheKey);
        
        return $travel;
        
    } catch (\Exception $e) {
        // ✅ ROLLBACK - ADD MONEY BACK
        $wallet->current_balance += $data['amount'];
        $wallet->save();
        
        \Cache::forget($cacheKey);
        throw $e;
    }
}

    /**
     * Create station wallet for travel
     */
    public function createStationWallet($travelId, $amount)
    {
        return StationWallet::create([
            'travel_id' => $travelId,
            'amount' => $amount ?? 0,
            'driver_status' => 'pending',
            'client_status' => 'hold',
            'payment_status' => 'hold'
        ]);
    }

    /**
     * Get unassigned travels
     */
public function getUnassignedTravels()
{
    $travels = Travel::whereNull('user_id')
        ->where('status', 'Waiting')
        ->with('between_city')
        ->get();
    
    return response()->json([
        'message' => 'successfully.',
        'data' => $travels
    ]);
}

/**
 * Get unassigned travels sorted by passengers and car type
 */
public function getUnassignedTravelsFiltered(Request $request)
{
    $passengers = $request->passengers;
    $type = trim($request->input('type'));
    $userId = $request->user_id;

    if (!$passengers || !$type) {
        return response()->json([
            'success' => false,
            'message' => 'passengers and type are required.',
            'data' => []
        ], 400);
    }

    // ✅ Get driver's company details
    $driverCompany = null;
    $driverMaxPassengers = 0;
    $driverCompanyType = null;
    
    if (!$userId) {
        return response()->json([
            'success' => false,
            'message' => 'user_id is required.',
            'data' => []
        ], 400);
    }
    
    $driverCompany = \App\Models\Company::where('user_id', $userId)->first();
    
    if (!$driverCompany) {
        return response()->json([
            'success' => false,
            'message' => 'Driver company not found. Please complete your registration.',
            'data' => []
        ], 400);
    }
    
    $driverCompanyType = $driverCompany->company_type;
    
    // Get max passengers for driver's company type
    $companyTypes = \App\Http\Controllers\Transport\BetweenCityController::COMPANY_TYPES;
    if (isset($companyTypes[$driverCompanyType])) {
        $driverMaxPassengers = $companyTypes[$driverCompanyType]['max_passengers'];
    }

    // ✅ Build query - DIRECTLY filter by company_type in database
    $travels = Travel::whereNull('user_id')
        ->where('status', 'Waiting')
        ->where('passengers', '<=', $passengers) // Driver's vehicle capacity
        ->where('passengers', '<=', $driverMaxPassengers) // Company type max
        ->where(function($query) use ($driverCompanyType) {
            // Trip ka company_type ya to NULL ho, ya driver ke company_type se match kare
            $query->whereNull('company_type')
                  ->orWhere('company_type', $driverCompanyType);
        })
        ->with(['between_city', 'client'])
        ->orderBy('created_at', 'desc')
        ->get();

    // ✅ CRITICAL FIX: Filter trips based on ROUTE company_type restrictions
    $validTravels = $travels->filter(function($travel) use ($driverCompanyType, $driverMaxPassengers) {
        
        // ✅ FILTER: Route Company Type Match
        // If route has company_type restriction, it MUST match driver's company_type
        if ($travel->between_city && $travel->between_city->company_type) {
            if ($travel->between_city->company_type !== $driverCompanyType) {
                \Log::info("❌ FILTERED OUT - Route company type mismatch", [
                    'travel_id' => $travel->id,
                    'route_company_type' => $travel->between_city->company_type,
                    'driver_company_type' => $driverCompanyType
                ]);
                return false; // Driver's company not allowed on this route
            }
        }
        
        // ✅ Double-check capacity (safety check)
        if ($travel->passengers > $driverMaxPassengers) {
            \Log::info("❌ FILTERED OUT - Exceeds company capacity", [
                'travel_id' => $travel->id,
                'trip_passengers' => $travel->passengers,
                'driver_max' => $driverMaxPassengers
            ]);
            return false; // Exceeds driver's company type limit
        }

        // ✅ All checks passed - show this trip
        \Log::info("✅ TRIP ALLOWED", [
            'travel_id' => $travel->id,
            'trip_company_type' => $travel->company_type ?? 'NULL',
            'route_company_type' => $travel->between_city->company_type ?? 'NULL',
            'driver_company_type' => $driverCompanyType
        ]);
        
        return true;
    });

    // ✅ Enhanced response with filtering info
    return response()->json([
        'success' => true,
        'message' => 'Successfully.',
        'data' => $validTravels->values(),
        'filter_info' => [
            'driver_vehicle_capacity' => $passengers,
            'driver_company_type' => $driverCompanyType,
            'driver_company_max_passengers' => $driverMaxPassengers,
            'total_available_trips' => $travels->count(),
            'matching_trips' => $validTravels->count(),
            'filtered_out' => $travels->count() - $validTravels->count()
        ]
    ]);
}

/**
     * Get client travels
     */
public function getClientTravels($clientId)
{
    $travels = Travel::where('client_id', $clientId)
        ->with(['appUser.vehicle', 'between_city', 'stationWallet:travel_id,can_cancel_free'])
        ->get();

    // ✅ Add company_type to response (SIMPLE)
    $travels->each(function($travel) {
        if ($travel->between_city && $travel->between_city->company_type) {
            $travel->between_city->company_type_name = $travel->between_city->company_type;
        }
    });

    return response()->json([
        'message' => 'successfully.',
        'data' => $travels
    ]);
}

    /**
     * Driver accepts travel
     */ 
public function acceptTravel($travelId, $userId, $lang = 'en')
{
    $messages = [
        'ar' => [
            'need_package' => 'تحتاج إلى باقة نشطة بين المدن لقبول الرحلات.',
            'not_found' => 'الرحلة غير موجودة',
            'success' => 'تم قبول السائق بنجاح.'
        ],
        'en' => [
            'need_package' => 'You need an active intercity package.',
            'not_found' => 'Travel not found',
            'success' => 'Driver accepted successfully.'
        ],
        'ur' => [
            'need_package' => 'فعال انٹر سٹی پیکج درکار ہے۔',
            'not_found' => 'سفر نہیں ملا',
            'success' => 'ڈرائیور نے کامیابی سے قبول کیا۔'
        ]
    ];

    DB::beginTransaction();
    try {
        // ✅ CHECK 1: Active subscription
        if (!$this->hasActiveIntercitySubscription($userId)) {
            throw new \Exception($messages[$lang]['need_package']);
        }
        
        // ✅ CHECK 2: Travel exists
        $travel = Travel::find($travelId);
        if (!$travel) {
            throw new \Exception($messages[$lang]['not_found']);
        }
        
        // ✅ CHECK 3: Driver company type matches trip company type
        if ($travel->company_type) {
            $this->validateDriverCompanyTypeForTrip(
                $userId,
                $travel->company_type,
                $lang
            );
        }
        
        // ✅ CHECK 4: Driver company type allowed on route
        if ($travel->between_city_id) {
            $this->validateDriverCompanyTypeOnRoute(
                $userId,
                $travel->between_city_id,
                $lang
            );
        }
        
        // ✅ CHECK 5: CRITICAL FIX - Always validate capacity
        // Even if transport_type is null, we must check capacity!
        $this->validateDriverCapacityForTrip(
            $userId,
            $travel->passengers,
            $lang
        );
        
        // ✅ CHECK 6: Vehicle type (only if transport_type specified)
        // if ($travel->selected_transport_type) {
        //     $this->validateDriverVehicleTypeMatch(
        //         $userId,
        //         $travel->selected_transport_type,
        //         $lang
        //     );
        // }

        // ✅ ALL CHECKS PASSED - Accept trip
        $stationWallet = StationWallet::where('travel_id', $travelId)->first();
        if (!$stationWallet) {
            $stationWallet = $this->createStationWallet($travelId, $travel->amount);
        }

        $travel->update([
            'user_id' => $userId,
            'status' => 'DriverAccepted',
            'driver_assigned_at' => $this->getSaudiTime()
        ]);
        
        if ($travel->passenger_id) {
            $passenger = Passenger::where('id', $travel->passenger_id)->first();
            if ($passenger) {
                $passenger->update(['user_id' => $userId]);
            }
        }

        $stationWallet->update(['driver_status' => 'confirmed']);

        Log::info("Driver {$userId} accepted trip {$travelId} successfully");

        DB::commit();

        return [
            'success' => true,
            'message' => $messages[$lang]['success'],
            'status' => 'driver_accepted',
            'travel_id' => $travelId
        ];

    } catch (\Exception $e) {
        DB::rollBack();
        throw $e;
    }
}

    /**
     * Cancel travel by driver
     */
public function cancelTravelByDriver($travelId, $lang = 'en')
{
    $messages = [
        'ar' => [
            'in_progress' => 'لا يمكنك إلغاء الرحلة بمجرد بدء الرحلة.',
            'completed' => 'لا يمكن إلغاء رحلة مكتملة. لقد انتهيت بالفعل من الرحلة.',
            'finished' => 'انتهت الرحلة وتمت معالجة الدفع. الإلغاء غير ممكن.',
            'already_cancelled_passenger' => 'تم إلغاء هذه الرحلة بالفعل من قبل الراكب.',
            'already_cancelled' => 'لقد قمت بالفعل بإلغاء هذه الرحلة.',
            'cannot_cancel' => 'الإلغاء غير مسموح به لحالة الرحلة هذه.',
            'trip_started' => 'لقد بدأت الرحلة بالفعل. لا يمكنك الإلغاء بعد بدء الرحلة.',
            'success' => 'تم إلغاء الرحلة بنجاح. لم تعد مخصصًا لهذه الرحلة.',
            'success_with_penalty' => 'تم إلغاء الرحلة. تم إلغاء تفعيل باقتك.'
        ],
        'en' => [
            'in_progress' => 'You cannot cancel the trip once you have started the journey.',
            'completed' => 'Cannot cancel completed trip. You have already ended the trip.',
            'finished' => 'Trip is finished and payment processed. Cancellation not possible.',
            'already_cancelled_passenger' => 'This trip was already cancelled by the passenger.',
            'already_cancelled' => 'You have already cancelled this trip.',
            'cannot_cancel' => 'Cancellation not allowed for this trip status.',
            'trip_started' => 'Trip has already started. You cannot cancel after beginning the journey.',
            'success' => 'Travel cancelled successfully. You are no longer assigned to this trip.',
            'success_with_penalty' => 'Travel cancelled. Your package has been deactivated.'
        ],
        'ur' => [
            'in_progress' => 'سفر شروع ہونے کے بعد آپ ٹرپ منسوخ نہیں کر سکتے۔',
            'completed' => 'مکمل شدہ ٹرپ منسوخ نہیں کیا جا سکتا۔ آپ پہلے ہی ٹرپ ختم کر چکے ہیں۔',
            'finished' => 'ٹرپ مکمل ہو گیا اور ادائیگی کی کارروائی ہو گئی۔ منسوخی ممکن نہیں۔',
            'already_cancelled_passenger' => 'یہ ٹرپ مسافر نے پہلے ہی منسوخ کر دیا تھا۔',
            'already_cancelled' => 'آپ پہلے ہی یہ ٹرپ منسوخ کر چکے ہیں۔',
            'cannot_cancel' => 'اس ٹرپ کی حیثیت کے لیے منسوخی کی اجازت نہیں۔',
            'trip_started' => 'ٹرپ پہلے ہی شروع ہو چکا ہے۔ سفر شروع کرنے کے بعد منسوخ نہیں کیا جا سکتا۔',
            'success' => 'سفر کامیابی سے منسوخ ہو گیا۔ آپ اب اس ٹرپ کے لیے مختص نہیں ہیں۔',
            'success_with_penalty' => 'سفر منسوخ ہو گیا۔ آپ کا پیکج غیر فعال کر دیا گیا ہے۔'
        ]
    ];

    DB::beginTransaction();
    try {
        $travel = Travel::findOrFail($travelId);

        $cancellationRules = [
            'Waiting' => true,
            'DriverAccepted' => true,
            'PassengerAccepted' => true,
            'InProgress' => false,
            'Completed' => false,
            'Finished' => false,
            'CancelledByPassenger' => false,
            'CancelledByDriver' => false,
        ];

        if (!isset($cancellationRules[$travel->status]) || !$cancellationRules[$travel->status]) {
            $errorKey = [
                'InProgress' => 'in_progress',
                'Completed' => 'completed',
                'Finished' => 'finished',
                'CancelledByPassenger' => 'already_cancelled_passenger',
                'CancelledByDriver' => 'already_cancelled',
            ][$travel->status] ?? 'cannot_cancel';
            
            throw new \Exception($messages[$lang][$errorKey] ?? $messages['en'][$errorKey]);
        }

        if ($travel->started_at) {
            throw new \Exception($messages[$lang]['trip_started'] ?? $messages['en']['trip_started']);
        }

        $driverId = $travel->user_id;
        $subscriptionWasInactivated = false;

        // ✅ Package Will Only Become Inactive When Then Passenger Has Accepted The Ride And The Driver Cancel The Ride After The PassengerAccepted Status
        if ($travel->status === 'PassengerAccepted') {
            $intercityPackage = PackageType::where('name', 'بين المدن')->first();
            if ($intercityPackage) {
                $activeSubscriptions = Subscription::where('user_id', $driverId)
                    ->where('package_id', $intercityPackage->id)
                    ->where('status', 'active')
                    ->get();

                foreach ($activeSubscriptions as $subscription) {
                    $subscription->update([
                        'status' => 'inactive', 
                        'updated_at' => $this->getSaudiTime()
                    ]);
                    $subscriptionWasInactivated = true;
                    \Log::info("Subscription inactive (passenger had accepted) for driver: {$driverId}, Subscription ID: {$subscription->id}");
                }
            }
        } else {
            \Log::info("Package remains active - passenger had not accepted yet. Travel status: {$travel->status}");
        }

        $stationWallet = StationWallet::where('travel_id', $travelId)->first();
        if ($stationWallet) {
            $stationWallet->update([
                'driver_status' => 'cancelled',
                'client_status' => 'hold',
                'payment_status' => 'hold'
            ]);
        }


        // ✅ CRITICAL FIX: RIDE WILL BE AVAILABLE AGAIN FOR OTHER DRIVERS
        $travel->update([
            'user_id' => null, // ✅ Driver remove karo
            'status' => 'Waiting', // ✅ Status phir se 'Waiting' karo
            'driver_assigned_at' => null, // ✅ Driver assignment reset karo
            'cancelled_at' => $this->getSaudiTime()
        ]);
        
        if ($travel->passenger_id) {
            $passenger = Passenger::where('id', $travel->passenger_id)->first();
            if ($passenger) {
                $passenger->update(['user_id' => null]);
            }
        }

        DB::commit();

        $successMessage = $subscriptionWasInactivated 
            ? ($messages[$lang]['success_with_penalty'] ?? $messages['en']['success_with_penalty'])
            : ($messages[$lang]['success'] ?? $messages['en']['success']);

        return [
            'message' => $successMessage
        ];

    } catch (\Exception $e) {
        DB::rollBack();
        Log::error('DRIVER CANCELLATION ERROR: ' . $e->getMessage());
        throw $e;
    }
}

/**
 * Passenger cancels travel with refund rules - PROTECTED VERSION
 */

public function cancelTravelByPassenger($travelId, $passengerId, $lang = 'en')
{
    $messages = [
        'ar' => [
            'in_progress' => 'إلغاء الرحلة غير مسموح به بمجرد بدء الرحلة.',
            'completed' => 'لا يمكن إلغاء رحلة مكتملة. يرجى الاتصال بالدعم للحصول على المساعدة.',
            'finished' => 'انتهت الرحلة وتمت معالجة الدفع. الإلغاء غير ممكن.',
            'already_cancelled' => 'تم إلغاء هذه الرحلة بالفعل من قبلك.',
            'cancelled_by_driver' => 'تم إلغاء هذه الرحلة من قبل السائق.',
            'trip_started' => 'لقد بدأت الرحلة بالفعل. الإلغاء غير مسموح به بعد بدء الرحلة.',
            'unauthorized' => 'محاولة إلغاء غير مصرح بها.',
            'payment_released' => 'تم إصدار الدفع للسائق بالفعل. لا يمكن الإلغاء.',
            'already_refunded' => 'تم إرجاع المبلغ بالفعل لهذه الرحلة.',
            'success' => 'تم إلغاء الرحلة بنجاح.',
            'refund_name' => 'إسترجاع دفعة'
        ],
        'en' => [
            'in_progress' => 'Trip cancellation is not allowed once the journey has started.',
            'completed' => 'Cannot cancel completed trip. Please contact support for assistance.',
            'finished' => 'Trip is finished and payment processed. Cancellation not possible.',
            'already_cancelled' => 'This trip was already cancelled by you.',
            'cancelled_by_driver' => 'This trip was cancelled by the driver.',
            'trip_started' => 'Trip has already started. Cancellation is not permitted after journey begins.',
            'unauthorized' => 'Unauthorized cancellation attempt.',
            'payment_released' => 'Payment already released to driver. Cannot cancel.',
            'already_refunded' => 'Amount already refunded for this trip.',
            'success' => 'Travel cancelled successfully.',
            'refund_name' => 'Payment Refund'
        ],
        'ur' => [
            'in_progress' => 'سفر شروع ہونے کے بعد ٹرپ منسوخ کرنے کی اجازت نہیں ہے۔',
            'completed' => 'مکمل شدہ ٹرپ منسوخ نہیں کیا جا سکتا۔ مدد کے لیے سپورٹ سے رابطہ کریں۔',
            'finished' => 'ٹرپ مکمل ہو گیا اور ادائیگی کی کارروائی ہو گئی۔ منسوخی ممکن نہیں۔',
            'already_cancelled' => 'یہ ٹرپ آپ نے پہلے ہی منسوخ کر دیا تھا۔',
            'cancelled_by_driver' => 'یہ ٹرپ ڈرائیور نے منسوخ کر دیا تھا۔',
            'trip_started' => 'ٹرپ پہلے ہی شروع ہو چکا ہے۔ سفر شروع ہونے کے بعد منسوخی کی اجازت نہیں۔',
            'unauthorized' => 'غیر مجاز منسوخی کی کوشش۔',
            'payment_released' => 'ادائیگی پہلے ہی ڈرائیور کو جاری کی جا چکی ہے۔ منسوخ نہیں کیا جا سکتا۔',
            'already_refunded' => 'اس ٹرپ کے لیے رقم پہلے ہی واپس کی جا چکی ہے۔',
            'success' => 'سفر کامیابی سے منسوخ ہو گیا۔',
            'refund_name' => 'ادائیگی کی واپسی'
        ]
    ];

    DB::beginTransaction();
    try {
        $travel = Travel::findOrFail($travelId);

        // ✅ CHECK: Already refunded?
        $existingRefund = WalletDetail::where('travel_id', $travelId)
            ->whereNotNull('refund_amount')
            ->first();
        
        if ($existingRefund) {
            DB::rollBack();
            Log::warning("Duplicate refund blocked for travel_id: {$travelId}");
            throw new \Exception($messages[$lang]['already_refunded'] ?? $messages['en']['already_refunded']);
        }

        // ✅ CHECK: Can cancel?
        $cancellationRules = [
            'Waiting' => true,
            'DriverAccepted' => true,
            'PassengerAccepted' => true,
            'InProgress' => false,
            'Completed' => false,
            'Finished' => false,
            'CancelledByPassenger' => false,
            'CancelledByDriver' => false,
        ];

        if (!isset($cancellationRules[$travel->status]) || !$cancellationRules[$travel->status]) {
            $errorKey = [
                'InProgress' => 'in_progress',
                'Completed' => 'completed',
                'Finished' => 'finished',
                'CancelledByPassenger' => 'already_cancelled',
                'CancelledByDriver' => 'cancelled_by_driver',
            ][$travel->status] ?? 'in_progress';
            
            throw new \Exception($messages[$lang][$errorKey] ?? $messages['en'][$errorKey]);
        }

        if ($travel->started_at) {
            throw new \Exception($messages[$lang]['trip_started'] ?? $messages['en']['trip_started']);
        }
        
        if ($travel->client_id != $passengerId) {
            throw new \Exception($messages[$lang]['unauthorized'] ?? $messages['en']['unauthorized']);
        }

        // ✅ CALCULATE ALL TIME-RELATED VALUES (ONCE ONLY)
        $currentTime = $this->getSaudiTime();
        $bookingTime = \Carbon\Carbon::parse($travel->created_at, 'Asia/Riyadh');
        $travelDateTime = \Carbon\Carbon::parse($travel->date . ' ' . $travel->time, 'Asia/Riyadh');
        
        // Calculate booking advance time (in hours)
        $bookingAdvanceHours = $bookingTime->diffInHours($travelDateTime, false);
        
        // Free cancellation window = booking advance time / 2
        $freeCancellationWindowHours = $bookingAdvanceHours / 2;
        
        // Time remaining until trip starts (in hours)
        $hoursRemainingUntilTrip = $currentTime->diffInHours($travelDateTime, false);
        
        // ✅ DETERMINE: can_cancel_free
        // TRUE = Cancelling WITHIN free window (more time remaining than window)
        // FALSE = Cancelling AFTER free window expires (less time remaining)
        $canCancelFree = ($hoursRemainingUntilTrip > $freeCancellationWindowHours);

        // ✅ CALCULATE REFUND PERCENTAGE
        $driverAssignedTime = $travel->driver_assigned_at
            ? \Carbon\Carbon::parse($travel->driver_assigned_at, 'Asia/Riyadh')
            : null;
        
        if (!$driverAssignedTime) {
            // No driver assigned yet - 100% refund
            $refundPercentage = 100;
            $hoursSinceAssignment = 0;
        } else {
            // Driver assigned - calculate if within cancellation window
            $hoursSinceAssignment = $driverAssignedTime->diffInHours($currentTime, false);
            
            // Within window = 100%, After = 90%
            $refundPercentage = ($hoursSinceAssignment <= $freeCancellationWindowHours) ? 100 : 90;
        }

        $originalAmount = $travel->amount;
        $refundAmount = ($originalAmount * $refundPercentage) / 100;
        $deductionAmount = $originalAmount - $refundAmount;

        // ✅ UPDATE STATION WALLET
        $stationWallet = StationWallet::where('travel_id', $travelId)->first();
        
        if ($stationWallet) {
            if ($stationWallet->payment_status === 'released') {
                throw new \Exception($messages[$lang]['payment_released'] ?? $messages['en']['payment_released']);
            }
            
            $stationWallet->update([
                'client_status' => 'cancelled',
                'payment_status' => 'cancelled',
                'driver_status' => 'cancelled',
                'can_cancel_free' => $canCancelFree
            ]);
        }

        // ✅ UPDATE TRAVEL STATUS
        $travel->update([
            'status' => 'CancelledByPassenger',
            'cancelled_at' => $currentTime
        ]);

        // ✅ PROCESS REFUND
        if ($refundAmount > 0) {
            $wallet = Wallet::where('user_id', $passengerId)->first();
            if ($wallet) {
                // Double check before insert
                $checkAgain = WalletDetail::where('travel_id', $travelId)
                    ->whereNotNull('refund_amount')
                    ->exists();
                
                if ($checkAgain) {
                    DB::rollBack();
                    Log::error("Critical: Duplicate refund blocked at final check for travel_id: {$travelId}");
                    throw new \Exception('Duplicate refund detected.');
                }
                
                // Update wallet balance
                $wallet->current_balance += $refundAmount;
                $wallet->save();
                
                // ✅ SIMPLE MESSAGE - Just trip route
                $simpleMessages = [
                    'ar' => 'إلغاء رحلة من ' . $travel->from . ' إلى ' . $travel->to,
                    'en' => 'Trip cancelled from ' . $travel->from . ' to ' . $travel->to,
                    'ur' => $travel->from . ' سے ' . $travel->to . ' تک سفر منسوخ'
                ];
                
                $refundName = $messages[$lang]['refund_name'] ?? $messages['en']['refund_name'];
                $simpleDetails = $simpleMessages[$lang] ?? $simpleMessages['en'];
                
                Log::info("Creating WalletDetail for travel_id: {$travelId}, passenger: {$passengerId}, lang: {$lang}");
                
                // ✅ CREATE WALLET DETAIL (SINGLE RECORD)
                WalletDetail::create([
                    'name' => $refundName,
                    'wallet_id' => $wallet->id,
                    'amount' => $refundAmount,
                    'refund_amount' => $refundAmount,
                    'deduction_amount' => $deductionAmount,
                    'refund_percentage' => $refundPercentage,
                    'details' => $simpleDetails,
                    'travel_id' => $travelId,
                    'transaction_date' => $currentTime
                ]);
                
                Log::info("WalletDetail created successfully for travel_id: {$travelId}");
            }
        }

        DB::commit();

        return [
            'success' => true,
            'message' => $messages[$lang]['success'] ?? $messages['en']['success'],
            'data' => [
                'refund_percentage' => $refundPercentage,
                'refund_amount' => $refundAmount,
                'deduction_amount' => $deductionAmount,
                'original_amount' => $originalAmount,
                'can_cancel_free' => $canCancelFree,
                'booking_advance_hours' => round($bookingAdvanceHours, 1),
                'free_cancellation_window_hours' => round($freeCancellationWindowHours, 1),
                'hours_remaining_until_trip' => round($hoursRemainingUntilTrip, 1),
                'hours_since_driver_assigned' => round($hoursSinceAssignment, 1),
                'saudi_current_time' => $currentTime->format('Y-m-d H:i:s')
            ]
        ];

    } catch (\Exception $e) {
        DB::rollBack();
        Log::error('CANCELLATION ERROR: ' . $e->getMessage());
        throw $e;
    }
}

    /**
     * Confirm order (by client or driver)
     */
public function confirmOrder($travelId, $type, $lang = 'ar')  // ✅ LANG PARAMETER ADD KARO
{
    if (!in_array($type, ['client', 'driver'])) {
        throw new \Exception('Invalid confirmation type');
    }

    DB::beginTransaction();
    try {
        $travel = Travel::findOrFail($travelId);
        $stationWallet = StationWallet::where('travel_id', $travelId)->first();

        if (!$stationWallet) {
            throw new \Exception('Payment record not found.');
        }

        if ($stationWallet->payment_status === 'released') {
            DB::rollBack();
            return [
                'success' => false,
                'message' => 'Payment already released to driver.'
            ];
        }

        if ($travel->status !== 'Completed') {
            DB::rollBack();
            throw new \Exception('Trip must be completed first by driver. Driver needs to end the trip before payment can be released.');
        }

        if ($type !== 'client') {
            DB::rollBack();
            throw new \Exception('Only passenger can confirm payment release after trip completion.');
        }

        if ($type === 'client') {
            if ($stationWallet->client_status === 'confirmed') {
                DB::rollBack();
                throw new \Exception('Client already confirmed.');
            }
            $stationWallet->client_status = 'confirmed';
            $stationWallet->driver_status = 'confirmed';
        }
        
        $stationWallet->save();

        // ✅ NOW BOTH ARE CONFIRMED + TRIP COMPLETED = RELEASE PAYMENT
        if ($stationWallet->client_status === 'confirmed' && 
            $stationWallet->driver_status === 'confirmed' &&
            $travel->status === 'Completed') {
            
            $driverId = $travel->user_id;
            
            $driverWallet = Wallet::firstOrCreate(
                ['user_id' => $driverId],
                ['current_balance' => 0, 'total_recharge' => 0]
            );

            // ✅ ADD THIS: CHECK IF WALLET DETAIL ALREADY EXISTS
            $exists = WalletDetail::where('travel_id', $travelId)
                ->where('wallet_id', $driverWallet->id)
                ->exists();
            
            if (!$exists) {
                // ✅ GET DRIVER'S LANGUAGE
                $driver = \App\Models\AppUser::find($driverId);
                $driverLang = $driver->preferred_language ?? $lang;
                
                // ✅ MULTI-LANGUAGE SUPPORT
                $nameTranslations = [
                    'ar' => 'استلام الدفع',
                    'en' => 'Payment Received',
                    'ur' => 'ادائیگی موصول ہوئی'
                ];
                
                $detailsTranslations = [
                    'ar' => 'رحلة من ' . $travel->from . ' إلى ' . $travel->to,
                    'en' => 'Trip from ' . $travel->from . ' to ' . $travel->to,
                    'ur' => $travel->from . ' سے ' . $travel->to . ' تک سفر'
                ];
                
                // ✅ CREATE WALLET DETAIL FOR DRIVER
                WalletDetail::create([
                    'wallet_id' => $driverWallet->id,
                    'travel_id' => $travelId,
                    'name' => $nameTranslations[$driverLang] ?? $nameTranslations['ar'],
                    'amount' => $stationWallet->amount,
                    'details' => $detailsTranslations[$driverLang] ?? $detailsTranslations['ar'],
                    'transaction_date' => $this->getSaudiTime()
                ]);
                
                Log::info("Driver WalletDetail created for travel_id: {$travelId}, driver: {$driverId}, lang: {$driverLang}");
            }

            // ✅ UPDATE WALLET BALANCE
            $driverWallet->current_balance += $stationWallet->amount;
            $driverWallet->save();

            // ✅ UPDATE STATUSES
            $travel->update(['status' => 'Finished']);
            $stationWallet->update(['payment_status' => 'released']);

            DB::commit();

            $duration = $travel->started_at ? $travel->started_at->diffInMinutes($travel->ended_at) : 0;

            return [
                'success' => true,
                'message' => 'Payment released successfully! Ride is now finished.',
                'data' => [
                    'amount_transferred' => $stationWallet->amount,
                    'driver_id' => $driverId,
                    'travel_status' => 'Finished',
                    'trip_duration_minutes' => $duration
                ]
            ];
        }

        DB::commit();

        return [
            'success' => true,
            'message' => ucfirst($type) . ' confirmed successfully.',
            'payment_status' => 'on_hold'
        ];

    } catch (\Exception $e) {
        DB::rollBack();
        throw $e;
    }
}

    /**
     * Release all pending payments
     */
    public function releasePendingPayments()
    {
        DB::beginTransaction();
        try {
            $pendingPayments = StationWallet::where('driver_status', 'confirmed')
                ->where('client_status', 'confirmed')
                ->where('payment_status', 'hold')
                ->get();

            $releasedCount = 0;

            foreach ($pendingPayments as $payment) {
                $travel = Travel::find($payment->travel_id);
                if ($travel && $travel->user_id) {
                    $driverWallet = Wallet::firstOrCreate(
                        ['user_id' => $travel->user_id],
                        ['current_balance' => 0, 'total_recharge' => 0]
                    );

                    $driverWallet->current_balance += $payment->amount;
                    $driverWallet->save();

                    $payment->update(['payment_status' => 'released']);
                    $releasedCount++;
                }
            }

            DB::commit();

            return [
                'success' => true,
                'message' => 'Released ' . $releasedCount . ' pending payments successfully'
            ];

        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

/**
 * Passenger confirms driver acceptance
 */
public function passengerConfirmRide($travelId, Request $request)
{
    DB::beginTransaction();
    try {
        $travel = Travel::findOrFail($travelId);
        
        if ($travel->status !== 'DriverAccepted') {
            throw new \Exception('Ride is not in accepted state by driver.');
        }
        
        $travel->update(['status' => 'PassengerAccepted']);
        
        $stationWallet = StationWallet::where('travel_id', $travelId)->first();
        if ($stationWallet) {
            $stationWallet->update(['client_status' => 'accepted']);
        }
        
        // ✅ FORCE SAUDI TIMEZONE
        $currentTime = Carbon::now('Asia/Riyadh');
        $bookingDateTime = Carbon::parse($travel->date . ' ' . $travel->time, 'Asia/Riyadh');
        
        // ✅ GRACE PERIOD TIMES
        $warningTime = $bookingDateTime->copy()->addMinutes(45);      // Booking + 45 min
        $cancellationTime = $bookingDateTime->copy()->addMinutes(60); // Booking + 60 min
        
        // ✅ CORRECT DELAY CALCULATION (Current → Future)
        $warningDelay = max(0, $currentTime->diffInSeconds($warningTime, false));
        $cancellationDelay = max(0, $currentTime->diffInSeconds($cancellationTime, false));
        
        // ✅ DISPATCH WARNING JOB
        if ($warningDelay > 0) {
            SendDriverWarning::dispatch($travelId)->delay($warningDelay);
            
            Log::info("Warning job dispatched", [
                'travel_id' => $travelId,
                'delay_seconds' => $warningDelay,
                'execute_at' => $warningTime->toDateTimeString(),
                'booking_time' => $bookingDateTime->toDateTimeString(),
                'current_time' => $currentTime->toDateTimeString()
            ]);
        } else {
            Log::warning("Warning time already passed - skipping job", [
                'travel_id' => $travelId,
                'warning_time' => $warningTime->toDateTimeString(),
                'current_time' => $currentTime->toDateTimeString()
            ]);
        }
        
        // ✅ DISPATCH CANCELLATION JOB
        if ($cancellationDelay > 0) {
            CancelDriverSubscription::dispatch($travelId)->delay($cancellationDelay);
            
            Log::info("Cancellation job dispatched", [
                'travel_id' => $travelId,
                'delay_seconds' => $cancellationDelay,
                'execute_at' => $cancellationTime->toDateTimeString(),
                'booking_time' => $bookingDateTime->toDateTimeString(),
                'current_time' => $currentTime->toDateTimeString()
            ]);
        } else {
            Log::warning("Cancellation time already passed - skipping job", [
                'travel_id' => $travelId,
                'cancellation_time' => $cancellationTime->toDateTimeString(),
                'current_time' => $currentTime->toDateTimeString()
            ]);
        }
        
        DB::commit();
        
        return response()->json([
            'success' => true,
            'message' => 'Ride confirmed by passenger successfully.',
            'data' => [
                'travel' => $travel->fresh(),
                'grace_period_info' => [
                    'booking_time' => $bookingDateTime->toDateTimeString(),
                    'warning_at' => $warningTime->toDateTimeString(),
                    'auto_cancel_at' => $cancellationTime->toDateTimeString(),
                    'current_time' => $currentTime->toDateTimeString(),
                    'warning_delay_seconds' => $warningDelay,
                    'cancellation_delay_seconds' => $cancellationDelay
                ]
            ]
        ]);
        
    } catch (\Exception $e) {
        DB::rollBack();
        
        Log::error('Passenger Confirm Ride Error', [
            'travel_id' => $travelId,
            'error' => $e->getMessage()
        ]);
        
        return response()->json([
            'success' => false,
            'message' => $e->getMessage()
        ], 400);
    }
}

/**
 * Check if travel can be cancelled
 */
private function canCancelTravel($travelId)
{
    $travel = Travel::find($travelId);
    
    if (!$travel) {
        return false;
    }
    
    // Already cancelled
    if (in_array($travel->status, ['CancelledByPassenger', 'CancelledByDriver'])) {
        return false;
    }
    
    // Completed or finished trip
    if (in_array($travel->status, ['Completed', 'Finished'])) {
        return false;
    }
    
    $stationWallet = StationWallet::where('travel_id', $travelId)->first();
    
    // Payment already released
    if ($stationWallet && $stationWallet->payment_status === 'released') {
        return false;
    }
    
    return true;
}


    // ==========================================
    // ROUTE WRAPPER METHODS
    // ==========================================

    /**
     * Route wrapper: Accept travel
     */
    public function acceptTravelRoute($travelId, Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:app_users,id',
            'lang' => 'nullable|in:en,ar,ur'
        ]);
        
        try {
            // ✅ HEADER SUPPORT ADDED
            $lang = $this->getLanguageFromRequest($request, 'en');
            $result = $this->acceptTravel($travelId, $request->user_id, $lang);
            return response()->json($result);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Route wrapper: Cancel travel by driver
     */
    public function cancelTravelByDriverRoute($travelId, Request $request)
    {
        $request->validate([
            'lang' => 'nullable|in:en,ar,ur'
        ]);
        
        try {
            // ✅ HEADER SUPPORT ADDED
            $lang = $this->getLanguageFromRequest($request, 'en');
            $result = $this->cancelTravelByDriver($travelId, $lang);
            return response()->json($result);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error: ' . $e->getMessage()
            ], 404);
        }
    }

        /**
         * Route wrapper: Cancel travel by passenger
         */
    public function cancelTravelByPassengerRoute($travelId, Request $request)
    {
        // ✅ Accept Both Parameters
        $validated = $request->validate([
            'passenger_id' => 'nullable|exists:app_users,id',
            'client_id' => 'nullable|exists:app_users,id',
            'lang' => 'nullable|in:en,ar,ur' // ✅ LANG PARAMETER ADD KARO
        ]);

        // At least one should be present
        if (!$request->has('passenger_id') && !$request->has('client_id')) {
            return response()->json([
                'success' => false,
                'message' => 'Either passenger_id or client_id is required'
            ], 400);
        }

        try {
            $passengerId = $request->passenger_id ?? $request->client_id;
            
            // ✅ CHECK HEADER FIRST, THEN BODY, THEN DEFAULT
            $lang = $request->header('lang') 
                    ?? $request->header('Lang') 
                    ?? $request->header('Accept-Language')
                    ?? $request->get('lang', 'ar'); // ✅ DEFAULT 'ar'
            
            // Ensure valid language
            if (!in_array($lang, ['en', 'ar', 'ur'])) {
                $lang = 'ar';
            }
            
            // ✅ LANG PARAMETER PASS KARO
            $result = $this->cancelTravelByPassenger($travelId, $passengerId, $lang);
            return response()->json($result);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }   

    /**
     * Route wrapper: Confirm order
     */
    public function confirmOrderRoute(Request $request, $travelId)
    {
        $request->validate([
            'type' => 'required|in:client,driver',
            'lang' => 'nullable|in:en,ar,ur'
        ]);

        try {
            // ✅ HEADER SUPPORT ADDED
            $lang = $this->getLanguageFromRequest($request, 'ar');
            $result = $this->confirmOrder($travelId, $request->type, $lang);
            return response()->json($result);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 404);
        }
    }

/**
 * Start Trip - Driver starts journey
 */
public function startTrip($travelId, Request $request)
{
    $request->validate(['user_id' => 'required|exists:app_users,id']);
    DB::beginTransaction();
    try {
        $travel = Travel::findOrFail($travelId);
        
        if ($travel->user_id != $request->user_id) {
            throw new \Exception('Unauthorized. Not your trip.');
        }
        
        if ($travel->started_at) {
            throw new \Exception('Trip already started.');
        }
        
        if ($travel->status !== 'PassengerAccepted') {
            throw new \Exception('Trip must be accepted first.');
        }
        
        $travel->update([
            'status' => 'InProgress',
            'started_at' => $this->getSaudiTime()
        ]);
        
        DB::commit();
        
        return response()->json([
            'success' => true,
            'message' => 'Trip started successfully.',
            'data' => ['travel' => $travel->fresh()]
        ]);
        
    } catch (\Exception $e) {
        DB::rollBack();
        return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
    }
}

/**
 * End Trip - Driver completes journey
 */
public function endTrip($travelId, Request $request)
{
        $request->validate([
            'user_id' => 'required|exists:app_users,id'
        ]);
    DB::beginTransaction();
    try {
        $travel = Travel::findOrFail($travelId);
        
        if ($travel->user_id != $request->user_id) {
            throw new \Exception('Unauthorized.');
        }
        
        if (!$travel->started_at) {
            throw new \Exception('Trip not started yet.');
        }
        
        if ($travel->ended_at) {
            throw new \Exception('Trip already ended.');
        }
        
        if ($travel->status !== 'InProgress') {
            throw new \Exception('Trip must be in progress.');
        }
        
        $duration = now()->diffInMinutes($travel->started_at);
        
        $travel->update([
            'status' => 'Completed',
            'ended_at' => $this->getSaudiTime()
        ]);
        
        DB::commit();
        
        return response()->json([
            'success' => true,
            'message' => 'Trip completed successfully. Waiting for passenger confirmation to release payment.',
            'data' => [
                'travel' => $travel->fresh(),
                'duration_minutes' => $duration
            ]
        ]);
        
    } catch (\Exception $e) {
        DB::rollBack();
        return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
    }
}

/**
 * Get Trip Status
 */
public function getTripStatus($travelId)
{
    try {
        $travel = Travel::with('client', 'appUser.vehicle', 'between_city')->findOrFail($travelId);
        $stationWallet = StationWallet::where('travel_id', $travelId)->first();

        $duration = null;
        if ($travel->started_at) {
            $endTime = $travel->ended_at ?? now();
            $duration = $travel->started_at->diffInMinutes($endTime);
        }

        // ✅ Add company_type to between_city (SIMPLE)
        if ($travel->between_city && $travel->between_city->company_type) {
            $travel->between_city->company_type_name = $travel->between_city->company_type;
        }

        return response()->json([
            'success' => true,
            'data' => [
                'travel' => $travel,
                'transport_types' => $travel->transport_types,
                'status' => [
                    'current_status' => $travel->status,
                    'trip_started' => $travel->started_at ? true : false,
                    'trip_ended' => $travel->ended_at ? true : false,
                    'duration_minutes' => $duration
                ],
                'confirmations' => [
                    'client_confirmed' => $stationWallet ? $stationWallet->client_status === 'confirmed' : false,
                    'driver_confirmed' => $stationWallet ? $stationWallet->driver_status === 'confirmed' : false
                ],
                'payment' => [
                    'amount' => $stationWallet ? $stationWallet->amount : 0,
                    'status' => $stationWallet ? $stationWallet->payment_status : 'unknown'
                ]
            ]
        ]);

    } catch (\Exception $e) {
        return response()->json(['success' => false, 'message' => $e->getMessage()], 404);
    }
}

/**
 * Check if driver has active intercity subscription
 */
private function hasActiveIntercitySubscription($userId)
{
    $intercityPackage = PackageType::where('name', 'بين المدن')->first();
    
    if (!$intercityPackage) {
        return false;
    }
    
    $activeSubscription = Subscription::where('user_id', $userId)
        ->where('package_id', $intercityPackage->id)
        ->where('status', 'active')
        ->first();
    
    return $activeSubscription !== null;
}

/**
 * Vehicle Type Mapping (English ↔ Arabic)
 */
private const VEHICLE_TYPE_MAPPING = [
    'limousine_taxi' => 'تاكسي ليموزين',
    'private_car' => 'سيارة خاصة',
    'bus' => 'حافلة'
];

/**
 * Get Arabic equivalent of English vehicle type
 */
private function getArabicType($englishType)
{
    return self::VEHICLE_TYPE_MAPPING[strtolower($englishType)] ?? $englishType;
}

/**
 * Get English equivalent of Arabic vehicle type
 */
private function getEnglishType($arabicType)
{
    $flipped = array_flip(self::VEHICLE_TYPE_MAPPING);
    return $flipped[$arabicType] ?? $arabicType;
}

/**
 * Check if two vehicle types match (supports English & Arabic)
 */
private function vehicleTypesMatch($type1, $type2)
{
    $type1_clean = strtolower(trim($type1));
    $type2_clean = strtolower(trim($type2));
    
    if ($type1_clean === $type2_clean) {
        return true;
    }
    
    $type1_arabic = $this->getArabicType($type1_clean);
    $type2_arabic = $this->getArabicType($type2_clean);
    
    return $type1_arabic === $type2_clean || $type2_arabic === $type1_clean;
}

/**
 * Validate route configuration matches trip requirements
 */
public function validateRouteConfiguration($betweenCityId, $passengers, $selectedTransportType, $lang = 'ar')
{
    $messages = [
        'ar' => [
            'type_not_allowed' => 'نوع المركبة {type} غير متاح على هذا الطريق. الأنواع المتاحة: {available}',
            'exceeds_limit' => 'عدد الركاب {count} يتجاوز الحد الأقصى المسموح ({max} راكب)'
        ],
        'en' => [
            'type_not_allowed' => 'Vehicle type {type} is not available on this route. Available types: {available}',
            'exceeds_limit' => 'Passenger count {count} exceeds maximum allowed ({max} passengers)'
        ],
        'ur' => [
            'type_not_allowed' => 'گاڑی کی قسم {type} اس راستے پر دستیاب نہیں۔ دستیاب اقسام: {available}',
            'exceeds_limit' => 'مسافروں کی تعداد {count} زیادہ سے زیادہ حد ({max} مسافر) سے زیادہ ہے'
        ]
    ];

    $betweenCity = BetweenCity::find($betweenCityId);
    
    if (!$betweenCity) {
        return true;
    }

    // CHECK #1: Transport Type
    // $allowedTypes = is_array($betweenCity->transport_types_arabic) 
    //     ? $betweenCity->transport_types_arabic 
    //     : [];

    // $typeAllowed = false;
    // foreach ($allowedTypes as $allowedType) {
    //     if ($this->vehicleTypesMatch($selectedTransportType, $allowedType)) {
    //         $typeAllowed = true;
    //         break;
    //     }
    // }

    // if (!$typeAllowed && count($allowedTypes) > 0) {
    //     $availableList = implode(', ', $allowedTypes);
    //     $error = str_replace(
    //         ['{type}', '{available}'],
    //         [$selectedTransportType, $availableList],
    //         $messages[$lang]['type_not_allowed']
    //     );
    //     throw new \Exception($error);
    // }

    // ✅ CHECK #2: Company Type Passenger Limit (NEW - SIMPLE)
    if ($betweenCity->company_type) {
        $companyTypes = \App\Http\Controllers\Transport\BetweenCityController::COMPANY_TYPES;
        
        if (isset($companyTypes[$betweenCity->company_type])) {
            $maxPassengers = $companyTypes[$betweenCity->company_type]['max_passengers'];
            
            if ($passengers > $maxPassengers) {
                $error = str_replace(
                    ['{count}', '{max}'],
                    [$passengers, $maxPassengers],
                    $messages[$lang]['exceeds_limit']
                );
                throw new \Exception($error);
            }
        }
    }

    // CHECK #3: Route passenger limit (existing)
    $routeMaxPassengers = (int) $betweenCity->passengers;
    
    if ($routeMaxPassengers > 0 && $passengers > $routeMaxPassengers) {
        $error = str_replace(
            ['{count}', '{max}'],
            [$passengers, $routeMaxPassengers],
            $messages[$lang]['exceeds_limit']
        );
        throw new \Exception($error);
    }

    return true;
}

/**
 * ✅ NEW: Validate driver capacity (company + vehicle) WITHOUT type check
 * This runs ALWAYS, even if transport_type is null
 */
private function validateDriverCapacityForTrip($driverId, $tripPassengers, $lang = 'ar')
{
    $messages = [
        'ar' => [
            'no_vehicle' => 'لم يتم العثور على سيارة للسائق',
            'no_company' => 'لم يتم العثور على شركة السائق',
            'capacity_insufficient' => 'سيارتك تتسع لـ {capacity} مقاعد فقط، والرحلة تحتاج {required} راكب',
            'company_limit' => 'عدد الركاب {required} يتجاوز الحد الأقصى لنوع شركتك ({max} راكب)'
        ],
        'en' => [
            'no_vehicle' => 'No vehicle found for driver',
            'no_company' => 'Driver company not found',
            'capacity_insufficient' => 'Your vehicle has only {capacity} seats, trip needs {required} passengers',
            'company_limit' => 'Passenger count {required} exceeds your company type maximum ({max} passengers)'
        ],
        'ur' => [
            'no_vehicle' => 'ڈرائیور کے لیے گاڑی نہیں ملی',
            'no_company' => 'ڈرائیور کی کمپنی نہیں ملی',
            'capacity_insufficient' => 'آپ کی گاڑی میں صرف {capacity} سیٹیں ہیں، سفر کو {required} مسافر درکار ہیں',
            'company_limit' => 'مسافروں کی تعداد {required} آپ کی کمپنی کی زیادہ سے زیادہ حد ({max} مسافر) سے زیادہ ہے'
        ]
    ];

    // Get driver's company
    $company = \App\Models\Company::where('user_id', $driverId)->first();
    
    if (!$company) {
        throw new \Exception($messages[$lang]['no_company']);
    }

    $requiredCapacity = (int) $tripPassengers;

    // ✅ CHECK 1: Company Type Max Passenger Limit (CRITICAL!)
    if ($company->company_type) {
        $companyTypes = \App\Http\Controllers\Transport\BetweenCityController::COMPANY_TYPES;
        
        if (isset($companyTypes[$company->company_type])) {
            $maxAllowed = $companyTypes[$company->company_type]['max_passengers'];
            
            if ($requiredCapacity > $maxAllowed) {
                $error = str_replace(
                    ['{required}', '{max}'],
                    [$requiredCapacity, $maxAllowed],
                    $messages[$lang]['company_limit']
                );
                throw new \Exception($error);
            }
        }
    }

    // ✅ CHECK 2: Vehicle Capacity
    $vehicle = \App\Models\Vehicle::where('user_id', $driverId)->first();
    
    if (!$vehicle) {
        throw new \Exception($messages[$lang]['no_vehicle']);
    }

    $vehicleCapacity = (int) $vehicle->number_of_passengers;
    
    if ($vehicleCapacity < $requiredCapacity) {
        $error = str_replace(
            ['{capacity}', '{required}'],
            [$vehicleCapacity, $requiredCapacity],
            $messages[$lang]['capacity_insufficient']
        );
        throw new \Exception($error);
    }

    return true;
}

/**
 * ✅ NEW: Validate ONLY vehicle type match (separated from capacity check)
 */
private function validateDriverVehicleTypeMatch($driverId, $tripTransportType, $lang = 'ar')
{
    $messages = [
        'ar' => [
            'no_vehicle' => 'لم يتم العثور على سيارة للسائق',
            'type_mismatch' => 'نوع سيارتك ({driver_type}) لا يتطابق مع نوع الرحلة المطلوب ({trip_type})'
        ],
        'en' => [
            'no_vehicle' => 'No vehicle found for driver',
            'type_mismatch' => 'Your vehicle type ({driver_type}) doesn\'t match required trip type ({trip_type})'
        ],
        'ur' => [
            'no_vehicle' => 'ڈرائیور کے لیے گاڑی نہیں ملی',
            'type_mismatch' => 'آپ کی گاڑی کی قسم ({driver_type}) مطلوبہ سفر کی قسم ({trip_type}) سے میل نہیں کھاتی'
        ]
    ];

    $vehicle = \App\Models\Vehicle::where('user_id', $driverId)->first();
    
    if (!$vehicle) {
        throw new \Exception($messages[$lang]['no_vehicle']);
    }

    // Check type match
    if (!$this->vehicleTypesMatch($vehicle->car_type, $tripTransportType)) {
        $error = str_replace(
            ['{driver_type}', '{trip_type}'],
            [$vehicle->car_type, $tripTransportType],
            $messages[$lang]['type_mismatch']
        );
        throw new \Exception($error);
    }

    return true;
}

/**
 * Validate existing trip against current rules
 */
public function validateExistingTrip($existingTravel, $requiredPassengers, $requiredType, $lang = 'ar')
{
    if (!$existingTravel || !$existingTravel->user_id) {
        return $existingTravel; // No driver assigned, trip is valid
    }

    $messages = [
        'ar' => [
            'revalidation_failed' => 'الرحلة الموجودة لم تعد تطابق المتطلبات'
        ],
        'en' => [
            'revalidation_failed' => 'Existing trip no longer matches requirements'
        ],
        'ur' => [
            'revalidation_failed' => 'موجودہ سفر اب تقاضوں سے میل نہیں کھاتا'
        ]
    ];

    try {
        // Fetch driver's vehicle
        $vehicle = \App\Models\Vehicle::where('user_id', $existingTravel->user_id)->first();
        
        if (!$vehicle) {
            Log::warning("Revalidation: No vehicle found for driver {$existingTravel->user_id} on trip {$existingTravel->id}");
            return null; // Driver has no vehicle, create new trip
        }

        // Check type match
        $typeMatches = $this->vehicleTypesMatch($vehicle->car_type, $existingTravel->selected_transport_type);
        
        if (!$typeMatches) {
            Log::info("Revalidation Failed: Type mismatch. Driver has {$vehicle->car_type}, trip needs {$existingTravel->selected_transport_type}");
            return null;
        }

        // Check capacity
        $vehicleCapacity = (int) $vehicle->number_of_passengers;
        $tripPassengers = (int) $existingTravel->passengers;
        
        if ($vehicleCapacity < $tripPassengers) {
            Log::info("Revalidation Failed: Capacity insufficient. Driver has {$vehicleCapacity} seats, trip needs {$tripPassengers}");
            return null;
        }

        // All checks passed
        Log::info("Revalidation Passed: Returning existing trip {$existingTravel->id}");
        return $existingTravel;

    } catch (\Exception $e) {
        Log::error("Revalidation Error: " . $e->getMessage());
        return null;
    }
}

/**
 * Validate driver's vehicle matches trip requirements
 */
public function validateDriverVehicleForTrip($driverId, $tripPassengers, $tripTransportType, $lang = 'ar')
{
    $messages = [
        'ar' => [
            'no_vehicle' => 'لم يتم العثور على سيارة للسائق',
            'no_company' => 'لم يتم العثور على شركة السائق',
            'type_mismatch' => 'نوع سيارتك ({driver_type}) لا يتطابق مع نوع الرحلة المطلوب ({trip_type})',
            'capacity_insufficient' => 'سيارتك تتسع لـ {capacity} مقاعد فقط، والرحلة تحتاج {required} راكب',
            'company_limit' => 'عدد الركاب {required} يتجاوز الحد الأقصى لنوع شركتك ({max} راكب)'
        ],
        'en' => [
            'no_vehicle' => 'No vehicle found for driver',
            'no_company' => 'Driver company not found',
            'type_mismatch' => 'Your vehicle type ({driver_type}) doesn\'t match required trip type ({trip_type})',
            'capacity_insufficient' => 'Your vehicle has only {capacity} seats, trip needs {required} passengers',
            'company_limit' => 'Passenger count {required} exceeds your company type maximum ({max} passengers)'
        ],
        'ur' => [
            'no_vehicle' => 'ڈرائیور کے لیے گاڑی نہیں ملی',
            'no_company' => 'ڈرائیور کی کمپنی نہیں ملی',
            'type_mismatch' => 'آپ کی گاڑی کی قسم ({driver_type}) مطلوبہ سفر کی قسم ({trip_type}) سے میل نہیں کھاتی',
            'capacity_insufficient' => 'آپ کی گاڑی میں صرف {capacity} سیٹیں ہیں، سفر کو {required} مسافر درکار ہیں',
            'company_limit' => 'مسافروں کی تعداد {required} آپ کی کمپنی کی زیادہ سے زیادہ حد ({max} مسافر) سے زیادہ ہے'
        ]
    ];

    // Get driver's vehicle
    $vehicle = \App\Models\Vehicle::where('user_id', $driverId)->first();
    
    if (!$vehicle) {
        throw new \Exception($messages[$lang]['no_vehicle']);
    }

    // ✅ CHECK 1: Type Match
    if (!$this->vehicleTypesMatch($vehicle->car_type, $tripTransportType)) {
        $error = str_replace(
            ['{driver_type}', '{trip_type}'],
            [$vehicle->car_type, $tripTransportType],
            $messages[$lang]['type_mismatch']
        );
        throw new \Exception($error);
    }

    // ✅ CHECK 2: Vehicle Capacity
    $vehicleCapacity = (int) $vehicle->number_of_passengers;
    $requiredCapacity = (int) $tripPassengers;
    
    if ($vehicleCapacity < $requiredCapacity) {
        $error = str_replace(
            ['{capacity}', '{required}'],
            [$vehicleCapacity, $requiredCapacity],
            $messages[$lang]['capacity_insufficient']
        );
        throw new \Exception($error);
    }

    // ✅ CHECK 3: Company Type Max Passenger Limit
    $company = \App\Models\Company::where('user_id', $driverId)->first();
    
    if (!$company) {
        throw new \Exception($messages[$lang]['no_company']);
    }

    if ($company->company_type) {
        $companyTypes = \App\Http\Controllers\Transport\BetweenCityController::COMPANY_TYPES;
        
        if (isset($companyTypes[$company->company_type])) {
            $maxAllowed = $companyTypes[$company->company_type]['max_passengers'];
            
            if ($requiredCapacity > $maxAllowed) {
                $error = str_replace(
                    ['{required}', '{max}'],
                    [$requiredCapacity, $maxAllowed],
                    $messages[$lang]['company_limit']
                );
                throw new \Exception($error);
            }
        }
    }

    return true;
}


/**
 * ✅ NEW: Validate driver's company type matches TRIP's company type
 */
private function validateDriverCompanyTypeForTrip($driverId, $tripCompanyType, $lang = 'ar')
{
    $messages = [
        'ar' => [
            'no_company' => 'لم يتم العثور على شركة السائق',
            'company_mismatch' => 'نوع شركتك ({driver_company}) لا يطابق نوع الرحلة المطلوب ({trip_company}). لا يمكن قبول هذه الرحلة.'
        ],
        'en' => [
            'no_company' => 'Driver company not found',
            'company_mismatch' => 'Your company type ({driver_company}) does not match the required trip company type ({trip_company}). Cannot accept this trip.'
        ],
        'ur' => [
            'no_company' => 'ڈرائیور کی کمپنی نہیں ملی',
            'company_mismatch' => 'آپ کی کمپنی کی قسم ({driver_company}) سفر کی مطلوبہ کمپنی کی قسم ({trip_company}) سے میل نہیں کھاتی۔ یہ سفر قبول نہیں کیا جا سکتا۔'
        ]
    ];

    // Get driver's company
    $driverCompany = \App\Models\Company::where('user_id', $driverId)->first();
    
    if (!$driverCompany) {
        throw new \Exception($messages[$lang]['no_company']);
    }

    // Compare driver company type with TRIP company type
    if ($driverCompany->company_type !== $tripCompanyType) {
        // Get readable names
        $companyTypes = \App\Http\Controllers\Transport\BetweenCityController::COMPANY_TYPES;
        
        $driverCompanyName = $companyTypes[$driverCompany->company_type]['name_ar'] ?? $driverCompany->company_type;
        $tripCompanyName = $companyTypes[$tripCompanyType]['name_ar'] ?? $tripCompanyType;
        
        $error = str_replace(
            ['{driver_company}', '{trip_company}'],
            [$driverCompanyName, $tripCompanyName],
            $messages[$lang]['company_mismatch']
        );
        
        throw new \Exception($error);
    }

    return true;
}

/**
 * ✅ NEW: Validate driver's company type is allowed on ROUTE
 */
private function validateDriverCompanyTypeOnRoute($driverId, $betweenCityId, $lang = 'ar')
{
    $messages = [
        'ar' => [
            'no_company' => 'لم يتم العثور على شركة السائق',
            'route_not_allowed' => 'نوع شركتك ({driver_company}) غير مسموح به على هذا الطريق. الأنواع المسموحة: {allowed_types}'
        ],
        'en' => [
            'no_company' => 'Driver company not found',
            'route_not_allowed' => 'Your company type ({driver_company}) is not allowed on this route. Allowed types: {allowed_types}'
        ],
        'ur' => [
            'no_company' => 'ڈرائیور کی کمپنی نہیں ملی',
            'route_not_allowed' => 'آپ کی کمپنی کی قسم ({driver_company}) اس راستے پر اجازت نہیں۔ اجازت شدہ اقسام: {allowed_types}'
        ]
    ];

    // Get driver's company
    $driverCompany = \App\Models\Company::where('user_id', $driverId)->first();
    
    if (!$driverCompany) {
        throw new \Exception($messages[$lang]['no_company']);
    }

    // Get route configuration
    $betweenCity = \App\Models\BetweenCity::find($betweenCityId);
    
    if (!$betweenCity || !$betweenCity->company_type) {
        return true; // No restriction if route has no company_type
    }

    // Compare driver company type with ROUTE company type
    if ($driverCompany->company_type !== $betweenCity->company_type) {
        $companyTypes = \App\Http\Controllers\Transport\BetweenCityController::COMPANY_TYPES;
        
        $driverCompanyName = $companyTypes[$driverCompany->company_type]['name_ar'] ?? $driverCompany->company_type;
        $routeCompanyName = $companyTypes[$betweenCity->company_type]['name_ar'] ?? $betweenCity->company_type;
        
        $error = str_replace(
            ['{driver_company}', '{allowed_types}'],
            [$driverCompanyName, $routeCompanyName],
            $messages[$lang]['route_not_allowed']
        );
        
        throw new \Exception($error);
    }

    return true;
}

    /**
     * Route wrapper: Release pending payments
     */
    public function releasePendingPaymentsRoute()
    {
        try {
            $result = $this->releasePendingPayments();
            return response()->json($result);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error releasing payments: ' . $e->getMessage()
            ], 500);
        }
    }
}