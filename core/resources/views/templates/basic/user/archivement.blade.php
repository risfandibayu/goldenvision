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

        .imgUser {
            height: 100px;
            margin-top: -15px;
            display: flex;
            justify-content: center;
            margin-left: 65px;
        }

        .username {
            margin-top: 45px;
            display: flex;
            justify-content: center
        }
    </style>
@endpush

@section('panel')
    <div class="row d-flex justify-content-center text-center">
        <div class="col-md-3 col-lg-3 mb-3">
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
            <div class=" col-md-3 col-lg-3 mb-3">
                <div class="card b-radius--10 cardImages " style=" height: 15rem;width: 16rem;background-color: #1B1B19;">
                    <div class="card-body text-center" style="display: table; min-height: 15rem; overflow: hidden;">
                        <div style="display: table-cell; vertical-align: middle;">
                            <img src="{{ asset('assets/assets/badges') . '/' . $title }}" alt="">
                        </div>

                    </div>
                </div>
            </div>
        @endif
    </div>
    @if ($title)
        <div class="row d-flex justify-content-center text-center">
            <div class="col-md-12">
                <div class="card b-radius--10" style="background-color: #1B1B19;">
                    <div class="card-body text-center" style="display: table; min-height: 15rem; overflow: hidden;">
                        <div style="display: table-cell; vertical-align: middle;">
                            <img src="{{ asset('assets/assets/badges') . '/sertif-' . $title }}" alt="">
                        </div>

                    </div>
                </div>
            </div>
    @endif
@endsection
