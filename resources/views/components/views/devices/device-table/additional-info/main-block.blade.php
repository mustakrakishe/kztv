<div class="row additional-info">
        
    <x-section id="characteristics" class="model-property-section" :title="__('Characteristics')">
        <x-slot name="controlButtons">
            <x-buttons.with-icon type="submit"><i class="fas fa-pen"></i></x-buttons.with-icon>
        </x-slot>

        <x-slot name="content">
            <p class="m-0 p-2">{{ $characteristics }}</p>
        </x-slot>
    </x-section>

    <div class="card" style="width: 640px">
        <div class="card-header row">
            <div class="col-3">{{ __('Date') }}</div>
            <div class="col-4">{{ __('Location') }}</div>
            <div class="col-4">{{ __('Comment') }}</div>
        </div>

        
        @isset($movementHistory)
            <div class="card-body p-0">
                <ul class="list-group list-group-flush">
                    
                    @foreach($movementHistory as $log)
                        
                    <li class="list-group-item p-0 d-flex">
                        <div class="col-3">{{ $log->created_at }}</div>
                        <div class="col-4">{{ $log->location }}</div>
                        <div class="col-4">{{ $log->comment }}</div>
                    </li>

                    @endforeach

                </ul>
            </div>
        @endisset
    </div>

    {{--<x-section id="movement-history" class="" :title="__('Movement history')">
        <x-slot name="controlButtons">
            <x-buttons.with-icon value="{{ $device_id }}" onclick="show_new_movement_log_form($(this))"><i class="fas fa-plus"></i></x-buttons.with-icon>
        </x-slot>

        <x-slot name="content">
            <div class="p-2">
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
    </x-section>--}}
</div>
