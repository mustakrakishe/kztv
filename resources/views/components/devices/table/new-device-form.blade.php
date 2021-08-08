<x-devices.table.row class="new-device-form">
    @csrf

    <x-slot name="id"></x-slot>
    <x-slot name="inventory_code"><input type="text" name="inventory_code" class="form-control"></x-slot>
    <x-slot name="identification_code"><input type="text" name="identification_code" class="form-control"></x-slot>
    <x-slot name="type"><input type="text" name="type" class="form-control"></x-slot>
    <x-slot name="model"><input type="text" name="model" class="form-control"></x-slot>
    <x-slot name="properties"><input type="text" name="properties" class="form-control"></x-slot>
    <x-slot name="location"><input type="text" name="location" class="form-control"></x-slot>

    <x-slot name="control">
        <x-devices.btn-groups.new-device-form></x-devices.btn-groups.new-device-form>
    </x-slot>
</x-devices.table.row>