<tr 
    id="@isset($id){{ $id }}@endisset"
    class="odd @isset($class){{ $class }}@endisset"
    style="display: {{ $display }};"
>
    <td width="5%" name="codes" class="info">@isset($codes){{ $codes }}@endisset</td>
    <td width="10%" name="type" class="info">@isset($type){{ $type }}@endisset</td>
    <td width="20%" name="model" class="info">@isset($model){{ $model }}@endisset</td>
    <td width="30%" name="properties" class="info">@isset($properties){{ $properties }}@endisset</td>
    <td width="30%" name="location" class="info">@isset($location){{ $location }}@endisset</td>
    <td width="5%" class="ctrl">@isset($ctrl_btns){{ $ctrl_btns }}@endisset</td>
</tr>