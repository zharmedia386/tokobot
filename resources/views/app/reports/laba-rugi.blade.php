@extends('layouts.master')
@section('title', 'Laporan Laba Rugi')
@section('content')

<div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title fs-3">Laporan Laba Rugi Bulan X</h4>
                    </div>
                </div>
                <!-- START PENDAPATAN -->
                <div class="card-body px-0">
                    {{-- <p class="text-dark">◉ Pendapatan</p> --}}
                    <div class="table-responsive">
                        <table id="user-list-table" class="table table-striped" {{--role="grid" data-toggle="data-table"--}}>
                            <thead>
                                <tr>
                                    <th colspan="2">Pendapatan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">Pendapatan 1</th>
                                    <td>@currency(10000)</td>
                                </tr>
                                <tr>
                                    <th scope="row">Pendapatan 2</td>
                                    <td>@currency(20000)</td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspans="2">Saldo : @currency(30000)</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <!-- END PENDAPATAN -->

                <!-- START BEBAN -->
                <div class="card-body px-0">
                    {{-- <p class="text-dark">◉ Beban</p> --}}
                    <div class="table-responsive">
                        <table id="user-list-table" class="table table-striped" {{--role="grid" data-toggle="data-table"--}}>
                            <thead>
                                <tr>
                                    <th colspan="2">Beban</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">Beban 1</th>
                                    <td>@currency(5000)</td>
                                </tr>
                                <tr>
                                    <th scope="row">Beban 2</td>
                                    <td>@currency(15000)</td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspans="2">Saldo : @currency(20000)</th>
                                </tr>
                            </tfoot> 
                        </table>
                    </div>
                </div>
                <!-- END BEBAN -->
                <div class="card-body px-0">
                    {{-- <p class="text-dark">◉ Beban</p> --}}
                    <div class="table-responsive">
                        <table id="user-list-table" class="table table-striped" {{--role="grid" data-toggle="data-table"--}}>
                            <thead>
                                <tr>
                                    <th scope="row">Laba Bersih</th>
                                    <th>@currency(10000)</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>        
            </div>
        </div>
    </div>
</div>
@endsection