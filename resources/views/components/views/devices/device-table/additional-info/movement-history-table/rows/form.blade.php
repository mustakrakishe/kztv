@php
    if(isset($log)){
        $rowClass = 'edit-form';
        $onSubmit = 'update_movement_log(event)';
        $onReset = 'cancel_update_movement_log(event)';
        $time = strtotime($log->created_at);
    }
    else{
        $rowClass = 'new-form';
        $onSubmit = 'add_new_movement_log(event)';
        $onReset = 'cancel_add_new_entry(event)';
        $time = time();
    }

    $created_at = date('Y-m-d', $time) . 'T' . date('H:i:s', $time);
@endphp

<x-views.devices.device-table.additional-info.movement-history-table.rows.layout class="{{ $rowClass }}" :onSubmit="$onSubmit" :onReset="$onReset">
    
    <x-slot name="id"><input type="text" name="id" class="form-control" value="@isset($log){{ $log->id }}@endisset"></x-slot>
    <x-slot name="unit_id"><input type="text" name="unit_id" class="form-control" value="{{ $unit_id }}"></x-slot>
    <x-slot name="created_at"><input type="datetime-local" name="created_at" class="form-control" placeholder="{{ __('Date') }}" value="{{ $created_at }}"></x-slot>
    <x-slot name="location"><input type="text" name="location" class="form-control" placeholder="{{ __('Location') }}" value="@isset($log){{ $log->location }}@endisset" required></x-slot>
    <x-slot name="comment"><input type="text" name="comment" class="form-control" placeholder="{{ __('Comment') }}" value="@isset($log){{ $log->comment }}@endisset"></x-slot>

    <x-slot name="control">
        <x-button type="submit">
            <i class="fas fa-check"></i>
        </x-button>
        
        <x-button type="reset">
            <i class="fas fa-ban"></i>
        </x-button>
    </x-slot>
</x-views.devices.device-table.additional-info.movement-history-table.rows.layout>