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
            // Initialize the map
            map = L.map('map').setView([-0.9019336055045014, 119.86625407936758], 12);

            // Add a tile layer
            L.tileLayer("https://tile.openstreetmap.org/{z}/{x}/{y}.png", {
                maxZoom: 20,
                attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
            }).addTo(map);
            L.geoJSON(jp).addTo(map);
            // L.geoJSON(simpul).addTo(map);

            // Fetch and display markers
            $.getJSON('https://simeja-bmprsulteng.com/dashboard/webgis/json', function(data) {
                $.each(data, function(index) {
                    // Create a custom icon with an image
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

                    // Set color class and display text based on status
                    let statusColorClass;
                    let statusText;
                    if (data[index].status === 'Pending') {
                        statusColorClass = 'text-red-500';
                        statusText = 'Baru';
                    } else if (data[index].status === 'On Progress') {
                        statusColorClass = 'text-blue-500';
                        statusText = 'Dalam pengerjaan';
                    } else {
                        statusColorClass = 'text-green-500';
                        statusText = 'Selesai';
                    }
                    // Function to format the created_at date
                    function formatDate(dateString) {
                        const date = new Date(dateString);
                        const options = {
                            year: 'numeric',
                            month: 'long',
                            day: 'numeric'
                        };
                        return date.toLocaleDateString(undefined, options); // "January 1, 2024"
                    }

                    // Example usage in popup content
                    const formattedDate = formatDate(data[index].created_at);

                    // Prepare popup content with translated status
                    const popupContent = `
                            <div class="max-w-sm rounded-lg overflow-hidden bg-white ">
                                <img class="w-full h-48 object-cover" src="http://simeja-bmprsulteng.com/storage/${data[index].image}" alt="Foto Kerusakan">
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
                                        <span class="text-gray-600">${data[index].name}</span>
                                    </div>

                                    <div class="mb-2 flex flex-col">
                                        <span class="font-semibold text-gray-800">Alamat:</span>
                                        <span class="text-gray-600">${data[index].address}</span>
                                    </div>

                                    <div class="mb-2 flex flex-col">
                                        <span class="font-semibold text-gray-800">Aspirasi:</span>
                                        <span class="text-gray-600">${data[index].aspirasi}</span>
                                    </div>
                                      <div class="mb-2 flex flex-col">
                                        <span class="font-semibold text-gray-800">Tanggal:</span>
                                        <span class="text-gray-600">${formattedDate}</span>
                                    </div>
                                </div>
                            </div>

    `;

                    // Select icon based on status
                    const icon = data[index].status === 'Pending' ? customIconRed :
                        data[index].status === 'On Progress' ? customIconBlue : customIconGreen;

                    // Add marker with full data in popup
                    const marker = L.marker([data[index].lat, data[index].long], {
                            icon: icon
                        })
                        .bindPopup(popupContent)
                        .on('click', function() {
                            // Display details in the note card when a marker is clicked
                            $('#noteDetails').text(
                                `Name: ${data[index].name}, Status: ${statusText}`);
                        }).addTo(map);

                    markers.push({
                        marker: marker,
                        status: data[index].status
                    });
                });

            });
        });
    </script>
</x-layout-dashboard>
