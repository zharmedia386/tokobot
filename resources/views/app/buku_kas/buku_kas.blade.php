@extends('layouts.master')
@section('title', 'Buku Kas')
@section('content')

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between pb-0 border-0">
                <div class="header-title">
                    <h4 class="card-title">Buku Kas</h4>
                </div> 
                <div class="dropdown">
                    <a class="btn btn-outline-warning rounded" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                        + Tambah Kas
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item active" href="{{ route('tambah_kas_pemasukkan') }}">Pemasukkan</a></li>
                        <li><a class="dropdown-item" href="{{ route('tambah_kas_pengeluaran') }}">Pengeluaran</a></li>
                    </ul>
                </div>
            </div>
            <div class="card-body">
                <br>
                {{-- <p>Saldo : @currency($kas[0]->harga_asset)</p> --}}
                <div class="table-responsive">
                    <table id="datatable" class="table table-striped" data-toggle="data-table">
                        <thead>
                            <tr  class="text-center">
                                <th>Tanggal </th>
                                <th>Pemasukkan</th>
                                <th>Pengeluaran</th>
                                <th>Harga Pemasukkan</th>
                                <th>Harga Pengeluaran</th>
                                <th>Action</th>
                                <th>Detail</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @php
                                $totalPemasukkan = 0;
                                $totalPengeluaran = 0;
                            @endphp
                            @foreach($buku_kas as $data)
                                @if($user_id == $data->user_id)
                                    <tr>
                                        <td>{{ $data->tanggal }}</td>

                                        @if(is_null($data->nama_pemasukkan))
                                            <td>-</td>
                                        @else
                                            <td>{{ $data->nama_pemasukkan }}</td>
                                        @endif

                                        @if(is_null($data->nama_pengeluaran))
                                            <td>-</td>
                                        @else
                                            <td>{{ $data->nama_pengeluaran }}</td>
                                        @endif

                                        <td  class="text-end">@currency($data->harga_pemasukkan)</td>
                                        <td  class="text-end">@currency($data->harga_pengeluaran)</td>
                                        <td>
                                            <div class="flex align-items-center list-user-action">
                                                <form action="{{ route('buku_kas_delete', $data->kas_id) }}" method="post">@csrf
                                                {{-- <a class="btn btn-sm btn-icon btn-info" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit" href="#">
                                                    <span class="btn-inner">
                                                    <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M11.4925 2.78906H7.75349C4.67849 2.78906 2.75049 4.96606 2.75049 8.04806V16.3621C2.75049 19.4441 4.66949 21.6211 7.75349 21.6211H16.5775C19.6625 21.6211 21.5815 19.4441 21.5815 16.3621V12.3341" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M8.82812 10.921L16.3011 3.44799C17.2321 2.51799 18.7411 2.51799 19.6721 3.44799L20.8891 4.66499C21.8201 5.59599 21.8201 7.10599 20.8891 8.03599L13.3801 15.545C12.9731 15.952 12.4211 16.181 11.8451 16.181H8.09912L8.19312 12.401C8.20712 11.845 8.43412 11.315 8.82812 10.921Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        <path d="M15.1655 4.60254L19.7315 9.16854" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    </svg>
                                                    </span>
                                                </a> --}}
                
                                                <button type="submit" class="btn btn-sm btn-icon btn-danger" onClick="return confirm('Yakin mau dihapus?')">
                                                    <span class="btn-inner">
                                                    <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="currentColor">
                                                        <path d="M19.3248 9.46826C19.3248 9.46826 18.7818 16.2033 18.4668 19.0403C18.3168 20.3953 17.4798 21.1893 16.1088 21.2143C13.4998 21.2613 10.8878 21.2643 8.27979 21.2093C6.96079 21.1823 6.13779 20.3783 5.99079 19.0473C5.67379 16.1853 5.13379 9.46826 5.13379 9.46826" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        <path d="M20.708 6.23975H3.75" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        <path d="M17.4406 6.23973C16.6556 6.23973 15.9796 5.68473 15.8256 4.91573L15.5826 3.69973C15.4326 3.13873 14.9246 2.75073 14.3456 2.75073H10.1126C9.53358 2.75073 9.02558 3.13873 8.87558 3.69973L8.63258 4.91573C8.47858 5.68473 7.80258 6.23973 7.01758 6.23973" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    </svg>
                                                    </span>
                                                </button>
                                                
                                                </form>
                                            </div>
                                        </td>
                                        <td><a href="{{ route('buku_kas_detail', $data->kas_id) }}" class="btn btn-warning">Detail</a></td>
                                    </tr>
                                    @php
                                        $totalPemasukkan += $data->harga_pemasukkan;
                                        $totalPengeluaran += $data->harga_pengeluaran;  
                                    @endphp
                                @endif
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="4">
                                    Total Pemasukkan: @currency($totalPemasukkan) <br>
                                    Total Pengeluaran: @currency($totalPengeluaran) <br>
                                    <tr>
                                    <th colspans="4">Saldo : @currency($totalPemasukkan-$totalPengeluaran)</th>
                                </th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection