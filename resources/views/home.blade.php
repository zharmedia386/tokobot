@extends('layouts.master')
@section('title', 'Home')
@section('content')
    

@push('child-css')
    <link rel="stylesheet" href="{{ asset('hoverable/hoverable.css') }}" />
@endpush


<div class="row">
    <div class="col-lg-12">
        <div class="iq-main">
            <div class="card mb-0 iq-content rounded-bottom">
                <div class="d-flex flex-wrap align-items-center justify-content-between mx-3 my-3">
                    <div class="d-flex flex-wrap align-items-center">
                        <div class="profile-img22 position-relative me-3 mb-3 mb-lg-0">
                            <img src="../../assets/images/User-profile/1.png" class="img-fluid avatar avatar-100 avatar-rounded" alt="profile-image" />
                        </div>
                        <div class="d-flex align-items-center mb-3 mb-sm-0">
                            <div>
                                <h6 class="me-2 text-primary">{{ session()->get('username') }}</h6>
                                <span>
                                    <svg width="19" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            fill-rule="evenodd"
                                            clip-rule="evenodd"
                                            d="M9.59151 15.2068C13.2805 15.2068 16.4335 15.7658 16.4335 17.9988C16.4335 20.2318 13.3015 20.8068 9.59151 20.8068C5.90151 20.8068 2.74951 20.2528 2.74951 18.0188C2.74951 15.7848 5.88051 15.2068 9.59151 15.2068Z"
                                            stroke="currentColor"
                                            stroke-width="1.5"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                        ></path>
                                        <path
                                            fill-rule="evenodd"
                                            clip-rule="evenodd"
                                            d="M9.59157 12.0198C7.16957 12.0198 5.20557 10.0568 5.20557 7.63476C5.20557 5.21276 7.16957 3.24976 9.59157 3.24976C12.0126 3.24976 13.9766 5.21276 13.9766 7.63476C13.9856 10.0478 12.0356 12.0108 9.62257 12.0198H9.59157Z"
                                            stroke="currentColor"
                                            stroke-width="1.5"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                        ></path>
                                        <path d="M16.4829 10.8815C18.0839 10.6565 19.3169 9.28253 19.3199 7.61953C19.3199 5.98053 18.1249 4.62053 16.5579 4.36353" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path d="M18.5952 14.7322C20.1462 14.9632 21.2292 15.5072 21.2292 16.6272C21.2292 17.3982 20.7192 17.8982 19.8952 18.2112" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                    <small class="mb-0 text-dark">{{ session()->get('email') }}</small>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="iq-header-img">
                <img src="../../assets/images/User-profile/01_2.png" alt="header" class="img-fluid w-100 rounded" style="object-fit: contain;" />
            </div>
        </div>
    </div>
    <ul id="top-tab-list" class="p-0 row list-inline">
        <li class="col-lg-3 col-md-6 text-start mb-2" id="hoverable">
            <a href="{{ route('sales') }}">
                <div class="iq-icon me-3">
                    <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M21.6389 14.3957H17.5906C16.1042 14.3948 14.8993 13.1909 14.8984 11.7045C14.8984 10.218 16.1042 9.01409 17.5906 9.01318H21.6389" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M18.049 11.6429H17.7373" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path
                            fill-rule="evenodd"
                            clip-rule="evenodd"
                            d="M7.74766 3H16.3911C19.2892 3 21.6388 5.34951 21.6388 8.24766V15.4247C21.6388 18.3229 19.2892 20.6724 16.3911 20.6724H7.74766C4.84951 20.6724 2.5 18.3229 2.5 15.4247V8.24766C2.5 5.34951 4.84951 3 7.74766 3Z"
                            stroke="currentColor"
                            stroke-width="1.5"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        ></path>
                        <path d="M7.03516 7.5382H12.4341" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </div>
                <span>Penjualan</span>
            </a>
        </li>
        <li id="hoverable1" class="col-lg-3 col-md-6 mb-2 text-start">
            <a href="{{ route('purchase') }}">
                <div class="iq-icon me-3">
                    <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M13.8496 4.25024V6.67024" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M13.8496 17.76V19.784" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M13.8496 14.3247V9.50366" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path
                            fill-rule="evenodd"
                            clip-rule="evenodd"
                            d="M18.7021 20C20.5242 20 22 18.5426 22 16.7431V14.1506C20.7943 14.1506 19.8233 13.1917 19.8233 12.001C19.8233 10.8104 20.7943 9.85039 22 9.85039L21.999 7.25686C21.999 5.45745 20.5221 4 18.7011 4H5.29892C3.47789 4 2.00104 5.45745 2.00104 7.25686L2 9.93485C3.20567 9.93485 4.17668 10.8104 4.17668 12.001C4.17668 13.1917 3.20567 14.1506 2 14.1506V16.7431C2 18.5426 3.4758 20 5.29787 20H18.7021Z"
                            stroke="currentColor"
                            stroke-width="1.5"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        ></path>
                    </svg>
                </div>
                <span>Pembelian</span>
            </a>
        </li>
        <li id="hoverable" class="col-lg-3 col-md-6 mb-2 text-start">
            <a href="{{ route('asset') }}">
                <div class="iq-icon me-3">
                    <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M17.9028 8.85107L13.4596 12.4641C12.6201 13.1301 11.4389 13.1301 10.5994 12.4641L6.11865 8.85107" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path
                            fill-rule="evenodd"
                            clip-rule="evenodd"
                            d="M16.9089 21C19.9502 21.0084 22 18.5095 22 15.4384V8.57001C22 5.49883 19.9502 3 16.9089 3H7.09114C4.04979 3 2 5.49883 2 8.57001V15.4384C2 18.5095 4.04979 21.0084 7.09114 21H16.9089Z"
                            stroke="currentColor"
                            stroke-width="1.5"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        ></path>
                    </svg>
                </div>
                <span>Aset</span>
            </a>
        </li>
        <li id="hoverable" class="col-lg-3 col-md-6 mb-2 text-start">
            <a href="{{ route('kewajiban') }}">
                <div class="iq-icon me-3">
                    <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M15.7161 16.2234H8.49609" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M15.7161 12.0369H8.49609" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M11.2521 7.86011H8.49707" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path
                            fill-rule="evenodd"
                            clip-rule="evenodd"
                            d="M15.909 2.74976C15.909 2.74976 8.23198 2.75376 8.21998 2.75376C5.45998 2.77076 3.75098 4.58676 3.75098 7.35676V16.5528C3.75098 19.3368 5.47298 21.1598 8.25698 21.1598C8.25698 21.1598 15.933 21.1568 15.946 21.1568C18.706 21.1398 20.416 19.3228 20.416 16.5528V7.35676C20.416 4.57276 18.693 2.74976 15.909 2.74976Z"
                            stroke="currentColor"
                            stroke-width="1.5"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        ></path>
                    </svg>
                </div>
                <span>Kewajiban</span>
            </a>
        </li>
        <p></p>
        <li class="col-lg-3 col-md-6 text-start mb-2" id="hoverable">
            <a href="{{ route('modal') }}">
                <div class="iq-icon me-3">
                    <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M11.9951 16.6766V14.1396" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path
                            fill-rule="evenodd"
                            clip-rule="evenodd"
                            d="M18.19 5.33008C19.88 5.33008 21.24 6.70008 21.24 8.39008V11.8301C18.78 13.2701 15.53 14.1401 11.99 14.1401C8.45 14.1401 5.21 13.2701 2.75 11.8301V8.38008C2.75 6.69008 4.12 5.33008 5.81 5.33008H18.19Z"
                            stroke="currentColor"
                            stroke-width="1.5"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        ></path>
                        <path
                            d="M15.4951 5.32576V4.95976C15.4951 3.73976 14.5051 2.74976 13.2851 2.74976H10.7051C9.48512 2.74976 8.49512 3.73976 8.49512 4.95976V5.32576"
                            stroke="currentColor"
                            stroke-width="1.5"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        ></path>
                        <path
                            d="M2.77441 15.4829L2.96341 17.9919C3.09141 19.6829 4.50041 20.9899 6.19541 20.9899H17.7944C19.4894 20.9899 20.8984 19.6829 21.0264 17.9919L21.2154 15.4829"
                            stroke="currentColor"
                            stroke-width="1.5"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        ></path>
                    </svg>
                </div>
                <span>Modal</span>
            </a>
        </li>
        <li id="hoverable1" class="col-lg-3 col-md-6 mb-2 text-start">
            <a href="{{ route('posisi_keuangan') }}">
                <div class="iq-icon me-3">
                    <svg width="23" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            fill-rule="evenodd"
                            clip-rule="evenodd"
                            d="M16.5139 21.5H8.16604C5.09968 21.5 2.74727 20.3925 3.41547 15.9348L4.1935 9.89363C4.6054 7.66937 6.02416 6.81812 7.26901 6.81812H17.4475C18.7107 6.81812 20.047 7.73345 20.523 9.89363L21.3011 15.9348C21.8686 19.8891 19.5802 21.5 16.5139 21.5Z"
                            stroke="currentColor"
                            stroke-width="1.5"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        ></path>
                        <path
                            d="M16.6512 6.59848C16.6512 4.21241 14.7169 2.27812 12.3309 2.27812V2.27812C11.1819 2.27325 10.0782 2.72628 9.26406 3.53703C8.44987 4.34778 7.99218 5.44947 7.99219 6.59848H7.99219"
                            stroke="currentColor"
                            stroke-width="1.5"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        ></path>
                        <path d="M15.2965 11.102H15.2507" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M9.4659 11.102H9.42013" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </div>
                <span>Posisi Keuangan <br> (Neraca)</span>
            </a>
        </li>
        <li id="hoverable" class="col-lg-3 col-md-6 mb-2 text-start">
            <a href="{{ route('arus_kas_bulan') }}">
                <div class="iq-icon me-3">
                    <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M7.24512 14.7815L10.2383 10.8914L13.6524 13.5733L16.5815 9.79297" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        <circle cx="19.9954" cy="4.20027" r="1.9222" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></circle>
                        <path
                            d="M14.9248 3.12012H7.65704C4.6456 3.12012 2.77832 5.25284 2.77832 8.26428V16.3467C2.77832 19.3581 4.60898 21.4817 7.65704 21.4817H16.2612C19.2726 21.4817 21.1399 19.3581 21.1399 16.3467V9.30776"
                            stroke="currentColor"
                            stroke-width="1.5"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        ></path>
                    </svg>
                </div>
                <span>Arus Kas Bulan <br> (Cash Flow)</span>
            </a>
        </li>
        <li id="hoverable" class="col-lg-3 col-md-6 mb-2 text-start">
            <a href="{{ route('laba_rugi') }}">
                <div class="iq-icon me-3">
                    <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M7.37121 10.2017V17.0618" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M12.0382 6.91919V17.0619" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M16.6285 13.8269V17.0619" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path
                            fill-rule="evenodd"
                            clip-rule="evenodd"
                            d="M16.6857 2H7.31429C4.04762 2 2 4.31208 2 7.58516V16.4148C2 19.6879 4.0381 22 7.31429 22H16.6857C19.9619 22 22 19.6879 22 16.4148V7.58516C22 4.31208 19.9619 2 16.6857 2Z"
                            stroke="currentColor"
                            stroke-width="1.5"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        ></path>
                    </svg>
                </div>
                <span>Laba Rugi</span>
            </a>
        </li>
        <p></p>
        <li class="col-lg-3 col-md-6 text-start mb-2" id="hoverable">
            <a href="{{ route('stok_barang') }}">
                <div class="iq-icon me-3">
                    <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            fill-rule="evenodd"
                            clip-rule="evenodd"
                            d="M3 6.5C3 3.87479 3.02811 3 6.5 3C9.97189 3 10 3.87479 10 6.5C10 9.12521 10.0111 10 6.5 10C2.98893 10 3 9.12521 3 6.5Z"
                            stroke="currentColor"
                            stroke-width="1.5"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        ></path>
                        <path
                            fill-rule="evenodd"
                            clip-rule="evenodd"
                            d="M14 6.5C14 3.87479 14.0281 3 17.5 3C20.9719 3 21 3.87479 21 6.5C21 9.12521 21.0111 10 17.5 10C13.9889 10 14 9.12521 14 6.5Z"
                            stroke="currentColor"
                            stroke-width="1.5"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        ></path>
                        <path
                            fill-rule="evenodd"
                            clip-rule="evenodd"
                            d="M3 17.5C3 14.8748 3.02811 14 6.5 14C9.97189 14 10 14.8748 10 17.5C10 20.1252 10.0111 21 6.5 21C2.98893 21 3 20.1252 3 17.5Z"
                            stroke="currentColor"
                            stroke-width="1.5"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        ></path>
                        <path
                            fill-rule="evenodd"
                            clip-rule="evenodd"
                            d="M14 17.5C14 14.8748 14.0281 14 17.5 14C20.9719 14 21 14.8748 21 17.5C21 20.1252 21.0111 21 17.5 21C13.9889 21 14 20.1252 14 17.5Z"
                            stroke="currentColor"
                            stroke-width="1.5"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        ></path>
                    </svg>
                </div>
                <span>Stok Barang</span>
            </a>
        </li>
        <li class="col-lg-3 col-md-6 text-start mb-2" id="hoverable">
            <a href="{{ route('beban_usaha') }}">
                <div class="iq-icon me-3">
                <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M14.3955 9.59497L9.60352 14.387" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    <path d="M14.3971 14.3898L9.60107 9.59277" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    <path
                        fill-rule="evenodd"
                        clip-rule="evenodd"
                        d="M16.3345 2.75024H7.66549C4.64449 2.75024 2.75049 4.88924 2.75049 7.91624V16.0842C2.75049 19.1112 4.63549 21.2502 7.66549 21.2502H16.3335C19.3645 21.2502 21.2505 19.1112 21.2505 16.0842V7.91624C21.2505 4.88924 19.3645 2.75024 16.3345 2.75024Z"
                        stroke="currentColor"
                        stroke-width="1.5"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    ></path>
                </svg>
                </div>
                <span>Beban Usaha (dihapus?)</span>
            </a>
        </li>
        <li class="col-lg-3 col-md-6 text-start mb-2" id="hoverable">
            <a href="{{ route('buku_kas') }}">
                <div class="iq-icon me-3">
                <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        fill-rule="evenodd"
                        clip-rule="evenodd"
                        d="M21.419 15.732C21.419 19.31 19.31 21.419 15.732 21.419H7.95C4.363 21.419 2.25 19.31 2.25 15.732V7.932C2.25 4.359 3.564 2.25 7.143 2.25H9.143C9.861 2.251 10.537 2.588 10.967 3.163L11.88 4.377C12.312 4.951 12.988 5.289 13.706 5.29H16.536C20.123 5.29 21.447 7.116 21.447 10.767L21.419 15.732Z"
                        stroke="currentColor"
                        stroke-width="1.5"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    ></path>
                    <path d="M7.48145 14.4629H16.2164" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
                </div>
                <span>Buku Kas</span>
            </a>
        </li>
        <li class="col-lg-3 col-md-6 text-start mb-2" id="hoverable">
            <a href="{{ route('buku_utang') }}">
                <div class="iq-icon me-3">
                <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M15.7161 16.2234H8.49609" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    <path d="M15.7161 12.0369H8.49609" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    <path d="M11.2521 7.86011H8.49707" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    <path
                        fill-rule="evenodd"
                        clip-rule="evenodd"
                        d="M15.909 2.74976C15.909 2.74976 8.23198 2.75376 8.21998 2.75376C5.45998 2.77076 3.75098 4.58676 3.75098 7.35676V16.5528C3.75098 19.3368 5.47298 21.1598 8.25698 21.1598C8.25698 21.1598 15.933 21.1568 15.946 21.1568C18.706 21.1398 20.416 19.3228 20.416 16.5528V7.35676C20.416 4.57276 18.693 2.74976 15.909 2.74976Z"
                        stroke="currentColor"
                        stroke-width="1.5"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    ></path>
                </svg>
                </div>
                <span>Buku Utang dan Piutang</span>
            </a>
        </li>
    </ul> 
</div>
<div class="offcanvas offcanvas-bottom share-offcanvas" tabindex="-1" id="share-btn" aria-labelledby="shareBottomLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="shareBottomLabel">Share</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body small">
        <div class="d-flex flex-wrap align-items-center">
            <div class="text-center me-3 mb-3">
                <img src="../../assets/images/brands/08.png" class="img-fluid rounded mb-2" alt="" />
                <h6>Facebook</h6>
            </div>
            <div class="text-center me-3 mb-3">
                <img src="../../assets/images/brands/09.png" class="img-fluid rounded mb-2" alt="" />
                <h6>Twitter</h6>
            </div>
            <div class="text-center me-3 mb-3">
                <img src="../../assets/images/brands/10.png" class="img-fluid rounded mb-2" alt="" />
                <h6>Instagram</h6>
            </div>
            <div class="text-center me-3 mb-3">
                <img src="../../assets/images/brands/11.png" class="img-fluid rounded mb-2" alt="" />
                <h6>Google Plus</h6>
            </div>
            <div class="text-center me-3 mb-3">
                <img src="../../assets/images/brands/13.png" class="img-fluid rounded mb-2" alt="" />
                <h6>In</h6>
            </div>
            <div class="text-center me-3 mb-3">
                <img src="../../assets/images/brands/12.png" class="img-fluid rounded mb-2" alt="" />
                <h6>YouTube</h6>
            </div>
        </div>
    </div>
</div>


@push('child-js')
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
    <script src="{{ asset('hoverable/hoverable.js') }}"></script>
@endpush


@endsection