@extends('layouts.master-1')
@section('title', 'Detail Modal')
@section('content')

<div class="card">
    <div class="card-header d-flex justify-content-between">
        <div class="header-title">
            <h4 class="card-title">Detail Modal</h4>
        </div>
    </div>
    <div class="card-body">
        <form>
            <div class="form-group">
                <label class="form-label" for="exampleInputText1">Modal ID</label>
                <input type="text" class="form-control" id="exampleInputText1" name="nomorAsset" disabled value="{{ $modal[0]->modal_id }}" />
            </div>
            <div class="form-group">
                <label class="form-label" for="exampleInputText1">Nama Modal</label>
                <input type="text" class="form-control" id="exampleInputText1" disabled value="{{ $modal[0]->nama_modal }}" />
            </div>
            <div class="form-group">
                <label class="form-label" for="exampleInputdate">Saldo Awal (Harga Modal)</label>
                <input type="text" class="form-control" id="exampleInputText1" disabled value="{{ $modal[0]->harga_modal }}" />
            </div>
            <a class="btn btn-danger rounded" href="{{ url()->previous() }}">Kembali</a>
            
        </form>
    </div>
</div>


@endsection