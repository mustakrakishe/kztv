<div class="tab">
    <label class="m-0 w-full">

        <input {{ $attributes->filter(function($value, $key){return in_array($key, ['id', 'name', 'value', 'checked']); })->merge(['type' => 'radio', 'class' => 'form-control', 'hidden' => 'hidden']) }}>

        <div {{ $attributes->filter(function($value, $key){ return !in_array($key, ['id', 'name', 'value']); })->merge(['class' => 'label text-light p-2 m-0 text-center fw-normal']) }}>
            {{ $slot }}
        </div>

    </label>
</div>