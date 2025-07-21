<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div id="mainlayout" class="flex flex-row bg-lap-white p-4 h-screen gap-4">
        <aside id="sidebar" class="flex flex-col w-64 h-full bg-slate-200 lg:rounded-xl rounded-none flex-shrink-0 overflow-y-auto
                       transition-all duration-300 ease-in-out
                      fixed inset-y-0 left-0 transform -translate-x-full z-50
                      md:relative md:translate-x-0">
            <div class="p-4 bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 sticky top-0 z-10">
                <h2 class="text-xl font-bold mb-0">Sidebar</h2>
            </div>
            <div class="p-4 overflow-y-auto hide-scrollbar">
                <nav class="mt-5">
                    <ul>
                        <li>
                            <a href="#" class="flex items-center justify-between p-2 hover:bg-gray-700">
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li class="relative">
                            <a href="#" class="flex items-center justify-between p-2 hover:bg-gray-700 menu-toggle">
                                <span>Products</span>
                                <svg class="w-4 h-4 transition-transform duration-200 transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </a>
                            <ul class="ml-4 nested-menu hidden">
                                <li>
                                    <a href="#" class="block p-2 hover:bg-gray-700">All Products</a>
                                </li>
                                <li class="relative">
                                    <a href="#" class="flex items-center justify-between p-2 hover:bg-gray-700 menu-toggle">
                                        <span>Categories</span>
                                        <svg class="w-4 h-4 transition-transform duration-200 transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                    </a>
                                    <ul class="ml-4 nested-menu hidden">
                                        <li><a href="#" class="block p-2 hover:bg-gray-700">Electronics</a></li>
                                        <li><a href="#" class="block p-2 hover:bg-gray-700">Clothing</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#" class="block p-2 hover:bg-gray-700">Add New Product</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

        <div id="sidebar-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden md:hidden"></div>

        <main class="flex flex-col w-full h-full gap-3 transition-all duration-300 ease-in-out" id="main-content-area">
            <header class="w-full h-20 bg-slate-200 rounded-xl flex items-center justify-between p-4">
                <h1 class="text-2xl font-bold">Dashboard</h1>
                <button id="toggleSidebar" class="md:hidden p-2 bg-slate-300 rounded-lg text-gray-700 hover:bg-slate-400 focus:outline-none focus:ring-2 focus:ring-slate-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </header>
            <section class="flex flex-col w-full h-full bg-slate-200 rounded-xl overflow-hidden">
                <div class="p-4 bg-slate-200 rounded-t-xl sticky top-0 z-10">
                    <h2 class="text-xl font-semibold mb-0">Konten Utama</h2>
                </div>
                <div class="p-4 overflow-auto hide-scrollbar">
                    <p class="mb-2">Ini adalah area konten utama Anda. Sidebar dapat diciutkan dan diperluas.</p>
                    <p class="mb-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                    <p class="mb-2">Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                    <p class="mb-2">Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    <p class="mb-2">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
                    <p class="mb-2">Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.</p>
                    <p class="mb-2">Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.</p>
                    <p class="mb-2">Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur?</p>
                    <p class="mb-2">Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?</p>
                    <p class="mb-2">At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.</p>
                    <p class="mb-2">Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus.</p>
                    <p class="mb-2">Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.</p>
                    <p class="mb-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                    <p class="mb-2">Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                    <p class="mb-2">Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    <p class="mb-2">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
                    <p class="mb-2">Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.</p>
                    <p class="mb-2">Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.</p>
                    <p class="mb-2">Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur?</p>
                    <p class="mb-2">Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?</p>
                    <p class="mb-2">At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.</p>
                    <p class="mb-2">Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus.</p>
                    <p class="mb-2">Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.</p>
                </div>
            </section>
        </main>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mainLayout = document.getElementById('mainlayout');
            const toggleSidebarBtn = document.getElementById('toggleSidebar');
            const sidebar = document.getElementById('sidebar');
            const sidebarOverlay = document.getElementById('sidebar-overlay');
            const mainContentArea = document.getElementById('main-content-area');
            let isSidebarCollapsed = false;

            // Fungsi untuk membuka sidebar
            function openSidebar() {
                sidebar.classList.remove('-translate-x-full');
                sidebarOverlay.classList.remove('hidden');
            }

            // Fungsi untuk menutup sidebar
            function closeSidebar() {
                sidebar.classList.add('-translate-x-full');
                sidebarOverlay.classList.add('hidden');
            }

            // Event listener untuk tombol toggle
            toggleSidebarBtn.addEventListener('click', () => {
                if (sidebar.classList.contains('-translate-x-full')) {
                    openSidebar();
                } else {
                    closeSidebar();
                }
            });

            // Event listener untuk overlay (menutup sidebar saat klik di luar)
            sidebarOverlay.addEventListener('click', closeSidebar);

            // Menutup sidebar saat ukuran layar berubah dari mobile ke desktop
            // Ini memastikan sidebar selalu terbuka di desktop jika itu adalah perilaku yang diinginkan
            window.addEventListener('resize', () => {
                if (window.innerWidth >= 768) { // 768px adalah breakpoint default 'md' di Tailwind
                    sidebar.classList.remove('-translate-x-full');
                    sidebarOverlay.classList.add('hidden'); // Pastikan overlay tersembunyi di desktop
                }
            });
        });
    </script>
</body>
</html>
