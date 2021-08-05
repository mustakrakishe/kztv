<x-devices.table-rows.templates.table-row>
    <x-slot name="row_class">device-log</x-slot>

    <x-slot name="id">@isset($device->id){{ $device->id }}@endisset</x-slot>
    <x-slot name="inventory_code">@isset($device->inventory_code){{ $device->inventory_code }}@endisset</x-slot>
    <x-slot name="identification_code">@isset($device->identification_code)({{ $device->identification_code }})@endisset</x-slot>
    <x-slot name="type">@isset($device->type){{ $device->type }}@endisset</x-slot>
    <x-slot name="model">@isset($device->model){{ $device->model }}@endisset</x-slot>
    <x-slot name="properties">@isset($device->properties){{ $device->properties }}@endisset</x-slot>
    <x-slot name="location">@isset($device->location){{ $device->location }}@endisset</x-slot>

    <x-slot name="ctrl_btns">
        <x-devices.btn-groups.device-log></x-devices.btn-groups.device-log>
    </x-slot>
</x-devices.table-rows.templates.table-row>