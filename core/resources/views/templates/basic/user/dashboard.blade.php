@extends($activeTemplate . 'user.layouts.app')

@push('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css">
    <style>
        :root {
            --primary-color: rgb(11, 78, 179)
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

        @keyframes stroke {
            100% {
                stroke-dashoffset: 0
            }
        }

        @keyframes scale {

            0%,
            100% {
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
@endpush
@section('panel')
    {{-- <div class="row mb-4">
        <div class="col-lg-12">
            @if (\App\Models\User::canClaimDailyGold(Auth::id()))
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    <strong>Hey {{ Auth::user()->fullname }}!</strong> &nbsp; Check-In and get your 0.005gr gold right now.
                    &nbsp; <a href="#" class="alert-link" data-toggle="modal" data-target="#exampleModal">CHECK
                        IN</a>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
        </div>
    </div> --}}
    <div class="row">
        @if (Auth::user()->is_kyc == 0)
            <div class="col-lg-8 col-md-8 col-12 mb-30">
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
            </div>
        @elseif(Auth::user()->is_kyc == 1)
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
                            <div class="progress-step" data-title="Status"></div>
                        </div>
                        <p>Your data is in the verification process.</p>
                    </div>
                </div>
            </div>
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
            <div class="col-lg-8 col-md-8 col-12 mb-30">
                <div class="card card-header-actions">
                    <div class="card-header text-center" style="font-weight: 600;">
                        Account Verification
                        <p>Your data has been successfully verified <i class="fa fa-check-circle text-success"></i></p>
                    </div>
                    <div class="card-footer text-center">
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
                </div>
            </div>
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

        @if (Auth::user()->plan_id != 0)
            <div class="col-lg-4 col-md-4 col-12 mb-30">
                <div class="card card-header-actions">
                    <div class="card-header" style="font-weight: 600;">
                        MP Number
                    </div>
                    <div class="card-body text-center bg--gradi-9 border-3">
                        <h2 style="font-weight: 700;color: black;">M{{ Auth::user()->no_bro }}</h2>
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
        <div class="col-xl-3 col-lg-4 col-sm-6 mb-30 text-center">
            <div class="dashboard-w1  h-100 w-100 bg--gradi-51 b-radius--10 box-shadow">
                <div class="icon">
                    <i class="las la-gem"></i>
                </div>
                <div class="details">
                    <div class="numbers">
                        <span class="amount">{{ nbk(auth()->user()->total_golds) }}</span>
                        <span class="currency-sign">Gram</span>
                    </div>
                    <div class="desciption">
                        <span class="text--small">Equal To {{ nb($goldBonus) }} IDR</span>
                    </div>
                    <div class="desciption">
                        <span class="text--small ">{{ nbk(auth()->user()->total_daily_golds) }} Daily Gold</span>
                        |
                        <span class="text--small ">{{ nb(auth()->user()->total_weekly_golds) }} Weekly Gold</span>
                    </div>
                </div>
                <br>
                <a href="{{ route('user.my.tree') }}"
                    class="btn btn-sm btn-block text--small bg--white text--black box--shadow3 mt-3">@lang('View All')</a>
            </div>
        </div>

        @if (auth()->user()->plan_id != 0)
            <div class="col-xl-3 col-lg-4 col-sm-6 mb-30 text-center">
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

            {{-- <div class="col-xl-3 col-lg-4 col-sm-6 mb-30 text-center">
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

        <div class="col-xl-3 col-lg-4 col-sm-6 mb-30">
            <div class="dashboard-w1 bg--success b-radius--10 box-shadow">
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
            </div>
        </div>

        <div class="col-xl-3 col-lg-4 col-sm-6 mb-30">
            <div class="dashboard-w1 bg--primary b-radius--10 box-shadow">
                <div class="icon">
                    <i class="las la-cloud-upload-alt "></i>
                </div>
                <div class="details">
                    <div class="numbers">
                        <span class="amount">{{ nb(getAmount($totalDeposit)) }}</span>
                        <span class="currency-sign">{{ $general->cur_text }}</span>
                    </div>
                    <div class="desciption">
                        <span class="text--small">@lang('Total Deposit')</span>
                    </div>
                </div>
                <br>
                <a href="{{ route('user.report.deposit') }}"
                    class="btn btn-sm text--small bg--white btn-block text--black box--shadow3 mt-3">@lang('View All')</a>
            </div>
        </div>

        <div class="col-xl-3 col-lg-4 col-sm-6 mb-30">
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
        <div class="col-xl-3 col-lg-4 col-sm-6 mb-30">
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

        <div class="col-xl-3 col-lg-4 col-sm-6 mb-30">
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

        <div class="col-xl-3 col-lg-4 col-sm-6 mb-30">
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

        {{-- <div class="col-xl-3 col-lg-4 col-sm-6 mb-30">
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
        </div> --}}

        {{-- <div class="col-xl-3 col-lg-4 col-sm-6 mb-30">
        <div class="dashboard-w1 bg--12 b-radius--10 box-shadow">
            <div class="icon">
                <i class="las la-money-bill"></i>
            </div>
            <div class="details">
                <div class="numbers">
                    <span class="amount">{{getAmount(auth()->user()->total_ref_com)}}</span>
                    <span class="currency-sign">{{$general->cur_text}}</span>
                </div>
                <div class="desciption">
                    <span class="text--small">@lang('Total Referral Commission')</span>
                </div>
                <a href="{{route('user.report.refCom')}}"
                    class="btn btn-sm text--small bg--white btn-block text--black box--shadow3 mt-3">@lang('View All')</a>
            </div>
        </div>
    </div> --}}

        <div class="col-xl-3 col-lg-4 col-sm-6 mb-30">
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

        {{-- <div class="col-xl-3 col-lg-4 col-sm-6 mb-30">
        <div class="dashboard-w1 bg--3 b-radius--10 box-shadow">
            <div class="icon">
                <i class="las la-users"></i>
            </div>
            <div class="details">
                <div class="numbers">
                    <span class="amount">{{$total_ref}}</span>
                </div>
                <div class="desciption">
                    <span class="text--small">@lang('Total Referral')</span>
                </div>
                <a href="{{route('user.my.ref')}}"
                    class="btn btn-sm text--small bg--white btn-block text--black box--shadow3 mt-3">@lang('View All')</a>
            </div>
        </div>
    </div> --}}

        <div class="col-xl-3 col-lg-4 col-sm-6 mb-30">
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



        {{-- <div class="col-xl-3 col-lg-4 col-sm-6 mb-30">
        <div class="dashboard-w1 bg--17 b-radius--10 box-shadow">
            <div class="icon">
                <i class="las la-cart-arrow-down"></i>
            </div>
            <div class="details">
                <div class="numbers">
                    <span class="amount">{{auth()->user()->userExtra->bv_left +
                        auth()->user()->userExtra->bv_right}}</span>
                </div>
                <div class="desciption">
                    <span class="text--small">@lang('Total BV')</span>
                </div>
                <a href="{{route('user.bv.log')}}?type=paidBV"
                    class="btn btn-sm text--small bg--white btn-block text--black box--shadow3 mt-3">@lang('View All')</a>
            </div>
        </div>
    </div>


    <div class="col-xl-3 col-lg-4 col-sm-6 mb-30">
        <div class="dashboard-w1 bg--19 b-radius--10 box-shadow">
            <div class="icon">
                <i class="las la-arrow-alt-circle-left"></i>
            </div>
            <div class="details">
                <div class="numbers">
                    <span class="amount">{{getAmount(auth()->user()->userExtra->bv_left)}}</span>
                </div>
                <div class="desciption">
                    <span class="text--small">@lang('Left BV')</span>
                </div>
                <a href="{{route('user.bv.log')}}?type=leftBV"
                    class="btn btn-sm text--small bg--white btn-block text--black box--shadow3 mt-3">@lang('View All')</a>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-lg-4 col-sm-6 mb-30">
        <div class="dashboard-w1 bg--11 b-radius--10 box-shadow">
            <div class="icon">
                <i class="las la-arrow-alt-circle-right"></i>
            </div>
            <div class="details">
                <div class="numbers">
                    <span class="amount">{{getAmount(auth()->user()->userExtra->bv_right)}}</span>
                </div>
                <div class="desciption">
                    <span class="text--small">@lang('Right BV')</span>
                </div>
                <a href="{{route('user.bv.log')}}?type=rightBV"
                    class="btn btn-sm text--small bg--white btn-block text--black box--shadow3 mt-3">@lang('View All')</a>
            </div>
        </div>
    </div>


    <div class="col-xl-3 col-lg-4 col-sm-6 mb-30">
        <div class="dashboard-w1 bg--13 b-radius--10 box-shadow">
            <div class="icon">
                <i class="las la-hand-holding-usd"></i>
            </div>
            <div class="details">
                <div class="numbers">
                    <span class="amount">{{getAmount($totalBvCut)}}</span>
                    <span class="currency-sign">{{$general->cur_text}}</span>
                </div>
                <div class="desciption">
                    <span class="text--small">@lang('Total Bv Cut')</span>
                </div>
                <a href="{{route('user.bv.log')}}?type=cutBV"
                    class="btn btn-sm text--small bg--white btn-block text--black box--shadow3 mt-3">@lang('View All')</a>
            </div>
        </div>
    </div> --}}
        <div class="col-xl-12 col-lg-12 col-sm-12 mb-30">
            <div class="card bg--gradi-51">
                <div class="card-header">
                    <h2 class="card-title text-center text-light">Reward List</h2>
                    <h6 class="card-title text-center text-light mt-n3">List Reward yang bisa di claim dari total jumlah
                        kiri dan kanan.</h6>
                    <hr class="text-light">
                    <div class="row d-flex justify-content-center text-center">
                        <div class="col-md-4 mt-3 text-center">
                            <div class="card" style="width: 18rem;">
                                <img class="card-img-top" src="{{ asset('assets/turki.jpg') }}" alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title">150 Kiri : 150 Kanan</h5>
                                    <p class="card-text">Dapatkan Reward <b>Trip Ke Turki</b> Dengan 150:150 Downline</p>
                                    <a href="#"
                                        class="btn btn-primary  @if (auth()->user()->userExtra->left <= 150 && auth()->user()->userExtra->right <= 150) disabled @endif">Ambil
                                        Reward</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mt-3">
                            <div class="card" style="width: 18rem;">
                                <img class="card-img-top" src="{{ asset('assets/cars.jpeg') }}" alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title">999 Kiri : 999 Kanan</h5>
                                    <p class="card-text">Dapatkan Reward <b>Mobil Wuling Almaz</b> Dengan 999:999
                                        Downline
                                    </p>
                                    <a href="#"
                                        class="btn btn-primary @if (auth()->user()->userExtra->left <= 999 && auth()->user()->userExtra->right <= 999) disabled @endif">Ambil
                                        Reward</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <ul class="list-group">
                        <li class="list-group-item">150 kiri 150 kanan
                            <a href="#" class="btn btn-success btn-sm"></a>
                        </li>
                        <li class="list-group-item">999 kiri 999 kanan
                            <a href="#" class="btn btn-success btn-sm">Ambil 1 Unit Wuling Almaz</a>
                        </li>
                    </ul> --}}
                </div>
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
    </script>
@endpush
