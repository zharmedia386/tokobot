<?php

namespace App\Http\Controllers;

use App\Models\Users;
use App\Models\Orderlist;
use App\Models\Customer;
use App\Models\Purchase_Form_Tunai;
use App\Models\Sales_Form_Tunai;
use App\Models\Sales_Form_Kredit;
use App\Models\Purchase_Form_Kredit;
use App\Models\Asset;
use App\Models\Kewajiban;
use App\Models\Buku_Kas;
use App\Models\Modal;
use App\Models\Modal_Awal;
use App\Models\Beban_Usaha;
use App\Models\Stok_Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class ReportController extends Controller
{
    ////////////////////////////////////////////////////////////
    // REPORTS

    // POSISI KEUANGAN
    public function posisi_keuangan()
    {
        $user_id = session()->get('user_id');
        
        // Validate if modal_awal is still empty or not, if so redirect to modal_awal page
        if (!Modal_Awal::where('user_id', $user_id)->exists())
            return redirect()->route('modal_awal')->with('emptyModalAwal', 'Pastikan Modal Awal diisikan terlebih dahulu, sebelum mengisi yang lainnya');

        if (session()->has('hasLogin')) {
            // ASSET LANCAR DAN TETAP
            $cond1 = "Asset Lancar";
            $asset_lancar = DB::select('select asset.user_id, asset.nama_asset, SUM(asset.harga_asset) as harga_asset from asset where asset.jenis_asset = ? and asset.user_id = ? GROUP BY asset.nama_asset, asset.user_id', [$cond1, $user_id]);
            // dd($asset_lancar);
            $cond2 = "Asset Tetap";
            $asset_tetap = DB::select('select asset.user_id, asset.nama_asset, SUM(asset.harga_asset) as harga_asset from asset where asset.jenis_asset = ? and asset.user_id = ? GROUP BY asset.nama_asset, asset.user_id', [$cond2, $user_id]);

            // UTANG
            $utang = DB::select('select sum(jumlah_utang) as jumlah_utang from buku_utang_form_utang where buku_utang_form_utang.user_id = ?', [$user_id]);
            
            // MODAL
            $modal = DB::select('select sum(harga_modal) as harga_modal from modal where modal.user_id = ' . $user_id);
            $modal = $modal[0]->harga_modal; // baru modal awal
            
            // MODAL AWAL
            $modal_awal = DB::select('select sum(harga_modal) as harga_modal from modal_awal where modal_awal.user_id = ' . $user_id);

            // PRIVE MODAL
            $cond3 = "Penarikan Sebagian asset/modal untuk keperluan pribadi";
            $prive_modal = DB::select('select sum(harga_pengeluaran) as prive_modal from buku_kas where buku_kas.nama_pengeluaran = ? and buku_kas.user_id = ?', [$cond3, $user_id]);
            $prive_modal = $prive_modal[0]->prive_modal;
            
            // Pendapatan
            $penjualan_tunai = DB::select('select sum(total_penjualan) as sales_tunai from sales_form_tunai where sales_form_tunai.user_id = ' . $user_id);
            $penjualan_tunai= $penjualan_tunai[0]->sales_tunai;
            $penjualan_kredit = DB::select('select sum(total_penjualan) as sales_kredit from sales_form_kredit where sales_form_kredit.user_id = ' . $user_id);
            $penjualan_kredit = $penjualan_kredit[0]->sales_kredit;

            $pendapatan_atas_penjualan = $penjualan_tunai + $penjualan_kredit;
            // dd($pendapatan_atas_penjualan);


            // Harga Pokok Penjualan -> Jumlah yang terjual x Harga Pembelian
            $stok_barang_dagang = DB::select('select * from stok_barang where stok_barang.user_id = ' . $user_id);
            $sales_form_tunai = DB::select('select * from sales_form_tunai where sales_form_tunai.user_id = ' . $user_id);
            $sales_form_kredit = DB::select('select * from sales_form_kredit where sales_form_kredit.user_id = ' . $user_id);
            $hpp1 = 0;
            $hpp2 = 0;

            // Penjualan Tunai
            foreach($sales_form_tunai as $sales_tunai) {
                foreach($stok_barang_dagang as $stok_barang) {
                    if(Str::lower($sales_tunai->produk_yang_terjual) == Str::lower($stok_barang->nama_barang)) {
                        $hpp1 += $sales_tunai->jumlah_barang * $stok_barang->harga_satuan;
                    }
                }
            }
            
            // Penjualan Kredit
            foreach($sales_form_kredit as $sales_kredit) {
                foreach($stok_barang_dagang as $stok_barang) {
                    if(Str::lower($sales_kredit->produk_yang_terjual) == Str::lower($stok_barang->nama_barang)) {
                        $hpp1 += $sales_kredit->jumlah_barang * $stok_barang->harga_satuan;
                    }
                }
            }

            $harga_pokok_penjualan = $hpp1;
            $laba_kotor = $pendapatan_atas_penjualan - $harga_pokok_penjualan;
            $modal_akhir=0;

            // BEBAN GAJI
            $beban_gaji = DB::select('select sum(harga_pengeluaran) as beban_gaji from buku_kas where buku_kas.nama_pengeluaran = "Gaji/bonus karyawan" and buku_kas.user_id = ' . $user_id);

            if($beban_gaji) {
                $beban_gaji = $beban_gaji[0]->beban_gaji;
                            
                
                /////////////////////////////////
                /// LABA BERSIH
                $laba_bersih = $laba_kotor - $beban_gaji;

                // MODAL AKHIR
                // modal_awal + laba bersih - prive modal
                // dikurangi prive modal nya nanti di frontend
                $modal_akhir = $modal + $laba_bersih;
            }

            return view('app/reports/posisi-keuangan', compact('asset_lancar','asset_tetap', 'user_id', 'utang', 'modal_akhir', 'prive_modal', 'modal_awal'));
        } 
        return redirect()->route('login')->with('loginFirst', 'Anda harus login terlebih dahulu');
    }

    // ARUS KAS BULAN
    public function arus_kas_bulan()
    {
        $user_id = session()->get('user_id');
        
        // Validate if modal_awal is still empty or not, if so redirect to modal_awal page
        if (!Modal_Awal::where('user_id', $user_id)->exists())
            return redirect()->route('modal_awal')->with('emptyModalAwal', 'Pastikan Modal Awal diisikan terlebih dahulu, sebelum mengisi yang lainnya');

        if (session()->has('hasLogin')) {
            return view('app/reports/arus-kas-bulan');
        } 
        return redirect()->route('login')->with('loginFirst', 'Anda harus login terlebih dahulu');
    }

    // LABA RUGI
    public function laba_rugi()
    {
        $user_id = session()->get('user_id');
        
        // Validate if modal_awal is still empty or not, if so redirect to modal_awal page
        if (!Modal_Awal::where('user_id', $user_id)->exists())
            return redirect()->route('modal_awal')->with('emptyModalAwal', 'Pastikan Modal Awal diisikan terlebih dahulu, sebelum mengisi yang lainnya');

        if (session()->has('hasLogin')) {
            // PEMASUKKAN DAN PENGELUARAN (BUKU KAS)
            // Harga Pokok Penjualan -> Jumlah yang terjual x Harga Pembelian
            $stok_barang_dagang = DB::select('select * from stok_barang where stok_barang.user_id = ' . $user_id);
            $sales_form_tunai = DB::select('select * from sales_form_tunai where sales_form_tunai.user_id = ' . $user_id);
            $sales_form_kredit = DB::select('select * from sales_form_kredit where sales_form_kredit.user_id = ' . $user_id);
            $hpp1 = 0;
            $hpp2 = 0;

            // Penjualan Tunai
            foreach($sales_form_tunai as $sales_tunai) {
                foreach($stok_barang_dagang as $stok_barang) {
                    if(Str::lower($sales_tunai->produk_yang_terjual) == Str::lower($stok_barang->nama_barang)) {
                        $hpp1 += $sales_tunai->jumlah_barang * $stok_barang->harga_satuan;
                    }
                }
            }
            
            // Penjualan Kredit
            foreach($sales_form_kredit as $sales_kredit) {
                foreach($stok_barang_dagang as $stok_barang) {
                    if(Str::lower($sales_kredit->produk_yang_terjual) == Str::lower($stok_barang->nama_barang)) {
                        $hpp1 += $sales_kredit->jumlah_barang * $stok_barang->harga_satuan;
                    }
                }
            }

            $harga_pokok_penjualan = $hpp1;
            // dd($hpp1);


            $gaji_karyawan = new Buku_Kas;
            $penjualan_kredit = new Sales_Form_Kredit;
            $gaji_karyawan_user_id = 0;
            $gaji_karyawan_nama_pengeluaran = '';
            $gaji_karyawan_harga_pengeluaran = 0;
            $total_pengeluaran = 0;
            $total_penjualan_kredit = 0;
            $penjualan_tunai = DB::select('select buku_kas.user_id, buku_kas.kas_id, buku_kas.nama_pemasukkan, buku_kas.tanggal, SUM(buku_kas.harga_pemasukkan) as harga_pemasukkan from buku_kas where buku_kas.user_id = ? GROUP BY buku_kas.nama_pemasukkan, buku_kas.user_id', [$user_id]);
            $penjualan_kredit = DB::select('select * from sales_form_kredit where sales_form_kredit.user_id = ?', [$user_id]);
            foreach($penjualan_kredit as $data){
                $total_penjualan_kredit += $data->total_penjualan;
            }

            $beban = DB::select('select buku_kas.user_id, buku_kas.kas_id, buku_kas.nama_pengeluaran, buku_kas.tanggal, SUM(buku_kas.harga_pengeluaran) as harga_pengeluaran from buku_kas where buku_kas.user_id = ? GROUP BY buku_kas.nama_pengeluaran, buku_kas.user_id', [$user_id]);
            foreach ($beban as $beban_usaha) {
                if($beban_usaha->nama_pengeluaran == "Gaji/bonus karyawan") {
                    $gaji_karyawan->user_id = $beban_usaha->user_id;
                    $gaji_karyawan->nama_pengeluaran = $beban_usaha->nama_pengeluaran;
                    $gaji_karyawan->harga_pengeluaran = $beban_usaha->harga_pengeluaran;
                }
                $total_pengeluaran += $beban_usaha->harga_pengeluaran;
            }

            $gaji_karyawan = (object)$gaji_karyawan->getAttributes();
            if (isset($gaji_karyawan->user_id) and isset($gaji_karyawan->nama_pengeluaran) and isset($gaji_karyawan->harga_pengeluaran)){
                $gaji_karyawan_user_id = $gaji_karyawan->user_id;
                $gaji_karyawan_nama_pengeluaran = $gaji_karyawan->nama_pengeluaran;
                $gaji_karyawan_harga_pengeluaran = $gaji_karyawan->harga_pengeluaran;
            }
            
            // dd($gaji_karyawan);
            // dd($gaji_karyawan_user_id);
            // $gaji_karyawan_harga_pengeluaran = $gaji_karyawan->harga_pengeluaran;
                
            return view('app/reports/laba-rugi', compact('harga_pokok_penjualan','penjualan_tunai','total_penjualan_kredit','penjualan_kredit', 'gaji_karyawan_user_id','gaji_karyawan_nama_pengeluaran','gaji_karyawan_harga_pengeluaran', 'user_id'));
        } 
        return redirect()->route('login')->with('loginFirst', 'Anda harus login terlebih dahulu');
    }

    // PERUBAHAN MODAL
    public function perubahan_modal()
    {
        $user_id = session()->get('user_id');
        
        // Validate if modal_awal is still empty or not, if so redirect to modal_awal page
        if (!Modal_Awal::where('user_id', $user_id)->exists())
            return redirect()->route('modal_awal')->with('emptyModalAwal', 'Pastikan Modal Awal diisikan terlebih dahulu, sebelum mengisi yang lainnya');

        if (session()->has('hasLogin')) {
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
        $user_id = session()->get('user_id');
        
        // Validate if modal_awal is still empty or not, if so redirect to modal_awal page
        if (!Modal_Awal::where('user_id', $user_id)->exists())
            return redirect()->route('modal_awal')->with('emptyModalAwal', 'Pastikan Modal Awal diisikan terlebih dahulu, sebelum mengisi yang lainnya');

        if (session()->has('hasLogin')) {
            // ASSET LANCAR DAN TETAP
            $cond1 = "Asset Lancar";
            $asset_lancar = DB::select('select asset.nomor_asset, asset.jenis_asset, asset.user_id, asset.nama_asset, SUM(asset.harga_asset) as harga_asset from asset where asset.jenis_asset = ? and asset.user_id = ? GROUP BY asset.nama_asset, asset.user_id, asset.jenis_asset', [$cond1, $user_id]);
            $cond2 = "Asset Tetap";
            $asset_tetap = DB::select('select asset.nomor_asset, asset.jenis_asset, asset.user_id, asset.nama_asset, SUM(asset.harga_asset) as harga_asset from asset where asset.jenis_asset = ? and asset.user_id = ? GROUP BY asset.nama_asset, asset.user_id, asset.jenis_asset',  [$cond2, $user_id]);

            return view('app/asset/asset', compact('asset_lancar', 'asset_tetap', 'user_id'));
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
        // Validate if there's no empty fields (nama, harga, dan jenis asset)
        $validator = Validator::make($request->all(), [
            'namaAsset' => 'required',
            'hargaAsset' => 'required',
            'jenisAsset' => 'required',
        ]);
    
        if ($validator->fails())
            return redirect()->route('asset_form')->with('emptyFields', 'Pastikan isian nama, harga, dan jenis asset tidak kosong');

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
            $user_id = session()->get('user_id');
            $asset = DB::select('select * from asset where asset.nomor_asset = ? and asset.user_id = ?', [$nomor_asset, $user_id]);
            return view('app/asset/asset_detail', compact('asset'));
        } 
        return redirect()->route('login')->with('loginFirst', 'Anda harus login terlebih dahulu');
    }

    public function asset_delete($nomor_asset) {
        $asset = Asset::find($nomor_asset);
        $asset->delete();
        return redirect('/app/asset');
    }

    // KEWAJIBAN
    public function kewajiban()
    {
        $user_id = session()->get('user_id');
        
        // Validate if modal_awal is still empty or not, if so redirect to modal_awal page
        if (!Modal_Awal::where('user_id', $user_id)->exists())
            return redirect()->route('modal_awal')->with('emptyModalAwal', 'Pastikan Modal Awal diisikan terlebih dahulu, sebelum mengisi yang lainnya');

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
        // Validate if there's no empty fields (nama, jenis, dan nominal kewajiban)
        $validator = Validator::make($request->all(), [
            'namaKewajiban' => 'required',
            'jenisKewajiban' => 'required',
            'nominal' => 'required',
        ]);
    
        if ($validator->fails())
            return redirect()->route('kewajiban_form')->with('emptyFields', 'Pastikan isian nama, jenis, dan nominal kewajiban tidak kosong');

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
            $user_id = session()->get('user_id');
            $kewajiban = DB::select('select * from kewajiban where kewajiban.nomor_kewajiban = ? kewajiban.user_id = ?', [$nomor_kewajiban, $user_id]);
            
            return view('app/kewajiban/kewajiban_detail', compact('kewajiban'));
        } 
        return redirect()->route('login')->with('loginFirst', 'Anda harus login terlebih dahulu');
    }

    public function kewajiban_delete($nomor_kewajiban) {
        // dd($nomor_kewajiban);
        $kewajiban = Kewajiban::find($nomor_kewajiban);
        $kewajiban->delete();
        return redirect('/app/kewajiban');
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

    public function modal_awal_aset_usaha()
    {
        if (session()->has('hasLogin')) {
            $nomor_asset = DB::selectOne("select getNewId('asset') as value from dual")->value;

            return view('app/modal/tambah_modal_awal_aset', compact('nomor_asset'));
        } 
        return redirect()->route('login')->with('loginFirst', 'Anda harus login terlebih dahulu');
    }

    public function modal_awal_persediaan_barang_dagang()
    {
        if (session()->has('hasLogin')) {
            $nomor_transaksi = DB::selectOne("select getNewId('purchase_form_tunai') as value from dual")->value;

            return view('app/modal/tambah_modal_awal_persediaan', compact('nomor_transaksi'));
        } 
        return redirect()->route('login')->with('loginFirst', 'Anda harus login terlebih dahulu');
    }

    public function modal_awal_aset_form_post(Request $request)
    {
        // Validate if there's no empty fields (nama, harga, dan jenis asset)
        $validator = Validator::make($request->all(), [
            'namaAsset' => 'required',
            'hargaAsset' => 'required',
            'jenisAsset' => 'required',
        ]);
    
        if ($validator->fails())
            return redirect()->route('modal_awal_aset_usaha')->with('emptyFields', 'Pastikan isian nama, harga, dan jenis asset tidak kosong');


        $user_id = session()->get('user_id');

        // Asset
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


        // MODAL AWAL
        $modal_awal = new Modal_Awal();
        $modal_awal->user_id = session()->get('user_id');
        $modal_awal->modal_awal_id = DB::selectOne("select getNewId('modal_awal') as value from dual")->value;
        $modal_awal->nama_modal = $request->namaAsset;
        $modal_awal->jenis_modal = "Aset Usaha";
        $modal_awal->harga_modal = (int)($asset->harga_asset);

        $modal_awal->save();

        return redirect()->route('modal_awal')->with('successAddModal', 'Pemasukan Modal Sukses!');
    }

    public function modal_awal_persediaan_form_post(Request $request)
    {
        // Validate if there's no empty fields (tanggal, produk yang dibeli, jumlah barang, harga satuan)
        $validator = Validator::make($request->all(), [
            'tanggalTransaksi' => 'required',
            'produkYangDibeli' => 'required',
            'jumlahBarang' => 'required',
            'hargaSatuan' => 'required',
        ]);
    
        if ($validator->fails())
            return redirect()->route('modal_awal_persediaan_barang_dagang')->with('emptyFields', 'Pastikan isian tanggal, produk yang dibeli, jumlah barang, harga satuan tidak kosong');


        $user_id = session()->get('user_id');

        // Purchase Form Tunai
        $purchase_form_tunai = new Purchase_Form_Tunai();
        $purchase_form_tunai->user_id = session()->get('user_id');
        $purchase_form_tunai->nomor_transaksi = DB::selectOne("select getNewId('purchase_form_tunai') as value from dual")->value;
        $purchase_form_tunai->tanggal_transaksi = $request->tanggalTransaksi;
        $purchase_form_tunai->metode_pembayaran = $request->metodePembayaran;
        $purchase_form_tunai->diskon_pembelian = $request->diskonPembelian;
        $purchase_form_tunai->produk_yang_dibeli = Str::lower($request->produkYangDibeli);
        $purchase_form_tunai->pajak = $request->pajak;

            // JUMLAH BARANG
        $satuanBarang = $request->satuanBarang;
        $purchase_form_tunai->jumlah_barang = $satuanBarang * $request->jumlahBarang;

            // HARGA SATUAN
        $purchase_form_tunai->harga_satuan = $request->hargaSatuan;
        $purchase_form_tunai->harga_satuan = Str::replace('.','',$purchase_form_tunai->harga_satuan);
        $purchase_form_tunai->harga_satuan = Str::replace('Rp ','',$purchase_form_tunai->harga_satuan);
        $purchase_form_tunai->harga_satuan = (int)($purchase_form_tunai->harga_satuan);

        // HARGA TOTAL
        $persentaseDiskon = $request->diskonPembelian / 100 * ($purchase_form_tunai->jumlah_barang * $purchase_form_tunai->harga_satuan);
        $persentasePajak = $request->pajak * $persentaseDiskon / 100;
        $purchase_form_tunai->total_pembelian = (($purchase_form_tunai->jumlah_barang * $purchase_form_tunai->harga_satuan) - $persentaseDiskon) + $persentasePajak;

        // $purchase_form_tunai->save();

        // ASSET LANCAR
        $asset = new Asset();
        $asset->user_id = session()->get('user_id');
        $asset->nomor_asset = DB::selectOne("select getNewId('asset') as value from dual")->value;
        $asset->nama_asset = "Persediaan barang dagang";
        $asset->jenis_asset = "Asset Lancar";
        $asset->harga_asset = (($purchase_form_tunai->jumlah_barang * $purchase_form_tunai->harga_satuan) - $persentaseDiskon) + $persentasePajak;
        $asset->save();


        // STOK BARANG
        $lower_produkYangDibeli = Str::lower($request->produkYangDibeli);
        $barang_yang_sama = DB::select('select * from stok_barang where stok_barang.nama_barang = ? and stok_barang.user_id = ?', [$lower_produkYangDibeli, $user_id]);
        
        if($barang_yang_sama) { // TAMBAH STOK
            $barang_yang_sama = Stok_Barang::find($barang_yang_sama[0]->stok_id);
            $barang_yang_sama->jumlah_stok += $satuanBarang * $request->jumlahBarang;
            $barang_yang_sama->total_harga += (($purchase_form_tunai->jumlah_barang * $purchase_form_tunai->harga_satuan) - $persentaseDiskon) + $persentasePajak;
            $barang_yang_sama->update();
        } else { // Tambah Barang Baru
            $stok_barang = new Stok_Barang();
            $stok_barang->user_id = session()->get('user_id');
            $stok_barang->stok_id = DB::selectOne("select getNewId('stok_barang') as value from dual")->value;
            $stok_barang->kode_barang = generateRandomString(6);
            $stok_barang->nama_barang = Str::lower($request->produkYangDibeli);
            $stok_barang->jumlah_stok = $satuanBarang * $request->jumlahBarang;
            $stok_barang->harga_satuan = $purchase_form_tunai->harga_satuan;
            $stok_barang->total_harga = (($purchase_form_tunai->jumlah_barang * $purchase_form_tunai->harga_satuan) - $persentaseDiskon) + $persentasePajak;
            $stok_barang->save();
        }


        // BUKU KAS
        $buku_kas = new Buku_Kas();
        $buku_kas->user_id = session()->get('user_id');
        $buku_kas->kas_id = DB::selectOne("select getNewId('buku_kas') as value from dual")->value;
        $buku_kas->nama_pengeluaran = "Persediaan barang dagang";
        $buku_kas->harga_pengeluaran = (($purchase_form_tunai->jumlah_barang * $purchase_form_tunai->harga_satuan) - $persentaseDiskon) + $persentasePajak;
        $buku_kas->tanggal = $request->tanggalTransaksi;

        $buku_kas->save();


        // MODAL
        $modal = new Modal();
        $modal->user_id = session()->get('user_id');
        $modal->modal_id = DB::selectOne("select getNewId('modal') as value from dual")->value;
        $modal->nama_modal = Str::lower($request->produkYangDibeli);
        $modal->harga_modal = (($purchase_form_tunai->jumlah_barang * $purchase_form_tunai->harga_satuan) - $persentaseDiskon) + $persentasePajak;
        $modal->save();


        // MODAL AWAL
        $modal_awal = new Modal_Awal();
        $modal_awal->user_id = session()->get('user_id');
        $modal_awal->modal_awal_id = DB::selectOne("select getNewId('modal_awal') as value from dual")->value;
        $modal_awal->nama_modal = Str::lower($request->produkYangDibeli);
        $modal_awal->jenis_modal = "Persediaan barang dagang";
        $modal_awal->harga_satuan = $purchase_form_tunai->harga_satuan;
        $modal_awal->harga_modal = (($purchase_form_tunai->jumlah_barang * $purchase_form_tunai->harga_satuan) - $persentaseDiskon) + $persentasePajak;

        $modal_awal->save();

        return redirect()->route('modal_awal')->with('successAddModal', 'Pemasukan Modal Sukses!');
    }

    public function modal_awal_delete($modal_awal_id) {
        // dd($modal_awal_id);
        $modal_awal = Modal_Awal::find($modal_awal_id);
        $modal_awal->delete();
        return redirect('/app/modal_awal');
    }

    public function modal_awal_detail($modal_awal_id)
    {
        if (session()->has('hasLogin')) {
            $user_id = session()->get('user_id');
            $modal_awal = DB::select('select * from modal_awal where modal_awal.modal_awal_id = ? and modal_awal.user_id = ?', [$modal_awal_id, $user_id]);

            return view('app/modal/modal_awal_detail', compact('modal_awal', 'user_id'));
        } 
        return redirect()->route('login')->with('loginFirst', 'Anda harus login terlebih dahulu');
    }

    // MODAL
    public function modal()
    {
        $user_id = session()->get('user_id');
        
        // Validate if modal_awal is still empty or not, if so redirect to modal_awal page
        if (!Modal_Awal::where('user_id', $user_id)->exists())
            return redirect()->route('modal_awal')->with('emptyModalAwal', 'Pastikan Modal Awal diisikan terlebih dahulu, sebelum mengisi yang lainnya');

        if (session()->has('hasLogin')) {
            // DATA MODAL
            $modal = DB::table('modal')->get();

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
        // Validate if there's no empty fields (nama dan harga modal)
        $validator = Validator::make($request->all(), [
            'namaModal' => 'required',
            'hargaModal' => 'required',
        ]);
    
        if ($validator->fails())
            return redirect()->route('tambah_modal')->with('emptyFields', 'Pastikan isian nama dan harga modal tidak kosong');


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
            $user_id = session()->get('user_id');
            $modal = DB::select('select * from modal where modal.modal_id = ? and modal.user_id = ?', [$modal_id, $user_id]);

            return view('app/modal/modal_detail', compact('modal'));
        } 
        return redirect()->route('login')->with('loginFirst', 'Anda harus login terlebih dahulu');
    }

    public function modal_delete($modal_id) {
        // dd($modal_id);
        $modal = Modal::find($modal_id);
        $modal->delete();
        return redirect('/app/modal');
    }

    // BEBAN USAHA
    public function beban_usaha()
    {
        $user_id = session()->get('user_id');
        
        // Validate if modal_awal is still empty or not, if so redirect to modal_awal page
        if (!Modal_Awal::where('user_id', $user_id)->exists())
            return redirect()->route('modal_awal')->with('emptyModalAwal', 'Pastikan Modal Awal diisikan terlebih dahulu, sebelum mengisi yang lainnya');

        if (session()->has('hasLogin')) {
            $beban_usaha = DB::table('beban_usaha')->get();

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
        // Validate if there's no empty fields (nama dan harga beban usaha)
        $validator = Validator::make($request->all(), [
            'namaBebanUsaha' => 'required',
            'hargaBebanUsaha' => 'required',
        ]);
    
        if ($validator->fails())
            return redirect()->route('beban_usaha_form')->with('emptyFields', 'Pastikan isian nama dan harga beban usaha tidak kosong');

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
            $user_id = session()->get('user_id');
            $beban_usaha = DB::select('select * from beban_usaha where beban_usaha.beban_usaha_id = ? and beban_usaha.user_id = ?', [$beban_usaha_id, $user_id]);
            
            return view('app/beban_usaha/beban_usaha_detail', compact('beban_usaha'));
        } 
        return redirect()->route('login')->with('loginFirst', 'Anda harus login terlebih dahulu');
    }

    // ASSET TETAP
    public function asset_tetap()
    {
        $user_id = session()->get('user_id');
        
        // Validate if modal_awal is still empty or not, if so redirect to modal_awal page
        if (!Modal_Awal::where('user_id', $user_id)->exists())
            return redirect()->route('modal_awal')->with('emptyModalAwal', 'Pastikan Modal Awal diisikan terlebih dahulu, sebelum mengisi yang lainnya');

        if (session()->has('hasLogin')) {
            return view('app/asset_tetap/asset_tetap');
        } 
        return redirect()->route('login')->with('loginFirst', 'Anda harus login terlebih dahulu');
    }

    // STOK BARANG
    public function stok_barang()
    {
        $user_id = session()->get('user_id');
        
        // Validate if modal_awal is still empty or not, if so redirect to modal_awal page
        if (!Modal_Awal::where('user_id', $user_id)->exists())
            return redirect()->route('modal_awal')->with('emptyModalAwal', 'Pastikan Modal Awal diisikan terlebih dahulu, sebelum mengisi yang lainnya');

        if (session()->has('hasLogin')) {
            $stok_barang = DB::table('stok_barang')->get();

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
        // Validate if there's no empty fields (nama barang, harga satuan, dan jumlah stok)
        $validator = Validator::make($request->all(), [
            'namaBarang' => 'required',
            'hargaSatuan' => 'required',
            'jumlahStok' => 'required',
        ]);
    
        if ($validator->fails())
            return redirect()->route('stok_barang_form')->with('emptyFields', 'Pastikan isian nama barang, harga satuan, dan jumlah stok tidak kosong');


        $user_id = session()->get('user_id');

        $stok_barang = new Stok_Barang();
        $stok_barang->user_id = $user_id;
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
            $user_id = session()->get('user_id');
            $stok_barang = DB::select('select * from stok_barang where stok_barang.stok_id = ? and stok_barang.user_id = ?', [$stok_id, $user_id]);
            
            return view('app/stok_barang/stok_barang_detail', compact('stok_barang'));
        } 
        return redirect()->route('login')->with('loginFirst', 'Anda harus login terlebih dahulu');
    }

    public function stok_barang_delete($stok_id) {
        $stok_barang = Stok_Barang::find($stok_id);
        $stok_barang->delete();
        return redirect('/app/stok_barang');
    }
}