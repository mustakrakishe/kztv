<div {{ $attributes->merge(['class' => 'section']) }}>
    <div class="row py-2">
        <div name="title" class="col p-0">
            {{ $title }}
        </div>
        
        <div name="control-buttons" class="col p-0 text-right">
            {{ $controlButtons }}
        </div>
    </div>

    <div class="row">
        <div name="content" class="col">
            {{ $content }}
        </div>
    </div>
</div>