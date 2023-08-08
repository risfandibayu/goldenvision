@extends('admin.layouts.app')

@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header ">
                    <button class="btn btn-success float-right" data-toggle="modal" data-target="#exampleModal"><i
                            class="fas fa-plus"></i> Add {{ $page_title }}</button>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive--md table-responsive">
                        <table class="table table--light style--two">
                            <thead>
                                <tr>
                                    <th scope="col">@lang('#')</th>
                                    <th scope="col">@lang('Image')</th>
                                    <th scope="col">@lang('Name')</th>
                                    <th scope="col">@lang('Username')</th>
                                    <th scope="col">@lang('Email')</th>
                                    <th scope="col">@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($admin as $key => $product)
                                    <tr>
                                        <td data-label="@lang('Sl')">{{ $key + 1 }}</td>
                                        <td data-label="@lang('Image')">
                                            <div class="user">
                                                <div class="thumb">
                                                    <img src="{{ getImage(imagePath()['profile']['user']['path'] . '/' . $product->image, imagePath()['profile']['user']['size']) }}"
                                                        alt="@lang('image')">
                                                </div>

                                            </div>

                                        </td>
                                        <td data-label="@lang('Name')">{{ __($product->name) }}</td>
                                        <td data-label="@lang('Username')">{{ __($product->username) }}</td>
                                        <td data-label="@lang('Email')">{{ __($product->email) }}</td>
                                        <td data-label="@lang('Action')">
                                            <button type="button" class="icon-btn edit" data-toggle="tooltip"
                                                data-id="{{ $product->id }}" data-name="{{ $product->name }}"
                                                data-username="{{ $product->username }}" data-email="{{ $product->email }}"
                                                data-original-title="Edit">
                                                <i class="la la-pencil"></i>
                                            </button>
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
                    {{ $admin->links('admin.partials.paginate') }}
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add {{ $page_title }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.adminReward.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="font-weight-bold"> @lang('Name')</label>
                                <input type="text" class="form-control" name="name" placeholder="Name" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="font-weight-bold"> @lang('Username')</label>
                                <input type="text" class="form-control" name="username" placeholder="Username" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col">
                                <label class="font-weight-bold">@lang('Email')</label>
                                <input type="email" class="form-control" name="email" placeholder="Type Email" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="font-weight-bold"> @lang('Password')</label>
                                <input type="password" class="form-control" name="password" placeholder="Password" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="font-weight-bold"> @lang('Retype Password')</label>
                                <input type="password" class="form-control" name="password_confirmation"
                                    placeholder="Retype Password" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save {{ $page_title }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

{{-- @push('breadcrumb-plugins')
<a href="javascript:void(0)" class="btn btn-sm btn--success add-product"><i class="fa fa-fw fa-plus"></i>@lang('Add
    New')</a>
@endpush --}}

@push('script')
    <script>
        "use strict";
        (function($) {
            $('.edit').on('click', function() {
                console.log($(this).data('image'));
                var modal = $('#edit-product');
                modal.find('.name').val($(this).data('name'));
                modal.find('.price').val($(this).data('price'));
                modal.find('.stok').val($(this).data('stok'));
                modal.find('.weight').val($(this).data('weight'));
                var input = modal.find('.image');
                // input.setAttribute("value", "http://localhost/microgold/assets/images/avatar.png");

                if ($(this).data('status')) {
                    modal.find('.toggle').removeClass('btn--danger off').addClass('btn--success');
                    modal.find('input[name="status"]').prop('checked', true);

                } else {
                    modal.find('.toggle').addClass('btn--danger off').removeClass('btn--success');
                    modal.find('input[name="status"]').prop('checked', false);
                }

                modal.find('input[name=id]').val($(this).data('id'));
                modal.modal('show');
            });

            $('.add-product').on('click', function() {
                var modal = $('#add-product');
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
    </script>
@endpush
