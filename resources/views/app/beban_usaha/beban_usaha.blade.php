@extends('layouts.master')
@section('title', 'Beban Usaha')
@section('content')

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between pb-0 border-0">
                <div class="header-title">
                    <h4 class="card-title">Beban Usaha</h4>
                </div> 
                <div class="button">
                    <a class="btn btn-outline-primary rounded" href="{{ route('tambah_beban_usaha') }}">
                        + Tambah Beban Usaha
                    </a>
                </div>
            </div>
                <br>
                <div class="table-responsive">
                    <table id="datatable" class="table table-striped" data-toggle="data-table">
                        <thead class="text-center">
                            <tr>
                                <th>Nomor </th>
                                <th>Nama Beban Usaha</th>
                                <th>Harga Beban Usaha</th>
                                <th>Detail</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @php
                                $totalBebanUsaha = 0;
                            @endphp
                            @foreach($beban_usaha as $data)
                                @if($user_id == $data->user_id)
                                    <tr>
                                        <td>{{ $data->beban_usaha_id }}</td>
                                        <td>{{ $data->nama_beban_usaha }}</td>
                                        <td>@currency($data->harga_beban_usaha)</td>
                                        <td><a href="{{ route('beban_usaha_detail', $data->beban_usaha_id) }}" class="btn btn-warning">Detail</a></td>
                                    </tr>
                                    @php
                                        $totalBebanUsaha += $data->harga_beban_usaha;
                                    @endphp
                                @endif
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="4">Total Beban Usaha: @currency($totalBebanUsaha)</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection