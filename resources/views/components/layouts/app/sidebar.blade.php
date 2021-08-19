<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <!-- Brand Logo -->
    <a href="/" class="brand-link">
        <img src="{{ asset('storage/service/logo.jpg') }}" alt='ПрАТ "КЗТВ"' class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">ПрАТ "КЗТВ"</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center justify-content-between" style="color: #ced4da;">
            <div class="info d-flex">
                <div class="image">
                    <i class="far fa-user-circle" style="font-size: 24px"></i>
                </div>

                <div class="name ml-2">
                    {{ Auth::user()->login }}
                </div>
            </div>

            <div class="control mr-3 d-flex">
            <!-- <i class="fas fa-ellipsis-v"></i> -->
                <div class="logout">
                    <form id="logout" action="{{ route('logout') }}" method="post" hidden> @csrf </form>
                    <a href="" onclick="event.preventDefault(); $('form#logout').submit()">
                        <i class="fas fa-sign-out-alt""></i>
                    </a>
                </div>
            </div>

        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-legacy nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">

                <x-layouts.app.sidebar.nav-item>
                    <x-slot name="title">{{ __('Devices') }}</x-slot>
                    <x-slot name="iconClass">fas fa-desktop</x-slot>
                    <x-slot name="link">{{ route('devices') }}</x-slot>
                </x-layouts.app.sidebar.nav-item>
                
            </ul>
        </nav>
        
    </div>
    
</aside>




