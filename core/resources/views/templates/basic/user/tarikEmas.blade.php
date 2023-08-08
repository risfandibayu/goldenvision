@extends($activeTemplate . 'user.layouts.app')

@section('panel')
    <div class="row">
        <div class="col-md-3  mb-3 d-flex  justify-content-center text-center ">
            <div class="card b-radius--10 cardImages {{ $user->userExtra->is_gold ? 'gold' : 'silver' }}">
                <div class="card-body text-center" style="display: table; min-height: 15rem; overflow: hidden;">
                    <div style="display: table-cell; vertical-align: middle;">
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
                <div class="card b-radius--10 cardImages {{ 'reward-' . $item->reward_id }}">
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
                            @if ($item->reward_id == 1)
                                <img class="imgTurkie"
                                    src="{{ getImage('assets/images/user/profile/' . auth()->user()->image, null, true) }}"
                                    alt="@lang('image')">
                                <span class="usernameTurkie text-dark">{{ $user->username }}</span>
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
