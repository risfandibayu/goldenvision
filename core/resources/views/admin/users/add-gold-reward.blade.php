@extends('admin.layouts.app')

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
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-50 border-bottom pb-2">@lang('Weekly Gold Reward')</h5>

                <form action="{{route('admin.users.reward.store-weekly-gold',[$user->id])}}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-control-label font-weight-bold">
                                    @lang('Weekly Gold Reward')
                                </label>
                                <input class="form-control{{ $errors->has('gold') ? ' is-invalid' : '' }}" type="text" name="gold">
                                @error('gold')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="form-group">
                                <button type="submit" class="btn btn--primary btn-block btn-lg">@lang('Save Changes')
                                </button>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('script')
<script>
    'use strict';
        (function($){
            $("select[name=country]").val("{{ @$user->address->country }}");
        })(jQuery)
</script>
@endpush
