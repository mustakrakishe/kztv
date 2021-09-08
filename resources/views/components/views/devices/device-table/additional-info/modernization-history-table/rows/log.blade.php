<x-views.devices.device-table.additional-info.modernization-history-table.rows.layout>
    <x-slot name="id">{{ $modernizationAccount->id }}</x-slot>
    <x-slot name="date">{{ $modernizationAccount->date }}</x-slot>
    <x-slot name="characteristics">{{ $modernizationAccount->characteristics }}</x-slot>
    <x-slot name="comment">{{ $modernizationAccount->comment }}</x-slot>

    <x-slot name="control">
        <x-button value="{{ $modernizationAccount->id }}" onclick="modernization_create(this)">
            <i class="fas fa-pen"></i>
        </x-button>
        
        <x-button value="{{ $modernizationAccount->id }}" token="{{ csrf_token() }}" link="{{ route('modernization.delete', [
            'modernizationId' => $modernizationAccount->id,
            'deviceId' => $modernizationAccount->device_id]) }}" onclick="modernization_delete(this)">
            <i class="fas fa-trash-alt"></i>
        </x-button>
    </x-slot>
</x-views.devices.device-table.additional-info.modernization-history-table.rows.layout>