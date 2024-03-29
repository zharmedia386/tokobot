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
Route::post('/app/purchase/purchase_tunai_delete/{nomor_transaksi}', 'App\Http\Controllers\PurchaseSalesController@purchase_tunai_delete')->name('purchase_tunai_delete');

Route::get('/app/purchase/form_kredit', 'App\Http\Controllers\PurchaseSalesController@purchase_form_kredit')->name('purchase_form_kredit');
Route::post('/app/purchase/form_kredit', 'App\Http\Controllers\PurchaseSalesController@purchase_form_kredit_post')->name('purchase_form_kredit_post');
Route::get('/app/purchase/purchase_kredit_detail/{user_id}', 'App\Http\Controllers\PurchaseSalesController@purchase_kredit_detail')->name('purchase_kredit_detail');
Route::post('/app/purchase/purchase_kredit_delete/{nomor_transaksi}', 'App\Http\Controllers\PurchaseSalesController@purchase_kredit_delete')->name('purchase_kredit_delete');

//// SALES
Route::get('/app/sales', 'App\Http\Controllers\PurchaseSalesController@sales')->name('sales');
Route::get('/app/sales/form_tunai', 'App\Http\Controllers\PurchaseSalesController@sales_form_tunai')->name('sales_form_tunai');
Route::post('/app/sales/form_tunai', 'App\Http\Controllers\PurchaseSalesController@sales_form_tunai_post')->name('sales_form_tunai_post');
Route::get('/app/sales/sales_tunai_detail/{user_id}', 'App\Http\Controllers\PurchaseSalesController@sales_tunai_detail')->name('sales_tunai_detail');
Route::post('/app/sales/sales_tunai_delete/{nomor_transaksi}', 'App\Http\Controllers\PurchaseSalesController@sales_tunai_delete')->name('sales_tunai_delete');

Route::get('/app/sales/form_kredit', 'App\Http\Controllers\PurchaseSalesController@sales_form_kredit')->name('sales_form_kredit');
Route::post('/app/sales/form_kredit', 'App\Http\Controllers\PurchaseSalesController@sales_form_kredit_post')->name('sales_form_kredit_post');
Route::get('/app/sales/sales_kredit_detail/{user_id}', 'App\Http\Controllers\PurchaseSalesController@sales_kredit_detail')->name('sales_kredit_detail');
Route::post('/app/sales/sales_kredit_delete/{nomor_transaksi}', 'App\Http\Controllers\PurchaseSalesController@sales_kredit_delete')->name('sales_kredit_delete');

//// BUKU UTANG
Route::get('/app/buku_utang', 'App\Http\Controllers\BukuUtangController@buku_utang')->name('buku_utang');
Route::get('/app/buku_utang/form_utang', 'App\Http\Controllers\BukuUtangController@buku_utang_form_utang')->name('buku_utang_form_utang');
Route::post('/app/buku_utang/form_utang', 'App\Http\Controllers\BukuUtangController@buku_utang_form_utang_post')->name('buku_utang_form_utang_post');
Route::get('/app/buku_utang/buku_utang_utang_detail/{user_id}', 'App\Http\Controllers\BukuUtangController@buku_utang_utang_detail')->name('buku_utang_utang_detail');
Route::post('/app/buku_utang/buku_utang_utang_delete/{nomor_utang}', 'App\Http\Controllers\BukuUtangController@buku_utang_utang_delete')->name('buku_utang_utang_delete');

Route::get('/app/buku_utang/form_piutang', 'App\Http\Controllers\BukuUtangController@buku_utang_form_piutang')->name('buku_utang_form_piutang');
Route::post('/app/buku_utang/form_piutang', 'App\Http\Controllers\BukuUtangController@buku_utang_form_piutang_post')->name('buku_utang_form_piutang_post');
Route::get('/app/buku_utang/buku_utang_piutang_detail/{user_id}', 'App\Http\Controllers\BukuUtangController@buku_utang_piutang_detail')->name('buku_utang_piutang_detail');
Route::post('/app/buku_utang/buku_utang_piutang_delete/{nomor_piutang}', 'App\Http\Controllers\BukuUtangController@buku_utang_piutang_delete')->name('buku_utang_piutang_delete');


// REPORT
Route::get('/app/reports/posisi-keuangan', 'App\Http\Controllers\ReportController@posisi_keuangan')->name('posisi_keuangan');
Route::get('/app/reports/arus-kas-bulan', 'App\Http\Controllers\ReportController@arus_kas_bulan')->name('arus_kas_bulan');
Route::get('/app/reports/laba-rugi', 'App\Http\Controllers\ReportController@laba_rugi')->name('laba_rugi');

// ASSET
Route::get('/app/asset', 'App\Http\Controllers\ReportController@asset')->name('asset');
Route::get('/app/asset/asset_form', 'App\Http\Controllers\ReportController@asset_form')->name('asset_form');
Route::post('/app/asset/asset_form', 'App\Http\Controllers\ReportController@asset_form_post')->name('asset_form_post');
Route::get('/app/asset/asset_detail/{user_id}', 'App\Http\Controllers\ReportController@asset_detail')->name('asset_detail');
Route::post('/app/asset/asset_delete/{nomor_asset}', 'App\Http\Controllers\ReportController@asset_delete')->name('asset_delete');

// KEWAJIBAN
// Route::get('/app/kewajiban', 'App\Http\Controllers\ReportController@kewajiban')->name('kewajiban');
// Route::get('/app/kewajiban/kewajiban_form', 'App\Http\Controllers\ReportController@kewajiban_form')->name('kewajiban_form');
// Route::post('/app/kewajiban/kewajiban_form', 'App\Http\Controllers\ReportController@kewajiban_form_post')->name('kewajiban_form_post');
// Route::get('/app/kewajiban/kewajiban_detail/{user_id}', 'App\Http\Controllers\ReportController@kewajiban_detail')->name('kewajiban_detail');
// Route::post('/app/kewajiban/kewajiban_delete/{nomor_kewajiban}', 'App\Http\Controllers\ReportController@kewajiban_delete')->name('kewajiban_delete');

// MODAL
Route::get('/app/modal', 'App\Http\Controllers\ReportController@modal')->name('modal');
Route::get('/app/tambah_modal', 'App\Http\Controllers\ReportController@tambah_modal')->name('tambah_modal');
Route::post('/app/modal/modal_form', 'App\Http\Controllers\ReportController@modal_form_post')->name('modal_form_post');
Route::get('/app/modal/modal_detail/{modal_id}', 'App\Http\Controllers\ReportController@modal_detail')->name('modal_detail');
Route::post('/app/modal/modal_delete/{modal_id}', 'App\Http\Controllers\ReportController@modal_delete')->name('modal_delete');

// MODAL AWAL
Route::get('/app/modal_awal', 'App\Http\Controllers\ReportController@modal_awal')->name('modal_awal');
Route::get('/app/modal_awal_aset_usaha', 'App\Http\Controllers\ReportController@modal_awal_aset_usaha')->name('modal_awal_aset_usaha');
Route::post('/app/modal_awal_aset_usaha', 'App\Http\Controllers\ReportController@modal_awal_aset_form_post')->name('modal_awal_aset_usaha_post');
Route::get('/app/modal_awal_persediaan_barang_dagang', 'App\Http\Controllers\ReportController@modal_awal_persediaan_barang_dagang')->name('modal_awal_persediaan_barang_dagang');
Route::post('/app/modal_awal_persediaan_barang_dagang', 'App\Http\Controllers\ReportController@modal_awal_persediaan_form_post')->name('modal_awal_persediaan_barang_dagang_post');
Route::post('/app/modal_awal/modal_awal_delete/{modal_awal_id}', 'App\Http\Controllers\ReportController@modal_awal_delete')->name('modal_awal_delete');
Route::get('/app/modal_awal_detail/{modal_awal_id}', 'App\Http\Controllers\ReportController@modal_awal_detail')->name('modal_awal_detail');

// PERUBAHAN MODAL
Route::get('/app/perubahan_modal', 'App\Http\Controllers\ReportController@perubahan_modal')->name('perubahan_modal');

// BEBAN USAHA
Route::get('/app/beban_usaha', 'App\Http\Controllers\ReportController@beban_usaha')->name('beban_usaha');
Route::get('/app/tambah_beban_usaha', 'App\Http\Controllers\ReportController@tambah_beban_usaha')->name('tambah_beban_usaha');
Route::post('/app/beban_usaha/beban_usaha_form', 'App\Http\Controllers\ReportController@beban_usaha_form_post')->name('beban_usaha_form_post');
Route::get('/app/beban_usaha/beban_usaha_detail/{beban_usaha_id}', 'App\Http\Controllers\ReportController@beban_usaha_detail')->name('beban_usaha_detail');

// BUKU KAS
Route::get('/app/buku_kas', 'App\Http\Controllers\BukuKasController@buku_kas')->name('buku_kas');
Route::get('/app/tambah_kas_pemasukkan', 'App\Http\Controllers\BukuKasController@tambah_kas_pemasukkan')->name('tambah_kas_pemasukkan');
Route::post('/app/tambah_kas_pemasukkan', 'App\Http\Controllers\BukuKasController@tambah_kas_pemasukkan_post')->name('tambah_kas_pemasukkan_post');
Route::get('/app/tambah_kas_pengeluaran', 'App\Http\Controllers\BukuKasController@tambah_kas_pengeluaran')->name('tambah_kas_pengeluaran');
Route::post('/app/tambah_kas_pengeluaran', 'App\Http\Controllers\BukuKasController@tambah_kas_pengeluaran_post')->name('tambah_kas_pengeluaran_post');
Route::get('/app/buku_kas_detail/{kas_id}', 'App\Http\Controllers\BukuKasController@buku_kas_detail')->name('buku_kas_detail');
Route::post('/app/buku_kas_delete/{kas_id}', 'App\Http\Controllers\BukuKasController@buku_kas_delete')->name('buku_kas_delete');

// ASSET TETAP
Route::get('/app/asset_tetap', 'App\Http\Controllers\ReportController@asset_tetap')->name('asset_tetap');

// STOK BARANG
Route::get('/app/stok_barang', 'App\Http\Controllers\ReportController@stok_barang')->name('stok_barang');
Route::get('/app/stok_barang/stok_barang_form', 'App\Http\Controllers\ReportController@stok_barang_form')->name('stok_barang_form');
Route::post('/app/stok_barang/stok_barang_form_post', 'App\Http\Controllers\ReportController@stok_barang_form_post')->name('stok_barang_form_post');
Route::get('/app/stok_barang/stok_barang_detail/{stok_id}', 'App\Http\Controllers\ReportController@stok_barang_detail')->name('stok_barang_detail');
Route::post('/app/stok_barang/stok_barang_delete/{stok_id}', 'App\Http\Controllers\ReportController@stok_barang_delete')->name('stok_barang_delete');

// KREDITUR
Route::get('/app/kreditur', 'App\Http\Controllers\KrediturSupplierController@kreditur')->name('kreditur');
Route::get('/app/tambah_kreditur', 'App\Http\Controllers\KrediturSupplierController@tambah_kreditur')->name('tambah_kreditur');
Route::post('/app/tambah_kreditur', 'App\Http\Controllers\KrediturSupplierController@tambah_kreditur_post')->name('tambah_kreditur_post');
Route::post('/app/kreditur_delete/{kreditur_id}', 'App\Http\Controllers\KrediturSupplierController@kreditur_delete')->name('kreditur_delete');

// SUPPLIER
Route::get('/app/supplier', 'App\Http\Controllers\KrediturSupplierController@supplier')->name('supplier');
Route::get('/app/tambah_supplier', 'App\Http\Controllers\KrediturSupplierController@tambah_supplier')->name('tambah_supplier');
Route::post('/app/tambah_supplier', 'App\Http\Controllers\KrediturSupplierController@tambah_supplier_post')->name('tambah_supplier_post');
Route::post('/app/supplier_delete/{supplier_id}', 'App\Http\Controllers\KrediturSupplierController@supplier_delete')->name('supplier_delete');