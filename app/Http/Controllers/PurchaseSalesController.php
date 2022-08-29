<?php

namespace App\Http\Controllers;

use App\Models\Users;
use App\Models\Purchase_Form_Tunai;
use App\Models\Purchase_Form_Kredit;
use App\Models\Sales_Form_Tunai;
use App\Models\Sales_Form_Kredit;
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
            $purchase_form_tunai = DB::table('purchase_form_tunai')->get();
            $purchase_form_kredit = DB::table('purchase_form_kredit')->get();
            $user_id = session()->get('user_id');

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
        // $test = DB::selectOne("select getNewId('purchase_form_tunai') as value from dual")->value;
        // dd($test);

        // Purchase Form Tunai
        $purchase_form_tunai = new Purchase_Form_Tunai();
        $purchase_form_tunai->user_id = session()->get('user_id');
        $purchase_form_tunai->nomor_transaksi = DB::selectOne("select getNewId('purchase_form_tunai') as value from dual")->value;
        $purchase_form_tunai->tanggal_transaksi = $request->tanggalTransaksi;
        $purchase_form_tunai->metode_pembayaran = $request->metodePembayaran;
        $purchase_form_tunai->diskon_pembelian = $request->diskonPembelian;
        $purchase_form_tunai->produk_yang_dibeli = $request->produkYangDibeli;
        $purchase_form_tunai->pajak = $request->pajak;
        $purchase_form_tunai->jumlah_barang = $request->jumlahBarang;

            // HARGA SATUAN
        $purchase_form_tunai->harga_satuan = $request->hargaSatuan;
        $purchase_form_tunai->harga_satuan = Str::replace('.','',$purchase_form_tunai->harga_satuan);
        $purchase_form_tunai->harga_satuan = Str::replace('Rp ','',$purchase_form_tunai->harga_satuan);
        $purchase_form_tunai->harga_satuan = (int)($purchase_form_tunai->harga_satuan);

        // HARGA TOTAL
        $persentaseDiskon = $request->diskonPembelian / 100 * ($request->jumlahBarang * $purchase_form_tunai->harga_satuan);
        $persentasePajak = $request->pajak * $persentaseDiskon / 100;
        
        $purchase_form_tunai->total_pembelian = (($request->jumlahBarang * $purchase_form_tunai->harga_satuan) - $persentaseDiskon) + $persentasePajak;

        $purchase_form_tunai->save();

        return redirect()->route('purchase')->with('successPurchaseFormTunai', 'Pemasukan Pembayaran Secara Tunai Sukses!');
    }

    public function purchase_tunai_detail($nomor_transaksi)
    {
        if (session()->has('hasLogin')) {
            $purchase_form_tunai = DB::select('select * from purchase_form_tunai where purchase_form_tunai.nomor_transaksi = ' . $nomor_transaksi);
            return view('app/purchase/purchase_tunai_detail', compact('purchase_form_tunai'));
        } 
        return redirect()->route('login')->with('loginFirst', 'Anda harus login terlebih dahulu');
    }

    public function purchase_form_kredit_post(Request $request)
    {
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
        $purchase_form_kredit->jumlah_barang = $request->jumlahBarang;
        $purchase_form_kredit->nama_supplier = $request->namaSupplier;

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
        $persentaseDiskon = $request->diskonPembelian / 100 * ($request->jumlahBarang * $purchase_form_kredit->harga_satuan);
        $persentasePajak = $request->pajak * $persentaseDiskon / 100;
        
        $purchase_form_kredit->total_pembelian = (($request->jumlahBarang * $purchase_form_kredit->harga_satuan) - $persentaseDiskon) + $persentasePajak;

        $purchase_form_kredit->save();

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
            $purchase_form_kredit = DB::select('select * from purchase_form_kredit where purchase_form_kredit.nomor_transaksi = ' . $nomor_transaksi);

            return view('app/purchase/purchase_kredit_detail', compact('purchase_form_kredit'));
        } 
        return redirect()->route('login')->with('loginFirst', 'Anda harus login terlebih dahulu');
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    // SALES
    public function sales()
    {
        if (session()->has('hasLogin')) {
            $sales_form_tunai = DB::table('sales_form_tunai')->get();
            $sales_form_kredit = DB::table('sales_form_kredit')->get();
            $user_id = session()->get('user_id');

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
        $sales_form_tunai->jumlah_barang = $request->jumlahBarang;
        $sales_form_tunai->harga_satuan = $request->hargaSatuan;

        // HARGA TOTAL
        $persentaseDiskon = $request->diskonPenjualan / 100 * ($request->jumlahBarang * $request->hargaSatuan);
        $persentasePajak = $request->pajak * $persentaseDiskon / 100;
        
        $sales_form_tunai->total_penjualan = (($request->jumlahBarang * $request->hargaSatuan) - $persentaseDiskon) + $persentasePajak;

        $sales_form_tunai->save();

        return redirect()->route('sales')->with('successSalesFormTunai', 'Pemasukan Pembayaran Secara Tunai Sukses!');
    }

    public function sales_tunai_detail($nomor_transaksi)
    {
        if (session()->has('hasLogin')) {
            $sales_form_tunai = DB::select('select * from sales_form_tunai where sales_form_tunai.nomor_transaksi = ' . $nomor_transaksi);
            return view('app/sales/sales_tunai_detail', compact('sales_form_tunai'));
        } 
        return redirect()->route('login')->with('loginFirst', 'Anda harus login terlebih dahulu');
    }

    public function sales_form_kredit_post(Request $request)
    {
        // dd($request->metodePembayaran);
        // dd($request->umurUtang);

        // Sales Form Kredit
        $sales_form_kredit = new Sales_Form_Kredit();
        $sales_form_kredit->user_id = session()->get('user_id');
        $sales_form_kredit->nomor_transaksi = DB::selectOne("select getNewId('sales_form_kredit') as value from dual")->value;
        $sales_form_kredit->tanggal_transaksi = $request->tanggalTransaksi;
        $sales_form_kredit->metode_pembayaran = $request->metodePembayaran;
        $sales_form_kredit->umur_utang = $request->umurUtang;
        $sales_form_kredit->batas_pembayaran_utang = $request->batasPembayaranUtang;
        $sales_form_kredit->denda_keterlambatan = $request->dendaKeterlambatan;
        $sales_form_kredit->diskon_penjualan = $request->diskonPenjualan;
        $sales_form_kredit->produk_yang_terjual = $request->produkYangTerjual;
        $sales_form_kredit->nama_kreditur = $request->namaKreditur;
        $sales_form_kredit->pajak = $request->pajak;
        $sales_form_kredit->jumlah_barang = $request->jumlahBarang;
        $sales_form_kredit->total_penjualan = $request->totalPenjualan;

        $sales_form_kredit->save();

        return redirect()->route('sales')->with('successSalesFormKredit', 'Pemasukan Pembayaran Secara Kredit Sukses!');
    }

    public function sales_form_kredit()
    {
        if (session()->has('hasLogin')) {
            $nomor_transaksi = DB::selectOne("select getNewId('sales_form_kredit') as value from dual")->value;
            $kreditur = DB::table('kreditur')->get();
            $user_id = session()->get('user_id');
            return view('app/sales/sales_form_kredit', compact('nomor_transaksi', 'kreditur', 'user_id'));
        } 
        return redirect()->route('login')->with('loginFirst', 'Anda harus login terlebih dahulu');
    }

    public function sales_kredit_detail($nomor_transaksi)
    {
        if (session()->has('hasLogin')) {
            $sales_form_kredit = DB::select('select * from sales_form_kredit where sales_form_kredit.nomor_transaksi = ' . $nomor_transaksi);
            return view('app/sales/sales_kredit_detail', compact('sales_form_kredit'));
        } 
        return redirect()->route('login')->with('loginFirst', 'Anda harus login terlebih dahulu');
    }
}