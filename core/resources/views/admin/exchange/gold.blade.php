@extends('admin.layouts.app')

@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card b-radius--10 ">
                <div class="card-body p-0">
                    <div class="table-responsive--sm table-responsive">
                        <table class="table table--light">
                            <thead>
                                <tr>
                                    <th scope="col">@lang('ID')</th>
                                    <th scope="col">@lang('Username')</th>
                                    <th scope="col">@lang('Gold')</th>
                                    <th scope="col">@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($items as $item)
                                    <tr>
                                        <td data-label="@lang('Product Name')">{{ $item->id }}</td>
                                        <td data-label="@lang('Product Name')">{{ $item->username }}</td>
                                        <td>{{ check100GoldID($item->id, 'daily')['type'] ? check100GoldID($item->id, 'daily')['day'] - 1 : check100GoldID($item->id, 'daily')['day'] }}
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table><!-- table end -->
                    </div>
                </div>
                <div class="card-footer py-4">
                    {{ paginateLinks($items) }}
                </div>
            </div><!-- card end -->
        </div>
    </div>
@endsection
