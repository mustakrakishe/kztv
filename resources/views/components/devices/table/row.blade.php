@props(['device'])

<div {{ $attributes->merge(['class' => 'table-row row']) }}>
    <div class="cell info id" hidden>{{ $device->id }}</div>

    <div class="cell info codes col-1">
        <div class="row m-0"><div class="info inventory_code">{{ $device->inventory_code }}</div></div>
        <div class="row m-0"><div class="info identification_code">@isset($device->identification_code)({{ $device->identification_code }})@endisset</div></div>
    </div>

    <div class="cell info type col-1">{{ $device->type }}</div>
    <div class="cell info model col-2">{{ $device->model }}</div>
    <div class="cell info properties col-4">{{ $device->properties }}</div>
    <div class="cell info location col-3">{{ $device->location }}</div>

    <div class="cell control col-1">
        <x-devices.btn-groups.device-log></x-devices.btn-groups.device-log>
    </div>
</div>