<x-templates.adminlte :title="$title" :bodyClass="$bodyClass" :divClass="$divClass">
    <x-partials.preloader />
    <x-partials.flashdata />
    {{ $slot }}
</x-templates.adminlte>
