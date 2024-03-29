@extends('layouts.master-1')
@section('title', 'Form Utang')
@section('content')

<div class="card">
    <div class="card-header d-flex justify-content-between">
        <div class="header-title">
            <h4 class="card-title">Tambah Utang</h4>
        </div>
    </div>
    <div class="card-body">
        <!-- ALERT MAKING SURE THERE'S NO EMPTY FIELDS-->
        @if (session()->has('emptyFields'))
        <div id="alerts-disimissible-component">
            <div class="alert alert-left alert-info  alert-dismissible fade show fs-7" role="alert">
                {{ session('emptyFields') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"> </button>
            </div>
        </div>
        @endif
        
        <form action="{{ route('buku_utang_form_utang_post') }}" method="POST">
            @csrf
            <div class="form-group">
                <label class="form-label" for="exampleInputText1">Nomor Utang</label>
                <input type="text" class="form-control" name="nomorUtang" id="rupiah" disabled value="{{ $nomor_utang }}" />
            </div>
            <div class="form-group">
                <label class="form-label" for="exampleInputdate">Tanggal</label>
                <input type="date" class="form-control" name="tanggal" id="exampleInputdate" />
            </div>
            <div class="form-group">
                <label class="form-label" for="exampleInputText1">Nama Utang</label>
                <input type="text" class="form-control" id="exampleInputText1" name="nama" placeholder="Masukkan Nama.." />
            </div>
            <div class="form-group">
                <label class="form-label">Nama Supplier</label>
                <select class="form-select mb-3 shadow-none" name="namaSupplier">
                    @foreach($supplier as $data)
                        @if($user_id == $data->user_id)
                            <option name="namaSupplier" value="{{ $data->nama_supplier }}" selected=""> {{ $data->nama_supplier }} </option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label class="form-label" for="exampleInputText1">Jumlah Utang</label>
                <input type="text" class="form-control" id="rupiah_2" name="jumlahUtang" placeholder="Masukkan Jumlah Utang.." />
            </div>
            <button type="submit" class="btn btn-primary rounded">Tambah</button>
            <a class="btn btn-danger rounded" href="{{ url()->previous() }}">Batal</a>
        </form>
    </div>
</div>

@push('child-js')
    <script src="{{ asset('format/rupiah_format.js') }}"></script>
@endpush

@endsection