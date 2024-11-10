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
                    <form action="{{ route('dataInventarisJalan.store') }}" method="post">
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
                                            {{ old('road_inventory_id') == $street->id ? 'selected' : '' }}>
                                            {{ $street->noRuas }} - {{ $street->namaRuas }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="dariSta"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Dari
                                    STA</label>
                                <select id="dariSta" name="dariSta"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="" disabled selected>Pilih STA</option>
                                    <option value="0+000" {{ old('dariSta') == '0+000' ? 'selected' : '' }}>0+000
                                    </option>
                                    <option value="0+100" {{ old('dariSta') == '0+100' ? 'selected' : '' }}>0+100
                                    </option>
                                    <option value="0+200" {{ old('dariSta') == '0+200' ? 'selected' : '' }}>0+200
                                    </option>
                                    <option value="0+300" {{ old('dariSta') == '0+300' ? 'selected' : '' }}>0+300
                                    </option>
                                    <option value="0+400" {{ old('dariSta') == '0+400' ? 'selected' : '' }}>0+400
                                    </option>
                                    <option value="0+500" {{ old('dariSta') == '0+500' ? 'selected' : '' }}>0+500
                                    </option>
                                    <option value="0+600" {{ old('dariSta') == '0+600' ? 'selected' : '' }}>0+600
                                    </option>
                                    <option value="0+700" {{ old('dariSta') == '0+700' ? 'selected' : '' }}>0+700
                                    </option>
                                    <option value="0+800" {{ old('dariSta') == '0+800' ? 'selected' : '' }}>0+800
                                    </option>
                                    <option value="0+900" {{ old('dariSta') == '0+900' ? 'selected' : '' }}>0+900
                                    </option>
                                    <option value="1+000" {{ old('dariSta') == '1+000' ? 'selected' : '' }}>1+000
                                    </option>
                                </select>
                            </div>
                            <div>
                                <label for="tipeJalan"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kode Tipe
                                    Jalan</label>
                                <select id="tipeJalan" name="tipeJalan"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="" disabled selected>Pilih Tipe Jalan</option>
                                    <option value="1" {{ old('tipeJalan') == '1' ? 'selected' : '' }}>2 / 1 UD
                                    </option>
                                    <option value="2" {{ old('tipeJalan') == '2' ? 'selected' : '' }}>2 / 2 UD
                                    </option>
                                    <option value="3" {{ old('tipeJalan') == '3' ? 'selected' : '' }}>4 / 2 UD
                                    </option>
                                    <option value="4" {{ old('tipeJalan') == '4' ? 'selected' : '' }}>4 / 2 D
                                    </option>
                                    <option value="5" {{ old('tipeJalan') == '5' ? 'selected' : '' }}>6 / 2 D
                                    </option>
                                </select>
                            </div>
                            <div>
                                <label for="keSta"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ke STA</label>
                                <select id="keSta" name="keSta"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="" disabled selected>Pilih STA</option>
                                    <option value="0+100" {{ old('keSta') == '0+100' ? 'selected' : '' }}>0+100
                                    </option>
                                    <option value="0+200" {{ old('keSta') == '0+200' ? 'selected' : '' }}>0+200
                                    </option>
                                    <option value="0+300" {{ old('keSta') == '0+300' ? 'selected' : '' }}>0+300
                                    </option>
                                    <option value="0+400" {{ old('keSta') == '0+400' ? 'selected' : '' }}>0+400
                                    </option>
                                    <option value="0+500" {{ old('keSta') == '0+500' ? 'selected' : '' }}>0+500
                                    </option>
                                    <option value="0+600" {{ old('keSta') == '0+600' ? 'selected' : '' }}>0+600
                                    </option>
                                    <option value="0+700" {{ old('keSta') == '0+700' ? 'selected' : '' }}>0+700
                                    </option>
                                    <option value="0+800" {{ old('keSta') == '0+800' ? 'selected' : '' }}>0+800
                                    </option>
                                    <option value="0+900" {{ old('keSta') == '0+900' ? 'selected' : '' }}>0+900
                                    </option>
                                    <option value="1+000" {{ old('keSta') == '1+000' ? 'selected' : '' }}>1+000
                                    </option>
                                    <option value="1+100" {{ old('keSta') == '1+100' ? 'selected' : '' }}>1+100
                                    </option>
                                </select>
                            </div>
                            <div>
                                <label for="lapisPermukaanTahun"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Lapis Permukaan
                                    Tahun</label>
                                <input type="number" id="lapisPermukaanTahun" name="lapisPermukaanTahun"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="2020" value="{{ old('lapisPermukaanTahun') }}" />
                            </div>
                            <div>
                                <label for="lapisPermukaanJenis"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Lapis Permukaan
                                    Jenis</label>
                                <select id="lapisPermukaanJenis" name="lapisPermukaanJenis"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="" disabled selected>Pilih Jenis Permukaan</option>
                                    <option value="0" {{ old('lapisPermukaanJenis') == '0' ? 'selected' : '' }}>
                                        Tidak Diketahui</option>
                                    <option value="1" {{ old('lapisPermukaanJenis') == '1' ? 'selected' : '' }}>
                                        Tanah</option>
                                    <option value="2" {{ old('lapisPermukaanJenis') == '2' ? 'selected' : '' }}>
                                        Japat (AWCAS) / Kerikil</option>
                                    <option value="3" {{ old('lapisPermukaanJenis') == '3' ? 'selected' : '' }}>
                                        Telford / Macadam Terbuka</option>
                                    <option value="4" {{ old('lapisPermukaanJenis') == '4' ? 'selected' : '' }}>
                                        Burtu</option>
                                    <option value="5" {{ old('lapisPermukaanJenis') == '5' ? 'selected' : '' }}>
                                        Burda</option>
                                    <option value="6" {{ old('lapisPermukaanJenis') == '6' ? 'selected' : '' }}>
                                        Penetrasi Macadam 1 Lapis</option>
                                    <option value="7" {{ old('lapisPermukaanJenis') == '7' ? 'selected' : '' }}>
                                        Penetrasi Macadam 2 Lapis</option>
                                    <option value="8" {{ old('lapisPermukaanJenis') == '8' ? 'selected' : '' }}>
                                        Lasbutag (BUTAS)</option>
                                    <option value="9" {{ old('lapisPermukaanJenis') == '9' ? 'selected' : '' }}>
                                        Aspal Beton (A.C.)</option>
                                    <option value="10" {{ old('lapisPermukaanJenis') == '10' ? 'selected' : '' }}>
                                        Latasbum (NACAS)</option>
                                    <option value="11" {{ old('lapisPermukaanJenis') == '11' ? 'selected' : '' }}>
                                        Lataston (HRS)</option>
                                    <option value="12" {{ old('lapisPermukaanJenis') == '12' ? 'selected' : '' }}>
                                        HRSSA</option>
                                    <option value="13" {{ old('lapisPermukaanJenis') == '13' ? 'selected' : '' }}>
                                        Slurry Seal</option>
                                    <option value="14" {{ old('lapisPermukaanJenis') == '14' ? 'selected' : '' }}>
                                        Macro Seal</option>
                                    <option value="15" {{ old('lapisPermukaanJenis') == '15' ? 'selected' : '' }}>
                                        Micro Asbuton</option>
                                    <option value="16" {{ old('lapisPermukaanJenis') == '16' ? 'selected' : '' }}>
                                        DGEM</option>
                                    <option value="17" {{ old('lapisPermukaanJenis') == '17' ? 'selected' : '' }}>
                                        SMA</option>
                                    <option value="18" {{ old('lapisPermukaanJenis') == '18' ? 'selected' : '' }}>
                                        BMA</option>
                                    <option value="19" {{ old('lapisPermukaanJenis') == '19' ? 'selected' : '' }}>
                                        HSWC</option>
                                    <option value="20" {{ old('lapisPermukaanJenis') == '20' ? 'selected' : '' }}>
                                        SPAV</option>
                                    <option value="21" {{ old('lapisPermukaanJenis') == '21' ? 'selected' : '' }}>
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
                                    placeholder="4.5" value="{{ old('lapisPermukaanLebar') }}" />
                            </div>
                            <div>
                                <label for="median"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kode
                                    Median</label>
                                <select id="median" name="median"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="" disabled selected>Pilih Median</option>
                                    <option value="0" {{ old('median') == '0' ? 'selected' : '' }}>Tidak Ada
                                    </option>
                                    <option value="1" {{ old('median') == '1' ? 'selected' : '' }}>1 < M</option>
                                    <option value="2" {{ old('median') == '2' ? 'selected' : '' }}>1 - 3 M
                                    </option>
                                    <option value="3" {{ old('median') == '3' ? 'selected' : '' }}>3 < M</option>
                                </select>
                            </div>
                            <div>
                                <label for="bahuKiriTahun"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Bahu Kiri
                                    Tahun</label>
                                <input type="text" id="bahuKiriTahun" name="bahuKiriTahun"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="2020" value="{{ old('bahuKiriTahun') }}" />
                            </div>
                            <div>
                                <label for="bahuKananTahun"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Bahu Kanan
                                    Tahun</label>
                                <input type="text" id="bahuKananTahun" name="bahuKananTahun"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="2020" value="{{ old('bahuKananTahun') }}" />
                            </div>
                            <div>
                                <label for="bahuKiriLebar"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Bahu Kiri
                                    Lebar</label>
                                <input type="text" id="bahuKiriLebar" name="bahuKiriLebar"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="4.5" value="{{ old('bahuKiriLebar') }}" />
                            </div>
                            <div>
                                <label for="bahuKananLebar"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Bahu Kanan
                                    Lebar</label>
                                <input type="text" id="bahuKananLebar" name="bahuKananLebar"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="4.5" value="{{ old('bahuKananLebar') }}" />
                            </div>
                            <div>
                                <label for="bahuKiriJenis"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kode Jenis
                                    Bahu Kiri</label>
                                <select id="bahuKiriJenis" name="bahuKiriJenis"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="" disabled selected>Pilih Jenis Bahu</option>
                                    <option value="0" {{ old('bahuKiriJenis') == '0' ? 'selected' : '' }}>Tidak
                                        Ada Bahu</option>
                                    <option value="1" {{ old('bahuKiriJenis') == '1' ? 'selected' : '' }}>Bahu
                                        Lunak</option>
                                    <option value="2" {{ old('bahuKiriJenis') == '2' ? 'selected' : '' }}>Bahu
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
                                    <option value="0" {{ old('bahuKananJenis') == '0' ? 'selected' : '' }}>Tidak
                                        Ada Bahu</option>
                                    <option value="1" {{ old('bahuKananJenis') == '1' ? 'selected' : '' }}>Bahu
                                        Lunak</option>
                                    <option value="2" {{ old('bahuKananJenis') == '2' ? 'selected' : '' }}>Bahu
                                        yang Diperkeras</option>
                                </select>
                            </div>
                            <div>
                                <label for="saluranKiriLebar"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Saluran Kiri
                                    Lebar</label>
                                <input type="number" id="saluranKiriLebar" name="saluranKiriLebar"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="40 cm" value="{{ old('saluranKiriLebar') }}" />
                            </div>
                            <div>
                                <label for="saluranKananLebar"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Saluran Kanan
                                    Lebar</label>
                                <input type="number" id="saluranKananLebar" name="saluranKananLebar"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="40 cm" value="{{ old('saluranKananLebar') }}" />
                            </div>
                            <div>
                                <label for="saluranKiriDalam"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Saluran Kiri
                                    Dalam</label>
                                <input type="number" id="saluranKiriDalam" name="saluranKiriDalam"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="40 cm" value="{{ old('saluranKiriDalam') }}" />
                            </div>
                            <div>
                                <label for="saluranKananDalam"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Saluran Kanan
                                    Dalam</label>
                                <input type="number" id="saluranKananDalam" name="saluranKananDalam"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="40 cm" value="{{ old('saluranKananDalam') }}" />
                            </div>
                            <div>
                                <label for="saluranKiriJenis"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kode Jenis
                                    Saluran Samping Kiri</label>
                                <select id="saluranKiriJenis" name="saluranKiriJenis"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="" disabled selected>Pilih Jenis Saluran Samping</option>
                                    <option value="0" {{ old('saluranKiriJenis') == '0' ? 'selected' : '' }}>
                                        Tidak Ada</option>
                                    <option value="1" {{ old('saluranKiriJenis') == '1' ? 'selected' : '' }}>
                                        Tanah Terbuka</option>
                                    <option value="2" {{ old('saluranKiriJenis') == '2' ? 'selected' : '' }}>
                                        Beton/Pasir Batu Terbuka</option>
                                    <option value="3" {{ old('saluranKiriJenis') == '3' ? 'selected' : '' }}>
                                        Saluran Irigasi</option>
                                    <option value="4" {{ old('saluranKiriJenis') == '4' ? 'selected' : '' }}>
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
                                    <option value="0" {{ old('saluranKananJenis') == '0' ? 'selected' : '' }}>
                                        Tidak Ada</option>
                                    <option value="1" {{ old('saluranKananJenis') == '1' ? 'selected' : '' }}>
                                        Tanah Terbuka</option>
                                    <option value="2" {{ old('saluranKananJenis') == '2' ? 'selected' : '' }}>
                                        Beton/Pasir Batu Terbuka</option>
                                    <option value="3" {{ old('saluranKananJenis') == '3' ? 'selected' : '' }}>
                                        Saluran Irigasi</option>
                                    <option value="4" {{ old('saluranKananJenis') == '4' ? 'selected' : '' }}>
                                        Beton/Pasir Batu Tertutup</option>
                                </select>
                            </div>
                            <div>
                                <label for="tataKiri"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kode Tata Guna
                                    Lahan Kiri</label>
                                <select id="tataKiri" name="tataKiri"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="" disabled selected>Pilih Tata Guna Lahan</option>
                                    <option value="1" {{ old('tataKiri') == '1' ? 'selected' : '' }}>Sawah /
                                        Kebun / Hutan (Rural)</option>
                                    <option value="2" {{ old('tataKiri') == '2' ? 'selected' : '' }}>Perumahan
                                        (Urban 1)</option>
                                    <option value="3" {{ old('tataKiri') == '3' ? 'selected' : '' }}>
                                        Perindustrian (Urban 2)</option>
                                    <option value="4" {{ old('tataKiri') == '4' ? 'selected' : '' }}>Pertokoan /
                                        Perkantoran / Pasar (Urban 3)</option>
                                </select>
                            </div>
                            <div>
                                <label for="tataKanan"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kode Tata Guna
                                    Lahan Kanan</label>
                                <select id="tataKanan" name="tataKanan"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="" disabled selected>Pilih Tata Guna Lahan</option>
                                    <option value="1" {{ old('tataKanan') == '1' ? 'selected' : '' }}>Sawah /
                                        Kebun / Hutan (Rural)</option>
                                    <option value="2" {{ old('tataKanan') == '2' ? 'selected' : '' }}>Perumahan
                                        (Urban 1)</option>
                                    <option value="3" {{ old('tataKanan') == '3' ? 'selected' : '' }}>
                                        Perindustrian (Urban 2)</option>
                                    <option value="4" {{ old('tataKanan') == '4' ? 'selected' : '' }}>Pertokoan /
                                        Perkantoran / Pasar (Urban 3)</option>
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
                                    <option value="1" {{ old('alinyemenVertical') == '1' ? 'selected' : '' }}>
                                        Datar (F) (< 5.0 M/KM)</option>
                                    <option value="2" {{ old('alinyemenVertical') == '2' ? 'selected' : '' }}>
                                        Bukit (R) (5 - 45 M/KM)</option>
                                    <option value="3" {{ old('alinyemenVertical') == '3' ? 'selected' : '' }}>
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
                                    <option value="1" {{ old('alinyemenHorizontal') == '1' ? 'selected' : '' }}>
                                        Lurus (< 0.25 Rad/KM)</option>
                                    <option value="2" {{ old('alinyemenHorizontal') == '2' ? 'selected' : '' }}>
                                        Sedikit Belokan (0.25 - 3.50 Rad/KM)</option>
                                    <option value="3" {{ old('alinyemenHorizontal') == '3' ? 'selected' : '' }}>
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
                                    <option value="L1" {{ old('terrainKiri') == 'L1' ? 'selected' : '' }}>
                                        (Lembah) Datar (F) < 1.0 M</option>
                                    <option value="L2" {{ old('terrainKiri') == 'L2' ? 'selected' : '' }}>
                                        (Lembah) Bukit (R) 1.0 M < Bukit < 3.0 M</option>
                                    <option value="L3" {{ old('terrainKiri') == 'L3' ? 'selected' : '' }}>
                                        (Lembah) Gunung (H) > 3.0 M</option>
                                    <option value="T1" {{ old('terrainKiri') == 'T1' ? 'selected' : '' }}>
                                        (Tebing) Datar (F) < 1.0 M</option>
                                    <option value="T2" {{ old('terrainKiri') == 'T2' ? 'selected' : '' }}>
                                        (Tebing) Bukit (R) 1.0 M < Bukit < 3.0 M</option>
                                    <option value="T3" {{ old('terrainKiri') == 'T3' ? 'selected' : '' }}>
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
                                    <option value="L1" {{ old('terrainKanan') == 'L1' ? 'selected' : '' }}>
                                        (Lembah) Datar (F) < 1.0 M</option>
                                    <option value="L2" {{ old('terrainKanan') == 'L2' ? 'selected' : '' }}>
                                        (Lembah) Bukit (R) 1.0 M < Bukit < 3.0 M</option>
                                    <option value="L3" {{ old('terrainKanan') == 'L3' ? 'selected' : '' }}>
                                        (Lembah) Gunung (H) > 3.0 M</option>
                                    <option value="T1" {{ old('terrainKanan') == 'T1' ? 'selected' : '' }}>
                                        (Tebing) Datar (F) < 1.0 M</option>
                                    <option value="T2" {{ old('terrainKanan') == 'T2' ? 'selected' : '' }}>
                                        (Tebing) Bukit (R) 1.0 M < Bukit < 3.0 M</option>
                                    <option value="T3" {{ old('terrainKanan') == 'T3' ? 'selected' : '' }}>
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
