@extends('layouts.master-1')
@section('title', 'Purchase Invoice')
@section('content')

<div class="card">
    <div class="card-header d-flex justify-content-between">
        <div class="header-title">
            <h4 class="card-title">Pembelian Tunai</h4>
        </div>
    </div>
    <div class="card-body">
        <form method="GET">
            <div class="form-group">
                <label class="form-label" for="exampleInputText1">Nomor Transaksi</label>
                <input type="text" class="form-control" id="exampleInputText1" name="nomorTransaksi" disabled value="{{ $purchase_form_tunai[0]->nomor_transaksi }}" />
            </div>
            <div class="form-group">
                <label class="form-label" for="exampleInputdate">Tanggal Transaksi</label>
                <input type="date" class="form-control" name="tanggalTransaksi" id="exampleInputdate" disabled value="{{ $purchase_form_tunai[0]->tanggal_transaksi }}"/>
            </div>
            <div class="form-group">
                <label class="form-label">Metode Pembayaran</label>
                <select class="form-select mb-3 shadow-none" value="tunai" name="metodePembayaran" disabled="disabled">
                    <option value="tunai" selected="" name="metodePembayaran">{{ $purchase_form_tunai[0]->metode_pembayaran }}</option>
                    <option value="kredit" name="metodePembayaran">Kredit</option>
                </select>
                <input type="hidden" value="tunai" name="metodePembayaran" />
            </div>
            <div class="form-group">
                <label class="form-label" for="exampleInputText1">Diskon Pembelian (%)</label>
                <input type="text" class="form-control" name="diskonPembelian" id="exampleInputText1" disabled value="{{ $purchase_form_tunai[0]->diskon_pembelian }}" />
            </div>
            <div class="form-group">
                <label class="form-label" for="exampleInputText1">Produk yang dibeli</label>
                <input type="text" class="form-control" name="produkYangDibeli" id="exampleInputText1" disabled value="{{ $purchase_form_tunai[0]->produk_yang_dibeli }}" />
            </div>
            <div class="form-group">
                <label class="form-label" for="exampleInputText1">Pajak (%)</label>
                <input type="text" class="form-control" name="pajak" id="exampleInputText1" disabled value="{{ $purchase_form_tunai[0]->pajak }}" />
            </div>
            <div class="form-group">
                <label class="form-label" for="exampleInputText1">Jumlah Barang</label>
                <input type="text" class="form-control" name="pajak" id="exampleInputText1" disabled value="{{ $purchase_form_tunai[0]->jumlah_barang }}" />
            </div>
            <div class="form-group">
                <label class="form-label" for="exampleInputText1">Harga Satuan</label>
                <input type="text" class="form-control" name="hargaSatuan" id="exampleInputText1" disabled value="{{ $purchase_form_tunai[0]->harga_satuan }}" />
            </div>
            <a class="btn btn-danger rounded" href="{{ url()->previous() }}">cancel</a>
        </form>
    </div>
</div>
@endsection