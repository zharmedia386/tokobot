@extends('layouts.master-1')
@section('title', 'Form Asset')
@section('content')

<div class="card">
    <div class="card-header d-flex justify-content-between">
        <div class="header-title">
            <h4 class="card-title">Tambah Aset</h4>
        </div>
    </div>
    <div class="card-body">
        <form action="{{ route('asset_form_post') }}" method="POST">
            @csrf
            <div class="form-group">
                <label class="form-label" for="exampleInputText1">No. Aset</label>
                <input type="text" class="form-control" id="exampleInputText1" name="nomorAsset" disabled value="{{ $nomor_asset }}" />
            </div>
            <div class="form-group">
                <label class="form-label">Jenis Aset</label>
                <select class="form-select mb-3 shadow-none" name="jenisAsset">
                    <option name="jenisAsset" value="Asset Lancar" selected="">Pilih Jenis Aset</option>
                    <option name="jenisAsset" value="Asset Lancar">Aset Lancar</option>
                    <option name="jenisAsset" value="Asset Tetap">Aset Tetap</option>
                </select>
            </div>
            <div class="form-group">
                <label class="form-label" for="exampleInputText1">Nama Aset</label>
                <input type="text" class="form-control" id="exampleInputText1" name="namaAsset" placeholder="Masukkan nama aset anda" />
            </div>
            <div class="form-group">
                <label class="form-label" for="exampleInputdate">Saldo Awal (Harga Aset)</label>
                <input type="text" class="form-control" id="rupiah" name="hargaAsset" placeholder="Masukkan nominal harga aset anda" />
            </div>
            <!-- <div class="form-group">
                <label class="form-label" for="exampleInputdate">Umur Ekonomis</label>
                <input type="text" class="form-control" id="exampleInputText1" name="umurEkonomis" placeholder="Masukkan umur ekonomis aset anda" />
            </div>
            <div class="form-group">
                <label class="form-label" for="exampleInputdate">Masa Penggunaan</label>
                <input type="text" class="form-control" id="exampleInputText1" name="masaPenggunaan" placeholder="Masukkan masa penggunaan aset anda" />
            </div> -->
            <button type="submit" class="btn btn-primary rounded">Tambah</button>
            <a class="btn btn-danger rounded" href="{{ url()->previous() }}">Batal</a>
        </form>
    </div>
</div>

@push('child-js')
    <script src="{{ asset('format/rupiah_format.js') }}"></script>
@endpush

@endsection