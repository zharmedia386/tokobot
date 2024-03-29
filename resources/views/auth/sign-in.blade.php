@extends('layouts.master-1')
@section('title', 'Sign In')
@section('content')
    
<div class="wrapper">
    <section class="container-fluid bg-circle-login" id="auth-sign">
        <div class="row align-items-center">
            <div class="col-md-12 col-lg-7 col-xl-4">
                <div class="card-body">
                    <!-- <a href="{{ route('home') }}">
                        <img src="{{ asset('assets/images/favicon.png') }}" class="img-fluid logo-img" alt="img4" />
                    </a> -->
                    <br><br>
                    <h2 class="mb-2 text-center">Login Akun</h2>
                    <br>
                    <!-- <p class="text-center">Sign in to stay connected.</p> -->

                    <!-- ALERT LOGIN FIRST -->
                    @if (session()->has('loginFirst'))
                    <div id="alerts-disimissible-component">
                        <div class="alert alert-left alert-info  alert-dismissible fade show fs-7" role="alert">
                            {{ session('loginFirst') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"> </button>
                        </div>
                    </div>
                    @endif

                    <!-- ALERT SUCCESSFULLY REGISTER, PLEASE LOGIN -->
                    @if (session()->has('successRegister'))
                    <div id="alerts-disimissible-component">
                        <div class="alert alert-left alert-success  alert-dismissible fade show fs-7" role="alert">
                            {{ session('successRegister') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"> </button>
                        </div>
                    </div>
                    @endif

                    <form action="{{ route('login_post') }}" method="POST" class="needs-validation" novalidate="">
                    @csrf
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" class="form-control form-control-sm" id="username" name="username" aria-describedby="username" placeholder="..." />
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control form-control-sm" id="password"  name="password" aria-describedby="password" placeholder="..." />
                                </div>
                            </div>
                            <div class="col-lg-12 d-flex justify-content-between">
                                <div class="form-check mb-3">
                                    <input type="checkbox" class="form-check-input" id="customCheck1" />
                                    <label class="form-check-label" for="customCheck1">Ingat saya</label>
                                </div>
                                {{-- <a href="recoverpw.html">Lupa Password?</a> --}}
                            </div>
                        </div>
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary">Sign In</button>
                        </div>
                        <!-- <p class="text-center my-3">or sign in with other accounts?</p>
                        <div class="d-flex justify-content-center">
                            <ul class="list-group list-group-horizontal list-group-flush">
                                <li class="list-group-item border-0 pb-0">
                                    <a href="#"><img src="{{ asset('assets/images/brands/fb.svg') }}" alt="fb" /></a>
                                </li>
                                <li class="list-group-item border-0 pb-0">
                                    <a href="#"><img src="{{ asset('assets/images/brands/gm.svg') }}" alt="gm" /></a>
                                </li>
                                <li class="list-group-item border-0 pb-0">
                                    <a href="#"><img src="{{ asset('assets/images/brands/im.svg') }}" alt="im" /></a>
                                </li>
                                <li class="list-group-item border-0 pb-0">
                                    <a href="#"><img src="{{ asset('assets/images/brands/li.svg') }}" alt="li" /></a>
                                </li>
                            </ul>
                        </div> -->
                        <p class="mt-3 text-center">Belum punya akun? <a href="{{route('register')}}" class="text-underline"><br><strong>Klik disini</strong></a> untuk bikin akun baru</p>
                    </form>
                </div>
            </div>
            <div class="col-md-12 col-lg-5 col-xl-7 d-lg-block d-none vh-100 overflow-hidden">
                <img src="{{ asset('assets/images/auth/11.png') }}" class="img-fluid sign-in-img" alt="images" />
            </div>
        </div>
    </section>
</div>
    
@endsection