@extends('layouts.master')
@section('title', 'Asset')
@section('content')

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between pb-0 border-0">
                <div class="header-title">
                    <h4 class="card-title">Aset</h4>
                </div> 
                <div class="button">
                    <a class="btn btn-outline-primary rounded" href="{{ route('asset_form') }}">
                        + Tambah Aset
                    </a>
                </div>
            </div>
            <div class="card-body">
                <br>
                <div class="table-responsive">
                    <table id="datatable" class="table table-striped" data-toggle="data-table">
                        <thead class="text-center">
                            <tr>
                                <th>Nomor Aset</th>
                                <th>Jenis Aset</th>
                                <th>Nama Aset</th>
                                <th>Harga Aset</th>
                                <th>Detail</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @php
                                $totalAsset = 0;
                            @endphp
                            @foreach($asset as $data)
                                @if($user_id == $data->user_id)
                                    <tr>
                                        <td>{{ $data->nomor_asset }}</td>
                                        <td>{{ $data->jenis_asset }}</td>
                                        <td>{{ $data->nama_asset }}</td>
                                        <td class="text-end">@currency($data->harga_asset)</td>
                                        <td><a href="{{ route('asset_detail', $data->nomor_asset) }}" class="btn btn-warning">Detail</a></td>
                                    </tr>
                                    @php
                                        $totalAsset += $data->harga_asset;
                                    @endphp
                                @endif
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="4">Total Aset: @currency($totalAsset)</th>
                                <tr>
                                <th colspans="4">Saldo : @currency($totalAsset)</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection