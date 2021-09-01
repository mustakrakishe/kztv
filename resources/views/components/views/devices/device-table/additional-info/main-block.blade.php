<div class="row additional-info">

    <div class="container">
        <div name="table-title-row" class="row p-2 justify-content-end">
            <div name="title" class="col-4 text-center overflow-visible font-weight-bold">{{ __('Movement history') }}</div>
            
            <div name="control-buttons" class="col-4 text-right">
                <x-buttons.with-icon value="{{ $device_id }}" onclick="show_new_movement_log_form($(this))"><i class="fas fa-plus"></i></x-buttons.with-icon>
            </div>
        </div>

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
        
</div>
