@extends('layouts.master')
@section('title', 'kewajiban')
@section('content')

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between pb-0 border-0">
                <div class="header-title">
                    <h4 class="card-title">Kewajiban (Utang)</h4>
                </div> 
                <div class="dropdown">
                    <a class="btn btn-outline-primary rounded" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                        <!--<svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path opacity="0.4" d="M16.6203 22H7.3797C4.68923 22 2.5 19.8311 2.5 17.1646V11.8354C2.5 9.16894 4.68923 7 7.3797 7H16.6203C19.3108 7 21.5 9.16894 21.5 11.8354V17.1646C21.5 19.8311 19.3108 22 16.6203 22Z" fill="currentColor"></path>
                            <path
                                d="M15.7551 10C15.344 10 15.0103 9.67634 15.0103 9.27754V6.35689C15.0103 4.75111 13.6635 3.44491 12.0089 3.44491C11.2472 3.44491 10.4477 3.7416 9.87861 4.28778C9.30854 4.83588 8.99272 5.56508 8.98974 6.34341V9.27754C8.98974 9.67634 8.65604 10 8.24487 10C7.8337 10 7.5 9.67634 7.5 9.27754V6.35689C7.50497 5.17303 7.97771 4.08067 8.82984 3.26285C9.68098 2.44311 10.7814 2.03179 12.0119 2C14.4849 2 16.5 3.95449 16.5 6.35689V9.27754C16.5 9.67634 16.1663 10 15.7551 10Z"
                                fill="currentColor"
                            ></path>
                        </svg> -->
                        + Tambah Kewajiban
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="{{ route('jangka_panjang') }}">Jangka Panjang</a></li>
                        <li><a class="dropdown-item" href="{{ route('jangka_pendek') }}">Jangka Pendek</a></li>
                    </ul>
                </div>
            </div>
            <div class="card-body">
                <ul class="nav nav-tabs" id="myTab-1" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="Tetap-tab" data-bs-toggle="tab" href="#Tetap" role="tab" aria-controls="Tetap" aria-selected="true">Jangka Panjang</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="Asset Lancar-tab" data-bs-toggle="tab" href="#Asset Lancar" role="tab" aria-controls="Asset Lancar" aria-selected="false">Jangka Pendek</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent-2">
                    <div class="tab-pane fade show active" id="Tetap" role="tabpanel" aria-labelledby="Tetap-tab">
                        <p>Asset Tetap</p>
                    </div>
                    <div class="tab-pane fade" id="Asset Lancar" role="tabpanel" aria-labelledby="Asset Lancar-tab">
                        <p>Asset Lancar</p>
                    </div>
                </div>
                <br>
                <div class="table-responsive">
                    <table id="datatable" class="table table-striped" data-toggle="data-table">
                        <thead>
                            <tr>
                                <th>Nomor </th>
                                <th>Jenis Kewajiban</th>
                                <th>Nama Kewajiban</th>
                                <th>Nominal</th>
                                <th>Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Rhona Davidson</td>
                                <td>Integration Specialist</td>
                                <td>Tokyo</td>
                                <td>55</td>
                                <!--<td><button type="button" class="btn btn-outline-warning mt-2">Detail</button> </td>
                                <td><button type="button" class="btn btn-warning">Detail</button> </td>-->
                                <td><button type="button" class="btn btn-outline-warning rounded-pill mt-2">Detail</button></td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Nomor </th>
                                <th>Jenis Kewajiban</th>
                                <th>Nama Kewajiban</th>
                                <th>Nominal</th>
                                <th>Detail</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <p class="mb-4">Total : Rp </p>
            </div>
        </div>
    </div>
</div>

@endsection