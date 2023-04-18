<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{ $title ?? 'Masterplan' }}</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Include All CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/v3') }}/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/v3') }}/css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/v3') }}/css/payloan-icon.css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/v3') }}/css/icofont.css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/v3') }}/css/animate.css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/v3') }}/css/settings.css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/v3') }}/css/slick.css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/v3') }}/css/owl.theme.css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/v3') }}/css/owl.carousel.css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/v3') }}/css/preset.css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/v3') }}/css/theme.css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/v3') }}/css/responsive.css" />
    <!-- Favicon Icon -->
    <link rel="icon" type="image/png" href="{{ asset('assets/images/favicon-new.png') }}">

</head>

<body>
    @yield('content')
    <!-- Preloading -->
    {{-- <div class="preloader text-center">
        <div class="la-ball-circus la-2x">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div> --}}
    <!-- Preloading -->
    <!-- Header section -->

    <!-- Include All JS -->
    <script src="{{ asset('assets/v3') }}/js/jquery.js"></script>
    <script src="{{ asset('assets/v3') }}/js/bootstrap.min.js"></script>
    <script src="{{ asset('assets/v3') }}/js/modernizr.custom.js"></script>
    <script src="{{ asset('assets/v3') }}/js/jquery.themepunch.revolution.min.js"></script>
    <script src="{{ asset('assets/v3') }}/js/jquery.themepunch.tools.min.js"></script>

    <script src="{{ asset('assets/v3') }}/js/jquery-ui.js"></script>
    <script src="{{ asset('assets/v3') }}/js/shuffle.js"></script>
    <script src="{{ asset('assets/v3') }}/js/slick.js"></script>
    <script src="{{ asset('assets/v3') }}/js/gmaps.js"></script>
    <script src="https://maps.google.com/maps/api/js?key=AIzaSyCysDHE3s4Qw3nTh9o58-2mJcqvR6HV8Kk"></script>
    <script src="{{ asset('assets/v3') }}/js/owl.carousel.js"></script>
    <script src="{{ asset('assets/v3') }}/js/theme.js"></script>

    @stack('script')
</body>

</html>
