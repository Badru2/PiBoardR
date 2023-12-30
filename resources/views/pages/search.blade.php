<x-app-layout>
    @foreach ($users as $user)
        <div class="flex mx-3 py-4 rounded-lg mb-3 bg-gray-800">
            <div class="ms-4">
                <img class="w-24 h-24 object-cover rounded-full"
                    src="{{ $user->avatar ? asset('images/avatar/' . $user->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) }}"
                    alt="{{ url('https://ui-avatars.com/api/?name=' . $user->name) }}">
            </div>
            <div class="ps-3">
                <p>{{ $user->name }}</p>
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

    @include('components.tweets')
</x-app-layout>
