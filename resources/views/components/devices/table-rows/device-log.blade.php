<x-devices.table-rows.template>
    <x-slot name="row_class">device-log</x-slot>

    <x-slot name="id">{{ $device->id }}</x-slot>
    <x-slot name="inventory_code">{{ $device->inventory_code }}</x-slot>
    <x-slot name="identification_code">{{ $device->identification_code }}</x-slot>
    <x-slot name="type">{{ $device->type }}</x-slot>
    <x-slot name="model">{{ $device->model }}</x-slot>
    <x-slot name="properties">{{ $device->properties }}</x-slot>
    <x-slot name="location">{{ $device->location }}</x-slot>

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