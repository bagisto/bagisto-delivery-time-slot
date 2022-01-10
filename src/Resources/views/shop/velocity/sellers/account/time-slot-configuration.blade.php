@extends('shop::customers.account.index')

@section('page_title')
    {{ __('delivery-time-slot::app.shop.layouts.delivery-time-configuration') }}
@stop

@section('page-detail-wrapper')
    <div class="account-layout">
        <option-wrapper></option-wrapper>
    </div>
@stop


@push('scripts')
    <script type="text/x-template" id="options-template">
        <form method="POST" action="{{route('marketplace.timeslot.seller.saveconfig') }}" @submit.prevent="onSubmit">
            <div class="account-head mb-30">
                <span class="account-heading">
                    {{ __('delivery-time-slot::app.shop.layouts.delivery-time-configuration') }}
                </span>

                <div class="account-action">
                    <button type="submit" class="btn btn-lg btn-success">
                        {{ __('delivery-time-slot::app.shop.layouts.save-btn') }}
                    </button>
                </div>
            </div>
            <div class="horizontal-rule"></div>
            @csrf()
            <br>
            <div class="sale-section" style="width:100%;">
                <div class="control-group" style="width:100%;" :class="[errors.has('minimum_time_required') ? 'has-error' : '']">
                    <label for="minimum_time_required" class="required">{{ __('delivery-time-slot::app.shop.seller.minimum-required-time') }}</label>

                    <input type="text" class="control" name="minimum_time_required" v-validate="'required'" value="{{ $minimuTimeRequired->minimum_time_required ?? 1 }}" data-vv-as="&quot;{{ __('delivery-time-slot::app.shop.seller.minimum-required-time') }}&quot;">

                    <span class="control-error" v-if="errors.has('minimum_time_required')">@{{ errors.first('minimum_time_required') }}</span>

                    <span class="control-info" >Enter number of days, e.g: 5</span>
                </div>

                <div class="table">
                <table v-for="input, index in inputs" v-if="input.start_time || input.end_time != null">
                    <thead>
                        <tr>
                            <th class="required">{{ __('delivery-time-slot::app.admin.layouts.select-day') }}</th>
                            <th>{{ __('delivery-time-slot::app.admin.layouts.start-time') }}</th>
                            <th>{{ __('delivery-time-slot::app.admin.layouts.end-time') }}</th>
                            <th>{{ __('delivery-time-slot::app.admin.layouts.quotas') }}</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <input type="hidden" name="id[]" v-model="input.id" />
                            <td>
                                <div class="control-group">
                                    <select class="control" name="delivery_day[]">
                                        @php
                                            $adminDefinedDays =  core()->getConfigData('marketplace.settings.mpDeliveryTimeSlot.allowed_days');

                                        @endphp

                                        @php($lang = Lang::get('delivery-time-slot::app.admin.layouts.days'))
                                            @foreach($lang as $languageFile)
                                                <option
                                                v-if="input.delivery_day == '{{ strtolower($languageFile) }}'" selected value="{{strtolower($languageFile) }}">
                                                    {{ $languageFile }}
                                                </option>

                                                <option value="{{strtolower($languageFile) }}" v-if="input.delivery_day != '{{ strtolower($languageFile) }}'">
                                                    {{ $languageFile }}
                                                </option>
                                            @endforeach
                                    </select>
                                </div>
                            </td>

                            <td>
                                <time-picker>
                                    <div class="control-group" :class="[inputs[index].start_time_execption ? 'has-error' : '']">
                                        <input type="text" name="start_time[]" class="control" v-model="input.start_time" v-bind:value="input.start_time" @change="validateStartTime(input.end_time, $event, index)" v-validate="validate[inputs[index].start_time_execption] || is_required ? 'required' : ''"/>

                                        <span class="control-error" v-if="inputs[index].start_time_execption">Start Time should be less Than End Time</span>
                                    </div>
                                </time-picker>
                            </td>

                            <td>
                                <time-picker>
                                    <div class="control-group" :class="[inputs[index].end_time_execption ? 'has-error' : '']" >
                                        <input type="text" class="control"  name="end_time[]" v-model="input.end_time" @change="validateEndTime(input.start_time, $event, index)" v-validate="'required'"/>

                                        <span class="control-error" v-if="inputs[index].end_time_execption">End Time should be greater Than Start Time</span>

                                    </div>
                                </time-picker>
                            </td>

                            <td>
                                <div class="control-group" >
                                    <input type="text" value='InsertedValue.time_delivery_quota' class="control" name="time_delivery_quota[]" v-model="input.time_delivery_quota"/>
                                </div>
                            </td>
                            <td>
                                <a class="btn btn-lg btn-primary button-remove" @click="removeInput(index)">
                                    {{ __('delivery-time-slot::app.admin.layouts.btn.delete') }}
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
                </div>

                <a class="mt-10 btn btn-lg btn-primary button-add" @click="addInput">
                    {{ __('delivery-time-slot::app.admin.layouts.btn.add-time-slot') }}
                </a>
            </div>
        </form>
    </script>

    <script>
        Vue.component('option-wrapper', {

            template: '#options-template',

            inject: ['$validator'],

            data: function(data) {
                return {

                    data: @json($data),

                    validate: {
                        'is_required': false,
                    },

                    is_required: '',

                    inputs: [{
                        id: "",
                        delivery_day : "",
                        start_time : "",
                        end_time : "",
                        time_delivery_quota : "",
                        is_seller : 0,
                    }],
                }
            },

            mounted () {
                for (let i = 0; i < this.data.length; i++) {
                    this.inputs.push({
                        id: this.data[i].id,
                        delivery_day : this.data[i].delivery_day,
                        start_time : this.data[i].start_time,
                        end_time : this.data[i].end_time,
                        time_delivery_quota : this.data[i].time_delivery_quota,
                        is_seller: 0
                     });
                }

                if (this.inputs.length != 0) {
                    this.inputs.shift();
                }
            },

            methods: {

                addInput() {
                    this.inputs.push({
                        id: '',
                        delivery_day : '',
                        start_time: '',
                        end_time: '',
                        time_delivery_quota: '',
                        is_seller: 0,
                        is_required: false,
                        validate: {
                            'is_required': false,
                        },
                    });
                },

                removeInput(index) {
                    this.$delete(this.inputs, index);
                },

                validateEndTime(start_time, event, index, endTime, setEndTime) {

                    if (typeof setEndTime === 'undefined') {
                        var endTime = event.target.value;
                    }
                    var endTime = endTime;
                    var startTime = start_time;

                    var today = new Date();
                    var dd = String(today.getDate()).padStart(2, '0');
                    var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
                    var yyyy = today.getFullYear();

                    var today = mm + '/' + dd + '/' + yyyy;

                    var formattedStartTime = today + ' ' + startTime;
                    var formattedEndTime = today + ' ' + endTime;

                    if(new Date(Date.parse(formattedStartTime)) < new Date(Date.parse(formattedEndTime))){
                        this.inputs[index].end_time_execption = false;
                    } else {
                        this.inputs[index].end_time_execption = true;
                    }
                    this.error();

                    this.validateStartTime(endTime, event, index, startTime, setStartTime = true);

                },

                validateStartTime(end_time, event, index, startTime, setStartTime) {

                    if (typeof setStartTime === 'undefined') {
                        var startTime = event.target.value;
                    }

                    var startTime = startTime;
                    var endTime = end_time;

                    var today = new Date();
                    var dd = String(today.getDate()).padStart(2, '0');
                    var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
                    var yyyy = today.getFullYear();

                    var today = mm + '/' + dd + '/' + yyyy;

                    var formattedStartTime = today + ' ' + startTime;
                    var formattedEndTime = today + ' ' + endTime;

                    if(new Date(Date.parse(formattedStartTime)) < new Date(Date.parse(formattedEndTime))){
                        this.inputs[index].start_time_execption = false;
                     }else{
                        this.inputs[index].start_time_execption = true;
                     }

                     this.error();

                     this.validateEndTime(startTime, event, index, endTime, setEndTime = true);

                },

                error: function() {
                    console.log = console.warn = console.error = () => {};
                },

                onSubmit: function (e) {
                    this.$validator.validateAll().then(result => {
                        for (var i = 0; i < this.inputs.length; i++) {

                            var startTime = this.inputs[i].start_time_execption;
                            var endTime = this.inputs[i].end_time_execption;
                            if (startTime === true || endTime === true) {
                                return e.preventDefault();
                            }
                        }
                        e.target.submit();
                    });
                },
             },
         });
    </script>
@endpush
