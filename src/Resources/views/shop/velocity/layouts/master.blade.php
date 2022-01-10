@extends('shop::layouts.master')

@push('css')
    <link rel="stylesheet" href="{{ asset('themes/velocity/assets/css/delivery-time-slot.css') }}">
@endpush

@push('scripts')
    <script type="text/javascript" src="{{ bagisto_asset('js/delivery-time-slot.js') }}">
    </script>
@endpush
