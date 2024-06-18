@props([
    'name',
])

<button data-modal-target="{{ $name }}" data-modal-toggle="{{ $name }}" type="button">
    {{ $slot }}
</button>