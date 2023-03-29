@extends($activeTemplate . 'user.layouts.app')

@push('style')
    <link href="{{ asset('assets/admin/css/tree.css') }}" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

    <style>
        a {
            text-decoration: none;
            background-color: transparent;
        }

        .textInf {
            margin-top: -1rem;
        }
    </style>
@endpush

@section('panel')

    <div class="card">
        <div class="row">
            {{-- <div class="col-md-12"> --}}
            <nav class="col-3 col-md-2">
                <div class="nav nav-tabs nav-fill " id="nav-tab" role="tablist"
                    style="border: none;
                color: #ffffff;
                background-color: #96795f;">
                    @for ($i = 1; $i < $get_bv->bv + 1; $i++)
                        <?php
                        $tmp = App\Models\User::where('username', '=', $ref->username . $i)->first();
                        ?>
                        {{-- @dump($tmp) --}}
                        @if ($tmp)
                            {{-- {{ $tmp->email }} --}}
                            <a style="color: black;    width: -webkit-fill-available;" class="nav-item nav-link tab"
                                id="nav-user-tab" data-toggle="tab" href="#nav-user{{ $i }}" role="tab"
                                aria-controls="nav-user{{ $i }}" aria-selected="true">MP - {{ $tmp->no_bro }} <i
                                    class="las la-check" style="color: rgb(60, 226, 255)"></i></a>
                        @else
                            <a style="color: black;     width: -webkit-fill-available;"
                                class="nav-item nav-link tab addNewTree" id="nav-user-tab" data-toggle="tab"
                                href="#nav-user{{ $i }}" role="tab"
                                aria-controls="nav-user{{ $i }}" aria-selected="true">MP - (Number) <i
                                    class="las la-pen" style="color: yellow"></i></a>
                        @endif
                    @endfor

                    {{-- <a class="nav-item nav-link" id="nav-user2-tab" data-toggle="tab" href="#nav-user2" role="tab" aria-controls="nav-user2" aria-selected="false">User 2</a>
                    <a class="nav-item nav-link" id="nav-user3-tab" data-toggle="tab" href="#nav-user3" role="tab" aria-controls="nav-user3" aria-selected="false">User 3</a>
                    <a class="nav-item nav-link" id="nav-user4-tab" data-toggle="tab" href="#nav-user4" role="tab" aria-controls="nav-user4" aria-selected="false">User 4</a>
                    <a class="nav-item nav-link" id="nav-user5-tab" data-toggle="tab" href="#nav-user5" role="tab" aria-controls="nav-user5" aria-selected="false">User 5</a>
                    <a class="nav-item nav-link" id="nav-user6-tab" data-toggle="tab" href="#nav-user6" role="tab" aria-controls="nav-user6" aria-selected="false">User 6</a>
                    <a class="nav-item nav-link" id="nav-user7-tab" data-toggle="tab" href="#nav-user7" role="tab" aria-controls="nav-user7" aria-selected="false">User 7</a> --}}
                </div>
            </nav>
            <div class="col-9 col-md-10 tab-content" id="nav-tabContent">
                @for ($i = 1; $i < $get_bv->bv + 1; $i++)
                    <div class="tab-pane fade show" id="nav-user{{ $i }}" role="tabpanel"
                        aria-labelledby="nav-user{{ $i }}-tab">
                        <div class="card-body">
                            <?php
                            $tmp = App\Models\User::where('users.username', $ref->usrn . $i)
                                ->join('users as us', 'us.id', '=', 'users.pos_id')
                                ->select('users.*', 'us.username as us')
                                ->first();
                            ?>

                            <input type="text" name="count" id="counting" hidden value="{{ $i }}">
                            @if ($tmp)
                                <div class="card " style="max-height: 50rem">
                                    {{ tree_created($ref->usrn . $i) }}
                                    {{-- @dump(tree_created($ref->usr.'+'.$i.'@'.$ref->domain)) --}}
                                </div>
                                <div class="form-group">
                                    <label for="ref_username1">Parent Username</label>
                                    <select class="form-select form-control" disabled>
                                        <option value="" hidden>{{ $tmp->us }}</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="position1">Position</label>
                                    <select class="form-select form-control" disabled>
                                        @if ($tmp->position == 1)
                                            <option value="">Left</option>
                                        @else
                                            <option value="">Right</option>
                                        @endif
                                    </select>
                                </div>


                                <div class="form-group">
                                    <label for="exampleInputusername">Username</label>
                                    <input readonly type="text" class="form-control" name="username"
                                        id="exampleInputusername" placeholder="Username" value="{{ $tmp->username }}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputusername">MP Number</label>
                                    <input readonly type="text" class="form-control" name="username"
                                        id="exampleInputusername" placeholder="Username" value="{{ $tmp->no_bro }}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email address</label>
                                    <input readonly value="{{ $ref->usr . '+' . $i . '@' . $ref->domain }}" type="email"
                                        name="email" class="form-control" id="exampleInputEmail1"
                                        aria-describedby="emailHelp" placeholder="Enter email">
                                    {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Password</label>
                                    <input disabled type="text" value="the password is the same as the main email"
                                        class="form-control" id="exampleInputPassword1" placeholder="Password">
                                </div>
                            @else
                                <div class="card tree" id="tree" hidden>
                                </div>
                                <div class="card card-tree">
                                    <div class="previewTree" id="previewTree">
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
                                        </div>
                                    </div>
                                </div>
                                <div class="card mt-3" id="inpForm" hidden>
                                    <div class="card-body">
                                        <form action="{{ route('user.user') }}" class="form"
                                            id="form{{ $i }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <input type="text" class="last lastMp" value="" hidden>
                                            <input type="text" class="upMp uplineMP" name="upMp" value=""
                                                hidden>
                                            <input type="text" name="count" class="counting" hidden
                                                value="{{ $i }}">
                                            <div class="form-group">
                                                <label for="ref_username1">Parent Username</label>
                                                <input readonly type="text" class="form-control newUpline"
                                                    name="upline" id="exampleInputusername" placeholder="Username"
                                                    value="">
                                            </div>
                                            <input type="hidden" name="pos" id="pos" class="pos">
                                            <div class="form-group">
                                                <label for="position1">Position</label>
                                                <select class="form-select form-control position" name="position"
                                                    id="position" disabled>
                                                    <option value="">-- Select Position --</option>
                                                    <option value="1">Kiri</option>
                                                    <option value="2">Kanan</option>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="exampleInputusername">Username</label>
                                                <input readonly type="text" class="form-control newUsername"
                                                    name="username" id="exampleInputusername" placeholder="Username"
                                                    value="">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputusername">MP Number</label>
                                                <input readonly type="text" class="form-control" name="no_bro"
                                                    id="exampleInputno_bro" placeholder="no_bro"
                                                    value="Random MP Number">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Email address</label>
                                                <input readonly value="{{ auth()->user()->email }}" type="email"
                                                    name="email" class="form-control newEmail" id="exampleInputEmail1"
                                                    aria-describedby="emailHelp" placeholder="Enter email">
                                                {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Password</label>
                                                <input disabled type="text"
                                                    value="the password is the same as the main email"
                                                    class="form-control" id="exampleInputPassword1"
                                                    placeholder="Password">
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-6 col-6">
                                                    <button type="submit"
                                                        class="btn btn--primary btn-block">Submit</button>
                                                </div>
                                                <div class="col-md-6 col-6">
                                                    <a href="{{ route('user.my.tree') }}"
                                                        class="btn btn--secondary btn-block">View
                                                        Tree</a>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            @endif

                            {{-- @if (in_array($ref->usrn . $i, $reg))
                                    <button class="btn btn--primary btn-block" disabled>User is already registered</button>
                                @else
                                    <div class="row">
                                        <div class="col-md-6 col-6">
                                            <button type="submit" class="btn btn--primary btn-block">Submit</button>
                                        </div>
                                        <div class="col-md-6 col-6">
                                            <a href="{{ route('user.my.tree') }}"
                                                class="btn btn--secondary btn-block">View
                                                Tree</a>
                                        </div>
                                    </div>
                                @endif --}}

                        </div>
                    </div>
                @endfor

            </div>
            {{-- </div> --}}

        </div>
    </div>



@endsection
@push('script')
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    {{-- <script>
    $.ajax({
    type:"GET",
    url: "http://fantasy.premierleague.com/web/api/elements/100/",
    success: function(data) {
            $("body").append(JSON.stringify(data));
        },
    error: function(jqXHR, textStatus, errorThrown) {
            alert(jqXHR.status);
        },
    dataType: "json"
    });​​​​​​​​​​​​​​​
</script> --}}
    <script>
        $(document).ready(function() {
            $('#nav-tabContent').on('select2:select', 'select2', function(e) {
                var data = e.params.data;
                console.log(data);
            });
        });
        $('.showDetails').on('click', function() {
            let id = $(this).data('id');
            $.ajax({
                type: "GET",
                url: "{{ url('/user/cek_pos') }}/" + id,
                success: function(data) {
                    $('#tree').attr("hidden", false).html(data.tree);
                    $('.card-tree').attr("hidden", true);

                }

            })
        });
        $('.addNewTree').on('click', function() {
            $('#inpForm').attr('hidden', true);
            $('.card-tree').attr('hidden', false);
            $('#tree').attr('hidden', false);
        })
        $('.btnUser').on('click', function() {
            let last = $('.last').val();
            let count = $('.counting').val();
            let user = "{{ auth()->user()->username }}";
            let upline = $(this).data('upline');
            let pos = $(this).data('pos');
            let uname = $(this).data('up');
            $('.imgUser' + pos + last).removeClass('select-user');
            $('#inpForm').attr("hidden", false);
            $('.imgUser' + pos + upline).addClass('select-user');
            $('.last').val(upline);
            $('.pos').val(pos);
            $('.upMp').val(upline);
            $('.newUpline').val(uname);
            $('.newUsername').val(user + count);
            $('.position').val(pos);

        })
        $('#tree').on('click', '.btnUser', function() {
            let last = $('.last').val();
            let count = $('.counting').val();
            let user = "{{ auth()->user()->username }}";
            let upline = $(this).data('upline');
            let pos = $(this).data('pos');
            let uname = $(this).data('up');
            $('#inpForm').attr("hidden", false);
            console.log('imgUser' + pos + last);

            $('.imgUser' + last).removeClass('select-user');

            $('.imgUser' + pos + upline).addClass('select-user');
            $('.lastMp').val(pos + upline);
            $('.uplineMP').val(upline);
            $('.pos').val(pos);
            $('.newUpline').val(uname);
            $('.newUsername').val(user + count);
            $('.position').val(pos);
        })
        $('#tree').on('click', '.showDetails', function() {
            let id = $(this).data('id');
            $.ajax({
                type: "GET",
                url: "{{ url('/user/cek_pos') }}/" + id,
                success: function(data) {
                    $('#tree').attr("hidden", false).html(data.tree);
                    $('.card-tree').attr("hidden", true);

                }

            })
        })

        function selectFx(x) {
            var id = x.value;
            $.ajax({
                type: "GET",
                url: "{{ url('/user/cek_pos') }}/" + id,
                success: function(data) {
                    // $("body").append(JSON.stringify(data));
                    console.log(data.response);

                    if (data.response == 0) {
                        var options =
                            '<option value="" hidden>-- Select Position --</option><option value="1">Left</option><option value="2">Right</option>';
                        $('.position').prop('disabled', false).prop('required', true);
                        $('.alr').attr("hidden", true);
                        $('.position').html(options);
                        $('.tree').attr("hidden", false).html(data.tree);
                    } else if (data.response == 1) {
                        var options =
                            '<option value="" hidden>-- Select Position --</option><option value="1" selected>Left</option>';
                        $('.position').prop('disabled', false).prop('required', true);
                        $('.alr').attr("hidden", true);
                        $('.position').html(options);
                        $('.tree').attr("hidden", false).html(data.tree);
                        var pilih = `
                            <div class='user'><img src='` + base_uri + `/assets/images/avatar.png' alt='*' class='select-user'>
                                <p class='user-name'>MP</p>
                                <p class="user-name"><a class="btn btn-sm" style="background-color:#00f60e;color:black;" >Selected Position</a> </p>
                                </div> <span class='line'></span>
                        `;
                        $('.pleft').html(pilih);

                    } else if (data.response == 2) {

                        var options =
                            '<option value="" hidden>-- Select Position --</option><option value="2" selected>Right</option>';
                        $('.position').prop('disabled', false).prop('required', true);
                        $('.alr').attr("hidden", true);
                        $('.position').html(options);
                        $('.tree').attr("hidden", false).html(data.tree);
                        var pilih = `
                            <div class='user'><img src='` + base_uri + `/assets/images/avatar.png' alt='*' class='select-user'>
                                <p class="user-name"><a class="btn btn-sm" style="background-color:#00f60e;color:black;" >Selected Position</a> </p>
                                </div> <span class='line'></span>
                        `;
                        $('.pright').html(pilih);
                    } else {
                        var options = '<option value="" hidden>Full</option>';
                        $('.position').prop('disabled', false).prop('required', true);
                        $('.alr').attr("hidden", false).html('Please select Another Parent Username!.');
                        $('.position').html(options);
                        $('.tree').attr("hidden", false).html(data.tree);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert(jqXHR.status);
                },
                dataType: "json"
            });
        }

        var base_uri = $('#base_url').val();

        $('.ref_username').on('change', function() {

            console.log($(this).val());
            // var posa = $('.position').val();
            // console.log(posa);
            // var id = $('.ref_username').val();
            // $('.tree').attr("hidden",true);
            var id = $(this).find(':selected').data('value');
            // console.log(id);
            $.ajax({
                type: "GET",
                url: "{{ url('/user/cek_pos') }}/" + id,
                success: function(data) {
                    // $("body").append(JSON.stringify(data));
                    console.log(data.response);

                    if (data.response == 0) {
                        var options =
                            '<option value="" hidden>-- Select Position --</option><option value="1">Left</option><option value="2">Right</option>';
                        $('.position').prop('disabled', false).prop('required', true);
                        $('.alr').attr("hidden", true);
                        $('.position').html(options);
                        $('.tree').attr("hidden", false).html(data.tree);
                    } else if (data.response == 1) {
                        var options =
                            '<option value="" hidden>-- Select Position --</option><option value="1" selected>Left</option>';
                        $('.position').prop('disabled', false).prop('required', true);
                        $('.alr').attr("hidden", true);
                        $('.position').html(options);
                        $('.tree').attr("hidden", false).html(data.tree);
                        var pilih = `
                            <div class='user'><img src='` + base_uri + `/assets/images/avatar.png' alt='*' class='select-user'>
                                <p class='user-name'>MP</p>
                                <p class="user-name"><a class="btn btn-sm" style="background-color:#00f60e;color:black;" >Selected Position</a> </p>
                                </div> <span class='line'></span>
                        `;
                        $('.pleft').html(pilih);

                    } else if (data.response == 2) {

                        var options =
                            '<option value="" hidden>-- Select Position --</option><option value="2" selected>Right</option>';
                        $('.position').prop('disabled', false).prop('required', true);
                        $('.alr').attr("hidden", true);
                        $('.position').html(options);
                        $('.tree').attr("hidden", false).html(data.tree);
                        var pilih = `
                            <div class='user'><img src='` + base_uri + `/assets/images/avatar.png' alt='*' class='select-user'><p class='user-name'>MP</p>
                                <p class="user-name"><a class="btn btn-sm" style="background-color:#00f60e;color:black;" >Selected Position</a> </p>
                                </div> <span class='line'></span>
                        `;
                        $('.pright').html(pilih);
                    } else {
                        var options = '<option value="" hidden>Full</option>';
                        $('.position').prop('disabled', false).prop('required', true);
                        $('.alr').attr("hidden", false).html('Please select Another Parent Username!.');
                        $('.position').html(options);
                        $('.tree').attr("hidden", false).html(data.tree);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert(jqXHR.status);
                },
                dataType: "json"
            });
        });
        // function posa(){
        //     var pos = $('.position').find('option:selected').val();
        //     console.log(pos);

        // };

        $('.position').on('change', function() {
            var pos = $(this).find('option:selected').val();
            var pilih = `
                <div class='user'><img src='` + base_uri + `/assets/images/avatar.png' alt='*' class='select-user'>
                    <p class="user-name"><a class="btn btn-sm" style="background-color:#00f60e;color:black;" >Selected Position</a> </p> </div> <span class='line'></span>
            `;
            // var def = `
        //     <div class='user'><img src='` + base_uri + `/assets/images/avatar.png' alt='*' class='no-user'><p class='user-name'>MP</p> </div> <span class='line'></span>
        // `;
            // console.log(pos);

            // $('.pleft').html("");
            if (pos == 1) {
                $('.pleft').html(pilih);
                // $('.pright').html(def);
            } else {
                $('.pright').html(pilih);
                // $('.pleft').html(def);
            }
        });
        $('.tab').on('click', function() {
            $('.tree').attr("hidden", true);
            $('.form')[0].reset();
        });
        $('.select_tree').on('click', function() {
            // var id = $(this).data('id');
            console.log('id');
        });

        function f1(id) {
            // console.log(id);
            $.ajax({
                type: "GET",
                url: "{{ url('/user/cek_pos') }}/" + id,
                success: function(data) {
                    // $("body").append(JSON.stringify(data));

                    $(".ref_username option[value='" + id + "']").attr("selected", "selected");
                    $('.form')[0].reset();
                    if (data.response == 0) {
                        var options =
                            '<option value="" hidden>-- Select Position --</option><option value="1">Left</option><option value="2">Right</option>';
                        $('.position').prop('disabled', false).prop('required', true);
                        $('.alr').attr("hidden", true);
                        $('.position').html(options);
                        $('.tree').attr("hidden", false).html(data.tree);
                    } else if (data.response == 1) {
                        var options =
                            '<option value="" hidden>-- Select Position --</option><option value="1" selected>Left</option>';
                        $('.position').prop('disabled', false).prop('required', true);
                        $('.alr').attr("hidden", true);
                        $('.position').html(options);
                        $('.tree').attr("hidden", false).html(data.tree);
                        var pilih = `
                            <div class='user'><img src='` + base_uri + `/assets/images/avatar.png' alt='*' class='select-user'>
                                <p class='user-name'>MP</p>
                                <p class="user-name"><a class="btn btn-sm" style="background-color:#00f60e;color:black;" >Selected Position</a> </p>
                                </div> <span class='line'></span>
                        `;
                        $('.pleft').html(pilih);
                    } else if (data.response == 2) {
                        var options =
                            '<option value="" hidden>-- Select Position --</option><option value="2" selected>Right</option>';
                        $('.position').prop('disabled', false).prop('required', true);
                        $('.alr').attr("hidden", true);
                        $('.position').html(options);
                        $('.tree').attr("hidden", false).html(data.tree);
                        var pilih = `
                            <div class='user'><img src='` + base_uri + `/assets/images/avatar.png' alt='*' class='select-user'>
                                <p class='user-name'>MP</p>
                                <p class="user-name"><a class="btn btn-sm" style="background-color:#00f60e;color:black;" >Selected Position</a> </p>
                                </div> <span class='line'></span>
                        `;
                        $('.pright').html(pilih);
                    } else {
                        var options = '<option value="" hidden>Full</option>';
                        $('.position').prop('disabled', false).prop('required', true);
                        $('.alr').attr("hidden", false).html('Please select Another Parent Username!.');
                        $('.position').html(options);
                        $('.tree').attr("hidden", false).html(data.tree);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert(jqXHR.status);
                },
                dataType: "json"
            });
        };
    </script>
@endpush
