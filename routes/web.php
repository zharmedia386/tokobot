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

////////////////////////////////////////////////////////////////////////////////
// APPLICATION
Route::get('/app/profile', 'App\Http\Controllers\AppController@user_profile')->name('user_profile');
Route::get('/app/edit-profile', 'App\Http\Controllers\AppController@edit_profile')->name('edit_profile');
Route::get('/app/privacy-setting', 'App\Http\Controllers\AppController@privacy_setting')->name('privacy_setting');

// PENJUALAN
//// PURCHASE
Route::get('/app/purchase', 'App\Http\Controllers\PurchaseSalesController@purchase')->name('purchase');
Route::get('/app/purchase/form_tunai', 'App\Http\Controllers\PurchaseSalesController@purchase_form_tunai')->name('purchase_form_tunai');
Route::post('/app/purchase/form_tunai', 'App\Http\Controllers\PurchaseSalesController@purchase_form_tunai_post')->name('purchase_form_tunai_post');
Route::get('/app/purchase/purchase_tunai_detail/{user_id}', 'App\Http\Controllers\PurchaseSalesController@purchase_tunai_detail')->name('purchase_tunai_detail');

Route::get('/app/purchase/form_kredit', 'App\Http\Controllers\PurchaseSalesController@purchase_form_kredit')->name('purchase_form_kredit');
Route::post('/app/purchase/form_kredit', 'App\Http\Controllers\PurchaseSalesController@purchase_form_kredit_post')->name('purchase_form_kredit_post');
Route::get('/app/purchase/purchase_kredit_detail/{user_id}', 'App\Http\Controllers\PurchaseSalesController@purchase_kredit_detail')->name('purchase_kredit_detail');

//// SALES
Route::get('/app/sales', 'App\Http\Controllers\PurchaseSalesController@sales')->name('sales');
Route::get('/app/sales/form_tunai', 'App\Http\Controllers\PurchaseSalesController@sales_form_tunai')->name('sales_form_tunai');
Route::post('/app/sales/form_tunai', 'App\Http\Controllers\PurchaseSalesController@sales_form_tunai_post')->name('sales_form_tunai_post');
Route::get('/app/sales/sales_tunai_detail/{user_id}', 'App\Http\Controllers\PurchaseSalesController@sales_tunai_detail')->name('sales_tunai_detail');

Route::get('/app/sales/form_kredit', 'App\Http\Controllers\PurchaseSalesController@sales_form_kredit')->name('sales_form_kredit');
Route::post('/app/sales/form_kredit', 'App\Http\Controllers\PurchaseSalesController@sales_form_kredit_post')->name('sales_form_kredit_post');
Route::get('/app/sales/sales_kredit_detail/{user_id}', 'App\Http\Controllers\PurchaseSalesController@sales_kredit_detail')->name('sales_kredit_detail');

//// BUKU UTANG
Route::get('/app/buku_utang', 'App\Http\Controllers\BukuUtangController@buku_utang')->name('buku_utang');
Route::get('/app/buku_utang/form_utang', 'App\Http\Controllers\BukuUtangController@buku_utang_form_utang')->name('buku_utang_form_utang');
Route::post('/app/buku_utang/form_utang', 'App\Http\Controllers\BukuUtangController@buku_utang_form_utang_post')->name('buku_utang_form_utang_post');
Route::get('/app/buku_utang/buku_utang_utang_detail/{user_id}', 'App\Http\Controllers\BukuUtangController@buku_utang_utang_detail')->name('buku_utang_utang_detail');

Route::get('/app/buku_utang/form_piutang', 'App\Http\Controllers\BukuUtangController@buku_utang_form_piutang')->name('buku_utang_form_piutang');
Route::post('/app/buku_utang/form_piutang', 'App\Http\Controllers\BukuUtangController@buku_utang_form_piutang_post')->name('buku_utang_form_piutang_post');
Route::get('/app/buku_utang/buku_utang_piutang_detail/{user_id}', 'App\Http\Controllers\BukuUtangController@buku_utang_piutang_detail')->name('buku_utang_piutang_detail');


// REPORT
Route::get('/app/reports/posisi-keuangan', 'App\Http\Controllers\ReportController@posisi_keuangan')->name('posisi_keuangan');
Route::get('/app/reports/arus-kas-bulan', 'App\Http\Controllers\ReportController@arus_kas_bulan')->name('arus_kas_bulan');
Route::get('/app/reports/laba-rugi', 'App\Http\Controllers\ReportController@laba_rugi')->name('laba_rugi');

// ASSET
Route::get('/app/asset', 'App\Http\Controllers\ReportController@asset')->name('asset');
Route::get('/app/asset/tambah_asset_tetap', 'App\Http\Controllers\ReportController@tambah_asset_tetap')->name('tambah_asset_tetap');
Route::get('/app/asset/tambah_asset_lancar', 'App\Http\Controllers\ReportController@tambah_asset_lancar')->name('tambah_asset_lancar');

// KEWAJIBAN
Route::get('/app/kewajiban', 'App\Http\Controllers\ReportController@kewajiban')->name('kewajiban');
Route::get('/app/kewajiban/jangka_panjang', 'App\Http\Controllers\ReportController@jangka_panjang')->name('jangka_panjang');
Route::get('/app/kewajiban/jangka_pendek', 'App\Http\Controllers\ReportController@jangka_pendek')->name('jangka_pendek');

// MODAL
Route::get('/app/modal', 'App\Http\Controllers\ReportController@modal')->name('modal');
Route::get('/app/tambah_modal', 'App\Http\Controllers\ReportController@tambah_modal')->name('tambah_modal');