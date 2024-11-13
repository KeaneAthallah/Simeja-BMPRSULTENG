<x-layout-dashboard>
    <x-slot:title>{{ $title }}</x-slot:title>


    <script src="{{ asset('output/JP_Sulteng_2023.js') }}"></script>
    <script src="{{ asset('output/simpul_JPSulteng_fix.js') }}"></script>
    <div class="flex flex-col items-center m-5">
        <div id="map" style="height: 90vh; width: 100%"
            class="relative w-full max-w-md md:max-w-xl lg:max-w-7xl bg-nord0 rounded-lg shadow-lg border-4 border-nord1 dark:border-nord5 dark:bg-nord4 my-4">
        </div>
    </div>

    <x-layout-dashboard>
        <x-slot:title>{{ $title }}</x-slot:title>

        <script src="{{ asset('output/JP_Sulteng_2023.js') }}"></script>
        <script src="{{ asset('output/simpul_JPSulteng_fix.js') }}"></script>
        <div class="flex flex-col items-center m-5">
            <div id="map" style="height: 90vh; width: 100%"
                class="relative w-full max-w-md md:max-w-xl lg:max-w-7xl bg-nord0 rounded-lg shadow-lg border-4 border-nord1 dark:border-nord5 dark:bg-nord4 my-4">
            </div>
        </div>

        <script>
            // Initialize the map
            var map = L.map('map').setView([-0.9062410028581525, 119.85685829713327], 13);

            // Add OpenStreetMap tiles
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            var simpulIcon = L.icon({
                iconUrl: `https://simeja-bmprsulteng.com/icons/marker.png`, // Replace with the path to your custom simpul icon
                iconSize: [25, 25],
                iconAnchor: [12, 41],
                popupAnchor: [0, -41]
            });

            // Layer groups
            var layers = {
                'Kondisi Jalan': {
                    'Baik': L.layerGroup(),
                    'Sedang': L.layerGroup(),
                    'Rusak Ringan': L.layerGroup(),
                    'Rusak Berat': L.layerGroup()
                },
                'Penanganan': {
                    'Pemeliharaan Rutin': L.layerGroup(),
                    'Pemeliharaan Berkala': L.layerGroup(),
                    'Peningkatan/Rekonstruksi': L.layerGroup()
                },
                'Jenis Perkerasan': {
                    '1': L.layerGroup(),
                    '2': L.layerGroup(),
                    '3': L.layerGroup(),
                    '4': L.layerGroup(),
                    '5': L.layerGroup()
                },
                'Complaints': L.layerGroup(),
                'Simpul Features': L.layerGroup(),
                'GeoJSON Layer': L.layerGroup() // New layer group for geoJson(jp)
            };

            // Color mapping for each condition and type
            var colors = {
                'Kondisi Jalan': {
                    'Baik': 'green',
                    'Sedang': 'yellow',
                    'Rusak Ringan': 'orange',
                    'Rusak Berat': 'red'
                },
                'Penanganan': {
                    'Pemeliharaan Rutin': 'blue',
                    'Pemeliharaan Berkala': 'purple',
                    'Peningkatan/Rekonstruksi': 'brown'
                },
                'Jenis Perkerasan': {
                    '1': 'cyan',
                    '2': 'magenta',
                    '3': 'pink',
                    '4': 'lime',
                    '5': 'teal'
                }
            };

            var url = "{{ url('/') }}";

            // Fetch data from Laravel
            fetch(`${url}/map-data`)
                .then(response => response.json())
                .then(data => {
                    console.log('Fetched data:', data);
                    data.forEach(item => {
                        if (item.street_id) {
                            var color = colors['Kondisi Jalan'][item.kondisiJalan] || colors['Penanganan'][item
                                .penanganan
                            ] || colors['Jenis Perkerasan'][item.jenis_perkerasan] || 'blue';
                            var latlngs = item.coordinates.map(coord => [coord.latitude, coord.longitude]);
                            var polyline = L.polyline(latlngs, {
                                color: color
                            }).bindPopup(
                                `<b>${item.nama_ruas}</b><br>Kondisi Jalan: ${item.kondisiJalan}<br>Penanganan: ${item.penanganan}`
                                );
                            layers['Kondisi Jalan'][item.kondisiJalan].addLayer(polyline);
                            layers['Penanganan'][item.penanganan].addLayer(polyline);
                            layers['Jenis Perkerasan'][item.jenis_perkerasan].addLayer(polyline);
                        } else if (item.complain_id) {
                            var marker = L.marker([item.lat, item.long]).bindPopup(
                                `<b>Status: ${item.status}</b><br>Description: ${item.description}<br><img src="${url}/storage/${item.image}" width="100">`
                                );
                            layers['Complaints'].addLayer(marker);
                        }
                    });

                    Object.keys(layers['Kondisi Jalan']).forEach(key => layers['Kondisi Jalan'][key].addTo(map));
                    Object.keys(layers['Penanganan']).forEach(key => layers['Penanganan'][key].addTo(map));
                    Object.keys(layers['Jenis Perkerasan']).forEach(key => layers['Jenis Perkerasan'][key].addTo(map));
                    layers['Complaints'].addTo(map);

                    // Integrate simpul features with layer control
                    simpul.features.forEach(function(feature) {
                        var coords = [feature.geometry.coordinates[1], feature.geometry.coordinates[0]];
                        var properties = feature.properties;
                        var popupContent = `
                            <strong>OBJECTID:</strong> ${properties.OBJECTID}<br>
                            <strong>Kl_Dat_Das:</strong> ${properties.Kl_Dat_Das}<br>
                            <strong>Nm_Ruas:</strong> ${properties.Nm_Ruas}<br>
                            <strong>Thn_Data:</strong> ${properties.Thn_Data}<br>
                            <strong>Status:</strong> ${properties.Status}<br>
                            <strong>Fungsi:</strong> ${properties.Fungsi}<br>
                            <strong>Propinsi:</strong> ${properties.Propinsi}<br>
                            <strong>Shape Length:</strong> ${properties.Shape_Leng}<br>
                            <strong>Length KM:</strong> ${properties.LengthKM}<br>
                            <strong>X Coordinate:</strong> ${properties.X}<br>
                            <strong>Y Coordinate:</strong> ${properties.Y}
                        `;
                        var marker = L.marker(coords, {
                            icon: simpulIcon
                        }).bindPopup(popupContent);

                        layers['Simpul Features'].addLayer(marker);
                    });
                    layers['Simpul Features'].addTo(map);

                    // Add geoJson(jp) data to its own layer
                    var geoJsonLayer = L.geoJson(jp);
                    layers['GeoJSON Layer'].addLayer(geoJsonLayer);
                    layers['GeoJSON Layer'].addTo(map);

                    // Layer control
                    var overlayMaps = {
                        'Kondisi Jalan Baik': layers['Kondisi Jalan']['Baik'],
                        'Kondisi Jalan Sedang': layers['Kondisi Jalan']['Sedang'],
                        'Kondisi Jalan Rusak Ringan': layers['Kondisi Jalan']['Rusak Ringan'],
                        'Kondisi Jalan Rusak Berat': layers['Kondisi Jalan']['Rusak Berat'],
                        'Penanganan Pemeliharaan Rutin': layers['Penanganan']['Pemeliharaan Rutin'],
                        'Penanganan Pemeliharaan Berkala': layers['Penanganan']['Pemeliharaan Berkala'],
                        'Penanganan Peningkatan/Rekonstruksi': layers['Penanganan']['Peningkatan/Rekonstruksi'],
                        'Jenis Perkerasan Aspal': layers['Jenis Perkerasan']['1'],
                        'Jenis Perkerasan Beton': layers['Jenis Perkerasan']['2'],
                        'Jenis Perkerasan Macadam': layers['Jenis Perkerasan']['3'],
                        'Jenis Perkerasan Kerikil': layers['Jenis Perkerasan']['4'],
                        'Jenis Perkerasan Tanah': layers['Jenis Perkerasan']['5'],
                        'Aspirasi': layers['Complaints'],
                        'Simpul Features': layers['Simpul Features'],
                        'GeoJSON Layer': layers['GeoJSON Layer'] // Add geoJson(jp) layer to layer control
                    };

                    L.control.layers({}, overlayMaps, {
                        collapsed: true
                    }).addTo(map);
                })
                .catch(error => console.error('Error fetching map data:', error));
        </script>
    </x-layout-dashboard>





</x-layout-dashboard>
