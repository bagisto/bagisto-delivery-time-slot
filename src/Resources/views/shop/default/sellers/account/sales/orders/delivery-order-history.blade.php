@extends('marketplace::shop.layouts.account')

@section('page_title')
    {{ __('delivery-time-slot::app.shop.seller.time-delivery-order') }}
@endsection

@section('content')

    <div class="account-layout">

        <div class="account-head mb-10">
            <span class="account-heading">
                {{ __('delivery-time-slot::app.shop.seller.time-delivery-order') }}
            </span>

            <div class="account-action">
            </div>

            <div class="horizontal-rule"></div>
        </div>

        <div class="account-items-list">

            {!! app('Webkul\MpDeliveryTimeSlot\DataGrids\Shop\DeliveryOrderHistoryDataGrid')->render() !!}

        </div>

    </div>

@endsection