<x-layout-dashboard>
    <div class="flex flex-col items-center m-5">
        <div id="map" style="height: 70vh"
            class="relative w-full max-w-md md:max-w-xl lg:max-w-7xl bg-nord0 rounded-lg shadow-lg border-4 border-nord1 dark:border-nord5 dark:bg-nord4 mt-4">
        </div>
    </div>

    <script>
        let map;
        let markers = [];

        $(document).ready(function() {
            // Initialize the map
            map = L.map('map').setView([-0.9019336055045014, 119.86625407936758], 12);

            // Add a tile layer
            L.tileLayer("https://tile.openstreetmap.org/{z}/{x}/{y}.png", {
                maxZoom: 20,
                attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
            }).addTo(map);

            // Fetch and display markers
            $.getJSON('http://localhost/gis/public/dashboard/webgis/json', function(data) {
                $.each(data, function(index) {
                    // Create a custom icon with an image
                    const customIconRed = L.icon({
                        iconUrl: 'https://localhost/gis/public/icons/red.png', // URL to the image for this marker
                        iconSize: [25, 25], // Size of the icon
                        iconAnchor: [12,
                            41
                        ], // Point of the icon which will correspond to marker's location
                        popupAnchor: [1, -
                            34
                        ] // Point from which the popup should open relative to the iconAnchor
                    });
                    const customIconBlue = L.icon({
                        iconUrl: 'https://localhost/gis/public/icons/blue.png', // URL to the image for this marker
                        iconSize: [30, 30], // Size of the icon
                        iconAnchor: [12,
                            41
                        ], // Point of the icon which will correspond to marker's location
                        popupAnchor: [1, -
                            34
                        ] // Point from which the popup should open relative to the iconAnchor
                    });
                    const customIconGreen = L.icon({
                        iconUrl: 'https://localhost/gis/public/icons/green.png', // URL to the image for this marker
                        iconSize: [25, 25], // Size of the icon
                        iconAnchor: [12,
                            41
                        ], // Point of the icon which will correspond to marker's location
                        popupAnchor: [1, -
                            34
                        ] // Point from which the popup should open relative to the iconAnchor
                    });
                    if (data[index].status == 'Pending') {
                        const marker = L.marker([data[index].lat, data[index].long], {
                                icon: customIconRed
                            })
                            .bindPopup(data[index].name)
                            .on('click', function() {
                                // Display details in the note card when a marker is clicked
                                $('#noteDetails').text(
                                    `Name: ${data[index].name}, Status: ${data[index].status}`
                                );
                            }).addTo(map);
                    } else if (data[index].status == 'On Progress') {
                        const marker = L.marker([data[index].lat, data[index].long], {
                                icon: customIconBlue
                            })
                            .bindPopup(data[index].name)
                            .on('click', function() {
                                // Display details in the note card when a marker is clicked
                                $('#noteDetails').text(
                                    `Name: ${data[index].name}, Status: ${data[index].status}`
                                );
                            }).addTo(map);
                    } else {
                        const marker = L.marker([data[index].lat, data[index].long], {
                                icon: customIconGreen
                            })
                            .bindPopup(data[index].name)
                            .on('click', function() {
                                // Display details in the note card when a marker is clicked
                                $('#noteDetails').text(
                                    `Name: ${data[index].name}, Status: ${data[index].status}`
                                );
                            }).addTo(map);
                    }
                });
            });
        });

        function filterMarkers(status) {
            // Clear all markers from the map
            markers.forEach(({
                marker
            }) => map.removeLayer(marker));

            // Add filtered markers back to the map
            markers.forEach(({
                marker,
                status: markerStatus
            }) => {
                if (status === 'all' || markerStatus === status) {
                    marker.addTo(map);
                }
            });
        }
    </script>
</x-layout-dashboard>
