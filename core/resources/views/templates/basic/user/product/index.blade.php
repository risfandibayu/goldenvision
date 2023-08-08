@extends($activeTemplate . 'user.layouts.app')

@section('panel')
<div class="row">
    
    @if (count($corder) > 0)
    <div class="col-md-12 mb-20">
        <div class="card b-radius--10">
            <div class="card-body p-0">
                <div class="table-responsive--sm table-responsive">
                    <table class="table table--light style--two">
                        <thead>
                        <tr>
                            <th scope="col">@lang('Order ID')</th>
                            <th scope="col">@lang('Date')</th>
                            <th scope="col">@lang('Name')</th>
                            <th scope="col">@lang('Type')</th>
                            <th scope="col">@lang('QTY')</th>
                            <th scope="col">@lang('Total')</th>
                            <th scope="col">@lang('Status')</th>
                            <th scope="col">@lang('Action')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($corder as $item)
                            <tr>
                                <td data-label="@lang('Date')"> {{ $item->trx }}</td>
                                <td data-label="@lang('Date')"> {{ showDateTime($item->created_at) }}</td>
                                <td data-label="@lang('Date')"> {{ $item->name }}</td>
                                <td data-label="@lang('Date')"> {{ $item->prod->weight }} gr</td>
                                <td data-label="@lang('Date')"> {{ $item->qty }} pieces</td>
                                <td data-label="@lang('Date')">Rp. {{ nb($item->qty * $item->prod->price) }}</td>
                                <td data-label="@lang('Status')">
                                    @if($item->status == 2)
                                            <span class="badge badge--warning">@lang('Pending')</span>
                                        @elseif($item->status == 1)
                                            <span class="badge badge--success">@lang('Complete')</span>
                                        @elseif($item->status == 3)
                                            <span class="badge badge--primary">@lang('Accepted. On Process')</span>
                                        @elseif($item->status == 4)
                                            <span class="badge badge--danger">@lang('Rejected')</span>
                                        @endif
                                    @if($item->admin_feedback != null)
                                                <button class="btn--info btn-rounded  badge detailBtn"
                                                        data-admin_feedback="{{$item->admin_feedback}}"><i
                                                        class="fa fa-info"></i></button>
                                    @endif
                                </td>
                                <td data-label="@lang('Action')">
                                    <button 
                                    data-id="{{ $item->id }}"
                                    data-status="{{ $item->status }}"
                                    data-front="{{ getImage('assets/images/cproduct/f/'. $item->front,  null, true)}}"
                                    data-back="{{ getImage('assets/images/cproduct/b/'. $item->back,  null, true)}}"
                                    data-name="{{ $item->name }}"
                                        class="icon-btn ml-1 detailOrder" data-toggle="tooltip" title=""
                                        data-original-title="@lang('Detail')">
                                        <i class="la la-eye"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table><!-- table end -->
                </div>
            </div>
        </div><!-- card end -->
    </div>
    @endif

    @foreach($product as $data)
    <div class="col-xl-2 col-lg-4 col-md-6 col-sm-6 col-6 mb-30">
        <div class="card h-100">
            <div class="card-body pt-5">
                <div class="pricing-table text-center mb-4">
                    <img class="img-fluid" src="{{ getImage('assets/images/product/'. $data->image,  null, true)}}"
                        alt="">
                    <h4 class="package-name mb-20 text-"><strong>@lang($data->name)</strong></h4>
                    <p>{{nbk($data->weight)}} Gram</p>
                    <p>Rp. {{nb($data->price)}}</p>
                </div>
                <div class="row px-10">
                    {{-- <div class="col-6"> --}}
                        <button data-id="{{ $data->id }}" data-name="{{ $data->name }}" data-price="{{ $data->price }}"
                            data-image="{{ getImage('assets/images/product/'. $data->image,  null, true)}}"
                            data-toggle="modal" class="btn btn--sm btn--danger btn-block buy"><i
                                class="las la-shopping-cart"></i> Buy</button>
                        {{--
                    </div>
                    <div class="col-6">
                        <button class="btn btn--sm btn--secondary btn-block cart"><i class="las la-shopping-cart"></i>
                            Cart</button>
                    </div> --}}
                </div>
            </div>

        </div><!-- card end -->
    </div>
    @endforeach

    <div class="modal fade" id="buy-product" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"> Confirm Purchase <span id="prod_name"></span> ?</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <form method="post" action="{{route('user.product.purchase')}}">
                    {{-- <form method="post"> --}}
                        {{-- <div class="modal-body"> --}}
                            {{-- </div> --}}
                        @csrf
                        <div class="modal-body row">
                            <div class="px-100">
                                <img src="" alt="" id="img" class="img-fluid">
                            </div>
                            <h5 class="text-center col-12"><span id="price"></span> {{$general->cur_text}} / Item</h5>
                            <input type="hidden" name="prices" id="prices" value="">
                            <input type="hidden" name="product_id" id="product_id" value="">
                            <input type="hidden" name="product_name" id="product_name" value="">
                            <div class="form-group col-6">
                                <label for="">QTY</label>
                                <input class="form-control" type="number" name="qty" id="qty" min="1" placeholder="QTY"
                                    required>
                            </div>
                            <div class="form-group col-6">
                                <label for="">total</label>
                                <input class="form-control" type="number" name="total" id="total" value=""
                                    placeholder="total" disabled>
                                <input class="form-control" type="hidden" name="totals" id="totals" value=""
                                    placeholder="total">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn--danger" data-dismiss="modal"><i
                                    class="fa fa-times"></i>
                                @lang('Close')</button>

                            <button type="submit" class="btn btn--success"><i class="lab la-telegram-plane"></i>
                                @lang('Buy')</button>
                        </div>
                    </form>
            </div>
        </div>
    </div>


    <div id="custom-order" class="modal  fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Order Custom Product')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="{{route('user.product.custom')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">

                            <div class="px-100 col-6">
                                <img src="" alt="" id="imgfadd" class="img-fluid">
                            </div>
                            <div class="px-100 col-6">
                                <img src="" alt="" id="imgbadd" class="img-fluid">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col">
                                <label class="font-weight-bold" for="">Name</label>
                                <input class="form-control " type="text" name="name" id="name" placeholder="Design Name"
                                    required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col">
                                <label class="font-weight-bold"> @lang('Front Design') <small>(recommended image ratio
                                        9:16)</small></label>
                                <input class="form-control form-control-lg" type="file" accept="image/*"
                                    onchange="loadFilefadd(event)" name="front" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col">
                                <label class="font-weight-bold"> @lang('Back Design') <small>(recommended image ratio
                                        9:16)</small></label>
                                <input class="form-control form-control-lg" type="file" accept="image/*"
                                    onchange="loadFilebadd(event)" name="back" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col">
                                <label class="font-weight-bold"> @lang('Type')</label>
                                <select name="prod_id" id="prod_id" class="form-control type">
                                    <option value="" hidden selected>-- Select Type --</option>
                                    @foreach ($cproduct as $item)
                                    <option value="{{$item->id}}" data-price="{{$item->price}}"> {{$item->weight}} gr</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col">
                                <label class="font-weight-bold" for="">QTY</label>
                                <input class="form-control " type="number" name="qty" id="cqty" min="1" placeholder="QTY"
                                    required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col">
                                <label class="font-weight-bold" for="">Total</label>
                                {{-- <input type="hidden" name="cprice" > --}}
                                <input class="form-control ctotal" type="number" name="total" id="ctotal" min="1" placeholder=""
                                    readonly>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn-block btn btn--primary">@lang('Purchase')</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <div id="detail-order" class="modal  fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Preview Custom Design Order')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="{{route('user.product.rcustom')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">

                            <div class="px-100 col-6">
                                <img src="" alt="" id="imgf" class="img-fluid">
                            </div>
                            <div class="px-100 col-6">
                                <img src="" alt="" id="imgb" class="img-fluid">
                            </div>
                        </div>
                        <input type="hidden" id="id" name="id">
                        <div class="form-row">
                            <div class="form-group col">
                                <label class="font-weight-bold" for="">Name</label>
                                <input class="form-control " type="text" name="name" id="name" placeholder="Design Name"
                                    required>
                            </div>
                        </div>
                        <div class="form-row hidden" id="ifront" >
                            <div class="form-group col">
                                <label class="font-weight-bold"> @lang('Front Design') <small>(recommended image ratio
                                        9:16)</small></label>
                                <input class="form-control form-control-lg ifront" type="file" accept="image/*"
                                    onchange="loadFilef(event)" name="front" required>
                            </div>
                        </div>
                        <div class="form-row hidden" id="iback" >
                            <div class="form-group col">
                                <label class="font-weight-bold"> @lang('Back Design') <small>(recommended image ratio
                                        9:16)</small></label>
                                <input class="form-control form-control-lg" type="file" accept="image/*"
                                    onchange="loadFileb(event)" name="back" required>
                            </div>
                        </div>
                        
                    </div>
                    <div class="modal-footer hidden" id="btnr" >
                        <button type="submit" class="btn-block btn btn--primary btnr" >@lang('Resubmit')</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <div id="detailModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Details')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="@lang('Close')">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="withdraw-detail"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn--danger" data-dismiss="modal">@lang('Close')</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')

<script>
    // $('input[name=qty]').on('keyup change',function() { 
    //     // alert('okl');
    //     $('input[name=total]').val($('input[name=qty]').val() * $('input[name=prices]').val());
    //     $('input[name=totals]').val($('input[name=qty]').val() * $('input[name=prices]').val());
    // });
</script>
<script>
    "use strict";
        (function ($) {
            $('.buy').on('click', function () {
                // console.log($(this).data('name'));
                var modal = $('#buy-product');
                modal.find('#img').attr("src",$(this).data('image'));
                modal.find('#prod_name').html($(this).data('name'));
                modal.find('#prices').val($(this).data('price'));
                modal.find('#price').html($(this).data('price'));
                modal.find('#product_id').val($(this).data('id'));
                modal.find('#product_name').val($(this).data('name'));

                modal.find('#qty').on('keyup change',function() { 
        // alert('okl');
                    modal.find('#total').val(modal.find('#qty').val() * modal.find('#prices').val());
                    modal.find('#totals').val(modal.find('#qty').val() * modal.find('#prices').val());
                });
                // modal.find('.weight').val($(this).data('weight'));
                // var input = modal.find('.image');
                // // input.setAttribute("value", "http://localhost/microgold/assets/images/avatar.png");

                // if($(this).data('status')){
                //     modal.find('.toggle').removeClass('btn--danger off').addClass('btn--success');
                //     modal.find('input[name="status"]').prop('checked',true);

                // }else{
                //     modal.find('.toggle').addClass('btn--danger off').removeClass('btn--success');
                //     modal.find('input[name="status"]').prop('checked',false);
                // }

                // modal.find('input[name=id]').val($(this).data('id'));
                modal.modal('show');
            });

            $('.modal').on('hidden.bs.modal', function(){
                $(this).find('form')[0].reset();
            });

            $('.custom-order').on('click', function () {
                var modal = $('#custom-order');
                $("#prod_id").change(function() {
                    var selectedItem = $(this).val();
                    var abc = $('option:selected',this).data("price");
                    // alert(abc);
                    modal.find('#ctotal').val("");
                    modal.find('#cqty').val("");
                    modal.find('#cqty').on('keyup change',function() { 
        // // alert('okl');
                    
                        modal.find('#ctotal').val(modal.find('#cqty').val() * abc);
                    });
                });
                // console.log($(".type option:selected").attr('data-price'));
                // modal.find('prod_id').val($(this).data('price'));
        //         modal.find('#qty').on('keyup change',function() { 
        // // alert('okl');
                    
        //             modal.find('#ctotal').val(modal.find('#cqty').val() * modal.find('#cprice').val());
        //         });
                modal.modal('show');
            });

            $('.detailBtn').on('click', function () {
                var modal = $('#detailModal');
                var feedback = $(this).data('admin_feedback');
                modal.find('.withdraw-detail').html(`<p> ${feedback} </p>`);
                modal.modal('show');
            });
            $('.detailOrder').on('click', function () {
                var modal = $('#detail-order');
                console.log($(this).data('status'));
                // var feedback = $(this).data('admin_feedback');
                // modal.find('.withdraw-detail').html(`<p> ${feedback} </p>`);
                modal.find('#imgf').attr("src",$(this).data('front'));
                modal.find('#imgb').attr("src",$(this).data('back'));
                modal.find('#name').val($(this).data('name'));
                modal.find('#id').val($(this).data('id'));
                if ($(this).data('status') === 4) {
                    // console.log('oi');
                    modal.find('#ifront').removeClass("hidden");
                    modal.find('#iback').removeClass("hidden");
                    modal.find('#btnr').removeClass("hidden");
                }else{
                    // modal.find('#ifront').attr("src",false);
                    // console.log('sip');

                }
                modal.modal('show');
            });
        })(jQuery);
</script>
<script>
    var loadFile = function(event) {
            var output = document.getElementById('output');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src)
            }
        };
    var loadFilef = function(event) {
            var output = document.getElementById('imgf');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src)
            }
        };
    var loadFileb = function(event) {
            var output = document.getElementById('imgb');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src)
            }
        };
    var loadFilefadd = function(event) {
            var output = document.getElementById('imgfadd');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src)
            }
        };
    var loadFilebadd = function(event) {
            var output = document.getElementById('imgbadd');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src)
            }
        };

</script>
@endpush
@push('breadcrumb-plugins')
<a href="javascript:void(0)" class="btn btn-sm btn--success custom-order"><i
        class="fa fa-fw fa-shopping-cart"></i>@lang('Order Custom Design')</a>
@endpush
@push('style')
<style>
    .hidden {display:none;}
</style>
@endpush
