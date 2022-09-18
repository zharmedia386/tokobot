<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Modal_Awal;

class MainController extends Controller
{
    ////////////////////////////////////////////////////////////
    // TOKOBOT TEMPLATE
    
    // HOME DASHBOARD
    public function home()
    {
        if (session()->has('hasLogin')) {
            // TESTING ANOTHER METHOD FOR SELECT DATA FROM DB
            // $user_id = 1;
            // $modal_awal_id = 2;
            // $modal_awal = Modal_Awal::select('*')
            //     ->where('user_id', '=', $user_id)
            //     ->where('modal_awal_id', '=', $modal_awal_id)
            //     ->get();
            // dd($modal_awal[0]->nama_modal);


            // $modal_awal = DB::select('select * from modal_awal where modal_awal.modal_id = ' . 1);
            // $user_id = session()->get('user_id');

            // dd(empty($modal_awal));

            // if(empty($modal_awal)) {
            //     return redirect()->route('tambah_modal_awal')->with('successAddModal', 'Pemasukan Modal Sukses!');
            // }
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
