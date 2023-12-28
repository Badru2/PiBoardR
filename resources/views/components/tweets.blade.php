@foreach ($tweets as $tweet)
    <div class="p-3 mb-5 lg:w-2/5 xl:w-3/5 mx-auto lg:border-2 lg:border-gray-800 lg:bg-gray-800">
        <div class="flex">
            <div class="me-2">
                <a href="{{ route('profile.show', $tweet->user->name) }}" class="text-white">
                    <img class="w-12 h-12 object-cover rounded-full"
                        src="{{ $tweet->user->avatar ? asset('images/avatar/' . $tweet->user->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode($tweet->user->name) }}"
                        alt="{{ url('https://ui-avatars.com/api/?name=' . $tweet->user->name) }}">
                </a>
            </div>
            <div>
                <strong>
                    <a href="{{ route('profile.show', $tweet->user->name) }}" class="text-white">
                        {{ $tweet->user->name }}
                    </a>
                </strong>
                <p>{{ $tweet->created_at->locale('id')->diffForHumans() }}</p>
            </div>
        </div>

        <p class="captions att py-3">{{ $tweet->content }}</p>

        <div class="text-center">
            @if (pathinfo($tweet->file, PATHINFO_EXTENSION) == 'mp4' || pathinfo($tweet->file, PATHINFO_EXTENSION) == 'webm')
                <!-- video -->
                <video id="myVideo" src="{{ asset('/storage/tweets/' . $tweet->file) }}" disablepictureinpicture
                    controlslist="nodownload" controls class="w-full mx-auto rounded"></video>
            @elseif (pathinfo($tweet->file, PATHINFO_EXTENSION) == 'mp3' ||
                    pathinfo($tweet->file, PATHINFO_EXTENSION) == 'ogg' ||
                    pathinfo($tweet->file, PATHINFO_EXTENSION) == 'wav')
                <!-- audio -->
                <audio controls>
                    <source src="{{ asset('/storage/tweets/' . $tweet->file) }}"
                        type="audio/{{ pathinfo($tweet->file, PATHINFO_EXTENSION) }}">
                </audio>
            @else
                <!-- gambar -->
                <img src="{{ asset('/storage/tweets/' . $tweet->file) }}"
                    class="rounded mx-auto w-full max-h-96 object-cover"
                    onclick="my_modal_{{ $tweet->id }}.showModal()" alt="">
            @endif
        </div>

        <div class="border-black border-t-2 border-b-2 mt-4 flex justify-evenly">
            {{-- Like --}}
            <a class="m-2 text-xl cursor-pointer text-danger" onclick="like({{ $tweet->id }}, this)">
                @if ($tweet->is_liked())
                    <iconify-icon icon="material-symbols-light:favorite"></iconify-icon>
                @else
                    <iconify-icon icon="material-symbols:favorite-outline"></iconify-icon>
                @endif
                {{-- {{ $tweet->likes->count() }} --}}
            </a>

            {{-- Comment --}}
            {{-- <a onclick="comment_{{ $tweet->id }}.showModal()"
                class="m-2 text-xl text-white cursor-pointer"><iconify-icon icon="bx:comment"></iconify-icon>
                {{ $tweet->comments->count() }}
            </a> --}}

            {{-- Share inactive --}}
            <a href="{{ route('tweet.show', $tweet->id) }}" class="m-2 text-xl text-white"><iconify-icon
                    icon="ri:share-line"></iconify-icon></a>

            {{-- Favorite inactive --}}
            <a href="{{ route('tweet.show', $tweet->id) }}" class="m-2 text-xl text-white"><iconify-icon
                    icon="material-symbols:bookmark-outline"></iconify-icon></a>
        </div>
    </div>
@endforeach
