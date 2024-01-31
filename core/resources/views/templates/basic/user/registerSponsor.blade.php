@extends($activeTemplate . 'user.layouts.app')

@push('style')
    <link href="{{ asset('assets/admin/css/tree.css') }}" rel="stylesheet">
    <style>
        .progress {
            height: 30px;
        }
    </style>
@endpush

@section('panel')
    {{-- <div class="card mb-4">
        <div class="card-header">
            Share Referals
        </div>
        <div class="card-body">
            <div class="form-group row">
                <label for="kiri" class="col-sm-2 col-form-label">Kiri</label>
                <div class="col-sm-10 input-group">
                    <input type="text" class="form-control" id="kiri"
                        value="{{ url('user/plan?') . 'sponsor=' . auth()->user()->no_bro . '&position=1' }}">
                    <div class="input-group-append">
                        <button type="button" class="input-group-text" id="btnKiri"> <i class="fas fa-copy mr-2"></i>
                            Salin</button>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="kiri" class="col-sm-2 col-form-label">Kanan</label>
                <div class="col-sm-10 input-group">
                    <input type="text" class="form-control" id="kanan"
                        value="{{ url('user/plan?') . 'sponsor=' . auth()->user()->no_bro . '&position=2' }}">
                    <div class="input-group-append">
                        <button type="button" class="input-group-text" id="btnKanan"> <i class="fas fa-copy mr-2"></i>
                            Salin</button>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <form action="{{ route('user.sponsorRegist.post') }}" method="POST">
        @csrf
        <div class="card">
            <div class="card-header">
                <h3>Upliners</h3>
            </div>
            <div class="card-footer">
                <div class="form-group row">
                    <label for="sponsor" class="col-sm-2 col-form-label">Sponsor</label>
                    <div class="input-group col-sm-10">
                        <input type="text" class="form-control col-md-2" id="sponsor" name="sponsor"
                            placeholder="Sponsor" value="{{ $user->no_bro }}" readonly>
                        <input type="text" class="form-control col-md-10" id="sponsor" placeholder="Username"
                            value="{{ $user->username }}" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="sponsor" class="col-sm-2 col-form-label">Upline</label>
                    <div class="input-group col-sm-10">
                        <input type="text" class="form-control col-md-2" id="upline" name="upline"
                            placeholder="upline" value="{{ session()->get('SponsorSet')['upline'] ?? '' }}" readonly>
                        <input type="text" class="form-control col-md-10" id="sponsor" placeholder="Username"
                            value="{{ $upline->username }}" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="sponsor" class="col-sm-2 col-form-label">Placement</label>
                    <div class="col-sm-10">
                        <input type="hidden" name="position" id=""
                            value="{{ session()->get('SponsorSet')['position'] }}">
                        <select name="" id="position" class="form-control" disabled>
                            <option value="1" {{ session()->get('SponsorSet')['position'] == 1 ? 'selected' : '' }}>
                                Kiri</option>
                            <option value="2"{{ session()->get('SponsorSet')['position'] == 2 ? 'selected' : '' }}>
                                Kanan</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mt-4">
            <div class="card-header">
                <h3>Registered New Users</h3>
            </div>
            <div class="card-body">
                <div class="form-group row">
                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                            name="email" value="{{ $user->email }}" placeholder="email" readonly>
                        @error('email')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="phone" class="col-sm-2 col-form-label">Phone No</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}"
                            value="{{ $user->mobile }}" name="phone" placeholder="phone" readonly>
                        @error('phone')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="username" class="col-sm-2 col-form-label">Username</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control {{ $errors->has('username') ? 'is-invalid' : '' }}"
                            value="{{ old('username') }}" name="username" placeholder="username">
                        @error('username')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <hr>

                <div class="form-group row">
                    <label for="phone" class="col-sm-2 col-form-label">Registered User
                        <br>
                        <span class="text-sm  {{ auth()->user()->pin < 1 ? 'text-danger' : 'text-primary' }}">
                            {{ auth()->user()->pin < 1 ? 'You Have No PIN' : 'You Have ' . auth()->user()->pin . ' PIN' }}
                        </span>
                    </label>
                    <div class="col-sm-10">
                        <select name="pin" id="" class="form-control">
                            <option>{{ auth()->user()->pin < 1 ? 'You Have No Pin' : 'Select' }}</option>
                            <option value="1" {{ auth()->user()->pin < 1 ? 'disabled' : '' }}
                                {{ old('pin') == 1 ? 'selected' : '' }}>1 ID</option>
                            <option value="5"
                                {{ auth()->user()->pin < 5 ? 'disabled' : '' }}{{ old('pin') == 1 ? 'selected' : '' }}>5
                                ID (1
                                Qualified)
                            </option>
                            <option value="25"
                                {{ auth()->user()->pin < 25 ? 'disabled' : '' }}{{ old('pin') == 1 ? 'selected' : '' }}>25
                                ID
                                (5 Qualified)
                            </option>
                        </select>
                        {{-- <input type="number" class="form-control {{ $errors->has('pin') ? 'is-invalid' : '' }}"
                            value="{{ old('pin') }}" name="pin" placeholder="pin"> --}}
                        @error('pin')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="card-footer text-center">
                <div class="row">
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-success btn-lg btn-block"
                            {{ auth()->user()->pin < 1 ? 'disabled' : '' }}><i class="fa fa-save"></i>
                            Submit</button>
                    </div>
                    <div class="col-md-6">
                        <a href="{{ session()->get('SponsorSet')['url'] ?? '' }}"
                            class="btn btn-warning btn-lg btn-block"><i class="fa fa-times"></i> Cancel</a>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <div class="modal fade" id="confBuyModal" class="modalPlan" tabindex="-1" role="dialog"
        aria-labelledby="myModalLabel" aria-hidden="true" data-toggle="modal" data-backdrop="static"
        data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" id="modalHeader">

                </div>
                <div id="barModal" class="d-none">
                    <div class="modal-body">
                        <div class="">
                            <img src="{{ asset('assets/spin.gif') }}" alt="loading.."
                                style=" display: block;
                                                margin-left: auto;
                                                margin-right: auto;
                                                width: 50%;">
                        </div>
                        <hr>
                        <div class="progress d-none">
                            <div id="progressBar" class="progress-bar" role="progressbar" style="width: 0%;"
                                aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                        </div>
                        <ul class="package-features-list mt-30 borderless">
                            <div id="bar">
                                <li><i class="fas fa-times bg--secondary"></i>Valiadate Input</li>
                                <li><i class="fas fa-times bg--secondary"></i>Subscribed Plan</li>
                                <li><i class="fas fa-times bg--secondary"></i>Register New User</li>
                                <li><i class="fas fa-times bg--secondary"></i>Publish Data</li>
                            </div>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        (function($) {
            "use strict";
            var bar =
                `<li><i class="fas fa-check bg--success me-3"></i>Valiadate Input</li>
                    <li><i class="fas fa-times bg--secondary"></i>Subscribed Plan</li>
                    <li><i class="fas fa-times bg--secondary"></i>Register New User</li>
                    <li><i class="fas fa-times bg--secondary"></i>Publish Data</li>`;

            var progress = 0;
            var progressBar = $('#progressBar');

            function updateProgress(percentage) {
                progress += percentage;
                progressBar.css('width', progress + '%').attr('aria-valuenow', progress).text(progress + '%');
            }

            function simulateProgress() {
                // Simulate validating data
                setTimeout(function() {
                    updateProgress(2); // 0.5 seconds
                }, 500);

                // Simulate subscribing plan
                setTimeout(function() {
                    updateProgress(3); // 0.5 seconds
                }, 1000);

                // Simulate creating user
                var userCount = 1;
                var createUserInterval = setInterval(function() {
                    updateProgress(1); // 0.3 seconds
                    if (userCount >= 5) {
                        clearInterval(createUserInterval);

                    }
                    userCount++;
                }, 200);
            }

            $('button[type="submit"]').on('click', function() {
                $('#confBuyModal').modal('show');
                setTimeout(function() {
                    $('#bar').html(bar);
                }, 2000);
                var formModal = $('#formModal');
                var barModal = $('#barModal');
                $('#modalHeader').addClass('d-none');
                formModal.addClass('d-none');
                barModal.removeClass('d-none');

                var intervalId = window.setInterval(function() {
                    simulateProgress();

                    var ariaValueNow = $('#progressBar').attr('aria-valuenow');
                    if (ariaValueNow == 10) {
                        bar =
                            `<li><i class="fas fa-check bg--success me-3"></i>Valiadate Input</li>
                    <li><i class="fas fa-check bg--success"></i>Subscribed Plan</li>
                    <li><i class="fas fa-times bg--secondary"></i>Register New User</li>
                    <li><i class="fas fa-times bg--secondary"></i>Publish Data</li>`;
                        $('#bar').html(bar);

                    }
                    if (ariaValueNow == 20) {
                        bar =
                            `<li><i class="fas fa-check bg--success me-3"></i>Valiadate Input</li>
                    <li><i class="fas fa-check bg--success"></i>Subscribed Plan</li>
                    <li><i class="fas fa-check bg--success"></i>Register New User</li>
                    <li><i class="fas fa-times bg--secondary"></i>Publish Data</li>`;
                        $('#bar').html(bar);

                    }
                    if (ariaValueNow == 80) {
                        bar =
                            `<li><i class="fas fa-check bg--success me-3"></i>Valiadate Input</li>
                    <li><i class="fas fa-check bg--success"></i>Subscribed Plan</li>
                    <li><i class="fas fa-check bg--success"></i>Register New User</li>
                    <li><i class="fas fa-check bg--success"></i>Publish Data</li>`;
                        $('#bar').html(bar);

                    }
                    if (ariaValueNow == 90) {
                        clearInterval(intervalId);
                    }

                }, 5000);
            });

        })(jQuery);
    </script>
@endpush
