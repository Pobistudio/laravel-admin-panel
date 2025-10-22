<div class="p-4 rounded-t-xl sticky top-0 z-10">
    <h2 class="text-2xl font-medium mb-0 block">
        @hasSection('page_title')
            @yield('page_title')
        @else
            @yield('title')
        @endif
    </h2>
    <span class="text-sm text-gray-400 font-normal mb-0 block py-2 pl-1">@yield('page_subtitle')</span>
</div>
