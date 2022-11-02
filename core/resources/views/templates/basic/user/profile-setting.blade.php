@extends($activeTemplate . 'user.layouts.app')

@push('style')
<style>
    .custom-btn {
        width: 130px;
        height: 40px;
        color: #fff;
        border-radius: 5px;
        padding: 10px 25px;
        font-family: 'Lato', sans-serif;
        font-weight: 500;
        background: transparent;
        /* cursor: pointer; */
        transition: all 0.3s ease;
        position: relative;
        display: inline-block;
        box-shadow: inset 2px 2px 2px 0px rgba(255, 255, 255, .5),
            7px 7px 20px 0px rgba(0, 0, 0, .1),
            4px 4px 5px 0px rgba(0, 0, 0, .1);
        outline: none;
    }

    /* 11 */
    .btn-11 {
        display: inline-block;
        outline: none;
        font-family: inherit;
        font-size: 1em;
        box-sizing: border-box;
        border: none;
        border-radius: .3em;
        height: 2.75em;
        line-height: 2.5em;
        text-transform: uppercase;
        padding: 0 1em;
        box-shadow: 0 3px 6px rgba(0, 0, 0, .16), 0 3px 6px rgba(110, 80, 20, .4),
            inset 0 -2px 5px 1px rgba(139, 66, 8, 1),
            inset 0 -1px 1px 3px rgba(250, 227, 133, 1);
        background-image: linear-gradient(160deg, #a54e07, #b47e11, #fef1a2, #bc881b, #a54e07);
        border: 1px solid #a55d07;
        color: rgb(120, 50, 5);
        text-shadow: 0 2px 2px rgba(250, 227, 133, 1);
        /* cursor: pointer; */
        transition: all .2s ease-in-out;
        background-size: 100% 100%;
        background-position: center;
        overflow: hidden;
    }

    /* .btn-11:hover {
    text-decoration: none;
    color: #fff;
} */
    .btn-11:before {
        position: absolute;
        content: '';
        display: inline-block;
        top: -180px;
        left: 0;
        width: 30px;
        height: 100%;
        background-color: #fff;
        animation: shiny-btn1 3s ease-in-out infinite;
    }

    /* .btn-11:hover{
  opacity: .7;
} */
    /* .btn-11:active{
  box-shadow:  4px 4px 6px 0 rgba(255,255,255,.3),
              -4px -4px 6px 0 rgba(116, 125, 136, .2),
    inset -4px -4px 6px 0 rgba(255,255,255,.2),
    inset 4px 4px 6px 0 rgba(0, 0, 0, .2);
} */


    @-webkit-keyframes shiny-btn1 {
        0% {
            -webkit-transform: scale(0) rotate(45deg);
            opacity: 0;
        }

        80% {
            -webkit-transform: scale(0) rotate(45deg);
            opacity: 0.5;
        }

        81% {
            -webkit-transform: scale(4) rotate(45deg);
            opacity: 1;
        }

        100% {
            -webkit-transform: scale(50) rotate(45deg);
            opacity: 0;
        }
    }
</style>
@endpush

@section('panel')

<div class="row mb-none-30">
    <div class="col-xl-3 col-lg-5 col-md-5">
        <div class="card b-radius--10 overflow-hidden box--shadow1">
            <div class="card-body p-0">
                <div class="p-3 bg--white">
                    <img id="output"
                        src="{{ getImage('assets/images/user/profile/'. auth()->user()->image,  null, true)}}"
                        alt="@lang('profile-image')" class="b-radius--10 w-100">


                    <ul class="list-group mt-3">
                        <li class="list-group-item d-flex justify-content-between">
                            <span>@lang('Name')</span> {{auth()->user()->fullname}}
                        </li>
                        <li class="list-group-item rounded-0 d-flex justify-content-between">
                            <span>@lang('Username')</span> {{auth()->user()->username}}
                        </li>
                        {{-- @if (auth()->user()->plan_id != 0)

                        <li class="list-group-item d-flex justify-content-between">
                            <span>@lang('BRO')</span>
                            <div class="custom-btn btn-11 text-center"><span style="font-weight: 700">
                                    {{auth()->user()->bro_qty + 1}} BRO </span></div>
                        </li>
                        @endif --}}
                        <li class="list-group-item d-flex justify-content-between">
                            <span>@lang('Joined at')</span> {{date('d M, Y h:i
                            A',strtotime(auth()->user()->created_at))}}
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Account Status</span>
                            @switch(auth()->user()->is_kyc)
                            @case(0)
                            <span class="badge badge-pill bg--danger">Unverified</span>
                            @break
                            @case(1)
                            <span class="badge badge-pill bg--warning">On Process Verification</span>
                            @break
                            @case(2)
                            <span class="badge badge-pill bg--success">Verified</span>
                            @break
                            @case(3)
                            <span class="badge badge-pill bg--danger">Rejected</span>
                            @break
                            @endswitch
                        </li>
                    </ul>

                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-9 col-lg-7 col-md-7 mb-30">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-50 border-bottom pb-2">{{auth()->user()->fullname}} @lang('Information')</h5>

                <form action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label class="form-control-label font-weight-bold">@lang('First Name') <span
                                        class="text-danger">*</span></label>
                                <input class="form-control form-control-lg" type="text" name="firstname"
                                    value="{{auth()->user()->firstname}}" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label  font-weight-bold">@lang('Last Name') <span
                                        class="text-danger">*</span></label>
                                <input class="form-control form-control-lg" type="text" name="lastname"
                                    value="{{auth()->user()->lastname}}" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        @if (auth()->user()->plan_id != 0)

                        <div class="col-md-6">
                            <div class="form-group ">
                                <label class="form-control-label font-weight-bold">@lang('No MP')<span
                                        class="text-danger">*</span></label>
                                <input class="form-control form-control-lg" type="email"
                                    value="{{auth()->user()->no_bro}}" readonly>
                            </div>
                        </div>
                        @endif

                        <div class="col-md-6">
                            <div class="form-group ">
                                <label class="form-control-label font-weight-bold">@lang('Email')<span
                                        class="text-danger">*</span></label>
                                <input class="form-control form-control-lg" type="email"
                                    value="{{auth()->user()->email}}" readonly>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label  font-weight-bold">@lang('Mobile Number')<span
                                        class="text-danger">*</span></label>
                                <input class="form-control form-control-lg" type="text"
                                    value="{{auth()->user()->mobile}}" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label  font-weight-bold">@lang('Avatar')</label>
                                <input class="form-control form-control-lg" type="file" accept="image/*"
                                    onchange="loadFile(event)" name="image">
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="form-group ">
                                <label class="form-control-label font-weight-bold">@lang('Address') </label>
                                <input class="form-control form-control-lg" type="text" name="address"
                                    value="{{auth()->user()->address->address}}">
                                <small class="form-text text-muted"><i class="las la-info-circle"></i>@lang('House
                                    number, street address')
                                </small>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="form-group">
                                <label class="form-control-label font-weight-bold">@lang('City')</label>
                                <input class="form-control form-control-lg" type="text" name="city"
                                    value="{{auth()->user()->address->city}}">
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="form-group ">
                                <label class="form-control-label font-weight-bold">@lang('State')</label>
                                <input class="form-control form-control-lg" type="text" name="state"
                                    value="{{auth()->user()->address->state}}">
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="form-group ">
                                <label class="form-control-label font-weight-bold">@lang('Zip/Postal')</label>
                                <input class="form-control form-control-lg" type="text" name="zip"
                                    value="{{auth()->user()->address->zip}}">
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="form-group ">
                                <label class="form-control-label font-weight-bold">@lang('Country')</label>
                                <select name="country" class="form-control form-control-lg">
                                    @include('partials.country') </select>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="form-group">
                                <button type="submit" class="btn btn--primary btn-block btn-lg">@lang('Save
                                    Changes')</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-5 col-md-5">
    </div>

    <div class="col-xl-9 col-lg-7 col-md-7 mb-30">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-50 border-bottom pb-2">{{auth()->user()->fullname}} @lang('Bank Account
                    Information')</h5>
                @if ($bank_user)
                <form action="{{route('user.edit_rekening')}}" method="POST" enctype="multipart/form-data" id="edit">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label class="form-control-label font-weight-bold">@lang('Bank Name') <span
                                        class="text-danger">*</span></label>
                                {{-- <input class="form-control form-control-lg" type="text" name="firstname"
                                    value="{{auth()->user()->firstname}}" required> --}}
                                <select name="bank_name" id="bank_name" class="form-control form-control-lg">
                                    @foreach ($bank as $item)
                                    <option value="{{$item->nama_bank}}" {{auth()->user()->userBank->nama_bank ==
                                        $item->nama_bank ? 'selected' : '';}} >{{$item->nama_bank}}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label  font-weight-bold">@lang('Bank Branch City')
                                    <small>(Optional)</small></label>
                                <input class="form-control form-control-lg" type="text" name="kota_cabang"
                                    value="{{auth()->user()->userBank->kota_cabang}}" placeholder="Bank KCP Jakarta">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label  font-weight-bold">@lang('Bank Account Name') <span
                                        class="text-danger">*</span></label>
                                <input class="form-control form-control-lg" type="text" name="acc_name"
                                    value="{{auth()->user()->userBank->nama_akun}}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label  font-weight-bold">@lang('Bank Account Number') <span
                                        class="text-danger">*</span></label>
                                <input class="form-control form-control-lg" type="text" name="acc_number"
                                    value="{{auth()->user()->userBank->no_rek}}" required>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="form-group">
                                <button type="submit" class="btn btn--primary btn-block btn-lg">@lang('Save
                                    Changes')</button>
                            </div>
                        </div>
                    </div>
                </form>
                @else
                <form action="{{route('user.add_rekening')}}" method="POST" enctype="multipart/form-data" id="add">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label class="form-control-label font-weight-bold">@lang('Bank Name') <span
                                        class="text-danger">*</span></label>
                                {{-- <input class="form-control form-control-lg" type="text" name="firstname"
                                    value="{{auth()->user()->firstname}}" required> --}}
                                <select name="bank_name" id="bank_name" class="form-control form-control-lg" required>
                                    <option value="" hidden selected>-- Pilih Bank --</option>
                                    @foreach ($bank as $item)
                                    <option value="{{$item->nama_bank}}">{{$item->nama_bank}}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label  font-weight-bold">@lang('Bank Branch City')
                                    <small>(Optional)</small></label>
                                <input class="form-control form-control-lg" type="text" name="kota_cabang" value=""
                                    placeholder="Bank KCP Jakarta">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label  font-weight-bold">@lang('Account Name') <span
                                        class="text-danger">*</span></label>
                                <input class="form-control form-control-lg" type="text" name="acc_name" value=""
                                    required placeholder="Account Name">
                            </div>
                        </div>
                        <div class="col-md-6">

                            <div class="form-group">
                                <label class="form-control-label  font-weight-bold">@lang('Account Number') <span
                                        class="text-danger">*</span></label>
                                <input class="form-control form-control-lg" type="text" placeholder="Account Number"
                                    name="acc_number" value="" required>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="form-group">
                                <button type="submit" class="btn btn--primary btn-block btn-lg">@lang('Save
                                    Changes')</button>
                            </div>
                        </div>
                    </div>
                </form>
                @endif


            </div>
        </div>
    </div>


    <div class="col-xl-3 col-lg-5 col-md-5">
    </div>

    <div class="col-xl-9 col-lg-7 col-md-7 mb-30">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-10">
                        <h5 class="card-title mb-50 border-bottom pb-2">{{auth()->user()->fullname}} @lang('Shipping
                            Address Information')</h5>
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn--primary add-address">Add New Address</button>
                    </div>
                </div>
                <div class="table-responsive--sm table-responsive">
                    <table class="table table--light style--two">
                        <thead>
                            <tr>
                                <th scope="col">@lang('#')</th>
                                <th scope="col">@lang('Recipient`s name')</th>
                                <th scope="col">@lang('Recipient`s phone number')</th>
                                <th scope="col">@lang('Full Address')</th>
                                <th scope="col">@lang('Postal Code')</th>
                                <th scope="col">@lang('Action')</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 0; ?>
                            @foreach ($alamat as $item)
                            <?php $no++; ?>
                            <tr>
                                <td>{{$no}}</td>
                                <td>{{$item->nama_penerima}}</td>
                                <td>{{$item->no_telp}}</td>
                                <td>{{$item->alamat}}</td>
                                <td>{{$item->kode_pos}}</td>
                                <td data-label="@lang('Action')">
                                    <button type="button" class="icon-btn editaddress" data-toggle="tooltip"
                                    data-id="{{ $item->id }}"
                                        data-alamat="{{ $item->alamat }}"
                                        data-nama_penerima="{{ $item->nama_penerima }}"
                                        data-no_telp="{{ $item->no_telp }}"
                                        data-kode_pos="{{ $item->kode_pos }}"
                                        data-original-title="Edit">
                                        <i class="la la-pencil"></i>
                                    </button>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table><!-- table end -->
                </div>


            </div>
        </div>
    </div>
</div>


<div id="add-address" class="modal  fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">@lang('Add New Address')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="{{route('user.add_address')}}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">

                        <div class="form-group">
                            <label class="font-weight-bold"> @lang('Recipient`s name')</label>
                            {{-- <input class="form-control form-control-lg" type="file" accept="image/*"
                                onchange="loadFile(event)" name="images" required> --}}
                            <input type="text" class="form-control" name="nama_penerima" placeholder="Nama Penerima" required>
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold"> @lang('Recipient`s phone number')</label>
                            {{-- <input class="form-control form-control-lg" type="file" accept="image/*"
                                onchange="loadFile(event)" name="images" required> --}}
                            <input type="text" class="form-control" name="no_telp" placeholder="Nomor Telepon Penerima" required>
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold"> @lang('Full Address')</label>
                            {{-- <input class="form-control form-control-lg" type="file" accept="image/*"
                            onchange="loadFile(event)" name="images" required> --}}
                            <Textarea id="alamat" name="alamat" rows="4"
                            placeholder="Jalan, No Rumah, RT, RW , Kec/Kota, Kab" required></Textarea>
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold"> @lang('Postal Code')</label>
                            {{-- <input class="form-control form-control-lg" type="file" accept="image/*"
                                onchange="loadFile(event)" name="images" required> --}}
                            <input type="text" class="form-control" name="kode_pos" placeholder="Kode Pos Penerima" required>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn-block btn btn--primary">@lang('Submit')</button>
                </div>
            </form>

        </div>
    </div>
</div>
<div id="edit-address" class="modal  fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">@lang('Edit Address')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="{{route('user.edit_address')}}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <input type="hidden" class="id" name="id" id="id">
                    {{-- <div class="form-row">
                        <div class="form-group col">
                            <label class="font-weight-bold"> @lang('Address')</label>
                            <Textarea class="alamat" id="alamat" name="alamat" rows="4"
                                placeholder="Jalan, No Rumah, RT, RW , Kec/Kota, Kab, No Pos"></Textarea>
                        </div>
                    </div> --}}
                    <div class="form-group">
                        <label class="font-weight-bold"> @lang('Recipient`s name')</label>
                        {{-- <input class="form-control form-control-lg" type="file" accept="image/*"
                            onchange="loadFile(event)" name="images" required> --}}
                        <input type="text" class="form-control nama_penerima" id="nama_penerima" name="nama_penerima" placeholder="Nama Penerima" required>
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold"> @lang('Recipient`s phone number')</label>
                        {{-- <input class="form-control form-control-lg" type="file" accept="image/*"
                            onchange="loadFile(event)" name="images" required> --}}
                        <input type="text" class="form-control no_telp" id="no_telp" name="no_telp" placeholder="Nomor Telepon Penerima" required>
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold"> @lang('Full Address')</label>
                        {{-- <input class="form-control form-control-lg" type="file" accept="image/*"
                        onchange="loadFile(event)" name="images" required> --}}
                        <Textarea class="alamat" id="alamat" name="alamat" rows="4"
                        placeholder="Jalan, No Rumah, RT, RW , Kec/Kota, Kab" required></Textarea>
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold"> @lang('Postal Code')</label>
                        {{-- <input class="form-control form-control-lg" type="file" accept="image/*"
                            onchange="loadFile(event)" name="images" required> --}}
                        <input type="text" class="form-control kode_pos" id="kode_pos" name="kode_pos" placeholder="Kode Pos Penerima" required>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn-block btn btn--primary">@lang('Submit')</button>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection

@push('breadcrumb-plugins')
<a href="{{route('user.change-password')}}" class="btn btn--success btn--shadow"><i class="fa fa-key"></i>@lang('Change
    Password')</a>
@endpush



@push('script')
<script>
    'use strict';
        (function($){
            $("select[name=country]").val("{{ auth()->user()->address->country }}");
        })(jQuery)

        var loadFile = function(event) {
            var output = document.getElementById('output');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src)
            }
        };

        $('.add-address').on('click', function () {
                var modal = $('#add-address');
                modal.modal('show');
        });
        $('.editaddress').on('click', function () {
            // console.log($(this).data('alamat'));
                var modal = $('#edit-address');
                modal.find('.id').val($(this).data('id'));
                modal.find('.alamat').val($(this).data('alamat'));
                modal.find('.nama_penerima').val($(this).data('nama_penerima'));
                modal.find('.no_telp').val($(this).data('no_telp'));
                modal.find('.kode_pos').val($(this).data('kode_pos'));
                modal.modal('show');
        });

</script>
@endpush
