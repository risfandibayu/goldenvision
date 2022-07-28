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
                    <a class="nav-item nav-link active" id="nav-user1-tab" data-toggle="tab" href="#nav-user1" role="tab" aria-controls="nav-user1" aria-selected="true">User 1</a>
                    <a class="nav-item nav-link" id="nav-user2-tab" data-toggle="tab" href="#nav-user2" role="tab" aria-controls="nav-user2" aria-selected="false">User 2</a>
                    <a class="nav-item nav-link" id="nav-user3-tab" data-toggle="tab" href="#nav-user3" role="tab" aria-controls="nav-user3" aria-selected="false">User 3</a>
                    <a class="nav-item nav-link" id="nav-user4-tab" data-toggle="tab" href="#nav-user4" role="tab" aria-controls="nav-user4" aria-selected="false">User 4</a>
                    <a class="nav-item nav-link" id="nav-user5-tab" data-toggle="tab" href="#nav-user5" role="tab" aria-controls="nav-user5" aria-selected="false">User 5</a>
                    <a class="nav-item nav-link" id="nav-user6-tab" data-toggle="tab" href="#nav-user6" role="tab" aria-controls="nav-user6" aria-selected="false">User 6</a>
                    <a class="nav-item nav-link" id="nav-user7-tab" data-toggle="tab" href="#nav-user7" role="tab" aria-controls="nav-user7" aria-selected="false">User 7</a>
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-user1" role="tabpanel" aria-labelledby="nav-user1-tab">
                    <div class="card-body">
                        <form action="{{route('user.user1')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                        <div class="form-group">
                            <label for="ref_username1">Referral Username</label>
                            <select class="form-select form-control" name="ref_username1" id="ref_username1" required>
                              <option value="" hidden>-- Select Referral Username --</option>
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

                        <div class="form-group">
                            <label for="position1">Position</label>
                            <select class="form-select form-control" name="position1" id="position1" disabled>
                                <option value="">-- Select Position --</option>
                            </select>
                            <span id="alr1" class="text-danger">Please select Referral Username First!.</span>
                            {{-- <span id="alr" class="text-danger"></span> --}}
                        </div>


                        <div class="form-group">
                            <label for="exampleInputusername">Username</label>
                            <input readonly type="text" class="form-control" name="username1" id="exampleInputusername" placeholder="Username" value="{{$ref->username}}1">
                          </div>
                        <div class="form-group">
                          <label for="exampleInputEmail1">Email address</label>
                          <input readonly value="{{$ref->usr.'+1@'.$ref->domain}}" type="email" name="email1" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                          {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                        </div>
                        <div class="form-group">
                          <label for="exampleInputPassword1">Password</label>
                          <input disabled type="text" value="the password is the same as the main email" class="form-control" id="exampleInputPassword1" placeholder="Password">
                        </div>
                        @if (in_array($ref->usr.'+1@'.$ref->domain, $reg))
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
                <div class="tab-pane fade show" id="nav-user2" role="tabpanel" aria-labelledby="nav-user2-tab">
                    <div class="card-body">
                        <form action="{{route('user.user2')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="ref_username2">Referral Username</label>
                                <select class="form-select form-control" name="ref_username2" id="ref_username2" required>
                                  <option value="" hidden>-- Select Referral Username --</option>
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
    
                            <div class="form-group">
                                <label for="position2">Position</label>
                                <select class="form-select form-control" name="position2" id="position2" disabled>
                                    <option value="">-- Select Position --</option>
                                </select>
                                <span id="alr2" class="text-danger">Please select Referral Username First!.</span>
                                {{-- <span id="alr" class="text-danger"></span> --}}
                            </div>
                            <div class="form-group">
                                <label for="exampleInputusername">Username</label>
                                <input readonly type="text" class="form-control" id="exampleInputusername" name="username2" placeholder="Username" value="{{$ref->username}}2">
                            </div>
                            
                            <div class="form-group">
                              <label for="exampleInputEmail1">Email address</label>
                              <input readonly value="{{$ref->usr.'+2@'.$ref->domain}}" type="email" name="email2" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                              {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                            </div>
                            <div class="form-group">
                              <label for="exampleInputPassword1">Password</label>
                              <input readonly type="text" value="the password is the same as the main email" class="form-control" id="exampleInputPassword1" placeholder="Password">
                            </div>
                            @if (in_array($ref->usr.'+2@'.$ref->domain, $reg))
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
                <div class="tab-pane fade show" id="nav-user3" role="tabpanel" aria-labelledby="nav-user3-tab">
                    <div class="card-body">
                        <form action="{{route('user.user3')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="ref_username3">Referral Username</label>
                                <select class="form-select form-control" name="ref_username3" id="ref_username3" required>
                                  <option value="" hidden>-- Select Referral Username --</option>
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
    
                            <div class="form-group">
                                <label for="position3">Position</label>
                                <select class="form-select form-control" name="position3" id="position3" disabled>
                                    <option value="">-- Select Position --</option>
                                </select>
                                <span id="alr3" class="text-danger">Please select Referral Username First!.</span>
                                {{-- <span id="alr" class="text-danger"></span> --}}
                            </div>
                            <div class="form-group">
                                <label for="exampleInputusername">Username</label>
                                <input readonly type="text" class="form-control" id="exampleInputusername" name="username3" placeholder="Username" value="{{$ref->username}}3">
                              </div>
                            
                            <div class="form-group">
                              <label for="exampleInputEmail1">Email address</label>
                              <input readonly value="{{$ref->usr.'+3@'.$ref->domain}}" type="email" name="email3" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                              {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                            </div>
                            <div class="form-group">
                              <label for="exampleInputPassword1">Password</label>
                              <input readonly type="text" value="the password is the same as the main email" class="form-control" id="exampleInputPassword1" placeholder="Password">
                            </div>
                            @if (in_array($ref->usr.'+3@'.$ref->domain, $reg))
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
                <div class="tab-pane fade show" id="nav-user4" role="tabpanel" aria-labelledby="nav-user4-tab">
                    <div class="card-body">
                        <form action="{{route('user.user4')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="ref_username4">Referral Username</label>
                                <select class="form-select form-control" name="ref_username4" id="ref_username4" required>
                                  <option value="" hidden>-- Select Referral Username --</option>
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
    
                            <div class="form-group">
                                <label for="position4">Position</label>
                                <select class="form-select form-control" name="position4" id="position4" disabled>
                                    <option value="">-- Select Position --</option>
                                </select>
                                <span id="alr4" class="text-danger">Please select Referral Username First!.</span>
                                {{-- <span id="alr" class="text-danger"></span> --}}
                            </div>
                            <div class="form-group">
                                <label for="exampleInputusername">Username</label>
                                <input readonly type="text" class="form-control" id="exampleInputusername" name="username4" placeholder="Username" value="{{$ref->username}}4">
                              </div>
                            
                            <div class="form-group">
                              <label for="exampleInputEmail1">Email address</label>
                              <input readonly value="{{$ref->usr.'+4@'.$ref->domain}}" type="email" name="email4" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                              {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                            </div>
                            <div class="form-group">
                              <label for="exampleInputPassword1">Password</label>
                              <input readonly type="text" value="the password is the same as the main email" class="form-control" id="exampleInputPassword1" placeholder="Password">
                            </div>
                            @if (in_array($ref->usr.'+4@'.$ref->domain, $reg))
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
                <div class="tab-pane fade show" id="nav-user5" role="tabpanel" aria-labelledby="nav-user5-tab">
                    <div class="card-body">
                        <form action="{{route('user.user5')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="ref_username5">Referral Username</label>
                                <select class="form-select form-control" name="ref_username5" id="ref_username5" required>
                                  <option value="" hidden>-- Select Referral Username --</option>
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
    
                            <div class="form-group">
                                <label for="position5">Position</label>
                                <select class="form-select form-control" name="position5" id="position5" disabled>
                                    <option value="">-- Select Position --</option>
                                </select>
                                <span id="alr5" class="text-danger">Please select Referral Username First!.</span>
                                {{-- <span id="alr" class="text-danger"></span> --}}
                            </div>
                            <div class="form-group">
                                <label for="exampleInputusername">Username</label>
                                <input readonly type="text" class="form-control" id="exampleInputusername" name="username5" placeholder="Username" value="{{$ref->username}}5">
                              </div>
                            
                            <div class="form-group">
                              <label for="exampleInputEmail1">Email address</label>
                              <input readonly value="{{$ref->usr.'+5@'.$ref->domain}}" type="email" name="email5" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                              {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                            </div>
                            <div class="form-group">
                              <label for="exampleInputPassword1">Password</label>
                              <input readonly type="text" value="the password is the same as the main email" class="form-control" id="exampleInputPassword1" placeholder="Password">
                            </div>
                            @if (in_array($ref->usr.'+5@'.$ref->domain, $reg))
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
                <div class="tab-pane fade show" id="nav-user6" role="tabpanel" aria-labelledby="nav-user6-tab">
                    <div class="card-body">
                        <form action="{{route('user.user6')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="ref_username6">Referral Username</label>
                                <select class="form-select form-control" name="ref_username6" id="ref_username6" required>
                                  <option value="" hidden>-- Select Referral Username --</option>
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
    
                            <div class="form-group">
                                <label for="position6">Position</label>
                                <select class="form-select form-control" name="position6" id="position6" disabled>
                                    <option value="">-- Select Position --</option>
                                </select>
                                <span id="alr6" class="text-danger">Please select Referral Username First!.</span>
                                {{-- <span id="alr" class="text-danger"></span> --}}
                            </div>
                            <div class="form-group">
                                <label for="exampleInputusername">Username</label>
                                <input readonly type="text" class="form-control" id="exampleInputusername" name="username6" placeholder="Username" value="{{$ref->username}}6">
                              </div>
                            
                            <div class="form-group">
                              <label for="exampleInputEmail1">Email address</label>
                              <input readonly value="{{$ref->usr.'+6@'.$ref->domain}}" type="email" name="email6" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                              {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                            </div>
                            <div class="form-group">
                              <label for="exampleInputPassword1">Password</label>
                              <input readonly type="text" value="the password is the same as the main email" class="form-control" id="exampleInputPassword1" placeholder="Password">
                            </div>
                            @if (in_array($ref->usr.'+6@'.$ref->domain, $reg))
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
                <div class="tab-pane fade show" id="nav-user7" role="tabpanel" aria-labelledby="nav-user7-tab">
                    <div class="card-body">
                        <form action="{{route('user.user7')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="ref_username7">Referral Username</label>
                                <select class="form-select form-control" name="ref_username7" id="ref_username7" required>
                                  <option value="" hidden>-- Select Referral Username --</option>
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
    
                            <div class="form-group">
                                <label for="position7">Position</label>
                                <select class="form-select form-control" name="position7" id="position7" disabled>
                                    <option value="">-- Select Position --</option>
                                </select>
                                <span id="alr7" class="text-danger">Please select Referral Username First!.</span>
                                {{-- <span id="alr" class="text-danger"></span> --}}
                            </div>
                            <div class="form-group">
                                <label for="exampleInputusername">Username</label>
                                <input readonly type="text" class="form-control" id="exampleInputusername" name="username7" placeholder="Username" value="{{$ref->username}}7">
                              </div>
                            
                            <div class="form-group">
                              <label for="exampleInputEmail1">Email address</label>
                              <input readonly value="{{$ref->usr.'+7@'.$ref->domain}}" type="email" name="email7" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                              {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                            </div>
                            <div class="form-group">
                              <label for="exampleInputPassword1">Password</label>
                              <input readonly type="text" value="the password is the same as the main email" class="form-control" id="exampleInputPassword1" placeholder="Password">
                            </div>
                            @if (in_array($ref->usr.'+7@'.$ref->domain, $reg))
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
    $('#ref_username1').on('change', function() {
        var id = $('#ref_username1').val();
        // console.log(s);
        $.ajax({
        type:"GET", 
        url: "{{url('/user/cek_pos')}}/"+id, 
        success: function(data) {
                // $("body").append(JSON.stringify(data));
                // console.log(data.response);
                if (data.response == 0) {
                    var options =  '<option value="1">Left</option><option value="2">Right</option>';
                    $('#position1').prop('disabled', false).prop('required', true);
                    $('#alr1').attr("hidden",true);
                    $('#position1').html(options);
                }
                else if (data.response == 1) {
                    var options =  '<option value="1">Left</option>';
                    $('#position1').prop('disabled', false).prop('required', true);
                    $('#alr1').attr("hidden",true);
                    $('#position1').html(options);
                }
                else if (data.response == 2) {
                    var options =  '<option value="2">Right</option>';
                    $('#position1').prop('disabled', false).prop('required', true);
                    $('#alr1').attr("hidden",true);
                    $('#position1').html(options);
                }else{
                    var options =  '<option value="" hidden>Full</option>';
                    $('#position1').prop('disabled', false).prop('required', true);
                    $('#alr1').attr("hidden",false).html('Please select Another Referral Username!.');
                    $('#position1').html(options);
                }
            }, 
        error: function(jqXHR, textStatus, errorThrown) {
                alert(jqXHR.status);
            },
        dataType: "json"
        });
    });
</script>
<script>
    $('#ref_username2').on('change', function() {
        var id = $('#ref_username2').val();
        // console.log(s);
        $.ajax({
        type:"GET", 
        url: "{{url('/user/cek_pos')}}/"+id, 
        success: function(data) {
                // $("body").append(JSON.stringify(data));
                // console.log(data.response);
                if (data.response == 0) {
                    var options =  '<option value="1">Left</option><option value="2">Right</option>';
                    $('#position2').prop('disabled', false).prop('required', true);
                    $('#alr2').attr("hidden",true);
                    $('#position2').html(options);
                }
                else if (data.response == 1) {
                    var options =  '<option value="1">Left</option>';
                    $('#position2').prop('disabled', false).prop('required', true);
                    $('#alr2').attr("hidden",true);
                    $('#position2').html(options);
                }
                else if (data.response == 2) {
                    var options =  '<option value="2">Right</option>';
                    $('#position2').prop('disabled', false).prop('required', true);
                    $('#alr2').attr("hidden",true);
                    $('#position2').html(options);
                }else{
                    var options =  '<option value="" hidden>Full</option>';
                    $('#position2').prop('disabled', false).prop('required', true);
                    $('#alr2').attr("hidden",false).html('Please select Another Referral Username!.');
                    $('#position2').html(options);
                }
            }, 
        error: function(jqXHR, textStatus, errorThrown) {
                alert(jqXHR.status);
            },
        dataType: "json"
        });
    });
</script>
<script>
    $('#ref_username3').on('change', function() {
        var id = $('#ref_username3').val();
        // console.log(s);
        $.ajax({
        type:"GET", 
        url: "{{url('/user/cek_pos')}}/"+id, 
        success: function(data) {
                // $("body").append(JSON.stringify(data));
                // console.log(data.response);
                if (data.response == 0) {
                    var options =  '<option value="1">Left</option><option value="2">Right</option>';
                    $('#position3').prop('disabled', false).prop('required', true);
                    $('#alr3').attr("hidden",true);
                    $('#position3').html(options);
                }
                else if (data.response == 1) {
                    var options =  '<option value="1">Left</option>';
                    $('#position3').prop('disabled', false).prop('required', true);
                    $('#alr3').attr("hidden",true);
                    $('#position3').html(options);
                }
                else if (data.response == 2) {
                    var options =  '<option value="2">Right</option>';
                    $('#position3').prop('disabled', false).prop('required', true);
                    $('#alr3').attr("hidden",true);
                    $('#position3').html(options);
                }else{
                    var options =  '<option value="" hidden>Full</option>';
                    $('#position3').prop('disabled', false).prop('required', true);
                    $('#alr3').attr("hidden",false).html('Please select Another Referral Username!.');
                    $('#position3').html(options);
                }
            }, 
        error: function(jqXHR, textStatus, errorThrown) {
                alert(jqXHR.status);
            },
        dataType: "json"
        });
    });
</script>
<script>
    $('#ref_username4').on('change', function() {
        var id = $('#ref_username4').val();
        // console.log(s);
        $.ajax({
        type:"GET", 
        url: "{{url('/user/cek_pos')}}/"+id, 
        success: function(data) {
                // $("body").append(JSON.stringify(data));
                // console.log(data.response);
                if (data.response == 0) {
                    var options =  '<option value="1">Left</option><option value="2">Right</option>';
                    $('#position4').prop('disabled', false).prop('required', true);
                    $('#alr4').attr("hidden",true);
                    $('#position4').html(options);
                }
                else if (data.response == 1) {
                    var options =  '<option value="1">Left</option>';
                    $('#position4').prop('disabled', false).prop('required', true);
                    $('#alr4').attr("hidden",true);
                    $('#position4').html(options);
                }
                else if (data.response == 2) {
                    var options =  '<option value="2">Right</option>';
                    $('#position4').prop('disabled', false).prop('required', true);
                    $('#alr4').attr("hidden",true);
                    $('#position4').html(options);
                }else{
                    var options =  '<option value="" hidden>Full</option>';
                    $('#position4').prop('disabled', false).prop('required', true);
                    $('#alr4').attr("hidden",false).html('Please select Another Referral Username!.');
                    $('#position4').html(options);
                }
            }, 
        error: function(jqXHR, textStatus, errorThrown) {
                alert(jqXHR.status);
            },
        dataType: "json"
        });
    });
</script>
<script>
    $('#ref_username5').on('change', function() {
        var id = $('#ref_username5').val();
        // console.log(s);
        $.ajax({
        type:"GET", 
        url: "{{url('/user/cek_pos')}}/"+id, 
        success: function(data) {
                // $("body").append(JSON.stringify(data));
                // console.log(data.response);
                if (data.response == 0) {
                    var options =  '<option value="1">Left</option><option value="2">Right</option>';
                    $('#position5').prop('disabled', false).prop('required', true);
                    $('#alr5').attr("hidden",true);
                    $('#position5').html(options);
                }
                else if (data.response == 1) {
                    var options =  '<option value="1">Left</option>';
                    $('#position5').prop('disabled', false).prop('required', true);
                    $('#alr5').attr("hidden",true);
                    $('#position5').html(options);
                }
                else if (data.response == 2) {
                    var options =  '<option value="2">Right</option>';
                    $('#position5').prop('disabled', false).prop('required', true);
                    $('#alr5').attr("hidden",true);
                    $('#position5').html(options);
                }else{
                    var options =  '<option value="" hidden>Full</option>';
                    $('#position5').prop('disabled', false).prop('required', true);
                    $('#alr5').attr("hidden",false).html('Please select Another Referral Username!.');
                    $('#position5').html(options);
                }
            }, 
        error: function(jqXHR, textStatus, errorThrown) {
                alert(jqXHR.status);
            },
        dataType: "json"
        });
    });
</script>
<script>
    $('#ref_username6').on('change', function() {
        var id = $('#ref_username6').val();
        // console.log(s);
        $.ajax({
        type:"GET", 
        url: "{{url('/user/cek_pos')}}/"+id, 
        success: function(data) {
                // $("body").append(JSON.stringify(data));
                // console.log(data.response);
                if (data.response == 0) {
                    var options =  '<option value="1">Left</option><option value="2">Right</option>';
                    $('#position6').prop('disabled', false).prop('required', true);
                    $('#alr6').attr("hidden",true);
                    $('#position6').html(options);
                }
                else if (data.response == 1) {
                    var options =  '<option value="1">Left</option>';
                    $('#position6').prop('disabled', false).prop('required', true);
                    $('#alr6').attr("hidden",true);
                    $('#position6').html(options);
                }
                else if (data.response == 2) {
                    var options =  '<option value="2">Right</option>';
                    $('#position6').prop('disabled', false).prop('required', true);
                    $('#alr6').attr("hidden",true);
                    $('#position6').html(options);
                }else{
                    var options =  '<option value="" hidden>Full</option>';
                    $('#position6').prop('disabled', false).prop('required', true);
                    $('#alr6').attr("hidden",false).html('Please select Another Referral Username!.');
                    $('#position6').html(options);
                }
            }, 
        error: function(jqXHR, textStatus, errorThrown) {
                alert(jqXHR.status);
            },
        dataType: "json"
        });
    });
</script>
<script>
    $('#ref_username7').on('change', function() {
        var id = $('#ref_username7').val();
        // console.log(s);
        $.ajax({
        type:"GET", 
        url: "{{url('/user/cek_pos')}}/"+id, 
        success: function(data) {
                // $("body").append(JSON.stringify(data));
                // console.log(data.response);
                if (data.response == 0) {
                    var options =  '<option value="1">Left</option><option value="2">Right</option>';
                    $('#position7').prop('disabled', false).prop('required', true);
                    $('#alr7').attr("hidden",true);
                    $('#position7').html(options);
                }
                else if (data.response == 1) {
                    var options =  '<option value="1">Left</option>';
                    $('#position7').prop('disabled', false).prop('required', true);
                    $('#alr7').attr("hidden",true);
                    $('#position7').html(options);
                }
                else if (data.response == 2) {
                    var options =  '<option value="2">Right</option>';
                    $('#position7').prop('disabled', false).prop('required', true);
                    $('#alr7').attr("hidden",true);
                    $('#position7').html(options);
                }else{
                    var options =  '<option value="" hidden>Full</option>';
                    $('#position7').prop('disabled', false).prop('required', true);
                    $('#alr7').attr("hidden",false).html('Please select Another Referral Username!.');
                    $('#position7').html(options);
                }
            }, 
        error: function(jqXHR, textStatus, errorThrown) {
                alert(jqXHR.status);
            },
        dataType: "json"
        });
    });
</script>
@endpush