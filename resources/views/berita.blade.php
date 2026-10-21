@extends('layouts.main')

@section('title', 'Kumpulan Berita - Dispora Jatim')

@section('content')
    <div class="relative bg-dispora-dark py-24 overflow-hidden">
        <div class="absolute inset-0 opacity-30">
            <img src="{{ asset('images/berita.png') }}" class="w-full h-full object-cover" alt="Background Berita">
        </div>
        <div class="absolute inset-0 bg-gradient-to-t from-dispora-dark via-dispora-dark/40 to-transparent"></div>

        <div class="max-w-7xl mx-auto px-6 relative z-10 text-center" data-aos="zoom-in">
            <h1 class="text-4xl md:text-5xl font-extrabold text-white mb-6 drop-shadow-lg">Kumpulan Berita & Pengumuman</h1>
            <p class="text-xl text-dispora-light max-w-2xl mx-auto mb-8">Informasi terbaru seputar kegiatan, prestasi, dan pengumuman resmi dari Dinas Kepemudaan dan Olahraga Provinsi Jawa Timur.</p>
            <form id="berita-hero-search" action="{{ route('berita.index') }}" method="GET" class="max-w-xl mx-auto relative">
                <input type="text" name="search" value="{{ request('search') }}"
                    class="w-full pl-6 pr-16 py-4 rounded-full text-gray-800 shadow-xl focus:outline-none focus:ring-4 focus:ring-dispora/50 border-none text-lg"
                    placeholder="Cari berita atau pengumuman...">
                @if(request('category'))
                    <input type="hidden" name="category" value="{{ request('category') }}">
                @endif
                <button type="submit" class="absolute right-2 top-2 bottom-2 bg-dispora hover:bg-dispora-dark text-white p-3 rounded-full transition shadow-md" aria-label="Cari berita">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </button>
            </form>
        </div>
    </div>

    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-6" id="berita-content" data-index-url="{{ route('berita.index') }}" aria-live="polite" style="transition: opacity 0.3s ease;">
            @include('partials.berita-content')
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const container = document.getElementById('berita-content');
            const heroForm = document.getElementById('berita-hero-search');
            if (!container) return;

            const indexUrl = new URL(container.dataset.indexUrl, window.location.href);
            let activeRequest = null;
            let typingTimer = null;

            function isBeritaIndex(url) {
                return url.origin === indexUrl.origin &&
                    url.pathname.replace(/\/$/, '') === indexUrl.pathname.replace(/\/$/, '');
            }

            function syncHeroForm(url) {
                if (!heroForm) return;

                heroForm.querySelector('[name="search"]').value = url.searchParams.get('search') || '';
                let categoryInput = heroForm.querySelector('[name="category"]');
                const category = url.searchParams.get('category');

                if (category && !categoryInput) {
                    categoryInput = document.createElement('input');
                    categoryInput.type = 'hidden';
                    categoryInput.name = 'category';
                    heroForm.appendChild(categoryInput);
                }

                if (categoryInput) {
                    if (category) categoryInput.value = category;
                    else categoryInput.remove();
                }
            }

            async function loadBerita(target, options = {}) {
                const url = new URL(target, window.location.href);
                const pushHistory = options.pushHistory !== false;
                const fallback = options.fallback !== false;

                if (!isBeritaIndex(url)) {
                    if (fallback) window.location.assign(url.toString());
                    return;
                }

                if (activeRequest) activeRequest.abort();
                activeRequest = new AbortController();
                container.style.opacity = '0.4';
                container.setAttribute('aria-busy', 'true');

                try {
                    const response = await fetch(url.toString(), {
                        cache: 'no-store',
                        signal: activeRequest.signal,
                        headers: {
                            'Accept': 'text/html',
                            'X-Requested-With': 'XMLHttpRequest',
                        },
                    });

                    if (!response.ok) throw new Error(`HTTP ${response.status}`);

                    const html = await response.text();
                    const doc = new DOMParser().parseFromString(html, 'text/html');
                    const fragment = doc.querySelector('[data-berita-fragment]');
                    if (!fragment) throw new Error('Fragmen berita tidak ditemukan pada respons.');

                    container.innerHTML = fragment.outerHTML;
                    syncHeroForm(url);

                    if (pushHistory) window.history.pushState({}, '', url.toString());
                    if (typeof AOS !== 'undefined') setTimeout(() => AOS.refreshHard(), 50);

                    container.scrollIntoView({ behavior: 'smooth', block: 'start' });
                } catch (error) {
                    if (error.name === 'AbortError') return;
                    console.error('Gagal memuat berita:', error);
                    if (fallback) window.location.assign(url.toString());
                } finally {
                    container.style.opacity = '1';
                    container.removeAttribute('aria-busy');
                }
            }

            container.addEventListener('click', function (event) {
                const link = event.target.closest('a');
                if (!link || !link.href || link.target || event.ctrlKey || event.metaKey || event.shiftKey || event.altKey) return;

                const url = new URL(link.href, window.location.href);
                if (!isBeritaIndex(url)) return;

                event.preventDefault();
                loadBerita(url);
            });

            if (heroForm) {
                heroForm.addEventListener('submit', function (event) {
                    event.preventDefault();
                    const url = new URL(heroForm.action, window.location.href);
                    url.search = new URLSearchParams(new FormData(heroForm)).toString();
                    loadBerita(url);
                });

                heroForm.addEventListener('input', function (event) {
                    if (event.target.name !== 'search') return;
                    clearTimeout(typingTimer);
                    typingTimer = setTimeout(() => heroForm.requestSubmit(), 500);
                });
            }

            window.addEventListener('popstate', function () {
                loadBerita(window.location.href, { pushHistory: false, fallback: true });
            });
        });
    </script>
@endsection
