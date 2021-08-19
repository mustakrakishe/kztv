<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ env('APP_NAME') }}@isset($pageTitle) - {{ $pageTitle }}@endisset</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="admin-lte/dist/css/adminlte.min.css">

    <script src="admin-lte/plugins/jquery/jquery.min.js"></script>
    <script src="admin-lte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="admin-lte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <script src="admin-lte/dist/js/adminlte.js"></script>
</head>

<body class="dark-mode">
    <x-layouts.app.preloader></x-layouts.app.preloader>
    {{ $slot }}
</body>

</html>
