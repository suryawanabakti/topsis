<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SPK BLT Desa Turungan Baji')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        .sidebar-overlay {
            transition: opacity 0.3s ease;
        }

        .sidebar {
            transition: transform 0.3s ease;
        }
    </style>
</head>

<body class="bg-gray-100 text-gray-800 antialiased font-sans">

    @guest
        @yield('content')
    @endguest

    @auth
        <div class="flex h-screen bg-gray-100 overflow-hidden">
            <!-- Mobile Overlay -->
            <div id="sidebar-overlay" class="sidebar-overlay fixed inset-0 z-20 bg-black bg-opacity-50 hidden lg:hidden"
                onclick="toggleSidebar()"></div>

            <!-- Sidebar -->
            <div id="sidebar"
                class="sidebar fixed lg:static inset-y-0 left-0 z-30 flex flex-col w-64 bg-indigo-800 text-white shadow-xl transform -translate-x-full lg:translate-x-0">
                <div class="flex items-center justify-center py-6 px-6 border-b border-indigo-700 flex-shrink-0">
                    <img src="{{ asset('logo.png') }}" alt="SPK BLT Turungan Baji" class="h-32 object-contain">
                    <button onclick="toggleSidebar()" class="lg:hidden absolute right-4 text-indigo-200 hover:text-white">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                            </path>
                        </svg>
                    </button>
                </div>
                <div class="flex flex-col flex-1 overflow-y-auto">
                    <nav class="flex-1 px-2 py-4 space-y-1">
                        {{-- Dashboard: semua role --}}
                        <a href="{{ route('dashboard') }}" onclick="closeSidebarOnMobile()"
                            class="flex items-center px-4 py-3 text-indigo-100 hover:bg-indigo-700 rounded-lg transition-colors {{ request()->routeIs('dashboard') ? 'bg-indigo-700' : '' }}">
                            <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                            <span>Dashboard</span>
                        </a>

                        {{-- Data Warga: semua role --}}
                        <a href="{{ route('warga.index') }}" onclick="closeSidebarOnMobile()"
                            class="flex items-center px-4 py-3 text-indigo-100 hover:bg-indigo-700 rounded-lg transition-colors {{ request()->routeIs('warga.*') ? 'bg-indigo-700' : '' }}">
                            <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                            <span>Data Warga</span>
                        </a>

                        {{-- Kriteria: semua role --}}
                        <a href="{{ route('kriteria.index') }}" onclick="closeSidebarOnMobile()"
                            class="flex items-center px-4 py-3 text-indigo-100 hover:bg-indigo-700 rounded-lg transition-colors {{ request()->routeIs('kriteria.*') ? 'bg-indigo-700' : '' }}">
                            <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                            <span>Data Kriteria</span>
                        </a>

                        {{-- Sub Kriteria: admin only --}}
                        @if(Auth::user()->isAdmin())
                        <a href="{{ route('sub_kriteria.index') }}" onclick="closeSidebarOnMobile()"
                            class="flex items-center px-4 py-3 text-indigo-100 hover:bg-indigo-700 rounded-lg transition-colors {{ request()->routeIs('sub_kriteria.*') ? 'bg-indigo-700' : '' }}">
                            <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path></svg>
                            <span>Sub Kriteria</span>
                        </a>
                        @endif

                        {{-- Nilai Alternatif: admin + kepala_dusun --}}
                        @if(Auth::user()->isAdmin() || Auth::user()->isKepDusun())
                        <a href="{{ route('penilaian.index') }}" onclick="closeSidebarOnMobile()"
                            class="flex items-center px-4 py-3 text-indigo-100 hover:bg-indigo-700 rounded-lg transition-colors {{ request()->routeIs('penilaian.*') ? 'bg-indigo-700' : '' }}">
                            <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                            <span>Nilai Alternatif</span>
                        </a>
                        @endif

                        {{-- Hasil Ranking: semua role --}}
                        <a href="{{ route('topsis.index') }}" onclick="closeSidebarOnMobile()"
                            class="flex items-center px-4 py-3 text-yellow-300 hover:bg-indigo-700 rounded-lg transition-colors {{ request()->routeIs('topsis.*') ? 'bg-indigo-700' : '' }}">
                            <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                            <span>Hasil Ranking</span>
                        </a>

                        {{-- Manajemen User: admin only --}}
                        @if(Auth::user()->isAdmin())
                        <div class="pt-3 mt-2 border-t border-indigo-700">
                            <p class="px-4 text-xs text-indigo-400 uppercase tracking-widest mb-2">Admin</p>
                            <a href="{{ route('users.index') }}" onclick="closeSidebarOnMobile()"
                                class="flex items-center px-4 py-3 text-indigo-100 hover:bg-indigo-700 rounded-lg transition-colors {{ request()->routeIs('users.*') ? 'bg-indigo-700' : '' }}">
                                <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197"></path></svg>
                                <span>Manajemen User</span>
                            </a>
                        </div>
                        @endif
                    </nav>
                </div>
                <div class="p-4 border-t border-indigo-700 flex-shrink-0">
                    <div class="flex items-center mb-3 px-2">
                        <div
                            class="w-8 h-8 rounded-full bg-indigo-500 flex items-center justify-center text-white font-bold text-sm mr-3">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                        <div>
                            <p class="text-sm font-medium text-white">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-indigo-300">{{ Auth::user()->roleName() }}</p>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="flex items-center w-full px-4 py-2 text-indigo-100 hover:bg-indigo-700 rounded-lg transition-colors text-sm">
                            <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                </path>
                            </svg>
                            Logout
                        </button>
                    </form>
                </div>
            </div>

            <!-- Main Content -->
            <div class="flex flex-col flex-1 overflow-hidden">
                <!-- Topbar -->
                <header
                    class="flex items-center justify-between px-4 lg:px-6 py-4 bg-white border-b-4 border-indigo-600 flex-shrink-0">
                    <div class="flex items-center min-w-0">
                        <button onclick="toggleSidebar()"
                            class="lg:hidden mr-3 text-gray-500 hover:text-gray-700 flex-shrink-0">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16"></path>
                            </svg>
                        </button>
                        <h2 class="text-base lg:text-xl font-semibold text-gray-800 truncate">@yield('title')</h2>
                    </div>
                    <div class="hidden md:flex items-center ml-4 flex-shrink-0">
                        <span class="text-sm font-medium text-gray-500">{{ Auth::user()->name }}</span>
                    </div>
                </header>

                <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-4 lg:p-6">
                    @if (session('success'))
                        <div class="mb-4 bg-green-50 border-l-4 border-green-500 p-4 rounded-md shadow-sm">
                            <p class="text-sm text-green-700 font-medium">{{ session('success') }}</p>
                        </div>
                    @endif
                    @yield('content')
                </main>
            </div>
        </div>
    @endauth

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        }

        function closeSidebarOnMobile() {
            if (window.innerWidth < 1024) {
                const sidebar = document.getElementById('sidebar');
                const overlay = document.getElementById('sidebar-overlay');
                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('hidden');
            }
        }
    </script>
</body>

</html>
