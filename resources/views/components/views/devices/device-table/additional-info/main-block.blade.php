<div class="row additional-info">

    <div class="container mb-3">
        <div name="table-title-row" class="row p-2 justify-content-end">
            <div name="title" class="col-4 text-center overflow-visible font-weight-bold">{{ __('Movement history') }}</div>
            
            <div name="control-buttons" class="col-4 text-right">
                <x-button value="{{ $deviceId }}" onclick="show_new_movement_log_form($(this))">
                    <i class="fas fa-plus"></i>
                </x-button>
            </div>
        </div>

        <x-table class="movement-history-table">
            <x-slot name="head">
                <div class="cell col-3">{{ __('Date') }}</div>
                <div class="cell col-4">{{ __('Location') }}</div>
                <div class="cell col-4">{{ __('Comment') }}</div>
            </x-slot>

            <x-slot name="body">
                @isset($movements)
                    @foreach($movements as $movement)
                        <x-views.devices.device-table.additional-info.movement-history-table.rows.log :log="$movement"/>
                    @endforeach
                @endisset
            </x-slot>
        </x-table>
    </div>
    
    <div class="container mb-3">
        <div name="table-title-row" class="row p-2 justify-content-end">
            <div name="title" class="col-4 text-center overflow-visible font-weight-bold">{{ __('Modernization history') }}</div>
            
            <div name="control-buttons" class="col-4 text-right">
                <x-button value="{{ $deviceId }}" link="{{ route('modernization.create', compact('deviceId')) }}" onclick="modernization_create($(this))">
                    <i class="fas fa-plus"></i>
                </x-button>
            </div>
        </div>

        <x-table class="modernization-history-table">
            <x-slot name="head">
                <div class="cell col-3">{{ __('Date') }}</div>
                <div class="cell col-4">{{ __('Characteristics') }}</div>
                <div class="cell col-4">{{ __('Comment') }}</div>
            </x-slot>

            <x-slot name="body">
                @isset($modernizationAccounts)
                    @foreach($modernizationAccounts as $modernizationAccount)
                        <x-views.devices.device-table.additional-info.modernization-history-table.rows.log :modernizationAccount="$modernizationAccount"/>
                    @endforeach
                @endisset
            </x-slot>
        </x-table>
    </div>
    
    <div class="container mb-3">
        <div name="table-title-row" class="row p-2 justify-content-end">
            <div name="title" class="col-4 text-center overflow-visible font-weight-bold">{{ __('Repair history') }}</div>
            
            <div name="control-buttons" class="col-4 text-right">
                <x-button value="{{ $deviceId }}" link="{{ route('repair.create', compact('deviceId')) }}" onclick="repair_create($(this))">
                    <i class="fas fa-plus"></i>
                </x-button>
            </div>
        </div>

        <x-table class="repair-history-table">
            <x-slot name="head">
                <div class="cell col-2">{{ __('Date') }}</div>
                <div class="cell col-3">{{ __('Cause') }}</div>
                <div class="cell col-3">{{ __('Result') }}</div>
                <div class="cell col-3">{{ __('Characteristics') }}</div>
            </x-slot>

            <x-slot name="body">
                @isset($repairAccounts)
                    @foreach($repairAccounts as $repairAccount)
                        <x-views.devices.device-table.additional-info.repair-history-table.rows.log :repairAccount="$repairAccount"/>
                    @endforeach
                @endisset
            </x-slot>
        </x-table>
    </div>
        
</div>
