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
            max-width: 100px;
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
    </style>
@endpush
@extends($activeTemplate . 'user.layouts.app')

@section('panel')
    <div class="card">
        <div class="card-body card-rad ">
            <div class="row">
                @foreach ($logs as $item)
                    <div class="col-lg-4">
                        <div class="card b-radius--10 bg-blue mb-3 mt-2">
                            <div class="card-body">
                                <div class="row dis">
                                    <div class="col-md-4 col-sm-4">
                                        <img src="{{ asset('assets/hand.png') }}" alt="hands-icon" class="icons">
                                    </div>
                                    <div class="col-md-8 col-sm-8 text-center">
                                        <h3 class="mt-2 text-gold text-on"> Hari {{ $item->day }} </h3>
                                        <h3 class="mt-2 text-prima text-on">
                                            {{ date('d/m/Y', strtotime($item->created_at)) }}</h3>
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
