<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
})->name('frontend.index');

Route::get('/privacy', function(){
    return view('privacy');
})->name('frontend.privacy');

Route::get('terms-condition', function(){
    return view('terms_condition');
})->name('frontend.terms');

Route::get('login', function () {
    return redirect()->route('vendors.login');
})->name('login');

