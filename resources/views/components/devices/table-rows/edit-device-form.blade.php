<x-devices.table-rows.template>
    <x-slot name="row_class">edit-device-form</x-slot>

    @csrf
    <x-slot name="id"><input name="id" type="text" class="form-control"></x-slot>
    <x-slot name="inventory_code"><input name="inventory_code" type="text" class="form-control"></x-slot>
    <x-slot name="identification_code"><input name="identification_code" type="text" class="form-control"></x-slot>
    <x-slot name="type"><input name="type" type="text" class="form-control" required></x-slot>
    <x-slot name="model"><input name="model" type="text" class="form-control"></x-slot>
    <x-slot name="properties"><input name="properties" type="text" class="form-control"></x-slot>
    <x-slot name="location"><input name="location" type="text" class="form-control" required></x-slot>

    <x-slot name="ctrl_btns">
        <div class="row">
            <div class="col-6">
                <label class="btn btn-link m-0 p-0">
                    <button class="ok" onclick="update_device(event)" hidden></button>
                    <i class="fas fa-check"></i>
                </label>
            </div>
            <div class="col-6">
                <label class="btn btn-link m-0 p-0">
                    <button class="cancel" onclick="cancel_update_device(event)" hidden></button>
                    <i class="fas fa-ban"></i>
                </label>
            </div>
        </div>
    </x-slot>
</x-devices.table-rows.template>