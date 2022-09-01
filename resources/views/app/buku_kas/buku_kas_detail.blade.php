@extends('layouts.master-1')
@section('title', 'Buku Kas Detail')
@section('content')

<div class="card">
    <div class="card-header d-flex justify-content-between">
        <div class="header-title">
            <h4 class="card-title">Buku Kas Detail</h4>
        </div>
    </div>
    <div class="card-body">
        <form>
            <div class="form-group">
                <label class="form-label" for="exampleInputdate">Tanggal Transaksi</label>
                <input type="date" class="form-control" name="tanggal" id="exampleInputdate" disabled value="{{ $buku_kas[0]->tanggal }}"/>
            </div>
            <div class="form-group">
                <label class="form-label">Kategori Pemasukkan</label>
                <select class="form-select mb-3 shadow-none" name="pemasukkan" disabled>
                    <option name="pemasukkan" value="Penjualan" selected="">{{ $buku_kas[0]->nama_pemasukkan }}</option>
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
                <input type="text" class="form-control" name="hargaPemasukkan" id="exampleInputText1" disabled value="{{ $buku_kas[0]->harga_pemasukkan }}" />
            </div>
            <div class="form-group">
                <label class="form-label">Kategori Pengeluaran</label>
                <select class="form-select mb-3 shadow-none" name="pengeluaran" disabled>
                    <option name="pengeluaran" value="Pengeluaran di luar usaha" selected="">{{ $buku_kas[0]->nama_pengeluaran }}</option>
                    <option name="pengeluaran" value="Pengeluaran di luar usaha">Pengeluaran di luar usaha</option>
                    <option name="pengeluaran" value="Pembelian bahan baku">Pembelian bahan baku</option>
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
                <input type="text" class="form-control" name="hargaPengeluaran"id="exampleInputText1" disabled value="{{ $buku_kas[0]->harga_pengeluaran }}" />
            </div>
            <button type="submit" class="btn btn-primary rounded">Tambah</button>
            <a class="btn btn-danger rounded" href="{{ url()->previous() }}">Kembali</a>
        </form>
    </div>
</div>


@endsection