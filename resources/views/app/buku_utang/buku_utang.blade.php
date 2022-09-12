@extends('layouts.master')
@section('title', 'Buku Utang')
@section('content')

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <ul class="nav nav-tabs" id="myTab-1" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="utang-tab" data-bs-toggle="tab" href="#utang" role="tab" aria-controls="utang" aria-selected="true">Utang</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="piutang-tab" data-bs-toggle="tab" href="#piutang" role="tab" aria-controls="piutang" aria-selected="false">Piutang</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent-2">
                    <!-- UTANG TABLE -->
                    <div class="tab-pane fade show active" id="utang" role="tabpanel" aria-labelledby="utang-tab">
                        <!-- HEADER UTANG -->
                        <div class="card-header d-flex justify-content-between pb-0 border-0">
                            <div class="header-title">
                                <h4 class="card-title">Buku Utang</h4>
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
                                        <li><a class="dropdown-item active" href="{{ route('buku_utang_form_utang') }}">PDF</a></li>
                                        <li><a class="dropdown-item" href="javascript:export_excel_purchase_tunai()">Excel</a></li>
                                    </ul>
                                </div>
                                &nbsp;&nbsp;
                                <!-- <a class="btn btn-outline-primary rounded" href="{{ route('buku_utang_form_utang') }}">
                                    + Tambah Utang
                                </a>  -->
                            </div>
                        </div>
                        <!-- END HEADER UTANG -->
                        <br>
                        <div class="table-responsive">
                            <table id="datatable buku_utang_form_utang" class="table table-striped" data-toggle="data-table">
                                <thead class="text-center">
                                    <tr>
                                        <th>Nomor Utang</th>
                                        <th>Tanggal</th>
                                        <th>Nama Utang</th>
                                        <th>Nama Supplier</th>
                                        <th>Jumlah Utang</th>
                                        <th>Detail</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    @php
                                        $totalUtang = 0;
                                    @endphp
                                    @foreach($buku_utang_form_utang as $data)
                                        @if($user_id == $data->user_id)
                                            <tr>
                                                <td>{{ $data->nomor_utang }}</td>
                                                <td>{{ date_format(date_create($data->tanggal),"Y/m/d") }}</td>
                                                <td>{{ $data->nama }}</td>
                                                <td>{{ $data->nama_supplier }}</td>
                                                <td class="text-end">@currency($data->jumlah_utang)</td>
                                                <td><a href="{{ route('buku_utang_utang_detail', $data->nomor_utang) }}" class="btn btn-warning">Detail</a></td>
                                            </tr>
                                            @php
                                                $totalUtang += $data->jumlah_utang;
                                            @endphp
                                        @endif
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="4">Total Utang: @currency($totalUtang)</th>
                                        <tr>
                                        <th colspans="4">Saldo : @currency($totalUtang)</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <!-- END UTANG TABLE -->
                    
                    <!-- PIUTANG TABLE -->
                    <div class="tab-pane fade" id="piutang" role="tabpanel" aria-labelledby="piutang-tab">
                        <!-- HEADER PIUTANG -->
                        <div class="card-header d-flex justify-content-between pb-0 border-0">
                            <div class="header-title">
                                <h4 class="card-title">Buku Piutang</h4>
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
                                        <li><a class="dropdown-item active" href="{{ route('buku_utang_form_utang') }}">PDF</a></li>
                                        <li><a class="dropdown-item" href="javascript:export_excel_purchase_tunai()">Excel</a></li>
                                    </ul>
                                </div>
                                &nbsp;&nbsp;
                                <!-- <a class="btn btn-outline-primary rounded" href="{{ route('buku_utang_form_piutang') }}">
                                    + Tambah Piutang
                                </a>  -->
                            </div>
                        </div>
                        <br>
                        <!-- END HEADER PIUTANG -->
                        <div class="table-responsive">
                            <table id="datatable" class="table table-striped" data-toggle="data-table">
                                <thead class="text-center">
                                    <tr>
                                        <th>Nomor Piutang</th>
                                        <th>Tanggal</th>
                                        <th>Nama Piutang</th>
                                        <th>Nama Kreditur</th>
                                        <th>Jumlah Piutang</th>
                                        <th>Detail</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    @php
                                        $totalPiutang = 0;
                                    @endphp
                                    @foreach($buku_utang_form_piutang as $data)
                                        @if($user_id == $data->user_id)
                                            <tr>
                                                <td>{{ $data->nomor_piutang }}</td>
                                                <td>{{ date_format(date_create($data->tanggal),"Y/m/d") }}</td>
                                                <td>{{ $data->nama }}</td>
                                                <td>{{ $data->nama_kreditur }}</td>
                                                <td class="text-end">@currency($data->jumlah_piutang)</td>
                                                <td><a href="{{ route('buku_utang_piutang_detail', $data->nomor_piutang) }}" class="btn btn-warning">Detail</a></td>
                                            </tr>
                                            @php
                                                $totalPiutang += $data->jumlah_piutang;
                                            @endphp
                                        @endif
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="4">Total Piutang: @currency($totalPiutang)</th>
                                        <tr>
                                        <th colspans="4">Saldo : @currency($totalPiutang)</th>
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