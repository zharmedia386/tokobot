<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderlistController;
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

// TOKOBOT  TEMPLATE
Route::get('/', 'App\Http\Controllers\MainController@home')->name('home');

// EXTRA PAGE
Route::get('/extra/privacy-policy', 'App\Http\Controllers\MainController@privacy_policy')->name('privacy_policy');
Route::get('/extra/terms-of-service', 'App\Http\Controllers\MainController@terms_of_service')->name('terms_of_service');

// DUAL TONE ICON
Route::get('/icons/dual-tone', 'App\Http\Controllers\MainController@dual_tone_icon')->name('dual_tone_icon');

////////////////////////////////////////////////////////////////////////////////
// AUTHENTICATION
Route::post('/auth/logout', 'App\Http\Controllers\AuthController@logout')->name('logout');
Route::get('/auth/update_password', 'App\Http\Controllers\AuthController@update_password')->name('update_password');
Route::get('/auth/profile', 'App\Http\Controllers\AuthController@profile')->name('profile');
Route::post('/auth/edit_profile', 'App\Http\Controllers\AuthController@edit_profile')->name('edit_profile');

// PELAKU UMKM
Route::get('/auth/register', 'App\Http\Controllers\AuthController@register')->name('register');
Route::post('/auth/store', 'App\Http\Controllers\AuthController@store')->name('register.store');
Route::get('/auth/login', 'App\Http\Controllers\AuthController@login')->name('login');
Route::post('/auth/login', 'App\Http\Controllers\AuthController@authenticate')->name('login_post');