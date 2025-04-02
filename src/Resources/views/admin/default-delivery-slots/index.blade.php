<x-admin::layouts>
    <!-- Title of the page -->
    <x-slot:title>
        @lang('delivery_time_slot::app.admin.delivery-time-slot.default-delivery-time')
    </x-slot>

    <!-- Create option Wrapper Vue Components -->
    <v-option-wrapper></v-option-wrapper>

    @pushOnce('scripts')
    <script type="text/x-template" id="v-option-wrapper-template">
        <x-admin::form
            method="POST"
            action="{{ route('admin.time-slot.store') }}"
            @click="onSubmit($event)"
        >
            <div class="flex items-center justify-between gap-4 max-sm:flex-wrap">
               <p class="text-[20px] font-bold text-gray-800 dark:text-white">
                    @lang('delivery_time_slot::app.admin.delivery-time-slot.default-delivery-time')
                </p>

                <div class="flex items-center gap-x-2.5">
                   <!-- Save Button -->
                    <button
                       class="primary-button"
                    >
                       @lang('delivery_time_slot::app.admin.delivery-time-slot.save-btn')
                    </button>
               </div>
            </div><br>

            <div
                class="flex w-full items-center gap-x-[4px]"
                v-if="applied.massActions.indices.length"
            >
                <x-admin::dropdown>
                    <!-- Dropdown Toggler -->
                    <x-slot:toggle>
                        <button
                            type="button"
                            class="inline-flex w-full max-w-max cursor-pointer appearance-none items-center justify-between gap-x-[8px] rounded-[6px] border bg-white px-[10px] py-[6px] text-center leading-[24px] text-gray-600 transition-all marker:shadow hover:border-gray-400 focus:border-gray-400 focus:ring-black dark:border-gray-800 dark:bg-gray-900 dark:text-gray-300 dark:hover:border-gray-400 dark:focus:border-gray-400"
                        >
                            <span>
                                @lang('admin::app.components.datagrid.toolbar.mass-actions.select-action')
                            </span>

                            <span class="icon-sort-down text-[24px]"></span>
                        </button>
                    </x-slot:toggle>

                    <!-- Dropdown Content -->
                    <x-slot:menu class="!p-0 shadow-[0_5px_20px_rgba(0,0,0,0.15)] dark:border-gray-800">
                        <template v-for="massAction in massActions">
                            <li
                                class="group/item relative overflow-visible"
                                v-if="massAction?.options?.length"
                            >
                                <a
                                    class="whitespace-no-wrap flex cursor-not-allowed justify-between gap-[5px] rounded-t px-4 py-2 text-[14px] text-gray-600 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-950"
                                    href="javascript:void(0);"
                                >
                                    <i
                                        class="text-[24px]"
                                        :class="massAction.icon"
                                        v-if="massAction?.icon"
                                    >
                                    </i>

                                    <span>
                                        @{{ massAction.title }}
                                    </span>

                                    <i class="icon-arrow-left -mt-[1px] text-[20px]"></i>
                                </a>

                                <ul class="absolute top-0 z-10 hidden w-max min-w-[150px] rounded-[4px] border bg-white shadow-[0_5px_20px_rgba(0,0,0,0.15)] group-hover/item:block ltr:left-full rtl:right-full dark:border-gray-800 dark:bg-gray-900">
                                    <li>
                                        <a
                                            class="whitespace-no-wrap block rounded-t px-4 py-2 text-[14px] text-gray-600 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-950"
                                            href="javascript:void(0);"
                                            v-text="option.label"
                                            @click="performMassAction(massAction.title, option)"
                                        >
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li v-else>
                                <a
                                    class="whitespace-no-wrap flex gap-[5px] rounded-b px-4 py-2 text-[14px] text-gray-600 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-950"
                                    href="javascript:void(0);"
                                    @click="performMassAction(massAction)"
                                >
                                    <i
                                        class="text-[24px]"
                                        :class="massAction.icon"
                                        v-if="massAction?.icon"
                                    >
                                    </i>

                                    @{{ massAction.title }}
                                </a>
                            </li>
                        </template>
                    </x-slot:menu>
                </x-admin::dropdown>

                <div class="ltr:pl-[10px] rtl:pr-[10px]">
                    <p class="text-[14px] font-light text-gray-800 dark:text-white">
                        <!-- Need to manage this translation. -->
                        @{{ applied.massActions.indices.length }} of {{ count($timeSlots) }} Selected
                    </p>
                </div>
            </div>
            
            <div 
                v-else
                class="mt-3.5 flex gap-2"
            >
                <x-admin::form.control-group class="w-[525px]">
                   <x-admin::form.control-group.label class="required text-sm">
                        @lang('delivery_time_slot::app.admin.delivery-time-slot.minimum-required-time.title')
                   </x-admin::form.control-group.label>

                   <x-admin::form.control-group.control
                        type="text"
                        name="minimum_time_required"
                        v-model="minimum_time"
                        @input="minimumTime(minimum_time, $event)"
                    >
                    </x-admin::form.control-group.control>

                    <div>
                        <span 
                           class="mt-1 text-sm italic text-red-600" 
                            v-if="minimum_time_exception"
                        >
                            @lang('delivery_time_slot::app.admin.delivery-time-slot.minimum-required-time.minimum-time-exception')
                        </span>
                    </div>

                    <span class="text-sm font-bold text-gray-800 dark:text-white" >
                        @lang('delivery_time_slot::app.admin.delivery-time-slot.minimum-required-time.info')
                    </span>
                </x-admin::form.control-group>
           </div>
    
            <div class="box-shadow mt-[20px] overflow-x-auto rounded-[6px] border">
                <x-admin::table>
                    <x-admin::table.thead class="text-sm font-medium dark:bg-gray-800">
                        <x-admin::table.thead.tr>
                            <!-- Mass Action -->
                            <x-admin::table.th>
                                <label for="mass_action_select_all_records">
                                    <input
                                        type="checkbox"
                                        name="mass_action_select_all_records"
                                        id="mass_action_select_all_records"
                                        :checked="['all', 'partial'].includes(applied.massActions.meta.mode)"
                                        class="peer hidden"
                                        @change="selectAllRecords"
                                    >

                                    <span
                                        class="icon-uncheckbox cursor-pointer rounded-[6px] text-[24px]"
                                        :class="[
                                            applied.massActions.meta.mode === 'all' ? 'peer-checked:icon-checked peer-checked:text-blue-600 ' : (
                                                applied.massActions.meta.mode === 'partial' ? 'peer-checked:icon-checkbox-partial peer-checked:text-blue-600' : ''
                                            ),
                                        ]"
                                    >
                                    </span>
                                </label>
                            </x-admin::table.th>

                            <!-- Delivery Date -->
                            <x-admin::table.th class="required">
                               @lang('delivery_time_slot::app.admin.delivery-time-slot.delivery_date')
                            </x-admin::table.th>

                             <!-- Delivery Day -->
                            <x-admin::table.th>
                               @lang('delivery_time_slot::app.admin.delivery-time-slot.day')
                            </x-admin::table.th>

                           <!-- Start Time -->
                           <x-admin::table.th>
                              @lang('delivery_time_slot::app.admin.delivery-time-slot.start-time')       
                           </x-admin::table.th>

                            <!-- End Time -->
                            <x-admin::table.th>
                               @lang('delivery_time_slot::app.admin.delivery-time-slot.end-time')           
                            </x-admin::table.th>

                            <!-- Quota -->
                            <x-admin::table.th>
                              @lang('delivery_time_slot::app.admin.delivery-time-slot.quotas')               
                            </x-admin::table.th>

                            <!-- Status -->
                            <x-admin::table.th>
                              @lang('delivery_time_slot::app.admin.delivery-time-slot.status')
                            </x-admin::table.th>

                            <!-- Action -->
                            <x-admin::table.th>
                               @lang('delivery_time_slot::app.admin.delivery-time-slot.action')
                            </x-admin::table.th>
                        </x-admin::table.thead.tr>                    
                    </x-admin::table.thead>

                    <x-admin::table.thead.tr v-for="input, index in inputs">
                       <x-admin::table.td>
                           <label 
                               class="flex w-max cursor-pointer select-none items-center gap-x-1"
                               :for="`mass_action_select_record_${input.id}`"
                            >
                                <input 
                                    type="checkbox" 
                                    :name="`mass_action_select_record_${input.id}`"
                                    :id="`mass_action_select_record_${input.id}`"
                                    v-model="applied.massActions.indices"
                                    :value="input.id"
                                    class="peer hidden"
                                    @change="setCurrentSelectionMode"
                                >
                    
                                <span class="icon-uncheckbox peer-checked:icon-checked cursor-pointer rounded-[6px] text-[24px] peer-checked:text-blue-600"></span>
                            </label>
                        </x-admin::table.td>

                        <input 
                           type="hidden" 
                           name="id[]" 
                           v-model="input.id"
                        >
                    
                        <x-admin::table.td>
                            <x-delivery_time_slot::date ::allow-input="false">
                                <input 
                                    type="text" 
                                    class="flatpickr-input min-h-[39px] w-[160px] cursor-pointer rounded-[6px] border px-3 py-2 text-[14px] text-gray-600 transition-all hover:border-gray-400 focus:border-gray-400 dark:border-gray-800 dark:bg-gray-900 dark:text-gray-300 dark:hover:border-gray-400 dark:focus:border-gray-400"
                                    name="delivery_date[]"
                                    v-model="input.delivery_date"
                                    @input="validateDeliveryDay(input.delivery_date, $event, index)"
                                    placeholder="Select Date"
                                > 
                            </x-delivery_time_slot::date>

                            <div class="control-error">
                                <span 
                                    v-if="inputs[index].has_exception"
                                    class="text-xs italic text-red-600" 
                                >
                                   @lang('delivery_time_slot::app.admin.delivery-time-slot.start-time-exception')
                                </span>
                            </div>
                        </x-admin::table.td>
    
                        <x-admin::table.td>  
                            <select
                                class="icon:white flex min-h-[39px] w-[100px] rounded-[6px] border px-2 py-2 text-sm text-gray-600 transition-all hover:border-gray-400 focus:border-gray-400 dark:border-gray-800 dark:bg-gray-900 dark:text-gray-300 dark:hover:border-gray-400 dark:focus:border-gray-400"
                                name="delivery_day[]"
                                v-model= "input.delivery_day"
                                @change="validateDeliveryDay(input.delivery_date, $event, index)"
                            >
                                @php
                                  $lang = Lang::get('delivery_time_slot::app.admin.delivery-time-slot.days')
                                @endphp

                                @foreach($lang as $languageFile)
                                    <option value="{{strtolower($languageFile) }}"
                                       v-if="input.delivery_day == '{{ strtolower($languageFile) }}'"
                                       selected-value="{{strtolower($languageFile) }}"
                                    >
                                    {{ $languageFile }}
                                   </option>
                                @endforeach
                           </select>   
                             
                           <div class="control-error">
                                <span 
                                    v-if="inputs[index].has_exception"
                                    class="text-xs italic text-red-600" 
                                >
                                   @lang('delivery_time_slot::app.admin.delivery-time-slot.start-time-exception')
                                </span>
                            </div>        
                       </x-admin::table.td>

                    <x-admin::table.td  v-if="inputs[index].start_time_exception">
                        <x-delivery_time_slot::time 
                            class="mt-3"
                            ::allow-input="false"
                        > 
                            <input 
                                type="text" 
                                class="flatpickr-input min-h-[39px] w-[160px] cursor-pointer rounded-[6px] border px-3 py-2 text-[14px] text-gray-600 transition-all hover:border-gray-400 focus:border-gray-400 dark:border-gray-800 dark:bg-gray-900 dark:text-gray-300 dark:hover:border-gray-400 dark:focus:border-gray-400"
                                name="start_time[]"                                                                                                                                                             
                                v-model="input.start_time"                                                                                                                                                  
                                placeholder="Start time"
                                v-validate="validate[inputs[index].start_time_exception] || is_required ? 'required' : ''"
                            >
                        </x-delivery_time_slot::time>
                        
                        <div class="control-error">
                            <span 
                                class="text-xs italic text-red-600"                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     
                            >
                                @lang('delivery_time_slot::app.admin.delivery-time-slot.start-time-exception')
                            </span>
                        </div>
                    </x-admin::table.td>

                    <x-admin::table.td  v-else>
                        <x-delivery_time_slot::time 
                            class="mt-2"
                            ::allow-input="false"
                        > 
                            <input 
                                type="text" 
                                class="flatpickr-input min-h-[39px] w-[160px] cursor-pointer rounded-[6px] border px-3 py-2 text-[14px] text-gray-600 transition-all hover:border-gray-400 focus:border-gray-400 dark:border-gray-800 dark:bg-gray-900 dark:text-gray-300 dark:hover:border-gray-400 dark:focus:border-gray-400"
                                name="start_time[]"
                                v-model="input.start_time"
                                placeholder="Start time"
                                v-validate="validate[inputs[index].start_time_exception] || is_required ? 'required' : ''"
                            >
                        </x-delivery_time_slot::time>
                    </x-admin::table.td>

                    <x-admin::table.td  v-if="inputs[index].end_time_exception">
                        <x-delivery_time_slot::time 
                            class="mt-3"
                            ::allow-input="false"
                        >  
                            <input 
                                type="text" 
                                class="flatpickr-input min-h-[39px] w-[160px] cursor-pointer rounded-[6px] border px-3 py-2 text-[14px] text-gray-600 transition-all hover:border-gray-400 focus:border-gray-400 dark:border-gray-800 dark:bg-gray-900 dark:text-gray-300 dark:hover:border-gray-400 dark:focus:border-gray-400"
                                name="end_time[]"
                                placeholder="End time"
                                v-model="input.end_time"
                                @change="validateEndTime(input.start_time, $event, index)"
                                v-validate="validate[inputs[index].end_time_exception] || is_required ? 'required' : ''"
                            > 
                        </x-delivery_time_slot::time>
                        
                        <div class="control-error">
                            <span 
                                class="text-xs italic text-red-600" 
                            >
                                @lang('delivery_time_slot::app.admin.delivery-time-slot.end-time-exception')
                            </span>
                        </div>
                    </x-admin::table.td>

                    <x-admin::table.td v-else>
                        <x-delivery_time_slot::time 
                            class="mt-2"
                            ::allow-input="false"
                        >  
                            <input 
                                type="text" 
                                class="flatpickr-input min-h-[39px] w-[160px] cursor-pointer rounded-[6px] border px-3 py-2 text-[14px] text-gray-600 transition-all hover:border-gray-400 focus:border-gray-400 dark:border-gray-800 dark:bg-gray-900 dark:text-gray-300 dark:hover:border-gray-400 dark:focus:border-gray-400"
                                name="end_time[]"
                                placeholder="End time"
                                v-model="input.end_time"
                                @change="validateEndTime(input.start_time, $event, index)"
                                v-validate="validate[inputs[index].end_time_exception] || is_required ? 'required' : ''"
                            > 
                        </x-delivery_time_slot::time>
                    </x-admin::table.td>

                    <x-admin::table.td>
                        <input
                            class="flex min-h-[39px] w-[85px] rounded-[6px] border px-3 py-2 text-base text-gray-600 transition-all hover:border-gray-400 focus:border-gray-400 dark:border-gray-800 dark:bg-gray-900 dark:text-gray-300 dark:hover:border-gray-400 dark:focus:border-gray-400"
                            type="number"
                            name="time_delivery_quota[]"
                            placeholder="Quota"
                            value='InsertedValue.time_delivery_quota'
                            v-model="input.time_delivery_quota"
                        >

                        <div class="control-error">
                            <span 
                                v-if="inputs[index].has_exception"
                                class="text-xs italic text-red-600" 
                            >
                                @lang('delivery_time_slot::app.admin.delivery-time-slot.start-time-exception')
                            </span>
                        </div>
                    </x-admin::table.td>

                    <x-admin::table.td>
                        <select 
                           class="flex min-h-[39px] w-[95px] rounded-[6px] border px-3 py-2 text-base text-gray-600 transition-all hover:border-gray-400 focus:border-gray-400 dark:border-gray-800 dark:bg-gray-900 dark:text-gray-300 dark:hover:border-gray-400 dark:focus:border-gray-400"
                            name="status[]"
                        >
                            <option value="1" :selected="input.status === 1">
                                @lang('delivery_time_slot::app.admin.delivery-time-slot.enable')
                            </option>

                            <option value="0" :selected="input.status === 0">
                                @lang('delivery_time_slot::app.admin.delivery-time-slot.disable')
                            </option>
                        </select>
                        
                        <div class="control-error">
                            <span 
                                v-if="inputs[index].has_exception"
                                class="text-xs italic text-red-600" 
                            >
                                @lang('delivery_time_slot::app.admin.delivery-time-slot.start-time-exception')
                            </span>
                        </div>
                    </x-admin::table.td>

                    <x-admin::table.td>
                        <button
                            type="button"
                            @click="removeRow(input.id, index)"
                            class="primary-button"
                        >
                            @lang('delivery_time_slot::app.admin.delivery-time-slot.btn.delete')
                        </button>
                    </x-admin::table.td>
                </x-admin::table.thead.tr>
              </x-admin::table>
            </div>
      </x-admin::form>

       <button
            type="button"
            @click="addInput"
            class="primary-button mt-[20px]"
        >
            @lang('delivery_time_slot::app.admin.delivery-time-slot.btn.add-time-slot') 
        </button>
    </script>

    <script type="module">
        app.component('v-option-wrapper', {
            template: '#v-option-wrapper-template',

            data: function(data) {
                return {
                    data: @json($timeSlots),

                    minimumTimeData: @json($minimumTimeRequired),
                    
                    validate: {
                        'is_required': false,
                    },

                    is_required: '',

                    selectedDay : '',

                    minimum_time : '',

                    massActions: [{
                        'icon'  : 'icon-delete',
                        'title' : 'Delete',
                    }],

                    applied: {
                        massActions: {
                            meta: {
                                mode: 'none',

                                action: null,
                            },

                            indices: [],

                            value: null,
                        }
                    },

                    minimum_time_exception: true,
                
                    weekdays : [
                        'sunday',
                        'monday',
                        'tuesday',
                        'wednesday',
                        'thursday',
                        'friday',
                        'saturday',
                    ],

                    inputs:[{
                        id: "",
                        delivery_date: "",
                        delivery_day: "",
                        start_time: "",
                        end_time: "",
                        time_delivery_quota: "",
                        status : "",
                        is_required: false,
                        validate: {
                            'is_required': false,
                        },
                    }],
                }
            },

            mounted () {
               this.get();
            },

            methods: {
                get() {
                    this.minimum_time = this.minimumTimeData;

                    if( 
                       this.minimum_time >= 1
                        &&  this.minimum_time <= 7
                    ) {
                        this.minimum_time_exception = false;
                    }

                    for (let i = 0; i < this.data.length; i++) {
                        this.inputs.push({
                            id: this.data[i].id,
                            delivery_date: this.data[i].delivery_date,
                            delivery_day : this.data[i].delivery_day,
                            start_time : this.data[i].start_time,
                            end_time : this.data[i].end_time,
                            time_delivery_quota : this.data[i].time_delivery_quota,
                            status : this.data[i].status,
                        });
                    }

                    if (this.inputs.length != 0) {
                        this.inputs.shift();
                    }
                },

                addInput(e) {
                    this.inputs.push({
                        id:'',
                        delivery_date: '',
                        delivery_day: '',
                        start_time: '',
                        end_time: '',
                        time_delivery_quota: '',
                        status: '',
                        is_required: false,
                        validate: {
                            'is_required': false,
                        },
                    });
                },

                removeRow(timeSlotId, index){
                    const method = 'post';

                    if (timeSlotId) {
                        this.$emitter.emit('open-confirm-modal', {
                            agree: () => {
                               switch (method) {
                                   case 'post':
                                       this.$axios[method](`{{ route('admin.time-slot.delete') }}`, {
                                           id: timeSlotId,
                                        })
                                        .then(response => {
                                            this.$emitter.emit('add-flash', { type: 'success', message: response.data.message });

                                            location.reload(true);
                                        })
                                        .catch((error) => {
                                           this.$emitter.emit('add-flash', { type: 'error', message: error.response.data.message });
                                       });

                                        break;
                                    default:
                                        console.error('Method not supported.');

                                        break;
                                }
                            }
                        });
                    } else {
                        this.inputs.splice(index, 1);
                    }
                },
          
                minimumTime(minimum_time, e) {
                    if (
                        minimum_time >= 1 
                        && minimum_time <= 7
                    ) {
                        this.minimum_time_exception = false;
                    } else {
                        this.minimum_time_exception = true;
                    }
                },

                validateDeliveryDay(delivery_date, event, index) {
                    var deliveryDate = delivery_date;

                    var date = new Date(Date.parse(deliveryDate)).getDay()
                     
                    var formattedDay = this.weekdays[date];

                    this.inputs[index].delivery_day = formattedDay;
                },

                validateEndTime(start_time, event, index, endTime, setEndTime) {
                    if (typeof setEndTime === 'undefined') {
                        var endTime = event.target.value;
                    }
                    
                    var endTime = endTime;

                    var startTime = start_time;
                    
                    var today = new Date();
                    
                    var dd = String(today.getDate()).padStart(2, '0');

                    var mm = String(today.getMonth() + 1).padStart(2, '0'); /** January is 0! */

                    var yyyy = today.getFullYear();

                    var today = mm + '/' + dd + '/' + yyyy;

                    var formattedStartTime = today + ' ' + startTime;

                    var formattedEndTime = today + ' ' + endTime;
                    
                    if (new Date(Date.parse(formattedStartTime)) < new Date(Date.parse(formattedEndTime))) {
                        this.inputs[index].end_time_exception = false;

                        this.inputs[index].start_time_exception = false;
                    } else {
                        this.inputs[index].end_time_exception = true;

                        this.inputs[index].start_time_exception = true;
                    }
                    
                    this.error();
                     
                    this.validateStartTime(endTime, event, index, startTime, setStartTime = true);
                },

                selectAllRecords() {
                    this.setCurrentSelectionMode();

                    if (['all', 'partial'].includes(this.applied.massActions.meta.mode)) {
                        this.data.forEach(record => {
                            const id = record.id;

                            this.applied.massActions.indices = this.applied.massActions.indices.filter(selectedId => selectedId !== id);
                        });

                        this.applied.massActions.meta.mode = 'none';
                    } else {
                        this.data.forEach(record => {
                            const id = record.id;

                            let found = this.applied.massActions.indices.find(selectedId => selectedId === id);

                            if (! found) {
                                this.applied.massActions.indices.push(id);
                            }
                        });

                        this.applied.massActions.meta.mode = 'all';
                    }
                },

                setCurrentSelectionMode() {
                    this.applied.massActions.meta.mode = 'none';

                    if (!this.data.length) {
                        return;
                    }

                    let selectionCount = 0;

                    this.data.forEach(record => {
                        const id = record.id;

                        if (this.applied.massActions.indices.includes(id)) {
                            this.applied.massActions.meta.mode = 'partial';

                            ++selectionCount;
                        }
                    });

                    if (this.data.length === selectionCount) {
                        this.applied.massActions.meta.mode = 'all';
                    }
                },

                performMassAction(currentAction, currentOption = null) {
                    this.applied.massActions.meta.action = currentAction;

                    if (currentOption) {
                        this.applied.massActions.value = currentOption.value;
                    }

                    const method = 'post';

                    this.$emitter.emit('open-confirm-modal', {
                        agree: () => {
                            switch (method) {
                                case 'post':
                                    this.$axios[method](`{{ route('admin.time-slot.mass-delete') }}`, {
                                            indices: this.applied.massActions.indices
                                        })
                                        .then(response => {
                                            this.$emitter.emit('add-flash', { type: 'success', message: response.data.message });

                                            location.reload(true);
                                        })
                                        .catch((error) => {
                                            this.$emitter.emit('add-flash', { type: 'error', message: error.response.data.message });
                                        });

                                    break;

                                default:
                                    console.error('Method not supported.');

                                    break;
                            }

                            this.applied.massActions.indices  = [];
                        }
                    });
                },

                onSubmit(e) {
                    for (var i = 0; i < this.inputs.length; i++) {
                        var startTime = this.inputs[i].start_time_exception;
                        var endTime = this.inputs[i].end_time_exception;

                        if (
                            startTime 
                            || endTime
                        ) {
                            return e.preventDefault();
                        }
                    }
                },

                error() {
                    console.log = console.warn = console.error = () => {};
                },
            },
        });
    </script>
    @endPushOnce
</x-admin::layouts>
