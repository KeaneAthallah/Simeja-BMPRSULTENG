<x-layout-dashboard>
    <div class="flex flex-col items-center justify-center m-10">
        <div class="w-full p-8 bg-nord5 text-nord0 dark:bg-nord2 dark:text-nord6 rounded-lg shadow-lg">
            <h1 class="text-4xl font-extrabold text-center text-nord0 dark:text-nord6">Welcome to
                {{ auth()->user()->first_name }} Dashboard!</h1>
            <p class="mt-4 text-lg text-center text-nord0 dark:text-nord6">We're excited to have you here. Explore the
                insights below
                to get started.</p>

            <div class="grid grid-cols-1 gap-6 mt-8 md:grid-cols-2 lg:grid-cols-3">
                <!-- Card 1 -->
                <div
                    class="flex items-center justify-between p-6 bg-nord7 text-nord0 dark:text-nord6 rounded-lg shadow-lg transform hover:scale-105 transition-transform duration-200">
                    <div>
                        <h2 class="text-xl font-semibold">Keluhan baru</h2>
                        <p class="text-3xl">{{ $newComplains }}</p>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-nord0 dark:text-nord6"
                        viewBox="0 0 20 20" fill="currentColor">
                        <path d="M10 2a7 7 0 100 14 7 7 0 000-14zm0 2a5 5 0 100 10 5 5 0 000-10z" />
                    </svg>
                </div>
                <!-- Card 2 -->
                <div
                    class="flex items-center justify-between p-6 bg-nord8 text-nord0 dark:text-nord6 rounded-lg shadow-lg transform hover:scale-105 transition-transform duration-200">
                    <div>
                        <h2 class="text-xl font-semibold">Keluhan dalam proses</h2>
                        <p class="text-3xl">{{ $onProgressComplains }}</p>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-nord0 dark:text-nord6"
                        viewBox="0 0 20 20" fill="currentColor">
                        <path
                            d="M10 2a8 8 0 000 16 8 8 0 000-16zm1 11a1 1 0 10-2 0v2a1 1 0 002 0v-2zm2-9a1 1 0 10-2 0v5a1 1 0 002 0V4zm-3 7a1 1 0 10-2 0v2a1 1 0 002 0v-2z" />
                    </svg>
                </div>
                <!-- Card 3 -->
                <div
                    class="flex items-center justify-between p-6 bg-nord9 text-nord0 dark:text-nord6 rounded-lg shadow-lg transform hover:scale-105 transition-transform duration-200">
                    <div>
                        <h2 class="text-xl font-semibold">Keluhan selesai</h2>
                        <p class="text-3xl">{{ $completedComplains }}</p>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-nord0 dark:text-nord6"
                        viewBox="0 0 20 20" fill="currentColor">
                        <path
                            d="M3 2a1 1 0 011-1h12a1 1 0 011 1v4h-2V3H4v12h2v2H4a1 1 0 01-1-1V2zm5 5h8v2H8V7zm0 4h5v2H8v-2z" />
                    </svg>
                </div>
            </div>
        </div>
    </div>
</x-layout-dashboard>
