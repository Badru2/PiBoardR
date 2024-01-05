<aside id="logo-sidebar"
    class="hidden lg:block fixed top-0 right-0 z-40 w-64 2xl:w-80 h-screen transition-transform -translate-x-full sm:translate-x-0"
    aria-label="Sidebar">
    <div class="h-full px-3 py-4 overflow-y-auto primary-blue-dark">
        <ul class="space-y-2 font-medium">
            <li>
                <form class="mx-autow-full" action="{{ route('search') }}" method="GET">
                    <div class="relative">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                            </svg>
                        </div>
                        <input type="text" id="default-search"
                            class="typeahead block w-full ps-10 text-sm text-gray-900 border
                            border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500
                            focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600
                            dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500
                            dark:focus:border-blue-500"
                            name="search" placeholder="Search" value="{{ old('search') }}">
                    </div>
                </form>
            </li>
        </ul>
    </div>
</aside>
