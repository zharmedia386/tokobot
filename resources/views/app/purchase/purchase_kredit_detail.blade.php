@extends('layouts.master-1')
@section('title', 'Purchase Invoice')
@section('content')

<div class="card">
    <div class="card-header d-flex justify-content-between">
        <div class="header-title">
            <h4 class="card-title">Pembayaran Kredit</h4>
        </div>
    </div>
    <div class="card-body">
        <form method="GET">
            <div class="form-group">
                <label class="form-label" for="exampleInputText1">Nomor Transaksi</label>
                <input type="text" class="form-control" id="exampleInputText1" name="nomorTransaksi" disabled value="{{ $purchase_form_kredit[0]->nomor_transaksi }}" />
            </div>
            <div class="form-group">
                <label class="form-label" for="exampleInputdate">Tanggal Transaksi</label>
                <input type="date" class="form-control" name="tanggalTransaksi" id="exampleInputdate" disabled value="{{ $purchase_form_kredit[0]->tanggal_transaksi }}"/>
            </div>
            <div class="form-group">
                <label class="form-label">Metode Pembayaran</label>
                <select class="form-select mb-3 shadow-none" value="kredit" name="metodePembayaran" disabled="disabled">
                    <option value="kredit" selected="" name="metodePembayaran">Kredit</option>
                    <option value="kredit" name="metodePembayaran">Kredit</option>
                </select>
                <input type="hidden" value="kredit" name="metodePembayaran" />
            </div>
            <div class="form-group">
                <label class="form-label">Umur Piutang</label>
                <select class="form-select mb-3 shadow-none" name="umurPiutang" disabled >
                    <option name="umurPiutang" value="15" selected="">Pilih Umur Piutang</option>
                    <option name="umurPiutang" value="15">15 hari</option>
                    <option name="umurPiutang" value="30">30 hari</option>
                    <option name="umurPiutang" value="60">60 hari</option>
                    <option name="umurPiutang" value="90">90 hari</option>
                </select>
            </div>
            <div class="form-group">
                <label class="form-label" for="exampleInputdate">Batas Pembayaran Utang</label>
                <input type="date" class="form-control" id="exampleInputdate" name="batasPembayaranUtang" disabled value="{{ $purchase_form_kredit[0]->batas_pembayaran_utang }}"/>
            </div>
            <div class="form-group">
                <label class="form-label" for="exampleInputText1">Denda Keterlambatan</label>
                <input type="text" class="form-control" id="exampleInputText1" name="dendaKeterlambatan" disabled value="{{ $purchase_form_kredit[0]->denda_keterlambatan }}" />
            </div>
            <div class="form-group">
                <label class="form-label" for="exampleInputText1">Diskon Pembelian</label>
                <input type="text" class="form-control" name="diskonPembelian" id="exampleInputText1" disabled value="{{ $purchase_form_kredit[0]->diskon_pembelian }}" />
            </div>
            <div class="form-group">
                <label class="form-label" for="exampleInputText1">Produk yang dibeli</label>
                <input type="text" class="form-control" name="produkYangDibeli" id="exampleInputText1" disabled value="{{ $purchase_form_kredit[0]->produk_yang_dibeli }}" />
            </div>
            <div class="form-group">
                <label class="form-label" for="exampleInputText1">Pajak</label>
                <input type="text" class="form-control" name="pajak" id="exampleInputText1" disabled value="{{ $purchase_form_kredit[0]->pajak }}" />
            </div>
            <div class="form-group">
                <label class="form-label" for="exampleInputText1">Total Pembelian</label>
                <input type="text" class="form-control" name="totalPembelian" id="exampleInputText1" disabled value="{{ $purchase_form_kredit[0]->total_pembelian }}" />
            </div>
            <a class="btn btn-danger rounded" href="{{ url()->previous() }}">cancel</a>
        </form>
    </div>
</div>
@endsection