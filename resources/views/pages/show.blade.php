@section('title')
    Show - {{ $tweet->content }}
@endsection
<x-app-layout>
    <div class="py-4 w-full mx-auto sm:px-6 lg:px-8 lg:w-3/5">
        <div class="card w-1/2 grid grid-cols-5 mx-auto bg-dark my-3 mb-4">
            <a href="{{ route('dashboard') }}" class="text-white text-4xl p-2 col-span-2"><iconify-icon icon="ep:back"></iconify-icon></a>
            <h1 class="text-white my-auto col-span-3">Kembali</h1>
        </div>
        <div class="card-body bg-dark text-light mx-3 bg-gray-800">
            {{-- Content Tweet Start --}}
            <div class="flex flex-row">
                <div class="text-5xl me-2">
                    <img class="w-12 h-12 object-cover rounded-full"
                        src="{{ $tweet->user->avatar ? asset('images/avatar/' . $tweet->user->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode($tweet->user->name) }}"
                        alt="{{ url('https://ui-avatars.com/api/?name=' . $tweet->user->name) }}">
                </div>
                <div>
                    <strong>{{ $tweet->user->name }}</strong>
                    <p>{{ $tweet->created_at->locale('id')->diffForHumans() }}</p>
                </div>
            </div>

            <p class="captions">{!! $tweet->content !!}</p>

            <div class="text-center my-3">
                {{-- <img src="{{ asset('/storage/posts/' . $tweet->image) }}" class="rounded mx-auto w-4/5" alt="">
                <video src="{{ asset('/storage/posts/' . $tweet->image) }}" controls class="w-full"></video> --}}
                @if (pathinfo($tweet->file, PATHINFO_EXTENSION) == 'mp4' || pathinfo($tweet->file, PATHINFO_EXTENSION) == 'webm')
                    <!-- Jika itu video -->
                    <video src="{{ asset('/storage/tweets/' . $tweet->file) }}" controls class="w-4/5 mx-auto rounded"></video>
                @elseif (pathinfo($tweet->file, PATHINFO_EXTENSION) == 'mp3' ||
                        pathinfo($tweet->file, PATHINFO_EXTENSION) == 'ogg' ||
                        pathinfo($tweet->file, PATHINFO_EXTENSION) == 'wav')
                    <!-- Jika itu audio -->
                    <audio controls>
                        <source src="{{ asset('/storage/tweets/' . $tweet->file) }}"
                            type="audio/{{ pathinfo($tweet->file, PATHINFO_EXTENSION) }}">
                    </audio>
                @else
                    <!-- Jika itu gambar -->
                    <img src="{{ asset('/storage/tweets/' . $tweet->file) }}" class="rounded mx-auto w-full" alt="">
                @endif

            </div>
            {{-- Content Tweet End --}}

            {{-- Comments Start --}}
            {{-- Comments End --}}
        </div>
        <livewire:comments :model="$tweet" />
    </div>
</x-app-layout>
