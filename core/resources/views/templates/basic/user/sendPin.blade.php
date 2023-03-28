@extends($activeTemplate . 'user.layouts.app')

@section('panel')
    <div class="row ">
        <div class="col-md-3 col-lg-3 mb-3">
            <div class="card b-radius--10 " style="min-height: 15rem;">
                <div class="card-body text-center" style="display: table; min-height: 15rem; overflow: hidden;">
                    <div style="display: table-cell; vertical-align: middle;">
                        <h3>Available PINs</h3>
                        <h1 class="display-1 font-weight-bold">{{ auth()->user()->pin }}</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-9 col-lg-9 ">
            <div class="card b-radius--10 " style="min-height: 15rem;">
                <div class="card-body">
                    <form action="" method="post" id="formSubBalance">
                        @csrf
                        <div class="form">
                            <input type="hidden" id="user_id">
                            <div class="form-group row">
                                <label for="staticEmail" class="col-sm-2 col-form-label">Account Username<span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control uname" id="username" name="username"
                                        autofocus>
                                    <span class="txt-uname"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword" class="col-sm-2 col-form-label">Transfer Qty<span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control pin" id="pin" name="pin" disabled>
                                    <span class="txt-pin"></span>

                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword" class="col-sm-2 col-form-label"> </label>
                                <div class="col-sm-10">
                                    <button class="btn btn-success btnSend" type="submit" disabled> <i
                                            class="fas fa-paper-plane"></i>
                                        Send PIN</button>
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
        (function($) {
            checkValid();
            $('#username').on('keyup', delay(function(e) {

                var uname = $(this).val();
                $.ajax({
                    url: "{{ url('find-uname') }}" + "/" + uname,
                    cache: false,
                    success: function(res) {
                        if (res.status == 404) {
                            $('.pin').attr('disabled', true);
                            $('.uname').removeClass('is-valid').addClass('is-invalid');
                            $('.txt-uname').addClass('text-danger').removeClass('text-success')
                                .html(res.msg)
                            $('#user_id').val('');

                            checkValid();

                        }
                        if (res.status == 200) {
                            $('.pin').attr('disabled', false).attr('placeholder',
                                "Input PIN Qty").focus();
                            $('.uname').removeClass('is-invalid').addClass('is-valid');
                            $('.txt-uname').addClass('text-success').removeClass('text-danger')
                                .html(res.msg)
                            $('#user_id').val(res.data.id);
                            checkValid();

                        }
                    }
                });
            }, 500))

            $('#pin').on('keyup', delay(function(e) {
                $('.txt-pin').html('');
                const uPin = parseInt("{{ auth()->user()->pin }}"); //60
                let pin = parseInt($(this).val()); //100
                if (uPin > pin) {
                    $('.pin').removeClass('is-invalid').addClass('is-valid');
                    $('.txt-pin').addClass('text-success').removeClass('text-danger').html(
                        'Qty Match');

                    checkValid();

                } else {
                    $('.pin').removeClass('is-valid').addClass('is-invalid');
                    $('.txt-pin').addClass('text-danger').removeClass('text-success').html(
                        'You Not Have Enough PIN to Send');
                    checkValid();

                }
                if (isNaN(pin)) {
                    $('.pin').removeClass('is-invalid is-valid');
                    $('.txt-pin').removeClass('text-danger text-success').addClass('text-secondary').html(
                        'Type PIN Qty');
                    checkValid();

                }

            }, 500))

            function delay(callback, ms) {
                var timer = 0;
                return function() {
                    var context = this,
                        args = arguments;
                    clearTimeout(timer);
                    timer = setTimeout(function() {
                        callback.apply(context, args);
                    }, ms || 0);
                };
            }

            function checkValid() {
                let uname = $('.uname').hasClass('is-valid');
                let pin = $('.pin').hasClass('is-valid');
                if (uname && pin) {
                    $('.btnSend').attr('disabled', false);
                } else {
                    $('.btnSend').attr('disabled', true);
                }
                let userID = $('#user_id').val();
                const url = "{{ url('user/send-pin') }}" + '/' + userID;
                $('#formSubBalance').attr('action', url)

            }


        })(jQuery)
    </script>
@endpush
