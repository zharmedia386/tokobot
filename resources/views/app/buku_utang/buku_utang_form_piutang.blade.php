@extends('layouts.master-1')
@section('title', 'Form Piutang')
@section('content')

<div class="card">
    <div class="card-header d-flex justify-content-between">
        <div class="header-title">
            <h4 class="card-title">Tambah Piutang</h4>
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
        
        <form action="{{ route('buku_utang_form_piutang_post') }}" method="POST">
            @csrf
            <div class="form-group">
                <label class="form-label" for="exampleInputText1">Nomor Piutang</label>
                <input type="text" class="form-control" name="nomorPiutang" id="exampleInputText1" disabled value="{{ $nomor_piutang }}" />
            </div>
            <div class="form-group">
                <label class="form-label" for="exampleInputdate">Tanggal</label>
                <input type="date" class="form-control" name="tanggal" id="exampleInputdate" />
            </div>
            <div class="form-group">
                <label class="form-label" for="exampleInputText1">Nama Piutang</label>
                <input type="text" class="form-control" id="exampleInputText1" name="nama" placeholder="Masukkan Nama.." />
            </div>
            <div class="form-group">
                <label class="form-label">Nama Kreditur</label>
                <select class="form-select mb-3 shadow-none" name="namaKreditur">
                    @foreach($kreditur as $data)
                        @if($user_id == $data->user_id)
                            <option name="namaKreditur" value="{{ $data->nama_kreditur }}" selected=""> {{ $data->nama_kreditur }} </option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label class="form-label" for="exampleInputText1">Jumlah Piutang</label>
                <input type="text" class="form-control" id="rupiah" name="jumlahPiutang" placeholder="Masukkan Jumlah Piutang.." />
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