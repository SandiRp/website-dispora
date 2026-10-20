@extends('layouts.main')

@section('title', 'Logo Resmi - DISPORA Jawa Timur')

@section('content')

    {{-- Hero Section --}}
    <section class="relative pt-32 pb-20 lg:pt-40 lg:pb-28 bg-dispora-900 overflow-hidden">
        <div class="absolute inset-0">
            <img src="https://images.unsplash.com/photo-1541701494587-cb58502866ab?q=80&w=2000&auto=format&fit=crop" class="w-full h-full object-cover opacity-10 mix-blend-luminosity">
            <div class="absolute inset-0 bg-gradient-to-br from-dispora-900 via-dispora-900/95 to-dispora-800/90"></div>
        </div>
        
        <div class="max-w-7xl mx-auto px-6 relative z-10 text-center">
            <div class="inline-flex items-center space-x-2 bg-white/10 backdrop-blur-md px-4 py-1.5 rounded-full text-xs font-bold mb-6 border border-white/20 text-white" data-aos="fade-down">
                <span>🎨</span>
                <span class="uppercase tracking-wider">Aset Publik</span>
            </div>
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-black text-white mb-6 leading-tight tracking-tight" data-aos="fade-up" data-aos-delay="100">
                Logo Resmi <span class="text-transparent bg-clip-text bg-gradient-to-r from-dispora-200 to-dispora-400">DISPORA</span>
            </h1>
            <p class="text-lg text-dispora-100 max-w-2xl mx-auto leading-relaxed" data-aos="fade-up" data-aos-delay="200">
                Kumpulan logo resmi, maskot, dan aset visual lainnya yang dikeluarkan oleh Dinas Kepemudaan dan Olahraga Provinsi Jawa Timur.
            </p>
        </div>

        <div class="absolute bottom-0 left-0 w-full h-16 bg-gradient-to-t from-gray-50 to-transparent"></div>
    </section>

    {{-- Logo List Section --}}
    <section class="py-20 bg-gray-50 min-h-[50vh]">
        <div class="max-w-7xl mx-auto px-6">
            @if(isset($logos) && $logos->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                    @foreach($logos as $logo)
                        <div class="bg-white rounded-3xl border border-gray-100 shadow-xl shadow-gray-200/50 hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 flex flex-col overflow-hidden group" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                            {{-- Image Preview Area --}}
                            <div class="h-48 w-full bg-gray-50/50 p-8 flex items-center justify-center relative overflow-hidden group-hover:bg-dispora-50/30 transition-colors">
                                @if($loop->first)
                                <div class="absolute top-4 right-4">
                                    <span class="bg-dispora-500 text-white text-[10px] font-bold px-2 py-1 rounded-full uppercase tracking-wider">Terbaru</span>
                                </div>
                                @endif
                                
                                @if($logo->image_path)
                                    <img src="{{ \App\Support\Media::url($logo->image_path) }}" alt="{{ $logo->title }}" class="max-h-full max-w-full object-contain filter group-hover:scale-110 transition-transform duration-500">
                                @else
                                    <div class="text-gray-300 flex flex-col items-center">
                                        <svg class="w-12 h-12 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                        <span class="text-xs font-medium">Preview Tidak Tersedia</span>
                                    </div>
                                @endif
                            </div>

                            {{-- Content Area --}}
                            <div class="p-6 flex-grow flex flex-col bg-white border-t border-gray-50">
                                <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $logo->title }}</h3>
                                @if($logo->description)
                                    <p class="text-sm text-gray-500 mb-6 flex-grow line-clamp-3">{{ $logo->description }}</p>
                                @endif
                                
                                <div class="mt-auto">
                                    @if($logo->file_path)
                                        <a href="{{ \App\Support\Media::url($logo->file_path) }}?download=1" download class="w-full flex items-center justify-center gap-2 bg-dispora-50 hover:bg-dispora-600 text-dispora-700 hover:text-white border border-dispora-100 font-semibold py-2.5 px-4 rounded-xl transition-all duration-300">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                                            Unduh Logo
                                        </a>
                                    @else
                                        <button disabled class="w-full flex items-center justify-center gap-2 bg-gray-50 text-gray-400 border border-gray-100 font-semibold py-2.5 px-4 rounded-xl cursor-not-allowed">
                                            Tidak Tersedia
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-20 bg-white rounded-3xl border border-gray-100 shadow-sm" data-aos="fade-up">
                    <div class="w-24 h-24 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Belum Ada Logo</h3>
                    <p class="text-gray-500">Saat ini belum ada logo resmi yang dipublikasikan.</p>
                </div>
            @endif
        </div>
    </section>

@endsection
