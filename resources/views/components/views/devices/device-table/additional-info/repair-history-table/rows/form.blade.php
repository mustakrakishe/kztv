@php
    if(isset($repairAccount)){
        $rowClass = 'edit-form';
        $repairId = $repairAccount->id;
        $url_data = compact('deviceId', 'repairId');

        $action = route('repair.update', $url_data);
        $cancel = route('repair.show', $url_data);

        $onSubmit = 'repair_update(event)';
        $onReset = 'repair_cancel_edit(event)';

        $time = strtotime($repairAccount->date);
    }
    else{
        $rowClass = 'new-form';

        $onSubmit = 'repair_store(event)';
        $onReset = 'cancel_create(event)';
        
        $action = route('repair.store', compact('deviceId'));
        $cancel = '';

        $time = time();
    }

    $date = date('Y-m-d', $time) . 'T' . date('H:i:s', $time);
@endphp

<x-views.devices.device-table.additional-info.repair-history-table.rows.layout class="{{ $rowClass }}" :action="$action" :cancel="$cancel" :onSubmit="$onSubmit" :onReset="$onReset">
    
    <input type="text" name="device_id" value="{{ $deviceId }}" hidden>

    <x-slot name="id">
        <input type="text" name="id" class="form-control" value="@isset($repairAccount){{ $repairAccount->id }}@endisset">
    </x-slot>

    <x-slot name="date">
        <input type="datetime-local" name="date" class="form-control" placeholder="{{ __('Date') }}" value="{{ $date }}" required>
    </x-slot>

    <x-slot name="cause">
        <input type="text" name="cause" class="form-control" placeholder="{{ __('Cause') }}" value="@isset($repairAccount){{ $repairAccount->cause }}@endisset" required>
    </x-slot>

    <x-slot name="result">
        <input type="text" name="result" class="form-control" placeholder="{{ __('Result') }}" value="@isset($repairAccount){{ $repairAccount->result }}@endisset">
    </x-slot>

    <x-slot name="characteristics">
        <input type="text" name="characteristics" class="form-control" placeholder="{{ __('Characteristics') }}" value="@isset($repairAccount){{ $repairAccount->characteristics }}@endisset">
    </x-slot>

    <x-slot name="control">
        <x-button type="submit">
            <i class="fas fa-check"></i>
        </x-button>
        
        <x-button type="reset" class="ml-2">
            <i class="fas fa-ban"></i>
        </x-button>
    </x-slot>
</x-views.devices.device-table.additional-info.repair-history-table.rows.layout>