<x-devices.table-row-empty>
    @csrf
    <x-slot name="codes">
        <input name="inventory_code" type="text" class="form-control">
        <input name="identification_code" type="text" class="form-control">
    </x-slot>

    <x-slot name="type"><input name="type" type="text" class="form-control" required></x-slot>
    <x-slot name="model"><input name="model" type="text" class="form-control"></x-slot>
    <x-slot name="properties"><input name="properties" type="text" class="form-control"></x-slot>
    <x-slot name="location"><input name="location" type="text" class="form-control" required></x-slot>

    <x-slot name="ctrl_btns">
        <div class="row device-ctrl-group edit-mode">
            <div class="col-6">
                <label class="btn btn-link m-0 p-0">
                    <button class="add_device" hidden></button>
                    <i class="fas fa-check"></i>
                </label>
            </div>
            <div class="col-6">
                <label class="btn btn-link m-0 p-0">
                    <button class="cancel_add_device" hidden></button>
                    <i class="fas fa-ban"></i>
                </label>
            </div>
        </div>
    </x-slot>
</x-devices.table-row-empty>