<x-devices.table-rows.templates.table-row>
    <x-slot name="row_class">{{ $row_class }}</x-slot>

    @csrf
    <x-slot name="id"><input name="id" type="text" class="form-control"></x-slot>
    <x-slot name="inventory_code"><input name="inventory_code" type="text" class="form-control" placeholder="Інв. №"></x-slot>
    <x-slot name="identification_code"><input name="identification_code" type="text" class="form-control" placeholder="Ідент. №"></x-slot>
    <x-slot name="type"><input name="type" type="text" class="form-control" placeholder="Тип" required></x-slot>
    <x-slot name="model"><input name="model" type="text" class="form-control" placeholder="Модель"></x-slot>
    <x-slot name="properties"><input name="properties" type="text" class="form-control" placeholder="Характеристики"></x-slot>
    <x-slot name="location"><input name="location" type="text" class="form-control" placeholder="Розташування" required></x-slot>

    <x-slot name="ctrl_btns">
        {{ $ctrl_btns }}
    </x-slot>
</x-devices.table-rows.templates.table-row>