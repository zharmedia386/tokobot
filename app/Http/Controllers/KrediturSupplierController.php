<?php

namespace App\Http\Controllers;

use App\Models\Users;
use App\Models\Kreditur;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KrediturSupplierController extends Controller
{
    // KREDITUR
    public function kreditur()
    {
        if (session()->has('hasLogin')) {
            $kreditur = DB::table('kreditur')->get();
            $user_id = session()->get('user_id');

            return view('app/kreditur/kreditur', compact('kreditur', 'user_id'));
        } 
        return redirect()->route('login')->with('loginFirst', 'Anda harus login terlebih dahulu');
    }

    public function tambah_kreditur()
    {
        if (session()->has('hasLogin')) {
            $kreditur_id = DB::selectOne("select getNewId('kreditur') as value from dual")->value;
            return view('app/kreditur/form_kreditur', compact('kreditur_id'));
        } 
        return redirect()->route('login')->with('loginFirst', 'Anda harus login terlebih dahulu');
    }

    public function tambah_kreditur_post(Request $request)
    {
        $kreditur = new Kreditur();
        $kreditur->user_id = session()->get('user_id');
        $kreditur->kreditur_id = DB::selectOne("select getNewId('kreditur') as value from dual")->value;
        $kreditur->nama_kreditur = $request->namaKreditur;
        $kreditur->alamat = $request->alamat;

        $kreditur->save();

        return redirect()->route('kreditur')->with('successAddKreditur', 'Pemasukan Kreditur Sukses!');
    }

    public function kreditur_delete($kreditur_id) {
        // dd($kreditur_id);
        $kreditur = Kreditur::find($kreditur_id);
        $kreditur->delete();
        return redirect('/app/kreditur');
    }

    // SUPPLIER
    public function supplier()
    {
        if (session()->has('hasLogin')) {
            $supplier = DB::table('supplier')->get();
            $user_id = session()->get('user_id');

            return view('app/supplier/supplier', compact('supplier', 'user_id'));
        } 
        return redirect()->route('login')->with('loginFirst', 'Anda harus login terlebih dahulu');
    }

    public function tambah_supplier()
    {
        if (session()->has('hasLogin')) {
            $supplier_id = DB::selectOne("select getNewId('supplier') as value from dual")->value;
            return view('app/supplier/form_supplier', compact('supplier_id'));
        } 
        return redirect()->route('login')->with('loginFirst', 'Anda harus login terlebih dahulu');
    }

    public function tambah_supplier_post(Request $request)
    {
        $supplier = new Supplier();
        $supplier->user_id = session()->get('user_id');
        $supplier->supplier_id = DB::selectOne("select getNewId('supplier') as value from dual")->value;
        $supplier->nama_supplier = $request->namaSupplier;
        $supplier->alamat = $request->alamat;

        $supplier->save();

        return redirect()->route('supplier')->with('successAddsupplier', 'Pemasukan Supplier Sukses!');
    }

    public function supplier_delete($supplier_id) {
        // dd($supplier_id);
        $supplier = Supplier::find($supplier_id);
        $supplier->delete();
        return redirect('/app/supplier');
    }
}