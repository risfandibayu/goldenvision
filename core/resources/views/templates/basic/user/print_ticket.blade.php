<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="{{ getImage('assets/images/favicon-new.png') }}">
    {{-- <link rel="icon" type="image/png" href="{{ asset('assets/images/favicon-new.png') }}"> --}}
    <title>{{ $general->sitename($pageTitle) }}</title>
    <style>
        @media screen,
        print {
            body {
                box-sizing: border-box;
                background-color: #eee;
                font-family: "Quicksand", sans-serif;
            }

            h1,
            h2,
            h3,
            h4,
            h5,
            h6 {
                margin: 0;
                color: #456;
            }

            p {
                color: #678;
                margin-top: 10px;
                margin-bottom: 10px;
            }

            ul {
                padding: 0;
                margin: 0;
                list-style: none;
            }

            .d-flex {
                display: flex;
            }

            .flex-wrap {
                flex-wrap: wrap;
            }

            .justify-content-between {
                justify-content: space-between;
            }

            .justify-content-center {
                justify-content: center;
            }

            .cmn-btn {
                position: relative;
                background: #fa9e1b;
                color: white;
                padding: 12px 30px;
                border-radius: 5px;
                font-size: 14px;
                font-weight: 600;
                z-index: 2;
                overflow: hidden;
                -webkit-transition: all ease 0.5s;
                -moz-transition: all ease 0.5s;
                transition: all ease 0.5s;
                outline: none;
                box-shadow: none;
                border: none;
                margin-top: 20px;
                cursor: pointer;
            }

            .print-btn {
                text-align: center;
            }

            .ticket-wrapper {
                width: 7.5in;
                margin: 0 auto;
                padding: 20px;
                border-radius: 10px;
                background: #fff;
                box-shadow: 0 5px 35px rgba(0, 0, 0, .1);
            }

            .ticket-inner {
                border: 2px solid #ccd;
                padding: 30px;
                border-radius: 5px;
                padding-bottom: 0px;
            }

            .ticket-header {
                text-align: center;
            }

            .ticket-header .title {
                font-size: 22px;
            }


            @media (min-width:992px) {
                .ticket-body-part {
                    width: 50%;
                }
            }

            .ticket-info {
                display: flex;
                flex-wrap: wrap;
                align-items: center;

            }


            .ticket-body {
                padding: 20px;
                font-size: 15px;
            }

            .text-right {
                text-align: right;
            }

            .text-left {
                text-align: left;
            }

            .ticket-logo {
                width: 120px;
                margin: 0 auto 15px;
            }

            .ticket-logo img {
                width: 100%;
            }

            .border {
                border: 1px solid #eef !important;
            }

            .info {
                margin-bottom: 15px;
            }


        }

        @media print {
            .p-50 {
                padding: 0 50px;
            }
        }
    </style>
</head>

<body>

    <div id="block1">
        <div class="ticket-wrapper">
            <div class="ticket-inner">
                <div class="ticket-header">
                    <div class="ticket-logo"><img src="{{ getImage('assets/images/reward/' . $ticket->rewa->images, null, true) }}" alt="Logo"></div>
                    <div class="ticket-header-content">
                        <h4 class="title">{{ __(@$ticket->rewa->reward) }}</h4>
                        <p class="info">@lang('E-Ticket/ Reservation Voucher')</p>
                    </div>
                </div>
                <div class="border"></div>
                <div class="ticket-body d-flex flex-wrap">
                    <div class="p-50 ticket-body-part">
                        <table class="">
                            <tbody>
                                <tr>
                                    <td class="text-right">
                                        <p class="title">@lang('Ticket Number')</p>
                                    </td>
                                    <td>
                                        <b>:</b>
                                    </td>
                                    <td class="text-left">
                                        <h5 class="value">{{ __($ticket->trx) }}</h5>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-right">
                                        <p class="title">@lang('Name')</p>
                                    </td>
                                    <td>
                                        <b>:</b>
                                    </td>
                                    <td class="text-left">
                                        <h5 class="value">{{ $ticket->user->firstname}} {{ $ticket->user->lastname }}</h5>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="p-50 ticket-body-part">
                        <table class="">
                            <tbody>
                                <tr>
                                    <td class="text-right">
                                        <p class="title">@lang('MP Number')</p>
                                    </td>
                                    <td>
                                        <b>:</b>
                                    </td>
                                    <td class="text-left">
                                        <h5 class="value">{{$ticket->user->no_bro}}</h5>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-right">
                                        <p class="title">@lang('Email')</p>
                                    </td>
                                    <td>
                                        <b>:</b>
                                    </td>
                                    <td class="text-left">
                                        <h5 class="value">{{$ticket->user->email}}</h5>
                                    </td>
                                </tr>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="print-btn">
        <button type="button" class="cmn-btn btn-download" id="demo">@lang('Download Ticket')</button>
    </div>


    @php
    $fileName = slug($ticket->user->username).'_'.time()
    @endphp
    <!-- jquery -->
    <script src="{{asset('assets/templates/basic/js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset('assets/templates/basic/js/html2pdf.bundle.min.js')}}"></script>
    <script>
        "use strict";
        const options = {
            margin: 0.3,
            filename: `{{ $fileName }}`,
            image: {
                type: 'jpeg',
                quality: 0.98
            },
            html2canvas: {
                scale: 2
            },
            jsPDF: {
                unit: 'in',
                format: 'A4',
                orientation: 'landscape'
            }
        }

        var objstr = document.getElementById('block1').innerHTML;
        var strr = objstr;
        $(document).on('click', '.btn-download', function(e) {
            e.preventDefault();
            var element = document.getElementById('demo');
            html2pdf().from(strr).set(options).save();
        });
    </script>
</body>

</html>
