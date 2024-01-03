@extends('layouts.master-1')
@section('title', 'stok_barang_form_post')
@section('content')

<div class="card">
    <div class="card-header d-flex justify-content-between">
        <div class="header-title">
            <h4 class="card-title">Detail Stok Barang</h4>
        </div>
    </div>
    <div class="card-body">
        <form method="GET">
            <div class="form-group">
                <label class="form-label" for="exampleInputText1">Nomor Barang</label>
                <input type="text" class="form-control" id="exampleInputText1" name="nomorBarang" disabled value="{{ $stok_barang[0]->stok_id }}" />
            </div>
            <div class="form-group">
                <label class="form-label" for="exampleInputText1">Kode Barang</label>
                <input type="text" class="form-control" id="exampleInputText1" name="nomorBarang" disabled value="{{ $stok_barang[0]->kode_barang }}" />
            </div>
            <div class="form-group">
                <label class="form-label" for="exampleInputText1">Nama Barang</label>
                <input type="text" class="form-control" id="exampleInputText1" name="namaAsset" disabled value="{{ $stok_barang[0]->nama_barang }}" />
            </div>
            <div class="form-group">
                <label class="form-label" for="exampleInputdate">Harga Barang per Unit</label>
                <input type="text" class="form-control" id="exampleInputText1" name="hargaBarang" disabled value="{{ $stok_barang[0]->harga_satuan }}" />
            </div>
            <div class="form-group">
                <label class="form-label" for="exampleInputdate">Jumlah Stok</label>
                <input type="text" class="form-control" id="exampleInputText1" name="stokBarang" disabled value="{{ $stok_barang[0]->jumlah_stok }}" />
            </div>
            <div class="form-group">
                <label class="form-label" for="exampleInputdate">Total Harga</label>
                <input type="text" class="form-control" id="exampleInputText1" name="stokBarang" disabled value="{{ $stok_barang[0]->total_harga }}" />
            </div>
            <a class="btn btn-danger rounded" href="{{ url()->previous() }}">Kembali</a>
        </form>
    </div>
</div>


@endsection