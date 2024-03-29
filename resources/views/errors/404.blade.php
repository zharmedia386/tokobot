@extends('layouts.master-1')
@section('title', 'Error 404')
@section('content')
    
<div class="wrapper">
    <div class="d-flex align-items-center justify-content-center vh-100">
        <div class="container text-center mt-5">
            <div class="row">
                <div class="col-lg-12">
                    <img src="{{ asset('assets/images/error/01.png') }}" class="img-fluid w-25" alt="" />
                    <img src="{{ asset('assets/images/error/1.png') }}" class="img-fluid px-5" alt="" />
                    <img src="{{ asset('assets/images/error/01.png') }}" class="img-fluid w-25" alt="" />
                    <h2 class="mb-0 mt-4">Page Not Found.</h2>
                    <p class="mt-2">Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs.</p>
                    <div class="d-flex justify-content-center">
                        <a href="{{ route('home') }}" class="btn btn-primary">Back to Home</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="box">
            <div class="c xl-circle">
                <div class="c lg-circle">
                    <div class="c md-circle">
                        <div class="c sm-circle">
                            <div class="c xs-circle"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection