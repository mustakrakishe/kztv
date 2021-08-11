<div class="row additional-info">

    <x-views.devices.device-table.additional-info.section class="col-3">
        <x-slot name="title">Статус</x-slot>
        <x-slot name="content">
            <p class="mx-auto">2021-08-01: Новий</p>
        </x-slot>
    </x-views.devices.device-table.additional-info.section>

    <x-views.devices.device-table.additional-info.section class="col-7">
        <x-slot name="title">Історія переміщення</x-slot>
        <x-slot name="content">
            
            <div class="row">
                <div class="col text-right mt-auto" style="padding: 8px 23px;">
                    <label class="btn btn-link m-0 p-0"">
                        <button name="btn_new_device" onclick="show_new_movement_log_form(event)" hidden></button>
                        <i class="fas fa-plus"></i>
                    </label>
                </div>
            </div>
            
            <div class="row">
                <x-table class="movement-history-table">
                    <x-slot name="head">
                        <div class="cell col-2">Дата</div>
                        <div class="cell col-5">Розташування</div>
                        <div class="cell col-4">Коментар</div>
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