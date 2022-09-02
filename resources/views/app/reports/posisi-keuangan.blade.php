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
                                <!-- ASSET LANCAR -->
                                <tr>
                                    <th scope="row"><strong>Asset Lancar</strong></td>
                                </tr>
                                @php
                                    $assetLancar = 0;
                                @endphp
                                @foreach($asset_lancar as $data)
                                    @if($user_id == $data->user_id)
                                        <tr>
                                            <th scope="row">{{ $data->nama_asset }}</th>
                                            <td>@currency($data->harga_asset)</td>
                                        </tr>
                                        @php
                                            $assetLancar += $data->harga_asset;
                                        @endphp
                                    @endif
                                @endforeach
                                <tr>
                                    <th><strong>Total Aset Lancar</strong></th>
                                    <td><strong>@currency($assetLancar)</strong></td>
                                </tr>
                                <!-- ASSET TETAP -->
                                <tr>
                                    <th scope="row"><strong>Asset Tetap</strong></td>
                                </tr>
                                @php
                                    $assetTetap = 0;
                                @endphp
                                @foreach($asset_tetap as $data)
                                    @if($user_id == $data->user_id)
                                        <tr>
                                            <th scope="row">{{ $data->nama_asset }}</td>
                                            <td>@currency($data->harga_asset)</td>
                                        </tr>
                                        @php
                                            $assetTetap += $data->harga_asset;
                                        @endphp
                                    @endif
                                @endforeach
                                <tr>
                                    <th><strong>Total Aset Tetap</strong></th>
                                    <td><strong>@currency($assetTetap)</strong></td>
                                </tr>
                            </tbody>
                            @php
                                $assetTotal = $assetTetap + $assetLancar;
                            @endphp
                            <tfoot>
                                <tr>
                                    <th><strong>Total Aset</strong></th>
                                    <td><strong>@currency($assetTotal)</strong></td>
                                </tr>
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
                                    <td>@currency($utang[0]->jumlah_utang)</td>
                                </tr>
                                <tr>
                                    <th scope="row">Modal</td>
                                    <td>@currency($modal[0]->harga_modal)</td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                <th><strong>Total Utang dan Modal</strong></th>
                                <td><strong>@currency($utang[0]->jumlah_utang + $modal[0]->harga_modal)</strong></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <!-- END UTANG -->
            </div>
        </div>
    </div>
</div>

@endsection