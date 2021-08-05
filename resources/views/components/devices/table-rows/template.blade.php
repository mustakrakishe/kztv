<tr class="{{ $row_class }}">
    {{ $slot }}
    <td class="info" name="id" hidden>{{ $id }}</td>
    <td class="codes">
        <div class="info" name="inventory_code">{{ $inventory_code }}</div>
        <div class="info" name="identification_code">{{ $identification_code }}</div>
    </td>
    <td class="info" name="type">{{ $type }}</td>
    <td class="info" name="model">{{ $model }}</td>
    <td class="info" name="properties">{{ $properties }}</td>
    <td class="info" name="location">{{ $location }}</td>
    <td class="ctrl">{{ $ctrl_btns }}</td>
</tr>