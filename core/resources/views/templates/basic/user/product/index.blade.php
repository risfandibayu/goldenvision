@extends($activeTemplate . 'user.layouts.app')

@section('panel')
<div class="row mb-none-30">
    @foreach($product as $data)
    <div class="col-xl-2 col-lg-4 col-md-6 col-sm-6 col-6 mb-30">
        <div class="card h-100">
            <div class="card-body pt-5" >
                <div class="pricing-table text-center mb-4">
                    <img class="img-fluid" src="{{ getImage('assets/images/product/'. $data->image,  null, true)}}" alt="">
                    <h4 class="package-name mb-20 text-"><strong>@lang($data->name)</strong></h4>
                    <p>{{$data->weight}} Gram</p>
                    <p>Rp. {{$data->price}}</p>
                </div>
                <div class="row px-10">
                    {{-- <div class="col-6"> --}}
                        <button
                        data-id="{{ $data->id }}"
                                        data-name="{{ $data->name }}"
                                        data-price="{{ $data->price }}"
                                        data-image="{{ getImage('assets/images/product/'. $data->image,  null, true)}}"
                        data-toggle="modal" class="btn btn--sm btn--danger btn-block buy"><i class="las la-shopping-cart"></i> Buy</button>
                    {{-- </div>
                    <div class="col-6">
                        <button class="btn btn--sm btn--secondary btn-block cart"><i class="las la-shopping-cart"></i> Cart</button>
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
                    <h4 class="modal-title" > Confirm Purchase <span id="prod_name"></span> ?</h4>
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
                            <input class="form-control" type="number" name="qty" id="qty" min="1" placeholder="QTY" required>
                        </div>
                        <div class="form-group col-6">
                            <label for="">total</label>
                            <input class="form-control" type="number" name="total" id="total" value="" placeholder="total" disabled>
                            <input class="form-control" type="hidden" name="totals" id="totals" value="" placeholder="total">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn--danger" data-dismiss="modal"><i class="fa fa-times"></i>
                            @lang('Close')</button>

                        <button type="submit" class="btn btn--success"><i
                                class="lab la-telegram-plane"></i> @lang('Buy')</button>
                    </div>
                </form>
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

            // $('.add-product').on('click', function () {
            //     var modal = $('#add-product');
            //     modal.modal('show');
            // });
        })(jQuery);
</script>
@endpush