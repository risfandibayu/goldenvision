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
                            <th scope="col">@lang('Name')</th>
                            <th scope="col">@lang('Price')</th>
                            <th scope="col">@lang('Type')</th>
                            <th scope="col">@lang('Qty')</th>
                            <th scope="col">@lang('Total')</th>
                            <th scope="col">@lang('Weight Total')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($gold as $gd)
                            <tr>
                                <td data-label="@lang('Name')">{{$gd->name}}</td>
                                <td data-label="@lang('Price')">{{$gd->price}}</td>
                                <td data-label="@lang('Type')">{{$gd->weight}}</td>
                                <td data-label="@lang('Qty')">{{$gd->qty}}</td>
                                <td data-label="@lang('Total')">{{$gd->total_rp}} IDR</td>
                                <td data-label="@lang('Weight Total')">{{$gd->total_wg}} gr</td>

                            </tr>
                        @empty
                            <tr>
                                <td class="text-muted text-center" colspan="100%">{{ __($empty_message) }}</td>
                            </tr>
                        @endforelse

                        </tbody>
                    </table><!-- table end -->
                </div>
            </div>
            <div class="card-footer py-4">
                {{ $gold->links($activeTemplate .'user.partials.paginate') }}
            </div>
        </div><!-- card end -->
    </div>


</div>
@endsection

@push('script')

@endpush
