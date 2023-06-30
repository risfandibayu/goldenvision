@extends($activeTemplate . 'user.layouts.app')

@push('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css">
    <link rel="stylesheet" href="{{ asset('') }}">
    <style>
        :root {
            --primary-color: rgb(11, 78, 179)
        }

        .bg-grand-gold {
            background: linear-gradient(90deg, rgba(194, 102, 31, 1) 14%, rgba(255, 192, 0, 1) 100%);
        }

        .txt-grand-gold {
            background: -webkit-linear-gradient(rgba(194, 102, 31, 1) 14%, rgba(255, 192, 0, 1) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        label {
            display: block;
            margin-bottom: 0.5rem
        }

        input {
            display: block;
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ccc;
            border-radius: 0.25rem;
            height: 50px
        }

        .width-50 {
            width: 50%
        }

        .ml-auto {
            margin-left: auto
        }

        .text-center {
            text-align: center
        }

        .progressbar {
            position: relative;
            display: flex;
            justify-content: space-between;
            counter-reset: step;
            margin: 2rem 2rem 4rem
        }

        .progressbar::before,
        .progress {
            content: "";
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            height: 4px;
            width: 100%;
            background-color: #dcdcdc;
            z-index: 1
        }

        .progress {
            background-color: rgb(0 128 0);
            width: 0%;
            transition: 0.3s
        }

        .progress-step {
            width: 2.1875rem;
            height: 2.1875rem;
            background-color: #dcdcdc;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1
        }

        .progress-step::before {
            counter-increment: step;
            content: counter(step)
                /* font-family: FontAwesome; */
                /* content: "\f023"; */

        }

        .progress-step::after {
            content: attr(data-title);
            position: absolute;
            top: calc(100% + 0.5rem);
            font-size: 0.85rem;
            color: #666;
            width: 80px;
        }

        .progress-step-active {
            background-color: var(--primary-color);
            color: #f3f3f3
        }

        .form {
            width: clamp(320px, 30%, 430px);
            margin: 0 auto;
            border: none;
            border-radius: 10px !important;
            overflow: hidden;
            padding: 1.5rem;
            background-color: #fff;
            padding: 20px 30px
        }

        .step-forms {
            display: none;
            transform-origin: top;
            animation: animate 1s
        }

        .step-forms-active {
            display: block
        }

        .group-inputs {
            margin: 1rem 0
        }

        .animated-progress {
            width: 600px;
            height: 30px;
            border-radius: 5px;
            margin: 20px 10px;
            border: 1px solid rgb(8, 37, 201);
            overflow: hidden;
            position: relative;
        }

        .animated-progress span {
            height: 100%;
            display: block;
            width: 0;
            color: rgb(255, 251, 251);
            line-height: 30px;
            position: absolute;
            text-align: end;
            padding-right: 5px;
        }

        .progress-blue span {
            background-color: blue;
        }

        .progress-green span {
            background-color: green;
        }

        .progress-purple span {
            background-color: indigo;
        }

        .progress-red span {
            background-color: red;
        }

        @keyframes animate {
            from {
                transform: scale(1, 0);
                opacity: 0
            }

            to {
                transform: scale(1, 1);
                opacity: 1
            }
        }

        .btns-group {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1.5rem
        }

        .btn {
            padding: 0.75rem;
            display: block;
            text-decoration: none;
            background-color: var(--primary-color);
            color: #f3f3f3;
            text-align: center;
            border-radius: 0.25rem;
            cursor: pointer;
            transition: 0.3s
        }

        .btn:hover {
            box-shadow: 0 0 0 2px #fff, 0 0 0 3px var(--primary-color)
        }

        .progress-step-check {
            position: relative;
            background-color: green !important;
            transition: all 0.8s
        }

        .progress-step-check::before {
            position: absolute;
            content: '\2713';
            width: 100%;
            height: 100%;
            top: 8px;
            left: 13px;
            font-size: 12px
        }

        .group-inputs {
            position: relative
        }

        .group-inputs label {
            font-size: 13px;
            position: absolute;
            height: 19px;
            padding: 4px 7px;
            top: -14px;
            left: 10px;
            color: #a2a2a2;
            background-color: white
        }

        .welcome {
            height: 450px;
            width: 350px;
            background-color: #fff;
            border-radius: 6px;
            display: flex;
            justify-content: center;
            align-items: center
        }

        .welcome .content {
            display: flex;
            align-items: center;
            flex-direction: column
        }

        .checkmark__circle {
            stroke-dasharray: 166;
            stroke-dashoffset: 166;
            stroke-width: 2;
            stroke-miterlimit: 10;
            stroke: #7ac142;
            fill: none;
            animation: stroke 0.6s cubic-bezier(0.65, 0, 0.45, 1) forwards
        }

        .checkmark {
            width: 56px;
            height: 56px;
            border-radius: 50%;
            display: block;
            stroke-width: 2;
            stroke: #fff;
            stroke-miterlimit: 10;
            margin: 10% auto;
            box-shadow: inset 0px 0px 0px #7ac142;
            animation: fill .4s ease-in-out .4s forwards, scale .3s ease-in-out .9s both
        }

        .checkmark__check {
            transform-origin: 50% 50%;
            stroke-dasharray: 48;
            stroke-dashoffset: 48;
            animation: stroke 0.3s cubic-bezier(0.65, 0, 0.45, 1) 0.8s forwards
        }

        .cards-wrapper {
            display: flex;
        }

        .cardSlide {
            margin: 0 0.5em;
            width: calc(100%/3);
        }

        /* userInfo */

        .profile {
            width: 330px;
            height: 100px;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            border-radius: 5px;
            background-color: #fafafa;
            box-shadow: 0 0 2rem #babbbc;
            animation: show-profile 0.5s forwards ease-in-out;
        }

        /* @keyframes show-profile {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                0% {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    width: 0;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                }
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            } */

        .profile .photo {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            overflow: hidden;
            border: 5px solid #fafafa;
            margin-left: -50px;
            box-shadow: 0 0 0.5rem #babbbc;
            animation: rotate-photo 0.5s forwards ease-in-out;
        }

        /* @keyframes rotate-photo {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    0% {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        transform: rotate(0deg);
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    }

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    100% {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        transform: rotate(-360deg);
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    }
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                } */

        .profile .photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .profile .content {
            padding: 10px;
            overflow: hidden;
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
        }

        .profile .content .text {
            margin-top: 20px;
            margin-left: 50px;
        }

        .profile .content .text h3,
        .profile .content .text h6 {
            font-weight: normal;
            margin: 3px 0;
            letter-spacing: 0.5px;
            white-space: nowrap;
        }

        .profile .content .btn {
            background-color: #70a1ff;
            width: 50px;
            height: 50px;
            position: absolute;
            right: 25px;
            top: 25px;
            border-radius: 50%;
            z-index: 1;
            cursor: pointer;
            transition-duration: 0.3s;
            animation: pop-btn 0.3s both ease-in-out 0.5s;
        }

        .shing {
            &::before {
                animation: shine #{$anim-duration}s ease-in-out infinite;
            }
        }

        @media (max-width: 768px) {
            .carousel-inner .carousel-item>div {
                display: none;
            }

            .carousel-inner .carousel-item>div:first-child {
                display: block;
            }
        }

        .carousel-inner .carousel-item.active,
        .carousel-inner .carousel-item-next,
        .carousel-inner .carousel-item-prev {
            display: flex;
        }

        .imgUser {
            height: 10rem;
            width: 10rem;
            background-color: #fff;
        }

        .cardImages {
            height: 15rem;
            width: 16rem;
            background-color: #141214;
        }

        .cardImages.masterGold {
            background-image: url("{{ asset('assets/assets/badges/title-mg.jpeg') }}");
            background-repeat: no-repeat;
            background-size: 100% 100%;
        }

        .cardImages.grandMaster {
            background-image: url("{{ asset('assets/assets/badges/title-gmg.jpeg') }}");
            background-repeat: no-repeat;
            background-size: 100% 100%;
        }

        /* display 3 */
        @media (min-width: 768px) {

            .carousel-inner .carousel-item-right.active,
            .carousel-inner .carousel-item-next {
                transform: translateX(33.333%);
            }

            .carousel-inner .carousel-item-left.active,
            .carousel-inner .carousel-item-prev {
                transform: translateX(-33.333%);
            }
        }

        .carousel-inner .carousel-item-right,
        .carousel-inner .carousel-item-left {
            transform: translateX(0);
        }

        .card-gold-view {
            height: 250px;
            width: 360px;
            background-color: #141214;
        }

        .cardImage {
            background-image: url("{{ asset('assets/card.png') }}");
            background-repeat: no-repeat;
            background-size: 100% 100%;
        }

        .card-gold-view .text-view {
            color: white;
            margin-top: 35%;
            justify-content: center;
            padding: 10px;
            font-size: 20px;
        }

        @keyframes shine {
            0% {
                left: -100%;
                transition-property: left;
            }

            #{($anim-speed / ($anim-duration + $anim-speed) * 100%)},
            100% {
                left: 100%;
                transition-property: left;
            }
        }


        @keyframes stroke {
            100% {
                stroke-dashoffset: 0
            }
        }

        @keyframes scale {

            0%,
            0% {
                transform: none
            }

            50% {
                transform: scale3d(1.1, 1.1, 1)
            }
        }

        @keyframes fill {
            100% {
                box-shadow: inset 0px 0px 0px 30px #7ac142
            }
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
    @if (auth()->user()->gold_no == null)
        <!-- Modal -->

        <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content row" style="background-color: #606060">
                    <form action="{{ route('user.serialnum') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <img src="{{ asset('assets/card-gold.jpeg') }}" alt="">
                                </div>
                                <div class="col-md-8 ">
                                    <h3 class="text-center text-light mt-3">MASTERPLAN CARD</h3>
                                    <hr>
                                    <h5 class="text-light">Karena semakin banyaknya user baru di sistem Masterplan, untuk
                                        mentrack masterplan card yang sudah beredar, harap cek masterplan card anda dan
                                        masukan
                                        serial number yang tertera agar dapat kami tracking.
                                    </h5>

                                    <input type="text" name="serial" id=""
                                        class="form-control form-control-lg mt-4" placeholder="SN0000">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">

                            <button type="button" class="btn" style="background-color:darkgoldenrod"
                                data-dismiss="modal">Lewatkan
                                Sekarang</button>
                            <button type="submit" class="btn text-center" style="background-color: dodgerblue">Simpan
                                Serial
                                Number</button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif



    <div class="row mb-4">
        <div class="col-lg-12">
            @if ($checkDaily_days < 100 && auth()->user()->userExtra->d_gold != 1)
                @if (\App\Models\User::canClaimDailyGold(Auth::id()))
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Check-In To Get Bonus Gold</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('user.daily-checkin') }}" method="post">
                                        @csrf
                                        <p class="text-center h5">Click the button below to get your daily gold.</p>
                                        <div class="row mt-4">
                                            <div class="col-12 text-sm-center">
                                                <button type="submit" class="btn btn-warning btn-block">Check-In <i
                                                        class="me-2 fas fa-arrow-right"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="alert alert-warning alert-dismissible fade show p-3" role="alert">
                        <strong>Hey {{ Auth::user()->fullname }}!</strong> &nbsp; Check-In and get your 0.005 Gram gold
                        right
                        now.
                        &nbsp; <a href="#" class="alert-link" data-toggle="modal" data-target="#exampleModal">CHECK
                            IN</a>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
            @else
                @if ($checkDaily_days >= 100)
                    {{-- @dd(chekWeeklyClaim()) --}}
                    @if (chekWeeklyClaim(auth()->user()->id))
                        <div class="alert alert-success alert-dismissible fade show p-3 text-center" role="alert"
                            data-toggle="modal" data-target="#modalWeek">
                            <strong>Hey {{ Auth::user()->fullname }}! &emsp;</strong> <br>
                            <div>
                                Kamu Sudah Check-In Emas Selama 100 Hari Nih Sekarang Kamu Bisa Claim Weekly Gold. <strong>
                                    Claim
                                    Gold
                                    Mingguan Kamu Disini</strong>
                                &nbsp;
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                    @endif
                    <div class="modal fade" id="modalWeek" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Check-In To Get Bonus Gold</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('user.weekly-checkin') }}" method="post">
                                        @csrf
                                        <p class="text-center h5">Click the button below to get your Weekly Gold.</p>
                                        <div class="row mt-4">
                                            <div class="col-12 text-sm-center">
                                                <button type="submit" class="btn btn-warning btn-block">Check-In <i
                                                        class="me-2 fas fa-arrow-right"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                @if (!auth()->user()->wd_gold && auth()->user()->userExtra->is_gold)
                    <div class="modal fade" id="modalWd" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Withdraw Bonus Gold</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="{{ route('user.withdraw.gold') }}">
                                        @csrf
                                        <div class="container col-md-8">
                                            <h6>Total Emas: {{ $checkDaily->gold ?? '' }}</h6>
                                            <h6>Harga Emas /Gram: Rp {{ $goldBonus }}</h6>
                                            <h6>Platform Fee: 5%</h6>

                                            <h6>-----------------------------------------------</h6>
                                            <h6>Harga Total: Rp {{ nb($goldBonus * $checkDaily_gold) }}</h6>
                                            <h6>Platform Fee: Rp {{ nb(($goldBonus * $checkDaily_gold * 5) / 100) }}</h6>
                                            <strong>Total:
                                                {{ nb($goldBonus * $checkDaily_gold - ($goldBonus * $checkDaily_gold * 5) / 100) }}</strong>

                                        </div>
                                        <div class="row mt-4">
                                            <div class="col-12 text-sm-center">
                                                <input type="hidden" name="total"
                                                    value="{{ $goldBonus * $checkDaily_gold - ($goldBonus * $checkDaily_gold * 5) / 100 }}">
                                                <button type="submit" class="btn btn-warning btn-block">Transfer to
                                                    Balance
                                                    Rp
                                                    {{ nb($goldBonus * $checkDaily_gold - ($goldBonus * $checkDaily_gold * 5) / 100) }}
                                                    <i class="me-2 fas fa-arrow-right"></i></button>
                                            </div>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="alert alert-success alert-dismissible fade show p-3 text-center" role="alert"
                        data-toggle="modal" data-target="#modalWd">
                        <strong>Hey {{ Auth::user()->fullname }}! &emsp;</strong> <br>
                        <div>Kamu Sudah Check-In Emas Selama
                            {{ $checkDaily_days ?? '' }} Hari Nih Sebanyak {{ nbk($checkDaily_gold) ?? '' }} Gram,
                            Sekarang emas itu bisa di withdraw loh. <br> >>Click Disini<< <button type="button"
                                class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                        </div>
                    </div>
                @endif

                @if (!auth()->user()->address_check)
                    <a href="{{ url('user/profile-setting') }}">
                        <div class="alert alert-warning alert-dismissible fade show p-3 h6" role="alert">
                            Perhatian,
                            terdapat perubahan kebijakan perusahaan terkait data alamat
                            pelanggan. <br>
                            Segera perbaharui alamat pada akun anda demi menghindari kesalahan
                            pengiriman dan pendataan. <br>
                            Terima kasih~.
                            <br>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </a>
                @endif

                {{-- @if (\App\Models\User::canClaimWeeklyGold(Auth::id()))
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Check-In To Get Bonus Gold</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('user.weekly-checkin') }}" method="post">
                                    @csrf
                                    <p class="text-center h5">Click the button below to get your weekly gold.</p>
                                    <div class="row mt-4">
                                        <div class="col-12 text-sm-center">
                                            <button type="submit" class="btn btn-warning btn-block">Check-In <i
                                                    class="me-2 fas fa-arrow-right"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="alert alert-warning alert-dismissible fade show p-3" role="alert">
                    <strong>Hey {{ Auth::user()->fullname }}!</strong> &nbsp; Check-In and get your 0.005gr gold right now.
                    &nbsp; <a href="#" class="alert-link" data-toggle="modal" data-target="#exampleModal">CHECK
                        IN</a>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif --}}
            @endif
        </div>
    </div>
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
            <div class="card card-header-actions">
                {{-- <div class="card-header text-center" style="font-weight: 600;">
                        Account Verification
                        <p>Your data has been successfully verified <i class="fa fa-check-circle text-success"></i></p>
                    </div> --}}
                {{-- <div class="card-footer text-center">
                        <b>Akumulasi Komisi</b>
                        <p>Ketika Sudah Mencapai Rp. 10,000,000 Anda Wajib Melakukan Repeat Order Ke
                            Produk Masterplan Lainnya (saat ini {{ $persen_bonus }}% dari target)</p>
                        <div class="d-flex justify-content-center">
                            <div class="animated-progress progress-blue">
                                <span data-progress="{{ $persen_bonus }}"></span>
                            </div>
                        </div>
                        @if ($persen_bonus >= 70)
                            <a href="{{ route('user.product.index') }}" class="btn btn--success btn-sm">
                                <i class="las la-archive"></i>
                                Repeat Order</a>
                        @endif
                    </div>
                </div> --}}

                <div class="container text-center my-3">
                    <div class="row mx-auto my-auto">
                        <div id="recipeCarousel1" class="carousel slide w-100" data-ride="carousel">
                            <div class="carousel-inner w-100" role="listbox">
                                @foreach ($promo as $i => $item)
                                    <div class="carousel-item @if ($item->id == 3) active @endif">
                                        <div class="col-md-12">
                                            <div class="bonus">
                                                <div class="card-body bg--gradi-8 h5 ">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <img class="card-img-top"
                                                                src="{{ getImage('assets/images/reward/' . $item->images, null, true) }}"
                                                                alt="Bonus reward {{ $item->reward }}"
                                                                style="height: 200px;width: 400px">
                                                        </div>
                                                        <div class="col-md-8">
                                                            <b class="text-center"> Bonus Sepesial
                                                                {{ $item->id == 3 ? ' Bulan Ini' : ' Sampai Bulan Juni' }}</b>
                                                            <br><br>
                                                            <h4 class="text-justify text-light">
                                                                Untuk mitra usaha yang telah memenuhi
                                                                kualifikasi
                                                                penjualan
                                                                produk {{ $item['kiri'] }} kiri dan {{ $item['kanan'] }}
                                                                kanan,
                                                                akan
                                                                mendapatkan
                                                                kesempatan reward {{ $item['reward'] }}
                                                                {{ $item['equal'] != 0 ? 'atau uang unai senilai Rp ' . nb($item['equal']) : '' }}
                                                                segera tingkatkan
                                                                penjualan anda dan raih kesuksesan bersama!!
                                                            </h4>
                                                            <br>
                                                            <b class="mt-5 text-center"> Total penjualan kamu saat ini
                                                                {{ $p_kiri - 3 <= 0 ? 0 : $p_kiri - 3 }} :
                                                                {{ $p_kanan - 3 <= 0 ? 0 : $p_kanan - 3 }}</b>
                                                        </div>
                                                    </div>
                                                </div>
                                                @if (auth()->user()->userExtra->is_gold)
                                                    @if (cekReward($item->id) == true)
                                                        <div class="card-footer">
                                                            <div class="input-group">
                                                                <button class="btn btn-primary btn-block" disabled>Already
                                                                    Claim
                                                                    Bonus</button>

                                                            </div>
                                                        </div>
                                                    @else
                                                        <div class="card-footer">
                                                            <form action="{{ route('user.claim-reward') }}"
                                                                method="POST">
                                                                @csrf
                                                                <input type="hidden" name="type"
                                                                    value="{{ $item['id'] }}">
                                                                <div class="input-group">
                                                                    @if ($item['equal'] == 0)
                                                                        <button class="btn btn-primary btn-block">Claim
                                                                            Bonus</button>
                                                                    @else
                                                                        <input type="submit"
                                                                            class="form-control bg-primary form-control-lg"
                                                                            name="claim" value="{{ $item['reward'] }}">
                                                                        <input type="submit"
                                                                            class="form-control bg-primary form-control-lg"
                                                                            aria-label="Large" name="claim"
                                                                            value="{{ $item['equal'] }}">
                                                                    @endif

                                                                </div>
                                                            </form>
                                                        </div>
                                                    @endif
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                {{-- @dd(auth()->user()->userExtra->p_right) --}}
                                @foreach ($reward as $i => $item)
                                    @if (auth()->user()->userExtra->left >= $item->kiri && auth()->user()->userExtra->right >= $item->kanan)
                                        <div class="carousel-item ">
                                            <div class="col-md-12">
                                                <div class="bonus">
                                                    <div class="card-body bg--gradi-10 h5 ">

                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <img class="card-img-top"
                                                                    src="{{ getImage('assets/images/reward/' . $item->images, null, true) }}"
                                                                    alt="Bonus reward {{ $item->reward }}"
                                                                    style="height: 200px;width: 400px">
                                                            </div>
                                                            <div class="col-md-8 text-center">
                                                                <b> Bonus Sepesial
                                                                    {{ $item->reward }}</b>
                                                                <br><br>
                                                                <h4 class="text-justify text-light">
                                                                    Untuk mitra usaha yang telah memenuhi
                                                                    kualifikasi
                                                                    penjualan
                                                                    produk {{ $item['kiri'] }} kiri dan
                                                                    {{ $item['kanan'] }}
                                                                    kanan,
                                                                    akan
                                                                    mendapatkan
                                                                    kesempatan reward {{ $item['reward'] }}
                                                                    {{ $item['equal'] != 0 ? 'atau uang unai senilai Rp ' . nb($item['equal']) : '' }}
                                                                    segera tingkatkan
                                                                    penjualan anda dan raih kesuksesan bersama!!
                                                                </h4>
                                                                <br>
                                                                <b class="mt-5 text-center"> Total penjualan kamu saat ini
                                                                    {{ $p_kiri }} :
                                                                    {{ $p_kanan }}</b>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    @if (auth()->user()->userExtra->is_gold)
                                                        @if (cekReward($item->id) == true)
                                                            <button class="btn btn-primary btn-block" disabled>Alredy Claim
                                                                Reward</button>
                                                        @else
                                                            <div class="card-footer">
                                                                <form action="{{ route('user.claim-reward') }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    <input type="hidden" name="type"
                                                                        value="{{ $item['id'] }}">
                                                                    <div class="input-group">
                                                                        @if ($item['equal'] == 0)
                                                                            <button class="btn btn-primary btn-block">Claim
                                                                                Reward</button>
                                                                        @else
                                                                            <input type="submit"
                                                                                class="form-control bg-primary form-control-lg"
                                                                                name="claim"
                                                                                value="{{ $item['reward'] }}">
                                                                            <input type="submit"
                                                                                class="form-control bg-primary form-control-lg"
                                                                                aria-label="Large" name="claim"
                                                                                value="{{ $item['equal'] }}">
                                                                        @endif

                                                                    </div>
                                                                </form>
                                                            </div>
                                                        @endif
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            <a class="carousel-control-prev w-auto" href="#recipeCarousel1" role="button"
                                data-slide="prev">
                                <span class="carousel-control-prev-icon bg-dark border border-dark rounded-circle"
                                    aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next w-auto" href="#recipeCarousel1" role="button"
                                data-slide="next">
                                <span class="carousel-control-next-icon bg-dark border border-dark rounded-circle"
                                    aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                </div>

            </div>

            <div class="container text-center my-3">
                <h5 class="font-weight-light font-weight-bold">User Claim Reward</h5>
                <div class="row mx-auto my-auto">
                    <div id="recipeCarousel" class="carousel slide w-100" data-ride="carousel">
                        <div class="carousel-inner w-100" role="listbox">
                            @foreach ($ure as $item => $value)
                                <div class="carousel-item @if ($item == 0) active @endif">
                                    <div class="col-md-4">
                                        <div class="card card-body d-flex justify-content-center"
                                            style="min-height: 20rem;">
                                            <div style="width:100%; text-align:center">
                                                {{-- <img src="https://mirror-api-playground.appspot.com/links/filoli-spring-fling.jpg"
                                                    style="width:50%; height:50%;"> --}}
                                                <img class="img-fluid imgUser"
                                                    src="{{ getImage('assets/images/user/profile/' . $value->user->image, null, true) }}">
                                            </div>

                                            <h5 class="card-title mt-2 mb-n1">
                                                {{-- @if ($value->user->firstname)
                                                    {{ ucwords($value->user->firstname . ' ' . $value->user->lastname) }}
                                                @else
                                                   
                                                @endif --}}
                                                {{ $value->user->no_bro }}
                                            </h5>
                                            {{-- <span class="text-sencondary">{{ $value->user->username }}</span> --}}
                                            <p class="card-text">{{ $value->reward->reward }} </p>
                                            <p class="card-text">{!! $value->details()['is_gold']
                                                ? '<span
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        class="badge rounded-pill badge-warning">Gold</span>'
                                                : '<span
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        class="badge rounded-pill badge-secondary">Silver</span>' !!}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                        <a class="carousel-control-prev w-auto" href="#recipeCarousel" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon bg-dark border border-dark rounded-circle"
                                aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next w-auto" href="#recipeCarousel" role="button" data-slide="next">
                            <span class="carousel-control-next-icon bg-dark border border-dark rounded-circle"
                                aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </div>


        </div>


        @if (Auth::user()->plan_id != 0)
            <div class="col-lg-4 col-md-4 col-12 mb-30">
                @if ($title)
                    <div class="mb-3 d-flex justify-content-center shing">
                        <div class="card b-radius--10 cardImages {{ $title }}">
                            <div class="card-body text-center cardTitle"
                                style="display: table; min-height: 15rem; overflow: hidden;">
                                <div style="display: table-cell; vertical-align: middle;">

                                </div>

                            </div>
                        </div>
                    </div>
                @endif
                @if (auth()->user()->new_ps)
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
                <div class="card card-gold-view cardImage">
                    <div class="text-view text-center">
                        {{ goldNum() }}
                    </div>
                </div>
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

    <div class="row mb-none-30">


        {{-- @if ($general->free_user_notice != null)
    <div class="col-lg-12 col-sm-6 mb-30">
        <div class="card border--light">
            @if ($general->notice == null)
            <div class="card-header">@lang('Notice')</div> @endif
            <div class="card-body">
                <p class="card-text"> @php echo $general->free_user_notice; @endphp </p>
            </div>
        </div>
    </div>
    @endif --}}
        <div class="col-xl-3 col-lg-4 col-sm-6 mb-30 text-center text-center">
            <div class="dashboard-w1  h-100 w-100 bg--gradi-51 b-radius--10 box-shadow">
                <div class="icon">
                    <i class="las la-gem"></i>
                </div>
                <div class="details">
                    <div class="numbers">
                        <span
                            class="amount">{{ auth()->user()->wd_gold ? auth()->user()->total_weekly_golds : nbk(auth()->user()->total_golds) }}</span>
                        <span class="currency-sign">Gram</span>
                    </div>
                    <div class="desciption">
                        <span class="text--small font-weight-bold">Equal To <span
                                class="badge badge-danger">{{ auth()->user()->wd_gold ? 0 : nb($goldBonus * (auth()->user()->wd_gold ? auth()->user()->total_weekly_golds : auth()->user()->total_golds)) }}
                                IDR</span>
                        </span>
                    </div>
                    <div class="desciption">
                        <span class="text--small ">{{ auth()->user()->wd_gold ? 0 : auth()->user()->total_daily_golds }}gr
                            Daily</span>
                        |
                        <span class="text--small ">{{ auth()->user()->total_weekly_golds }}gr
                            Weekly</span>
                    </div>
                </div>
                <br>
                <a href="{{ route('user.report.gold') }}"
                    class="btn btn-sm btn-block text--small bg--white text--black box--shadow3 mt-3">@lang('View All')</a>
            </div>
        </div>

        @if (auth()->user()->plan_id != 0)
            <div class="col-xl-3 col-lg-4 col-sm-6 mb-30 text-center text-center">
                <div class="dashboard-w1  h-100 w-100 bg--gradi-18 b-radius--10 box-shadow">
                    {{-- <div class="details">
                <div class="numbers">
                    <span class="amount" style="font-family: serif;
                    font-weight:bold;background-color: #414141ec;
                    color: transparent;
                    text-shadow: 0px 2px 3px rgba(255, 255, 255, 0.007);
                    -webkit-background-clip: text;
                       -moz-background-clip: text;
                            background-clip: text;  ">{{auth()->user()->bro_qty}} MP</span>
                </div>
            </div> --}}
                    <div class="icon">
                        <i class="las la-tree"></i>
                    </div>
                    <div class="details">
                        <div class="numbers">
                            <span
                                class="amount">{{ nb(auth()->user()->userExtra->left + auth()->user()->userExtra->right) }}</span>
                            <span class="currency-sign">MP</span>
                        </div>
                        <div class="desciption">
                            <span class="text--small">Total MP Joined</span>
                        </div>
                    </div>
                    <br>
                    <a href="{{ route('user.my.tree') }}"
                        class="btn btn-sm btn-block text--small bg--white text--black box--shadow3 mt-3">@lang('View All')</a>
                </div>
            </div>

            {{-- <div class="col-xl-3 col-lg-4 col-sm-6 mb-30 text-center text-center">
        <div class="dashboard-w1  h-100 w-100 bg--gradi-18 b-radius--10 box-shadow">
            <div class="details">
                <div class="numbers">
                    <span class="amount" style="font-family: serif;
                    font-weight:bold;background-color: #414141ec;
                    color: transparent;
                    text-shadow: 0px 2px 3px rgba(255, 255, 255, 0.007);
                    -webkit-background-clip: text;
                       -moz-background-clip: text;
                            background-clip: text;  ">{{auth()->user()->bro_qty}} MP</span>
                </div>
            </div>
            <div class="icon">
                <i class="las la-tree"></i>
            </div>
            <div class="details">
                <div class="numbers" >
                    <span class="amount">{{nb(auth()->user()->bro_qty + 1)}}</span>
                    <span class="currency-sign">MP</span>
                </div>
                <div class="desciption">
                    <span class="text--small">Business Right Owner</span>
                </div>
            </div>
            <br>
            <a href="{{ route('user.my.tree') }}" class="btn btn-sm btn-block text--small bg--white text--black box--shadow3 mt-3">@lang('View All')</a>
        </div>
    </div> --}}
        @endif

        {{-- @if ($emas)
            <div class="col-xl-3 col-lg-4 col-sm-6 mb-30">
                <div class="dashboard-w1 bg--gradi-1 b-radius--10 box-shadow">
                    <div class="icon">
                        <i class="las la-coins"></i>
                    </div>
                    <div class="details">
                        <div class="numbers">
                            <span class="amount">{{ nbk($emas->total_wg) }}</span>
                            <span class="currency-sign">Gram</span>
                        </div>
                        <div class="desciption">
                            <span class="text--small">Equal To {{ nb($emas->total_rp) }} IDR</span>
                        </div>
                    </div>
                    <br>
                    <a href="{{ route('user.gold.invest') }}"
                        class="btn btn-sm btn-block text--small bg--white text--black box--shadow3 mt-3">@lang('View All')</a>
                </div>
            </div>
        @endif --}}

        <div class="col-xl-3 col-lg-4 col-sm-6 mb-30 text-center">
            <div class="dashboard-w1 h-100 w-100 bg--success b-radius--10 box-shadow">
                <div class="icon">
                    <i class="las la-wallet"></i>
                </div>
                <div class="details">
                    <div class="numbers">
                        <span class="amount">{{ nb(getAmount(auth()->user()->balance)) }}</span>
                        <span class="currency-sign">{{ $general->cur_text }}</span>
                    </div>
                    <div class="desciption">
                        <span class="text--small">@lang('Current Balance')</span>
                    </div>
                </div>
                <br>
                <a href="{{ route('user.report.transactions') }}"
                    class="btn btn-sm btn-block text--small bg--white text--black box--shadow3 mt-3">@lang('View All')</a>
                {{-- <button class="btn btn-primary">Convert Saldo to PIN</button> --}}
            </div>
        </div>

        <div class="col-xl-3 col-lg-4 col-sm-6 mb-30 text-center">
            <div class="dashboard-w1 h-100 w-100 bg--primary b-radius--10 box-shadow">
                <div class="icon">
                    <i class="las la-cloud-upload-alt "></i>
                </div>
                <div class="details">
                    <div class="numbers">
                        <span class="amount">{{ auth()->user()->pin }}</span>
                        <span class="currency-sign">{{ 'PIN' }}</span>
                    </div>
                    <div class="desciption">
                        <span class="text--small">@lang('Active Pin')</span>
                    </div>
                </div>
                <br>
                <a href="{{ route('user.pins.PinDeliveriyLog') }}"
                    class="btn btn-sm text--small bg--white btn-block text--black box--shadow3 mt-3">@lang('View All')</a>
            </div>
        </div>

        <div class="col-xl-3 col-lg-4 col-sm-6 mb-30 text-center">
            <div class="dashboard-w1 bg--10 b-radius--10 box-shadow">
                <div class="icon">
                    <i class="las la-cloud-download-alt"></i>
                </div>
                <div class="details">
                    <div class="numbers">
                        <span class="amount">{{ nb(getAmount($totalWithdraw)) }}</span>
                        <span class="currency-sign">{{ $general->cur_text }}</span>
                    </div>
                    <div class="desciption">
                        <span class="text--small">@lang('Total Withdraw')</span>
                    </div>
                </div>
                <br>
                <a href="{{ route('user.report.withdraw') }}"
                    class="btn btn-sm text--small bg--white btn-block text--black box--shadow3 mt-3">@lang('View All')</a>
            </div>
        </div>
        <div class="col-xl-3 col-lg-4 col-sm-6 mb-30 text-center">
            <div class="dashboard-w1 bg--teal b-radius--10 box-shadow">
                <div class="icon">
                    <i class="las la-check"></i>
                </div>
                <div class="details">
                    <div class="numbers">
                        <span class="amount">{{ $completeWithdraw }}</span>
                    </div>
                    <div class="desciption">
                        <span class="text--small">@lang('Complete Withdraw')</span>
                    </div>
                </div>
                <br>
                <a href="{{ route('user.report.withdraw') }}?type=complete"
                    class="btn btn-sm text--small bg--white btn-block text--black box--shadow3 mt-3">@lang('View All')</a>
            </div>
        </div>

        <div class="col-xl-3 col-lg-4 col-sm-6 mb-30 text-center">
            <div class="dashboard-w1 bg--warning b-radius--10 box-shadow">
                <div class="icon">
                    <i class="las la-spinner"></i>
                </div>
                <div class="details">
                    <div class="numbers">
                        <span class="amount">{{ $pendingWithdraw }}</span>
                    </div>
                    <div class="desciption">
                        <span class="text--small">@lang('Pending Withdraw')</span>
                    </div>
                </div>
                <br>
                <a href="{{ route('user.report.withdraw') }}?type=complete"
                    class="btn btn-sm text--small bg--white btn-block text--black box--shadow3 mt-3">@lang('View All')</a>
            </div>
        </div>

        <div class="col-xl-3 col-lg-4 col-sm-6 mb-30 text-center">
            <div class="dashboard-w1 bg--danger b-radius--10 box-shadow">
                <div class="icon">
                    <i class="las la-ban"></i>
                </div>
                <div class="details">
                    <div class="numbers">
                        <span class="amount">{{ $rejectWithdraw }}</span>
                    </div>
                    <div class="desciption">
                        <span class="text--small">@lang('Reject Withdraw')</span>
                    </div>
                </div>
                <br>
                <a href="{{ route('user.report.withdraw') }}?type=reject"
                    class="btn btn-sm text--small bg--white btn-block text--black box--shadow3 mt-3">@lang('View All')</a>
            </div>
        </div>

        <div class="col-xl-3 col-lg-4 col-sm-6 mb-30 text-center">
            <div class="dashboard-w1 bg--cyan b-radius--10 box-shadow">
                <div class="icon">
                    <i class="las la-money-bill-wave"></i>
                </div>
                <div class="details">
                    <div class="numbers">
                        <span class="amount">{{ nb(getAmount(auth()->user()->total_invest)) }}</span>
                        <span class="currency-sign">{{ $general->cur_text }}</span>
                    </div>
                    <div class="desciption">
                        <span class="text--small">@lang('Total Invest')</span>
                    </div>
                </div>
                <br>
                <a href="{{ route('user.report.invest') }}"
                    class="btn btn-sm text--small bg--white btn-block text--black box--shadow3 mt-3">@lang('View All')</a>
            </div>
        </div>
        <div class="col-xl-3 col-lg-4 col-sm-6 mb-30 text-center">
            <div class="dashboard-w1 bg--info b-radius--10 box-shadow">
                <div class="icon">
                    <i class="fa fa-tree"></i>
                </div>
                <div class="details">
                    <div class="numbers">
                        <span class="amount">{{ nb(getAmount(auth()->user()->total_binary_com)) }}</span>
                        <span class="currency-sign">{{ $general->cur_text }}</span>
                    </div>
                    <div class="desciption">
                        <span class="text--small">@lang('Total Binary Commission')</span>
                    </div>
                </div>
                <br>
                <a href="{{ route('user.report.binaryCom') }}"
                    class="btn btn-sm text--small bg--white btn-block text--black box--shadow3 mt-3">@lang('View All')</a>
            </div>
        </div>
        <div class="col-xl-3 col-lg-4 col-sm-6 mb-30 text-center">
            <div class="dashboard-w1 bg--12 b-radius--10 box-shadow">
                <div class="icon">
                    <i class="las la-money-bill"></i>
                </div>
                <div class="details">
                    <div class="numbers">
                        <span class="amount">{{ nb(getAmount(auth()->user()->total_ref_com)) }}</span>
                        <span class="currency-sign">{{ $general->cur_text }}</span>
                    </div>
                    <div class="desciption">
                        <span class="text--small">@lang('Total Bonus Sponsor')</span>
                    </div>
                    <a href="{{ route('user.report.refCom') }}"
                        class="btn btn-sm text--small bg--white btn-block text--black box--shadow3 mt-3">@lang('View All')</a>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-4 col-sm-6 mb-30 text-center">
            <div class="dashboard-w1 bg--success b-radius--10 box-shadow">
                <div class="icon">
                    <i class="fa fa-tree"></i>
                </div>
                <div class="details">
                    <div class="numbers">
                        <span
                            class="amount">{{ nb(getAmount(auth()->user()->total_binary_com + auth()->user()->total_ref_com)) }}</span>
                        <span class="currency-sign">{{ $general->cur_text }}</span>
                    </div>
                    <div class="desciption">
                        <span class="text--small">@lang('Total Bonus All')</span>
                    </div>
                </div>
                <br>
                <a href="{{ route('user.report.binaryCom') }}"
                    class="btn btn-sm text--small bg--white btn-block text--black box--shadow3 mt-3">@lang('View All')</a>
            </div>
        </div>
        <div class="col-xl-3 col-lg-4 col-sm-6 mb-30 text-center">
            <div class="dashboard-w1 bg--15 b-radius--10 box-shadow">
                <div class="icon">
                    <i class="fa fa-arrow-circle-left"></i>
                </div>
                <div class="details">
                    <div class="numbers">
                        <span class="amount">{{ auth()->user()->userExtra->left }} :
                            {{ auth()->user()->userExtra->right }}</span>
                    </div>
                    <div class="desciption">
                        <span class="text--small">@lang('Total Left : Total Right')</span>
                    </div>
                </div>
                <br>
                <a href="{{ route('user.my.tree') }}"
                    class="btn btn-sm text--small bg--white btn-block text--black box--shadow3 mt-3">@lang('View All')</a>
            </div>
        </div>

    </div>

@endsection

@push('script')
    <script>
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
