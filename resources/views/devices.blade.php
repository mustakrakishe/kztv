<x-app-layout>
    <link rel="stylesheet" href="css\devices.css">

    <script>
        let links = {
            add_device: @json(route('devices.add')),
            get_device_form: @json(route('devices.get_device_form')),
            get_device_log: @json(route('devices.get_device_log')),
            get_device_more_info: @json(route('devices.get_device_more_info')),
            get_movement_log_form: @json(route('devices.get_movement_log_form')),
            delete_device: @json(route('devices.delete')),
            update_device: @json(route('devices.update'))
        };
    </script>
    <script src="{{ asset('js/scenarios/devices.js') }}"></script>

    <x-slot name="pageTitle">Пристрої</x-slot>
    <x-slot name="header">Пристрої</x-slot>

    <div class="card">
        <div class="card-body">
            <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                <div class="row">
                    <div class="col text-right mt-auto" style="padding: 8px 23px;">
                        <button name="btn_new_device" id="new_device" onclick="show_new_device_form()" hidden></button>
                        <label class="btn btn-link m-0 p-0" for="new_device"><i class="fas fa-plus"></i></label>
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