@php
    if(isset($device)){
        $rowClass = 'edit-device-form';
        $onSubmit = 'update_device(event)';
        $onReset = 'cancel_update_device(event)';
    }
    else{
        $rowClass = 'new-device-form';
        $onSubmit = 'add_new_device(event)';
        $onReset = 'cancel_add_new_device(event)';
    }

    $btnGroupComponentName = 'views.devices.device-table.btn-groups.' . $rowClass;

    function checkSelected($device, $type){
        if(isset($device) && $type->name == $device->type){
            return 'selected';
        }
    }
@endphp

<x-views.devices.device-table.rows.layout class="{{ $rowClass }}" :onSubmit="$onSubmit" :onReset="$onReset">

    <x-slot name="id">
        <input type="text" name="id" class="form-control" value="@isset($device){{ $device->id }}@endisset">
    </x-slot>

    <x-slot name="inventory_code">
        <input type="text" name="inventory_code" class="form-control" placeholder="{{ __('Inv. №') }}" value="@isset($device){{ $device->inventory_code }}@endisset" onchange="validate_device_form(event)">
    </x-slot>

    <x-slot name="identification_code">
        <input type="text" name="identification_code" class="form-control" placeholder="{{ __('Ident. №') }}" value="@isset($device){{ $device->identification_code }}@endisset" onchange="validate_device_form(event)">
    </x-slot>

    <x-slot name="type">
        <select name="type" class="form-control" onchange="check_type(event)">
            @empty($device)
                <option class="placeholder" disabled selected>{{ __('Type') }}</option>
            @endempty

            @foreach ($types as $type)
                <!-- Value is represented with the type name instead of it's id becouse somebody can change it's name while another user will be selecting this type. -->
                <option value="{{ $type->name }}" @php echo checkSelected($device, $type); @endphp>{{ $type->name }}</option>
            @endforeach

            <option value="new">{{ __('New') }}</option>
        </select>
    </x-slot>

    <x-slot name="model">
        <input type="text" name="model" class="form-control" placeholder="{{ __('Model') }}" value="@isset($device){{ $device->model }}@endisset" onchange="validate_device_form(event)">
    </x-slot>

    <x-slot name="properties">
        <input type="text" name="properties" class="form-control" placeholder="{{ __('Characteristics') }}" value="@isset($device){{ $device->properties }}@endisset" onchange="validate_device_form(event)">
    </x-slot>

    <x-slot name="location">
        <input type="text" name="location" class="form-control" placeholder="{{ __('Location') }}" value="@isset($device){{ $device->location }}@endisset" onchange="validate_device_form(event)">
    </x-slot>

    <x-slot name="control">
        <x-dynamic-component :component="$btnGroupComponentName"/>
    </x-slot>
</x-views.devices.device-table.rows.layout>