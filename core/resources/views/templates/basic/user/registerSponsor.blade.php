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
    <form action="{{ route('user.sponsorRegist.post') }}" method="POST">
        @csrf
        <div class="card">
            <div class="card-footer">
                <div class="form-group row">
                    <label for="sponsor" class="col-sm-2 col-form-label">Sponsor</label>
                    <div class="input-group col-sm-10">
                        <input type="text" class="form-control col-md-2" id="sponsor" name="sponsor"
                            placeholder="Sponsor" value="{{ $user->no_bro }}" readonly>
                        <input type="text" class="form-control col-md-10" id="sponsor" placeholder="Username"
                            value="{{ $user->username }}" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="sponsor" class="col-sm-2 col-form-label">Upline</label>
                    <div class="input-group col-sm-10">
                        <input type="text" class="form-control col-md-2" id="upline" name="upline"
                            placeholder="upline" value="{{ session()->get('SponsorSet')['upline'] ?? '' }}" readonly>
                        <input type="text" class="form-control col-md-10" id="sponsor" placeholder="Username"
                            value="{{ $upline->username }}" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="sponsor" class="col-sm-2 col-form-label">Placement</label>
                    <div class="col-sm-10">
                        <input type="hidden" name="position" id=""
                            value="{{ session()->get('SponsorSet')['position'] }}">
                        <select name="" id="position" class="form-control" disabled>
                            <option value="1" {{ session()->get('SponsorSet')['position'] == 1 ? 'selected' : '' }}>
                                Kiri</option>
                            <option value="2"{{ session()->get('SponsorSet')['position'] == 2 ? 'selected' : '' }}>
                                Kanan</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mt-4">
            <div class="card-body">
                <div class="form-group row">
                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                            name="email" value="{{ old('email') }}" placeholder="email">
                        @error('email')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="username" class="col-sm-2 col-form-label">Username</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control {{ $errors->has('username') ? 'is-invalid' : '' }}"
                            value="{{ old('username') }}" name="username" placeholder="username">
                        @error('username')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="phone" class="col-sm-2 col-form-label">Phone No</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}"
                            value="{{ old('phone') }}" name="phone" placeholder="phone">
                        @error('phone')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <hr>
                <div class="form-group row">
                    <label for="phone" class="col-sm-2 col-form-label">Transfer Pin</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control {{ $errors->has('pin') ? 'is-invalid' : '' }}"
                            value="{{ old('pin') }}" name="pin" placeholder="pin">
                        @error('pin')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <hr>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group ">
                            <label class="form-control-label font-weight-bold">@lang('Bank Name') <span
                                    class="text-danger">*</span></label>
                            {{-- <input class="form-control form-control-lg" type="text" name="firstname"
                                    value="{{auth()->user()->firstname}}" required> --}}
                            <select name="bank_name" id="bank_name"
                                class="form-control form-control select2 {{ $errors->has('bank_name') ? 'is-invalid' : '' }}">
                                <option value="" hidden>-- Pilih Bank --</option>
                                @foreach ($bank as $item)
                                    <option value="{{ $item->nama_bank }}"
                                        {{ $item->nama_bank == old('bank_name') ? 'selected' : '' }}>
                                        {{ $item->nama_bank }}
                                    </option>
                                @endforeach
                            </select>
                            @error('bank_name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-control-label  font-weight-bold">@lang('Bank Branch City')
                                <small>(Optional)</small></label>
                            <input class="form-control form-control {{ $errors->has('kota_cabang') ? 'is-invalid' : '' }}"
                                type="text" name="kota_cabang" value="{{ old('kota_cabang') }}"
                                placeholder="Bank KCP Jakarta">
                            @error('kota_cabang')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-control-label  font-weight-bold">@lang('Account Name') <span
                                    class="text-danger">*</span></label>
                            <input class="form-control form-control {{ $errors->has('acc_name') ? 'is-invalid' : '' }}"
                                type="text" name="acc_name" value="{{ old('acc_name') }}"
                                placeholder="Account Name">
                            @error('acc_name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">

                        <div class="form-group">
                            <label class="form-control-label  font-weight-bold">@lang('Account Number') <span
                                    class="text-danger">*</span></label>
                            <input class="form-control form-control {{ $errors->has('acc_number') ? 'is-invalid' : '' }}"
                                type="text" placeholder="Account Number" name="acc_number"
                                value="{{ old('acc_number') }}">
                            @error('acc_number')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-footer text-center">
                <a href="{{ session()->get('SponsorSet')['url'] ?? '' }}" class="btn btn-warning btn-lg"><i
                        class="fa fa-times"></i> Cancel</a>
                <button type="submit" class="btn btn-success btn-lg"><i class="fa fa-save"></i> Submit</button>
            </div>
        </div>
    </form>
@endsection
