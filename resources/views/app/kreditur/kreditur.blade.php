@extends('layouts.master')
@section('title', 'Kreditur')
@section('content')

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between pb-0 border-0">
                <div class="header-title">
                    <h4 class="card-title">Kreditur</h4>
                </div> 
                <div class="button">
                    <a class="btn btn-outline-primary rounded" href="{{ route('tambah_kreditur') }}">
                        + Tambah Kreditur
                    </a>
                </div>
            </div>
            <div class="card-body">
                <br>
                <div class="table-responsive">
                    <table id="datatable" class="table table-striped" data-toggle="data-table">
                        <thead>
                            <tr>
                                <th>Kreditur ID</th>
                                <th>Nama Kreditur</th>
                                <th>Alamat</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($kreditur as $data)
                                @if($user_id == $data->user_id)
                                <tr>
                                    <td>{{ $data->kreditur_id }}</td>
                                    <td>{{ $data->nama_kreditur }}</td>
                                    <td>{{ $data->alamat }}</td>
                                </tr>
                                @endif
                            @endforeach
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