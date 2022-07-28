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
    </head>
    <body class="  " style="background: url(assets/images/dashboard.png); background-attachment: fixed; background-size: cover;">
        <!-- loader START -->
        @include('layouts.loader')
        <!-- loader END -->

        
        @yield('content')


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
    </body>
</html>
