<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <link href="{{ asset('logo.png') }}" rel='shortcut icon'>

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

        .primary-red {
            background: #C70039;
        }

        .primary-red-border {
            border: 2px solid #C70039;
        }

        @media screen and (min-width: 1024px) {
            div.primary-blue-lg {
                background-color: #4AB6FF;
            }

            div.primary-red-left {
                border-left: #C70039 solid 5px
            }
        }
    </style>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/output.css') }}">
</head>

<body class="font-sans text-gray-900 antialiased">
    <div class="min-h-screen flex flex-col lg:flex-row items-center px-3 bg-gray-100 dark:bg-gray-900">
        <div class="lg:hidden">
            <a href="/">
                <img src="{{ asset('icon_white.svg') }}" class="mb-5 mt-12 w-64" alt="">
            </a>
        </div>

        <div class="hidden lg:block w-2/5 text-white ps-4">
            <img src="{{ asset('icon_white.svg') }}" class="w-72" alt="">
            <div class="w-40 h-2 rounded-full primary-red my-4"></div>
            <h1 class="text-3xl">Selamat Datang Di</h1>
            <h1 class="text-3xl font-extrabold">PI Board</h1>
        </div>

        <div class="lg:w-3/5 lg:h-screen primary-blue-lg primary-red-left flex">
            <div
                class="w-full m-auto lg:bg-white sm:max-w-md px-6 py-4 primary-blue shadow-md overflow-hidden rounded-lg primary-red-border">
                {{ $slot }}
            </div>
        </div>
    </div>
</body>

</html>
