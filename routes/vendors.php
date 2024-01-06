<?php


/*
|--------------------------------------------------------------------------
| Vendors Routes
|--------------------------------------------------------------------------
|
| Here is where you can register vendors routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "vendors" middleware group. Now create something great!
|
*/

Route::get('login', [App\Http\Controllers\Vendors\Auth\LoginController::class, 'showLoginForm'])->name('vendors.login');
Route::post('login', [App\Http\Controllers\Vendors\Auth\LoginController::class, 'login'])->name('vendors.login');

Route::group(['middleware' => 'auth', 'namespace' => 'App\Http\Controllers\Vendors', 'as'=>'vendors.'], function () {

    Route::get('dashboard', 'DashboardController@index')->name('dashboard');

    // Services
    Route::resource('services', 'ServiceController');

    // Service booking
    Route::resource('service-booking', 'ServiceBookingController');

    // Products
    Route::resource('products', 'ProductController');

    // Availability Hour
    Route::resource('availability-hour', 'AvailabilityHourController');

    // Service coupon
    Route::resource('service-coupon', 'ServiceCouponController');
    Route::get('service-coupon/status-update/{id}', 'ServiceCouponController@statusUpdate')->name('service-coupon.statusUpdate');

    //Product coupon
    Route::resource('product-coupon', 'ProductCouponController');
    Route::get('product-coupon/status-update/{id}', 'ProductCouponController@statusUpdate')->name('product-coupon.statusUpdate');

    //Logout
    Route::post('logout', 'DashboardController@logout')->name('logout');
});
