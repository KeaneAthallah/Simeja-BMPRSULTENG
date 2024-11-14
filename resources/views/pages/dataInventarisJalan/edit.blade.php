<x-layout-dashboard>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="mx-auto min-h-[120vh] px-4 py-6 sm:px-6 lg:px-8">
        <div class="rounded-2xl">
            <!--Container-->
            <div class="container w-full max-w-full mx-auto px-2">
                <!--Title-->
                <h1
                    class="flex items-center font-sans font-bold break-normal text-nord0 dark:text-nord6 px-2 py-2 text-xl md:text-2xl">
                    FORMULIR SURVEI INVENTARIS JARINGAN JALAN
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
                    <form action="{{ route('dataInventarisJalan.update', $data->id) }}" method="post">
                        @method('PUT')
                        @csrf
                        <div class="grid gap-6 mb-6 md:grid-cols-2">
                            <div>
                                <label for="road_inventory_id"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Survey Jalan
                                    Aspal</label>
                                <select id="road_inventory_id" name="road_inventory_id"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="" disabled selected>Pilih Jalan Aspal</option>
                                    @foreach ($inventarisJalans as $street)
                                        <option value="{{ $street->id }}"
                                            {{ old('road_inventory_id', $street->id) == $street->id ? 'selected' : '' }}>
                                            {{ $street->noRuas }} - {{ $street->namaRuas }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="road_id"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pilih Data
                                    STA</label>
                                <select id="road_id" name="road_id"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="" disabled selected>Pilih STA</option>
                                    {{-- Asphalt Streets --}}
                                    <optgroup label="Data Survey Jalan Aspal">
                                        @foreach ($streets['asphaltStreets'] as $asphaltStreet)
                                            <option value="{{ $asphaltStreet->id }}"
                                                {{ old('road_id', $asphaltStreet->id) == $asphaltStreet->id ? 'selected' : '' }}>
                                                {{ $asphaltStreet->dariPatok }} -
                                                {{ $asphaltStreet->kePatok }}
                                                {{ $asphaltStreet->asphaltStreet->roadInventory->namaRuas }}
                                            </option>
                                        @endforeach
                                    </optgroup>

                                    {{-- Soil Streets --}}
                                    <optgroup label="Data Survey Jalan Tanah">
                                        @foreach ($streets['soilStreets'] as $soilStreet)
                                            <option value="{{ $soilStreet->id }}"
                                                {{ old('road_id', $soilStreet->id) == $soilStreet->id ? 'selected' : '' }}>
                                                {{ $soilStreet->dariPatok }} -
                                                {{ $soilStreet->kePatok }}
                                                {{ $soilStreet->soilsStreet->roadInventory->namaRuas }}
                                            </option>
                                        @endforeach
                                    </optgroup>
                                </select>
                            </div>
                            <div>
                                <label for="tipeJalan"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kode Tipe
                                    Jalan</label>
                                <select id="tipeJalan" name="tipeJalan"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="" disabled selected>Pilih Tipe Jalan</option>
                                    <option value="1"
                                        {{ old('tipeJalan', $data->tipeJalan) == '1' ? 'selected' : '' }}>2 / 1 UD
                                    </option>
                                    <option value="2"
                                        {{ old('tipeJalan', $data->tipeJalan) == '2' ? 'selected' : '' }}>2 / 2 UD
                                    </option>
                                    <option value="3"
                                        {{ old('tipeJalan', $data->tipeJalan) == '3' ? 'selected' : '' }}>4 / 2 UD
                                    </option>
                                    <option value="4"
                                        {{ old('tipeJalan', $data->tipeJalan) == '4' ? 'selected' : '' }}>4 / 2 D
                                    </option>
                                    <option value="5"
                                        {{ old('tipeJalan', $data->tipeJalan) == '5' ? 'selected' : '' }}>6 / 2 D
                                    </option>
                                </select>
                            </div>
                            <div>
                                <label for="jenisPerkerasan"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jenis
                                    Perkerasan</label>
                                <select id="jenisPerkerasan" name="jenisPerkerasan"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="" disabled selected>Pilih Jenis Perkerasan</option>
                                    <option value="1"
                                        {{ old('jenisPerkerasan', $data->jenisPerkerasan) == '1' ? 'selected' : '' }}>
                                        Aspal (AC,HRS,ATB)
                                    </option>
                                    <option value="2"
                                        {{ old('jenisPerkerasan', $data->jenisPerkerasan) == '2' ? 'selected' : '' }}>
                                        Beton
                                    </option>
                                    <option value="3"
                                        {{ old('jenisPerkerasan', $data->jenisPerkerasan) == '3' ? 'selected' : '' }}>
                                        Lapis Penetrasi/Macadam
                                    </option>
                                    <option value="4"
                                        {{ old('jenisPerkerasan', $data->jenisPerkerasan) == '4' ? 'selected' : '' }}>
                                        Kerikil
                                    </option>
                                    <option value="5"
                                        {{ old('jenisPerkerasan', $data->jenisPerkerasan) == '5' ? 'selected' : '' }}>
                                        Tanah/Belum Tembus
                                    </option>
                                </select>
                            </div>
                            <div>
                                <label for="lapisPermukaanTahun"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Lapis Permukaan
                                    Tahun</label>
                                <input type="number" id="lapisPermukaanTahun" name="lapisPermukaanTahun"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="2020"
                                    value="{{ old('lapisPermukaanTahun', $data->lapisPermukaanTahun) }}" />
                            </div>
                            <div>
                                <label for="lapisPermukaanJenis"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Lapis Permukaan
                                    Jenis</label>
                                <select id="lapisPermukaanJenis" name="lapisPermukaanJenis"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="" disabled selected>Pilih Jenis Permukaan</option>
                                    <option value="0"
                                        {{ old('lapisPermukaanJenis', $data->lapisPermukaanJenis) == '0' ? 'selected' : '' }}>
                                        Tidak Diketahui</option>
                                    <option value="1"
                                        {{ old('lapisPermukaanJenis', $data->lapisPermukaanJenis) == '1' ? 'selected' : '' }}>
                                        Tanah</option>
                                    <option value="2"
                                        {{ old('lapisPermukaanJenis', $data->lapisPermukaanJenis) == '2' ? 'selected' : '' }}>
                                        Japat (AWCAS) / Kerikil</option>
                                    <option value="3"
                                        {{ old('lapisPermukaanJenis', $data->lapisPermukaanJenis) == '3' ? 'selected' : '' }}>
                                        Telford / Macadam Terbuka</option>
                                    <option value="4"
                                        {{ old('lapisPermukaanJenis', $data->lapisPermukaanJenis) == '4' ? 'selected' : '' }}>
                                        Burtu</option>
                                    <option value="5"
                                        {{ old('lapisPermukaanJenis', $data->lapisPermukaanJenis) == '5' ? 'selected' : '' }}>
                                        Burda</option>
                                    <option value="6"
                                        {{ old('lapisPermukaanJenis', $data->lapisPermukaanJenis) == '6' ? 'selected' : '' }}>
                                        Penetrasi Macadam 1 Lapis</option>
                                    <option value="7"
                                        {{ old('lapisPermukaanJenis', $data->lapisPermukaanJenis) == '7' ? 'selected' : '' }}>
                                        Penetrasi Macadam 2 Lapis</option>
                                    <option value="8"
                                        {{ old('lapisPermukaanJenis', $data->lapisPermukaanJenis) == '8' ? 'selected' : '' }}>
                                        Lasbutag (BUTAS)</option>
                                    <option value="9"
                                        {{ old('lapisPermukaanJenis', $data->lapisPermukaanJenis) == '9' ? 'selected' : '' }}>
                                        Aspal Beton (A.C.)</option>
                                    <option value="10"
                                        {{ old('lapisPermukaanJenis', $data->lapisPermukaanJenis) == '10' ? 'selected' : '' }}>
                                        Latasbum (NACAS)</option>
                                    <option value="11"
                                        {{ old('lapisPermukaanJenis', $data->lapisPermukaanJenis) == '11' ? 'selected' : '' }}>
                                        Lataston (HRS)</option>
                                    <option value="12"
                                        {{ old('lapisPermukaanJenis', $data->lapisPermukaanJenis) == '12' ? 'selected' : '' }}>
                                        HRSSA</option>
                                    <option value="13"
                                        {{ old('lapisPermukaanJenis', $data->lapisPermukaanJenis) == '13' ? 'selected' : '' }}>
                                        Slurry Seal</option>
                                    <option value="14"
                                        {{ old('lapisPermukaanJenis', $data->lapisPermukaanJenis) == '14' ? 'selected' : '' }}>
                                        Macro Seal</option>
                                    <option value="15"
                                        {{ old('lapisPermukaanJenis', $data->lapisPermukaanJenis) == '15' ? 'selected' : '' }}>
                                        Micro Asbuton</option>
                                    <option value="16"
                                        {{ old('lapisPermukaanJenis', $data->lapisPermukaanJenis) == '16' ? 'selected' : '' }}>
                                        DGEM</option>
                                    <option value="17"
                                        {{ old('lapisPermukaanJenis', $data->lapisPermukaanJenis) == '17' ? 'selected' : '' }}>
                                        SMA</option>
                                    <option value="18"
                                        {{ old('lapisPermukaanJenis', $data->lapisPermukaanJenis) == '18' ? 'selected' : '' }}>
                                        BMA</option>
                                    <option value="19"
                                        {{ old('lapisPermukaanJenis', $data->lapisPermukaanJenis) == '19' ? 'selected' : '' }}>
                                        HSWC</option>
                                    <option value="20"
                                        {{ old('lapisPermukaanJenis', $data->lapisPermukaanJenis) == '20' ? 'selected' : '' }}>
                                        SPAV</option>
                                    <option value="21"
                                        {{ old('lapisPermukaanJenis', $data->lapisPermukaanJenis) == '21' ? 'selected' : '' }}>
                                        Rigid</option>
                                </select>
                            </div>
                            <div>
                                <label for="lapisPermukaanLebar"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Lapis
                                    Permukaan
                                    Lebar</label>
                                <input type="text" id="lapisPermukaanLebar" name="lapisPermukaanLebar"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="4.5"
                                    value="{{ old('lapisPermukaanLebar', $data->lapisPermukaanLebar) }}" />
                            </div>
                            <div>
                                <label for="median"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kode
                                    Median</label>
                                <select id="median" name="median"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="" disabled selected>Pilih Median</option>
                                    <option value="0"
                                        {{ old('median', $data->median) == '0' ? 'selected' : '' }}>
                                        Tidak Ada
                                    </option>
                                    <option value="1"
                                        {{ old('median', $data->median) == '1' ? 'selected' : '' }}>
                                        1 < M</option>
                                    <option value="2"
                                        {{ old('median', $data->median) == '2' ? 'selected' : '' }}>
                                        1 - 3 M
                                    </option>
                                    <option value="3"
                                        {{ old('median', $data->median) == '3' ? 'selected' : '' }}>
                                        3 < M</option>
                                </select>
                            </div>
                            <div>
                                <label for="bahuKiriLebar"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Bahu Kiri
                                    Lebar</label>
                                <input type="text" id="bahuKiriLebar" name="bahuKiriLebar"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="4.5" value="{{ old('bahuKiriLebar', $data->bahuKiriLebar) }}" />
                            </div>
                            <div>
                                <label for="bahuKananLebar"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Bahu Kanan
                                    Lebar</label>
                                <input type="text" id="bahuKananLebar" name="bahuKananLebar"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="4.5" value="{{ old('bahuKananLebar', $data->bahuKananLebar) }}" />
                            </div>
                            <div>
                                <label for="bahuKiriJenis"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kode Jenis
                                    Bahu Kiri</label>
                                <select id="bahuKiriJenis" name="bahuKiriJenis"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="" disabled selected>Pilih Jenis Bahu</option>
                                    <option value="0"
                                        {{ old('bahuKiriJenis', $data->bahuKiriJenis) == '0' ? 'selected' : '' }}>Tidak
                                        Ada Bahu</option>
                                    <option value="1"
                                        {{ old('bahuKiriJenis', $data->bahuKiriJenis) == '1' ? 'selected' : '' }}>Bahu
                                        Lunak</option>
                                    <option value="2"
                                        {{ old('bahuKiriJenis', $data->bahuKiriJenis) == '2' ? 'selected' : '' }}>Bahu
                                        yang Diperkeras</option>
                                </select>
                            </div>
                            <div>
                                <label for="bahuKananJenis"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kode Jenis
                                    Bahu Kanan</label>
                                <select id="bahuKananJenis" name="bahuKananJenis"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="" disabled selected>Pilih Jenis Bahu</option>
                                    <option value="0"
                                        {{ old('bahuKananJenis', $data->bahuKananJenis) == '0' ? 'selected' : '' }}>
                                        Tidak
                                        Ada Bahu</option>
                                    <option value="1"
                                        {{ old('bahuKananJenis', $data->bahuKananJenis) == '1' ? 'selected' : '' }}>
                                        Bahu
                                        Lunak</option>
                                    <option value="2"
                                        {{ old('bahuKananJenis', $data->bahuKananJenis) == '2' ? 'selected' : '' }}>
                                        Bahu
                                        yang Diperkeras</option>
                                </select>
                            </div>
                            <div>
                                <label for="saluranKiriLebar"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Saluran Kiri
                                    Lebar</label>
                                <input type="number" id="saluranKiriLebar" name="saluranKiriLebar"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="40 cm"
                                    value="{{ old('saluranKiriLebar', $data->saluranKiriLebar) }}" />
                            </div>
                            <div>
                                <label for="saluranKananLebar"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Saluran Kanan
                                    Lebar</label>
                                <input type="number" id="saluranKananLebar" name="saluranKananLebar"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="40 cm"
                                    value="{{ old('saluranKananLebar', $data->saluranKananLebar) }}" />
                            </div>
                            <div>
                                <label for="saluranKiriDalam"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Saluran Kiri
                                    Dalam</label>
                                <input type="number" id="saluranKiriDalam" name="saluranKiriDalam"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="40 cm"
                                    value="{{ old('saluranKiriDalam', $data->saluranKiriDalam) }}" />
                            </div>
                            <div>
                                <label for="saluranKananDalam"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Saluran Kanan
                                    Dalam</label>
                                <input type="number" id="saluranKananDalam" name="saluranKananDalam"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="40 cm"
                                    value="{{ old('saluranKananDalam', $data->saluranKananDalam) }}" />
                            </div>
                            <div>
                                <label for="saluranKiriJenis"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kode Jenis
                                    Saluran Samping Kiri</label>
                                <select id="saluranKiriJenis" name="saluranKiriJenis"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="" disabled selected>Pilih Jenis Saluran Samping</option>
                                    <option value="0"
                                        {{ old('saluranKiriJenis', $data->saluranKiriJenis) == '0' ? 'selected' : '' }}>
                                        Tidak Ada</option>
                                    <option value="1"
                                        {{ old('saluranKiriJenis', $data->saluranKiriJenis) == '1' ? 'selected' : '' }}>
                                        Tanah Terbuka</option>
                                    <option value="2"
                                        {{ old('saluranKiriJenis', $data->saluranKiriJenis) == '2' ? 'selected' : '' }}>
                                        Beton/Pasir Batu Terbuka</option>
                                    <option value="3"
                                        {{ old('saluranKiriJenis', $data->saluranKiriJenis) == '3' ? 'selected' : '' }}>
                                        Saluran Irigasi</option>
                                    <option value="4"
                                        {{ old('saluranKiriJenis', $data->saluranKiriJenis) == '4' ? 'selected' : '' }}>
                                        Beton/Pasir Batu Tertutup</option>
                                </select>
                            </div>
                            <div>
                                <label for="saluranKananJenis"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kode Jenis
                                    Saluran Samping Kanan</label>
                                <select id="saluranKananJenis" name="saluranKananJenis"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="" disabled selected>Pilih Jenis Saluran Samping</option>
                                    <option value="0"
                                        {{ old('saluranKananJenis', $data->saluranKananJenis) == '0' ? 'selected' : '' }}>
                                        Tidak Ada</option>
                                    <option value="1"
                                        {{ old('saluranKananJenis', $data->saluranKananJenis) == '1' ? 'selected' : '' }}>
                                        Tanah Terbuka</option>
                                    <option value="2"
                                        {{ old('saluranKananJenis', $data->saluranKananJenis) == '2' ? 'selected' : '' }}>
                                        Beton/Pasir Batu Terbuka</option>
                                    <option value="3"
                                        {{ old('saluranKananJenis', $data->saluranKananJenis) == '3' ? 'selected' : '' }}>
                                        Saluran Irigasi</option>
                                    <option value="4"
                                        {{ old('saluranKananJenis', $data->saluranKananJenis) == '4' ? 'selected' : '' }}>
                                        Beton/Pasir Batu Tertutup</option>
                                </select>
                            </div>
                            <div>
                                <label for="tataKiri"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kode Tata Guna
                                    Lahan Kiri</label>
                                <select id="tataKiri" name="tataKiri"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="1"
                                        {{ old('tataKiri', $data->tataKiri) == '1' ? 'selected' : '' }}>Sawah
                                    </option>
                                    <option value="2"
                                        {{ old('tataKiri', $data->tataKiri) == '2' ? 'selected' : '' }}>Kebun
                                    </option>
                                    <option value="3"
                                        {{ old('tataKiri', $data->tataKiri) == '3' ? 'selected' : '' }}>Hutan
                                    </option>
                                    <option value="4"
                                        {{ old('tataKiri', $data->tataKiri) == '4' ? 'selected' : '' }}>Perumahan
                                    </option>
                                    <option value="5"
                                        {{ old('tataKiri', $data->tataKiri) == '5' ? 'selected' : '' }}>
                                        Perindustrian</option>
                                    <option value="6"
                                        {{ old('tataKiri', $data->tataKiri) == '6' ? 'selected' : '' }}>Pertokoan
                                    </option>
                                    <option value="7"
                                        {{ old('tataKiri', $data->tataKiri) == '7' ? 'selected' : '' }}>
                                        Perkantoran</option>
                                    <option value="8"
                                        {{ old('tataKiri', $data->tataKiri) == '8' ? 'selected' : '' }}>Pasar
                                    </option>
                                </select>
                            </div>
                            <div>
                                <label for="tataKanan"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kode Tata Guna
                                    Lahan Kanan</label>
                                <select id="tataKanan" name="tataKanan"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="" disabled selected>Pilih Tata Guna Lahan</option>
                                    <option value="1"
                                        {{ old('tataKanan', $data->tataKanan) == '1' ? 'selected' : '' }}>Sawah
                                    </option>
                                    <option value="2"
                                        {{ old('tataKanan', $data->tataKanan) == '2' ? 'selected' : '' }}>Kebun
                                    </option>
                                    <option value="3"
                                        {{ old('tataKanan', $data->tataKanan) == '3' ? 'selected' : '' }}>Hutan
                                    </option>
                                    <option value="4"
                                        {{ old('tataKanan', $data->tataKanan) == '4' ? 'selected' : '' }}>Perumahan
                                    </option>
                                    <option value="5"
                                        {{ old('tataKanan', $data->tataKanan) == '5' ? 'selected' : '' }}>
                                        Perindustrian</option>
                                    <option value="6"
                                        {{ old('tataKanan', $data->tataKanan) == '6' ? 'selected' : '' }}>Pertokoan
                                    </option>
                                    <option value="7"
                                        {{ old('tataKanan', $data->tataKanan) == '7' ? 'selected' : '' }}>
                                        Perkantoran</option>
                                    <option value="8"
                                        {{ old('tataKanan', $data->tataKanan) == '8' ? 'selected' : '' }}>Pasar
                                    </option>
                                </select>
                            </div>
                            <div>
                                <label for="alinyemenVertical"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Alignment
                                    Vertical
                                    (Kode Grade)</label>
                                <select id="alinyemenVertical" name="alinyemenVertical"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="" disabled selected>Alignment Vertical (Pilih Grade)</option>
                                    <option value="1"
                                        {{ old('alinyemenVertical', $data->alinyemenVertical) == '1' ? 'selected' : '' }}>
                                        Datar (F) (< 5.0 M/KM)</option>
                                    <option value="2"
                                        {{ old('alinyemenVertical', $data->alinyemenVertical) == '2' ? 'selected' : '' }}>
                                        Bukit (R) (5 - 45 M/KM)</option>
                                    <option value="3"
                                        {{ old('alinyemenVertical', $data->alinyemenVertical) == '3' ? 'selected' : '' }}>
                                        Gunung (H) (> 45 M/KM)</option>
                                </select>
                            </div>
                            <div>
                                <label for="alinyemenHorizontal"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Alignment
                                    Horizontal
                                    (Kode Belokan)</label>
                                <select id="alinyemenHorizontal" name="alinyemenHorizontal"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="" disabled selected>Alignment Horizontal (Pilih Belokan)
                                    </option>
                                    <option value="1"
                                        {{ old('alinyemenHorizontal', $data->alinyemenHorizontal) == '1' ? 'selected' : '' }}>
                                        Lurus (< 0.25 Rad/KM)</option>
                                    <option value="2"
                                        {{ old('alinyemenHorizontal', $data->alinyemenHorizontal) == '2' ? 'selected' : '' }}>
                                        Sedikit Belokan (0.25 - 3.50 Rad/KM)</option>
                                    <option value="3"
                                        {{ old('alinyemenHorizontal', $data->alinyemenHorizontal) == '3' ? 'selected' : '' }}>
                                        Banyak Belokan (> 3.50 Rad/KM)</option>
                                </select>
                            </div>
                            <div>
                                <label for="terrainKiri"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kode
                                    Terrain Kiri</label>
                                <select id="terrainKiri" name="terrainKiri"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="" disabled selected>Pilih Terrain Kiri</option>
                                    <option value="L1"
                                        {{ old('terrainKiri', $data->terrainKiri) == 'L1' ? 'selected' : '' }}>
                                        (Lembah) Datar (F) < 1.0 M</option>
                                    <option value="L2"
                                        {{ old('terrainKiri', $data->terrainKiri) == 'L2' ? 'selected' : '' }}>
                                        (Lembah) Bukit (R) 1.0 M < Bukit < 3.0 M</option>
                                    <option value="L3"
                                        {{ old('terrainKiri', $data->terrainKiri) == 'L3' ? 'selected' : '' }}>
                                        (Lembah) Gunung (H) > 3.0 M</option>
                                    <option value="T1"
                                        {{ old('terrainKiri', $data->terrainKiri) == 'T1' ? 'selected' : '' }}>
                                        (Tebing) Datar (F) < 1.0 M</option>
                                    <option value="T2"
                                        {{ old('terrainKiri', $data->terrainKiri) == 'T2' ? 'selected' : '' }}>
                                        (Tebing) Bukit (R) 1.0 M < Bukit < 3.0 M</option>
                                    <option value="T3"
                                        {{ old('terrainKiri', $data->terrainKiri) == 'T3' ? 'selected' : '' }}>
                                        (Tebing) Gunung (H) > 3.0 M</option>
                                </select>
                            </div>
                            <div>
                                <label for="terrainKanan"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kode
                                    Terrain Kanan</label>
                                <select id="terrainKanan" name="terrainKanan"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="" disabled selected>Pilih Terrain Kanan</option>
                                    <option value="L1"
                                        {{ old('terrainKanan', $data->terrainKanan) == 'L1' ? 'selected' : '' }}>
                                        (Lembah) Datar (F) < 1.0 M</option>
                                    <option value="L2"
                                        {{ old('terrainKanan', $data->terrainKanan) == 'L2' ? 'selected' : '' }}>
                                        (Lembah) Bukit (R) 1.0 M < Bukit < 3.0 M</option>
                                    <option value="L3"
                                        {{ old('terrainKanan', $data->terrainKanan) == 'L3' ? 'selected' : '' }}>
                                        (Lembah) Gunung (H) > 3.0 M</option>
                                    <option value="T1"
                                        {{ old('terrainKanan', $data->terrainKanan) == 'T1' ? 'selected' : '' }}>
                                        (Tebing) Datar (F) < 1.0 M</option>
                                    <option value="T2"
                                        {{ old('terrainKanan', $data->terrainKanan) == 'T2' ? 'selected' : '' }}>
                                        (Tebing) Bukit (R) 1.0 M < Bukit < 3.0 M</option>
                                    <option value="T3"
                                        {{ old('terrainKanan', $data->terrainKanan) == 'T3' ? 'selected' : '' }}>
                                        (Tebing) Gunung (H) > 3.0 M</option>
                                </select>
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
