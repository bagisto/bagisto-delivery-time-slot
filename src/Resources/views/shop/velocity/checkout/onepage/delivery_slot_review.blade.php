@if ( isset($selectedSlots) && ! empty($selectedSlots))
    <br>
    <span>
        <h4>{{ __('delivery-time-slot::app.shop.checkout.time-slots')}}</h4>
    </span>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
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
                        @if (is_null($slots['days']['get_sellers']))
                            <td>{{ __('delivery-time-slot::app.shop.checkout.admin')}}</td>
                        @else
                            <td>{{ ucwords($slots['days']['get_sellers']['customer']['first_name'])}} {{ ucwords($slots['days']['get_sellers']['customer']['last_name'])}}</td>
                        @endif

                        @if (core()->getConfigData('delivery_time_slot.settings.general.display_time_format') == 12)
                            <td>{{ date('h:i A', strtotime($slots['days']['start_time'])) }}-{{ date('h:i A', strtotime($slots['days']['end_time'])) }}</td>
                        @else
                            <td>{{$slots['days']['start_time']}}-{{$slots['days']['end_time']}}</td>
                        @endif

                        <td>{{ $slots['delivery_date'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif