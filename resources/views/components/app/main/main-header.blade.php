<header class="w-full h-20 bg-white flex items-center md:justify-end justify-between p-4">
    <button id="toggleSidebar" class="md:hidden p-2 bg-lap-dark rounded-lg text-lap-white  hover:drop-shadow-lg focus:outline-none focus:ring-2">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
        </svg>
    </button>

    <div class="relative inline-block text-left">
        <div>
            <button type="button" class="inline-flex gap-2 cursor-pointer items-center justify-center w-full px-4 py-2 bg-transparent font-medium text-gray-700 hover:bg-gray-100 hover:drop-shadow-lg hover:rounded-lg focus:outline-none" id="menu-button" aria-expanded="true" aria-haspopup="true">
                <i class="ri-user-4-line ri-lg flex bg-lap-dark text-white rounded-full w-8 h-8 items-center justify-center"></i>
                <small>John Doe</small>
                <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </button>
        </div>

        <div id="dropdown-menu" class="hidden origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-gray-100 ring-1 ring-slate-400 ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
            <div class="py-1" role="none">
                <a href="#" class="text-gray-700 block px-4 py-2 text-sm hover:bg-gray-300" role="menuitem" tabindex="-1" id="menu-item-2">Dukungan</a>
                <form method="POST" action="#" role="none">
                    <button type="submit" class="text-gray-700 block w-full text-left px-4 py-2 text-sm hover:bg-gray-300" role="menuitem" tabindex="-1" id="menu-item-3">Keluar</button>
                </form>
            </div>
        </div>
    </div>
</header>
