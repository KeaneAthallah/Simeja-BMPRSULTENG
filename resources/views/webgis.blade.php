<x-layout-homepage>
    <script src="{{ asset('output/JP_Sulteng_2023.js') }}"></script>
    <script src="{{ asset('output/simpul_JPSulteng_fix.js') }}"></script>
    <div class="mt-20 flex flex-col items-center bg-nord4 rounded-lg w-full">
        <div id="map" style="height: 80vh; width: 100%"
            class="relative w-full max-w-md md:max-w-xl lg:max-w-7xl bg-nord0 rounded-lg shadow-lg border-4 border-nord1 dark:border-nord5 dark:bg-nord4 my-4">
        </div>
    </div>
    <script>
        // Initialize the map
        var map = L.map('map').setView([-0.9029821741503987, 119.85871178991329], 12);

        // Add OpenStreetMap tiles
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);
        var url = "{{ url('/') }}";
        // Define custom icons
        var simpulIcon = L.icon({
            iconUrl: `https://simeja-bmprsulteng.com/icons/marker.png`, // Replace with the path to your custom simpul icon
            iconSize: [25, 25], // Adjust size as needed
            iconAnchor: [12, 41],
            popupAnchor: [0, -41]
        });

        var complaintIconNew = L.icon({
            iconUrl: `https://simeja-bmprsulteng.com/icons/red.png`, // Replace with the path to your custom complaint icon
            iconSize: [25, 25], // Adjust size as needed
            iconAnchor: [12, 41],
            popupAnchor: [0, -41]
        });
        var complaintIconPending = L.icon({
            iconUrl: `https://simeja-bmprsulteng.com/icons/blue.png`, // Replace with the path to your custom complaint icon
            iconSize: [25, 25], // Adjust size as needed
            iconAnchor: [12, 41],
            popupAnchor: [0, -41]
        });
        var complaintIconCompleted = L.icon({
            iconUrl: `https://simeja-bmprsulteng.com/icons/green.png`, // Replace with the path to your custom complaint icon
            iconSize: [25, 25], // Adjust size as needed
            iconAnchor: [12, 41],
            popupAnchor: [0, -41]
        });

        // Add GeoJSON data for jp if necessary
        L.geoJSON(jp).addTo(map);

        // Loop through simpul features and add markers with simpulIcon
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

            L.marker(coords, {
                    icon: simpulIcon
                })
                .addTo(map)
                .bindPopup(popupContent);
        });


        // Fetch complaint data from the server and add markers with complaintIcon
        fetch(`${url}/webgis/map-data`)
            .then(response => response.json())
            .then(data => {
                data.forEach(item => {
                    console.log(item);

                    var marker = L.marker([item.lat, item.long], {
                        icon: (item.status === 'Pending') ? complaintIconNew : (item.status ===
                            'Completed') ? complaintIconCompleted : complaintIconPending
                    }).addTo(map);
                    marker.bindPopup(
                        `<div style="border: 2px solid #ddd; padding: 20px; border-radius: 10px; background-color: #f3f3f3; font-family: Arial, sans-serif;">
    <h3 style="color: #2980b9; font-size: 22px; margin-top: 0;">${item.name}</h3>
    <p style="font-size: 16px; color: #34495e; line-height: 1.6; margin-bottom: 10px;">
        <strong>Alamat:</strong> ${item.address}<br>
        <strong>Status:</strong> <span style="color: #e74c3c;">${item.status}</span><br>
        <strong>Aspirasi:</strong> ${item.description}
    </p>
    <div style="margin-top: 15px; text-align: center;">
        <img src="${url}/storage/${item.image}" alt="Complain Image" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
    </div>
</div>`
                    );
                });
            })
            .catch(error => console.error('Error fetching map data:', error));
    </script>


    </body>
</x-layout-homepage>
