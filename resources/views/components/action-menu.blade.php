<div class="flex mt-4 border-t-2 border-b-2 border-black justify-evenly">
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
    <a onclick="comment_{{ $tweet->id }}.showModal()" class="m-2 text-xl text-white cursor-pointer"><iconify-icon
            icon="bx:comment"></iconify-icon>
        {{-- {{ $tweet->comments->count() }} --}}
    </a>

    {{-- Share inactive --}}
    <input type="text" id="copy_{{ $tweet->id }}" value="{{ route('tweet.show' . $tweet->id) }}" class="absolute left-[-1000px]"
        readonly>
    <a value="copy" onclick="copyToClipboard('copy_{{ $tweet->id }}')" class="m-2 text-xl text-white"><iconify-icon
            icon="ri:share-line"></iconify-icon></a>

    {{-- Favorite inactive --}}
    <a class="m-2 text-xl cursor-pointer text-danger" onclick="favorite({{ $tweet->id }}, this)">
        @if ($tweet->is_favorited())
            <iconify-icon icon="material-symbols:bookmark"></iconify-icon>
        @else
            <iconify-icon icon="material-symbols:bookmark-outline"></iconify-icon>
        @endif
        {{-- {{ $tweet->likes->count() }} --}}
    </a>
</div>
