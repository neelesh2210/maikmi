<?php

use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\WithdrawalController;
use App\Http\Controllers\Admin\ProductOrderController;
use App\Http\Controllers\Admin\SendNotificationController;


/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "admin" middleware group. Now create something great!
|
*/

Route::get('login', [LoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('login', [LoginController::class, 'login'])->name('admin.login.submit');
Route::middleware(['auth:admin'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::post('change_theme', [DashboardController::class, 'changeTheme'])->name('admin.theme');

    Route::group(['namespace' => 'App\Http\Controllers\Admin'], function () {

        // Salons Management
        Route::resource('salon', 'SalonController')->except(['create']);
        Route::get('salon/feature-update/{id}', 'SalonController@featureUpdate')->name('salon.featureUpdate');
        Route::get('salon/available-update/{id}', 'SalonController@availableUpdate')->name('salon.availableUpdate');
        Route::post('salon/kyc-status-update/{id}', 'SalonController@kycStatusUpdate')->name('salon.kycStatusUpdate');
        Route::get('salon/worker-list/{salon_id}','SalonController@workerList')->name('salon.worker.list');
        Route::get('salon/kyc/{salon_id}','SalonController@kyc')->name('salon.kyc');

        // Gallery
        Route::resource('salon-gallery', 'SalonGalleryController');

        // Availability Hours
        Route::resource('availability-hour', 'AvailabilityHourController');

        // Service categories
        Route::resource('service-category', 'ServiceCategoryController');
        Route::get('service-category/feature-update/{id}', 'ServiceCategoryController@featureUpdate')->name('service-category.featureUpdate');
        Route::get('service-category/status-update/{id}', 'ServiceCategoryController@statusUpdate')->name('service-category.statusUpdate');

        // Service sub categories
        Route::resource('service-subcategory', 'ServiceSubCategoryController');
        Route::get('service-subcategory/feature-update/{id}', 'ServiceSubCategoryController@featureUpdate')->name('service-subcategory.featureUpdate');
        Route::get('service-subcategory/status-update/{id}', 'ServiceSubCategoryController@statusUpdate')->name('service-subcategory.statusUpdate');

        // Services
        Route::resource('services', 'ServiceController');

        //Service Catelog
        Route::resource('service-catelog','ServiceCatelogController');

        // Services Coupon
        Route::resource('service-coupon', 'ServiceCouponController');
        Route::get('service-coupon/status-update/{id}', 'ServiceCouponController@statusUpdate')->name('service-coupon.statusUpdate');

        // Products Category
        Route::resource('product-category', 'ProductCategoryController');
        Route::get('product-category/feature-update/{id}', 'ProductCategoryController@featureUpdate')->name('product-category.featureUpdate');
        Route::get('product-category/status-update/{id}', 'ProductCategoryController@statusUpdate')->name('product-category.statusUpdate');

        // Product sub categories
        Route::resource('product-subcategory', 'ProductSubCategoryController');
        Route::get('product-subcategory/feature-update/{id}', 'ProductSubCategoryController@featureUpdate')->name('product-subcategory.featureUpdate');
        Route::get('product-subcategory/status-update/{id}', 'ProductSubCategoryController@statusUpdate')->name('product-subcategory.statusUpdate');

        // Product management
        Route::resource('products', 'ProductController');
        Route::get('product/feature-update/{id}', 'ProductController@featureUpdate')->name('product.featureUpdate');

        // Product Coupon
        Route::resource('product-coupon', 'ProductCouponController');
        Route::get('product-coupon/status-update/{id}', 'ProductCouponController@statusUpdate')->name('product-coupon.statusUpdate');

        // User Management
        Route::resource('user', 'UserManagementController');
        Route::get('user/status-update/{id}', 'UserManagementController@statusUpdate')->name('user.statusUpdate');
        Route::get('user/feature-update/{id}', 'UserManagementController@featureUpdate')->name('user.featureUpdate');

        // User Address
        Route::resource('user-address', 'UserAddressController');

        // Website Setup Route
        Route::resource('web_setup', 'WebsiteSetupController');

        // App Alider Route
        Route::resource('app_sliders', 'AppSliderController');

        // App Banner Route
        Route::resource('app_banners', 'AppBannerController');

        // Transaction Route
        Route::get('payment', 'TransactionRecordController@paymentHistory')->name('transaction.payment');

        //Product Order
        Route::get('product-order-list',[ProductOrderController::class,'index'])->name('product.order.list');
        Route::get('product-order-detail/{order_id}',[ProductOrderController::class,'show'])->name('product.order.detail');

        // Staff Route
        Route::resource('staffs', 'StaffController');

        // Role Route
        Route::resource('roles', 'RoleController');

        // Service booking
        Route::resource('service-booking', 'ServiceBookingController');

        //Plan
        Route::resource('plan', PlanController::class);

        //Send Notification
        Route::get('send-notification',[SendNotificationController::class,'index'])->name('send.notification');
        Route::post('send-notification-store',[SendNotificationController::class,'store'])->name('send.notification.store');

        //Coupon
        Route::get('coupons',[CouponController::class, 'index'])->name('coupon.index');
        Route::get('coupon/create',[CouponController::class, 'create'])->name('coupon.create');
        Route::post('coupon/store',[CouponController::class, 'store'])->name('coupon.store');
        Route::get('coupon/{slug}/edit',[CouponController::class, 'edit'])->name('coupon.edit');
        Route::put('coupon/{slug}/update',[CouponController::class, 'update'])->name('coupon.update');
        Route::delete('coupon/{slug}/delete',[CouponController::class, 'destroy'])->name('coupon.destroy');
        Route::post('get-salon-service', [CouponController::class, 'getSalonService'])->name('get.salon.service');

        //Withdrawal List
        Route::get('withdrawal-list',[WithdrawalController::class,'index'])->name('withdrawal.list');
        Route::post('withdrawal-status',[WithdrawalController::class,'status'])->name('withdrawal.status');

    });

    // Change Password
    Route::post('change-password', [App\Http\Controllers\Admin\AdminController::class, 'changePassword'])->name('admin.changePassword');

    //Logout
    Route::post('logout', [LoginController::class, 'logout'])->name('admin.logout');
});
