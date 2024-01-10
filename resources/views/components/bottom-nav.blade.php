<div class="fixed bottom-0 flex justify-evenly bg-gray-800 pt-1 pb-1 z-50 w-full lg:hidden">
    <x-bottom-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
        <iconify-icon icon="uil:home"></iconify-icon>
    </x-bottom-nav-link>

    <x-bottom-nav-link onclick="search_modal.showModal()" :active="request()->routeIs('search')">
        <iconify-icon icon="ic:twotone-search"></iconify-icon>
    </x-bottom-nav-link>

    <x-bottom-nav-link :href="route('tweet.create')" :active="request()->routeIs('tweet.create')">
        <iconify-icon icon="material-symbols:upload"></iconify-icon>
    </x-bottom-nav-link>

    <x-bottom-nav-link :href="route('tweet.create')" :active="request()->routeIs('tweet.create')">
        <iconify-icon icon="ion:notifcations"></iconify-icon>
    </x-bottom-nav-link>

    <a href="{{ route('profile.index') }}">
        @if (Auth::user())
            <img class="mt-1 {{ request()->routeIs('profile.index') ? 'ring-cyan-500 border-2 border-cyan-500 rounded-full w-9 h-9 object-cover' : 'w-9 h-9 object-cover rounded-full' }}"
                src="{{ Auth::user()->avatar ? asset('images/avatar/' . Auth::user()->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) }}"
                alt="{{ url('https://ui-avatars.com/api/?name=' . Auth::user()->name) }}">
        @else
            <img class="w-8 h-8 object-cover rounded-full" src="https://ui-avatars.com/api/?name=guest">
        @endif
    </a>
</div>

<dialog id="search_modal" class="modal">
    <div class="w-4/5 absolute top-2">
        <div class="px-1 py-1">
            <form class="mx-auto w-full h-24" action="{{ route('search') }}" method="GET">
                <div class="relative">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                        </svg>
                    </div>
                    <input type="text" id="default-search"
                        class="block w-full ps-10 text-sm text-gray-900 border
                    border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500
                    focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600
                    dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500
                    dark:focus:border-blue-500"
                        name="search" placeholder="Search" value="{{ old('search') }}">
                </div>
            </form>
        </div>
    </div>
    <form method="dialog" class="modal-backdrop">
        <button>close</button>
    </form>
</dialog>
