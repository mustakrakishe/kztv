<x-table id="device-table">
    <x-slot name="head">
        <div class="cell col-1">{{ __('Inv. №') }}</div>
        <div class="cell col-2">{{ __('Type') }}</div>
        <div class="cell col-2">{{ __('Model') }}</div>
        <div class="cell col-3">{{ __('Location') }}</div>
        <div class="cell col-3">{{ __('Comment') }}</div>
    </x-slot>

    <x-slot name="body">
        @foreach($devices as $device)
            <x-views.devices.device-table.rows.log :device="$device"/>
        @endforeach
    </x-slot>
</x-table>

{!! $devices->links() !!}