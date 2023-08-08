
<br>
@if ( isset($timeSlotData) && ! empty($timeSlotData))
    @foreach ($timeSlotData as $key => $timeSlot)
        @foreach($timeSlot['items'] as $timeSlotItem)
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
                
            @if ( $timeSlot_order_item_id == $item_id && ! is_null($timeSlot['timeOrderSlot']))
            
            <div class="order-status">
                <span>
                    <p><strong>Delivery Date/Day: </strong>
                        {{ $timeSlot['timeOrderSlot']['delivery_date'] }}
                    </p>
                    <p><strong>Delivery Time: </strong>
                        @if (core()->getConfigData('delivery_time_slot.settings.general.display_time_format') == 12)
                            {{ date('h:i A', strtotime($timeSlot['timeOrderSlot']['time_slot']['start_time'])) }} -
                            {{ date('h:i A', strtotime($timeSlot['timeOrderSlot']['time_slot']['end_time'])) }}
                        @else                                
                            {{ $timeSlot['timeOrderSlot']['time_slot']['start_time']}} - 
                            {{ $timeSlot['timeOrderSlot']['time_slot']['end_time']}}
                        @endif
                    </p>
                </span>
            </div>
            @endif
        @endforeach
    @endforeach
@endif