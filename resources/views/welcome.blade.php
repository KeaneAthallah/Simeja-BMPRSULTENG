<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('assets/leaflet.css') }}">
    <script src="{{ asset('assets/leaflet.js') }}"></script>
    <style>
        #map {
            height: 750px;
        }
    </style>
    @vite('resources/css/app.css')
    <title>Test</title>
</head>

<body>
    <div id="map" class="w-full h-full"></div>
    {{-- <span class="text-red-500">YAHooo</span> --}}
    <script>
        var map = L.map('map').setView([-0.9269032028805467, 119.88221629817065], 13);
        googleStreets = L.tileLayer('http://{s}.google.com/vt?lyrs=s&x={x}&y={y}&z={z}', {
            maxZoom: 20,
            subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
        });
        googleStreets.addTo(map);
    </script>
</body>

</html>
