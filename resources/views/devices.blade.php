<x-app-layout>
    <link rel="stylesheet" href="css\devices.css">

    <script>
        let links = {
            add_device: @json(route('devices.add')),
            add_movement_log: @json(route('devices.add_movement_log')),
            get_device_comment_form_view: @json(route('devices.get_device_comment_form_view')),
            get_device_comment_log_view: @json(route('devices.get_device_comment_log_view')),
            get_device_form_view: @json(route('devices.get_device_form_view')),
            get_device_log_view: @json(route('devices.get_device_log_view')),
            get_device_more_info_view: @json(route('devices.get_device_more_info_view')),
            get_movement_log_view: @json(route('devices.get_movement_log_view')),
            get_movement_log_form_view: @json(route('devices.get_movement_log_form_view')),
            delete_device: @json(route('devices.delete')),
            delete_movement_log: @json(route('devices.delete_movement_log')),
            find_devices: @json(route('devices.find_devices')),
            update_device: @json(route('devices.update')),
            update_device_comment: @json(route('devices.update_device_comment')),
            update_movement_log: @json(route('devices.update_movement_log'))
        };
    </script>
    <script src="{{ asset('js/scenarios/devices.js') }}"></script>

    <x-slot name="pageTitle">{{ __('Devices') }}</x-slot>
    <x-slot name="header">{{ __('Devices') }}</x-slot>

    <div class="card">
        <div class="card-body">
            <div id="wrapper" class="wrapper">
                <div class="row">
                    <div class="col-4">
                        <form onsubmit='find_devices(event)'>
                            <div class="input-group mb-3 search-container form-row align-items-center">
                                <input type="search" id="search-keywords" class="form-control" placeholder="{{ __('Search by keywords') }}...">
                                <div class="input-group-append">
                                    <button id="search_devices" class="btn btn-secondary" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="col-4 my-auto ">
                        <div id="search-status" class="text-secondary"></div>
                    </div>

                    <div class="col text-right mt-auto" style="padding: 8px 23px;">
                        <label class="btn btn-link m-0 p-0">
                            <button id="new_device" onclick="show_new_device_form()" hidden></button>
                            <i class="fas fa-plus"></i>
                        </label>
                    </div>

                </div>

                <div class="row">

                    <x-table id="device-table">
                        <x-slot name="head">
                            <div class="cell col-1">{{ __('Inv. №') }}</div>
                            <div class="cell col-2">{{ __('Type') }}</div>
                            <div class="cell col-2">{{ __('Model') }}</div>
                            <div class="cell col-3">{{ __('Characteristics') }}</div>
                            <div class="cell col-3">{{ __('Location') }}</div>
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