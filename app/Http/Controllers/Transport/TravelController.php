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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TravelController extends Controller
{
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
            'selected_transport_type' => $data['selected_transport_type'] ?? null,
            'round_trip' => $data['round_trip'] ?? false
        ]);
    }

    /**
     * Create travel with driver assigned
     */
    public function createAssignedTravel(array $data)
    {

    // ✅ CHECK SUBSCRIPTION BEFORE CREATING TRAVEL
    if (isset($data['user_id']) && !$this->hasActiveIntercitySubscription($data['user_id'])) {
        throw new \Exception('Driver needs an active intercity package to create rides.');
    }

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
            'selected_transport_type' => $data['selected_transport_type'] ?? null,
            'round_trip' => $data['round_trip'] ?? false
        ]);
    }

    /**
     * Create travel with client (passenger who booked)
     */
    public function createClientTravel(array $data)
    {
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
            'selected_transport_type' => $data['selected_transport_type'] ?? null,
            'round_trip' => $data['round_trip'] ?? false
        ]);
    }

    /**
     * Check if travel already exists
     */
// public function findExistingTravel(array $criteria)
// {
//     return Travel::where('from', $criteria['from'])
//         ->where('to', $criteria['to'])
//         ->where('date', $criteria['date'])
//         ->where('time', $criteria['time'])
//         ->where('user_id', $criteria['user_id'])
//         ->where('client_id', $criteria['client_id'])
//         ->where('amount', $criteria['amount'])
//         ->where('passengers', $criteria['passengers'])
//         ->where('round_trip', $criteria['round_trip'])
//         // ✅ EXCLUDE CANCELLED AND FINISHED TRIPS - Allow new bookings
//         ->whereNotIn('status', [
//             'CancelledByPassenger', 
//             'CancelledByDriver',
//             'Finished',
//             'Completed'  // Also exclude completed but not yet confirmed trips
//         ])
//         ->first();
// }


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

    if (!$passengers || !$type) {
        return response()->json([
            'message' => 'passengers and type are required.',
            'data' => []
        ], 400);
    }

    $betweenCity = BetweenCity::where('passengers', $passengers)
        ->where('car_type', $type)
        ->first();

    if (!$betweenCity) {
        return response()->json([
            'message' => 'No matching BetweenCity found.',
            'data' => []
        ], 404);
    }

    $travels = Travel::whereNull('user_id')
        ->where('status', 'Waiting')
        ->where('between_city_id', $betweenCity->id)
        ->get();

    return response()->json([
        'message' => 'Successfully retrieved.',
        'data' => $travels
    ]);
}

    /**
     * Get client travels
     */
    public function getClientTravels($clientId)
    {
        $travels = Travel::where('client_id', $clientId)
            ->with(['appUser.vehicle', 'between_city'])
            ->get();

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
            'need_package' => 'تحتاج إلى باقة نشطة بين المدن لقبول الرحلات. يرجى شراء باقة أولاً.',
            'not_found' => 'الرحلة غير موجودة',
            'success' => 'تم قبول السائق بنجاح. في انتظار تأكيد الراكب.'
        ],
        'en' => [
            'need_package' => 'You need an active intercity package to accept rides. Please purchase a package first.',
            'not_found' => 'Travel not found',
            'success' => 'Driver accepted successfully. Waiting for passenger confirmation.'
        ],
        'ur' => [
            'need_package' => 'سواریاں قبول کرنے کے لیے آپ کو فعال انٹر سٹی پیکج کی ضرورت ہے۔ براہ کرم پہلے پیکج خریدیں۔',
            'not_found' => 'سفر نہیں ملا',
            'success' => 'ڈرائیور نے کامیابی سے قبول کیا۔ مسافر کی تصدیق کا انتظار ہے۔'
        ]
    ];

    DB::beginTransaction();
    try {
        if (!$this->hasActiveIntercitySubscription($userId)) {
            throw new \Exception($messages[$lang]['need_package'] ?? $messages['en']['need_package']);
        }
        
        $travel = Travel::find($travelId);
        if (!$travel) {
            throw new \Exception($messages[$lang]['not_found'] ?? $messages['en']['not_found']);
        }

        $stationWallet = StationWallet::where('travel_id', $travelId)->first();
        if (!$stationWallet) {
            $stationWallet = $this->createStationWallet($travelId, $travel->amount);
        }

        $travel->update([
            'user_id' => $userId,
            'status' => 'DriverAccepted',
            'driver_assigned_at' => now()
        ]);
        
        if ($travel->passenger_id) {
            $passenger = Passenger::where('id', $travel->passenger_id)->first();
            if ($passenger) {
                $passenger->update(['user_id' => $userId]);
            }
        }

        $stationWallet->update(['driver_status' => 'confirmed']);
        DB::commit();

        return [
            'success' => true,
            'message' => $messages[$lang]['success'] ?? $messages['en']['success'],
            'status' => 'driver_accepted',
            'requires_passenger_confirmation' => true,
            'travel_id' => $travelId
        ];

    } catch (\Exception $e) {
        DB::rollBack();
        throw $e;
    }
}
    /**
     * Cancel unassigned travel (by client)
     */
    // public function cancelUnassignedTravel($travelId)
    // {
    //     DB::beginTransaction();
    //     try {
    //         $travel = Travel::find($travelId);

    //         if (!$travel) {
    //             throw new \Exception('Travel not found');
    //         }

    //         $clientId = $travel->client_id;
    //         $price = $travel->amount;

    //         $stationWallet = StationWallet::where('travel_id', $travelId)->first();
            
    //         if ($stationWallet && $stationWallet->payment_status === 'hold') {
    //             // Refund to client
    //             $wallet = Wallet::where('user_id', $clientId)->first();
                
    //             if ($wallet) {
    //                 $wallet->current_balance += $price;
    //                 $wallet->save();
    //             }

    //             $stationWallet->update([
    //                 'payment_status' => 'cancelled',
    //                 'client_status' => 'cancelled',
    //                 'driver_status' => 'cancelled'
    //             ]);
    //         } else {
    //             // Old case - no hold payment
    //             $wallet = Wallet::firstOrCreate(
    //                 ['user_id' => $clientId],
    //                 ['current_balance' => 0, 'total_recharge' => 0]
    //             );

    //             $wallet->current_balance += $price;
    //             $wallet->save();
    //         }

    //         $travel->delete();
    //         DB::commit();

    //         return ['message' => 'Travel cancelled and amount refunded to wallet.'];

    //     } catch (\Exception $e) {
    //         DB::rollBack();
    //         throw $e;
    //     }
    // }

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
            'success' => 'تم إلغاء الرحلة بنجاح. لم تعد مخصصًا لهذه الرحلة.'
        ],
        'en' => [
            'in_progress' => 'You cannot cancel the trip once you have started the journey.',
            'completed' => 'Cannot cancel completed trip. You have already ended the trip.',
            'finished' => 'Trip is finished and payment processed. Cancellation not possible.',
            'already_cancelled_passenger' => 'This trip was already cancelled by the passenger.',
            'already_cancelled' => 'You have already cancelled this trip.',
            'cannot_cancel' => 'Cancellation not allowed for this trip status.',
            'trip_started' => 'Trip has already started. You cannot cancel after beginning the journey.',
            'success' => 'Travel cancelled successfully. You are no longer assigned to this trip.'
        ],
        'ur' => [
            'in_progress' => 'سفر شروع ہونے کے بعد آپ ٹرپ منسوخ نہیں کر سکتے۔',
            'completed' => 'مکمل شدہ ٹرپ منسوخ نہیں کیا جا سکتا۔ آپ پہلے ہی ٹرپ ختم کر چکے ہیں۔',
            'finished' => 'ٹرپ مکمل ہو گیا اور ادائیگی کی کارروائی ہو گئی۔ منسوخی ممکن نہیں۔',
            'already_cancelled_passenger' => 'یہ ٹرپ مسافر نے پہلے ہی منسوخ کر دیا تھا۔',
            'already_cancelled' => 'آپ پہلے ہی یہ ٹرپ منسوخ کر چکے ہیں۔',
            'cannot_cancel' => 'اس ٹرپ کی حیثیت کے لیے منسوخی کی اجازت نہیں۔',
            'trip_started' => 'ٹرپ پہلے ہی شروع ہو چکا ہے۔ سفر شروع کرنے کے بعد منسوخ نہیں کیا جا سکتا۔',
            'success' => 'سفر کامیابی سے منسوخ ہو گیا۔ آپ اب اس ٹرپ کے لیے مختص نہیں ہیں۔'
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

        // ✅ SUBSCRIPTION INACTIVATION 
        $intercityPackage = PackageType::where('name', 'بين المدن')->first();
        if ($intercityPackage) {
            $activeSubscriptions = Subscription::where('user_id', $driverId)
                ->where('package_id', $intercityPackage->id)
                ->where('status', 'active')
                ->get();

            foreach ($activeSubscriptions as $subscription) {
                $subscription->update([
                    'status' => 'inactive', 
                    'updated_at' => now()
                ]);
                \Log::info("Subscription inactive for driver: {$driverId}, Subscription ID: {$subscription->id}");
            }
        }

        $stationWallet = StationWallet::where('travel_id', $travelId)->first();
        if ($stationWallet) {
            $stationWallet->update([
                'driver_status' => 'cancelled',
                'client_status' => 'hold', // ✅ Client status will be on hold and payment will be refunded
                'payment_status' => 'hold'
            ]);
        }

        // ✅ CRITICAL FIX: RIDE WILL BE AVAILABLE AGAIN FOR OTHER DRIVERS
        $travel->update([
            'user_id' => null, // ✅ Driver remove karo
            'status' => 'Waiting', // ✅ Status phir se 'Waiting' karo
            'driver_assigned_at' => null, // ✅ Driver assignment reset karo
            'cancelled_at' => now()
        ]);
        
        if ($travel->passenger_id) {
            $passenger = Passenger::where('id', $travel->passenger_id)->first();
            if ($passenger) {
                $passenger->update(['user_id' => null]);
            }
        }

        DB::commit();

        return [
            'message' => $messages[$lang]['success'] ?? $messages['en']['success']
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

/**
 * Passenger cancels travel with refund rules - CLEAN VERSION
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

        // ✅ CALCULATE REFUND
        $currentTime = now();
        $driverAssignedTime = $travel->driver_assigned_at;
        
        if (!$driverAssignedTime) {
            $refundPercentage = 100;
        } else {
            $hoursSinceAssignment = $driverAssignedTime->diffInHours($currentTime);
            $refundPercentage = ($hoursSinceAssignment <= 12) ? 100 : 90;
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
                'driver_status' => 'cancelled'
            ]);
        }

        // ✅ UPDATE TRAVEL STATUS (ONCE ONLY)
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
                    'transaction_date' => now()
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
                'original_amount' => $originalAmount
            ]
        ];

    } catch (\Exception $e) {
        DB::rollBack();
        Log::error('CANCELLATION ERROR: ' . $e->getMessage());
        throw $e;
    }
}


// public function cancelTravelByPassenger($travelId, $passengerId, $lang = 'en')
// {
//     $messages = [
//         'ar' => [
//             'in_progress' => 'إلغاء الرحلة غير مسموح به بمجرد بدء الرحلة.',
//             'completed' => 'لا يمكن إلغاء رحلة مكتملة. يرجى الاتصال بالدعم للحصول على المساعدة.',
//             'finished' => 'انتهت الرحلة وتمت معالجة الدفع. الإلغاء غير ممكن.',
//             'already_cancelled' => 'تم إلغاء هذه الرحلة بالفعل من قبلك.',
//             'cancelled_by_driver' => 'تم إلغاء هذه الرحلة من قبل السائق.',
//             'trip_started' => 'لقد بدأت الرحلة بالفعل. الإلغاء غير مسموح به بعد بدء الرحلة.',
//             'unauthorized' => 'محاولة إلغاء غير مصرح بها.',
//             'payment_released' => 'تم إصدار الدفع للسائق بالفعل. لا يمكن الإلغاء.',
//             'success' => 'تم إلغاء الرحلة بنجاح.',
//             'refund_name' => 'إسترجاع دفعة',
//             'trip_label' => 'رحلة من',
//             'to' => 'إلى'
//         ],
//         'en' => [
//             'in_progress' => 'Trip cancellation is not allowed once the journey has started.',
//             'completed' => 'Cannot cancel completed trip. Please contact support for assistance.',
//             'finished' => 'Trip is finished and payment processed. Cancellation not possible.',
//             'already_cancelled' => 'This trip was already cancelled by you.',
//             'cancelled_by_driver' => 'This trip was cancelled by the driver.',
//             'trip_started' => 'Trip has already started. Cancellation is not permitted after journey begins.',
//             'unauthorized' => 'Unauthorized cancellation attempt.',
//             'payment_released' => 'Payment already released to driver. Cannot cancel.',
//             'success' => 'Travel cancelled successfully.',
//             'refund_name' => 'Payment Refund',
//             'trip_label' => 'Trip from',
//             'to' => 'to'
//         ],
//         'ur' => [
//             'in_progress' => 'سفر شروع ہونے کے بعد ٹرپ منسوخ کرنے کی اجازت نہیں ہے۔',
//             'completed' => 'مکمل شدہ ٹرپ منسوخ نہیں کیا جا سکتا۔ مدد کے لیے سپورٹ سے رابطہ کریں۔',
//             'finished' => 'ٹرپ مکمل ہو گیا اور ادائیگی کی کارروائی ہو گئی۔ منسوخی ممکن نہیں۔',
//             'already_cancelled' => 'یہ ٹرپ آپ نے پہلے ہی منسوخ کر دیا تھا۔',
//             'cancelled_by_driver' => 'یہ ٹرپ ڈرائیور نے منسوخ کر دیا تھا۔',
//             'trip_started' => 'ٹرپ پہلے ہی شروع ہو چکا ہے۔ سفر شروع ہونے کے بعد منسوخی کی اجازت نہیں۔',
//             'unauthorized' => 'غیر مجاز منسوخی کی کوشش۔',
//             'payment_released' => 'ادائیگی پہلے ہی ڈرائیور کو جاری کی جا چکی ہے۔ منسوخ نہیں کیا جا سکتا۔',
//             'success' => 'سفر کامیابی سے منسوخ ہو گیا۔',
//             'refund_name' => 'ادائیگی کی واپسی',
//             'trip_label' => 'سے سفر',
//             'to' => 'سے'
//         ]
//     ];

//     DB::beginTransaction();
//     try {
//         $travel = Travel::findOrFail($travelId);

//         // ✅ CRITICAL: CHECK IF ALREADY REFUNDED (PREVENT DUPLICATE RECORDS)
//         $existingRefund = WalletDetail::where('travel_id', $travelId)
//             ->whereNotNull('refund_amount')
//             ->first();
        
//         if ($existingRefund) {
//             DB::rollBack();
//             Log::warning("Duplicate refund attempt blocked for travel_id: {$travelId}");
//             throw new \Exception($messages[$lang]['already_refunded'] ?? $messages['en']['already_refunded']);
//         }

//         $cancellationRules = [
//             'Waiting' => true,
//             'DriverAccepted' => true,
//             'PassengerAccepted' => true,
//             'InProgress' => false,
//             'Completed' => false,
//             'Finished' => false,
//             'CancelledByPassenger' => false,
//             'CancelledByDriver' => false,
//         ];

//         if (!isset($cancellationRules[$travel->status]) || !$cancellationRules[$travel->status]) {
//             $errorKey = [
//                 'InProgress' => 'in_progress',
//                 'Completed' => 'completed',
//                 'Finished' => 'finished',
//                 'CancelledByPassenger' => 'already_cancelled',
//                 'CancelledByDriver' => 'cancelled_by_driver',
//             ][$travel->status] ?? 'in_progress';
            
//             throw new \Exception($messages[$lang][$errorKey] ?? $messages['en'][$errorKey]);
//         }

//         if ($travel->started_at) {
//             throw new \Exception($messages[$lang]['trip_started'] ?? $messages['en']['trip_started']);
//         }
        
//         if ($travel->client_id != $passengerId) {
//             throw new \Exception($messages[$lang]['unauthorized'] ?? $messages['en']['unauthorized']);
//         }

//         $currentTime = now();
//         $driverAssignedTime = $travel->driver_assigned_at;
//         $refundPercentage = 0;
        
//         $refundReasons = [
//             'ar' => [
//                 'no_driver' => 'تم الإلغاء قبل تعيين السائق',
//                 'within_12h' => 'تم الإلغاء خلال 12 ساعة من تعيين السائق',
//                 'after_12h' => 'تم الإلغاء بعد 12 ساعة من تعيين السائق - خصم 10٪'
//             ],
//             'en' => [
//                 'no_driver' => 'Cancelled before driver assignment',
//                 'within_12h' => 'Cancelled within 12 hours of driver assignment',
//                 'after_12h' => 'Cancelled after 12 hours of driver assignment - 10% deduction'
//             ],
//             'ur' => [
//                 'no_driver' => 'ڈرائیور تفویض سے پہلے منسوخ کیا گیا',
//                 'within_12h' => 'ڈرائیور تفویض کے 12 گھنٹے کے اندر منسوخ کیا گیا',
//                 'after_12h' => 'ڈرائیور تفویض کے 12 گھنٹے بعد منسوخ کیا گیا - 10٪ کٹوتی'
//             ]
//         ];

//         if (!$driverAssignedTime) {
//             $refundPercentage = 100;
//             $refundReason = $refundReasons[$lang]['no_driver'] ?? $refundReasons['en']['no_driver'];
//         } else {
//             $hoursSinceAssignment = $driverAssignedTime->diffInHours($currentTime);
            
//             if ($hoursSinceAssignment <= 12) {
//                 $refundPercentage = 100;
//                 $refundReason = $refundReasons[$lang]['within_12h'] ?? $refundReasons['en']['within_12h'];
//             } else {
//                 $refundPercentage = 90;
//                 $refundReason = $refundReasons[$lang]['after_12h'] ?? $refundReasons['en']['after_12h'];
//             }
//         }

//         $originalAmount = $travel->amount;
//         $refundAmount = ($originalAmount * $refundPercentage) / 100;
//         $deductionAmount = $originalAmount - $refundAmount;

//         $stationWallet = StationWallet::where('travel_id', $travelId)->first();
        
//         if ($stationWallet) {
//             if ($stationWallet->payment_status === 'released') {
//                 throw new \Exception($messages[$lang]['payment_released'] ?? $messages['en']['payment_released']);
//             }
            
//             $stationWallet->update([
//                 'client_status' => 'cancelled',
//                 'payment_status' => 'cancelled',
//                 'driver_status' => 'cancelled'
//             ]);
//         }

//         // ✅ UPDATE TRAVEL STATUS FIRST (BEFORE WALLET OPERATIONS)
//         $travel->update([
//             'status' => 'CancelledByPassenger',
//             'cancelled_at' => $currentTime
//         ]);        

//         // ✅ REFUND ONLY IF AMOUNT IS GREATER THAN 0
//         if ($refundAmount > 0) {
//             $wallet = Wallet::where('user_id', $passengerId)->first();
//             if ($wallet) {
//                 // ✅ CRITICAL: CHECK IF REFUND ALREADY PROCESSED FOR THIS SPECIFIC TRIP
//                 $existingRefund = WalletDetail::where('travel_id', $travelId)
//                     ->whereNotNull('refund_amount')
//                     ->exists();
                
//                 if ($existingRefund) {
//                     Log::warning("Duplicate refund attempt blocked for travel_id: {$travelId}");
//                     DB::rollBack();
//                     throw new \Exception('Refund already processed for this trip.');
//                 }
                
//                 $wallet->current_balance += $refundAmount;
//                 $wallet->save();
                
//                 // ✅ LANGUAGE-SPECIFIC WALLET DETAIL
//                 $refundName = $messages[$lang]['refund_name'] ?? $messages['en']['refund_name'];
//                 $tripLabel = $messages[$lang]['trip_label'] ?? $messages['en']['trip_label'];
//                 $toLabel = $messages[$lang]['to'] ?? $messages['en']['to'];
                
//                 Log::info("Creating WalletDetail for travel_id: {$travelId}, passenger: {$passengerId}, lang: {$lang}");
                
//                 // ✅ SINGLE INSERT WITH UNIQUE CHECK
//                 WalletDetail::create([
//                     'name' => $refundName,
//                     'wallet_id' => $wallet->id,
//                     'amount' => $refundAmount,
//                     'refund_amount' => $refundAmount,
//                     'deduction_amount' => $deductionAmount,
//                     'refund_percentage' => $refundPercentage,
//                     'details' => $refundReason . ' | ' . $tripLabel . ' ' . $travel->from . ' ' . $toLabel . ' ' . $travel->to,
//                     'travel_id' => $travelId,
//                     'transaction_date' => now()
//                 ]);
                
//                 Log::info("WalletDetail created successfully for travel_id: {$travelId}");
//             }
//         }

//         $travel->update([
//             'status' => 'CancelledByPassenger',
//             'cancelled_at' => $currentTime
//         ]);

//         DB::commit();

//         return [
//             'success' => true,
//             'message' => $messages[$lang]['success'] ?? $messages['en']['success'],
//             'data' => [
//                 'refund_percentage' => $refundPercentage,
//                 'refund_amount' => $refundAmount,
//                 'deduction_amount' => $deductionAmount,
//                 'original_amount' => $originalAmount,
//                 'reason' => $refundReason
//             ]
//         ];

//     } catch (\Exception $e) {
//         DB::rollBack();
//         Log::error('CANCELLATION ERROR: ' . $e->getMessage());
//         throw $e;
//     }
// }

    /**
     * Confirm order (by client or driver)
     */
public function confirmOrder($travelId, $type)
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

        // Already released?
        if ($stationWallet->payment_status === 'released') {
            DB::rollBack();
            return [
                'success' => false,
                'message' => 'Payment already released to driver.'
            ];
        }

        // ✅ CRITICAL CHECK: Trip must be COMPLETED (status check)
        if ($travel->status !== 'Completed') {
            DB::rollBack();
            throw new \Exception('Trip must be completed first by driver. Driver needs to end the trip before payment can be released.');
        }

        // ✅ ONLY CLIENT CAN CONFIRM PAYMENT RELEASE
        if ($type !== 'client') {
            DB::rollBack();
            throw new \Exception('Only passenger can confirm payment release after trip completion.');
        }

        // Update confirmation status
        if ($type === 'client') {
            if ($stationWallet->client_status === 'confirmed') {
                DB::rollBack();
                throw new \Exception('Client already confirmed.');
            }
            $stationWallet->client_status = 'confirmed';
            
            // ✅ AUTOMATICALLY DRIVER BHI CONFIRMED
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

            $driverWallet->current_balance += $stationWallet->amount;
            $driverWallet->save();

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

        // ✅ AB YE CASE NAHI AYEGA KYUNKI SIRF CLIENT CONFIRM KAR SAKTA HAI
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
        
        // Check ke travel DriverAccepted status mein hai
        if ($travel->status !== 'DriverAccepted') {
            throw new \Exception('Ride is not in accepted state by driver.');
        }
        
        // Status update karo PassengerAccepted mein
        $travel->update([
            'status' => 'PassengerAccepted'
        ]);
        
        // ✅ UNCOMMENT THIS - STATION WALLET UPDATE IMPORTANT HAI
        $stationWallet = StationWallet::where('travel_id', $travelId)->first();
        if ($stationWallet) {
            $stationWallet->update([
                'client_status' => 'accepted'  // NOT 'confirmed'
            ]);
        }
        
        DB::commit();
        
        return response()->json([
            'success' => true,
            'message' => 'Ride confirmed by passenger successfully.',
            'data' => ['travel' => $travel]
        ]);
        
    } catch (\Exception $e) {
        DB::rollBack();
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
            'user_id' => 'required|exists:app_users,id'
            ]);
        try {
            $result = $this->acceptTravel($travelId, $request->user_id);
            return response()->json($result);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Route wrapper: Cancel unassigned travel
     */
    // public function cancelUnassignedTravelRoute($travelId)
    // {
    //     try {
    //         $result = $this->cancelUnassignedTravel($travelId);
    //         return response()->json($result);
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'message' => 'Error: ' . $e->getMessage()
    //         ], 500);
    //     }
    // }

    /**
     * Route wrapper: Cancel travel by driver
     */
    public function cancelTravelByDriverRoute($travelId)
    {
        try {
            $result = $this->cancelTravelByDriver($travelId);
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
                $lang = $request->get('lang', 'en'); // ✅ DEFAULT 'en'
                
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
        ]);

        try {
            $result = $this->confirmOrder($travelId, $request->type);
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
            'started_at' => now()
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
            'ended_at' => now()
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