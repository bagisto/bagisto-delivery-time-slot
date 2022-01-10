<br>
@if (isset($timeSlotData) && ! empty($timeSlotData))
    @foreach ($timeSlotData as $key => $timeSlot)
    
        @foreach ($timeSlot['items'] as $timeSlotItem)
            @php
                if ($item->type == 'configurable') {
                    $item = $item->child;
                }

                if ( isset($item->order_item_id) && $item->order_item_id) {
                    $item_id = $item->order_item_id;
                } else {
                    $item_id = $item->id;
                }

                if ( isset($timeSlotItem->order_item_id) && $timeSlotItem->order_item_id) {
                    $timeSlot_order_item_id = $timeSlotItem->order_item_id;
                } else {
                    $timeSlot_order_item_id = $timeSlotItem->id;
                }
            @endphp
            @if($timeSlot_order_item_id == $item_id && ! is_null($timeSlot['timeOrderSlot']))
                <strong> By Seller:</strong>
                @if (! is_null($timeSlot['timeOrderSlot']['marketplace_seller_id']))
                    <a href="{{route('admin.customer.edit', $timeSlot['timeOrderSlot']->seller->customer->id) }}">
                        {{ ucWords($timeSlot['timeOrderSlot']->seller->customer->first_name
                        .PHP_EOL.$timeSlot['timeOrderSlot']->seller->customer->last_name) }}
                    </a>
                    <br>
                @else
                    Admin <br>
                @endif
                <div class="order-status">
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
            @endif
        @endforeach
    @endforeach
@endif