<x-layout-dashboard>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="mx-auto min-h-[120vh] px-4 py-6 sm:px-6 lg:px-8">
        <div class="rounded-2xl">
            <!--Container-->
            <div class="container w-full max-w-full mx-auto px-2">
                <!--Title-->
                <h1
                    class="flex items-center font-sans font-bold break-normal text-nord0 dark:text-nord6 px-2 py-2 text-xl md:text-2xl">
                    FORMULIR SURVEI KONDISI JALAN ASPAL PER-100 METER
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
                    <form action="{{ route('dataJalanAspal.store') }}" method="post">
                        @csrf
                        <div class="grid gap-6 mb-6 md:grid-cols-2">
                            <div>
                                <label for="asphalt_street_id"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Survey Jalan
                                    Aspal</label>
                                <select id="asphalt_street_id" name="asphalt_street_id"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="" disabled selected>Pilih Jalan Aspal</option>
                                    @foreach ($jalanAspals as $street)
                                        <option value="{{ $street->id }}"
                                            {{ old('asphalt_street_id') == $street->id ? 'selected' : '' }}>
                                            {{ $street->noRuas }} - {{ $street->namaRuas }} - ({{ $street->dariPatok }}
                                            -
                                            {{ $street->kePatok }})
                                        </option>
                                    @endforeach
                                </select>
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
                                            Permukaan Perkerasan</h3>
                                        <ul
                                            class=" w-full h-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                            <li
                                                class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                                                <div class="flex items-center ps-3">
                                                    <input id="baik/rapat" type="radio" value="1"
                                                        {{ old('permukaanPerkerasan') == '1' ? 'checked' : '' }}
                                                        name="permukaanPerkerasan"
                                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                    <label for="baik/rapat"
                                                        class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Baik/Rapat</label>
                                                </div>
                                            </li>
                                            <li
                                                class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                                                <div class="flex items-center ps-3">
                                                    <input id="rusakPengkerasan" type="radio" value="2"
                                                        {{ old('permukaanPerkerasan') == '2' ? 'checked' : '' }}
                                                        name="permukaanPerkerasan"
                                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                    <label for="rusakPengkerasan"
                                                        class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Kasar</label>
                                                </div>
                                            </li>

                                        </ul>
                                    </div>
                                    <div
                                        class="border border-black dark:border-white flex items-center flex-col p-3 rounded-md">
                                        <h3
                                            class="mb-4 font-semibold text-gray-900 dark:text-white border-b border-black dark:border-white w-full text-center">
                                            Kondisi/Keadaan</h3>
                                        <ul
                                            class="w-full h-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                            <li
                                                class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                                                <div class="flex items-center ps-3">
                                                    <input id="baik2" type="radio" value="1"
                                                        {{ old('kondisi') == '1' ? 'checked' : '' }} name="kondisi"
                                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                    <label for="baik2"
                                                        class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Baik/tidak
                                                        ada kelainan</label>
                                                </div>
                                            </li>
                                            <li
                                                class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                                                <div class="flex items-center ps-3">
                                                    <input id="react-checkbox" type="radio" value="2"
                                                        {{ old('kondisi') == '2' ? 'checked' : '' }} name="kondisi"
                                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                    <label for="react-checkbox"
                                                        class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Aspal
                                                        Berlebihan</label>
                                                </div>
                                            </li>
                                            <li
                                                class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                                                <div class="flex items-center ps-3">
                                                    <input id="angular-checkbox" type="radio" value="3"
                                                        {{ old('kondisi') == '3' ? 'checked' : '' }} name="kondisi"
                                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                    <label for="angular-checkbox"
                                                        class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Lepas-lepas</label>
                                                </div>
                                            </li>
                                            <li
                                                class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                                                <div class="flex items-center ps-3">
                                                    <input id="laravel-checkbox" type="radio" value="4"
                                                        {{ old('kondisi') == '4' ? 'checked' : '' }} name="kondisi"
                                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                    <label for="laravel-checkbox"
                                                        class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Hancur</label>
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
                                                        {{ old('penurunan') == '1' ? 'checked' : '' }} name="penurunan"
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
                                            % Tambalan</h3>
                                        <ul
                                            class="w-full h-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                            <li
                                                class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                                                <div class="flex items-center ps-3">
                                                    <input id="vue-checkbox" type="radio" value="1"
                                                        {{ old('tambalan') == '1' ? 'checked' : '' }} name="tambalan"
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
                                                        {{ old('tambalan') == '2' ? 'checked' : '' }} name="tambalan"
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
                                                        {{ old('tambalan') == '3' ? 'checked' : '' }} name="tambalan"
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
                                                        {{ old('tambalan') == '4' ? 'checked' : '' }} name="tambalan"
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
                                    Retak-retak</h2>
                                <div class="grid gap-6 mb-6 md:grid-cols-1">
                                    <div
                                        class="border border-black dark:border-white flex items-center flex-col p-3 rounded-md">
                                        <h3
                                            class="mb-4 font-semibold text-gray-900 dark:text-white border-b border-black dark:border-white w-full text-center">
                                            Jenis</h3>
                                        <ul
                                            class="w-full h-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                            <li
                                                class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                                                <div class="flex items-center ps-3">
                                                    <input id="vue-checkbox" type="radio" value="1"
                                                        {{ old('jenis') == '1' ? 'checked' : '' }} name="jenis"
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
                                                        {{ old('jenis') == '2' ? 'checked' : '' }} name="jenis"
                                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                    <label for="react-checkbox"
                                                        class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Tidak
                                                        berhubungan</label>
                                                </div>
                                            </li>
                                            <li
                                                class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                                                <div class="flex items-center ps-3">
                                                    <input id="angular-checkbox" type="radio" value="3"
                                                        {{ old('jenis') == '3' ? 'checked' : '' }} name="jenis"
                                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                    <label for="angular-checkbox"
                                                        class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Saling
                                                        berhubungan (Bidang luas)</label>
                                                </div>
                                            </li>
                                            <li
                                                class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                                                <div class="flex items-center ps-3">
                                                    <input id="laravel-checkbox" type="radio" value="4"
                                                        {{ old('jenis') == '4' ? 'checked' : '' }} name="jenis"
                                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                    <label for="laravel-checkbox"
                                                        class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Saling
                                                        Berhubungan (Bidang sempit)</label>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <div
                                        class="border border-black dark:border-white flex items-center flex-col p-3 rounded-md">
                                        <h3
                                            class="mb-4 font-semibold text-gray-900 dark:text-white border-b border-black dark:border-white w-full text-center">
                                            Lebar</h3>
                                        <ul
                                            class="w-full h-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                            <li
                                                class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                                                <div class="flex items-center ps-3">
                                                    <input id="vue-checkbox" type="radio" value="1"
                                                        name="lebar" {{ old('lebar') == '1' ? 'checked' : '' }}
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
                                                        {{ old('lebar') == '2' ? 'checked' : '' }} name="lebar"
                                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                    <label for="react-checkbox"
                                                        class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Halus
                                                        < 1 mm</label>
                                                </div>
                                            </li>
                                            <li
                                                class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                                                <div class="flex items-center ps-3">
                                                    <input id="angular-checkbox" type="radio" value="3"
                                                        {{ old('lebar') == '3' ? 'checked' : '' }} name="lebar"
                                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                    <label for="angular-checkbox"
                                                        class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Sedang
                                                        1-5 mm</label>
                                                </div>
                                            </li>
                                            <li
                                                class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                                                <div class="flex items-center ps-3">
                                                    <input id="laravel-checkbox" type="radio" value="4"
                                                        {{ old('lebar') == '4' ? 'checked' : '' }} name="lebar"
                                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                    <label for="laravel-checkbox"
                                                        class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Lebar
                                                        > 5 mm</label>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <div
                                        class="border border-black dark:border-white flex items-center flex-col p-3 rounded-md">
                                        <h3
                                            class="mb-4 font-semibold text-gray-900 dark:text-white border-b border-black dark:border-white w-full text-center">
                                            % Luas</h3>
                                        <ul
                                            class="w-full h-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                            <li
                                                class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                                                <div class="flex items-center ps-3">
                                                    <input id="vue-checkbox" type="radio" value="1"
                                                        {{ old('luas') == '1' ? 'checked' : '' }} name="luas"
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
                                                        {{ old('luas') == '2' ? 'checked' : '' }} name="luas"
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
                                                        {{ old('luas') == '3' ? 'checked' : '' }} name="luas"
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
                                                        {{ old('luas') == '4' ? 'checked' : '' }} name="luas"
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
                                                        < 5cm dalam</label>
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
                                                        15cm dalam</label>
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
                                                        15cm dalam</label>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <div
                                        class="border border-black dark:border-white flex items-center flex-col p-3 rounded-md">
                                        <h3
                                            class="mb-4 font-semibold text-gray-900 dark:text-white border-b border-black dark:border-white w-full text-center">
                                            KR | Kerusakan tepi | KN
                                        </h3>
                                        <ul
                                            class="w-full h-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                            <li
                                                class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                                                <div class="flex items-center justify-between px-3">
                                                    <input id="vue-checkbox-left" type="radio" value="1"
                                                        {{ old('kerusakanTepiKiri') == '1' ? 'checked' : '' }}
                                                        name="kerusakanTepiKiri"
                                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                    <label for="vue-checkbox-left"
                                                        class="py-3 text-sm font-medium text-gray-900 dark:text-gray-300">Tidak
                                                        ada</label>
                                                    <input id="vue-checkbox-right" type="radio" value="1"
                                                        {{ old('kerusakanTepiKanan') == '1' ? 'checked' : '' }}
                                                        name="kerusakanTepiKanan"
                                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                </div>
                                            </li>
                                            <li class="w-full border-b border-gray-200 dark:border-gray-600">
                                                <div class="flex items-center justify-between px-3">
                                                    <input id="react-checkbox-left" type="radio" value="2"
                                                        {{ old('kerusakanTepiKiri') == '2' ? 'checked' : '' }}
                                                        name="kerusakanTepiKiri"
                                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                    <label for="react-checkbox-left"
                                                        class="py-3 text-sm font-medium text-gray-900 dark:text-gray-300">Ringan</label>
                                                    <input id="react-checkbox-right" type="radio" value="2"
                                                        {{ old('kerusakanTepiKanan') == '2' ? 'checked' : '' }}
                                                        name="kerusakanTepiKanan"
                                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                </div>
                                            </li>
                                            <li class="w-full border-b border-gray-200 dark:border-gray-600">
                                                <div class="flex items-center justify-between px-3">
                                                    <input id="angular-checkbox-left" type="radio" value="3"
                                                        {{ old('kerusakanTepiKiri') == '3' ? 'checked' : '' }}
                                                        name="kerusakanTepiKiri"
                                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                    <label for="angular-checkbox-left"
                                                        class="py-3 text-sm font-medium text-gray-900 dark:text-gray-300">Berat</label>
                                                    <input id="angular-checkbox-right" type="radio" value="3"
                                                        {{ old('kerusakanTepiKanan') == '3' ? 'checked' : '' }}
                                                        name="kerusakanTepiKanan"
                                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
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
