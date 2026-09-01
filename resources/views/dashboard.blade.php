<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-800 leading-tight flex items-center gap-2">
            <svg class="w-6 h-6 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
            {{ __('Dashboard Admin') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            {{-- Greeting Banner --}}
            <div class="relative bg-gradient-to-r from-teal-600 to-emerald-500 rounded-2xl p-8 text-white shadow-xl overflow-hidden">
                {{-- Decorative Elements --}}
                <div class="absolute -right-8 -top-8 w-40 h-40 bg-white/10 rounded-full blur-2xl"></div>
                <div class="absolute right-20 bottom-0 w-24 h-24 bg-white/5 rounded-full blur-xl"></div>
                <div class="absolute left-1/2 -bottom-4 w-64 h-16 bg-black/10 rounded-full blur-2xl"></div>
                {{-- Pattern --}}
                <div class="absolute inset-0 opacity-5" style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'0.4\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>

                <div class="flex items-center justify-between relative z-10">
                    <div>
                        <p class="text-teal-100 text-sm font-medium mb-1 flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            {{ now()->translatedFormat('l, d F Y') }}
                        </p>
                        <h1 class="text-2xl lg:text-3xl font-black">Selamat datang, {{ Auth::user()->name }} 👋</h1>
                        <p class="text-teal-100 mt-2 text-sm font-medium">Panel Admin — Dinas Kepemudaan dan Olahraga Provinsi Jawa Timur</p>
                    </div>
                    <div class="hidden sm:flex items-center">
                        <div class="w-20 h-20 rounded-2xl overflow-hidden opacity-80 shadow-lg border-2 border-white/20">
                            <img src="{{ asset('images/logo.jpeg') }}" alt="Logo" class="w-full h-full object-contain">
                        </div>
                    </div>
                </div>
            </div>

            {{-- Stats Cards --}}
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
                {{-- Berita --}}
                <a href="{{ route('admin.posts.index') }}" class="bg-white/70 backdrop-blur-lg rounded-2xl shadow-sm border border-white/60 p-5 flex flex-col items-center text-center hover:shadow-lg hover:-translate-y-1.5 transition-all duration-300 group hover:border-blue-200">
                    <div class="w-12 h-12 bg-gradient-to-br from-blue-400 to-blue-600 rounded-2xl flex items-center justify-center mb-3 shadow-md shadow-blue-200/50 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                    </div>
                    <p class="text-3xl font-black text-gray-800">{{ $stats['posts'] }}</p>
                    <p class="text-xs text-gray-500 mt-1 font-semibold">Berita</p>
                </a>

                {{-- Kegiatan --}}
                <a href="{{ route('admin.agendas.index') }}" class="bg-white/70 backdrop-blur-lg rounded-2xl shadow-sm border border-white/60 p-5 flex flex-col items-center text-center hover:shadow-lg hover:-translate-y-1.5 transition-all duration-300 group hover:border-green-200">
                    <div class="w-12 h-12 bg-gradient-to-br from-green-400 to-green-600 rounded-2xl flex items-center justify-center mb-3 shadow-md shadow-green-200/50 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </div>
                    <p class="text-3xl font-black text-gray-800">{{ $stats['agendas'] }}</p>
                    <p class="text-xs text-gray-500 mt-1 font-semibold">Kegiatan</p>
                </a>

                {{-- Layanan --}}
                <a href="{{ route('admin.services.index') }}" class="bg-white/70 backdrop-blur-lg rounded-2xl shadow-sm border border-white/60 p-5 flex flex-col items-center text-center hover:shadow-lg hover:-translate-y-1.5 transition-all duration-300 group hover:border-purple-200">
                    <div class="w-12 h-12 bg-gradient-to-br from-purple-400 to-purple-600 rounded-2xl flex items-center justify-center mb-3 shadow-md shadow-purple-200/50 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    </div>
                    <p class="text-3xl font-black text-gray-800">{{ $stats['services'] }}</p>
                    <p class="text-xs text-gray-500 mt-1 font-semibold">Layanan</p>
                </a>

                {{-- Aplikasi --}}
                <a href="{{ route('admin.connected_apps.index') }}" class="bg-white/70 backdrop-blur-lg rounded-2xl shadow-sm border border-white/60 p-5 flex flex-col items-center text-center hover:shadow-lg hover:-translate-y-1.5 transition-all duration-300 group hover:border-orange-200">
                    <div class="w-12 h-12 bg-gradient-to-br from-orange-400 to-orange-600 rounded-2xl flex items-center justify-center mb-3 shadow-md shadow-orange-200/50 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3H5a2 2 0 00-2 2v4m6-6h10a2 2 0 012 2v4M9 3v18m0 0h10a2 2 0 002-2V9M9 21H5a2 2 0 01-2-2V9m0 0h18"/></svg>
                    </div>
                    <p class="text-3xl font-black text-gray-800">{{ $stats['apps'] }}</p>
                    <p class="text-xs text-gray-500 mt-1 font-semibold">Aplikasi</p>
                </a>

                {{-- Data SKM --}}
                <a href="{{ route('admin.skm_data.index') }}" class="bg-white/70 backdrop-blur-lg rounded-2xl shadow-sm border border-white/60 p-5 flex flex-col items-center text-center hover:shadow-lg hover:-translate-y-1.5 transition-all duration-300 group hover:border-teal-200">
                    <div class="w-12 h-12 bg-gradient-to-br from-teal-400 to-teal-600 rounded-2xl flex items-center justify-center mb-3 shadow-md shadow-teal-200/50 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                    </div>
                    <p class="text-3xl font-black text-gray-800">{{ $stats['skm'] }}</p>
                    <p class="text-xs text-gray-500 mt-1 font-semibold">Data SKM</p>
                </a>

                {{-- Sosial Media --}}
                <a href="{{ route('admin.social_medias.index') }}" class="bg-white/70 backdrop-blur-lg rounded-2xl shadow-sm border border-white/60 p-5 flex flex-col items-center text-center hover:shadow-lg hover:-translate-y-1.5 transition-all duration-300 group hover:border-pink-200">
                    <div class="w-12 h-12 bg-gradient-to-br from-pink-400 to-pink-600 rounded-2xl flex items-center justify-center mb-3 shadow-md shadow-pink-200/50 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"/></svg>
                    </div>
                    <p class="text-3xl font-black text-gray-800">{{ $stats['socmed'] }}</p>
                    <p class="text-xs text-gray-500 mt-1 font-semibold">Sosial Media</p>
                </a>
            </div>

            {{-- Lower Section --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                {{-- Upcoming Agendas --}}
                <div class="lg:col-span-2 bg-white/70 backdrop-blur-lg rounded-2xl shadow-sm border border-white/60 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-100/80 flex justify-between items-center">
                        <h3 class="font-bold text-gray-800 flex items-center gap-2">
                            <div class="w-8 h-8 bg-gradient-to-br from-green-400 to-emerald-500 rounded-lg flex items-center justify-center shadow-sm">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            </div>
                            Kegiatan Terdekat
                        </h3>
                        <a href="{{ route('admin.agendas.index') }}" class="text-teal-600 text-sm hover:underline font-semibold flex items-center gap-1">
                            Lihat Semua
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </a>
                    </div>
                    <div class="divide-y divide-gray-100/60">
                        @forelse($recentAgendas as $agenda)
                        <div class="flex items-center gap-4 px-6 py-4 hover:bg-teal-50/30 transition-colors duration-200">
                            <div class="bg-gradient-to-br from-teal-500 to-emerald-600 text-white rounded-xl p-2.5 text-center min-w-[56px] shadow-md shadow-teal-200/40">
                                <p class="text-xl font-black leading-none">{{ $agenda->start_date->format('d') }}</p>
                                <p class="text-[10px] uppercase tracking-widest leading-none mt-1 text-teal-100 font-bold">{{ $agenda->start_date->format('M') }}</p>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="font-bold text-gray-800 truncate">{{ $agenda->title }}</p>
                                <p class="text-sm text-gray-500 truncate flex items-center gap-1 mt-0.5">
                                    <svg class="w-3 h-3 inline text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                    {{ $agenda->location }}
                                </p>
                            </div>
                            @php
                                $colors = ['upcoming'=>'bg-green-100 text-green-700 border border-green-200','ongoing'=>'bg-blue-100 text-blue-700 border border-blue-200','completed'=>'bg-gray-100 text-gray-600 border border-gray-200','cancelled'=>'bg-red-100 text-red-600 border border-red-200'];
                                $labels = ['upcoming'=>'Akan Datang','ongoing'=>'Berlangsung','completed'=>'Selesai','cancelled'=>'Batal'];
                            @endphp
                            <span class="{{ $colors[$agenda->status] }} text-xs font-bold px-2.5 py-1 rounded-full">{{ $labels[$agenda->status] }}</span>
                        </div>
                        @empty
                        <div class="px-6 py-12 text-center text-gray-400">
                            <svg class="w-12 h-12 mx-auto mb-3 opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            <p class="font-medium">Belum ada kegiatan terdaftar.</p>
                        </div>
                        @endforelse
                    </div>
                </div>

                {{-- Sidebar --}}
                <div class="flex flex-col gap-5">
                    {{-- SKM Card --}}
                    @if($latestSkm)
                    <div class="relative bg-gradient-to-br from-gray-900 via-gray-800 to-teal-900 rounded-2xl shadow-xl p-6 text-white overflow-hidden">
                        <div class="absolute -right-6 -top-6 w-32 h-32 bg-teal-500/20 rounded-full blur-2xl"></div>
                        <div class="absolute -left-6 -bottom-6 w-24 h-24 bg-amber-500/10 rounded-full blur-2xl"></div>
                        <div class="relative z-10">
                            <p class="text-gray-400 text-xs font-bold uppercase tracking-widest mb-1">Indeks SKM Terbaru</p>
                            <p class="text-gray-500 text-sm mb-5">{{ $latestSkm->period }} {{ $latestSkm->year }}</p>
                            <p class="text-6xl font-black leading-none text-transparent bg-clip-text bg-gradient-to-r from-amber-300 to-amber-500">{{ number_format($latestSkm->index_value, 2) }}</p>
                            <div class="mt-4 inline-flex items-center bg-amber-500/20 px-3 py-1.5 rounded-full text-sm font-bold border border-amber-500/30 text-amber-300">
                                ⭐ Mutu: {{ $latestSkm->category }}
                            </div>
                            <a href="{{ route('admin.skm_data.index') }}" class="block mt-5 text-center bg-white/10 hover:bg-white/20 border border-white/15 rounded-xl py-2.5 text-sm font-semibold transition backdrop-blur-sm">Kelola Data SKM →</a>
                        </div>
                    </div>
                    @else
                    <div class="bg-white/70 backdrop-blur-lg rounded-2xl shadow-sm border border-white/60 p-6 text-center text-gray-400">
                        <svg class="w-12 h-12 mx-auto mb-3 opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                        <p class="text-sm font-medium">Belum ada data SKM.</p>
                        <a href="{{ route('admin.skm_data.create') }}" class="mt-2 inline-block text-teal-600 text-sm font-semibold hover:underline">Tambah Sekarang →</a>
                    </div>
                    @endif

                    {{-- Quick Links --}}
                    <div class="bg-white/70 backdrop-blur-lg rounded-2xl shadow-sm border border-white/60 p-5">
                        <h3 class="font-bold text-gray-700 text-sm mb-4 uppercase tracking-wider flex items-center gap-2">
                            <svg class="w-4 h-4 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                            Pintasan Cepat
                        </h3>
                        <div class="space-y-1.5">
                            <a href="{{ route('admin.posts.create') }}" class="flex items-center gap-3 p-2.5 rounded-xl hover:bg-blue-50/80 text-gray-700 text-sm font-medium transition group">
                                <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center group-hover:bg-blue-200 transition">
                                    <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                                </div>
                                Tambah Berita Baru
                            </a>
                            <a href="{{ route('admin.agendas.create') }}" class="flex items-center gap-3 p-2.5 rounded-xl hover:bg-green-50/80 text-gray-700 text-sm font-medium transition group">
                                <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center group-hover:bg-green-200 transition">
                                    <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                                </div>
                                Tambah Kegiatan
                            </a>
                            <a href="{{ route('admin.services.create') }}" class="flex items-center gap-3 p-2.5 rounded-xl hover:bg-purple-50/80 text-gray-700 text-sm font-medium transition group">
                                <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center group-hover:bg-purple-200 transition">
                                    <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                                </div>
                                Tambah Layanan
                            </a>
                            <a href="{{ route('admin.skm_data.create') }}" class="flex items-center gap-3 p-2.5 rounded-xl hover:bg-teal-50/80 text-gray-700 text-sm font-medium transition group">
                                <div class="w-8 h-8 bg-teal-100 rounded-lg flex items-center justify-center group-hover:bg-teal-200 transition">
                                    <svg class="w-4 h-4 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                                </div>
                                Input Data SKM
                            </a>
                            <a href="{{ route('admin.social_medias.create') }}" class="flex items-center gap-3 p-2.5 rounded-xl hover:bg-pink-50/80 text-gray-700 text-sm font-medium transition group">
                                <div class="w-8 h-8 bg-pink-100 rounded-lg flex items-center justify-center group-hover:bg-pink-200 transition">
                                    <svg class="w-4 h-4 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                                </div>
                                Tambah Sosial Media
                            </a>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>
