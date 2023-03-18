@extends($activeTemplate . 'user.layouts.app')

@push('style')
    <link href="{{ asset('assets/admin/css/tree.css') }}" rel="stylesheet">
@endpush

@section('panel')
    {{-- <div class="card mb-4">
        <div class="card-header">
            Share Referals
        </div>
        <div class="card-body">
            <div class="form-group row">
                <label for="kiri" class="col-sm-2 col-form-label">Kiri</label>
                <div class="col-sm-10 input-group">
                    <input type="text" class="form-control" id="kiri"
                        value="{{ url('user/plan?') . 'sponsor=' . auth()->user()->no_bro . '&position=1' }}">
                    <div class="input-group-append">
                        <button type="button" class="input-group-text" id="btnKiri"> <i class="fas fa-copy mr-2"></i>
                            Salin</button>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="kiri" class="col-sm-2 col-form-label">Kanan</label>
                <div class="col-sm-10 input-group">
                    <input type="text" class="form-control" id="kanan"
                        value="{{ url('user/plan?') . 'sponsor=' . auth()->user()->no_bro . '&position=2' }}">
                    <div class="input-group-append">
                        <button type="button" class="input-group-text" id="btnKanan"> <i class="fas fa-copy mr-2"></i>
                            Salin</button>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <div class="card">

        {{-- <div class=" row">
            <div class="col-md-11 col-8"></div>

            <a href="{{ url()->previous() }}" style="margin-left: -19px;margin-top:5px;" class="col-md-1 col-4 btn btn--secondary">Back</a>
        </div> --}}
        <div class="active-user-none" data-id="{{ auth()->user()->id }}"></div>
        <div class="row text-center justify-content-center llll">
            <!-- <div class="col"> -->
            <div class="w-1 ">
                @php echo showSingleUserinTree($tree['a']); @endphp
            </div>
        </div>
        <div class="row text-center justify-content-center llll">
            <!-- <div class="col"> -->
            <div class="w-2 ">
                @php echo showSingleUserinTree($tree['b']); @endphp
            </div>
            <!-- <div class="col"> -->
            <div class="w-2 ">
                @php echo showSingleUserinTree($tree['c']); @endphp
            </div>
        </div>
        <div class="row text-center justify-content-center llll">
            <!-- <div class="col"> -->
            <div class="w-4  ">
                @php echo showSingleUserNoLine($tree['d']); @endphp
            </div>
            <!-- <div class="col"> -->
            <div class="w-4  ">
                @php echo showSingleUserNoLine($tree['e']); @endphp
            </div>
            <!-- <div class="col"> -->
            <div class="w-4  ">
                @php echo showSingleUserNoLine($tree['f']); @endphp
            </div>
            <!-- <div class="col"> -->
            <div class="w-4  ">
                @php echo showSingleUserNoLine($tree['g']); @endphp
            </div>
            <!-- <div class="col"> -->

        </div>
        {{-- <div class="row text-center justify-content-center llll">
            <!-- <div class="col"> -->
            <div class="w-8 ">
                @php echo showSingleUserinTree($tree['h']); @endphp
            </div>
            <!-- <div class="col"> -->
            <div class="w-8 ">
                @php echo showSingleUserinTree($tree['i']); @endphp
            </div>
            <!-- <div class="col"> -->
            <div class="w-8 ">
                @php echo showSingleUserinTree($tree['j']); @endphp
            </div>
            <!-- <div class="col"> -->
            <div class="w-8 ">
                @php echo showSingleUserinTree($tree['k']); @endphp
            </div>
            <!-- <div class="col"> -->
            <div class="w-8 ">
                @php echo showSingleUserinTree($tree['l']); @endphp
            </div>
            <!-- <div class="col"> -->
            <div class="w-8 ">
                @php echo showSingleUserinTree($tree['m']); @endphp
            </div>
            <!-- <div class="col"> -->
            <div class="w-8 ">
                @php echo showSingleUserinTree($tree['n']); @endphp
            </div>
            <!-- <div class="col"> -->
            <div class="w-8 ">
                @php echo showSingleUserinTree($tree['o']); @endphp
            </div>
        </div> --}}

    </div>


    <div class="modal fade user-details-modal-area" id="exampleModalCenter" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">@lang('User Details')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="@lang('Close')">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="user-details-modal">
                        <div class="user-details-header ">
                            <div class="thumb">
                                <img src="#" alt="*" class="tree_image w-h-100-p">

                            </div>
                            <div class="content">
                                <a class="user-name tree_url tree_name" href=""></a>
                                <strong style="    font-size: 19px;
                                font-weight: bolder;"
                                    class="user-status tree_bro"></strong>
                                <br>
                                <span class="user-status tree_email"></span>
                                <br>
                                <span class="user-status tree_phone"></span>
                                <br>

                                <span class="user-status tree_status"></span>
                                <span class="user-status tree_plan mb-3"></span>


                            </div>

                        </div>
                        <div class="user-details-body text-center">

                            {{-- <h6 class="my-3">@lang('Referred By'): <span class="tree_ref"></span></h6> --}}


                            <table class="table table-bordered">
                                <tr>
                                    <th>
                                    </th>
                                    <th>@lang('LEFT')</th>
                                    <th>@lang('RIGHT')</th>
                                </tr>

                                {{-- <tr>
                                    <td>@lang('Current BV')</td>
                                    <td><span class="lbv"></span></td>
                                    <td><span class="rbv"></span></td>
                                </tr> --}}
                                {{-- <tr>
                                    <td>@lang('Free Member')</td>
                                    <td><span class="lfree"></span></td>
                                    <td><span class="rfree"></span></td>
                                </tr> --}}

                                <tr>
                                    <td>@lang('MP Member')</td>
                                    <td><span class="lpaid"></span></td>
                                    <td><span class="rpaid"></span></td>
                                </tr>
                            </table>
                            {{-- <hr> --}}
                            {{-- <span class="mt-4">
                                <div class="form-group d-none" id="is_true">
                                    <label class="form-control-label font-weight-bold">@lang('Stockiest Status')
                                    </label><br>
                                    <input type="checkbox" id="is_stockiest_true" data-width="100%"
                                        data-onstyle="-success" data-offstyle="-danger" data-toggle="toggle"
                                        data-on="Active" data-off="Deactive" name="is_stockiest" checked>
                                </div>
                                <div class="form-group d-none" id="is_false">
                                    <label class="form-control-label font-weight-bold">@lang('Stockiest Status')
                                    </label><br>
                                    <input type="checkbox" id="is_stockiest_false" data-width="100%"
                                        data-onstyle="-success" data-offstyle="-danger" data-toggle="toggle"
                                        data-on="Active" data-off="Deactive" name="is_stockiest">
                                </div>
                            </span> --}}
                            <hr>
                            <a href="#" class="mt-4 btn btn--warning btn-block btn-sm btnAddSubs">Send Pin</a>
                            <hr>
                            <a href="" class=" btn btn--primary btn-block btn-sm tree_url">See Tree</a>
                            <hr>
                            <form action="{{ route('user.sponsor.set') }}" method="POST" id="formAddDownline"
                                class="d-none">
                                @csrf
                                <input type="hidden" name="back" value="{{ Request::url() }}">
                                <input type="hidden" name="upline" id="upline">
                                <select name="postion" id="position" class="form-select form-control">
                                    <option selected disabled>--Select Position</option>
                                    <option value="1" id="s_kiri">Kiri</option>
                                    <option value="2" id="s_kanan">Kanan</option>
                                </select>
                                <button type="submit" class=" btn btn--success btn-block btn-sm mt-2">Add
                                    Downline</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="addSubModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Send PIN')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {{-- <form action="{{ route('admin.users.addSubBalance', $user->id) }}" method="POST"> --}}
                <form action="" method="POST" id="formSubBalance">
                    @csrf
                    <div class="modal-body">
                        <div class="form-row">
                            {{-- <div class="form-group col-md-12">
                                <input type="checkbox" data-width="100%" data-height="44px" data-onstyle="-success"
                                    data-offstyle="-danger" data-toggle="toggle" data-on="Add Balance"
                                    data-off="Subtract Balance" name="act" checked>
                            </div> --}}


                            <div class="form-group col-md-12">
                                <label>@lang('PIN')<span class="text-danger">*</span> <span class="text-secondary">
                                        <br>
                                        Sisa Pin =
                                        {{ auth()->user()->pin }}</span></label>
                                <div class="input-group has_append">
                                    <input type="text" name="pin" class="form-control"
                                        placeholder="Please provide positive amount">
                                    <div class="input-group-append">
                                        <div class="input-group-text">PIN</div>
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

@push('script')
    <script>
        "use strict";
        (function($) {
            const userID = $('.active-user-none').data('id');

            $('.showDetails').on('click', function() {
                var modal = $('#exampleModalCenter');
                let id = $(this).data('id');
                $('#is_stockiest_true').attr('data-id');
                $('#is_stockiest_false').attr('data-id');
                $('#is_true').addClass('d-none');
                $('#is_false').addClass('d-none');
                if (id == userID) {
                    $('.btnAddSubs').addClass('d-none');
                } else {
                    $('.btnAddSubs').removeClass('d-none');
                }
                $('.tree_name').text($(this).data('name'));
                $('.tree_url')
                    .attr({
                        "href": $(this).data('treeurl')
                    });
                $('.tree_status').text($(this).data('status'));
                $('.tree_plan').text($(this).data('plan'));
                $(
                    '.tree_phone').text('+' + $(this).data('mobile'));
                $('.tree_email').text($(this).data(
                    'email'));
                $('.tree_bro').text($(this).data('bro'));
                $('.tree_image').attr({
                    "src": $(this).data('image')
                });
                $('.user-details-header').removeClass('Paid');
                $('.user-details-header').removeClass('Free');
                $('.user-details-header').addClass($(this).data('status'));
                $('.tree_ref').text($(this).data(
                    'refby'));
                $('.lbv').text($(this).data('lbv'));
                $('.rbv').text($(this).data('rbv'));
                $('.lpaid')
                    .text($(this).data('lpaid'));
                $('.rpaid').text($(this).data('rpaid'));
                $('.lfree').text($(this)
                    .data('lfree'));
                $('.rfree').text($(this).data('rfree'));
                $('#exampleModalCenter').modal(
                    'show');
                $('.btnAddSubs').attr('data-id', id);
                $('#is_stockiest_true').attr('data-id', id);
                $('#is_stockiest_false').attr('data-id', id);

                const is_stockiest = $(this).data('is_stockiest');
                if (is_stockiest) {
                    $('#is_true').removeClass('d-none');
                    $('#is_false').addClass('d-none');
                } else {
                    $('#is_true').addClass('d-none');
                    $('#is_false').removeClass('d-none');

                }
                const kiri = $(this).data('lpaid');
                const kanan = $(this).data('rpaid');
                if (kiri < 1 || kanan < 1) {
                    $('#formAddDownline').removeClass('d-none');
                    $('#upline').val($(this).data('bro'));
                    if (kiri > 0) {
                        $('#s_kiri').attr('disabled', 'disabled');
                    }
                    if (kanan > 0) {
                        $('#s_kanan').attr('disabled', 'disabled');
                    }
                } else {
                    $('#formAddDownline').addClass('d-none');
                }

            });
            $('.btnAddSubs').on('click', function() {
                let userID = $(this).data('id');
                const url = "{{ url('user/send-pin') }}" + '/' + userID;

                $('#exampleModalCenter').modal('hide');
                $('#addSubModal').modal('show');
                $('#formSubBalance').attr('action', url)
            })
            $('#is_stockiest_true').on('change', function() {
                const status = 0;
                const id = $(this).data('id');
                $.ajax({
                    url: "{{ url('user/update-stockiest') }}" + '/' + id,
                    cache: false,
                    success: function(rs) {
                        location.reload();
                    }
                });
            })
            $('#is_stockiest_false').on('change', function() {
                const status = 1;
                const id = $(this).data('id');
                $.ajax({
                    url: "{{ url('user/update-stockiest') }}" + '/' + id,
                    cache: false,
                    success: function(rs) {
                        if (rs.status == 200) {
                            location.reload();
                        } else {
                            alert(rs.msg);
                        }
                    }
                });
            });
            $('#btnKiri').on('click', function() {
                $("#btnKanan").removeClass('bg-success');
                $("#btnKanan").html('<i class="fas fa-copy mr-2"> Salin');
                var kiri = $('#kiri').val();
                navigator.clipboard.writeText(kiri);
                $(this).addClass('bg-success');
                $(this).html('<i class="fas fa-copy mr-2"> Data Disalin');
            });
            $('#btnKanan').on('click', function() {
                $("#btnKiri").removeClass('bg-success');
                $("#btnKiri").html('<i class="fas fa-copy mr-2"> Salin');
                var kanan = $('#kanan').val();
                navigator.clipboard.writeText(kanan);
                $(this).addClass('bg-success');
                $(this).html('<i class="fas fa-copy mr-2"> Data Disalin');
            })
        })(jQuery);
    </script>
@endpush
@push('breadcrumb-plugins')
    <form action="{{ route('user.other.tree.search') }}" method="GET" class="form-inline float-right bg--white">
        <div class="input-group has_append">
            <input type="text" name="username" class="form-control" placeholder="@lang('Search by username')">
            <div class="input-group-append">
                <button class="btn btn--success" type="submit"><i class="fa fa-search"></i></button>
            </div>
        </div>
    </form>
@endpush
