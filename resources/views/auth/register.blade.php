@section('title', 'PiBoard')
<x-guest-layout>

    <h1 class="font-extrabold text-xl lg:hidden text-center text-black py-4">SMK PRAKARYA INTERNASIONAL</h1>
    <h1 class="hidden font-extrabold text-2xl lg:block text-center text-black py-4">SMK <br> PRAKARYA INTERNASIONAL</h1>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            {{-- <x-input-label for="name" :value="__('Name')" /> --}}
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus
                autocomplete="name" placeholder="Nama" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            {{-- <x-input-label for="email" :value="__('Email')" /> --}}
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                autocomplete="username" placeholder="Email" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            {{-- <x-input-label for="password" :value="__('Password')" /> --}}

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password"
                placeholder="Password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            {{-- <x-input-label for="password_confirmation" :value="__('Confirm Password')" /> --}}

            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required
                autocomplete="new-password" placeholder="Confirm Password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        {{-- <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div> --}}

        <button type="submit" class="w-full py-3 px-3 rounded-md text-white mt-6" style="background-color: #021F35">
            Login
        </button>

        <p class="text-center text-black mt-7 mb-3">Sudah Punya akun? <a href="{{ route('login') }}" class="text-blue-800">Sign
                In</a>
        </p>
    </form>

</x-guest-layout>
<div class="h-24 primary-blue-dark lg:hidden"></div>
