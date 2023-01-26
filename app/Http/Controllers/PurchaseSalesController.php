<?php

namespace App\Http\Controllers;

use App\Models\Users;
use App\Models\Purchase_Form_Tunai;
use App\Models\Purchase_Form_Kredit;
use App\Models\Sales_Form_Tunai;
use App\Models\Sales_Form_Kredit;
use App\Models\Buku_Kas;
use App\Models\Asset;
use App\Models\Modal;
use App\Models\Buku_Utang_Form_Utang;
use App\Models\Buku_Utang_Form_Piutang;
use App\Models\Stok_Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class PurchaseSalesController extends Controller
{
    ////////////////////////////////////////////////////////////
    // PENJUALAN

    // PURCHASE
    public function purchase()
    {
        if (session()->has('hasLogin')) {
            $user_id = session()->get('user_id');
            $purchase_form_tunai = DB::table('purchase_form_tunai')->get();
            $purchase_form_kredit = DB::table('purchase_form_kredit')->get();

            return view('app/purchase/purchase', compact('purchase_form_tunai', 'purchase_form_kredit', 'user_id'));
        } 
        return redirect()->route('login')->with('loginFirst', 'Anda harus login terlebih dahulu');
    }

    public function purchase_form_tunai()
    {
        if (session()->has('hasLogin')) {
            $nomor_transaksi = DB::selectOne("select getNewId('purchase_form_tunai') as value from dual")->value;
            return view('app/purchase/purchase_form_tunai', compact('nomor_transaksi'));
        } 
        return redirect()->route('login')->with('loginFirst', 'Anda harus login terlebih dahulu');
    }

    public function purchase_form_tunai_post(Request $request)
    {
        $user_id = session()->get('user_id');
        // $test = DB::selectOne("select getNewId('purchase_form_tunai') as value from dual")->value;
        // dd($test);

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

        $purchase_form_tunai->save();


        // MODAL
        // $modal = new Modal();
        // $modal->user_id = session()->get('user_id');
        // $modal->modal_id = DB::selectOne("select getNewId('modal') as value from dual")->value;
        // $modal->nama_modal = "Persediaan barang dagang";
        // $modal->harga_modal = (($request->jumlahBarang * $purchase_form_tunai->harga_satuan) - $persentaseDiskon) + $persentasePajak;
        // $modal->save();


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
        // $barang_yang_sama = Stok_Barang::select('*')->where('user_id' , '=', $user_id)->where('nama_barang' , '=', $lower_produkYangDibeli)->get();
        // $barang_yang_sama = $barang_yang_sama[0];
        $barang_yang_sama = DB::select('select * from stok_barang where stok_barang.nama_barang = ? and stok_barang.user_id = ?', [$lower_produkYangDibeli, $user_id]);
        // dd($barang_yang_sama);
        
        if($barang_yang_sama) { // TAMBAH STOK
            $barang_yang_sama = Stok_Barang::find($barang_yang_sama[0]->stok_id);
            // dd($barang_yang_sama);
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

        // UBAH UANG KAS DI ASET LANCAR
        $kas_temp = "Kas";
        $kas = DB::select('select * from asset where asset.nama_asset = ? and asset.user_id = ?', [$kas_temp, $user_id]);
        if($kas) {
            $kas = Asset::find($kas[0]->nomor_asset);
            $kas->harga_asset -= (($purchase_form_tunai->jumlah_barang * $purchase_form_tunai->harga_satuan) - $persentaseDiskon) + $persentasePajak;
            $kas->update();
            // dd($kas);
        }

        return redirect()->route('purchase')->with('successPurchaseFormTunai', 'Pemasukan Pembayaran Secara Tunai Sukses!');
    }

    public function purchase_tunai_detail($nomor_transaksi)
    {
        if (session()->has('hasLogin')) {
            $user_id = session()->get('user_id');
            $purchase_form_tunai = DB::select('select * from purchase_form_tunai where purchase_form_tunai.nomor_transaksi = ? and purchase_form_tunai.user_id = ?', [$nomor_transaksi, $user_id]);
            return view('app/purchase/purchase_tunai_detail', compact('purchase_form_tunai'));
        } 
        return redirect()->route('login')->with('loginFirst', 'Anda harus login terlebih dahulu');
    }

    public function purchase_form_kredit_post(Request $request)
    {
        $user_id = session()->get('user_id');
        // dd($request->metodePembayaran);
        // dd($request->umurUtang);

        // Purchase Form Kredit
        $purchase_form_kredit = new Purchase_Form_Kredit();
        $purchase_form_kredit->user_id = session()->get('user_id');
        $purchase_form_kredit->nomor_transaksi = DB::selectOne("select getNewId('purchase_form_kredit') as value from dual")->value;
        $purchase_form_kredit->tanggal_transaksi = $request->tanggalTransaksi;
        $purchase_form_kredit->metode_pembayaran = $request->metodePembayaran;
        $purchase_form_kredit->umur_utang = $request->umurUtang;
            
            // PENAMBAHAN TANGGAL DARI UMUR UTANG 
        $days_add = (int)$request->umurUtang;
        $tanggalTransaksi = Carbon::createFromFormat('Y-m-d', $request->tanggalTransaksi);
        $batasPembayaranUtang = $tanggalTransaksi->addDays($days_add);
        $purchase_form_kredit->batas_pembayaran_utang = $batasPembayaranUtang;

        $purchase_form_kredit->diskon_pembelian = $request->diskonPembelian;
        $purchase_form_kredit->produk_yang_dibeli = $request->produkYangDibeli;
        $purchase_form_kredit->pajak = $request->pajak;
        $purchase_form_kredit->nama_supplier = $request->namaSupplier;

            // JUMLAH BARANG
        $satuanBarang = $request->satuanBarang;
        $purchase_form_kredit->jumlah_barang = $satuanBarang * $request->jumlahBarang;

            // DENDA KETERLAMBATAN
        $purchase_form_kredit->denda_keterlambatan = $request->dendaKeterlambatan;
        $purchase_form_kredit->denda_keterlambatan = Str::replace('.','',$purchase_form_kredit->denda_keterlambatan);
        $purchase_form_kredit->denda_keterlambatan = Str::replace('Rp ','',$purchase_form_kredit->denda_keterlambatan);
        $purchase_form_kredit->denda_keterlambatan = (int)($purchase_form_kredit->denda_keterlambatan);

            // HARGA SATUAN
        $purchase_form_kredit->harga_satuan = $request->hargaSatuan;
        $purchase_form_kredit->harga_satuan = Str::replace('.','',$purchase_form_kredit->harga_satuan);
        $purchase_form_kredit->harga_satuan = Str::replace('Rp ','',$purchase_form_kredit->harga_satuan);
        $purchase_form_kredit->harga_satuan = (int)($purchase_form_kredit->harga_satuan);

        // HARGA TOTAL
        $persentaseDiskon = $request->diskonPembelian / 100 * ($purchase_form_kredit->jumlah_barang * $purchase_form_kredit->harga_satuan);
        $persentasePajak = $request->pajak * $persentaseDiskon / 100;
        $purchase_form_kredit->total_pembelian = (($purchase_form_kredit->jumlah_barang * $purchase_form_kredit->harga_satuan) - $persentaseDiskon) + $persentasePajak;

        $purchase_form_kredit->save();


        // BUKU UTANG
        $buku_utang_form_utang = new Buku_Utang_Form_Utang();
        $buku_utang_form_utang->user_id = session()->get('user_id');
        $buku_utang_form_utang->nomor_utang = DB::selectOne("select getNewId('buku_utang_form_utang') as value from dual")->value;
        $buku_utang_form_utang->nama = "Persediaan barang dagang";
        $buku_utang_form_utang->nama_supplier = $request->namaSupplier;
        $buku_utang_form_utang->tanggal = $request->tanggalTransaksi;;
        $buku_utang_form_utang->jumlah_utang = (($purchase_form_kredit->jumlah_barang * $purchase_form_kredit->harga_satuan) - $persentaseDiskon) + $persentasePajak;
        $buku_utang_form_utang->save();


        // ASSET LANCAR
        $asset = new Asset();
        $asset->user_id = session()->get('user_id');
        $asset->nomor_asset = DB::selectOne("select getNewId('asset') as value from dual")->value;
        $asset->nama_asset = "Persediaan barang dagang";
        $asset->jenis_asset = "Asset Lancar";
        $asset->harga_asset = (($purchase_form_kredit->jumlah_barang * $purchase_form_kredit->harga_satuan) - $persentaseDiskon) + $persentasePajak;
        $asset->save();


        // STOK BARANG
        $lower_produkYangDibeli = Str::lower($request->produkYangDibeli);
        $barang_yang_sama = DB::select('select * from stok_barang where stok_barang.nama_barang = ? and stok_barang.user_id = ?', [$lower_produkYangDibeli, $user_id]);
        // dd($barang_yang_sama);
        
        if($barang_yang_sama) { // TAMBAH STOK
            $barang_yang_sama = Stok_Barang::find($barang_yang_sama[0]->stok_id);
            // dd($barang_yang_sama);
            $barang_yang_sama->jumlah_stok += $satuanBarang * $request->jumlahBarang;
            $barang_yang_sama->total_harga += (($purchase_form_kredit->jumlah_barang * $purchase_form_kredit->harga_satuan) - $persentaseDiskon) + $persentasePajak;
            $barang_yang_sama->update();
        } else { // Tambah Barang Baru
            $stok_barang = new Stok_Barang();
            // dd($stok_barang);
            $stok_barang->user_id = session()->get('user_id');
            $stok_barang->stok_id = DB::selectOne("select getNewId('stok_barang') as value from dual")->value;
            $stok_barang->kode_barang = generateRandomString(6);
            $stok_barang->nama_barang = Str::lower($request->produkYangDibeli);
            $stok_barang->jumlah_stok = $satuanBarang * $request->jumlahBarang;
            $stok_barang->harga_satuan = $purchase_form_kredit->harga_satuan;
            $stok_barang->total_harga = (($purchase_form_kredit->jumlah_barang * $purchase_form_kredit->harga_satuan) - $persentaseDiskon) + $persentasePajak;
            $stok_barang->save();
        }

        // BUKU KAS
        $buku_kas = new Buku_Kas();
        $buku_kas->user_id = session()->get('user_id');
        $buku_kas->kas_id = DB::selectOne("select getNewId('buku_kas') as value from dual")->value;
        $buku_kas->nama_pengeluaran = "Persediaan barang dagang";
        $buku_kas->harga_pengeluaran = (($purchase_form_kredit->jumlah_barang * $purchase_form_kredit->harga_satuan) - $persentaseDiskon) + $persentasePajak;
        $buku_kas->tanggal = $request->tanggalTransaksi;

        $buku_kas->save();

        return redirect()->route('purchase')->with('successPurchaseFormKredit', 'Pemasukan Pembayaran Secara Kredit Sukses!');
    }

    public function purchase_form_kredit()
    {
        if (session()->has('hasLogin')) {
            $nomor_transaksi = DB::selectOne("select getNewId('purchase_form_kredit') as value from dual")->value;
            $supplier = DB::table('supplier')->get();
            $user_id = session()->get('user_id');

            return view('app/purchase/purchase_form_kredit', compact('nomor_transaksi', 'supplier', 'user_id'));
        } 
        return redirect()->route('login')->with('loginFirst', 'Anda harus login terlebih dahulu');
    }

    public function purchase_kredit_detail($nomor_transaksi)
    {
        if (session()->has('hasLogin')) {
            $user_id = session()->get('user_id');
            $purchase_form_kredit = DB::select('select * from purchase_form_kredit where purchase_form_kredit.nomor_transaksi = ? and purchase_form_kredit.user_id = ?', [$nomor_transaksi, $user_id]);

            return view('app/purchase/purchase_kredit_detail', compact('purchase_form_kredit'));
        } 
        return redirect()->route('login')->with('loginFirst', 'Anda harus login terlebih dahulu');
    }

    public function purchase_tunai_delete($nomor_transaksi) {
        // dd($nomor_transaksi);
        $purchase_tunai = Purchase_Form_Tunai::find($nomor_transaksi);
        $purchase_tunai->delete();
        return redirect('/app/purchase');
    }

    public function purchase_kredit_delete($nomor_transaksi) {
        // dd($nomor_transaksi);
        $purchase_kredit = Purchase_Form_Kredit::find($nomor_transaksi);
        $purchase_kredit->delete();
        return redirect('/app/purchase');
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    // SALES
    public function sales()
    {
        if (session()->has('hasLogin')) {
            $user_id = session()->get('user_id');
            $sales_form_tunai = DB::table('sales_form_tunai')->get();
            $sales_form_kredit = DB::table('sales_form_kredit')->get();

            return view('app/sales/sales', compact('sales_form_tunai', 'sales_form_kredit', 'user_id'));
        } 
        return redirect()->route('login')->with('loginFirst', 'Anda harus login terlebih dahulu');
    }

    public function sales_form_tunai()
    {
        if (session()->has('hasLogin')) {
            $nomor_transaksi = DB::selectOne("select getNewId('sales_form_tunai') as value from dual")->value;
            return view('app/sales/sales_form_tunai', compact('nomor_transaksi'));
        } 
        return redirect()->route('login')->with('loginFirst', 'Anda harus login terlebih dahulu');
    }

    public function sales_form_tunai_post(Request $request)
    {
        $user_id = session()->get('user_id');
        // $test = DB::selectOne("select getNewId('sales_form_tunai') as value from dual")->value;
        // dd($test);

        // Sales Form Tunai
        $sales_form_tunai = new Sales_Form_Tunai();
        $sales_form_tunai->user_id = session()->get('user_id');
        $sales_form_tunai->nomor_transaksi = DB::selectOne("select getNewId('sales_form_tunai') as value from dual")->value;
        $sales_form_tunai->tanggal_transaksi = $request->tanggalTransaksi;
        $sales_form_tunai->metode_pembayaran = $request->metodePembayaran;
        $sales_form_tunai->diskon_penjualan = $request->diskonPenjualan;
        $sales_form_tunai->produk_yang_terjual = $request->produkYangTerjual;
        $sales_form_tunai->pajak = $request->pajak;

            // JUMLAH BARANG
        $satuanBarang = $request->satuanBarang;
        $sales_form_tunai->jumlah_barang = $satuanBarang * $request->jumlahBarang;
        
            // HARGA SATUAN
        $sales_form_tunai->harga_satuan = $request->hargaSatuan;
        $sales_form_tunai->harga_satuan = Str::replace('.','',$sales_form_tunai->harga_satuan);
        $sales_form_tunai->harga_satuan = Str::replace('Rp ','',$sales_form_tunai->harga_satuan);
        $sales_form_tunai->harga_satuan = (int)($sales_form_tunai->harga_satuan);
        
        // HARGA TOTAL
        $persentaseDiskon = $request->diskonPenjualan / 100 * ($sales_form_tunai->jumlah_barang * $sales_form_tunai->harga_satuan);
        $persentasePajak = $request->pajak * $persentaseDiskon / 100;
        $sales_form_tunai->total_penjualan = (($sales_form_tunai->jumlah_barang * $sales_form_tunai->harga_satuan) - $persentaseDiskon) + $persentasePajak;

        $sales_form_tunai->save();


        // ASSET LANCAR
        $asset = new Asset();
        $asset->user_id = session()->get('user_id');
        $asset->nomor_asset = DB::selectOne("select getNewId('asset') as value from dual")->value;
        $asset->nama_asset = "Persediaan barang dagang";
        $asset->jenis_asset = "Asset Lancar";

            // PENGURANGAN KE PERSEDIAAN BARANG DAGANG DARI HPP NYA
            // HARGA PEMBELIAN DI MODAL AWAL DIKALI JUMLAH PENJUALAN
        $harga_satuan_pembelian = DB::select('select harga_satuan from modal_awal where modal_awal.nama_modal = ? and modal_awal.user_id = ?', [Str::lower($request->produkYangTerjual), $user_id] );
        $hpp = $sales_form_tunai->jumlah_barang * $harga_satuan_pembelian[0]->harga_satuan;

        $asset->harga_asset = -$hpp;
        $asset->save();


        // STOK BARANG
        $lower_produkYangTerjual = Str::lower($request->produkYangTerjual);
        $barang_yang_sama = DB::select('select * from stok_barang where stok_barang.nama_barang = ? and stok_barang.user_id = ?', [$lower_produkYangTerjual, $user_id]);
        // dd($barang_yang_sama);
        
        if($barang_yang_sama) { // TAMBAH STOK
            $barang_yang_sama = Stok_Barang::find($barang_yang_sama[0]->stok_id);
            // dd($barang_yang_sama);
            $barang_yang_sama->jumlah_stok -= $satuanBarang * $request->jumlahBarang;
            $barang_yang_sama->total_harga -= (($sales_form_tunai->jumlah_barang * $sales_form_tunai->harga_satuan) - $persentaseDiskon) + $persentasePajak;
            $barang_yang_sama->update();
        } else { // Tambah Barang Baru
            return redirect('/app/sales')->with('salesBelumDitambahkan', 'Barang Terjual yang diisikan belum ada di Stok Barang!');
        }


        // MODAL
        // $modal = new Modal();
        // $modal->user_id = session()->get('user_id');
        // $modal->modal_id = DB::selectOne("select getNewId('modal') as value from dual")->value;
        // $modal->nama_modal = "Persediaan barang dagang";
        // $modal->harga_modal = (($sales_form_tunai->jumlah_barang* $sales_form_tunai->harga_satuan) - $persentaseDiskon) + $persentasePajak;
        // $modal->save();


        // BUKU KAS
        $buku_kas = new Buku_Kas();
        $buku_kas->user_id = session()->get('user_id');
        $buku_kas->kas_id = DB::selectOne("select getNewId('buku_kas') as value from dual")->value;
        $buku_kas->nama_pemasukkan = "Penjualan Tunai";
        $buku_kas->harga_pemasukkan = (($sales_form_tunai->jumlah_barang * $sales_form_tunai->harga_satuan) - $persentaseDiskon) + $persentasePajak;
        $buku_kas->tanggal = $request->tanggalTransaksi;

        $buku_kas->save();


        // UBAH UANG KAS DI ASET LANCAR
        $kas_temp = "Kas";
        $kas = DB::select('select * from asset where asset.nama_asset = ? and asset.user_id = ?', [$kas_temp, $user_id]);
        $kas = Asset::find($kas[0]->nomor_asset);
        $kas->harga_asset += (($sales_form_tunai->jumlah_barang * $sales_form_tunai->harga_satuan) - $persentaseDiskon) + $persentasePajak;
        $kas->update();
        // dd($kas);


        return redirect()->route('sales')->with('successSalesFormTunai', 'Pemasukan Pembayaran Secara Tunai Sukses!');
    }

    public function sales_tunai_detail($nomor_transaksi)
    {
        if (session()->has('hasLogin')) {
            $user_id = session()->get('user_id');
            $sales_form_tunai = DB::select('select * from sales_form_tunai where sales_form_tunai.nomor_transaksi = ? and sales_form_tunai.user_id = ?', [$nomor_transaksi, $user_id]);
            return view('app/sales/sales_tunai_detail', compact('sales_form_tunai'));
        } 
        return redirect()->route('login')->with('loginFirst', 'Anda harus login terlebih dahulu');
    }

    public function sales_form_kredit_post(Request $request)
    {
        $user_id = session()->get('user_id');
        // dd($request->metodePembayaran);
        // dd($request->umurUtang);

        // Sales Form Kredit
        $sales_form_kredit = new Sales_Form_Kredit();
        $sales_form_kredit->user_id = session()->get('user_id');
        $sales_form_kredit->nomor_transaksi = DB::selectOne("select getNewId('sales_form_kredit') as value from dual")->value;
        $sales_form_kredit->tanggal_transaksi = $request->tanggalTransaksi;
        $sales_form_kredit->metode_pembayaran = $request->metodePembayaran;
        $sales_form_kredit->umur_utang = $request->umurUtang;

        // PENAMBAHAN TANGGAL DARI UMUR UTANG 
        $days_add = (int)$request->umurUtang;
        $tanggalTransaksi = Carbon::createFromFormat('Y-m-d', $request->tanggalTransaksi);
        $batasPembayaranUtang = $tanggalTransaksi->addDays($days_add);
        $sales_form_kredit->batas_pembayaran_utang = $batasPembayaranUtang;

            // DENDA KETERLAMBATAN
        $sales_form_kredit->denda_keterlambatan = $request->dendaKeterlambatan;
        $sales_form_kredit->denda_keterlambatan = Str::replace('.','',$sales_form_kredit->denda_keterlambatan);
        $sales_form_kredit->denda_keterlambatan = Str::replace('Rp ','',$sales_form_kredit->denda_keterlambatan);
        $sales_form_kredit->denda_keterlambatan = (int)($sales_form_kredit->denda_keterlambatan);

            // HARGA SATUAN
        $sales_form_kredit->harga_satuan = $request->hargaSatuan;
        $sales_form_kredit->harga_satuan = Str::replace('.','',$sales_form_kredit->harga_satuan);
        $sales_form_kredit->harga_satuan = Str::replace('Rp ','',$sales_form_kredit->harga_satuan);
        $sales_form_kredit->harga_satuan = (int)($sales_form_kredit->harga_satuan);

        $sales_form_kredit->diskon_penjualan = $request->diskonPenjualan;
        $sales_form_kredit->produk_yang_terjual = $request->produkYangTerjual;
        $sales_form_kredit->nama_kreditur = $request->namaKreditur;
        $sales_form_kredit->pajak = $request->pajak;

            // JUMLAH BARANG
        $satuanBarang = $request->satuanBarang;
        $sales_form_kredit->jumlah_barang = $satuanBarang * $request->jumlahBarang;

        // HARGA TOTAL
        $persentaseDiskon = $request->diskonPenjualan / 100 * ($sales_form_kredit->jumlah_barang * $sales_form_kredit->harga_satuan);
        $persentasePajak = $request->pajak * $persentaseDiskon / 100;
        $sales_form_kredit->total_penjualan = (($sales_form_kredit->jumlah_barang * $sales_form_kredit->harga_satuan) - $persentaseDiskon) + $persentasePajak;

        $sales_form_kredit->save();


        // ASSET LANCAR UNTUK PIUTANG
        $asset = new Asset();
        $asset->user_id = session()->get('user_id');
        $asset->nomor_asset = DB::selectOne("select getNewId('asset') as value from dual")->value;
        $asset->nama_asset = "Piutang";
        $asset->jenis_asset = "Asset Lancar";
        $asset->harga_asset = ((($sales_form_kredit->jumlah_barang * $sales_form_kredit->harga_satuan) - $persentaseDiskon) + $persentasePajak);
        // dd($asset->harga_asset);
        $asset->save();


        // ASSET LANCAR UNTUK PERSEDIAAN BARANG DAGANG
        $asset = new Asset();
        $asset->user_id = session()->get('user_id');
        $asset->nomor_asset = DB::selectOne("select getNewId('asset') as value from dual")->value;
        $asset->nama_asset = "Persediaan barang dagang";
        $asset->jenis_asset = "Asset Lancar";

            // PENGURANGAN KE PERSEDIAAN BARANG DAGANG DARI HPP NYA
            // HARGA PEMBELIAN DI MODAL AWAL DIKALI JUMLAH PENJUALAN
        $harga_satuan_pembelian = DB::select('select harga_satuan from modal_awal where modal_awal.nama_modal = ? and modal_awal.user_id = ?', [Str::lower($request->produkYangTerjual), $user_id] );
        $hpp = $sales_form_kredit->jumlah_barang * $harga_satuan_pembelian[0]->harga_satuan;

        $asset->harga_asset = -$hpp;
        $asset->save();


        // BUKU PIUTANG
        $buku_utang_form_piutang = new Buku_Utang_Form_Piutang();
        $buku_utang_form_piutang->user_id = session()->get('user_id');
        $buku_utang_form_piutang->nomor_piutang = DB::selectOne("select getNewId('buku_utang_form_piutang') as value from dual")->value;
        $buku_utang_form_piutang->nama = "Penjualan Kredit";
        $buku_utang_form_piutang->nama_kreditur = $request->namaKreditur;
        $buku_utang_form_piutang->tanggal = $request->tanggalTransaksi;
        $buku_utang_form_piutang->jumlah_piutang = (($sales_form_kredit->jumlah_barang * $sales_form_kredit->harga_satuan) - $persentaseDiskon) + $persentasePajak;
        $buku_utang_form_piutang->save();


        // STOK BARANG
        $lower_produkYangTerjual = Str::lower($request->produkYangTerjual);
        $barang_yang_sama = DB::select('select * from stok_barang where stok_barang.nama_barang = ? and stok_barang.user_id = ?', [$lower_produkYangTerjual, $user_id]);
        // dd($barang_yang_sama);
        
        if($barang_yang_sama) { // TAMBAH STOK
            $barang_yang_sama = Stok_Barang::find($barang_yang_sama[0]->stok_id);
            // dd($barang_yang_sama);
            $barang_yang_sama->jumlah_stok -= $satuanBarang * $request->jumlahBarang;
            $barang_yang_sama->total_harga -= (($sales_form_kredit->jumlah_barang * $sales_form_kredit->harga_satuan) - $persentaseDiskon) + $persentasePajak;
            $barang_yang_sama->update();
        } else { // Tambah Barang Baru
            return redirect('/app/sales')->with('salesBelumDitambahkan', 'Barang Terjual yang diisikan belum ada di Stok Barang!');
        }


        // BUKU KAS
        // $buku_kas = new Buku_Kas();
        // $buku_kas->user_id = session()->get('user_id');
        // $buku_kas->kas_id = DB::selectOne("select getNewId('buku_kas') as value from dual")->value;
        // $buku_kas->nama_pemasukkan = "Penjualan";
        // $buku_kas->harga_pemasukkan = (($sales_form_kredit->jumlah_barang * $sales_form_kredit->harga_satuan) - $persentaseDiskon) + $persentasePajak;
        // $buku_kas->tanggal = $request->tanggalTransaksi;

        // $buku_kas->save();

        return redirect()->route('sales')->with('successSalesFormKredit', 'Pemasukan Pembayaran Secara Kredit Sukses!');
    }

    public function sales_form_kredit()
    {
        if (session()->has('hasLogin')) {
            $user_id = session()->get('user_id');
            $nomor_transaksi = DB::selectOne("select getNewId('sales_form_kredit') as value from dual")->value;
            $kreditur = DB::table('kreditur')->get();
            return view('app/sales/sales_form_kredit', compact('nomor_transaksi', 'kreditur', 'user_id'));
        } 
        return redirect()->route('login')->with('loginFirst', 'Anda harus login terlebih dahulu');
    }

    public function sales_kredit_detail($nomor_transaksi)
    {
        if (session()->has('hasLogin')) {
            $user_id = session()->get('user_id');
            $sales_form_kredit = DB::select('select * from sales_form_kredit where sales_form_kredit.nomor_transaksi = ? and sales_form_kredit.user_id = ?', [$nomor_transaksi, $user_id]);
            return view('app/sales/sales_kredit_detail', compact('sales_form_kredit'));
        } 
        return redirect()->route('login')->with('loginFirst', 'Anda harus login terlebih dahulu');
    }

    public function sales_tunai_delete($nomor_transaksi) {
        // dd($nomor_transaksi);
        $sales_tunai = Sales_Form_Tunai::find($nomor_transaksi);
        $sales_tunai->delete();
        return redirect('/app/sales');
    }

    public function sales_kredit_delete($nomor_transaksi) {
        // dd($nomor_transaksi);
        $sales_kredit = Sales_Form_Kredit::find($nomor_transaksi);
        $sales_kredit->delete();
        return redirect('/app/sales');
    }
}