<!DOCTYPE html>
<html lang="id" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Dispora Jatim - Dinas Kepemudaan dan Olahraga')</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.jpeg') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/accessibility.css') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <meta name="description" content="@yield('meta_description', 'Website Resmi Dinas Kepemudaan dan Olahraga Provinsi Jawa Timur')">
    <meta name="theme-color" content="#0bbead">
    <style>
        .hide-scrollbar::-webkit-scrollbar { display: none; }
        .hide-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
    @stack('styles')
</head>

<body class="antialiased bg-white text-gray-800 font-sans flex flex-col min-h-screen">

    {{-- Accessibility Widget (floating button + panel) --}}
    @include('components.accessibility-widget')

    <!-- NAVBAR - transparent on hero, solid on scroll -->
    <nav x-data="{ mobileMenuOpen: false, scrolled: false }"
         x-init="window.addEventListener('scroll', () => { scrolled = window.scrollY > 20 })"
         :class="scrolled ? 'bg-white/95 backdrop-blur-xl shadow-lg border-b border-gray-100' : 'bg-transparent'"
         class="fixed top-0 left-0 right-0 z-50 transition-all duration-500"
         role="navigation"
         aria-label="Navigasi utama">
        <div class="max-w-7xl mx-auto px-6 py-3 flex justify-between items-center">

            <!-- Logo -->
            <a href="{{ url('/') }}" class="flex items-center space-x-3 group">
                <div class="w-11 h-11 flex items-center justify-center rounded-xl overflow-hidden bg-white shadow-md group-hover:shadow-lg transition-shadow">
                    <img src="{{ asset('images/logo.jpeg') }}" alt="Logo Dispora Jatim" class="w-full h-full object-contain">
                </div>
                <div :class="scrolled ? 'text-gray-900' : 'text-white'" class="transition-colors duration-300">
                    <div class="text-base font-bold leading-tight">Dinas Kepemudaan dan Olahraga</div>
                    <div :class="scrolled ? 'text-dispora-600' : 'text-dispora-200'" class="text-xs font-semibold tracking-widest uppercase transition-colors duration-300">Jawa Timur</div>
                </div>
            </a>

            <!-- Desktop Menu -->
            <div class="hidden md:flex items-center space-x-1">
                @php
                    $navLinks = [
                        ['url' => '/', 'label' => 'Beranda', 'match' => '/'],
                        ['url' => '/Halprofil', 'label' => 'Profil', 'match' => 'Halprofil*'],
                        ['url' => '/program', 'label' => 'Program', 'match' => 'program*'],
                        ['url' => '/laporan', 'label' => 'Laporan', 'match' => 'laporan*'],
                        ['url' => '/regulasi', 'label' => 'Regulasi', 'match' => 'regulasi*'],
                        ['url' => '/berita', 'label' => 'Berita', 'match' => 'berita*'],
                    ];
                @endphp
                @foreach($navLinks as $nav)
                <a href="{{ url($nav['url']) }}"
                   :class="scrolled ? '{{ request()->is($nav['match']) ? 'text-dispora-600' : 'text-gray-700 hover:text-dispora-600' }}' : '{{ request()->is($nav['match']) ? 'text-white' : 'text-white/90 hover:text-white' }}'"
                   class="relative px-4 py-2 text-sm font-semibold transition-colors duration-300 group">
                    {{ $nav['label'] }}
                    <span class="absolute bottom-0 left-1/2 -translate-x-1/2 h-0.5 rounded-full transition-all duration-300 {{ request()->is($nav['match']) ? 'nav-underline-active' : 'w-0 group-hover:w-3/4' }}"
                          :class="scrolled ? 'bg-dispora-600' : 'bg-white'"></span>
                </a>
                @endforeach
                <a href="https://ppid.dispora.jatimprov.go.id/" target="_blank"
                   :class="scrolled ? 'text-gray-700 hover:text-dispora-600' : 'text-white/90 hover:text-white'"
                   class="relative px-4 py-2 text-sm font-semibold transition-colors duration-300 group">
                    PPID
                    <span class="absolute bottom-0 left-1/2 -translate-x-1/2 h-0.5 rounded-full transition-all duration-300 w-0 group-hover:w-3/4"
                          :class="scrolled ? 'bg-dispora-600' : 'bg-white'"></span>
                </a>

                {{-- Google Translate Dropdown in Navbar --}}
                <div id="a11y-translate-nav" class="a11y-translate-nav ml-2" :class="scrolled ? 'scrolled' : ''">
                    <span class="a11y-translate-icon" aria-hidden="true">
                        <svg :class="scrolled ? 'text-gray-600' : 'text-white/80'" class="w-4 h-4 transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129"/>
                        </svg>
                    </span>
                    <div id="google_translate_element"></div>
                </div>
            </div>

            <!-- Hamburger -->
            <div class="md:hidden">
                <button @click="mobileMenuOpen = !mobileMenuOpen"
                        :class="scrolled ? 'text-gray-800' : 'text-white'"
                        class="p-2 rounded-lg hover:bg-white/10 transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': mobileMenuOpen, 'inline-flex': !mobileMenuOpen }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': !mobileMenuOpen, 'inline-flex': mobileMenuOpen }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div x-show="mobileMenuOpen"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 -translate-y-4"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-4"
             style="display: none;"
             class="md:hidden bg-white/95 backdrop-blur-xl border-t border-gray-100 shadow-2xl">
            <div class="px-6 py-4 space-y-1">
                <a href="{{ url('/') }}" class="block px-4 py-3 rounded-xl text-sm font-semibold {{ request()->is('/') ? 'text-dispora-600 bg-dispora-50' : 'text-gray-700 hover:bg-gray-50' }}">Beranda</a>
                <a href="{{ url('/Halprofil') }}" class="block px-4 py-3 rounded-xl text-sm font-semibold {{ request()->is('Halprofil*') ? 'text-dispora-600 bg-dispora-50' : 'text-gray-700 hover:bg-gray-50' }}">Profil</a>
                <a href="{{ url('/program') }}" class="block px-4 py-3 rounded-xl text-sm font-semibold {{ request()->is('program*') ? 'text-dispora-600 bg-dispora-50' : 'text-gray-700 hover:bg-gray-50' }}">Program</a>
                <a href="{{ url('/regulasi') }}" class="block px-4 py-3 rounded-xl text-sm font-semibold {{ request()->is('regulasi*') ? 'text-dispora-600 bg-dispora-50' : 'text-gray-700 hover:bg-gray-50' }}">Regulasi</a>
                <a href="{{ url('/laporan') }}" class="block px-4 py-3 rounded-xl text-sm font-semibold {{ request()->is('laporan*') ? 'text-dispora-600 bg-dispora-50' : 'text-gray-700 hover:bg-gray-50' }}">Laporan</a>
                <a href="https://ppid.dispora.jatimprov.go.id/" target="_blank" class="block px-4 py-3 rounded-xl text-sm font-semibold text-gray-700 hover:bg-gray-50">PPID</a>
                <a href="{{ url('/berita') }}" class="block px-4 py-3 rounded-xl text-sm font-semibold {{ request()->is('berita*') ? 'text-dispora-600 bg-dispora-50' : 'text-gray-700 hover:bg-gray-50' }}">Berita</a>
                <a href="{{ url('/agenda') }}" class="block px-4 py-3 rounded-xl text-sm font-semibold bg-dispora-600 text-white text-center mt-2">📅 Agenda Kegiatan</a>
            </div>
        </div>
    </nav>

    <!-- KONTEN DINAMIS -->
    <main id="main-content" class="flex-grow" role="main">
        @yield('content')
    </main>

    <!-- FOOTER -->
    <footer class="bg-dispora-950 text-white pt-20 mt-auto relative overflow-hidden" role="contentinfo">
        <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-dispora-400 via-dispora-300 to-dispora-500"></div>
        <div class="absolute top-20 right-0 w-96 h-96 bg-dispora-800/20 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute bottom-0 left-0 w-80 h-80 bg-dispora-900/30 rounded-full blur-3xl pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-6 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-6 mb-12">
                <!-- About -->
                <div class="lg:col-span-5 pr-0 lg:pr-4" data-aos="fade-up">
                    <div class="flex items-center space-x-3 mb-6">
                        <div class="w-11 h-11 flex items-center justify-center rounded-lg overflow-hidden bg-white shadow-md group-hover:shadow-lg transition-shadow">
                            <img src="{{ asset('images/logo.jpeg') }}" alt="Logo Dispora Jatim" class="w-full h-full object-contain">
                        </div>
                        <div>
                            <h2 class="text-lg font-bold leading-tight">Dinas Kepemudaan dan Olahraga</h2>
                            <span class="text-xs font-semibold text-dispora-300 tracking-widest uppercase">Jawa Timur</span>
                        </div>
                    </div>
                    <p class="text-dispora-100/60 leading-relaxed text-sm mb-6">
                        Website resmi Dinas Kepemudaan dan Olahraga Provinsi Jawa Timur. Kami berkomitmen untuk terus
                        berinovasi dalam memberikan pelayanan publik yang transparan dan akuntabel.
                    </p>
                </div>

                <!-- Contact -->
                <div class="lg:col-span-4" data-aos="fade-up" data-aos-delay="100">
                    <h4 class="text-sm font-bold mb-5 uppercase tracking-widest text-dispora-300">Kontak Kami</h4>
                    <ul class="space-y-4">
                        <li class="flex items-start group">
                            <div class="w-9 h-9 rounded-lg bg-white/5 border border-white/10 flex items-center justify-center mr-3 shrink-0 group-hover:bg-dispora-600 group-hover:border-dispora-500 transition-all">
                                <svg class="w-4 h-4 text-dispora-400 group-hover:text-white transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            </div>
                            <span class="text-sm text-white/60 leading-relaxed">Jl. Kayoon No.56, Embong Kaliasin, Kec. Genteng, Surabaya, Jawa Timur 60271</span>
                        </li>
                        <li class="flex items-center group">
                            <div class="w-9 h-9 rounded-lg bg-white/5 border border-white/10 flex items-center justify-center mr-3 shrink-0 group-hover:bg-dispora-600 group-hover:border-dispora-500 transition-all">
                                <svg class="w-4 h-4 text-dispora-400 group-hover:text-white transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            </div>
                            <span class="text-sm text-white/60">(031) 5345507</span>
                        </li>
                        <li class="flex items-center group">
                            <div class="w-9 h-9 rounded-lg bg-white/5 border border-white/10 flex items-center justify-center mr-3 shrink-0 group-hover:bg-dispora-600 group-hover:border-dispora-500 transition-all">
                                <svg class="w-4 h-4 text-dispora-400 group-hover:text-white transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            </div>
                            <span class="text-sm text-white/60">dispora@jatimprov.go.id</span>
                        </li>
                    </ul>
                </div>

                <!-- Quick Links -->
                <div class="lg:col-span-3" data-aos="fade-up" data-aos-delay="200">
                    <h4 class="text-sm font-bold mb-5 uppercase tracking-widest text-dispora-300">Tautan Cepat</h4>
                    <ul class="space-y-3">
                        <li><a href="{{ url('/Halprofil') }}" class="text-sm text-white/60 hover:text-white transition flex items-center group"><span class="w-1.5 h-1.5 rounded-full bg-dispora-500 mr-3 group-hover:scale-150 transition-transform"></span>Profil Instansi</a></li>
                        <li><a href="{{ url('/Halprofil') }}" class="text-sm text-white/60 hover:text-white transition flex items-center group"><span class="w-1.5 h-1.5 rounded-full bg-dispora-500 mr-3 group-hover:scale-150 transition-transform"></span>Visi & Misi</a></li>
                        <li><a href="{{ url('/Halprofil') }}" class="text-sm text-white/60 hover:text-white transition flex items-center group"><span class="w-1.5 h-1.5 rounded-full bg-dispora-500 mr-3 group-hover:scale-150 transition-transform"></span>Struktur Organisasi</a></li>
                        <li><a href="{{ url('/program') }}" class="text-sm text-white/60 hover:text-white transition flex items-center group"><span class="w-1.5 h-1.5 rounded-full bg-dispora-500 mr-3 group-hover:scale-150 transition-transform"></span>Dokumen Perencanaan</a></li>
                        <li><a href="{{ url('/berita') }}" class="text-sm text-white/60 hover:text-white transition flex items-center group"><span class="w-1.5 h-1.5 rounded-full bg-dispora-500 mr-3 group-hover:scale-150 transition-transform"></span>Berita</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Bottom bar -->
        <div class="border-t border-white/10 bg-black/20">
            <div class="max-w-7xl mx-auto px-6 py-5 flex flex-col md:flex-row justify-between items-center gap-4">
                <div class="flex flex-wrap items-center justify-center gap-3">
                    <span class="text-[10px] font-bold text-dispora-400 uppercase tracking-widest">Statistik</span>
                    <div class="flex items-center bg-white/5 px-3 py-1.5 rounded-lg border border-white/10 gap-2">
                        <svg class="w-3.5 h-3.5 text-dispora-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                        <span class="text-xs text-white/50">Hari ini: <strong class="text-white">{{ number_format($today_visitors ?? 0) }}</strong></span>
                    </div>
                    <div class="flex items-center bg-white/5 px-3 py-1.5 rounded-lg border border-white/10 gap-2">
                        <svg class="w-3.5 h-3.5 text-dispora-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                        <span class="text-xs text-white/50">Total: <strong class="text-white">{{ number_format($total_visitors ?? 0) }}</strong></span>
                    </div>
                </div>
                <p class="text-xs text-white/40 text-center md:text-right">
                    &copy; 2026 Dinas Kepemudaan dan Olahraga Jawa Timur. All rights reserved.
                </p>
            </div>
        </div>
    </footer>

    @stack('scripts')
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({ duration: 800, once: false, offset: 80 });
    </script>

    {{-- Accessibility Engine --}}
    <script src="{{ asset('js/accessibility.js') }}"></script>

    {{-- Google Translate --}}
    <script>
        function googleTranslateElementInit() {
            // Only ONE instance — in the navbar (default layout renders a <select>)
            if (document.getElementById('google_translate_element')) {
                new google.translate.TranslateElement({
                    pageLanguage: 'id',
                    includedLanguages: 'id,en,ar,zh-CN,ja,ko,ms,th,vi,fr,de,es,pt,ru,hi,nl,it',
                    autoDisplay: false
                }, 'google_translate_element');
            }
        }

        /**
         * Helper: change Google Translate language from the custom panel dropdown.
         * Tries the native <select> first, falls back to cookie-based approach.
         */
        function a11yChangeLanguage(langCode) {
            if (!langCode) return;

            // Method 1: Direct <select> manipulation (works with default/HORIZONTAL layout)
            var combo = document.querySelector('.goog-te-combo');
            if (combo) {
                combo.value = langCode;
                combo.dispatchEvent(new Event('change'));
                return;
            }

            // Method 2: Cookie-based fallback (works with any layout)
            var domain = window.location.hostname;
            document.cookie = 'googtrans=/id/' + langCode + ';path=/;domain=' + domain;
            document.cookie = 'googtrans=/id/' + langCode + ';path=/';
            window.location.reload();
        }
    </script>
    <script src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
</body>

</html>
