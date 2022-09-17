@extends('layouts.master-1')
@section('title', 'Tambah Modal Awal')
@section('content')

<div class="card">
    <div class="card-header d-flex justify-content-between">
        <div class="header-title">
            <h4 class="card-title">Tambah Modal Awal</h4>
        </div>
    </div>
    <div class="card-body">
        <form action="{{ route('modal_awal_form_post') }}" method="POST">
            @csrf
            <div class="form-group">
                <label class="form-label" for="exampleInputText1">Modal ID</label>
                <input type="text" class="form-control" name="modalID" id="exampleInputText1" disabled value="{{ $modal_id }}" />
            </div>
            <div class="form-group">
                <label class="form-label" for="exampleInputText1">Nama Modal</label>
                <input type="text" class="form-control" name="namaModal" id="exampleInputText1" placeholder="Masukkan nama modal anda" />
            </div>
            <div class="form-group">
                <label class="form-label" for="exampleInputdate">Saldo Awal (Harga Modal)</label>
                <input type="text" class="form-control" name="hargaModal" id="rupiah" placeholder="Masukkan nominal harga modal anda" />
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