<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Products') — Product Management</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#F8FAFC] text-[#0F172A] font-sans antialiased selection:bg-[#2563EB]/15 selection:text-[#172554]">

    <div class="min-h-screen flex">
        <!-- Mobile Sidebar Backdrop -->
        <div id="sidebar-backdrop"
             onclick="toggleSidebar(false)"
             class="fixed inset-0 z-30 bg-[#0F172A]/40 hidden lg:hidden transition-opacity"
             aria-hidden="true"></div>

        <!-- Sidebar -->
        <aside id="app-sidebar"
               aria-label="Sidebar Navigation"
               class="fixed inset-y-0 left-0 z-40 w-64 bg-[#FFFFFF] border-r border-[#E2E8F0] flex flex-col transform -translate-x-full lg:translate-x-0 lg:static lg:inset-auto lg:z-auto transition-transform duration-200 ease-in-out shrink-0">

            <!-- Brand / Identity -->
            <div class="h-16 px-6 flex items-center justify-between border-b border-[#E2E8F0]">
                <a href="{{ route('products.index') }}" class="flex items-center gap-3 focus:outline-none">
                    <div class="w-8 h-8 rounded-lg bg-[#172554] flex items-center justify-center text-white shrink-0">
                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m21 7.5-9-5.25L3 7.5m18 0-9 5.25m9-5.25v9l-9 5.25M3 7.5l9 5.25M3 7.5v9l9 5.25m0-9v9" />
                        </svg>
                    </div>
                    <div class="leading-tight">
                        <span class="block text-sm font-semibold tracking-tight text-[#172554]">ProductHub</span>
                        <span class="block text-[11px] text-[#64748B]">Inventory System</span>
                    </div>
                </a>

                <!-- Close Sidebar Button (Mobile) -->
                <button type="button"
                        onclick="toggleSidebar(false)"
                        class="lg:hidden p-1.5 rounded-md text-[#64748B] hover:text-[#0F172A] hover:bg-[#F8FAFC] focus:outline-none"
                        aria-label="Close sidebar">
                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Navigation -->
            <div class="flex-1 px-3 py-5 overflow-y-auto">
                <p class="px-3 mb-2 text-[11px] font-semibold uppercase tracking-wider text-[#64748B]">
                    Catalog
                </p>
                <nav class="space-y-1">
                    @php
                        $isProductsActive = request()->routeIs('products.*');
                    @endphp
                    <a href="{{ route('products.index') }}"
                       class="group flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors {{ $isProductsActive ? 'bg-[#172554] text-white shadow-2xs' : 'text-[#64748B] hover:bg-[#F8FAFC] hover:text-[#0F172A]' }}">
                        <svg class="w-4 h-4 shrink-0 {{ $isProductsActive ? 'text-white' : 'text-[#64748B] group-hover:text-[#0F172A]' }}"
                             xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                        </svg>
                        <span>Products</span>
                    </a>
                </nav>
            </div>
        </aside>

        <!-- Main Content Column -->
        <div class="flex-1 flex flex-col min-w-0">
            <!-- Top Header -->
            <header class="h-16 bg-[#FFFFFF] border-b border-[#E2E8F0] px-4 sm:px-6 lg:px-8 flex items-center justify-between sticky top-0 z-20">
                <div class="flex items-center gap-3 min-w-0">
                    <!-- Mobile Menu Toggle -->
                    <button type="button"
                            onclick="toggleSidebar(true)"
                            class="lg:hidden p-2 -ml-1 rounded-lg text-[#64748B] hover:text-[#0F172A] hover:bg-[#F8FAFC] focus:outline-none focus:ring-2 focus:ring-[#2563EB]/20"
                            aria-label="Open sidebar">
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>
                    </button>

                    <!-- Breadcrumb / Header Navigation -->
                    <nav aria-label="Breadcrumb" class="flex items-center gap-2 text-sm truncate">
                        <a href="{{ route('products.index') }}"
                           class="font-medium {{ request()->routeIs('products.index') ? 'text-[#0F172A]' : 'text-[#64748B] hover:text-[#0F172A] transition-colors' }}">
                            Products
                        </a>
                        @hasSection('breadcrumb')
                            <svg class="w-4 h-4 text-[#64748B]/60 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                            </svg>
                            <span class="font-medium text-[#0F172A] truncate">@yield('breadcrumb')</span>
                        @endif
                    </nav>
                </div>

                <div class="flex items-center gap-3">
                    @yield('header_actions')
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 px-4 sm:px-6 lg:px-8 py-6 sm:py-8 max-w-7xl w-full mx-auto">
                <!-- Flash Messages -->
                @if (session('success'))
                    <div id="flash-success"
                         role="alert"
                         class="mb-6 flex items-center justify-between gap-3 rounded-lg bg-[#15803D]/10 border border-[#15803D]/25 px-4 py-3 text-sm text-[#15803D]">
                        <div class="flex items-center gap-2.5">
                            <svg class="w-4 h-4 shrink-0 text-[#15803D]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                            <span class="font-medium">{{ session('success') }}</span>
                        </div>
                        <button type="button"
                                onclick="document.getElementById('flash-success').remove()"
                                class="p-1 rounded-md text-[#15803D]/70 hover:text-[#15803D] hover:bg-[#15803D]/10 transition-colors"
                                aria-label="Dismiss notification">
                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                @endif

                @if (session('error'))
                    <div id="flash-error"
                         role="alert"
                         class="mb-6 flex items-center justify-between gap-3 rounded-lg bg-[#DC2626]/10 border border-[#DC2626]/25 px-4 py-3 text-sm text-[#DC2626]">
                        <div class="flex items-center gap-2.5">
                            <svg class="w-4 h-4 shrink-0 text-[#DC2626]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                            </svg>
                            <span class="font-medium">{{ session('error') }}</span>
                        </div>
                        <button type="button"
                                onclick="document.getElementById('flash-error').remove()"
                                class="p-1 rounded-md text-[#DC2626]/70 hover:text-[#DC2626] hover:bg-[#DC2626]/10 transition-colors"
                                aria-label="Dismiss notification">
                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    <script>
        function toggleSidebar(open) {
            const sidebar = document.getElementById('app-sidebar');
            const backdrop = document.getElementById('sidebar-backdrop');
            if (!sidebar || !backdrop) return;

            if (open) {
                sidebar.classList.remove('-translate-x-full');
                backdrop.classList.remove('hidden');
            } else {
                sidebar.classList.add('-translate-x-full');
                backdrop.classList.add('hidden');
            }
        }
    </script>
</body>
</html>
