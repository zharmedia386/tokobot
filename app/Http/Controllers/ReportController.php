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
use App\Models\Modal_Awal;
use App\Models\Beban_Usaha;
use App\Models\Stok_Barang;
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
            $user_id = session()->get('user_id');

            // ASSET LANCAR DAN TETAP
            $cond1 = "Asset Lancar";
            $asset_lancar = DB::select('select asset.user_id, asset.nama_asset, SUM(asset.harga_asset) as harga_asset from asset where asset.jenis_asset = ? and asset.user_id = ? GROUP BY asset.nama_asset, asset.user_id', [$cond1, $user_id]);
            // dd($asset_lancar);
            $cond2 = "Asset Tetap";
            $asset_tetap = DB::select('select asset.user_id, asset.nama_asset, SUM(asset.harga_asset) as harga_asset from asset where asset.jenis_asset = ? and asset.user_id = ? GROUP BY asset.nama_asset, asset.user_id', [$cond2, $user_id]);

            // UTANG
            $utang = DB::select('select sum(jumlah_utang) as jumlah_utang from buku_utang_form_utang where buku_utang_form_utang.user_id = ' . $user_id);
            
            // MODAL
            $modal = DB::select('select sum(harga_modal) as harga_modal from modal where modal.user_id = ' . $user_id);
            
            // MODAL AWAL
            $modal_awal = DB::select('select sum(harga_modal) as harga_modal from modal_awal where modal_awal.user_id = ' . $user_id);

            // PRIVE MODAL
            $cond3 = "Penarikan Sebagian asset/modal untuk keperluan pribadi";
            $prive_modal = DB::select('select sum(harga_pengeluaran) as prive_modal from buku_kas where buku_kas.nama_pengeluaran = ? and buku_kas.user_id = ?', [$cond3, $user_id]);

            
            // dd($prive_modal);

            return view('app/reports/posisi-keuangan', compact('asset_lancar','asset_tetap', 'user_id', 'utang', 'modal', 'prive_modal', 'modal_awal'));
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
            // PEMASUKKAN DAN PENGELUARAN (BUKU KAS)
            $buku_kas = DB::table('buku_kas')->get();
            $user_id = session()->get('user_id');

            return view('app/reports/laba-rugi', compact('buku_kas', 'user_id'));
        } 
        return redirect()->route('login')->with('loginFirst', 'Anda harus login terlebih dahulu');
    }

    // PERUBAHAN MODAL
    public function perubahan_modal()
    {
        if (session()->has('hasLogin')) {
            $user_id = session()->get('user_id');

            $modal_awal = DB::select('select sum(harga_asset) as modal_awal from asset where asset.user_id = ' . $user_id);
            // dd($modal_awal);
            $prive_pemilik = DB::select('select sum(harga_pengeluaran) as prive_pemilik from buku_kas where buku_kas.user_id = ' . $user_id);

            return view('app/modal/perubahan_modal', compact('user_id', 'prive_pemilik', 'modal_awal'));
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

        $asset->save();
        // $asset->umur_ekonomis = $request->umurEkonomis;
        // $asset->masa_penggunaan = $request->masaPenggunaan;

        // MODAL
        $modal = new Modal();
        $modal->user_id = session()->get('user_id');
        $modal->modal_id = DB::selectOne("select getNewId('modal') as value from dual")->value;
        $modal->nama_modal = $request->namaAsset;
        $modal->harga_modal = (int)($asset->harga_asset);
        $modal->save();


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

    // MODAL AWAL
    public function modal_awal()
    {
        if (session()->has('hasLogin')) {
            // DATA MODAL
            $modal_awal = DB::table('modal_awal')->get();
            $user_id = session()->get('user_id');

            return view('app/modal/modal_awal', compact('user_id', 'modal_awal'));
        } 
        return redirect()->route('login')->with('loginFirst', 'Anda harus login terlebih dahulu');
    }

    public function tambah_modal_awal()
    {
        if (session()->has('hasLogin')) {
            $modal_awal_id = DB::selectOne("select getNewId('modal_awal') as value from dual")->value;

            return view('app/modal/tambah_modal_awal', compact('modal_awal_id'));
        } 
        return redirect()->route('login')->with('loginFirst', 'Anda harus login terlebih dahulu');
    }

    public function modal_awal_form_post(Request $request)
    {
        $modal_awal = new Modal_Awal();
        $modal_awal->user_id = session()->get('user_id');
        $modal_awal->modal_awal_id = DB::selectOne("select getNewId('modal_awal') as value from dual")->value;
        $modal_awal->nama_modal = $request->namaModal;

        // HARGA MODAL
        $modal_awal->harga_modal = $request->hargaModal;
        $modal_awal->harga_modal = Str::replace('.','',$modal_awal->harga_modal);
        $modal_awal->harga_modal = Str::replace('Rp ','',$modal_awal->harga_modal);
        $modal_awal->harga_modal = (int)($modal_awal->harga_modal);

        $modal_awal->save();

        return redirect()->route('modal_awal')->with('successAddModal', 'Pemasukan Modal Sukses!');
    }

    // MODAL
    public function modal()
    {
        if (session()->has('hasLogin')) {
            // DATA MODAL
            $modal = DB::table('modal')->get();
            $user_id = session()->get('user_id');


            // PERUBAHAN MODAL
            $modal_awal = DB::select('select sum(harga_modal) as modal_awal from modal_awal where modal_awal.user_id = ' . $user_id);
            $modal_tambahan = DB::select('select sum(harga_modal) as modal_tambahan from modal where modal.user_id = ' . $user_id);
            $total_modal = $modal_awal[0]->modal_awal + $modal_tambahan[0]->modal_tambahan;
            $prive_pemilik = DB::select('select sum(harga_pengeluaran) as prive_pemilik from buku_kas where buku_kas.user_id = ' . $user_id);
            $modal_akhir = $total_modal - $prive_pemilik[0]->prive_pemilik;
            // dd($modal_awal);

            return view('app/modal/modal', compact('user_id', 'modal', 'prive_pemilik', 'modal_awal', 'modal_tambahan', 'total_modal', 'modal_akhir'));
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
            $stok_id = DB::selectOne("select getNewId('stok_barang') as value from dual")->value;

            return view('app/stok_barang/stok_barang_form', compact('stok_id'));
        } 
        return redirect()->route('login')->with('loginFirst', 'Anda harus login terlebih dahulu');
    }

    public function stok_barang_form_post(Request $request)
    {
        // $test = DB::selectOne("select getNewId('kewajiban') as value from dual")->value;
        // dd($test);

        $stok_barang = new Stok_Barang();
        $stok_barang->user_id = session()->get('user_id');
        $stok_barang->stok_id = DB::selectOne("select getNewId('stok_barang') as value from dual")->value;
        $stok_barang->kode_barang = generateRandomString(6);
        $stok_barang->nama_barang = $request->namaBarang;
        $stok_barang->harga_satuan = $request->hargaSatuan;
        $stok_barang->jumlah_stok = $request->jumlahStok;
        $stok_barang->total_harga = $request->hargaSatuan * $request->jumlahStok;

        $stok_barang->save();

        return redirect()->route('stok_barang')->with('successAddstok_barang', 'Pemasukan Stok Barang Sukses!');
    }

    public function stok_barang_detail($stok_id) {
        if (session()->has('hasLogin')) {
            $stok_barang = DB::select('select * from stok_barang where stok_barang.stok_id = ' . $stok_id);
            
            return view('app/stok_barang/stok_barang_detail', compact('stok_barang'));
        } 
        return redirect()->route('login')->with('loginFirst', 'Anda harus login terlebih dahulu');
    }
}