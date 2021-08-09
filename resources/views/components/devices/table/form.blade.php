@php
    $rowClass = isset($device) ? 'edit-device-form' : 'new-device-form';
    $btnGroupComponentName = 'devices.btn-groups.' . $rowClass;
    function checkSelected($device, $type){
        if(isset($device) && $type->name == $device->type){
            return 'selected';
        }
    }
@endphp
<x-devices.table.row class="{{ $rowClass }}">
    @csrf

    <x-slot name="id"><input type="text" name="id" class="form-control" value="@isset($device){{ $device->id }}@endisset"></x-slot>
    <x-slot name="inventory_code"><input type="text" name="inventory_code" class="form-control" placeholder="Інв. №" value="@isset($device){{ $device->inventory_code }}@endisset"></x-slot>
    <x-slot name="identification_code"><input type="text" name="identification_code" class="form-control" placeholder="Ідент. №" value="@isset($device){{ $device->identification_code }}@endisset"></x-slot>
    <x-slot name="type">
        <select name="type" class="form-control" onchange="check_type(event)">
            @empty($device)
                <option class="placeholder" disabled selected>Тип</option>
            @endempty

            @foreach ($types as $type)
                <option value="{{ $type->id }}" @php echo checkSelected($device, $type); @endphp>{{ $type->name }}</option>
            @endforeach

            <option value="new">Новий</option>
        </select>
    </x-slot>
    <x-slot name="model"><input type="text" name="model" class="form-control" placeholder="Модель" value="@isset($device){{ $device->model }}@endisset"></x-slot>
    <x-slot name="properties"><input type="text" name="properties" class="form-control" placeholder="Характеристики" value="@isset($device){{ $device->properties }}@endisset"></x-slot>
    <x-slot name="location"><input type="text" name="location" class="form-control" placeholder="Розташування" value="@isset($device){{ $device->location }}@endisset"></x-slot>

    <x-slot name="control">
        <x-dynamic-component :component="$btnGroupComponentName"/>
    </x-slot>
</x-devices.table.row>