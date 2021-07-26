<x-devices.table-row-empty>
    <x-slot name="codes">
        <input type="text" class="form-control">
        <input type="text" class="form-control">
    </x-slot>

    <x-slot name="type"><input type="text" class="form-control"></x-slot>
    <x-slot name="model"><input type="text" class="form-control"></x-slot>
    <x-slot name="properties"><input type="text" class="form-control"></x-slot>
    <x-slot name="location"><input type="text" class="form-control"></x-slot>

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