@props(['id' => null])

<div {{ $attributes->merge(['class' => 'button-group']) }}>
    <x-button value="{{ $id }}" onclick="show_device_more_info(event)">
        <i class="far fa-window-maximize"></i>
    </x-button>

    <x-button value="{{ $id }}" onclick="show_device_edit_form(event)">
        <i class="fas fa-pen"></i>
    </x-button>
        
    <x-button value="{{ $id }}" onclick="delete_device(event)">
        <i class="fas fa-trash-alt"></i>
    </x-button>
</div>