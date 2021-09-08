@php
    if(isset($modernization)){
        $rowClass = 'edit-form';
        $onSubmit = 'modernization_update(event)';
        $onReset = 'modernization_cancel_edit(event)';
        $time = strtotime($modernization->date);
    }
    else{
        $rowClass = 'new-form';
        $onSubmit = 'modernization_store(event)';
        $onReset = 'cancel_create(event)';
        $time = time();
        $url = route('modernization.store', compact('deviceId'));
    }

    $date = date('Y-m-d', $time) . 'T' . date('H:i:s', $time);
@endphp

<x-views.devices.device-table.additional-info.modernization-history-table.rows.layout class="{{ $rowClass }}" :action="$url" :onSubmit="$onSubmit" :onReset="$onReset">
    
    <input type="text" name="device_id" value="{{ $deviceId }}" hidden>
    <x-slot name="id"><input type="text" name="id" class="form-control" value="@isset($modernization){{ $modernization->id }}@endisset"></x-slot>
    <x-slot name="date"><input type="datetime-local" name="date" class="form-control" placeholder="{{ __('Date') }}" value="{{ $date }}" required></x-slot>
    <x-slot name="characteristics"><input type="text" name="characteristics" class="form-control" placeholder="{{ __('Characteristics') }}" value="@isset($modernization){{ $condition->characteristics }}@endisset" required></x-slot>
    <x-slot name="comment"><input type="text" name="comment" class="form-control" placeholder="{{ __('Comment') }}" value="@isset($modernization){{ $modernization->comment }}@endisset"></x-slot>

    <x-slot name="control">
        <x-button type="submit">
            <i class="fas fa-check"></i>
        </x-button>
        
        <x-button type="reset">
            <i class="fas fa-ban"></i>
        </x-button>
    </x-slot>
</x-views.devices.device-table.additional-info.modernization-history-table.rows.layout>