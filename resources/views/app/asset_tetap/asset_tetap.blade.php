@extends('layouts.master')
@section('title', 'asset_tetap')
@section('content')

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between pb-0 border-0">
                <div class="header-title">
                    <h4 class="card-title">Asset Tetap</h4>
                </div> 
            </div>
            <!--<div class="card-body">
                <ul class="nav nav-tabs" id="myTab-1" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="Tetap-tab" data-bs-toggle="tab" href="#Tetap" role="tab" aria-controls="Tetap" aria-selected="true">Asset Tetap</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="Asset Lancar-tab" data-bs-toggle="tab" href="#Asset Lancar" role="tab" aria-controls="Asset Lancar" aria-selected="false">Asset Lancar</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent-2">
                    <div class="tab-pane fade show active" id="Tetap" role="tabpanel" aria-labelledby="Tetap-tab">
                        <p>Asset Tetap</p>
                    </div>
                    <div class="tab-pane fade" id="Asset Lancar" role="tabpanel" aria-labelledby="Asset Lancar-tab">
                        <p>Asset Lancar</p>
                    </div>
                </div>-->
                <br>
                <div class="table-responsive">
                    <table id="datatable" class="table table-striped" data-toggle="data-table">
                        <thead>
                            <tr>
                                <th>Nomor </th>
                                <th>Nama Asset Tetap</th>
                                <th>Harga Perolehan</th>
                                <th>Umur Ekonomis</th>
                                <th>Masa Penggunaan</th>
                                <th>Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Tanah</td>
                                <td>55</td>
                                <td>6 Tahun</td>
                                <td>5 Tahun</td>
                                <!--<td><button type="button" class="btn btn-outline-warning mt-2">Detail</button> </td>
                                <td><button type="button" class="btn btn-warning">Detail</button> </td>-->
                                <td><button type="button" class="btn btn-outline-warning rounded-pill mt-2">Detail</button></td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Nomor </th>
                                <th>Nama Asset Tetap</th>
                                <th>Harga Perolehan</th>
                                <th>Umur Ekonomis</th>
                                <th>Masa Penggunaan</th>
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
