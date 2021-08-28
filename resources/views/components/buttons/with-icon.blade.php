<label class="btn btn-link m-0 p-0">
    <button {{ $attributes->merge(['hidden' => 'hidden']) }}></button>
    {{ $slot }}
</label>