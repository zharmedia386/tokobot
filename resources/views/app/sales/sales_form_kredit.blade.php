@extends('layouts.master-1')
@section('title', 'Invoice Penjualan Kredit')
@section('content')

<div class="card">
    <div class="card-header d-flex justify-content-between">
        <div class="header-title">
            <h4 class="card-title">Penjualan Kredit</h4>
        </div>
    </div>
    <div class="card-body">
        <form action="{{ route('sales_form_kredit_post') }}" method="POST">
            @csrf
            <div class="form-group">
                <label class="form-label" for="exampleInputText1">Nomor Transaksi</label>
                <input type="text" class="form-control" name="nomorTransaksi" id="exampleInputText1" disabled value="{{ $nomor_transaksi }}" />
            </div>
            <div class="form-group">
                <label class="form-label" for="exampleInputdate">Tanggal Transaksi</label>
                <input type="date" class="form-control" name="tanggalTransaksi" id="exampleInputdate" />
            </div>
            <div class="form-group">
                <label class="form-label">Metode Pembayaran</label>
                <select class="form-select mb-3 shadow-none" disabled="">
                    <option selected="">Kredit</option>
                    <option value="1">Tunai</option>
                </select>
                <input type="hidden" value="tunai" name="metodePembayaran" />
            </div>
            <div class="form-group">
                <label class="form-label">Umur Piutang</label>
                <select class="form-select mb-3 shadow-none" name="umurPiutang">
                    <option name="umurPiutang" value="15" selected="">Pilih Umur Piutang</option>
                    <option name="umurPiutang" value="15">15 hari</option>
                    <option name="umurPiutang" value="30">30 hari</option>
                    <option name="umurPiutang" value="60">60 hari</option>
                    <option name="umurPiutang" value="90">90 hari</option>
                </select>
            </div>
            <div class="form-group">
                <label class="form-label" for="exampleInputdate">Batas Pembayaran Utang</label>
                <input type="date" class="form-control" id="exampleInputdate" name="batasPembayaranUtang"/>
            </div>
            <div class="form-group">
                <label class="form-label" for="exampleInputText1">Denda Keterlambatan</label>
                <input type="text" class="form-control" id="exampleInputText1" name="dendaKeterlambatan" placeholder="Masukkan Denda Keterlambatan.." />
            </div>
            <div class="form-group">
                <label class="form-label" for="exampleInputText1">Diskon Penjualan</label>
                <input type="text" class="form-control" id="exampleInputText1" name="diskonPenjualan" placeholder="Masukkan Diskon Penjualan.." />
            </div>
            <div class="form-group">
                <label class="form-label" for="exampleInputText1">Produk yang terjual</label>
                <input type="text" class="form-control" id="exampleInputText1" name="produkYangTerjual" placeholder="Masukkan Produk yang terjual.." />
            </div>
            <div class="form-group">
                <label class="form-label" for="exampleInputText1">Pajak</label>
                <input type="text" class="form-control" id="exampleInputText1" name="pajak" placeholder="Masukkan Pajak.." />
            </div>
            <div class="form-group">
                <label class="form-label" for="exampleInputText1">Jumlah Barang</label>
                <input type="text" class="form-control" id="exampleInputText1" name="jumlahBarang" placeholder="Masukkan Jumlah Barang.." />
            </div>
            <div class="form-group">
                <label class="form-label" for="exampleInputText1">Total Penjualan</label>
                <input type="text" class="form-control" id="exampleInputText1" name="totalPenjualan" placeholder="Masukkan Total Penjualan.." />
            </div>
            <button type="submit" class="btn btn-primary rounded">Submit</button>
            <a class="btn btn-danger rounded" href="{{ url()->previous() }}">cancel</a>
        </form>
    </div>
</div>


@endsection