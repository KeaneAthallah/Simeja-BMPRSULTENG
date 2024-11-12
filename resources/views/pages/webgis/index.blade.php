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
        let map;
        let markers = [];

        $(document).ready(function() {
            // Initialize the map centered at a default location
            map = L.map('map').setView([-0.9019336055045014, 119.86625407936758], 12);

            // Add a tile layer
            L.tileLayer("https://tile.openstreetmap.org/{z}/{x}/{y}.png", {
                maxZoom: 20,
                attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
            }).addTo(map);

            // Fetch and display markers from the backend API
            const url = "{{ route('dashboard.webgis.json') }}";

            $.getJSON(url, function(data) {
                // Create custom icons for different statuses
                const customIconRed = L.icon({
                    iconUrl: 'https://simeja-bmprsulteng.com/icons/red.png',
                    iconSize: [25, 25],
                    iconAnchor: [12, 41],
                    popupAnchor: [1, -34]
                });
                const customIconBlue = L.icon({
                    iconUrl: 'https://simeja-bmprsulteng.com/icons/blue.png',
                    iconSize: [30, 30],
                    iconAnchor: [12, 41],
                    popupAnchor: [1, -34]
                });
                const customIconGreen = L.icon({
                    iconUrl: 'https://simeja-bmprsulteng.com/icons/green.png',
                    iconSize: [25, 25],
                    iconAnchor: [12, 41],
                    popupAnchor: [1, -34]
                });

                // Process each item in the data array
                $.each(data, function(index, item) {
                    // For `asphaltStreetData` and `soilsStreetData`, handle the coordinates (polyline)
                    if (item.coordinates) {
                        let latlngs = item.coordinates.map(function(coord) {
                            return [coord.latitude, coord
                            .longitude]; // [latitude, longitude]
                        });

                        // Determine polyline color based on data type
                        let color = item.asphaltStreetData_id ? 'red' :
                        'blue'; // Red for Asphalt, Blue for Soils
                        let polyline = L.polyline(latlngs, {
                            color: color
                        }).addTo(map);
                        map.fitBounds(polyline.getBounds()); // Zoom to fit the polyline
                    }

                    // For `complaints`, display markers with popup information
                    if (item.lat && item.long) {
                        // Determine the status and corresponding color
                        let statusColorClass;
                        let statusText;
                        if (item.status === 'Pending') {
                            statusColorClass = 'text-red-500';
                            statusText = 'Baru';
                        } else if (item.status === 'On Progress') {
                            statusColorClass = 'text-blue-500';
                            statusText = 'Dalam pengerjaan';
                        } else {
                            statusColorClass = 'text-green-500';
                            statusText = 'Selesai';
                        }

                        // Format the date
                        function formatDate(dateString) {
                            const date = new Date(dateString);
                            const options = {
                                year: 'numeric',
                                month: 'long',
                                day: 'numeric'
                            };
                            return date.toLocaleDateString(undefined, options);
                        }

                        const formattedDate = formatDate(item.created_at);

                        // Prepare popup content
                        const popupContent = `
                            <div class="max-w-sm rounded-lg overflow-hidden bg-white">
                                <img class="w-full h-48 object-cover" src="http://simeja-bmprsulteng.com/storage/${item.image}" alt="Foto Kerusakan">
                                <div class="px-6 py-4">
                                    <div class="mb-4">
                                        <span class="font-semibold text-lg">Status:</span>
                                        <span class="font-semibold text-lg ${statusColorClass} ml-1">${statusText}</span>
                                    </div>
                                    <div class="mb-2">
                                        <span class="font-bold text-gray-800">Laporan dibuat oleh:</span>
                                    </div>
                                    <div class="mb-2 flex flex-col">
                                        <span class="font-semibold text-gray-800">Nama:</span>
                                        <span class="text-gray-600">${item.name || 'Tidak tersedia'}</span>
                                    </div>
                                    <div class="mb-2 flex flex-col">
                                        <span class="font-semibold text-gray-800">Alamat:</span>
                                        <span class="text-gray-600">${item.address || 'Tidak tersedia'}</span>
                                    </div>
                                    <div class="mb-2 flex flex-col">
                                        <span class="font-semibold text-gray-800">Aspirasi:</span>
                                        <span class="text-gray-600">${item.aspirasi || 'Tidak tersedia'}</span>
                                    </div>
                                    <div class="mb-2 flex flex-col">
                                        <span class="font-semibold text-gray-800">Tanggal:</span>
                                        <span class="text-gray-600">${formattedDate}</span>
                                    </div>
                                </div>
                            </div>
                        `;

                        // Select icon based on status
                        const icon = item.status === 'Pending' ? customIconRed :
                            item.status === 'On Progress' ? customIconBlue : customIconGreen;

                        // Ensure the coordinates are in [latitude, longitude] format before adding the marker
                        const lat = item.lat;
                        const long = item.long;
                        const marker = L.marker([lat, long], {
                                icon: icon
                            })
                            .bindPopup(popupContent)
                            .on('click', function() {
                                $('#noteDetails').text(
                                    `Name: ${item.name || 'Tidak tersedia'}, Status: ${statusText}`
                                    );
                            })
                            .addTo(map);

                        markers.push({
                            marker: marker,
                            status: item.status
                        });
                    }
                });
            });
        });
    </script>



</x-layout-dashboard>
