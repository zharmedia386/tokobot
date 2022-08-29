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
                                <th>Pemasukkan</th>
                                <th>Pengeluaran</th>
                                <th>Harga Pemasukkan</th>
                                <th>Harga Pengeluaran</th>
                                <th>Total Harga</th>
                                <th>Detail</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @php
                                $totalPemasukkan = 0;
                                $totalPengeluaran = 0;
                                $hargaTotal = 0;
                            @endphp
                            @foreach($buku_kas as $data)
                                @if($user_id == $data->user_id)
                                    <tr>
                                        <td>{{ $data->tanggal }}</td>
                                        <td>{{ $data->pemasukkan }}</td>
                                        <td>{{ $data->pengeluaran }}</td>
                                        <td  class="text-end">@currency($data->harga_pemasukkan)</td>
                                        <td  class="text-end">@currency($data->harga_pengeluaran)</td>
                                        <td  class="text-end">@currency($data->total_harga)</td>
                                        <td><a href="{{ route('buku_kas_detail', $data->kas_id) }}" class="btn btn-warning">Detail</a></td>
                                    </tr>
                                    @php
                                        $totalPemasukkan += $data->harga_pemasukkan;
                                        $totalPengeluaran += $data->harga_pengeluaran;  
                                        $hargaTotal += $data->harga_total;  
                                    @endphp
                                @endif
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="4">Total Pemasukkan: @currency($totalPemasukkan)</th>
                                <th colspan="4">Total Pengeluaran: @currency($totalPengeluaran)</th>
                                <th colspan="4">Total Kas: @currency($hargaTotal)</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection