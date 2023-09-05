@extends($activeTemplate . 'user.layouts.app')
@include($activeTemplate . 'user.dashboard.styleDashboard')

@push('style')
    <style>
        .imgProfit {
            width: 19ch;
            margin-top: 165px;
        }
    </style>
@endpush

@push('script')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('myChart');
        $.ajax({
            url: "{{ url('gold-today') }}",
            success: function(result) {
                new Chart(ctx, {
                    type: 'line',
                    data: {
                        // labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                        datasets: [{
                            label: 'Price',
                            data: result,
                            borderWidth: 1,
                            borderColor: "#fdbe01",
                            borderDash: [5, 5],
                            backgroundColor: "#FFD700",
                            pointBackgroundColor: "#d68315",
                            pointBorderColor: "#d68315",
                            pointHoverBackgroundColor: "#d68315",
                            pointHoverBorderColor: "#d68315",
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                max: 1000000,
                                min: 900000
                            }
                        }
                    }
                });
            }
        });
        $(".animated-progress span").each(function() {
            $(this).animate({
                    width: $(this).attr("data-progress") + "%",
                },
                1000
            );
            $(this).text($(this).attr("data-progress") + "%");
        });
        $('#recipeCarousel').carousel({
            interval: 10000
        })

        $('.carousel .carousel-item').each(function() {
            var minPerSlide = 3;
            var next = $(this).next();
            if (!next.length) {
                next = $(this).siblings(':first');
            }
            next.children(':first-child').clone().appendTo($(this));

            for (var i = 0; i < minPerSlide; i++) {
                next = next.next();
                if (!next.length) {
                    next = $(this).siblings(':first');
                }

                next.children(':first-child').clone().appendTo($(this));
            }
        });
    </script>
@endpush
@if (auth()->user()->gold_no == null)
    @push('script')
        <script>
            $('#staticBackdrop').modal('show');
        </script>
    @endpush
@endif
@section('panel')

    @include($activeTemplate . 'user.dashboard.modalInfo')


    @include($activeTemplate . 'user.dashboard.dailyGold')

    <div class="row">
        @if (Auth::user()->is_kyc == 0)
            {{-- <div class="col-lg-8 col-md-8 col-12 mb-30">
                <div class="card card-header-actions">
                    <div class="card-header" style="font-weight: 600;">
                        Account Verification
                    </div>
                    <div class="card-body text-center">
                        <div class="progressbar">
                            <div class="progress" id="progress"></div>
                            <div class="progress-step progress-step-active" data-title="Unverified"></div>
                            <div class="progress-step" data-title="Verification"></div>
                            <div class="progress-step" data-title="Status"></div>
                        </div>
                        <p>It is recommended to verify to be able to unlock all features.</p>
                        <a href="{{ route('user.verification') }}" class="btn btn-sm btn-danger">Verify Now</a>
                    </div>
                </div>
            </div> --}}
        @elseif(Auth::user()->is_kyc == 1)
            {{-- <div class="col-lg-8 col-md-8 col-12 mb-30">
                <div class="card card-header-actions">
                    <div class="card-header" style="font-weight: 600;">
                        Account Verification
                    </div>
                    <div class="card-body text-center">
                        <div class="progressbar">
                            <div class="progress" id="progress"></div>
                            <div class="progress-step progress-step-active" data-title="Unverified"></div>
                            <div class="progress-step progress-step-active" data-title="Verification"></div>
                            <div class="progress-step" data-title="Status"></div>
                        </div>
                        <p>Your data is in the verification process.</p>
                    </div>
                </div>
            </div> --}}
        @elseif(Auth::user()->is_kyc == 2)
            {{-- <div class="col-lg-8 col-md-8 col-12 mb-30">
                <div class="card card-header-actions">
                    <div class="card-header" style="font-weight: 600;">
                        Account Verification
                    </div>
                    <div class="card-body text-center">
                        <div class="progressbar">
                            <div class="progress" id="progress"></div>
                            <div class="progress-step progress-step-active" data-title="Unverified"></div>
                            <div class="progress-step progress-step-active" data-title="Verification"></div>
                            <div class="progress-step progress-step-active bg-success" data-title="Verified"></div>
                        </div>
                        <p>Your data has been successfully verified.</p>
                    </div>
                </div>
            </div> --}}
        @elseif(Auth::user()->is_kyc == 3)
            <div class="col-lg-8 col-md-8 col-12 mb-30">
                <div class="card card-header-actions">
                    <div class="card-header" style="font-weight: 600;">
                        Account Verification
                    </div>
                    <div class="card-body text-center">
                        <div class="progressbar">
                            <div class="progress" id="progress"></div>
                            <div class="progress-step progress-step-active" data-title="Unverified"></div>
                            <div class="progress-step progress-step-active" data-title="Verification"></div>
                            <div class="progress-step progress-step-active bg-danger" data-title="Rejected"></div>
                        </div>
                        <p>Your data failed to verify, please resend your data.</p>
                        <a href="{{ route('user.verification') }}" class="btn btn-sm btn-danger">Resend Data</a>
                    </div>
                </div>
            </div>
        @endif

        <div class="col-lg-8 col-md-8 col-12 mb-30">

            @if ($persen_bonus > 49)
                <div class="card-footer text-center mb-3">
                    <b>Akumulasi Komisi</b>
                    <p>Ketika Sudah Mencapai Rp. 10,000,000 Anda Wajib Melakukan Repeat Order Ke
                        Produk Masterplan Lainnya. Saat ini Rp. {{ nb(countAllBonus()) }} ({{ $persen_bonus }}% dari target)
                    </p>
                    <div class="d-flex justify-content-center">
                        <div class="animated-progress progress-blue">
                            <span data-progress="{{ $persen_bonus }}"></span>
                        </div>
                    </div>
                    @if ($persen_bonus >= 100)
                        <a href="{{ url('user/plan') }}" class="btn btn--success btn-sm">
                            <i class="las la-archive"></i>
                            Repeat Order</a>
                    @endif
                </div>
            @endif

            @include($activeTemplate . 'user.dashboard.bonusReward')


        </div>


        @if (Auth::user()->plan_id != 0)
            <div class="col-lg-4 col-md-4 col-12 mb-30">
                @if ($title)
                    <div class="mb-3 d-flex justify-content-center shing">
                        <div class="card b-radius--10 cardImages {{ $title }}">
                            <div class="card-body text-center cardTitle"
                                style="display: table; min-height: 15rem; overflow: hidden;">
                                <div style="display: table-cell; vertical-align: middle;">
                                    {{-- <h5 class="text-warning">Profit Sharing</h5> --}}
                                    @if (auth()->user()->sharing_profit)
                                        <img src="{{ asset('assets/2.png') }}" class="imgProfit" alt="sharing">
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                @if (auth()->user()->new_ps && oncreate() < 90)
                    <div class="card card-header-actions mb-3">
                        <div class="card-body">
                            <strong>Hi {{ auth()->user()->username }}.</strong>
                            <br> Selamat, kamu terpilih untuk ikut mendapatkan deviden profit sahring dari masterplan nih.
                            <br> Caranya cukup mudah, dalam 30 hari akun anda dibuat, kamu harus mendapatkan pertumbuhan
                            sebanyak 103 kanan : 103 kiri. (sudah {{ umurakun() }} hari berjalan) <br>
                            <strong>(Saat ini kamu {{ auth()->user()->userExtra->left }} :
                                {{ auth()->user()->userExtra->right }} )</strong>

                        </div>
                        <div>
                            <span class="ml-5">Sudah {{ oncreate() }}% sampai akun anda berumur 30 hari</span>
                            <div class="d-flex justify-content-center">
                                <div class="animated-progress progress-blue">
                                    <span data-progress="{{ oncreate() }}"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                @include($activeTemplate . 'user.dashboard.gems')
                @include($activeTemplate . 'user.dashboard.tarikEmas')

                <div class="card card-header-actions mt-3">
                    <div class="card-header" style="font-weight: 600;">
                        MP Number
                    </div>
                    <div class="card-body text-center bg--gradi-9 border-3">
                        <h2 style="font-weight: 700;color: black;">{{ Auth::user()->no_bro }}</h2>
                    </div>
                </div>
                <div class="card card-header-actions mt-3">
                    <div class="card-header bg-grand-gold d-flex justify-content-center" style="font-weight: 600;">
                        Gold Rates
                    </div>
                    <div class="card-body text-center border-3">
                        <div class="price-today text-secondary">
                            Today Buy : Rp {{ nb($goldToday->per_gram) }}<br>
                            Today Sell: Rp {{ nb($goldBonus) }}
                            <span class=" {{ $goldToday->percent > 0 ? 'text-success' : 'text-danger' }} ">
                                (<i class="fa {{ $goldToday->percent > 0 ? 'fa-arrow-up ' : 'fa-arrow-down' }}"
                                    aria-hidden="true" style="font-size: px"></i> {{ $goldToday->percent }}%)
                            </span>


                        </div>
                        <canvas id="myChart" style="width:100%;max-width:700px"></canvas>
                    </div>
                </div>
            </div>
        @endif
    </div>


    @include($activeTemplate . 'user.dashboard.cardInfo')

@endsection
