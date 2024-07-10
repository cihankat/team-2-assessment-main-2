<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Default Title') // {{ env('APP_NAME') }}</title>
    @vite('resources/css/app.css')
    <script src="//unpkg.com/alpinejs@2.8.0/dist/alpine.js" defer></script>
    <style>
        .sidebar-transition {
            transition: transform 0.3s ease;
            z-index: 1000;
        }
        .content-transition {
            transition: margin-left 0.3s ease;
        }
        @media (min-width: 768px) {
            .sidebar-open ~ .content-transition {
                margin-left: 256px;
            }
        }
        .sidebar-hidden {
            transform: translateX(-100%);
        }
        .content-full {
            margin-left: 0;
        }
    </style>
</head>
<body class="bg-gray-200" x-data="{ sidebarOpen: false }">
    @auth
    <div class="flex h-screen bg-gray-200">
        <div :class="{'sidebar-transition': true, 'sidebar-hidden': !sidebarOpen}"
             class="w-64 bg-blue-800 shadow h-full flex flex-col fixed inset-y-0 left-0">
            <div class="px-8 py-4 text-white text-2xl font-bold">
                <a href="{{ route('home') }}">{{ config('app.name') }}</a>
            </div>
            <nav class="mt-10">
                <a href="{{ route('admin_panel') }}" class="text-white py-2 px-4 block hover:bg-blue-700">Dashboard</a>
                <a href="{{ route('admin.users') }}" class="text-white py-2 px-4 block hover:bg-blue-700">Users</a>
                <a href="{{ route('admin.classes') }}" class="text-white py-2 px-4 block hover:bg-blue-700">Classes</a>
                <a href="{{ route('home') }}" class="text-white py-2 px-4 block hover:bg-blue-700">Back to {{ env('APP_NAME') }}</a>
            </nav>
            <div class="px-8 py-4">
            </div>
        </div>

        <div :class="{'content-transition': true, 'content-full': !sidebarOpen}"
             class="flex-1 flex flex-col overflow-hidden">
            <header class="flex justify-between items-center py-4 px-6 bg-white shadow">
                <div>
                    <button @click="sidebarOpen = !sidebarOpen">
                        <svg class="h-6 w-6 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"/>
                        </svg>
                    </button>
                </div>
            </header>
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
                @yield('content')
            </main>
        </div>
    </div>
    @endauth
</body>
</html>
