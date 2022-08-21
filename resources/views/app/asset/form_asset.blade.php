@extends('layouts.master-1')
@section('title', 'Form Asset')
@section('content')

<div class="card">
    <div class="card-header d-flex justify-content-between">
        <div class="header-title">
            <h4 class="card-title">Tambah Asset</h4>
        </div>
    </div>
    <div class="card-body">
        <form>
            <div class="form-group">
                <label class="form-label">Jenis Asset</label>
                <select class="form-select mb-3 shadow-none" name="umurPiutang">
                    <option name="umurPiutang" value="15" selected="">Pilih Jenis Asset</option>
                    <option name="umurPiutang" value="15">Asset Lancar</option>
                    <option name="umurPiutang" value="30">Asset Tetap</option>
                </select>
            </div>
            <div class="form-group">
                <label class="form-label" for="exampleInputText1">Nama Asset</label>
                <input type="text" class="form-control" id="exampleInputText1" placeholder="Masukkan nama asset anda" />
            </div>
            <div class="form-group">
                <label class="form-label" for="exampleInputdate">Saldo Awal (Harga Asset)</label>
                <input type="text" class="form-control" id="exampleInputText1" placeholder="Masukkan nominal harga asset anda" />
            </div>
            <div class="form-group">
                <label class="form-label" for="exampleInputdate">Umur Ekonomis</label>
                <input type="text" class="form-control" id="exampleInputText1" placeholder="Masukkan umur ekonomis asset anda" />
            </div>
            <div class="form-group">
                <label class="form-label" for="exampleInputdate">Masa Penggunaan</label>
                <input type="text" class="form-control" id="exampleInputText1" placeholder="Masukkan masa penggunaan asset anda" />
            </div>
            <button type="submit" class="btn btn-primary rounded">Submit</button>
            <a class="btn btn-danger rounded" href="{{ url()->previous() }}">cancel</a>
        </form>
    </div>
</div>


@endsection