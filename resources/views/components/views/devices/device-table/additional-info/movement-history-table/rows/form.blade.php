@php
    $rowClass = isset($log) ? 'edit-form' : 'new-form';
    $btnGroupComponentName = 'views.devices.device-table.additional-info.movement-history-table.btn-groups.' . $rowClass;
    $time = isset($log) ? strtotime($log->created_at) : time();
    $created_at = date('Y-m-d', $time) . 'T' . date('H:i', $time);
@endphp
<x-views.devices.device-table.additional-info.movement-history-table.rows.layout class="{{ $rowClass }}">
    @csrf
    <x-slot name="id"><input type="text" name="id" class="form-control" value="@isset($log){{ $log->id }}@endisset"></x-slot>
    <x-slot name="unit_id"><input type="text" name="unit_id" class="form-control" value="{{ $unit_id }}"></x-slot>
    <x-slot name="created_at"><input type="datetime-local" name="created_at" class="form-control" placeholder="{{ __('Date') }}" value="{{ $created_at }}"></x-slot>
    <x-slot name="location"><input type="text" name="location" class="form-control" placeholder="{{ __('Location') }}" value="@isset($log){{ $log->location }}@endisset"></x-slot>
    <x-slot name="comment"><input type="text" name="comment" class="form-control" placeholder="{{ __('Comment') }}" value="@isset($log){{ $log->comment }}@endisset"></x-slot>

    <x-slot name="control">
        <x-dynamic-component :component="$btnGroupComponentName"/>
    </x-slot>
</x-views.devices.device-table.additional-info.movement-history-table.rows.layout>