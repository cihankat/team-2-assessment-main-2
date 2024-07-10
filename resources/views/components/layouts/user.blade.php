<!DOCTYPE html>
<html lang="en">
<head>
   @stack('scripts')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', "Default title") // {{ env('APP_NAME') }}</title>
    @vite('resources/css/app.css')
    <script src="//unpkg.com/alpinejs@2.8.0/dist/alpine.js" defer></script>
    <style>
        /* Sidebar and Content transition styles */
        .sidebar-transition {
            transition: transform 0.3s ease;
            z-index: 1000; /* Ensures the sidebar is on top of other content */
        }

        .content-transition {
            transition: margin 0.3s ease;
        }

        /* Ensures the sidebar is off-screen when hidden */
        .sidebar-hidden {
            transform: translateX(-100%);
        }

        /* Adjust margin when the sidebar is visible */
        .content-visible {
            margin-left: 256px; /* Adjust this value to match your sidebar's width */
        }

        /* Full width when the sidebar is hidden */
        .content-hidden {
            margin-left: 0;
        }

        /* -----
        SVG Icons - svgicons.sparkk.fr
        ----- */

        .svg-icon {
            width: 1.75em;
            height: 1.75em;
        }

        .svg-icon path,
        .svg-icon polygon,
        .svg-icon rect {
            fill: #4691f6;
        }

        .svg-icon circle {
            stroke: #4691f6;
            stroke-width: 1;
        }

        /* Add this new style for the profile button */
        .profile-btn {
            display: block; /* Makes it block to take full width */
            padding: 10px 20px; /* Adds some padding */
            text-align: center; /* Centers the text */
            color: white; /* White text color */
            background-color: transparent; /* Keeps the background transparent or set your color */
            border-radius: 5px; /* Optional: if you want rounded corners */
            text-decoration: none; /* Removes underline from links */
        }

        /* Ensure white text color for SVG icon within the button */
        .profile-btn .svg-icon path,
        .profile-btn .svg-icon polygon,
        .profile-btn .svg-icon rect {
            fill: white;
        }
    </style>
</head>

<body class="bg-gray-200" x-data="{ sidebarOpen: false }">
@auth
    <div class="flex h-screen bg-gray-200">
        <!-- Sidebar -->
        <div :class="sidebarOpen ? 'sidebar-transition' : 'sidebar-transition sidebar-hidden'"
             class="w-64 bg-blue-800 shadow h-full flex flex-col fixed inset-y-0 left-0" x-show="sidebarOpen"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="transform -translate-x-full" x-transition:enter-end="transform translate-x-0"
             x-transition:leave="transition ease-in duration-300" x-transition:leave-start="transform translate-x-0"
             x-transition:leave-end="transform -translate-x-full">
            <div class="flex-1">
                <div class="px-8 py-4 text-white text-2xl font-bold">
                    <a href="{{ route('home') }}">{{ env('APP_NAME') }}</a>
                </div>
                <nav class="text-white text-base font-semibold">
                    <a href="{{ route('assessment.index') }}"
                       class="flex items-center text-white py-4 pl-6 nav-item active-nav-link">
                        Assessment
                    </a>
                    <a href="{{ route('checklists.index') }}" class="flex items-center text-white py-4 pl-6 nav-item">
                        Checklist
                    </a>
                    <a href="{{ route('calendar') }}" class="flex items-center text-white py-4 pl-6 nav-item">
                        Agenda
                    </a>
                    @can('access_admin')
                        <a href="{{ route('admin_panel') }}" class="flex items-center text-white py-4 pl-6 nav-item">
                            Admin
                        </a>
                    @endcan
                    <!-- More sidebar items -->
                </nav>
            </div>
            <!-- Profile Picture at the bottom of the sidebar -->
            <div class="px-8 py-4">
                {{-- Update this link to point to the user.settings route --}}
                <a href="{{ route('user.settings') }}" class="profile-btn">
                    <img src="{{ auth()->user()->profile_picture ? asset('storage/' . auth()->user()->profile_picture) : asset('path/to/default/avatar.png') }}"
                        alt="Profile" class="mx-auto h-12 w-12 rounded-full object-cover">
                </a>

            </div>
        </div>

        <!-- Content area -->
        <div :class="sidebarOpen ? 'content-transition content-visible' : 'content-transition content-hidden'"
             class="flex-1 flex flex-col">
            <header class="flex justify-between items-center py-4 px-6 bg-white shadow">
                <div>
                    <button @click="sidebarOpen = !sidebarOpen">
                        <svg class="h-6 w-6 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M4 6h16M4 12h16m-7 6h7"/>
                        </svg>
                    </button>
                </div>
                <div class="relative">
                    <!-- Notification icon -->
                    <button onclick="toggleNotifications()" class="relative">
                        <svg class="svg-icon" viewBox="0 0 20 20">
                            <path
                                d="M14.38,3.467l0.232-0.633c0.086-0.226-0.031-0.477-0.264-0.559c-0.229-0.081-0.48,0.033-0.562,0.262l-0.234,0.631C10.695,2.38,7.648,3.89,6.616,6.689l-1.447,3.93l-2.664,1.227c-0.354,0.166-0.337,0.672,0.035,0.805l4.811,1.729c-0.19,1.119,0.445,2.25,1.561,2.65c1.119,0.402,2.341-0.059,2.923-1.039l4.811,1.73c0,0.002,0.002,0.002,0.002,0.002c0.23,0.082,0.484-0.033,0.568-0.262c0.049-0.129,0.029-0.266-0.041-0.377l-1.219-2.586l1.447-3.932C18.435,7.768,17.085,4.676,14.38,3.467 M9.215,16.211c-0.658-0.234-1.054-0.869-1.014-1.523l2.784,0.998C10.588,16.215,9.871,16.447,9.215,16.211 M16.573,10.27l-1.51,4.1c-0.041,0.107-0.037,0.227,0.012,0.33l0.871,1.844l-4.184-1.506l-3.734-1.342l-4.185-1.504l1.864-0.857c0.104-0.049,0.188-0.139,0.229-0.248l1.51-4.098c0.916-2.487,3.708-3.773,6.222-2.868C16.187,5.024,17.489,7.783,16.573,10.27"></path>
                        </svg>
                        <!-- Notification count if applicable -->
                        <span id="notificationCount"
                              class="absolute top-0 right-0 inline-flex items-center justify-center px-1.5 py-0.5 mr-2 text-xs font-bold leading-none bg-red-500 text-white rounded-full">{{ $unreadNotificationCount }}</span>
                    </button>
                    <!-- Dropdown menu for notifications -->
                    <div id="notificationDropdown"
                         class="hidden origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none"
                         role="menu" aria-orientation="vertical" aria-labelledby="options-menu">
                        <div class="py-1" role="none">
                            @foreach($notifications as $notification)
                                <a href="{{ route('notifications.notification', ['id' => $notification->id]) }}"
                                   class="block px-4 py-2 text-sm @if($notification->read_at) text-gray-400 hover:bg-gray-100 @else text-gray-700 hover:bg-gray-100 @endif"
                                   role="menuitem">{{ $notification->title }}</a>
                            @endforeach
                            <a href="{{ route('notifications') }}"
                               class="block px-4 py-2 text-sm text-center text-gray-700 hover:bg-gray-100"
                               role="menuitem">Toon alles</a>
                        </div>
                    </div>
                </div>
            </header>

            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
                @yield('content')
            </main>
        </div>
    </div>
@endauth

<script>
    let notificationOpen = false;

    function toggleNotifications() {
        notificationOpen = !notificationOpen;
        const dropdown = document.getElementById('notificationDropdown');
        const count = document.getElementById('notificationCount');
        if (notificationOpen) {
            dropdown.classList.remove('hidden');
            // Your notification count update logic here
        } else {
            dropdown.classList.add('hidden');
        }
    }
</script>

</body>
</html>
