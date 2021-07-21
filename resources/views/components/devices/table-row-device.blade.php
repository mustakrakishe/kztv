<x-devices.table-row-empty display="{{ $display }}">
    <x-slot name="codes">
        {{ $device->inventory_code }}
        
        @isset($device->identification_code)
            @isset($device->inventory_code)<br>@endisset
            ({{ $device->identification_code }})
        @endisset
    </x-slot>

    <x-slot name="type">{{ $device->type }}</x-slot>
    <x-slot name="model">{{ $device->model }}</x-slot>
    <x-slot name="properties">{{ $device->properties }}</x-slot>
    <x-slot name="location">{{ $device->location }}</x-slot>

    <x-slot name="ctrl_btns">
        <div class="row device-ctrl-group read-mode">
            <div class="col-6">
                <button name="device_id" id="edit_device_{{ $device->id }}" class="edit_device" value="{{ $device->id }}" hidden></button>
                <label class="btn btn-link m-0 p-0" for="edit_device_{{ $device->id }}"><i class="fas fa-pen"></i></label>
            </div>
            <div class="col-6">
                <button name="device_id" id="del_device_{{ $device->id }}" class="del_device" value="{{ $device->id }}" hidden></button>
                <label class="btn btn-link m-0 p-0" for="del_device_{{ $device->id }}"><i class="fas fa-trash-alt p-0"></i></label>
            </div>
        </div>

        <div class="row device-ctrl-group edit-mode" hidden>
            <div class="col-6">
                <button name="device_id" id="upd_device_{{ $device->id }}" class="upd_device" value="{{ $device->id }}" hidden></button>
                <label class="btn btn-link m-0 p-0" for="upd_device_{{ $device->id }}"><i class="fas fa-check"></i></label>
            </div>
            <div class="col-6">
                <button name="device_id" id="cancel_upd_device_{{ $device->id }}" class="cancel_upd_device" value="{{ $device->id }}" hidden></button>
                <label class="btn btn-link m-0 p-0" for="cancel_upd_device_{{ $device->id }}"><i class="fas fa-ban"></i></label>
            </div>
        </div>
    </x-slot>

</x-devices.table-row-empty>