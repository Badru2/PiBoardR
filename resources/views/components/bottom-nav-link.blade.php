@props(['active'])

@php
    $classes =
        $active ?? false
            ? 'inline-flex items-center justify-center border-indigo-400 dark:border-indigo-600 text-2xl rounded-full
            leading-5 text-gray-900 dark:text-gray-100 focus:border-indigo-700 transition duration-150 ease-in-out'
            : 'inline-flex items-center justify-center border-transparent text-2xl font-medium leading-5 text-gray-500
            dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300 dark:hover:border-gray-700
            focus:text-gray-700 dark:focus:text-gray-300 focus:border-gray-300 dark:focus:border-gray-700
            transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
