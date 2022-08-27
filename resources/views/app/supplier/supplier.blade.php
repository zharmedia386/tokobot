@extends('layouts.master')
@section('title', 'Supplier')
@section('content')

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between pb-0 border-0">
                <div class="header-title">
                    <h4 class="card-title">Supplier</h4>
                </div> 
                <div class="button">
                    <a class="btn btn-outline-primary rounded" href="{{ route('tambah_supplier') }}">
                        + Tambah Supplier
                    </a>
                </div>
            </div>
            <div class="card-body">
                <br>
                <div class="table-responsive">
                    <table id="datatable" class="table table-striped" data-toggle="data-table">
                        <thead>
                            <tr>
                                <th>Nama Supplier</th>
                                <th>Alamat</th>
                                <th>Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>PT Ciwaruga</td>
                                <td>Jl. Ciwaruga</td>
                                <td><button type="button" class="btn btn-warning">Detail</button> </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection