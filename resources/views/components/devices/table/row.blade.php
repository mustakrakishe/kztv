<div {{ $attributes->merge(['class' => 'table-row row']) }}>

    <div class="cell info id" hidden>{{ $id }}</div>
    <div class="cell info codes col-1">
        <div class="row m-0"><div class="info inventory_code">{{ $inventory_code }}</div></div>
        <div class="row m-0"><div class="info identification_code">{{ $identification_code }}</div></div>
    </div>
    <div class="cell info type col-1">{{ $type }}</div>
    <div class="cell info model col-2">{{ $model }}</div>
    <div class="cell info properties col-4">{{ $properties }}</div>
    <div class="cell info location col-3">{{ $location }}</div>
    <div class="cell control col-1">{{ $control }}</div>

</div>