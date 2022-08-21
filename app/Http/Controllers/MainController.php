<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{
    ////////////////////////////////////////////////////////////
    // TOKOBOT TEMPLATE
    
    // HOME DASHBOARD
    public function home()
    {
        if (session()->has('hasLogin')) {
            return view('home');
        } 
        return redirect()->route('login')->with('loginFirst', 'Anda harus login terlebih dahulu');
    }

    // PRIVACY POLICY
    public function privacy_policy()
    {
        if (session()->has('hasLogin')) {
            return view('extra.privacy-policy');
        } 
        return redirect()->route('login')->with('loginFirst', 'Anda harus login terlebih dahulu');
    }

    // TERMS OF SERVICE
    public function terms_of_service()
    {
        if (session()->has('hasLogin')) {
            return view('extra.terms-of-service');
        } 
        return redirect()->route('login')->with('loginFirst', 'Anda harus login terlebih dahulu');
    }

    // DUAL TONE ICON
    public function dual_tone_icon()
    {
        if (session()->has('hasLogin')) {
            return view('icons.dual-tone');
        } 
        return redirect()->route('login')->with('loginFirst', 'Anda harus login terlebih dahulu');
    }
}
