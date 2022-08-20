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
        <form action="{{ route('purchase_form_kredit_post') }}" method="POST">
            @csrf
            <div class="form-group">
                <label class="form-label" for="exampleInputText1">Nomor Transaksi</label>
                <input type="text" class="form-control" name="nomorTransaksi" id="exampleInputText1" placeholder="Masukkan Nomor Transaksi.." />
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
                <label class="form-label" for="exampleInputText1">Diskon Pembelian</label>
                <input type="text" class="form-control" id="exampleInputText1" name="diskonPembelian" placeholder="Masukkan Diskon Pembelian.." />
            </div>
            <div class="form-group">
                <label class="form-label" for="exampleInputText1">Produk yang dibeli</label>
                <input type="text" class="form-control" id="exampleInputText1" name="produkYangDibeli" placeholder="Masukkan Produk yang dibeli.." />
            </div>
            <div class="form-group">
                <label class="form-label" for="exampleInputText1">Pajak</label>
                <input type="text" class="form-control" id="exampleInputText1" name="pajak" placeholder="Masukkan Pajak.." />
            </div>
            <div class="form-group">
                <label class="form-label" for="exampleInputText1">Total Pembelian</label>
                <input type="text" class="form-control" id="exampleInputText1" name="totalPembelian" placeholder="Masukkan Total Pembelian.." />
            </div>
            <button type="submit" class="btn btn-primary rounded">Submit</button>
            <button type="submit" class="btn btn-danger rounded" href="{{ url()->previous() }}">cancel</button>
        </form>
    </div>
</div>


@endsection