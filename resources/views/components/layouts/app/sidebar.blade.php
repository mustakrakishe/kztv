<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <!-- Brand Logo -->
    <a href="/" class="brand-link">
        <img src="{{ asset('storage/logo.jpg') }}" alt='ПрАТ "КЗТВ"' class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">ПрАТ "КЗТВ"</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-legacy nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">

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
                
            </ul>
        </nav>
        
    </div>
    
</aside>




