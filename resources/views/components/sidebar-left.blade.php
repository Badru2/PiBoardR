<aside id="logo-sidebar"
    class="hidden lg:block fixed top-0 left-0 z-40 w-64 2xl:w-80 h-screen transition-transform -translate-x-full sm:translate-x-0"
    aria-label="Sidebar">
    <div class="h-full px-3 py-4 overflow-y-auto primary-blue-dark">
        <a href="{{ route('dashboard') }}" class="flex items-center ps-2.5 mb-5">
            <img src="{{ asset('icon_white.svg') }}" class="me-3 h-12" alt="" />
        </a>
        <ul class="space-y-2 font-medium">
            <li class="my-5 mt-12">
                <a href="{{ route('profile.index') }}"
                    class="flex items-center text-white rounded-lg   dark:hover:bg-gray-700 group">
                    <div class="text-4xl">
                        @if (Auth::user())
                            <img class="w-9 h-9 object-cover rounded-full"
                                src="{{ Auth::user()->avatar ? asset('images/avatar/' . Auth::user()->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) }}"
                                alt="{{ url('https://ui-avatars.com/api/?name=' . Auth::user()->name) }}">
                        @else
                            <img class="w-9 h-9 object-cover rounded-full" src="https://ui-avatars.com/api/?name=guest">
                        @endif
                    </div>
                    <div class="ms-3">
                        @if (Auth::user())
                            {{ Auth::user()->name }}
                        @else
                            Guest
                        @endif
                    </div>
                </a>
                @if (Auth::user())
                    <div class="w-2/3 h-1 rounded-md mt-3 bg-teal-700"></div>
                @else
                    <div class="w-2/3 h-1 rounded-md mt-3 bg-teal-900"></div>
                @endif
            </li>
            <li class="my-1">
                <a href="{{ route('dashboard') }}"
                    class="flex items-center text-white rounded-lg dark:hover:bg-gray-700 group">
                    <div class="text-4xl">
                        <iconify-icon icon="uil:home"></iconify-icon>
                    </div>
                    <span class="ms-3">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="{{ route('tweet.create') }}"
                    class="flex items-center text-white rounded-lg dark:hover:bg-gray-700 group">
                    <div class="text-4xl">
                        <iconify-icon icon="material-symbols:upload"></iconify-icon>
                    </div>
                    <span class="ms-3">Create</span>
                </a>
            </li>
            @if (!Auth::user())
                <li>
                    <a href="{{ route('login') }}"
                        class="flex pt-1 text-white rounded-lg bg-blue-500 dark:hover:bg-blue-700 group">
                        <div class="text-4xl ">
                            <iconify-icon icon="material-symbols:login"></iconify-icon>
                        </div>
                        <span class="ms-3 pt-2">Log In</span>
                    </a>
                </li>
            @endif
        </ul>
    </div>
</aside>
