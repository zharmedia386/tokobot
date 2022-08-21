@extends('layouts.master')
@section('title', 'Asset')
@section('content')

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between pb-0 border-0">
                <div class="header-title">
                    <h4 class="card-title">Asset</h4>
                </div> 
                <div class="button">
                    <a class="btn btn-outline-primary rounded" href="{{ route('asset_form') }}">
                        + Tambah Asset
                    </a>
                </div>
            </div>
            <div class="card-body">
                <br>
                <div class="table-responsive">
                    <table id="datatable" class="table table-striped" data-toggle="data-table">
                        <thead>
                            <tr>
                                <th>Nomor Asset</th>
                                <th>Jenis Asset</th>
                                <th>Nama Asset</th>
                                <th>Harga Asset</th>
                                <th>Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($asset as $data)
                                @if($user_id == $data->user_id)
                                    <tr>
                                        <td>{{ $data->nomor_asset }}</td>
                                        <td>{{ $data->jenis_asset }}</td>
                                        <td>{{ $data->nama_asset }}</td>
                                        <td>{{ $data->harga_asset }}</td>
                                        <td><a href="{{ route('asset_detail', $data->nomor_asset) }}" class="btn btn-warning">Detail</a></td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="4">Total Asset: Rp1000000000000000000000000</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection