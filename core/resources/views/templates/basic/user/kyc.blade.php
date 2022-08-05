@extends($activeTemplate . 'user.layouts.app')

@section('panel')

    <div class="row mb-none-30">
        

        <div class="col-xl-12 col-lg-12 col-md-12 col-12 mb-30">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-50 border-bottom pb-2">{{auth()->user()->fullname}} @lang('Information')</h5>

                    <form action="{{route('user.submitVerification')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group ">
                                    <label class="form-control-label font-weight-bold">@lang('First Name') <span
                                            class="text-danger">*</span></label>
                                    <input class="form-control form-control-lg" type="text" name="firstname"
                                           value="{{auth()->user()->firstname}}" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label  font-weight-bold">@lang('Last Name') <span
                                            class="text-danger">*</span></label>
                                    <input class="form-control form-control-lg" type="text" name="lastname" value="{{auth()->user()->lastname}}" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group ">
                                    <label class="form-control-label font-weight-bold">@lang('No BRO')<span class="text-danger">*</span></label>
                                    <input class="form-control form-control-lg" type="email" value="{{auth()->user()->no_bro}}" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group ">
                                    <label class="form-control-label font-weight-bold">@lang('Email')<span class="text-danger">*</span></label>
                                    <input class="form-control form-control-lg" type="email" value="{{auth()->user()->email}}" readonly>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label  font-weight-bold">@lang('Mobile Number')<span
                                            class="text-danger">*</span></label>
                                    <input class="form-control form-control-lg" type="text"
                                           value="{{auth()->user()->mobile}}" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label  font-weight-bold">@lang('Avatar')</label>
                                    <input class="form-control form-control-lg" type="file" accept="image/*"  onchange="loadFile(event)" name="image">
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <div class="form-group ">
                                    <label class="form-control-label font-weight-bold">@lang('Address')<span
                                        class="text-danger">*</span> </label>
                                    <input class="form-control form-control-lg" type="text" name="address"
                                           value="{{auth()->user()->address->address}}" required>
                                    <small class="form-text text-muted"><i
                                            class="las la-info-circle"></i>@lang('House number, street address')
                                    </small>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label font-weight-bold">@lang('City')<span
                                        class="text-danger">*</span></label>
                                    <input class="form-control form-control-lg" type="text" name="city"
                                           value="{{auth()->user()->address->city}}" required>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="form-group ">
                                    <label class="form-control-label font-weight-bold">@lang('State')<span
                                        class="text-danger">*</span></label>
                                    <input class="form-control form-control-lg" type="text" name="state"
                                           value="{{auth()->user()->address->state}}" required>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="form-group ">
                                    <label class="form-control-label font-weight-bold">@lang('Zip/Postal')<span
                                        class="text-danger">*</span></label>
                                    <input class="form-control form-control-lg" type="text" name="zip"
                                           value="{{auth()->user()->address->zip}}" required>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="form-group ">
                                    <label class="form-control-label font-weight-bold">@lang('Country')<span
                                        class="text-danger">*</span></label>
                                    <select name="country" class="form-control form-control-lg" required> @include('partials.country') </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-xl-6 col-md-6 col-12">
                                <div class="form-group ">
                                    <label class="form-control-label font-weight-bold">National ID/Passport ID<span
                                        class="text-danger">*</span></label>
                                    <input class="form-control form-control-lg" value="{{auth()->user()->nik}}" type="text" name="nik"
                                            required>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-3 col-12">
                                <div class="form-group ">
                                    <label class="form-control-label font-weight-bold">National ID/Passport ID Photo<span
                                        class="text-danger">*</span></label>
                                        <input class="form-control form-control-lg" type="file" accept="image/*"  onchange="loadFile(event)" name="ktp" required>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-3 col-12">
                                <div class="form-group ">
                                    <label class="form-control-label font-weight-bold">Selfie with National ID/Passport ID<span
                                        class="text-danger">*</span></label>
                                        <input class="form-control form-control-lg" type="file" accept="image/*"  onchange="loadFile(event)" name="selfie" required>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn--primary btn-block btn-lg">@lang('Save Changes')</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('breadcrumb-plugins')
    <a href="{{route('user.change-password')}}" class="btn btn--success btn--shadow"><i class="fa fa-key"></i>@lang('Change Password')</a>
@endpush



@push('script')
    <script>
        'use strict';
        (function($){
            $("select[name=country]").val("{{ auth()->user()->address->country }}");
        })(jQuery)

        var loadFile = function(event) {
            var output = document.getElementById('output');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src)
            }
        };


    </script>
@endpush
