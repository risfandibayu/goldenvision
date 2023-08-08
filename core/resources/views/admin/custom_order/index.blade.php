@extends('admin.layouts.app')

@section('panel')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card b-radius--10">
            <div class="card-body p-0">
                <div class="table-responsive--sm table-responsive">
                    <table class="table table--light style--two">
                        <thead>
                            <tr>
                                <th scope="col">@lang('Order ID')</th>
                                <th scope="col">@lang('Date')</th>
                                <th scope="col">@lang('User')</th>
                                <th scope="col">@lang('Custom Design Name')</th>
                                <th scope="col">@lang('Type')</th>
                                <th scope="col">@lang('QTY')</th>
                                <th scope="col">@lang('Total')</th>
                                <th scope="col">@lang('Status')</th>
                                <th scope="col">@lang('Action')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($corder as $item)
                            <tr>
                                <td data-label="@lang('Date')"> {{ $item->trx }}</td>
                                <td data-label="@lang('Date')"> {{ showDateTime($item->created_at) }}</td>
                                <td data-label="@lang('Username')"><a
                                        href="{{ route('admin.users.detail', $item->user->id) }}">{{$item->user->username}}</a>
                                </td>
                                <td data-label="@lang('Date')"> {{ $item->name }}</td>
                                <td data-label="@lang('Date')"> {{ $item->prod->weight }} gr</td>
                                <td data-label="@lang('Date')"> {{ $item->qty }} pieces</td>
                                <td data-label="@lang('Date')">Rp. {{ nb($item->qty * $item->prod->price) }}</td>
                                <td data-label="@lang('Status')">
                                    @if($item->status == 2)
                                    <span class="badge badge--warning">@lang('Pending')</span>
                                    @elseif($item->status == 1)
                                    <span class="badge badge--success">@lang('Complete')</span>
                                    @elseif($item->status == 3)
                                    <span class="badge badge--primary">@lang('Accepted. On Process')</span>
                                    @elseif($item->status == 4)
                                    <span class="badge badge--danger">@lang('Rejected')</span>
                                    @endif
                                </td>

                                <td data-label="@lang('Action')">
                                    <div class="row">
                                        @if ($item->status == 3)
                                            
                                            <div class="col-6">
                                                <button data-id="{{$item->id}}"
                                                    class="icon-btn ml-1 upds" data-toggle="tooltip" title=""
                                                    data-original-title="@lang('Update Status')">
                                                    <i class="la la-pencil"></i>
                                                </button>
                                            </div>
                                        @else
                                        <div class="col-6">
                                        </div>
                                        @endif
                                        <div class="col-6">
                                            <a href="{{ route('admin.corder.details', $item->id) }}"
                                                class="icon-btn ml-1 " data-toggle="tooltip" title=""
                                                data-original-title="@lang('Detail')">
                                                <i class="la la-eye"></i>
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table><!-- table end -->
                </div>
            </div>
        </div><!-- card end -->
    </div>
</div>

<div id="updateModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">@lang('Update Order Status')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('admin.corder.update')}}" method="POST">
                @csrf
                <input type="hidden" name="id">
                <div class="modal-body">
                    <p>@lang('Are you sure to') <span class="font-weight-bold">@lang('update status')</span> <span class="font-weight-bold withdraw-amount text-success"></span> @lang('Custom Order to ') <span class="font-weight-bold">@lang('Complete')</span>?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn--dark" data-dismiss="modal">@lang('Close')</button>
                    <button type="submit" class="btn btn--success">@lang('Update')</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection




@push('script-lib')
<script src="{{ asset('assets/admin/js/vendor/datepicker.min.js') }}"></script>
<script src="{{ asset('assets/admin/js/vendor/datepicker.en.js') }}"></script>

@endpush

@push('script')
<script>
    'use strict';
        (function ($) {
            if (!$('.datepicker-here').val()) {
                $('.datepicker-here').datepicker();
            };
            $('.upds').on('click', function () {
                var modal = $('#updateModal');
                modal.find('input[name=id]').val($(this).data('id'));
                modal.modal('show');
            });

        })(jQuery)
</script>
@endpush