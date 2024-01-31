@extends('v3.index')
@section('content')
    @include('v3.navbar')
    <!-- Header section -->
    <!-- Payloan_header_bg section -->
    @include('v3.hero')
    <!-- Payloan_header_bg section -->
    <!-- Common section -->
    @include('v3.produk')
    <!-- Common section -->

    <!-- Common section -->
    <section class="commonSection applicatioProces">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="sec_title">Proses Yang Cepat dan<br> Sangat Mudah</h2>
                    {{-- <p class="sec_desc">Kami membantu anda <br> </p> --}}
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="singleProcess_2 mr_40">
                        <div class="flipper">
                            <div class="front">
                                <div class="bg_number">
                                    <h1>01</h1>
                                </div>
                                <h4>Belanja <br> Rp 700.000</h4>
                                {{-- <p>We are provide best services and finaancial solution for you.</p> --}}
                            </div>
                            <div class="back">
                                <div class="bg_number">
                                    <h1>01</h1>
                                </div>
                                {{-- <h4>Apply Bank Loan</h4> --}}
                                <h4>Belanja <br> Rp 700.000</h4>
                                {{-- <p>We are provide best services and finaancial solution for you.</p> --}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="singleProcess_2 mlr_40">
                        <div class="flipper">
                            <div class="front">
                                <div class="bg_number">
                                    <h1>02</h1>
                                </div>
                                {{-- <h4>Approved Bank Loan</h4> --}}
                                <h4>Bayar <br> Rp 500.000</h4>
                                {{-- <p>We are provide best services and finaancial solution for you.</p> --}}
                            </div>
                            <div class="back">
                                <div class="bg_number">
                                    <h1>02</h1>
                                </div>
                                <h4>Bayar <br> Rp 500.000</h4>

                                {{-- <h4>Approved Bank Loan</h4> --}}
                                {{-- <p>We are provide best services and finaancial solution for you.</p> --}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="singleProcess_2 ml_40">
                        <div class="flipper">
                            <div class="front">
                                <div class="bg_number">
                                    <h1>03</h1>
                                </div>
                                <h4>Kamu Dapat <br> 2 Produk</h4>
                                {{-- <p>We are provide best services and finaancial solution for you.</p> --}}
                            </div>
                            <div class="back">
                                <div class="bg_number">
                                    <h1>03</h1>
                                </div>
                                <h4>Kamu Dapat <br> 2 Produk</h4>
                                {{-- <p>We are provide best services and finaancial solution for you.</p> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Common section -->

    <!-- Common section -->
    {{-- <section class="commonSection applyAmoutSec">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="sec_title">Get your amount<br> for fillup this form</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="applyamountFrom">
                        <form action="#" method="post">
                            <input type="number" step="any" name="amount" placeholder="Amount">
                            <input type="number" step="any" name="amount" placeholder="Long of months?">
                            <input type="number" step="any" name="amount" placeholder="Installment amount.">
                            <button class="common_btn" type="submit">Subscribe Now</button>
                        </form>
                    </div>
                </div>
                <div class="col-lg-7">
                </div>
            </div>
        </div>
    </section> --}}
    <!-- Common section -->
    <!-- Common section -->
    @if ($user >= 1)
        @include('v3.sycle')
    @endif
    <!-- Common section -->

    <!-- Common section -->
    {{-- <section class="commonSection custome_sec_2">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="sec_title">How to say our most<br> honorable customer</h2>
                    <p class="sec_desc">We are here to help you when you need your financial<br> support, then we are
                        help you.</p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="customer_area">
                        <div class="singleCustomer">
                            <img src="images/about/5.png" alt="" />
                            <div class="quote_img"><img src="images/quote.png" alt="" /></div>
                            <p>
                                From time time we need generate
                                sample names to populate a test
                                database usually just requiring first
                                and last names address.
                            </p>
                            <h5>Austin Matthews</h5>
                            <div class="cus_signature">
                                <img src="images/signature.png" alt="" />
                            </div>
                        </div>
                        <div class="singleCustomer">
                            <img src="images/about/5.png" alt="" />
                            <div class="quote_img"><img src="images/quote.png" alt="" /></div>
                            <p>
                                From time time we need generate
                                sample names to populate a test
                                database usually just requiring first
                                and last names address.
                            </p>
                            <h5>Evelyn Goodman</h5>
                            <div class="cus_signature">
                                <img src="images/signature.png" alt="" />
                            </div>
                        </div>
                        <div class="singleCustomer">
                            <img src="images/about/5.png" alt="" />
                            <div class="quote_img"><img src="images/quote.png" alt="" /></div>
                            <p>
                                From time time we need generate
                                sample names to populate a test
                                database usually just requiring first
                                and last names address.
                            </p>
                            <h5>Calvin Cannon</h5>
                            <div class="cus_signature">
                                <img src="images/signature.png" alt="" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="customer_thumb">
                        <img src="images/about/3.png" alt="" />
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
    <!-- Common section -->

    <!-- footer section -->
    @include('v3.contact')
    <!-- footer section -->
    <!-- Copyright section -->
    <section class="copyright">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <p>Copyright <a href="#home">Masterplan&copy;</a>. All rights reserved</p>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="#" id="backTo"><i class="flaticon-chevron"></i></a>
                </div>
            </div>
        </div>
    </section>
    <!-- Copyright section -->
@endsection
