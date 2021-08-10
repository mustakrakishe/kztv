<div {{ $attributes->merge(['class' => 'section']) }}>
    <div class="row">
        <p class="title">{{ $title }}</p>
    </div>

    <div class="row content">
        {{ $content }}
    </div>
</div>