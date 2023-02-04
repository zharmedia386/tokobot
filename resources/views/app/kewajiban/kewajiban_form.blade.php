@extends('layouts.master-1')
@section('title', 'Form Kewajiban')
@section('content')

<div class="card">
    <div class="card-header d-flex justify-content-between">
        <div class="header-title">
            <h4 class="card-title">Tambah Kewajiban(Utang)</h4>
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
        
        <form action="{{ route('kewajiban_form_post') }}" method="POST">
            @csrf
            <div class="form-group">
                <label class="form-label" for="exampleInputText1">Nomor Kewajiban</label>
                <input type="text" class="form-control" id="exampleInputText1" name="nomorKewajiban" disabled value="{{ $nomor_kewajiban }}" />
            </div>
            <div class="form-group">
                <label class="form-label">Jenis Kewajiban(Utang)</label>
                <select class="form-select mb-3 shadow-none" name="jenisKewajiban">
                    <option name="jenisKewajiban" value="Jangka Pendek" selected="">Pilih Jenis Kewajiban(Utang)</option>
                    <option name="jenisKewajiban" value="Jangka Pendek">Jangka Pendek</option>
                    <option name="jenisKewajiban" value="Jangka Panjang">Jangka Panjang</option>
                </select>
            </div>
            <div class="form-group">
                <label class="form-label" for="exampleInputText1">Nama Kewajiban</label>
                <input type="text" class="form-control" id="exampleInputText1" name="namaKewajiban" placeholder="Masukkan nama kewajiban(utang) anda" />
            </div>
            <div class="form-group">
                <label class="form-label" for="exampleInputdate">Nominal</label>
                <input type="text" class="form-control" id="rupiah" name="nominal" placeholder="Masukkan nominal kewajiban(utang) anda" />
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