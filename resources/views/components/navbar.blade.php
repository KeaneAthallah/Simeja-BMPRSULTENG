<nav class="container bg-nord4 text-nord0  dark:bg-nord3 dark:text-nord6" x-data="{ isOpen: false }">
    <div class="sm:max-w-screen-sm md:max-w-screen-md lg:max-w-screen-xl mx-auto p-4">
        <div class="flex h-16 items-center justify-between">
            <a href="{{ url('/') }}">
                <div class="flex items-center -ml-28">
                    <span class="hidden md:block font-bold ml-3">SiMeja | BMPR SULTENG</span>
                    <div class="ml-3 flex-shrink-0">
                        <img class=" w-8" src="{{ asset('assets/images/logo.png') }}" alt="Your Company">
                    </div>
                </div>
            </a>

            <div class="hidden md:block">
                <div class="ml-4 flex items-center md:ml-6 ">

                    <!-- Profile dropdown -->
                    <div class="relative ml-3 -mr-32 flex">
                        <div>
                            <button type="button" @click="isOpen = !isOpen"
                                class="relative flex max-w-xs items-center rounded-full bg-nord6 text-nord0 dark:text-nord6 text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-nord0 mr-3"
                                id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                                <span class="sr-only">Open user menu</span>
                                <div class="px-3 py-2 text-nord0">{{ auth()->user()->email }}</div>
                            </button>

                        </div>
                        <div class="-ml-80 lg:ml-0">
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
                            class="absolute right-0 z-10 mt-5 w-48 origin-top-right rounded-md bg-nord6 dark:bg-nord0 py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                            role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button"
                            tabindex="-1">
                            <!-- Active: "bg-gray-100", Not Active: "" -->
                            <a href="#" class="block px-4 py-2 text-sm text-nord0 dark:text-nord6" role="menuitem"
                                tabindex="-1" id="user-menu-item-0">Your Profile</a>
                            <a href="#" class="block px-4 py-2 text-sm text-nord0 dark:text-nord6" role="menuitem"
                                tabindex="-1" id="user-menu-item-1">Settings</a>
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
            <div class="-ml-80 md:hidden">
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
            <div class="-mr-2 flex md:hidden">
                <!-- Mobile menu button -->
                <button type="button" @click="isOpen = !isOpen"
                    class="relative inline-flex items-center justify-center rounded-md bg-nord7 p-2 text-nord0 dark:text-nord6 hover:bg-nord8 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-nord6"
                    aria-controls="mobile-menu" aria-expanded="false">
                    <span class="absolute -inset-0.5"></span>
                    <span class="sr-only">Open main menu</span>
                    <!-- Menu open: "hidden", Menu closed: "block" -->
                    <svg :class="{ 'hidden': isOpen, 'block': !isOpen }" class="block h-6 w-6" fill="none"
                        viewBox="0 0 24 24" stroke-width="1.5" stroke="white" aria-hidden="true" data-slot="icon">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                    <!-- Menu open: "block", Menu closed: "hidden" -->
                    <svg :class="{ 'block': isOpen, 'hidden': !isOpen }" class="hidden h-6 w-6" fill="none"
                        viewBox="0 0 24 24" stroke-width="1.5" stroke="white" aria-hidden="true" data-slot="icon">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile menu, show/hide based on menu state. -->
    <div class="md:hidden" id="mobile-menu" x-show="isOpen"
        x-transition:enter="transition ease-out duration-100 transform" x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-75 transform"
        x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95">
        <div class="space-y-1 px-2 pb-3 pt-2 sm:px-3">
            <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-nord9 hover:text-white" -->
            <a href="#" class="block rounded-md bg-nord7 px-3 py-2 text-base font-medium text-white"
                aria-current="page">Dashboard</a>
            <a href="#"
                class="block rounded-md px-3 py-2 text-base font-medium text-nord0 dark:text-nord6 hover:bg-nord9 hover:text-white">Aspirasi</a>
            <a href="#"
                class="block rounded-md px-3 py-2 text-base font-medium text-nord0 dark:text-nord6 hover:bg-nord9 hover:text-white">WebGis</a>
            <a href="#"
                class="block rounded-md px-3 py-2 text-base font-medium text-nord0 dark:text-nord6 hover:bg-nord9 hover:text-white">Data
                Survey</a>
            <a href="#"
                class="block rounded-md px-3 py-2 text-base font-medium text-nord0 dark:text-nord6 hover:bg-nord9 hover:text-white">Penanganan</a>
            <a href="#"
                class="block rounded-md px-3 py-2 text-base font-medium text-nord0 dark:text-nord6 hover:bg-nord9 hover:text-white">Laporan</a>
            <a href="#"
                class="block rounded-md px-3 py-2 text-base font-medium text-nord0 dark:text-nord6 hover:bg-nord9 hover:text-white">Data
                Induk</a>
        </div>
        <div class="border-t border-gray-700 pb-3 pt-4">
            <div class="flex items-center px-4">
                <div class="flex-shrink-0">
                    <img class="h-10 w-10 rounded-full"
                        src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                        alt="">
                </div>
                <div class="ml-3">
                    <div class="text-base font-medium leading-none text-white">
                        {{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</div>
                    <div class="text-sm font-medium leading-none text-nord0 dark:text-nord6">
                        {{ auth()->user()->email }}
                    </div>
                </div>

            </div>
            <div class="mt-3 space-y-1 px-2">
                <a href="#"
                    class="block rounded-md px-3 py-2 text-base font-medium text-nord0 dark:text-nord6 hover:bg-nord9 hover:text-white">Your
                    Profile</a>
                <a href="#"
                    class="block rounded-md px-3 py-2 text-base font-medium text-nord0 dark:text-nord6 hover:bg-nord9 hover:text-white">Settings</a>
                <a href="#"
                    class="block rounded-md px-3 py-2 text-base font-medium text-nord0 dark:text-nord6 hover:bg-nord9 hover:text-white">Sign
                    out</a>
            </div>
        </div>
    </div>
</nav>
