@extends('delivery-time-slot::shop.velocity.layouts.master')

@section('content-wrapper')
    <div class="account-content">
        @include('shop::customers.account.partials.sidemenu')

        @yield('content')

    </div>
@stop
