<x-devices.table-rows.template>
    <x-slot name="row_class">device-log</x-slot>

    <x-slot name="id">@isset($device){{ $device->id }}@endisset</x-slot>
    <x-slot name="inventory_code">@isset($device){{ $device->inventory_code }}@endisset</x-slot>
    <x-slot name="identification_code">@isset($device){{ $device->identification_code }}@endisset</x-slot>
    <x-slot name="type">@isset($device){{ $device->type }}@endisset</x-slot>
    <x-slot name="model">@isset($device){{ $device->model }}@endisset</x-slot>
    <x-slot name="properties">@isset($device){{ $device->properties }}@endisset</x-slot>
    <x-slot name="location">@isset($device){{ $device->location }}@endisset</x-slot>

    <x-slot name="ctrl_btns">
        <div class="row">
            <div class="col-6">
                <label class="btn btn-link m-0 p-0">
                    <button class="edit" onclick="show_device_edit_form(event)" hidden></button>
                    <i class="fas fa-pen"></i>
                </label>
            </div>
            <div class="col-6">
                <label class="btn btn-link m-0 p-0">
                    <button class="delete" onclick="delete_device(event)" hidden></button>
                    <i class="fas fa-trash-alt"></i>
                </label>
            </div>
        </div>
    </x-slot>
</x-devices.table-rows.template>