<x-app-layout>

    <x-slot name="pageTitle">Устройства</x-slot>

    <x-slot name="header">
        Устройства
    </x-slot>

    <x-layouts.app.wrapper.category-item>
        <x-slot name="link">{{ route('devices.add') }}</x-slot>
        <x-slot name="img_path"></x-slot>
        <x-slot name="description">Добавить новое</x-slot>
    </x-layouts.app.wrapper.category-item>

</x-app-layout>