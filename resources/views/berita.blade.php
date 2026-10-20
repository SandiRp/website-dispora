@extends('layouts.main')

@section('title', 'Kumpulan Berita - Dispora Jatim')

@section('content')

    <!-- <div class="bg-white border-b border-gray-200 pt-8 pb-4">
        <div class="max-w-7xl mx-auto px-6">
            <nav class="text-sm text-gray-500 mb-2">
                <a href="{{ url('/') }}" class="hover:text-dispora transition">Beranda</a>
                <span class="mx-2">/</span>
                <span class="text-gray-800 font-medium">Berita Terkini</span>
            </nav>
        </div>
    </div> -->

    <div class="relative bg-dispora-dark py-24 overflow-hidden">
        <!-- Background Image -->
        <div class="absolute inset-0 opacity-30">
            <img src="{{ asset('images/berita.png') }}"
                class="w-full h-full object-cover" alt="Background Berita">
        </div>
        <!-- Gradient Overlay -->
        <div class="absolute inset-0 bg-gradient-to-t from-dispora-dark via-dispora-dark/40 to-transparent"></div>
        
        <div class="max-w-7xl mx-auto px-6 relative z-10 text-center" data-aos="zoom-in">
            <h1 class="text-4xl md:text-5xl font-extrabold text-white mb-6 drop-shadow-lg">Kumpulan Berita & Pengumuman</h1>
            <p class="text-xl text-dispora-light max-w-2xl mx-auto mb-8">Informasi terbaru seputar kegiatan, prestasi,
                dan pengumuman resmi dari Dinas Kepemudaan dan Olahraga Provinsi Jawa Timur.</p>
            <form id="berita-hero-search" action="{{ url('/berita') }}" method="GET" class="max-w-xl mx-auto relative">
                <input type="text" name="search" value="{{ request('search') }}"
                    class="w-full pl-6 pr-16 py-4 rounded-full text-gray-800 shadow-xl focus:outline-none focus:ring-4 focus:ring-dispora/50 border-none text-lg"
                    placeholder="Cari berita atau pengumuman...">
                @if(request('category'))
                <input type="hidden" name="category" value="{{ request('category') }}">
                @endif
                <button type="submit"
                    class="absolute right-2 top-2 bottom-2 bg-dispora hover:bg-dispora-dark text-white p-3 rounded-full transition shadow-md">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </button>
            </form>
        </div>
    </div>

    <!-- 2. KONTEN BERITA -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-6" id="berita-content" style="transition: opacity 0.3s ease;">

            <!-- Filter Categories -->
            <div class="flex flex-wrap gap-3 mb-10" data-aos="fade-up">
                <a href="{{ url('/berita') }}"
                    class="px-5 py-2 rounded-full {{ !request('category') ? 'bg-dispora text-white font-bold shadow-sm' : 'bg-white border border-gray-200 text-gray-600 hover:bg-gray-100 font-bold' }} text-sm shrink-0 transition">Semua
                    Berita</a>
                @foreach($categories as $cat)
                <a href="{{ url('/berita?category='.$cat->slug) }}"
                    class="px-5 py-2 rounded-full {{ request('category') == $cat->slug ? 'bg-dispora text-white font-bold shadow-sm' : 'bg-white border border-gray-200 text-gray-600 hover:bg-gray-100 font-bold' }} text-sm shrink-0 transition">{{ $cat->name }}</a>
                @endforeach
            </div>

            @if($posts->count() > 0)
            @php $highlight = $posts->first(); @endphp
            <div data-aos="fade-up" data-aos-delay="100" class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden mb-12 flex flex-col lg:flex-row group">
                <a href="{{ route('berita.detail', $highlight->slug) }}" class="lg:w-2/3 h-64 md:h-96 relative overflow-hidden block">
                    <img data-media-image src="{{ $highlight->featured_image ? route('public.file', ['folder' => 'posts', 'filename' => basename($highlight->featured_image)]) : asset('images/media-placeholder.svg') }}"
                        class="w-full h-full object-cover group-hover:scale-105 transition duration-700"
                        alt="{{ $highlight->title }}">
                    <div class="absolute top-4 left-4 bg-dispora text-white text-xs font-bold px-3 py-1.5 rounded-full shadow-lg">
                        BERITA UTAMA</div>
                </a>
                <div class="lg:w-1/3 p-8 flex flex-col justify-center">
                    <p class="text-sm text-gray-400 mb-3 font-medium flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                            </path>
                        </svg> {{ $highlight->display_date->translatedFormat('d F Y') }}
                    </p>
                    <h3 class="text-2xl font-extrabold text-gray-800 mb-4 leading-tight group-hover:text-dispora transition">
                        <a href="{{ route('berita.detail', $highlight->slug) }}">{{ $highlight->title }}</a></h3>
                    <p class="text-gray-600 mb-6 line-clamp-4">{{ Str::limit(strip_tags($highlight->content), 200) }}</p>
                    <div>
                        <a href="{{ route('berita.detail', $highlight->slug) }}" class="inline-flex items-center text-dispora font-bold hover:text-dispora-dark transition">
                            Baca Selengkapnya <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

                @foreach($posts->skip(1) as $post)
                <div data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}" class="bg-white rounded-xl overflow-hidden shadow-sm border border-gray-200 hover:shadow-lg transition group flex flex-col">
                    <a href="{{ route('berita.detail', $post->slug) }}" class="h-48 relative overflow-hidden shrink-0 block">
                        <img data-media-image src="{{ $post->featured_image ? route('public.file', ['folder' => 'posts', 'filename' => basename($post->featured_image)]) : asset('images/media-placeholder.svg') }}"
                            class="w-full h-full object-cover group-hover:scale-110 transition duration-500" alt="{{ $post->title }}">
                        <div class="absolute top-4 left-4 bg-dispora text-white text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-wider">
                            {{ $post->category->name ?? 'Berita' }}</div>
                    </a>
                    <div class="p-6 flex-grow flex flex-col">
                        <p class="text-xs text-gray-400 mb-2 font-medium">{{ $post->display_date->translatedFormat('d F Y') }}</p>
                        <h4 class="font-bold text-lg text-gray-800 mb-3 hover:text-dispora transition line-clamp-2"><a
                                href="{{ route('berita.detail', $post->slug) }}">{{ $post->title }}</a></h4>
                        <p class="text-gray-600 text-sm line-clamp-3 mb-4 flex-grow">{{ Str::limit(strip_tags($post->content), 120) }}</p>
                        <a href="{{ route('berita.detail', $post->slug) }}" class="text-dispora font-semibold text-sm hover:underline mt-auto">Baca
                            Selengkapnya</a>
                    </div>
                </div>
                @endforeach

            </div>

            <div class="mt-12 flex justify-center">
                {{ $posts->links() }}
            </div>

        </div>
    </section>

    <!-- AJAX Script for Seamless Filtering & Searching -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const container = document.getElementById('berita-content');
            if (!container) return;

            function fetchBerita(url) {
                container.style.opacity = '0.4';

                fetch(url, {
                    headers: { 'X-Requested-With': 'XMLHttpRequest' }
                })
                .then(response => response.text())
                .then(html => {
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(html, 'text/html');
                    const newContent = doc.getElementById('berita-content');

                    if (newContent) {
                        container.innerHTML = newContent.innerHTML;
                        container.style.opacity = '1';

                        // Re-initialize AOS
                        if (typeof AOS !== 'undefined') {
                            setTimeout(() => AOS.refreshHard(), 50);
                        }

                        // Update URL bar
                        window.history.pushState({}, '', url);

                        // Scroll to content area smoothly
                        container.scrollIntoView({ behavior: 'smooth', block: 'start' });
                    }
                })
                .catch(error => {
                    console.error('Error fetching berita:', error);
                    container.style.opacity = '1';
                });
            }

            // 1. Intercept link clicks (category filters & pagination)
            container.addEventListener('click', function(e) {
                const link = e.target.closest('a');
                if (link && link.href && link.href.includes('/berita') && !link.hasAttribute('target')) {
                    // Don't intercept links to berita detail pages (contains slug)
                    const url = new URL(link.href);
                    if (url.pathname === '/berita' || url.pathname === '/berita/') {
                        e.preventDefault();
                        fetchBerita(link.href);
                    }
                }
            });

            // 2. Intercept search form submit
            container.addEventListener('submit', function(e) {
                const form = e.target.closest('form');
                if (form) {
                    e.preventDefault();
                    const url = new URL(form.action);
                    const formData = new FormData(form);
                    const searchParams = new URLSearchParams(formData);
                    url.search = searchParams.toString();
                    fetchBerita(url.toString());
                }
            });

            // 3. Debounced live search
            let typingTimer;
            container.addEventListener('input', function(e) {
                if (e.target.name === 'search') {
                    clearTimeout(typingTimer);
                    typingTimer = setTimeout(() => {
                        const form = e.target.closest('form');
                        if (form) {
                            form.dispatchEvent(new Event('submit', { cancelable: true, bubbles: true }));
                        }
                    }, 500);
                }
            });

            // 4. Handle browser back/forward
            window.addEventListener('popstate', function() {
                fetchBerita(window.location.href);
            });

            // 5. Intercept hero search form (outside container)
            const heroForm = document.getElementById('berita-hero-search');
            if (heroForm) {
                heroForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    const url = new URL(heroForm.action);
                    const formData = new FormData(heroForm);
                    const searchParams = new URLSearchParams(formData);
                    url.search = searchParams.toString();
                    fetchBerita(url.toString());
                });

                let heroTimer;
                heroForm.addEventListener('input', function(e) {
                    if (e.target.name === 'search') {
                        clearTimeout(heroTimer);
                        heroTimer = setTimeout(() => {
                            heroForm.dispatchEvent(new Event('submit', { cancelable: true, bubbles: true }));
                        }, 500);
                    }
                });
            }
        });
    </script>

@endsection
