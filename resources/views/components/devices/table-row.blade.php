<tr class="odd">
    <td style="width: 5%" name="inventory_code" class="info">
        {{ $device->inventory_code }}
        @isset($device->identification_code)
            @isset($device->inventory_code)
                <br>
            @endisset

            ({{ $device->identification_code }})
        @endisset
    </td>
    <td width="10%" name="type" class="info">{{ $device->type }}</td>
    <td width="20%" name="model" class="info">{{ $device->model }}</td>
    <td width="30%" name="properties" class="info">{{ $device->properties }}</td>
    <td width="30%" name="location" class="info">{{ $device->location }}</td>
    <td class="ctrl" width="5%">
        <div class="row device-ctrl-group read-mode">
            <div class="col-6">
                <button name="device_id" id="edit_device_{{ $device->id }}" class="edit_device" value="{{ $device->id }}" hidden></button>
                <label class="btn btn-link m-0 p-0" for="edit_device_{{ $device->id }}"><i class="fas fa-pen"></i></label>
            </div>
            <div class="col-6">
                <button name="device_id" id="del_device_{{ $device->id }}" class="del_device" value="{{ $device->id }}" hidden></button>
                <label class="btn btn-link m-0 p-0" for="del_device_{{ $device->id }}"><i class="fas fa-trash-alt p-0"></i></label>
            </div>
        </div>

        <div class="row device-ctrl-group edit-mode" hidden>
            <div class="col-6">
                <button name="device_id" id="upd_device_0" class="upd_device" value="{{ $device->id }}" hidden></button>
                <label class="btn btn-link m-0 p-0" for="upd_device_{{ $device->id }}"><i class="fas fa-check"></i></label>
            </div>
            <div class="col-6">
                <button name="device_id" id="cancel_upd_device_{{ $device->id }}" class="cancel_upd_device" value="{{ $device->id }}" hidden></button>
                <label class="btn btn-link m-0 p-0" for="cancel_upd_device_{{ $device->id }}"><i class="fas fa-ban"></i></label>
            </div>
        </div>
    </td>
</tr>