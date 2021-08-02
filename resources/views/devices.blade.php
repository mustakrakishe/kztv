<x-app-layout>
    <link rel="stylesheet" href="css\devices.css">

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

        let device_old_data = {};
    </script>
    <script src="{{ asset('js/scenarios/devices.js') }}"></script>

    <x-slot name="pageTitle">Пристрої</x-slot>
    <x-slot name="header">Пристрої</x-slot>

    <div class="card">
        <div class="card-body">
            <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                <div class="row">
                    <div class="col-sm-11 col-md-6">
                        <div id="example1_filter" class="dataTables_filter">
                            <label>Пошук:<input type="search" class="form-control form-control-sm" placeholder="" aria-controls="example1"></label>
                        </div>
                    </div>
                    <div class="col-sm-1 col-md-6 text-right mt-auto" style="padding: 8px 23px;">
                        <button name="btn_new_device" id="new_device" onclick="show_new_device_form()" hidden></button>
                        <label class="btn btn-link m-0 p-0" for="new_device"><i class="fas fa-plus"></i></label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <table id="device_table" class="table table-striped dataTable dtr-inline" role="grid" aria-describedby="example1_info">
                            <thead>
                                <tr role="row">
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">Інв. №</th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">Тип</th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">Модель</th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">Характеристики</th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">Розташування</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($devices as $device)
                                    <x-devices.table-rows.device-log :device="$device"></x-devices.table-rows.device-log>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
</x-app-layout>