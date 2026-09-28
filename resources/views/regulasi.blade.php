@extends('layouts.main')

@section('title', 'Kumpulan Regulasi - Dispora Jatim')

@section('content')
    <!-- HEADER/HERO INTERNAL PAGE -->
    <div class="relative pt-32 pb-20 overflow-hidden bg-dispora-dark">
        <div class="absolute inset-0 opacity-20">
            <img src="{{ asset('images/regulasi.png') }}"
                class="w-full h-full object-cover" alt="Background Dokumen">
        </div>
        <div class="absolute inset-0 bg-gradient-to-r from-dispora-dark to-transparent"></div>
        <div class="max-w-7xl mx-auto px-6 relative z-10" data-aos="zoom-in">
            <span class="text-dispora-light font-bold tracking-wider uppercase text-sm mb-2 block">Produk Hukum</span>
            <h1 class="text-4xl md:text-5xl font-extrabold text-white mb-4 drop-shadow-lg">Dokumen Regulasi</h1>
            <div class="w-20 h-1.5 bg-white rounded-full"></div>
            <p class="mt-6 text-gray-200 max-w-2xl text-lg drop-shadow">Kumpulan produk hukum dan peraturan perundang-undangan terkait kepemudaan dan olahraga di Provinsi Jawa Timur.</p>
        </div>
    </div>

    <!-- BREADCRUMB -->
    <div class="bg-white border-b border-gray-100 py-4 shadow-sm">
        <div class="max-w-7xl mx-auto px-6">
            <nav class="text-sm text-gray-500">
                <a href="{{ url('/') }}" class="hover:text-dispora-600 transition">Beranda</a>
                <span class="mx-2">/</span>
                <span class="text-gray-800 font-medium">Regulasi</span>
            </nav>
        </div>
    </div>

    <section class="py-12 bg-gray-50 min-h-screen" x-data="{ showPreview: false, previewUrl: '', previewTitle: '' }">
        <div class="max-w-7xl mx-auto px-6">

            <form method="GET" action="{{ url('/regulasi') }}" data-aos="fade-up" data-aos-delay="100" class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 mb-8 flex flex-col md:flex-row gap-4 items-end">
                <div class="w-full md:w-1/3">
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Cari Judul / Nomor</label>
                    <div class="relative">
                        <input type="text" name="search" value="{{ request('search') }}" class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-dispora/20 focus:border-dispora outline-none transition text-sm" placeholder="Contoh: Pergub No. 12 Tahun...">
                    </div>
                </div>
                <div class="w-full md:w-1/6">
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Tahun</label>
                    <select name="year" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-dispora/20 focus:border-dispora outline-none transition text-sm text-gray-700 bg-white">
                        <option value="">Semua Tahun</option>
                        <option value="2024" {{ request('year') == '2024' ? 'selected' : '' }}>2024</option>
                        <option value="2025" {{ request('year') == '2025' ? 'selected' : '' }}>2025</option>
                        <option value="2026" {{ request('year') == '2026' ? 'selected' : '' }}>2026</option>
                        <option value="2027" {{ request('year') == '2027' ? 'selected' : '' }}>2027</option>
                        <option value="2028" {{ request('year') == '2028' ? 'selected' : '' }}>2028</option>
                        <option value="2029" {{ request('year') == '2029' ? 'selected' : '' }}>2029</option>
                        <option value="2030" {{ request('year') == '2030' ? 'selected' : '' }}>2030</option>
                    </select>
                </div>
                <div class="w-full md:w-auto">
                    <button type="submit" class="w-full md:w-auto bg-dispora hover:bg-dispora-dark text-white px-6 py-2.5 rounded-lg font-bold transition shadow-sm flex items-center justify-center">Terapkan Filter</button>
                </div>
            </form>

            <div class="space-y-4">
                @forelse($documents as $doc)
                <div data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}" class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 flex flex-col md:flex-row items-start md:items-center justify-between gap-6 hover:shadow-md transition">
                    <div class="flex items-start gap-5">
                        <div class="w-12 h-12 bg-blue-50 rounded-lg flex items-center justify-center shrink-0 border border-blue-100">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        </div>
                        <div>
                            <div class="flex flex-wrap items-center gap-2 mb-2">
                                <span class="bg-gray-100 text-gray-600 px-2.5 py-0.5 rounded text-[10px] font-bold uppercase tracking-wider">{{ $doc->category->name ?? 'Dokumen' }}</span>
                                <span class="bg-green-100 text-green-700 px-2.5 py-0.5 rounded text-[10px] font-bold uppercase tracking-wider">Berlaku</span>
                            </div>
                            <h4 class="text-lg font-bold text-gray-800 mb-1 leading-tight hover:text-dispora transition cursor-pointer">{{ $doc->title }}</h4>
                            <p class="text-sm text-gray-500">{{ Str::limit(strip_tags($doc->description), 150) }}</p>
                        </div>
                    </div>
                    <div class="w-full md:w-auto shrink-0 border-t md:border-none border-gray-100 pt-4 md:pt-0 flex flex-wrap gap-2 justify-end">
                        <button type="button" @disabled(!$doc->file_path) @click.prevent="previewUrl = {{ \Illuminate\Support\Js::from(\App\Support\Media::url($doc->file_path)) }}; previewTitle = {{ \Illuminate\Support\Js::from($doc->title) }}; showPreview = true" class="bg-blue-50 border border-blue-200 text-blue-600 hover:bg-blue-600 hover:text-white px-4 py-2 rounded-lg font-bold text-sm flex items-center justify-center transition">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg> Preview
                        </button>
                        @if($doc->file_path)
                        <a href="{{ \App\Support\Media::url($doc->file_path) }}?download=1" download class="bg-white border-2 border-gray-200 text-gray-700 hover:border-dispora hover:text-dispora px-4 py-2 rounded-lg font-bold text-sm flex items-center justify-center transition">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg> Unduh
                        </a>
                        @else
                        <span role="status" class="text-sm text-gray-500">Dokumen tidak tersedia.</span>
                        @endif
                    </div>
                </div>
                @empty
                <div class="text-center py-12 text-gray-500 bg-white rounded-xl border border-gray-200">Belum ada dokumen regulasi.</div>
                @endforelse
                <div class="mt-8 flex justify-center">{{ $documents->links() }}</div>
            </div>

            <!-- Modal -->
            <div x-show="showPreview" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-gray-900 bg-opacity-75 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all w-full max-w-4xl h-[80vh] flex flex-col">
                    <div class="bg-white px-4 py-3 border-b border-gray-200 flex justify-between items-center shrink-0">
                        <h3 class="text-lg leading-6 font-bold text-gray-900 truncate" id="modal-title" x-text="previewTitle"></h3>
                        <button type="button" @click="showPreview = false" class="text-gray-400 hover:text-gray-500">
                            <span class="sr-only">Close</span>
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>
                    </div>
                    <div class="bg-gray-100 flex-1 min-h-0 w-full relative flex flex-col">
                        <iframe x-media-preview="showPreview ? previewUrl : ''" title="Pratinjau dokumen" class="w-full flex-1 min-h-0 border-none"></iframe>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse shrink-0">
                        <button type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm transition" @click="showPreview = false">Tutup</button>
                        <a :href="previewUrl ? previewUrl + '?download=1' : null" download class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-dispora text-base font-medium text-white hover:bg-dispora-dark focus:outline-none sm:w-auto sm:text-sm transition">Unduh Dokumen</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
