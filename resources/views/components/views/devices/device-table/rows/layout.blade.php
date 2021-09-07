@props(['onSubmit' => null, 'onReset' => null])

<div {{ $attributes->merge(['class' => 'table-row row']) }}>
    <div class="col table-row-content">

        <div class="row main-info">

            @if(str_ends_with($attributes->get('class'), 'form'))
                <form class="col" onsubmit="{{ $onSubmit }};" onreset="{{ $onReset }}">
                    @csrf
                    <div class="row">
            @endif

            {{ $slot }}
            <div class="cell" name="id" hidden>{{ $id }}</div>
            <div class="cell" name="status_id" hidden>{{ $status_id }}</div>
            <div class="cell col-1">
                <div class="row m-0"><div name="inventory_code" title="{{ __('Inventory code') }}">{{ $inventory_code }}</div></div>
                <div class="row m-0"><div name="identification_code" title="{{ __('Identification code') }}">{{ $identification_code }}</div></div>
            </div>
            <div class="cell col-2" name="type">{{ $type }}</div>
            <div class="cell col-2" name="model">{{ $model }}</div>
            <div class="cell col-3" name="location">{{ $location }}</div>
            <div class="cell col" name="comment">{{ $comment }}</div>
            <div class="cell col-auto text-right" name="control">{{ $control }}</div>
            
            @if(str_ends_with($attributes->get('class'), 'form'))
                    </div>
                </form>
            @endif
        </div>

    </div>
</div>