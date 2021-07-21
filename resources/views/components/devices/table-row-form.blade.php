<x-devices.table-row-empty id="{{ $id }}" class="{{ $class }}" display="{{ $display }}">
    <x-slot name="codes"><input type="text" class="form-control" style="margin-left: -12px;"><input type="text" class="form-control" style="margin-left: -12px;"></x-slot>

    <x-slot name="type"><input type="text" class="form-control" style="margin-left: -12px;"></x-slot>
    <x-slot name="model"><input type="text" class="form-control" style="margin-left: -12px;"></x-slot>
    <x-slot name="properties"><input type="text" class="form-control" style="margin-left: -12px;"></x-slot>
    <x-slot name="location"><input type="text" class="form-control" style="margin-left: -12px;"></x-slot>

    <x-slot name="ctrl_btns">
        <div class="row device-ctrl-group edit-mode">
            <div class="col-6">
                <button id="add_device" class="add_device" hidden></button>
                <label class="btn btn-link m-0 p-0" for="add_device"><i class="fas fa-check"></i></label>
            </div>
            <div class="col-6">
                <button id="cancel_add_device" class="cancel_add_device" hidden></button>
                <label class="btn btn-link m-0 p-0" for="cancel_add_device"><i class="fas fa-ban"></i></label>
            </div>
        </div>
    </x-slot>
</x-devices.table-row-empty>