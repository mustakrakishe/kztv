<x-app-layout>
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
                        <i class="fas fa-plus"></i>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <table class="table table-striped dataTable dtr-inline" role="grid" aria-describedby="example1_info">
                            <thead>
                                <tr role="row">
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">Інв. №</th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">Тип</th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">Модель</th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">Характеристики</th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">Розташування</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($devices as $device)
                                    <tr class="odd">
                                        <td style="width: 10%"  name="inventory_code" class="dtr-control sorting_1" tabindex="0">{{ $device->inventory_code }}
                                            @isset($device->identification_code)
                                                @isset($device->inventory_code)
                                                    <br>
                                                @endisset

                                                ({{ $device->identification_code }})
                                            @endisset
                                        </td>
                                        <td style="width: 10%" name="type">{{ $device->type }}</td>
                                        <td style="width: 20%"  name="model">{{ $device->model }}</td>
                                        <td style="width: 30%"  name="properties">{{ $device->properties }}</td>
                                        <td style="width: 30%"  name="location">{{ $device->location }}</td>
                                        <td style="width: 5%"  name="edit" class="control">
                                            <button name="device_id" id="edit_device_{{ $device->id }}" class="edit_device" value="{{ $device->id }}" hidden></button>
                                            <label class="m-0" for="edit_device_{{ $device->id }}"><i class="fas fa-pen"></i></label>
                                        </td>
                                        <td style="width: 5%"  name="del" class="control">
                                            <button name="device_id" id="del_device_{{ $device->id }}" class="del_device" value="{{ $device->id }}" hidden></button>
                                            <label class="m-0" for="del_device_{{ $device->id }}"><i class="fas fa-trash-alt p-0"></i></label>
                                        </td>
                                    </tr>
                                @endforeach
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card-body -->
    </div>

    <script>
        let del_device_handler_link = @json(route('devices.delete'));
    </script>
    <script src="{{ asset('js/handlers/devices.js') }}"></script>
</x-app-layout>