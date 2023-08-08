@extends('admin::layouts.content')

@section('page_title')
    {{ __('delivery-time-slot::app.admin.layouts.delivery-orders') }}
@stop

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h1>{{ __('delivery-time-slot::app.admin.layouts.delivery-orders') }}</h1>
            </div>
        </div>

        <div class="page-content">
            <datagrid-plus 
                src="{{ route('admin.timeslot.delivery.orders') }}"
            >
            </datagrid-plus>
        </div>
    </div>
@endsection