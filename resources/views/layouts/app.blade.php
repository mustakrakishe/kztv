<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ env('APP_NAME') }}@isset($pageTitle) - {{ $pageTitle }}@endisset</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="admin-lte/plugins/fontawesome-free/css/all.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="admin-lte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="admin-lte/dist/css/adminlte.min.css">
</head>

<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">

        <x-layouts.app.preloader></x-layouts.app.preloader>

        <x-layouts.app.navbar></x-layouts.app.navbar>

        <x-layouts.app.sidebar></x-layouts.app.sidebar>

        <x-layouts.app.wrapper>
            <x-slot name="header">{{ $header }}</x-slot>
            {{ $slot }}
        </x-layouts.app.wrapper>

    </div>

    <!-- REQUIRED SCRIPTS -->
    <!-- jQuery -->
    <script src="admin-lte/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="admin-lte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="admin-lte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="admin-lte/dist/js/adminlte.js"></script>
</body>

</html>