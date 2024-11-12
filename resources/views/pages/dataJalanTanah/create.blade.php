<x-layout-dashboard>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="mx-auto min-h-[120vh] px-4 py-6 sm:px-6 lg:px-8">
        <div class="rounded-2xl">
            <!--Container-->
            <div class="container w-full max-w-full mx-auto px-2">
                <!--Title-->
                <h1
                    class="flex items-center font-sans font-bold break-normal text-nord0 dark:text-nord6 px-2 py-2 text-xl md:text-2xl">
                    FORMULIR SURVEI KONDISI JALAN TANAH/KERIKIL PER-100 METER
                </h1>
                @if ($errors->any())
                    <div class="flex p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                        role="alert">
                        <svg class="flex-shrink-0 inline w-4 h-4 me-3 mt-[2px]" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                        </svg>
                        <span class="sr-only">Danger</span>
                        <div>
                            <span class="font-medium">Pastikan bahwa persyaratan ini terpenuhi:</span>
                            <ul class="mt-1.5 list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif
                <!--Card-->
                <div id='recipients'
                    class="p-8 mt-6 lg:mt-0 rounded shadow bg-nord4 dark:bg-nord3 text-nord0 dark:text-nord6">
                    <form action="{{ route('dataJalanTanah.store') }}" method="post">
                        @csrf
                        <div class="grid gap-6 mb-6 md:grid-cols-2">
                            <div>
                                <label for="dariPatok"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Dari Patok
                                    Sta</label>
                                <input type="text" id="dariPatok" name="dariPatok"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="0+000" value="{{ old('dariPatok') }}" />
                            </div>
                            <div>
                                <label for="soils_street_id"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Survey Jalan
                                    Tanah / Kerikil</label>
                                <select id="soils_street_id" name="soils_street_id"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="" disabled selected>Pilih Jalan Tanah / Kerikil</option>
                                    @foreach ($jalanTanahs as $street)
                                        <option value="{{ $street->id }}"
                                            {{ old('soils_street_id') == $street->id ? 'selected' : '' }}>
                                            {{ $street->noRuas }} - {{ $street->namaRuas }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="kePatok"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ke Patok
                                    Sta</label>
                                <input type="text" id="kePatok" name="kePatok"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="0+100" value="{{ old('kePatok') }}" />
                            </div>
                            <div class="mb-4">
                                <label for="koordinat"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Koordinat
                                </label>
                                <textarea id="koordinat" name="koordinat"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder='Example: [[119.843909, -0.889369], [119.843519, -0.890182]]'>{{ old('koordinat') }}</textarea>
                                <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">
                                    Enter coordinates in JSON format as a single line:
                                    <span class="font-mono">[[longitude, latitude], [longitude, latitude]]</span>.
                                    Click <a href="https://geojson.io/#map=11.42/-0.9171/119.8803" target="_blank"
                                        rel="noopener noreferrer" class="text-blue-700 dark:text-blue-200">here</a> to
                                    get coordinates.
                                </p>
                            </div>
                            <div>
                                <label for="image"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Gambar
                                </label>
                                <input type="file" id="image" name="image"
                                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                    placeholder="0+100" value="{{ old('image') }}" />
                            </div>
                            <div>
                                <label for="preview-image"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Preview Gambar
                                </label>
                                <img id="preview-image" class="rounded-lg"
                                    src="{{ asset('assets/images/no_image.jpg') }} " alt="">
                            </div>
                        </div>
                        <div class="grid gap-6 mb-6 md:grid-cols-4">
                            <div class="border  border-black dark:border-white rounded-md p-6">
                                <h2
                                    class="text-lg h-16 content-center font-semibold text-center mb-6 text-gray-900 dark:text-white border-b border-black dark:border-white">
                                    Permukaan Pengkerasaan</h2>
                                <div class="grid gap-6 mb-6 md:grid-cols-1">
                                    <div
                                        class="border border-black dark:border-white flex items-center flex-col p-3 rounded-md">
                                        <h3
                                            class="mb-4 font-semibold text-gray-900 dark:text-white border-b border-black dark:border-white w-full text-center">
                                            Kemiringan Melintang</h3>
                                        <ul
                                            class=" w-full h-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                            <li
                                                class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                                                <div class="flex items-center ps-3">
                                                    <input id="baik/rapat" type="radio" value="1"
                                                        {{ old('kemiringan') == '1' ? 'checked' : '' }}
                                                        name="kemiringan"
                                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                    <label for="baik/rapat"
                                                        class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">>
                                                        5%</label>
                                                </div>
                                            </li>
                                            <li
                                                class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                                                <div class="flex items-center ps-3">
                                                    <input id="rusakPengkerasan" type="radio" value="2"
                                                        {{ old('kemiringan') == '2' ? 'checked' : '' }}
                                                        name="kemiringan"
                                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                    <label for="rusakPengkerasan"
                                                        class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">3
                                                        - 5%</label>
                                                </div>
                                            </li>
                                            <li
                                                class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                                                <div class="flex items-center ps-3">
                                                    <input id="rusakPengkerasan" type="radio" value="2"
                                                        {{ old('kemiringan') == '3' ? 'checked' : '' }}
                                                        name="kemiringan"
                                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                    <label for="rusakPengkerasan"
                                                        class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Rata</label>
                                                </div>
                                            </li>
                                            <li
                                                class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                                                <div class="flex items-center ps-3">
                                                    <input id="rusakPengkerasan" type="radio" value="2"
                                                        {{ old('kemiringan') == '4' ? 'checked' : '' }}
                                                        name="kemiringan"
                                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                    <label for="rusakPengkerasan"
                                                        class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Cekung</label>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <div
                                        class="border border-black dark:border-white flex items-center flex-col p-3 rounded-md">
                                        <h3
                                            class="mb-4 font-semibold text-gray-900 dark:text-white border-b border-black dark:border-white w-full text-center">
                                            % Penurunan</h3>
                                        <ul
                                            class="w-full h-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                            <li
                                                class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                                                <div class="flex items-center ps-3">
                                                    <input id="vue-checkbox" type="radio" value="1"
                                                        {{ old('penurunan') == '1' ? 'checked' : '' }}
                                                        name="penurunan"
                                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                    <label for="vue-checkbox"
                                                        class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Tidak
                                                        ada</label>
                                                </div>
                                            </li>
                                            <li
                                                class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                                                <div class="flex items-center ps-3">
                                                    <input id="react-checkbox" type="radio" value="2"
                                                        {{ old('penurunan') == '2' ? 'checked' : '' }}
                                                        name="penurunan"
                                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                    <label for="react-checkbox"
                                                        class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                                        < 10% luas</label>
                                                </div>
                                            </li>
                                            <li
                                                class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                                                <div class="flex items-center ps-3">
                                                    <input id="angular-checkbox" type="radio" value="3"
                                                        {{ old('penurunan') == '3' ? 'checked' : '' }}
                                                        name="penurunan"
                                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                    <label for="angular-checkbox"
                                                        class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">10
                                                        - 30% luas</label>
                                                </div>
                                            </li>
                                            <li
                                                class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                                                <div class="flex items-center ps-3">
                                                    <input id="laravel-checkbox" type="radio" value="4"
                                                        {{ old('penurunan') == '4' ? 'checked' : '' }}
                                                        name="penurunan"
                                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                    <label for="laravel-checkbox"
                                                        class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">>
                                                        30% luas</label>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <div
                                        class="border border-black dark:border-white flex items-center flex-col p-3 rounded-md">
                                        <h3
                                            class="mb-4 font-semibold text-gray-900 dark:text-white border-b border-black dark:border-white w-full text-center">
                                            Erosi Permukaan
                                        </h3>
                                        <ul
                                            class="w-full h-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                            <li
                                                class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                                                <div class="flex items-center ps-3">
                                                    <input id="vue-checkbox" type="radio" value="1"
                                                        {{ old('erosi') == '1' ? 'checked' : '' }} name="erosi"
                                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                    <label for="vue-checkbox"
                                                        class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Tidak
                                                        ada</label>
                                                </div>
                                            </li>
                                            <li
                                                class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                                                <div class="flex items-center ps-3">
                                                    <input id="react-checkbox" type="radio" value="2"
                                                        {{ old('erosi') == '2' ? 'checked' : '' }} name="erosi"
                                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                    <label for="react-checkbox"
                                                        class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                                        < 10% luas</label>
                                                </div>
                                            </li>
                                            <li
                                                class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                                                <div class="flex items-center ps-3">
                                                    <input id="angular-checkbox" type="radio" value="3"
                                                        {{ old('erosi') == '3' ? 'checked' : '' }} name="erosi"
                                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                    <label for="angular-checkbox"
                                                        class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">10
                                                        - 30% luas</label>
                                                </div>
                                            </li>
                                            <li
                                                class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                                                <div class="flex items-center ps-3">
                                                    <input id="laravel-checkbox" type="radio" value="4"
                                                        {{ old('erosi') == '4' ? 'checked' : '' }} name="erosi"
                                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                    <label for="laravel-checkbox"
                                                        class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">>
                                                        30% luas</label>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="border border-black dark:border-white rounded-md p-6">
                                <h2
                                    class="text-lg  h-16 content-center font-semibold text-center mb-6 text-gray-900 dark:text-white border-b border-black dark:border-white">
                                    Kerikil / Batu</h2>
                                <div class="grid gap-6 mb-6 md:grid-cols-1">
                                    <div
                                        class="border border-black dark:border-white flex items-center flex-col p-3 rounded-md">
                                        <h3
                                            class="mb-4 font-semibold text-gray-900 dark:text-white border-b border-black dark:border-white w-full text-center">
                                            Ukuran Terbanyak</h3>
                                        <ul
                                            class="w-full h-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                            <li
                                                class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                                                <div class="flex items-center ps-3">
                                                    <input id="vue-checkbox" type="radio" value="1"
                                                        {{ old('ukuranTerbanyak') == '1' ? 'checked' : '' }}
                                                        name="ukuranTerbanyak"
                                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                    <label for="vue-checkbox"
                                                        class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Tidak
                                                        ada</label>
                                                </div>
                                            </li>
                                            <li
                                                class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                                                <div class="flex items-center ps-3">
                                                    <input id="react-checkbox" type="radio" value="2"
                                                        {{ old('ukuranTerbanyak') == '2' ? 'checked' : '' }}
                                                        name="ukuranTerbanyak"
                                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                    <label for="react-checkbox"
                                                        class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                                        < 1 cm</label>
                                                </div>
                                            </li>
                                            <li
                                                class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                                                <div class="flex items-center ps-3">
                                                    <input id="angular-checkbox" type="radio" value="3"
                                                        {{ old('ukuranTerbanyak') == '3' ? 'checked' : '' }}
                                                        name="ukuranTerbanyak"
                                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                    <label for="angular-checkbox"
                                                        class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">1
                                                        - 5 cm</label>
                                                </div>
                                            </li>
                                            <li
                                                class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                                                <div class="flex items-center ps-3">
                                                    <input id="laravel-checkbox" type="radio" value="4"
                                                        {{ old('ukuranTerbanyak') == '4' ? 'checked' : '' }}
                                                        name="ukuranTerbanyak"
                                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                    <label for="laravel-checkbox"
                                                        class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">>
                                                        5 cm</label>
                                                </div>
                                            </li>
                                            <li
                                                class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                                                <div class="flex items-center ps-3">
                                                    <input id="laravel-checkbox" type="radio" value="5"
                                                        {{ old('ukuranTerbanyak') == '5' ? 'checked' : '' }}
                                                        name="ukuranTerbanyak"
                                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                    <label for="laravel-checkbox"
                                                        class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Tidak
                                                        Tentu</label>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <div
                                        class="border border-black dark:border-white flex items-center flex-col p-3 rounded-md">
                                        <h3
                                            class="mb-4 font-semibold text-gray-900 dark:text-white border-b border-black dark:border-white w-full text-center">
                                            Tebal Lapisan</h3>
                                        <ul
                                            class="w-full h-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                            <li
                                                class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                                                <div class="flex items-center ps-3">
                                                    <input id="vue-checkbox" type="radio" value="1"
                                                        name="tebalLapisan"
                                                        {{ old('tebalLapisan') == '1' ? 'checked' : '' }}
                                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                    <label for="vue-checkbox"
                                                        class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Tidak
                                                        ada</label>
                                                </div>
                                            </li>
                                            <li
                                                class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                                                <div class="flex items-center ps-3">
                                                    <input id="react-checkbox" type="radio" value="2"
                                                        {{ old('tebalLapisan') == '2' ? 'checked' : '' }}
                                                        name="tebalLapisan"
                                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                    <label for="react-checkbox"
                                                        class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                                        < 5 cm</label>
                                                </div>
                                            </li>
                                            <li
                                                class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                                                <div class="flex items-center ps-3">
                                                    <input id="angular-checkbox" type="radio" value="3"
                                                        {{ old('tebalLapisan') == '3' ? 'checked' : '' }}
                                                        name="tebalLapisan"
                                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                    <label for="angular-checkbox"
                                                        class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">5
                                                        - 10 cm</label>
                                                </div>
                                            </li>
                                            <li
                                                class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                                                <div class="flex items-center ps-3">
                                                    <input id="laravel-checkbox" type="radio" value="4"
                                                        {{ old('tebalLapisan') == '4' ? 'checked' : '' }}
                                                        name="tebalLapisan"
                                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                    <label for="laravel-checkbox"
                                                        class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">10
                                                        - 20 cm</label>
                                                </div>
                                            </li>
                                            <li
                                                class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                                                <div class="flex items-center ps-3">
                                                    <input id="laravel-checkbox" type="radio" value="5"
                                                        {{ old('tebalLapisan') == '5' ? 'checked' : '' }}
                                                        name="tebalLapisan"
                                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                    <label for="laravel-checkbox"
                                                        class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">>
                                                        20 cm</label>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <div
                                        class="border border-black dark:border-white flex items-center flex-col p-3 rounded-md">
                                        <h3
                                            class="mb-4 font-semibold text-gray-900 dark:text-white border-b border-black dark:border-white w-full text-center">
                                            Distribusi</h3>
                                        <ul
                                            class="w-full h-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                            <li
                                                class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                                                <div class="flex items-center ps-3">
                                                    <input id="vue-checkbox" type="radio" value="1"
                                                        {{ old('distribusi') == '1' ? 'checked' : '' }}
                                                        name="distribusi"
                                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                    <label for="vue-checkbox"
                                                        class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Tidak
                                                        ada</label>
                                                </div>
                                            </li>
                                            <li
                                                class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                                                <div class="flex items-center ps-3">
                                                    <input id="react-checkbox" type="radio" value="2"
                                                        {{ old('distribusi') == '2' ? 'checked' : '' }}
                                                        name="distribusi"
                                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                    <label for="react-checkbox"
                                                        class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                                        Rata</label>
                                                </div>
                                            </li>
                                            <li
                                                class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                                                <div class="flex items-center ps-3">
                                                    <input id="angular-checkbox" type="radio" value="3"
                                                        {{ old('distribusi') == '3' ? 'checked' : '' }}
                                                        name="distribusi"
                                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                    <label for="angular-checkbox"
                                                        class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Tidak
                                                        rata</label>
                                                </div>
                                            </li>
                                            <li
                                                class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                                                <div class="flex items-center ps-3">
                                                    <input id="laravel-checkbox" type="radio" value="4"
                                                        {{ old('distribusi') == '4' ? 'checked' : '' }}
                                                        name="distribusi"
                                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                    <label for="laravel-checkbox"
                                                        class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Gundukan
                                                        memanjang</label>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="border border-black dark:border-white rounded-md p-6">
                                <h2
                                    class="text-lg  h-16 content-center font-semibold text-center mb-6 text-gray-900 dark:text-white border-b border-black dark:border-white">
                                    Kerusakan lain</h2>
                                <div class="grid gap-6 mb-6 md:grid-cols-1">
                                    <div
                                        class="border border-black dark:border-white flex items-center flex-col p-3 rounded-md">
                                        <h3
                                            class="mb-4 font-semibold text-gray-900 dark:text-white border-b border-black dark:border-white w-full text-center">
                                            Jumlah lubang</h3>
                                        <ul
                                            class="w-full h-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                            <li
                                                class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                                                <div class="flex items-center ps-3">
                                                    <input id="vue-checkbox" type="radio" value="1"
                                                        {{ old('jumlahLubang') == '1' ? 'checked' : '' }}
                                                        name="jumlahLubang"
                                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                    <label for="vue-checkbox"
                                                        class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Tidak
                                                        ada</label>
                                                </div>
                                            </li>
                                            <li
                                                class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                                                <div class="flex items-center ps-3">
                                                    <input id="react-checkbox" type="radio" value="2"
                                                        {{ old('jumlahLubang') == '2' ? 'checked' : '' }}
                                                        name="jumlahLubang"
                                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                    <label for="react-checkbox"
                                                        class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">1
                                                        / 100M</label>
                                                </div>
                                            </li>
                                            <li
                                                class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                                                <div class="flex items-center ps-3">
                                                    <input id="angular-checkbox" type="radio" value="3"
                                                        {{ old('jumlahLubang') == '3' ? 'checked' : '' }}
                                                        name="jumlahLubang"
                                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                    <label for="angular-checkbox"
                                                        class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">2
                                                        - 10 / 100M</label>
                                                </div>
                                            </li>
                                            <li
                                                class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                                                <div class="flex items-center ps-3">
                                                    <input id="laravel-checkbox" type="radio" value="4"
                                                        {{ old('jumlahLubang') == '4' ? 'checked' : '' }}
                                                        name="jumlahLubang"
                                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                    <label for="laravel-checkbox"
                                                        class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">>
                                                        10 / 100M</label>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <div
                                        class="border border-black dark:border-white flex items-center flex-col p-3 rounded-md">
                                        <h3
                                            class="mb-4 font-semibold text-gray-900 dark:text-white border-b border-black dark:border-white w-full text-center">
                                            Ukuran lubang</h3>
                                        <ul
                                            class="w-full h-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                            <li
                                                class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                                                <div class="flex items-center ps-3">
                                                    <input id="vue-checkbox" type="radio" value="1"
                                                        {{ old('ukuranLubang') == '1' ? 'checked' : '' }}
                                                        name="ukuranLubang"
                                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                    <label for="vue-checkbox"
                                                        class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Tidak
                                                        ada</label>
                                                </div>
                                            </li>
                                            <li
                                                class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                                                <div class="flex items-center ps-3">
                                                    <input id="react-checkbox" type="radio" value="2"
                                                        {{ old('ukuranLubang') == '2' ? 'checked' : '' }}
                                                        name="ukuranLubang"
                                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                    <label for="react-checkbox"
                                                        class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Kecil
                                                        dan dangkal</label>
                                                </div>
                                            </li>
                                            <li
                                                class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                                                <div class="flex items-center ps-3">
                                                    <input id="angular-checkbox" type="radio" value="3"
                                                        {{ old('ukuranLubang') == '3' ? 'checked' : '' }}
                                                        name="ukuranLubang"
                                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                    <label for="angular-checkbox"
                                                        class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Kecil
                                                        dan dalam</label>
                                                </div>
                                            </li>
                                            <li
                                                class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                                                <div class="flex items-center ps-3">
                                                    <input id="laravel-checkbox" type="radio" value="4"
                                                        {{ old('ukuranLubang') == '4' ? 'checked' : '' }}
                                                        name="ukuranLubang"
                                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                    <label for="laravel-checkbox"
                                                        class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Besar
                                                        dan dangkal</label>
                                                </div>
                                            </li>
                                            <li
                                                class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                                                <div class="flex items-center ps-3">
                                                    <input id="laravel-checkbox" type="radio" value="5"
                                                        {{ old('ukuranLubang') == '5' ? 'checked' : '' }}
                                                        name="ukuranLubang"
                                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                    <label for="laravel-checkbox"
                                                        class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Besar
                                                        dan dalam</label>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <div
                                        class="border border-black dark:border-white flex items-center flex-col p-3 rounded-md">
                                        <h3
                                            class="mb-4 font-semibold text-gray-900 dark:text-white border-b border-black dark:border-white w-full text-center">
                                            Bekas roda</h3>
                                        <ul
                                            class="w-full h-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                            <li
                                                class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                                                <div class="flex items-center ps-3">
                                                    <input id="vue-checkbox" type="radio" value="1"
                                                        {{ old('bekasRoda') == '1' ? 'checked' : '' }}
                                                        name="bekasRoda"
                                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                    <label for="vue-checkbox"
                                                        class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Tidak
                                                        ada</label>
                                                </div>
                                            </li>
                                            <li
                                                class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                                                <div class="flex items-center ps-3">
                                                    <input id="react-checkbox" type="radio" value="2"
                                                        {{ old('bekasRoda') == '2' ? 'checked' : '' }}
                                                        name="bekasRoda"
                                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                    <label for="react-checkbox"
                                                        class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                                        < 5 cm dalam</label>
                                                </div>
                                            </li>
                                            <li
                                                class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                                                <div class="flex items-center ps-3">
                                                    <input id="angular-checkbox" type="radio" value="3"
                                                        {{ old('bekasRoda') == '3' ? 'checked' : '' }}
                                                        name="bekasRoda"
                                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                    <label for="angular-checkbox"
                                                        class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">5
                                                        -
                                                        15 cm dalam</label>
                                                </div>
                                            </li>
                                            <li
                                                class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                                                <div class="flex items-center ps-3">
                                                    <input id="laravel-checkbox" type="radio" value="4"
                                                        {{ old('bekasRoda') == '4' ? 'checked' : '' }}
                                                        name="bekasRoda"
                                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                    <label for="laravel-checkbox"
                                                        class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">>
                                                        15 cm dalam</label>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <div
                                        class="border border-black dark:border-white flex items-center flex-col p-3 rounded-md">
                                        <h3
                                            class="mb-4 font-semibold text-gray-900 dark:text-white border-b border-black dark:border-white w-full text-center">
                                            Bergelombaang</h3>
                                        <ul
                                            class="w-full h-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                            <li
                                                class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                                                <div class="flex items-center ps-3">
                                                    <input id="vue-checkbox" type="radio" value="1"
                                                        {{ old('bergelombang') == '1' ? 'checked' : '' }}
                                                        name="bergelombang"
                                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                    <label for="vue-checkbox"
                                                        class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Tidak
                                                        ada</label>
                                                </div>
                                            </li>
                                            <li
                                                class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                                                <div class="flex items-center ps-3">
                                                    <input id="react-checkbox" type="radio" value="2"
                                                        {{ old('bergelombang') == '2' ? 'checked' : '' }}
                                                        name="bergelombang"
                                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                    <label for="react-checkbox"
                                                        class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                                        < 10% luas</label>
                                                </div>
                                            </li>
                                            <li
                                                class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                                                <div class="flex items-center ps-3">
                                                    <input id="angular-checkbox" type="radio" value="3"
                                                        {{ old('bergelombang') == '3' ? 'checked' : '' }}
                                                        name="bergelombang"
                                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                    <label for="angular-checkbox"
                                                        class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">10
                                                        -
                                                        30% luas</label>
                                                </div>
                                            </li>
                                            <li
                                                class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                                                <div class="flex items-center ps-3">
                                                    <input id="laravel-checkbox" type="radio" value="4"
                                                        {{ old('bergelombang') == '4' ? 'checked' : '' }}
                                                        name="bergelombang"
                                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                    <label for="laravel-checkbox"
                                                        class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">>
                                                        30% luas</label>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="border border-black dark:border-white rounded-md p-6">
                                <h2
                                    class="text-lg h-16 content-center font-semibold text-center mb-6 text-gray-900 dark:text-white border-b border-black dark:border-white">
                                    Bahu, Saluran Samping dan lain-lain</h2>
                                <div class="grid gap-6 mb-6 md:grid-cols-1">
                                    <div
                                        class="border border-black dark:border-white flex items-center flex-col p-3 rounded-md">
                                        <h3
                                            class="mb-4 font-semibold text-gray-900 dark:text-white border-b border-black dark:border-white w-full text-center">
                                            KR | Kondisi bahu | KN
                                        </h3>
                                        <ul
                                            class="w-full h-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                            <li
                                                class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                                                <div class="flex items-center justify-between px-3">
                                                    <input id="vue-checkbox-left" type="radio" value="1"
                                                        {{ old('kondisiBahuKiri') == '1' ? 'checked' : '' }}
                                                        name="kondisiBahuKiri"
                                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                    <label for="vue-checkbox-left"
                                                        class="py-3 text-sm font-medium text-gray-900 dark:text-gray-300">Tidak
                                                        ada</label>
                                                    <input id="vue-checkbox-right" type="radio" value="1"
                                                        {{ old('kondisiBahuKanan') == '1' ? 'checked' : '' }}
                                                        name="kondisiBahuKanan"
                                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                </div>
                                            </li>
                                            <li class="w-full border-b border-gray-200 dark:border-gray-600">
                                                <div class="flex items-center justify-between px-3">
                                                    <input id="react-checkbox-left" type="radio" value="2"
                                                        {{ old('kondisiBahuKiri') == '2' ? 'checked' : '' }}
                                                        name="kondisiBahuKiri"
                                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                    <label for="react-checkbox-left"
                                                        class="py-3 text-sm font-medium text-gray-900 dark:text-gray-300">Baik/Rata</label>
                                                    <input id="react-checkbox-right" type="radio" value="2"
                                                        {{ old('kondisiBahuKanan') == '2' ? 'checked' : '' }}
                                                        name="kondisiBahuKanan"
                                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                </div>
                                            </li>
                                            <li class="w-full border-b border-gray-200 dark:border-gray-600">
                                                <div class="flex items-center justify-between px-3">
                                                    <input id="angular-checkbox-left" type="radio" value="3"
                                                        {{ old('kondisiBahuKiri') == '3' ? 'checked' : '' }}
                                                        name="kondisiBahuKiri"
                                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                    <label for="angular-checkbox-left"
                                                        class="py-3 text-sm font-medium text-gray-900 dark:text-gray-300">Erosi
                                                        ringan</label>
                                                    <input id="angular-checkbox-right" type="radio" value="3"
                                                        {{ old('kondisiBahuKanan') == '3' ? 'checked' : '' }}
                                                        name="kondisiBahuKanan"
                                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                </div>
                                            </li>
                                            <li class="w-full border-b border-gray-200 dark:border-gray-600">
                                                <div class="flex items-center justify-between px-3">
                                                    <input id="angular-checkbox-left" type="radio" value="4"
                                                        {{ old('kondisiBahuKiri') == '4' ? 'checked' : '' }}
                                                        name="kondisiBahuKiri"
                                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                    <label for="angular-checkbox-left"
                                                        class="py-3 text-sm font-medium text-gray-900 dark:text-gray-300">Erosi
                                                        berat</label>
                                                    <input id="angular-checkbox-right" type="radio" value="4"
                                                        {{ old('kondisiBahuKanan') == '4' ? 'checked' : '' }}
                                                        name="kondisiBahuKanan"
                                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <div
                                        class="border border-black dark:border-white flex items-center flex-col p-3 rounded-md">
                                        <h3
                                            class="mb-4 font-semibold text-gray-900 dark:text-white border-b border-black dark:border-white w-full text-center">
                                            KR | Permukaan bahu | KN
                                        </h3>
                                        <ul
                                            class="w-full h-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                            <li
                                                class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                                                <div class="flex items-center justify-between px-3">
                                                    <input id="vue-checkbox-left" type="radio" value="1"
                                                        {{ old('permukaanBahuKiri') == '1' ? 'checked' : '' }}
                                                        name="permukaanBahuKiri"
                                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                    <label for="vue-checkbox-left"
                                                        class="py-3 text-sm font-medium text-gray-900 dark:text-gray-300">Tidak
                                                        ada</label>
                                                    <input id="vue-checkbox-right" type="radio" value="1"
                                                        {{ old('permukaanBahuKanan') == '1' ? 'checked' : '' }}
                                                        name="permukaanBahuKanan"
                                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                </div>
                                            </li>
                                            <li class="w-full border-b border-gray-200 dark:border-gray-600">
                                                <div class="flex items-center justify-between px-3">
                                                    <input id="react-checkbox-left" type="radio" value="2"
                                                        {{ old('permukaanBahuKiri') == '2' ? 'checked' : '' }}
                                                        name="permukaanBahuKiri"
                                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                    <label for="react-checkbox-left"
                                                        class="py-3 text-sm font-medium text-gray-900 dark:text-gray-300">Diatas
                                                        permukaan jalan</label>
                                                    <input id="react-checkbox-right" type="radio" value="2"
                                                        {{ old('permukaanBahuKanan') == '2' ? 'checked' : '' }}
                                                        name="permukaanBahuKanan"
                                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                </div>
                                            </li>
                                            <li class="w-full border-b border-gray-200 dark:border-gray-600">
                                                <div class="flex items-center justify-between px-3">
                                                    <input id="angular-checkbox-left" type="radio" value="3"
                                                        {{ old('permukaanBahuKiri') == '3' ? 'checked' : '' }}
                                                        name="permukaanBahuKiri"
                                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                    <label for="angular-checkbox-left"
                                                        class="py-3 text-sm font-medium text-gray-900 dark:text-gray-300">Rata
                                                        dengan permukaan jalan</label>
                                                    <input id="angular-checkbox-right" type="radio" value="3"
                                                        {{ old('permukaanBahuKanan') == '3' ? 'checked' : '' }}
                                                        name="permukaanBahuKanan"
                                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                </div>
                                            </li>
                                            <li class="w-full border-b border-gray-200 dark:border-gray-600">
                                                <div class="flex items-center justify-between px-3">
                                                    <input id="angular-checkbox-left" type="radio" value="4"
                                                        {{ old('permukaanBahuKiri') == '4' ? 'checked' : '' }}
                                                        name="permukaanBahuKiri"
                                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                    <label for="angular-checkbox-left"
                                                        class="py-3 text-sm font-medium text-gray-900 dark:text-gray-300">Dibawah
                                                        permukaan jalan</label>
                                                    <input id="angular-checkbox-right" type="radio" value="4"
                                                        {{ old('permukaanBahuKanan') == '4' ? 'checked' : '' }}
                                                        name="permukaanBahuKanan"
                                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                </div>
                                            </li>
                                            <li class="w-full border-b border-gray-200 dark:border-gray-600">
                                                <div class="flex items-center justify-between px-3">
                                                    <input id="angular-checkbox-left" type="radio" value="5"
                                                        {{ old('permukaanBahuKiri') == '5' ? 'checked' : '' }}
                                                        name="permukaanBahuKiri"
                                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                    <label for="angular-checkbox-left"
                                                        class="py-3 text-sm font-medium text-gray-900 dark:text-gray-300">>
                                                        5cm
                                                        dibawah
                                                        permukaan jalan</label>
                                                    <input id="angular-checkbox-right" type="radio" value="5"
                                                        {{ old('permukaanBahuKanan') == '5' ? 'checked' : '' }}
                                                        name="permukaanBahuKanan"
                                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <div
                                        class="border border-black dark:border-white flex items-center flex-col p-3 rounded-md">
                                        <h3
                                            class="text-sm mb-4 font-semibold text-gray-900 dark:text-white border-b border-black dark:border-white w-full text-center">
                                            KR | Kondisi saluran samping | KN
                                        </h3>
                                        <ul
                                            class="w-full h-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                            <li
                                                class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                                                <div class="flex items-center justify-between px-3">
                                                    <input id="vue-checkbox-left" type="radio" value="1"
                                                        {{ old('kondisiSaluranKiri') == '1' ? 'checked' : '' }}
                                                        name="kondisiSaluranKiri"
                                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                    <label for="vue-checkbox-left"
                                                        class="py-3 text-sm font-medium text-gray-900 dark:text-gray-300">Tidak
                                                        ada</label>
                                                    <input id="vue-checkbox-right" type="radio" value="1"
                                                        {{ old('kondisiSaluranKanan') == '1' ? 'checked' : '' }}
                                                        name="kondisiSaluranKanan"
                                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                </div>
                                            </li>
                                            <li class="w-full border-b border-gray-200 dark:border-gray-600">
                                                <div class="flex items-center justify-between px-3">
                                                    <input id="react-checkbox-left" type="radio" value="2"
                                                        {{ old('kondisiSaluranKiri') == '2' ? 'checked' : '' }}
                                                        name="kondisiSaluranKiri"
                                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                    <label for="react-checkbox-left"
                                                        class="py-3 text-sm font-medium text-gray-900 dark:text-gray-300">Bersih</label>
                                                    <input id="react-checkbox-right" type="radio" value="2"
                                                        {{ old('kondisiSaluranKanan') == '2' ? 'checked' : '' }}
                                                        name="kondisiSaluranKanan"
                                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                </div>
                                            </li>
                                            <li class="w-full border-b border-gray-200 dark:border-gray-600">
                                                <div class="flex items-center justify-between px-3">
                                                    <input id="angular-checkbox-left" type="radio" value="3"
                                                        {{ old('kondisiSaluranKiri') == '3' ? 'checked' : '' }}
                                                        name="kondisiSaluranKiri"
                                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                    <label for="angular-checkbox-left"
                                                        class="py-3 text-sm font-medium text-gray-900 dark:text-gray-300">Tertutup/tersumbat</label>
                                                    <input id="angular-checkbox-right" type="radio" value="3"
                                                        {{ old('kondisiSaluranKanan') == '3' ? 'checked' : '' }}
                                                        name="kondisiSaluranKanan"
                                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                </div>
                                            </li>
                                            <li class="w-full border-b border-gray-200 dark:border-gray-600">
                                                <div class="flex items-center justify-between px-3">
                                                    <input id="angular-checkbox-left" type="radio" value="4"
                                                        {{ old('kondisiSaluranKiri') == '4' ? 'checked' : '' }}
                                                        name="kondisiSaluranKiri"
                                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                    <label for="angular-checkbox-left"
                                                        class="py-3 text-sm font-medium text-gray-900 dark:text-gray-300">Erosi
                                                    </label>
                                                    <input id="angular-checkbox-right" type="radio" value="4"
                                                        {{ old('kondisiSaluranKanan') == '4' ? 'checked' : '' }}
                                                        name="kondisiSaluranKanan"
                                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <div
                                        class="border border-black dark:border-white flex items-center flex-col p-3 rounded-md">
                                        <h3
                                            class="mb-4 font-semibold text-gray-900 dark:text-white border-b border-black dark:border-white w-full text-center">
                                            KR | Kerusakan lereng | KN
                                        </h3>
                                        <ul
                                            class="w-full h-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                            <li
                                                class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                                                <div class="flex items-center justify-between px-3">
                                                    <input id="vue-checkbox-left" type="radio" value="1"
                                                        {{ old('kerusakanLerengKiri') == '1' ? 'checked' : '' }}
                                                        name="kerusakanLerengKiri"
                                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                    <label for="vue-checkbox-left"
                                                        class="py-3 text-sm font-medium text-gray-900 dark:text-gray-300">Tidak
                                                        ada</label>
                                                    <input id="vue-checkbox-right" type="radio" value="1"
                                                        {{ old('kerusakanLerengKanan') == '1' ? 'checked' : '' }}
                                                        name="kerusakanLerengKanan"
                                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                </div>
                                            </li>
                                            <li class="w-full border-b border-gray-200 dark:border-gray-600">
                                                <div class="flex items-center justify-between px-3">
                                                    <input id="angular-checkbox-left" type="radio" value="2"
                                                        {{ old('kerusakanLerengKiri') == '2' ? 'checked' : '' }}
                                                        name="kerusakanLerengKiri"
                                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                    <label for="angular-checkbox-left"
                                                        class="py-3 text-sm font-medium text-gray-900 dark:text-gray-300">Longsor/runtuh</label>
                                                    <input id="angular-checkbox-right" type="radio" value="2"
                                                        {{ old('kerusakanLerengKanan') == '2' ? 'checked' : '' }}
                                                        name="kerusakanLerengKanan"
                                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <div
                                        class="border border-black dark:border-white flex items-center flex-col p-3 rounded-md">
                                        <h3
                                            class="mb-4 font-semibold text-gray-900 dark:text-white border-b border-black dark:border-white w-full text-center">
                                            KR | Trotoar | KN
                                        </h3>
                                        <ul
                                            class="w-full h-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                            <li
                                                class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                                                <div class="flex items-center justify-between px-3">
                                                    <input id="vue-checkbox-left" type="radio" value="1"
                                                        {{ old('trotoarKiri') == '1' ? 'checked' : '' }}
                                                        name="trotoarKiri"
                                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                    <label for="vue-checkbox-left"
                                                        class="py-3 text-sm font-medium text-gray-900 dark:text-gray-300">Tidak
                                                        ada</label>
                                                    <input id="vue-checkbox-right" type="radio" value="1"
                                                        {{ old('trotoarKanan') == '1' ? 'checked' : '' }}
                                                        name="trotoarKanan"
                                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                </div>
                                            </li>
                                            <li class="w-full border-b border-gray-200 dark:border-gray-600">
                                                <div class="flex items-center justify-between px-3">
                                                    <input id="react-checkbox-left" type="radio" value="2"
                                                        {{ old('trotoarKiri') == '2' ? 'checked' : '' }}
                                                        name="trotoarKiri"
                                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                    <label for="react-checkbox-left"
                                                        class="py-3 text-sm font-medium text-gray-900 dark:text-gray-300">Baik/aman</label>
                                                    <input id="react-checkbox-right" type="radio" value="2"
                                                        {{ old('trotoarKanan') == '2' ? 'checked' : '' }}
                                                        name="trotoarKanan"
                                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                </div>
                                            </li>
                                            <li class="w-full border-b border-gray-200 dark:border-gray-600">
                                                <div class="flex items-center justify-between px-3">
                                                    <input id="angular-checkbox-left" type="radio" value="3"
                                                        {{ old('trotoarKiri') == '3' ? 'checked' : '' }}
                                                        name="trotoarKiri"
                                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                    <label for="angular-checkbox-left"
                                                        class="py-3 text-sm font-medium text-gray-900 dark:text-gray-300">Berbahaya</label>
                                                    <input id="angular-checkbox-right" type="radio" value="3"
                                                        {{ old('trotoarKanan') == '3' ? 'checked' : '' }}
                                                        name="trotoarKanan"
                                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
                    </form>
                </div>
            </div>
            <!--/container-->
        </div>
    </div>
</x-layout-dashboard>
