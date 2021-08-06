<div {{ $attributes->merge(['class' => 'table']) }}>
    @isset($head)
    <div name="head">
        {{ $head }}
    </div>
    @endisset

    @isset($body)
    <div name="body">
        {{ $body }}
    </div>
    @endisset
</div>