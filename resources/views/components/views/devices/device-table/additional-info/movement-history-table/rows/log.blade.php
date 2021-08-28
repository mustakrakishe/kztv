<x-views.devices.device-table.additional-info.movement-history-table.rows.layout>
    <x-slot name="id">{{ $log->id }}</x-slot>
    <x-slot name="unit_id">{{ $log->unit_id }}</x-slot>
    <x-slot name="created_at">{{ $log->created_at }}</x-slot>
    <x-slot name="location">{{ $log->location }}</x-slot>
    <x-slot name="comment">{{ $log->comment }}</x-slot>

    <x-slot name="control">
        <x-button value="{{ $id }}" onclick="show_movement_log_edit_form(event)">
            <i class="fas fa-pen"></i>
        </x-button>
        
        <x-button value="{{ $id }}" onclick="delete_movement_log(event)">
            <i class="fas fa-trash-alt"></i>
        </x-button>
    </x-slot>
</x-views.devices.device-table.additional-info.movement-history-table.rows.layout>