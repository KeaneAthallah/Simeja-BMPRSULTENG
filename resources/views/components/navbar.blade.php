<nav class="w-full bg-nord4 text-nord0 dark:bg-nord3 dark:text-nord6" x-data="{ isOpen: false }">
    <div class="container sm:max-w-screen-sm md:max-w-screen-md lg:max-w-screen-xl mx-auto p-4">
        <div class="flex h-16 items-center justify-between">
            <a href="{{ url('/') }}">
                <div class="flex items-center">
                    <span class="hidden md:block font-bold ml-3">SiMeja | BMPR SULTENG</span>
                    <div class="ml-3 flex-shrink-0">
                        <img class="w-8" src="{{ asset('assets/images/logo.png') }}" alt="Your Company">
                    </div>
                </div>
            </a>

            <div class="hidden md:block">
                <div class="ml-4 flex items-center md:ml-6">
                    <div class="relative ml-3 flex">
                        <div class="flex flex-row-reverse gap-3">
                            <button type="button" @click="isOpen = !isOpen"
                                class="relative flex max-w-xs items-center rounded-full bg-nord6 text-nord0 dark:text-nord6 text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-nord0 mr-3"
                                id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                                <span class="sr-only">Open user menu</span>
                                <div class="px-3 py-2 text-nord0 uppercase">{{ auth()->user()->name }}</div>
                            </button>
                            <button onclick="toggleDarkMode()"
                                class="h-10 w-10 rounded-lg p-2 hover:bg-gray-100 dark:hover:bg-gray-700">
                                <svg class="fill-violet-700 block dark:hidden" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                                </svg>
                                <svg class="fill-yellow-500 hidden dark:block" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"
                                        fill-rule="evenodd" clip-rule="evenodd"></path>
                                </svg>
                            </button>
                        </div>
                        <div x-show="isOpen" x-transition:enter="transition ease-out duration-100 transform"
                            x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75 transform"
                            x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                            class="absolute right-0 z-10 mt-12 w-48 origin-top-right rounded-md bg-nord6 dark:bg-nord0 py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                            role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button"
                            tabindex="-1">
                            <a href="{{ route('profile.edit') }}"
                                class="block px-4 py-2 text-sm text-nord0 dark:text-nord6" role="menuitem"
                                tabindex="-1" id="user-menu-item-0">Your Profile</a>
                            <form action="{{ route('logout') }}" method="post">
                                @csrf
                                <button class="block px-4 py-2 text-sm text-nord0 dark:text-nord6" role="menuitem"
                                    tabindex="-1" id="user-menu-item-2">
                                    Sign out
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="-mr-2 flex md:hidden gap-3 flex-row-reverse">
                <button type="button" @click="isOpen = !isOpen"
                    class="relative inline-flex items-center justify-center rounded-md bg-nord7 p-2 text-nord0 dark:text-nord6 hover:bg-nord8 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-nord6"
                    aria-controls="mobile-menu" aria-expanded="false">
                    <span class="absolute -inset-0.5"></span>
                    <span class="sr-only">Open main menu</span>
                    <svg :class="{ 'hidden': isOpen, 'block': !isOpen }" class="block h-6 w-6" fill="none"
                        viewBox="0 0 24 24" stroke-width="1.5" stroke="white" aria-hidden="true" data-slot="icon">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.75 5.75h16.5m-16.5 6h16.5m-16.5 6h16.5" />
                    </svg>
                    <svg :class="{ 'hidden': !isOpen, 'block': isOpen }" class="hidden h-6 w-6" fill="none"
                        viewBox="0 0 24 24" stroke-width="1.5" stroke="white" aria-hidden="true" data-slot="icon">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
                <button onclick="toggleDarkMode()"
                    class="h-10 w-10 rounded-lg p-2 hover:bg-gray-100 dark:hover:bg-gray-700">
                    <svg class="fill-violet-700 block dark:hidden" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                    </svg>
                    <svg class="fill-yellow-500 hidden dark:block" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"
                            fill-rule="evenodd" clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile menu, show/hide based on menu state. -->
    <div id="mobile-menu" class="md:hidden bg-nord4 dark:bg-nord3 py-4" x-show="isOpen"
        x-transition:enter="transition ease-out duration-100 transform" x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-75 transform"
        x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95">
        <div class="space-y-1 px-2">
            <a href="{{ route('dashboard') }}"
                class="{{ request()->routeIs('dashboard') ? 'bg-nord7 text-nord0' : 'text-nord0 dark:text-nord6 hover:bg-nord9 hover:text-white' }} block rounded-md px-3 py-2 text-sm font-medium">Dashboard</a>
            <a href="{{ route('aspirasi.index') }}"
                class="{{ request()->routeIs('aspirasi.index') ? 'bg-nord7 text-nord0' : 'text-nord0 dark:text-nord6 hover:bg-nord9 hover:text-white' }} block rounded-md px-3 py-2 text-sm font-medium">Aspirasi</a>
            <a href="{{ route('webgis.index') }}"
                class="{{ request()->routeIs('webgis.index') ? 'bg-nord7 text-nord0' : 'text-nord0 dark:text-nord6 hover:bg-nord9 hover:text-white' }} block rounded-md px-3 py-2 text-sm font-medium">WebGis</a>

            <!-- Admin Role Menu -->
            @if (auth()->user()->role == 'admin')
                <div class="relative">
                    <button type="button" data-dropdown-toggle="mobileDropdownAdmin"
                        class="block w-full text-left rounded-md bg-nord6 dark:bg-gray-700 px-3 py-2 text-sm font-medium text-nord0 dark:text-nord6">
                        Pengaturan
                    </button>
                    <div id="mobileDropdownAdmin"
                        class="hidden bg-white dark:bg-gray-900 rounded-md shadow-md mt-5 z-50">
                        <a href="{{ route('inventarisJalan.index') }}"
                            class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-600">Inventarisasi
                            Jaringan</a>
                        <a href="{{ route('jalanAspal.index') }}"
                            class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-600">Aspal</a>
                        <a href="{{ route('jalanTanah.index') }}"
                            class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-600">Tanah/Kerikil</a>
                        <a href="#"
                            class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-600">Jembatan</a>
                    </div>
                </div>
            @endif

            <!-- Admin or Staff Role Menu -->
            @if (auth()->user()->role == 'admin' || auth()->user()->role == 'staff')
                <div class="relative z-0">
                    <button type="button" data-dropdown-toggle="mobileDropdownSurveyData"
                        class="block w-full text-left rounded-md bg-nord6 dark:bg-gray-700 px-3 py-2 text-sm font-medium text-nord0 dark:text-nord6">
                        Data Survey
                    </button>
                    <div id="mobileDropdownSurveyData"
                        class="hidden bg-white dark:bg-gray-900 rounded-md shadow-md mt-1">
                        <a href="{{ route('dataInventarisJalan.index') }}"
                            class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-600">Inventarisasi
                            Jaringan</a>
                        <a href="{{ route('dataJalanAspal.index') }}"
                            class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-600">Aspal</a>
                        <a href="{{ route('dataJalanTanah.index') }}"
                            class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-600">Tanah/Kerikil</a>
                        <a href="#"
                            class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-600">Jembatan</a>
                    </div>
                </div>
            @endif

            <!-- Users Link for Admin -->
            @if (auth()->user()->role == 'admin')
                <a href="{{ route('dashboard.users') }}"
                    class="{{ request()->routeIs('dashboard.users') ? 'bg-nord7 text-nord0' : 'text-nord0 dark:text-nord6 hover:bg-nord9 hover:text-white' }} block rounded-md px-3 py-2 text-sm font-medium">Users</a>
            @endif
            <a href="{{ route('profile.edit') }}"
                class="{{ request()->routeIs('profile.edit') ? 'bg-nord7 text-nord0' : 'text-nord0 dark:text-nord6 hover:bg-nord9 hover:text-white' }} block rounded-md px-3 py-2 text-sm font-medium">Your
                Profile</a>
            <form action="{{ route('logout') }}" method="post">
                @csrf
                <button
                    class="text-nord0 dark:text-nord6 hover:bg-nord9 hover:text-white block rounded-md px-3 py-2 text-sm font-medium"
                    role="menuitem" tabindex="-1" id="user-menu-item-2">
                    Sign out
                </button>
            </form>
        </div>
    </div>
</nav>
