<div class="w-80 bg-white rounded-lg shadow-lg p-4" x-data="treeView()">
    <div class="mb-4">
        <h3 class="text-lg font-semibold text-gray-800 mb-2">Navigation Menu</h3>
        <input
            type="text"
            x-model="search"
            placeholder="Search menu..."
            class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
        >
    </div>

    <div class="space-y-1 max-h-[600px] overflow-y-auto custom-scrollbar">
        <template x-for="item in filteredMenus" :key="item.id">
            <div x-data="{ expanded: false }">
                <!-- Parent Menu Item -->
                <div
                    @click="item.children.length > 0 ? expanded = !expanded : navigateTo(item.link)"
                    class="flex items-center justify-between px-3 py-2.5 rounded-lg cursor-pointer transition-all duration-200 group"
                    :class="item.children.length > 0 && expanded ? 'bg-blue-50 text-blue-700' : 'hover:bg-gray-50 text-gray-700 hover:text-gray-900'"
                >
                    <div class="flex items-center gap-3 flex-1">
                        <!-- Toggle Icon for parent with children -->
                        <template x-if="item.children.length > 0">
                            <i
                                class="text-gray-400 transition-transform duration-200 text-sm"
                                :class="expanded ? 'ri-arrow-down-s-line' : 'ri-arrow-right-s-line'"
                            ></i>
                        </template>

                        <!-- Menu Icon -->
                        <template x-if="item.icon && item.icon !== '#'">
                            <i
                                :class="item.icon"
                                class="text-lg transition-colors duration-200"
                                :class="expanded ? 'text-blue-600' : 'text-gray-500 group-hover:text-blue-600'"
                            ></i>
                        </template>

                        <!-- Menu Name -->
                        <span
                            class="text-sm font-medium transition-colors duration-200"
                            x-text="item.name"
                        ></span>
                    </div>

                    <!-- Badge for children count -->
                    <template x-if="item.children.length > 0">
                        <span
                            class="px-2 py-0.5 text-xs font-medium rounded-full transition-colors duration-200"
                            :class="expanded ? 'bg-blue-100 text-blue-700' : 'bg-gray-100 text-gray-600 group-hover:bg-blue-100 group-hover:text-blue-700'"
                            x-text="item.children.length"
                        ></span>
                    </template>
                </div>

                <!-- Children Menu Items -->
                <template x-if="item.children.length > 0">
                    <div
                        x-show="expanded"
                        x-collapse
                        class="ml-6 mt-1 space-y-1 border-l-2 border-gray-200 pl-4"
                    >
                        <template x-for="child in item.children" :key="child.id">
                            <a
                                :href="child.link"
                                class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm text-gray-600 hover:text-gray-900 hover:bg-gray-50 transition-all duration-200 group"
                            >
                                <!-- Child Item Dot -->
                                <span class="w-1.5 h-1.5 rounded-full bg-gray-300 group-hover:bg-blue-500 transition-colors duration-200"></span>

                                <!-- Child Name -->
                                <span
                                    class="font-medium"
                                    x-text="child.name"
                                ></span>
                            </a>
                        </template>
                    </div>
                </template>
            </div>
        </template>

        <!-- Empty State -->
        <template x-if="filteredMenus.length === 0">
            <div class="text-center py-8 text-gray-400">
                <i class="ri-search-line text-4xl mb-2"></i>
                <p class="text-sm">No menu found</p>
            </div>
        </template>
    </div>
</div>
@push('scripts')
    <script>
        function treeView() {
            return {
                search: '',
                menus: @json($menus ?? []),

                get filteredMenus() {
                    if (!this.search) return this.menus;

                    const searchLower = this.search.toLowerCase();
                    return this.menus.filter(menu => {
                        const nameMatch = menu.name.toLowerCase().includes(searchLower);
                        const childMatch = menu.children.some(child =>
                            child.name.toLowerCase().includes(searchLower)
                        );
                        return nameMatch || childMatch;
                    }).map(menu => {
                        if (menu.children.length > 0) {
                            return {
                                ...menu,
                                children: menu.children.filter(child =>
                                    child.name.toLowerCase().includes(searchLower)
                                )
                            };
                        }
                        return menu;
                    });
                },

                navigateTo(link) {
                    if (link && link !== '#') {
                        window.location.href = link;
                    }
                }
            }
        }
    </script>
@endpush
