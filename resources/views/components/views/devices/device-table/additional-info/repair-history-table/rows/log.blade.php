@php
    $link_parameters = [
        'repairId' => $repairAccount->id,
        'deviceId' => $repairAccount->device_id
    ];
@endphp

<x-views.devices.device-table.additional-info.repair-history-table.rows.layout>
    <x-slot name="id">{{ $repairAccount->id }}</x-slot>
    <x-slot name="date">{{ $repairAccount->date }}</x-slot>
    <x-slot name="cause">{{ $repairAccount->cause }}</x-slot>
    <x-slot name="result">{{ $repairAccount->result }}</x-slot>
    <x-slot name="characteristics">{{ $repairAccount->characteristics }}</x-slot>

    <x-slot name="control">
        <x-button
            value="{{ $repairAccount->id }}"
            link="{{ route('repair.edit', $link_parameters) }}"
            onclick="repair_edit(this)"
        >
            <i class="fas fa-pen"></i>
        </x-button>
        
        <x-button
            class="ml-2"
            value="{{ $repairAccount->id }}"
            token="{{ csrf_token() }}"
            link="{{ route('repair.delete', $link_parameters) }}"
            onclick="repair_delete(this)"
        >
            <i class="fas fa-trash-alt"></i>
        </x-button>
    </x-slot>
</x-views.devices.device-table.additional-info.repair-history-table.rows.layout>