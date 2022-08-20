<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <title>@yield('title') &mdash; Tokobot</title>

        <!-- Favicon -->
        <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}" />

        <!-- Library / Plugin Css Build -->
        <link rel="stylesheet" href="{{ asset('assets/css/core/libs.min.css') }}" />

        <!-- Custom Css -->
        <link rel="stylesheet" href="{{ asset('assets/css/aprycot.min.css?v=1.0.0') }}" />

        <!-- Child CSS -->
        @stack('child-css')
    </head>
    <body class="  " style="background: url(assets/images/dashboard.png); background-attachment: fixed; background-size: cover;">
        <!-- loader START -->
        @include('layouts.loader')
        <!-- loader END -->

        @include('layouts.position_relative')
        
        @include('layouts.sidebar')

        <main class="main-content">
            <div class="position-relative">
                @include('layouts.navbar')
            </div>
            <div class="content-inner mt-5 py-0">
                
                @yield('content')
            </div>

            @include('layouts.footer')

        </main>

        <!-- Child Javascript -->
        @stack('child-js')
        
        <!-- Required Library Bundle Script -->
        <script src="{{ asset('assets/js/core/libs.min.js') }}"></script>

        <!-- External Library Bundle Script -->
        <script src="{{ asset('assets/js/core/external.min.js') }}"></script>

        <!-- Mapchart JavaScript -->
        <script src="{{ asset('assets/js/charts/dashboard.js') }}"></script>

        <!-- fslightbox JavaScript -->
        <script src="{{ asset('assets/js/fslightbox.js') }}"></script>

        <!-- app JavaScript -->
        <script src="{{ asset('assets/js/app.js') }}"></script>

        <!-- moment JavaScript -->
        <script src="{{ asset('assets/vendor/moment.min.js') }}"></script>
        
        <!-- Widgetchart JavaScript -->
        <script src="{{ asset('assets/js/charts/widgetcharts.js') }}"></script>

        <!-- Mapchart JavaScript -->
        <script src="{{ asset('assets/js/charts/vectore-chart.js') }}"></script>

        <!-- Admin Dashboard Chart -->
        <script src="{{ asset('assets/js/charts/admin.js') }}"></script>
        
        <!-- GSAP Animation -->
        <script src="{{ asset('assets/vendor/gsap/gsap.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/gsap/ScrollTrigger.min.js') }}"></script>
        <script src="{{ asset('assets/js/animation/gsap-init.js') }}"></script>
        
        <!-- Stepper Plugin -->
        <script src="{{ asset('assets/js/stepper.js') }}"></script>
        
        <!-- Form Wizard Script -->
        <script src="{{ asset('assets/js/form-wizard.js') }}"></script>
    </body>
</html>
