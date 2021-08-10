<div {{ $attributes->merge(['class' => 'table']) }}>
    <div name="head" class="row">
        {{ $head }}
    </div>

    <div class="row">
        <div name="body" class="col">
            {{ $body }}
        </div>
    </div>
</div>