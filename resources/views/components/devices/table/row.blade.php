<div {{ $attributes->merge(['class' => 'table-row row']) }}>

    {{ $slot }}
    <div class="cell info" name="id" hidden>{{ $id }}</div>
    <div class="cell col-1">
        <div class="row m-0"><div class="info" name="inventory_code">{{ $inventory_code }}</div></div>
        <div class="row m-0"><div class="info" name="identification_code">{{ $identification_code }}</div></div>
    </div>
    <div class="cell info col-1" name="type">{{ $type }}</div>
    <div class="cell info col-2" name="model">{{ $model }}</div>
    <div class="cell info col-4" name="properties">{{ $properties }}</div>
    <div class="cell info col-3" name="location">{{ $location }}</div>
    <div class="cell control col-1">{{ $control }}</div>

</div>