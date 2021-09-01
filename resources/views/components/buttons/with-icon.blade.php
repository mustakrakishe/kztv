<label {{ $attributes->merge(['class' => 'btn btn-link m-0 p-0']) }}>
    <button hidden></button>
    {{ $slot }}
</label>