@extends('admin.layouts.app')

@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body p-0">
                    <div class="table-responsive--md table-responsive">
                        <table class="table table--light style--two">
                            <thead>
                                <tr>
                                    <th scope="col">@lang('NO')</th>
                                    {{-- <th scope="col">@lang('Code')</th> --}}
                                    <th scope="col">@lang('Username')</th>
                                    <th scope="col">@lang('Gram Emas Check In 100 hari ')</th>
                                    <th scope="col">@lang('Equal Rupiah')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($table as $key)
                                    <tr>

                                        <td data-label="@lang('No')">{{ $key['no'] }}</td>
                                        <td data-label="@lang('user')">
                                            {{ $key['username'] }}
                                        </td>
                                        <td data-label="@lang('user')">
                                            {{ $key['gold'] }}
                                        </td>
                                        <td data-label="@lang('user')">
                                            {{ nb($key['harga']) }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-muted text-center" colspan="100%">{{ __($empty_message) }}</td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                        <!-- table end -->
                    </div>
                </div>
                <div class="card-footer py-4">
                    {{-- {{ $table->links('admin.partials.paginate') }} --}}
                </div>
            </div>
        </div>
    </div>


    {{-- edit modal --}}
    <div id="edit-product" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Edit Product')</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>

                </div>
                <form method="post" action="{{ route('admin.reward.userUpdate') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        {{-- <h3 class=""></h3> --}}
                        <div class="form-row">
                            <div class="form-group col">
                                <label class="font-weight-bold"> @lang('Notes Claim User')</label>
                                <input class="form-control claim-info" readonly></input>
                            </div>

                        </div>
                        <input type="hidden" name="id" id="id">
                        <input type="hidden" name="claim" id="claim">
                        <input type="hidden" name="amount" id="amount">
                        <input type="hidden" name="user" id="user">
                        <div class="form-row">
                            <div class="form-group col">
                                <label class="font-weight-bold">
                                    @lang('Details from admin')<span class="text-danger">*</span></label>
                                <textarea name="ket" id="ket" class="form-control " cols="5" rows="5"></textarea>
                            </div>

                        </div>
                        <div class="form-row">
                            <div class="form-group col">
                                <label class="font-weight-bold">@lang('Bonus')</label>
                                <select name="status" id="status" class="form-control ">
                                    <option>Select--</option>
                                    <option value="1">Created</option>
                                    <option value="2">Bonus Send</option>
                                    <option value="3">Failed!.</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-block btn--primary">@lang('Update')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
{{-- 
@push('breadcrumb-plugins')
    <div class="row">
        <div class="col-md-6 col-6">

            <form action="{{ route('admin.reward.goldExport') }}" method="GET" class="form-inline float-sm-right">

                <button class="btn btn--primary" type="submit">Export Excel</button>
            </form>
        </div>
    </div>
@endpush --}}


@push('script')
    <script>
        "use strict";
        (function($) {
            $('.edit').on('click', function() {
                console.log();
                var modal = $('#edit-product');
                $('.claim-info').val($(this).data('selected'))
                $('#id').val($(this).data('id'));
                $('#ket').val($(this).data('ket'));
                $('#status').val($(this).data('status'));
                $('#claim').val($(this).data('claim'));
                $('#amount').val($(this).data('amount'));
                $('#user').val($(this).data('userid'));
                modal.modal('show');
            });

            $('.add-product').on('click', function() {
                var modal = $('#add-product');
                modal.modal('show');
            });
        })(jQuery);
    </script>
    <script>
        var loadFile = function(event) {
            var output = document.getElementById('output');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src)
            }
        };
    </script>
@endpush
