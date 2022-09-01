@extends('layouts.master-1')
@section('title', 'Form Utang Detail')
@section('content')

<div class="card">
    <div class="card-header d-flex justify-content-between">
        <div class="header-title">
            <h4 class="card-title">Utang Detail</h4>
        </div>
    </div>
    <div class="card-body">
        <form method="GET">
            <div class="form-group">
                <label class="form-label" for="exampleInputText1">Nomor Utang</label>
                <input type="text" class="form-control" id="exampleInputText1" name="nomorUtang" disabled value="{{ $buku_utang_form_utang[0]->nomor_utang }}" />
            </div>
            <div class="form-group">
                <label class="form-label" for="exampleInputdate">Tanggal</label>
                <input type="date" class="form-control" name="tanggal" id="exampleInputdate" disabled value="{{ $buku_utang_form_utang[0]->tanggal }}"/>
            </div>
            <div class="form-group">
                <label class="form-label" for="exampleInputText1">Nama Utang</label>
                <input type="text" class="form-control" name="nama" id="exampleInputText1" disabled value="{{ $buku_utang_form_utang[0]->nama }}" />
            <div class="form-group">
                <label class="form-label" for="exampleInputText1">Jumlah Utang</label>
                <input type="text" class="form-control" id="exampleInputText1" name="jumlahUtang" disabled value="{{ $buku_utang_form_utang[0]->jumlah_utang }}" />
            </div>
            </div>
            <a class="btn btn-danger rounded" href="{{ url()->previous() }}">Kembali</a>
        </form>
    </div>
</div>
@endsection