<x-app-layout>
    <link rel="stylesheet" href="css\devices.css">

    <script>
        let links = {
            add_device: @json(route('devices.add')),
            add_movement_log: @json(route('devices.add_movement_log')),
            get_device_comment_form: @json(route('devices.get_device_comment_form')),
            get_device_comment_log_view: @json(route('devices.get_device_comment_log_view')),
            get_device_form: @json(route('devices.get_device_form')),
            get_device_log_view: @json(route('devices.get_device_log_view')),
            get_device_more_info: @json(route('devices.get_device_more_info')),
            get_movement_log_view: @json(route('devices.get_movement_log_view')),
            get_movement_log_form: @json(route('devices.get_movement_log_form')),
            delete_device: @json(route('devices.delete')),
            delete_movement_log: @json(route('devices.delete_movement_log')),
            find_devices: @json(route('devices.find_devices')),
            update_device: @json(route('devices.update')),
            update_device_comment: @json(route('devices.update_device_comment')),
            update_movement_log: @json(route('devices.update_movement_log'))
        };
    </script>
    <script src="{{ asset('js/scenarios/devices.js') }}"></script>

    <x-slot name="pageTitle">Пристрої</x-slot>
    <x-slot name="header">Пристрої</x-slot>

    <div class="card">
        <div class="card-body">
            <div id="wrapper" class="wrapper">
                <div class="row">
                    <div class="col search-container">
                        <input type="search" id="device-table-search" class="form-control" placeholder="Пошук за ключовими словами..." aria-controls="example1" onkeydown="find_devices(event)">
                    </div>

                    <div class="col text-right mt-auto" style="padding: 8px 23px;">
                        <label class="btn btn-link m-0 p-0">
                            <button name="btn_new_device" id="new_device" onclick="show_new_device_form()" hidden></button>
                            <i class="fas fa-plus"></i>
                        </label>
                    </div>
                </div>

                <div class="row">

                    <x-table id="device-table">
                        <x-slot name="head">
                            <div class="cell col-1">Інв. №</div>
                            <div class="cell col-2">Тип</div>
                            <div class="cell col-2">Модель</div>
                            <div class="cell col-3">Характеристики</div>
                            <div class="cell col-3">Розташування</div>
                        </x-slot>
                        <x-slot name="body">
                            @foreach($devices as $device)
                                <x-views.devices.device-table.rows.log :device="$device"/>
                            @endforeach
                        </x-slot>
                    </x-table>

                </div>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
</x-app-layout>