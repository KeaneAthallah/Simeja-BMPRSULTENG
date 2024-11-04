<!DOCTYPE html>
<html lang="en" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" href="{{ asset('assets/images/logo.png') }}" type="image/png">
    <title>SiMeja | {{ $title }}</title>
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="{{ asset('assets/leaflet.css') }}">
    <script src="{{ asset('assets/leaflet.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@9.0.3"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
</head>

<body class="h-full tracking-wider leading-normal">
    <div class="min-h-full dark:bg-nord0 dark:text-nord6 bg-nord6 text-nord0">
        <x-navbar></x-navbar>
        <x-header></x-header>
        <main class="dark:text-black">
            {{ $slot }}
        </main>
    </div>
    <script src="../path/to/flowbite/dist/flowbite.min.js"></script>
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
