<div {{ $attributes->merge(['class' => 'section']) }}>
    <div class="row section-title">
        <div class="line col"></div>
        <p>{{ $title }}</p>
        <div class="line col"></div>
    </div>

    <div class="row section-content">
        {{ $content }}
    </div>
</div>