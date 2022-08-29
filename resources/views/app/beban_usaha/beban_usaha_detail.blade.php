@extends('layouts.master-1')
@section('title', 'Detail Beban Usaha')
@section('content')

<div class="card">
    <div class="card-header d-flex justify-content-between">
        <div class="header-title">
            <h4 class="card-title">Detail Beban Usaha</h4>
        </div>
    </div>
    <div class="card-body">
        <form action="{{ route('beban_usaha_form_post') }}" method="POST">
            @csrf
            <div class="form-group">
                <label class="form-label" for="exampleInputText1">Beban Usaha ID</label>
                <input type="text" class="form-control" id="exampleInputText1" name="bebanUsahaId" disabled value="{{ $beban_usaha[0]->beban_usaha_id }}" />
            </div>
            <div class="form-group">
                <label class="form-label" for="exampleInputText1">Nama Beban Usaha</label>
                <input type="text" class="form-control" name="namaBebanUsaha" id="exampleInputText1" disabled value="{{ $beban_usaha[0]->nama_beban_usaha }}" />
            </div>
            <div class="form-group">
                <label class="form-label" for="exampleInputdate">Saldo Awal (Harga Beban Usaha)</label>
                <input type="text" class="form-control" name="hargaBebanUsaha" id="rupiah" disabled value="{{ $beban_usaha[0]->harga_beban_usaha }}" />
            </div>
            <a class="btn btn-danger rounded" href="{{ url()->previous() }}">Cancel</a>
            
        </form>
    </div>
</div>

@push('child-js')
    <script src="{{ asset('format/rupiah_format.js') }}"></script>
@endpush

@endsection