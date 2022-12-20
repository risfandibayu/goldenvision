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
                                <th scope="col">@lang('#')</th>
                                <th scope="col">@lang('Ticket ID')</th>
                                <th scope="col">@lang('Reward')</th>
                                <th scope="col">@lang('MP Kiri')</th>
                                <th scope="col">@lang('MP Kanan')</th>
                                <th scope="col">@lang('Action')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($reward  as $ex)
                                <tr>
                                    <td data-label="@lang('#')">{{ $reward->firstItem()+$loop->index }}</td>
                                    <td data-label="@lang('Reward')">{{ $ex->trx }}</td>
                                    <td data-label="@lang('Reward')">{{ $ex->rewa->reward }}</td>
                                    <td data-label="@lang('MP Kiri')">{{ $ex->rewa->kiri }}</td>
                                    <td data-label="@lang('MP Kanan')">{{ $ex->rewa->kanan }}</td>
                                    <td data-label="@lang('Action')">
                                        <a class="btn btn--success" href="{{ route('user.ticket.print', $ex->id) }}" target="_blank" class="print"><i class="las la-print"></i></a>
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
                    {{ $reward->appends($_GET)->links() }}
                </div>
            </div>
        </div>
    </div>

@endsection