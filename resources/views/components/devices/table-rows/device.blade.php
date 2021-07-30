<x-devices.table-rows.template>
    <x-slot name="row_class">log_row</x-slot>

    <x-slot name="id">{{ $device->id }}</x-slot>
    <x-slot name="inventory_code">{{ $device->inventory_code }}</x-slot>
    <x-slot name="identification_code">{{ $device->identification_code }}</x-slot>
    <x-slot name="type">{{ $device->type }}</x-slot>
    <x-slot name="model">{{ $device->model }}</x-slot>
    <x-slot name="properties">{{ $device->properties }}</x-slot>
    <x-slot name="location">{{ $device->location }}</x-slot>

    <x-slot name="ctrl_btns">
        <x-devices.btn-groups.actions></x-devices.btn-groups.actions>
    </x-slot>
</x-devices.table-rows.template>