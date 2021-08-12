<div {{ $attributes->merge(['class' => 'table-row row']) }}>
    <div class="col table-row-content">

        <div class="row main-info">
            {{ $slot }}
            <div class="cell" name="id" hidden>{{ $id }}</div>
            <div class="cell col-1">
                <div class="row m-0"><div name="inventory_code">{{ $inventory_code }}</div></div>
                <div class="row m-0"><div name="identification_code">{{ $identification_code }}</div></div>
            </div>
            <div class="cell col-2" name="type">{{ $type }}</div>
            <div class="cell col-2" name="model">{{ $model }}</div>
            <div class="cell col-3" name="properties">{{ $properties }}</div>
            <div class="cell col-3" name="location">{{ $location }}</div>
            <div class="cell col-1" name="control">{{ $control }}</div>
        </div>

    </div>
</div>