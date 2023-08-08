@extends('admin::layouts.master')

@section('content-wrapper')
    <div class="inner-section">
        <div class="content-wrapper">

            @include ('admin::layouts.tabs')
            
            @yield('content')

        </div>
    </div>

@push('css')
    <link rel="stylesheet" href="{{ asset('vendor/delivery-time-slot/assets/css/delivery-time-slot.css') }}">
@endpush

@push('scripts')
    <script type="text/javascript" src="{{ asset('vendor/delivery-time-slot/assets/js/delivery-time-slot.js') }}">
    </script>
@endpush
@stop
