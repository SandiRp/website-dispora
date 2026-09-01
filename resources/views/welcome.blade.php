@extends('layouts.main')

@section('title', 'Beranda - Dinas Kepemudaan dan Olahraga Jawa Timur')

@push('styles')
<style>
    .hero-dots {
        background-image: radial-gradient(circle, rgba(255,255,255,0.06) 1px, transparent 1px);
        background-size: 30px 30px;
    }
    .card-hover {
        transition: transform 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94), box-shadow 0.4s ease;
    }
    .card-hover:hover {
        transform: translateY(-6px);
        box-shadow: 0 25px 50px -12px rgba(0,0,0,0.1);
    }
    @keyframes ticker {
        0% { transform: translateX(0); }
        100% { transform: translateX(-50%); }
    }
    .ticker-animate {
        animation: ticker 35s linear infinite;
    }
    .ticker-animate:hover { animation-play-state: paused; }
    @keyframes shimmer {
        0% { background-position: -200% center; }
        100% { background-position: 200% center; }
    }
    .text-shimmer {
        background: linear-gradient(90deg, #0bbead, #52f5db, #0bbead);
        background-size: 200% auto;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        animation: shimmer 4s ease-in-out infinite;
    }
</style>
@endpush

@section('content')

    {{-- ===================================================
         1. HERO - Full Screen
    ==================================================== --}}
    <section x-data="{
        active: 0,
        count: {{ $latestPosts->take(3)->count() ?: 1 }},
        init() { setInterval(() => { this.active = (this.active + 1) % this.count }, 6000) }
    }" class="relative w-full h-screen overflow-hidden bg-dispora-950">

        @forelse($latestPosts->take(3) as $i => $post)
        <div x-show="active === {{ $i }}"
             x-transition:enter="transition-opacity ease-out duration-1000"
             x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
             x-transition:leave="transition-opacity ease-in duration-700"
             x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
             class="absolute inset-0" {!! $i > 0 ? 'style="display:none"' : '' !!}>
            <img src="{{ $post->featured_image ? route('public.file', ['folder'=>'posts','filename'=>basename($post->featured_image)]) : 'https://images.unsplash.com/photo-1542744173-8e7e53415bb0?q=80&w=2000&auto=format&fit=crop' }}"
                 class="w-full h-full object-cover" alt="{{ $post->title }}">
        </div>
        @empty
        <div class="absolute inset-0 bg-gradient-to-br from-dispora-800 to-dispora-950"></div>
        @endforelse

        <!-- Overlays -->
        <div class="absolute inset-0 bg-gradient-to-b from-dispora-950/80 via-dispora-950/40 to-dispora-950/90"></div>
        <div class="absolute inset-0 hero-dots"></div>

        <!-- Content -->
        <div class="relative z-10 h-full flex flex-col justify-center items-center text-center px-6">
            <!-- <div data-aos="fade-down" data-aos-delay="200" class="inline-flex items-center space-x-2 bg-white/10 backdrop-blur-md px-5 py-2 rounded-full border border-white/20 mb-8">
                <span class="w-2 h-2 rounded-full bg-dispora-400 animate-pulse"></span>
                <span class="text-white/80 text-sm font-medium tracking-wide">Website Resmi Dispora Jawa Timur</span>
            </div> -->

            <h1 data-aos="fade-up" data-aos-delay="400" class="text-4xl md:text-6xl lg:text-7xl font-black text-white max-w-5xl leading-tight mb-6">
                Membangun <span class="text-shimmer">Generasi</span><br class="hidden md:block"> Muda yang Unggul
            </h1>

            <p data-aos="fade-up" data-aos-delay="600" class="text-lg md:text-xl text-white/60 max-w-2xl mb-10 leading-relaxed">
                Dinas Kepemudaan dan Olahraga Provinsi Jawa Timur berkomitmen mewujudkan pemuda berdaya saing dan olahraga berprestasi.
            </p>

            <!-- <div data-aos="fade-up" data-aos-delay="800" class="flex flex-col sm:flex-row gap-4">
                <a href="{{ url('/berita') }}" class="bg-dispora-500 hover:bg-dispora-400 text-white px-8 py-3.5 rounded-full font-bold text-sm shadow-lg shadow-dispora-500/30 hover:shadow-dispora-400/40 transition-all duration-300 flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                    Baca Berita Terkini
                </a>
                <a href="{{ url('/agenda') }}" class="bg-white/10 hover:bg-white/20 backdrop-blur-md text-white px-8 py-3.5 rounded-full font-bold text-sm border border-white/20 transition-all duration-300 flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    Lihat Agenda
                </a>
            </div> -->
        </div>

        <!-- Slide dots -->
        @if($latestPosts->take(3)->count() > 1)
        <div class="absolute bottom-10 left-1/2 -translate-x-1/2 z-20 flex items-center gap-3">
            @foreach($latestPosts->take(3) as $i => $p)
            <button @click="active = {{ $i }}"
                    :class="active === {{ $i }} ? 'w-12 bg-dispora-400' : 'w-3 bg-white/30 hover:bg-white/50'"
                    class="h-3 rounded-full transition-all duration-500"></button>
            @endforeach
        </div>
        @endif
    </section>

    {{-- ===================================================
         NEWS TICKER
    ==================================================== --}}
    @if($latestPosts->count() > 0)
    <div class="bg-dispora-950 border-b border-dispora-800/50">
        <div class="max-w-7xl mx-auto flex items-center">
            <div class="bg-dispora-500 text-white px-5 py-3 font-bold text-xs uppercase tracking-widest shrink-0 flex items-center gap-2">
                <span class="w-2 h-2 rounded-full bg-white animate-pulse"></span> Terbaru
            </div>
            <div class="overflow-hidden flex-1 py-3">
                <div class="ticker-animate flex whitespace-nowrap">
                    @foreach($latestPosts as $post)
                    <a href="{{ url('/berita/'.$post->slug) }}" class="text-white/70 hover:text-dispora-300 text-sm mx-8 transition">{{ $post->title }} <span class="text-white/30 mx-4">•</span></a>
                    @endforeach
                    {{-- duplicate for seamless loop --}}
                    @foreach($latestPosts as $post)
                    <a href="{{ url('/berita/'.$post->slug) }}" class="text-white/70 hover:text-dispora-300 text-sm mx-8 transition">{{ $post->title }} <span class="text-white/30 mx-4">•</span></a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @endif

    {{-- ===================================================
         2. BERITA TERKINI
    ==================================================== --}}
    <section class="py-20 bg-white relative overflow-hidden">
        <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-dispora-50 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2 pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-6 relative z-10">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-14" data-aos="fade-up">
                <div>
                    <div class="accent-bar mb-4"></div>
                    <h2 class="section-heading">Berita Terkini</h2>
                    <p class="section-subtitle">Informasi terbaru seputar kepemudaan dan olahraga Jawa Timur</p>
                </div>
                <a href="{{ url('/berita') }}" class="mt-6 md:mt-0 inline-flex items-center gap-2 text-dispora-600 font-semibold text-sm hover:text-dispora-700 group transition">
                    Semua Berita
                    <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
            </div>

            @if($latestPosts->count() > 0)
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                {{-- Featured large card --}}
                <div class="lg:col-span-7" data-aos="fade-right">
                    @php $featured = $latestPosts->first(); @endphp
                    <a href="{{ url('/berita/'.$featured->slug) }}" class="group block relative rounded-3xl overflow-hidden h-[480px] shadow-lg">
                        <img src="{{ $featured->featured_image ? route('public.file', ['folder'=>'posts','filename'=>basename($featured->featured_image)]) : 'https://images.unsplash.com/photo-1461896836934-ffe607ba8211?q=80&w=1000&auto=format&fit=crop' }}"
                             class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" alt="{{ $featured->title }}">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/30 to-transparent"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-8">
                            <span class="inline-block bg-dispora-500 text-white text-xs font-bold px-3 py-1.5 rounded-lg mb-4 uppercase tracking-wide">{{ $featured->category->name ?? 'Berita' }}</span>
                            <h3 class="text-2xl md:text-3xl font-bold text-white mb-3 leading-tight line-clamp-2 group-hover:text-dispora-200 transition">{{ $featured->title }}</h3>
                            <p class="text-white/60 text-sm line-clamp-2 mb-4">{{ Str::limit(strip_tags($featured->content), 150) }}</p>
                            <div class="flex items-center gap-4 text-xs text-white/50">
                                <span class="flex items-center gap-1.5">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    {{ $featured->created_at->translatedFormat('d F Y') }}
                                </span>
                            </div>
                        </div>
                    </a>
                </div>

                {{-- Side list --}}
                <div class="lg:col-span-5 flex flex-col gap-5" data-aos="fade-left">
                    @foreach($latestPosts->skip(1)->take(4) as $post)
                    <a href="{{ url('/berita/'.$post->slug) }}" class="group flex gap-5 bg-white rounded-2xl border border-gray-100 p-4 card-hover">
                        <div class="w-28 h-28 rounded-xl overflow-hidden shrink-0 bg-gray-100">
                            <img src="{{ $post->featured_image ? route('public.file', ['folder'=>'posts','filename'=>basename($post->featured_image)]) : 'https://images.unsplash.com/photo-1461896836934-ffe607ba8211?q=80&w=400&auto=format&fit=crop' }}"
                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" alt="{{ $post->title }}">
                        </div>
                        <div class="flex flex-col justify-center min-w-0 flex-1">
                            <span class="text-dispora-600 text-[10px] font-bold uppercase tracking-wider mb-1.5">{{ $post->category->name ?? 'Berita' }}</span>
                            <h4 class="font-bold text-sm text-gray-900 leading-snug line-clamp-2 group-hover:text-dispora-600 transition mb-2">{{ $post->title }}</h4>
                            <p class="text-xs text-gray-400 flex items-center gap-1.5">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                {{ $post->created_at->translatedFormat('d M Y') }}
                            </p>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>

            {{-- Scrollable extra news --}}
            @if($latestPosts->count() > 5)
            <div class="mt-12" x-data="{ init() { setInterval(() => { let s = this.$refs.ns; if(!s) return; let w = s.querySelector('.ns-item'); if(!w) return; let d = w.offsetWidth+24; if(s.scrollLeft >= s.scrollWidth-s.clientWidth-10){s.scrollTo({left:0,behavior:'smooth'})}else{s.scrollBy({left:d,behavior:'smooth'})} }, 4000) } }">
                <div x-ref="ns" class="flex gap-6 overflow-x-auto snap-x snap-mandatory hide-scrollbar pb-4">
                    @foreach($latestPosts->skip(5) as $post)
                    <a href="{{ url('/berita/'.$post->slug) }}" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}"
                       class="ns-item snap-start shrink-0 w-[300px] bg-white rounded-2xl overflow-hidden border border-gray-100 group card-hover">
                        <div class="h-44 overflow-hidden relative">
                            <img src="{{ $post->featured_image ? route('public.file', ['folder'=>'posts','filename'=>basename($post->featured_image)]) : 'https://images.unsplash.com/photo-1461896836934-ffe607ba8211?q=80&w=600&auto=format&fit=crop' }}"
                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" alt="{{ $post->title }}">
                            <div class="absolute top-3 left-3 bg-dispora-500 text-white text-[10px] font-bold px-2.5 py-1 rounded-lg uppercase">{{ $post->category->name ?? 'Berita' }}</div>
                        </div>
                        <div class="p-5">
                            <p class="text-xs text-gray-400 mb-2">{{ $post->created_at->translatedFormat('d F Y') }}</p>
                            <h4 class="font-bold text-sm text-gray-900 leading-snug line-clamp-2 group-hover:text-dispora-600 transition">{{ $post->title }}</h4>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
            @endif
            @endif
        </div>
    </section>

    {{-- ===================================================
         3. BERITA GUBERNUR
    ==================================================== --}}
    @if($gubernurPosts->count() > 0)
    <section class="py-20 bg-gradient-to-b from-gray-50 to-white relative overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-px bg-gradient-to-r from-transparent via-gray-200 to-transparent"></div>
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-14" data-aos="fade-up">
                <div>
                    <div class="w-16 h-1.5 bg-gradient-to-r from-red-500 to-red-600 rounded-full mb-4"></div>
                    <h2 class="section-heading">Berita Gubernur</h2>
                    <p class="section-subtitle">Kabar terbaru dari Gubernur Jawa Timur</p>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <a href="{{ url('/berita/'.$gubernurPosts[0]->slug) }}" data-aos="fade-right" class="group relative rounded-3xl overflow-hidden min-h-[420px] shadow-xl block">
                    <img src="{{ $gubernurPosts[0]->featured_image ? route('public.file', ['folder'=>'posts','filename'=>basename($gubernurPosts[0]->featured_image)]) : 'https://images.unsplash.com/photo-1551836022-d5d88e9218df?q=80&w=800&auto=format&fit=crop' }}"
                         class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" alt="{{ $gubernurPosts[0]->title }}">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/95 via-black/40 to-transparent"></div>
                    <div class="absolute bottom-0 left-0 right-0 p-8">
                        <span class="inline-block bg-red-600 text-white text-xs font-bold px-3 py-1.5 rounded-lg mb-4 uppercase tracking-wide">Gubernur Jatim</span>
                        <h3 class="text-2xl font-bold text-white mb-3 leading-tight line-clamp-2 group-hover:text-red-200 transition">{{ $gubernurPosts[0]->title }}</h3>
                        <p class="text-white/60 text-sm line-clamp-2 mb-3">{{ Str::limit(strip_tags($gubernurPosts[0]->content), 120) }}</p>
                        <span class="text-xs text-white/40">{{ $gubernurPosts[0]->created_at->translatedFormat('d F Y') }}</span>
                    </div>
                </a>

                <div class="flex flex-col gap-6 justify-center" data-aos="fade-left">
                    @foreach($gubernurPosts->skip(1) as $post)
                    <a href="{{ url('/berita/'.$post->slug) }}" class="group flex gap-5 bg-white rounded-2xl p-4 border border-gray-100 card-hover">
                        <div class="w-32 h-32 rounded-xl overflow-hidden shrink-0 bg-gray-100">
                            <img src="{{ $post->featured_image ? route('public.file', ['folder'=>'posts','filename'=>basename($post->featured_image)]) : 'https://images.unsplash.com/photo-1555848962-6e79363ec58f?q=80&w=400&auto=format&fit=crop' }}"
                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" alt="{{ $post->title }}">
                        </div>
                        <div class="flex flex-col justify-center">
                            <span class="text-red-600 text-[10px] font-bold uppercase tracking-wider mb-2">Gubernur Jatim</span>
                            <h4 class="font-bold text-gray-900 leading-snug mb-2 group-hover:text-red-600 transition line-clamp-2">{{ $post->title }}</h4>
                            <p class="text-xs text-gray-400">{{ $post->created_at->translatedFormat('d F Y') }}</p>
                        </div>
                    </a>
                    @if(!$loop->last)<div class="h-px bg-gray-100"></div>@endif
                    @endforeach

                    @if($gubernurPosts->count() <= 1)
                    <div class="text-center text-gray-400 py-10">
                        <svg class="w-12 h-12 mx-auto mb-3 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                        <p class="text-sm">Berita gubernur lainnya segera hadir</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
    @endif

    {{-- ===================================================
         4. JADWAL KEGIATAN
    ==================================================== --}}
    <section class="py-20 bg-white relative overflow-hidden">
        <div class="absolute bottom-0 left-0 w-[400px] h-[400px] bg-dispora-50 rounded-full blur-3xl translate-y-1/2 -translate-x-1/2 pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-6 relative z-10">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-14" data-aos="fade-up">
                <div>
                    <div class="accent-bar mb-4"></div>
                    <h2 class="section-heading">Jadwal Kegiatan</h2>
                    <p class="section-subtitle">Agenda dan kegiatan mendatang Dispora Jawa Timur</p>
                </div>
                <a href="{{ url('/agenda') }}" class="mt-6 md:mt-0 inline-flex items-center gap-2 text-dispora-600 font-semibold text-sm hover:text-dispora-700 group transition">
                    Semua Kegiatan
                    <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                @forelse($upcomingAgendas as $agenda)
                <div data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}" class="group bg-white rounded-2xl border border-gray-100 overflow-hidden card-hover flex">
                    <div class="bg-gradient-to-b from-dispora-500 to-dispora-700 text-white px-5 py-6 flex flex-col justify-center items-center min-w-[80px] shrink-0">
                        <span class="text-2xl font-black leading-none">{{ $agenda->start_date->format('d') }}</span>
                        <span class="text-[10px] font-semibold uppercase tracking-wider mt-1 text-dispora-200">{{ $agenda->start_date->format('M') }}</span>
                        <div class="w-6 h-px bg-white/30 my-2"></div>
                        <span class="text-[10px] font-medium text-dispora-200">{{ $agenda->start_date->format('Y') }}</span>
                    </div>
                    <div class="p-5 flex-1 flex flex-col justify-center min-w-0">
                        <h4 class="font-bold text-gray-900 leading-snug mb-2 line-clamp-2 group-hover:text-dispora-600 transition">{{ $agenda->title }}</h4>
                        <div class="flex flex-wrap items-center gap-3 text-xs">
                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full font-semibold
                                {{ $agenda->status == 'upcoming' ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' :
                                   ($agenda->status == 'ongoing' ? 'bg-blue-50 text-blue-700 border border-blue-200' :
                                   ($agenda->status == 'completed' ? 'bg-gray-50 text-gray-600 border border-gray-200' :
                                   'bg-red-50 text-red-700 border border-red-200')) }}">
                                <span class="w-1.5 h-1.5 rounded-full {{ $agenda->status == 'upcoming' ? 'bg-emerald-500' : ($agenda->status == 'ongoing' ? 'bg-blue-500 animate-pulse' : ($agenda->status == 'completed' ? 'bg-gray-400' : 'bg-red-500')) }}"></span>
                                {{ $agenda->status == 'upcoming' ? 'Akan Datang' : ($agenda->status == 'ongoing' ? 'Berlangsung' : ($agenda->status == 'completed' ? 'Selesai' : 'Dibatalkan')) }}
                            </span>
                            <span class="text-gray-400 flex items-center gap-1 truncate">
                                <svg class="w-3 h-3 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                {{ Str::limit($agenda->location, 30) }}
                            </span>
                        </div>
                        @if($agenda->attachment_path || $agenda->link_url)
                        <div class="mt-3">
                            <a href="{{ route('agenda.click', ['id' => $agenda->id, 'type' => $agenda->link_url ? 'daftar' : 'materi']) }}" target="_blank"
                               class="inline-flex items-center gap-1.5 text-dispora-600 hover:text-dispora-700 text-xs font-semibold">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                                Dokumentasi & Materi
                            </a>
                        </div>
                        @endif
                    </div>
                </div>
                @empty
                <div class="col-span-full">
                    <div class="text-center py-16 bg-gray-50 rounded-3xl border-2 border-dashed border-gray-200">
                        <svg class="w-16 h-16 mx-auto mb-4 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        <p class="text-gray-400 text-sm">Belum ada agenda kegiatan yang akan datang.</p>
                    </div>
                </div>
                @endforelse
            </div>
        </div>
    </section>

    {{-- ===================================================
         5. MEDIA SOSIAL
    ==================================================== --}}
    @if($socialMedias->count() > 0)
    <section class="py-20 bg-gradient-to-b from-gray-50 to-white relative overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-px bg-gradient-to-r from-transparent via-gray-200 to-transparent"></div>
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-14" data-aos="fade-up">
                <div>
                    <div class="w-16 h-1.5 bg-dispora-500 rounded-full mb-4"></div>
                    <h2 class="section-heading">Ikuti Kami</h2>
                    <p class="section-subtitle">Tetap terhubung melalui media sosial resmi kami</p>
                </div>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-{{ min($socialMedias->count(), 5) }} gap-5 max-w-4xl mx-auto">
                @foreach($socialMedias as $socmed)
                <a href="{{ $socmed->url }}" target="_blank" data-aos="zoom-in" data-aos-delay="{{ $loop->index * 80 }}"
                   class="group bg-white rounded-2xl p-6 border border-gray-100 text-center card-hover">
                    <div class="w-14 h-14 mx-auto rounded-2xl bg-gray-50 group-hover:bg-dispora-500 flex items-center justify-center mb-4 transition-all duration-300 group-hover:shadow-lg group-hover:shadow-dispora-500/20">
                        @php $platform = strtolower($socmed->platform); @endphp
                        <div class="text-gray-400 group-hover:text-white transition-colors duration-300">
                            @if($platform === 'youtube')
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                            @elseif($platform === 'instagram')
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 1 0 0 12.324 6.162 6.162 0 0 0 0-12.324zM12 16a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm6.406-11.845a1.44 1.44 0 1 0 0 2.881 1.44 1.44 0 0 0 0-2.881z"/></svg>
                            @elseif($platform === 'facebook')
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                            @elseif(in_array($platform, ['twitter', 'x']))
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                            @elseif($platform === 'tiktok')
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z"/></svg>
                            @elseif($socmed->icon_class)
                                <i class="{{ $socmed->icon_class }} text-2xl"></i>
                            @else
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.95-.49-7-3.85-7-7.93 0-.62.08-1.21.21-1.79L9 15v1c0 1.1.9 2 2 2v1.93zm6.9-2.54c-.26-.81-1-1.39-1.9-1.39h-1v-3c0-.55-.45-1-1-1H8v-2h2c.55 0 1-.45 1-1V7h2c1.1 0 2-.9 2-2v-.41c2.93 1.19 5 4.06 5 7.41 0 2.08-.8 3.97-2.1 5.39z"/></svg>
                            @endif
                        </div>
                    </div>
                    <h4 class="font-bold text-gray-900 text-sm capitalize">{{ $socmed->platform }}</h4>
                    <p class="text-gray-400 text-xs mt-1">{{ $socmed->account_name }}</p>
                </a>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- ===================================================
         6. LAYANAN & APLIKASI
    ==================================================== --}}
    @if($services->count() > 0 || $connectedApps->count() > 0)
    <section class="py-20 bg-white relative overflow-hidden">
        <div class="absolute top-20 right-0 w-[500px] h-[500px] bg-dispora-50 rounded-full blur-3xl translate-x-1/2 pointer-events-none"></div>
        <div class="max-w-7xl mx-auto px-6 relative z-10">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-14" data-aos="fade-up">
                <div>
                    <div class="w-16 h-1.5 bg-dispora-500 rounded-full mb-4"></div>
                    <h2 class="section-heading">Layanan & Aplikasi</h2>
                    <p class="section-subtitle">Akses layanan publik dan aplikasi terhubung Dispora Jatim</p>
                </div>
            </div>

            @if($services->count() > 0)
            <div class="mb-12">
                <h3 class="text-xs font-bold text-dispora-600 uppercase tracking-widest mb-6 text-center" data-aos="fade-up">Layanan Kami</h3>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-5">
                    @foreach($services as $service)
                    <a href="{{ $service->url_link ?? '#' }}" target="{{ $service->url_link ? '_blank' : '_self' }}" data-aos="zoom-in-up" data-aos-delay="{{ $loop->index * 80 }}"
                       class="group bg-white rounded-2xl p-6 text-center border border-gray-100 card-hover">
                        <div class="h-24 w-full mx-auto mb-4 flex items-center justify-center overflow-visible">
                            @if($service->icon_path)
                                <img src="{{ Storage::url($service->icon_path) }}" alt="{{ $service->name }}" class="w-20 h-20 object-contain transition-transform duration-500 group-hover:scale-110">
                            @else
                                <svg class="w-16 h-16 text-dispora-500 transition-transform duration-500 group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            @endif
                        </div>
                        <h4 class="font-bold text-gray-900 text-sm mb-1">{{ $service->name }}</h4>
                        <p class="text-xs text-gray-400 line-clamp-2">{{ $service->description }}</p>
                    </a>
                    @endforeach
                </div>
            </div>
            @endif

            @if($connectedApps->count() > 0)
            <div>
                <!-- <h3 class="text-xs font-bold text-dispora-600 uppercase tracking-widest mb-6 text-center" data-aos="fade-up">Aplikasi Terhubung</h3> -->
                <div class="grid grid-cols-2 md:grid-cols-4 gap-5">
                    @foreach($connectedApps as $app)
                    <a href="{{ $app->url_link ?? '#' }}" target="{{ $app->url_link ? '_blank' : '_self' }}" data-aos="zoom-in-up" data-aos-delay="{{ $loop->index * 80 }}"
                       class="group bg-white rounded-2xl p-6 text-center border border-gray-100 card-hover">
                        <div class="h-24 w-full mx-auto mb-4 flex items-center justify-center overflow-visible">
                            @if($app->logo_path)
                                <img src="{{ Storage::url($app->logo_path) }}" alt="{{ $app->name }}" class="w-20 h-20 object-contain transition-transform duration-500 group-hover:scale-110">
                            @else
                                <svg class="w-16 h-16 text-gray-400 transition-transform duration-500 group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3H5a2 2 0 00-2 2v4m6-6h10a2 2 0 012 2v4M9 3v18m0 0h10a2 2 0 002-2V9M9 21H5a2 2 0 01-2-2V9m0 0h18"/></svg>
                            @endif
                        </div>
                        <h4 class="font-bold text-gray-900 text-sm mb-1">{{ $app->name }}</h4>
                        <p class="text-xs text-gray-400 line-clamp-2">{{ $app->description }}</p>
                    </a>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </section>
    @endif

    {{-- ===================================================
         7. SURVEI KEPUASAN MASYARAKAT (SKM)
    ==================================================== --}}
    @if($latestSkm)
    <section class="py-20 bg-gradient-to-b from-gray-50 to-white relative overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-px bg-gradient-to-r from-transparent via-gray-200 to-transparent"></div>
        <div class="max-w-7xl mx-auto px-6">
            <div class="relative rounded-[2rem] overflow-hidden" data-aos="fade-up">
                <div class="absolute inset-0 bg-gradient-to-br from-dispora-700 via-dispora-600 to-dispora-800"></div>
                <div class="absolute top-0 right-0 w-80 h-80 bg-dispora-400/20 rounded-full blur-3xl pointer-events-none"></div>
                <div class="absolute bottom-0 left-0 w-96 h-96 bg-dispora-300/10 rounded-full blur-3xl pointer-events-none"></div>
                <div class="absolute inset-0 hero-dots opacity-30"></div>

                <div class="relative z-10 p-10 md:p-16 flex flex-col lg:flex-row items-center justify-between gap-12">
                    <div class="lg:w-3/5 text-white">
                        <div class="inline-flex items-center space-x-2 bg-white/10 backdrop-blur-md px-4 py-1.5 rounded-full text-xs font-bold mb-6 border border-white/20">
                            <span>📊</span>
                            <span class="uppercase tracking-wider">Transparansi Pelayanan Publik</span>
                        </div>
                        <h2 class="text-3xl md:text-5xl font-black mb-5 leading-tight tracking-tight">Survei Kepuasan<br>Masyarakat</h2>
                        <p class="text-dispora-100/70 text-lg mb-8 max-w-xl leading-relaxed">
                            Kritik dan saran Anda adalah energi kami untuk terus berinovasi. Bantu kami meningkatkan kualitas penyelenggaraan pelayanan publik.
                        </p>
                        <div class="flex flex-col sm:flex-row gap-4">
                            <a href="#" class="bg-white text-dispora-700 px-8 py-3.5 rounded-full font-bold text-sm hover:bg-dispora-50 transition-all duration-300 shadow-lg shadow-black/10 flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                Isi Survei Sekarang
                            </a>
                            @if($latestSkm->doc_path)
                            <a href="{{ Storage::url($latestSkm->doc_path) }}" target="_blank" class="border-2 border-white/30 text-white hover:bg-white hover:text-dispora-700 px-8 py-3.5 rounded-full font-bold text-sm transition-all duration-300 flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                Lihat Laporan
                            </a>
                            @endif
                        </div>
                    </div>

                    <div class="lg:w-2/5 flex justify-center w-full">
                        <div class="bg-white rounded-3xl p-8 text-center shadow-2xl w-full max-w-sm relative overflow-hidden">
                            <div class="absolute top-0 left-0 w-full h-1.5 bg-gradient-to-r from-dispora-400 via-dispora-300 to-dispora-500"></div>
                            <p class="text-xs font-bold text-gray-400 mb-1 uppercase tracking-[0.2em] mt-2">Indeks Kepuasan</p>
                            <p class="text-xs text-gray-300 mb-8 font-medium">{{ $latestSkm->period }} — Tahun {{ $latestSkm->year }}</p>
                            @php
                                $indexStr = number_format($latestSkm->index_value, 2);
                                $parts = explode('.', $indexStr);
                            @endphp
                            <div class="mb-8">
                                <span class="text-7xl font-black text-dispora-600">{{ $parts[0] }}</span>
                                <span class="text-4xl font-bold text-dispora-300">.{{ $parts[1] ?? '00' }}</span>
                            </div>
                            <div class="inline-flex items-center justify-center bg-dispora-50 text-dispora-700 font-bold px-6 py-3 rounded-2xl border border-dispora-100 w-full text-sm">
                                <span class="mr-2">⭐</span> MUTU: {{ $latestSkm->category }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

@endsection
