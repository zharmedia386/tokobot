@extends('layouts.master')
@section('title', 'Perubahan Modal')
@section('content')

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between pb-0 border-0">
                <div class="header-title">
                    <h4 class="card-title">Perubahan Modal</h4>
                </div> 
                <!-- <div class="button">
                    <a class="btn btn-outline-primary rounded" href="{{ route('tambah_kreditur') }}">
                        + Tambah Kreditur
                    </a>
                </div> -->
            </div>
            <div class="card-body">
                <br>
                <div class="table-responsive">
                    <table id="datatable" class="table table-striped" data-toggle="data-table">
                        <thead>
                            <tr>
                                <th>Modal Awal</th>
                                <th>Tambahan</th>
                                <th>Total</th>
                                <th>Prive Pemilik</th>
                                <th>Modal Akhir</th>
                            </tr>
                        </thead>
                        <tbody>
                                <tr>
                                    <td>Rp 10.000.000</td>
                                    <td>Rp 5.000.000</td>
                                    <td>Rp 15.000.000</td>
                                    <td>Rp 3.000.000</td>
                                    <td>Rp 12.000.000</td>
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