@extends('layouts.master')
@section('title', 'Modal Awal')
@section('content')

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between pb-0 border-0">
                <div class="header-title">
                    <h4 class="card-title">Modal Awal</h4>
                </div> 
                <div class="dropdown">
                    <a class="btn btn-outline-warning rounded" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                        + Tambah Modal Awal
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item active" href="{{ route('modal_awal_aset_usaha') }}">Aset Usaha</a></li>
                        <li><a class="dropdown-item" href="{{ route('modal_awal_persediaan_barang_dagang') }}">Persediaan Barang Dagang</a></li>
                    </ul>
                </div>
            </div>
            <div class="card-body">
                <br>
                <div class="table-responsive">
                    <table id="datatable" class="table table-striped" data-toggle="data-table">
                        <thead class="text-center">
                            <tr>
                                <th>Modal ID </th>
                                <th>Nama Modal</th>
                                <th>Jenis Modal</th>
                                <th>Harga Modal</th>
                                <th>Detail</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                        @php
                        $totalModal = 0;
                        @endphp
                        @foreach($modal_awal as $data)
                            @if($user_id == $data->user_id)
                                <tr>
                                    <td>{{ $data->modal_awal_id }}</td>
                                    <td>{{ $data->nama_modal }}</td>
                                    <td>{{ $data->jenis_modal }}</td>
                                    <td class="text-end">@currency($data->harga_modal)</td>
                                    <td><a href="{{ route('modal_detail', $data->modal_awal_id) }}" class="btn btn-warning">Detail</a></td>
                                </tr>
                                @php
                                    $totalModal += $data->harga_modal;
                                @endphp
                            @endif
                        @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="4">Total Modal Awal: @currency($totalModal)</th>
                                <tr>
                                <th colspans="4">Saldo : @currency($totalModal)</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection