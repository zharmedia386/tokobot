@extends('layouts.master')
@section('title', 'Laporan Posisi Keuangan')
@section('content')

<div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title fs-3">Laporan Posisi Keuangan Bulan X</h4>
                    </div>
                </div>
                <!-- START ASET -->
                <div class="card-body px-0">
                    {{-- <p class="text-dark">◉ Aset</p> --}}
                    <div class="table-responsive">
                        <table id="user-list-table" class="table table-striped" {{--data-toggle="data-table"--}}>
                            <thead>
                                <tr>
                                    <tr>
                                        <th colspan="2">Aset</th>
                                    </tr>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">Aset 1 (namanya apa)</th>
                                    <td>@currency(10000)</td>
                                </tr>
                                <tr>
                                    <th scope="row">Aset 2 (namanya apa)</td>
                                    <td>@currency(20000)</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-body px-0">
                    {{-- <p class="text-dark">◉ Beban</p> --}}
                    <div class="table-responsive">
                        <table id="user-list-table" class="table table-striped" {{--role="grid" data-toggle="data-table"--}}>
                            <thead>
                                <tr>
                                    <th>Total Aset</th>
                                    <td>@currency(10000)</td>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div> 
                <!-- END ASET -->

                <!-- START UTANG -->
                <div class="card-body px-0">
                    {{-- <p class="text-dark">◉ Aset</p> --}}
                    <div class="table-responsive">
                        <table id="user-list-table" class="table table-striped" {{--data-toggle="data-table"--}}>
                            <thead>
                                <tr>
                                    <tr>
                                        <th colspan="2">Utang dan Modal</th>
                                    </tr>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">Utang</th>
                                    <td>@currency(10000)</td>
                                </tr>
                                <tr>
                                    <th scope="row">Modal</td>
                                    <td>@currency(20000)</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- END UTANG -->
                
                <div class="card-body px-0">
                    {{-- <p class="text-dark">◉ Beban</p> --}}
                    <div class="table-responsive">
                        <table id="user-list-table" class="table table-striped" {{--role="grid" data-toggle="data-table"--}}>
                            <thead>
                                <tr>
                                    <th>Total Utang dan Modal</th>
                                    <td>@currency(10000)</td>
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