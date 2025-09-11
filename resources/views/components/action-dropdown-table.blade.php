<div class="relative my-2" x-data="{ open: false }" @click.outside="open = false">
    <button type="button" class="inline-flex items-center p-2 rounded-full text-gray-400 hover:text-gray-600 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-slate-500 cursor-pointer" id="options-menu" aria-haspopup="true" aria-expanded="true" @click="open = ! open">
        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
            <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z" />
        </svg>
    </button>

    <div x-show="open" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-slate-400 ring-opacity-5 focus:outline-none z-50 origin-top-right" role="menu" aria-orientation="vertical" aria-labelledby="options-menu">
        <div class="py-1" role="none">
            @foreach ($actions as $item)
                @if ($item['type'] == 'link')
                   <a href="{{ $item['action'] }}" target="{{ (isset($item['new_tab']) && $item['new_tab']) ? '_blank' : '_self'  }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900 cursor-pointer text-start" role="menuitem">
                        {{ $item['name'] }}
                    </a>
                @else
                    <button type="button" class="w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900 cursor-pointer text-start" onclick="{{ $item['action'] }}">
                        {{ $item['name'] }}
                    </button>
                @endif
            @endforeach
        </div>
    </div>
</div>
