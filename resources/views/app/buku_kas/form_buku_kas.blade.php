@extends('layouts.master-1')
@section('title', 'Form Buku Kas')
@section('content')

<div class="card">
    <div class="card-header d-flex justify-content-between">
        <div class="header-title">
            <h4 class="card-title">Tambah Kas</h4>
        </div>
    </div>
    <div class="card-body">
        <form>
            <div class="form-group">
                <label class="form-label" for="exampleInputdate">Tanggal Transaksi</label>
                <input type="date" class="form-control" name="tanggalTransaksi" id="exampleInputdate" />
            </div>
            <div class="form-group">
                <label class="form-label">Kategori Pemasukkan</label>
                <select class="form-select mb-3 shadow-none" name="pemasukkan">
                    <option name="pemasukkan" value="15" selected="">Pilih Kategori Pemasukkan</option>
                    <option name="Pemasukkan" value="Penjualan">Penjualan</option>
                    <option name="Pemasukkan" value="Penambahan modal">Penambahan modal </option>
                    <option name="Pemasukkan" value="60">Pendapatan di luar usaha</option>
                    <option name="Pemasukkan" value="90">Pendapatan lain-lain</option>
                    <option name="Pemasukkan" value="90">Pendapatan jasa/komisi</option>
                    <option name="Pemasukkan" value="90">Terima pinjaman</option>
                    <option name="Pemasukkan" value="90">Penagihan utang</option>
                    <option name="Pemasukkan" value="90">Pendapatan investasi</option>
                </select>
            </div>
            <div class="form-group">
                <label class="form-label" for="exampleInputText1">Nominal Pemasukkan</label>
                <input type="text" class="form-control" id="exampleInputText1" placeholder="Masukkan nominal pemasukkan anda" />
            </div>
            <div class="form-group">
                <label class="form-label">Kategori Pengeluaran</label>
                <select class="form-select mb-3 shadow-none" name="Pemasukkan">
                    <option name="Pemasukkan" value="15" selected="">Pilih Kategori Pengeluaran</option>
                    <option name="Pemasukkan" value="Penjualan">Pengeluaran di luar usaha</option>
                    <option name="Pemasukkan" value="Penambahan modal">Pembelian bahan baku</option>
                    <option name="Pemasukkan" value="60">Biaya operasional</option>
                    <option name="Pemasukkan" value="90">Gaji/bonus karyawan</option>
                    <option name="Pemasukkan" value="90">Pemberian utang</option>
                    <option name="Pemasukkan" value="90">Pembayaran utang</option>
                    <option name="Pemasukkan" value="90">Pengeluaran lain-lain</option>
                    <option name="Pemasukkan" value="90">Penarikan Sebagian asset/modal untuk keperluan pribadi</option>
                </select>
            </div>
            <div class="form-group">
                <label class="form-label" for="exampleInputdate">Nominal Pengeluaran</label>
                <input type="text" class="form-control" id="exampleInputText1" placeholder="Masukkan nominal pengeluaran anda" />
            </div>
            <button type="submit" class="btn btn-primary rounded">Submit</button>
            <a class="btn btn-danger rounded" href="{{ url()->previous() }}">cancel</a>
        </form>
    </div>
</div>


@endsection