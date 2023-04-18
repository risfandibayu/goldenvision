@extends('v3.index')
@section('content')
    {{-- @include('v3.navbar') --}}

    <section class="payloan_header_bg ">
        <div class="container">
            <div class="img">
                <img src="{{ asset('assets/build.png') }}" alt="img" class="imgInfo">
            </div>
            <div class="text-center ">
                <h2 class="font-weight-bold">Web is Under Constraction</h2>
                <h5 class="font-weight-bold">We Will Back Soon</h5>
                <a class="btn btn-lg btn-primary" href="{{ url('/') }}">Go Back</a>
            </div>
        </div>
    </section>
@endsection
