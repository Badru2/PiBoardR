<x-app-layout>
    @foreach ($tweets as $tweet)
        @include('components.tweets')
    @endforeach
</x-app-layout>
