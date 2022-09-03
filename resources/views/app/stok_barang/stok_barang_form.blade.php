@extends('layouts.master-1')
@section('title', 'stok_barang_form')
@section('content')

<div class="card">
    <div class="card-header d-flex justify-content-between">
        <div class="header-title">
            <h4 class="card-title">Tambah Stok Barang</h4>
        </div>
    </div>
    <div class="card-body">
        <form action="{{ route('stok_barang_form_post') }}" method="POST">
            @csrf
            <div class="form-group">
                <label class="form-label" for="exampleInputText1">Stok Id</label>
                <input type="text" class="form-control" id="exampleInputText1" name="stok_id" disabled value="{{ $stok_id }}" />
            </div>
            <div class="form-group">
                <label class="form-label" for="exampleInputText1">Nama Barang</label>
                <input type="text" class="form-control" id="exampleInputText1" name="namaBarang" placeholder="Masukkan nama barang anda" />
            </div>
            <div class="form-group">
                <label class="form-label" for="exampleInputdate">Harga Barang Per Unit</label>
                <input type="text" class="form-control" id="exampleInputText1" name="hargaSatuan" placeholder="Masukkan harga barang per unit anda" />
            </div>
            <div class="form-group">
                <label class="form-label" for="exampleInputdate">Jumlah Stok</label>
                <input type="text" class="form-control" id="exampleInputText1" name="jumlahStok" placeholder="Masukkan jumlah stok anda" />
            </div>
            <button type="submit" class="btn btn-primary rounded">Tambah</button>
            <a class="btn btn-danger rounded" href="{{ url()->previous() }}">Batal</a>
        </form>
    </div>
</div>


@endsection