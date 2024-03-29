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
        <!-- ALERT MAKING SURE THERE'S NO EMPTY FIELDS-->
        @if (session()->has('emptyFields'))
        <div id="alerts-disimissible-component">
            <div class="alert alert-left alert-info  alert-dismissible fade show fs-7" role="alert">
                {{ session('emptyFields') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"> </button>
            </div>
        </div>
        @endif
        
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