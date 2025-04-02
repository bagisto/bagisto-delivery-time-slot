{!! view_render_event('bagisto.shop.checkout.shipping.method.before') !!}
<v-shipping-method ref="vShippingMethod" >
    <!-- Shipping Method Shimmer Effect -->
    <x-shop::shimmer.checkout.onepage.shipping-method/>
</v-shipping-method>

{!! view_render_event('bagisto.shop.checkout.shipping.method.after') !!}
@pushOnce('scripts')
    <script type="text/x-template" id="v-shipping-method-template">
        <div class="mt-[30px]"> 
            <template v-if="! isShowShippingMethod && isShippingMethodLoading">
                <!-- Shipping Method Shimmer Effect -->
                <x-shop::shimmer.checkout.onepage.shipping-method/>
            </template>

            <template v-if="isShowShippingMethod">
                <x-shop::accordion class="!border-b-0">
                    <x-slot:header >
                        <div class="flex items-center justify-between">
                            <h2 class="text-[26px] font-medium max-sm:text-[20px]">
                                @lang('shop::app.checkout.onepage.shipping.shipping-method')
                            </h2>
                        </div>
                    </x-slot:header>

                    <x-slot:content>
                        <div class="mt-[30px] flex flex-wrap gap-[30px]">
                            <div
                                class="relative max-w-[218px] select-none max-sm:max-w-full max-sm:flex-auto"
                                v-for="shippingMethod in shippingMethods"
                            >  

                                {!! view_render_event('bagisto.shop.checkout.shipping-method.before') !!}

                                <div v-for="rate in shippingMethod.rates">
                                    <input 
                                        type="radio"
                                        name="shipping_method"
                                        :id="rate.method"
                                        :value="rate.method"
                                        class="peer hidden"
                                        @change="store(rate.method)"
                                    >
                                      
                                    <label 
                                        class="icon-radio-unselect peer-checked:icon-radio-select absolute top-5 cursor-pointer text-2xl text-navyBlue ltr:right-5 rtl:left-5"
                                        :for="rate.method"
                                    >
                                    </label>

                                    <label 
                                        class="block cursor-pointer rounded-[12px] border border-[#E9E9E9] p-[20px]"
                                        :for="rate.method"
                                    >
                                        <span class="icon-flate-rate text-[60px] text-navyBlue"></span>

                                        <p class="mt-[5px] text-[25px] font-semibold max-sm:text-[20px]">
                                            @{{ rate.base_formatted_price }}
                                        </p>
                                        
                                        <p class="mt-[10px] text-[12px] font-medium">
                                            <span class="font-medium">@{{ rate.method_title }}</span> - @{{ rate.method_description }}
                                        </p>
                                    </label>
                                </div>

                                {!! view_render_event('bagisto.shop.checkout.shipping-method.after') !!}

                            </div>
                        </div>
                    
                    @if (core()->getConfigData('delivery_time_slot.settings.general.enable_time_slot'))
                        <div class="flex items-center justify-between" v-if="requireException">
                            <h2 class="mt-[20px] text-base font-medium text-red-500 max-sm:text-xl">
                                @lang('delivery_time_slot::app.shop.checkout.shipping-method-required')
                            </h2>
                        </div> 

                       <div class="flex items-center justify-between">
                            <h2 class="mt-[20px] text-2xl font-medium max-sm:text-xl">
                               @lang('delivery_time_slot::app.shop.delivery-time-slot.title')
                            </h2>
                        </div> 

                        <div class="mt-4 flex flex-wrap gap-8"> 
                            <div
                              class="relative max-w-[218px] select-none max-sm:max-w-full max-sm:flex-auto"
                            > 
                               <x-admin::table class="radio-boxed cursor-pointer rounded-[6px] border border-[#E9E9E9] p-5">
                                    <x-admin::table.thead>
                                       <x-admin::table.thead.tr class="mt-1.5 text-xl font-semibold text-black max-sm:text-base">
                                            <!-- Admin tables heading -->
                                           <x-admin::table.th>
                                             @lang('delivery_time_slot::app.shop.checkout.date-day')
                                          </x-admin::table.th>

                                           <!-- Admin tables heading -->
                                          <x-admin::table.th>
                                             @lang('delivery_time_slot::app.shop.checkout.time-slots')   
                                           </x-admin::table.th>                           
                                        </x-admin::table.thead.tr>                    
                                    </x-admin::table.thead>

                                    <x-admin::table.thead.tr v-if="sellersTimeSlots.SlotsNotAvailable">
                                        <x-admin::table.td>
                                            <div> 
                                                @{{ sellersTimeSlots.message }}
                                           </div>    
                                        </x-admin::table.td>
                                   </x-admin::table.thead.tr>

                                    <x-admin::table.thead.tr v-for="timeSlot, index in sellersTimeSlots.slots">
                                        <x-admin::table.td
                                          for="selected_time_slots" 
                                          name="deliveryDate"
                                        >
                                           @{{index}}
                                        </x-admin::table.td>

                                        <x-admin::table.td>                           
                                           <div 
                                                class="flex flex-col gap-x-1"
                                                v-for="slot, key in timeSlot"
                                            >
                                                <span 
                                                    class="mb-3 w-full rounded border px-3 py-2 text-[14px] text-gray-600 shadow transition-all hover:border-gray-400 focus:border-gray-400"
                                                    v-if="slot.time_delivery_quota > slot.quota || slot.delivery_date >= today"
                                                >
                                                   <input 
                                                      type="radio"
                                                      class="text-2xl text-navyBlue"
                                                      :name="time_slot+'_'+index" 
                                                      @click="methodSelectedTimeSlot(slot.id)"  
                                                      :value="slot.id"
                                                      v-model="selectedSlot"
                                                    >

                                                    <label 
                                                       :for="slot.id" 
                                                       class="p-2"
                                                    >
                                                        @{{ slot.start_time }} - @{{ slot.end_time }}
                                                   </label>
                                                </span>
                                
                                               <span
                                                    class="mb-3 w-full rounded border px-3 py-2 text-[14px] text-red-500 shadow transition-all hover:border-gray-400 focus:border-gray-400"
                                                    v-else
                                                >
                                                   <input 
                                                        type="radio" 
                                                        :name="time_slot+'_'+index" 
                                                        @click="methodSelectedTimeSlot(slot.id)"
                                                        :value="slot.id"
                                                        v-model="selectedSlot"
                                                    >

                                                    <label 
                                                        :for="slot.id" 
                                                        class="p-2"
                                                    >
                                                        @{{ slot.start_time }} - @{{ slot.end_time }}
                                                   </label>
                                               </span>
                                            </div>
                                        </x-admin::table.td>
                                   </x-admin::table.thead.tr>
                                </x-admin::table>
                           </div>
                        </div>
                    @endif
                    </x-slot:content>
                </x-shop::accordion>
            </template>
        </div>
    </script>

    <script type="module">
        app.component('v-shipping-method', {
            template: '#v-shipping-method-template',

            data() {
                return {
                    shippingMethods: [],

                    isShowShippingMethod: false,

                    isShippingMethodLoading: false,

                    today: '',
                    
                    sellersTimeSlots: [],

                    isShippingMethodSelected: false,

                    selectedSlot:null,

                    requireException: false,
                }       
            },

            mounted() {
                var now = new Date();
                
                const date = String(now.getDate()).padStart(2, '0');

                const month = String(now.getMonth() + 1).padStart(2, '0');

                const year = now.getFullYear();

                this.today = `${date}/${month}/${year}`;
            },
             
            methods: {
                store(selectedShippingMethod) {
                    this.$parent.$refs.vCartSummary.canPlaceOrder = false;

                    this.$parent.$refs.vPaymentMethod.isShowPaymentMethod = false;

                    this.$parent.$refs.vPaymentMethod.isPaymentMethodLoading = true;
                      
                    this.$axios.post("{{ route('shop.checkout.onepage.shipping_methods.store') }}", {    
                        shipping_method: selectedShippingMethod,
                    })
                    .then(response => {
                        this.$parent.getOrderSummary();

                        this.isShippingMethodSelected = true;

                        this.requireException = false;

                        this.$parent.$refs.vPaymentMethod.payment_methods = response.data.payment_methods;

                        this.$parent.$refs.vPaymentMethod.isShowPaymentMethod = true;

                        this.$parent.$refs.vPaymentMethod.isPaymentMethodLoading = false;
                    })
                    .catch(error => {});                
                },

                /**
                 * Delivery time slot scripts.
                 */
                methodSelectedTimeSlot: function(selectedSlot) {
                    if (this.isShippingMethodSelected && selectedSlot) {
                        this.$axios.post("{{ route('shop.checkout.onepage.delivery_time_Slot.store') }}", {    
                           deliverySlotId: selectedSlot
                       })
                       .then(response => {
                          this.$parent.getOrderSummary();

                          this.requireException = false;
                        })
                        .catch(error => {}); 
                    }  else {
                        this.requireException = true;
                    }            
                },
            },
        });
    </script>
@endPushOnce