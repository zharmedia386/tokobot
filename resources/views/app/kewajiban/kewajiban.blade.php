@extends('layouts.master')
@section('title', 'kewajiban')
@section('content')

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between pb-0 border-0">
                <div class="header-title">
                    <h4 class="card-title">Kewajiban(Utang)</h4>
                </div> 
                <div class="button">
                    <a class="btn btn-outline-primary rounded" href="{{ route('kewajiban_form') }}">
                        + Tambah Kewajiban
                    </a>
                </div>
            </div>
            <div class="card-body">
                <br>
                <div class="table-responsive">
                    <table id="datatable" class="table table-striped" data-toggle="data-table">
                        <thead>
                            <tr>
                                <th>No. Kewajiban </th>
                                <th>Jenis Kewajiban</th>
                                <th>Nama Kewajiban</th>
                                <th>Nominal</th>
                                <th>Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($kewajiban as $data)
                                @if($user_id == $data->user_id)
                                    <tr>
                                        <td>{{ $data->nomor_kewajiban }}</td>
                                        <td>{{ $data->jenis_kewajiban }}</td>
                                        <td>{{ $data->nama_kewajiban}}</td>
                                        <td>{{ $data->nominal }}</td>
                                        <td><a href="{{ route('kewajiban_detail', $data->nomor_kewajiban) }}" class="btn btn-warning">Detail</a></td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="4">Total Kewajiban: Rp 57.000.000</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection