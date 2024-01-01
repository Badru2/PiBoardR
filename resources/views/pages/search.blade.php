<x-app-layout>
    @foreach ($users as $user)
        <div class="flex mx-3 py-4 rounded-lg mb-3 bg-gray-800">
            <a href="{{ route('profile.show', $user->name) }}" class="ms-4">
                <img class="w-24 h-24 object-cover rounded-full"
                    src="{{ $user->avatar ? asset('images/avatar/' . $user->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) }}"
                    alt="{{ url('https://ui-avatars.com/api/?name=' . $user->name) }}">
            </a>
            <div class="ps-3">
                <a href="{{ route('profile.show', $user->name) }}">{{ $user->name }}</a>
                <div class="text-gray-500 uppercase ">
                    @if (Auth::user()->id != $user->id)
                        <button class="" onclick="follow({{ $user->id }}, this)">
                            {{ Auth::user()->following->contains($user->id) ? 'UNFOLLOW' : 'FOLLOW' }}
                        </button>
                    @endif
                </div>
            </div>
        </div>
    @endforeach

    @foreach ($tweets as $tweet)
        @include('components.tweets')
    @endforeach
</x-app-layout>
