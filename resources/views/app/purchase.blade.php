@extends('layouts.master')
@section('title', 'Purchase')
@section('content')

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between pb-0 border-0">
                <div class="header-title">
                    <h4 class="card-title">Purchase</h4>
                </div> 
                <div class="dropdown">
                    <a class="btn btn-outline-primary rounded" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                        + Purchase invoice
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="{{ route('purchase_form_tunai') }}">Tunai</a></li>
                        <li><a class="dropdown-item" href="{{ route('purchase_form_kredit') }}">Kredit</a></li>
                    </ul>
                </div>
            </div>
            <div class="card-body">
                <ul class="nav nav-tabs" id="myTab-1" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="tunai-tab" data-bs-toggle="tab" href="#tunai" role="tab" aria-controls="tunai" aria-selected="true">Tunai</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="kredit-tab" data-bs-toggle="tab" href="#kredit" role="tab" aria-controls="kredit" aria-selected="false">Kredit</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent-2">
                    <div class="tab-pane fade show active" id="tunai" role="tabpanel" aria-labelledby="tunai-tab">
                        <p>Tunai</p>
                    </div>
                    <div class="tab-pane fade" id="kredit" role="tabpanel" aria-labelledby="kredit-tab">
                        <p>Kredit</p>
                    </div>
                </div>
                <br>
                <div class="table-responsive">
                    <table id="datatable" class="table table-striped" data-toggle="data-table">
                        <thead>
                            <tr>
                                <th>Nomor Transaksi</th>
                                <th>Tanggal</th>
                                <th>Nama Barang</th>
                                <th>Jumlah</th>
                                <th>Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Rhona Davidson</td>
                                <td>Integration Specialist</td>
                                <td>Tokyo</td>
                                <td>55</td>
                                <td><button type="button" class="btn btn-warning">Detail</button> </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Nomor Transaksi</th>
                                <th>Tanggal</th>
                                <th>Nama Barang</th>
                                <th>Jumlah</th>
                                <th>Detail</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection