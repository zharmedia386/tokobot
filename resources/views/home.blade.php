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
                                <h6 class="me-2 text-primary">Devon Lane</h6>
                                <span>
                                    <svg width="19" height="19" class="me-2" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M21 10.8421C21 16.9172 12 23 12 23C12 23 3 16.9172 3 10.8421C3 4.76697 7.02944 1 12 1C16.9706 1 21 4.76697 21 10.8421Z" stroke="#07143B" stroke-width="1.5" />
                                        <circle cx="12" cy="9" r="3" stroke="#07143B" stroke-width="1.5" />
                                    </svg>
                                    <small class="mb-0 text-dark">Lisbon, Portugal</small>
                                </span>
                            </div>
                            <div class="ms-4">
                                <p class="mb-0 text-dark">UI/UX Designer</p>
                                <p class="me-2 mb-0 text-dark">Hello@gmail.com</p>
                                <p class="mb-0 text-dark">Email</p>
                            </div>
                        </div>
                    </div>
                    <ul class="d-flex mb-0 text-center">
                        <li class="badge bg-primary py-2 me-2">
                            <p class="mb-3 mt-2">142</p>
                            <small class="mb-1 fw-normal">Reviews</small>
                        </li>
                        <li class="badge bg-primary py-2 me-2">
                            <p class="mb-3 mt-2">201</p>
                            <small class="mb-1 fw-normal">Photos</small>
                        </li>
                        <li class="badge bg-primary py-2 me-2">
                            <p class="mb-3 mt-2">3.1k</p>
                            <small class="mb-1 fw-normal">Followers</small>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="iq-header-img">
                <img src="../../assets/images/User-profile/01.png" alt="header" class="img-fluid w-100 rounded" style="object-fit: contain;" />
            </div>
        </div>
    </div>
    <ul id="top-tab-list" class="p-0 row list-inline">
        <li class="col-lg-3 col-md-6 text-start mb-2" id="hoverable">
            <a href="{{ route('sales') }}">
                <div class="iq-icon me-3">
                    <svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" height="20" width="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 11V7a4 4 0 118 0m-4 8v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2z" />
                    </svg>
                </div>
                <span>Penjualan</span>
            </a>
        </li>
        <li id="hoverable1" class="col-lg-3 col-md-6 mb-2 text-start">
            <a href="{{ route('purchase') }}">
                <div class="iq-icon me-3">
                    <svg xmlns="http://www.w3.org/2000/svg" height="20" width="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
                <span>Pembelian</span>
            </a>
        </li>
        <li id="hoverable" class="col-lg-3 col-md-6 mb-2 text-start">
            <a href="{{ route('asset') }}">
                <div class="iq-icon me-3">
                    <svg xmlns="http://www.w3.org/2000/svg" height="20" width="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"
                        />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </div>
                <span>Asset</span>
            </a>
        </li>
        <li id="hoverable" class="col-lg-3 col-md-6 mb-2 text-start">
            <a href="{{ route('kewajiban') }}">
                <div class="iq-icon me-3">
                    <svg xmlns="http://www.w3.org/2000/svg" height="20" width="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                <span>Kewajiban</span>
            </a>
        </li>
        <p></p>
        <li class="col-lg-3 col-md-6 text-start mb-2" id="hoverable">
            <a href="{{ route('modal') }}">
                <div class="iq-icon me-3">
                    <svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" height="20" width="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 11V7a4 4 0 118 0m-4 8v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2z" />
                    </svg>
                </div>
                <span>Modal</span>
            </a>
        </li>
        <li id="hoverable1" class="col-lg-3 col-md-6 mb-2 text-start">
            <a href="{{ route('posisi_keuangan') }}">
                <div class="iq-icon me-3">
                    <svg xmlns="http://www.w3.org/2000/svg" height="20" width="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
                <span>Posisi Keuangan</span>
            </a>
        </li>
        <li id="hoverable" class="col-lg-3 col-md-6 mb-2 text-start">
            <a href="{{ route('arus_kas_bulan') }}">
                <div class="iq-icon me-3">
                    <svg xmlns="http://www.w3.org/2000/svg" height="20" width="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"
                        />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </div>
                <span>Arus Kas Bulan</span>
            </a>
        </li>
        <li id="hoverable" class="col-lg-3 col-md-6 mb-2 text-start">
            <a href="{{ route('laba_rugi') }}">
                <div class="iq-icon me-3">
                    <svg xmlns="http://www.w3.org/2000/svg" height="20" width="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                <span>Laba Rugi</span>
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