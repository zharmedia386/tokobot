<?php

namespace App\Http\Controllers;

use App\Models\Users;
use App\Models\Kreditur;
use App\Models\Supplier;
use App\Models\Modal_Awal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class KrediturSupplierController extends Controller
{
    // KREDITUR
    public function kreditur()
    {
        $user_id = session()->get('user_id');
        
        // Validate if modal_awal is still empty or not, if so redirect to modal_awal page
        if (!Modal_Awal::where('user_id', $user_id)->exists())
            return redirect()->route('modal_awal')->with('emptyModalAwal', 'Pastikan Modal Awal diisikan terlebih dahulu, sebelum mengisi yang lainnya');

            // checks if the user is already logged in by checking the session status
        if (session()->has('hasLogin')) {
            $kreditur = DB::table('kreditur')->get();

            return view('app/kreditur/kreditur', compact('kreditur', 'user_id'));
        } 
        return redirect()->route('login')->with('loginFirst', 'Anda harus login terlebih dahulu');
    }

    public function tambah_kreditur()
    {
        // checks if the user is already logged in by checking the session status
        if (session()->has('hasLogin')) {
            $kreditur_id = DB::selectOne("select getNewId('kreditur') as value from dual")->value;

            return view('app/kreditur/form_kreditur', compact('kreditur_id'));
        } 
        return redirect()->route('login')->with('loginFirst', 'Anda harus login terlebih dahulu');
    }

    public function tambah_kreditur_post(Request $request)
    {
        // Validate if there's no empty fields (alamat, nama kreditur)
        $validator = Validator::make($request->all(), [
            'alamat' => 'required',
            'namaKreditur' => 'required',
        ]);
    
        if ($validator->fails())
            return redirect()->route('tambah_kreditur')->with('emptyFields', 'Pastikan isian alamat, nama kreditur tidak kosong');

        // Create a new instance of the kreditur and save it to the database
        $kreditur = new Kreditur();
        $kreditur->user_id = session()->get('user_id');
        $kreditur->kreditur_id = DB::selectOne("select getNewId('kreditur') as value from dual")->value;
        $kreditur->nama_kreditur = $request->namaKreditur;
        $kreditur->alamat = $request->alamat;
    }

    public function kreditur_delete($kreditur_id) {
        $kreditur = Kreditur::find($kreditur_id);
        $kreditur->delete();
        return redirect('/app/kreditur');
    }

    // SUPPLIER
    public function supplier()
    {
        $user_id = session()->get('user_id');
        
        // Validate if modal_awal is still empty or not, if so redirect to modal_awal page
        if (!Modal_Awal::where('user_id', $user_id)->exists())
            return redirect()->route('modal_awal')->with('emptyModalAwal', 'Pastikan Modal Awal diisikan terlebih dahulu, sebelum mengisi yang lainnya');

        // checks if the user is already logged in by checking the session status
        if (session()->has('hasLogin')) {
            $supplier = DB::table('supplier')->get();

            return view('app/supplier/supplier', compact('supplier', 'user_id'));
        } 
        return redirect()->route('login')->with('loginFirst', 'Anda harus login terlebih dahulu');
    }

    public function tambah_supplier()
    {
        // checks if the user is already logged in by checking the session status
        if (session()->has('hasLogin')) {
            $supplier_id = DB::selectOne("select getNewId('supplier') as value from dual")->value;

            return view('app/supplier/form_supplier', compact('supplier_id'));
        } 
        return redirect()->route('login')->with('loginFirst', 'Anda harus login terlebih dahulu');
    }

    public function tambah_supplier_post(Request $request)
    {
        // Validate if there's no empty fields (alamat, nama supplier)
        $validator = Validator::make($request->all(), [
            'alamat' => 'required',
            'namaSupplier' => 'required',
        ]);
    
        if ($validator->fails())
            return redirect()->route('tambah_supplier')->with('emptyFields', 'Pastikan isian alamat, nama supplier tidak kosong');

        // Create a new instance of the supplier and save it to the database
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