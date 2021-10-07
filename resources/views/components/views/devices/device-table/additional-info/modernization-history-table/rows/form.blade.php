@php
    if(isset($modernizationAccount)){
        $rowClass = 'edit-form';
        $modernizationId = $modernizationAccount->id;
        $url_data = compact('deviceId', 'modernizationId');

        $action = route('modernization.update', $url_data);
        $cancel = route('modernization.show', $url_data);

        $onSubmit = 'modernization_update(event)';
        $onReset = 'modernization_cancel_edit(event)';

        $time = strtotime($modernizationAccount->date);
    }
    else{
        $rowClass = 'new-form';

        $onSubmit = 'modernization_store(event)';
        $onReset = 'cancel_create(event)';
        
        $action = route('modernization.store', compact('deviceId'));
        $cancel = '';

        $time = time();
    }

    $date = date('Y-m-d', $time) . 'T' . date('H:i:s', $time);
@endphp

<x-views.devices.device-table.additional-info.modernization-history-table.rows.layout class="{{ $rowClass }}" :action="$action" :cancel="$cancel" :onSubmit="$onSubmit" :onReset="$onReset">
    
    <input type="text" name="device_id" value="{{ $deviceId }}" hidden>
    <x-slot name="id"><input type="text" name="id" class="form-control" value="@isset($modernizationAccount){{ $modernizationAccount->id }}@endisset"></x-slot>
    <x-slot name="date"><input type="datetime-local" name="date" class="form-control" placeholder="{{ __('Date') }}" value="{{ $date }}" required></x-slot>
    <x-slot name="characteristics"><input type="text" name="characteristics" class="form-control" placeholder="{{ __('Characteristics') }}" value="@isset($modernizationAccount){{ $modernizationAccount->characteristics }}@endisset" required></x-slot>
    <x-slot name="comment"><input type="text" name="comment" class="form-control" placeholder="{{ __('Comment') }}" value="@isset($modernizationAccount){{ $modernizationAccount->comment }}@endisset"></x-slot>

    <x-slot name="control">
        <x-button type="submit">
            <i class="fas fa-check"></i>
        </x-button>
        
        <x-button type="reset" class="ml-2">
            <i class="fas fa-ban"></i>
        </x-button>
    </x-slot>
</x-views.devices.device-table.additional-info.modernization-history-table.rows.layout>