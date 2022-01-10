@extends('admin::layouts.master')

@section('content-wrapper')
    <div class="inner-section">

        @include ('admin::layouts.nav-aside')

        <div class="content-wrapper">

            @include ('admin::layouts.tabs')

            @yield('content')

        </div>

    </div>

@push('css')
    <link rel="stylesheet" href="{{ bagisto_asset('css/delivery-time-slot.css') }}">
@endpush

@push('scripts')
    <script type="text/javascript" src="{{ bagisto_asset('/themes/default/assets/js/delivery-time-slot.js') }}">
    </script>
@endpush
@stop
