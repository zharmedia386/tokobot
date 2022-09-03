@extends('layouts.master')
@section('title', 'stok_barang')
@section('content')

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between pb-0 border-0">
                <div class="header-title">
                    <h4 class="card-title">Stok Barang</h4>
                </div>
                <!-- <div class="button">
                    <a class="btn btn-outline-primary rounded" href="{{ route('stok_barang_form') }}">
                        + Tambah Stok Barang
                    </a>
                </div>  -->
            </div>
                <br>
                <div class="table-responsive">
                    <table id="datatable" class="table table-striped" data-toggle="data-table">
                        <thead>
                            <tr>
                                <th>Kode Barang</th>
                                <th>Nama Barang</th>
                                <th>Harga per Unit</th>
                                <th>Jumlah Stok</th>
                                <th>Total</th>
                                <th>Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $totalHargaStok = 0;
                            @endphp
                            @foreach($stok_barang as $data)
                                @if($user_id == $data->user_id)
                                    <tr>
                                        <td>{{ $data->kode_barang }}</td>
                                        <td>{{ $data->nama_barang }}</td>
                                        <td>{{ $data->harga_satuan }}</td>
                                        <td>{{ $data->jumlah_stok }}</td>
                                        <td>{{ $data->total_harga }}</td>
                                        <td><a href="{{ route('stok_barang_detail', $data->stok_id) }}" class="btn btn-warning">Detail</a></td>
                                    </tr>
                                    @php
                                        $totalHargaStok += $data->total_harga;
                                    @endphp
                                @endif
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="4">Total Harga Stok: @currency($totalHargaStok)</th>
                                <tr>
                                <th colspans="4">Saldo : @currency($totalHargaStok)</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
