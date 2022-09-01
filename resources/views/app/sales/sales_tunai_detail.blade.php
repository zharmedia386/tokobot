@extends('layouts.master-1')
@section('title', 'Invoice Penjualan Kredit Detail')
@section('content')

<div class="card">
    <div class="card-header d-flex justify-content-between">
        <div class="header-title">
            <h4 class="card-title">Penjualan Tunai</h4>
        </div>
    </div>
    <div class="card-body">
        <form method="GET">
            <div class="form-group">
                <label class="form-label" for="exampleInputText1">Nomor Transaksi</label>
                <input type="text" class="form-control" id="exampleInputText1" name="nomorTransaksi" disabled value="{{ $sales_form_tunai[0]->nomor_transaksi }}" />
            </div>
            <div class="form-group">
                <label class="form-label" for="exampleInputdate">Tanggal Transaksi</label>
                <input type="date" class="form-control" name="tanggalTransaksi" id="exampleInputdate" disabled value="{{ $sales_form_tunai[0]->tanggal_transaksi }}"/>
            </div>
            <div class="form-group">
                <label class="form-label">Metode Pembayaran</label>
                <select class="form-select mb-3 shadow-none" value="tunai" name="metodePembayaran" disabled="disabled">
                    <option value="tunai" selected="" name="metodePembayaran">{{ $sales_form_tunai[0]->metode_pembayaran }}</option>
                    <option value="kredit" name="metodePembayaran">Kredit</option>
                </select>
                <input type="hidden" value="tunai" name="metodePembayaran" />
            </div>
            <div class="form-group">
                <label class="form-label" for="exampleInputText1">Diskon Penjualan (%)</label>
                <input type="text" class="form-control" name="diskonPenjualan" id="exampleInputText1" disabled value="{{ $sales_form_tunai[0]->diskon_penjualan }}" />
            </div>
            <div class="form-group">
                <label class="form-label" for="exampleInputText1">Produk yang terjual</label>
                <input type="text" class="form-control" name="produkYangTerjual" id="exampleInputText1" disabled value="{{ $sales_form_tunai[0]->produk_yang_terjual }}" />
            </div>
            <div class="form-group">
                <label class="form-label" for="exampleInputText1">Pajak (%)</label>
                <input type="text" class="form-control" name="pajak" id="exampleInputText1" disabled value="{{ $sales_form_tunai[0]->pajak }}" />
            </div>
            <div class="form-group">
                <label class="form-label" for="exampleInputText1">Jumlah Barang</label>
                <input type="text" class="form-control" name="pajak" id="exampleInputText1" disabled value="{{ $sales_form_tunai[0]->jumlah_barang }}" />
            </div>
            <div class="form-group">
                <label class="form-label" for="exampleInputText1">Harga Satuan</label>
                <input type="text" class="form-control" name="hargaSatuan" id="exampleInputText1" disabled value="{{ $sales_form_tunai[0]->harga_satuan }}" />
            </div>
            <a class="btn btn-danger rounded" href="{{ url()->previous() }}">Kembali</a>
        </form>
    </div>
</div>
@endsection