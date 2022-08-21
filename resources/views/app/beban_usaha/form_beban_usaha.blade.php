@extends('layouts.master-1')
@section('title', 'Form Beban Usaha')
@section('content')

<div class="card">
    <div class="card-header d-flex justify-content-between">
        <div class="header-title">
            <h4 class="card-title">Tambah Beban Usaha</h4>
        </div>
    </div>
    <div class="card-body">
        <form>
            <div class="form-group">
                <label class="form-label" for="exampleInputText1">Nama Beban Usaha</label>
                <input type="text" class="form-control" id="exampleInputText1" placeholder="Masukkan nama beban usaha anda" />
            </div>
            <div class="form-group">
                <label class="form-label" for="exampleInputdate">Saldo Awal (Harga Beban Usaha)</label>
                <input type="text" class="form-control" id="exampleInputText1" placeholder="Masukkan nominal harga beban usaha anda" />
            </div>
            <button type="submit" class="btn btn-primary rounded">Submit</button>
            <a class="btn btn-danger rounded" href="{{ url()->previous() }}">Cancel</a>
            
        </form>
    </div>
</div>


@endsection