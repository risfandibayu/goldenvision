@extends('admin.layouts.app')
@section('panel')
    <div class="row mb-none-30">
        <div class="col-xl-4 col-md-6 mb-30">
            <div class="card b-radius--10 overflow-hidden box--shadow1">
                <div class="card-body">
                    <ul class="list-group">
                        
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Order ID')
                            <span class="font-weight-bold">{{ $corder->trx }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Date')
                            <span class="font-weight-bold">{{ showDateTime($corder->created_at) }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Order ID')
                            <span class="font-weight-bold">{{ $corder->user->username }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Design Name')
                            <span class="font-weight-bold">{{ $corder->name }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Product Weight')
                            <span class="font-weight-bold">{{ $corder->prod->weight }} gr</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('QTY')
                            <span class="font-weight-bold">{{ $corder->qty }} pieces</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Total (gr)')
                            <span class="font-weight-bold">{{ $corder->qty * $corder->prod->weight }} gr</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Total (Rp)')
                            <span class="font-weight-bold">Rp. {{ nb($corder->qty * $corder->prod->price) }} </span>
                        </li>
                        
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Status')
                            @if($corder->status == 2)
                                            <span class="badge badge--warning">@lang('Pending')</span>
                                        @elseif($corder->status == 1)
                                            <span class="badge badge--success">@lang('Complete')</span>
                                        @elseif($corder->status == 3)
                                            <span class="badge badge--primary">@lang('Accepted. On Process')</span>
                                        @elseif($corder->status == 4)
                                            <span class="badge badge--danger">@lang('Rejected')</span>
                                        @endif
                        </li>
                        @if($corder->admin_feedback)
                            <li class="list-group-item">
                                <strong>@lang('Admin Response')</strong>
                                <br>
                                <p>{{__($corder->admin_feedback)}}</p>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-xl-8 col-md-6 mb-30">
            <div class="card b-radius--10 overflow-hidden box--shadow1">
                <div class="card-body">
                    <h5 class="card-title mb-50 border-bottom pb-2">@lang('Custom Order Design Information')</h5>
                    {{-- @if($details != null)
                        @foreach(json_decode($details) as $k => $val)
                            @if($val->type == 'file')
                                <div class="row mt-4">
                                    <div class="col-md-8">
                                        <h6>{{inputTitle($k)}}</h6>
                                        <img src="{{getImage('assets/images/verify/deposit/'.$val->field_name)}}" alt="@lang('Image')">
                                    </div>
                                </div>
                            @else
                                <div class="row mt-4">
                                    <div class="col-md-12">
                                        <h6>{{inputTitle($k)}}</h6>
                                        <p>{{__($val->field_name)}}</p>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @endif --}}
                    <div class="row col-md-12 mb-50">
                        <div class="col-md-6">
                            <label class="form-control-label font-weight-bold">Front Design</label>
                            <div class="">
                                <img src="{{ getImage('assets/images/cproduct/f/'. $corder->front, null, true)}}"
                                    alt="Front" class="b-radius--10 w-100">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-control-label font-weight-bold">Back Design</label>
                            <div class="">
                                <img src="{{ getImage('assets/images/cproduct/b/'. $corder->back, null, true)}}"
                                    alt="Back" class="b-radius--10 w-100">
                            </div>
                        </div>
                    </div>
                    @if($corder->status == 2)
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <button class="btn btn--success ml-1 approveBtn"
                                        data-id="{{ $corder->id }}"
                                        
                                        data-username="{{ @$corder->user->username }}"
                                        data-toggle="tooltip" data-original-title="@lang('Approve')"><i class="fas fa-check"></i>
                                    @lang('Approve')
                                </button>

                                <button class="btn btn--danger ml-1 rejectBtn"
                                        data-id="{{ $corder->id }}"
                                        
                                        data-username="{{ @$corder->user->username }}"
                                        data-toggle="tooltip" data-original-title="@lang('Reject')"><i class="fas fa-ban"></i>
                                    @lang('Reject')
                                </button>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>


    {{-- APPROVE MODAL --}}
    <div id="approveModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Approve Custom Order Confirmation')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('admin.corder.approve')}}" method="POST">
                    @csrf
                    <input type="hidden" name="id">
                    <div class="modal-body">
                        <p>@lang('Are you sure to') <span class="font-weight-bold">@lang('approve')</span> <span class="font-weight-bold withdraw-amount text-success"></span> @lang('Custom Order of') <span class="font-weight-bold withdraw-user"></span>?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn--dark" data-dismiss="modal">@lang('Close')</button>
                        <button type="submit" class="btn btn--success">@lang('Approve')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- REJECT MODAL --}}
    <div id="rejectModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Reject Custom Order Confirmation')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.corder.reject')}}" method="POST">
                    @csrf
                    <input type="hidden" name="id">
                    <div class="modal-body">
                        <p>@lang('Are you sure to') <span class="font-weight-bold">@lang('reject')</span> <span class="font-weight-bold withdraw-amount text-success"></span> @lang('Custom Order of') <span class="font-weight-bold withdraw-user"></span>?</p>

                        <div class="form-group">
                            <label class="font-weight-bold mt-2">@lang('Reason for Rejection')</label>
                            <textarea name="ket" id="message" placeholder="@lang('Reason for Rejection')" class="form-control" rows="5"></textarea>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn--dark" data-dismiss="modal">@lang('Close')</button>
                        <button type="submit" class="btn btn--danger">@lang('Reject')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    
@endsection

@push('script')
    <script>
        'use strict';
        (function($){
            $('.approveBtn').on('click', function () {
                var modal = $('#approveModal');
                modal.find('input[name=id]').val($(this).data('id'));
                modal.find('.withdraw-amount').text($(this).data('amount'));
                modal.find('.withdraw-user').text($(this).data('username'));
                modal.modal('show');
            });

            $('.rejectBtn').on('click', function () {
                var modal = $('#rejectModal');
                modal.find('input[name=id]').val($(this).data('id'));
                modal.find('.withdraw-amount').text($(this).data('amount'));
                modal.find('.withdraw-user').text($(this).data('username'));
                modal.modal('show');
            });
        })(jQuery)
    </script>
@endpush
