<x-app-layout>
    <x-slot name="header">Добро пожаловать!</x-slot>

    <x-slot name="navItems">

        <x-layouts.app.sidebar.nav-item>
            <x-slot name="title">Устройства</x-slot>
            <x-slot name="iconClass">fas fa-desktop</x-slot>
            <x-slot name="link">{{ route('devices') }}</x-slot>

            <x-slot name="treeview">
                <x-layouts.app.sidebar.nav-item>
                    <x-slot name="title">Компьютеры</x-slot>
                    <x-slot name="iconClass">far fa-circle</x-slot>
                    <x-slot name="link">{{ route('computers') }}</x-slot>
                </x-layouts.app.sidebar.nav-item>
            </x-slot>
        </x-layouts.app.sidebar.nav-item>

    </x-slot>

</x-app-layout>