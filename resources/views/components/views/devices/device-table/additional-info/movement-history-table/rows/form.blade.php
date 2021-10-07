@php
    if(isset($log)){
        $rowClass = 'edit-form';
        $onSubmit = 'update_movement_log(event)';
        $onReset = 'cancel_update_movement_log(event)';
        $time = strtotime($log->date);
    }
    else{
        $rowClass = 'new-form';
        $onSubmit = 'add_new_movement_log(event)';
        $onReset = 'cancel_create(event)';
        $time = time();
    }

    $date = date('Y-m-d', $time) . 'T' . date('H:i:s', $time);
@endphp

<x-views.devices.device-table.additional-info.movement-history-table.rows.layout class="{{ $rowClass }}" :onSubmit="$onSubmit" :onReset="$onReset">
    <input type="text" name="device_id" hidden value="{{ $device_id }}">

    <x-slot name="id"><input type="text" name="id" value="@isset($log){{ $log->id }}@endisset"></x-slot>
    <x-slot name="date"><input type="datetime-local" name="date" class="form-control" placeholder="{{ __('Date') }}" value="{{ $date }}"></x-slot>
    <x-slot name="location"><input type="text" name="location" class="form-control" placeholder="{{ __('Location') }}" value="@isset($log){{ $log->location }}@endisset" required></x-slot>
    <x-slot name="comment"><input type="text" name="comment" class="form-control" placeholder="{{ __('Comment') }}" value="@isset($log){{ $log->comment }}@endisset"></x-slot>

    <x-slot name="control">
        <x-button type="submit">
            <i class="fas fa-check"></i>
        </x-button>
        
        <x-button class="ml-2" type="reset">
            <i class="fas fa-ban"></i>
        </x-button>
    </x-slot>
</x-views.devices.device-table.additional-info.movement-history-table.rows.layout>