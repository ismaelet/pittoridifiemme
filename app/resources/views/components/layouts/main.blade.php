@props([
    'title' => null,
    'headerColor' => 'light',
])

<x-layouts.app :$title>
    <div class="page-container">
        <x-header :color="$headerColor" />

        <main>
            {{ $slot }}
        </main>
    </div>
</x-layouts.app>
