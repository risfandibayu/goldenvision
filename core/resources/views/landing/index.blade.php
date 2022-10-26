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
    <title>Masterplan</title>

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
    <link rel="icon" type="image/png" href="favicon.png">
    <link rel="apple-touch-icon" href="apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="apple-touch-icon-114x114.png">


</head>

<body>

    <div class="animsition">

        <!-- Navigation
  ================================================== -->

        <div class="navigation-wrap cbp-af-header header-dark header-transparent one-page-nav">
            <div class="padding-on-scroll">
                <div class="section-1400">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <nav class="navbar navbar-expand-xl navbar-light">

                                    <a class="navbar-brand animsition-link" href="{{ route('home') }}">
                                        <img src="{{ asset('assets/images/logo.jpg') }}" alt="logo">
                                    </a>

                                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                        aria-expanded="false" aria-label="Toggle navigation">
                                        <span class="navbar-toggler-icon"></span>
                                    </button>

                                    <div class="collapse navbar-collapse text-center text-xl-right"
                                        id="navbarSupportedContent">
                                        <ul class="navbar-nav ml-auto pt-4 pt-xl-0 mr-xl-4">
                                            <li class="nav-item">
                                                <a class="nav-link" href="#page-home" data-gal='m_PageScroll2id'
                                                    data-ps2id-offset="70">Beranda</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="#page-product" data-gal='m_PageScroll2id'
                                                    data-ps2id-offset="70">Produk</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="#page-about" data-gal='m_PageScroll2id'
                                                    data-ps2id-offset="70">Tentang</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="#page-faq" data-gal='m_PageScroll2id'
                                                    data-ps2id-offset="70">FAQ</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="#" data-toggle="modal"
                                                    data-target="#modal-login-register">Login | Register</a>
                                            </li>
                                        </ul>
                                        <div class="pb-3 pb-xl-0"></div>
                                    </div>

                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade modal-medium" id="modal-login-register" tabindex="-1" role="dialog"
            aria-labelledby="modal-login-register" style="display: none;" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body z-bigger">
                        <div class="container-fluid">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <i class="uil uil-multiply"></i>
                            </button>
                            <div class="text-center">
                                <h5 class="mb-2">Login / Register</h5>
                            </div>
                            <div>
                                <ul class="nav nav-pills mb-3 login-register-menu" id="pills-tab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="pills-login-tab" data-toggle="pill"
                                            href="#pills-login" role="tab" aria-controls="pills-login"
                                            aria-selected="true">Login</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="pills-register-tab" data-toggle="pill"
                                            href="#pills-register" role="tab" aria-controls="pills-register"
                                            aria-selected="false">Register</a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="pills-tabContent">
                                    <div class="tab-pane fade active show" id="pills-login" role="tabpanel"
                                        aria-labelledby="pills-login-tab">
                                        <form method="post" action="{{ route('user.login') }}">
                                            @csrf

                                            <div>
                                                <div class="form-group">
                                                    <input type="text"
                                                        class="form-style form-style-with-icon {{ $errors->has('no_bro') ? 'is-invalid' : '' }}"
                                                        placeholder="@lang('Username/E-mail/MP Number')" autocomplete="off"
                                                        name="username" value="{{ old('username') }}">
                                                    <i class="input-icon uil uil-user-circle"></i>
                                                    @error('no_bro')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="mt-4">
                                                <div class="form-group">
                                                    <input type="password"
                                                        class="form-style form-style-with-icon {{ $errors->has('password') ? 'is-invalid' : '' }}"
                                                        placeholder="@lang('Password')" autocomplete="off"
                                                        name="password">
                                                    <i class="input-icon uil uil-lock-alt"></i>
                                                    @error('password')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>

                                            @if (reCaptcha())
                                                <div class="form-group my-3">
                                                    @php echo reCaptcha(); @endphp
                                                </div>
                                            @endif

                                            <div class="col-lg-12 form-group my-3">
                                                @include($activeTemplate . 'partials.custom-captcha')
                                            </div>

                                            <div class="mt-4">
                                                <button class="btn btn-primary btn-fluid">Login</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="tab-pane fade" id="pills-register" role="tabpanel"
                                        aria-labelledby="pills-register-tab">
                                        <form method="post" action="{{ route('user.register') }}">
                                            @csrf

                                            <div>
                                                <div class="form-group">
                                                    <label>@lang('First Name')</label>
                                                    <input type="text"
                                                        class="form-style {{ $errors->has('firstname') ? 'is-invalid' : '' }}"
                                                        placeholder="@lang('First Name')" name="firstname"
                                                        autocomplete="off" value="{{ old('firstname') }}">
                                                    @error('firstname')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="mt-4">
                                                <div class="form-group">
                                                    <label>@lang('Last Name')</label>
                                                    <input type="text"
                                                        class="form-style {{ $errors->has('lastname') ? 'is-invalid' : '' }}"
                                                        placeholder="@lang('Last Name')" name="lastname"
                                                        autocomplete="off" value="{{ old('lastname') }}">
                                                    @error('lastname')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="mt-4">
                                                <div class="form-group">
                                                    <label>@lang('Email')</label>
                                                    <input type="text"
                                                        class="form-style {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                                        placeholder="Email" name="email"
                                                        value="{{ old('email') }}" autocomplete="off">
                                                    @error('email')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="mt-4">
                                                <div class="form-group">
                                                    <label>@lang('Username')</label>
                                                    <input type="text"
                                                        class="form-style {{ $errors->has('username') ? 'is-invalid' : '' }}"
                                                        placeholder="@lang('Username')" autocomplete="off"
                                                        value="{{ old('username') }}" name="username">
                                                    @error('username')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="mt-4">
                                                <div class="form-group">
                                                    <label>@lang('Phone Number')</label>
                                                    <div class="row m-0">
                                                        <div class="col-3 m-0 p-0">
                                                            <select class="form-style" name="country_code">

                                                                @include('partials.country_code')
                                                            </select>
                                                        </div>
                                                        <div class="col-9 m-0 p-0">
                                                            <input type="text"
                                                                class="form-style {{ $errors->has('mobile') ? 'is-invalid' : '' }}"
                                                                placeholder="@lang('Phone Number')" autocomplete="off"
                                                                name="mobile" value="{{ old('mobile') }}">
                                                            @error('mobile')
                                                                <small class="text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mt-4">
                                                <div class="form-group">
                                                    <label>@lang('Country')</label>
                                                    <input type="text"
                                                        class="form-style {{ $errors->has('country') ? 'is-invalid' : '' }}"
                                                        name="country" placeholder="@lang('Country')" readonly
                                                        autocomplete="off" value="{{ old('country') }}">
                                                    @error('country')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="mt-4">
                                                <div class="form-group">
                                                    <label>@lang('Password')</label>
                                                    <input type="password"
                                                        class="form-style {{ $errors->has('password') ? 'is-invalid' : '' }}"
                                                        placeholder="@lang('Password')" autocomplete="off"
                                                        name="password">
                                                    @error('password')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="mt-4">
                                                <div class="form-group">
                                                    <label>@lang('Confirm Password')</label>
                                                    <input type="password"
                                                        class="form-style {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}"
                                                        placeholder="@lang('Confirm Password')" autocomplete="off"
                                                        name="password_confirmation">
                                                    @error('password_confirmation')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-lg-12">
                                                @include($activeTemplate . 'partials.custom-captcha')
                                            </div>

                                            @if ($general->agree_policy)
                                                <div class="mt-4">
                                                    <div class="form-group">
                                                        <input type="checkbox" id="checkbox-1" name="agree">
                                                        <label class="checkbox mb-0 font-weight-500 size-15"
                                                            for="checkbox-1">
                                                            I accept the <a href="#"
                                                                class="link link-dark-primary"
                                                                data-hover="Terms and Conditions">Terms and
                                                                Conditions</a> and <a href="#"
                                                                class="link link-dark-primary"
                                                                data-hover="Privacy Policy">Privacy Policy</a>
                                                        </label>
                                                        <br />
                                                        @error('agree')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>
                                            @endif
                                            <div class="mt-4">
                                                <button class="btn btn-primary btn-fluid">Register</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            {{-- </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Primary Page Layout
  ================================================== -->

        <!-- Hero
  ================================================== -->

        <div class="section over-hide full-height" id="page-home">
            <div class="section">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="section full-height over-hide one-page-hero-back-img-2 parallax-hero-1200"
                            style="background-image: url('{{ asset('assets/landing/img/hero-img-1.jpg') }}');">
                            <div class="hero-center-section text-center px-2">
                                <h2 class="display-5 mb-4 color-light-2 text-center fade-hero"
                                    data-swiper-parallax-y="200" data-swiper-parallax-duration="600">
                                    Masterplan
                                </h2>
                                <p class="lead font-weight-600 mb-0 color-light-2 text-center fade-hero"
                                    data-swiper-parallax-y="150" data-swiper-parallax-duration="500">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                    incididunt ut labore et dolore magna aliqua
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Product section
  ================================================== -->

        <div class="section over-hide" id="page-product">
            <div class="section over-hide padding-top-bottom-120 section-background-24">
                <div class="section-1400">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6 col-lg-3"
                                data-scroll-reveal="enter bottom move 40px over 0.5s after 0.3s">
                                <div class="section border-4 services-wrap-3 px-4 py-5">
                                    <p class="mb-2"><i class="uil uil-package size-50"></i></p>
                                    <h6 class="mb-4">
                                        Product 1
                                    </h6>
                                    <p class="mb-0">
                                        Sed ut perspiciatis unde omnis iste natus error sit voluptatem.
                                    </p>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-3 mt-4 mt-sm-0"
                                data-scroll-reveal="enter bottom move 40px over 0.5s after 0.3s">
                                <div class="section border-4 services-wrap-3 px-4 py-5">
                                    <p class="mb-2"><i class="uil uil-ruler-combined size-50"></i></p>
                                    <h6 class="mb-4">
                                        Product 2
                                    </h6>
                                    <p class="mb-0">
                                        Sed ut perspiciatis unde omnis iste natus error sit voluptatem.
                                    </p>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-3 mt-4 mt-lg-0"
                                data-scroll-reveal="enter bottom move 40px over 0.5s after 0.3s">
                                <div class="section border-4 services-wrap-3 px-4 py-5">
                                    <p class="mb-2"><i class="uil uil-bolt size-50"></i></p>
                                    <h6 class="mb-4">
                                        Product 3
                                    </h6>
                                    <p class="mb-0">
                                        Sed ut perspiciatis unde omnis iste natus error sit voluptatem.
                                    </p>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-3 mt-4 mt-lg-0"
                                data-scroll-reveal="enter bottom move 40px over 0.5s after 0.3s">
                                <div class="section border-4 services-wrap-3 px-4 py-5">
                                    <p class="mb-2"><i class="uil uil-image-check size-50"></i></p>
                                    <h6 class="mb-4">
                                        Product 4
                                    </h6>
                                    <p class="mb-0">
                                        Sed ut perspiciatis unde omnis iste natus error sit voluptatem.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- About section
  ================================================== -->

        <div class="section over-hide" id="page-about">
            <div class="section over-hide padding-top-bottom-120 bg-light-2">
                <div class="section-1400 mb-5 pb-lg-3">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12 align-self-center text-center text-lg-left">
                                <div class="row">
                                    <div class="col-12 col-lg-12 services-wrap-2">
                                        <div class="mb-5 px-5">
                                            <div class="col-12">
                                                <h2 class="display-1 mb-0 color-dark-blue">
                                                    Tentang Kami
                                                </h2>
                                            </div>
                                            <div class="col-12 mt-3">
                                                <h5 class="mb-0 color-gray-dark title-text-left-line">
                                                    Quisque sagittis purus sit amet volutpat consequat mauris
                                                </h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-12 col-lg-12 services-wrap-2">
                                        <div class="row px-5">
                                            <div class="col-6">
                                                <div class="row">
                                                    <div class="col-auto">
                                                        <img src="{{ asset('assets/landing/img/icon-5.svg') }}"
                                                            alt="">
                                                    </div>
                                                    <div class="col">
                                                        <h5 class="mb-3">
                                                            Quisque
                                                        </h5>
                                                        <p class="mb-0">
                                                            Sed ut perspiciatis unde omnis iste natus error sit
                                                            voluptatem doloremque laudantium.
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="row mt-4">
                                                    <div class="col-auto">
                                                        <img src="{{ asset('assets/landing/img/icon-8.svg') }}"
                                                            alt="">
                                                    </div>
                                                    <div class="col">
                                                        <h5 class="mb-3">
                                                            Rhoncus
                                                        </h5>
                                                        <p class="mb-0">
                                                            Sed ut perspiciatis unde omnis iste natus error sit
                                                            voluptatem doloremque laudantium.
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="row">
                                                    <div class="col-auto">
                                                        <img src="{{ asset('assets/landing/img/icon-5.svg') }}"
                                                            alt="">
                                                    </div>
                                                    <div class="col">
                                                        <h5 class="mb-3">
                                                            Gravida
                                                        </h5>
                                                        <p class="mb-0">
                                                            Sed ut perspiciatis unde omnis iste natus error sit
                                                            voluptatem doloremque laudantium.
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="row mt-4">
                                                    <div class="col-auto">
                                                        <img src="{{ asset('assets/landing/img/icon-8.svg') }}"
                                                            alt="">
                                                    </div>
                                                    <div class="col">
                                                        <h5 class="mb-3">
                                                            Aliquam
                                                        </h5>
                                                        <p class="mb-0">
                                                            Sed ut perspiciatis unde omnis iste natus error sit
                                                            voluptatem doloremque laudantium.
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- FAQ section
  ================================================== -->

        <div class="section over-hide" id="page-faq">
            <div class="section over-hide">
                <div class="section">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12 py-5 px-4">
                                <div class="mb-5">
                                    <div class="col-12">
                                        <h2 class="display-1 mb-0 color-dark-blue">
                                            FAQ
                                        </h2>
                                    </div>
                                    <div class="col-12 mt-3">
                                        <h5 class="mb-0 color-gray-dark title-text-left-line">
                                            Frequently Asked Question
                                        </h5>
                                    </div>
                                </div>

                                <div class="accordion" id="accordionExample">
                                    <div class="card">
                                        <div class="card-header" id="headingOne">
                                            <div class="btn-accordion" role="button" data-toggle="collapse"
                                                data-target="#collapseOne" aria-expanded="true"
                                                aria-controls="collapseOne">
                                                Faq 1
                                            </div>
                                        </div>
                                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                                            data-parent="#accordionExample" style="">
                                            <div class="card-body">
                                                <p class="mb-3">Anim pariatur cliche reprehenderit, enim eiusmod high
                                                    life accusamus terry richardson ad squid. 3 wolf moon officia aute,
                                                    non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt
                                                    laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird
                                                    on it squid single-origin coffee nulla assumenda shoreditch et.</p>
                                                <p class="mb-0">Nihil anim keffiyeh helvetica, craft beer labore wes
                                                    anderson cred nesciunt sapiente ea proident. Ad vegan excepteur
                                                    butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw
                                                    denim aesthetic synth nesciunt you probably haven't heard of them
                                                    accusamus labore sustainable VHS.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header" id="headingTwo">
                                            <div class="btn-accordion collapsed" role="button"
                                                data-toggle="collapse" data-target="#collapseTwo"
                                                aria-expanded="false" aria-controls="collapseTwo">
                                                Faq 2
                                            </div>
                                        </div>
                                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                                            data-parent="#accordionExample">
                                            <div class="card-body">
                                                <p class="mb-3">Anim pariatur cliche reprehenderit, enim eiusmod high
                                                    life accusamus terry richardson ad squid. 3 wolf moon officia aute,
                                                    non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt
                                                    laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird
                                                    on it squid single-origin coffee nulla assumenda shoreditch et.</p>
                                                <p class="mb-0">Nihil anim keffiyeh helvetica, craft beer labore wes
                                                    anderson cred nesciunt sapiente ea proident. Ad vegan excepteur
                                                    butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw
                                                    denim aesthetic synth nesciunt you probably haven't heard of them
                                                    accusamus labore sustainable VHS.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header" id="headingThree">
                                            <div class="btn-accordion collapsed" role="button"
                                                data-toggle="collapse" data-target="#collapseThree"
                                                aria-expanded="false" aria-controls="collapseThree">
                                                Faq 3
                                            </div>
                                        </div>
                                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                                            data-parent="#accordionExample">
                                            <div class="card-body">
                                                <p class="mb-3">Anim pariatur cliche reprehenderit, enim eiusmod high
                                                    life accusamus terry richardson ad squid. 3 wolf moon officia aute,
                                                    non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt
                                                    laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird
                                                    on it squid single-origin coffee nulla assumenda shoreditch et.</p>
                                                <p class="mb-0">Nihil anim keffiyeh helvetica, craft beer labore wes
                                                    anderson cred nesciunt sapiente ea proident. Ad vegan excepteur
                                                    butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw
                                                    denim aesthetic synth nesciunt you probably haven't heard of them
                                                    accusamus labore sustainable VHS.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer
  ================================================== -->

        @include($activeTemplate . 'partials/landing/footer')
    </div>

    <!-- JAVASCRIPT
    ================================================== -->
    <script src="{{ asset('assets/landing/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/landing/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/landing/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/landing/js/plugins.js') }}"></script>
    <script src="{{ asset('assets/landing/js/custom.js') }}"></script>

    <script>
        $('select[name=country_code]').change(function() {
            $('input[name=country]').val($('select[name=country_code] :selected').data('country'));
        }).change();

        @if ($errors->any())
            $('#modal-login-register').modal();

            @if ($form = session('form'))
                @if ($form == 'register')
                    $('#pills-login-tab').removeClass('active');
                    $('#pills-register-tab').addClass('active');

                    $('#pills-login').removeClass('active show');
                    $('#pills-register').addClass('active show');
                @elseif ($form == 'register')
                    $('#pills-login-tab').addClass('active');
                    $('#pills-register-tab').removeClass('active');

                    $('#pills-login').addClass('active show');
                    $('#pills-register').removeClass('active show');
                @endif
            @endif
        @endif
    </script>
    <!-- End Document
================================================== -->
</body>

</html>
