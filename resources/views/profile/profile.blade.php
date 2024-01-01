<x-app-layout>
    <div class="w-full px-4 py-4 lg:w-3/5 lg:mx-auto lg:bg-gray-800 mb-4 ">
        <div class="lg:border-b-2 lg:border-gray-800 flex relative">
            <h1 class="text-xl text-white lg:text-2xl">Profile</h1>

            {{-- User Menu --}}
            @if (Auth::user()->id == $user->id)
                <div class="dropdown dropdown-left right-4 top-0 mt-1 absolute">
                    <label tabindex="0" class="m-1 cursor-pointer text-xl"><iconify-icon
                            icon="pepicons-pop:dots-y"></iconify-icon>
                    </label>
                    <ul tabindex="0" class="dropdown-content z-[1] menu p-2 shadow bg-black rounded-box w-40">
                        <li>
                            <a href="{{ route('profile.edit') }}" class="text-warning text-x2l">
                                <i class="bi bi-pencil-square"></i> Edit Profil</a>
                        </li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a href="route('logout')" class="bg-transparent text-danger"
                                    onclick="event.preventDefault();
                                        this.closest('form').submit();">
                                    <i class="bi bi-box-arrow-left"></i><span class="ms-2">Logout</span>
                                </a>
                            </form>
                        </li>
                    </ul>
                </div>
            @endif
        </div>
        <div class="flex mt-3">
            <img class="w-16 h-16 lg:w-52 lg:h-52 object-cover rounded-full avatar-mobile"
                src="{{ $user->avatar ? asset('images/avatar/' . $user->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) }}"
                alt="{{ url('https://ui-avatars.com/api/?name=' . $user->name) }}" onclick="avatar_image.showModal()">
            <div class="ps-4">
                <h2 class="lg:text-3xl lg:mb-2 font-bold text-white flex">
                    {{ $user->name }}

                    <div class="text-gray-500 uppercase ps-3">
                        @if (Auth::user()->id != $user->id)
                            <button class="" onclick="follow({{ $user->id }}, this)">
                                {{ Auth::user()->following->contains($user->id) ? 'UNFOLLOW' : 'FOLLOW' }}
                            </button>
                        @endif
                    </div>
                </h2>
                <h3 class="lg:text-xl">
                    {{ $user->fullName }}
                </h3>
                <p class="lg:text-lg">
                    {{ $user->bio }}
                </p>
            </div>
        </div>
    </div>

    {{-- Avatar Image Modal --}}
    <dialog id="avatar_image" class="modal">
        <img class="w-80 h-80 object-cover absolute z-50"
            src="{{ $user->avatar ? asset('images/avatar/' . $user->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) }}"
            alt="{{ url('https://ui-avatars.com/api/?name=' . $user->name) }}">

        <form method="dialog" class="modal-backdrop bg-transparent ">
            <button>close</button>
        </form>
    </dialog>

    {{-- @if (Auth::user()->id == $user->id) --}}
    <div class="mb-4 border-b border-gray-200 dark:border-gray-700 lg:w-3/5 mx-auto">
        <ul class="flex flex-wrap -mb-px text-sm font-medium text-center justify-evenly" id="default-tab"
            data-tabs-toggle="#default-tab-content" role="tablist">
            <li class="me-2" role="presentation">
                <button class="inline-block p-4 border-b-2 rounded-t-lg" id="profile-tab" data-tabs-target="#tweets"
                    type="button" role="tab" aria-controls="profile" aria-selected="false">My Tweets</button>
            </li>
            <li class="me-2" role="presentation">
                <button
                    class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                    id="dashboard-tab" data-tabs-target="#favorite" type="button" role="tab"
                    aria-controls="dashboard" aria-selected="false">Favorite</button>
            </li>
        </ul>
    </div>

    <div id="default-tab-content" class="bg-transparent">
        <div class="hidden p-0 m-0 w-full bg-transparent rounded-lg" id="tweets" role="tabpanel"
            aria-labelledby="profile-tab">
            @foreach ($tweets as $tweet)
                @include('components.tweets')
            @endforeach
        </div>
        <div class="hidden p-0 m-0 rounded-lg" id="favorite" role="tabpanel" aria-labelledby="dashboard-tab">
            @foreach ($favoritedTweets as $tweet)
                @include('components.tweets')
            @endforeach
        </div>
    </div>
    {{-- @else
    @endif
    @include('components.tweets') --}}
</x-app-layout>
