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
        <aside id="sidebar" class="flex flex-col w-64 h-full bg-slate-200 rounded-xl transition-all duration-300 ease-in-out">
            <div class="p-4 bg-slate-200 rounded-t-xl sticky top-0 z-10">
                <h2 class="text-xl font-bold mb-0">Sidebar</h2>
            </div>
            <div class="p-4 overflow-y-auto">
                <nav>
                    <ul>
                        <li class="mb-2"><a href="#" class="text-gray-700 hover:text-gray-900">Link 1</a></li>
                        <li class="mb-2"><a href="#" class="text-gray-700 hover:text-gray-900">Link 2</a></li>
                        <li class="mb-2"><a href="#" class="text-gray-700 hover:text-gray-900">Link 3</a></li>
                        <li class="mb-2"><a href="#" class="text-gray-700 hover:text-gray-900">Link 4</a></li>
                        <li class="mb-2"><a href="#" class="text-gray-700 hover:text-gray-900">Link 5</a></li>
                        <li class="mb-2"><a href="#" class="text-gray-700 hover:text-gray-900">Link 6</a></li>
                        <li class="mb-2"><a href="#" class="text-gray-700 hover:text-gray-900">Link 7</a></li>
                        <li class="mb-2"><a href="#" class="text-gray-700 hover:text-gray-900">Link 8</a></li>
                        <li class="mb-2"><a href="#" class="text-gray-700 hover:text-gray-900">Link 9</a></li>
                        <li class="mb-2"><a href="#" class="text-gray-700 hover:text-gray-900">Link 10</a></li>
                        <li class="mb-2"><a href="#" class="text-gray-700 hover:text-gray-900">Link 11</a></li>
                        <li class="mb-2"><a href="#" class="text-gray-700 hover:text-gray-900">Link 12</a></li>
                        <li class="mb-2"><a href="#" class="text-gray-700 hover:text-gray-900">Link 13</a></li>
                        <li class="mb-2"><a href="#" class="text-gray-700 hover:text-gray-900">Link 14</a></li>
                        <li class="mb-2"><a href="#" class="text-gray-700 hover:text-gray-900">Link 15</a></li>
                        <li class="mb-2"><a href="#" class="text-gray-700 hover:text-gray-900">Link 16</a></li>
                        <li class="mb-2"><a href="#" class="text-gray-700 hover:text-gray-900">Link 17</a></li>
                        <li class="mb-2"><a href="#" class="text-gray-700 hover:text-gray-900">Link 18</a></li>
                        <li class="mb-2"><a href="#" class="text-gray-700 hover:text-gray-900">Link 19</a></li>
                        <li class="mb-2"><a href="#" class="text-gray-700 hover:text-gray-900">Link 20</a></li>
                        <li class="mb-2"><a href="#" class="text-gray-700 hover:text-gray-900">Link 20</a></li>
                        <li class="mb-2"><a href="#" class="text-gray-700 hover:text-gray-900">Link 20</a></li>
                        <li class="mb-2"><a href="#" class="text-gray-700 hover:text-gray-900">Link 20</a></li>
                        <li class="mb-2"><a href="#" class="text-gray-700 hover:text-gray-900">Link 20</a></li>
                        <li class="mb-2"><a href="#" class="text-gray-700 hover:text-gray-900">Link 20</a></li>
                        <li class="mb-2"><a href="#" class="text-gray-700 hover:text-gray-900">Link 20</a></li>
                        <li class="mb-2"><a href="#" class="text-gray-700 hover:text-gray-900">Link 20</a></li>
                        <li class="mb-2"><a href="#" class="text-gray-700 hover:text-gray-900">Link 20</a></li>
                        <li class="mb-2"><a href="#" class="text-gray-700 hover:text-gray-900">Link 20</a></li>
                        <li class="mb-2"><a href="#" class="text-gray-700 hover:text-gray-900">Link 20</a></li>
                        <li class="mb-2"><a href="#" class="text-gray-700 hover:text-gray-900">Link 20</a></li>
                        <li class="mb-2"><a href="#" class="text-gray-700 hover:text-gray-900">Link 20</a></li>
                        <li class="mb-2"><a href="#" class="text-gray-700 hover:text-gray-900">Link 20</a></li>
                        <li class="mb-2"><a href="#" class="text-gray-700 hover:text-gray-900">Link 20</a></li>
                        <li class="mb-2"><a href="#" class="text-gray-700 hover:text-gray-900">Link 20</a></li>
                    </ul>
                </nav>
            </div>
        </aside>

        <main class="flex flex-col w-full h-full gap-3 transition-all duration-300 ease-in-out" id="main-content-area">
            <header class="w-full h-20 bg-slate-200 rounded-xl flex items-center justify-between p-4">
                <h1 class="text-2xl font-bold">Dashboard</h1>
                <button id="toggleSidebar" class="p-2 bg-slate-300 rounded-lg text-gray-700 hover:bg-slate-400 focus:outline-none focus:ring-2 focus:ring-slate-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </header>
            <section class="flex flex-col w-full h-full bg-slate-200 rounded-xl overflow-hidden">
                <div class="p-4 bg-slate-200 rounded-t-xl sticky top-0 z-10">
                    <h2 class="text-xl font-semibold mb-0">Konten Utama</h2>
                </div>
                <div class="p-4 overflow-auto">
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
            const mainContentArea = document.getElementById('main-content-area');
            let isSidebarCollapsed = false;

            toggleSidebarBtn.addEventListener('click', function() {
                if (isSidebarCollapsed) {
                    // Main Layout
                    mainLayout.classList.add('gap-4');
                    mainLayout.classList.remove('gap-0');
                    // Expand sidebar
                    sidebar.classList.remove('w-0', 'p-0', 'overflow-hidden');
                    sidebar.classList.add('w-64'); // Add back original width
                    // Show sidebar content again
                    sidebar.querySelector('.p-4.overflow-y-auto').classList.remove('hidden');
                    sidebar.querySelector('.p-4.bg-slate-200.rounded-t-xl.sticky').classList.remove('hidden');

                    mainContentArea.classList.remove('ml-0');
                    toggleSidebarBtn.innerHTML = `
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    `;
                } else {
                    // Main Layout
                    mainLayout.classList.remove('gap-4');
                    mainLayout.classList.add('gap-0');
                    // Collapse sidebar
                    sidebar.classList.remove('w-64'); // Remove original width
                    sidebar.classList.add('w-0', 'p-0', 'overflow-hidden'); // Make it disappear
                    // Hide sidebar content to prevent overflow issues
                    sidebar.querySelector('.p-4.overflow-y-auto').classList.add('hidden');
                    sidebar.querySelector('.p-4.bg-slate-200.rounded-t-xl.sticky').classList.add('hidden');


                    // mainContentArea.classList.add('ml-4'); // Optional: push main content
                    toggleSidebarBtn.innerHTML = `
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7"></path>
                        </svg>
                    `;
                }
                isSidebarCollapsed = !isSidebarCollapsed;
            });
        });
    </script>
</body>
</html>
