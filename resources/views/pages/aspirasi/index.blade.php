<x-layout-dashboard>
    <div class="mx-auto min-h-[120vh] px-4 py-6 sm:px-6 lg:px-8">
        <div class="rounded-2xl">
            <!--Container-->
            <div class="container w-full max-w-full mx-auto px-2">
                <!--Title-->
                <h1
                    class="flex items-center font-sans font-bold break-normal text-nord0 dark:text-nord6 px-2 py-2 text-xl md:text-2xl">
                    Aspirasi
                </h1>
                <!--Card-->
                <div id='recipients'
                    class="p-8 mt-6 lg:mt-0 rounded shadow bg-nord4 dark:bg-nord3 text-nord0 dark:text-nord6">
                    <table id="example" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                        <thead>
                            <tr>
                                <th data-priority="1">NIK</th>
                                <th data-priority="2">Nama</th>
                                <th data-priority="3">Alamat</th>
                                <th data-priority="4">Status</th>
                                <th data-priority="5">Waktu</th>
                            </tr>
                        </thead>
                        <tbody class="">
                            @foreach ($datas as $data)
                                <tr class="text-center">
                                    <td class="bg-nord4 dark:bg-nord3 text-nord0 dark:text-nord6">
                                        <a href="{{ route('complain.show', $data->id) }}" class="text-nord14">
                                            {{ $data->nik }}</a>
                                    </td>
                                    <td class="bg-nord4 dark:bg-nord3 text-nord0 dark:text-nord6">
                                        {{ $data->name }}
                                    </td>
                                    <td class="bg-nord4 dark:bg-nord3 text-nord0 dark:text-nord6">
                                        {{ $data->address }}
                                    </td>
                                    <td class="bg-nord4 dark:bg-nord3 text-nord0 dark:text-nord6">
                                        @if ($data->status == 'Pending')
                                            <span class="bg-nord16 font-bold rounded-md p-2 text-nord0 ">Pending</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>


                </div>
            </div>
            <!--/container-->
        </div>
    </div>
    <script>
        map = L.map("map").setView([-0.8898015139606371, 119.85738857328762], 13); // Set zoom level

        // Add Google streets layer to the map
        let googleStreets = L.tileLayer(
            "http://{s}.google.com/vt?lyrs=m&x={x}&y={y}&z={z}", {
                maxZoom: 20,
                subdomains: ["mt0", "mt1", "mt2", "mt3"],
            }
        );
        googleStreets.addTo(map);
    </script>
</x-layout-dashboard>
