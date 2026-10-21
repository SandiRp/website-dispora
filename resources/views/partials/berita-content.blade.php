<div data-berita-fragment>
    <div class="flex flex-wrap gap-3 mb-10" data-aos="fade-up">
        <a href="{{ route('berita.index') }}"
            class="px-5 py-2 rounded-full {{ !request('category') ? 'bg-dispora text-white font-bold shadow-sm' : 'bg-white border border-gray-200 text-gray-600 hover:bg-gray-100 font-bold' }} text-sm shrink-0 transition">Semua Berita</a>
        @foreach($categories as $cat)
            <a href="{{ route('berita.index', ['category' => $cat->slug]) }}"
                class="px-5 py-2 rounded-full {{ request('category') == $cat->slug ? 'bg-dispora text-white font-bold shadow-sm' : 'bg-white border border-gray-200 text-gray-600 hover:bg-gray-100 font-bold' }} text-sm shrink-0 transition">{{ $cat->name }}</a>
        @endforeach
    </div>

    @if($posts->count() > 0)
        @php $highlight = $posts->first(); @endphp
        <div data-aos="fade-up" data-aos-delay="100" class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden mb-12 flex flex-col lg:flex-row group">
            <a href="{{ route('berita.detail', $highlight->slug) }}" class="lg:w-2/3 h-64 md:h-96 relative overflow-hidden block">
                <img data-media-image src="{{ $highlight->featured_image ? route('public.file', ['folder' => 'posts', 'filename' => basename($highlight->featured_image)]) : asset('images/media-placeholder.svg') }}"
                    class="w-full h-full object-cover group-hover:scale-105 transition duration-700" alt="{{ $highlight->title }}">
                <div class="absolute top-4 left-4 bg-dispora text-white text-xs font-bold px-3 py-1.5 rounded-full shadow-lg">BERITA UTAMA</div>
            </a>
            <div class="lg:w-1/3 p-8 flex flex-col justify-center">
                <p class="text-sm text-gray-400 mb-3 font-medium flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    {{ $highlight->display_date->translatedFormat('d F Y') }}
                </p>
                <h3 class="text-2xl font-extrabold text-gray-800 mb-4 leading-tight group-hover:text-dispora transition"><a href="{{ route('berita.detail', $highlight->slug) }}">{{ $highlight->title }}</a></h3>
                <p class="text-gray-600 mb-6 line-clamp-4">{{ Str::limit(strip_tags($highlight->content), 200) }}</p>
                <div><a href="{{ route('berita.detail', $highlight->slug) }}" class="inline-flex items-center text-dispora font-bold hover:text-dispora-dark transition">Baca Selengkapnya <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg></a></div>
            </div>
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach($posts->skip(1) as $post)
            <div data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}" class="bg-white rounded-xl overflow-hidden shadow-sm border border-gray-200 hover:shadow-lg transition group flex flex-col">
                <a href="{{ route('berita.detail', $post->slug) }}" class="h-48 relative overflow-hidden shrink-0 block">
                    <img data-media-image src="{{ $post->featured_image ? route('public.file', ['folder' => 'posts', 'filename' => basename($post->featured_image)]) : asset('images/media-placeholder.svg') }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500" alt="{{ $post->title }}">
                    <div class="absolute top-4 left-4 bg-dispora text-white text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-wider">{{ $post->category->name ?? 'Berita' }}</div>
                </a>
                <div class="p-6 flex-grow flex flex-col">
                    <p class="text-xs text-gray-400 mb-2 font-medium">{{ $post->display_date->translatedFormat('d F Y') }}</p>
                    <h4 class="font-bold text-lg text-gray-800 mb-3 hover:text-dispora transition line-clamp-2"><a href="{{ route('berita.detail', $post->slug) }}">{{ $post->title }}</a></h4>
                    <p class="text-gray-600 text-sm line-clamp-3 mb-4 flex-grow">{{ Str::limit(strip_tags($post->content), 120) }}</p>
                    <a href="{{ route('berita.detail', $post->slug) }}" class="text-dispora font-semibold text-sm hover:underline mt-auto">Baca Selengkapnya</a>
                </div>
            </div>
        @endforeach
    </div>

    @if($posts->hasPages())
        <div class="mt-12 flex justify-center">{{ $posts->links() }}</div>
    @endif
</div>
