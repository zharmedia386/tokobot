@extends('layouts.master-1')
@section('title', 'Tambah Stok')
@section('content')

<div class="card">
    <div class="card-header d-flex justify-content-between">
        <div class="header-title">
            <h4 class="card-title">Tambah Stok</h4>
        </div>
    </div>
    <div class="card-body">
        <form action="{{ route('tambah_kreditur_post') }}" method="POST">
            @csrf
            <div class="form-group">
                <label class="form-label" for="exampleInputText1">Kode Barang</label>
                <input type="text" class="form-control" name="namaKreditur" id="exampleInputText1" placeholder="Masukkan kode barang" />
            </div>
            <div class="form-group">
                <label class="form-label" for="exampleInputText1">Nama Barang</label>
                <input type="text" class="form-control" name="alamat" id="exampleInputText1" placeholder="Masukkan nama barang" />
            </div>
            <div class="form-group">
                <label class="form-label" for="exampleInputText1">Harga Per Unit</label>
                <input type="text" class="form-control" name="alamat" id="exampleInputText1" placeholder="Masukkan harga per unit" />
            </div>
            <div class="form-group">
                <label class="form-label" for="exampleInputText1">Jumlah Stok</label>
                <input type="text" class="form-control" name="alamat" id="exampleInputText1" placeholder="Masukkan nama barang" />
            </div>
            <div class="form-group">
                <label class="form-label" for="exampleInputText1">Total</label>
                <input type="text" class="form-control" name="alamat" id="exampleInputText1" placeholder="Masukkan nama barang" />
            </div>
            <button type="submit" class="btn btn-primary rounded">Tambah</button>
            <a class="btn btn-danger rounded" href="{{ url()->previous() }}">Batal</a>
            
        </form>
    </div>
</div>


@endsection