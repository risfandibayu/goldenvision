@extends('admin.layouts.app')
@push('style')
    <link rel="stylesheet" href="{{ asset('assets/leaflet') }}/leaflet.css" />
    <script src="{{ asset('assets/leaflet') }}/leaflet.js"></script>
    <link rel="stylesheet" href="{{ asset('assets') }}/dist/MarkerCluster.css" />
    <link rel="stylesheet" href="{{ asset('assets') }}/dist/MarkerCluster.Default.css" />
    <script src="{{ asset('assets') }}/dist/leaflet.markercluster-src.js"></script>
@endpush

@section('panel')
    @if (@json_decode($general->sys_version)->version > systemDetails()['version'])
        <div class="row">
            <div class="col-md-12">
                <div class="card text-white bg-warning mb-3">
                    <div class="card-header">
                        <h3 class="card-title"> @lang('New Version Available') <button
                                class="btn btn--dark float-right">@lang('Version')
                                {{ json_decode($general->sys_version)->version }}</button> </h3>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title text-dark">@lang('What is the Update ?')</h5>
                        <p>
                            <pre class="f-size--24">{{ json_decode($general->sys_version)->details }}</pre>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    @endif
    @if (@json_decode($general->sys_version)->message)
        <div class="row">
            @foreach (json_decode($general->sys_version)->message as $msg)
                <div class="col-md-12">
                    <div class="alert border border--primary" role="alert">
                        <div class="alert__icon bg--primary"><i class="far fa-bell"></i></div>
                        <p class="alert__message">@php echo $msg; @endphp</p>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    <div class="row mb-none-30">
        <div class="col-xl-3 col-lg-4 col-sm-6 mb-30">
            <div class="dashboard-w1 bg--gradi-10 b-radius--10 box-shadow">
                <div class="icon">
                    <i class="fa fa-users"></i>
                </div>
                <div class="details">
                    <div class="numbers">
                        <span class="amount">{{ $widget['total_bro_joined'] }}</span>
                    </div>
                    <div class="desciption">
                        <span class="text--small">@lang('Total MP Joined')</span>
                    </div>
                    <a href="{{ route('admin.users.all') }}"
                        class="btn btn-sm text--small bg--white text--black box--shadow3 mt-3">@lang('View All')</a>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-4 col-sm-6 mb-30">
            <div class="dashboard-w1 bg--primary b-radius--10 box-shadow">
                <div class="icon">
                    <i class="fa fa-users"></i>
                </div>
                <div class="details">
                    <div class="numbers">
                        <span class="amount">{{ $widget['total_users'] }}</span>
                    </div>
                    <div class="desciption">
                        <span class="text--small">@lang('Total Users')</span>
                    </div>
                    <a href="{{ route('admin.users.all') }}"
                        class="btn btn-sm text--small bg--white text--black box--shadow3 mt-3">@lang('View All')</a>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-4 col-sm-6 mb-30">
            <div class="dashboard-w1 bg--1 b-radius--10 box-shadow">
                <div class="icon">
                    <i class="fas fa-wallet"></i>
                </div>
                <div class="details">
                    <div class="numbers">
                        <span class="currency-sign">{{ $general->cur_sym }}</span>
                        <span class="amount">{{ nb(getAmount($widget['users_balance'])) }}</span>
                    </div>
                    <div class="desciption">
                        <span class="text--small">@lang('Users Balance')</span>
                    </div>
                    <a href="{{ route('admin.users.active') }}"
                        class="btn btn-sm text--small bg--white text--black box--shadow3 mt-3">@lang('View All')</a>
                </div>
            </div>
        </div>


        <div class="col-xl-3 col-lg-4 col-sm-6 mb-30">
            <div class="dashboard-w1 bg--success b-radius--10 box-shadow">
                <div class="icon">
                    <i class="fa fa-users"></i>
                </div>
                <div class="details">
                    <div class="numbers">
                        <span class="amount">{{ $widget['verified_users'] }}</span>
                    </div>
                    <div class="desciption">
                        <span class="text--small">@lang('Total Verified Users')</span>
                    </div>
                    <a href="{{ route('admin.users.active') }}"
                        class="btn btn-sm text--small bg--white text--black box--shadow3 mt-3">@lang('View All')</a>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-4 col-sm-6 mb-30">
            <div class="dashboard-w1 bg--red b-radius--10 box-shadow">
                <div class="icon">
                    <i class="fa fa-ban"></i>
                </div>
                <div class="details">
                    <div class="numbers">
                        <span class="amount">{{ $widget['banned_users'] }}</span>
                    </div>
                    <div class="desciption">
                        <span class="text--small">@lang('Banned Users')</span>
                    </div>
                    <a href="{{ route('admin.users.banned') }}"
                        class="btn btn-sm text--small bg--white text--black box--shadow3 mt-3">@lang('View All')</a>
                </div>
            </div>
        </div>


        <div class="col-xl-3 col-lg-4 col-sm-6 mb-30">
            <div class="dashboard-w1 bg--indigo b-radius--10 box-shadow ">
                <div class="icon">
                    <i class="la la-envelope"></i>
                </div>
                <div class="details">
                    <div class="numbers">
                        <span class="amount">{{ $widget['email_verified_users'] }}</span>
                    </div>
                    <div class="desciption">
                        <span class="text--small">@lang('Total Email Verified')</span>
                    </div>
                    <a href="{{ route('admin.users.emailVerified') }}"
                        class="btn btn-sm text--small bg--white text--black box--shadow3 mt-3">@lang('View All')</a>
                </div>
            </div>
        </div>


        <div class="col-xl-3 col-lg-4 col-sm-6 mb-30">
            <div class="dashboard-w1 bg--danger b-radius--10 box-shadow">
                <div class="icon">
                    <i class="fa fa-envelope"></i>
                </div>
                <div class="details">
                    <div class="numbers">
                        <span class="amount">{{ $widget['emailUnverified'] }}</span>
                    </div>
                    <div class="desciption">
                        <span class="text--small">@lang('Total Email Unverified')</span>
                    </div>
                    <a href="{{ route('admin.users.emailUnverified') }}"
                        class="btn btn-sm text--small bg--white text--black box--shadow3 mt-3">@lang('View All')</a>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-4 col-sm-6 mb-30">
            <div class="dashboard-w1 bg--primary b-radius--10 box-shadow ">
                <div class="icon">
                    <i class="fa fa-phone"></i>
                </div>
                <div class="details">
                    <div class="numbers">
                        <span class="amount">{{ $widget['sms_verified_users'] }}</span>
                    </div>
                    <div class="desciption">
                        <span class="text--small">@lang('Total SMS Verified')</span>
                    </div>
                    <a href="{{ route('admin.users.smsVerified') }}"
                        class="btn btn-sm text--small bg--white text--black box--shadow3 mt-3">@lang('View All')</a>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-4 col-sm-6 mb-30">
            <div class="dashboard-w1 bg--pink b-radius--10 box-shadow">
                <div class="icon">
                    <i class="fa fa-window-close"></i>
                </div>
                <div class="details">
                    <div class="numbers">
                        <span class="amount">{{ $widget['smsUnverified'] }}</span>
                    </div>
                    <div class="desciption">
                        <span class="text--small">@lang('Total SMS Unverified')</span>
                    </div>
                    <a href="{{ route('admin.users.smsUnverified') }}"
                        class="btn btn-sm text--small bg--white text--black box--shadow3 mt-3">@lang('View All')</a>
                </div>
            </div>
        </div>


        <div class="col-xl-3 col-lg-4 col-sm-6 mb-30">
            <div class="dashboard-w1 bg--cyan b-radius--10 box-shadow">
                <div class="icon">
                    <i class="fa fa-money-bill-wave-alt"></i>
                </div>
                <div class="details">
                    <div class="numbers">
                        <span class="currency-sign">{{ $general->cur_sym }}</span>
                        <span class="amount">{{ nb(getAmount($widget['users_invest'])) }}</span>
                    </div>
                    <div class="desciption">
                        <span class="text--small">@lang('Total Invest')</span>
                    </div>
                    <a href="{{ route('admin.report.invest') }}"
                        class="btn btn-sm text--small bg--white text--black box--shadow3 mt-3">@lang('View All')</a>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-4 col-sm-6 mb-30">
            <div class="dashboard-w1 bg--info b-radius--10 box-shadow">
                <div class="icon">
                    <i class="fa fa-money-bill-wave-alt"></i>
                </div>
                <div class="details">
                    <div class="numbers">
                        <span class="currency-sign">{{ $general->cur_sym }}</span>
                        <span class="amount">{{ nb(getAmount($widget['last7days_invest'])) }}</span>
                    </div>
                    <div class="desciption">
                        <span class="text--small">@lang('Last 7 Days Invest')</span>
                    </div>
                    <a href="#0"
                        class="btn btn-sm text--small bg--white text--black box--shadow3 mt-3">@lang('View All')</a>
                </div>
            </div>
        </div>


        {{-- <div class="col-xl-3 col-lg-4 col-sm-6 mb-30">
            <div class="dashboard-w1 bg--3 b-radius--10 box-shadow">
                <div class="icon">
                    <i class="las la-hand-holding-usd"></i>
                </div>
                <div class="details">
                    <div class="numbers">
                        <span class="currency-sign">{{$general->cur_sym}}</span>
                        <span class="amount">{{getAmount($widget['total_ref_com'])}}</span>
                    </div>
                    <div class="desciption">
                        <span class="text--small">@lang('Total Referral Commission')</span>
                    </div>
                    <a href="{{route('admin.report.refCom')}}"
                       class="btn btn-sm text--small bg--white text--black box--shadow3 mt-3">@lang('View All')</a>
                </div>
            </div>
        </div> --}}

        <div class="col-xl-3 col-lg-4 col-sm-6 mb-30">
            <div class="dashboard-w1 bg--17 b-radius--10 box-shadow">
                <div class="icon">
                    <i class="las la-tree"></i>
                </div>
                <div class="details">
                    <div class="numbers">
                        <span class="currency-sign">{{ $general->cur_sym }}</span>
                        <span class="amount">{{ nb(getAmount($widget['total_binary_com'])) }}</span>

                    </div>
                    <div class="desciption">
                        <span class="text--small">@lang('Total Binary Commission')</span>
                    </div>
                    <a href="{{ route('admin.report.binaryCom') }}"
                        class="btn btn-sm text--small bg--white text--black box--shadow3 mt-3">@lang('View All')</a>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-4 col-sm-6 mb-30">
            <div class="dashboard-w1 bg--gradi-51 b-radius--10 box-shadow">
                <div class="icon">
                    <i class="las la-coins"></i>
                </div>
                <div class="details">
                    <div class="numbers">
                        <span class="currency-sign">{{ $general->cur_sym }}</span>
                        <span class="amount">{{ nb(getAmount($widget['totalWdGold'])) }}</span>

                    </div>
                    <div class="desciption">
                        <span class="text--small">@lang('Total DailyGold Withdrawl')</span>
                    </div>
                    {{-- <a href="#"
                        class="btn btn-sm text--small bg--white text--black box--shadow3 mt-3">@lang('View All')</a> --}}
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-4 col-sm-6 mb-30">
            <div class="dashboard-w1 bg--17 b-radius--10 box-shadow">
                <div class="icon">
                    <i class="las fa-money-bill-wave-alt"></i>
                </div>
                <div class="details">
                    <div class="numbers">
                        <span class="currency-sign">{{ $general->cur_sym }}</span>
                        <span class="amount">{{ nb(getAmount($widget['totalMpProd'])) }}</span>

                    </div>
                    <div class="desciption">
                        <span class="text--small">@lang('Total Gold Card')</span>
                    </div>
                    {{-- <a href="#"
                        class="btn btn-sm text--small bg--white text--black box--shadow3 mt-3">@lang('View All')</a> --}}
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-4 col-sm-6 mb-30">
            <div class="dashboard-w1 bg--pink b-radius--10 box-shadow">
                <div class="icon">
                    <i class="las fa-money-bill-wave-alt"></i>
                </div>
                <div class="details">
                    <div class="numbers">
                        <span class="currency-sign">{{ $general->cur_sym }}</span>
                        <span class="amount">{{ nb(getAmount($widget['totalColagenProd'])) }}</span>

                    </div>
                    <div class="desciption">
                        <span class="text--small">@lang('Total Colagen Production')</span>
                    </div>
                    {{-- <a href="#"
                        class="btn btn-sm text--small bg--white text--black box--shadow3 mt-3">@lang('View All')</a> --}}
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-4 col-sm-6 mb-30">
            <div class="dashboard-w1 bg--danger b-radius--10 box-shadow">
                <div class="icon">
                    <i class="las fa-money-bill-wave-alt"></i>
                </div>
                <div class="details">
                    <div class="numbers">
                        <span class="currency-sign">{{ $general->cur_sym }}</span>
                        <span class="amount">{{ nb(getAmount($widget['totalReferalsCommision'])) }}</span>

                    </div>
                    <div class="desciption">
                        <span class="text--small">@lang('Total Refeerals Commision')</span>
                    </div>
                    {{-- <a href="#"
                        class="btn btn-sm text--small bg--white text--black box--shadow3 mt-3">@lang('View All')</a> --}}
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-4 col-sm-6 mb-30">
            <div class="dashboard-w1 bg--success b-radius--10 box-shadow">
                <div class="icon">
                    <i class="las fa-money-bill-wave-alt"></i>
                </div>
                <div class="details">
                    <div class="numbers">
                        <span class="currency-sign">{{ $general->cur_sym }}</span>
                        <span class="amount">{{ nb(getAmount($widget['totalPurchasedPlan'])) }}</span>

                    </div>
                    <div class="desciption">
                        <span class="text--small">@lang('Total Purchased Plan')</span>
                    </div>
                    {{-- <a href="#"
                        class="btn btn-sm text--small bg--white text--black box--shadow3 mt-3">@lang('View All')</a> --}}
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-4 col-sm-6 mb-30">
            <div class="dashboard-w1 bg--primary b-radius--10 box-shadow">
                <div class="icon">
                    <i class="las fa-money-bill-wave-alt"></i>
                </div>
                <div class="details">
                    <div class="numbers">
                        <span class="currency-sign">{{ $general->cur_sym }}</span>
                        <span class="amount">{{ nb(getAmount($widget['r_hp'])) }}</span>

                    </div>
                    <div class="desciption">
                        <span class="text--small">@lang('Total Bonus Reward Phone')</span>
                    </div>
                    {{-- <a href="#"
                        class="btn btn-sm text--small bg--white text--black box--shadow3 mt-3">@lang('View All')</a> --}}
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-4 col-sm-6 mb-30">
            <div class="dashboard-w1 bg--gradi-10 b-radius--10 box-shadow">
                <div class="details">
                    <div class="numbers ">
                        {{-- <span class="amount">Leader</span> --}}
                    </div>
                </div>
                <div class="icon">
                    <i class="las fa-info"></i>
                </div>
                @foreach ($leader as $user)
                    <div class="details mr-3">
                        <div class="desciption">
                            <span class="text--small">{{ $user->fullname }}</span>
                        </div>
                        <div class="numbers">
                            <span class="amount">{{ $user->pin }} PIN</span>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>

        <div class="col-xl-3 col-lg-4 col-sm-6 mb-30">
            <div class="dashboard-w1 bg--gradi-5 b-radius--10 box-shadow">
                <div class="details">
                    <div class="numbers ">
                        {{-- <span class="amount">User Badges</span> --}}
                    </div>
                </div>
                <div class="icon">
                    <i class="las fa-info"></i>
                </div>
                <div class="details mr-3">
                    <div class="desciption">
                        <span class="text--small">{{ 'GOLD' }}</span>
                    </div>
                    <div class="numbers">
                        <span class="amount">{{ $widget['gold_silver']['gold'] }}</span>
                    </div>
                </div>
                <div class="details mr-3">
                    <div class="desciption">
                        <span class="text--small">{{ 'SILVER' }}</span>
                    </div>
                    <div class="numbers">
                        <span class="amount">{{ $widget['gold_silver']['silver'] }}</span>
                    </div>
                </div>

            </div>
        </div>

        {{-- <div class="col-md-6">
            <div class="card ">
                <div class="card-body p-0">
                    <div class="table-responsive--sm table-responsive">
                        <table class="table table--light style--two">
                            <thead>
                                <tr class="text-center">
                                    <th colspan="3">Leader Not Distributed PIN</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($leader as $user)
                                    <tr>
                                        <td data-label="@lang('User')">
                                            <div class="user">
                                                <div class="thumb"><img
                                                        src="{{ getImage('assets/images/user/profile/' . $user->image, null, true) }}"
                                                        alt="@lang('image')"></div>
                                                <span class="name">{{ $user->fullname }}</span>
                                            </div>
                                        </td>
                                        <td data-label="@lang('Username')"><a
                                                href="{{ route('admin.users.detail', $user->id) }}">{{ $user->username }}</a>
                                        </td>
                                        <td data-label="@lang('Email')" class="text-left">{{ $user->pin }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-muted text-center" colspan="100%">@lang('User Not Found')</td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table><!-- table end -->
                    </div>
                </div>
            </div>
        </div> --}}
        {{-- <div class="col-xl-3 col-lg-4 col-sm-6 mb-30">
            <div class="dashboard-w1 bg--deep-purple b-radius--10 box-shadow">
                <div class="icon">
                    <i class="las la-cut"></i>
                </div>
                <div class="details">
                    <div class="numbers">
                        <span class="amount">{{getAmount($bv['totalBvCut'])}}</span>
                    </div>
                    <div class="desciption">
                        <span class="text--small">@lang('Users Total Bv Cut')</span>
                    </div>
                    <a href="{{route('admin.report.bvLog')}}?type=cutBV"
                       class="btn btn-sm text--small bg--white text--black box--shadow3 mt-3">@lang('View All')</a>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-4 col-sm-6 mb-30">
            <div class="dashboard-w1 bg--15 b-radius--10 box-shadow">
                <div class="icon">
                    <i class="las la-cart-arrow-down"></i>
                </div>
                <div class="details">
                    <div class="numbers">
                        <span class="amount">{{getAmount($bv['bvLeft'] + $bv['bvRight'])}}</span>
                    </div>
                    <div class="desciption">
                        <span class="text--small">@lang('Users Total BV')</span>
                    </div>
                    <a href="{{route('admin.report.bvLog')}}?type=paidBV"
                       class="btn btn-sm text--small bg--white text--black box--shadow3 mt-3">@lang('View All')</a>
                </div>
            </div>
        </div>


        <div class="col-xl-3 col-lg-4 col-sm-6 mb-30">
            <div class="dashboard-w1 bg--10 b-radius--10 box-shadow">
                <div class="icon">
                    <i class="las la-arrow-alt-circle-left"></i>
                </div>
                <div class="details">
                    <div class="numbers">
                        <span class="amount">{{getAmount($bv['bvLeft'])}}</span>
                    </div>
                    <div class="desciption">
                        <span class="text--small">@lang('Users Left BV')</span>
                    </div>
                    <a href="{{route('admin.report.bvLog')}}?type=leftBV"
                       class="btn btn-sm text--small bg--white text--black box--shadow3 mt-3">@lang('View All')</a>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-4 col-sm-6 mb-30">
            <div class="dashboard-w1 bg--3 b-radius--10 box-shadow">
                <div class="icon">
                    <i class="las la-arrow-alt-circle-right"></i>
                </div>
                <div class="details">
                    <div class="numbers">
                        <span class="amount">{{getAmount($bv['bvRight'])}}</span>
                    </div>
                    <div class="desciption">
                        <span class="text--small">@lang('Right BV')</span>
                    </div>
                    <a href="{{route('admin.report.bvLog')}}?type=rightBV" class="btn btn-sm text--small bg--white text--black box--shadow3 mt-3">@lang('View All')</a>
                </div>
            </div>
        </div> --}}
    </div>
    <div class="row mb-none-30 mt-5">
        <div class="col-xl-7 mb-30">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">@lang('Daily purchase Plan')</h5>
                    <div id="registered-line"></div>
                </div>
            </div>
        </div>
        <div class="col-xl-5 mb-30">

            <div class="card ">
                <div class="card-header">
                    <h6 class="card-title mb-0">@lang('Last Log User')</h6>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive--sm table-responsive">
                        <table class="table table--light style--two">
                            <thead>
                                <tr>
                                    <th scope="col">@lang('User')</th>
                                    <th scope="col">@lang('Username')</th>
                                    <th scope="col">@lang('Section')</th>
                                    <th scope="col">@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($latesLog as $user)
                                    <tr>
                                        <td data-label="@lang('User')">
                                            <div class="user">
                                                <div class="thumb"><img
                                                        src="{{ getImage('assets/images/user/profile/' . $user->user->image, null, true) }}"
                                                        alt="@lang('image')"></div>
                                                <span class="name">{{ $user->fullname }}</span>
                                            </div>
                                        </td>
                                        <td data-label="@lang('Username')"><a
                                                href="{{ route('admin.users.detail', $user->id) }}">{{ $user->user->username }}</a>
                                        </td>
                                        <td data-label="@lang('Email')" class="text-left">{{ $user->subject }} <br>
                                            <span style="color: #999">{{ $user->created_at->diffForHumans() }}</span>
                                        </td>
                                        <td data-label="@lang('Action')">
                                            <a href="{{ route('admin.users.detail', $user->user_id) }}" class="icon-btn"
                                                data-toggle="tooltip" title="@lang('Details')">
                                                <i class="las la-desktop text--shadow"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-muted text-center" colspan="100%">@lang('User Not Found')</td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table><!-- table end -->
                    </div>
                </div>
                <a href="#">
                    <div class="card-footer text-center">
                        See All Log User
                    </div>
                </a>
            </div>
        </div>
    </div>
    <div class="row mt-50 mb-none-30">
        <div class="col-xl-6 mb-30">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">@lang('Monthly  Deposit & Withdraw  Report')</h5>
                    <div id="apex-bar-chart"></div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 mb-30">
            <div class="row mb-none-30">
                <div class="col-lg-6 col-sm-6 mb-30">
                    <div class="widget-three box--shadow2 b-radius--5 bg--white">
                        <div class="widget-three__icon b-radius--rounded bg--success  box--shadow2">
                            <i class="las la-money-bill "></i>
                        </div>
                        <div class="widget-three__content">
                            <h2 class="numbers">{{ nb(getAmount($payment['total_deposit_amount'])) }}
                                {{ $general->cur_text }}</h2>
                            <p class="text--small">@lang('Total Deposit')</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-6 mb-30">
                    <div class="widget-three box--shadow2 b-radius--5 bg--white">
                        <div class="widget-three__icon b-radius--rounded bg--teal box--shadow2">
                            <i class="las la-money-check"></i>
                        </div>
                        <div class="widget-three__content">
                            <h2 class="numbers">{{ nb(getAmount($payment['total_deposit_charge'])) }}
                                {{ $general->cur_text }}</h2>
                            <p class="text--small">@lang('Total Deposit Charge')</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-sm-6 mb-30">
                    <div class="widget-three box--shadow2 b-radius--5 bg--white">
                        <div class="widget-three__icon b-radius--rounded bg--warning  box--shadow2">
                            <i class="las la-spinner"></i>
                        </div>
                        <div class="widget-three__content">
                            <h2 class="numbers">{{ $payment['total_deposit_pending'] }}</h2>
                            <p class="text--small">@lang('Pending Deposit')</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-6 mb-30">
                    <div class="widget-three box--shadow2 b-radius--5 bg--white">
                        <div class="widget-three__icon b-radius--rounded bg--danger box--shadow2">
                            <i class="las la-ban "></i>
                        </div>
                        <div class="widget-three__content">
                            <h2 class="numbers">{{ $payment['total_deposit_reject'] }}</h2>
                            <p class="text--small">@lang('Reject Deposit')</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- row end -->


    <div class="row mt-50 mb-none-30">
        <div class="col-xl-3 col-lg-6 col-sm-6 mb-30">
            <div class="dashboard-w1 bg--15 b-radius--10 box-shadow">
                <div class="icon">
                    <i class="fa fa-wallet"></i>
                </div>
                <div class="details">
                    <div class="numbers">
                        <span class="amount">{{ $paymentWithdraw['withdraw_method'] }}</span>
                    </div>
                    <div class="desciption">
                        <span>@lang('Withdraw Method')</span>
                    </div>
                    <a href="{{ route('admin.withdraw.method.index') }}"
                        class="btn btn-sm text--small bg--white text--black box--shadow3 mt-3">@lang('View All')</a>
                </div>
            </div>
        </div>


        <div class="col-xl-3 col-lg-6 col-sm-6 mb-30">
            <div class="dashboard-w1 bg--success b-radius--10 box-shadow">
                <div class="icon">
                    <i class="fa fa-hand-holding-usd"></i>
                </div>
                <div class="details">
                    <div class="numbers">
                        <span class="amount">{{ nb(getAmount($paymentWithdraw['total_withdraw_amount'])) }}</span>
                        <span class="currency-sign">{{ trans($general->cur_text) }}</span>
                    </div>
                    <div class="desciption">
                        <span>@lang('Total Withdraw')</span>
                    </div>
                    <a href="{{ route('admin.withdraw.approved') }}"
                        class="btn btn-sm text--small bg--white text--black box--shadow3 mt-3">@lang('View All')</a>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-sm-6 mb-30">
            <div class="dashboard-w1 bg--danger b-radius--10 box-shadow">
                <div class="icon">
                    <i class="fa fa-money-bill-alt"></i>
                </div>
                <div class="details">
                    <div class="numbers">
                        <span class="amount">{{ nb(getAmount($paymentWithdraw['total_withdraw_charge'])) }} </span>
                        <span class="currency-sign">{{ trans($general->cur_text) }}</span>
                    </div>
                    <div class="desciption">
                        <span>@lang('Total Withdraw Charge')</span>
                    </div>

                    <a href="{{ route('admin.withdraw.approved') }}"
                        class="btn btn-sm text--small bg--white text--black box--shadow3 mt-3">@lang('View All')</a>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-sm-6 mb-30">
            <div class="dashboard-w1 bg--warning b-radius--10 box-shadow">
                <div class="icon">
                    <i class="fa fa-spinner"></i>
                </div>
                <div class="details">
                    <div class="numbers">
                        <span class="amount">{{ $paymentWithdraw['total_withdraw_pending'] }}</span>
                    </div>
                    <div class="desciption">
                        <span>@lang('Withdraw Pending')</span>
                    </div>

                    <a href="{{ route('admin.withdraw.pending') }}"
                        class="btn btn-sm text--small bg--white text--black box--shadow3 mt-3">@lang('View All')</a>
                </div>
            </div>
        </div>
    </div>




    <div class="row mb-none-30 mt-5">
        <div class="col-xl-6 mb-30">
            <div class="card ">
                <div class="card-header">
                    <h6 class="card-title mb-0">@lang('New User list')</h6>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive--sm table-responsive">
                        <table class="table table--light style--two">
                            <thead>
                                <tr>
                                    <th scope="col">@lang('User')</th>
                                    <th scope="col">@lang('Username')</th>
                                    <th scope="col">@lang('Email')</th>
                                    <th scope="col">@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($latestUser as $user)
                                    <tr>
                                        <td data-label="@lang('User')">
                                            <div class="user">
                                                <div class="thumb"><img
                                                        src="{{ getImage('assets/images/user/profile/' . $user->image, null, true) }}"
                                                        alt="@lang('image')"></div>
                                                <span class="name">{{ $user->fullname }}</span>
                                            </div>
                                        </td>
                                        <td data-label="@lang('Username')"><a
                                                href="{{ route('admin.users.detail', $user->id) }}">{{ $user->username }}</a>
                                        </td>
                                        <td data-label="@lang('Email')">{{ $user->email }}</td>
                                        <td data-label="@lang('Action')">
                                            <a href="{{ route('admin.users.detail', $user->id) }}" class="icon-btn"
                                                data-toggle="tooltip" title="@lang('Details')">
                                                <i class="las la-desktop text--shadow"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-muted text-center" colspan="100%">@lang('User Not Found')</td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table><!-- table end -->
                    </div>
                </div>
            </div><!-- card end -->
        </div>
        <div class="col-xl-6 mb-30">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">@lang('Last 30 days Withdraw History')</h5>
                    <div id="withdraw-line"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-none-30 mt-5">
        <div class="col-xl-4 col-lg-6 mb-30">
            <div class="card overflow-hidden">
                <div class="card-body">
                    <h5 class="card-title">@lang('Login By Browser')</h5>
                    <canvas id="userBrowserChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-6 mb-30">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">@lang('Login By OS')</h5>
                    <canvas id="userOsChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-6 mb-30">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">@lang('Login By Country')</h5>
                    <canvas id="userCountryChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-none-30 mt-5">
        <div class="col-xl-12 col-lg-12 mb-30">
            <div class="card overflow-hidden">
                <h5 class="card-title text-center">@lang('Clauster User Address')</h5>
                <div class="card-body">
                    <div id="map" style="width: 100%; height: 500px;"></div>
                </div>
            </div>
        </div>

    </div>

    {{-- @dd($withdrawals['per_day_amount']->flatten()) --}}

    @include('admin.partials.matchingBonusModal')
@endsection

@push('breadcrumb-plugins')
    <a href="javascript:void(0)"
        class="btn @if (Carbon\Carbon::parse($general->last_cron)->diffInSeconds() < 600) btn--success @elseif(Carbon\Carbon::parse($general->last_cron)->diffInSeconds() < 1200) btn--warning @else
        btn--danger @endif "><i
            class="fa fa-fw fa-clock"></i>@lang('Last Cron Run') :
        {{ Carbon\Carbon::parse($general->last_cron)->difFforHumans() }}</a>
@endpush


@push('script')
    <script>
        const map = L.map('map').setView([-3.0038834316199865, 112.19397583513029], 5);

        const tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);
        var markers = L.markerClusterGroup({
            singleMarkerMode: true
        });

        $.ajax({
            url: "{{ url('/admin/dashboard') }}",
            cache: false,
            success: function(res) {
                $.each(res.data, function(key, val) {
                    const marker = L.marker([val.lat, val.lng]);
                    markers.addLayer(marker);

                    map.addLayer(markers);
                    map.fitBounds(markers.getBounds());
                });
            }
        });
    </script>
    <script src="{{ asset('assets/admin/js/vendor/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/vendor/chart.js.2.8.0.js') }}"></script>

    <script>
        'use strict';
        // apex-bar-chart js
        var options = {
            series: [{
                name: 'Total Deposit',
                data: [
                    @foreach ($report['months'] as $month)
                        {{ getAmount(@$depositsMonth->where('months', $month)->first()->depositAmount) }},
                    @endforeach
                ]
            }, {
                name: 'Total Withdraw',
                data: [
                    @foreach ($report['months'] as $month)
                        {{ getAmount(@$withdrawalMonth->where('months', $month)->first()->withdrawAmount) }},
                    @endforeach
                ]
            }],
            chart: {
                type: 'bar',
                height: 400,
                toolbar: {
                    show: false
                }
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '50%',
                    endingShape: 'rounded'
                },
            },
            dataLabels: {
                enabled: true
            },
            stroke: {
                show: true,
                width: 2,
                colors: ['transparent']
            },
            xaxis: {
                categories: @json($report['months']->flatten()),
            },
            yaxis: {
                title: {
                    text: "{{ __($general->cur_sym) }}",
                    style: {
                        color: '#7c97bb'
                    }
                }
            },
            grid: {
                xaxis: {
                    lines: {
                        show: false
                    }
                },
                yaxis: {
                    lines: {
                        show: false
                    }
                },
            },
            fill: {
                opacity: 1
            },
            tooltip: {
                y: {
                    formatter: function(val) {
                        return "{{ __($general->cur_sym) }}" + val + " "
                    }
                }
            }
        };

        var chart = new ApexCharts(document.querySelector("#apex-bar-chart"), options);
        chart.render();

        // apex-line chart
        var options = {
            chart: {
                height: 430,
                type: "area",
                toolbar: {
                    show: false
                },
                dropShadow: {
                    enabled: true,
                    enabledSeries: [0],
                    top: -2,
                    left: 0,
                    blur: 10,
                    opacity: 0.08
                },
                animations: {
                    enabled: true,
                    easing: 'linear',
                    dynamicAnimation: {
                        speed: 1000
                    }
                },
            },
            dataLabels: {
                enabled: false
            },
            series: [{
                name: "Series 1",
                data: @json($withdrawals['per_day_amount']->flatten())
            }],
            fill: {
                type: "gradient",
                gradient: {
                    shadeIntensity: 1,
                    opacityFrom: 0.7,
                    opacityTo: 0.9,
                    stops: [0, 90, 100]
                }
            },
            xaxis: {
                categories: @json($withdrawals['per_day']->flatten())
            },
            grid: {
                padding: {
                    left: 5,
                    right: 5
                },
                xaxis: {
                    lines: {
                        show: false
                    }
                },
                yaxis: {
                    lines: {
                        show: false
                    }
                },
            },
        };

        var chart = new ApexCharts(document.querySelector("#withdraw-line"), options);

        chart.render();

        var ctx = document.getElementById('userBrowserChart');
        var myChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: @json($chart['user_browser_counter']->keys()),
                datasets: [{
                    data: {{ $chart['user_browser_counter']->flatten() }},
                    backgroundColor: [
                        '#ff7675',
                        '#6c5ce7',
                        '#ffa62b',
                        '#ffeaa7',
                        '#D980FA',
                        '#fccbcb',
                        '#45aaf2',
                        '#05dfd7',
                        '#FF00F6',
                        '#1e90ff',
                        '#2ed573',
                        '#eccc68',
                        '#ff5200',
                        '#cd84f1',
                        '#7efff5',
                        '#7158e2',
                        '#fff200',
                        '#ff9ff3',
                        '#08ffc8',
                        '#3742fa',
                        '#1089ff',
                        '#70FF61',
                        '#bf9fee',
                        '#574b90'
                    ],
                    borderColor: [
                        'rgba(231, 80, 90, 0.75)'
                    ],
                    borderWidth: 0,

                }]
            },
            options: {
                aspectRatio: 1,
                responsive: true,
                maintainAspectRatio: true,
                elements: {
                    line: {
                        tension: 0 // disables bezier curves
                    }
                },
                scales: {
                    xAxes: [{
                        display: false
                    }],
                    yAxes: [{
                        display: false
                    }]
                },
                legend: {
                    display: false,
                }
            }
        });



        // var options = {
        //     chart: {
        //         height: 430,
        //         type: "rangeBar",
        //         toolbar: {
        //             show: false
        //         },
        //         dropShadow: {
        //             enabled: true,
        //             enabledSeries: [0],
        //             top: -2,
        //             left: 0,
        //             blur: 10,
        //             opacity: 0.08
        //         },
        //         animations: {
        //             enabled: true,
        //             easing: 'linear',
        //             dynamicAnimation: {
        //                 speed: 1000
        //             }
        //         },
        //     },
        //     dataLabels: {
        //         enabled: false
        //     },
        //     series: [{
        //         name: "Total",
        //         data: @json($registered['total'])
        //     }],
        //     fill: {
        //         type: "gradient",
        //         gradient: {
        //             shadeIntensity: 1,
        //             opacityFrom: 0.7,
        //             opacityTo: 0.9,
        //             stops: [0, 90, 100]
        //         }
        //     },
        //     xaxis: {
        //         categories: @json($registered['month'])
        //     },
        //     grid: {
        //         padding: {
        //             left: 5,
        //             right: 5
        //         },
        //         xaxis: {
        //             lines: {
        //                 show: false
        //             }
        //         },
        //         yaxis: {
        //             lines: {
        //                 show: false
        //             }
        //         },
        //     },
        // };
        var options = {
            series: [{
                name: 'Purchase',
                data: @json($registered['total'])
            }],
            annotations: {
                points: [{
                    x: 'Bananas',
                    seriesIndex: 0,
                    label: {
                        borderColor: '#775DD0',
                        offsetY: 0,
                        style: {
                            color: '#fff',
                            background: '#775DD0',
                        },
                        text: 'Bananas are good',
                    }
                }]
            },
            chart: {
                height: 350,
                type: 'bar',
            },
            plotOptions: {
                bar: {
                    columnWidth: '50%',
                }
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                width: 2
            },

            grid: {
                row: {
                    colors: ['#fff', '#f2f2f2']
                }
            },
            xaxis: {
                labels: {
                    rotate: -45
                },
                categories: @json($registered['month']),
                tickPlacement: 'on'
            },
            yaxis: {
                title: {
                    text: 'Total Purchase',
                },
            },
            fill: {
                type: 'gradient',
                gradient: {
                    shade: 'light',
                    type: "horizontal",
                    shadeIntensity: 0.25,
                    gradientToColors: undefined,
                    inverseColors: true,
                    opacityFrom: 0.85,
                    opacityTo: 0.85,
                    stops: [50, 0, 100]
                },
            }
        };
        var chart = new ApexCharts(document.querySelector("#registered-line"), options);
        chart.render();

        var ctx = document.getElementById('userOsChart');
        var myChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: @json($chart['user_os_counter']->keys()),
                datasets: [{
                    data: {{ $chart['user_os_counter']->flatten() }},
                    backgroundColor: [
                        '#ff7675',
                        '#6c5ce7',
                        '#ffa62b',
                        '#ffeaa7',
                        '#D980FA',
                        '#fccbcb',
                        '#45aaf2',
                        '#05dfd7',
                        '#FF00F6',
                        '#1e90ff',
                        '#2ed573',
                        '#eccc68',
                        '#ff5200',
                        '#cd84f1',
                        '#7efff5',
                        '#7158e2',
                        '#fff200',
                        '#ff9ff3',
                        '#08ffc8',
                        '#3742fa',
                        '#1089ff',
                        '#70FF61',
                        '#bf9fee',
                        '#574b90'
                    ],
                    borderColor: [
                        'rgba(0, 0, 0, 0.05)'
                    ],
                    borderWidth: 0,

                }]
            },
            options: {
                aspectRatio: 1,
                responsive: true,
                elements: {
                    line: {
                        tension: 0 // disables bezier curves
                    }
                },
                scales: {
                    xAxes: [{
                        display: false
                    }],
                    yAxes: [{
                        display: false
                    }]
                },
                legend: {
                    display: false,
                }
            },
        });


        // Donut chart
        var ctx = document.getElementById('userCountryChart');
        var myChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: @json($chart['user_country_counter']->keys()),
                datasets: [{
                    data: {{ $chart['user_country_counter']->flatten() }},
                    backgroundColor: [
                        '#ff7675',
                        '#6c5ce7',
                        '#ffa62b',
                        '#ffeaa7',
                        '#D980FA',
                        '#fccbcb',
                        '#45aaf2',
                        '#05dfd7',
                        '#FF00F6',
                        '#1e90ff',
                        '#2ed573',
                        '#eccc68',
                        '#ff5200',
                        '#cd84f1',
                        '#7efff5',
                        '#7158e2',
                        '#fff200',
                        '#ff9ff3',
                        '#08ffc8',
                        '#3742fa',
                        '#1089ff',
                        '#70FF61',
                        '#bf9fee',
                        '#574b90'
                    ],
                    borderColor: [
                        'rgba(231, 80, 90, 0.75)'
                    ],
                    borderWidth: 0,

                }]
            },
            options: {
                aspectRatio: 1,
                responsive: true,
                elements: {
                    line: {
                        tension: 0 // disables bezier curves
                    }
                },
                scales: {
                    xAxes: [{
                        display: false
                    }],
                    yAxes: [{
                        display: false
                    }]
                },
                legend: {
                    display: false,
                }
            }
        });
    </script>
@endpush
