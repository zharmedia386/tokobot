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
                <div class="button">
                    <a class="btn btn-outline-primary rounded" href="{{ route('stok_barang_form') }}">
                        + Tambah Stok Barang
                    </a>
                </div> 
            </div>
            <!--<div class="card-body">
                <ul class="nav nav-tabs" id="myTab-1" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="Tetap-tab" data-bs-toggle="tab" href="#Tetap" role="tab" aria-controls="Tetap" aria-selected="true">Asset Tetap</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="Asset Lancar-tab" data-bs-toggle="tab" href="#Asset Lancar" role="tab" aria-controls="Asset Lancar" aria-selected="false">Asset Lancar</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent-2">
                    <div class="tab-pane fade show active" id="Tetap" role="tabpanel" aria-labelledby="Tetap-tab">
                        <p>Asset Tetap</p>
                    </div>
                    <div class="tab-pane fade" id="Asset Lancar" role="tabpanel" aria-labelledby="Asset Lancar-tab">
                        <p>Asset Lancar</p>
                    </div>
                </div>-->
                <br>
                <div class="table-responsive">
                    <table id="datatable" class="table table-striped" data-toggle="data-table">
                        <thead>
                            <tr>
                                <th>Nomor </th>
                                <th>Nama Barang</th>
                                <th>Harga Per Unit</th>
                                <th>Jumlah Stok</th>
                                <th>Total</th>
                                <th>Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($stok_barang as $data)
                                @if($user_id == $data->user_id)
                                    <tr>
                                        <td>{{ $data->nomor_barang }}</td>
                                        <td>{{ $data->nama_barang }}</td>
                                        <td>{{ $data->harga_barang }}</td>
                                        <td>{{ $data->stok_barang }}</td>
                                        <td>50</td>
                                        <td><a href="{{ route('stok_barang_detail', $data->nomor_barang) }}" class="btn btn-warning">Detail</a></td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Nomor </th>
                                <th>Nama Barang</th>
                                <th>Harga Per Unit</th>
                                <th>Jumlah Stok</th>
                                <th>Total</th>
                                <th>Detail</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
