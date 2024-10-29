<x-layout-dashboard>
    <div class="flex justify-center mt-20">
        <div id="map" style="height: 60vh"
            class="w-full max-w-md md:max-w-xl  bg-nord0 rounded-lg shadow-lg border-4 border-nord1 dark:border-nord5 dark:bg-nord4">
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $.getJSON('http://localhost/gis/public/dashboard/webgis/json', function(data) {
                $.each(data, function(index) {
                    L.marker([data[index].lat, data[index].long]).addTo(map).bindPopup(data[index]
                        .name);
                })
            })
        })
    </script>
</x-layout-dashboard>
