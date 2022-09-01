@extends('layouts.master-1')
@section('title', 'Invoice Penjualan Tunai')
@section('content')

<div class="card">
    <div class="card-header d-flex justify-content-between">
        <div class="header-title">
            <h4 class="card-title">Penjualan Tunai</h4>
        </div>
    </div>
    <div class="card-body">
        <form action="{{ route('sales_form_tunai_post') }}" method="POST">
            @csrf
            <div class="form-group">
                <label class="form-label" for="exampleInputText1">Nomor Transaksi</label>
                <input type="text" class="form-control" id="exampleInputText1" name="nomorTransaksi" disabled value="{{ $nomor_transaksi }}" />
            </div>
            <div class="form-group">
                <label class="form-label" for="exampleInputdate">Tanggal Transaksi</label>
                <input type="date" class="form-control" name="tanggalTransaksi" id="exampleInputdate" />
            </div>
            <div class="form-group">
                <label class="form-label">Metode Pembayaran</label>
                <select class="form-select mb-3 shadow-none" value="tunai" name="metodePembayaran" disabled="disabled">
                    <option value="tunai" selected="" name="metodePembayaran">Tunai</option>
                    <option value="kredit" name="metodePembayaran">Kredit</option>
                </select>
                <input type="hidden" value="tunai" name="metodePembayaran" />
            </div>
            <div class="form-group">
                <label class="form-label" for="exampleInputText1">Diskon Penjualan (%)</label>
                <input type="text" class="form-control" name="diskonPenjualan" id="exampleInputText1" placeholder="Masukkan Diskon Penjualan.." />
            </div>
            <div class="form-group">
                <label class="form-label" for="exampleInputText1">Produk yang terjual</label>
                <input type="text" class="form-control" name="produkYangTerjual" id="exampleInputText1" placeholder="Masukkan Produk yang terjual.." />
            </div>
            <div class="form-group">
                <label class="form-label" for="exampleInputText1">Pajak (%)</label>
                <input type="text" class="form-control" name="pajak" id="exampleInputText1" placeholder="Masukkan Pajak.." />
            </div>
            <div class="form-group">
                <label class="form-label" for="exampleInputText1">Jumlah barang</label>
                <input type="text" class="form-control" name="jumlahBarang" id="exampleInputText1" placeholder="Masukkan Jumlah Barang.." />
            </div>
            <div class="form-group">
                <label class="form-label">Satuan Barang</label>
                <select class="form-select mb-3 shadow-none" name="satuanBarang">
                    <option name="satuanBarang" value="1" selected="">Pilih Satuan Barang</option>
                    <option name="satuanBarang" value="1">Pcs</option>
                    <option name="satuanBarang" value="12">Lusin</option>
                    <option name="satuanBarang" value="144">Gross</option>
                    <option name="satuanBarang" value="20">Kodi</option>
                    <option name="satuanBarang" value="500">RIm</option>
                </select>
            </div>
            <div class="form-group">
                <label class="form-label" for="exampleInputText1">Harga Satuan</label>
                <input type="text" class="form-control" name="hargaSatuan" id="rupiah" placeholder="Masukkan Harga Satuan.." />
            </div>
            <button type="submit" class="btn btn-primary rounded">Tambah</button>
            <a class="btn btn-danger rounded" href="{{ url()->previous() }}">Batal</a>
        </form>
    </div>
</div>

@push('child-js')
    <script src="{{ asset('format/rupiah_format.js') }}"></script>
@endpush

@endsection