@props(['disabled' => false])
<button {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => '  px-3 py-2 text-sm font-semibold text-center inline-flex items-center text-white bg-emerald-500 rounded-lg hover:bg-emerald-800 focus:ring-4 focus:outline-none focus:ring-emerald-300 dark:bg-emerald-600 dark:hover:bg-emerald-700 dark:focus:ring-emerald-800']) !!} >
    {{ $slot }}
</button>
