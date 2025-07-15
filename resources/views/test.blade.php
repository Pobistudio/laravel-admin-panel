<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-amber-300 p-3">
    <aside class="w-64 bg-gray-800 text-white min-h-screen">
        <nav class="mt-10">
            <ul>
                <li>
                    <a href="#" class="flex items-center justify-between p-4 hover:bg-gray-700">
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="relative">
                    <a href="#" class="flex items-center justify-between p-4 hover:bg-gray-700 menu-toggle">
                        <span>Products</span>
                        <svg class="w-4 h-4 transition-transform duration-200 transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </a>
                    <ul class="ml-4 nested-menu hidden">
                        <li>
                            <a href="#" class="block p-4 hover:bg-gray-700">All Products</a>
                        </li>
                        <li class="relative">
                            <a href="#" class="flex items-center justify-between p-4 hover:bg-gray-700 menu-toggle">
                                <span>Categories</span>
                                <svg class="w-4 h-4 transition-transform duration-200 transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </a>
                            <ul class="ml-4 nested-menu hidden">
                                <li><a href="#" class="block p-4 hover:bg-gray-700">Electronics</a></li>
                                <li><a href="#" class="block p-4 hover:bg-gray-700">Clothing</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#" class="block p-4 hover:bg-gray-700">Add New Product</a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="#" class="flex items-center justify-between p-4 hover:bg-gray-700">
                        <span>Settings</span>
                    </a>
                </li>
            </ul>
        </nav>
    </aside>
</body>
</html>
