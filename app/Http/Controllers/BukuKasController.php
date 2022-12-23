<?php

namespace App\Http\Controllers;

use App\Models\Users;
use App\Models\Buku_Kas;
use App\Models\Asset;
use App\Models\Buku_Utang_Form_Utang;
use App\Models\Buku_Utang_Form_Piutang;
use App\Models\Modal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BukuKasController extends Controller
{
    // BUKU KAS
    public function buku_kas()
    {
        if (session()->has('hasLogin')) {
            $buku_kas = DB::table('buku_kas')->get();
            $user_id = session()->get('user_id');

            return view('app/buku_kas/buku_kas', compact('buku_kas', 'user_id'));
        }
        return redirect()->route('login')->with('loginFirst', 'Anda harus login terlebih dahulu');
    }    

    // PEMASUKKAN
    public function tambah_kas_pemasukkan()
    {
        if (session()->has('hasLogin')) {
            $kas_id = DB::selectOne("select getNewId('buku_kas') as value from dual")->value;
            $kreditur = DB::table('kreditur')->get();
            $user_id = session()->get('user_id');

            return view('app/buku_kas/form_buku_kas_pemasukkan', compact('kas_id', 'kreditur', 'user_id'));
        }
        return redirect()->route('login')->with('loginFirst', 'Anda harus login terlebih dahulu');
    }

    public function tambah_kas_pemasukkan_post(Request $request)
    {
        $buku_kas = new Buku_Kas();
        $buku_kas->user_id = session()->get('user_id');
        $buku_kas->kas_id = DB::selectOne("select getNewId('buku_kas') as value from dual")->value;
        $buku_kas->tanggal = $request->tanggal;
        $buku_kas->nama_pemasukkan = $request->pemasukkan;

        // HARGA PENGELUARAN
        $buku_kas->harga_pemasukkan = $request->hargaPemasukkan;
        $buku_kas->harga_pemasukkan = Str::replace('.','',$buku_kas->harga_pemasukkan);
        $buku_kas->harga_pemasukkan = Str::replace('Rp ','',$buku_kas->harga_pemasukkan);
        $buku_kas->harga_pemasukkan = (int)($buku_kas->harga_pemasukkan);

        $buku_kas->save();

        // PENAGIHAN UTANG (PIUTANG)
        if($request->pemasukkan == "Penagihan utang") {
            // UBAH UANG KAS DI ASET LANCAR
            $kas = DB::select('select * from asset where asset.nama_asset = "Kas"');
            $kas = Asset::find($kas[0]->nomor_asset);
            $kas->harga_asset += $buku_kas->harga_pemasukkan;
            $kas->update();
            // dd($kas);

            // MENGURANGI DAFTAR PIUTANG DI ASET LANCAR
            $asset = new Asset();
            $asset->user_id = session()->get('user_id');
            $asset->nomor_asset = DB::selectOne("select getNewId('asset') as value from dual")->value;
            $asset->nama_asset = "Piutang";
            $asset->jenis_asset = "Asset Lancar";
            $asset->harga_asset = -$buku_kas->harga_pemasukkan;
            // dd($asset->harga_asset);
            $asset->save();
        }

        return redirect()->route('buku_kas')->with('pemasukkanSuccess', 'Pemasukkan berhasil');
    }

    // PENGELUARAN
    public function tambah_kas_pengeluaran()
    {
        if (session()->has('hasLogin')) {
            $kas_id = DB::selectOne("select getNewId('buku_kas') as value from dual")->value;

            return view('app/buku_kas/form_buku_kas_pengeluaran', compact('kas_id'));
        }
        return redirect()->route('login')->with('loginFirst', 'Anda harus login terlebih dahulu');
    }

    public function tambah_kas_pengeluaran_post(Request $request)
    {
        $buku_kas = new Buku_Kas();
        $buku_kas->user_id = session()->get('user_id');
        $buku_kas->kas_id = DB::selectOne("select getNewId('buku_kas') as value from dual")->value;
        $buku_kas->tanggal = $request->tanggal;
        $buku_kas->nama_pengeluaran = $request->pengeluaran;

        // HARGA PENGELUARAN
        $buku_kas->harga_pengeluaran = $request->hargaPengeluaran;
        $buku_kas->harga_pengeluaran = Str::replace('.','',$buku_kas->harga_pengeluaran);
        $buku_kas->harga_pengeluaran = Str::replace('Rp ','',$buku_kas->harga_pengeluaran);
        $buku_kas->harga_pengeluaran = (int)($buku_kas->harga_pengeluaran);

        $buku_kas->save();

        // JIKA PEMBAYARAN UTANG, DIMASUKKAN SEBAGAI PENAMBAHAN KE PERSEDIAAN BARANG DAGANG
        if($request->pengeluaran == "Pembayaran Utang") {
            $asset = new Asset();
            $asset->user_id = session()->get('user_id');
            $asset->nomor_asset = DB::selectOne("select getNewId('asset') as value from dual")->value;
            $asset->nama_asset = "Persediaan barang dagang";
            $asset->jenis_asset = "Asset Lancar";
            $asset->harga_asset = $buku_kas->harga_pengeluaran;
            // dd($asset->harga_asset);
            $asset->save();
        }

        // JIKA PEMBERIAN UTANG (PIUTANG) DAN PEMBAYARAN UTANG DI BUKU KAS PENGELUARAN DIPILIH, MASUK KE BUKU UTANG (NERACA)
        // if($request->pengeluaran == "Pemberian utang (Piutang)") {
        //     $buku_utang_form_utang = new Buku_Utang_Form_Utang();
        //     $buku_utang_form_utang->user_id = session()->get('user_id');
        //     $buku_utang_form_utang->nomor_utang = DB::selectOne("select getNewId('buku_utang_form_utang') as value from dual")->value;
        //     $buku_utang_form_utang->nama = "Pemberian Utang (Piutang)";
        //     $buku_utang_form_utang->nama_supplier = "-";
        //     $buku_utang_form_utang->tanggal = $request->tanggal;
        //     $buku_utang_form_utang->jumlah_utang = $buku_kas->harga_pengeluaran;

        //     $buku_utang_form_utang->save();
        // } else if($request->pengeluaran == "Pembayaran utang") {
        //     $buku_utang_form_utang = new Buku_Utang_Form_Utang();
        //     $buku_utang_form_utang->user_id = session()->get('user_id');
        //     $buku_utang_form_utang->nomor_utang = DB::selectOne("select getNewId('buku_utang_form_utang') as value from dual")->value;
        //     $buku_utang_form_utang->nama = "Pembayaran utang";
        //     $buku_utang_form_utang->nama_supplier = "-";
        //     $buku_utang_form_utang->tanggal = $request->tanggal;
        //     $buku_utang_form_utang->jumlah_utang = $buku_kas->harga_pengeluaran;

        //     $buku_utang_form_utang->save();
        // }

        // PEMBAYARAN UTANG 
        if($request->pengeluaran == "Pembayaran Utang" || $request->pengeluaran == "Gaji/bonus karyawan" || $request->pengeluaran == "Penarikan Sebagian asset/modal untuk keperluan pribadi") {
            // UBAH UANG KAS DI ASET LANCAR
            $kas = DB::select('select * from asset where asset.nama_asset = "Kas"');
            $kas = Asset::find($kas[0]->nomor_asset);
            $kas->harga_asset -= $buku_kas->harga_pengeluaran;
            $kas->update();
            // dd($kas);
        }

        return redirect()->route('buku_kas')->with('pengeluaranSuccess', 'Pengeluaran berhasil');
    }

    public function buku_kas_detail($kas_id)
    {
        if (session()->has('hasLogin')) {
            $buku_kas = DB::select('select * from buku_kas where buku_kas.kas_id = ' . $kas_id);

            return view('app/buku_kas/buku_kas_detail', compact('buku_kas'));
        } 
        return redirect()->route('login')->with('loginFirst', 'Anda harus login terlebih dahulu');
    }
}