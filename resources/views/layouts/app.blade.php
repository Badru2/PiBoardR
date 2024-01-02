<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="bg-gray-900">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <style>
        .primary-blue-dark {
            background-color: #021F35;
        }

        .primary-blue {
            background-color: #4AB6FF;
        }
    </style>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/output.css') }}">

    <script>
        document.querySelectorAll(".captions").forEach(function(el) {
            let renderedText = el.innerHTML.replace(/#(\w+)/g,
                "<a href='search?search=%23$1' style='color: #00A9FF; text-decoration: underline'>#$1</a>");
            el.innerHTML = renderedText;
        });
    </script>

    <script src="https://cdn.tiny.cloud/1/ug8k3u0xghcson8wedsmu7tihjbd1mg86xrhsdo9eg662qo9/tinymce/6/tinymce.min.js"
        referrerpolicy="origin"></script>

</head>

<body class="font-sans antialiased bg-gray-900 dark:bg-gray-900 text-white">
    <div class="min-h-screen bg-gray-900">
        @include('components.sidebar-left')
        @include('components.sidebar-right')

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white dark:bg-gray-800 shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <div class="fixed bottom-0 flex justify-evenly bg-gray-800 pt-1 pb-1 z-50 w-full lg:hidden">
            <x-bottom-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                <iconify-icon icon="uil:home"></iconify-icon>
            </x-bottom-nav-link>

            <x-bottom-nav-link onclick="search_modal.showModal()" :active="request()->routeIs('search')">
                <iconify-icon icon="ic:twotone-search"></iconify-icon>
            </x-bottom-nav-link>

            <x-bottom-nav-link :href="route('tweet.create')" :active="request()->routeIs('tweet.create')">
                <iconify-icon icon="material-symbols:upload"></iconify-icon>
            </x-bottom-nav-link>

            <x-bottom-nav-link :href="route('tweet.create')" :active="request()->routeIs('tweet.create')">
                <iconify-icon icon="ion:notifcations"></iconify-icon>
            </x-bottom-nav-link>

            <a href="{{ route('profile.index') }}">
                <img class="mt-1 {{ request()->routeIs('profile.index') ? 'ring-cyan-500 border-2 border-cyan-500 rounded-full w-9 h-9 object-cover' : 'w-9 h-9 object-cover rounded-full' }}"
                    src="{{ Auth::user()->avatar ? asset('images/avatar/' . Auth::user()->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) }}"
                    alt="{{ url('https://ui-avatars.com/api/?name=' . Auth::user()->name) }}">
            </a>
        </div>

        <dialog id="search_modal" class="modal">
            <div class="w-4/5 absolute top-2">
                <div class="px-1 py-1">
                    <form class="mx-auto w-full h-24" action="{{ route('search') }}" method="GET">
                        <div class="relative">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                </svg>
                            </div>
                            <input type="text" id="default-search"
                                class="block w-full ps-10 text-sm text-gray-900 border
                            border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500
                            focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600
                            dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500
                            dark:focus:border-blue-500"
                                name="search" placeholder="Search" value="{{ old('search') }}">
                        </div>
                    </form>
                </div>
            </div>
            <form method="dialog" class="modal-backdrop">
                <button>close</button>
            </form>
        </dialog>


        <!-- Page Content -->
        <main class="bg-gray-900">
            <div class="pb-5"></div>
            {{ $slot }}
        </main>

        <div class="h-24 lg:hidden"></div>
    </div>

    <script>
        tinymce.init({
            selector: '#editor',
            menubar: false,
            skin: "oxide-dark",
            content_css: "dark"
        });
    </script>

    <script>
        document.querySelectorAll(".captions").forEach(function(el) {
            let renderedText = el.innerHTML.replace(/#(\w+)/g,
                "<a href='search?search=%23$1' style='color: #00A9FF; text-decoration: underline'>#$1</a>");
            el.innerHTML = renderedText;
        });

        // Like Button
        function like(id, el) {
            fetch('/like/' + id)
                .then(response => response.json())
                .then(data => {
                    if (data.status == 'LIKE') {
                        el.innerHTML =
                            '<iconify-icon icon="material-symbols-light:favorite"></iconify-icon>';
                    } else {
                        el.innerHTML =
                            '<div class="text-danger"><iconify-icon icon="material-symbols:favorite-outline"></iconify-icon></div>';
                    }
                });
        }

        // Favorite (Bookmark) Button
        function favorite(id, el) {
            fetch('/favorite/' + id)
                .then(response => response.json())
                .then(data => {
                    if (data.status == 'FAVORITE') {
                        el.innerHTML =
                            '<iconify-icon icon="material-symbols:bookmark"></iconify-icon>';
                    } else {
                        el.innerHTML =
                            '<iconify-icon icon="material-symbols:bookmark-outline"></iconify-icon>';
                    }
                });
        }

        function follow(id, el) {
            fetch('/follow/' + id).then(response => response.json()).then(data => {
                el.innerText = (data.status == "FOLLOW") ? 'UNFOLLOW' : 'FOLLOW'
            });
        }
    </script>

    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script>
        document.getElementById('selectImage').onchange = function(evt) {
            const videoPreview = document.getElementById('videoPreview');
            const imagePreview = document.getElementById('imagePreview');

            videoPreview.style.display = 'none';
            imagePreview.style.display = 'none';

            const [file] = evt.target.files;

            if (file) {
                const fileURL = URL.createObjectURL(file);

                if (file.type.startsWith('video/')) {
                    // Show video preview
                    videoPreview.src = fileURL;
                    videoPreview.style.display = 'block';
                } else if (file.type.startsWith('image/')) {
                    // Show image preview
                    imagePreview.src = fileURL;
                    imagePreview.style.display = 'block';
                } else {
                    // Handle other file types as needed
                    console.error('Unsupported file type');
                }
            }
        };
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
</body>

</html>
