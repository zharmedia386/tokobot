@extends('layouts.master-1')
@section('title', 'Form Utang')
@section('content')

<div class="card">
    <div class="card-header d-flex justify-content-between">
        <div class="header-title">
            <h4 class="card-title">Tambah Utang</h4>
        </div>
    </div>
    <div class="card-body">
        <form action="{{ route('buku_utang_form_utang_post') }}" method="POST">
            @csrf
            <div class="form-group">
                <label class="form-label" for="exampleInputText1">Nomor Utang</label>
                <input type="text" class="form-control" name="nomorUtang" id="exampleInputText1" disabled value="{{ $nomor_utang }}" />
            </div>
            <div class="form-group">
                <label class="form-label" for="exampleInputdate">Tanggal</label>
                <input type="date" class="form-control" name="tanggal" id="exampleInputdate" />
            </div>
            <div class="form-group">
                <label class="form-label" for="exampleInputText1">Nama</label>
                <input type="text" class="form-control" id="exampleInputText1" name="nama" placeholder="Masukkan Nama.." />
            </div>
            <div class="form-group">
                <label class="form-label" for="exampleInputText1">Jumlah Utang</label>
                <input type="text" class="form-control" id="exampleInputText1" name="jumlahUtang" placeholder="Masukkan Jumlah Utang.." />
            </div>
            <button type="submit" class="btn btn-primary rounded">Submit</button>
            <a class="btn btn-danger rounded" href="{{ url()->previous() }}">cancel</a>
        </form>
    </div>
</div>


@endsection