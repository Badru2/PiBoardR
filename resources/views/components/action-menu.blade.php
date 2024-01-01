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
    <a onclick="comment_{{ $tweet->id }}.showModal()" class="m-2 text-xl text-white cursor-pointer"><iconify-icon
            icon="bx:comment"></iconify-icon>
        {{-- {{ $tweet->comments->count() }} --}}
    </a>

    {{-- Share inactive --}}
    <a href="{{ route('tweet.show', $tweet->id) }}" class="m-2 text-xl text-white"><iconify-icon
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
