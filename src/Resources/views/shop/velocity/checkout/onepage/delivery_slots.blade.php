<div class="control-group mt-20">
    <div v-for="slots, sellerId in sellersTimeSlots" class="mt-20">

        <div class="table-responsive" v-if="! slots.slotsNotAvilable">
            <table class="table table-bordered table-hover" style="white-space: nowrap;">
                <thead class="thead-light">
                    <tr>
                        <th>Date/Day</th>
                        <th>Delivery Time Slots</th>
                    </tr>
                </thead>

                <tbody>
                    @php core()->getCurrentLocale()->direction == 'rtl' ? $style = 'style="text-align: right;"' : $style = '';
                    @endphp
                    <tr v-for="timeSlots, index in slots.days" {!! $style; !!}> 
                        <td v-if="index != 'seller'">
                        &#x202a;@{{ index }}&#x202c;
                        </td>

                        <td class="timeslot-td">
                            <span v-for="timeSlot, key in timeSlots">
                                <div class="radio">
                                    <span v-for="quota, quotaKey in slots.quotas" v-if="quotaKey == timeSlot.id && timeSlot.time_delivery_quota > quota && (Date.parse(['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'][new Date().getDay()] + ', '+new Date().getDate() + ' ' + (['','January', 'February', 'March', 'April', 'May', 'June',
                                        'July', 'August', 'September', 'October', 'November', 'December'
                                    ][new Date().getMonth()+1])+', '+new Date().getFullYear() +' '+ new Date().toLocaleString('en-US', { hour: 'numeric', minute: 'numeric', hour12: true }))) < Date.parse(index.split(' ')[2] + ' ' + index.split(' ')[0] + ' ' + index.split(' ')[1] + ' ' + index.split(' ')[3] +' '+ timeSlot.start_time)" style="padding: 3px;">
                                        <input type="radio" @change="methodSelectedTimeSlot($event)" @change="methodSelected()" :id="timeSlot.id+'_'+sellerId" :name="'start_time_slot_'+sellerId" :value="[timeSlot.id, sellerId, index.split(' ')[2] + ' ' + index.split(' ')[0] + ' ' + index.split(' ')[1] + ' ' + index.split(' ')[3]]">
                                        <label class="radio-view" :for="timeSlot.id+'_'+sellerId">
                                        </label>
                                        <div class="pl30">
                                            <div class="row ml-2 mr-2" style="margin-top: -20px;">
                                                @{{ timeSlot.start_time }} - @{{ timeSlot.end_time }}
                                            </div>
                                        </div>
                                    </span>

                                    <span v-if="(Date.parse(['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'][new Date().getDay()] + ', '+new Date().getDate() + ' ' + (['','January', 'February', 'March', 'April', 'May', 'June',
                                    'July', 'August', 'September', 'October', 'November', 'December'][new Date().getMonth()+1])+', '+new Date().getFullYear() +' '+ new Date().toLocaleString('en-US', { hour: 'numeric', minute: 'numeric', hour12: true }))) > (Date.parse(index.split(' ')[2] + ' ' + index.split(' ')[0] + ' ' + index.split(' ')[1] + ' ' + index.split(' ')[3] +' '+ timeSlot.start_time))" style="padding: 10px;">
                                        <label class="radio-view" :for="timeSlot.id+'_'+sellerId">
                                        </label>
                                        <div class="pl30" style="background-color:#fba0a0;">
                                            <div class="row ml-2 mr-2" style="margin-top: -20px;">
                                                @{{ timeSlot.start_time }} - @{{ timeSlot.end_time }}
                                            </div>
                                        </div>
                                    </span>

                                    <span v-for="quota, quotaKey in slots.quotas" v-if="quotaKey == timeSlot.id && timeSlot.time_delivery_quota <= quota" style="padding: 10px;">
                                        <label class="radio-view" :for="timeSlot.id+'_'+sellerId">
                                        </label>
                                        <div class="pl30" style="background-color:#fba0a0;">
                                            <div class="row ml-2 mr-2" style="margin-top: -20px;">
                                                @{{ timeSlot.start_time }} - @{{ timeSlot.end_time }}
                                            </div>
                                        </div>
                                    </span>
                                </div>
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