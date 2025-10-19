<?php

use App\Http\Controllers\Api\CategroyController;
use App\Http\Controllers\Api\DriverController;
use App\Http\Controllers\Api\GalleryApiController;
use App\Http\Controllers\Api\PackageController;
use App\Http\Controllers\Api\PassengerController;
use App\Http\Controllers\Api\SubCategoryController;
use App\Http\Controllers\Api\SubController;
use App\Http\Controllers\Api\WalletController;
use App\Http\Controllers\AuthAppController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthOtpController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\Transport\BetweenCityController;
use App\Http\Controllers\Transport\MandubController;
use App\Http\Controllers\Transport\PaymentController;
use App\Http\Controllers\Transport\TravelController;
use App\Http\Controllers\SupportController;
use App\Models\BetweenCity;
use Illuminate\Support\Facades\Route;



// Passenger Routes
Route::group(['prefix' => 'passenger'], function ($router) {
    Route::post('/register', [AuthAppController::class, 'creatNewUser']);
    Route::post('/login', [AuthAppController::class, 'passengerLogin']);
    Route::post('/verify-otp', [AuthAppController::class, 'passengerVerifyOtp']);
    Route::post('/logout', [AuthAppController::class, 'passengerLogout']);
    Route::post('/resend-otp', [AuthAppController::class, 'passengerResendOTP']);
    Route::delete('/delete-account', [AuthAppController::class, 'passengerDeleteAccount']);
    Route::get('/profile/{id}', [AuthAppController::class, 'passengerProfile']);
     Route::post('/upgrade-to-driver', [PassengerController::class, 'upgradeToDriver']);
});

// Driver Routes  
Route::group(['prefix' => 'driver'], function ($router) {
    Route::post('/register', [DriverController::class, 'store']);
    Route::post('/login', [AuthAppController::class, 'driverLogin']);
    Route::post('/verify-otp', [AuthAppController::class, 'driverVerifyOtp']);
    Route::post('/logout', [AuthAppController::class, 'driverLogout']);
    Route::post('/resend-otp', [AuthAppController::class, 'driverResendOTP']);
    Route::delete('/delete-account', [AuthAppController::class, 'driverDeleteAccount']);
    Route::get('/profile/{id}', [AuthAppController::class, 'driverProfile']);
});

// ✅ Common endpoints
Route::delete('/user/delete/{id}', [AuthAppController::class, 'deleteUser']);



// Route::group(['prefix' => 'auth'], function ($router) {
//     Route::post('/driver/login', [AuthAppController::class, 'login']);
//     Route::post('/driver/verify-otp', [AuthAppController::class, 'verifyOtp']);
//     Route::post('/driver/logout', [AuthAppController::class, 'logout']);
//     Route::post('/driver/resendOTP', [AuthAppController::class, 'resendOTP']);
//     Route::delete('/driver/delete-account', [AuthAppController::class, 'deleteAccount']);
//     Route::get('/driver/profile/{id}', [AuthAppController::class, 'profile']);
//     Route::post('/create/new/user', [AuthAppController::class, 'creatNewUser']);
// Route::delete('/user/delete/{id}', [AuthAppController::class, 'deleteUser']);

// });
// Route::group(['prefix' => 'auth'], function ($router) {
//     Route::post('/register', [AuthController::class, 'register']);
//     Route::post('/login', [AuthController::class, 'login']);
//     Route::post('/update/profile/{id}', [AuthController::class, 'update']);
//     Route::get('/profile', [AuthController::class, 'profile']);
//     Route::post('/logout', [AuthController::class, 'logout']);
//     //otp
//     Route::Post('/otp/generate', [AuthOtpController::class, 'otpGenerate']);
//     Route::Post('/otp/login', [AuthOtpController::class, 'loginWithOtp']);
//     Route::Post('/otp/update/password', [AuthOtpController::class, 'updatePassword']);
// });

Route::group(['prefix' => 'category'], function ($router) {
    Route::get('/', [CategroyController::class, 'showCategory']);
    Route::get('/subCategory/{cat}', [SubCategoryController::class, 'showSubCategory']);
    Route::get('/subCategory/vendors/{sub}', [SubCategoryController::class, 'showVendors']);
    Route::get('/subCategory/vendors/products/{vendor}', [SubCategoryController::class, 'showProducts']);
    Route::get('/subCategory/vendors/discount/products/{vendor}', [SubCategoryController::class, 'showDiscountProducts']);
    Route::get('/subCategory/vendors/new/products/{vendor}', [SubCategoryController::class, 'showNewProducts']);
});


// Route::group(['prefix' => 'drivers'], function ($router) {
//     Route::post('/', [DriverController::class, 'store']);
// });


Route::post('/employees/toggle-all-archive', [EmployeeController::class, 'toggleAllArchive']);
Route::group(['prefix' => 'passengers'], function ($router) {
    Route::post('/', [PassengerController::class, 'create']);
    Route::post('/update/{id}', [PassengerController::class, 'update']);
    Route::delete('/delete/{id}', [PassengerController::class, 'delete']);
    Route::delete('/deletePassenger/{id}', [PassengerController::class, 'deletePassenger']);
    Route::get('/getAll/{driver}', [PassengerController::class, 'getAll']);
    Route::get('/getOne/{passenger}', [PassengerController::class, 'getOne']);
    Route::post('/payment/release-pending', [PassengerController::class, 'releasePendingPayments']);
});
Route::group(['prefix' => 'packages'], function ($router) {
    Route::get('/', [PackageController::class, 'show']);
    Route::post('/createSubscription', [SubController::class, 'createSubscription']);
    Route::get('/Subscriptions/{driver}', [SubController::class, 'showSubscriptions']);
});

Route::group(['prefix' => 'wallets'], function ($router) {
    Route::get('/{id}', [WalletController::class, 'getWallet']);
    Route::post('/{id}', [WalletController::class, 'updateWallet']);
});

Route::group(['prefix' => 'mandub'], function ($router) {
    Route::post('/{code}', [MandubController::class, 'addSub']);
});
Route::group(['prefix' => 'travels'], function ($router) {
    Route::get('/{user}/{status}', [TravelController::class, 'allUserTravell']);
    Route::post('/{id}', [TravelController::class, 'updateTravellStatus']);
    Route::get('/get/unassigned/travel', [PassengerController::class, 'getUnassignedTravel']);
    Route::get('/get/unassigned/travel/sort', [PassengerController::class, 'getUnassignedTravelSort']);
    Route::post('/accept/travel/{travelId}', [PassengerController::class, 'acceptTravel']);
    Route::get('/show/client/{clientId}', [PassengerController::class, 'getClientTravel']);
    //cancelled order
    Route::post('cancel/client/travel/{travel}', [PassengerController::class, 'cancelUnassignedTravel']);
    Route::post('cancel/travel/by/drver/{travel}', [PassengerController::class, 'cancelTravelByDriver']);
    //confirm //order
    Route::post('confirm/order/by/client/driver/{travel}', [PassengerController::class, 'confirmOrderByDriverAndClient']);
    // history 
    Route::get('/transactions/history/{userId}', [PassengerController::class, 'getTransactionHistory']);
});


Route::group(['prefix' => 'betweenCity'], function ($router) {
    Route::get('/', [BetweenCityController::class, 'showBetweenCity']);
});


Route::group(['prefix' => 'payment'], function ($router) {
    Route::post('/create-payment', [PaymentController::class, 'create']);
    Route::get('/callback', [PaymentController::class, 'callback']);
});

//

Route::group(['prefix' => 'support'], function ($router) {
    Route::post('/{appUser}', [SupportController::class, 'create']);
        Route::get('/{appUser}', [SupportController::class, 'get']);

});
