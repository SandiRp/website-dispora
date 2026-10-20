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
            <img data-media-image src="{{ $post->featured_image ? route('public.file', ['folder'=>'posts','filename'=>basename($post->featured_image)]) : asset('images/media-placeholder.svg') }}"
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
    </section>
    @endif

    {{-- ===================================================
         3. BERITA TERKINI
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
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-stretch">
                {{-- Featured large card --}}
                <div class="lg:col-span-7 flex flex-col" data-aos="fade-right">
                    @php $featured = $latestPosts->first(); @endphp
                    <a href="{{ url('/berita/'.$featured->slug) }}" class="group block relative rounded-3xl overflow-hidden h-full min-h-[460px] lg:min-h-[520px] shadow-lg flex-1">
                        <img src="{{ $featured->featured_image ? route('public.file', ['folder'=>'posts','filename'=>basename($featured->featured_image)]) : 'https://images.unsplash.com/photo-1461896836934-ffe607ba8211?q=80&w=1000&auto=format&fit=crop' }}"
                             class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" alt="{{ $featured->title }}">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/95 via-black/40 to-black/10"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-6 md:p-8">
                            <span class="inline-block bg-dispora-500 text-white text-xs font-bold px-3 py-1.5 rounded-lg mb-3 uppercase tracking-wide shadow-sm">{{ $featured->category->name ?? 'Berita' }}</span>
                            <h3 class="text-xl md:text-2xl lg:text-3xl font-bold text-white mb-3 leading-tight line-clamp-2 group-hover:text-dispora-200 transition">{{ $featured->title }}</h3>
                            <p class="text-white/70 text-sm line-clamp-2 mb-4 leading-relaxed">{{ Str::limit(strip_tags($featured->content), 150) }}</p>
                            <div class="flex items-center gap-4 text-xs text-white/60">
                                <span class="flex items-center gap-1.5">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    {{ $featured->display_date->translatedFormat('d F Y') }}
                                </span>
                            </div>
                        </div>
                    </a>
                </div>

                {{-- Side list --}}
                <div class="lg:col-span-5 flex flex-col justify-between gap-3.5" data-aos="fade-left">
                    @foreach($latestPosts->skip(1)->take(4) as $post)
                    <a href="{{ url('/berita/'.$post->slug) }}" class="group flex items-center gap-4 bg-white rounded-2xl border border-gray-100 p-3.5 card-hover shadow-sm hover:shadow-md transition">
                        <div class="w-28 h-20 md:w-32 md:h-22 rounded-xl overflow-hidden shrink-0 bg-gray-100 relative">
                            <img src="{{ $post->featured_image ? route('public.file', ['folder'=>'posts','filename'=>basename($post->featured_image)]) : 'https://images.unsplash.com/photo-1461896836934-ffe607ba8211?q=80&w=400&auto=format&fit=crop' }}"
                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" alt="{{ $post->title }}">
                        </div>
                        <div class="flex flex-col justify-center min-w-0 flex-1">
                            <span class="text-dispora-600 text-[10px] font-bold uppercase tracking-wider mb-1">{{ $post->category->name ?? 'Berita' }}</span>
                            <h4 class="font-bold text-sm text-gray-900 leading-snug line-clamp-2 group-hover:text-dispora-600 transition mb-1.5">{{ $post->title }}</h4>
                            <p class="text-xs text-gray-400 flex items-center gap-1.5">
                                <svg class="w-3 h-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                {{ $post->display_date->translatedFormat('d M Y') }}
                            </p>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>

            {{-- Scrollable extra news --}}
            @if($latestPosts->count() > 5)
            <div class="mt-10" x-data="{ init() { setInterval(() => { let s = this.$refs.ns; if(!s) return; let w = s.querySelector('.ns-item'); if(!w) return; let d = w.offsetWidth+24; if(s.scrollLeft >= s.scrollWidth-s.clientWidth-10){s.scrollTo({left:0,behavior:'smooth'})}else{s.scrollBy({left:d,behavior:'smooth'})} }, 4000) } }">
                <div x-ref="ns" class="flex gap-5 overflow-x-auto snap-x snap-mandatory hide-scrollbar pb-4 pt-1">
                    @foreach($latestPosts->skip(5) as $post)
                    <a href="{{ url('/berita/'.$post->slug) }}" data-aos="fade-up" data-aos-delay="{{ $loop->index * 80 }}"
                       class="ns-item snap-start shrink-0 w-[280px] bg-white rounded-2xl overflow-hidden border border-gray-100 group card-hover shadow-sm hover:shadow-md transition">
                        <div class="h-36 overflow-hidden relative">
                            <img src="{{ $post->featured_image ? route('public.file', ['folder'=>'posts','filename'=>basename($post->featured_image)]) : 'https://images.unsplash.com/photo-1461896836934-ffe607ba8211?q=80&w=600&auto=format&fit=crop' }}"
                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" alt="{{ $post->title }}">
                            <div class="absolute top-2.5 left-2.5 bg-dispora-500 text-white text-[10px] font-bold px-2 py-0.5 rounded-md uppercase">{{ $post->category->name ?? 'Berita' }}</div>
                        </div>
                        <div class="p-4">
                            <p class="text-[11px] text-gray-400 mb-1 flex items-center gap-1">
                                <svg class="w-3 h-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                {{ $post->display_date->translatedFormat('d M Y') }}
                            </p>
                            <h4 class="font-bold text-xs md:text-sm text-gray-900 leading-snug line-clamp-2 group-hover:text-dispora-600 transition">{{ $post->title }}</h4>
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
                <a href="{{ url('/berita?category=gubernur') }}" class="mt-6 md:mt-0 inline-flex items-center gap-2 text-red-600 font-semibold text-sm hover:text-red-700 group transition">
                    Semua Berita Gubernur
                    <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-stretch">
                {{-- Featured large card --}}
                <div class="lg:col-span-7 flex flex-col" data-aos="fade-right">
                    @php $featuredGov = $gubernurPosts->first(); @endphp
                    <a href="{{ url('/berita/'.$featuredGov->slug) }}" class="group block relative rounded-3xl overflow-hidden h-full min-h-[460px] lg:min-h-[520px] shadow-lg flex-1">
                        <img src="{{ $featuredGov->featured_image ? route('public.file', ['folder'=>'posts','filename'=>basename($featuredGov->featured_image)]) : 'https://images.unsplash.com/photo-1551836022-d5d88e9218df?q=80&w=800&auto=format&fit=crop' }}"
                             class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" alt="{{ $featuredGov->title }}">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/95 via-black/40 to-black/10"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-6 md:p-8">
                            <span class="inline-block bg-red-600 text-white text-xs font-bold px-3 py-1.5 rounded-lg mb-3 uppercase tracking-wide shadow-sm">Gubernur Jatim</span>
                            <h3 class="text-xl md:text-2xl lg:text-3xl font-bold text-white mb-3 leading-tight line-clamp-2 group-hover:text-red-200 transition">{{ $featuredGov->title }}</h3>
                            <p class="text-white/70 text-sm line-clamp-2 mb-4 leading-relaxed">{{ Str::limit(strip_tags($featuredGov->content), 150) }}</p>
                            <div class="flex items-center gap-4 text-xs text-white/60">
                                <span class="flex items-center gap-1.5">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    {{ $featuredGov->display_date->translatedFormat('d F Y') }}
                                </span>
                            </div>
                        </div>
                    </a>
                </div>

                {{-- Side list --}}
                <div class="lg:col-span-5 flex flex-col justify-between gap-3.5" data-aos="fade-left">
                    @foreach($gubernurPosts->skip(1)->take(4) as $post)
                    <a href="{{ url('/berita/'.$post->slug) }}" class="group flex items-center gap-4 bg-white rounded-2xl border border-gray-100 p-3.5 card-hover shadow-sm hover:shadow-md transition">
                        <div class="w-28 h-20 md:w-32 md:h-22 rounded-xl overflow-hidden shrink-0 bg-gray-100 relative">
                            <img src="{{ $post->featured_image ? route('public.file', ['folder'=>'posts','filename'=>basename($post->featured_image)]) : 'https://images.unsplash.com/photo-1555848962-6e79363ec58f?q=80&w=400&auto=format&fit=crop' }}"
                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" alt="{{ $post->title }}">
                        </div>
                        <div class="flex flex-col justify-center min-w-0 flex-1">
                            <span class="text-red-600 text-[10px] font-bold uppercase tracking-wider mb-1">Gubernur Jatim</span>
                            <h4 class="font-bold text-sm text-gray-900 leading-snug line-clamp-2 group-hover:text-red-600 transition mb-1.5">{{ $post->title }}</h4>
                            <p class="text-xs text-gray-400 flex items-center gap-1.5">
                                <svg class="w-3 h-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                {{ $post->display_date->translatedFormat('d M Y') }}
                            </p>
                        </div>
                    </a>
                    @endforeach

                    @if($gubernurPosts->count() <= 1)
                    <div class="text-center text-gray-400 py-10 bg-white rounded-2xl border border-gray-100">
                        <svg class="w-12 h-12 mx-auto mb-3 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                        <p class="text-sm">Berita gubernur lainnya segera hadir</p>
                    </div>
                    @endif
                </div>
            </div>

            {{-- Scrollable extra news if > 5 --}}
            @if($gubernurPosts->count() > 5)
            <div class="mt-10" x-data="{ init() { setInterval(() => { let s = this.$refs.gns; if(!s) return; let w = s.querySelector('.gns-item'); if(!w) return; let d = w.offsetWidth+24; if(s.scrollLeft >= s.scrollWidth-s.clientWidth-10){s.scrollTo({left:0,behavior:'smooth'})}else{s.scrollBy({left:d,behavior:'smooth'})} }, 4000) } }">
                <div x-ref="gns" class="flex gap-5 overflow-x-auto snap-x snap-mandatory hide-scrollbar pb-4 pt-1">
                    @foreach($gubernurPosts->skip(5) as $post)
                    <a href="{{ url('/berita/'.$post->slug) }}" data-aos="fade-up" data-aos-delay="{{ $loop->index * 80 }}"
                       class="gns-item snap-start shrink-0 w-[280px] bg-white rounded-2xl overflow-hidden border border-gray-100 group card-hover shadow-sm hover:shadow-md transition">
                        <div class="h-36 overflow-hidden relative">
                            <img src="{{ $post->featured_image ? route('public.file', ['folder'=>'posts','filename'=>basename($post->featured_image)]) : 'https://images.unsplash.com/photo-1555848962-6e79363ec58f?q=80&w=600&auto=format&fit=crop' }}"
                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" alt="{{ $post->title }}">
                            <div class="absolute top-2.5 left-2.5 bg-red-600 text-white text-[10px] font-bold px-2 py-0.5 rounded-md uppercase">Gubernur Jatim</div>
                        </div>
                        <div class="p-4">
                            <p class="text-[11px] text-gray-400 mb-1 flex items-center gap-1">
                                <svg class="w-3 h-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                {{ $post->display_date->translatedFormat('d M Y') }}
                            </p>
                            <h4 class="font-bold text-xs md:text-sm text-gray-900 leading-snug line-clamp-2 group-hover:text-red-600 transition">{{ $post->title }}</h4>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </section>
    @endif

    {{-- ===================================================
         VENUES
    ==================================================== --}}
    @if(isset($venues) && $venues->count() > 0)
    <section class="py-20 bg-gray-50 border-y border-gray-100 relative overflow-hidden" x-data="{ showVenueModal: false, activeVenue: null }">
        <div class="max-w-7xl mx-auto px-6 relative z-10">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-14" data-aos="fade-up">
                <div>
                    <div class="w-16 h-1.5 bg-gradient-to-r from-teal-500 to-teal-600 rounded-full mb-4"></div>
                    <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900 tracking-tight mb-2">Venue Olahraga</h2>
                    <p class="text-lg text-gray-500 max-w-2xl">Fasilitas dan sarana prasarana olahraga yang dikelola oleh Dispora Jawa Timur.</p>
                </div>
            </div>

            <div x-data="{ init() { setInterval(() => { let s = this.$refs.vs; if(!s) return; let w = s.querySelector('.vs-item'); if(!w) return; let d = w.offsetWidth+24; if(s.scrollLeft >= s.scrollWidth-s.clientWidth-10){s.scrollTo({left:0,behavior:'smooth'})}else{s.scrollBy({left:d,behavior:'smooth'})} }, 3500) } }">
                <div x-ref="vs" class="flex gap-6 overflow-x-auto snap-x snap-mandatory hide-scrollbar pb-8">
                    @foreach($venues as $venue)
                    <div data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}" class="vs-item snap-start shrink-0 w-[300px] bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl border border-gray-100 transition-all duration-300 group flex flex-col">
                        <div class="h-44 overflow-hidden relative bg-gray-100">
                            @if($venue->image_path)
                            <img src="{{ \App\Support\Media::url($venue->image_path) }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" alt="{{ $venue->name }}">
                            @else
                            <div class="w-full h-full flex items-center justify-center text-gray-400">
                                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                            </div>
                            @endif
                        </div>
                        <div class="p-5 flex flex-col flex-grow">
                            <h3 class="font-bold text-base text-gray-900 mb-2">{{ $venue->name }}</h3>
                            <p class="text-xs text-gray-500 mb-6 flex-grow">{{ Str::limit($venue->short_description, 80) }}</p>
                            <button @click="activeVenue = {{ json_encode(array_merge($venue->toArray(), ['image_url' => \App\Support\Media::url($venue->image_path)])) }}; showVenueModal = true;" class="w-full mt-auto bg-gray-50 hover:bg-teal-50 text-teal-600 font-semibold py-2 rounded-xl transition text-sm flex items-center justify-center gap-2 border border-gray-100 hover:border-teal-100">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                Detail
                            </button>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Venue Modal --}}
        <div x-show="showVenueModal" 
             style="display: none;"
             class="fixed inset-0 z-[100] overflow-y-auto" 
             aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                
                <div x-show="showVenueModal" 
                     x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" 
                     x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" 
                     class="fixed inset-0 bg-gray-900/70 backdrop-blur-sm transition-opacity" 
                     @click="showVenueModal = false" aria-hidden="true"></div>

                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                <div x-show="showVenueModal" 
                     x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" 
                     x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" 
                     class="inline-block align-bottom bg-white rounded-3xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl w-full">
                    
                    <div class="relative h-64 bg-gray-100 w-full overflow-hidden">
                        <template x-if="activeVenue && activeVenue.image_path">
                            <img data-media-image :src="activeVenue.image_url" :alt="activeVenue.name" class="w-full h-full object-cover">
                        </template>
                        <template x-if="activeVenue && !activeVenue.image_path">
                            <div class="w-full h-full flex items-center justify-center text-gray-400 bg-gray-50">
                                <svg class="w-20 h-20 opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                            </div>
                        </template>
                        
                        <button @click="showVenueModal = false" class="absolute top-4 right-4 w-10 h-10 bg-white/30 hover:bg-white/90 backdrop-blur-md rounded-full flex items-center justify-center text-gray-900 transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>
                    </div>

                    <div class="px-6 py-8 sm:p-8">
                        <div class="sm:flex sm:items-start">
                            <div class="mt-3 text-center sm:mt-0 sm:text-left w-full">
                                <h3 class="text-2xl leading-6 font-bold text-gray-900 mb-4" id="modal-title" x-text="activeVenue ? activeVenue.name : ''"></h3>
                                <div class="mt-2">
                                    <p class="text-sm text-gray-600 whitespace-pre-wrap leading-relaxed" x-text="activeVenue ? (activeVenue.description || activeVenue.short_description) : ''"></p>
                                </div>
                                
                                <template x-if="activeVenue && activeVenue.pic_name">
                                    <div class="mt-6 bg-gray-50 rounded-xl p-4 flex items-center justify-between border border-gray-100">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 bg-teal-100 text-teal-600 rounded-full flex items-center justify-center">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                            </div>
                                            <div class="text-left">
                                                <p class="text-xs text-gray-500 font-medium">Penanggung Jawab (PIC)</p>
                                                <p class="text-sm font-bold text-gray-900" x-text="activeVenue.pic_name"></p>
                                            </div>
                                        </div>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-gray-50 px-6 py-4 sm:px-8 sm:flex sm:flex-row-reverse border-t border-gray-100">
                        <template x-if="activeVenue && activeVenue.pic_phone">
                            <a :href="'https://wa.me/' + activeVenue.pic_phone" target="_blank" class="w-full inline-flex justify-center rounded-xl border border-transparent shadow-sm px-6 py-3 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:ml-3 sm:w-auto sm:text-sm items-center gap-2">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.898-4.45 9.896-9.898-.002-5.462-4.452-9.897-9.901-9.897-5.45 0-9.898 4.437-9.896 9.884.001 1.826.465 3.582 1.343 5.143l1.116 1.982-1.002 3.666 3.753-.984 1.299.512zm5.361-12.784c-.26-.58-.535-.591-.779-.601-.202-.008-.433-.01-.665-.01-.231 0-.607.087-.924.433-.318.347-1.214 1.186-1.214 2.892 0 1.706 1.242 3.354 1.416 3.585.173.231 2.438 3.722 5.903 5.132.825.337 1.47.538 1.97.689.827.249 1.581.214 2.179.13.664-.094 2.042-.833 2.331-1.637.289-.805.289-1.495.202-1.637-.087-.144-.318-.231-.665-.404-.347-.173-2.042-1.012-2.36-1.127-.318-.116-.549-.173-.779.174-.231.346-.895 1.127-1.097 1.357-.202.231-.404.259-.751.087-.347-.173-1.458-.538-2.775-1.716-1.026-.917-1.717-2.05-1.919-2.396-.202-.347-.021-.533.152-.707.157-.158.347-.404.521-.606.173-.202.231-.347.347-.578.116-.231.058-.433-.029-.607-.087-.173-.779-1.879-1.071-2.57z"/></svg>
                                Hubungi PIC
                            </a>
                        </template>
                        <button type="button" @click="showVenueModal = false" class="mt-3 w-full inline-flex justify-center rounded-xl border border-gray-300 shadow-sm px-6 py-3 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                            Tutup
                        </button>
                    </div>
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
                        @if($socmed->custom_logo_path)
                            <img src="{{ Storage::url($socmed->custom_logo_path) }}" alt="{{ $socmed->platform }}" class="w-8 h-8 object-contain">
                        @else
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
                        @endif
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
                                <img src="{{ \App\Support\Media::url($service->icon_path) }}" alt="{{ $service->name }}" class="w-20 h-20 object-contain transition-transform duration-500 group-hover:scale-110">
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
                                <img src="{{ \App\Support\Media::url($app->logo_path) }}" alt="{{ $app->name }}" class="w-20 h-20 object-contain transition-transform duration-500 group-hover:scale-110">
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
         6.5 LOGO RESMI
    ==================================================== --}}
    @if(isset($officialLogos) && $officialLogos->count() > 0)
    <section class="py-20 bg-white border-t border-gray-100">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex flex-col md:flex-row justify-between items-end mb-12 gap-6" data-aos="fade-up">
                <div>
                    <h2 class="text-3xl md:text-4xl font-black text-gray-900 leading-tight">Logo Resmi & Maskot</h2>
                    <p class="text-gray-500 mt-3 max-w-2xl">Daftar logo resmi, maskot, dan aset visual lainnya yang dikeluarkan oleh Dinas Kepemudaan dan Olahraga Provinsi Jawa Timur.</p>
                </div>
                <a href="{{ url('/logo-resmi') }}" class="inline-flex items-center gap-2 bg-dispora-50 text-dispora-700 hover:bg-dispora-600 hover:text-white border border-dispora-100 font-semibold px-6 py-3 rounded-full transition-all duration-300 whitespace-nowrap">
                    Lihat Semua Logo
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($officialLogos as $logo)
                    <div class="bg-white rounded-3xl border border-gray-100 shadow-lg shadow-gray-200/50 hover:shadow-xl hover:-translate-y-2 transition-all duration-300 flex flex-col overflow-hidden group" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                        <div class="h-40 w-full bg-gray-50/50 p-6 flex items-center justify-center relative overflow-hidden group-hover:bg-dispora-50/30 transition-colors">
                            @if($logo->image_path)
                                <img src="{{ \App\Support\Media::url($logo->image_path) }}" alt="{{ $logo->title }}" class="max-h-full max-w-full object-contain filter group-hover:scale-110 transition-transform duration-500">
                            @else
                                <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            @endif
                        </div>
                        <div class="p-5 flex-grow flex flex-col border-t border-gray-50">
                            <h3 class="text-lg font-bold text-gray-900 mb-1 truncate">{{ $logo->title }}</h3>
                            @if($logo->description)
                                <p class="text-xs text-gray-500 mb-4 line-clamp-2">{{ $logo->description }}</p>
                            @endif
                            <div class="mt-auto">
                                @if($logo->file_path)
                                    <a href="{{ \App\Support\Media::url($logo->file_path) }}?download=1" download class="w-full flex items-center justify-center gap-1.5 bg-gray-50 hover:bg-dispora-50 text-gray-600 hover:text-dispora-700 text-sm font-semibold py-2 rounded-xl transition-colors border border-gray-100 hover:border-dispora-100">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                                        Unduh
                                    </a>
                                @else
                                    <button disabled class="w-full text-xs bg-gray-50 text-gray-400 py-2 rounded-xl border border-gray-100 cursor-not-allowed">Tidak Tersedia</button>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- ===================================================
         7. SURVEI KEPUASAN MASYARAKAT (SKM)
    ==================================================== --}}
    @if($latestSkm)
    <section class="py-20 bg-dispora-900 relative overflow-hidden" x-data="{ showSkmModal: false }">
        <div class="absolute inset-0">
            <img src="https://images.unsplash.com/photo-1542744173-8e7e53415bb0?q=80&w=2000&auto=format&fit=crop" class="w-full h-full object-cover opacity-10 mix-blend-luminosity">
            <div class="absolute inset-0 bg-gradient-to-br from-dispora-900 via-dispora-900/95 to-dispora-800/90"></div>
        </div>
        
        <div class="max-w-7xl mx-auto px-6 relative z-10">
            <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-3xl p-8 lg:p-12 shadow-2xl overflow-hidden" data-aos="fade-up">
                <div class="flex flex-col lg:flex-row items-center gap-12 relative">
                    <div class="absolute top-0 right-0 w-64 h-64 bg-dispora-500/20 rounded-full blur-3xl translate-x-1/3 -translate-y-1/3"></div>
                    
                    <div class="lg:w-3/5">
                        <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg bg-dispora-500/20 border border-dispora-400/30 text-dispora-200 text-xs font-bold mb-6">
                            <span class="relative flex h-2 w-2">
                              <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-dispora-400 opacity-75"></span>
                              <span class="relative inline-flex rounded-full h-2 w-2 bg-dispora-500"></span>
                            </span>
                            DATA TERBARU
                        </div>
                        <h2 class="text-3xl lg:text-4xl font-bold text-white mb-6 leading-tight">Survei Kepuasan Masyarakat (SKM)</h2>
                        <p class="text-dispora-100 text-lg leading-relaxed mb-8">Sebagai bentuk transparansi dan komitmen kami dalam memberikan pelayanan terbaik kepada masyarakat, berikut adalah hasil Survei Kepuasan Masyarakat terbaru.</p>
                        <div class="flex flex-col sm:flex-row gap-4">
                            <a href="https://linktr.ee/SKM_DisporaJatim" target="_blank" class="inline-flex justify-center items-center gap-2 bg-white text-dispora-900 font-semibold px-8 py-3.5 rounded-xl hover:bg-dispora-50 transition shadow-lg shadow-white/10">
                                Ikuti Survei
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                            </a>
                            @if($latestSkm->document_path)
                            <a href="{{ \App\Support\Media::url($latestSkm->document_path) }}" target="_blank" class="inline-flex justify-center items-center border-2 border-white/30 text-white hover:bg-white hover:text-dispora-700 px-8 py-3.5 rounded-xl font-semibold transition-all duration-300 gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                Lihat Laporan
                            </a>
                            @else
                            <p class="self-center text-sm text-dispora-100">Dokumen laporan tidak tersedia.</p>
                            @endif
                        </div>
                    </div>

                    <div class="lg:w-2/5 flex justify-center w-full mt-8 lg:mt-0">
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
                            <div class="inline-flex items-center justify-center bg-dispora-50 text-dispora-700 font-bold px-6 py-3 rounded-2xl border border-dispora-100 w-full text-sm mb-3">
                                <span class="mr-2">⭐</span> MUTU: {{ $latestSkm->category }}
                            </div>
                            <button @click="showSkmModal = true" class="w-full text-sm font-semibold text-dispora-600 hover:text-dispora-800 transition py-2 underline decoration-dispora-300 decoration-2 underline-offset-4">
                                Detail SKM Lengkap
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Modal SKM --}}
        <div x-show="showSkmModal" 
             style="display: none;"
             class="fixed inset-0 z-[100] overflow-y-auto" 
             aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div x-show="showSkmModal" 
                     x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" 
                     x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" 
                     class="fixed inset-0 bg-gray-900/70 backdrop-blur-sm transition-opacity" 
                     @click="showSkmModal = false" aria-hidden="true"></div>

                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                <div x-show="showSkmModal" 
                     x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" 
                     x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" 
                     class="inline-block align-bottom bg-white rounded-3xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl w-full">
                    
                    <div class="bg-gradient-to-r from-dispora-600 to-dispora-700 px-6 py-6 sm:px-8 flex justify-between items-center">
                        <h3 class="text-xl font-bold text-white">Riwayat Indeks Kepuasan Masyarakat</h3>
                        <button @click="showSkmModal = false" class="text-white/70 hover:text-white transition">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>
                    </div>

                    <div class="px-6 py-6 sm:p-8 bg-gray-50 max-h-[60vh] overflow-y-auto">
                        <div class="space-y-4">
                            @if(isset($allSkm) && $allSkm->count() > 0)
                                @foreach($allSkm as $skm)
                                <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm flex items-center justify-between">
                                    <div>
                                        <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">{{ $skm->period }} — {{ $skm->year }}</p>
                                        <p class="text-sm font-semibold text-gray-900">Mutu: {{ $skm->category }}</p>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-2xl font-black text-dispora-600">{{ number_format($skm->index_value, 2) }}</p>
                                    </div>
                                </div>
                                @endforeach
                            @else
                                <div class="text-center py-8 text-gray-500">
                                    Belum ada data SKM yang dipublikasikan.
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    {{-- ===================================================
         ANNOUNCEMENT POP-UP MODAL
    ==================================================== --}}
    @if(isset($announcements) && $announcements->count() > 0)
    <div x-data="{
            showAnnouncement: false,
            currentSlide: 0,
            totalSlides: {{ $announcements->count() }},
            init() {
                // Only show once per session
                if (!sessionStorage.getItem('announcement_dismissed_{{ $announcements->pluck('id')->join('_') }}')) {
                    setTimeout(() => { this.showAnnouncement = true; }, 800);
                }
            },
            close() {
                this.showAnnouncement = false;
                sessionStorage.setItem('announcement_dismissed_{{ $announcements->pluck('id')->join('_') }}', '1');
            },
            next() { this.currentSlide = (this.currentSlide + 1) % this.totalSlides; },
            prev() { this.currentSlide = (this.currentSlide - 1 + this.totalSlides) % this.totalSlides; }
        }">
        {{-- Backdrop --}}
        <div x-show="showAnnouncement"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 z-[9999] bg-black/60 backdrop-blur-sm flex items-center justify-center p-4"
             x-on:click.self="close()"
             style="display: none;">

            {{-- Modal Card --}}
            <div x-show="showAnnouncement"
                 x-transition:enter="transition ease-out duration-400 delay-100"
                 x-transition:enter-start="opacity-0 scale-90 translate-y-8"
                 x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 scale-100"
                 x-transition:leave-end="opacity-0 scale-95"
                 class="bg-white rounded-3xl shadow-2xl max-w-lg w-full overflow-hidden relative">

                {{-- Close Button --}}
                <button x-on:click="close()" class="absolute top-4 right-4 z-10 w-8 h-8 bg-black/20 hover:bg-black/40 backdrop-blur-md rounded-full flex items-center justify-center text-white transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>

                {{-- Slides --}}
                @foreach($announcements as $i => $announcement)
                <div x-show="currentSlide === {{ $i }}" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
                    {{-- Image --}}
                    @if($announcement->image_path)
                    <div class="w-full h-56 sm:h-64 overflow-hidden">
                        <img src="{{ \App\Support\Media::url($announcement->image_path) }}" alt="{{ $announcement->title }}" class="w-full h-full object-cover">
                    </div>
                    @else
                    <div class="w-full h-32 bg-gradient-to-br from-dispora-500 to-dispora-700 flex items-center justify-center">
                        <svg class="w-16 h-16 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/></svg>
                    </div>
                    @endif

                    {{-- Content --}}
                    <div class="p-6 sm:p-8">
                        <h3 class="text-xl sm:text-2xl font-black text-gray-900 mb-3 leading-tight">{{ $announcement->title }}</h3>
                        @if($announcement->content)
                        <p class="text-gray-600 text-sm sm:text-base leading-relaxed mb-6">{{ $announcement->content }}</p>
                        @endif

                        <div class="flex items-center gap-3">
                            @if($announcement->button_url)
                            <a href="{{ $announcement->button_url }}" target="_blank" class="inline-flex items-center gap-2 bg-dispora-600 hover:bg-dispora-700 text-white font-semibold px-6 py-3 rounded-xl transition-colors shadow-lg shadow-dispora-500/20">
                                {{ $announcement->button_text ?: 'Selengkapnya' }}
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                            </a>
                            @endif
                            <!-- <button x-on:click="close()" class="text-gray-500 hover:text-gray-700 font-medium text-sm px-4 py-3 rounded-xl hover:bg-gray-100 transition-colors">
                                Tutup
                            </button> -->
                        </div>
                    </div>
                </div>
                @endforeach

                {{-- Navigation dots (if multiple) --}}
                @if($announcements->count() > 1)
                <div class="flex items-center justify-center gap-2 pb-6">
                    <button x-on:click="prev()" class="w-8 h-8 rounded-full bg-gray-100 hover:bg-gray-200 flex items-center justify-center text-gray-500 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                    </button>
                    @foreach($announcements as $i => $a)
                    <button x-on:click="currentSlide = {{ $i }}" :class="currentSlide === {{ $i }} ? 'bg-dispora-500 w-6' : 'bg-gray-300 w-2'" class="h-2 rounded-full transition-all duration-300"></button>
                    @endforeach
                    <button x-on:click="next()" class="w-8 h-8 rounded-full bg-gray-100 hover:bg-gray-200 flex items-center justify-center text-gray-500 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </button>
                </div>
                @endif
            </div>
        </div>
    </div>
    @endif

@endsection
