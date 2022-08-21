@extends('layouts.master-1')
@section('title', 'Form Piutang Detail')
@section('content')

<div class="card">
    <div class="card-header d-flex justify-content-between">
        <div class="header-title">
            <h4 class="card-title">Piutang Detail</h4>
        </div>
    </div>
    <div class="card-body">
        <form method="GET">
            <div class="form-group">
                <label class="form-label" for="exampleInputText1">Nomor Piutang</label>
                <input type="text" class="form-control" id="exampleInputText1" name="nomorPiutang" disabled value="{{ $buku_utang_form_piutang[0]->nomor_piutang }}" />
            </div>
            <div class="form-group">
                <label class="form-label" for="exampleInputdate">Tanggal</label>
                <input type="date" class="form-control" name="tanggal" id="exampleInputdate" disabled value="{{ $buku_utang_form_piutang[0]->tanggal }}"/>
            </div>
            <div class="form-group">
                <label class="form-label" for="exampleInputText1">Nama</label>
                <input type="text" class="form-control" name="nama" id="exampleInputText1" disabled value="{{ $buku_utang_form_piutang[0]->nama }}" />
            <div class="form-group">
                <label class="form-label" for="exampleInputText1">Jumlah Piutang</label>
                <input type="text" class="form-control" id="exampleInputText1" name="jumlahPiutang" disabled value="{{ $buku_utang_form_piutang[0]->jumlah_piutang }}" />
            </div>
            </div>
            <a class="btn btn-danger rounded" href="{{ url()->previous() }}">cancel</a>
        </form>
    </div>
</div>
@endsection