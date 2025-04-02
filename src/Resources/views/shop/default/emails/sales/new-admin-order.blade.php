@component('shop::emails.layouts.master')
    <div style="text-align: center;">
        <a href="{{ config('app.url') }}">
            @if (core()->getConfigData('general.design.admin_logo.logo_image'))
                <img src="{{ \Illuminate\Support\Facades\Storage::url(core()->getConfigData('general.design.admin_logo.logo_image')) }}" alt="{{ config('app.name') }}" style="height: 40px; width: 110px;"/>
            @else
                <img src="{{ asset('vendor/webkul/ui/assets/images/logo.png') }}" alt="{{ config('app.name') }}"/>
            @endif
        </a>
    </div>

    <div style="padding: 30px;">
        <div style="font-size: 20px;color: #242424;line-height: 30px;margin-bottom: 34px;">
            <span style="font-weight: bold;">
                @lang('shop::app.mail.order.heading')
            </span> <br>

            <p style="font-size: 16px;color: #5E5E5E;line-height: 24px;">
            @lang('shop::app.mail.order.dear-admin', ['admin_name' => config('mail.from.name')]),
            </p>

            <p style="font-size: 16px;color: #5E5E5E;line-height: 24px;">
                {!! __('shop::app.mail.order.greeting-admin', [
                    'order_id' => '<a href="' . route('customer.orders.view', $order->id) . '" style="color: #0041FF; font-weight: bold;">#' . $order->increment_id . '</a>',
                    'created_at' => $order->created_at
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
                    {{ $order->shipping_address->name }}
                </div>

                <div>
                    {{ $order->shipping_address->address1 }}, {{ $order->shipping_address->state }}
                </div>

                <div>
                    {{ core()->country_name($order->shipping_address->country) }} {{ $order->shipping_address->postcode }}
                </div>

                <div>---</div>

                <div style="margin-bottom: 40px;">
                    @lang('shop::app.mail.order.contact'): {{ $order->shipping_address->phone }}
                </div>

                <div style="font-size: 16px;color: #242424; font-weight: bold">
                    @lang('shop::app.mail.order.shipping') 
                </div>

                <div style="font-size: 16px;color: #242424;">
                    {{ $order->shipping_title }}
                </div>
            </div>

            <div style="line-height: 25px;">
                <div style="font-weight: bold;font-size: 16px;color: #242424;">
                    @lang('shop::app.mail.order.billing-address')
                </div>

                <div>
                    {{ $order->billing_address->name }}
                </div>

                <div>
                    {{ $order->billing_address->address1 }}, {{ $order->billing_address->state }}
                </div>

                <div>
                    {{ core()->country_name($order->billing_address->country) }} {{ $order->billing_address->postcode }}
                </div>

                <div>---</div>

                <div style="margin-bottom: 40px;">
                    @lang('shop::app.mail.order.contact'): {{ $order->billing_address->phone }}
                </div>

                <div style="font-size: 16px; color: #242424; font-weight: bold">
                    @lang('shop::app.mail.order.payment')
                </div>

                <div style="font-size: 16px; color: #242424;">
                    {{ core()->getConfigData('sales.paymentmethods.' . $order->payment->method . '.title') }}
                </div>
            </div>
        </div>

        <div class="section-content">
            <div class="table mb-20">
                <table style="overflow-x: auto; border-collapse: collapse;
                border-spacing: 0;width: 100%">
                    <thead>
                        <tr style="background-color: #f2f2f2">
                            <th style="text-align: left;padding: 8px">@lang('shop::app.customer.account.order.view.SKU')</th>
                            <th style="text-align: left;padding: 8px">@lang('shop::app.customer.account.order.view.product-name')</th>
                            <th style="text-align: left;padding: 8px">@lang('shop::app.customer.account.order.view.price')</th>
                            <th style="text-align: left;padding: 8px">@lang('shop::app.customer.account.order.view.qty')</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($order->items as $item)
                            <tr>
                                <td data-value="@lang('shop::app.customer.account.order.view.SKU') }}" style="text-align: left;padding: 8px">
                                    {{ $item->getTypeInstance()->getOrderedItem($item)->sku }}
                                </td>

                                <td data-value="@lang('shop::app.customer.account.order.view.product-name') }}" style="text-align: left;padding: 8px">
                                    {{ $item->name }}

                                    @if (isset($item->additional['attributes']))
                                        <div class="item-options">

                                            @foreach ($item->additional['attributes'] as $attribute)
                                                <b>{{ $attribute['attribute_name'] }} : </b>{{ $attribute['option_label'] }}</br>
                                            @endforeach

                                        </div>
                                    @endif
                                </td>

                                <td>
                                    @php
                                        $timeslotOrderRepository = app('Webkul\DeliveryTimeSlot\Repositories\DeliveryTimeSlotsOrdersRepository');

                                        $orderSlots = collect();

                                        $orderOfSeller = $timeslotOrderRepository->findOneByField(['order_id' => $order->id]);

                                        $timeSlotData = [];

                                        if ($orderOfSeller) {
                                            if ($item->type == 'configurable') {
                                                $item = $item->child;
                                            }

                                            $orderSlots->push([
                                                'items' => [$item],
                                                'timeOrderSlot' => $timeslotOrderRepository->with('time_slot')
                                                ->findOneByField([
                                                    'order_id' => $order->id,
                                                ])
                                            ]);
                                        }

                                        $timeSlotData = $orderSlots;
                                    @endphp

                                    @if (! empty($timeSlotData))
                                        @foreach ($timeSlotData as $key => $timeSlot)
                                            @foreach ($timeSlot['items'] as $timeSlotItem)

                                                <div style=" border: 3px solid #ccc;border-radius: 3px; display: inline-block; margin: 15px 0 0; padding: 2px 10px; text-transform: uppercase; vertical-align: top;">
                                                    <span>
                                                        @if($timeSlotItem['id'] == $item->id && ! is_null($timeSlot['timeOrderSlot']))
                                                        <strong> By Seller:</strong>
                                                            <br>Admin <br>
                                                        @endif
                                                    </span>
                                                    <span>
                                                        <p><strong>Delivery Date/Day: </strong>
                                                        {{ $timeSlot['timeOrderSlot']['delivery_date'] }}
                                                        </p>
                                                        <p><strong>Delivery Time: </strong>
                                                            {{ $timeSlot['timeOrderSlot']['time_slot']['start_time']}}<b>
                                                                -
                                                            </b>
                                                            {{ $timeSlot['timeOrderSlot']['time_slot']['end_time']}}
                                                        </p>
                                                    </span>
                                                </div>

                                            @endforeach
                                        @endforeach
                                    @endif
                                </td>

                                <td data-value="@lang('shop::app.customer.account.order.view.price') }}" style="text-align: left;padding: 8px">
                                    {{ core()->formatPrice($item->price, $order->order_currency_code) }}
                                </td>

                                <td data-value="@lang('shop::app.customer.account.order.view.qty') }}" style="text-align: left;padding: 8px">
                                    {{ $item->qty_ordered }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div style="font-size: 16px;color: #242424;line-height: 30px;float: right;width: 40%;margin-top: 20px;">
            <div>
                <span>@lang('shop::app.mail.order.subtotal')</span>
                <span style="float: right;">
                    {{ core()->formatBasePrice($order->base_sub_total) }}
                </span>
            </div>

            <div>
                <span>@lang('shop::app.mail.order.shipping-handling')</span>
                <span style="float: right;">
                    {{ core()->formatBasePrice($order->base_shipping_amount) }}
                </span>
            </div>

            @foreach (Webkul\Tax\Helpers\Tax::getTaxRatesWithAmount($order, true) as $taxRate => $baseTaxAmount )
            <div>
                <span id="taxrate-{{ core()->taxRateAsIdentifier($taxRate) }}">@lang('shop::app.mail.order.tax') }} {{ $taxRate }} %</span>
                <span id="basetaxamount-{{ core()->taxRateAsIdentifier($taxRate) }}" style="float: right;">
                    {{ core()->formatBasePrice($baseTaxAmount) }}
                </span>
            </div>
            @endforeach

            @if ($order->discount_amount > 0)
                <div>
                    <span>@lang('shop::app.mail.order.discount')</span>
                    <span style="float: right;">
                        {{ core()->formatBasePrice($order->base_discount_amount) }}
                    </span>
                </div>
            @endif

            <div style="font-weight: bold">
                <span>@lang('shop::app.mail.order.grand-total')</span>
                <span style="float: right;">
                    {{ core()->formatBasePrice($order->base_grand_total) }}
                </span>
            </div>
        </div>

        <div style="width: 100%;margin-top: 65px;font-size: 16px;color: #5E5E5E;line-height: 24px;display: inline-block">
            <p style="font-size: 16px;color: #5E5E5E;line-height: 24px;">
                {!!
                    __('shop::app.mail.order.help', [
                        'support_email' => '<a style="color:#0041FF" href="mailto:' . config('mail.admin.address') . '">' . config('mail.admin.address') . '</a>'
                        ])
                !!}
            </p>

            <p style="font-size: 16px;color: #5E5E5E;line-height: 24px;">
                @lang('shop::app.mail.order.thanks') 
            </p>
        </div>
    </div>
@endcomponent
