@extends('layouts.master')
@section('title', 'Modal')
@section('content')

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between pb-0 border-0">
                <div class="header-title">
                    <h4 class="card-title">Modal</h4>
                </div> 
                <div class="button">
                    <a class="btn btn-outline-primary rounded" href="{{ route('tambah_modal') }}">
                        + Tambah Modal
                    </a>
                </div>
            </div>
                <br>
                <div class="table-responsive">
                    <table id="datatable" class="table table-striped" data-toggle="data-table">
                        <thead class="text-center">
                            <tr>
                                <th>Nomor </th>
                                <th>Nama Modal</th>
                                <th>Harga Modal</th>
                                <th>Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>301</td>
                                <td>Modal usaha</td>
                                <td>Rp 50.000.000</td>
                                <td><button type="button" class="btn btn-warning">Detail</button> </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="4">Total Asset: Rp 50.000.000</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection