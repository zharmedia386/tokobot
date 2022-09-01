@extends('layouts.master-1')
@section('title', 'Form Kewajiban Detail')
@section('content')

<div class="card">
    <div class="card-header d-flex justify-content-between">
        <div class="header-title">
            <h4 class="card-title">Tambah Kewajiban(Utang) Detail</h4>
        </div>
    </div>
    <div class="card-body">
        <form method="GET">
            <div class="form-group">
                <label class="form-label" for="exampleInputText1">Nomor Kewajiban</label>
                <input type="text" class="form-control" id="exampleInputText1" name="nomorKewajiban" disabled value="{{ $kewajiban[0]->nomor_kewajiban }}" />
            </div>
            <div class="form-group">
                <label class="form-label">Jenis Kewajiban(Utang)</label>
                <select class="form-select mb-3 shadow-none" name="jenisKewajiban" disabled="disabled">
                    <option name="jenisKewajiban" value="Jangka Pendek" selected="">Pilih Jenis Kewajiban(Utang)</option>
                    <option name="jenisKewajiban" value="Jangka Pendek">Jangka Pendek</option>
                    <option name="jenisKewajiban" value="Jangka Panjang">Jangka Panjang</option>
                </select>
            </div>
            <div class="form-group">
                <label class="form-label" for="exampleInputText1">Nama Kewajiban</label>
                <input type="text" class="form-control" id="exampleInputText1" name="namaKewajiban" disabled value="{{ $kewajiban[0]->nama_kewajiban }}" />
            </div>
            <div class="form-group">
                <label class="form-label" for="exampleInputdate">Nominal</label>
                <input type="text" class="form-control" id="exampleInputText1" name="nominal" disabled value="{{ $kewajiban[0]->nominal }}" />
            </div>
            <button type="submit" class="btn btn-primary rounded">Tambah</button>
            <a class="btn btn-danger rounded" href="{{ url()->previous() }}">Kembali</a>
        </form>
    </div>
</div>


@endsection