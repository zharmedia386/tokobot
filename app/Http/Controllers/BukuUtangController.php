<?php

namespace App\Http\Controllers;

use App\Models\Users;
use App\Models\Buku_Utang_Form_Utang;
use App\Models\Buku_Utang_Form_Piutang;
use App\Models\Sales_Form_Tunai;
use App\Models\Sales_Form_Kredit;
use App\Models\Asset;
use App\Models\Modal_Awal;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class BukuUtangController extends Controller
{

    // BUKU UTANG
    public function buku_utang()
    {
        $user_id = session()->get('user_id');
        
        // Validate if modal_awal is still empty or not, if so redirect to modal_awal page
        if (!Modal_Awal::where('user_id', $user_id)->exists())
            return redirect()->route('modal_awal')->with('emptyModalAwal', 'Pastikan Modal Awal diisikan terlebih dahulu, sebelum mengisi yang lainnya');

        // checks if the user is already logged in by checking the session status
        if (session()->has('hasLogin')) {
            // Get sum utang and supplier based on user_id
            $buku_utang_form_utang = DB::select('select buku_utang_form_utang.user_id, buku_utang_form_utang.tanggal, buku_utang_form_utang.nama, buku_utang_form_utang.nama_supplier, buku_utang_form_utang.nomor_utang, SUM(buku_utang_form_utang.jumlah_utang) as jumlah_utang from buku_utang_form_utang where buku_utang_form_utang.user_id = ? GROUP BY buku_utang_form_utang.nama_supplier, buku_utang_form_utang.user_id', [$user_id]);
            
            // Get sum piutang and kreditur based on user_id
            $buku_utang_form_piutang = DB::select('select buku_utang_form_piutang.user_id, buku_utang_form_piutang.tanggal, buku_utang_form_piutang.nama, buku_utang_form_piutang.nama_kreditur, buku_utang_form_piutang.nomor_piutang, SUM(buku_utang_form_piutang.jumlah_piutang) as jumlah_piutang from buku_utang_form_piutang where buku_utang_form_piutang.user_id = ? GROUP BY buku_utang_form_piutang.nama_kreditur, buku_utang_form_piutang.user_id', [$user_id]);

            return view('app/buku_utang/buku_utang', compact('buku_utang_form_utang', 'buku_utang_form_piutang', 'user_id'));
        } 
        return redirect()->route('login')->with('loginFirst', 'Anda harus login terlebih dahulu');
    }

    public function buku_utang_form_utang()
    {
        $user_id = session()->get('user_id');

        // checks if the user is already logged in by checking the session status
        if (session()->has('hasLogin')) {
            $nomor_utang = DB::selectOne("select getNewId('buku_utang_form_utang') as value from dual")->value;
            $buku_utang_utang = DB::table('buku_utang_utang')->get();

            return view('app/buku_utang/buku_utang_form_utang', compact('nomor_utang', 'user_id', 'buku_utang_utang'));
        } 
        return redirect()->route('login')->with('loginFirst', 'Anda harus login terlebih dahulu');
    }

    public function buku_utang_form_utang_post(Request $request)
    {
        // Validate if there's no empty fields (tanggal, supplier, nama utang, dan jumlah utang)
        $validator = Validator::make($request->all(), [
            'tanggal' => 'required',
            'nama' => 'required',
            'jumlahUtang' => 'required',
            'namaSupplier' => 'required',
        ]);
    
        if ($validator->fails())
            return redirect()->route('buku_utang_form_utang')->with('emptyFields', 'Pastikan isian tanggal, supplier, nama utang, dan jumlah utang tidak kosong');

        // Buku Utang Form Tunai
        $buku_utang_form_utang = new Buku_Utang_Form_Utang();
        $buku_utang_form_utang->user_id = session()->get('user_id');
        $buku_utang_form_utang->nomor_utang = DB::selectOne("select getNewId('buku_utang_form_utang') as value from dual")->value;
        $buku_utang_form_utang->tanggal = $request->tanggal;
        $buku_utang_form_utang->nama = $request->nama;
        $buku_utang_form_utang->nama_buku_utang_utang = $request->namaSupplier;
        // harga satuan
        $buku_utang_form_utang->jumlah_utang = $request->jumlahUtang;
        $buku_utang_form_utang->jumlah_utang = Str::replace('.','',$buku_utang_form_utang->jumlah_utang);
        $buku_utang_form_utang->jumlah_utang = Str::replace('Rp ','',$buku_utang_form_utang->jumlah_utang);
        $buku_utang_form_utang->jumlah_utang = (int)($buku_utang_form_utang->jumlah_utang);
        $buku_utang_form_utang->save();
    public function buku_utang_utang_detail($nomor_utang)
    {
        // checks if the user is already logged in by checking the session status
        if (session()->has('hasLogin')) {
            $user_id = session()->get('user_id');
            $buku_utang_form_utang = DB::select('select * from buku_utang_form_utang where buku_utang_form_utang.nomor_utang = ? and buku_utang_form_utang.user_id = ?', [$nomor_utang, $user_id]);
            $harga_utang = DB::select('select sum(jumlah_utang) as jumlah_utang from buku_utang_form_utang where buku_utang_form_utang.nomor_utang = ? and buku_utang_form_utang.user_id = ?', [$nomor_utang, $user_id]);

            return view('app/buku_utang/buku_utang_utang_detail', compact('buku_utang_form_utang','harga_utang'));
        } 
        return redirect()->route('login')->with('loginFirst', 'Anda harus login terlebih dahulu');
    }

    public function buku_utang_form_piutang_post(Request $request)
    {
        $user_id = session()->get('user_id');

        // Validate if there's no empty fields (tanggal, kreditur, nama piutang, dan jumlah piutang)
        $validator = Validator::make($request->all(), [
            'tanggal' => 'required',
            'nama' => 'required',
            'jumlahPiutang' => 'required',
            'namaKreditur' => 'required',
        ]);
    
        if ($validator->fails())
            return redirect()->route('buku_utang_form_utang')->with('emptyFields', 'Pastikan isian tanggal, kreditur, nama piutang, dan jumlah piutang tidak kosong');

        // Buku Utang Form Piutang
        $buku_utang_form_piutang = new Buku_Utang_Form_Piutang();
        $buku_utang_form_piutang->user_id = $user_id;
        $buku_utang_form_piutang->nomor_piutang = DB::selectOne("select getNewId('buku_utang_form_piutang') as value from dual")->value;
        $buku_utang_form_piutang->tanggal = $request->tanggal;
        $buku_utang_form_piutang->nama = $request->nama;
        $buku_utang_form_piutang->nama_kreditur = $request->namaKreditur;
        // harga satuan
        $buku_utang_form_piutang->save();

        // ASSET LANCAR
        $asset = new Asset();
        $asset->user_id = session()->get('user_id');
        $asset->nomor_asset = DB::selectOne("select getNewId('asset') as value from dual")->value;
        $asset->nama_asset = "Pemberian Utang (Piutang)";
        $asset->jenis_asset = "Asset Lancar";
        $asset->harga_asset = $buku_utang_form_piutang->jumlah_piutang;
        $asset->save();

        return redirect()->route('buku_utang')->with('successBukuUtangFormPiutang', 'Pemasukan Piutang Sukses!');
    }

    public function buku_utang_form_piutang()
    {
        // checks if the user is already logged in by checking the session status
        if (session()->has('hasLogin')) {
            $user_id = session()->get('user_id');
            $nomor_piutang = DB::selectOne("select getNewId('buku_utang_form_piutang') as value from dual")->value;
            $kreditur = DB::table('kreditur')->get();

            return view('app/buku_utang/buku_utang_form_piutang', compact('nomor_piutang', 'user_id', 'kreditur'));
        } 
        return redirect()->route('login')->with('loginFirst', 'Anda harus login terlebih dahulu');
    }

    public function buku_utang_piutang_detail($nomor_piutang)
    {
        // checks if the user is already logged in by checking the session status
        if (session()->has('hasLogin')) {
            $user_id = session()->get('user_id');
            $buku_utang_form_piutang = DB::select('select * from buku_utang_form_piutang where buku_utang_form_piutang.nomor_piutang = ? and buku_utang_form_piutang.user_id = ?', [$nomor_piutang, $user_id]);
            $harga_piutang = DB::select('select sum(jumlah_piutang) as jumlah_piutang from buku_utang_form_piutang where buku_utang_form_piutang.nomor_piutang = ? and buku_utang_form_piutang.user_id = ?', [$nomor_piutang, $user_id]);

            return view('app/buku_utang/buku_utang_piutang_detail', compact('buku_utang_form_piutang','harga_piutang'));
        } 
        return redirect()->route('login')->with('loginFirst', 'Anda harus login terlebih dahulu');
    }

    //  deletes an entry from the "buku_utang_utang" table based on nomor_utang as primary key
    public function buku_utang_utang_delete($nomor_utang) {
        $buku_utang_utang = Buku_Utang_Form_Utang::find($nomor_utang);
        $buku_utang_utang->delete();
        
        return redirect('/app/buku_utang');
    }
    
    //  deletes an entry from the "buku_utang_piutang" table based on nomor_piutang as primary key
    public function buku_utang_piutang_delete($nomor_piutang) {
        $buku_utang_piutang = Buku_Utang_Form_Piutang::find($nomor_piutang);
        $buku_utang_piutang->delete();

        return redirect('/app/buku_utang');
    }
}