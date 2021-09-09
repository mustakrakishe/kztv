@props([
    'action' => null,
    'cancel' => null,
    'onSubmit' => null,
    'onReset' => null
])

<div {{ $attributes->merge(['class' => 'table-row row']) }}>

    @if(str_ends_with($attributes->get('class'), 'form'))
        <form class="col" action="{{ $action }}" cancel="{{ $cancel }}" onsubmit="{{ $onSubmit }}" onreset="{{ $onReset }}" >
            @csrf
            <div class="row">
    @endif

    {{ $slot }}
    <div class="cell info" name="id" hidden>{{ $id }}</div>
    <div class="cell info col-3" name="date">{{ $date }}</div>
    <div class="cell info col-4" name="characteristics">{{ $characteristics }}</div>
    <div class="cell info col-4" name="comment">{{ $comment }}</div>
    <div class="cell control col-1">{{ $control }}</div>
            
    @if(str_ends_with($attributes->get('class'), 'form'))
            </div>
        </form>
    @endif
    
</div>