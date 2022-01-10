@extends('shop::customers.account.index')

@section('page_title')
    {{ __('delivery-time-slot::app.shop.seller.time-delivery-order') }}
@endsection

@section('page-detail-wrapper')
    <div class="account-head mb-10">
        
        <span class="account-heading">
            {{ __('delivery-time-slot::app.shop.seller.time-delivery-order') }}
        </span>
    </div>

        <div class="account-items-list">
            <div class="account-table-content">

            {!! app('Webkul\MpDeliveryTimeSlot\DataGrids\Shop\DeliveryOrderHistoryDataGrid')->render() !!}

            </div>
        </div>
@endsection