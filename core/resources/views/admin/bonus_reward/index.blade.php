@extends('admin.layouts.app')

@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body p-0">
                    <div class="table-responsive--md table-responsive">
                        <table class="table table--light style--two">
                            <thead>
                                <tr>
                                    <th scope="col">@lang('Sl')</th>
                                    <th scope="col">@lang('Image')</th>
                                    <th scope="col">@lang('Kiri')</th>
                                    <th scope="col">@lang('Kanan')</th>
                                    <th scope="col">@lang('Reward')</th>
                                    <th scope="col">@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($table as $key => $k)
                                    <tr>
                                        <td data-label="@lang('No')">{{ $key + 1 }}</td>
                                        <td data-label="@lang('Image')">
                                            <img style="width: 300px"
                                                src="{{ asset('assets/images/reward/' . $k->images) }}"
                                                alt="Image {{ $k->name }}" class="img-fluid">
                                        </td>
                                        <td data-label="@lang('kiri')">
                                            {{ $k->kiri }}
                                        </td>
                                        <td data-label="@lang('kanan')">
                                            {{ $k->kanan }}
                                        </td>
                                        <td data-label="@lang('reward')">
                                            {{ $k->reward }}
                                        </td>

                                        <td data-label="@lang('Action')">
                                            <button type="button" class="icon-btn edit" data-toggle="tooltip"
                                                data-id="{{ $k->id }}"
                                                data-kiri="{{ $k->kiri }}"
                                                data-kanan="{{ $k->kanan }}"
                                                data-bonus="{{ $k->reward }}"
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
                    {{ $table->links('admin.partials.paginate') }}
                </div>
            </div>
        </div>
    </div>


    {{-- edit modal --}}
    <div id="edit-product" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Edit Product')</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>

                </div>
                <form method="post" action="{{ route('admin.reward.update') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">

                        <input class="form-control plan_id" type="hidden" name="id">
                        <div class="form-row">
                            <div class="form-group col">
                                <label class="font-weight-bold"> @lang('Bonus Image') <small>(recommended image ratio
                                        9:16)</small></label>
                                <input class="form-control form-control-lg" type="file" accept="image/*"
                                    onchange="loadFile(event)" name="images" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="font-weight-bold"> @lang('Kiri')</label>
                                <input type="number" class="form-control" name="kiri" placeholder="150" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="font-weight-bold"> @lang('Kanan') </label>
                                <input type="number" class="form-control" placeholder="150" name="kanan" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col">
                                <label class="font-weight-bold">@lang('Bonus')</label>
                                <input type="text" class="form-control" name="bonus" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-block btn--primary">@lang('Update')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="add-product" class="modal  fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Add New')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="form-group col">
                                <label class="font-weight-bold"> @lang('Bonus Image') <small>(recommended image ratio
                                        9:16)</small></label>
                                <input class="form-control form-control-lg" type="file" accept="image/*"
                                    onchange="loadFile(event)" name="images" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="font-weight-bold"> @lang('Kiri')</label>
                                <input type="number" class="form-control" name="kiri" placeholder="150" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="font-weight-bold"> @lang('Kanan') </label>
                                <input type="number" class="form-control" placeholder="150" name="kanan" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col">
                                <label class="font-weight-bold">@lang('Bonus')</label>
                                <input type="text" class="form-control" name="bonus" required>
                            </div>
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
    <a href="javascript:void(0)" class="btn btn-sm btn--success add-product"><i
            class="fa fa-fw fa-plus"></i>@lang('Add
                                                                                                                                                                                                                                                                                                                                                                                                                                                    New')</a>
@endpush

@push('script')
    <script>
        "use strict";
        (function($) {
            $('.edit').on('click', function() {
                console.log($(this).data('image'));
                var modal = $('#edit-product');
                modal.find('input[name=id]').val($(this).data('id'));
                modal.find('input[name=kiri]').val($(this).data('kiri'));
                modal.find('input[name=kanan]').val($(this).data('kanan'));
                modal.find('input[name=bonus]').val($(this).data('bonus'));
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
