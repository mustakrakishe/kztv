<div {{ $attributes->merge(['class' => 'section']) }}>
    <div class="row title">
        <div class="line col"></div>
        <p>{{ $title }}</p>
        <div class="line col"></div>
    </div>

    <div class="row">
        <div class="col content">
            {{ $content }}
        </div>
    </div>
</div>