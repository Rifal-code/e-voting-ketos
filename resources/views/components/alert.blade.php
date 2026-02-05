@props([
    'type' => 'success', // success | error | warning | info
])

@php
    $classes = match ($type) {
        'success' => 'bg-green-100 text-green-800 border-green-300',
        'error' => 'bg-red-100 text-red-800 border-red-300',
        'warning' => 'bg-yellow-100 text-yellow-800 border-yellow-300',
        'info' => 'bg-blue-100 text-blue-800 border-blue-300',
        default => 'bg-gray-100 text-gray-800 border-gray-300',
    };
@endphp

<div role="alert" class="border px-4 py-3 rounded mb-4 {{ $classes }}">
    {{ $slot }}
</div>

<script>
    setTimeout(() => {
        const alert = document.querySelector('[role="alert"]');
        if (alert) alert.remove();
    }, 2000);
</script>
