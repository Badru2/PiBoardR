@section('title', 'PiBoard')
<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <h1 class="font-extrabold text-xl xl:text-2xl lg:hidden text-center text-black py-4">SMK PRAKARYA INTERNASIONAL</h1>
    <h1 class="hidden font-extrabold text-2xl lg:block text-center text-black py-4">SMK <br> PRAKARYA INTERNASIONAL</h1>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            {{-- <x-input-label for="email" :value="__('Email')" /> --}}
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus
                autocomplete="username" placeholder="Email" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            {{-- <x-input-label for="password" :value="__('Password')" /> --}}

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password"
                placeholder="Password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox"
                    class="rounded bg-white border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800"
                    name="remember">
                <span class="ms-2 text-sm text-black">{{ __('Ingat Saya') }}</span>
            </label>
        </div>

        {{-- <div class="items-center mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                    href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif
        </div> --}}

        <button type="submit" class="w-full py-3 px-3 rounded-md text-white my-3" style="background-color: #021F35">
            Login
        </button>

        <p class="text-center text-black mt-7 mb-3">Belum Punya akun? <a href="{{ route('register') }}" class="text-blue-800">Sign
                Up</a>
        </p>
    </form>
</x-guest-layout>
