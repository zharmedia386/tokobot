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
        <form>
            <div class="form-group">
                <label class="form-label" for="exampleInputText1">Nama Kreditur</label>
                <input type="text" class="form-control" id="exampleInputText1" placeholder="Masukkan nama kreditur" />
            </div>
            <div class="form-group">
                <label class="form-label" for="exampleInputdate">Alamat</label>
                <input type="text" class="form-control" id="exampleInputText1" placeholder="Masukkan alamat kreditur" />
            </div>
            <button type="submit" class="btn btn-primary rounded">Submit</button>
            <a class="btn btn-danger rounded" href="{{ url()->previous() }}">Cancel</a>
            
        </form>
    </div>
</div>


@endsection