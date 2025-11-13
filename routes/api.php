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

    // ==========================================
    // PASSENGER ROUTES
    // ==========================================
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

    // ==========================================
    // DRIVER ROUTES
    // ==========================================
    Route::group(['prefix' => 'driver'], function ($router) {
        Route::post('/register', [DriverController::class, 'store']);
        Route::post('/login', [AuthAppController::class, 'driverLogin']);
        Route::post('/verify-otp', [AuthAppController::class, 'driverVerifyOtp']);
        Route::post('/logout', [AuthAppController::class, 'driverLogout']);
        Route::post('/resend-otp', [AuthAppController::class, 'driverResendOTP']);
        Route::delete('/delete-account', [AuthAppController::class, 'driverDeleteAccount']);
        Route::get('/profile/{id}', [AuthAppController::class, 'driverProfile']);
    });

    // ==========================================
    // COMMON USER ROUTES
    // ==========================================
    Route::delete('/user/delete/{id}', [AuthAppController::class, 'deleteUser']);

    // ==========================================
    // CATEGORY ROUTES
    // ==========================================
    Route::group(['prefix' => 'category'], function ($router) {
        Route::get('/', [CategroyController::class, 'showCategory']);
        Route::get('/subCategory/{cat}', [SubCategoryController::class, 'showSubCategory']);
        Route::get('/subCategory/vendors/{sub}', [SubCategoryController::class, 'showVendors']);
        Route::get('/subCategory/vendors/products/{vendor}', [SubCategoryController::class, 'showProducts']);
        Route::get('/subCategory/vendors/discount/products/{vendor}', [SubCategoryController::class, 'showDiscountProducts']);
        Route::get('/subCategory/vendors/new/products/{vendor}', [SubCategoryController::class, 'showNewProducts']);
    });

    // ==========================================
    // PASSENGERS (BOOKING) ROUTES
    // ==========================================
    // Route::post('/employees/toggle-all-archive', [EmployeeController::class, 'toggleAllArchive']);   

    Route::group(['prefix' => 'passengers'], function ($router) {
        // Passenger CRUD
        Route::post('/', [PassengerController::class, 'create']);
        Route::post('/update/{id}', [PassengerController::class, 'update']);
        Route::delete('/delete/{id}', [PassengerController::class, 'delete']);
        Route::delete('/deletePassenger/{id}', [PassengerController::class, 'deletePassenger']);
        Route::get('/getAll/{driver}', [PassengerController::class, 'getAll']);
        Route::get('/getOne/{passenger}', [PassengerController::class, 'getOne']);
        // Mobile App - Direct PDF Download (No encryption needed)
        Route::get('/download/{id}', [PassengerController::class, 'downloadPassengerPDFMobile']);
    });

    // ==========================================
    // TRAVEL ROUTES (MOVED FROM PASSENGERS)
    // ==========================================
    Route::group(['prefix' => 'travels'], function ($router) {
        // User travels by status
        Route::get('/{user}/{status}', [TravelController::class, 'allUserTravell']);
        Route::post('/{id}', [TravelController::class, 'updateTravellStatus']);
        
        // Unassigned travels (for drivers to accept)
        Route::get('/get/unassigned/travel', [TravelController::class, 'getUnassignedTravels']);
        Route::get('/get/unassigned/travel/sort', [TravelController::class, 'getUnassignedTravelsFiltered']);
        
        // Driver accepts travel
        Route::post('/accept/travel/{travelId}', [TravelController::class, 'acceptTravelRoute']);
        
        // Passenger confirm travels 
        Route::post('/passenger/confirm/{travelId}', [TravelController::class, 'passengerConfirmRide']);

        // Client travels
        Route::get('/show/client/{clientId}', [TravelController::class, 'getClientTravels']);
        
        // Cancel travel
        // Route::post('/cancel/client/travel/{travel}', [TravelController::class, 'cancelUnassignedTravelRoute']);
        Route::post('/cancel/travel/by/driver/{travel}', [TravelController::class, 'cancelTravelByDriverRoute']);
        Route::post('/cancel/travel/by/passenger/{travelId}', [TravelController::class, 'cancelTravelByPassengerRoute']);

        // Trip Management
        Route::post('/show/travel/start/{travelId}', [TravelController::class, 'startTrip']);
        Route::post('/show/travel/end/{travelId}', [TravelController::class, 'endTrip']);
        Route::get('/show/travel/status/{travelId}', [TravelController::class, 'getTripStatus']);
        
        // Confirm order
        Route::post('/confirm/order/by/client/driver/{travel}', [TravelController::class, 'confirmOrderRoute']);
        
        // Release pending payments
        Route::post('/payment/release-pending', [TravelController::class, 'releasePendingPaymentsRoute']);
    });

    // ==========================================
    // PACKAGE & SUBSCRIPTION ROUTES
    // ==========================================
    Route::group(['prefix' => 'packages'], function ($router) {
        Route::get('/', [PackageController::class, 'show']);
        Route::post('/createSubscription', [SubController::class, 'createSubscription']);
        Route::get('/Subscriptions/{driver}', [SubController::class, 'showSubscriptions']); 
    });

    // ==========================================
    // WALLET ROUTES
    // ==========================================
    Route::group(['prefix' => 'wallets'], function ($router) {
        Route::get('/{id}', [WalletController::class, 'getWallet']);
        Route::post('/{id}', [WalletController::class, 'updateWallet']);
    });

    // ==========================================
    // MANDUB ROUTES
    // ==========================================
    Route::group(['prefix' => 'mandub'], function ($router) {
        Route::post('/{code}', [MandubController::class, 'addSub']);
    });

    // ==========================================
    // BETWEEN CITY ROUTES
    // ==========================================
    Route::group(['prefix' => 'betweenCity'], function ($router) {
        Route::get('/', [BetweenCityController::class, 'showBetweenCity']);
    });

    // ==========================================
    // PAYMENT ROUTES
    // ==========================================
    Route::group(['prefix' => 'payment'], function ($router) {
        Route::post('/create-payment', [PaymentController::class, 'create']);
        Route::get('/callback', [PaymentController::class, 'callback']);
    });

    // ==========================================
    // SUPPORT ROUTES
    // ==========================================
    Route::group(['prefix' => 'support'], function ($router) {
        Route::post('/{appUser}', [SupportController::class, 'create']);
        Route::get('/{appUser}', [SupportController::class, 'get']);
        Route::post('/close-direct/{ticket}', [SupportController::class, 'closeTicketDirect'])->name('support.closeTicketDirect');
        Route::post('/reopen-ticket/{ticket}', [SupportController::class, 'reopenTicket'])->name('support.reopenTicket');
    });