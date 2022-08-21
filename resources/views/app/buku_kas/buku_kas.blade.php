@extends('layouts.master')
@section('title', 'Buku Kas')
@section('content')

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between pb-0 border-0">
                <div class="header-title">
                    <h4 class="card-title">Buku Kas</h4>
                </div> 
                <div class="button">
                    <a class="btn btn-outline-primary rounded" href="{{ route('tambah_kas') }}">
                        + Tambah Kas
                    </a>
                </div>
            </div>
            <div class="card-body">
                <br>
                <p>Saldo : Rp 10.000.000</p>
                <div class="table-responsive">
                    <table id="datatable" class="table table-striped" data-toggle="data-table">
                        <thead>
                            <tr>
                                <th>Tanggal </th>
                                <th>Keterangan</th>
                                <th>Pemasukkan</th>
                                <th>Pengeluaran</th>
                                <th>Total</th>
                                <th>Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>01/01/2022</td>
                                <td>Penjualan, Biaya Operasional</td>
                                <td>Rp 50.000.000</td>
                                <td>Rp 10.000.000</td>
                                <td>Rp 40.000.000</td>
                                <td><button type="button" class="btn btn-warning">Detail</button> </td>
                            </tr>
                            <tr>
                                <td>01/02/2022</td>
                                <td>Terima Pinjaman, Biaya Operasional</td>
                                <td>Rp 20.000.000</td>
                                <td>Rp 10.000.000</td>
                                <td>Rp 10.000.000</td>
                                <td><button type="button" class="btn btn-warning">Detail</button> </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="4">Total kas: Rp 60.000.000</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection