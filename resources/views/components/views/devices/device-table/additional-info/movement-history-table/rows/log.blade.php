<x-views.devices.device-table.additional-info.movement-history-table.rows.layout>
   
    <x-slot name="id">{{ $log->id }}</x-slot>
    <x-slot name="date">{{ $log->date }}</x-slot>
    <x-slot name="location">{{ $log->location }}</x-slot>
    <x-slot name="comment">{{ $log->comment }}</x-slot>

    <x-slot name="control">
        <x-button value="{{ $log->id }}" onclick="show_movement_log_edit_form(this)">
            <i class="fas fa-pen"></i>
        </x-button>
        
        <x-button class="ml-2" value="{{ $log->id }}" onclick="delete_movement_log(this)">
            <i class="fas fa-trash-alt"></i>
        </x-button>
    </x-slot>
</x-views.devices.device-table.additional-info.movement-history-table.rows.layout>