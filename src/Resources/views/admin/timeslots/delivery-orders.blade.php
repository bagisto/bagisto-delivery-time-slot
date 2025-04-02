<x-admin::layouts>
   <!--Page Title -->
    <x-slot:title>
        @lang('delivery_time_slot::app.admin.delivery-time-slot.delivery-orders')
    </x-slot>
    
    <!--Main body-->
    <div class="flex gap-3.5 justify-between items-center max-sm:flex-wrap">
        <p class="py-4 text-[20px] text-gray-800 dark:text-white font-bold">
            @lang('delivery_time_slot::app.admin.delivery-time-slot.delivery-orders')
        </p>
    </div>

    <x-admin::datagrid src="{{ route('admin.timeslot.delivery.orders') }}" :isMultiRow="true"></x-admin::datagrid>
</x-admin::layouts>