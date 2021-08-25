@props(['onSubmit' => null, 'onReset' => null])

<div {{ $attributes->merge(['class' => 'table-row row']) }}>

    @if(str_ends_with($attributes->get('class'), 'form'))
        <form class="col" onsubmit="{{ $onSubmit }};" onreset="{{ $onReset }}">
            @csrf
            <div class="row">
    @endif

    {{ $slot }}
    <div class="cell info" name="id" hidden>{{ $id }}</div>
    <div class="cell info" name="unit_id" hidden>{{ $unit_id }}</div>
    <div class="cell info col-3" name="created_at">{{ $created_at }}</div>
    <div class="cell info col-4" name="location">{{ $location }}</div>
    <div class="cell info col-4" name="comment">{{ $comment }}</div>
    <div class="cell control col-1">{{ $control }}</div>
            
    @if(str_ends_with($attributes->get('class'), 'form'))
            </div>
        </form>
    @endif
    
</div>