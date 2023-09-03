@push('css')
    <style>
        @media (min-width: 320px) and (max-width: 480px) {
            .text-on {
                font-size: 30px;
            }

            .icons {
                max-width: 60px;
            }

        }

        @media (min-width: 481px) and (max-width: 767px) {

            .text-on {
                font-size: 30px;
            }

            .icons {
                max-width: 60px;
            }
        }


        .icons {
            max-width: 60px;
        }

        .card-rad {
            border-radius: 20px;
            background-color: #202c3c;
        }

        .bg-blue {
            background-color: rgb(37, 51, 71);
        }

        .text-prima {
            color: #6ecbc3;
        }

        .text-gold {
            color: #e5a548;
        }

        .card-content {
            display: flex;
            justify-content: center;
        }
    </style>
@endpush
@extends($activeTemplate . 'user.layouts.app')

@section('panel')
    @if (typeClaimGold(auth()->user()) == 'weekly')
        <div class="card mb-4">
            <div class="card-body card-rad ">
                <h3 class="text-light">Weekly Claim</h3>

                <div class="row d-flex justify-content-center">
                    @foreach ($logs_week as $item)
                        {{-- @dd($item['day']) --}}
                        <div class="col-md-4 col-sm-3">
                            <div class="card b-radius--10 bg-blue mb-3 mt-2">
                                <div class="card-body card-content">
                                    <div class="row dis">
                                        <div class="col-md-4 col-sm-4 text-center">
                                            <img src="{{ asset('assets/gold-ico.png') }}" alt="hands-icon" class="icons">
                                            <span class="text-gold text-on"> {{ nbk($item['gold']) }} gr</span>
                                        </div>
                                        <div class="col-md-8 col-sm-8 text-center">
                                            <h3 class="mt-2 text-gold text-on"> Minggu {{ $item['day'] }} </h3>
                                            <h3 class="mt-2 text-prima text-on">
                                                {{ tanggal($item['created_at']) }}</h3>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    @endif
    <div class="card">
        <div class="card-body card-rad ">
            <h3 class="text-light">Daily Claim</h3>

            <div class="row d-flex justify-content-center">
                @foreach ($logs_day as $item)
                    {{-- @dd($item['day']) --}}
                    <div class="col-md-4 col-sm-3">
                        <div class="card b-radius--10 bg-blue mb-3 mt-2">
                            <div class="card-body card-content">
                                <div class="row dis">
                                    <div class="col-md-4 col-sm-4 text-center">
                                        <img src="{{ asset('assets/gold-ico.png') }}" alt="hands-icon" class="icons">
                                        <span class="text-gold text-on"> {{ nbk($item['gold']) }} gr</span>
                                    </div>
                                    <div class="col-md-8 col-sm-8 text-center">
                                        <h3 class="mt-2 text-gold text-on"> Hari {{ $item['day'] }} </h3>
                                        <h3 class="mt-2 text-prima text-on">
                                            {{ tanggal($item['created_at']) }}</h3>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
@endsection
{{-- 

@push('breadcrumb-plugins')
    <form action="" method="GET" class="form-inline float-sm-right bg--white">
        <div class="input-group has_append">
            <input type="text" name="search" class="form-control" placeholder="@lang('Search by TRX')" value="{{ @$search }}">
            <div class="input-group-append">
                <button class="btn btn--primary" type="submit"><i class="fa fa-search"></i></button>
            </div>
        </div>
    </form>
@endpush --}}
