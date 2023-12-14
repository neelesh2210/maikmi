<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\RegisterController;
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
Route::post('verify-registeration',[RegisterController::class,'verifyRegisteration']);
Route::post('register',[RegisterController::class,'register']);

//Login
Route::post('verify-login-phone',[LoginController::class,'verifyLoginPhone']);
Route::post('login-with-otp',[LoginController::class,'loginWithOtp']);

Route::post('login-with-email',[LoginController::class,'loginWithEmail']);













// -------------------------- Old Routes -------------------------- //

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Vendors api routes
Route::group(['namespace' => 'App\Http\Controllers\Api\Vendors', 'prefix' => 'vendors'], function () {

    Route::post('login', 'Auth\AuthApiController@login');
    Route::post('register', 'Auth\AuthApiController@register');

    // Vendors authenticated route
    Route::group(['middleware' => ['auth:sanctum']], function () {

        // Profile
        Route::get('profile', 'ProfileApiController@getProfile');
        Route::post('update-profile', 'ProfileApiController@updateProfile');

    });

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
