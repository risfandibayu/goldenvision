@extends('admin.layouts.app')

@section('panel')
    <div class="row mt-3">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body p-0">
                    <div class="table-responsive--md table-responsive">
                        <table class="table table--light style--two">
                            <thead>
                                <tr>
                                    <th scope="col" rowspan="1">@lang('Sl')</th>
                                    {{-- <th scope="col">@lang('Code')</th> --}}
                                    <th scope="col" rowspan="1">@lang('User')</th>
                                    <th scope="col" rowspan="1">@lang('Left')</th>
                                    <th scope="col" rowspan="1">@lang('Right')</th>
                                    <th scope="col" colspan="{{ $b }}" class="text-center">@lang('Month')
                                    </th>
                                </tr>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    @foreach ($b2 as $item)
                                        <th>{{ $item }}</th>
                                    @endforeach
                                </tr>

                            </thead>
                            <tbody>
                                @forelse($table as $key => $k)
                                    {{-- @dd($k->detail()); --}}
                                    <tr>
                                        <td data-label="@lang('No')">{{ $key + 1 }}</td>
                                        {{-- <td data-label="@lang('code')">
                                            {{ $k->trx }}
                                        </td> --}}
                                        <td data-label="@lang('user')">
                                            {{ $k->username }}
                                        </td>
                                        <td data-label="@lang('left')">
                                            {{ $k->userExtra->left }}
                                        </td>
                                        <td data-label="@lang('user')">
                                            {{ $k->userExtra->right }}
                                        </td>
                                        @foreach (getSharingProvitUserByMonth($k->id) as $item)
                                            <td data-label="@lang('user')">
                                                {{ 'Rp ' . nb($item) }}
                                            </td>
                                        @endforeach
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

    <div id="ModalAdd" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('ADD Profit Sharing This Month')</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>

                </div>
                <form method="post" id="formShare" action="" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="form-group col">
                                <label class="font-weight-bold">
                                    @lang('Update Kiri:Kanan')<span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="number" name="kiri" aria-label="Kiri" class="form-control"
                                        value="103">
                                    <input type="number" name="kanan" aria-label="Kanan" class="form-control"
                                        value="103">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col">
                                <label class="font-weight-bold">
                                    @lang('Profit to share')<span class="text-danger">*</span></label>
                                <input type="number" name="amount" id="amount" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col">
                                <label class="font-weight-bold">
                                    @lang('Details from admin')<span class="text-danger">*</span></label>
                                <textarea name="ket" id="ket" class="form-control " cols="5" rows="5">Profit Sharing Master Gold Commisions on Sales of Products</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="btnSave" class="btn btn-block btn--primary">@lang('Sharing Profit')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('breadcrumb-plugins')
    <a href="javascript:void(0)" class="btn btn-sm btn--success add-product"><i
            class="fa fa-fw fa-plus"></i>@lang('Add New')</a>
@endpush

@push('script')
    <script>
        "use strict";
        (function($) {
            $('.add-product').on('click', function() {
                var modal = $('#ModalAdd');
                modal.modal('show');
            });
        })(jQuery);
    </script>
    <script>
        $('#formShare').on('click', '#btnSave', function(e) {
            e.preventDefault();
            let $form = $(this).closest('form');
            const amount = $('#amount').val();
            Swal.fire({
                title: 'Sharing the profit?',
                text: "By distributing the profit, you will allocate " + amount +
                    " among all registered users as profit recipients.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Sharing Profit'
            }).then((result) => {
                if (result.isConfirmed) {
                    $form.submit();
                }
            })

        });
    </script>
@endpush
