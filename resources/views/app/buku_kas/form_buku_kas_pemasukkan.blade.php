@extends('layouts.master-1')
@section('title', 'Form Buku Kas Pemasukkan')
@section('content')

<div class="card">
    <div class="card-header d-flex justify-content-between">
        <div class="header-title">
            <h4 class="card-title">Tambah Kas Pemasukkan</h4>
        </div>
    </div>
    <div class="card-body">
        <form action="{{ route('tambah_kas_pemasukkan_post') }}" method="POST">
            @csrf
            <div class="form-group">
                <label class="form-label" for="exampleInputText1">Kas ID</label>
                <input type="text" class="form-control" name="kasID" id="exampleInputText1" disabled value="{{ $kas_id }}" />
            </div>
            <div class="form-group">
                <label class="form-label" for="exampleInputdate">Tanggal Transaksi</label>
                <input type="date" class="form-control" name="tanggal" id="exampleInputdate" />
            </div>
            <div class="form-group">
                <label class="form-label">Kategori Pemasukkan</label>
                <select class="form-select mb-3 shadow-none" name="pemasukkan">
                    <option name="pemasukkan" value="Penjualan" selected="">Pilih Kategori Pemasukkan</option>
                    <option name="pemasukkan" value="Penjualan">Penjualan</option>
                    <option name="pemasukkan" value="Penambahan modal">Penambahan modal </option>
                    <option name="pemasukkan" value="Pendapatan di luar usaha">Pendapatan di luar usaha</option>
                    <option name="pemasukkan" value="Pendapatan lain-lain">Pendapatan lain-lain</option>
                    <option name="pemasukkan" value="Pendapatan jasa/komisi">Pendapatan jasa/komisi</option>
                    <option name="pemasukkan" value="Terima pinjaman">Terima pinjaman</option>
                    <option name="pemasukkan" value="Penagihan utang">Penagihan utang</option>
                    <option name="pemasukkan" value="Pendapatan investasi">Pendapatan investasi</option>
                </select>
            </div>
            <div class="form-group">
                <label class="form-label" for="exampleInputText1">Harga Pemasukkan</label>
                <input type="text" class="form-control" name="hargaPemasukkan" id="rupiah" placeholder="Masukkan nominal pemasukkan anda" />
            </div>
            <button type="submit" class="btn btn-primary rounded">Tambah</button>
            <a class="btn btn-danger rounded" href="{{ url()->previous() }}">Kembali</a>
        </form>
    </div>
</div>

@push('child-js')
    <script src="{{ asset('format/rupiah_format.js') }}"></script>
@endpush

@endsection