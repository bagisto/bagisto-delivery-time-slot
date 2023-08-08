@extends('shop::layouts.master')

@push('css')
<link rel="stylesheet" href="{{ asset('vendor/delivery-time-slot/assets/css/delivery-time-slot.css') }}">
@endpush

@push('scripts')
    <script type="text/javascript" src="{{ asset('vendor/delivery-time-slot/assets/js/delivery-time-slot.js') }}">
    </script>
@endpush
