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
                <input type="text" class="form-control" id="exampleInputText1" name="nomorBarang" disabled value="{{ $barang[0]->nomor_barang }}" />
            </div>

            <div class="form-group">
                <label class="form-label" for="exampleInputText1">Nama Barang</label>
                <input type="text" class="form-control" id="exampleInputText1" name="namaAsset" disabled value="{{ $asset[0]->nama_barang }}" />
            </div>
            <div class="form-group">
                <label class="form-label" for="exampleInputdate">Harga Barang per Unit</label>
                <input type="text" class="form-control" id="exampleInputText1" name="hargaBarang" disabled value="{{ $asset[0]->harga_barang }}" />
            </div>
            <div class="form-group">
                <label class="form-label" for="exampleInputdate">Stok Barang Tersedia</label>
                <input type="text" class="form-control" id="exampleInputText1" name="stokBarang" disabled value="{{ $asset[0]->stok_barang }}" />
            </div>
            <button type="submit" class="btn btn-primary rounded">Submit</button>
            <a class="btn btn-danger rounded" href="{{ url()->previous() }}">cancel</a>
        </form>
    </div>
</div>


@endsection