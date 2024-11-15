<x-layout-homepage>
    <div class="relative h-screen hidden md:block">
        <img src="{{ asset('assets/images/home.jpg') }}" alt="Cityscape"
            class="absolute inset-0 w-full h-full object-cover object-right md:object-left lg:object-cover lg:object-center">
    </div>
    <div
        class="md:hidden container mx-auto flex flex-col items-center justify-center h-screen text-center bg-gradient-to-br from-yellow-400 via-amber-200 to-yellow-400">
        <h1 class="text-3xl md:text-5xl font-bold text-white mb-4">Selamat Datang di SiMeja</h1>
        <p class="text-base md:text-lg text-white mb-8">Your Gateway to Urban Living</p>
        <a href="#pengaduan" class="bg-white text-black font-bold py-3 px-6 rounded-full hover:bg-gray-200">
            Laporkan Kerusakan Jalan
        </a>
    </div>

    <div class="relative -mt-12 lg:-mt-24">
        <svg viewBox="0 0 1428 174" version="1.1" xmlns="http://www.w3.org/2000/svg"
            xmlns:xlink="http://www.w3.org/1999/xlink">
            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                <g transform="translate(-2.000000, 44.000000)" fill="#FFFFFF" fill-rule="nonzero">
                    <path
                        d="M0,0 C90.7283404,0.927527913 147.912752,27.187927 291.910178,59.9119003 C387.908462,81.7278826 543.605069,89.334785 759,82.7326078 C469.336065,156.254352 216.336065,153.6679 0,74.9732496"
                        opacity="0.100000001"></path>
                    <path
                        d="M100,104.708498 C277.413333,72.2345949 426.147877,52.5246657 546.203633,45.5787101 C666.259389,38.6327546 810.524845,41.7979068 979,55.0741668 C931.069965,56.122511 810.303266,74.8455141 616.699903,111.243176 C423.096539,147.640838 250.863238,145.462612 100,104.708498 Z"
                        opacity="0.100000001"></path>
                    <path
                        d="M1046,51.6521276 C1130.83045,29.328812 1279.08318,17.607883 1439,40.1656806 L1439,120 C1271.17211,77.9435312 1140.17211,55.1609071 1046,51.6521276 Z"
                        id="Path-4" opacity="0.200000003"></path>
                </g>
                <g transform="translate(-4.000000, 76.000000)" fill="#FFFFFF" fill-rule="nonzero">
                    <path
                        d="M0.457,34.035 C57.086,53.198 98.208,65.809 123.822,71.865 C181.454,85.495 234.295,90.29 272.033,93.459 C311.355,96.759 396.635,95.801 461.025,91.663 C486.76,90.01 518.727,86.372 556.926,80.752 C595.747,74.596 622.372,70.008 636.799,66.991 C663.913,61.324 712.501,49.503 727.605,46.128 C780.47,34.317 818.839,22.532 856.324,15.904 C922.689,4.169 955.676,2.522 1011.185,0.432 C1060.705,1.477 1097.39,3.129 1121.236,5.387 C1161.703,9.219 1208.621,17.821 1235.4,22.304 C1285.855,30.748 1354.351,47.432 1440.886,72.354 L1441.191,104.352 L1.121,104.031 L0.457,34.035 Z">
                    </path>
                </g>
            </g>
        </svg>
    </div>
    <section class="bg-white border-b py-8">
        <div id="pengaduan" class="flex flex-col items-center container max-w-5xl mx-auto m-8">
            <h1 class="w-full my-2 text-5xl font-bold leading-tight text-center text-nord0">
                Pengaduan Masyarakat
            </h1>
            <div class="w-full mb-4">
                <div class="h-1 mx-auto gradient w-3/6 opacity-25 my-0 py-0 rounded-t"></div>
            </div>
            <div><button
                    class="bg-nord0 text-nord6 font-bold rounded-full my-6 py-4 px-8 shadow-lg focus:outline-none focus:shadow-outline transform transition hover:scale-105 duration-300 ease-in-out"
                    id="find-my-location">Temukan saya</button></div>
        </div>
        <form action="{{ route('aspirasi.store') }}" method="POST" class="w-full mx-auto max-w-5xl"
            enctype="multipart/form-data">
            @csrf
            <div class="flex flex-wrap md:flex-nowrap gap-6">
                <div class="mx-16 lg:mx-1 w-full ">
                    <div id="map" class="w-full rounded-lg"></div>
                    <img id="preview-image" class="z-10 mt-5 sm:mt-28 mx-auto rounded-lg"
                        src="{{ asset('assets/images/no_image.jpg') }} " alt="">
                </div>
                <div class="mx-16 lg:mx-1 w-full">
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                for="nik">
                                ID/NIK
                            </label>
                            <input
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                id="nik" type="text" name="nik" value="{{ old('nik') }}">
                            @error('nik')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="w-full md:w-1/2 px-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                for="name">
                                Nama lengkap
                            </label>
                            <input
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                id="name" type="text" name="name" value="{{ old('name') }}">
                            @error('name')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                for="email">
                                Email
                            </label>
                            <input
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                id="email" type="email" name="email" value="{{ old('email') }}">
                            @error('email')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                for="phone">
                                No. Hp
                            </label>
                            <input
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                id="phone" type="text" name="phone" value="{{ old('phone') }}">
                            @error('phone')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="w-full md:w-1/2 px-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                for="address">
                                Alamat
                            </label>
                            <input
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                id="address" type="text" name="address" value="{{ old('address') }}">
                            @error('address')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                for="lat">
                                Latitude
                            </label>
                            <input
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                id="lat" type="text" name="lat" value="{{ old('lat') }}" readonly>
                            @error('lat')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="w-full md:w-1/2 px-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                for="long">
                                Longitude
                            </label>
                            <input
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                id="long" type="text" name="long" value="{{ old('long') }}" readonly>
                            @error('long')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                for="aspirasi">
                                Aspirasi
                            </label>
                            <textarea
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                id="aspirasi" name="aspirasi">{{ old('aspirasi') }}</textarea>
                            @error('aspirasi')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="w-full py-9 bg-nord6 rounded-2xl border border-gray-300 gap-3 grid border-dashed">
                        <div class="grid gap-1">
                            <svg class="mx-auto" width="40" height="40" viewBox="0 0 40 40" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <g id="File">
                                    <path id="icon"
                                        d="M31.6497 10.6056L32.2476 10.0741L31.6497 10.6056ZM28.6559 7.23757L28.058 7.76907L28.058 7.76907L28.6559 7.23757ZM26.5356 5.29253L26.2079 6.02233L26.2079 6.02233L26.5356 5.29253ZM33.1161 12.5827L32.3683 12.867V12.867L33.1161 12.5827ZM31.8692 33.5355L32.4349 34.1012L31.8692 33.5355ZM24.231 11.4836L25.0157 11.3276L24.231 11.4836ZM26.85 14.1026L26.694 14.8872L26.85 14.1026ZM11.667 20.8667C11.2252 20.8667 10.867 21.2248 10.867 21.6667C10.867 22.1085 11.2252 22.4667 11.667 22.4667V20.8667ZM25.0003 22.4667C25.4422 22.4667 25.8003 22.1085 25.8003 21.6667C25.8003 21.2248 25.4422 20.8667 25.0003 20.8667V22.4667ZM11.667 25.8667C11.2252 25.8667 10.867 26.2248 10.867 26.6667C10.867 27.1085 11.2252 27.4667 11.667 27.4667V25.8667ZM20.0003 27.4667C20.4422 27.4667 20.8003 27.1085 20.8003 26.6667C20.8003 26.2248 20.4422 25.8667 20.0003 25.8667V27.4667ZM23.3337 34.2H16.667V35.8H23.3337V34.2ZM7.46699 25V15H5.86699V25H7.46699ZM32.5337 15.0347V25H34.1337V15.0347H32.5337ZM16.667 5.8H23.6732V4.2H16.667V5.8ZM23.6732 5.8C25.2185 5.8 25.7493 5.81639 26.2079 6.02233L26.8633 4.56274C26.0191 4.18361 25.0759 4.2 23.6732 4.2V5.8ZM29.2539 6.70608C28.322 5.65771 27.7076 4.94187 26.8633 4.56274L26.2079 6.02233C26.6665 6.22826 27.0314 6.6141 28.058 7.76907L29.2539 6.70608ZM34.1337 15.0347C34.1337 13.8411 34.1458 13.0399 33.8638 12.2984L32.3683 12.867C32.5216 13.2702 32.5337 13.7221 32.5337 15.0347H34.1337ZM31.0518 11.1371C31.9238 12.1181 32.215 12.4639 32.3683 12.867L33.8638 12.2984C33.5819 11.5569 33.0406 10.9662 32.2476 10.0741L31.0518 11.1371ZM16.667 34.2C14.2874 34.2 12.5831 34.1983 11.2872 34.0241C10.0144 33.8529 9.25596 33.5287 8.69714 32.9698L7.56577 34.1012C8.47142 35.0069 9.62375 35.4148 11.074 35.6098C12.5013 35.8017 14.3326 35.8 16.667 35.8V34.2ZM5.86699 25C5.86699 27.3344 5.86529 29.1657 6.05718 30.593C6.25217 32.0432 6.66012 33.1956 7.56577 34.1012L8.69714 32.9698C8.13833 32.411 7.81405 31.6526 7.64292 30.3798C7.46869 29.0839 7.46699 27.3796 7.46699 25H5.86699ZM23.3337 35.8C25.6681 35.8 27.4993 35.8017 28.9266 35.6098C30.3769 35.4148 31.5292 35.0069 32.4349 34.1012L31.3035 32.9698C30.7447 33.5287 29.9863 33.8529 28.7134 34.0241C27.4175 34.1983 25.7133 34.2 23.3337 34.2V35.8ZM32.5337 25C32.5337 27.3796 32.532 29.0839 32.3577 30.3798C32.1866 31.6526 31.8623 32.411 31.3035 32.9698L32.4349 34.1012C33.3405 33.1956 33.7485 32.0432 33.9435 30.593C34.1354 29.1657 34.1337 27.3344 34.1337 25H32.5337ZM7.46699 15C7.46699 12.6204 7.46869 10.9161 7.64292 9.62024C7.81405 8.34738 8.13833 7.58897 8.69714 7.03015L7.56577 5.89878C6.66012 6.80443 6.25217 7.95676 6.05718 9.40704C5.86529 10.8343 5.86699 12.6656 5.86699 15H7.46699ZM16.667 4.2C14.3326 4.2 12.5013 4.1983 11.074 4.39019C9.62375 4.58518 8.47142 4.99313 7.56577 5.89878L8.69714 7.03015C9.25596 6.47133 10.0144 6.14706 11.2872 5.97592C12.5831 5.8017 14.2874 5.8 16.667 5.8V4.2ZM23.367 5V10H24.967V5H23.367ZM28.3337 14.9667H33.3337V13.3667H28.3337V14.9667ZM23.367 10C23.367 10.7361 23.3631 11.221 23.4464 11.6397L25.0157 11.3276C24.9709 11.1023 24.967 10.8128 24.967 10H23.367ZM28.3337 13.3667C27.5209 13.3667 27.2313 13.3628 27.0061 13.318L26.694 14.8872C27.1127 14.9705 27.5976 14.9667 28.3337 14.9667V13.3667ZM23.4464 11.6397C23.7726 13.2794 25.0543 14.5611 26.694 14.8872L27.0061 13.318C26.0011 13.1181 25.2156 12.3325 25.0157 11.3276L23.4464 11.6397ZM11.667 22.4667H25.0003V20.8667H11.667V22.4667ZM11.667 27.4667H20.0003V25.8667H11.667V27.4667ZM32.2476 10.0741L29.2539 6.70608L28.058 7.76907L31.0518 11.1371L32.2476 10.0741Z"
                                        fill="#2e3440" />
                                </g>
                            </svg>
                            <h2 class="text-center text-gray-400   text-xs leading-4">PNG, JPG or JPEG, smaller than
                                2MB</h2>
                        </div>
                        <div class="grid gap-2">
                            <h4 class="text-center text-gray-900 text-sm font-medium leading-snug">Drag and Drop your
                                file here or</h4>
                            <div class="flex items-center justify-center">
                                <label>
                                    <input type="file" hidden name="image" accept="image/*" id="image" />
                                    <div
                                        class="flex w-28 h-9 px-2 flex-col bg-nord0 rounded-full shadow text-nord6 text-xs font-semibold leading-4 items-center justify-center cursor-pointer focus:outline-none">
                                        Choose File</div>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex justify-center mt-5">
                <button
                    class="bg-nord0 text-nord6 font-bold rounded-full my-auto py-4 px-8 shadow-lg focus:outline-none focus:shadow-outline transform transition hover:scale-105 duration-300 ease-in-out mx-auto">
                    Submit
                </button>
            </div>
        </form>

    </section>

    <!-- Change the colour #f8fafc to match the previous section colour -->
    <svg class="wave-top" viewBox="0 0 1439 147" version="1.1" xmlns="http://www.w3.org/2000/svg"
        xmlns:xlink="http://www.w3.org/1999/xlink">
        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
            <g transform="translate(-1.000000, -14.000000)" fill-rule="nonzero">
                <g class="wave" fill="#f8fafc">
                    <path
                        d="M1440,84 C1383.555,64.3 1342.555,51.3 1317,45 C1259.5,30.824 1206.707,25.526 1169,22 C1129.711,18.326 1044.426,18.475 980,22 C954.25,23.409 922.25,26.742 884,32 C845.122,37.787 818.455,42.121 804,45 C776.833,50.41 728.136,61.77 713,65 C660.023,76.309 621.544,87.729 584,94 C517.525,105.104 484.525,106.438 429,108 C379.49,106.484 342.823,104.484 319,102 C278.571,97.783 231.737,88.736 205,84 C154.629,75.076 86.296,57.743 0,32 L0,0 L1440,0 L1440,84 Z">
                    </path>
                </g>
                <g transform="translate(1.000000, 15.000000)" fill="#FFFFFF">
                    <g
                        transform="translate(719.500000, 68.500000) rotate(-180.000000) translate(-719.500000, -68.500000) ">
                        <path
                            d="M0,0 C90.7283404,0.927527913 147.912752,27.187927 291.910178,59.9119003 C387.908462,81.7278826 543.605069,89.334785 759,82.7326078 C469.336065,156.254352 216.336065,153.6679 0,74.9732496"
                            opacity="0.100000001"></path>
                        <path
                            d="M100,104.708498 C277.413333,72.2345949 426.147877,52.5246657 546.203633,45.5787101 C666.259389,38.6327546 810.524845,41.7979068 979,55.0741668 C931.069965,56.122511 810.303266,74.8455141 616.699903,111.243176 C423.096539,147.640838 250.863238,145.462612 100,104.708498 Z"
                            opacity="0.100000001"></path>
                        <path
                            d="M1046,51.6521276 C1130.83045,29.328812 1279.08318,17.607883 1439,40.1656806 L1439,120 C1271.17211,77.9435312 1140.17211,55.1609071 1046,51.6521276 Z"
                            opacity="0.200000003"></path>
                    </g>
                </g>
            </g>
        </g>
    </svg>
    <section class="container mx-auto text-center py-6 mb-12">
        <h1 class="w-full my-2 text-5xl font-bold leading-tight text-center text-nord6">
            Jelajahi Kota Palu dan Laporkan Masalah Infrastruktur
        </h1>
        <div class="w-full mb-4">
            <div class="h-1 mx-auto bg-nord4 w-1/6 opacity-25 my-0 py-0 rounded-t"></div>
        </div>
        <h3 class="my-4 text-3xl leading-tight">
            Temukan peta interaktif kota Palu, pantau kondisi jalan, dan kirimkan laporan terkait perbaikan yang
            dibutuhkan.
        </h3>
        <button
            class="mx-auto lg:mx-0 hover:underline bg-nord4 text-nord0 font-bold rounded-full my-6 py-4 px-8 shadow-lg focus:outline-none focus:shadow-outline transform transition hover:scale-105 duration-300 ease-in-out">
            <a href="{{ url('/webgis') }}">Jelajahi Kota Palu dan Laporkan Masalah</a>
        </button>
    </section>
    <script>
        let latitude = -0.9029821741503987, // Default latitude
            longitude = 119.85871178991329; // Default longitude
        let map, marker; // Declare map and marker globally

        // Initialize the map with default coordinates
        function initMap() {
            map = L.map("map").setView([latitude, longitude], 13); // Set zoom level

            // Add Google streets layer to the map
            let googleStreets = L.tileLayer(
                "https://tile.openstreetmap.org/{z}/{x}/{y}.png", {
                    maxZoom: 20,
                    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
                }
            );
            googleStreets.addTo(map);

            // Add draggable marker for the default location
            marker = L.marker([latitude, longitude], {
                    draggable: true
                })
                .addTo(map)
                .bindPopup(`Latitude: ${latitude}, Longitude: ${longitude}`) // Set initial popup content
                .openPopup();

            // Event listener to update latitude and longitude on marker drag
            marker.on("dragend", function(e) {
                const position = marker.getLatLng(); // Get new marker position
                latitude = position.lat; // Update latitude
                longitude = position.lng; // Update longitude

                // Update the latitude and longitude input fields
                document.querySelector("#lat").value = latitude;
                document.querySelector("#long").value = longitude;

                // Update the popup with new latitude and longitude
                marker
                    .getPopup()
                    .setContent(
                        `Latitude: ${latitude.toFixed(
                    6
                )}, Longitude: ${longitude.toFixed(6)}`
                    ) // Update popup content
                    .openOn(map); // Reopen the updated popup
            });

            // Initialize input fields with default values
            document.querySelector("#lat").value = latitude;
            document.querySelector("#long").value = longitude;
        }

        // Geolocation function to update the map and marker based on user's location
        const findMyLocation = () => {
            const success = (position) => {
                latitude = position.coords.latitude;
                longitude = position.coords.longitude;

                if (map !== undefined) {
                    map.remove(); // Remove the existing map instance
                }

                // Reinitialize the map with the new location
                map = L.map("map").setView([latitude, longitude], 18);
                let googleStreets = L.tileLayer(
                    "https://tile.openstreetmap.org/{z}/{x}/{y}.png", {
                        maxZoom: 20,
                        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
                    }
                );
                googleStreets.addTo(map);

                // Add draggable marker for the new location
                marker = L.marker([latitude, longitude], {
                        draggable: true
                    })
                    .addTo(map)
                    .bindPopup(
                        `Latitude: ${latitude.toFixed(
                    6
                )}, Longitude: ${longitude.toFixed(6)}`
                    )
                    .openPopup();

                // Add dragend event listener to update lat/lng and popup when marker is dragged
                marker.on("dragend", function(e) {
                    const position = marker.getLatLng(); // Get new marker position
                    latitude = position.lat; // Update latitude
                    longitude = position.lng; // Update longitude

                    // Update the latitude and longitude input fields
                    document.querySelector("#lat").value = latitude;
                    document.querySelector("#long").value = longitude;

                    // Update the popup with new latitude and longitude
                    marker
                        .getPopup()
                        .setContent(
                            `Latitude: ${latitude.toFixed(
                        6
                    )}, Longitude: ${longitude.toFixed(6)}`
                        )
                        .openOn(map); // Reopen the updated popup
                });

                // Update the latitude and longitude input fields
                document.querySelector("#lat").value = latitude;
                document.querySelector("#long").value = longitude;
            };

            const error = (err) => {
                console.log(err);
            };

            // Trigger geolocation lookup
            navigator.geolocation.getCurrentPosition(success, error);
        };

        // Initialize the map with default coordinates when the page loads
        initMap();

        // Add event listener for "Find My Location" button
        document
            .querySelector("#find-my-location")
            .addEventListener("click", findMyLocation);
    </script>
    <script>
        const fileInput = document.getElementById("image");
        const previewImage = document.getElementById("preview-image");
        fileInput.addEventListener("change", function(e) {
            const file = e.target.files[0]; // Get the uploaded file
            if (file) {
                const reader = new FileReader();

                reader.onload = function(event) {
                    previewImage.src = event.target.result; // Set the image preview src
                };
                reader.readAsDataURL(file); // Read the file as a data URL
            }
        });
    </script>
</x-layout-homepage>
