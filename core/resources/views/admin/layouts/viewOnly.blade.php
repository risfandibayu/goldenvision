@extends('admin.layouts.master')

@section('content')
    <!-- page-wrapper start -->
    <div class="page-wrapper default-version">
        {{-- @include('admin.partials.sidenav')
        @include('admin.partials.topnav') --}}

        <div class="container">
            <div class="bodywrapper__inner">

                @include('admin.partials.breadcrumb')
                <div class="mt-5">

                    @yield('panel')
                </div>
            </div><!-- bodywrapper__inner end -->
        </div><!-- body-wrapper end -->
    </div>
@endsection
