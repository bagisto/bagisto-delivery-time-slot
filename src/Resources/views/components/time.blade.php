    <v-time-picker {{ $attributes }}>
        {{ $slot }}
    </v-time-picker>

    @pushOnce('scripts')
        <script type="text/x-template" id="v-time-picker-template">
            <span class="relative flex w-[160px] flex-row">
                <slot></slot>

                <i 
                    class="icon1-clock absolute top-[5px] text-[24px] text-gray-400"
                    :style="'right:5px;'"
                ></i>
            </span>
        </script>

        <script type="module">
            app.component('v-time-picker', {
                template: '#v-time-picker-template',

                props: {
                    name: String,

                    value: String,

                    allowInput: {
                        type: Boolean,
                        default: true,
                    },

                    disable: Array,

                    minTime: String,

                    maxTime: String,
                },

                data: function() {
                    return {
                        datepicker: null
                    };
                },

                mounted: function() {
                    let options = this.setOptions();

                    this.activate(options);
                },

                methods: {
                    setOptions: function() {
                        let self = this;

                        return {
                            allowInput: this.allowInput ?? false,
                            disable: this.disable ?? [],
                            minTime: this.minTime ?? '',
                            maxTime: this.maxTime ?? '',
                            altFormat: "H:i",
                            dateFormat: "H:i",
                            enableTime: true,
                            noCalendar : true,
                            time_24hr: true,

                            onChange: function(selectedDates, dateStr, instance) {
                                self.$emit("onChange", dateStr);
                            }
                        };
                    },

                    activate: function(options) {
                        let element = this.$el.getElementsByTagName("input")[0];

                        this.datepicker = new Flatpickr(element, options);
                    },

                    clear: function() {
                        this.datepicker.clear();
                    }
                }
            });
        </script>
    @endPushOnce
