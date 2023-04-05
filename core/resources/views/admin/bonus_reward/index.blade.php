@extends('admin.layouts.app')

@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="accordion" id="accordionExample">
                <div class="card">
                    <div class="card-header" id="headingTwo">
                        <h2 class="mb-0">
                            <button class="btn btn-block text-left collapsed style--two" type="button" data-toggle="collapse"
                                data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                Set Monthly Bonus
                            </button>
                        </h2>
                    </div>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">

                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('admin.reward.monthly') }}" id="formBonus" method="POST">
                                    @csrf
                                    <div class="form-row">
                                        <div class="form-group col">
                                            <label class="font-weight-bold">@lang('Monthly Bonus')</label>
                                            <select name="id" id="type" class="form-control type">
                                                <option selected disabled>Pilih Bonus</option>
                                                @foreach ($monthly as $i)
                                                    <option value="{{ $i->id }}">
                                                        {{ $i->kiri . ':' . $i->kanan . ' | ' . $i->reward }}
                                                        @if ($i->status)
                                                            (active)
                                                        @endif
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <button type="button" id="btn-ok" value="OK" name="register"
                                        class="btn btn-primary accept" disabled>Select Bonus First</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-3">
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
                                    <th scope="col">@lang('Type')</th>
                                    <th scope="col">@lang('Status')</th>
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
                                        <td data-label="@lang('type')">
                                            {{ $k->type }}
                                        </td>
                                        <td data-label="@lang('type')">
                                            @if ($k->status)
                                                <span class="badge badge-success">Active</span>
                                            @else
                                                <span class="badge badge-secondary">Inactive</span>
                                            @endif
                                        </td>
                                        <td data-label="@lang('Action')">
                                            <button type="button" class="icon-btn edit" data-toggle="tooltip"
                                                data-id="{{ $k->id }}" data-kiri="{{ $k->kiri }}"
                                                data-status="{{ $k->status }}" data-type="{{ $k->type }}"
                                                data-kanan="{{ $k->kanan }}" data-bonus="{{ $k->reward }}"
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
                                    onchange="loadFile(event)" name="images">
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
                        <div class="form-row">
                            <div class="form-group col">
                                <label class="font-weight-bold">@lang('Type')</label>
                                <select name="type" id="type" class="form-control type">
                                    <option selected disabled>--Select</option>
                                    <option value="alltime">alltime</option>
                                    <option value="monthly">monthly</option>
                                </select>
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
                                    onchange="loadFile(event)" name="images">
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
                        <div class="form-row">
                            <div class="form-group col">
                                <label class="font-weight-bold">@lang('Type')</label>
                                <select name="type" id="type" class="form-control type">
                                    <option selected disabled>--Select</option>
                                    <option value="alltime">alltime</option>
                                    <option value="monthly">monthly</option>
                                </select>
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
                var modal = $('#edit-product');
                modal.find('input[name=id]').val($(this).data('id'));
                modal.find('input[name=kiri]').val($(this).data('kiri'));
                modal.find('input[name=kanan]').val($(this).data('kanan'));
                modal.find('input[name=bonus]').val($(this).data('bonus'));
                $('.type').val($(this).data('type'));
                $('.status').val($(this).data('status'));
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

        $('#formBonus').on('click', '#btn-ok', function(e) {
            console.log('test');
            let $form = $(this).closest('form');
            Swal.fire({
                title: 'Yakin Update Bonus Bulanan?',
                text: "Dengan update bonus, presentase penjualan user bulan sebelumnya akan di reset",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Update Bonus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $form.submit();
                }
            })

        });
        $('.type').on('change', function() {
            $('#btn-ok').attr('disabled', false).html('Set Bonus This Month');
        })
    </script>
@endpush
