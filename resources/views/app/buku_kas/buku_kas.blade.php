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
                <div class="dropdown">
                    <a class="btn btn-outline-warning rounded" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                        + Tambah Kas
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item active" href="{{ route('tambah_kas_pemasukkan') }}">Pemasukkan</a></li>
                        <li><a class="dropdown-item" href="{{ route('tambah_kas_pengeluaran') }}">Pengeluaran</a></li>
                    </ul>
                </div>
            </div>
            <div class="card-body">
                <br>
                <p>Saldo : Rp 10.000.000</p>
                <div class="table-responsive">
                    <table id="datatable" class="table table-striped" data-toggle="data-table">
                        <thead>
                            <tr  class="text-center">
                                <th>Tanggal </th>
                                <th>Pemasukkan</th>
                                <th>Pengeluaran</th>
                                <th>Harga Pemasukkan</th>
                                <th>Harga Pengeluaran</th>
                                <th>Detail</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @php
                                $totalPemasukkan = 0;
                                $totalPengeluaran = 0;
                            @endphp
                            @foreach($buku_kas as $data)
                                @if($user_id == $data->user_id)
                                    <tr>
                                        <td>{{ $data->tanggal }}</td>

                                        @if(is_null($data->nama_pemasukkan))
                                            <td>-</td>
                                        @else
                                            <td>{{ $data->nama_pemasukkan }}</td>
                                        @endif

                                        @if(is_null($data->nama_pengeluaran))
                                            <td>-</td>
                                        @else
                                            <td>{{ $data->nama_pengeluaran }}</td>
                                        @endif

                                        <td  class="text-end">@currency($data->harga_pemasukkan)</td>
                                        <td  class="text-end">@currency($data->harga_pengeluaran)</td>
                                        <td><a href="{{ route('buku_kas_detail', $data->kas_id) }}" class="btn btn-warning">Detail</a></td>
                                    </tr>
                                    @php
                                        $totalPemasukkan += $data->harga_pemasukkan;
                                        $totalPengeluaran += $data->harga_pengeluaran;  
                                    @endphp
                                @endif
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="4">
                                    Total Pemasukkan: @currency($totalPemasukkan) <br>
                                    Total Pengeluaran: @currency($totalPengeluaran) <br>
                                    <tr>
                                    <th colspans="4">Saldo : @currency($totalPemasukkan-$totalPengeluaran)</th>
                                </th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection