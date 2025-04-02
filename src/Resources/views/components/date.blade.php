<v-date-picker {{ $attributes }}>
    {{ $slot }}
</v-date-picker>

@pushOnce('scripts')
    <script type="text/x-template" id="v-date-picker-template">
        <span class="relative flex w-[160px] flex-row">
            <slot></slot>

            <i
                class="icon-calendar absolute top-[5px] text-[24px] text-gray-400"
                :style="'right:5px;'"
            ></i>
        </span>
    </script>

    <script type="module">
        app.component('v-date-picker', {
            template: '#v-date-picker-template',

            props: {
                name: String,

                value: String,

                allowInput: {
                    type: Boolean,
                    default: true,
                },

                disable: Array,

                minDate: String,

                maxDate: String,
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

                    let today = new Date();

                    return {
                        allowInput: this.allowInput ?? true,
                        disable: this.disable ?? [],
                        minDate: today.toISOString().split("T")[0],
                        maxDate: this.maxDate ?? '',
                        altFormat: "Y-m-d",
                        dateFormat: "Y-m-d",
                        weekNumbers: true,

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
