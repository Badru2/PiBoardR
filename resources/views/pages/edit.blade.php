@section('title')
    Edit - {{ $tweet->content }}
@endsection
<x-app-layout>
    <div class="py-6 px-3 lg:w-3/5 mx-auto">
        <div class="lg:border-2 md:border-gray-800 md:p-3 md:bg-gray-800">
            <div class="text-center mb-3">
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
                @elseif (pathinfo($tweet->file, PATHINFO_EXTENSION) == 'png' ||
                        pathinfo($tweet->file, PATHINFO_EXTENSION) == 'jpg' ||
                        pathinfo($tweet->file, PATHINFO_EXTENSION) == 'jpeg' ||
                        pathinfo($tweet->file, PATHINFO_EXTENSION) == 'svg' ||
                        pathinfo($tweet->file, PATHINFO_EXTENSION) == 'gif')
                    <!-- gambar -->
                    <img src="{{ asset('/storage/tweets/' . $tweet->file) }}"
                        class="rounded mx-auto w-full max-h-96 2xl:max-h-96 object-cover"
                        onclick="my_modal_{{ $tweet->id }}.showModal()" alt="">
                @else
                    <div></div>
                @endif
            </div>

            <form method="POST" action="{{ route('tweet.update', $tweet->id) }}">
                @csrf
                @method('PUT')

                <textarea name="content" id="" rows="10" cols="30" class="w-full rounded-md bg-gray-800 text-white"
                    placeholder="Tuliskan postingan...">{{ $tweet->content }}</textarea>


                <div class="flex w-full justify-evenly mt-5">
                    <a onClick="window.location.reload();"
                        class="bg-red-700 px-8 py-1 lg:px-12 lg:py-3 rounded-full cursor-pointer hover:bg-red-500">Reset</a>
                    <input type="submit" value="Publish"
                        class="bg-cyan-500 px-8 py-1 rounded-full cursor-pointer hover:bg-cyan-300">
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.tiny.cloud/1/ug8k3u0xghcson8wedsmu7tihjbd1mg86xrhsdo9eg662qo9/tinymce/6/tinymce.min.js"
        referrerpolicy="origin"></script>

    <script>
        tinymce.init({
            selector: 'textarea',
            menubar: false,
            skin: "oxide-dark",
            content_css: "dark"
        });
    </script>
</x-app-layout>
