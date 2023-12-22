<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\ImageUploadController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\Vendors\SalonController;
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

Route::group(['middleware' => ['auth:sanctum']], function () {

    //Home
    Route::get('home',[HomeController::class,'home']);

    //Image Upload
    Route::post('image-upload',[ImageUploadController::class,'upload'])->name('image.upload');

    //Profile
    Route::get('profile', [ProfileController::class,'getProfile']);
    Route::post('update-profile', [ProfileController::class,'updateProfile']);

    //Salon
    Route::get('salon-detail/{id}',[SalonController::class,'show']);

    //Vendor Route
    Route::group(['prefix' => 'vendor'], function () {

        //Vendor Service Category
        Route::get('service-categories',[ServiceCategoryController::class,'index'])->name('service.categories');

        //Vendor Serive
        Route::get('service-list',[ServiceController::class,'index'])->name('service.list');
        Route::post('add-service',[ServiceController::class,'store'])->name('add.service');

        //Vendor Salon
        Route::post('update-salon-detail',[SalonController::class,'update']);

    });

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
