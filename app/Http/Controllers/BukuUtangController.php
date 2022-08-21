<?php

namespace App\Http\Controllers;

use App\Models\Users;
use App\Models\Buku_Utang_Form_Utang;
use App\Models\Buku_Utang_Form_Piutang;
use App\Models\Sales_Form_Tunai;
use App\Models\Sales_Form_Kredit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BukuUtangController extends Controller
{

    // BUKU UTANG
    public function buku_utang()
    {
        if (session()->has('hasLogin')) {
            $buku_utang_form_utang = DB::table('buku_utang_form_utang')->get();
            $buku_utang_form_piutang = DB::table('buku_utang_form_piutang')->get();
            $user_id = session()->get('user_id');

            return view('app/buku_utang/buku_utang', compact('buku_utang_form_utang', 'buku_utang_form_piutang', 'user_id'));
        } 
        return redirect()->route('login')->with('loginFirst', 'Anda harus login terlebih dahulu');
    }

    public function buku_utang_form_utang()
    {
        if (session()->has('hasLogin')) {
            $nomor_utang = DB::selectOne("select getNewId('buku_utang_form_utang') as value from dual")->value;
            return view('app/buku_utang/buku_utang_form_utang', compact('nomor_utang'));
        } 
        return redirect()->route('login')->with('loginFirst', 'Anda harus login terlebih dahulu');
    }

    public function buku_utang_form_utang_post(Request $request)
    {
        // $test = DB::selectOne("select getNewId('buku_utang_form_utang') as value from dual")->value;
        // dd($test);

        // Buku Utang Form Tunai
        $buku_utang_form_utang = new Buku_Utang_Form_Utang();
        $buku_utang_form_utang->user_id = session()->get('user_id');
        $buku_utang_form_utang->nomor_utang = DB::selectOne("select getNewId('buku_utang_form_utang') as value from dual")->value;
        $buku_utang_form_utang->tanggal = $request->tanggal;
        $buku_utang_form_utang->nama = $request->nama;
        $buku_utang_form_utang->jumlah_utang = $request->jumlahUtang;

        $buku_utang_form_utang->save();

        return redirect()->route('buku_utang')->with('successBukuUtangFormUtang', 'Pemasukan Utang Sukses!');
    }

    public function buku_utang_utang_detail($nomor_utang)
    {
        if (session()->has('hasLogin')) {
            $buku_utang_form_utang = DB::select('select * from buku_utang_form_utang where buku_utang_form_utang.nomor_utang = ' . $nomor_utang);
            return view('app/buku_utang/buku_utang_utang_detail', compact('buku_utang_form_utang'));
        } 
        return redirect()->route('login')->with('loginFirst', 'Anda harus login terlebih dahulu');
    }

    public function buku_utang_form_piutang_post(Request $request)
    {
        // dd($request->metodePembayaran);
        // dd($request->umurPiutang);

        // Buku Utang Form Piutang
        $buku_utang_form_piutang = new Buku_Utang_Form_Piutang();
        $buku_utang_form_piutang->user_id = session()->get('user_id');
        $buku_utang_form_piutang->nomor_piutang = DB::selectOne("select getNewId('buku_utang_form_piutang') as value from dual")->value;
        $buku_utang_form_piutang->tanggal = $request->tanggal;
        $buku_utang_form_piutang->nama = $request->nama;
        $buku_utang_form_piutang->jumlah_piutang = $request->jumlahPiutang;

        $buku_utang_form_piutang->save();

        return redirect()->route('buku_utang')->with('successBukuUtangFormPiutang', 'Pemasukan Piutang Sukses!');
    }

    public function buku_utang_form_piutang()
    {
        if (session()->has('hasLogin')) {
            $nomor_piutang = DB::selectOne("select getNewId('buku_utang_form_piutang') as value from dual")->value;
            return view('app/buku_utang/buku_utang_form_piutang', compact('nomor_piutang'));
        } 
        return redirect()->route('login')->with('loginFirst', 'Anda harus login terlebih dahulu');
    }

    public function buku_utang_piutang_detail($nomor_piutang)
    {
        if (session()->has('hasLogin')) {
            $buku_utang_form_piutang = DB::select('select * from buku_utang_form_piutang where buku_utang_form_piutang.nomor_piutang = ' . $nomor_piutang);
            return view('app/buku_utang/buku_utang_piutang_detail', compact('buku_utang_form_piutang'));
        } 
        return redirect()->route('login')->with('loginFirst', 'Anda harus login terlebih dahulu');
    }
}