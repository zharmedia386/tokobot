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

<<<<<<< HEAD
        // checks if the user is already logged in by checking the session status
=======
>>>>>>> c465d62cfca7b4032b4cd5560b34f1f36993b1f2
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
<<<<<<< HEAD
        // checks if the user is already logged in by checking the session status
=======
>>>>>>> c465d62cfca7b4032b4cd5560b34f1f36993b1f2
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
<<<<<<< HEAD
        $user_id = session()->get('user_id');

=======
>>>>>>> c465d62cfca7b4032b4cd5560b34f1f36993b1f2
        // Validate if there's no empty fields (tanggal, hargaPemasukkan, dan nama pemasukkan)
        $validator = Validator::make($request->all(), [
            'tanggal' => 'required',
            'hargaPemasukkan' => 'required',
            'pemasukkan' => 'required',
        ]);
    
        if ($validator->fails())
            return redirect()->route('tambah_kas_pemasukkan')->with('emptyFields', 'Pastikan isian tanggal, hargaPemasukkan, dan nama pemasukkan tidak kosong');

<<<<<<< HEAD
        // Create instance of Buku Kas for Handling Pemasukkan
        $buku_kas = new Buku_Kas();
=======
        $user_id = session()->get('user_id');
        $buku_kas = new Buku_Kas();
        // HARGA PENGELUARAN
>>>>>>> c465d62cfca7b4032b4cd5560b34f1f36993b1f2
        $buku_kas->harga_pemasukkan = $request->hargaPemasukkan;
        $buku_kas->harga_pemasukkan = Str::replace('.','',$buku_kas->harga_pemasukkan);
        $buku_kas->harga_pemasukkan = Str::replace('Rp ','',$buku_kas->harga_pemasukkan);
        $buku_kas->harga_pemasukkan = (int)($buku_kas->harga_pemasukkan);

<<<<<<< HEAD
        // data flows if users choose for Penagihan utang
        if($request->pemasukkan == "Penagihan utang") {
            // Update kas in Asset Lancar
            $kas_temp = "Kas";
            $kas = DB::select('select * from asset where asset.nama_asset = ? and asset.user_id = ?', [$kas_temp, $user_id]);
            $kas = Asset::find($kas[0]->nomor_asset); // find asset based on nomor_asset
            $kas->harga_asset += $buku_kas->harga_pemasukkan;
            $kas->update();

            // Decrement Piutang in Asset Lancar
=======
        // PENAGIHAN UTANG (PIUTANG)
        if($request->pemasukkan == "Penagihan utang") {
            // UBAH UANG KAS DI ASET LANCAR
            $kas_temp = "Kas";
            $kas = DB::select('select * from asset where asset.nama_asset = ? and asset.user_id = ?', [$kas_temp, $user_id]);
            $kas = Asset::find($kas[0]->nomor_asset);
            $kas->harga_asset += $buku_kas->harga_pemasukkan;
            $kas->update();
            // dd($kas);

            // MENGURANGI DAFTAR PIUTANG DI ASET LANCAR
>>>>>>> c465d62cfca7b4032b4cd5560b34f1f36993b1f2
            $asset = new Asset();
            $asset->user_id = session()->get('user_id');
            $asset->nomor_asset = DB::selectOne("select getNewId('asset') as value from dual")->value;
            $asset->nama_asset = "Piutang";
            $asset->jenis_asset = "Asset Lancar";
            $asset->harga_asset = -$buku_kas->harga_pemasukkan;
<<<<<<< HEAD
            $asset->save();

            // written as Piutang in Buku Piutang
=======
            // dd($asset->harga_asset);
            $asset->save();

            // UBAH PIUTANG KAS DI BUKU PIUTANG BERDASARKAN NAMA

            // $namaKreditur = $request->namaKreditur;
            // $piutang = DB::select('select * from buku_utang_form_piutang where buku_utang_form_piutang.nama_kreditur = ? and buku_utang_form_piutang.user_id = ?', [$namaKreditur, $user_id]);
            // $piutang = Buku_Utang_Form_Piutang::find($piutang[0]->nomor_piutang);
            // $piutang->jumlah_piutang -= $buku_kas->harga_pemasukkan;
            // $piutang->update();

>>>>>>> c465d62cfca7b4032b4cd5560b34f1f36993b1f2
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
<<<<<<< HEAD
=======

>>>>>>> c465d62cfca7b4032b4cd5560b34f1f36993b1f2
            $buku_kas->save();
        }

        return redirect()->route('buku_kas')->with('pemasukkanSuccess', 'Pemasukkan berhasil');
    }

    // PENGELUARAN
    public function tambah_kas_pengeluaran()
    {
<<<<<<< HEAD
        $user_id = session()->get('user_id');

        // checks if the user is already logged in by checking the session status
        if (session()->has('hasLogin')) {
=======
        if (session()->has('hasLogin')) {
            $user_id = session()->get('user_id');
>>>>>>> c465d62cfca7b4032b4cd5560b34f1f36993b1f2
            $kas_id = DB::selectOne("select getNewId('buku_kas') as value from dual")->value;
            $supplier = DB::table('supplier')->get();

            return view('app/buku_kas/form_buku_kas_pengeluaran', compact('kas_id', 'user_id', 'supplier'));
        }
        return redirect()->route('login')->with('loginFirst', 'Anda harus login terlebih dahulu');
    }

    public function tambah_kas_pengeluaran_post(Request $request)
    {
<<<<<<< HEAD
        $user_id = session()->get('user_id');
        
=======
>>>>>>> c465d62cfca7b4032b4cd5560b34f1f36993b1f2
        // Validate if there's no empty fields (tanggal, hargaPengeluaran, dan nama pengeluaran)
        $validator = Validator::make($request->all(), [
            'tanggal' => 'required',
            'hargaPengeluaran' => 'required',
            'pengeluaran' => 'required',
        ]);
    
        if ($validator->fails())
            return redirect()->route('tambah_kas_pengeluaran')->with('emptyFields', 'Pastikan isian tanggal, hargaPengeluaran, dan nama pengeluaran tidak kosong');

<<<<<<< HEAD
        // Creating Buku_Kas instances and save it to database
=======
        $user_id = session()->get('user_id');
>>>>>>> c465d62cfca7b4032b4cd5560b34f1f36993b1f2
        $buku_kas = new Buku_Kas();
        $buku_kas->user_id = session()->get('user_id');
        $buku_kas->kas_id = DB::selectOne("select getNewId('buku_kas') as value from dual")->value;
        $buku_kas->tanggal = $request->tanggal;
        $buku_kas->nama_pengeluaran = $request->pengeluaran;
<<<<<<< HEAD
        // harga Pengeluaran
=======

        // HARGA PENGELUARAN
>>>>>>> c465d62cfca7b4032b4cd5560b34f1f36993b1f2
        $buku_kas->harga_pengeluaran = $request->hargaPengeluaran;
        $buku_kas->harga_pengeluaran = Str::replace('.','',$buku_kas->harga_pengeluaran);
        $buku_kas->harga_pengeluaran = Str::replace('Rp ','',$buku_kas->harga_pengeluaran);
        $buku_kas->harga_pengeluaran = (int)($buku_kas->harga_pengeluaran);
<<<<<<< HEAD
        $buku_kas->save();

        // if bayar utang, buku_utang_utang berkurang
        if($request->pengeluaran == "Pembayaran Utang") {
=======

        $buku_kas->save();

        // JIKA PEMBAYARAN UTANG, DIMASUKKAN SEBAGAI PENAMBAHAN KE PERSEDIAAN BARANG DAGANG
        if($request->pengeluaran == "Pembayaran Utang") {
            // $asset = new Asset();
            // $asset->user_id = session()->get('user_id');
            // $asset->nomor_asset = DB::selectOne("select getNewId('asset') as value from dual")->value;
            // $asset->nama_asset = "Persediaan barang dagang";
            // $asset->jenis_asset = "Asset Lancar";
            // $asset->harga_asset = $buku_kas->harga_pengeluaran;
            // $asset->save();


            // UBAH UTANG KAS DI BUKU PIUTANG BERDASARKAN NAMA SUPPLIER
            
            // $namaSupplier = $request->namaSupplier;
            // $utang = DB::select('select * from buku_utang_form_utang where buku_utang_form_utang.nama_supplier = ? and buku_utang_form_utang.user_id = ?', [$namaSupplier, $user_id]);
            // $utang = Buku_Utang_Form_Utang::find($utang[0]->nomor_utang);
            // $utang->jumlah_utang -= $buku_kas->harga_pengeluaran;
            // $utang->update();

>>>>>>> c465d62cfca7b4032b4cd5560b34f1f36993b1f2
            $utang = new Buku_Utang_Form_Utang();
            $utang->tanggal = $request->tanggal;
            $utang->nama = 'Persediaan barang dagang';
            $utang->jumlah_utang = -$buku_kas->harga_pengeluaran;
            $utang->user_id = session()->get('user_id');
            $utang->nomor_utang = DB::selectOne("select getNewId('buku_utang_form_utang') as value from dual")->value;
            $utang->nama_supplier = $request->namaSupplier;
            $utang->save();
<<<<<<< HEAD
        }

        // Update uang kas
        $kas_temp = "Kas";
        $kas = DB::select('select * from asset where asset.nama_asset = ? and asset.user_id = ?', [$kas_temp, $user_id]);
        $kas = Asset::find($kas[0]->nomor_asset);
        $kas->harga_asset -= $buku_kas->harga_pengeluaran;
        $kas->update();
=======


            // UBAH UTANG KAS DI BUKU UTANG BERDASARKAN NAMA
            // $namaSupplier = $request->namaSupplier;
            // $utang = DB::select('select * from buku_utang_form_utang where buku_utang_form_utang.nama_supplier = ?', [$namaSupplier]);
            // $utang = Buku_Utang_Form_Utang::find($utang[0]->nomor_utang);
            // $utang->jumlah_utang -= $buku_kas->harga_pengeluaran;
            // $utang->update();
        }

        // JIKA PEMBERIAN UTANG (PIUTANG) DAN PEMBAYARAN UTANG DI BUKU KAS PENGELUARAN DIPILIH, MASUK KE BUKU UTANG (NERACA)
        // if($request->pengeluaran == "Pemberian utang (Piutang)") {
        //     $buku_utang_form_utang = new Buku_Utang_Form_Utang();
        //     $buku_utang_form_utang->user_id = session()->get('user_id');
        //     $buku_utang_form_utang->nomor_utang = DB::selectOne("select getNewId('buku_utang_form_utang') as value from dual")->value;
        //     $buku_utang_form_utang->nama = "Pemberian Utang (Piutang)";
        //     $buku_utang_form_utang->nama_buku_kas = "-";
        //     $buku_utang_form_utang->tanggal = $request->tanggal;
        //     $buku_utang_form_utang->jumlah_utang = $buku_kas->harga_pengeluaran;

        //     $buku_utang_form_utang->save();
        // } else if($request->pengeluaran == "Pembayaran utang") {
        //     $buku_utang_form_utang = new Buku_Utang_Form_Utang();
        //     $buku_utang_form_utang->user_id = session()->get('user_id');
        //     $buku_utang_form_utang->nomor_utang = DB::selectOne("select getNewId('buku_utang_form_utang') as value from dual")->value;
        //     $buku_utang_form_utang->nama = "Pembayaran utang";
        //     $buku_utang_form_utang->nama_buku_kas = "-";
        //     $buku_utang_form_utang->tanggal = $request->tanggal;
        //     $buku_utang_form_utang->jumlah_utang = $buku_kas->harga_pengeluaran;

        //     $buku_utang_form_utang->save();
        // }

        // PEMBAYARAN UTANG 
        if($request->pengeluaran == "Pembayaran Utang" || $request->pengeluaran == "Gaji/bonus karyawan" || $request->pengeluaran == "Penarikan Sebagian asset/modal untuk keperluan pribadi") {
            // UBAH UANG KAS DI ASET LANCAR
            $kas_temp = "Kas";
            $kas = DB::select('select * from asset where asset.nama_asset = ? and asset.user_id = ?', [$kas_temp, $user_id]);
            $kas = Asset::find($kas[0]->nomor_asset);
            $kas->harga_asset -= $buku_kas->harga_pengeluaran;
            $kas->update();
            // dd($kas);
        }
>>>>>>> c465d62cfca7b4032b4cd5560b34f1f36993b1f2

        return redirect()->route('buku_kas')->with('pengeluaranSuccess', 'Pengeluaran berhasil');
    }

    public function buku_kas_detail($kas_id)
    {
<<<<<<< HEAD
        // checks if the user is already logged in by checking the session status
=======
>>>>>>> c465d62cfca7b4032b4cd5560b34f1f36993b1f2
        if (session()->has('hasLogin')) {
            $user_id = session()->get('user_id');
            $buku_kas = DB::select('select * from buku_kas where buku_kas.kas_id = ? and buku_kas.user_id = ?', [$kas_id, $user_id]);

            return view('app/buku_kas/buku_kas_detail', compact('buku_kas'));
        } 
        return redirect()->route('login')->with('loginFirst', 'Anda harus login terlebih dahulu');
    }

    public function buku_kas_delete($kas_id) {
<<<<<<< HEAD
=======
        // dd($kas_id);
>>>>>>> c465d62cfca7b4032b4cd5560b34f1f36993b1f2
        $buku_kas = Buku_Kas::find($kas_id);
        $buku_kas->delete();
        return redirect('/app/buku_kas');
    }
}