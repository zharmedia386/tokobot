@extends('layouts.master')
@section('title', 'Dashboard')
@section('content')
<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Dashboard</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Views</a></div>
        <div class="breadcrumb-item"><a href="#">Pages</a></div>
        <div class="breadcrumb-item">Dashboard</div>
      </div>
    </div>

    <div class="section-body">
      <h2 class="section-title">Page 1</h2>
      {{-- Start Card --}}
      <div class="row">
        <div class="col-12 mb-4">
          <div class="hero bg-primary text-white">
            <div class="hero-inner">
              <h2>Welcome, {{ session()->get('username') }}!</h2>
              <p class="lead">You almost arrived, complete the information about your account to complete registration.</p>
              <div class="mt-4">
                <a href="#" class="btn btn-outline-white btn-lg btn-icon icon-left"><i class="far fa-user"></i> Setup Account</a>
              </div>
            </div>
          </div>
        </div>
      </div>
      {{-- End Card --}}
    </div>
  </section>
</div>

{{-- Alert --}}
@if (session()->has('successTopUp'))
  @php
  echo '<script type="text/javascript">alert("Top up Success! Please wait for cashier approval");</script>';
  @endphp
@endif

@if (session()->has('confirmPaymentCustomer'))
  @php
  echo '<script type="text/javascript">alert("Payment Success! Please wait for the driver to confirm your order");</script>';
  @endphp
@endif

@endsection