<?php

namespace App\Http\Controllers;

use App\Models\Users;
use App\Models\Orderlist;
use App\Models\Customer;
use App\Models\Purchase_Form_Tunai;
use App\Models\Purchase_Form_Kredit;
use App\Models\Asset;
use App\Models\Kewajiban;
use App\Models\Modal;
use App\Models\Beban_Usaha;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ReportController extends Controller
{
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
            $asset = DB::table('asset')->get();
            $user_id = session()->get('user_id');

            return view('app/asset/asset', compact('asset', 'user_id'));
        } 
        return redirect()->route('login')->with('loginFirst', 'Anda harus login terlebih dahulu');
    }

    public function asset_form()
    {
        if (session()->has('hasLogin')) {
            $nomor_asset = DB::selectOne("select getNewId('asset') as value from dual")->value;
            return view('app/asset/asset_form', compact('nomor_asset'));
        } 
        return redirect()->route('login')->with('loginFirst', 'Anda harus login terlebih dahulu');
    }

    public function asset_form_post(Request $request)
    {
        // $test = DB::selectOne("select getNewId('as') as value from dual")->value;
        // dd($test);

        // Purchase Form Tunai
        $asset = new Asset();
        $asset->user_id = session()->get('user_id');
        $asset->nomor_asset = DB::selectOne("select getNewId('asset') as value from dual")->value;
        $asset->nama_asset = $request->namaAsset;
        $asset->jenis_asset = $request->jenisAsset;

        // HARGA ASSET
        $asset->harga_asset = $request->hargaAsset;
        $asset->harga_asset = Str::replace('.','',$asset->harga_asset);
        $asset->harga_asset = Str::replace('Rp ','',$asset->harga_asset);
        $asset->harga_asset = (int)($asset->harga_asset);

        $asset->umur_ekonomis = $request->umurEkonomis;
        $asset->masa_penggunaan = $request->masaPenggunaan;

        $asset->save();

        return redirect()->route('asset')->with('successAddAsset', 'Pemasukan Asset Sukses!');
    }

    public function asset_detail($nomor_asset)
    {
        if (session()->has('hasLogin')) {
            $asset = DB::select('select * from asset where asset.nomor_asset = ' . $nomor_asset);
            return view('app/asset/asset_detail', compact('asset'));
        } 
        return redirect()->route('login')->with('loginFirst', 'Anda harus login terlebih dahulu');
    }

    // KEWAJIBAN
    public function kewajiban()
    {
        if (session()->has('hasLogin')) {
            $kewajiban = DB::table('kewajiban')->get();
            $user_id = session()->get('user_id');

            return view('app/kewajiban/kewajiban', compact('kewajiban', 'user_id'));
        } 
        return redirect()->route('login')->with('loginFirst', 'Anda harus login terlebih dahulu');
    }

    public function kewajiban_form()
    {
        if (session()->has('hasLogin')) {
            $nomor_kewajiban = DB::selectOne("select getNewId('kewajiban') as value from dual")->value;

            return view('app/kewajiban/kewajiban_form', compact('nomor_kewajiban'));
        } 
        return redirect()->route('login')->with('loginFirst', 'Anda harus login terlebih dahulu');
    }

    public function kewajiban_form_post(Request $request)
    {
        // $test = DB::selectOne("select getNewId('kewajiban') as value from dual")->value;
        // dd($test);

        // Kewajiban Form Tunai
        $kewajiban = new Kewajiban();
        $kewajiban->user_id = session()->get('user_id');
        $kewajiban->nomor_kewajiban = DB::selectOne("select getNewId('kewajiban') as value from dual")->value;
        $kewajiban->nama_kewajiban = $request->namaKewajiban;
        $kewajiban->jenis_kewajiban = $request->jenisKewajiban;

        // HARGA KEWAJIBAN
        $kewajiban->nominal = $request->nominal;
        $kewajiban->nominal = Str::replace('.','',$kewajiban->nominal);
        $kewajiban->nominal = Str::replace('Rp ','',$kewajiban->nominal);
        $kewajiban->nominal = (int)($kewajiban->nominal);

        $kewajiban->save();

        return redirect()->route('kewajiban')->with('successAddKewajiban', 'Pemasukan Kewajiban Sukses!');
    }

    public function kewajiban_detail($nomor_kewajiban)
    {
        if (session()->has('hasLogin')) {
            $kewajiban = DB::select('select * from kewajiban where kewajiban.nomor_kewajiban = ' . $nomor_kewajiban);
            
            return view('app/kewajiban/kewajiban_detail', compact('kewajiban'));
        } 
        return redirect()->route('login')->with('loginFirst', 'Anda harus login terlebih dahulu');
    }

    // MODAL
    public function modal()
    {
        if (session()->has('hasLogin')) {
            $modal = DB::table('modal')->get();
            $user_id = session()->get('user_id');

            return view('app/modal/modal', compact('user_id', 'modal'));
        } 
        return redirect()->route('login')->with('loginFirst', 'Anda harus login terlebih dahulu');
    }

    public function tambah_modal()
    {
        if (session()->has('hasLogin')) {
            $modal_id = DB::selectOne("select getNewId('modal') as value from dual")->value;

            return view('app/modal/tambah_modal', compact('modal_id'));
        } 
        return redirect()->route('login')->with('loginFirst', 'Anda harus login terlebih dahulu');
    }

    public function modal_form_post(Request $request)
    {
        $modal = new Modal();
        $modal->user_id = session()->get('user_id');
        $modal->modal_id = DB::selectOne("select getNewId('modal') as value from dual")->value;
        $modal->nama_modal = $request->namaModal;

        // HARGA MODAL
        $modal->harga_modal = $request->hargaModal;
        $modal->harga_modal = Str::replace('.','',$modal->harga_modal);
        $modal->harga_modal = Str::replace('Rp ','',$modal->harga_modal);
        $modal->harga_modal = (int)($modal->harga_modal);

        $modal->save();

        return redirect()->route('modal')->with('successAddModal', 'Pemasukan Modal Sukses!');
    }

    public function modal_detail($modal_id)
    {
        if (session()->has('hasLogin')) {
            $modal = DB::select('select * from modal where modal.modal_id = ' . $modal_id);

            return view('app/modal/modal_detail', compact('modal'));
        } 
        return redirect()->route('login')->with('loginFirst', 'Anda harus login terlebih dahulu');
    }

    // PERUBAHAN MODAL
    public function perubahan_modal()
    {
        if (session()->has('hasLogin')) {
            return view('app/modal/perubahan_modal');
        } 
        return redirect()->route('login')->with('loginFirst', 'Anda harus login terlebih dahulu');
    }

    // BEBAN USAHA
    public function beban_usaha()
    {
        if (session()->has('hasLogin')) {
            $beban_usaha = DB::table('beban_usaha')->get();
            $user_id = session()->get('user_id');

            return view('app/beban_usaha/beban_usaha', compact('user_id', 'beban_usaha'));
        } 
        return redirect()->route('login')->with('loginFirst', 'Anda harus login terlebih dahulu');
    }

    public function tambah_beban_usaha()
    {
        if (session()->has('hasLogin')) {
            $beban_usaha_id = DB::selectOne("select getNewId('beban_usaha') as value from dual")->value;

            return view('app/beban_usaha/form_beban_usaha', compact('beban_usaha_id'));
        } 
        return redirect()->route('login')->with('loginFirst', 'Anda harus login terlebih dahulu');
    }

    public function beban_usaha_form_post(Request $request)
    {
        $beban_usaha = new Beban_Usaha();
        $beban_usaha->user_id = session()->get('user_id');
        $beban_usaha->beban_usaha_id = DB::selectOne("select getNewId('beban_usaha') as value from dual")->value;
        $beban_usaha->nama_beban_usaha = $request->namaBebanUsaha;

        // HARGA BEBAN USAHA
        $beban_usaha->harga_beban_usaha = $request->hargaBebanUsaha;
        $beban_usaha->harga_beban_usaha = Str::replace('.','',$beban_usaha->harga_beban_usaha);
        $beban_usaha->harga_beban_usaha = Str::replace('Rp ','',$beban_usaha->harga_beban_usaha);
        $beban_usaha->harga_beban_usaha = (int)($beban_usaha->harga_beban_usaha);

        $beban_usaha->save();

        return redirect()->route('beban_usaha')->with('successAddBebanUsaha', 'Pemasukan Beban Usaha Sukses!');
    }

    public function beban_usaha_detail($beban_usaha_id)
    {
        if (session()->has('hasLogin')) {
            $beban_usaha = DB::select('select * from beban_usaha where beban_usaha.beban_usaha_id = ' . $beban_usaha_id);
            
            return view('app/beban_usaha/beban_usaha_detail', compact('beban_usaha'));
        } 
        return redirect()->route('login')->with('loginFirst', 'Anda harus login terlebih dahulu');
    }

    // ASSET TETAP
    public function asset_tetap()
    {
        if (session()->has('hasLogin')) {
            return view('app/asset_tetap/asset_tetap');
        } 
        return redirect()->route('login')->with('loginFirst', 'Anda harus login terlebih dahulu');
    }

    // STOK BARANG
    public function stok_barang()
    {
        if (session()->has('hasLogin')) {
            $stok_barang = DB::table('stok_barang')->get();
            $user_id = session()->get('user_id');

            return view('app/stok_barang/stok_barang', compact('stok_barang', 'user_id'));
        } 
        return redirect()->route('login')->with('loginFirst', 'Anda harus login terlebih dahulu');
    }

    public function stok_barang_form()
    {
        if (session()->has('hasLogin')) {
            $nomor_barang = DB::selectOne("select getNewId('stok_barang') as value from dual")->value;
            return view('app/stok_barang/stok_barang_form', compact('nomor_barang'));
        } 
        return redirect()->route('login')->with('loginFirst', 'Anda harus login terlebih dahulu');
    }

    public function stok_barang_form_post(Request $request)
    {
        // $test = DB::selectOne("select getNewId('kewajiban') as value from dual")->value;
        // dd($test);

        $stok_barang = new stok_barang();
        $stok_barang->user_id = session()->get('user_id');
        $stok_barang->nomor_barang = DB::selectOne("select getNewId('stok_barang') as value from dual")->value;
        $stok_barang->nama_barang = $request->namaBarang;
        $stok_barang->harga_barang = $request->hargaBarang;
        $stok_barang->stok_barang = $request->stokBarang;

        $stok_barang->save();

        return redirect()->route('stok_barang')->with('successAddstok_barang', 'Pemasukan Stok Barang Sukses!');
    }


    // STOK VERSI 2
    public function stok_barang_dagang()
    {
        if (session()->has('hasLogin')) {
            return view('app/stok/stok');
        } 
        return redirect()->route('login')->with('loginFirst', 'Anda harus login terlebih dahulu');
    }

    public function tambah_stok()
    {
        if (session()->has('hasLogin')) {
            return view('app/stok/tambah_stok');
        } 
        return redirect()->route('login')->with('loginFirst', 'Anda harus login terlebih dahulu');
    }

}