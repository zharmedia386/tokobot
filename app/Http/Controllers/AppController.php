<?php

namespace App\Http\Controllers;

use App\Models\Users;
use App\Models\Orderlist;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AppController extends Controller
{
    ////////////////////////////////////////////////////////////
    // APPLICATION
    
    // USER PROFILE
    public function user_profile()
    {
        if (session()->has('hasLogin')) {
            return view('app/user-profile');
        } 
        return redirect()->route('login')->with('loginFirst', 'Anda harus login terlebih dahulu');
    }

    // EDIT PROFILE
    public function edit_profile()
    {
        if (session()->has('hasLogin')) {
            return view('app/user-edit-profile');
        } 
        return redirect()->route('login')->with('loginFirst', 'Anda harus login terlebih dahulu');
    }

    // USER PRIVACY SETTING
    public function privacy_setting()
    {
        if (session()->has('hasLogin')) {
            return view('app/user-privacy-setting');
        } 
        return redirect()->route('login')->with('loginFirst', 'Anda harus login terlebih dahulu');
    }

    ////////////////////////////////////////////////////////////
    // PENJUALAN

    // PURCHASE
    public function purchase()
    {
        if (session()->has('hasLogin')) {
            return view('app/purchase');
        } 
        return redirect()->route('login')->with('loginFirst', 'Anda harus login terlebih dahulu');
    }

    public function purchase_form_tunai()
    {
        if (session()->has('hasLogin')) {
            return view('app/purchase_form_tunai');
        } 
        return redirect()->route('login')->with('loginFirst', 'Anda harus login terlebih dahulu');
    }

    public function purchase_form_kredit()
    {
        if (session()->has('hasLogin')) {
            return view('app/purchase_form_kredit');
        } 
        return redirect()->route('login')->with('loginFirst', 'Anda harus login terlebih dahulu');
    }

    // SALES
    public function sales()
    {
        if (session()->has('hasLogin')) {
            return view('app/sales');
        } 
        return redirect()->route('login')->with('loginFirst', 'Anda harus login terlebih dahulu');
    }

    ////////////////////////////////////////////////////////////
    // REPORTS

    // POSISI KEUANGAN
    public function posisi_keuangan()
    {
        if (session()->has('hasLogin')) {
            return view('app/reports/posisi-keuangan');
        } 
        return redirect()->route('login')->with('loginFirst', 'Anda harus login terlebih dahulu');
    }

    // ARUS KAS BULAN
    public function arus_kas_bulan()
    {
        if (session()->has('hasLogin')) {
            return view('app/reports/arus-kas-bulan');
        } 
        return redirect()->route('login')->with('loginFirst', 'Anda harus login terlebih dahulu');
    }

    // LABA RUGI
    public function laba_rugi()
    {
        if (session()->has('hasLogin')) {
            return view('app/reports/laba-rugi');
        } 
        return redirect()->route('login')->with('loginFirst', 'Anda harus login terlebih dahulu');
    }

    // ASSET
    public function asset()
    {
        if (session()->has('hasLogin')) {
            return view('app/asset/asset');
        } 
        return redirect()->route('login')->with('loginFirst', 'Anda harus login terlebih dahulu');
    }

    public function tambah_asset_tetap()
    {
        if (session()->has('hasLogin')) {
            return view('app/asset/form_asset_tetap');
        } 
        return redirect()->route('login')->with('loginFirst', 'Anda harus login terlebih dahulu');
    }

    public function tambah_asset_lancar()
    {
        if (session()->has('hasLogin')) {
            return view('app/asset/form_asset_lancar');
        } 
        return redirect()->route('login')->with('loginFirst', 'Anda harus login terlebih dahulu');
    }

    // KEWAJIBAN
    public function kewajiban()
    {
        if (session()->has('hasLogin')) {
            return view('app/kewajiban/kewajiban');
        } 
        return redirect()->route('login')->with('loginFirst', 'Anda harus login terlebih dahulu');
    }

    public function jangka_panjang()
    {
        if (session()->has('hasLogin')) {
            return view('app/kewajiban/form_jangka_panjang');
        } 
        return redirect()->route('login')->with('loginFirst', 'Anda harus login terlebih dahulu');
    }

    public function jangka_pendek()
    {
        if (session()->has('hasLogin')) {
            return view('app/kewajiban/form_jangka_pendek');
        } 
        return redirect()->route('login')->with('loginFirst', 'Anda harus login terlebih dahulu');
    }
}