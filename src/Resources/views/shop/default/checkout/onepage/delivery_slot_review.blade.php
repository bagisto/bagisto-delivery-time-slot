
<br>
@if ( isset($selectedSlots) && ! empty($selectedSlots))
    <span>
        <h4>{{ __('delivery-time-slot::app.shop.checkout.time-slots')}}</h4>
    </span>
    <div class="table">
        <table>
            <thead>
                <tr>
                    <th>{{ __('delivery-time-slot::app.shop.checkout.seller')}}</th>
                    <th>{{ __('delivery-time-slot::app.shop.checkout.time')}}</th>
                    <th>{{ __('delivery-time-slot::app.shop.checkout.date-day')}}</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($selectedSlots as $slots)
                    <tr>
                        @if( is_null($slots['days']['get_sellers']))
                            <td>{{ __('delivery-time-slot::app.shop.checkout.admin')}}</td>
                            @else
                                <td>{{ ucwords($slots['days']['get_sellers']['customer']['first_name'])}} {{ ucwords($slots['days']['get_sellers']['customer']['last_name'])}}</td>
                        @endif

                        <td>{{$slots['days']['start_time']}}-{{$slots['days']['end_time']}}</td>
                        <td>{{ $slots['delivery_date'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif