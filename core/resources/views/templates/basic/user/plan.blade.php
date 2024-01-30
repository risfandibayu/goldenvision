@extends($activeTemplate . 'user.layouts.app')

@section('panel')
    <div class="row mb-none-30 d-flex justify-content-center">

        @foreach ($plans as $data)
            <div class="col-xl-4 col-md-6 mb-30">
                <div class="card">
                    <div class="card-body pt-5 pb-5 ">
                        <div class="pricing-table text-center mb-4">
                            <h2 class="package-name mb-20 text-"><strong>@lang($data->name)</strong></h2>
                            <span
                                class="price text--dark font-weight-bold d-block">{{ $general->cur_sym }}{{ nb(getAmount($data->price)) }}</span>
                            <p>/ MP</p>
                            <hr>
                            Use Your {{ auth()->user()->pin }} PIN to buy
                            <hr>
                            <ul class="package-features-list mt-30">
                                {{-- <li><i class="fas fa-check bg--success"></i> <span>@lang('Business Volume (BV)'):
                                {{getAmount($data->bv)}}</span> <span class="icon" data-toggle="modal"
                                data-target="#bvInfoModal"><i class="fas fa-question-circle"></i></span></li>
                        <li><i class="fas fa-check bg--success"></i> <span> @lang('Referral Commission'):
                                {{$general->cur_sym}} {{getAmount($data->ref_com)}} </span>
                            <span class="icon" data-toggle="modal" data-target="#refComInfoModal"><i
                                    class="fas fa-question-circle"></i></span>
                        </li> --}}
                                <li>
                                    <i
                                        class="fas @if (getAmount($data->tree_com) != 0) fa-check bg--success @else fa-times bg--danger @endif "></i>
                                    <span>@lang('Referal Commission'): {{ $general->cur_sym }} {{ nb(getAmount($data->ref_com)) }}
                                    </span>
                                    {{-- <span class="icon" data-toggle="modal" data-target="#treeComInfoModal"><i
                                            class="fas fa-question-circle"></i></span> --}}
                                </li>

                            </ul>
                        </div>
                        @if (Auth::user()->plan_id != $data->id)
                            <a href="#confBuyModal{{ $data->id }}" data-toggle="modal"
                                class="btn w-100 btn-outline--primary  mt-20 py-2 box--shadow1">@lang('Subscribe')</a>
                        @else
                            <a data-toggle="modal"
                                class="btn w-100 btn-outline--primary  mt-20 py-2 box--shadow1">@lang('Already
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    Subscribe')</a>
                            {{-- <a href="#confBuyMP{{ $data->id }}" data-toggle="modal"
                                class="btn  w-100 btn--primary  mt-20 py-2 box--shadow1">@lang('Buy MP')</a> --}}
                        @endif
                    </div>


                    <div class="modal fade" id="confBuyModal{{ $data->id }}" tabindex="-1" role="dialog"
                        aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel"> @lang('Confirm Purchase ' . $data->name)?</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                            aria-hidden="true">×</span></button>
                                </div>
                                <form method="post" action="{{ route('user.plan.purchase') }}">
                                    {{-- <form method="post"> --}}
                                    {{-- <div class="modal-body"> --}}
                                    {{-- </div> --}}
                                    @csrf
                                    <div class="modal-body row">
                                        <h5 class="text-center col-12">
                                            <span class="text-success"> Use Your {{ auth()->user()->pin }} PIN to
                                                buy</span>
                                        </h5>
                                        <input type="hidden" name="prices" value="{{ getAmount($data->price) }}">
                                        <input type="hidden" name="plan_id" value="{{ $data->id }}">
                                        <div class="form-group col-6">
                                            <label for="ref_name" class="form--label-2">@lang('Package')</label>
                                            <select name="package" id="gold"
                                                class="package form-control form--control-2">
                                                <option>{{ auth()->user()->pin < 1 ? 'You Have No Pin' : 'Select' }}
                                                </option>
                                                <option value="1" {{ auth()->user()->pin < 1 ? 'disabled' : '' }}
                                                    {{ old('pin') == 1 ? 'selected' : '' }}>1 ID</option>
                                                <option value="5"
                                                    {{ auth()->user()->pin < 5 ? 'disabled' : '' }}{{ old('pin') == 1 ? 'selected' : '' }}>
                                                    5 ID (1
                                                    Qualified)
                                                </option>
                                                <option value="25"
                                                    {{ auth()->user()->pin < 25 ? 'disabled' : '' }}{{ old('pin') == 1 ? 'selected' : '' }}>
                                                    25 ID
                                                    (5 Qualified)
                                                </option>
                                            </select>
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="">total</label>
                                            <input class="form-control" type="number" name="total"
                                                value="{{ getAmount($data->price) }}" placeholder="total" disabled>
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="">QTY</label>
                                            <input class="form-control" type="number" name="qty" id="qty"
                                                min="1" value="" placeholder="MP qty" required>
                                        </div>

                                        {{-- <div class="col-6">
                                            <label for="ref_name"
                                                class="form--label-2">@lang('Referral MP Number (Upline)')<small>(Optional)</small></label>
                                            <input type="text" name="referral"
                                                class="referral form-control form--control-2" value="{{ old('referral') }}"
                                                id="up_name" placeholder="@lang('Enter Upline MP Number')">
                                        </div> --}}


                                        <div class="col-6">
                                            <label for="ref_name" class="form--label-2">@lang('Sponsor Username')</label>
                                            <input type="text" name="sponsor"
                                                class="referral form-control form--control-2"
                                                value="{{ app('request')->input('sponsor') ?? old('sponsor') }}"
                                                id="ref_name" placeholder="@lang('Enter Sponsor Username')*" required>
                                        </div>

                                        {{-- <div class="col-6">
                                            <label for="ref_name" class="form--label-2">@lang('Select Position')</label>
                                            <select name="position" class="position form-control form--control-2"
                                                id="position" required
                                                {{ !app('request')->input('position') ?? 'disabled' }}>
                                                <option value="">@lang('Select position')*</option>
                                                @foreach (mlmPositions() as $k => $v)
                                                    <option
                                                        value="{{ $k }}"{{ app('request')->input('position') == $k ? 'selected' : '' }}>
                                                        @lang($v)</option>
                                                @endforeach
                                            </select>
                                            <span id="position-test">
                                                <span class="text-danger">
                                                    @if (!app('request')->input('position') && !old('position'))
                                                        @lang('Please enter referral MP Number first')
                                                    @endif
                                                </span>
                                            </span>
                                        </div> --}}
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn--danger" data-dismiss="modal"><i
                                                class="fa fa-times"></i>
                                            @lang('Close')</button>

                                        <button type="submit" class="btn btn--success"><i
                                                class="lab la-telegram-plane"></i>
                                            @lang('Subscribe')</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>


                    <div class="modal fade" id="bvInfoModal">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">@lang('Business Volume (BV) info')</h5>
                                    <button type="button" class="close" data-dismiss="modal"
                                        aria-label="@lang('Close')">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <h5 class="text-danger">@lang('When someone from your below tree subscribe this plan, You will get this
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        Business Volume which will be used for matching bonus').
                                    </h5>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn--dark"
                                        data-dismiss="modal">@lang('Close')</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="confBuyMP{{ $data->id }}" tabindex="-1" role="dialog"
                        aria-labelledby="myModalLabel1" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel1"> @lang('Confirm Purchase MP')?</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                            aria-hidden="true">×</span></button>
                                </div>
                                <form method="post" action="{{ route('user.plan.mppurchase') }}">
                                    {{-- <form method="post"> --}}
                                    {{-- <div class="modal-body"> --}}
                                    {{-- </div> --}}
                                    @csrf
                                    <div class="modal-body row">
                                        <h5 class="text-center col-12"> {{ getAmount($data->price) }}
                                            {{ $general->cur_text }} / MP
                                            <br>
                                            or
                                            <br>
                                            <span class="text-success">Use Your {{ auth()->user()->pin }} PIN to
                                                buy</span>
                                        </h5>
                                        <input type="hidden" name="pricess" value="{{ getAmount($data->price) }}">
                                        <input type="hidden" name="plan_id" value="{{ $data->id }}">
                                        <div class="form-group col-6">
                                            <label for="">QTY</label>
                                            <input class="form-control" type="number" name="qtyy" id="qty"
                                                min="1" value="" placeholder="MP qty" required>
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="">total</label>
                                            <input class="form-control" type="number" name="totall" value=""
                                                placeholder="total" disabled>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn--danger" data-dismiss="modal"><i
                                                class="fa fa-times"></i>
                                            @lang('Close')</button>

                                        <button type="submit" class="btn btn--success"><i
                                                class="lab la-telegram-plane"></i> @lang('Buy')</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
        @endforeach



        <div class="modal fade" id="refComInfoModal">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">@lang('Referral Commission info')</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h5><span class=" text-danger">@lang('When your referred user subscribe in') <b> @lang('ANY PLAN')</b>,
                                @lang('you will get this amount').</span>
                            <br>
                            <br>
                            <span class="text-success"> @lang('This is the reason you should choose a plan with bigger referral
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    commission').</span>
                        </h5>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn--dark" data-dismiss="modal">@lang('Close')</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="treeComInfoModal">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">@lang('Commission to tree info')</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h5 class=" text-danger">@lang('When someone from your below tree subscribe this plan, You will get this
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            amount as tree commission'). </h5>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn--dark" data-dismiss="modal">@lang('Close')</button>
                    </div>
                </div>
            </div>
        </div>
    @endsection
    @push('script')
        <script>
            $('input[name=qty]').on('keyup change', function() {
                // alert('okl');
                $('input[name=total]').val($('input[name=qty]').val() * $('input[name=prices]').val());
            });
        </script>
        <script>
            $('input[name=qtyy]').on('keyup change', function() {
                // alert('okl');
                $('input[name=totall]').val($('input[name=qtyy]').val() * $('input[name=pricess]').val());
            });
        </script>

        <script>
            (function($) {
                "use strict";

                var oldPosition = '{{ old('position') }}';

                if (oldPosition) {
                    $('select[name=position]').removeAttr('disabled');
                    $('#position').val(oldPosition);
                }
                $('.package').on('change', function() {
                    const pack = $(this).val();
                    $('input[name=qty]').val(pack);
                    $('input[name=total]').val(pack * $('input[name=prices]').val());
                    console.log(pack * harga);
                });
                var not_select_msg = $('#position-test').html();

                $(document).on('blur', '#ref_name', function() {
                    var ref_id = $('#ref_name').val();
                    var token = "{{ csrf_token() }}";
                    $.ajax({
                        type: "POST",
                        url: "{{ route('check.referralbro') }}",
                        data: {
                            'ref_id': ref_id,
                            '_token': token
                        },
                        success: function(data) {
                            if (data.success) {
                                $('select[name=position]').removeAttr('disabled');
                                $('#position-test').text('');
                            } else {
                                $('select[name=position]').attr('disabled', true);
                                $('#position-test').html(not_select_msg);
                            }
                            $("#ref").html(data.msg);
                        }
                    });
                });

                $(document).on('change', '#position', function() {
                    updateHand();
                });

                function updateHand() {
                    var pos = $('#position').val();
                    var referrer_id = $('#referrer_id').val();
                    var token = "{{ csrf_token() }}";
                    $.ajax({
                        type: "POST",
                        url: "{{ route('get.user.position') }}",
                        data: {
                            'referrer': referrer_id,
                            'position': pos,
                            '_token': token
                        },
                        error: function(data) {
                            $("#position-test").html(data.msg);
                        }
                    });
                }

                @if (@$country_code)
                    $(`option[data-code={{ $country_code }}]`).attr('selected', '');
                @endif
                $('select[name=country_code]').change(function() {
                    $('input[name=country]').val($('select[name=country_code] :selected').data('country'));
                }).change();

                function submitUserForm() {
                    var response = grecaptcha.getResponse();
                    if (response.length == 0) {
                        document.getElementById('g-recaptcha-error').innerHTML =
                            '<span style="color:red;">@lang('Captcha field is required.')</span>';
                        return false;
                    }
                    return true;
                }

                function verifyCaptcha() {
                    document.getElementById('g-recaptcha-error').innerHTML = '';
                }

                @if ($general->secure_password)
                    $('input[name=password]').on('input', function() {
                        var password = $(this).val();
                        var capital = /[ABCDEFGHIJKLMNOPQRSTUVWXYZ]/;
                        var capital = capital.test(password);
                        if (!capital) {
                            $('.capital').removeClass('text--success');
                        } else {
                            $('.capital').addClass('text--success');
                        }
                        var number = /[123456790]/;
                        var number = number.test(password);
                        if (!number) {
                            $('.number').removeClass('text--success');
                        } else {
                            $('.number').addClass('text--success');
                        }
                        var special = /[`!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?~]/;
                        var special = special.test(password);
                        if (!special) {
                            $('.special').removeClass('text--success');
                        } else {
                            $('.special').addClass('text--success');
                        }

                    });
                @endif


            })(jQuery);
        </script>
    @endpush
