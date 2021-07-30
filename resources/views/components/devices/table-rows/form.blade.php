<x-devices.table-rows.template>
    @csrf
    <x-slot name="id"><input name="id" type="text" class="form-control"></x-slot>
    <x-slot name="inventory_code"><input name="inventory_code" type="text" class="form-control"></x-slot>
    <x-slot name="identification_code"><input name="identification_code" type="text" class="form-control"></x-slot>
    <x-slot name="type"><input name="type" type="text" class="form-control" required></x-slot>
    <x-slot name="model"><input name="model" type="text" class="form-control"></x-slot>
    <x-slot name="properties"><input name="properties" type="text" class="form-control"></x-slot>
    <x-slot name="location"><input name="location" type="text" class="form-control" required></x-slot>

    <x-slot name="ctrl_btns">
        <x-devices.btn-groups.confirmation></x-devices.btn-groups.confirmation>
    </x-slot>
</x-devices.table-rows.template>