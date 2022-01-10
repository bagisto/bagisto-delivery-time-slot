@extends('marketplace::shop.layouts.account')

@section('page_title')
    {{ __('marketplace::app.shop.sellers.account.sales.orders.view-title', ['order_id' => $sellerOrder->order_id]) }}
@endsection

@section('content')
@push('css')
    <link rel="stylesheet" href="{{ bagisto_asset('css/mp-delivery-time-slot.css') }}">
@endpush

    <div class="account-layout">

        <div class="account-head">
            <span class="account-heading">
                {{ __('marketplace::app.shop.sellers.account.sales.orders.view-title', ['order_id' => $sellerOrder->order_id]) }}
            </span>

            <div class="account-action">
                @if (core()->getConfigData('marketplace.settings.general.can_cancel_order') && $sellerOrder->canCancel())
                    <a href="{{ route('marketplace.account.orders.cancel', $sellerOrder->order_id) }}" class="btn btn-lg btn-primary" v-alert:message="'{{ __('admin::app.sales.orders.cancel-confirm-msg') }}'">
                        {{ __('admin::app.sales.orders.cancel-btn-title') }}
                    </a>
                @endif

                @if (core()->getConfigData('marketplace.settings.general.can_create_invoice') && $sellerOrder->canInvoice())
                    <a href="{{ route('marketplace.account.invoices.create', $sellerOrder->order_id) }}" class="btn btn-lg btn-primary">
                        {{ __('admin::app.sales.orders.invoice-btn-title') }}
                    </a>
                @endif

                @if (core()->getConfigData('marketplace.settings.general.can_create_shipment') && $sellerOrder->canShip())
                    <a href="{{ route('marketplace.account.shipments.create', $sellerOrder->order_id) }}" class="btn btn-lg btn-primary">
                        {{ __('admin::app.sales.orders.shipment-btn-title') }}
                    </a>
                @endif
            </div>
            <span></span>
        </div>

        {!! view_render_event('marketplace.sellers.account.sales.orders.view.before', ['sellerOrder' => $sellerOrder]) !!}

        <div class="sale-container">

            <tabs>
                <tab name="{{ __('marketplace::app.shop.sellers.account.sales.orders.info') }}" :selected="true">

                    <div class="sale-section">
                        <div class="section-content">
                            <div class="row">
                                <span class="title">
                                    {{ __('marketplace::app.shop.sellers.account.sales.orders.placed-on') }}
                                </span>

                                <span class="value">
                                    {{ core()->formatDate($sellerOrder->created_at, 'd M Y') }}
                                </span>
                            </div>

                            <div class="row">
                                <span class="title">
                                    {{ __('marketplace::app.shop.sellers.account.sales.orders.status') }}
                                </span>

                                <span class="value">
                                    {{ $sellerOrder->status_label }}
                                </span>
                            </div>

                            <div class="row">
                                <span class="title">
                                    {{ __('marketplace::app.shop.sellers.account.sales.orders.customer-name') }}
                                </span>

                                <span class="value">
                                    {{ $sellerOrder->order->customer_full_name }}
                                </span>
                            </div>

                            <div class="row">
                                <span class="title">
                                    {{ __('marketplace::app.shop.sellers.account.sales.orders.email') }}
                                </span>

                                <span class="value">
                                    {{ $sellerOrder->order->customer_email }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="sale-section">
                        <div class="secton-title">
                            <span>{{ __('shop::app.customer.account.order.view.products-ordered') }}</span>
                        </div>

                        <div class="section-content">
                            <div class="table">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>{{ __('shop::app.customer.account.order.view.SKU') }}</th>
                                            <th>{{ __('shop::app.customer.account.order.view.product-name') }}</th>
                                            <th>{{ __('shop::app.customer.account.order.view.price') }}</th>
                                            <th>{{ __('shop::app.customer.account.order.view.item-status') }}</th>
                                            <th>{{ __('shop::app.customer.account.order.view.subtotal') }}</th>
                                            <th>{{ __('shop::app.customer.account.order.view.discount') }}</th>
                                            <th>{{ __('marketplace::app.shop.sellers.account.sales.orders.admin-commission') }}</th>
                                            <th>{{ __('shop::app.customer.account.order.view.tax-percent') }}</th>
                                            <th>{{ __('shop::app.customer.account.order.view.tax-amount') }}</th>
                                            <th>{{ __('shop::app.customer.account.order.view.grand-total') }}</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                        @foreach ($sellerOrder->items as $sellerOrderItem)
                                            <tr>
                                                <td data-value="{{ __('shop::app.customer.account.order.view.SKU') }}">
                                                    {{ $sellerOrderItem->item->type == 'configurable' ? $sellerOrderItem->item->child->sku : $sellerOrderItem->item->sku }}
                                                </td>
                                                <td data-value="{{ __('shop::app.customer.account.order.view.product-name') }}">
                                                    {{ $sellerOrderItem->item->name }}

                                                    @if (isset($sellerOrderItem->additional['attributes']))
                                                    <div class="item-options">
                                                        @foreach ($sellerOrderItem->additional['attributes'] as $attribute)
                                                        <p>
                                                            <b>{{ $attribute['attribute_name'] }} : </b>{{ $attribute['option_label'] }}</br>
                                                        </p>
                                                        @endforeach
                                                    </div>
                                                @endif
                                                <br>
                                                @if( ! empty($timeSlotData))
                                                        <div class="order-status">
                                                            <span>
                                                                <p><strong>Delivery Date/Day: </strong>
                                                                    <br>{{ $timeSlotData->delivery_date }}
                                                                </p>
                                                                <p><strong>Delivery Time: </strong>
                                                                    <br>{{ $timeSlotData->time_slot->start_time }} <b>-</b> {{ $timeSlotData->time_slot->end_time }}
                                                                </p>
                                                            </span>
                                                        </div>
                                                    @endif
                                                </td>
                                                <td data-value="{{ __('shop::app.customer.account.order.view.price') }}">{{ core()->formatPrice($sellerOrderItem->item->price, $sellerOrder->order->order_currency_code) }}</td>
                                                <td data-value="{{ __('shop::app.customer.account.order.view.item-status') }}">
                                                    <span class="qty-row">
                                                        {{ __('shop::app.customer.account.order.view.item-ordered', ['qty_ordered' => $sellerOrderItem->item->qty_ordered]) }}
                                                    </span>

                                                    <span class="qty-row">
                                                        {{ $sellerOrderItem->item->qty_invoiced ? __('shop::app.customer.account.order.view.item-invoice', ['qty_invoiced' => $sellerOrderItem->item->qty_invoiced]) : '' }}
                                                    </span>

                                                    <span class="qty-row">
                                                        {{ $sellerOrderItem->item->qty_refunded ? __('admin::app.sales.orders.item-refunded', ['qty_refunded' => $sellerOrderItem->item->qty_refunded]) : '' }}
                                                    </span>

                                                    <span class="qty-row">
                                                        {{ $sellerOrderItem->item->qty_shipped ? __('shop::app.customer.account.order.view.item-shipped', ['qty_shipped' => $sellerOrderItem->item->qty_shipped]) : '' }}
                                                    </span>

                                                    <span class="qty-row">
                                                        {{ $sellerOrderItem->item->qty_canceled ? __('shop::app.customer.account.order.view.item-canceled', ['qty_canceled' => $sellerOrderItem->item->qty_canceled]) : '' }}
                                                    </span>
                                                </td>
                                                <td data-value="{{ __('shop::app.customer.account.order.view.subtotal') }}">{{ core()->formatPrice($sellerOrderItem->item->total, $sellerOrder->order->order_currency_code) }}</td>

                                                <td data-value="{{ __('shop::app.customer.account.order.view.discount') }}">{{ core()->formatPrice($sellerOrderItem->item->discount_amount, $sellerOrder->order->order_currency_code) }}</td>


                                                <td data-value="{{ __('marketplace::app.shop.sellers.account.sales.orders.admin-commission') }}">{{ core()->formatPrice($sellerOrderItem->commission, $sellerOrder->order->order_currency_code) }}</td>
                                                <td data-value="{{ __('shop::app.customer.account.order.view.tax-percent') }}">{{ number_format($sellerOrderItem->item->tax_percent, 2) }}%</td>
                                                <td data-value="{{ __('shop::app.customer.account.order.view.tax-amount') }}">{{ core()->formatPrice($sellerOrderItem->item->tax_amount, $sellerOrder->order->order_currency_code) }}</td>
                                                <td data-value="{{ __('shop::app.customer.account.order.view.grand-total') }}">{{ core()->formatPrice($sellerOrderItem->item->total + $sellerOrderItem->item->tax_amount - $sellerOrder->discount_amount, $sellerOrder->order->order_currency_code) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>

                                </table>
                            </div>

                            <div class="totals">
                                <table class="sale-summary">
                                    <tbody>
                                        <tr>
                                            <td>{{ __('shop::app.customer.account.order.view.subtotal') }}</td>
                                            <td>-</td>
                                            <td>{{ core()->formatPrice($sellerOrder->sub_total, $sellerOrder->order->order_currency_code) }}</td>
                                        </tr>

                                        <tr>
                                            <td>{{ __('shop::app.customer.account.order.view.shipping-handling') }}</td>
                                            <td>-</td>
                                            <td>{{ core()->formatPrice($sellerOrder->shipping_amount, $sellerOrder->order->order_currency_code) }}</td>
                                        </tr>

                                        <tr>
                                            <td>{{ __('shop::app.customer.account.order.view.discount') }}</td>
                                            <td>-</td>
                                            <td>{{ core()->formatPrice($sellerOrder->discount_amount, $sellerOrder->order->order_currency_code) }}</td>
                                        </tr>

                                        <tr class="border">
                                            <td>{{ __('shop::app.customer.account.order.view.tax') }}</td>
                                            <td>-</td>
                                            <td>{{ core()->formatPrice($sellerOrder->tax_amount, $sellerOrder->order->order_currency_code) }}</td>
                                        </tr>

                                        <tr class="bold">
                                            <td>{{ __('shop::app.customer.account.order.view.grand-total') }}</td>
                                            <td>-</td>
                                            <td>{{ core()->formatPrice($sellerOrder->grand_total, $sellerOrder->order->order_currency_code) }}</td>
                                        </tr>

                                        <tr class="bold">
                                            <td>{{ __('shop::app.customer.account.order.view.total-paid') }}</td>
                                            <td>-</td>
                                            <td>{{ core()->formatPrice($sellerOrder->grand_total_invoiced, $sellerOrder->order->order_currency_code) }}</td>
                                        </tr>

                                        <tr class="bold">
                                            <td>{{ __('shop::app.customer.account.order.view.total-refunded') }}</td>
                                            <td>-</td>
                                            <td>{{ core()->formatPrice($sellerOrder->order->grand_total_refunded, $sellerOrder->order->order_currency_code) }}</td>
                                        </tr>

                                        <tr class="bold">
                                            <td>{{ __('shop::app.customer.account.order.view.total-due') }}</td>
                                            <td>-</td>
                                            <td>{{ core()->formatPrice($sellerOrder->base_total_due, $sellerOrder->order->order_currency_code) }}</td>
                                        </tr>

                                        <tr class="bold">
                                            <td> {{ __('marketplace::app.shop.sellers.account.sales.orders.total-seller-amount') }}
                                            </td>
                                            <td>-</td>
                                            <td>{{ core()->formatPrice($sellerOrder->seller_total, $sellerOrder->order->order_currency_code) }}</td>
                                        </tr>

                                        <tr class="bold">
                                            <td>{{ __('marketplace::app.shop.sellers.account.sales.orders.total-admin-commission') }}
                                            </td>
                                            <td>-</td>
                                            <td>{{ core()->formatPrice($sellerOrder->commission, $sellerOrder->order->order_currency_code) }}</td>
                                        </tr>
                                    <tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </tab>

                @if ($sellerOrder->invoices->count())
                    <tab name="{{ __('marketplace::app.shop.sellers.account.sales.orders.invoices') }}">

                        @foreach ($sellerOrder->invoices as $sellerInvoice)

                            <div class="sale-section">
                                <div class="secton-title">
                                    <span>{{ __('shop::app.customer.account.order.view.individual-invoice', ['invoice_id' => $sellerInvoice->invoice_id]) }}</span>

                                    <a href="{{ route('marketplace.account.invoices.print', $sellerInvoice->marketplace_order_id ) }}" class="pull-right">
                                        {{ __('shop::app.customer.account.order.view.print') }}
                                    </a>
                                </div>

                                <div class="section-content">
                                    <div class="table">
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th>{{ __('shop::app.customer.account.order.view.product-name') }}</th>
                                                    <th>{{ __('shop::app.customer.account.order.view.price') }}</th>
                                                    <th>{{ __('shop::app.customer.account.order.view.qty') }}</th>
                                                    <th>{{ __('shop::app.customer.account.order.view.subtotal') }}</th>
                                                    <th>{{ __('shop::app.customer.account.order.view.tax-amount') }}</th>
                                                    <th>{{ __('shop::app.customer.account.order.view.discount') }}</th>
                                                    <th>{{ __('shop::app.customer.account.order.view.grand-total') }}</th>
                                                </tr>
                                            </thead>

                                            <tbody>

                                                @foreach ($sellerInvoice->items as $sellerInvoiceItem)
                                                    <?php $baseInvoiceItem = $sellerInvoiceItem->item; ?>
                                                    <tr>
                                                        <td data-value="{{ __('shop::app.customer.account.order.view.product-name') }}">{{ $baseInvoiceItem->name }}
                                                            <br>
                                                            @if( ! empty($timeSlotData))
                                                                <div class="order-status">
                                                                    <span>
                                                                        <p><strong>Delivery Date/Day: </strong>
                                                                            <br>{{ $timeSlotData->delivery_date }}
                                                                        </p>
                                                                        <p><strong>Delivery Time: </strong>
                                                                            <br>{{ $timeSlotData->time_slot->start_time }} <b>-</b> {{ $timeSlotData->time_slot->end_time }}
                                                                        </p>
                                                                    </span>
                                                                </div>
                                                            @endif
                                                        </td>

                                                        <td data-value="{{ __('shop::app.customer.account.order.view.price') }}">
                                                            {{ core()->formatPrice($baseInvoiceItem->price, $sellerOrder->order->order_currency_code) }}
                                                        </td>

                                                        <td data-value="{{ __('shop::app.customer.account.order.view.qty') }}">{{ $baseInvoiceItem->qty }}</td>

                                                        <td data-value="{{ __('shop::app.customer.account.order.view.subtotal') }}">
                                                            {{ core()->formatPrice($baseInvoiceItem->total, $sellerOrder->order->order_currency_code) }}
                                                        </td>

                                                        <td data-value="{{ __('shop::app.customer.account.order.view.tax-amount') }}">
                                                            {{ core()->formatPrice($baseInvoiceItem->tax_amount, $sellerOrder->order->order_currency_code) }}
                                                        </td>

                                                        <td data-value="{{ __('shop::app.customer.account.order.view.discount') }}">
                                                            {{ core()->formatPrice($baseInvoiceItem->discount_amount, $sellerOrder->order->order_currency_code) }}
                                                        </td>

                                                        <td data-value="{{ __('shop::app.customer.account.order.view.grand-total') }}">
                                                            {{ core()->formatPrice($baseInvoiceItem->total + $baseInvoiceItem->tax_amount - $sellerOrder->discount_amount, $sellerOrder->order->order_currency_code) }}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="totals">
                                        <table class="sale-summary">
                                            <tr>
                                                <td>{{ __('shop::app.customer.account.order.view.subtotal') }}</td>
                                                <td>-</td>
                                                <td>{{ core()->formatPrice($sellerInvoice->sub_total, $sellerOrder->order->order_currency_code) }}</td>
                                            </tr>

                                            <tr>
                                                <td>{{ __('shop::app.customer.account.order.view.shipping-handling') }}</td>
                                                <td>-</td>
                                                <td>{{ core()->formatPrice($sellerInvoice->shipping_amount, $sellerOrder->order->order_currency_code) }}</td>
                                            </tr>

                                            <tr>
                                                <td>{{ __('shop::app.customer.account.order.view.tax') }}</td>
                                                <td>-</td>
                                                <td>{{ core()->formatPrice($sellerInvoice->tax_amount, $sellerOrder->order->order_currency_code) }}</td>
                                            </tr>

                                            <tr>
                                                <td>{{ __('shop::app.customer.account.order.view.discount') }}</td>
                                                <td>-</td>
                                                <td>{{ core()->formatPrice($sellerInvoice->discount_amount, $sellerOrder->order->order_currency_code) }}</td>
                                            </tr>

                                            <tr class="bold">
                                                <td>{{ __('shop::app.customer.account.order.view.grand-total') }}</td>
                                                <td>-</td>
                                                <td>{{ core()->formatPrice($sellerInvoice->grand_total, $sellerOrder->order->order_currency_code) }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>

                        @endforeach
                    </tab>
                @endif

                @if ($sellerOrder->refunds->count())
                    <tab name="{{ __('marketplace::app.shop.sellers.account.sales.orders.refunds') }}">

                        @foreach ($sellerOrder->refunds as $sellerRefund)

                            <div class="sale-section">
                                <div class="section-content">
                                    <div class="table">
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th>{{ __('admin::app.sales.orders.product-name') }}</th>
                                                    <th>{{ __('admin::app.sales.orders.price') }}</th>
                                                    <th>{{ __('admin::app.sales.orders.qty') }}</th>
                                                    <th>{{ __('admin::app.sales.orders.subtotal') }}</th>
                                                    <th>{{ __('admin::app.sales.orders.tax-amount') }}</th>
                                                    <th>{{ __('admin::app.sales.orders.discount-amount') }}</th>
                                                    <th>{{ __('admin::app.sales.orders.grand-total') }}</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                @foreach ($sellerRefund->items as $sellerRefundItem)
                                                    <?php $baseRefundItem = $sellerRefundItem->item; ?>
                                                    <tr>
                                                        <td data-value="{{ __('shop::app.customer.account.order.view.product-name') }}">{{ $baseRefundItem->name }}</td>

                                                            <td data-value="{{ __('shop::app.customer.account.order.view.price') }}">
                                                            {{ core()->formatPrice($baseRefundItem->price, $sellerOrder->order->order_currency_code) }}
                                                        </td>

                                                        <td data-value="{{ __('shop::app.customer.account.order.view.qty') }}">{{ $baseRefundItem->qty }}</td>

                                                        <td data-value="{{ __('shop::app.customer.account.order.view.subtotal') }}">
                                                            {{ core()->formatPrice($baseRefundItem->total, $sellerOrder->order->order_currency_code) }}
                                                        </td>

                                                        <td data-value="{{ __('shop::app.customer.account.order.view.tax-amount') }}">
                                                            {{ core()->formatPrice($baseRefundItem->tax_amount, $sellerOrder->order->order_currency_code) }}
                                                        </td>

                                                        <td data-value="{{ __('shop::app.customer.account.order.view.discount') }}">
                                                            {{ core()->formatPrice($baseRefundItem->discount_amount, $sellerOrder->order->order_currency_code) }}
                                                        </td>

                                                        <td data-value="{{ __('shop::app.customer.account.order.view.grand-total') }}">
                                                            {{ core()->formatPrice($baseRefundItem->total + $baseRefundItem->tax_amount - $sellerOrder->discount_amount, $sellerOrder->order->order_currency_code) }}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="totals">
                                        <table class="sale-summary">
                                            <tr>
                                                <td>{{ __('shop::app.customer.account.order.view.subtotal') }}</td>
                                                <td>-</td>
                                                <td>{{ core()->formatPrice($sellerRefund->sub_total, $sellerOrder->order->order_currency_code) }}</td>
                                            </tr>

                                            @if ($sellerRefund->shipping_amount > 0)
                                                <tr>
                                                    <td>{{ __('shop::app.customer.account.order.view.shipping-handling') }}</td>
                                                    <td>-</td>
                                                    <td>{{ core()->formatPrice($sellerRefund->shipping_amount, $sellerOrder->order->order_currency_code) }}</td>
                                                </tr>
                                            @endif

                                            <tr>
                                                <td>{{ __('shop::app.customer.account.order.view.tax') }}</td>
                                                <td>-</td>
                                                <td>{{ core()->formatPrice($sellerRefund->tax_amount, $sellerOrder->order->order_currency_code) }}</td>
                                            </tr>

                                            <tr>
                                                <td>{{ __('shop::app.customer.account.order.view.discount') }}</td>
                                                <td>-</td>
                                                <td>{{ core()->formatPrice($sellerRefund->base_discount_amount, $sellerOrder->order->order_currency_code) }}</td>
                                            </tr>

                                            <tr>
                                                <td>{{ __('admin::app.sales.refunds.adjustment-refund') }}</td>
                                                <td>-</td>
                                                <td>{{ core()->formatPrice($sellerRefund->base_adjustment_refund, $sellerOrder->order->order_currency_code) }}</td>
                                            </tr>

                                            <tr>
                                                <td>{{ __('admin::app.sales.refunds.adjustment-fee') }}</td>
                                                <td>-</td>
                                                <td>{{ core()->formatPrice($sellerRefund->base_adjustment_fee, $sellerOrder->order->order_currency_code) }}</td>
                                            </tr>

                                            <tr class="bold">
                                                <td>{{ __('shop::app.customer.account.order.view.grand-total') }}</td>
                                                <td>-</td>
                                                <td>{{ core()->formatPrice($sellerRefund->grand_total, $sellerOrder->order->order_currency_code) }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>

                        @endforeach
                    </tab>
                @endif

                @if ($sellerOrder->shipments->count())
                    <tab name="{{ __('marketplace::app.shop.sellers.account.sales.orders.shipments') }}">

                        @foreach ($sellerOrder->shipments as $sellerShipment)

                            <div class="sale-section">
                                <div class="secton-title">
                                    <span>{{ __('shop::app.customer.account.order.view.individual-shipment', ['shipment_id' => $sellerShipment->shipment_id]) }}</span>
                                </div>

                                <div class="section-content">

                                    @if ($sellerShipment->shipment->inventory_source)
                                        <div class="row">
                                            <span class="title">
                                                {{ __('marketplace::app.shop.sellers.account.sales.orders.inventory-source') }}
                                            </span>

                                            <span class="value">
                                                {{ $sellerShipment->shipment->inventory_source->name }}
                                            </span>
                                        </div>
                                    @endif

                                    <div class="row">
                                        <span class="title">
                                            {{ __('marketplace::app.shop.sellers.account.sales.orders.carrier-title') }}
                                        </span>

                                        <span class="value">
                                            {{ $sellerShipment->shipment->carrier_title }}
                                        </span>
                                    </div>

                                    <div class="row">
                                        <span class="title">
                                            {{ __('marketplace::app.shop.sellers.account.sales.orders.tracking-number') }}
                                        </span>

                                        <span class="value">
                                            {{ $sellerShipment->shipment->track_number }}
                                        </span>
                                    </div>

                                    <div class="table" style="margin-top: 20px">
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th>{{ __('shop::app.customer.account.order.view.SKU') }}</th>
                                                    <th>{{ __('shop::app.customer.account.order.view.product-name') }}</th>
                                                    <th>{{ __('shop::app.customer.account.order.view.qty') }}</th>
                                                </tr>
                                            </thead>

                                            <tbody>

                                                @foreach ($sellerShipment->items as $sellerShipmentItem)

                                                    <tr>
                                                        <td data-value="{{ __('shop::app.customer.account.order.view.SKU') }}">{{ $sellerShipmentItem->item->sku }}</td>
                                                        <td data-value="{{ __('shop::app.customer.account.order.view.product-name') }}">{{ $sellerShipmentItem->item->name }}
                                                            <br>
                                                            @if( ! empty($timeSlotData))
                                                                <div class="order-status">
                                                                    <span>
                                                                        <p><strong>Delivery Date/Day: </strong>
                                                                            <br>{{ $timeSlotData->delivery_date }}
                                                                        </p>
                                                                        <p><strong>Delivery Time: </strong>
                                                                            <br>{{ $timeSlotData->time_slot->start_time }} <b>-</b> {{ $timeSlotData->time_slot->end_time }}
                                                                        </p>
                                                                    </span>
                                                                </div>
                                                            @endif
                                                        </td>
                                                        <td data-value="{{ __('shop::app.customer.account.order.view.qty') }}">{{ $sellerShipmentItem->item->qty }}</td>
                                                    </tr>

                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>

                        @endforeach
                    </tab>
                @endif
            </tabs>

            <div class="sale-section">
                <div class="section-content" style="border-bottom: 0">
                    <div class="order-box-container">
                        <div class="box">
                            <div class="box-title">
                                {{ __('shop::app.customer.account.order.view.shipping-address') }}
                            </div>

                            <div class="box-content">

                                @include ('admin::sales.address', ['address' => $sellerOrder->order->billing_address])

                            </div>
                        </div>

                        <div class="box">
                            <div class="box-title">
                                {{ __('shop::app.customer.account.order.view.billing-address') }}
                            </div>

                            <div class="box-content">

                                @include ('admin::sales.address', ['address' => $sellerOrder->order->shipping_address])

                            </div>
                        </div>

                        <div class="box">
                            <div class="box-title">
                                {{ __('shop::app.customer.account.order.view.shipping-method') }}
                            </div>

                            <div class="box-content">

                                {{ $sellerOrder->order->shipping_title }}

                            </div>
                        </div>

                        <div class="box">
                            <div class="box-title">
                                {{ __('shop::app.customer.account.order.view.payment-method') }}
                            </div>

                            <div class="box-content">
                                {{ core()->getConfigData('sales.paymentmethods.' . $sellerOrder->order->payment->method . '.title') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        {!! view_render_event('marketplace.sellers.account.sales.orders.view.after', ['sellerOrder' => $sellerOrder]) !!}

    </div>

@endsection