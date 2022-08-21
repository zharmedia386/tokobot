@extends('layouts.master')
@section('title', 'kewajiban')
@section('content')

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between pb-0 border-0">
                <div class="header-title">
                    <h4 class="card-title">Kewajiban(Utang)</h4>
                </div> 
                <div class="button">
                    <a class="btn btn-outline-primary rounded" href="{{ route('tambah_kewajiban') }}">
                        + Tambah Kewajiban
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
                                <th>Jenis Kewajiban</th>
                                <th>Nama Kewajiban</th>
                                <th>Nominal</th>
                                <th>Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>2101</td>
                                <td>Jangka Pendek</td>
                                <td>Utang Bulanan</td>
                                <td>Rp 2.000.000</td>
                                <td><button type="button" class="btn btn-warning">Detail</button> </td>
                            </tr>
                            <tr>
                                <td>2201</td>
                                <td>Jangka Panjang</td>
                                <td>Utang Bank</td>
                                <td>Rp 55.000.000</td>
                                <td><button type="button" class="btn btn-warning">Detail</button> </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="4">Total Utang: Rp 57.000.000</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection