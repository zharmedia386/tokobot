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
                    <a class="btn btn-outline-primary rounded" href="{{ route('tambah_asset') }}">
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
                                <th>Nomor </th>
                                <th>Jenis Asset</th>
                                <th>Nama Asset</th>
                                <th>Harga Asset</th>
                                <th>Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1201</td>
                                <td>Asset Tetap</td>
                                <td>Tanah</td>
                                <td>Rp 55.000.000</td>
                                <td><button type="button" class="btn btn-warning">Detail</button> </td>
                            </tr>
                            <tr>
                                <td>1101</td>
                                <td>Asset Lancar</td>
                                <td>Kas</td>
                                <td>Rp 55.000.000</td>
                                <td><button type="button" class="btn btn-warning">Detail</button> </td>
                            </tr>
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