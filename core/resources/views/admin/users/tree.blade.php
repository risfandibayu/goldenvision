@extends('admin.layouts.app')

@push('style')
    <link href="{{asset('assets/admin/css/tree.css')}}" rel="stylesheet">
@endpush

@section('panel')

    <div class="card">
        <div class="row text-center justify-content-center llll">
            <!-- <div class="col"> -->
            <div class="w-1">
                @php echo showSingleUserinTree($tree['a']); @endphp
            </div>
        </div>
        <div class="row text-center justify-content-center llll">
            <!-- <div class="col"> -->
            <div class="w-2">
                @php echo showSingleUserinTree($tree['b']); @endphp
            </div>
            <!-- <div class="col"> -->
            <div class="w-2 ">
                @php echo showSingleUserinTree($tree['c']); @endphp
            </div>
        </div>
        <div class="row text-center justify-content-center llll">
            <!-- <div class="col"> -->
            <div class="w-4 ">
                @php echo showSingleUserinTree($tree['d']); @endphp
            </div>
            <!-- <div class="col"> -->
            <div class="w-4 ">
                @php echo showSingleUserinTree($tree['e']); @endphp
            </div>
            <!-- <div class="col"> -->
            <div class="w-4 ">
                @php echo showSingleUserinTree($tree['f']); @endphp
            </div>
            <!-- <div class="col"> -->
            <div class="w-4 ">
                @php echo showSingleUserinTree($tree['g']); @endphp
            </div>
            <!-- <div class="col"> -->

        </div>
        <div class="row text-center justify-content-center llll">
            <!-- <div class="col"> -->
            <div class="w-8">
                @php echo showSingleUserinTree($tree['h']); @endphp
            </div>
            <!-- <div class="col"> -->
            <div class="w-8">
                @php echo showSingleUserinTree($tree['i']); @endphp
            </div>
            <!-- <div class="col"> -->
            <div class="w-8">
                @php echo showSingleUserinTree($tree['j']); @endphp
            </div>
            <!-- <div class="col"> -->
            <div class="w-8">
                @php echo showSingleUserinTree($tree['k']); @endphp
            </div>
            <!-- <div class="col"> -->
            <div class="w-8">
                @php echo showSingleUserinTree($tree['l']); @endphp
            </div>
            <!-- <div class="col"> -->
            <div class="w-8">
                @php echo showSingleUserinTree($tree['m']); @endphp
            </div>
            <!-- <div class="col"> -->
            <div class="w-8">
                @php echo showSingleUserinTree($tree['n']); @endphp
            </div>
            <!-- <div class="col"> -->
            <div class="w-8">
                @php echo showSingleUserinTree($tree['o']); @endphp
            </div>
        </div>
    </div>


    <div class="modal fade user-details-modal-area" id="exampleModalCenter" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">@lang('User Details')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="user-details-modal">
                        <div class="user-details-header ">
                            <div class="thumb"><img class="w-h-100-p tree_image" src="#" alt="*"
                                ></div>
                            <div class="content">
                                <a class="user-name tree_url tree_name" href=""></a>
                                <input type="hidden" name="id" class="tree_id">
                                <span class="user-status tree_bro"></span>
                                <br>
                                <span class="user-status tree_status"></span>
                                <span class="user-status tree_plan"></span>
                            </div>
                        </div>
                        <div class="user-details-body text-center">
                            <h6 class="my-3">@lang('Referred By'): <span class="tree_ref"></span></h6>
                            <table class="table table-bordered">
                                <tr>
                                    <th>&nbsp;</th>
                                    <th>@lang('LEFT')</th>
                                    <th>@lang('RIGHT')</th>
                                </tr>
                                {{-- <tr>
                                    <td>@lang('Current BV')</td>
                                    <td><span class="lbv"></span></td>
                                    <td><span class="rbv"></span></td>
                                </tr>
                                <tr>
                                    <td>@lang('Free Member')</td>
                                    <td><span class="lfree"></span></td>
                                    <td><span class="rfree"></span></td>
                                </tr> --}}
                                <tr>
                                    <td>@lang('BRO Member')</td>
                                    <td><span class="lpaid"></span></td>
                                    <td><span class="rpaid"></span></td>
                                </tr>
                                
                            </table>
                            <a href="" target="_blank" class="mt-2 btn btn--secondary btn-block btn-sm tree_login_url">Login as User</a>
                            <a href="" target="_blank" class="mt-2 btn btn--info btn-block btn-sm tree_detail_url">Detail User</a>
                            <a class="mt-2 text--white btn btn--success btn-block btn-sm set_user_placement" data-dismiss="modal">Set User Placement</a>
                            <a class="mt-2 text--white btn btn--warning btn-block btn-sm update_counting" data-dismiss="modal">Update Counting</a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="userPlacement" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Set User Placement') <span class="username"></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="userPlace" class="userPlace">
                    <div class="modal-body">
                        <div class="form-row">
    
                            <input hidden type="text" name="id" id="id" class="id">
                            <div class="form-group col-md-12">
                                <label>@lang('BRO Number')<span class="text-danger">*</span></label>
                                <div class="input-group has_append">
                                    <input type="text" name="no_bro" class="form-control no_bro"
                                        placeholder="BRO Number as parent" required>
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="ref_name" class="form--label-2">@lang('Select Position')</label>
                                <select name="position" class="position form-control form--control-2 position" id="position" required>
                                    <option value="">@lang('Select position')*</option>
                                    @foreach(mlmPositions() as $k=> $v)
                                        <option value="{{$k}}">@lang($v)</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
                    <div class="modal-footer">
                        <button type="button" class="btn btn--dark" data-dismiss="modal">@lang('Close')</button>
                        <button type="submit" class="btn btn--success submitPlace">@lang('Submit')</button>
                    </div>
            </div>
        </div>
    </div>

    <div id="updateCounting" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Update Counting') <span class="username"></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="updateCounting" class="updateCounting">
                    <div class="modal-body">
                        <div class="form-row">
    
                            <input hidden type="text" name="id" id="id" class="id">
                            <div class="form-group col-md-12">
                                <label>@lang('Left')<span class="text-danger">*</span></label>
                                <div class="input-group has_append">
                                    <input type="text" name="left" class="form-control left"
                                        placeholder="BRO Left Count" required>
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label>@lang('Right')<span class="text-danger">*</span></label>
                                <div class="input-group has_append">
                                    <input type="text" name="right" class="form-control right"
                                        placeholder="BRO Right Count" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                    <div class="modal-footer">
                        <button type="button" class="btn btn--dark" data-dismiss="modal">@lang('Close')</button>
                        <button type="submit" class="btn btn--success submitCount">@lang('Submit')</button>
                    </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        'use strict';
        (function($){
            $('.showDetails').on('click', function () {
                var modal = $('#exampleModalCenter');
                $('.tree_id').val($(this).data('id'));
                $('.tree_name').text($(this).data('name'));
                $('.tree_url').attr({"href": $(this).data('treeurl')});
                $('.tree_login_url').attr({"href": $(this).data('treeloginurl')});
                $('.tree_detail_url').attr({"href": $(this).data('treedetailurl')});
                $('.tree_status').text($(this).data('status'));
                $('.tree_bro').text('BRO Number : '+$(this).data('bro'));
                $('.tree_plan').text($(this).data('plan'));
                $('.tree_image').attr({"src": $(this).data('image')});
                $('.user-details-header').removeClass('Paid');
                $('.user-details-header').removeClass('Free');
                $('.user-details-header').addClass($(this).data('status'));
                $('.tree_ref').text($(this).data('refby'));
                $('.lbv').text($(this).data('lbv'));
                $('.rbv').text($(this).data('rbv'));
                $('.lpaid').text($(this).data('lpaid'));
                $('.rpaid').text($(this).data('rpaid'));
                $('.lfree').text($(this).data('lfree'));
                $('.rfree').text($(this).data('rfree'));
                $('#exampleModalCenter').modal('show');

                $('.set_user_placement').on('click', function () {
                    var modal = $('#userPlacement');
                    $('.username').text($('.tree_bro').text());

                    $('.id').val($('.tree_id').val());
                    $('#userPlacement').modal('show');
                });

                $('.update_counting').on('click', function () {
                    var modal = $('#updateCounting');
                    $('.username').text($('.tree_bro').text());

                    $('.id').val($('.tree_id').val());
                    $('#updateCounting').modal('show');
                });
            });
        })(jQuery)

    </script>
    {{-- <script>
        $('.set_user_placement').on('click', function () {
            var modal = $('#userPlacement');
            $('.username').text($(this).data('name'));
            $('#userPlacement').modal('show');
        });
    </script> --}}

    <script>
    $('.submitPlace').on('click', function () {
            var id = $('.id').val();
            var no_bro = $('.no_bro').val();
            var position = $('.position').val();
            // console.log(id);
            var token = "{{csrf_token()}}";
            $.ajax({
                type: "POST",
                url: "{{url('admin/user/set-user-placement/')}}/"+id,
                headers: {
                    'X-CSRF-Token': '{{ csrf_token() }}',
                },
                data: {
                    'id': id,
                    'no_bro': no_bro,
                    'position': position,
                    '_token': token
                },
                success: function(data) {
                    // console.log(data.msg);
                    if (data.msg == 'mantap') {
                        iziToast.success({
                            message: 'User set placement successfully',
                            position: "topRight"
                        });
                        window.location.reload();
                    }

                }
            });
    });
    </script>

    <script>
    $('.submitCount').on('click', function () {
            var id = $('.id').val();
            var left = $('.left').val();
            var right = $('.right').val();
            // console.log(id);
            var token = "{{csrf_token()}}";
            $.ajax({
                type: "POST",
                url: "{{url('admin/user/update_counting/')}}/"+id,
                headers: {
                    'X-CSRF-Token': '{{ csrf_token() }}',
                },
                data: {
                    'id': id,
                    'left': left,
                    'right': right,
                    '_token': token
                },
                success: function(data) {
                    // console.log(data.msg);
                    if (data.msg == 'mantap') {
                        iziToast.success({
                            message: 'Update Counting successfully',
                            position: "topRight"
                        });
                        window.location.reload();
                    }

                }
            });
    });
    </script>
@endpush
@push('breadcrumb-plugins')

    <form action="{{route('admin.users.other.tree.search')}}" method="GET" class="form-inline float-right bg--white">
        <div class="input-group has_append">
            <input type="text" name="username" class="form-control" placeholder="@lang('Search by username')">
            <div class="input-group-append">
                <button class="btn btn--success" type="submit"><i class="fa fa-search"></i></button>
            </div>
        </div>
    </form>

@endpush



