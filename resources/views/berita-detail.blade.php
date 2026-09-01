@extends('layouts.main')

@section('title', 'Gubernur Jatim Resmikan Pemusatan Latihan Daerah PON XXI - Dispora Jatim')

@section('content')

    <!-- NAVBAR BACKGROUND -->
    <div class="h-20 bg-dispora-dark w-full"></div>

    <!-- BREADCRUMB -->
    <div class="bg-white border-b border-gray-100 py-4 shadow-sm mb-4" data-aos="fade-down">
        <div class="max-w-7xl mx-auto px-6">
            <nav class="text-sm text-gray-500 flex items-center overflow-x-auto whitespace-nowrap hide-scrollbar">
                <a href="{{ url('/') }}" class="hover:text-dispora-600 transition">Beranda</a>
                <span class="mx-2">/</span>
                <a href="{{ url('/berita') }}" class="hover:text-dispora-600 transition">Berita</a>
                <span class="mx-2">/</span>
                <span class="text-gray-800 font-medium">{{ $post->category->name ?? 'Berita' }}</span>
                <span class="mx-2">/</span>
                <span class="text-gray-400 truncate max-w-[200px] md:max-w-xs">{{ Str::limit($post->title, 40) }}</span>
            </nav>
        </div>
    </div>

    <section x-data="{
        searchQuery: '',
        showSearchPopup: false,
        searchResults: [],
        fetchSuggestions() {
            if (this.searchQuery.length < 2) {
                this.showSearchPopup = false;
                return;
            }
            fetch('/api/berita/suggest?q=' + encodeURIComponent(this.searchQuery))
                .then(res => res.json())
                .then(data => {
                    this.searchResults = data;
                    this.showSearchPopup = data.length > 0;
                })
                .catch(() => {
                    this.showSearchPopup = false;
                });
        }
    }" class="py-10 bg-gray-50 min-h-screen mb-4">
        <div class="max-w-7xl mx-auto px-6">

            <div class="flex flex-col lg:flex-row gap-10 items-start w-full">

                <!-- ==========================================
                                                                         KOLOM KIRI (Artikel Utama)
                                                                    =========================================== -->
                <div data-aos="fade-right"
                    class="w-full lg:w-2/3 xl:w-8/12 bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden min-w-0">

                    <div class="p-6 md:p-10">
                        <div class="mb-6 flex">
                            <span class="bg-dispora text-white px-3 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider shadow-sm">{{ $post->category->name ?? 'Berita' }}</span>
                        </div>

                        <h1 class="text-3xl md:text-4xl lg:text-5xl font-extrabold text-gray-900 mb-6 leading-tight">
                            {{ $post->title }}
                        </h1>

                        <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4 border-y border-gray-100 py-4 mb-8">
                            <div class="flex items-center space-x-4">
                                <div class="w-10 h-10 bg-gray-200 rounded-full overflow-hidden border-2 border-white shadow-sm shrink-0">
                                    <svg class="w-full h-full text-gray-400" fill="currentColor" viewBox="0 0 24 24"><path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-gray-800">{{ $post->user->name ?? 'Admin' }}</p>
                                    <p class="text-xs text-gray-500 font-medium">{{ $post->created_at->translatedFormat('l, d F Y • H:i') }} WIB</p>
                                </div>
                            </div>

                            <div class="flex items-center space-x-2">
                                <span class="text-xs text-gray-400 font-bold mr-2 uppercase tracking-wider">Bagikan:</span>
                                <a href="#"
                                    class="w-8 h-8 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center hover:bg-blue-600 hover:text-white transition shadow-sm"><svg
                                        class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.469h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.469h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                                    </svg></a>
                                <a href="#"
                                    class="w-8 h-8 bg-green-100 text-green-600 rounded-full flex items-center justify-center hover:bg-green-600 hover:text-white transition shadow-sm"><svg
                                        class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 0 0-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413z" />
                                    </svg></a>
                                <a href="#"
                                    class="w-8 h-8 bg-sky-100 text-sky-500 rounded-full flex items-center justify-center hover:bg-sky-500 hover:text-white transition shadow-sm"><svg
                                        class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z" />
                                    </svg></a>
                            </div>
                        </div>

                        <div class="w-full h-[300px] md:h-[450px] rounded-2xl overflow-hidden mb-8 shadow-sm">
                            <img src="{{ $post->featured_image ? route('public.file', ['folder' => 'posts', 'filename' => basename($post->featured_image)]) : 'https://images.unsplash.com/photo-1542744173-8e7e53415bb0?q=80&w=1200&auto=format&fit=crop' }}"
                                class="w-full h-full object-cover" alt="{{ $post->title }}">
                        </div>

                        <div class="text-lg text-gray-700 leading-relaxed space-y-6 prose max-w-none">
                            @php
                                // Rewrite admin-only file URLs to public-accessible URLs regardless of domain stored in DB
                                $renderedContent = $post->content;
                                $renderedContent = preg_replace(
                                    '#src=["\'][^"\']*?/admin/files/([^/]+)/([^"\'\s>]+)["\']#i',
                                    'src="' . url('/file') . '/$1/$2"',
                                    $renderedContent
                                );
                            @endphp
                            {!! $renderedContent !!}
                        </div>

                        <div class="mt-12 pt-6 border-t border-gray-100 flex flex-wrap gap-2 items-center">
                            <span class="text-sm font-bold text-gray-500 mr-2">Kategori:</span>
                            <a href="#" class="bg-gray-100 hover:bg-dispora hover:text-white text-gray-600 px-3 py-1 rounded text-sm transition">{{ $post->category->name ?? 'Berita' }}</a>
                        </div>
                    </div>
                </div>

                <!-- ==========================================
                            KOLOM KANAN (Sidebar Widget) Menggunakan "flex flex-col gap-8" untuk jaminan jarak yang pas =========================================== -->
                <!-- KOLOM KANAN (Sticky Sidebar) -->
                <!-- Ditambahkan 'sticky top-24' dan 'self-start' agar menempel sempurna -->
                <div data-aos="fade-left" class="w-full lg:w-1/3 xl:w-4/12 shrink-0 flex flex-col gap-8 sticky top-24 self-start">

                    <!-- 1. Search Widget -->
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
                        <h4 class="font-bold text-gray-800 mb-4 flex items-center">
                            <span class="w-1.5 h-6 bg-dispora rounded-full mr-3"></span>
                            Cari Berita
                        </h4>
                        <form action="/berita" method="GET" class="relative" x-on:input.debounce.300ms="searchQuery = $event.target.value; fetchSuggestions();">
                            <input type="text" name="search" x-model="searchQuery"
                                class="w-full pl-4 pr-10 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-dispora/20 focus:border-dispora outline-none transition text-sm bg-gray-50"
                                placeholder="Kata kunci pencarian..." autocomplete="off">
                            <button type="submit"
                                class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-dispora">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </button>
                        </form>
                        <!-- Recommendation Popup -->
                        <div x-show="showSearchPopup && searchResults.length > 0" class="absolute z-10 w-full bg-white border border-gray-200 rounded-md shadow-lg mt-1">
                            <template x-for="result in searchResults" :key="result.id">
                                <a :href="'/berita/' + result.slug" class="block px-4 py-2 hover:bg-gray-100" x-text="result.title"></a>
                            </template>
                        </div>
                    </div>

                    <!-- 2. Berita Terkait -->
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                        <div class="bg-white border-b border-gray-100 p-6">
                            <h4 class="font-bold text-gray-800 uppercase tracking-wider text-sm flex items-center">
                                <span class="w-1.5 h-6 bg-dispora rounded-full mr-3"></span>
                                Berita Terkait
                            </h4>
                        </div>
                        <div class="p-6 space-y-6">

                            <!-- Item Berita -->
                            @forelse($relatedPosts->where('id','!=',$post->id) as $related)
                            <a href="{{ route('berita.detail', $related->slug) }}" class="flex gap-4 group">
                                <div class="w-20 h-20 bg-gray-200 rounded-xl overflow-hidden shrink-0 shadow-sm">
                                    <img src="{{ $related->featured_image ? route('public.file', ['folder' => 'posts', 'filename' => basename($related->featured_image)]) : 'https://images.unsplash.com/photo-1517486808906-6ca8b3f04846?q=80&w=200&auto=format&fit=crop' }}"
                                        class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                                </div>
                                <div class="flex flex-col justify-center">
                                    <h5 class="text-sm font-bold text-gray-800 leading-snug group-hover:text-dispora transition line-clamp-2 mb-1">
                                        {{ $related->title }}
                                    </h5>
                                    <p class="text-[11px] text-gray-400 font-medium uppercase tracking-wide">{{ $related->created_at->translatedFormat('d F Y') }}</p>
                                </div>
                            </a>
                            @if(!$loop->last)
                            <div class="border-t border-gray-100"></div>
                            @endif
                            @empty
                            <div class="text-sm text-gray-500 italic">Belum ada berita terkait.</div>
                            @endforelse

                        </div>
                        <a href="{{ url('/berita') }}"
                            class="block w-full text-center bg-gray-50 py-4 text-sm font-bold text-dispora hover:bg-gray-100 transition border-t border-gray-100 uppercase tracking-wider">
                            Lihat Semua Berita &rarr;
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </section>

@endsection
