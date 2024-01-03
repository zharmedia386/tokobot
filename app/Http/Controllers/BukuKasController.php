<?php

namespace App\Http\Controllers;

use App\Models\Users;
use App\Models\Buku_Kas;
use App\Models\Asset;
use App\Models\Buku_Utang_Form_Utang;
use App\Models\Buku_Utang_Form_Piutang;
use App\Models\Modal;
use App\Models\Modal_Awal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class BukuKasController extends Controller
{
    // BUKU KAS
    public function buku_kas()
    {
        $user_id = session()->get('user_id');
        
        // Validate if modal_awal is still empty or not, if so redirect to modal_awal page
        if (!Modal_Awal::where('user_id', $user_id)->exists())
            return redirect()->route('modal_awal')->with('emptyModalAwal', 'Pastikan Modal Awal diisikan terlebih dahulu, sebelum mengisi yang lainnya');

        // checks if the user is already logged in by checking the session status
        if (session()->has('hasLogin')) {
            $kas_temp = "Kas";
            $kas = DB::select('select * from asset where asset.nama_asset = ? and asset.user_id = ?', [$kas_temp, $user_id]);
            $buku_kas = DB::select('select buku_kas.user_id, buku_kas.kas_id, buku_kas.nama_pemasukkan, buku_kas.nama_pengeluaran, buku_kas.tanggal, SUM(buku_kas.harga_pemasukkan) as harga_pemasukkan , SUM(buku_kas.harga_pengeluaran) as harga_pengeluaran from buku_kas where buku_kas.user_id = ? GROUP BY buku_kas.nama_pemasukkan, buku_kas.user_id, buku_kas.nama_pengeluaran', [$user_id]);

            return view('app/buku_kas/buku_kas', compact('buku_kas', 'user_id', 'kas'));
        }
        return redirect()->route('login')->with('loginFirst', 'Anda harus login terlebih dahulu');
    }    

    // PEMASUKKAN
    public function tambah_kas_pemasukkan()
    {
        // checks if the user is already logged in by checking the session status
        if (session()->has('hasLogin')) {
            $user_id = session()->get('user_id');
            $kas_id = DB::selectOne("select getNewId('buku_kas') as value from dual")->value;
            $kreditur = DB::table('kreditur')->get();

            return view('app/buku_kas/form_buku_kas_pemasukkan', compact('kas_id', 'kreditur', 'user_id'));
        }
        return redirect()->route('login')->with('loginFirst', 'Anda harus login terlebih dahulu');
    }

    public function tambah_kas_pemasukkan_post(Request $request)
    {
        $user_id = session()->get('user_id');

        // Validate if there's no empty fields (tanggal, hargaPemasukkan, dan nama pemasukkan)
        $validator = Validator::make($request->all(), [
            'tanggal' => 'required',
            'hargaPemasukkan' => 'required',
            'pemasukkan' => 'required',
        ]);
    
        if ($validator->fails())
            return redirect()->route('tambah_kas_pemasukkan')->with('emptyFields', 'Pastikan isian tanggal, hargaPemasukkan, dan nama pemasukkan tidak kosong');

        // Create instance of Buku Kas for Handling Pemasukkan
        $buku_kas = new Buku_Kas();
        $buku_kas->harga_pemasukkan = $request->hargaPemasukkan;
        $buku_kas->harga_pemasukkan = Str::replace('.','',$buku_kas->harga_pemasukkan);
        $buku_kas->harga_pemasukkan = Str::replace('Rp ','',$buku_kas->harga_pemasukkan);
        $buku_kas->harga_pemasukkan = (int)($buku_kas->harga_pemasukkan);

        // data flows if users choose for Penagihan utang
        if($request->pemasukkan == "Penagihan utang") {
            // Update kas in Asset Lancar
            $kas_temp = "Kas";
            $kas = DB::select('select * from asset where asset.nama_asset = ? and asset.user_id = ?', [$kas_temp, $user_id]);
            $kas = Asset::find($kas[0]->nomor_asset); // find asset based on nomor_asset
            $kas->harga_asset += $buku_kas->harga_pemasukkan;
            $kas->update();

            // Decrement Piutang in Asset Lancar
            $asset = new Asset();
            $asset->user_id = session()->get('user_id');
            $asset->nomor_asset = DB::selectOne("select getNewId('asset') as value from dual")->value;
            $asset->nama_asset = "Piutang";
            $asset->jenis_asset = "Asset Lancar";
            $asset->harga_asset = -$buku_kas->harga_pemasukkan;
            $asset->save();

            // written as Piutang in Buku Piutang
            $piutang = new Buku_Utang_Form_Piutang();
            $piutang->tanggal = $request->tanggal;
            $piutang->nama = 'Penjualan Kredit';
            $piutang->jumlah_piutang = -$buku_kas->harga_pemasukkan;
            $piutang->user_id = session()->get('user_id');
            $piutang->nomor_piutang = DB::selectOne("select getNewId('buku_utang_form_piutang') as value from dual")->value;
            $piutang->nama_kreditur = $request->namaKreditur;
            $piutang->save();

        } else { // JIKA BUKAN PENAGIHAN UTANG, SAVE DI DATABASE BUKU KAS PEMASUKAN
            $buku_kas->user_id = session()->get('user_id');
            $buku_kas->kas_id = DB::selectOne("select getNewId('buku_kas') as value from dual")->value;
            $buku_kas->tanggal = $request->tanggal;
            $buku_kas->nama_pemasukkan = $request->pemasukkan;
            $buku_kas->save();
        }

        return redirect()->route('buku_kas')->with('pemasukkanSuccess', 'Pemasukkan berhasil');
    }

    // PENGELUARAN
    public function tambah_kas_pengeluaran()
    {
        $user_id = session()->get('user_id');

        // checks if the user is already logged in by checking the session status
        }
        return redirect()->route('login')->with('loginFirst', 'Anda harus login terlebih dahulu');
    }

    public function tambah_kas_pengeluaran_post(Request $request)
    {
        $user_id = session()->get('user_id');
        
        // Validate if there's no empty fields (tanggal, hargaPengeluaran, dan nama pengeluaran)
        $validator = Validator::make($request->all(), [
            'tanggal' => 'required',
            'hargaPengeluaran' => 'required',
            'pengeluaran' => 'required',
        ]);
    
        if ($validator->fails())
            return redirect()->route('tambah_kas_pengeluaran')->with('emptyFields', 'Pastikan isian tanggal, hargaPengeluaran, dan nama pengeluaran tidak kosong');

        // Creating Buku_Kas instances and save it to database
        $buku_kas->tanggal = $request->tanggal;
        $buku_kas->nama_pengeluaran = $request->pengeluaran;
        // harga Pengeluaran
        $buku_kas->harga_pengeluaran = $request->hargaPengeluaran;
        $buku_kas->harga_pengeluaran = Str::replace('.','',$buku_kas->harga_pengeluaran);
        $buku_kas->harga_pengeluaran = Str::replace('Rp ','',$buku_kas->harga_pengeluaran);
        $buku_kas->harga_pengeluaran = (int)($buku_kas->harga_pengeluaran);

        $buku_kas->save();

        // if bayar utang, buku_utang_utang berkurang
        if($request->pengeluaran == "Pembayaran Utang") {

        $buku_kas->save();

        // JIKA PEMBAYARAN UTANG, DIMASUKKAN SEBAGAI PENAMBAHAN KE PERSEDIAAN BARANG DAGANG
            $utang->nomor_utang = DB::selectOne("select getNewId('buku_utang_form_utang') as value from dual")->value;
            $utang->nama_supplier = $request->namaSupplier;
            $utang->save();
        }

        // Update uang kas
        $kas_temp = "Kas";
        $kas = DB::select('select * from asset where asset.nama_asset = ? and asset.user_id = ?', [$kas_temp, $user_id]);
        $kas = Asset::find($kas[0]->nomor_asset);
        $kas->harga_asset -= $buku_kas->harga_pengeluaran;
        $kas->update();

        return redirect()->route('buku_kas')->with('pengeluaranSuccess', 'Pengeluaran berhasil');
    }

    public function buku_kas_detail($kas_id)
    {
        // checks if the user is already logged in by checking the session status
        if (session()->has('hasLogin')) {
            $user_id = session()->get('user_id');
            $buku_kas = DB::select('select * from buku_kas where buku_kas.kas_id = ? and buku_kas.user_id = ?', [$kas_id, $user_id]);

            return view('app/buku_kas/buku_kas_detail', compact('buku_kas'));
        } 
        return redirect()->route('login')->with('loginFirst', 'Anda harus login terlebih dahulu');
    }

    public function buku_kas_delete($kas_id) {
        $buku_kas = Buku_Kas::find($kas_id);
        $buku_kas->delete();
        return redirect('/app/buku_kas');
    }
}