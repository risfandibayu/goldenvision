@extends($activeTemplate . 'user.layouts.app')

@push('style')
<link href="{{asset('assets/admin/css/tree.css')}}" rel="stylesheet">
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

<style>
    a{
        color: #000000;
        text-decoration: none;
        background-color: transparent;
    }
</style>
@endpush

@section('panel')

<div class="card">
    <div class="row">
        <div class="col-md-12">
            <nav>
                <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist" style="border: none;
                color: #ffffff;
                background-color: #96795f;">
                    @for ($i = 1; $i < $get_bv->bv+1; $i++)
                        
                    <a class="nav-item nav-link tab" id="nav-user-tab"  data-toggle="tab" href="#nav-user{{$i}}" role="tab" aria-controls="nav-user{{$i}}" aria-selected="true">User {{$i}}</a>
                    @endfor

                    {{-- <a class="nav-item nav-link" id="nav-user2-tab" data-toggle="tab" href="#nav-user2" role="tab" aria-controls="nav-user2" aria-selected="false">User 2</a>
                    <a class="nav-item nav-link" id="nav-user3-tab" data-toggle="tab" href="#nav-user3" role="tab" aria-controls="nav-user3" aria-selected="false">User 3</a>
                    <a class="nav-item nav-link" id="nav-user4-tab" data-toggle="tab" href="#nav-user4" role="tab" aria-controls="nav-user4" aria-selected="false">User 4</a>
                    <a class="nav-item nav-link" id="nav-user5-tab" data-toggle="tab" href="#nav-user5" role="tab" aria-controls="nav-user5" aria-selected="false">User 5</a>
                    <a class="nav-item nav-link" id="nav-user6-tab" data-toggle="tab" href="#nav-user6" role="tab" aria-controls="nav-user6" aria-selected="false">User 6</a>
                    <a class="nav-item nav-link" id="nav-user7-tab" data-toggle="tab" href="#nav-user7" role="tab" aria-controls="nav-user7" aria-selected="false">User 7</a> --}}
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                @for ($i = 1; $i < $get_bv->bv+1; $i++)
                <div class="tab-pane fade show" id="nav-user{{$i}}" role="tabpanel" aria-labelledby="nav-user{{$i}}-tab">
                    <div class="card-body">
                        <form action="{{route('user.user')}}" class="form" id="form{{$i}}" method="POST" enctype="multipart/form-data">
                            @csrf
                        <input type="text" name="count" hidden value="{{$i}}">
                        <div class="form-group">
                            <label for="ref_username1">Parent Username</label>
                            <select class="form-select form-control ref_username" name="ref_username" id="ref_username{{$i}}" required>
                              <option value="" hidden>-- Select Parent Username --</option>
                              @foreach($ref_user as $refus)
                                    @if($refus->pos == "Leader")
                                    <option value="{{$refus->id}}" data-value="{{$refus->id}}" style="font-weight: 700">{{$refus->username}}
                                               
                                    @else
                                    <option value="{{$refus->id}}" data-value="{{$refus->id}}">{{$refus->username}}
                                    @endif
                                        {{-- @if($refus->pos == $refus->pos_id) --}}
                                                @if($refus->pos == "Leader")
                                                - {{$refus->pos}} (You)
                                                @else
                                                    @if ($refus->position == 1)
                                                    - Under {{$refus->usa}} (Left)
                                                    @else
                                                    - Under {{$refus->usa}}  (Right)
                                                    @endif
                                                @endif
                                            
                                        {{-- @else --}}
                                        {{-- @endif --}}
                                    </option>
                                  @endforeach
                            </select>
                        </div>
                        <div class="card tree" id="tree" hidden>
                        </div>
                        <div class="form-group">
                            <label for="position1">Position</label>
                            <select class="form-select form-control position" name="position" id="position" disabled>
                                <option value="">-- Select Position --</option>
                            </select>
                            <span id="alr" class="text-danger alr">Please select Parent Username First!.</span>
                            {{-- <span id="alr" class="text-danger"></span> --}}
                        </div>


                        <div class="form-group">
                            <label for="exampleInputusername">Username</label>
                            <input readonly type="text" class="form-control" name="username" id="exampleInputusername" placeholder="Username" value="{{$ref->username}}{{$i}}">
                          </div>
                        <div class="form-group">
                          <label for="exampleInputEmail1">Email address</label>
                          <input readonly value="{{$ref->usr.'+'.$i.'@'.$ref->domain}}" type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                          {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                        </div>
                        <div class="form-group">
                          <label for="exampleInputPassword1">Password</label>
                          <input disabled type="text" value="the password is the same as the main email" class="form-control" id="exampleInputPassword1" placeholder="Password">
                        </div>
                        @if (in_array($ref->usr.'+'.$i.'@'.$ref->domain, $reg))
                            <button class="btn btn--primary btn-block" disabled>User is already registered</button>
                        @else
                            <div class="row">
                                <div class="col-md-6 col-6">
                                    <button type="submit" class="btn btn--primary btn-block">Submit</button>
                                </div>
                            <div class="col-md-6 col-6">
                                <a href="{{route('user.my.tree')}}" class="btn btn--secondary btn-block">View Tree</a>
                            </div>
                        </div>
                        @endif
                      </form>
                    </div>
                </div>
                @endfor
                
            </div>
        </div>
        
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
    var base_uri = $('#base_url').val();
    
    $('.ref_username').on('change', function() {
    // console.log(base_uri);
        // var posa = $('.position').val();
        // console.log(posa);
        // var id = $('.ref_username').val();
        // $('.tree').attr("hidden",true);
        var id = $(this).find(':selected').data('value');
        // console.log(id);
        $.ajax({
        type:"GET", 
        url: "{{url('/user/cek_pos')}}/"+id, 
        success: function(data) {
                // $("body").append(JSON.stringify(data));
                // console.log(data.response);
                
                if (data.response == 0) {
                    var options =  '<option value="" hidden>-- Select Position --</option><option value="1">Left</option><option value="2">Right</option>';
                    $('.position').prop('disabled', false).prop('required', true);
                    $('.alr').attr("hidden",true);
                    $('.position').html(options);
                    $('.tree').attr("hidden",false).html(data.tree);
                }
                else if (data.response == 1) {
                    var options =  '<option value="" hidden>-- Select Position --</option><option value="1" selected>Left</option>';
                    $('.position').prop('disabled', false).prop('required', true);
                    $('.alr').attr("hidden",true);
                    $('.position').html(options);
                    $('.tree').attr("hidden",false).html(data.tree);
                    var pilih = `
                <div class='user'><img src='`+base_uri+`/assets/images/avatar.png' alt='*' class='select-user'>
                    <p class='user-name'>BRO</p> 
                    <p class="user-name"><a class="btn btn-sm" style="background-color:#00f60e;color:black;" >Selected Position</a> </p>
                    </div> <span class='line'></span> 
            `;
                    $('.pleft').html(pilih);
                    
                }
                else if (data.response == 2) {
                    
                    var options =  '<option value="" hidden>-- Select Position --</option><option value="2" selected>Right</option>';
                    $('.position').prop('disabled', false).prop('required', true);
                    $('.alr').attr("hidden",true);
                    $('.position').html(options);
                    $('.tree').attr("hidden",false).html(data.tree);
                    var pilih = `
                <div class='user'><img src='`+base_uri+`/assets/images/avatar.png' alt='*' class='select-user'><p class='user-name'>BRO</p>
                    <p class="user-name"><a class="btn btn-sm" style="background-color:#00f60e;color:black;" >Selected Position</a> </p>
                    </div> <span class='line'></span> 
            `;
                    $('.pright').html(pilih);
                }else{
                    var options =  '<option value="" hidden>Full</option>';
                    $('.position').prop('disabled', false).prop('required', true);
                    $('.alr').attr("hidden",false).html('Please select Another Parent Username!.');
                    $('.position').html(options);
                    $('.tree').attr("hidden",false).html(data.tree);
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
                <div class='user'><img src='`+base_uri+`/assets/images/avatar.png' alt='*' class='select-user'><p class='user-name'>BRO</p>
                    <p class="user-name"><a class="btn btn-sm" style="background-color:#00f60e;color:black;" >Selected Position</a> </p> </div> <span class='line'></span> 
            `;
        var def = `
                <div class='user'><img src='`+base_uri+`/assets/images/avatar.png' alt='*' class='no-user'><p class='user-name'>BRO</p> </div> <span class='line'></span> 
            `;
        // console.log(pos);

        // $('.pleft').html("");
        if (pos == 1) {
            $('.pleft').html(pilih);
            $('.pright').html(def);
        }else{
            $('.pright').html(pilih);
            $('.pleft').html(def);
        }
    });
    $('.tab').on('click', function() {
        $('.tree').attr("hidden",true);
        $('.form')[0].reset();
    });
    $('.select_tree').on('click', function() {
        // var id = $(this).data('id');
        console.log('id');
    });
    function f1(id)
        {
            // console.log(id);
        $.ajax({
        type:"GET", 
        url: "{{url('/user/cek_pos')}}/"+id, 
        success: function(data) {
                // $("body").append(JSON.stringify(data));
                // console.log(data.response);
                $(".ref_username option[value='" + id + "']").attr("selected","selected");
                // $('.form')[0].reset();
                if (data.response == 0) {
                    var options =  '<option value="" hidden>-- Select Position --</option><option value="1">Left</option><option value="2">Right</option>';
                    $('.position').prop('disabled', false).prop('required', true);
                    $('.alr').attr("hidden",true);
                    $('.position').html(options);
                    $('.tree').attr("hidden",false).html(data.tree);
                }
                else if (data.response == 1) {
                    var options =  '<option value="" hidden>-- Select Position --</option><option value="1" selected>Left</option>';
                    $('.position').prop('disabled', false).prop('required', true);
                    $('.alr').attr("hidden",true);
                    $('.position').html(options);
                    $('.tree').attr("hidden",false).html(data.tree);
                    var pilih = `
                <div class='user'><img src='`+base_uri+`/assets/images/avatar.png' alt='*' class='select-user'>
                    <p class='user-name'>BRO</p> 
                    <p class="user-name"><a class="btn btn-sm" style="background-color:#00f60e;color:black;" >Selected Position</a> </p>
                    </div> <span class='line'></span> 
            `;
                    $('.pleft').html(pilih);
                }
                else if (data.response == 2) {
                    var options =  '<option value="" hidden>-- Select Position --</option><option value="2" selected>Right</option>';
                    $('.position').prop('disabled', false).prop('required', true);
                    $('.alr').attr("hidden",true);
                    $('.position').html(options);
                    $('.tree').attr("hidden",false).html(data.tree);
                    var pilih = `
                <div class='user'><img src='`+base_uri+`/assets/images/avatar.png' alt='*' class='select-user'>
                    <p class='user-name'>BRO</p> 
                    <p class="user-name"><a class="btn btn-sm" style="background-color:#00f60e;color:black;" >Selected Position</a> </p>
                    </div> <span class='line'></span> 
            `;
                    $('.pright').html(pilih);
                }else{
                    var options =  '<option value="" hidden>Full</option>';
                    $('.position').prop('disabled', false).prop('required', true);
                    $('.alr').attr("hidden",false).html('Please select Another Parent Username!.');
                    $('.position').html(options);
                    $('.tree').attr("hidden",false).html(data.tree);
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