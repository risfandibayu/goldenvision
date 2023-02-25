<!DOCTYPE html>
<!--[if IE 8]><html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]>
<!-->
<html class="no-js" lang="en">
<!--<![endif]-->

<head>

    <!-- Basic Page Needs
 ================================================== -->
    <meta charset="utf-8">
    <title>Masterplan {{ isset($title) ? ' - ' . $title : '' }}</title>

    <!-- Mobile Specific Metas
 ================================================== -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- CSS
 ================================================== -->
    <link rel="stylesheet" href="{{ asset('assets/landing/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/landing/css/animsition.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/landing/css/unicons.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/landing/css/lighbox.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/landing/css/tooltip.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/landing/css/swiper.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/landing/css/style.css') }}" />

    <!-- Favicons
 ================================================== -->
    <link rel="icon" type="image/png" href="{{ asset('assets/images/favicon-new.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('assets/images/favicon-new.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('assets/images/favicon-new.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('assets/images/favicon-new.png') }}">

    @yield('css')
</head>

<body {{ isset($bodyClass) ? 'class=' . $bodyClass : '' }}>

    <div class="animsition">

        @yield('content')

        @include($activeTemplate . 'partials/landing/footer')
    </div>

    <!-- JAVASCRIPT
    ================================================== -->
    <script src="{{ asset('assets/landing/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/landing/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/landing/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/landing/js/plugins.js') }}"></script>
    <script src="{{ asset('assets/landing/js/custom.js') }}"></script>
    @include('partials.notify')
    @yield('js')
    @stack('script')

</body>

</html>
