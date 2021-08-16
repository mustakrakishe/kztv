<x-views.devices.device-table.rows.layout class="log" onmouseover="show_device_log_control(event)" onmouseleave="hide_device_log_control(event)">
    <x-slot name="id"><div class="info" name="id">{{ $device->id }}</div></x-slot>
    <x-slot name="inventory_code"><div class="info" name="inventory_code">{{ $device->inventory_code }}</div></x-slot>
    <x-slot name="identification_code">
        @isset($device->identification_code)
            <div class="info" name="identification_code">{{ $device->identification_code }}</div>
        @endisset
    </x-slot>
    <x-slot name="type"><div class="info" name="type">{{ $device->type }}</div></x-slot>
    <x-slot name="model"><div class="info" name="model">{{ $device->model }}</div></x-slot>
    <x-slot name="properties"><div class="info" name="properties">{{ $device->properties }}</div></x-slot>
    <x-slot name="location"><div class="info" name="location">{{ $device->location }}</div></x-slot>

    <x-slot name="control">
        <x-views.devices.device-table.btn-groups.log hidden/>
    </x-slot>
</x-views.devices.device-table.rows.layout>