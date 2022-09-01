@extends('layouts.master')
@section('title', 'Modal')
@section('content')

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between pb-0 border-0">
                <div class="header-title">
                    <h4 class="card-title">Modal</h4>
                </div> 
                <div class="button">
                    <a class="btn btn-outline-primary rounded" href="{{ route('tambah_modal') }}">
                        + Tambah Modal
                    </a>
                </div>
            </div>
                <br>
                <div class="table-responsive">
                    <table id="datatable" class="table table-striped" data-toggle="data-table">
                        <thead class="text-center">
                            <tr>
                                <th>Modal ID </th>
                                <th>Nama Modal</th>
                                <th>Harga Modal</th>
                                <th>Detail</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @php
                                $totalModal = 0;
                            @endphp
                            @foreach($modal as $data)
                                @if($user_id == $data->user_id)
                                    <tr>
                                        <td>{{ $data->modal_id }}</td>
                                        <td>{{ $data->nama_modal }}</td>
                                        <td>@currency($data->harga_modal)</td>
                                        <td><a href="{{ route('modal_detail', $data->modal_id) }}" class="btn btn-warning">Detail</a></td>
                                    </tr>
                                    @php
                                        $totalModal += $data->harga_modal;
                                    @endphp
                                @endif
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="4">Total Aset: @currency($totalModal)</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection