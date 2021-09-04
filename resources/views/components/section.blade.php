<div {{ $attributes->merge(['class' => 'section']) }}>

    @if(str_ends_with($attributes->get('class'), 'form'))
        <form action="{{ $action = null }}" onsubmit="{{ $onSubmit = null }};" onreset="{{ $onReset = null }}">
            @csrf
    @endif

    <div name="head" class="p-2">
        <div name="content">
            <div name="title" class="{{ $contentType == 'table' ? 'text-center' : '' }}">
                {{ $title }}
            </div>
            
            <div name="control-buttons">
                {{ $controlButtons }}
            </div>
        </div>
    </div>

    <div name="body">{{ $content }}</div>

    @if(str_ends_with($attributes->get('class'), 'form'))
        </form>
    @endif
    
</div>