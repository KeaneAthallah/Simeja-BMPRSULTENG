<x-layout-dashboard>
    <x-slot:title>{{ $title }}</x-slot:title>
    <style>
        /* Custom CSS for layer control */
        .leaflet-control-layers-toggle {
            background-color: #4CAF50;
            border: none;
            padding: 8px 16px;
            color: white;
            font-size: 14px;
            cursor: pointer;
            border-radius: 5px;
        }

        .leaflet-control-layers {
            background: #fff;
            padding: 10px;
            border-radius: 5px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .leaflet-control-layers-list {
            list-style: none;
            padding: 0;
        }

        .leaflet-control-layers-list label {
            display: flex;
            align-items: center;
            font-size: 14px;
            padding: 5px 0;
            cursor: pointer;
        }

        /* Styling for each layer control item */
        .leaflet-control-layers-list label span {
            margin-left: 8px;
        }

        .leaflet-control-layers-list label input[type="checkbox"] {
            width: 18px;
            height: 18px;
            margin: 0;
            margin-right: 10px;
        }
    </style>

    <script src="{{ asset('output/JP_Sulteng_2023.js') }}"></script>
    <script src="{{ asset('output/simpul_JPSulteng_fix.js') }}"></script>
    <div class="flex flex-col items-center m-5">
        <div id="map" style="height: 90vh; width: 100%"
            class="relative w-full max-w-md md:max-w-xl lg:max-w-7xl bg-nord0 rounded-lg shadow-lg border-4 border-nord1 dark:border-nord5 dark:bg-nord4 my-4">
        </div>
    </div>

    <script>
        // Initialize tile layers
        var osm = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© OpenStreetMap'
        });
        var osmHOT = L.tileLayer('https://{s}.tile.openstreetmap.fr/hot/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© OpenStreetMap contributors, Tiles style by Humanitarian OpenStreetMap Team hosted by OpenStreetMap France'
        });
        var Stadia_StamenTonerLite = L.tileLayer(
            'https://tiles.stadiamaps.com/tiles/stamen_toner_lite/{z}/{x}/{y}{r}.{ext}', {
                minZoom: 0,
                maxZoom: 20,
                attribution: '&copy; <a href="https://www.stadiamaps.com/" target="_blank">Stadia Maps</a> &copy; <a href="https://www.stamen.com/" target="_blank">Stamen Design</a> &copy; <a href="https://openmaptiles.org/" target="_blank">OpenMapTiles</a> &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
                ext: 'png'
            });
        var Stadia_StamenTerrain = L.tileLayer(
            'https://tiles.stadiamaps.com/tiles/stamen_terrain/{z}/{x}/{y}{r}.{ext}', {
                minZoom: 0,
                maxZoom: 18,
                attribution: '&copy; <a href="https://www.stadiamaps.com/" target="_blank">Stadia Maps</a> &copy; <a href="https://www.stamen.com/" target="_blank">Stamen Design</a> &copy; <a href="https://openmaptiles.org/" target="_blank">OpenMapTiles</a> &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
                ext: 'png'
            });

        // Initialize the map with a default layer
        var map = L.map('map', {
            center: [-0.8975544769938592, 119.85632620526856],
            zoom: 10,
            layers: [osm]
        });
        // L.getJSON(jp).addto(Map);
        // Base layers
        var baseMaps = {
            "OpenStreetMap": osm,
            "OpenStreetMap.HOT": osmHOT,
            "OpenTerrain": Stadia_StamenTerrain,
            "OpenTonerLite": Stadia_StamenTonerLite
        };

        // Layer groups for kondisiJalan
        var kondisiLayers = {
            "Baik": L.layerGroup(),
            "Sedang": L.layerGroup(),
            "Rusak Ringan": L.layerGroup(),
            "Rusak Berat": L.layerGroup(),
        };

        // Layer groups for penanganan
        var penangananLayers = {
            "Pemeliharaan Rutin": L.layerGroup(),
            "Pemeliharaan Berkala": L.layerGroup(),
            "Peningkatan/Rekonstruksi": L.layerGroup(),
        };

        // Layer group for complaints
        var complaintsLayer = L.layerGroup();
        var jenisPerkerasanLayers = {
            "Aspal": L.layerGroup(),
            "Tanah": L.layerGroup()
        };


        // Add the layer control with custom labels and styling
        L.control.layers(baseMaps, {
            "Kondisi - Baik (Hijau)": kondisiLayers["Baik"],
            "Kondisi - Sedang (Kuning)": kondisiLayers["Sedang"],
            "Kondisi - Rusak Ringan (Orens)": kondisiLayers["Rusak Ringan"],
            "Kondisi - Rusak Berat (Merah)": kondisiLayers["Rusak Berat"],
            "Penanganan - Pemeliharaan Rutin (Merah)": penangananLayers["Pemeliharaan Rutin"],
            "Penanganan - Pemeliharaan Berkala (Hijau)": penangananLayers["Pemeliharaan Berkala"],
            "Penanganan - Peningkatan/Rekonstruksi (Biru)": penangananLayers["Peningkatan/Rekonstruksi"],
            "Komplain": complaintsLayer,
            "Jenis Perkerasan - Aspal": jenisPerkerasanLayers['Aspal'],
            "Jenis Perkerasan - Tanah": jenisPerkerasanLayers['Tanah'],
        }).addTo(map);

        // Fetch and handle GeoJSON data for street conditions
        const url = "{{ route('dashboard.webgis.json') }}";
        const baseURL = "{{ url('/') }}";

        $.getJSON(url, function(data) {
            const colorMapping = {
                "Baik": 'green',
                "Sedang": 'yellow',
                "Rusak Ringan": 'orange',
                "Rusak Berat": 'red',
                "Pemeliharaan Rutin": 'red',
                "Pemeliharaan Berkala": 'green',
                "Peningkatan/Rekonstruksi": 'blue'
            };

            $.each(data, function(index, item) {
                if (item.coordinates) {
                    let latlngs = item.coordinates.map(coord => [coord.latitude, coord.longitude]);

                    if (item.jenisPerkerasan === 'Aspal') {
                        let jenisPerkerasanPolyline = L.polyline(latlngs, {
                            color: 'black'
                        });
                        jenisPerkerasanLayers["Aspal"].addLayer(jenisPerkerasanPolyline);
                    } else if (item.jenisPerkerasan === 'Tanah') {
                        let jenisPerkerasanPolyline = L.polyline(latlngs, {
                            color: 'brown'
                        });
                        jenisPerkerasanLayers["Tanah"].addLayer(jenisPerkerasanPolyline);
                    }

                    // Add to appropriate kondisiJalan layer
                    let kondisiColor = colorMapping[item.kondisiJalan] || 'gray';
                    let kondisiPolyline = L.polyline(latlngs, {
                        color: kondisiColor
                    });
                    kondisiLayers[item.kondisiJalan]?.addLayer(kondisiPolyline);

                    // Add to appropriate penanganan layer
                    let penangananColor = colorMapping[item.penanganan] || 'gray';
                    let penangananPolyline = L.polyline(latlngs, {
                        color: penangananColor
                    });
                    penangananLayers[item.penanganan]?.addLayer(penangananPolyline);

                    // Ensure map fits the data
                    map.fitBounds(kondisiPolyline.getBounds());
                    map.fitBounds(jenisPerkerasanPolyline.getBounds());
                }
            });
        });

        // Fetch and handle complaint data
        const complaintsUrl = "{{ route('dashboard.webgis.json') }}"; // Assuming you have a route for complaints
        $.getJSON(complaintsUrl, function(complaints) {
            $.each(complaints, function(index, complain) {
                let lat = complain.lat;
                let long = complain.long;
                let description = complain.description;
                let status = complain.status;
                let image = complain.image;

                // Create marker for each complaint
                let marker = L.marker([lat, long]);

                // Popup with description and status, and image if available
                let popupContent = `
                    <strong>Deskripsi:</strong> ${description}<br>
                    <strong>Status:</strong> ${status}<br>
                    ${image ? `<img src="${baseURL}/storage/${image}" alt="Complaint Image" width="150">` : ''}
                `;
                marker.bindPopup(popupContent);

                // Add the marker to the complaints layer
                complaintsLayer.addLayer(marker);
                map.fitBounds(complaintsLayer.getBounds());
            });
        });
    </script>




    {{-- <script>
        // Initialize tile layers
        var osm = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© OpenStreetMap'
        });
        var osmHOT = L.tileLayer('https://{s}.tile.openstreetmap.fr/hot/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© OpenStreetMap contributors, Tiles style by Humanitarian OpenStreetMap Team hosted by OpenStreetMap France'
        });
        var Stadia_StamenTonerLite = L.tileLayer(
            'https://tiles.stadiamaps.com/tiles/stamen_toner_lite/{z}/{x}/{y}{r}.{ext}', {
                minZoom: 0,
                maxZoom: 20,
                attribution: '&copy; <a href="https://www.stadiamaps.com/" target="_blank">Stadia Maps</a> &copy; <a href="https://www.stamen.com/" target="_blank">Stamen Design</a> &copy; <a href="https://openmaptiles.org/" target="_blank">OpenMapTiles</a> &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
                ext: 'png'
            });
        var Stadia_StamenTerrain = L.tileLayer(
            'https://tiles.stadiamaps.com/tiles/stamen_terrain/{z}/{x}/{y}{r}.{ext}', {
                minZoom: 0,
                maxZoom: 18,
                attribution: '&copy; <a href="https://www.stadiamaps.com/" target="_blank">Stadia Maps</a> &copy; <a href="https://www.stamen.com/" target="_blank">Stamen Design</a> &copy; <a href="https://openmaptiles.org/" target="_blank">OpenMapTiles</a> &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
                ext: 'png'
            });

        // Initialize the map with a default layer
        var map = L.map('map', {
            center: [-0.8975544769938592, 119.85632620526856],
            zoom: 10,
            layers: [osm]
        });

        // Define base layers and overlays
        var baseMaps = {
            "OpenStreetMap": osm,
            "<span style='color: red'>OpenStreetMap.HOT</span>": osmHOT,
            "OpenTerrain": Stadia_StamenTerrain,
            "OpenTonerLite": Stadia_StamenTonerLite
        };

        // Define layer groups for different conditions
        var kondisiLayers = {
            "Baik": L.layerGroup(),
            "Sedang": L.layerGroup(),
            "Rusak Ringan": L.layerGroup(),
            "Rusak Berat": L.layerGroup()
        };

        var overlayMaps = {
            "Kondisi - Baik": kondisiLayers["Baik"],
            "Kondisi - Sedang": kondisiLayers["Sedang"],
            "Kondisi - Rusak Ringan": kondisiLayers["Rusak Ringan"],
            "Kondisi - Rusak Berat": kondisiLayers["Rusak Berat"]
        };

        // Add layer control to the map
        L.control.layers(baseMaps, overlayMaps, {
            collapsed: false
        }).addTo(map);

        // Fetch and handle GeoJSON data
        const url = "{{ route('dashboard.webgis.json') }}";
        const baseURL = "{{ url('/') }}";

        $.getJSON(url, function(data) {
            const customIcons = {
                Pending: L.icon({
                    iconUrl: `${baseURL}/icons/red.png`,
                    iconSize: [25, 25],
                    iconAnchor: [12, 41],
                    popupAnchor: [1, -34]
                }),
                "On Progress": L.icon({
                    iconUrl: `${baseURL}/icons/blue.png`,
                    iconSize: [30, 30],
                    iconAnchor: [12, 41],
                    popupAnchor: [1, -34]
                }),
                Completed: L.icon({
                    iconUrl: `${baseURL}/icons/green.png`,
                    iconSize: [25, 25],
                    iconAnchor: [12, 41],
                    popupAnchor: [1, -34]
                })
            };

            function formatDate(dateString) {
                const date = new Date(dateString);
                return date.toLocaleDateString(undefined, {
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric'
                });
            }

            // Define colors for each condition
            const kondisiColors = {
                "Baik": "red",
                "Sedang": "green",
                "Rusak Ringan": "blue",
                "Rusak Berat": "yellow"
            };

            $.each(data, function(index, item) {
                if (item.coordinates && item.kondisiJalan) {
                    let latlngs = item.coordinates.map(coord => [coord.latitude, coord.longitude]);
                    let kondisi = item.kondisiJalan;
                    let color = kondisiColors[kondisi] || 'gray';
                    let polyline = L.polyline(latlngs, {
                            color: color
                        })
                        .bindPopup(`<div>Kondisi Jalan: <strong>${kondisi}</strong></div>`)
                        .on('click', function() {
                            alert(`Kondisi Jalan: ${kondisi}`);
                        });

                    // Add polyline to corresponding layer group based on condition
                    polyline.addTo(kondisiLayers[kondisi]);
                }

                if (item.lat && item.long) {
                    let statusText = item.status === 'Pending' ? 'Baru' : item.status === 'On Progress' ?
                        'Dalam pengerjaan' : 'Selesai';
                    let popupContent = `
                        <div class="max-w-sm rounded-lg overflow-hidden bg-white">
                            <img class="w-full h-48 object-cover" src="${baseURL}/storage/${item.image}" alt="Foto Kerusakan">
                            <div class="px-6 py-4">
                                <div class="mb-4"><span class="font-semibold text-lg">Status:</span><span class="font-semibold text-lg ml-1">${statusText}</span></div>
                                <div class="mb-2"><span class="font-bold text-gray-800">Laporan dibuat oleh:</span></div>
                                <div class="mb-2 flex flex-col"><span class="font-semibold text-gray-800">Nama:</span><span class="text-gray-600">${item.name || 'Tidak tersedia'}</span></div>
                                <div class="mb-2 flex flex-col"><span class="font-semibold text-gray-800">Alamat:</span><span class="text-gray-600">${item.address || 'Tidak tersedia'}</span></div>
                                <div class="mb-2 flex flex-col"><span class="font-semibold text-gray-800">Aspirasi:</span><span class="text-gray-600">${item.aspirasi || 'Tidak tersedia'}</span></div>
                                <div class="mb-2 flex flex-col"><span class="font-semibold text-gray-800">Tanggal:</span><span class="text-gray-600">${formatDate(item.created_at)}</span></div>
                            </div>
                        </div>
                    `;

                    L.marker([item.lat, item.long], {
                            icon: customIcons[item.status] || customIcons.Pending
                        })
                        .bindPopup(popupContent)
                        .on('click', function() {
                            $('#noteDetails').text(
                                `Name: ${item.name || 'Tidak tersedia'}, Status: ${statusText}`);
                        })
                        .addTo(map);
                }
            });
        });
    </script> --}}

    {{-- <script>
        // Initialize tile layers
        var osm = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© OpenStreetMap'
        });
        var osmHOT = L.tileLayer('https://{s}.tile.openstreetmap.fr/hot/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© OpenStreetMap contributors, Tiles style by Humanitarian OpenStreetMap Team hosted by OpenStreetMap France'
        });
        var Stadia_StamenTonerLite = L.tileLayer(
            'https://tiles.stadiamaps.com/tiles/stamen_toner_lite/{z}/{x}/{y}{r}.{ext}', {
                minZoom: 0,
                maxZoom: 20,
                attribution: '&copy; <a href="https://www.stadiamaps.com/" target="_blank">Stadia Maps</a> &copy; <a href="https://www.stamen.com/" target="_blank">Stamen Design</a> &copy; <a href="https://openmaptiles.org/" target="_blank">OpenMapTiles</a> &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
                ext: 'png'
            });
        var Stadia_StamenTerrain = L.tileLayer(
            'https://tiles.stadiamaps.com/tiles/stamen_terrain/{z}/{x}/{y}{r}.{ext}', {
                minZoom: 0,
                maxZoom: 18,
                attribution: '&copy; <a href="https://www.stadiamaps.com/" target="_blank">Stadia Maps</a> &copy; <a href="https://www.stamen.com/" target="_blank">Stamen Design</a> &copy; <a href="https://openmaptiles.org/" target="_blank">OpenMapTiles</a> &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
                ext: 'png'
            });

        // Initialize the map with a default layer
        var map = L.map('map', {
            center: [-0.8975544769938592, 119.85632620526856],
            zoom: 10,
            layers: [osm]
        });

        // Define base layers and overlays
        var baseMaps = {
            "OpenStreetMap": osm,
            "<span style='color: red'>OpenStreetMap.HOT</span>": osmHOT,
            "OpenTerrain": Stadia_StamenTerrain,
            "OpenTonerLite": Stadia_StamenTonerLite
        };

        var baikLayer = L.layerGroup();
        var sedangLayer = L.layerGroup();
        var rusakRinganLayer = L.layerGroup();
        var rusakBeratLayer = L.layerGroup();

        // Layer control with "Kondisi" title
        var overlayMaps = {
            "Kondisi": {
                "Baik": baikLayer,
                "Sedang": sedangLayer,
                "Rusak Ringan": rusakRinganLayer,
                "Rusak Berat": rusakBeratLayer
            }
        };

        // Add layer control for base maps and overlays
        L.control.layers(baseMaps, overlayMaps, {
            collapsed: false
        }).addTo(map);


        // Fetch and handle GeoJSON data
        const url = "{{ route('dashboard.webgis.json') }}";
        const baseURL = "{{ url('/') }}";

        $.getJSON(url, function(data) {
            const customIcons = {
                Pending: L.icon({
                    iconUrl: `${baseURL}/icons/red.png`,
                    iconSize: [25, 25],
                    iconAnchor: [12, 41],
                    popupAnchor: [1, -34]
                }),
                "On Progress": L.icon({
                    iconUrl: `${baseURL}/icons/blue.png`,
                    iconSize: [30, 30],
                    iconAnchor: [12, 41],
                    popupAnchor: [1, -34]
                }),
                Completed: L.icon({
                    iconUrl: `${baseURL}/icons/green.png`,
                    iconSize: [25, 25],
                    iconAnchor: [12, 41],
                    popupAnchor: [1, -34]
                })
            };

            function formatDate(dateString) {
                const date = new Date(dateString);
                return date.toLocaleDateString(undefined, {
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric'
                });
            }

            function addPolylineToLayer(item, layerGroup, color) {
                let latlngs = item.coordinates.map(coord => [coord.latitude, coord.longitude]);
                L.polyline(latlngs, {
                    color: color
                }).addTo(layerGroup);
                map.fitBounds(layerGroup.getBounds());
            }

            $.each(data, function(index, item) {
                if (item.coordinates) {
                    let latlngs = item.coordinates.map(coord => [coord.latitude, coord.longitude]);
                    let color = 'blue'; // Default color

                    switch (item.kondisiJalan) {
                        case 'Baik':
                            color = 'red';
                            addPolylineToLayer(item, baikLayer, color);
                            break;
                        case 'Sedang':
                            color = 'green';
                            addPolylineToLayer(item, sedangLayer, color);
                            break;
                        case 'Rusak Ringan':
                            color = 'blue';
                            addPolylineToLayer(item, rusakRinganLayer, color);
                            break;
                        case 'Rusak Berat':
                            color = 'yellow';
                            addPolylineToLayer(item, rusakBeratLayer, color);
                            break;
                        default:
                            addPolylineToLayer(item, baikLayer, color); // Default to "Baik" if no match
                    }
                }
                if (item.lat && item.long) {
                    let statusText = item.status === 'Pending' ? 'Baru' : item.status === 'On Progress' ?
                        'Dalam pengerjaan' : 'Selesai';
                    let popupContent = `
                        <div class="max-w-sm rounded-lg overflow-hidden bg-white">
                            <img class="w-full h-48 object-cover" src="${baseURL}/storage/${item.image}" alt="Foto Kerusakan">
                            <div class="px-6 py-4">
                                <div class="mb-4"><span class="font-semibold text-lg">Status:</span><span class="font-semibold text-lg ml-1">${statusText}</span></div>
                                <div class="mb-2"><span class="font-bold text-gray-800">Laporan dibuat oleh:</span></div>
                                <div class="mb-2 flex flex-col"><span class="font-semibold text-gray-800">Nama:</span><span class="text-gray-600">${item.name || 'Tidak tersedia'}</span></div>
                                <div class="mb-2 flex flex-col"><span class="font-semibold text-gray-800">Alamat:</span><span class="text-gray-600">${item.address || 'Tidak tersedia'}</span></div>
                                <div class="mb-2 flex flex-col"><span class="font-semibold text-gray-800">Aspirasi:</span><span class="text-gray-600">${item.aspirasi || 'Tidak tersedia'}</span></div>
                                <div class="mb-2 flex flex-col"><span class="font-semibold text-gray-800">Tanggal:</span><span class="text-gray-600">${formatDate(item.created_at)}</span></div>
                            </div>
                        </div>
                    `;

                    L.marker([item.lat, item.long], {
                            icon: customIcons[item.status] || customIcons.Pending
                        })
                        .bindPopup(popupContent)
                        .on('click', function() {
                            $('#noteDetails').text(
                                `Name: ${item.name || 'Tidak tersedia'}, Status: ${statusText}`);
                        })
                        .addTo(map);
                }
            });
            // Object.values(kondisiLayers).forEach(layer => layer.addTo(map));
        });
    </script> --}}




</x-layout-dashboard>
