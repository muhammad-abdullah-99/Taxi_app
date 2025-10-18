<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFormRequest;
use App\Models\AppUser;
use App\Models\Company;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class DriverController extends Controller
{
    public function index()
    {
        $drivers = AppUser::all();
        return $drivers;
    }


    public function store(StoreFormRequest $request)
    {
        $driver = AppUser::where('mobile', $request->mobile)->where('user_type', 'Driver')->where('name', 'guest')->first();

        if ($driver):
            $driver->update([
                'mobile' => 'guest',
                'id_number' => 'guest'
            ]);
        endif;

        $lang = $request->lang ?? 'en';

        $messages = [
        'en' => [
            'registration_successful' => 'Driver registration successful.',
            'registration_failed' => 'Registration failed.',
            'mobile_exists_driver' => 'This mobile number is already registered as Driver.',
            'mobile_exists_passenger' => 'This mobile number is already registered as Passenger. Cannot create Driver account with same number.',
        ],
        'ar' => [
            'registration_successful' => 'تم تسجيل السائق بنجاح.',
            'registration_failed' => 'فشل التسجيل.',
            'mobile_exists_driver' => 'رقم الجوال هذا مسجل بالفعل كسائق.',
            'mobile_exists_passenger' => 'رقم الجوال هذا مسجل بالفعل كراكب. لا يمكن إنشاء حساب سائق بنفس الرقم.',
        ],
        'ur' => [
            'registration_successful' => 'ڈرائیور کا اندراج کامیابی سے مکمل ہو گیا ہے۔',
            'registration_failed' => 'اندراج ناکام ہو گیا۔',
            'mobile_exists_driver' => 'یہ موبائل نمبر پہلے سے ڈرائیور کے طور پر رجسٹرڈ ہے۔',
            'mobile_exists_passenger' => 'یہ موبائل نمبر پہلے سے مسافر کے طور پر رجسٹرڈ ہے۔ اسی نمبر سے ڈرائیور اکاؤنٹ نہیں بنایا جا سکتا۔',
        ],
    ];

    // Check if mobile exists as any user type (excluding guest)
    $existingUser = AppUser::where('mobile', $request->mobile)
        ->where('name', '!=', 'guest')
        ->first();

    if ($existingUser) {
        $errorMessage = $existingUser->user_type == 'Driver' ? 
            $messages[$lang]['mobile_exists_driver'] : 
            $messages[$lang]['mobile_exists_passenger'];
        
        return response()->json([
            'success' => false,
            'message' => $errorMessage,
            'user_type' => $existingUser->user_type,
        ], 400);
    }

        DB::beginTransaction();

        try {
            $destinationPath = public_path('storage/drivers/');

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

            $user = AppUser::create([
                'name' => $request->name,
                'mobile' => $request->mobile,
                'id_number' => $request->id_number,
                'user_type' => 'Driver',
                'id_image' => $idImagePath,
                'license_image_url' => $licenseImagePath,
                'driver_image' => $driverImagePath,
            ]);

            $vehicle = Vehicle::create([
                'user_id' => $user->id,
                'car_type' => $request->car_type,
                'number_of_passengers' => $request->number_of_passengers,
                'car_model' => $request->car_model,
                'car_color' => $request->car_color,
                'licence_plate_number' => $request->licence_plate_number,
                'car_image' => $carImagePath,
            ]);

            $company = Company::create([
                'user_id' => $user->id,
                'company_name' => $request->company_name,
                'company_location' => $request->company_location,
                'company_registration_number' => $request->company_registration_number,
                'company_type' => $request->company_type,
            ]);

            $smsMessages = [
                'en' => "Your registration request number ({$user->id_number}) has been successfully received.\nWe will get back to you as soon as possible.\n\nROSE - Bus Guidance App\nContact WhatsApp: 0551796056",

                'ar' => "تم استلام طلب التسجيل رقم ({$user->id_number}) بنجاح.\nوسيتم الرد عليك في أقرب وقت ممكن.\n\nتطبيق روز لتوجيه الحافلات\nللتواصل واتساب: 0551796056",

                'ur' => "آپ کی رجسٹریشن درخواست نمبر ({$user->id_number}) کامیابی سے موصول ہو گئی ہے۔\nہم جلد از جلد آپ سے رابطہ کریں گے۔\n\nروز بس رہنمائی ایپ\nرابطہ کریں واٹس ایپ: 0551796056",
            ];


            try {
                $response = Http::withHeaders([
                    'Authorization' => 'Bearer ' . config('services.taqnyat.bearer_token'),
                    'Content-Type' => 'application/json',
                ])->post(config('services.taqnyat.url'), [
                    'sender' => config('services.taqnyat.sender'),
                    'recipients' => [$user->mobile],
                    'body' => $smsMessages[$lang] ?? $smsMessages['ar'],
                ]);


                if (!$response->successful()) {
                    Log::error('Taqnyat SMS Failed', ['response' => $response->body()]);
                }
            } catch (\Exception $e) {
                Log::error('SMS Send Error', [
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString(),
                ]);
            }
            DB::commit();


            return response()->json([
                'success' => true,
                'message' => $messages[$lang]['registration_successful'],
                'data' => [
                    'driver' => $user,
                    'driver_image' => $user->driver_image,
                    'vehicle' => $vehicle,
                    'company' => $company,
                ],
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Registration Error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => $messages[$lang]['registration_failed'],
                'error' => config('app.debug') ? $e->getMessage() : null,
            ], 500);
        }
    }
}
