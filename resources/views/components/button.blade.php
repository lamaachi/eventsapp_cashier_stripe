@props([
    'active' => false,
    'disabled' => false,
    'primary',
])

<button {{ $attributes->class(['btn', $primary ? 'btn-primary' : 'btn-secondary', 'active' => $active])->merge(['disabled' => $disabled, 'type' => 'button']) }}>{{ $slot }}</button>