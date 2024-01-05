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

    {{-- Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

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
        @include('components.bottom-nav')

        <!-- Page Content -->
        <main class="bg-gray-900">
            <div class="pb-5"></div>
            {{ $slot }}
        </main>

        <div class="h-24 lg:h-12"></div>
    </div>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>


    <script type="text/javascript">
        var path = "{{ route('search') }}";

        $('#search').typeahead({
            source: function(query, process) {
                return $.get(path, {
                    query: query
                }, function(data) {
                    return process(data);
                });
            }
        });
    </script>

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
