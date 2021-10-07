<x-views.devices.device-table.rows.layout class="log" onmouseover="show_device_log_control(event)" onmouseleave="hide_device_log_control(event)">

    <x-slot name="id"><div class="info" name="id">{{ $device->id }}</div></x-slot>
    <x-slot name="status_id"><div class="info" name="status_id">{{ $device->status_id }}</div></x-slot>
    <x-slot name="inventory_code"><div class="info" name="inventory_code">{{ $device->inventory_code }}</div></x-slot>
    <x-slot name="identification_code">
        @isset($device->identification_code)
            <div class="info" name="identification_code">{{ $device->identification_code }}</div>
        @endisset
    </x-slot>
    <x-slot name="type"><div class="info" name="type">{{ $device->type }}</div></x-slot>
    <x-slot name="model"><div class="info" name="model">{{ $device->model }}</div></x-slot>
    <x-slot name="location"><div class="info" name="location">{{ $device->location }}</div></x-slot>
    <x-slot name="comment"><div class="info" name="comment">{{ $device->comment }}</div></x-slot>

    <x-slot name="control">
        <div hidden>
            <x-button title="{{ __('buttons.More') }}" value="{{ $device->id }}" onclick="show_device_more_info(this)">
                <i class="far fa-window-maximize"></i>
            </x-button>

            <x-button class="ml-2" title="{{ __('buttons.Edit') }}" value="{{ $device->id }}" onclick="show_device_edit_form(this)">
                <i class="fas fa-pen"></i>
            </x-button>
                
            <x-button class="ml-2" title="{{ __('buttons.Delete') }}" value="{{ $device->id }}" onclick="delete_device(this)">
                <i class="fas fa-trash-alt"></i>
            </x-button>
        </div>
    </x-slot>
</x-views.devices.device-table.rows.layout>