@extends('layouts.master-1')
@section('title', 'Tambah Supplier')
@section('content')

<div class="card">
    <div class="card-header d-flex justify-content-between">
        <div class="header-title">
            <h4 class="card-title">Tambah Supplier</h4>
        </div>
    </div>
    <div class="card-body">
        <form action="{{ route('tambah_supplier_post') }}" method="POST">
            @csrf
            <div class="form-group">
                <label class="form-label" for="exampleInputText1">Supplier ID</label>
                <input type="text" class="form-control" name="supplierID" id="exampleInputText1" disabled value="{{ $supplier_id }}" />
            </div>
            <div class="form-group">
                <label class="form-label" for="exampleInputText1">Nama Supplier</label>
                <input type="text" class="form-control" name="namaSupplier" id="exampleInputText1" placeholder="Masukkan nama supplier" />
            </div>
            <div class="form-group">
                <label class="form-label" for="exampleInputdate">Alamat</label>
                <input type="text" class="form-control" name="alamat" id="exampleInputText1" placeholder="Masukkan alamat supplier" />
            </div>
            <button type="submit" class="btn btn-primary rounded">Submit</button>
            <a class="btn btn-danger rounded" href="{{ url()->previous() }}">Cancel</a>
        </form>
    </div>
</div>


@endsection