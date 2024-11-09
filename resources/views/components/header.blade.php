 <header class="bg-nord6 dark:bg-nord2 shadow">
     <div class="hidden md:block py-2 ">
         <div class="ml-10 flex items-baseline space-x-4">
             <!-- Current: "bg-nord7 px-3 py-2 text-sm font-medium text-nord0", Default: "text-nord0 dark:text-nord6 hover:bg-nord9 hover:text-white" -->
             <a href="{{ route('dashboard') }}"
                 class="{{ request()->routeIs('dashboard') ? 'bg-nord7 text-nord0' : 'text-nord0 dark:text-nord6 hover:bg-nord9 hover:text-white' }} rounded-md  px-3 py-2 text-sm font-medium ">Dashboard</a>
             <a href="{{ route('aspirasi.index') }}"
                 class="{{ request()->routeIs('aspirasi.index') ? 'bg-nord7 text-nord0' : 'text-nord0 dark:text-nord6 hover:bg-nord9 hover:text-white' }} rounded-md px-3 py-2 text-sm font-medium ">Aspirasi</a>
             <a href="{{ route('webgis.index') }}"
                 class="{{ request()->routeIs('webgis.index') ? 'bg-nord7 text-nord0' : 'text-nord0 dark:text-nord6 hover:bg-nord9 hover:text-white' }} rounded-md px-3 py-2 text-sm font-medium ">WebGis</a>
             @if (auth()->user()->role == 'admin')
                 <button id="multiLevelDropdownButton" data-dropdown-toggle="multi-dropdown"
                     class="font-medium rounded-lg text-sm  text-center inline-flex items-center  {{ request()->routeIs('jalanAspal.index') || request()->routeIs('jalanTanah.index') ? 'bg-nord7 text-nord0' : 'text-nord0 dark:text-nord6 hover:bg-nord9 hover:text-white' }} rounded-md px-3 py-2 text-sm font-medium"
                     type="button">Data Survey <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true"
                         xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                         <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                             d="m1 1 4 4 4-4" />
                     </svg>
                 </button>

                 <!-- Dropdown menu -->
                 <div id="multi-dropdown"
                     class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                     <ul class="py-2 text-sm text-gray-700 dark:text-gray-200"
                         aria-labelledby="multiLevelDropdownButton">
                         <li>
                             <button id="doubleDropdownButton" data-dropdown-toggle="doubleDropdown"
                                 data-dropdown-placement="right-start" type="button"
                                 class="flex items-center justify-between w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Jalan<svg
                                     class="w-2.5 h-2.5 ms-3 rtl:rotate-180" aria-hidden="true"
                                     xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                     <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                         stroke-width="2" d="m1 9 4-4-4-4" />
                                 </svg></button>
                             <div id="doubleDropdown"
                                 class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-60 dark:bg-gray-700">
                                 <ul class="py-2 text-sm text-gray-700 dark:text-gray-200"
                                     aria-labelledby="doubleDropdownButton">
                                     <li>
                                         <a href="{{ route('inventarisJalan.index') }}"
                                             class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Inventarisasi
                                             jaringan</a>
                                     </li>
                                     <li>
                                         <a href="{{ route('jalanAspal.index') }}"
                                             class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Aspal</a>
                                     </li>
                                     <li>
                                         <a href="{{ route('jalanTanah.index') }}"
                                             class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Tanah/Kerikil</a>
                                     </li>
                                 </ul>
                             </div>
                         </li>
                         <li>
                             <a href="#"
                                 class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Jembatan</a>
                         </li>
                     </ul>
                 </div>
             @else
                 <button id="multiLevelDropdownButton" data-dropdown-toggle="multi-dropdown1"
                     class="font-medium rounded-lg text-sm  text-center inline-flex items-center  {{ request()->routeIs('jalanAspalData.index') ? 'bg-nord7 text-nord0' : 'text-nord0 dark:text-nord6 hover:bg-nord9 hover:text-white' }} rounded-md px-3 py-2 text-sm font-medium"
                     type="button">Penanganan <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true"
                         xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                         <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                             d="m1 1 4 4 4-4" />
                     </svg>
                 </button>

                 <!-- Dropdown menu -->
                 <div id="multi-dropdown1"
                     class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                     <ul class="py-2 text-sm text-gray-700 dark:text-gray-200"
                         aria-labelledby="multiLevelDropdownButton">
                         <li>
                             <button id="doubleDropdownButton" data-dropdown-toggle="doubleDropdown1"
                                 data-dropdown-placement="right-start" type="button"
                                 class="flex items-center justify-between w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Jalan<svg
                                     class="w-2.5 h-2.5 ms-3 rtl:rotate-180" aria-hidden="true"
                                     xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                     <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                         stroke-width="2" d="m1 9 4-4-4-4" />
                                 </svg></button>
                             <div id="doubleDropdown1"
                                 class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-60 dark:bg-gray-700">
                                 <ul class="py-2 text-sm text-gray-700 dark:text-gray-200"
                                     aria-labelledby="doubleDropdownButton">
                                     <li>
                                         <a href="#"
                                             class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Inventarisasi
                                             jaringan</a>
                                     </li>
                                     <li>
                                         <a href="{{ route('dataJalanAspal.index') }}"
                                             class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Aspal</a>
                                     </li>
                                     <li>
                                         <a href="#"
                                             class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Tanah/Kerikil</a>
                                     </li>
                                 </ul>
                             </div>
                         </li>
                         <li>
                             <a href="#"
                                 class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Jembatan</a>
                         </li>
                     </ul>
                 </div>
             @endif



         </div>
     </div>
 </header>
