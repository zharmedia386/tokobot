@extends('layouts.master-1')
@section('title', 'Invoice Penjualan Kredit')
@section('content')

<div class="card">
    <div class="card-header d-flex justify-content-between">
        <div class="header-title">
            <h4 class="card-title">Penjualan Kredit</h4>
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
        
        <form action="{{ route('sales_form_kredit_post') }}" method="POST">
            @csrf
            <div class="form-group">
                <label class="form-label" for="exampleInputText1">Nomor Transaksi</label>
                <input type="text" class="form-control" name="nomorTransaksi" id="exampleInputText1" disabled value="{{ $nomor_transaksi }}" />
            </div>
            <div class="form-group">
                <label class="form-label" for="exampleInputdate">Tanggal Transaksi</label>
                <input type="date" class="form-control" name="tanggalTransaksi" id="exampleInputdate" />
            </div>
            <div class="form-group">
                <label class="form-label">Metode Pembayaran</label>
                <select class="form-select mb-3 shadow-none" disabled="">
                    <option selected="">Kredit</option>
                    <option value="1">Tunai</option>
                </select>
                <input type="hidden" value="tunai" name="metodePembayaran" />
            </div>
            <div class="form-group">
                <label class="form-label">Nama Kreditur</label>
                <select class="form-select mb-3 shadow-none" name="namaKreditur">
                    @foreach($kreditur as $data)
                        @if($user_id == $data->user_id)
                            <option name="namaKreditur" value="{{ $data->nama_kreditur }}" selected=""> {{ $data->nama_kreditur }} </option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label class="form-label">Umur Utang</label>
                <select class="form-select mb-3 shadow-none" name="umurUtang">
                    <option name="umurUtang" value="15" selected="">Pilih Umur Utang</option>
                    <option name="umurUtang" value="15">15 hari</option>
                    <option name="umurUtang" value="30">30 hari</option>
                    <option name="umurUtang" value="60">60 hari</option>
                    <option name="umurUtang" value="90">90 hari</option>
                </select>
            </div>
            <div class="form-group">
                <label class="form-label" for="exampleInputText1">Denda Keterlambatan</label>
                <input type="text" class="form-control" id="rupiah" name="dendaKeterlambatan" placeholder="Masukkan Denda Keterlambatan.." />
            </div>
            <div class="form-group">
                <label class="form-label" for="exampleInputText1">Diskon Penjualan (%)</label>
                <input type="text" class="form-control" id="exampleInputText1" name="diskonPenjualan" placeholder="Masukkan Diskon Penjualan.." />
            </div>
            <div class="form-group">
                <label class="form-label" for="exampleInputText1">Nama Produk yang terjual</label>
                <input type="text" class="form-control" id="exampleInputText1" name="produkYangTerjual" placeholder="Masukkan Nama Produk yang terjual.." />
            </div>
            <div class="form-group">
                <label class="form-label" for="exampleInputText1">Pajak (%)</label>
                <input type="text" class="form-control" id="exampleInputText1" name="pajak" placeholder="Masukkan Pajak.." />
            </div>
            <div class="form-group">
                <label class="form-label" for="exampleInputText1">Jumlah Barang</label>
                <input type="text" class="form-control" id="exampleInputText1" name="jumlahBarang" placeholder="Masukkan Jumlah Barang.." />
            </div>
            <div class="form-group">
                <label class="form-label">Satuan Barang</label>
                <select class="form-select mb-3 shadow-none" name="satuanBarang">
                    <option name="satuanBarang" value="1" selected="">Pilih Satuan Barang</option>
                    <option name="satuanBarang" value="1">Pcs</option>
                    <option name="satuanBarang" value="12">Lusin</option>
                    <option name="satuanBarang" value="144">Gross</option>
                    <option name="satuanBarang" value="20">Kodi</option>
                    <option name="satuanBarang" value="500">RIm</option>
                </select>
            </div>
            <div class="form-group">
                <label class="form-label" for="exampleInputText1">Harga Satuan</label>
                <input type="text" class="form-control" id="rupiah_2" name="hargaSatuan" placeholder="Masukkan Harga Satuan.." />
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