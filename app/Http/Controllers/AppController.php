<?php

namespace App\Http\Controllers;

use App\Models\Users;
use App\Models\Orderlist;
use App\Models\Customer;
use App\Models\Purchase_Form_Tunai;
use App\Models\Purchase_Form_Kredit;
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
}