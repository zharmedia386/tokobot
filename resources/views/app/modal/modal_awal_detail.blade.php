@extends('layouts.master-1')
@section('title', 'Detail Modal Awal')
@section('content')

<div class="card">
    <div class="card-header d-flex justify-content-between">
        <div class="header-title">
            <h4 class="card-title">Detail Modal Awal</h4>
        </div>
    </div>
    <div class="card-body">
        <form>
            <div class="form-group">
                <label class="form-label" for="exampleInputText1">Modal Awal ID</label>
                <input type="text" class="form-control" id="exampleInputText1" name="nomorAsset" disabled value="{{ $modal_awal[0]->modal_awal_id }}" />
            </div>
            <div class="form-group">
                <label class="form-label" for="exampleInputText1">Nama Modal</label>
                <input type="text" class="form-control" id="exampleInputText1" disabled value="{{ $modal_awal[0]->nama_modal }}" />
            </div>
            <div class="form-group">
                <label class="form-label" for="exampleInputdate">Saldo Awal (Harga Modal)</label>
                <input type="text" class="form-control" id="exampleInputText1" disabled value="{{ $modal_awal[0]->harga_modal }}" />
            </div>
            <div class="form-group">
                <label class="form-label" for="exampleInputdate">Jenis Modal </label>
                <input type="text" class="form-control" id="exampleInputText1" disabled value="{{ $modal_awal[0]->jenis_modal }}" />
            </div>
            <div class="form-group">
                <label class="form-label" for="exampleInputdate">Harga Satuan </label>
                <input type="text" class="form-control" id="exampleInputText1" disabled value="{{ $modal_awal[0]->harga_satuan }}" />
            </div>
            <a class="btn btn-danger rounded" href="{{ url()->previous() }}">Kembali</a>
            
        </form>
    </div>
</div>


@endsection