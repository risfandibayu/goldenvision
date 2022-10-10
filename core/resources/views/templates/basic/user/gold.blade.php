@extends($activeTemplate . 'user.layouts.app')

@section('panel')

<div class="row">

    <div class="col-lg-12 mb-20">
        <div class="card b-radius--10 ">
            <div class="card-body p-0">

                <div class="table-responsive--sm table-responsive">
                    <table class="table table--light style--two">
                        <thead>
                        <tr>
                            <th scope="col">@lang('Name')</th>
                            <th scope="col">@lang('Price')</th>
                            <th scope="col">@lang('Type')</th>
                            <th scope="col">@lang('Qty')</th>
                            <th scope="col">@lang('Total')</th>
                            <th scope="col">@lang('Weight Total')</th>
                            {{-- <th scope="col">@lang('Action')</th> --}}
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($gold_bro as $gd)
                            <tr>
                                <td data-label="@lang('Name')">{{$gd->name}}</td>
                                <td data-label="@lang('Price')">{{nb($gd->price)}} IDR</td>
                                <td data-label="@lang('Type')">{{nbk($gd->weight)}} gr</td>
                                <td data-label="@lang('Qty')">{{nb($gd->qty)}} pcs</td>
                                <td data-label="@lang('Total')">{{nb($gd->total_rp)}} IDR</td>
                                <td data-label="@lang('Weight Total')">{{nbk($gd->total_wg)}} gr</td>
                                {{-- <td data-label="@lang('Action')">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <button class="btn btn--sm btn--primary delivery"
                                            data-gid="{{ $gd->gid }}"
                                                    data-name="{{ $gd->name }}"
                                                    data-price="{{ $gd->price }}"
                                                    data-weight="{{ $gd->weight }}"
                                                    data-tweight="{{ $gd->total_wg }}"
                                                    data-image="{{ getImage('assets/images/product/'. $gd->image,  null, true)}}">
                                                <i class="las la-truck"></i> 
                                                Delivery
                                            </button>
                                        </div>
                                        <div class="col-md-6">
                                            <button class="btn btn--sm btn--primary exchange"
                                            data-id="{{ $gd->id }}"
                                                    data-name="{{ $gd->name }}"
                                                    data-price="{{ $gd->price }}"
                                                    data-weight="{{ $gd->weight }}"
                                                    data-tweight="{{ $gd->total_wg }}"
                                                    data-image="{{ getImage('assets/images/product/'. $gd->image,  null, true)}}">
                                                <i class="las la-sync"></i> 
                                                Exchange
                                            </button>
                                        </div>
                                    </div>
                                
                                </td> --}}

                            </tr>
                        @empty
                            <tr>
                                <td class="text-muted text-center" colspan="100%">{{ __($empty_message) }}</td>
                            </tr>
                        @endforelse

                        </tbody>
                    </table><!-- table end -->
                </div>
            </div>
            {{-- <div class="card-footer py-4">
                {{ $gold->links($activeTemplate .'user.partials.paginate') }}
            </div> --}}
        </div><!-- card end -->
    </div>
    <div class="col-lg-12">
        <div class="card b-radius--10 ">
            <div class="card-body p-0">

                <div class="table-responsive--sm table-responsive">
                    <table class="table table--light style--two">
                        <thead>
                        <tr>
                            <th scope="col">@lang('Name')</th>
                            <th scope="col">@lang('Price')</th>
                            <th scope="col">@lang('Type')</th>
                            <th scope="col">@lang('Qty')</th>
                            <th scope="col">@lang('Total')</th>
                            <th scope="col">@lang('Weight Total')</th>
                            <th scope="col">@lang('Action')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($gold as $gd)
                            <tr>
                                <td data-label="@lang('Name')">{{$gd->name}}</td>
                                <td data-label="@lang('Price')">{{nb($gd->price)}} IDR</td>
                                <td data-label="@lang('Type')">{{nbk($gd->weight)}} gr</td>
                                <td data-label="@lang('Qty')">{{nb($gd->qty)}} pcs</td>
                                <td data-label="@lang('Total')">{{nb($gd->total_rp)}} IDR</td>
                                <td data-label="@lang('Weight Total')">{{nbk($gd->total_wg)}} gr</td>
                                <td data-label="@lang('Action')">
                                    {{-- <div class="row">
                                        <div class="col-md-6"> --}}
                                            <button class="btn btn--sm btn--primary delivery"
                                            data-gid="{{ $gd->gid }}"
                                                    data-name="{{ $gd->name }}"
                                                    data-price="{{ $gd->price }}"
                                                    data-weight="{{ $gd->weight }}"
                                                    data-tweight="{{ $gd->total_wg }}"
                                                    data-image="{{ getImage('assets/images/product/'. $gd->image,  null, true)}}">
                                                <i class="las la-truck"></i> 
                                                Delivery
                                            </button>
                                        {{-- </div>
                                        <div class="col-md-6">
                                            <button class="btn btn--sm btn--primary exchange"
                                            data-id="{{ $gd->id }}"
                                                    data-name="{{ $gd->name }}"
                                                    data-price="{{ $gd->price }}"
                                                    data-weight="{{ $gd->weight }}"
                                                    data-tweight="{{ $gd->total_wg }}"
                                                    data-image="{{ getImage('assets/images/product/'. $gd->image,  null, true)}}">
                                                <i class="las la-sync"></i> 
                                                Exchange
                                            </button>
                                        </div>
                                    </div> --}}
                                
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td class="text-muted text-center" colspan="100%">{{ __($empty_message) }}</td>
                            </tr>
                        @endforelse

                        </tbody>
                    </table><!-- table end -->
                </div>
            </div>
            {{-- <div class="card-footer py-4">
                {{ $gold->links($activeTemplate .'user.partials.paginate') }}
            </div> --}}
        </div><!-- card end -->
    </div>
</div>

<div class="modal fade" id="gold-exchange" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" > Confirm Exchange <span id="prod_name"></span> ?</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <form method="post" action="{{route('user.gold.exchange')}}">
                {{-- <form method="post"> --}}
                    {{-- <div class="modal-body"> --}}
                        {{-- </div> --}}
                    @csrf
                    <div class="modal-body row">
                        <div class="px-100">
                            <img src="" alt="" id="img" class="img-fluid">
                        </div>
                        {{-- <h5 class="text-center col-12"><span id="price"></span> {{$general->cur_text}} / Item</h5> --}}
                        <h5 class="text-center col-12">Your Gold Weight Total : <span id="tweight"></span> gr</h5>
                        <input type="hidden" name="weight" id="weight" value="">
                        <input type="hidden" name="prices" id="prices" value="">
                        <input type="hidden" name="product_id" id="product_id" value="">
                        <input type="hidden" name="product_name" id="product_name" value="">
                        <div class="form-group col-6">
                            <label for="">QTY</label>
                            <input class="form-control" type="number" name="qty" id="qty" min="1" placeholder="QTY" required>
                        </div>
                        <div class="form-group col-6">
                            <label for="">Weight total (gr)</label>
                            <input class="form-control" type="number" maxlength="2" name="total" id="total" value="" placeholder="total" disabled>
                            <input type="hidden" name="totals" id="totals" value="" placeholder="total">
                        </div>
                        <div class="form-group col-12">
                            <label for="">Amount total (IDR)</label>
                            <input class="form-control" type="number" name="total_rp" id="total_rp" value="" placeholder="total" disabled>
                            {{-- <input type="hidden" name="totals" id="totals" value="" placeholder="total"> --}}
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn--danger" data-dismiss="modal"><i class="fa fa-times"></i>
                            @lang('Close')</button>

                        <button type="submit" class="btn btn--success"><i
                                class="lab la-telegram-plane"></i> @lang('Exchange')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<div class="modal fade" id="gold-delivery" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" > Confirm Devlivery <span id="prod_name"></span> ?</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <form method="post" action="{{route('user.gold.delivery')}}">
                {{-- <form method="post"> --}}
                    {{-- <div class="modal-body"> --}}
                        {{-- </div> --}}
                    @csrf
                    <div class="modal-body row">
                        <div class="px-100">
                            <img src="" alt="" id="img" class="img-fluid">
                        </div>
                        <input type="hidden" name="gid" id="gid">
                        {{-- <h5 class="text-center col-12"><span id="price"></span> {{$general->cur_text}} / Item</h5> --}}
                        <h5 class="text-center col-12">Your Gold Weight Total : <span id="tweight"></span> gr</h5>
                        <div class="form-group col-12">
                            <label for="">QTY</label>
                            <input class="form-control" type="number" name="qty" id="qty" min="1" placeholder="QTY" required>
                        </div>
                        <div class="form-group col-12">
                            <label for="">Address</label>
                            <select name="alamat" id="alamat" class="form-control"  required>
                                <option value="" hidden selected>-- Chosse Address --</option>
                                @foreach ($alamat as $item)
                                    <option value="{{$item->id}}">{{$item->nama_penerima .' | '. Str::limit($item->alamat,20)}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn--danger" data-dismiss="modal"><i class="fa fa-times"></i>
                            @lang('Close')</button>

                        <button type="submit" class="btn btn--success"><i
                                class="lab la-telegram-plane"></i> @lang('Delivery')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('script')
<script>
    "use strict";
        (function ($) {
            $('.exchange').on('click', function () {
                // console.log($(this).data('weight'));
                var modal = $('#gold-exchange');
                modal.find('#img').attr("src",$(this).data('image'));
                modal.find('#prod_name').html($(this).data('name'));
                modal.find('#prices').val($(this).data('price'));
                modal.find('#price').html($(this).data('price'));
                modal.find('#weight').val($(this).data('weight'));
                modal.find('#tweight').html($(this).data('tweight'));
                modal.find('#product_id').val($(this).data('id'));
                modal.find('#product_name').val($(this).data('name'));

                modal.find('#qty').on('keyup change',function() { 
        // alert('okl');
                    modal.find('#total').val(modal.find('#qty').val() * modal.find('#weight').val().replace(/(\.\d{2})\d+/g, '$1'));
                    modal.find('#total_rp').val(modal.find('#qty').val() * modal.find('#prices').val());
                    modal.find('#totals').val(modal.find('#qty').val() * modal.find('#weight').val().replace(/(\.\d{2})\d+/g, '$1'));
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

            $('.delivery').on('click', function () {
                // console.log($(this).data('weight'));
                var modal = $('#gold-delivery');
                modal.find('#img').attr("src",$(this).data('image'));
                modal.find('#prod_name').html($(this).data('name'));
                modal.find('#gid').val($(this).data('gid'));
                modal.find('#prices').val($(this).data('price'));
                modal.find('#price').html($(this).data('price'));
                modal.find('#weight').val($(this).data('weight'));
                modal.find('#tweight').html($(this).data('tweight'));
                modal.find('#product_id').val($(this).data('id'));
                modal.find('#product_name').val($(this).data('name'));

                modal.modal('show');
            });

            $('.modal').on('hidden.bs.modal', function(){
                $(this).find('form')[0].reset();
            });

            // $('.add-product').on('click', function () {
            //     var modal = $('#add-product');
            //     modal.modal('show');
            // });
        })(jQuery);
</script>
@endpush
