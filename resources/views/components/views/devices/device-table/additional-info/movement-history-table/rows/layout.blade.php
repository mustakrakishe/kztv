<div {{ $attributes->merge(['class' => 'table-row row']) }}>
    <div class="cell info" name="id" hidden>{{ $id }}</div>
    <div class="cell info col-2" name="created_at">{{ $created_at }}</div>
    <div class="cell info col-5" name="location">{{ $location }}</div>
    <div class="cell info col-4" name="comment">{{ $comment }}</div>
    <div class="cell control col-1">{{ $control }}</div>
</div>