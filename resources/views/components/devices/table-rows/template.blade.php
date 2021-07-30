<tr class="device_table_row">
    {{ $slot }}
    <td class="info" name="id" hidden>{{ $id }}</td>
    <td width="5%" class="codes">
        <div class="info" name="inventory_code">{{ $inventory_code }}</div>
        <div class="info" name="identification_code">{{ $identification_code }}</div>
    </td>
    <td width="10%" class="info" name="type">{{ $type }}</td>
    <td width="20%" class="info" name="model">{{ $model }}</td>
    <td width="30%" class="info" name="properties">{{ $properties }}</td>
    <td width="30%" class="info" name="location">{{ $location }}</td>
    <td width="5%" class="ctrl">{{ $ctrl_btns }}</td>
</tr>