@extends($activeTemplate . 'user.layouts.app')
@push('style')
    <style>
        .cardImages {
            height: 15rem;
            width: 16rem;
            background-color: #141214;
        }

        .cardImages.gold {
            background-image: url("{{ asset('assets/assets/badges/member-gold.jpeg') }}");
            background-repeat: no-repeat;
            background-size: 100% 100%;
        }

        .cardImages.silver {
            background-image: url("{{ asset('assets/assets/badges/member-silver.jpeg') }}");
            background-repeat: no-repeat;
            background-size: 100% 100%;
        }

        .cardImages.phone {
            background-image: url("{{ asset('assets/assets/badges/phone-bonus-sertif.jpeg') }}");
            background-repeat: no-repeat;
            background-size: 100% 100%;
        }

        .cardImages.trip {
            background-image: url("{{ asset('assets/assets/badges/reward-monthly.jpeg') }}");
            background-repeat: no-repeat;
            background-size: 100% 100%;
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

        .sertif {
            height: 45rem;
            /* width: 16rem; */
            background-color: #141214;
        }

        .sertif.masterGold {
            background-image: url("{{ asset('assets/assets/badges/sertif-title-mg.jpeg') }}");
            background-repeat: no-repeat;
            background-size: 100% 100%;
        }

        .imgUser {
            height: 100px;
            margin-top: -15px;
            display: flex;
            justify-content: center;
            margin-left: 65px;
        }

        .imgPhone {
            height: 100px;
            margin-top: -28px;
            display: flex;
            justify-content: center;
            /* margin-left: 30; */
            margin-left: 105px;
        }

        .username {
            margin-top: 45px;
            display: flex;
            justify-content: center
        }

        .usernamePhone {
            /* margin-top: 15px; */
            display: flex;
            justify-content: center;
            margin-left: 90px;
            /* color: white; */
        }

        .imgTrip {
            height: 70px;
            margin-top: -3%;
            display: flex;
            justify-content: center;
            /* margin-left: 30; */
            margin-left: 140px;
        }

        .usernameTrip {
            /* margin-top: 45px; */
            display: flex;
            justify-content: center;
            margin-left: 120px;

        }
    </style>
@endpush

@section('panel')
    <div class="row">
        <div class="col-md-3  mb-3 d-flex  justify-content-center text-center ">
            <div class="card b-radius--10 cardImages {{ $user->userExtra->is_gold ? 'gold' : 'silver' }}">
                <div class="card-body text-center" style="display: table; min-height: 15rem; overflow: hidden;">
                    <div style="display: table-cell; vertical-align: middle;">
                        {{-- @if ($user->userExtra->is_gold)
                            <img src="{{ }}" alt="">
                        @else
                            <img src="{{ asset('assets/assets/badges/member-silver.jpeg') }}" alt="">
                        @endif --}}
                        <img class="rounded-circle imgUser"
                            src="{{ getImage('assets/images/user/profile/' . auth()->user()->image, null, true) }}"
                            alt="@lang('image')">
                        <span class="username text-dark">{{ $user->username }}</span>
                    </div>

                </div>
            </div>
        </div>
        @if ($title)
            <div class="col-md-3  mb-3 d-flex  justify-content-center text-center ">
                <div class="card b-radius--10 cardImages {{ $title }}">
                    <div class="card-body text-center" style="display: table; min-height: 15rem; overflow: hidden;">
                        <div style="display: table-cell; vertical-align: middle;">
                            {{-- <img src="{{ asset('assets/assets/badges') . '/' . $title }}" alt=""> --}}
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @foreach ($bonus as $item)
            <div class="col-md-3  mb-3 d-flex  justify-content-center text-center ">
                <div class="card b-radius--10 cardImages {{ $item->reward_id == 3 ? 'phone' : 'trip' }}">
                    <div class="card-body text-center" style="display: table; min-height: 15rem; overflow: hidden;">
                        <div style="display: table-cell; vertical-align: middle;">
                            @if ($item->reward_id == 3)
                                <img class="rounded-circle imgPhone"
                                    src="{{ getImage('assets/images/user/profile/' . auth()->user()->image, null, true) }}"
                                    alt="@lang('image')">
                                <span class="usernamePhone text-light">{{ $user->username }}</span>
                            @endif
                            @if ($item->reward_id == 4)
                                <img class="imgTrip"
                                    src="{{ getImage('assets/images/user/profile/' . auth()->user()->image, null, true) }}"
                                    alt="@lang('image')">
                                <span class="usernameTrip text-dark">{{ $user->username }}</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        @if ($title)
            <div class="col-md-12">
                <div class="card b-radius--10 sertif {{ $title }}">
                    <div class="card-body text-center" style="display: table; min-height: 15rem; overflow: hidden;">
                        <div style="display: table-cell; vertical-align: middle;">
                            {{-- <img src="{{ asset('assets/assets/badges') . '/sertif-' . $title }}" alt=""> --}}
                        </div>

                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
