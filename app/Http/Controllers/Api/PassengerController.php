<?php

namespace App\Http\Controllers\Api;

use Barryvdh\DomPDF\Facade\Pdf;
use Mpdf\Mpdf;


use App\Http\Controllers\Controller;
use App\Http\Controllers\Transport\TravelController;
use App\Models\Passenger;
use App\Models\PassengerList;
use App\Models\AppUser;
use App\Models\Company;
use App\Models\Vehicle;
use App\Models\BetweenCity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class PassengerController extends Controller
{
    protected $travelController;

    private function getSaudiTime()
    {
        return \Carbon\Carbon::now('Asia/Riyadh');
    }

    public function __construct(TravelController $travelController)
    {
        $this->travelController = $travelController;
    }

    /**
     * Create passenger with travel booking
     */
    public function create(Request $request)
    {
        $lang = $request->get('lang', 'en');

        DB::beginTransaction();
        try {
            // 1. Create Passenger
            $passenger = $this->createPassenger($request);

            // 2. Create Passenger Lists
            if ($request->has('passenger_list')) {
                $this->createPassengerLists($request->passenger_list, $passenger->id);
            }

            $travel = null;

            // 3. Validate BetweenCity (if needed)
            try {
                $betweenCityId = $this->travelController->validateBetweenCity(
                    $request->from,
                    $request->to,
                    $request->between_city_id,
                    $lang
                );
            } catch (\Exception $e) {
                DB::rollBack();
                return response()->json([
                    'success' => false,
                    'message' => $e->getMessage(),
                    'error_code' => 'CITIES_NOT_AVAILABLE'
                ], 400);
            }

            // 4. Create Travel (if date provided) with ALL validations
            if ($request->date) {
                $travel = $this->handleTravelCreation($request, $betweenCityId, $lang);
                
                // CRITICAL: Link passenger to travel
                if ($travel && $travel->id && !$travel->passenger_id) {
                    $travel->update(['passenger_id' => $passenger->id]);
                    Log::info("Passenger {$passenger->id} linked to travel {$travel->id}");
                }
            }

            DB::commit();

            $betweenCity = BetweenCity::find($betweenCityId);
            $transportTypes = $betweenCity ? $betweenCity->transport_types_arabic : [];

        // ✅ Get company_type details (NEW)
        $companyTypeDetails = null;
        if ($betweenCity && $betweenCity->company_type) {
            $companyTypes = \App\Http\Controllers\Transport\BetweenCityController::COMPANY_TYPES;
            if (isset($companyTypes[$betweenCity->company_type])) {
                $companyTypeDetails = [
                    'key' => $betweenCity->company_type,
                    'name_ar' => $companyTypes[$betweenCity->company_type]['name_ar'],
                    'name_en' => $companyTypes[$betweenCity->company_type]['name_en'],
                    'max_passengers' => $companyTypes[$betweenCity->company_type]['max_passengers'],
                    'transport_type' => $companyTypes[$betweenCity->company_type]['transport_type']
                ];
            }
        }

        // ✅ NEW: Get transport_type from created travel
        $travelTransportType = null;

        
        if ($travel) {
            // Priority 1: Check if travel has selected_transport_type
            if ($travel->selected_transport_type) {
                $travelTransportType = $travel->selected_transport_type;
            }
            // Priority 2: Get from travel's company_type
            elseif ($travel->company_type) {
                $companyTypes = \App\Http\Controllers\Transport\BetweenCityController::COMPANY_TYPES;
                if (isset($companyTypes[$travel->company_type]['transport_type'])) {
                    $travelTransportType = $companyTypes[$travel->company_type]['transport_type'];
                }
            }
            // Priority 3: Get from betweenCity's company_type (fallback)
            elseif ($betweenCity && $betweenCity->company_type) {
                $companyTypes = \App\Http\Controllers\Transport\BetweenCityController::COMPANY_TYPES;
                if (isset($companyTypes[$betweenCity->company_type]['transport_type'])) {
                    $travelTransportType = $companyTypes[$betweenCity->company_type]['transport_type'];
                }
            }
        }        


            $message = ($lang == 'ar') 
                ? 'تم إنشاء الرحلة بنجاح وحجز الدفع.' 
                : 'Passenger created successfully with payment hold.';

            return response()->json([
                'success' => true,
                'message' => $message,
                'data' => [
                    'passenger' => $passenger->load('list'),
                    'travel' => $travel ? $travel->load('client') : null,
                    'transport_type' => $travelTransportType,
                    'between_city' => $betweenCity ? [
                    'id' => $betweenCity->id,
                    'city_one' => $betweenCity->city_one,
                    'city_two' => $betweenCity->city_two,
                    'transport_types' => $transportTypes,
                    'company_type' => $companyTypeDetails
                ] : null
                ]
            ], 201);    
            
                } catch (\Exception $e) {
                    DB::rollBack();
                    
                    $errorMessage = $e->getMessage();
                    
                    // Wallet errors = 400, Others = 500
                    $statusCode = 400;
                    if (str_contains($errorMessage, 'An error occurred') || str_contains($errorMessage, 'حدث خطأ')) {
                        $statusCode = 500;
                    }

                    return response()->json([
                        'success' => false,
                        'message' => $errorMessage
                    ], $statusCode);
                }
    }

    /**
     * Create passenger record
     */
    private function createPassenger(Request $request)
    {
        return Passenger::create([
            'from' => $request->from,
            'to' => $request->to,
            'count' => $request->count,
            'user_id' => $request->user_id
        ]);
    }

    /**
     * Create passenger lists
     */
    private function createPassengerLists(array $passengerList, $passengerId)
    {
        foreach ($passengerList as $passengerData) {
            PassengerList::create([
                'name' => $passengerData['name'],
                'id_number' => $passengerData['id_number'],
                'phone_number' => $passengerData['Phone_number'],
                'passenger_id' => $passengerId,
            ]);
        }
    }

    /**
     * Handle travel creation based on request type
     */
private function handleTravelCreation(Request $request, $betweenCityId, $lang)
{
    $this->validateBookingTime($request->date, $request->time, $lang);

    if ($request->boolean('round_trip')) {
        $this->validateReturnTime($request->date, $request->time, $request->return_date, $request->return_time, $lang);
    }

    // ✅ Get BetweenCity for company_type
    $betweenCity = BetweenCity::find($betweenCityId);
    
    // ✅ PRIORITY: Request > BetweenCity
    $companyType = $request->company_type ?? ($betweenCity ? $betweenCity->company_type : null);

    // ✅ NEW: Get transport_type from company_type
    $transportType = $request->selected_transport_type; // Default from request
    
    if ($companyType) {
        $companyTypes = \App\Http\Controllers\Transport\BetweenCityController::COMPANY_TYPES;
        
        if (isset($companyTypes[$companyType]['transport_type'])) {
            // Only override if not explicitly sent in request
            if (!$request->selected_transport_type) {
                $transportType = $companyTypes[$companyType]['transport_type'];
            }
        }
    }
    
    // ✅ Build travel data with company_type
    $travelData = [
        'from' => $request->from,
        'to' => $request->to,
        'date' => $request->date,
        'amount' => $request->amount,
        'time' => $request->time,
        'passengers' => $request->count,
        'between_city_id' => $betweenCityId,
        'company_type' => $companyType, // ✅ NEW
        'selected_transport_type' => $transportType,
        'round_trip' => $request->boolean('round_trip'),
        'return_date' => $request->return_date,
        'return_time' => $request->return_time,
        'lang' => $lang            
    ];

    // Check if travel already exists
    $existingTravel = $this->travelController->findExistingTravel([
        'from' => $request->from,
        'to' => $request->to,
        'date' => $request->date,
        'time' => $request->time,
        'return_date' => $request->return_date,
        'return_time' => $request->return_time,            
        'user_id' => $request->user_id,
        'client_id' => $request->client_id,
        'amount' => $request->amount,
        'passengers' => $request->count,
        'round_trip' => $request->boolean('round_trip')
    ]);

    // STEP 4: Revalidate existing travel
    if ($existingTravel) {
        $revalidatedTravel = $this->travelController->validateExistingTrip(
            $existingTravel,
            $request->count,
            $request->selected_transport_type,
            $lang
        );

        if ($revalidatedTravel) {
            Log::info("Returning revalidated existing trip {$existingTravel->id}");
            return $revalidatedTravel;
        }

        Log::info("Existing trip {$existingTravel->id} failed revalidation, creating new trip");
    }

    // Create new travel based on type
    if ($request->client_id) {
        return $this->handleClientTravel($request, $travelData, $lang);
    } elseif ($request->user_id) {
        $travelData['user_id'] = $request->user_id;
        return $this->travelController->createAssignedTravel($travelData);
    }

    return null;
}

    /**
     * Handle client travel with payment
     */
private function handleClientTravel(Request $request, array $travelData, $lang)
{
    // Add client and location data
    $travelData['client_id'] = $request->client_id;
    $travelData['user_id'] = $request->user_id;
    $travelData['latitude_from'] = $request->latitude_from;
    $travelData['longitude_from'] = $request->longitude_from;
    $travelData['latitude_to'] = $request->latitude_to;
    $travelData['longitude_to'] = $request->longitude_to;
    $travelData['return_date'] = $request->return_date;
    $travelData['return_time'] = $request->return_time;

    // Process payment and create travel
    $travel = $this->travelController->processClientPaymentAndTravel(
        $travelData,
        $request->client_id,
        $lang  // ✅ PASS LANG PARAMETER
    );

    // ✅ CHECK IF STATION WALLET ALREADY EXISTS
    $existingWallet = \App\Models\StationWallet::where('travel_id', $travel->id)->first();
    
    if (!$existingWallet) {
        // Create station wallet ONLY if not exists
        $this->travelController->createStationWallet($travel->id, $travel->amount);
    }

    return $travel;
}

    /**
     * Update passenger
     */
    public function update(Request $request, $id)
    {
        $lang = $request->get('lang', 'en');

        DB::beginTransaction();
        try {
            $passenger = Passenger::findOrFail($id);
            $passenger->update($request->only(['from', 'to', 'count']));

            // Delete and recreate passenger lists
            PassengerList::where('passenger_id', $id)->delete();
            $this->createPassengerLists($request->passenger_list, $passenger->id);

            DB::commit();

            $message = ($lang == 'ar') 
                ? 'تم تحديث الرحلة بنجاح.' 
                : 'Passenger updated successfully.';

            return response()->json([
                'success' => true,
                'message' => $message,
                'data' => $passenger->load('list')
            ], 200);

        } catch (\Exception $e) {
            DB::rollBack();
            $errorMessage = ($lang == 'ar') 
                ? 'حدث خطأ أثناء تحديث الرحلة.' 
                : 'An error occurred while updating the passenger.';

            return response()->json([
                'success' => false,
                'message' => $errorMessage,
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Delete passenger
     */
    public function delete($id, Request $request)
    {
        $lang = $request->get('lang', 'en');
        $passenger = Passenger::findOrFail($id);
        $passenger->delete();

        $message = ($lang == 'ar') 
            ? 'تم حذف الرحلة بنجاح.' 
            : 'Passenger deleted successfully.';

        return response()->json(['success' => true, 'message' => $message], 200);
    }

    /**
     * Delete single passenger from list
     */
    public function deletePassenger($id, Request $request)
    {
        $lang = $request->get('lang', 'en');
        $passenger = PassengerList::findOrFail($id);
        $passengerId = $passenger->passenger_id;
        
        $passenger->delete();

        // Update passenger count
        $passengerRecord = Passenger::findOrFail($passengerId);
        $passengerRecord->count = max(0, $passengerRecord->count - 1);
        $passengerRecord->save();

        $message = ($lang == 'ar') 
            ? 'تم حذف الراكب من القائمة بنجاح.' 
            : 'Passenger removed from list successfully.';

        return response()->json(['success' => true, 'message' => $message], 200);
    }

    /**
     * Get all passengers for driver
     */
    public function getAll($driver, Request $request)
    {
        $lang = $request->get('lang', 'en');
        $passengers = Passenger::where('user_id', $driver)->with('list')->get();

        $message = ($lang == 'ar') 
            ? 'تم جلب جميع الرحلات.' 
            : 'All passengers fetched successfully.';

        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $passengers
        ], 200);
    }

    /**
     * Get single passenger details
     */
    public function getOne($id, Request $request)
    {
        $lang = $request->get('lang', 'en');
        $passenger = Passenger::with('list')->findOrFail($id);

        $message = ($lang == 'ar') 
            ? 'تم جلب تفاصيل الرحلة بنجاح.' 
            : 'Passenger details fetched successfully.';

        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $passenger
        ], 200);
    }

    /**
     * Show all passengers (web)
     */
    public function showAllPassengers($id = null)
    {
        $passengers = $id 
            ? Passenger::where('user_id', $id)->latest()->get()
            : Passenger::latest()->get();

        return view('/admin/transport/drivers/passengers', compact('passengers'));
    }

/**
 * Show passenger data with details (web)
 */
public function showPassengesrDataWithDetails($id)
{
    $passenger = Passenger::where('id', $id)
        ->with('appUser.vehicle', 'list', 'appUser.company')
        ->first();

    if (!$passenger) {
        abort(404, 'الركاب غير موجودين');
    }

    // ✅ ONLY CHANGE: Pass $isMobilePDF = false
    $isMobilePDF = false;

    return view('/admin/transport/drivers/passengersPDF', compact('passenger', 'isMobilePDF'));
}

/**
 * Download passenger PDF for Mobile App (Direct Download)
 */
/**
 * Download passenger PDF for Mobile App (Direct Download)
 */
public function downloadPassengerPDFMobile($id)
{
    $passenger = Passenger::where('id', $id)
        ->with('appUser.vehicle', 'list', 'appUser.company')
        ->first();

    if (!$passenger) {
        return response()->json(['success' => false, 'message' => 'Passenger not found'], 404);
    }

    try {
        // ✅ MPDF SUBFOLDER KE LIYE DIRECTORY BANAO
        $tempDir = '/var/www/project/storage/app/mpdf_temp/mpdf';
        if (!is_dir($tempDir)) {
            mkdir($tempDir, 0755, true);
        }

        $isMobilePDF = true;
        $pageTitle = 'كشف الركاب_' . $id;

        // ✅ View ko render karo
        $html = view('/admin/transport/drivers/passengersPDF', 
            compact('passenger', 'isMobilePDF', 'pageTitle')
        )->render();

        // ✅ Remove unwanted elements
        $html = preg_replace('/\{\{--.*?--\}\}/s', '', $html);
        $html = preg_replace('/<script\b[^<]*(?:(?!<\/script>)<[^<]*)*<\/script>/is', '', $html);
        $html = str_replace('onload="window.print();"', '', $html);
        $html = preg_replace('/@page\s*\{[^}]*\}/', '', $html);
        $html = preg_replace('/<\?xml[^?]*\?>/i', '', $html);

        $html = str_replace('display: table-cell;', 'display: block;', $html);
        $html = str_replace('display: table;', 'display: block;', $html);

        // ✅ mPDF config WITH TEMP DIR
        $mpdf = new \Mpdf\Mpdf([
            'mode' => 'utf-8',
            'format' => 'A4',
            'default_font' => 'dejavusans',
            'default_font_size' => 10,
            'margin_left' => 10,
            'margin_right' => 10,
            'margin_top' => 10,
            'margin_bottom' => 10,
            'orientation' => 'P',
            'tempDir' => '/var/www/project/storage/app/mpdf_temp', // ✅ PARENT DIRECTORY
        ]);

        $mpdf->SetDirectionality('rtl');
        $mpdf->WriteHTML($html);

        return $mpdf->Output('PassengerId_' . $id . '.pdf', 'D');

    } catch (\Exception $e) {
        Log::error('PDF Generation Error: ' . $e->getMessage());
        return response()->json([
            'success' => false,
            'message' => 'PDF generation failed: ' . $e->getMessage(),
        ], 500);
    }
}

    /**
     * Store new passengers (from admin panel)
     */
    public function storeNewPassengers(Request $request)
    {
        $request->validate([
            'from' => 'required|string',
            'to' => 'required|string',
            'count' => 'required|integer|min:1',
            'user_id' => 'required',
        ]);

        $passenger = Passenger::create([
            'from' => $request->from,
            'to' => $request->to,
            'count' => $request->count,
            'user_id' => $request->user_id,
        ]);

        if ($request->has('passenger_list')) {
            $this->createPassengerLists($request->passenger_list, $passenger->id);
        }

        return redirect()->route('showAllPassengers')
            ->with('success', 'تم إصدار كشف الركاب بنجاح');
    }


    /**
     * Upgrade passenger to driver
     */
    public function upgradeToDriver(Request $request)
    {
        $lang = $request->lang ?? 'en';

        $messages = [
            'en' => [
                'upgrade_successful' => 'Upgraded to Driver successfully.',
                'upgrade_failed' => 'Upgrade failed.',
                'already_driver' => 'You are already registered as Driver.',
                'user_not_found' => 'User not found.',
            ],
            'ar' => [
                'upgrade_successful' => 'تم الترقية إلى سائق بنجاح.',
                'upgrade_failed' => 'فشلت الترقية.',
                'already_driver' => 'أنت مسجل بالفعل كسائق.',
                'user_not_found' => 'لم يتم العثور على المستخدم.',
            ],
            'ur' => [
                'upgrade_successful' => 'ڈرائیور میں کامیابی سے اپ گریڈ ہو گئے۔',
                'upgrade_failed' => 'اپ گریڈ ناکام ہو گیا۔',
                'already_driver' => 'آپ پہلے سے ڈرائیور کے طور پر رجسٹرڈ ہیں۔',
                'user_not_found' => 'صارف نہیں ملا۔',
            ],
        ];

        // Validation
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:app_users,id',
            'id_number' => 'required|string|unique:app_users,id_number,' . $request->user_id . ',id',
            'id_image' => 'required|image|max:5120',
            'driver_image' => 'required|image|max:5120',
            'license_image' => 'required|image|max:5120',
            'car_type' => 'required|string',
            'number_of_passengers' => 'required|integer|min:1',
            'car_model' => 'required|string',
            'car_color' => 'required|string',
            'licence_plate_number' => 'required|string',
            'car_image' => 'required|image|max:5120',
            'company_name' => 'required|string',
            'company_location' => 'required|string',
            'company_registration_number' => 'required|string',
            'company_type' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $messages[$lang]['upgrade_failed'] ?? $messages['en']['upgrade_failed'],
                'errors' => $validator->errors(),
            ], 422);
        }

        // Find user
        $user = AppUser::find($request->user_id);

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => $messages[$lang]['user_not_found'] ?? $messages['en']['user_not_found'],
            ], 404);
        }

        // Check if already driver
        if ($user->user_type == 'Driver') {
            return response()->json([
                'success' => false,
                'message' => $messages[$lang]['already_driver'] ?? $messages['en']['already_driver'],
            ], 400);
        }

        DB::beginTransaction();

        try {
            $destinationPath = public_path('storage/drivers/');

            // Upload images
            $idFileName = time() . '_id_' . $request->file('id_image')->getClientOriginalName();
            $request->file('id_image')->move($destinationPath . 'ids', $idFileName);
            $idImagePath = 'drivers/ids/' . $idFileName;

            $driverFileName = time() . '_driver_' . $request->file('driver_image')->getClientOriginalName();
            $request->file('driver_image')->move($destinationPath . 'driver', $driverFileName);
            $driverImagePath = 'drivers/driver/' . $driverFileName;

            $licenseFileName = time() . '_license_' . $request->file('license_image')->getClientOriginalName();
            $request->file('license_image')->move($destinationPath . 'licenses', $licenseFileName);
            $licenseImagePath = 'drivers/licenses/' . $licenseFileName;

            $carFileName = time() . '_car_' . $request->file('car_image')->getClientOriginalName();
            $request->file('car_image')->move(public_path('storage/vehicles/images'), $carFileName);
            $carImagePath = 'vehicles/images/' . $carFileName;

            // Update user to Driver
            $user->update([
                'user_type' => 'Driver',
                'id_number' => $request->id_number,
                'id_image' => $idImagePath,
                'license_image_url' => $licenseImagePath,
                'driver_image' => $driverImagePath,
                'status' => null,
            ]);

            // Create vehicle
            $vehicle = Vehicle::create([
                'user_id' => $user->id,
                'car_type' => $request->car_type,
                'number_of_passengers' => $request->number_of_passengers,
                'car_model' => $request->car_model,
                'car_color' => $request->car_color,
                'licence_plate_number' => $request->licence_plate_number,
                'car_image' => $carImagePath,
            ]);

            // Create company
            $company = Company::create([
                'user_id' => $user->id,
                'company_name' => $request->company_name,
                'company_location' => $request->company_location,
                'company_registration_number' => $request->company_registration_number,
                'company_type' => $request->company_type,
            ]);

            // Send SMS
            $smsMessages = [
                'en' => "Your upgrade request to Driver (ID: {$user->id_number}) has been received.\nWe will get back to you soon.",
                'ar' => "تم استلام طلب الترقية إلى سائق (رقم: {$user->id_number}).\nسيتم الرد عليك قريباً.",
                'ur' => "آپ کی ڈرائیور اپ گریڈ درخواست (شناخت: {$user->id_number}) موصول ہو گئی ہے۔\nہم جلد ہی آپ سے رابطہ کریں گے۔",
            ];

            try {
                Http::withHeaders([
                    'Authorization' => 'Bearer ' . config('services.taqnyat.bearer_token'),
                    'Content-Type' => 'application/json',
                ])->post(config('services.taqnyat.url'), [
                    'sender' => config('services.taqnyat.sender'),
                    'recipients' => [$user->mobile],
                    'body' => $smsMessages[$lang] ?? $smsMessages['ar'],
                ]);
            } catch (\Exception $e) {
                Log::error('SMS Error: ' . $e->getMessage());
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => $messages[$lang]['upgrade_successful'] ?? $messages['en']['upgrade_successful'],
                'data' => [
                    'user' => $user->fresh(['company', 'vehicle']),
                    'vehicle' => $vehicle,
                    'company' => $company,
                ],
            ], 200);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Upgrade Error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => $messages[$lang]['upgrade_failed'] ?? $messages['en']['upgrade_failed'],
                'error' => config('app.debug') ? $e->getMessage() : null,
            ], 500);
        }
    }


/**
 * Validate booking time - Minimum 3 hours advance
 */
    private function validateBookingTime($selectedDate, $selectedTime, $lang = 'en')
    {
        $messages = [
            'ar' => [
                'minimum' => 'يجب أن يكون الحجز قبل 3 ساعات على الأقل من الآن',
                'past' => 'لا يمكن الحجز في وقت مضى'
            ],
            'en' => [
                'minimum' => 'Booking must be at least 3 hours in advance',
                'past' => 'Cannot book in the past'
            ],
            'ur' => [
                'minimum' => 'بکنگ کم از کم 3 گھنٹے پہلے ہونی چاہیے',
                'past' => 'ماضی میں بک نہیں کیا جا سکتا'
            ]
        ];

        $now = $this->getSaudiTime();
        $selectedDateTime = \Carbon\Carbon::parse($selectedDate . ' ' . $selectedTime, 'Asia/Riyadh');
        
        // Past time check
        if ($selectedDateTime <= $now) {
            throw new \Exception($messages[$lang]['past'] ?? $messages['en']['past']);
        }
        
        // Minimum 3 hours check
        $hoursDiff = $now->diffInHours($selectedDateTime, false);
        
        if ($hoursDiff < 3) {
            throw new \Exception($messages[$lang]['minimum'] ?? $messages['en']['minimum']);
        }
    }    

/**
 * Validate return time - should be after departure
 */
private function validateReturnTime($departureDate, $departureTime, $returnDate, $returnTime, $lang = 'en')
{
    $messages = [
        'ar' => [
            'return_after_departure' => 'يجب أن يكون وقت العودة بعد وقت المغادرة',
            'return_past' => 'لا يمكن أن يكون وقت العودة في الماضي',
            'return_required' => 'تاريخ ووقت العودة مطلوب للرحلات ذهابا وإيابا'
        ],
        'en' => [
            'return_after_departure' => 'Return time must be after departure time',
            'return_past' => 'Return time cannot be in the past',
            'return_required' => 'Return date and time are required for round trips'
        ],
        'ur' => [
            'return_after_departure' => 'واپسی کا وقت روانگی کے وقت کے بعد ہونا چاہیے',
            'return_past' => 'واپسی کا وقت ماضی میں نہیں ہو سکتا',
            'return_required' => 'راؤنڈ ٹرپ کے لیے واپسی کی تاریخ اور وقت درکار ہیں'
        ]
    ];

    // Check if return date/time provided
    if (!$returnDate || !$returnTime) {
        throw new \Exception($messages[$lang]['return_required'] ?? $messages['en']['return_required']);
    }

    $now = $this->getSaudiTime();
    $departureDateTime = \Carbon\Carbon::parse($departureDate . ' ' . $departureTime, 'Asia/Riyadh');
    $returnDateTime = \Carbon\Carbon::parse($returnDate . ' ' . $returnTime, 'Asia/Riyadh');
    
    // Return time past check
    if ($returnDateTime <= $now) {
        throw new \Exception($messages[$lang]['return_past'] ?? $messages['en']['return_past']);
    }
    
    // Return after departure check
    if ($returnDateTime <= $departureDateTime) {
        throw new \Exception($messages[$lang]['return_after_departure'] ?? $messages['en']['return_after_departure']);
    }
}


/**
 *  Validate driver vehicle matches trip requirements
 */
// private function validateDriverVehicle($driverId, $passengers, $transportType, $lang = 'ar')
// {
//     $vehicle = \App\Models\Vehicle::where('user_id', $driverId)->first();
    
//     if (!$vehicle) {
//         $messages = [
//             'ar' => 'لم يتم العثور على سيارة للسائق.',
//             'en' => 'No vehicle found for driver.',
//             'ur' => 'ڈرائیور کے لیے گاڑی نہیں ملی۔'
//         ];
//         throw new \Exception($messages[$lang] ?? $messages['ar']);
//     }
    
//     // ✅ Type mapping (English → Arabic)
//     $typeMapping = [
//         'limousine' => 'ليموزين',
//         'private_car' => 'سيارة خاصة',
//         'bus' => 'حافلة',
//         'van' => 'فان',
//         'taxi' => 'تاكسي',
//         'minibus' => 'ميني باص'
//     ];
    
//     $arabicType = $typeMapping[strtolower($transportType)] ?? $transportType;
    
//     // Check type match (supports both English and Arabic)
//     $typeMatches = ($vehicle->car_type === $transportType) || 
//                    ($vehicle->car_type === $arabicType);
    
//     if (!$typeMatches) {
//         $messages = [
//             'ar' => 'نوع سيارة السائق (' . $vehicle->car_type . ') لا يطابق نوع الرحلة المطلوب (' . $arabicType . '). لا يمكن إنشاء الرحلة.',
//             'en' => 'Driver vehicle type (' . $vehicle->car_type . ') does not match required trip type (' . $transportType . '). Cannot create trip.',
//             'ur' => 'ڈرائیور گاڑی کی قسم (' . $vehicle->car_type . ') مطلوبہ سفر کی قسم (' . $arabicType . ') سے میل نہیں کھاتی۔ سفر نہیں بنایا جا سکتا۔'
//         ];
//         throw new \Exception($messages[$lang] ?? $messages['ar']);
//     }
    
//     // Check capacity (string to int conversion)
//     $vehicleCapacity = (int) $vehicle->number_of_passengers;
//     $requiredPassengers = (int) $passengers;
    
//     if ($vehicleCapacity < $requiredPassengers) {
//         $messages = [
//             'ar' => 'سعة سيارة السائق (' . $vehicleCapacity . ' مقاعد) غير كافية للرحلة (' . $requiredPassengers . ' ركاب مطلوبين). لا يمكن إنشاء الرحلة.',
//             'en' => 'Driver vehicle capacity (' . $vehicleCapacity . ' seats) is insufficient for this trip (' . $requiredPassengers . ' passengers required). Cannot create trip.',
//             'ur' => 'ڈرائیور گاڑی کی گنجائش (' . $vehicleCapacity . ' سیٹیں) اس سفر کے لیے ناکافی ہے (' . $requiredPassengers . ' مسافر درکار)۔ سفر نہیں بنایا جا سکتا۔'
//         ];
//         throw new \Exception($messages[$lang] ?? $messages['ar']);
//     }
    
//     return true;
// }

}