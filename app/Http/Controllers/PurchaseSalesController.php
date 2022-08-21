<?php

namespace App\Http\Controllers;

use App\Models\Users;
use App\Models\Orderlist;
use App\Models\Customer;
use App\Models\Purchase_Form_Tunai;
use App\Models\Purchase_Form_Kredit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $purchase_form_tunai->total_pembelian = $request->totalPembelian;

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
        // dd($request->umurPiutang);

        // Purchase Form Kredit
        $purchase_form_kredit = new Purchase_Form_Kredit();
        $purchase_form_kredit->user_id = session()->get('user_id');
        $purchase_form_kredit->nomor_transaksi = DB::selectOne("select getNewId('purchase_form_kredit') as value from dual")->value;
        $purchase_form_kredit->tanggal_transaksi = $request->tanggalTransaksi;
        $purchase_form_kredit->metode_pembayaran = $request->metodePembayaran;
        $purchase_form_kredit->umur_piutang = $request->umurPiutang;
        $purchase_form_kredit->batas_pembayaran_utang = $request->batasPembayaranUtang;
        $purchase_form_kredit->denda_keterlambatan = $request->dendaKeterlambatan;
        $purchase_form_kredit->diskon_pembelian = $request->diskonPembelian;
        $purchase_form_kredit->produk_yang_dibeli = $request->produkYangDibeli;
        $purchase_form_kredit->pajak = $request->pajak;
        $purchase_form_kredit->jumlah_barang = $request->jumlahBarang;
        $purchase_form_kredit->total_pembelian = $request->totalPembelian;

        $purchase_form_kredit->save();

        return redirect()->route('purchase')->with('successPurchaseFormKredit', 'Pemasukan Pembayaran Secara Kredit Sukses!');
    }

    public function purchase_form_kredit()
    {
        if (session()->has('hasLogin')) {
            $nomor_transaksi = DB::selectOne("select getNewId('purchase_form_kredit') as value from dual")->value;
            return view('app/purchase/purchase_form_kredit', compact('nomor_transaksi'));
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
            return view('app/sales/sales');
        } 
        return redirect()->route('login')->with('loginFirst', 'Anda harus login terlebih dahulu');
    }
}