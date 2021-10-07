@php
    if(isset($device)){
        $rowClass = 'edit-device-form';
        $onSubmit = 'update_device(event)';
        $onReset = 'cancel_update_device(event)';
        $status_id = $device->status_id;
    }
    else{
        $rowClass = 'new-device-form';
        $onSubmit = 'add_new_device(event)';
        $onReset = 'cancel_create(event)';
        $status_id = 1;
    }

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

    <x-slot name="status_id">
        <input type="text" name="status_id" class="form-control" value="{{ $status_id }}">
    </x-slot>

    <x-slot name="inventory_code">
        <input type="text" name="inventory_code" class="form-control" placeholder="{{ __('Inv. №') }}" value="@isset($device){{ $device->inventory_code }}@endisset">
    </x-slot>

    <x-slot name="identification_code">
        <input type="text" name="identification_code" class="form-control" placeholder="{{ __('Ident. №') }}" value="@isset($device){{ $device->identification_code }}@endisset">
    </x-slot>

    <x-slot name="type">
        <select name="type" class="form-control" onchange="check_type(event);" required>
            @empty($device)
                <option class="placeholder" value="" disabled selected>{{ __('Type') }}</option>
            @endempty

            @foreach ($types as $type)
                <!-- Value is represented with the type name instead of it's id becouse somebody can change it's name while another user will be selecting this type. -->
                <option value="{{ $type->name }}" @php echo checkSelected($device, $type); @endphp>{{ $type->name }}</option>
            @endforeach

            <option value="new">{{ __('New') }}</option>
        </select>
    </x-slot>

    <x-slot name="model">
        <input type="text" name="model" class="form-control" placeholder="{{ __('Model') }}" value="@isset($device){{ $device->model }}@endisset"">
    </x-slot>

    <x-slot name="location">
        <input type="text" name="location" class="form-control" placeholder="{{ __('Location') }}" value="@isset($device){{ $device->location }}@endisset"" required>
    </x-slot>

    <x-slot name="comment">
        <input type="text" name="comment" class="form-control" placeholder="{{ __('Comment') }}" value="@isset($device){{ $device->comment }}@endisset"">
    </x-slot>

    <x-slot name="control">
        <x-button type="submit">
            <i class="fas fa-check"></i>
        </x-button>
        
        <x-button class="ml-2" type="reset">
            <i class="fas fa-ban"></i>
        </x-button>
    </x-slot>
</x-views.devices.device-table.rows.layout>