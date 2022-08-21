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
        <form>
            <div class="form-group">
                <label class="form-label">Jenis Kewajiban(Utang)</label>
                <select class="form-select mb-3 shadow-none" name="umurPiutang">
                    <option name="umurPiutang" value="15" selected="">Pilih Jenis Kewajiban(Utang)</option>
                    <option name="umurPiutang" value="15">Jangka Pendek</option>
                    <option name="umurPiutang" value="30">Jangka Panjang</option>
                </select>
            </div>
            <div class="form-group">
                <label class="form-label" for="exampleInputText1">Nama Kewajiban</label>
                <input type="text" class="form-control" id="exampleInputText1" placeholder="Masukkan nama kewajiban(utang) anda" />
            </div>
            <div class="form-group">
                <label class="form-label" for="exampleInputdate">Nominal</label>
                <input type="text" class="form-control" id="exampleInputText1" placeholder="Masukkan nominal kewajiban(utang) anda" />
            </div>
            <button type="submit" class="btn btn-primary rounded">Submit</button>
            <a class="btn btn-danger rounded" href="{{ url()->previous() }}">cancel</a>
        </form>
    </div>
</div>


@endsection