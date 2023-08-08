@extends($activeTemplate . 'user.layouts.app')

@section('panel')
    <div class="row">

        <div class="col-lg-12">
            <div class="card b-radius--10 ">
                <div class="card-body p-0">
                    <div class="table-responsive--sm table-responsive">
                        <table class="table table--light style--two">
                            <thead>
                            <tr>
                                <th scope="col">@lang('SL')</th>
                                <th scope="col">@lang('Time')</th>
                                <th scope="col">@lang('Delivery ID')</th>
                                <th scope="col">@lang('Product')</th>
                                <th scope="col">@lang('Qty')</th>
                                <th scope="col">@lang('Address')</th>
                                <th scope="col">@lang('Weight')</th>
                                {{-- <th scope="col">@lang('Amount')</th> --}}
                                <th scope="col">@lang('Shipping Cost')</th>
                                {{-- <th scope="col">@lang('Charge')</th> --}}
                                {{-- <th scope="col">@lang('Post QTY')</th> --}}
                                <th scope="col">@lang('Status')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($delivery  as $ex)
                                <tr>
                                    <td data-label="@lang('SL')">{{ $delivery->firstItem()+$loop->index }}</td>
                                    <td data-label="@lang('Date')">{{ showDateTime($ex->created_at) }}</td>
                                    <td data-label="@lang('Delivery ID')">{{ $ex->trx }}</td>
                                    <td data-label="@lang('Product')">
                                        @if ($ex->is_custom == 1)
                                        {{ $ex->cname }}
                                        @else
                                        {{ $ex->pname }}
                                        @endif
                                    </td>
                                    <td data-label="@lang('Qty')">{{ nb($ex->qty) }}</td>
                                    <td data-label="@lang('Address')">{{ Str::limit($ex->alamat,40) }}</td>
                                    <td data-label="@lang('Weight')">{{ nbk($ex->pweight * $ex->qty) }} gr</td>
                                    <td data-label="@lang('Shipping Cost')">{{ nb($ex->ongkir) }}</td>
                                    <td data-label="@lang('Status')">
                                        @if($ex->status == 1)
                                            <span class="badge badge--success">@lang('Complete. On Delivery')</span>
                                        @elseif($ex->status == 2)
                                            <span class="badge badge--warning">@lang('Pending')</span>
                                        @elseif($ex->status == 3)
                                            <span class="badge badge--danger">@lang('Cancel')</span>
                                        @endif
                                        @if($ex->no_resi != null)
                                                <button class="btn--info btn-rounded  badge detailBtn"
                                                        data-no_resi="{{$ex->no_resi}}"><i
                                                        class="fa fa-info"></i></button>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-muted text-center" colspan="100%">{{ __($empty_message) }}</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer py-4">
                    {{ $delivery->appends($_GET)->links() }}
                </div>
            </div>
        </div>
    </div>

    <div id="detailModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Details')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="@lang('Close')">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Nomor Resi : <span class="withdraw-detail"></span></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn--danger" data-dismiss="modal">@lang('Close')</button>
                </div>
            </div>
        </div>
    </div>

@endsection


{{-- @push('breadcrumb-plugins')
    <form action="" method="GET" class="form-inline float-sm-right bg--white">
        <div class="input-group has_append">
            <input type="text" name="search" class="form-control" placeholder="@lang('Search by TRX')" value="{{ $search ?? '' }}">
            <div class="input-group-append">
                <button class="btn btn--primary" type="submit"><i class="fa fa-search"></i></button>
            </div>
        </div>
    </form>
@endpush --}}

@push('script')
    <script>
        $('.detailBtn').on('click', function () {
                var modal = $('#detailModal');
                var feedback = $(this).data('no_resi');
                modal.find('.withdraw-detail').html(feedback);
                modal.modal('show');
        });
    </script>
@endpush

