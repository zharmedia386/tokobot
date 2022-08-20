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
}
