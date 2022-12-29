@extends($activeTemplate . 'user.layouts.app')
@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card b-radius--10 ">
                <div class="card-body p-0">
                    <div class="table-responsive--md  table-responsive">
                        <table class="table table--light style--two">
                            <thead>
                                <tr>
                                    {{-- <th scope="col">@lang('User')</th> --}}
                                    <th scope="col">@lang('Username')</th>
                                    <th scope="col">@lang('MP')</th>
                                    <th scope="col">@lang('Email')</th>
                                    <th scope="col">@lang('Phone')</th>
                                    <th scope="col">@lang('Joined At')</th>
                                    <th scope="col">@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($users as $user)
                                    <tr>
                                        {{-- <td data-label="@lang('User')">
                                            <div class="user">
                                                <div class="thumb">
                                                    <img src="{{ getImage(imagePath()['profile']['user']['path'] . '/' . $user->image, imagePath()['profile']['user']['size']) }}"
                                                        alt="@lang('image')">
                                                </div>
                                                <span class="name">{{ $user->fullname }}</span>
                                            </div>
                                        </td> --}}
                                        <td data-label="@lang('Username')"><a href="#">{{ $user->username }}</a>
                                        </td>
                                        <td data-label="@lang('MP')">
                                            @if ($user->no_bro == 0)
                                                <small>Not subscribed yet</small>
                                            @else
                                                {{ $user->no_bro }}
                                            @endif
                                        </td>
                                        <td data-label="@lang('Email')">{{ $user->email }}</td>
                                        <td data-label="@lang('Phone')">{{ $user->mobile }}</td>
                                        <td data-label="@lang('Joined At')">{{ showDateTime($user->created_at) }}</td>
                                        <td data-label="@lang('Action')">
                                            {{-- <a href="#" class="icon-btn" data-bs-toggle="modal"
                                                data-bs-target="#addSubModal">
                                                <i class="las la-desktop text--shadow"></i>
                                            </a> --}}
                                            <button type="button" class="btn btn-success btn-sm buttonAdd"
                                                data-id="{{ $user->id }}" data-username="{{ $user->username }}"
                                                data-toggle="modal" data-target="#addSubModal">Send Deposit</button>
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

    <div id="addSubModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Add / Subtract Balance')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {{-- <form action="{{ route('admin.users.addSubBalance', $user->id) }}" method="POST"> --}}
                <form action="" method="POST" id="formSubBalance">
                    @csrf
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <input type="checkbox" data-width="100%" data-height="44px" data-onstyle="-success"
                                    data-offstyle="-danger" data-toggle="toggle" data-on="Add Balance"
                                    data-off="Subtract Balance" name="act" checked>
                            </div>
                            <div class="form-group col-md-12">
                                <label>@lang('Amount')<span class="text-danger">*</span></label>
                                <div class="input-group has_append">
                                    <input type="text" name="amount" class="form-control"
                                        placeholder="Please provide positive amount">
                                    <div class="input-group-append">
                                        <div class="input-group-text">IDR</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn--dark" data-dismiss="modal">@lang('Close')</button>
                        <button type="submit" class="btn btn--success">@lang('Submit')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection



@push('breadcrumb-plugins')
    <div class="row">

        <div class="col-md-10 col-9">

            <form action="" method="GET" class="form-inline float-sm-right bg--white">
                <div class="input-group has_append">
                    <input type="text" name="search" class="form-control" placeholder="@lang('Username or email')"
                        value="{{ $src ?? '' }}">
                    <div class="input-group-append">
                        <button class="btn btn--primary" type="submit"><i class="fa fa-search"></i></button>
                    </div>
                </div>
            </form>
        </div>

    </div>
@endpush

@push('script')
    <script>
        $(document).ready(function(e) {

            $('.buttonAdd').on('click', function() {
                let userID = $(this).data('id');
                const username = $(this).data('username');
                const text = "Add / Subtract Balance to: " + username;
                $('.modal-title').html(text);
                console.log(username);
                const url = "{{ url('user/add-sub-balance') }}" + '/' + userID;
                $('.username').val(username)
                $('#exampleModalCenter').modal('hide');
                $('#formSubBalance').attr('action', url)
                $('#addSubModal').modal('show');
            })
        })
    </script>
@endpush
