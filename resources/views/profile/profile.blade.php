@section('title', "$user->name")
<x-app-layout>
    {{ $user->level = $user->where('level', 'admin')->count() }}
    <div class="w-full px-4 py-4 mb-4 lg:w-2/5 xl:w-2/5 lg:mx-auto lg:bg-gray-800 ">
        <div class="relative flex lg:border-b-2 lg:border-gray-800">
            <h1 class="text-xl text-white lg:text-2xl">Profile</h1>

            {{-- User Menu --}}
            @if (Auth::user())
                @if (Auth::user()->id == $user->id || Auth::user()->level == 'admin')
                    <div class="absolute top-0 mt-1 dropdown dropdown-left right-4">
                        <label tabindex="0" class="m-1 text-xl cursor-pointer"><iconify-icon icon="pepicons-pop:dots-y"></iconify-icon>
                        </label>
                        <ul tabindex="0" class="dropdown-content z-[1] menu p-2 shadow bg-black rounded-box w-40">
                            @if (Auth::user()->id == $user->id)
                                <li>
                                    <a href="{{ route('profile.edit') }}" class="text-warning text-x2l">
                                        <i class="bi bi-pencil-square"></i> Edit Profil</a>
                                </li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <a href="route('logout')" class="text-red-600 bg-transparent"
                                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                                            <i class="bi bi-box-arrow-left"></i><span class="ms-2">Logout</span>
                                        </a>
                                    </form>
                                </li>
                            @endif
                            @if (Auth::user()->level == 'admin')
                                @if (Auth::user()->id != $user->id)
                                    @if (!(Auth::user()->level == 'admin' && $user->level == 'childAdmin'))
                                        <li>
                                            <a onclick="change_to_admin.showModal()">To Admin</a>
                                        </li>
                                    @endif
                                @endif
                                @if ($user->level == 'childAdmin')
                                    <li>
                                        <a onclick="remove_from_admin.showModal()">Remove Admin</a>
                                    </li>
                                @endif
                            @endif
                        </ul>
                    </div>
                @endif
            @endif
        </div>
        <div class="flex mt-3">
            <img class="object-cover w-16 h-16 rounded-full lg:w-44 lg:h-44 xl:w-52 xl:h-52 avatar-mobile"
                src="{{ $user->avatar ? asset('images/avatar/' . $user->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) }}"
                alt="{{ url('https://ui-avatars.com/api/?name=' . $user->name) }}" onclick="avatar_image.showModal()">
            <div class="ps-4">
                <h2 class="flex font-bold text-white lg:text-3xl lg:mb-2">
                    {{ $user->name }}

                    <div class="text-gray-500 uppercase ps-3">
                        @if (Auth::user())
                            @if (Auth::user()->id != $user->id)
                                <button class="" onclick="follow({{ $user->id }}, this)">
                                    {{ Auth::user()->following->contains($user->id) ? 'UNFOLLOW' : 'FOLLOW' }}
                                </button>
                            @endif
                        @else
                            <a href="{{ route('login') }}">
                                FOLLOW
                            </a>
                        @endif
                    </div>
                </h2>
                <h3 class="lg:text-xl">
                    {{ $user->fullName }}
                </h3>
                <p class="lg:text-lg">
                    {!! $user->bio !!}
                </p>

            </div>
        </div>

        <div class="flex py-3 mt-5 text-center text-white justify-evenly">
            <div class="xl:text-2xl">
                <p>Tweets</p>
                {{ $user->tweets->count() }}
            </div>
            <div class="xl:text-2xl">
                <p>Follow</p>
                {{ $user->following->count() }}
            </div>
            <div class="xl:text-2xl">
                <p>Follower</p>
                {{ $user->follower->count() }}
            </div>
        </div>
    </div>

    {{-- Avatar Image Modal --}}
    <dialog id="avatar_image" class="modal">
        <img class="absolute z-50 object-cover w-80 h-80"
            src="{{ $user->avatar ? asset('images/avatar/' . $user->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) }}"
            alt="{{ url('https://ui-avatars.com/api/?name=' . $user->name) }}">

        <form method="dialog" class="bg-transparent modal-backdrop ">
            <button>close</button>
        </form>
    </dialog>

    <dialog id="change_to_admin" class="modal">
        <div class="modal-box">
            <form method="dialog">
                <button class="absolute btn btn-sm btn-circle btn-ghost right-2 top-2">✕</button>
            </form>
            <form action="{{ route('toAdmin', $user->id) }}" method="POST">
                @csrf
                @method('PUT')
                <input type="text" name="level" class="hidden" value="childAdmin">

                <p class="text-red-500">Apakah anda yakin ingin mengubah <span class="font-bold text-blue-300">
                        {{ $user->name }} </span> menjadi
                    Admin?</p>

                <button type="submit" class="w-20 px-3 py-2 mt-1 text-white bg-red-600 rounded-lg">Iya</button>
            </form>
        </div>

        <form method="dialog" class="bg-transparent modal-backdrop ">
            <button>close</button>
        </form>
    </dialog>

    <dialog id="remove_from_admin" class="modal">
        <div class="modal-box">
            <form method="dialog">
                <button class="absolute btn btn-sm btn-circle btn-ghost right-2 top-2">✕</button>
            </form>
            <form action="{{ route('toAdmin', $user->id) }}" method="POST">
                @csrf
                @method('PUT')
                <input type="text" name="level" class="hidden" value="users">

                <p class="text-red-500">Apakah anda yakin ingin mengubah <span class="font-bold text-blue-300">
                        {{ $user->name }} </span> menjadi
                    User?</p>

                <button type="submit" class="w-20 px-3 py-2 mt-1 text-white bg-red-600 rounded-lg">Iya</button>
            </form>
        </div>

        <form method="dialog" class="bg-transparent modal-backdrop ">
            <button>close</button>
        </form>
    </dialog>

    {{-- @if (Auth::user()->id == $user->id) --}}
    <div class="mx-auto mb-4 border-b border-gray-200 dark:border-gray-700 lg:w-2/5">
        <ul class="flex flex-wrap -mb-px text-sm font-medium text-center justify-evenly" id="default-tab"
            data-tabs-toggle="#default-tab-content" role="tablist">
            <li class="me-2" role="presentation">
                <button class="inline-block p-4 border-b-2 rounded-t-lg" id="profile-tab" data-tabs-target="#tweets" type="button"
                    role="tab" aria-controls="profile" aria-selected="false">My Tweets</button>
            </li>
            <li class="me-2" role="presentation">
                <button class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                    id="dashboard-tab" data-tabs-target="#favorite" type="button" role="tab" aria-controls="dashboard"
                    aria-selected="false">Favorite</button>
            </li>
        </ul>
    </div>

    <div id="default-tab-content" class="bg-transparent">
        <div class="hidden w-full p-0 m-0 bg-transparent rounded-lg" id="tweets" role="tabpanel" aria-labelledby="profile-tab">
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
