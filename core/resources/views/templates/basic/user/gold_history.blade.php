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
                                    <th scope="col">@lang('No')</th>
                                    <th scope="col">@lang('Gold')</th>
                                    <th scope="col">@lang('Tipe')</th>
                                    <th scope="col">@lang('Time')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($logs) > 0)
                                    @foreach ($logs as $k => $data)
                                        <tr>
                                            <td data-label="#@lang('No')">{{ $k + 1 }}</td>
                                            <td data-label="#@lang('Gold')">{{ $data->golds }}</td>
                                            <td data-label="@lang('Gateway')">{{ $data->type }}</td>

                                            <td data-label="@lang('Time')">
                                                <i class="las la-calendar"></i> {{ showDateTime($data->created_at) }}
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="100%" class="text-center"> @lang('No results found')!</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
{{-- 

@push('breadcrumb-plugins')
    <form action="" method="GET" class="form-inline float-sm-right bg--white">
        <div class="input-group has_append">
            <input type="text" name="search" class="form-control" placeholder="@lang('Search by TRX')" value="{{ @$search }}">
            <div class="input-group-append">
                <button class="btn btn--primary" type="submit"><i class="fa fa-search"></i></button>
            </div>
        </div>
    </form>
@endpush --}}
