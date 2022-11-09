@extends('layouts.master')
@section('title', 'Pembelian')
@section('content')

<div class="row">
    <div class="col-sm-12">
        <div class="card">
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
                    <!-- TUNAI TABLE -->
                    <div class="tab-pane fade show active" id="tunai" role="tabpanel" aria-labelledby="tunai-tab">
                        <!-- HEADER TUNAI -->
                        <div class="card-header d-flex justify-content-between pb-0 border-0">
                            <div class="header-title">
                                <h4 class="card-title">Pembelian Tunai</h4>
                            </div> 
                            <div class="dropdown-container d-flex justify-content-start">
                                <div class="dropdown">
                                    <a class="btn btn-outline-warning rounded" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                    <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            fill-rule="evenodd"
                                            clip-rule="evenodd"
                                            d="M12.1535 16.64L14.995 13.77C15.2822 13.47 15.2822 13 14.9851 12.71C14.698 12.42 14.2327 12.42 13.9455 12.71L12.3713 14.31V9.49C12.3713 9.07 12.0446 8.74 11.6386 8.74C11.2327 8.74 10.896 9.07 10.896 9.49V14.31L9.32178 12.71C9.03465 12.42 8.56931 12.42 8.28218 12.71C7.99505 13 7.99505 13.47 8.28218 13.77L11.1139 16.64C11.1832 16.71 11.2624 16.76 11.3515 16.8C11.4406 16.84 11.5396 16.86 11.6386 16.86C11.7376 16.86 11.8267 16.84 11.9158 16.8C12.005 16.76 12.0842 16.71 12.1535 16.64ZM19.3282 9.02561C19.5609 9.02292 19.8143 9.02 20.0446 9.02C20.302 9.02 20.5 9.22 20.5 9.47V17.51C20.5 19.99 18.5 22 16.0446 22H8.17327C5.58911 22 3.5 19.89 3.5 17.29V6.51C3.5 4.03 5.4901 2 7.96535 2H13.2525C13.5 2 13.7079 2.21 13.7079 2.46V5.68C13.7079 7.51 15.1931 9.01 17.0149 9.02C17.4333 9.02 17.8077 9.02318 18.1346 9.02595C18.3878 9.02809 18.6125 9.03 18.8069 9.03C18.9479 9.03 19.1306 9.02789 19.3282 9.02561ZM19.6045 7.5661C18.7916 7.5691 17.8322 7.5661 17.1421 7.5591C16.047 7.5591 15.145 6.6481 15.145 5.5421V2.9061C15.145 2.4751 15.6629 2.2611 15.9579 2.5721C16.7203 3.37199 17.8873 4.5978 18.8738 5.63395C19.2735 6.05379 19.6436 6.44249 19.945 6.7591C20.2342 7.0621 20.0223 7.5651 19.6045 7.5661Z"
                                            fill="currentColor"
                                        ></path>
                                    </svg>
                                        Cetak
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuButton1">
                                        <li><a class="dropdown-item active" href="{{ route('purchase_form_tunai') }}">PDF</a></li>
                                        <li><a class="dropdown-item" href="javascript:export_excel_purchase_tunai()">Excel</a></li>
                                    </ul>
                                </div>
                                &nbsp;&nbsp;
                                <a class="btn btn-outline-primary rounded" href="{{ route('purchase_form_tunai') }}">
                                    + Tambah Pembelian
                                </a> 
                            </div>
                        </div>
                        <!-- END HEADER TUNAI -->
                        <br>
                        <div class="table-responsive">
                            <table id="datatable purchase_form_tunai" class="table table-striped" data-toggle="data-table">
                                <thead class="text-center">
                                    <tr>
                                        <th>No.Transaksi</th>
                                        <th>Tanggal</th>
                                        <th>Nama Barang</th>
                                        <th>Jumlah Barang</th>
                                        <th>Harga Satuan</th>
                                        <th>Total Pembelian</th>
                                        <th>Detail</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    @php
                                        $totalPembelianTunai = 0;
                                    @endphp
                                    @foreach($purchase_form_tunai as $data)
                                        @if($user_id == $data->user_id)
                                            <tr>
                                                <td>{{ $data->nomor_transaksi }}</td>
                                                <td>{{ date_format(date_create($data->tanggal_transaksi),"d/m/Y") }}</td>
                                                <td>{{ $data->produk_yang_dibeli }}</td>
                                                <td>{{ $data->jumlah_barang }}</td>
                                                <td class="text-end">@currency($data->harga_satuan)</td>
                                                <td class="text-end">@currency($data->total_pembelian)</td>
                                                <td><a href="{{ route('purchase_tunai_detail', $data->nomor_transaksi) }}" class="btn btn-warning">Detail</a></td>
                                            </tr>
                                            @php
                                                $totalPembelianTunai += $data->total_pembelian;
                                            @endphp
                                        @endif
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="4">Total Pembelian: @currency($totalPembelianTunai)</th>
                                        <tr>
                                        <th colspans="4">Saldo : @currency($totalPembelianTunai)</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <!-- END TUNAI TABLE -->
                    
                    <!-- KREDIT TABLE -->
                    <div class="tab-pane fade" id="kredit" role="tabpanel" aria-labelledby="kredit-tab">
                        <!-- HEADER KREDIT -->
                        <div class="card-header d-flex justify-content-between pb-0 border-0">
                            <div class="header-title">
                                <h4 class="card-title">Pembelian Kredit</h4>
                            </div> 
                            <div class="dropdown-container d-flex justify-content-start">
                                <div class="dropdown">
                                    <a class="btn btn-outline-warning rounded" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                    <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            fill-rule="evenodd"
                                            clip-rule="evenodd"
                                            d="M12.1535 16.64L14.995 13.77C15.2822 13.47 15.2822 13 14.9851 12.71C14.698 12.42 14.2327 12.42 13.9455 12.71L12.3713 14.31V9.49C12.3713 9.07 12.0446 8.74 11.6386 8.74C11.2327 8.74 10.896 9.07 10.896 9.49V14.31L9.32178 12.71C9.03465 12.42 8.56931 12.42 8.28218 12.71C7.99505 13 7.99505 13.47 8.28218 13.77L11.1139 16.64C11.1832 16.71 11.2624 16.76 11.3515 16.8C11.4406 16.84 11.5396 16.86 11.6386 16.86C11.7376 16.86 11.8267 16.84 11.9158 16.8C12.005 16.76 12.0842 16.71 12.1535 16.64ZM19.3282 9.02561C19.5609 9.02292 19.8143 9.02 20.0446 9.02C20.302 9.02 20.5 9.22 20.5 9.47V17.51C20.5 19.99 18.5 22 16.0446 22H8.17327C5.58911 22 3.5 19.89 3.5 17.29V6.51C3.5 4.03 5.4901 2 7.96535 2H13.2525C13.5 2 13.7079 2.21 13.7079 2.46V5.68C13.7079 7.51 15.1931 9.01 17.0149 9.02C17.4333 9.02 17.8077 9.02318 18.1346 9.02595C18.3878 9.02809 18.6125 9.03 18.8069 9.03C18.9479 9.03 19.1306 9.02789 19.3282 9.02561ZM19.6045 7.5661C18.7916 7.5691 17.8322 7.5661 17.1421 7.5591C16.047 7.5591 15.145 6.6481 15.145 5.5421V2.9061C15.145 2.4751 15.6629 2.2611 15.9579 2.5721C16.7203 3.37199 17.8873 4.5978 18.8738 5.63395C19.2735 6.05379 19.6436 6.44249 19.945 6.7591C20.2342 7.0621 20.0223 7.5651 19.6045 7.5661Z"
                                            fill="currentColor"
                                        ></path>
                                    </svg>
                                        Cetak
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuButton1">
                                        <li><a class="dropdown-item active" href="{{ route('purchase_form_tunai') }}">PDF</a></li>
                                        <li><a class="dropdown-item" href="javascript:export_excel_purchase_tunai()">Excel</a></li>
                                    </ul>
                                </div>
                                &nbsp;&nbsp;
                                <a class="btn btn-outline-primary rounded" href="{{ route('purchase_form_kredit') }}">
                                    + Tambah Pembelian
                                </a> 
                            </div>
                        </div>
                        <br>
                        <!-- END HEADER KREDIT -->
                        <div class="table-responsive">
                            <table id="datatable" class="table table-striped" data-toggle="data-table">
                                <thead class="text-center">
                                    <tr>
                                        <th>No.Transaksi</th>
                                        <th>Tanggal</th>
                                        <th>Nama Barang</th>
                                        <th>Jumlah Barang</th>
                                        <th>Harga Satuan</th>
                                        <th>Total Pembelian</th>
                                        <th>Nama Supplier</th>
                                        <th>Detail</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    @php
                                        $totalPembelianKredit = 0;
                                    @endphp
                                    @foreach($purchase_form_kredit as $data)
                                        @if($user_id == $data->user_id)
                                            <tr>
                                                <td>{{ $data->nomor_transaksi }}</td>
                                                <td>{{ date_format(date_create($data->tanggal_transaksi),"d/m/Y") }}</td>
                                                <td>{{ $data->produk_yang_dibeli }}</td>
                                                <td>{{ $data->jumlah_barang }}</td>
                                                <td class="text-end">@currency($data->harga_satuan)</td>
                                                <td class="text-end">@currency($data->total_pembelian)</td>
                                                <td>{{ $data->nama_supplier }}</td>
                                                <td><a href="{{ route('purchase_kredit_detail', $data->nomor_transaksi) }}" class="btn btn-warning">Detail</a></td>
                                            </tr>
                                            @php
                                                $totalPembelianKredit += $data->total_pembelian;
                                            @endphp
                                        @endif
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="4">Total Pembelian: @currency($totalPembelianKredit)</th>
                                        <tr>
                                        <th colspans="4">Saldo : @currency($totalPembelianKredit)</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                <br>
            </div>
        </div>
    </div>
</div>

@push('child-js')
    <script src="{{ asset('cetak/excel_purchase_tunai.js') }}"></script>
@endpush

@endsection