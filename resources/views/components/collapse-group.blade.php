@props(['id' => 'accordion-' . uniqid()])

<div x-data="{ active: null }" class="space-y-3">
    {{ $slot }}
</div>
