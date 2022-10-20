<!DOCTYPE html>
<!--[if IE 8]><html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]>
<!--><html class="no-js" lang="en"><!--<![endif]-->
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
	<link rel="stylesheet" href="{{ asset('assets/landing/css/bootstrap.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/landing/css/animsition.min.css') }}" />
	<link rel="stylesheet" href="{{ asset('assets/landing/css/unicons.css') }}"/>
	<link rel="stylesheet" href="{{ asset('assets/landing/css/lighbox.min.css') }}"/>
	<link rel="stylesheet" href="{{ asset('assets/landing/css/tooltip.min.css') }}"/>
	<link rel="stylesheet" href="{{ asset('assets/landing/css/swiper.min.css') }}"/>
	<link rel="stylesheet" href="{{ asset('assets/landing/css/style.css') }}"/>

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

									<div class="collapse navbar-collapse text-center text-xl-right" id="navbarSupportedContent">
										<ul class="navbar-nav ml-auto pt-4 pt-xl-0 mr-xl-4">
											<li class="nav-item">
												<a class="nav-link" href="#page-home" data-gal='m_PageScroll2id' data-ps2id-offset="70">Beranda</a>
											</li>
											<li class="nav-item">
												<a class="nav-link" href="#page-product" data-gal='m_PageScroll2id' data-ps2id-offset="70">Produk</a>
											</li>
											<li class="nav-item">
												<a class="nav-link" href="#page-about" data-gal='m_PageScroll2id' data-ps2id-offset="70">Tentang</a>
											</li>
											<li class="nav-item">
												<a class="nav-link" href="#page-faq" data-gal='m_PageScroll2id' data-ps2id-offset="70">FAQ</a>
											</li>
											<li class="nav-item">
												<a class="nav-link" href="#">Login | Register</a>
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

		<!-- Primary Page Layout
		================================================== -->

		<!-- Hero
		================================================== -->

		<div class="section over-hide full-height" id="page-home">
			<div class="section">
				<div class="swiper-wrapper">
					<div class="swiper-slide">
						<div class="section full-height over-hide one-page-hero-back-img-2 parallax-hero-1200" style="background-image: url('{{ asset('assets/landing/img/hero-img-1.jpg') }}');">
							<div class="hero-center-section text-center px-2">
								<h2 class="display-5 mb-4 color-light-2 text-center fade-hero" data-swiper-parallax-y="200" data-swiper-parallax-duration="600">
									Masterplan
								</h2>
								<p class="lead font-weight-600 mb-0 color-light-2 text-center fade-hero" data-swiper-parallax-y="150" data-swiper-parallax-duration="500">
									Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua
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
							<div class="col-sm-6 col-lg-3" data-scroll-reveal="enter bottom move 40px over 0.5s after 0.3s">
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
							<div class="col-sm-6 col-lg-3 mt-4 mt-sm-0" data-scroll-reveal="enter bottom move 40px over 0.5s after 0.3s">
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
							<div class="col-sm-6 col-lg-3 mt-4 mt-lg-0" data-scroll-reveal="enter bottom move 40px over 0.5s after 0.3s">
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
							<div class="col-sm-6 col-lg-3 mt-4 mt-lg-0" data-scroll-reveal="enter bottom move 40px over 0.5s after 0.3s">
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
                                                        <img src="{{ asset('assets/landing/img/icon-5.svg') }}" alt="">
                                                    </div>
                                                    <div class="col">
                                                        <h5 class="mb-3">
                                                            Quisque
                                                        </h5>
                                                        <p class="mb-0">
                                                            Sed ut perspiciatis unde omnis iste natus error sit voluptatem doloremque laudantium.
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="row mt-4">
                                                    <div class="col-auto">
                                                        <img src="{{ asset('assets/landing/img/icon-8.svg') }}" alt="">
                                                    </div>
                                                    <div class="col">
                                                        <h5 class="mb-3">
                                                            Rhoncus
                                                        </h5>
                                                        <p class="mb-0">
                                                            Sed ut perspiciatis unde omnis iste natus error sit voluptatem doloremque laudantium.
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="row">
                                                    <div class="col-auto">
                                                        <img src="{{ asset('assets/landing/img/icon-5.svg') }}" alt="">
                                                    </div>
                                                    <div class="col">
                                                        <h5 class="mb-3">
                                                            Gravida
                                                        </h5>
                                                        <p class="mb-0">
                                                            Sed ut perspiciatis unde omnis iste natus error sit voluptatem doloremque laudantium.
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="row mt-4">
                                                    <div class="col-auto">
                                                        <img src="{{ asset('assets/landing/img/icon-8.svg') }}" alt="">
                                                    </div>
                                                    <div class="col">
                                                        <h5 class="mb-3">
                                                            Aliquam
                                                        </h5>
                                                        <p class="mb-0">
                                                            Sed ut perspiciatis unde omnis iste natus error sit voluptatem doloremque laudantium.
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
                                            <div class="btn-accordion" role="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                Faq 1
                                            </div>
                                        </div>
                                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample" style="">
                                            <div class="card-body">
                                                <p class="mb-3">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et.</p>
                                                <p class="mb-0">Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header" id="headingTwo">
                                            <div class="btn-accordion collapsed" role="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                Faq 2
                                            </div>
                                        </div>
                                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                            <div class="card-body">
                                                <p class="mb-3">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et.</p>
                                                <p class="mb-0">Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header" id="headingThree">
                                            <div class="btn-accordion collapsed" role="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                Faq 3
                                            </div>
                                        </div>
                                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                                            <div class="card-body">
                                                <p class="mb-3">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et.</p>
                                                <p class="mb-0">Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.</p>
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

		<div class="section over-hide padding-top pb-4 bg-dark-blue section-background-8" id="footer">
			<div class="section-1400">
				<div class="container-fluid">
					<div class="row text-center text-md-left">
						<div class="col-md order-md-first">
							<p class="mb-0 size-14 color-gray-dark mt-1 font-weight-500">© {{ \Carbon\Carbon::now()->format('Y') }} Masterplan. All Rights Reserved.</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>




	<!-- JAVASCRIPT
    ================================================== -->
	<script src="{{ asset('assets/landing/js/jquery.min.js') }}"></script>
	<script src="{{ asset('assets/landing/js/popper.min.js') }}"></script>
	<script src="{{ asset('assets/landing/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('assets/landing/js/plugins.js') }}"></script>
	<script src="{{ asset('assets/landing/js/custom.js') }}"></script>
<!-- End Document
================================================== -->
</body>
</html>
