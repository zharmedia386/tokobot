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
        <!-- ALERT MAKING SURE THERE'S NO EMPTY FIELDS-->
        @if (session()->has('emptyFields'))
        <div id="alerts-disimissible-component">
            <div class="alert alert-left alert-info  alert-dismissible fade show fs-7" role="alert">
                {{ session('emptyFields') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"> </button>
            </div>
        </div>
        @endif
        
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
                <select class="form-select mb-3 shadow-none" name="pengeluaran" id="seeAnotherField">
                    <option name="pengeluaran" value="Pengeluaran di luar usaha" selected="">Pilih Kategori Pengeluaran</option>
                    <option name="pengeluaran" value="Pengeluaran di luar usaha">Pengeluaran di luar usaha</option>
                    <option name="pengeluaran" value="Biaya operasional">Biaya operasional</option>
                    <option name="pengeluaran" value="Pembayaran Utang">Pembayaran Utang</option>
                    <option name="pengeluaran" value="Gaji/bonus karyawan">Gaji/bonus karyawan</option>
                    <!-- <option name="pengeluaran" value="Pemberian utang">Pemberian utang (Piutang)</option>
                    <option name="pengeluaran" value="Pembayaran utang">Pembayaran utang</option> -->
                    <option name="pengeluaran" value="Pengeluaran lain-lain">Pengeluaran lain-lain</option>
                    <option name="pengeluaran" value="Penarikan Sebagian asset/modal untuk keperluan pribadi">Penarikan Sebagian aset/modal untuk keperluan pribadi</option>
                </select>
            </div>
            <div class="form-group" id="otherFieldDiv">
                <label class="form-label">Nama Supplier</label>
                <select class="form-select mb-3 shadow-none" name="namaSupplier" id="otherField">
                    @foreach($supplier as $data)
                        @if($user_id == $data->user_id)
                            <option name="namaSupplier" value="{{ $data->nama_supplier }}" selected=""> {{ $data->nama_supplier }} </option>
                        @endif
                    @endforeach
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
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="{{ asset('format/rupiah_format.js') }}"></script>
<script src="{{ asset('form/hide-show-field.js') }}"></script>
@endpush

@endsection