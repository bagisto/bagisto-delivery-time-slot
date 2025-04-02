@component('shop::emails.layouts.master')
    <div style="text-align: center;">
        <a href="{{ config('app.url') }}">
            <img src="{{ asset('themes/default/assets/images/logo.svg') }}">
        </a>
    </div>

    <div style="padding: 30px;">
        <div style="font-size: 20px;color: #242424;line-height: 30px;margin-bottom: 34px;">
            <span style="font-weight: bold;">
                @lang('shop::app.mail.order.heading')
            </span> <br>
            <p style="font-size: 16px;color: #5E5E5E;line-height: 24px;">
                @lang('shop::app.mail.order.dear', ['customer_name' => $sellerOrder->seller->customer->name]),
            </p>

            <p style="font-size: 16px;color: #5E5E5E;line-height: 24px;">
                {!! __('marketplace::app.mail.sales.order.greeting', [
                    'order_id' => '<a href="' . route('marketplace.account.orders.view', $sellerOrder->order_id) . '" style="color: #0041FF; font-weight: bold;">#' . $sellerOrder->order_id . '</a>',
                    'created_at' => $sellerOrder->created_at
                    ])
                !!}
            </p>
        </div>

        <div style="font-weight: bold;font-size: 20px;color: #242424;line-height: 30px;margin-bottom: 20px !important;">
            @lang('shop::app.mail.order.summary')
        </div>

        <div style="display: flex;flex-direction: row;margin-top: 20px;justify-content: space-between;margin-bottom: 40px;">
            <div style="line-height: 25px;">
                <div style="font-weight: bold;font-size: 16px;color: #242424;">
                    @lang('shop::app.mail.order.shipping-address') 
                </div>

                <div>
                    {{ $sellerOrder->order->shipping_address->name }}
                </div>

                <div>
                    {{ $sellerOrder->order->shipping_address->address1 }}, {{ $sellerOrder->order->shipping_address->address2 ? $sellerOrder->order->shipping_address->address2 . ',' : '' }} {{ $sellerOrder->order->shipping_address->state }}
                </div>

                <div>
                    {{ core()->country_name($sellerOrder->order->shipping_address->country) }} {{ $sellerOrder->order->shipping_address->postcode }}
                </div>

                <div>---</div>

                <div style="margin-bottom: 40px;">
                    @lang('shop::app.mail.order.contact')  : {{ $sellerOrder->order->shipping_address->phone }}
                </div>

                <div style="font-size: 16px;color: #242424;">
                    @lang('shop::app.mail.order.shipping')
                </div>

                <div style="font-weight: bold;font-size: 16px;color: #242424;">
                    {{ $sellerOrder->order->shipping_title }}
                </div>
            </div>

            <div style="line-height: 25px;">
                <div style="font-weight: bold;font-size: 16px;color: #242424;">
                    @lang('shop::app.mail.order.billing-address')
                </div>

                <div>
                    {{ $sellerOrder->order->billing_address->name }}
                </div>

                <div>
                    {{ $sellerOrder->order->billing_address->address1 }}, {{ $sellerOrder->order->billing_address->address2 ? $sellerOrder->order->billing_address->address2 . ',' : '' }} {{ $sellerOrder->order->billing_address->state }}
                </div>

                <div>
                    {{ core()->country_name($sellerOrder->order->billing_address->country) }} {{ $sellerOrder->order->billing_address->postcode }}
                </div>

                <div>---</div>

                <div style="margin-bottom: 40px;">
                    @lang('shop::app.mail.order.contact') : {{ $sellerOrder->order->billing_address->phone }}
                </div>

                <div style="font-size: 16px; color: #242424;">
                    @lang('shop::app.mail.order.payment')
                </div>

                <div style="font-weight: bold;font-size: 16px; color: #242424;">
                    {{ core()->getConfigData('sales.paymentmethods.' . $sellerOrder->order->payment->method . '.title') }}
                </div>
            </div>
        </div>

        <div style="width: 100%;overflow-x: auto;">
            <table style="width: 100%;border-collapse: collapse;text-align: left;">
                <thead>
                    <tr>
                        <th style="font-weight: 700;padding: 12px 10px;background: #f8f9fa;color: #3a3a3a;">@lang('shop::app.customer.account.order.view.SKU')</th>
                        <th style="font-weight: 700;padding: 12px 10px;background: #f8f9fa;color: #3a3a3a;">@lang('shop::app.customer.account.order.view.product-name')</th>
                        <th style="font-weight: 700;padding: 12px 10px;background: #f8f9fa;color: #3a3a3a;">@lang('shop::app.customer.account.order.view.price') </th>
                        <th style="font-weight: 700;padding: 12px 10px;background: #f8f9fa;color: #3a3a3a;">@lang('shop::app.customer.account.order.view.subtotal')</th>
                        <th style="font-weight: 700;padding: 12px 10px;background: #f8f9fa;color: #3a3a3a;">@lang('shop::app.customer.account.order.view.tax-percent')</th>
                        <th style="font-weight: 700;padding: 12px 10px;background: #f8f9fa;color: #3a3a3a;">@lang('shop::app.customer.account.order.view.tax-amount')</th>

                        @if ($sellerOrder->discount_amount)
                            <th style="font-weight: 700;padding: 12px 10px;background: #f8f9fa;color: #3a3a3a;">@lang('shop::app.customer.account.order.view.discount-amount')</th>
                        @endif
                        <th style="font-weight: 700;padding: 12px 10px;background: #f8f9fa;color: #3a3a3a;">@lang('shop::app.customer.account.order.view.grand-total')</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach ($sellerOrder->items as $sellerOrderItem)
                        <tr>
                            <td style="padding: 10px;border-bottom: solid 1px #d3d3d3;color: #3a3a3a;vertical-align: top;">
                                {{ $sellerOrderItem->item->type == 'configurable' ? $sellerOrderItem->item->child->sku : $sellerOrderItem->item->sku }}
                            </td>

                            <td style="padding: 10px;border-bottom: solid 1px #d3d3d3;color: #3a3a3a;vertical-align: top;">
                                {{ $sellerOrderItem->item->name }}

                                @if (isset($sellerOrderItem->additional['attributes']))
                                    <div class="item-options">
                                        @foreach ($sellerOrderItem->additional['attributes'] as $attribute)
                                            <b>{{ $attribute['attribute_name'] }} : </b>{{ $attribute['option_label'] }}</br>
                                        @endforeach
                                    </div>
                                @endif

                                @php
                                    $timeSlotData = $sellerOrder->order->deliveryTimeSlotsOrders()->where([
                                        'order_id' => $sellerOrder->order->id ,
                                        'marketplace_seller_id' => $sellerOrder->seller->id ])->first();
                                @endphp

                                @if( ! empty($timeSlotData))
                                    <div style=" border: 3px solid #ccc;border-radius: 3px; display: inline-block; margin: 15px 0 0; padding: 2px 10px; text-transform: uppercase; vertical-align: top;">
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

                            <td style="padding: 10px;border-bottom: solid 1px #d3d3d3;color: #3a3a3a;vertical-align: top;">{{ core()->formatPrice($sellerOrderItem->item->price, $sellerOrder->order->order_currency_code) }}</td>

                            <td style="padding: 10px;border-bottom: solid 1px #d3d3d3;color: #3a3a3a;vertical-align: top;">{{ core()->formatPrice($sellerOrderItem->item->total, $sellerOrder->order->order_currency_code) }}</td>

                            <td style="padding: 10px;border-bottom: solid 1px #d3d3d3;color: #3a3a3a;vertical-align: top;">{{ number_format($sellerOrderItem->item->tax_percent, 2) }}%</td>

                            <td style="padding: 10px;border-bottom: solid 1px #d3d3d3;color: #3a3a3a;vertical-align: top;">{{ core()->formatPrice($sellerOrderItem->item->tax_amount, $sellerOrder->order->order_currency_code) }}</td>

                            @if ($sellerOrder->discount_amount)
                                <td style="padding: 10px;border-bottom: solid 1px #d3d3d3;color: #3a3a3a;vertical-align: top;">{{ core()->formatPrice($sellerOrderItem->item->discount_amount, $sellerOrder->order->order_currency_code) }}</td>
                            @endif

                            <td style="padding: 10px;border-bottom: solid 1px #d3d3d3;color: #3a3a3a;vertical-align: top;">{{ core()->formatPrice($sellerOrderItem->item->total + $sellerOrderItem->item->tax_amount, $sellerOrder->order->order_currency_code) }}</td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>

        <div style="font-size: 16px;color: #242424;line-height: 30px;float: right;width: 40%;margin-top: 20px;">
            <div>
                <span>@lang('shop::app.mail.order.subtotal')</span>
                <span style="float: right;">
                    {{ core()->formatPrice($sellerOrder->sub_total, $sellerOrder->order->order_currency_code) }}
                </span>
            </div>

            <div>
                <span>@lang('shop::app.mail.order.shipping-handling')</span>
                <span style="float: right;">
                    {{ core()->formatPrice($sellerOrder->shipping_amount, $sellerOrder->order->order_currency_code) }}
                </span>
            </div>

            <div>
                <span>@lang('shop::app.mail.order.tax')</span>
                <span style="float: right;">
                    {{ core()->formatPrice($sellerOrder->tax_amount, $sellerOrder->order->order_currency_code) }}
                </span>
            </div>

            @if ($sellerOrder->discount_amount)
                <div>
                    <span>@lang('shop::app.customer.account.order.view.discount-amount')</span>
                    <span style="float: right;">
                        {{ core()->formatPrice($sellerOrder->discount_amount, $sellerOrder->order->order_currency_code) }}
                    </span>
                </div>
            @endif

            <div style="font-weight: bold">
                <span>@lang('shop::app.mail.order.grand-total')</span>
                <span style="float: right;">
                    {{ core()->formatPrice($sellerOrder->grand_total, $sellerOrder->order->order_currency_code) }}
                </span>
            </div>
        </div>

        <div style="margin-top: 65px;font-size: 16px;color: #5E5E5E;line-height: 24px;display: block; width: 100%; float: left">

            <p style="font-size: 16px;color: #5E5E5E;line-height: 24px;">
                {!!
                    __('shop::app.mail.order.help', [
                        'support_email' => '<a style="color:#0041FF" href="mailto:' . config('mail.from.address') . '">' . config('mail.from.address'). '</a>'
                        ])
                !!}
            </p>

            <p style="font-size: 16px;color: #5E5E5E;line-height: 24px;">
                @lang('shop::app.mail.order.thanks')
            </p>
        </div>
    </div>
@endcomponent
