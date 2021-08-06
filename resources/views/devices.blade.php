<x-app-layout>
    <link rel="stylesheet" href="css\devices.css">
    <link rel="stylesheet" href="css\components\table.css">

    <script>
        let links = {
            add_device: @json(route('devices.add')),
            delete_device: @json(route('devices.delete')),
            update_device: @json(route('devices.update'))
        };

        let table_rows = {
            device_log: `<x-devices.table-rows.device-log></x-devices.table-rows.device-log>`,
            new_device_form: `<x-devices.table-rows.new-device-form></x-devices.table-rows.new-device-form>`,
            edit_device_form: `<x-devices.table-rows.edit-device-form></x-devices.table-rows.edit-device-form>`
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
                    <div class="col-sm-12">
                        <x-table.table id="device-table-1">
                            <x-slot name="head">
                                <x-table.row>
                                    <x-table.cell class="codes col-1">Інв. №</x-table.cell>
                                    <x-table.cell class="type col-1">Тип</x-table.cell>
                                    <x-table.cell class="model col-2">Модель</x-table.cell>
                                    <x-table.cell class="properties col-4">Характеристики</x-table.cell>
                                    <x-table.cell class="location col-3">Розташування</x-table.cell>
                                </x-table.row>
                            </x-slot>
                            <x-slot name="body">
                                @foreach($devices as $device)
                                    <x-table.row>
                                        <x-table.cell class="info id" hidden>{{ $device->id }}</x-table.cell>
                                        <x-table.cell class="info codes col-1">{{ $device->inventory_code }}</x-table.cell>
                                        <x-table.cell class="info type col-1">{{ $device->type }}</x-table.cell>
                                        <x-table.cell class="info model col-2">{{ $device->model }}</x-table.cell>
                                        <x-table.cell class="info properties col-4">{{ $device->properties }}</x-table.cell>
                                        <x-table.cell class="info location col-3">{{ $device->location }}</x-table.cell>
                                        <x-table.cell class="control col-1">
                                            <x-devices.btn-groups.device-log></x-devices.btn-groups.device-log>
                                        </x-table.cell>
                                    </x-table.row>
                                @endforeach
                            </x-slot>
                        </x-table.table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
</x-app-layout>