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
             <a href="{{ route('survey.index') }}"
                 class="{{ request()->routeIs('survey.index') ? 'bg-nord7 text-nord0' : 'text-nord0 dark:text-nord6 hover:bg-nord9 hover:text-white' }} rounded-md px-3 py-2 text-sm font-medium ">Data
                 Survey</a>
             <a href="{{ route('handling.index') }}"
                 class="{{ request()->routeIs('handling.index') ? 'bg-nord7 text-nord0' : 'text-nord0 dark:text-nord6 hover:bg-nord9 hover:text-white' }} rounded-md px-3 py-2 text-sm font-medium ">Penanganan</a>
             <a href="{{ route('laporan.index') }}"
                 class="{{ request()->routeIs('laporan.index') ? 'bg-nord7 text-nord0' : 'text-nord0 dark:text-nord6 hover:bg-nord9 hover:text-white' }} rounded-md px-3 py-2 text-sm font-medium ">Laporan</a>
             {{-- <a href="#" class="rounded-md px-3 py-2 text-sm font-medium ">Data
                 Induk</a> --}}
         </div>
     </div>
 </header>
