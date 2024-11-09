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
                    <form action="{{ route('jalanAspal.store') }}" method="post">
                        @csrf
                        <div class="grid gap-6 mb-6 md:grid-cols-2">
                            <div>
                                <label for="noProvinsi"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nomor
                                    Provinsi</label>
                                <input type="number" id="noProvinsi" name="noProvinsi"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="72" value="{{ old('noProvinsi') }}" />
                            </div>
                            <div>
                                <label for="noRuas"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nomor
                                    Ruas</label>
                                <input type="text" id="noRuas" name="noRuas"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="01423" value="{{ old('noRuas') }}" />
                            </div>
                            <div>
                                <label for="namaProvinsi"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                                    Provinsi</label>
                                <input type="text" id="namaProvinsi" name="namaProvinsi"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Sulawesi Tengah" value="{{ old('namaProvinsi') }}" />
                            </div>
                            <div>
                                <label for="namaRuas"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                                    Ruas</label>
                                <input type="text" id="namaRuas" name="namaRuas"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="SP. KULAWI - GIMPU" value="{{ old('namaRuas') }}" />
                            </div>
                            <div>
                                <label for="kabupaten"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kabupaten/Kota</label>
                                <input type="text" id="kabupaten" name="kabupaten"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Sigi" value="{{ old('kabupaten') }}" />
                            </div>
                            <div>
                                <label for="fungsi"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status
                                    Fungsi</label>
                                <input type="text" id="fungsi" name="fungsi"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="KP-2" value="{{ old('fungsi') }}" />
                            </div>
                            <div>
                                <label for="dariPatok"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Dari Patok
                                    Km</label>
                                <input type="text" id="dariPatok" name="dariPatok"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="0+000" value="{{ old('dariPatok') }}" />
                            </div>
                            <div>
                                <label for="date"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal</label>
                                <input type="date" id="date" name="date"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    value="{{ old('date') }}" />
                            </div>
                            <div>
                                <label for="kePatok"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ke Patok
                                    Km</label>
                                <input type="text" id="kePatok" name="kePatok"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="0+100" value="{{ old('kePatok') }}" />
                            </div>
                            <div class="mb-4">
                                <label for="surveyor"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Surveyor</label>
                                <div class="relative">
                                    <select multiple id="surveyor" name="surveyor[]"
                                        class="h-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">Hold down the Ctrl (Windows)
                                    or
                                    Command (Mac) button to select multiple options.</p>
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
