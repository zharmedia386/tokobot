@extends('layouts.master-1')
@section('title', 'Tambah Kreditur')
@section('content')

<div class="card">
    <div class="card-header d-flex justify-content-between">
        <div class="header-title">
            <h4 class="card-title">Tambah Kreditur</h4>
        </div>
    </div>
    <div class="card-body">
        <form action="{{ route('tambah_kreditur_post') }}" method="POST">
            @csrf
            <div class="form-group">
                <label class="form-label" for="exampleInputText1">Kreditur ID</label>
                <input type="text" class="form-control" name="krediturID" id="exampleInputText1" disabled value="{{ $kreditur_id }}" />
            </div>
            <div class="form-group">
                <label class="form-label" for="exampleInputText1">Nama Kreditur</label>
                <input type="text" class="form-control" name="namaKreditur" id="exampleInputText1" placeholder="Masukkan nama kreditur" />
            </div>
            <div class="form-group">
                <label class="form-label" for="exampleInputText1">Alamat</label>
                <input type="text" class="form-control" name="alamat" id="exampleInputText1" placeholder="Masukkan alamat kreditur" />
            </div>
            <button type="submit" class="btn btn-primary rounded">Tambah</button>
            <a class="btn btn-danger rounded" href="{{ url()->previous() }}">Batal</a>
            
        </form>
    </div>
</div>


@endsection