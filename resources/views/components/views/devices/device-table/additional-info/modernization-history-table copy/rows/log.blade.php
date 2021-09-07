<x-views.devices.device-table.additional-info.movement-history-table.rows.layout>
    <x-slot name="id">{{ $log->id }}</x-slot>
    <x-slot name="date">{{ $log->date }}</x-slot>
    <x-slot name="characteristics">{{ $log->characteristics }}</x-slot>
    <x-slot name="comment">{{ $log->comment }}</x-slot>

    <x-slot name="control">
        <x-button value="{{ $log->id }}" onclick="create_modernization(this)">
            <i class="fas fa-pen"></i>
        </x-button>
        
        <x-button value="{{ $log->id }}" onclick="delete_modernization(this)">
            <i class="fas fa-trash-alt"></i>
        </x-button>
    </x-slot>
</x-views.devices.device-table.additional-info.movement-history-table.rows.layout>