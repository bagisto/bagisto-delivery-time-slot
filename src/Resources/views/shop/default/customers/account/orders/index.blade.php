@extends('shop::layouts.master')

@section('page_title')
    {{ __('shop::app.customer.account.order.index.page-title') }}
@endsection

@section('content-wrapper')

    <div class="account-content">
        @include('shop::customers.account.partials.sidemenu')

        <div class="account-layout">

            <div class="account-head mb-10">
                <span class="back-icon"><a href="{{ route('shop.customer.profile.index') }}"><i class="icon icon-menu-back"></i></a></span>
                <span class="account-heading">
                    {{ __('shop::app.customer.account.order.index.title') }}
                </span>

                <div class="horizontal-rule"></div>
            </div>

            {!! view_render_event('bagisto.shop.customers.account.orders.list.before') !!}

            <div class="account-items-list">
                <div class="account-table-content">

                @if ( core()->getConfigData('delivery_time_slot.settings.general.status') )
                    {!! app('Webkul\DeliveryTimeSlot\DataGrids\Shop\OrderDataGrid')->render() !!}
                @else
                    {!! app('Webkul\Shop\DataGrids\OrderDataGrid')->render() !!}
                @endif

                </div>
            </div>

            {!! view_render_event('bagisto.shop.customers.account.orders.list.after') !!}

        </div>

    </div>

@endsection