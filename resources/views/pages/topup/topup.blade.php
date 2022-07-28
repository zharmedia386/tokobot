@extends('layouts.master-auth')
@section('title', 'Top-up')
@section('content')
<!-- Main Content -->
<div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="login-brand">
              <img src="{{ URL::asset('assets/img/delicacy-login.png') }}" alt="logo" width="100" class="shadow-light rounded-circle">
            </div>

            <div class="card card-primary">
              <div class="card-header"><h4>Top-up</h4></div>

              <div class="card-body">
                <p class="text-muted">Masukkan jumlah saldo yang akan di-top-up</p>
                <form action="{{ route('topup.custom') }}" method="POST">
                  @csrf
                  <div class="form-group">
                    <label for="saldo">Saldo</label>
                    <input id="saldo" type="text" class="form-control" placeholder="Masukkan Saldo" name="saldo" tabindex="2" required autofocus />
                    <div class="invalid-feedback">Please fill in your saldo</div>
                  </div>
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                      Konfirmasi
                    </button>
                  </div>
                </form>
              </div>
            </div>
            <div class="mt-5 text-muted text-center">
              <a href="{{route('dashboard')}}">Back to previous page</a>
            </div>
            <div class="simple-footer">Copyright &copy; Tokobot 2022</div>
          </div>
        </div>
      </div>
    </section>
  </div>

@endsection