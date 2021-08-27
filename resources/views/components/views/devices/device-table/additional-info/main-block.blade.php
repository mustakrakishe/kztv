<div class="row additional-info">
    <x-views.devices.device-table.additional-info.section class="col-4">
        <x-slot name="title">
            {{ __('Characteristics') }}
        </x-slot>

        <x-slot name="controlButtons">
            <label class="btn btn-link m-0 py-0">
                <button onclick="show_field_edit_form(event)" hidden></button>
                <i class="fas fa-pen"></i>
            </label>
        </x-slot>

        <x-slot name="content">
            <x-views.devices.device-table.additional-info.field.log :text="$characteristics" :name="'characteristics'"/>
        </x-slot>
    </x-views.devices.device-table.additional-info.section>

    <x-views.devices.device-table.additional-info.section class="col-7">

        <x-slot name="title">
            {{ __('Movement history') }}
        </x-slot>

        <x-slot name="controlButtons">
            <label class="btn btn-link m-0 py-0">
                <button name="btn_new_device" value="{{ $device_id }}" onclick="show_new_movement_log_form($(this))" hidden></button>
                <i class="fas fa-plus"></i>
            </label>
        </x-slot>

        <x-slot name="content">
            <div class="row">
                <x-table class="movement-history-table">
                    <x-slot name="head">
                        <div class="cell col-3">{{ __('Date') }}</div>
                        <div class="cell col-4">{{ __('Location') }}</div>
                        <div class="cell col-4">{{ __('Comment') }}</div>
                    </x-slot>

                    <x-slot name="body">
                        @isset($movementHistory)
                            @foreach($movementHistory as $log)
                                <x-views.devices.device-table.additional-info.movement-history-table.rows.log :log="$log"/>
                            @endforeach
                        @endisset
                    </x-slot>
                </x-table>
            </div>
        </x-slot>

    </x-views.devices.device-table.additional-info.section>
</div>
