@extends('admin.layouts.app')

@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card b-radius--10 ">
                <div class="card-body p-0">
                    <div class="table-responsive--sm table-responsive">
                        <table class="table table--light">
                            <thead>
                            <tr>
                                <th scope="col">@lang('Exchange ID')</th>
                                <th scope="col">@lang('Time')</th>
                                <th scope="col">@lang('Username')</th>
                                <th scope="col">@lang('Product Name')</th>
                                <th scope="col">@lang('Qty')</th>
                                <th scope="col">@lang('Total')</th>
                                <th scope="col">@lang('Status')</th>
                                <th scope="col">@lang('Action')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($items as $item)
                                <tr>
 

                                    <td data-label="@lang('Exchange')">{{$item->ex_id}}</td>
                                    <td data-label="@lang('Time')">{{showDateTime($item->created_at)}}</td>
                                    <td data-label="@lang('Username')"><a href="{{ route('admin.users.detail', $item->usid) }}">{{$item->us}}</a></td>
                                    <td data-label="@lang('Product Name')">{{$item->pdname}}</td>
                                    <td data-label="@lang('Qty')">{{$item->qty}}</td>
                                    <td data-label="@lang('Total')">{{$item->total}}</td>
                                    <td data-label="@lang('Status')">
                                        @if($item->status == 2)
                                        <span class="badge badge--success">@lang('Complete')</span>
                                        @elseif($item->status == 1)
                                            <span class="badge badge--warning">@lang('Pending')</span>
                                        @elseif($item->status == 3)
                                            <span class="badge badge--danger">@lang('Cancel')</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($item->status == 1)
                                            
                                        <button class="icon-btn  ml-1 exchange_verif" data-toggle="tooltip" title=""
                                        data-id="{{$item->id}}"
                                        data-exid="{{$item->ex_id}}"
                                        data-original-title="@lang('Details')">
                                            <i class="las la-desktop"></i>
                                        </button>
                                        @endif

                                        <form id="rform{{$item->id}}" action="{{route('admin.exchange.reject',$item->id)}}" method="post">
                                            @csrf
                                        </form>
                                        <form id="aform{{$item->id}}" action="{{route('admin.exchange.accept',$item->id)}}" method="post">
                                            @csrf
                                        </form>
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
                <div class="card-footer py-4">
                    {{ paginateLinks($items) }}
                </div>
            </div><!-- card end -->
        </div>
    </div>


    <div class="modal fade" id="exchange_verif" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Verification Exchange Request ID : <span id="ex_id"></span></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn--secondary" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn--danger reject">Reject</button>
              <button type="button" class="btn btn--primary accept">Accept</button>
            </div>
          </div>
        </div>
      </div>

     
@endsection
@push('script')
<script>
    "use strict";
        (function ($) {
            $('.exchange_verif').on('click', function () {
                // console.log($(this).data('id'));
                var id = $(this).data('id');
                var modal = $('#exchange_verif');
                modal.find('#ex_id').html($(this).data('exid'));
                modal.find('.reject').on('click',function(){
                    document.getElementById("rform"+id).submit();
                    // console.log(id);
                });
                modal.find('.accept').on('click',function(){
                    document.getElementById("aform"+id).submit();
                    // console.log(id);
                });
        //         modal.find('#prices').val($(this).data('price'));
        //         modal.find('#price').html($(this).data('price'));
        //         modal.find('#weight').val($(this).data('weight'));
        //         modal.find('#tweight').html($(this).data('tweight'));
        //         modal.find('#product_id').val($(this).data('id'));
        //         modal.find('#product_name').val($(this).data('name'));

        //         modal.find('#qty').on('keyup change',function() { 
        // // alert('okl');
        //             modal.find('#total').val(modal.find('#qty').val() * modal.find('#weight').val().replace(/(\.\d{2})\d+/g, '$1'));
        //             modal.find('#total_rp').val(modal.find('#qty').val() * modal.find('#prices').val());
        //             modal.find('#totals').val(modal.find('#qty').val() * modal.find('#weight').val().replace(/(\.\d{2})\d+/g, '$1'));
        //         });
        //         // modal.find('.weight').val($(this).data('weight'));
        //         // var input = modal.find('.image');
        //         // // input.setAttribute("value", "http://localhost/microgold/assets/images/avatar.png");

        //         // if($(this).data('status')){
        //         //     modal.find('.toggle').removeClass('btn--danger off').addClass('btn--success');
        //         //     modal.find('input[name="status"]').prop('checked',true);

        //         // }else{
        //         //     modal.find('.toggle').addClass('btn--danger off').removeClass('btn--success');
        //         //     modal.find('input[name="status"]').prop('checked',false);
        //         // }

        //         // modal.find('input[name=id]').val($(this).data('id'));
                modal.modal('show');
            });

            // $('.modal').on('hidden.bs.modal', function(){
            //     $(this).find('form')[0].reset();
            // });

            // $('.add-product').on('click', function () {
            //     var modal = $('#add-product');
            //     modal.modal('show');
            // });
        })(jQuery);
</script>
@endpush


