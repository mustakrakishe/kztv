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
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($devices as $device)
                                    <x-devices.table-row :device="$device"></x-devices.table-row>
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
        let upd_device_handler_link = @json(route('devices.update'));
        let del_device_handler_link = @json(route('devices.delete'));
    </script>
    <script src="{{ asset('js/handlers/devices.js') }}"></script>
</x-app-layout>