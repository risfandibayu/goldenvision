<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Designsninja">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Masterplan Indonesia</title>
    <link rel="shortcut icon" href="{{ asset('') }}assets/images/favicon-new.png">

    <!-- Core Style Sheets -->
    <link rel="stylesheet" href="{{ asset('') }}assets/assets/css/master.css">
    <!-- Responsive Style Sheets -->
    <link rel="stylesheet" href="{{ asset('') }}assets/assets/css/responsive.css">
    <!-- Revolution Style Sheets -->
    <link rel="stylesheet" type="text/css" href="{{ asset('') }}assets/revolution/css/settings.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('') }}assets/revolution/css/layers.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('') }}assets/revolution/css/navigation.css">

</head>

<body>

    <!--== Loader Start ==-->
    <div id="loader-overlay">
        <div class="loader">
            <div class="loader-inner"></div>
        </div>
    </div>
    <!--== Loader End ==-->

    <!--== Wrapper Start ==-->
    <div class="wrapper">

        <!--== Header Start ==-->
        <nav class="navbar navbar-default navbar-fixed navbar-transparent white bootsnav on no-full no-border">
            <!--== Start Top Search ==-->
            <div class="fullscreen-search-overlay" id="search-overlay"> <a href="#" class="fullscreen-close"
                    id="fullscreen-close-button"><i class="icofont icofont-close"></i></a>
                <div id="fullscreen-search-wrapper">
                    <form method="get" id="fullscreen-searchform">
                        <input type="text" value="" placeholder="Type and hit Enter..."
                            id="fullscreen-search-input" class="search-bar-top">
                        <i class="fullscreen-search-icon icofont icofont-search">
                            <input value="" type="submit">
                        </i>
                    </form>
                </div>
            </div>
            <!--== End Top Search ==-->
            <div class="container-fluid">


                <!--== Collect the nav links, forms, and other content for toggling ==-->
                @include('home.navbar')
                <!--== /.navbar-collapse ==-->
            </div>
        </nav>
        <!--== Header End ==-->

        <!--== Hero Slider Start ==-->
        @include('home.hero')
        <!--== Hero Slider End ==-->

        <!--== Who We Are Start ==-->
        {{-- <section class="pt-0 pb-0 transition-none">
            <div class="container-fluid">
                <div class="row row-flex flex-center">
                    <div class="col-md-6 col-sm-6 col-xs-12 dark-bg">
                        <div class="center-layout text-center">
                            <div class="v-align-middle white-color">
                                <div class="pt-130 pb-130 pr-50 pl-50">
                                    <div class="row">
                                        <div class="col-md-6 feature-box text-left mb-50 col-sm-12 animation-move-top">
                                            <div class="pull-left"><i
                                                    class="icon-pencil font-40px gradient-color xs-font-30px sm-font-30px md-font-26px"></i>
                                            </div>
                                            <div class="pull-right">
                                                <h4 class="mt-0 font-600">User Experience</h4>
                                                <p class="font-400">Lorem Ipsum is simply dummy text of the printing
                                                    and typesetting industry.</p>
                                            </div>
                                        </div>
                                        <div class="col-md-6 feature-box text-left mb-50 col-sm-12 animation-move-top">
                                            <div class="pull-left"><i
                                                    class="icon-tablet font-40px gradient-color xs-font-30px sm-font-30px md-font-26px"></i>
                                            </div>
                                            <div class="pull-right">
                                                <h4 class="mt-0 font-600">Responsive Layout</h4>
                                                <p class="font-400">Lorem Ipsum is simply dummy text of the printing
                                                    and typesetting industry.</p>
                                            </div>
                                        </div>
                                        <div class="col-md-6 feature-box text-left col-sm-12 animation-move-top">
                                            <div class="pull-left"><i
                                                    class="icon-pictures font-40px gradient-color xs-font-30px sm-font-30px md-font-26px"></i>
                                            </div>
                                            <div class="pull-right">
                                                <h4 class="mt-0 font-600">Digital Solutions</h4>
                                                <p class="font-400">Lorem Ipsum is simply dummy text of the printing
                                                    and typesetting industry.</p>
                                            </div>
                                        </div>
                                        <div class="col-md-6 feature-box text-left col-sm-12 animation-move-top">
                                            <div class="pull-left"><i
                                                    class="icon-desktop font-40px gradient-color xs-font-30px sm-font-30px md-font-26px"></i>
                                            </div>
                                            <div class="pull-right">
                                                <h4 class="mt-0 font-600">Bootstrap 3x</h4>
                                                <p class="font-400">Lorem Ipsum is simply dummy text of the printing
                                                    and typesetting industry.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12 relative remove-padding">
                        <div class="front-color-overlay-bg"></div>
                        <div class="img-center"
                            style="background-image: url({{ asset('') }}assets/assets/images/about-video-img-3.jpg);">
                        </div>
                    </div>
                </div>
            </div>
        </section> --}}
        <!--== Who We Are End ==-->

        <!--== Skills Start ==-->
        {{-- <section class="white-bg">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="default-color mt-0 text-uppercase">Our Skills</h5>
                        <h2 class="mt-0 font-700">Innovative Digital Theme</h2>
                        <p>Objectively innovate empowered manufactured products whereas parallel platforms.
                            Holisticly predominate extensible testing procedures for reliable supply chains.</p>
                    </div>
                    <div class="col-md-6">
                        <div class="row chart-style-01 sm-mt-30">
                            <div class="col-md-4 col-sm-4 col-xs-12 sm-mb-30 xs-mb-30 text-center">
                                <div class="chart-circle">
                                    <span class="chart-01" data-percent="95">
                                        <span class="percent dark-color font-20px font-700"></span>
                                    </span>
                                </div>
                                <div class="chart-title">
                                    <span class="dark-color font-18px font-700">Angular</span>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-12 sm-mb-30 xs-mb-30 text-center">
                                <div class="chart-circle">
                                    <span class="chart-01" data-percent="66">
                                        <span class="percent dark-color font-20px font-700"></span>
                                    </span>
                                </div>
                                <div class="chart-title">
                                    <span class="dark-color font-18px font-700">Web Design</span>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-12 sm-mb-30 xs-mb-30 text-center">
                                <div class="chart-circle">
                                    <span class="chart-01" data-percent="85">
                                        <span class="percent dark-color font-20px font-700"></span>
                                    </span>
                                </div>
                                <div class="chart-title">
                                    <span class="dark-color font-18px font-700">Photography</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section> --}}
        <!--== Skills End ==-->

        <!--== Video Start ==-->
        <section class="parallax-bg fixed-bg" data-parallax-bg-image="{{ asset('') }}assets/images/bg.jpg"
            data-parallax-speed="0.8" data-parallax-direction="up">
            <div class="overlay-gradient-bg-2"></div>
            <div class="container">
                <div class="row">
                    <div class="col-md-10 col-md-offset-1 text-center parallax-content">
                        <div class="center-layout">
                            <div class="v-align-middle">
                                {{-- <a class="popup-youtube" href="https://www.youtube.com/embed/28XxWSitbIc">
                                    <div class="play-button">
                                        <i class="tr-icon ion-android-arrow-dropright"></i>
                                    </div>
                                </a> --}}
                                <iframe width="860" height="415" src="https://www.youtube.com/embed/28XxWSitbIc"
                                    title="Masterplan video player" frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                    allowfullscreen></iframe>
                                <h2 class="font-700 white-color">Apa Itu Masterplan?</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--== Video End ==-->

        <!--== Counter Start ==-->
        @include('home.counter')
        <!--== Counter End ==-->

        <!--== Portfolio Start ==-->
        @include('home.invest')
        <!--== Portfolio End ==-->

        <!--== Who We Are Start ==-->
        @include('home.benefit')
        <!--== Who We Are End ==-->

        {{-- @include('home.faq') --}}

        <!--== Footer Start ==-->
        <footer class="footer" id="footer-fixed">
            <div class="footer-copyright">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 col-xs-12">
                            <div class="copy-right text-left">© 2023 <span class="gradient-color">Masterplan</span> All
                                rights reserved</div>
                        </div>
                        <div class="col-md-6 col-xs-12">
                            <ul class="social-media">
                                <li><a href="#" class="icofont icofont-social-facebook"></a></li>
                                <li><a href="#" class="icofont icofont-social-twitter"></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!--== Footer End ==-->

        <!--== Go to Top  ==-->
        <a href="javascript:" id="return-to-top"><i class="icofont icofont-arrow-up"></i></a>
        <!--== Go to Top End ==-->

    </div>
    <!--== Wrapper End ==-->

    <!--== Javascript Plugins ==-->
    <script src="{{ asset('') }}assets/assets/js/jquery.min.js"></script>
    <script src="{{ asset('') }}assets/assets/js/smoothscroll.js"></script>
    <script src="{{ asset('') }}assets/assets/js/plugins.js"></script>
    <script src="{{ asset('') }}assets/assets/js/master.js"></script>

    <!-- Revolution js Files -->
    <script type="text/javascript" src="{{ asset('') }}assets/revolution/js/jquery.themepunch.tools.min.js"></script>
    <script type="text/javascript" src="{{ asset('') }}assets/revolution/js/jquery.themepunch.revolution.min.js">
    </script>
    <script type="text/javascript" src="{{ asset('') }}assets/revolution/js/revolution.extension.actions.min.js">
    </script>
    <script type="text/javascript" src="{{ asset('') }}assets/revolution/js/revolution.extension.carousel.min.js">
    </script>
    <script type="text/javascript" src="{{ asset('') }}assets/revolution/js/revolution.extension.kenburn.min.js">
    </script>
    <script type="text/javascript"
        src="{{ asset('') }}assets/revolution/js/revolution.extension.layeranimation.min.js"></script>
    <script type="text/javascript" src="{{ asset('') }}assets/revolution/js/revolution.extension.migration.min.js">
    </script>
    <script type="text/javascript" src="{{ asset('') }}assets/revolution/js/revolution.extension.navigation.min.js">
    </script>
    <script type="text/javascript" src="{{ asset('') }}assets/revolution/js/revolution.extension.parallax.min.js">
    </script>
    <script type="text/javascript" src="{{ asset('') }}assets/revolution/js/revolution.extension.slideanims.min.js">
    </script>
    <script type="text/javascript" src="{{ asset('') }}assets/revolution/js/revolution.extension.video.min.js">
    </script>
    <!--== Javascript Plugins End ==-->

</body>

</html>
