<x-app-layout>

    <x-slot name="pageTitle">Устройства</x-slot>

    <x-slot name="navItems">
        <x-layouts.app.sidebar.nav-item>
            <x-slot name="title">Устройства</x-slot>
            <x-slot name="iconClass">fas fa-desktop</x-slot>
            <x-slot name="link">#</x-slot>
        </x-layouts.app.sidebar.nav-item>
    </x-slot>

    <x-slot name="header">
        Устройства
    </x-slot>

    @foreach ($departments as $department)
        <p>{{ $department->Название }}</p>
    @endforeach

</x-app-layout>