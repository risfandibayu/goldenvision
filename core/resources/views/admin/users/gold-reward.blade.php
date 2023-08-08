@extends('admin.layouts.app')
@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card b-radius--10 ">
                <div class="card-body p-0">
                    <div class="table-responsive--md  table-responsive">
                        <table class="table table--light style--two">
                            <thead>
                            <tr>
                                <th scope="col">@lang('User')</th>
                                <th scope="col">@lang('Username')</th>
                                <th scope="col">@lang('Email')</th>
                                <th scope="col">@lang('Daily Gold')</th>
                                <th scope="col">@lang('Weekly Gold')</th>
                                <th scope="col">@lang('Action')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($users as $user)
                            <tr>
                                <td data-label="@lang('User')">
                                        <span class="name">{{$user->fr}} {{$user->ls}}</span>
                                </td>
                                <td data-label="@lang('Username')"><a href="{{ route('admin.users.detail', $user->id) }}">{{ $user->username }}</a></td>
                                <td data-label="@lang('Email')">{{ $user->email }}</td>
                                <td data-label="@lang('Daily Gold')">{{ $user->total_daily_golds }} gr</td>
                                <td data-label="@lang('Weekly Gold')">{{ $user->total_weekly_golds }} gr</td>
                                <td data-label="@lang('Action')">
                                    @if ($user->total_weekly_golds < 0.50 && $user->daily_golds_count == 100)
                                        <a href="{{ route('admin.users.reward.add-gold', $user->id) }}" class="icon-btn" data-toggle="tooltip" data-original-title="@lang('Give Gold Reward')">
                                            <i class="las la-plus-circle text--shadow"></i>
                                        </a>
                                    @endif
                                </td>
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
                    {{ paginateLinks($users) }}
                </div>
            </div><!-- card end -->
        </div>


    </div>
@endsection



@push('breadcrumb-plugins')
<div class="row">

    <div class="col-md-10 col-9">
    <form action="{{ route('admin.users.reward.gold')}}" method="GET" class="form-inline float-sm-right bg--white mr-2">
        <div class="input-group has_append">
            <input type="text" name="search" class="form-control" placeholder="@lang('Username or email')" value="{{ $search ?? '' }}">
            <div class="input-group-append">
                <button class="btn btn--primary" type="submit"><i class="fa fa-search"></i></button>
            </div>
        </div>
    </form>
</div>
{{-- <div class="col-md-2 col-3">
    <form action="{{ route('admin.invest.gdetail.export') }}" method="GET" class="form-inline float-sm-right  bg--white">
        <input hidden type="text" name="search" class="form-control" placeholder="@lang('Username or email')" value="{{ $search ?? '' }}">
        <button class="btn btn--primary" type="submit">Export</button>
    </form>
</div> --}}
</div>
@endpush
