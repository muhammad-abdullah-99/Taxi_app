<?php

namespace App\Http\Controllers;

use App\Models\AppUser;
use App\Models\Company;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class AuthAppController extends Controller
{
    private function getLanguage($request)
    {
    // Priority: Accept-Language header > lang parameter > default English
    $lang = $request->header('Accept-Language', $request->input('lang', 'en'));
    
    // ✅ Support for Urdu language codes
    if (in_array($lang, ['ur', 'ur-PK', 'urdu', 'urd'])) {
        return 'ur';
    }
    
    return in_array($lang, ['en', 'ar']) ? $lang : 'en';
    }

private function getAppMessages($lang)
{
    return [
        'en' => [
            // ... existing English messages ...
            'invalid_input' => 'Invalid input.',
            'user_not_found' => 'User not found.',
            'driver_not_found' => 'Driver not found.',
            'passenger_not_found' => 'Passenger not found.',
            'wrong_account_type' => 'This mobile number is registered as {type}. Please use the correct number.',
            'account_pending' => 'Please wait until your account is approved.',
            'otp_sent' => 'OTP sent to your mobile number.',
            'invalid_otp' => 'Invalid or expired OTP.',
            'login_success' => 'Login successful.',
            'logout_success' => 'Logout successful.',
            'mobile_exists' => 'This mobile number is already registered as {type}. Please login or use a different number.',
            'account_created' => 'Account created successfully.',
            'delete_success' => 'Account deleted successfully.',
            'delete_error' => 'An error occurred while deleting the account.',
            'unauthorized_access' => 'Unauthorized access.',
            
            // Additional messages
            'otp_expired' => 'Verification code has expired. Please request a new one.',
            'otp_resent' => 'Verification code has been resent successfully.',
            'otp_send_failed' => 'Failed to send verification code. Please try again.',
            'profile_not_found' => 'Profile information not found.',
            'server_error' => 'Something went wrong. Please try again later.',
        ],
        'ar' => [
            // ... existing Arabic messages ...
            'invalid_input' => 'إدخال غير صالح.',
            'user_not_found' => 'لم يتم العثور على مستخدم.',
            'driver_not_found' => 'لم يتم العثور على سائق.',
            'passenger_not_found' => 'لم يتم العثور على راكب.',
            'wrong_account_type' => 'رقم الجوال هذا مسجل كـ {type}. يرجى استخدام الرقم الصحيح.',
            'account_pending' => 'يرجى الانتظار حتى تتم الموافقة على حسابك.',
            'otp_sent' => 'تم إرسال رمز OTP إلى رقم جوالك.',
            'invalid_otp' => 'رمز OTP غير صالح أو منتهي الصلاحية.',
            'login_success' => 'تم تسجيل الدخول بنجاح.',
            'logout_success' => 'تم تسجيل الخروج بنجاح.',
            'mobile_exists' => 'رقم الجوال هذا مسجل بالفعل كـ {type}. يرجى تسجيل الدخول أو استخدام رقم آخر.',
            'account_created' => 'تم إنشاء الحساب بنجاح.',
            'delete_success' => 'تم حذف الحساب بنجاح.',
            'delete_error' => 'حدث خطأ أثناء حذف الحساب.',
            'unauthorized_access' => 'وصول غير مصرح به.',
            
            // Additional messages
            'otp_expired' => 'انتهت صلاحية رمز التحقق. يرجى طلب رمز جديد.',
            'otp_resent' => 'تم إعادة إرسال رمز التحقق بنجاح.',
            'otp_send_failed' => 'فشل إرسال رمز التحقق. يرجى المحاولة مرة أخرى.',
            'profile_not_found' => 'لم يتم العثور على معلومات الملف الشخصي.',
            'server_error' => 'حدث خطأ ما. يرجى المحاولة لاحقاً.',
        ],
        'ur' => [ // ✅ YAHAN URDU MESSAGES ADD KAREIN
            'invalid_input' => 'غلط ان پٹ۔',
            'user_not_found' => 'صارف نہیں ملا۔',
            'driver_not_found' => 'ڈرائیور نہیں ملا۔',
            'passenger_not_found' => 'مسافر نہیں ملا۔',
            'wrong_account_type' => 'یہ موبائل نمبر {type} کے طور پر رجسٹرڈ ہے۔ براہ کرم صحیح نمبر استعمال کریں۔',
            'account_pending' => 'براہ کرم انتظار کریں جب تک آپ کے اکاؤنٹ کی منظوری نہ ہو جائے۔',
            'otp_sent' => 'OTP آپ کے موبائل نمبر پر بھیج دیا گیا ہے۔',
            'invalid_otp' => 'غلط یا میعاد ختم ہونے والا OTP۔',
            'login_success' => 'لاگ ان کامیاب۔',
            'logout_success' => 'لاگ آؤٹ کامیاب۔',
            'mobile_exists' => 'یہ موبائل نمبر پہلے ہی {type} کے طور پر رجسٹرڈ ہے۔ براہ کرم لاگ ان کریں یا کوئی دوسرا نمبر استعمال کریں۔',
            'account_created' => 'اکاؤنٹ کامیابی سے بن گیا۔',
            'delete_success' => 'اکاؤنٹ کامیابی سے حذف ہو گیا۔',
            'delete_error' => 'اکاؤنٹ کو حذف کرنے میں ایک خرابی پیش آئی۔',
            'unauthorized_access' => 'غیر مجاز رسائی۔',
            
            // Additional messages
            'otp_expired' => 'تصدیقی کوڈ کی میعاد ختم ہو گئی ہے۔ براہ کرم نیا کوڈ طلب کریں۔',
            'otp_resent' => 'تصدیقی کوڈ دوبارہ کامیابی سے بھیج دیا گیا ہے۔',
            'otp_send_failed' => 'تصدیقی کوڈ بھیجنے میں ناکامی۔ براہ کرم دوبارہ کوشش کریں۔',
            'profile_not_found' => 'پروفائل کی معلومات نہیں ملیں۔',
            'server_error' => 'کچھ غلط ہو گیا۔ براہ کرم بعد میں دوبارہ کوشش کریں۔',
        ]
    ][$lang] ?? [];
}


public function login(Request $request)
{
    $lang = $this->getLanguage($request);
    $messages = $this->getAppMessages($lang);

    $validator = Validator::make($request->all(), [
        'mobile' => 'required|string',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'success' => false,
            'message' => $messages['invalid_input'],
            'errors' => $validator->errors(),
        ], 422);
    }

    // ✅ Pehle check karo user exist karta hai
    $anyUser = AppUser::where('mobile', $request->mobile)
        ->where('name', '!=', 'guest')
        ->first();

    // ✅ SPECIAL RULE: Agar Passenger hai aur Driver app se login kar raha hai - BLOCK
    if ($anyUser && $anyUser->user_type == 'Passenger' && $request->has('user_type') && $request->user_type == 'Driver') {
       $accountType = $lang == 'ar' ? 'راكب' : 
                     ($lang == 'ur' ? 'مسافر' : 'Passenger');
        $errorMessage = str_replace('{type}', $accountType, $messages['wrong_account_type']);
        
        return response()->json([
            'success' => false,
            'message' => $errorMessage,
            'registered_as' => $anyUser->user_type,
        ], 403);
    }

    // ✅ User dhundho - Driver ho ya Passenger, dono Passenger app use kar sakte hain
    $user = AppUser::where('mobile', $request->mobile)
        ->where('name', '!=', 'guest')
        ->with(['company', 'vehicle'])
        ->select('*') // ✅ Ensure address field is included
        ->first();

    // ✅ Agar user nahi mila toh guest try karo
    if (!$user) {
        $user = AppUser::where('name', 'guest')->first();
    }

    // ✅ Agar ab bhi user nahi mila
    if (!$user) {
        $errorMessage = $messages['user_not_found'];
        
        if ($request->has('user_type')) {
            $errorMessage = $request->user_type == 'Driver' ? 
                $messages['driver_not_found'] : 
                $messages['passenger_not_found'];
        }
        
        return response()->json([
            'success' => false,
            'message' => $errorMessage,
        ], 404);
    }
    
    // ✅ Status check - SIRF Driver app ke liye
    // Agar Driver hai aur Driver app se login kar raha hai aur status null/0 hai
    if ($user->user_type == 'Driver' && $request->has('user_type') && $request->user_type == 'Driver' && !$user->status) {
        return response()->json([
            'success' => true,
            'user' => $user,
            'message' => $messages['account_pending'],
        ], 200);
    }

    // ✅ OTP generation - ONLY for real users (not guest)
    if ($user->name !== 'guest') {
        $otp = mt_rand(1000, 9999);

        // Test numbers ke liye fixed OTP
        if ($request->mobile == '0512345678') {
            $otp = 1111;
        }
        if ($request->mobile == '0560637609') {
            $otp = 1111;
        }

        $user->otp = $otp;
        $user->mobile = $request->mobile;
        $user->otp_expires_at = now()->addMinutes(10);
        
        if ($request->mobile == '923228937188') {
            $user->otp_expires_at = now()->addMinutes(10000);
        }
        
        $user->save();

        // ✅ SMS Sending
        $signature = 'AwHvLfJC9I9';
        $body = "<#> Your OTP code is: $otp. Valid for 10 minutes.\n$signature";
        
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . config('services.taqnyat.bearer_token'),
                'Content-Type' => 'application/json',
            ])->post(config('services.taqnyat.url'), [
                'sender' => config('services.taqnyat.sender'),
                'recipients' => [$user->mobile],
                'body' => $body,
            ]);
            
            if (!$response->successful()) {
                Log::error('Taqnyat SMS Failed', ['response' => $response->body()]);
            }
        } catch (\Exception $e) {
            Log::info('Taqnyat URL', ['url' => config('services.taqnyat.url')]);
            Log::error('SMS Send Error', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
        }

        return response()->json([
            'success' => true,
            'user' => $user,
            'otp' => $otp,
            'message' => $messages['otp_sent'],
        ], 200);
    } else {
        // Guest user - registration scenario
        return response()->json([
            'success' => true,
            'user' => $user,
            'message' => $messages['user_not_found'],
        ], 200);
    }
}

public function verifyOtp(Request $request)
{
    $lang = $this->getLanguage($request);
    $messages = $this->getAppMessages($lang);

    $validator = Validator::make($request->all(), [
        'mobile' => 'required|string',
        'otp' => 'required|string|digits:4',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'success' => false,
            'message' => $messages['invalid_input'],
            'errors' => $validator->errors(),
        ], 422);
    }

    try {
        $user = AppUser::where('mobile', $request->mobile)
            ->where('name', '!=', 'guest')
            ->first();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => $messages['invalid_otp'],
            ], 400);
        }

        if ($user->user_type == 'Driver' && $request->has('user_type') && $request->user_type == 'Driver') {
            if ($user->status == 0 || $user->status === null) {
                return response()->json([
                    'success' => false,
                    'message' => $messages['account_pending'],
                ], 400);
            }
        }

        // ✅ NEW: Check if OTP expired
        if ($user->otp_expires_at && now()->gt($user->otp_expires_at)) {
            return response()->json([
                'success' => false,
                'message' => $messages['otp_expired'],
            ], 400);
        }

        if ($user->otp !== $request->otp) {
            return response()->json([
                'success' => false,
                'message' => $messages['invalid_otp'],
            ], 400);
        }

        // Clear OTP after successful verification
        if ($request->mobile == '0512345678') {
            $user->otp = 1111;
        } elseif ($request->mobile == '0560637609') {
            $user->otp = 1111;
        } else {
            $user->otp = null;
        }
        $user->otp_expires_at = null;
        $user->save();

        $token = auth()->guard('api')->login($user);

        return $this->createNewToken($token);

    } catch (\Exception $e) {
        Log::error('OTP Verification Error', [
            'mobile' => $request->mobile,
            'error' => $e->getMessage(),
        ]);

        return response()->json([
            'success' => false,
            'message' => $messages['server_error'],
        ], 500);
    }
}

    public function createNewToken($token)
    {
        return response()->json([
            'driver' => auth()->guard('api')->user(),
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->guard('api')->factory()->getTTL() * 60000,
        ]);
    }

function resendOTP(Request $request)
{
    $lang = $this->getLanguage($request);
    $messages = $this->getAppMessages($lang);

    try {
        $user = AppUser::where('mobile', $request->mobile)
            ->where('name', '!=', 'guest')
            ->first();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => $messages['user_not_found'],
            ], 404);
        }

        $otp = mt_rand(1000, 9999);
        $user->otp = $otp;
        $user->mobile = $request->mobile;
        $user->otp_expires_at = now()->addMinutes(10);
        $user->save();

        $signature = 'AwHvLfJC9I9';
        $body = "<#> Your OTP code is: $otp. Valid for 10 minutes.\n$signature";
        
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . config('services.taqnyat.bearer_token'),
                'Content-Type' => 'application/json',
            ])->post(config('services.taqnyat.url'), [
                'sender' => config('services.taqnyat.sender'),
                'recipients' => [$user->mobile],
                'body'=> $body,
            ]);
            
            if (!$response->successful()) {
                Log::error('Taqnyat SMS Failed', ['response' => $response->body()]);
                
                // ✅ NEW: Return error if SMS fails
                return response()->json([
                    'success' => false,
                    'message' => $messages['otp_send_failed'],
                ], 500);
            }
        } catch (\Exception $e) {
            Log::error('SMS Send Error', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            
            // ✅ NEW: Return error if SMS fails
            return response()->json([
                'success' => false,
                'message' => $messages['otp_send_failed'],
            ], 500);
        }
        
        return response()->json([
            'success' => true,
            'user' => $user,
            'otp' => $otp,
            'message' => $messages['otp_resent'], // ✅ CHANGED: otp_resent instead of otp_sent
        ], 200);

    } catch (\Exception $e) {
        Log::error('Resend OTP Error', [
            'mobile' => $request->mobile,
            'error' => $e->getMessage(),
        ]);

        return response()->json([
            'success' => false,
            'message' => $messages['server_error'],
        ], 500);
    }
}

    public function logout(request $request)
    {
        $lang = $this->getLanguage($request);
        $messages = $this->getAppMessages($lang);

        auth()->logout();
        return response()->json([
            'message' => $messages['logout_success'],
        ], 201);
    }

    // delete account 
public function deleteAccount(Request $request)
{
    $lang = $this->getLanguage($request);
    $messages = $this->getAppMessages($lang);

    try {
        $user = $request->user();
        
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => $messages['unauthorized_access'],
            ], 401);
        }

        DB::beginTransaction();
        
        try {
            $vehicle = Vehicle::where('user_id', $user->id)->first();
            if ($vehicle) {
                $vehicle->delete();
            }
            
            $company = Company::where('user_id', $user->id)->first();
            if ($company) {
                $company->delete();
            }
            
            $user->tokens()->delete();
            $user->delete();
            
            DB::commit();
            
            return response()->json([
                'success' => true,
                'message' => $messages['delete_success'],
            ], 200);
            
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

    } catch (\Exception $e) {
        Log::error('Account Deletion Error', [
            'user_id' => $request->user()->id ?? 'unknown',
            'error' => $e->getMessage(),
        ]);

        return response()->json([
            'success' => false,
            'message' => $messages['delete_error'],
        ], 500);
    }
}

    public function profile($id)
    {
        $driver = AppUser::where('id', $id)
        ->with(['company', 'vehicle'])
        ->select('*') // ✅ Simple change
        ->first();
        
        return response()->json([
            'driver' => $driver,
            'message' => 'المعلومات الشخصية',
        ], 200);
    }

public function creatNewUser(request $request)
{
    $lang = $this->getLanguage($request);
    $messages = $this->getAppMessages($lang);

    try {
        // Check if mobile already exists (excluding guest)
        $existingUser = AppUser::where('mobile', $request->mobile)
            ->where('name', '!=', 'guest')
            ->first();

        if ($existingUser) {
            $userType = $existingUser->user_type == 'Driver' ? 
                ($lang == 'ar' ? 'سائق' : 
                 ($lang == 'ur' ? 'ڈرائیور' : 'Driver')) : // ✅ URDU ADDED
                ($lang == 'ar' ? 'راكب' : 
                 ($lang == 'ur' ? 'مسافر' : 'Passenger')); // ✅ URDU ADDED
            
            return response()->json([
                'success' => false,
                'message' => str_replace('{type}', $userType, $messages['mobile_exists']),
            ], 400);
        }

        $existingGuest = AppUser::where('mobile', $request->mobile)
            ->where('name', 'guest')
            ->first();

        if ($existingGuest) {
            $existingGuest->update([
                'mobile' => 'guest',
            ]);
        }

        $user = AppUser::create([
            'name' => $request->name,
            'mobile' => $request->mobile,
            'address' => $request->address,
            'user_type' => 'Passenger',
            'status' => 1,
        ]);

        // Generate authentication token
        $token = auth()->guard('api')->login($user);

        return response()->json([
            'success' => true,
            'message' => $messages['account_created'],
            'user' => auth()->guard('api')->user(),
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->guard('api')->factory()->getTTL() * 60000,
        ]);

    } catch (\Exception $e) {
        Log::error('Passenger Registration Error', [
            'mobile' => $request->mobile,
            'error' => $e->getMessage(),
        ]);

        return response()->json([
            'success' => false,
            'message' => $messages['server_error'],
        ], 500);
    }
}

    public function createNewUserToken($token)
    {
        return response()->json([
            'message' => 'success',
            'user' => auth()->guard('api')->user(),
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->guard('api')->factory()->getTTL() * 60000,
        ]);
    }

    //users
    public function users()
    {
        $users = AppUser::where('user_type', 'Passenger')->get();
        return view('admin.transport.user.users', compact('users'));
    }

    public function updateUserTabStatus($id)
    {
        $user = AppUser::find($id);

        if ($user) {
            $user->user_type = 'Driver';
            $user->status = null;
            $user->save();

            toastr()->success('تمت بنجاح');
            return back();
        } else {
            toastr()->error('فضل');
            return back();
        }
    }

    ////////////////////////

    public function deleteUser($id)
    {
        return response()->json([
            'success' => false,
            'message' => 'User deletion temporarily disabled for investigation',
            'error' => 'DELETION_BLOCKED'
        ], 403);
    }

    // New Methods For API Routes
    public function passengerLogin(Request $request)
    {
        $request->merge(['user_type' => 'Passenger']);
        return $this->login($request);
    }

    public function passengerVerifyOtp(Request $request)
    {
        $request->merge(['user_type' => 'Passenger']);
        return $this->verifyOtp($request);
    }

    public function passengerLogout(Request $request)
    {
        return $this->logout($request);
    }

    public function passengerResendOTP(Request $request)
    {
        return $this->resendOTP($request);
    }

    public function passengerDeleteAccount(Request $request)
    {
        return $this->deleteAccount($request);
    }

public function passengerProfile($id)
{
    $lang = request()->header('Accept-Language', 'en');
    $messages = $this->getAppMessages($lang);

    try {
        $passenger = AppUser::where('id', $id)
            ->select('*') // ✅ Simple change - address automatically included
            ->first();
            
        if (!$passenger) {
            return response()->json([
                'success' => false,
                'message' => $messages['profile_not_found'],
            ], 404);
        }
            
        return response()->json([
            'success' => true,
            'passenger' => $passenger,
            'message' => 'Passenger profile information',
        ], 200);

    } catch (\Exception $e) {
        Log::error('Get Passenger Profile Error', [
            'id' => $id,
            'error' => $e->getMessage(),
        ]);

        return response()->json([
            'success' => false,
            'message' => $messages['server_error'],
        ], 500);
    }
}

    // Driver specific methods
    public function driverLogin(Request $request)
    {
        $request->merge(['user_type' => 'Driver']);
        return $this->login($request);
    }

    public function driverVerifyOtp(Request $request)
    {
        $request->merge(['user_type' => 'Driver']);
        return $this->verifyOtp($request);
    }

    public function driverLogout(Request $request)
    {
        return $this->logout($request);
    }

    public function driverResendOTP(Request $request)
    {
        return $this->resendOTP($request);
    }

    public function driverDeleteAccount(Request $request)
    {
        return $this->deleteAccount($request);
    }

public function driverProfile($id)
{
    $lang = request()->header('Accept-Language', 'en');
    $messages = $this->getAppMessages($lang);

    try {
        $driver = AppUser::where('id', $id)
            ->where('user_type', 'Driver')
            ->with(['company', 'vehicle'])
            ->select('*') // ✅ Simple change - address automatically included
            ->first();
            
        if (!$driver) {
            return response()->json([
                'success' => false,
                'message' => $messages['profile_not_found'],
            ], 404);
        }
            
        return response()->json([
            'success' => true,
            'driver' => $driver,
            'message' => 'Driver profile information',
        ], 200);

    } catch (\Exception $e) {
        Log::error('Get Driver Profile Error', [
            'id' => $id,
            'error' => $e->getMessage(),
        ]);

        return response()->json([
            'success' => false,
            'message' => $messages['server_error'],
        ], 500);
    }
}

}