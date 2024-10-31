<!DOCTYPE html>
<html lang="en" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SiMeja || Dashboard</title>

    <!-- Theme script applied early -->


    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/leaflet.css') }}">
    <script src="{{ asset('assets/leaflet.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <style>
        /* Additional styling for dark mode and data tables */
        body.dark .dataTables_wrapper select,
        body.dark .dataTables_wrapper .dataTables_filter input {
            background-color: #2D3748;
            color: #A0AEC0;
            border-color: #4A5568;
        }

        body.dark .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background: #4A5568 !important;
        }
    </style>
</head>

<body class="h-full tracking-wider leading-normal">
    <div class="min-h-full dark:bg-nord0 dark:text-nord6 bg-nord6 text-nord0">
        <x-navbar></x-navbar>
        <x-header></x-header>
        <main class="dark:text-black">
            {{ $slot }}
        </main>
        {{-- <x-footer></x-footer> --}}
    </div>

    <!-- Datatables Scripts -->
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script>
        $(document).ready(function() {
            var table = $('#example').DataTable({
                    responsive: true
                })
                .columns.adjust()
                .responsive.recalc();
        });
    </script>

    <!-- Map Initialization Script -->
    <script>
        let latitude = -0.9029821741503987,
            longitude = 119.85871178991329;
        let map, marker;

        function initMap() {
            map = L.map("map").setView([latitude, longitude], 13);

            let googleStreets = L.tileLayer(
                "http://{s}.google.com/vt?lyrs=m&x={x}&y={y}&z={z}", {
                    maxZoom: 20,
                    subdomains: ["mt0", "mt1", "mt2", "mt3"],
                }
            );
            googleStreets.addTo(map);
        }

        initMap();
    </script>

    <!-- Theme Toggle Script -->
    <script>
        // Toggle dark mode with localStorage
        function toggleDarkMode() {
            document.body.classList.toggle('dark');
            localStorage.theme = document.body.classList.contains('dark') ? 'dark' : '';
        }

        // Apply the theme based on saved preference
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia(
                '(prefers-color-scheme: dark)').matches)) {
            document.body.classList.add('dark');
        } else {
            document.body.classList.remove('dark');
        }
    </script>
</body>

</html>
