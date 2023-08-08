<div class="control-group mt-20">
    <div v-for="slots, sellerId in sellersTimeSlots" class="mt-20">

        <div class="table" v-if="! slots.slotsNotAvilable">
            <div class="seller-name mb-20" v-if="sellerId == 0 && ! slots.SlotsNotAvilable" >
                <span>{{ __('delivery-time-slot::app.shop.checkout.seller')}}:</span>
                <span>{{ __('delivery-time-slot::app.shop.checkout.admin')}}</span>
            </div>

            <div class="seller-name mb-20" v-if="sellerId == 0 && slots.SlotsNotAvilable" >
                <span>{{ __('delivery-time-slot::app.shop.checkout.seller')}}:</span>
                <span>@{{slots.seller}}</span>
            </div>

            <div class="seller-name mb-20" v-if="slots.SlotsNotAvilable && sellerId != 0 ">
                <span>{{ __('delivery-time-slot::app.shop.checkout.seller')}}:</span>
                <span style="text-transform:capitalize;">
                    @{{ slots.seller.first_name }}  @{{ slots.seller.last_name }}
                </span>
            </div>

            <div class="seller-name mb-20" v-if="sellerId != 0 && !slots.SlotsNotAvilable">
                <span>{{ __('delivery-time-slot::app.shop.checkout.seller')}}:</span>
                <span style="text-transform:capitalize;">
                    @{{ slots.seller.first_name }}  @{{ slots.seller.last_name }}
                </span>
            </div>

            <table class="radio-boxed">
                <thead>
                    <tr>
                        <th>Date/Day</th>
                        <th colspan="2" style="border-left: 1px solid white;">Delivery Time Slots</th>
                    </tr>
                </thead>

                <tbody>
                    <tr v-if="slots.SlotsNotAvilable" >
                        <td colspan="1">
                            <span  class="message">
                                @{{ slots.message }}
                            </span>
                        </td>
                    </tr>
                    <tr v-for="timeSlots, index in slots.days">
                        <td style="text-transform:capitalize;" v-if="index != 'seller'">
                            @{{ index }}
                        </td>

                        <td class="timeslot-td">
                            <span v-for="timeSlot, key in timeSlots">
                                <span v-for="quota, quotaKey in slots.quotas" v-if="quotaKey == timeSlot.id && timeSlot.time_delivery_quota > quota && (Date.parse(['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'][new Date().getDay()] + ', '+new Date().getDate() + ' ' + (['','January', 'February', 'March', 'April', 'May', 'June',
                                    'July', 'August', 'September', 'October', 'November', 'December'
                                  ][new Date().getMonth()+1])+', '+new Date().getFullYear() +' '+ new Date().toLocaleString('en-US', { hour: 'numeric', minute: 'numeric', hour12: true }))) < Date.parse(index.split(' ')[2] + ' ' + index.split(' ')[0] + ' ' + index.split(' ')[1] + ' ' + index.split(' ')[3] +' '+ timeSlot.start_time)">
                                    <input type="radio" @change="methodSelectedTimeSlot($event)"  :id="timeSlot.id+'_'+sellerId" :name="'start_time_slot_'+sellerId" :value="[timeSlot.id, sellerId, index.split(' ')[2] + ' ' + index.split(' ')[0] + ' ' + index.split(' ')[1] + ' ' + index.split(' ')[3]]">
                                    <label :for="timeSlot.id+'_'+sellerId">
                                        @{{ timeSlot.start_time }} - @{{ timeSlot.end_time }}
                                    </label>
                                </span>

                                <span v-if="(Date.parse(['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'][new Date().getDay()] + ', '+new Date().getDate() + ' ' + (['','January', 'February', 'March', 'April', 'May', 'June',
                                'July', 'August', 'September', 'October', 'November', 'December'
                              ][new Date().getMonth()+1])+', '+new Date().getFullYear() +' '+ new Date().toLocaleString('en-US', { hour: 'numeric', minute: 'numeric', hour12: true }))) > (Date.parse(index.split(' ')[2] + ' ' + index.split(' ')[0] + ' ' + index.split(' ')[1] + ' ' + index.split(' ')[3] +' '+ timeSlot.start_time))">
                                <input type="radio"  name="start_time_slot">
                                    <label :for="timeSlot.id+'_'+sellerId" style="background-color:#fba0a0;" >
                                        @{{ timeSlot.start_time }} - @{{ timeSlot.end_time }}
                                    </label>
                                </span>

                                <span v-for="quota, quotaKey in slots.quotas" v-if="quotaKey == timeSlot.id && timeSlot.time_delivery_quota <= quota">
                                    <input type="radio"  name="start_time_slot">
                                    <label :for="timeSlot.id+'_'+sellerId" style="background-color:#fba0a0;" >
                                        @{{ timeSlot.start_time }} - @{{ timeSlot.end_time }}
                                    </label>
                                </span>

                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        @if (core()->getConfigData('delivery_time_slot.settings.general.show_message'))
            <div class="row col-12" v-else>
                <div style="border:1px solid red;width:100%;padding:15px">
                    <p class="fs20" v-if="slots.message">@{{ slots.message }}</p>
                    <p v-else> {{ core()->getConfigData('delivery_time_slot.settings.general.time_slot_error_message') ?: ' Warning: There are no slots avilable'}}</p>
                </div>
            </div>
        @endif

    </div>
</div>