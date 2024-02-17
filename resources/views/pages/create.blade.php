<x-app-layout>
    @section('title', 'Create')
    <div class="p-4 mx-auto text-white lg:w-3/5">
        <div class="lg:border-2 md:border-gray-800 md:p-3 md:bg-gray-800">
            <form action="{{ route('tweet.store') }}" method="POST" enctype="multipart/form-data" class="py-6 lg:px-4">
                @csrf
                <div class="mb-4">
                    <h2 class="mb-2">GAMBAR / VIDEO</h2>
                    <input type="file"
                        class="@error('file') is-invalid @enderror file-input file-input-md file-input-bordered w-full "
                        name="file" id="selectImage">

                    @error('image')
                        <div class="mt-2 alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror

                    <div class="mt-2">
                        <video id="videoPreview" src="#" alt="your video" style="display: none" controls></video>
                        <img id="imagePreview" src="#" alt="your image" class="mx-auto mt-3"
                            style="display:none;" />
                        <audio id="audioPreview" src="#" class="mx-auto mt-3" style="display: none"
                            controls></audio>
                    </div>
                </div>

                <div>
                    <h2 class="mb-4">CONTENT</h2>
                    <textarea name="content" id="" cols="30" rows="10" class="w-full rounded-lg bg-slate-700 captions"
                        id="editor"></textarea>
                </div>

                <div class="flex w-full mt-5 justify-evenly">
                    <a href="{{ route('tweet.create') }}"
                        class="px-8 py-1 bg-red-700 rounded-full cursor-pointer lg:px-12 lg:py-3 hover:bg-red-500">Reset</a>
                    <input type="submit" value="Publish"
                        class="px-8 py-1 rounded-full cursor-pointer bg-cyan-500 hover:bg-cyan-300">
                </div>
            </form>
        </div>
    </div>

    {{-- <script src="https://cdn.tiny.cloud/1/ug8k3u0xghcson8wedsmu7tihjbd1mg86xrhsdo9eg662qo9/tinymce/6/tinymce.min.js"
        referrerpolicy="origin"></script>

    <script>
        tinymce.init({
            selector: 'textarea',
            menubar: false,
            skin: "oxide-dark",
            content_css: "dark"
        });
    </script> --}}

</x-app-layout>
