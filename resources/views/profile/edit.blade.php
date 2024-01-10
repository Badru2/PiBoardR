@section('title', 'Edit Profile')
<x-app-layout>
    <div class="px-3">
        <div class="lg:w-3/5 lg:bg-gray-800 pb-3 mx-auto sm:px-6 lg:px-8 space-y-6 py-3 bg-dark text-white">
            <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="space-y-3">
                @csrf
                @method('PUT')

                <div>
                    @error('image')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                    @enderror

                    <div class="mt-2 w-full">
                        <video id="videoPreview" src="#" alt="your video" style="display: none" controls></video>
                        <img id="imagePreview" src="#" alt="your image"
                            class="mt-3 rounded-full w-32 h-32 lg:w-52 lg:h-52 object-cover mx-auto"
                            style="display:none;" />
                        <audio id="audioPreview" src="#" class="mt-3" style="display: none" controls></audio>
                    </div>

                    <h2>Avatar :</h2>
                    <input type="file" class="file-input file-input-md file-input-bordered w-full " name="avatar"
                        id="selectImage">

                </div>

                @if ($errors->has('avatar'))
                    <span class="invalid-feedback" role="alert">
                        {{ $errors->first('avatar') }}
                    </span>
                @endif

                <div>
                    <h2>Name :</h2>
                    <input type="text" name="name" value="{{ $user->name }}"
                        class="w-full bg-gray-600 rounded-lg">
                </div>

                <div>
                    <h2>Full Name :</h2>
                    <input type="fullName" class="w-full bg-gray-600 rounded-lg py-2">
                </div>

                <div>
                    <h2>Biodata :</h2>
                    <textarea name="bio" id="" cols="30" rows="10" class="w-full bg-gray-600 rounded-lg"></textarea>
                </div>

                <button type="submit"
                    class="bg-cyan-600 py-2 px-5 rounded-lg font-bold text-white my-3">Submit</button>
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
