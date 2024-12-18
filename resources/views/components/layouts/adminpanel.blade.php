<x-templates.adminlte :title="$title" bodyClass="sidebar-mini layout-fixed layout-navbar-fixed" divClass="wrapper">
    <x-partials.preloader />
    <x-partials.flashdata />
    <x-partials.navbar />
    <x-partials.sidebar />
    <x-partials.content :title="$title">
        {{ $slot }}
    </x-partials.content>
    <x-partials.footer />
</x-templates.adminlte>
