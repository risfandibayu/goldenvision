@extends($activeTemplate . 'user.layouts.app')
@section('panel')
    <div class="row  mt-2">
        <div class="col-md-4 col-lg-4 mb-8">
            <div class="card b-radius--10 " style="min-height: 16rem;">
                <div class="card-body text-center" style="display: table; min-height: 16rem; overflow: hidden;">
                    <div style="display: table-cell; vertical-align: middle;">
                        <h3>Available Balance</h3>
                        <h1 class="display-4 font-weight-bold">{{ nb(auth()->user()->balance) }}</h1>
                    </div>
                </div>
            </div>
        </div>
        @foreach ($withdrawMethod as $data)
            <div class="col-md-4 col-lg-4 mb-4">
                <div class="card card-deposit method-card b-radius--10" style="min-height: 16rem;">
                    <h5 class="card-header text-center">{{ __($data->name) }}</h5>
                    <div class="card-body card-body-deposit">
                        {{-- <img src="{{getImage(imagePath()['withdraw']['method']['path'].'/'. $data->image)}}"
                                class="card-img-top w-100" alt="{{__($data->name)}}"> --}}
                        <div class="deposit-content">
                            <ul class="text-center font-15">
                                <li>
                                    @lang('Limit')
                                    : <span class="text--success"> {{ nb(getAmount($data->min_limit)) }}
                                        - {{ nb(getAmount($data->max_limit)) }} {{ $general->cur_text }}</li></span>

                                <li>
                                    @lang('Charge') -
                                    <span class="text--danger">
                                        {{ nb(getAmount($data->fixed_charge)) }} {{ $general->cur_text }}
                                        + {{ getAmount($data->percent_charge) }}%
                                    </span>
                                </li>
                                <li>
                                    @lang('Processing Time')
                                    - <span class="text--info">
                                        {{ $data->delay }}</li>
                                </span>
                            </ul>
                        </div>
                        <a href="javascript:void(0)" data-id="{{ $data->id }}" data-resource="{{ $data }}"
                            data-min_amount="{{ getAmount($data->min_limit) }}"
                            data-max_amount="{{ getAmount($data->max_limit) }}"
                            data-fix_charge="{{ getAmount($data->fixed_charge) }}"
                            data-percent_charge="{{ getAmount($data->percent_charge) }}"
                            data-base_symbol="{{ $general->cur_text }}" class="btn btn-block  btn--success deposit"
                            data-toggle="modal" data-target="#exampleModal">
                            @lang('Withdraw Now')</a>
                    </div>
                </div>
            </div>
        @endforeach

    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title method-name" id="exampleModalLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('user.withdraw.money') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="hidden" name="currency" class="edit-currency form-control" value="">
                            <input type="hidden" name="method_code" class="edit-method-code  form-control" value="">
                        </div>
                        <div class="form-group">
                            <div class="deposit-content">
                                <ul class="text-center font-15">
                                    <li>
                                        @lang('Available Balance')
                                        :<span class="text--info">
                                            Rp {{ nb(auth()->user()->balance) }}</li>
                                    <li>
                                        @lang('Limit')
                                        : <span class="text--success"> {{ nb(getAmount($data->min_limit)) }}
                                            - {{ nb(getAmount($data->max_limit)) }} {{ $general->cur_text }}</li></span>
                                    <li>
                                        @lang('Charge') -
                                        <span class="text--danger">
                                            {{ nb(getAmount($data->fixed_charge)) }} {{ $general->cur_text }}
                                            + {{ getAmount($data->percent_charge) }}%
                                        </span>
                                    </li>
                                    <li>
                                        @lang('Processing Time')
                                        - <span class="text--info">
                                            {{ $data->delay }}</li>
                                    <li>
                                        @lang('Enter Amount'):</li>
                                    </span>
                                </ul>
                            </div>
                            <div class="input-group">
                                <input id="amount" type="text" class="form-control form-control-lg"
                                    onkeyup="this.value = this.value.replace (/^\.|[^\d\.]/g, '')" name="amount"
                                    placeholder="0.00" required="" value="{{ old('amount') }}">
                                <div class="input-group-append">
                                    <span class="input-group-text currency-addon">{{ __($general->cur_text) }}</span>
                                </div>
                            </div>
                        </div>
                        <p class="text-danger text-center depositLimit"></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn--secondary" data-dismiss="modal">@lang('Close')</button>
                        <button type="submit" class="btn btn--success">@lang('Confirm')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        'use strict';
        (function($) {
            $('.deposit').on('click', function() {
                var id = $(this).data('id');
                var result = $(this).data('resource');
                var minAmount = $(this).data('min_amount');
                var maxAmount = $(this).data('max_amount');
                var fixCharge = $(this).data('fix_charge');
                var percentCharge = $(this).data('percent_charge');

                var depositLimit = `@lang('Withdraw Limit:') ${minAmount} - ${maxAmount}  {{ $general->cur_text }}`;
                $('.depositLimit').text(depositLimit);
                var depositCharge =
                    `@lang('Charge:') ${fixCharge} {{ $general->cur_text }} ${(0 < percentCharge) ? ' + ' + percentCharge + ' %' : ''}`
                $('.depositCharge').text(depositCharge);
                $('.method-name').text(`@lang('Withdraw Via ') ${result.name}`);
                $('.edit-currency').val(result.currency);
                $('.edit-method-code').val(result.id);
            });
        })(jQuery)
    </script>
@endpush
