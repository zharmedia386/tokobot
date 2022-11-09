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
                @php
                    $totalPendapatan = 0;
                    $totalBeban = 0;
                    $totalLabaBersih = 0;
                @endphp
                <div class="card-body px-0">
                    <div class="table-responsive">
                        <table id="user-list-table" class="table table-striped">
                            <thead>
                                <tr>
                                    <th colspan="2">Pendapatan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($buku_kas as $data)
                                    @if($user_id == $data->user_id)
                                        @if(isset($data->nama_pemasukkan) & isset($data->harga_pemasukkan))
                                            <tr>
                                                <td>{{ $data->nama_pemasukkan }}</td>
                                                <td>@currency($data->harga_pemasukkan )</td>
                                            </tr>
                                        @endif
                                    @endif
                                    @php
                                        $totalPendapatan += $data->harga_pemasukkan;
                                    @endphp
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspans="2">Total Pendapatan : @currency($totalPendapatan)</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <!-- END PENDAPATAN -->

                <!-- START BEBAN -->
                <div class="card-body px-0">
                    <div class="table-responsive">
                        <table id="user-list-table" class="table table-striped">
                            <thead>
                                <tr>
                                    <th colspan="2">Beban</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($buku_kas as $data)
                                    @if($user_id == $data->user_id)
                                        @if(isset($data->nama_pengeluaran) & isset($data->harga_pengeluaran))
                                        <tr>
                                            <td>{{ $data->nama_pengeluaran }}</td>
                                            <td>@currency($data->harga_pengeluaran )</td>
                                        </tr>
                                        @endif
                                    @endif
                                    @php
                                        $totalBeban += $data->harga_pengeluaran;
                                    @endphp
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Total Beban : @currency($totalBeban)</th>
                                </tr>
                            </tfoot> 
                        </table>
                    </div>
                </div>
                <!-- END BEBAN -->
                @php
                    $totalLabaBersih = $totalPendapatan - $totalBeban;
                @endphp
                 <!-- START LABA BERSIH -->
                 <div class="card-body px-0">
                    <div class="table-responsive">
                        <table id="user-list-table" class="table table-striped">
                            <thead>
                                <tr>
                                    <th colspan="2">Laba Bersih</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th colspans="2">Total Laba Bersih : @currency($totalLabaBersih)</th>
                                </tr>
                            </tfoot> 
                        </table>
                    </div>
                </div>
                <!-- END LABA BERSIH -->       
            </div>
        </div>
    </div>
</div>
@endsection