@extends('templates/basic/layouts/landing', [
    'title' => 'Verif Code',
    'bodyClass' => 'login-bg',
])

@section('css')
    <style>
        .login-bg {
            background: url('/assets/landing/img/login-bg.jpg') no-repeat center fixed;
            background-size: cover;
            object-fit: contain;
        }
    </style>
@endsection

@section('content')
    <div class="section">
        <div class="section-1400 padding-top-bottom-120">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-lg-7 col-xl-5">
                        <div
                            class="section py-4 py-md-5 px-3 px-sm-4 px-lg-5 over-hide border-4 section-shadow-blue bg-white section-background-24 background-img-top form">
                            <form class="account--form g-4" method="post" action="{{ route('user.password.verify-code') }}">
                                @csrf
                                <input type="hidden" name="username" value="{{ $username }}">

                                <h4 class="mb-4 text-sm-center">
                                    Verification Code.
                                </h4>
                                {{-- <div class="col-sm-12">
                                    <label for="username" class="form--label-2">@lang('Your Name')</label>
                                    <select class="form-control form--control-2" name="type">
                                        <option value="email">@lang('E-Mail Address')</option>
                                        <option value="username">@lang('Username')</option>
                                    </select>
                                </div> --}}
                                <div class=" mt-3 form-group">
                                    <input type="text" class="form-style form-style-with-icon"
                                        placeholder="@lang('Enter Code..')" autocomplete="off" name="code"
                                        pattern="[0-9]*"maxlength="6">

                                    <i class="input-icon uil uil-user-check"></i>
                                </div>

                                {{-- <div class="row mt-3">
                                    <div class="col pr-0">
                                        <div class="form-group">
                                            <input type="checkbox" id="checkbox" checked>
                                            <label class="checkbox mb-0 font-weight-500 size-15" for="checkbox">Stay signed in</label>
                                        </div>
                                    </div>
                                    <div class="col-auto align-self-center text-right pl-0">
                                        <a href="recovery.html" class="link link-gray-primary size-15 font-weight-500 animsition-link" data-hover="Forgot password?">Forgot password?</a>
                                    </div>
                                </div> --}}
                                <div class="row mt-4">
                                    <div class="col-12 text-sm-center">
                                        <button type="submit" class="btn btn-dark-primary">Submit<i
                                                class="uil uil-arrow-right size-22 ml-3"></i></button>
                                    </div>
                                </div>

                                <div class="mt-4 text-center">
                                    @lang('Please check including your Junk/Spam Folder. if not found, you can')
                                    <a href="{{ route('user.password.request') }}" class="text--base">
                                        @lang('Try to send again')
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script type="text/javascript">
        $('select[name=type]').change(function() {
            $('.my_value').text($('select[name=type] :selected').text());
        }).change();
    </script>
@endpush
