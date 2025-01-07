<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OtpLessController;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\SlotController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\ImageUploadController;
use App\Http\Controllers\Api\ProductCartController;
use App\Http\Controllers\Api\ProductHomeController;
use App\Http\Controllers\Api\SalonRatingController;
use App\Http\Controllers\Api\UserAddressController;
use App\Http\Controllers\Api\ProductOrderController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\ProductSearchController;
use App\Http\Controllers\Api\ServiceSearchController;
use App\Http\Controllers\Api\Vendors\SalonController;
use App\Http\Controllers\Api\ServiceBookingController;
use App\Http\Controllers\Api\Vendors\WorkerController;
use App\Http\Controllers\Api\Vendors\ServiceController;
use App\Http\Controllers\Api\Vendors\ServiceCategoryController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Register
Route::post('verify-registration',[RegisterController::class,'verifyRegistration']);
Route::post('register',[RegisterController::class,'register']);

//Login with Phone
Route::post('verify-login-phone',[LoginController::class,'verifyLoginPhone']);
Route::post('login-with-otp',[LoginController::class,'loginWithOtp']);

//Login with Email
Route::post('login-with-email',[LoginController::class,'loginWithEmail']);

//Login/Register
Route::post('verify-phone',[LoginController::class,'verifyPhone']);
Route::post('verify-otp',[LoginController::class,'verifyOtp']);
Route::post('registration',[LoginController::class,'registration']);

//Invoice
Route::get('generate-product-invoce/{order_id}/{user_id}',[ProductOrderController::class,'invoice'])->name('api.product.invoice');
Route::get('generate-service-invoce/{booking_id}/{user_id}',[ServiceBookingController::class,'invoice'])->name('api.service.invoice');

//OTP Less
Route::get('otpless-send-otp',[OtpLessController::class,'sendOtp']);

Route::group(['middleware' => ['auth:sanctum']], function () {

    //Home
    Route::get('home',[HomeController::class,'home']);

    //Product Home
    Route::get('product-home',[ProductHomeController::class,'home']);

    //Image Upload
    Route::post('image-upload',[ImageUploadController::class,'upload'])->name('image.upload');

    //Profile
    Route::get('profile', [ProfileController::class,'getProfile']);
    Route::post('update-profile', [ProfileController::class,'updateProfile']);
    Route::post('update-avatar', [ProfileController::class,'updateAvatar']);

    //Salon
    Route::get('get-salon-list-by-service/{sedrvice_name}',[SalonController::class,'salonListByService']);
    Route::get('get-salon-list-by-service-category/{category_id}',[SalonController::class,'salonListByServiceCategory']);
    Route::get('get-salon-list-by-product-category/{category_id}',[SalonController::class,'salonListByProductCategory']);
    Route::get('salon-detail/{id}',[SalonController::class,'show']);
    Route::get('salon-list',[SalonController::class,'index']);

    //Salon Time Slot
    Route::post('get-time-slot',[SlotController::class,'timeSlot']);

    //Service Booking
    Route::post('service-booking',[ServiceBookingController::class,'serviceBooking']);
    Route::get('service-booking-list',[ServiceBookingController::class,'serviceBookingList']);
    Route::post('service-booking-reschedule',[ServiceBookingController::class,'serviceBookingReschedule']);
    Route::post('service-booking-cancel',[ServiceBookingController::class,'serviceBookingCancel']);
    Route::post('service-booking-waiting',[ServiceBookingController::class,'serviceBookingWaiting']);
    Route::post('service-booking-confirm',[ServiceBookingController::class,'serviceBookingConfirm']);
    Route::post('service-booking-status-check',[ServiceBookingController::class,'serviceBookingStatusCheck']);
    Route::post('service-booking-retry',[ServiceBookingController::class,'serviceBookingRetry']);
    Route::post('service-booking-payment-initialization',[ServiceBookingController::class,'paymentInitialization']);
    Route::post('service-booking-verify-signature',[ServiceBookingController::class,'verifySignature']);
    Route::post('service-booking-remaining-payment-initialization',[ServiceBookingController::class,'remainingPaymentInitialization']);
    Route::post('service-booking-remaining-verify-signature',[ServiceBookingController::class,'remainingVerifySignature']);

    //Product
    Route::get('product-detail/{id}',[ProductController::class,'detail']);

    //Cart
    Route::get('cart-list',[ProductCartController::class,'index']);
    Route::post('add-update-to-product-cart',[ProductCartController::class,'store']);
    Route::post('delete-product-from-cart',[ProductCartController::class,'destroy']);

    //Service Search
    Route::get('service-search',[ServiceSearchController::class,'search']);

    //Product Search
    Route::get('product-search',[ProductSearchController::class,'search']);

    //Product Order
    Route::get('product-order-list',[ProductOrderController::class,'index']);
    Route::post('product-order-store',[ProductOrderController::class,'store']);

    //Address
    Route::apiResource('address', UserAddressController::class);

    //Update FCM Token
    Route::post('update-fcm-token',[LoginController::class,'updateFcmToken'])->name('update.fcm.token');

    //Salon Rating
    Route::post('salon-rating',[SalonRatingController::class,'salonRating']);
    Route::get('salon-rating-list/{salon_id}',[SalonRatingController::class,'salonRatingList']);

    //Vendor Route
    Route::group(['prefix' => 'vendor'], function () {

        //Service Category
        Route::get('service-categories',[ServiceCategoryController::class,'index'])->name('service.categories');

        //Serive
        Route::get('service-list',[ServiceController::class,'index'])->name('service.list');
        Route::post('add-service',[ServiceController::class,'store'])->name('add.service');
        Route::post('update-service/{id}',[ServiceController::class,'update'])->name('update.service');
        Route::get('service-catelog/{category_id}',[ServiceController::class,'serviceCatelog']);

        //Salon
        Route::get('get-salon-home',[SalonController::class,'getSalonHome']);
        Route::post('update-salon-detail',[SalonController::class,'update']);
        Route::post('update-salon-availability',[SalonController::class,'updateSalonAvailability']);
        Route::post('update-home-service-status',[SalonController::class,'updateHomeServiceStatus']);
        Route::post('update-home-service-charge',[SalonController::class,'updateHomeServiceCharge']);

        //Worker
        Route::get('worker-list',[WorkerController::class,'index']);
        Route::post('add-worker',[WorkerController::class,'store']);
        Route::post('change-worker-status',[WorkerController::class,'status']);
        Route::post('delete-worker/{worker_id}',[WorkerController::class,'destroy']);

        //Time Slot
        Route::get('get-time-slot',[App\Http\Controllers\Api\Vendors\SlotController::class,'getTimeSlot']);
        Route::post('update-time-slot',[App\Http\Controllers\Api\Vendors\SlotController::class,'updateTimeSlot']);

        //Service Booking
        Route::get('service-booking-list',[App\Http\Controllers\Api\Vendors\ServiceBookingController::class,'serviceBookingList']);
        Route::post('service-booking-status-change',[App\Http\Controllers\Api\Vendors\ServiceBookingController::class,'serviceBookingStatusChange']);
        Route::post('verify-start-service-booking-otp',[App\Http\Controllers\Api\Vendors\ServiceBookingController::class,'verifyStartServiceBookingOtp']);
        Route::post('verify-end-service-booking-otp',[App\Http\Controllers\Api\Vendors\ServiceBookingController::class,'verifyEndServiceBookingOtp']);

        //Product Category
        Route::get('product-category-list',[App\Http\Controllers\Api\Vendors\ProductCategoryController::class,'index']);

        //Product
        Route::get('product-list',[App\Http\Controllers\Api\Vendors\ProductController::class,'index']);
        Route::post('add-product',[App\Http\Controllers\Api\Vendors\ProductController::class,'store']);
        Route::post('edit-product/{id}',[App\Http\Controllers\Api\Vendors\ProductController::class,'update']);

        //Product Order
        Route::get('product-order-list',[App\Http\Controllers\Api\Vendors\ProductOrderController::class,'index']);
        Route::post('product-order-status-change',[App\Http\Controllers\Api\Vendors\ProductOrderController::class,'statusChange']);

        //Salon KYC
        Route::post('kyc-document-store',[App\Http\Controllers\Api\Vendors\KycDocumentController::class,'store']);

        //Plan
        Route::get('plan-list',[App\Http\Controllers\Api\Vendors\PlanController::class,'index']);

        //Plan Purchase
        Route::post('plan-purchase-payment-initialization',[App\Http\Controllers\Api\Vendors\PlanPurchaseController::class,'paymentInitialization']);
        Route::post('plan-purchase-verify-signature',[App\Http\Controllers\Api\Vendors\PlanPurchaseController::class,'verifySignature']);
        Route::get('plan-purchase-list',[App\Http\Controllers\Api\Vendors\PlanPurchaseController::class,'planPurchaseList']);

    });

    Route::post('logout',[LoginController::class,'logout']);

});











// -------------------------- Old Routes -------------------------- //

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Vendors api routes
Route::group(['namespace' => 'App\Http\Controllers\Api\Vendors', 'prefix' => 'vendors'], function () {

    Route::post('login', 'Auth\AuthApiController@login');
    Route::post('register', 'Auth\AuthApiController@register');

});

// Users api routes
Route::group(['namespace' => 'App\Http\Controllers\Api\Users', 'prefix' => 'users'], function () {

    Route::post('login', 'Auth\AuthApiController@login');
    Route::post('register', 'Auth\AuthApiController@register');

    // Home
    Route::get('home', 'HomeApiController@home');

    // Salon
    Route::get('salon-detail/{id}', 'SalonApiController@salonDetail');

    // Services
    Route::get('service', 'ServiceApiController@service');

    // Users authenticated route
    Route::group(['middleware' => ['auth:sanctum']], function () {

        // Profile
        Route::get('profile', 'ProfileApiController@getProfile');
        Route::post('update-profile', 'ProfileApiController@updateProfile');

        // Get time salon
        Route::get('salon-time-slot', 'SalonApiController@salonTimeSlot');

        // Service booking
        Route::get('get-service-booking', 'ServiceBookingApiController@getBooking');
        Route::post('service-booking', 'ServiceBookingApiController@booking');

        // Address
        Route::apiResource('address', 'AddressApiController');

        // Check service coupon
        Route::get('check-service-coupon', 'ServiceCouponApiController@checkCoupon');

    });

});
