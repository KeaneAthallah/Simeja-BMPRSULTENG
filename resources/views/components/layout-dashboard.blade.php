<!DOCTYPE html>
<html lang="en" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SiMeja || Dashboard</title>
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="{{ asset('components/datatables.net-bs5/dataTables.bootstrap5.css') }}" />
    <link rel="stylesheet" href="{{ asset('components/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/leaflet.css') }}">
    <script src="{{ asset('assets/leaflet.js') }}"></script>
</head>

<body class="h-full">
    <div class="min-h-full dark:bg-nord0 dark:text-nord6 bg-nord6 text-nord0">
        <x-navbar></x-navbar>
        <x-header></x-header>
        <main class="dark:text-black">
            {{ $slot }}
        </main>
        <x-footer></x-footer>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('components/datatables.net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('components/datatables.net-bs5/dataTables.bootstrap5.js') }}"></script>
    <script src="{{ asset('components/js/data-table.js') }}"></script>
</body>

</html>
