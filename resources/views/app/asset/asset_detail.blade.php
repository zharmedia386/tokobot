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
        <form method="GET">
            <div class="form-group">
                <label class="form-label" for="exampleInputText1">Nomor Asset</label>
                <input type="text" class="form-control" id="exampleInputText1" name="nomorAsset" disabled value="{{ $asset[0]->nomor_asset }}" />
            </div>
            <div class="form-group">
                <label class="form-label">Jenis Asset</label>
                <select class="form-select mb-3 shadow-none" name="jenisAsset" disabled="disabled">
                    <option name="jenisAsset" value="Asset Lancar" selected="">Pilih Jenis Asset</option>
                    <option name="jenisAsset" value="Asset Lancar">Asset Lancar</option>
                    <option name="jenisAsset" value="Asset Tetap">Asset Tetap</option>
                </select>
            </div>
            <div class="form-group">
                <label class="form-label" for="exampleInputText1">Nama Asset</label>
                <input type="text" class="form-control" id="exampleInputText1" name="namaAsset" disabled value="{{ $asset[0]->nama_asset }}" />
            </div>
            <div class="form-group">
                <label class="form-label" for="exampleInputdate">Saldo Awal (Harga Asset)</label>
                <input type="text" class="form-control" id="exampleInputText1" name="hargaAsset" disabled value="{{ $asset[0]->harga_asset }}" />
            </div>
            <div class="form-group">
                <label class="form-label" for="exampleInputdate">Umur Ekonomis</label>
                <input type="text" class="form-control" id="exampleInputText1" name="umurEkonomis" disabled value="{{ $asset[0]->umur_ekonomis }}" />
            </div>
            <div class="form-group">
                <label class="form-label" for="exampleInputdate">Masa Penggunaan</label>
                <input type="text" class="form-control" id="exampleInputText1" name="masaPenggunaan" disabled value="{{ $asset[0]->masa_penggunaan }}" />
            </div>
            <button type="submit" class="btn btn-primary rounded">Submit</button>
            <a class="btn btn-danger rounded" href="{{ url()->previous() }}">cancel</a>
        </form>
    </div>
</div>


@endsection