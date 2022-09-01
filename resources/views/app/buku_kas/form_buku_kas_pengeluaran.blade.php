@extends('layouts.master-1')
@section('title', 'Form Buku Kas Pengeluaran')
@section('content')

<div class="card">
    <div class="card-header d-flex justify-content-between">
        <div class="header-title">
            <h4 class="card-title">Tambah Kas Pengeluaran</h4>
        </div>
    </div>
    <div class="card-body">
        <form action="{{ route('tambah_kas_pengeluaran_post') }}" method="POST">
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
                <label class="form-label">Kategori Pengeluaran</label>
                <select class="form-select mb-3 shadow-none" name="pengeluaran">
                    <option name="pengeluaran" value="Pengeluaran di luar usaha" selected="">Pilih Kategori Pengeluaran</option>
                    <option name="pengeluaran" value="Pengeluaran di luar usaha">Pengeluaran di luar usaha</option>
                    <option name="pengeluaran" value="Biaya operasional">Biaya operasional</option>
                    <option name="pengeluaran" value="Gaji/bonus karyawan">Gaji/bonus karyawan</option>
                    <option name="pengeluaran" value="Pemberian utang">Pemberian utang</option>
                    <option name="pengeluaran" value="Pembayaran utang">Pembayaran utang</option>
                    <option name="pengeluaran" value="Pengeluaran lain-lain">Pengeluaran lain-lain</option>
                    <option name="pengeluaran" value="Penarikan Sebagian asset/modal untuk keperluan pribadi">Penarikan Sebagian asset/modal untuk keperluan pribadi</option>
                </select>
            </div>
            <div class="form-group">
                <label class="form-label" for="exampleInputdate">Harga Pengeluaran</label>
                <input type="text" class="form-control" name="hargaPengeluaran"id="rupiah" placeholder="Masukkan nominal pengeluaran anda" />
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