<button {{ $attributes->merge(['class' => 'btn btn-primary', 'title' => $title]) }}>
    {{ $slot }}
</button>