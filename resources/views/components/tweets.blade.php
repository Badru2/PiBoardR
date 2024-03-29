<div class="relative p-3 mx-3 mb-5 bg-gray-800 lg:w-2/5 lg:mx-auto lg:border-2 lg:border-gray-800">
    <div class="flex">
        <div class="me-2">
            <a href="{{ route('profile.show', $tweet->user->name) }}" class="text-white">
                <img class="object-cover w-12 h-12 rounded-full"
                    src="{{ $tweet->user->avatar ? asset('images/avatar/' . $tweet->user->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode($tweet->user->name) }}"
                    alt="{{ url('https://ui-avatars.com/api/?name=' . $tweet->user->name) }}">
            </a>
        </div>
        <div>
            <strong>
                <a href="{{ route('profile.show', $tweet->user->name) }}" class="text-white hover:underline">
                    {{ $tweet->user->name }} @if ($tweet->user->level == 'admin')
                        <span class="text-blue-400 ">
                            <iconify-icon icon="dashicons:yes-alt"></iconify-icon>
                        </span>
                    @endif
                </a>
            </strong>
            <p class="text-gray-500">{{ $tweet->created_at->locale('id')->diffForHumans() }}</p>
        </div>

        <div class="absolute right-4">
            <div class="dropdown dropdown-left">
                <label tabindex="0" class="m-1 text-xl cursor-pointer"><iconify-icon icon="pepicons-pop:dots-y"></iconify-icon></label>
                <ul tabindex="0" class="dropdown-content z-[1] menu p-2 shadow bg-black rounded-box w-24">
                    @can('delete', $tweet)
                        <li>
                            <form action="{{ route('tweet.destroy', $tweet->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-700">HAPUS</button>
                            </form>
                        </li>
                    @endcan
                    @can('update', $tweet)
                        <li><a href="{{ route('tweet.edit', $tweet->id) }}" class="text-warning">Edit</a>
                        </li>
                    @endcan
                    @cannot('view', $tweet)
                        <li><button onclick="report_{{ $tweet->id }}.showModal()" class="text-warning">Report</button>
                        </li>
                    @endcannot
                </ul>
            </div>
        </div>
    </div>

    <p class="mb-3 captions att">{!! $tweet->content !!}</p>

    <div class="mt-3 text-center">
        @if (pathinfo($tweet->file, PATHINFO_EXTENSION) == 'mp4' || pathinfo($tweet->file, PATHINFO_EXTENSION) == 'webm')
            <!-- video -->
            <video id="myVideo" src="{{ asset('/storage/tweets/' . $tweet->file) }}" disablepictureinpicture controlslist="nodownload"
                controls class="w-full mx-auto rounded`"></video>
        @elseif (pathinfo($tweet->file, PATHINFO_EXTENSION) == 'mp3' ||
                pathinfo($tweet->file, PATHINFO_EXTENSION) == 'ogg' ||
                pathinfo($tweet->file, PATHINFO_EXTENSION) == 'wav')
            <!-- audio -->
            <audio controls>
                <source src="{{ asset('/storage/tweets/' . $tweet->file) }}"
                    type="audio/{{ pathinfo($tweet->file, PATHINFO_EXTENSION) }}">
            </audio>
        @elseif (pathinfo($tweet->file, PATHINFO_EXTENSION) == 'png' ||
                pathinfo($tweet->file, PATHINFO_EXTENSION) == 'jpg' ||
                pathinfo($tweet->file, PATHINFO_EXTENSION) == 'jpeg' ||
                pathinfo($tweet->file, PATHINFO_EXTENSION) == 'svg' ||
                pathinfo($tweet->file, PATHINFO_EXTENSION) == 'gif')
            <!-- gambar -->
            <img src="{{ asset('/storage/tweets/' . $tweet->file) }}"
                class="object-cover w-full mx-auto rounded max-h-96 2xl:max-h-96 2xl:max-h-2/4"
                onclick="my_modal_{{ $tweet->id }}.showModal()" alt="">
        @else
            <div></div>
        @endif
    </div>

    <div class="flex mt-4 border-t-2 border-b-2 border-black justify-evenly">
        {{-- Like --}}
        @if (Auth::user())
            <a class="m-2 text-xl text-red-600 cursor-pointer" onclick="like({{ $tweet->id }}, this)">
                @if ($tweet->is_liked())
                    <iconify-icon icon="material-symbols-light:favorite"></iconify-icon>
                @else
                    <iconify-icon icon="material-symbols:favorite-outline"></iconify-icon>
                @endif
                {{-- {{ $tweet->likes->count() }} --}}
            </a>
        @else
            <a href="{{ route('login') }}" class="m-2 text-xl text-red-600 cursor-pointer">
                <iconify-icon icon="material-symbols:favorite-outline"></iconify-icon>
            </a>
        @endif

        {{-- Comment --}}
        <a onclick="comment_{{ $tweet->id }}.showModal()" class="m-2 text-xl text-blue-300 cursor-pointer"><iconify-icon
                icon="bx:comment"></iconify-icon>
            {{-- {{ $tweet->comments->count() }} --}}
        </a>

        {{-- Share inactive --}}
        {{-- <a href="{{ route('tweet.show', $tweet->id) }}" class="m-2 text-xl text-blue-600"><iconify-icon
                icon="ri:share-line"></iconify-icon></a> --}}
        <input type="text" id="copy_{{ $tweet->id }}" value="piboardremake.net/show/{{ $tweet->id }}"
            class="absolute left-[-1000px]" readonly>
        <a value="copy" onclick="copyToClipboard('copy_{{ $tweet->id }}')" class="m-2 text-xl text-white"><iconify-icon
                icon="ri:share-line"></iconify-icon></a>

        @if (Auth::user())
            <a class="m-2 text-xl text-green-500 cursor-pointer" onclick="favorite({{ $tweet->id }}, this)">
                @if ($tweet->is_favorited())
                    <iconify-icon icon="material-symbols:bookmark"></iconify-icon>
                @else
                    <iconify-icon icon="material-symbols:bookmark-outline"></iconify-icon>
                @endif
                {{-- {{ $tweet->likes->count() }} --}}
            </a>
        @else
            <a href="{{ route('login') }}" class="m-2 text-xl text-green-500 cursor-pointer">
                <iconify-icon icon="material-symbols:bookmark-outline"></iconify-icon>
            </a>
        @endif
        {{-- Favorite inactive --}}
    </div>

    {{-- Image Tweet Modal --}}
    <dialog id="my_modal_{{ $tweet->id }}" class="modal">
        {{-- <div class="w-11/12 max-w-6xl modal-box">
                <div class="modal-action">
                    <form method="dialog">
                        <button class="absolute text-white btn btn-sm btn-circle btn-ghost right-4 top-2">✕</button>
                    </form>
                </div>
            </div> --}}
        <div class="max-w-5xl modal-box">
            <img src="{{ asset('/storage/tweets/' . $tweet->file) }}" class="w-full" alt="">
        </div>
        <form method="dialog" class="bg-transparent border-0 modal-backdrop">
            <button></button>
        </form>
    </dialog>


    <dialog id="comment_{{ $tweet->id }}" class="modal">
        <div class="max-w-5xl modal-box lg:w-3/5">
            {{-- <img src="{{ asset('/storage/tweets/' . $tweet->file) }}" class="w-full" alt=""> --}}
            <livewire:comments :model="$tweet" />
        </div>
        <form method="dialog" class="bg-transparent border-0 modal-backdrop">
            <button></button>
        </form>
    </dialog>
    {{-- Comment Tweet Modal --}}

</div>

<script>
    function copyToClipboard(id) {
        document.getElementById(id).select();
        document.execCommand('copy');
    }
</script>
