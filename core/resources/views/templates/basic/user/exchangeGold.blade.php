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
                                <th scope="col">@lang('Exchange ID')</th>
                                <th scope="col">@lang('Product')</th>
                                <th scope="col">@lang('Qty')</th>
                                <th scope="col">@lang('Weight')</th>
                                <th scope="col">@lang('Amount')</th>
                                {{-- <th scope="col">@lang('Charge')</th> --}}
                                {{-- <th scope="col">@lang('Post QTY')</th> --}}
                                <th scope="col">@lang('Status')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($exchange  as $ex)
                                <tr>
                                    <td data-label="@lang('SL')">{{ $exchange->firstItem()+$loop->index }}</td>
                                    <td data-label="@lang('Date')">{{ showDateTime($ex->created_at) }}</td>
                                    <td data-label="@lang('Exchange ID')">{{ $ex->ex_id }}</td>
                                    <td data-label="@lang('Product')">{{ $ex->name }}</td>
                                    <td data-label="@lang('Qty')">{{ nb($ex->qty) }}</td>
                                    <td data-label="@lang('Weight')">{{ nbk($ex->wei) }} gr</td>
                                    <td data-label="@lang('Amount')">{{ nb($ex->total) }} IDR</td>
                                    <td data-label="@lang('Status')">
                                        @if($ex->status == 2)
                                            <span class="badge badge--success">@lang('Complete')</span>
                                        @elseif($ex->status == 1)
                                            <span class="badge badge--warning">@lang('Pending')</span>
                                        @elseif($ex->status == 3)
                                            <span class="badge badge--danger">@lang('Cancel')</span>
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
                    {{ $exchange->appends($_GET)->links() }}
                </div>
            </div>
        </div>
    </div>

@endsection


@push('breadcrumb-plugins')
    <form action="" method="GET" class="form-inline float-sm-right bg--white">
        <div class="input-group has_append">
            <input type="text" name="search" class="form-control" placeholder="@lang('Search by TRX')" value="{{ $search ?? '' }}">
            <div class="input-group-append">
                <button class="btn btn--primary" type="submit"><i class="fa fa-search"></i></button>
            </div>
        </div>
    </form>
@endpush

