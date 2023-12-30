<x-app-layout>
    @section('title', 'Create')
    <div class="p-4 text-white lg:w-3/5 mx-auto">
        <div class="lg:border-2 md:border-gray-800 md:p-3 md:bg-gray-800">
            <form action="{{ route('tweet.store') }}" method="POST" enctype="multipart/form-data" class="lg:px-4 py-6">
                @csrf
                <div class="mb-4">
                    <h2 class="mb-2">GAMBAR / VIDEO</h2>
                    <input type="file"
                        class="@error('file') is-invalid @enderror file-input file-input-md file-input-bordered w-full "
                        name="file" id="selectImage">

                    @error('image')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                    @enderror

                    <div class="mt-2">
                        <video id="videoPreview" src="#" alt="your video" style="display: none" controls></video>
                        <img id="imagePreview" src="#" alt="your image" class="mt-3 mx-auto"
                            style="display:none;" />
                        <audio id="audioPreview" src="#" class="mt-3 mx-auto" style="display: none"
                            controls></audio>
                    </div>
                </div>

                <div>
                    <h2 class="mb-4">CONTENT</h2>
                    <textarea name="content" id="" cols="30" rows="10" class="bg-slate-700 w-full rounded-lg captions"></textarea>
                </div>

                <div class="flex w-full justify-evenly mt-5">
                    <a href="/create"
                        class="bg-red-700 px-8 py-1 lg:px-12 lg:py-3 rounded-full cursor-pointer hover:bg-red-500">Reset</a>
                    <input type="submit" value="Publish"
                        class="bg-cyan-500 px-8 py-1 rounded-full cursor-pointer hover:bg-cyan-300">
                </div>
            </form>
        </div>
    </div>

</x-app-layout>
