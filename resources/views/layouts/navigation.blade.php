<nav x-data="{ open: false, dropPublikasi: false, dropLayanan: false, dropData: false }" class="bg-white/70 backdrop-blur-xl border-b border-gray-200/50 shadow-sm sticky top-0 z-50">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <!-- Logo -->
                <div class="shrink-0 flex items-center gap-3">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-xl overflow-hidden shadow-sm">
                            <img src="{{ asset('images/logo.jpeg') }}" alt="Logo" class="w-full h-full object-contain">
                        </div>
                        <div class="hidden lg:block">
                            <span class="text-sm font-bold text-gray-800 leading-none block">DISPORA</span>
                            <span class="text-[10px] font-medium text-gray-400 leading-none">Admin Panel</span>
                        </div>
                    </a>
                </div>

                <!-- Navigation Links (Desktop) -->
                <div class="hidden sm:flex sm:items-center sm:ms-8 space-x-1">
                    <!-- Dashboard -->
                    <a href="{{ route('dashboard') }}" class="px-3 py-2 rounded-lg text-sm font-semibold transition-all duration-200 {{ request()->routeIs('dashboard') ? 'bg-teal-50 text-teal-700' : 'text-gray-500 hover:text-gray-800 hover:bg-gray-100' }}">
                        <span class="flex items-center gap-1.5">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                            Dashboard
                        </span>
                    </a>

                    <!-- Dropdown: Publikasi -->
                    <div class="relative" x-on:click.away="dropPublikasi = false">
                        <button x-on:click="dropPublikasi = !dropPublikasi" class="px-3 py-2 rounded-lg text-sm font-semibold transition-all duration-200 {{ request()->routeIs('admin.posts.*') || request()->routeIs('admin.documents.*') ? 'bg-teal-50 text-teal-700' : 'text-gray-500 hover:text-gray-800 hover:bg-gray-100' }}">
                            <span class="flex items-center gap-1.5">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                                Publikasi
                                <svg class="w-3 h-3 transition-transform" :class="dropPublikasi ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                            </span>
                        </button>
                        <div x-show="dropPublikasi" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-1" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-1" class="absolute left-0 mt-2 w-48 bg-white/90 backdrop-blur-xl rounded-xl shadow-xl border border-gray-200/60 py-2 z-50" style="display: none;">
                            <a href="{{ route('admin.posts.index') }}" class="flex items-center gap-2.5 px-4 py-2.5 text-sm font-medium {{ request()->routeIs('admin.posts.*') ? 'text-teal-700 bg-teal-50' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }} transition">
                                <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                                Berita
                            </a>
                            <a href="{{ route('admin.documents.index') }}" class="flex items-center gap-2.5 px-4 py-2.5 text-sm font-medium {{ request()->routeIs('admin.documents.*') ? 'text-teal-700 bg-teal-50' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }} transition">
                                <svg class="w-4 h-4 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                Dokumen
                            </a>
                        </div>
                    </div>

                    <!-- Dropdown: Layanan Publik -->
                    <div class="relative" x-on:click.away="dropLayanan = false">
                        <button x-on:click="dropLayanan = !dropLayanan" class="px-3 py-2 rounded-lg text-sm font-semibold transition-all duration-200 {{ request()->routeIs('admin.services.*') || request()->routeIs('admin.agendas.*') || request()->routeIs('admin.connected_apps.*') ? 'bg-teal-50 text-teal-700' : 'text-gray-500 hover:text-gray-800 hover:bg-gray-100' }}">
                            <span class="flex items-center gap-1.5">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                Layanan
                                <svg class="w-3 h-3 transition-transform" :class="dropLayanan ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                            </span>
                        </button>
                        <div x-show="dropLayanan" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-1" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-1" class="absolute left-0 mt-2 w-48 bg-white/90 backdrop-blur-xl rounded-xl shadow-xl border border-gray-200/60 py-2 z-50" style="display: none;">
                            <a href="{{ route('admin.agendas.index') }}" class="flex items-center gap-2.5 px-4 py-2.5 text-sm font-medium {{ request()->routeIs('admin.agendas.*') ? 'text-teal-700 bg-teal-50' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }} transition">
                                <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                Kegiatan
                            </a>
                            <a href="{{ route('admin.services.index') }}" class="flex items-center gap-2.5 px-4 py-2.5 text-sm font-medium {{ request()->routeIs('admin.services.*') ? 'text-teal-700 bg-teal-50' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }} transition">
                                <svg class="w-4 h-4 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                Layanan
                            </a>
                            <a href="{{ route('admin.venues.index') }}" class="flex items-center gap-2.5 px-4 py-2.5 text-sm font-medium {{ request()->routeIs('admin.venues.*') ? 'text-teal-700 bg-teal-50' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }} transition">
                                <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                                Venue
                            </a>
                            <a href="{{ route('admin.connected_apps.index') }}" class="flex items-center gap-2.5 px-4 py-2.5 text-sm font-medium {{ request()->routeIs('admin.connected_apps.*') ? 'text-teal-700 bg-teal-50' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }} transition">
                                <svg class="w-4 h-4 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3H5a2 2 0 00-2 2v4m6-6h10a2 2 0 012 2v4M9 3v18m0 0h10a2 2 0 002-2V9M9 21H5a2 2 0 01-2-2V9m0 0h18"/></svg>
                                Aplikasi
                            </a>
                        </div>
                    </div>

                    <!-- Dropdown: Data & Profil -->
                    <div class="relative" x-on:click.away="dropData = false">
                        <button x-on:click="dropData = !dropData" class="px-3 py-2 rounded-lg text-sm font-semibold transition-all duration-200 {{ request()->routeIs('admin.skm_data.*') || request()->routeIs('admin.social_medias.*') || request()->routeIs('admin.officials.*') ? 'bg-teal-50 text-teal-700' : 'text-gray-500 hover:text-gray-800 hover:bg-gray-100' }}">
                            <span class="flex items-center gap-1.5">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4"/></svg>
                                Data
                                <svg class="w-3 h-3 transition-transform" :class="dropData ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                            </span>
                        </button>
                        <div x-show="dropData" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-1" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-1" class="absolute left-0 mt-2 w-48 bg-white/90 backdrop-blur-xl rounded-xl shadow-xl border border-gray-200/60 py-2 z-50" style="display: none;">
                            <a href="{{ route('admin.skm_data.index') }}" class="flex items-center gap-2.5 px-4 py-2.5 text-sm font-medium {{ request()->routeIs('admin.skm_data.*') ? 'text-teal-700 bg-teal-50' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }} transition">
                                <svg class="w-4 h-4 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                                Data SKM
                            </a>
                            <a href="{{ route('admin.social_medias.index') }}" class="flex items-center gap-2.5 px-4 py-2.5 text-sm font-medium {{ request()->routeIs('admin.social_medias.*') ? 'text-teal-700 bg-teal-50' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }} transition">
                                <svg class="w-4 h-4 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"/></svg>
                                Sosial Media
                            </a>
                            <a href="{{ route('admin.officials.index') }}" class="flex items-center gap-2.5 px-4 py-2.5 text-sm font-medium {{ request()->routeIs('admin.officials.*') ? 'text-teal-700 bg-teal-50' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }} transition">
                                <svg class="w-4 h-4 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                Pejabat
                            </a>
                            <a href="{{ route('admin.official_logos.index') }}" class="flex items-center gap-2.5 px-4 py-2.5 text-sm font-medium {{ request()->routeIs('admin.official_logos.*') ? 'text-teal-700 bg-teal-50' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }} transition">
                                <svg class="w-4 h-4 text-cyan-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                Logo Resmi
                            </a>
                            <a href="{{ route('admin.announcements.index') }}" class="flex items-center gap-2.5 px-4 py-2.5 text-sm font-medium {{ request()->routeIs('admin.announcements.*') ? 'text-teal-700 bg-teal-50' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }} transition">
                                <svg class="w-4 h-4 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/></svg>
                                Pengumuman
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Settings Dropdown (Desktop) -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center gap-2 px-3 py-2 rounded-lg text-sm font-semibold text-gray-500 hover:text-gray-800 hover:bg-gray-100 focus:outline-none transition-all duration-200">
                            <div class="w-8 h-8 rounded-full bg-gradient-to-br from-teal-400 to-emerald-500 flex items-center justify-center text-white text-xs font-bold shadow-sm">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                            <span class="hidden lg:inline">{{ Auth::user()->name }}</span>
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        @role('Super Admin')
                            <x-dropdown-link :href="route('admin.users.index')">
                                {{ __('Kelola Pengguna') }}
                            </x-dropdown-link>
                        @endrole

                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger (Mobile) -->
            <div class="-me-2 flex items-center sm:hidden">
                <button x-on:click="open = !open" class="inline-flex items-center justify-center p-2 rounded-lg text-gray-500 hover:text-gray-700 hover:bg-gray-100 focus:outline-none transition duration-200">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu (Mobile) -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-white/90 backdrop-blur-xl border-t border-gray-200/50">
        <div class="pt-3 pb-2 px-4 space-y-1">
            <p class="px-3 py-1 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Menu</p>
            <a href="{{ route('dashboard') }}" class="flex items-center gap-2 px-3 py-2.5 rounded-lg text-sm font-semibold {{ request()->routeIs('dashboard') ? 'bg-teal-50 text-teal-700' : 'text-gray-600 hover:bg-gray-50' }} transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                Dashboard
            </a>

            <p class="px-3 pt-3 py-1 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Publikasi</p>
            <a href="{{ route('admin.posts.index') }}" class="flex items-center gap-2 px-3 py-2.5 rounded-lg text-sm font-medium {{ request()->routeIs('admin.posts.*') ? 'bg-teal-50 text-teal-700' : 'text-gray-600 hover:bg-gray-50' }} transition">
                <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                Berita
            </a>
            <a href="{{ route('admin.documents.index') }}" class="flex items-center gap-2 px-3 py-2.5 rounded-lg text-sm font-medium {{ request()->routeIs('admin.documents.*') ? 'bg-teal-50 text-teal-700' : 'text-gray-600 hover:bg-gray-50' }} transition">
                <svg class="w-4 h-4 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                Dokumen
            </a>

            <p class="px-3 pt-3 py-1 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Layanan</p>
            <a href="{{ route('admin.agendas.index') }}" class="flex items-center gap-2 px-3 py-2.5 rounded-lg text-sm font-medium {{ request()->routeIs('admin.agendas.*') ? 'bg-teal-50 text-teal-700' : 'text-gray-600 hover:bg-gray-50' }} transition">
                <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                Kegiatan
            </a>
            <a href="{{ route('admin.services.index') }}" class="flex items-center gap-2 px-3 py-2.5 rounded-lg text-sm font-medium {{ request()->routeIs('admin.services.*') ? 'bg-teal-50 text-teal-700' : 'text-gray-600 hover:bg-gray-50' }} transition">
                <svg class="w-4 h-4 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                Layanan
            </a>
            <a href="{{ route('admin.connected_apps.index') }}" class="flex items-center gap-2 px-3 py-2.5 rounded-lg text-sm font-medium {{ request()->routeIs('admin.connected_apps.*') ? 'bg-teal-50 text-teal-700' : 'text-gray-600 hover:bg-gray-50' }} transition">
                <svg class="w-4 h-4 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3H5a2 2 0 00-2 2v4m6-6h10a2 2 0 012 2v4M9 3v18m0 0h10a2 2 0 002-2V9M9 21H5a2 2 0 01-2-2V9m0 0h18"/></svg>
                Aplikasi
            </a>

            <p class="px-3 pt-3 py-1 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Data</p>
            <a href="{{ route('admin.skm_data.index') }}" class="flex items-center gap-2 px-3 py-2.5 rounded-lg text-sm font-medium {{ request()->routeIs('admin.skm_data.*') ? 'bg-teal-50 text-teal-700' : 'text-gray-600 hover:bg-gray-50' }} transition">
                <svg class="w-4 h-4 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                Data SKM
            </a>
            <a href="{{ route('admin.social_medias.index') }}" class="flex items-center gap-2 px-3 py-2.5 rounded-lg text-sm font-medium {{ request()->routeIs('admin.social_medias.*') ? 'bg-teal-50 text-teal-700' : 'text-gray-600 hover:bg-gray-50' }} transition">
                <svg class="w-4 h-4 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"/></svg>
                Sosial Media
            </a>
            <a href="{{ route('admin.officials.index') }}" class="flex items-center gap-2 px-3 py-2.5 rounded-lg text-sm font-medium {{ request()->routeIs('admin.officials.*') ? 'bg-teal-50 text-teal-700' : 'text-gray-600 hover:bg-gray-50' }} transition">
                <svg class="w-4 h-4 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                Pejabat
            </a>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-3 pb-3 px-4 border-t border-gray-200/50">
            <div class="flex items-center gap-3 px-3 py-2">
                <div class="w-9 h-9 rounded-full bg-gradient-to-br from-teal-400 to-emerald-500 flex items-center justify-center text-white text-sm font-bold shadow-sm">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                <div>
                    <div class="font-semibold text-sm text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="text-xs text-gray-500">{{ Auth::user()->email }}</div>
                </div>
            </div>
            <div class="mt-2 space-y-1">
                @role('Super Admin')
                    <a href="{{ route('admin.users.index') }}" class="flex items-center gap-2 px-3 py-2.5 rounded-lg text-sm font-medium {{ request()->routeIs('admin.users.*') ? 'bg-teal-50 text-teal-700' : 'text-gray-600 hover:bg-gray-50' }} transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M9 20H4v-2a3 3 0 015.356-1.857M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        Kelola Pengguna
                    </a>
                @endrole
                <a href="{{ route('profile.edit') }}" class="flex items-center gap-2 px-3 py-2.5 rounded-lg text-sm font-medium text-gray-600 hover:bg-gray-50 transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    Profile
                </a>
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" class="flex items-center gap-2 px-3 py-2.5 rounded-lg text-sm font-medium text-red-600 hover:bg-red-50 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                        Log Out
                    </a>
                </form>
            </div>
        </div>
    </div>
</nav>
