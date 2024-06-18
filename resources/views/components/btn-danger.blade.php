@props(['disabled' => false])
<button {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => '  px-3 py-2 text-sm font-semibold text-center inline-flex items-center text-white bg-red-500 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800']) !!} >
    {{ $slot }}
</button>
