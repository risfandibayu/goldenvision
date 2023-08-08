@extends('admin.layouts.app')

@section('panel')
    <div class="row mb-none-30 mt-5">
        @foreach ($table as $item)
            <div class="col-md-6 mb-3">
                <div class="card">
                    <div class="card-header">
                        <h6 class="card-tilte">
                            {{ $item->username }}
                        </h6>
                    </div>
                    <div class="card-body">
                        <div id="grow-line-{{ $item->id }}"></div>
                    </div>
                </div>
            </div>
            {{-- @dd(memberGrowId($item->id)['date']) --}}

            @push('script')
                <script>
                    "use strict";
                    var options = {
                        series: @json(memberGrowId($item->id)['series']),
                        chart: {
                            height: 350,
                            type: 'line'
                        },
                        dataLabels: {
                            enabled: false
                        },
                        stroke: {
                            curve: 'smooth'
                        },
                        xaxis: {
                            type: 'datetime',
                            categories: @json(memberGrowId($item->id)['date'])
                        },
                        tooltip: {
                            x: {
                                format: 'dd/MM/yy'
                            },
                        },
                    };

                    var chart = new ApexCharts(document.querySelector("#grow-line-{{ $item->id }}"), options);
                    chart.render();
                </script>
            @endpush
        @endforeach
    </div>
@endsection
@push('script-lib')
    <script src="{{ asset('assets/admin/js/vendor/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/vendor/chart.js.2.8.0.js') }}"></script>
@endpush
{{-- 
@push('breadcrumb-plugins')
    <div class="row">
        <div class="col-md-6 col-6">

            <form action="{{ route('admin.reward.goldExport') }}" method="GET" class="form-inline float-sm-right">

                <button class="btn btn--primary" type="submit">Export Excel</button>
            </form>
        </div>
    </div>
@endpush --}}
