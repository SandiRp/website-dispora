@extends('layouts.main')

@section('title', 'Program & Dokumen - Dispora Jatim')

@push('styles')
    <style>
        /* Kustomisasi Scrollbar untuk Daftar Dokumen */
        .doc-scroll::-webkit-scrollbar {
            width: 6px;
        }

        .doc-scroll::-webkit-scrollbar-track {
            background: #f3f4f6;
            border-radius: 10px;
        }

        .doc-scroll::-webkit-scrollbar-thumb {
            background: #10b981;
            border-radius: 10px;
        }

        .doc-scroll::-webkit-scrollbar-thumb:hover {
            background: #047857;
        }
    </style>
@endpush

@section('content')

    <div class="relative bg-dispora-dark py-24 overflow-hidden">
        <div class="absolute inset-0 opacity-20">
            <img src="{{ asset('images/programperencana.png') }}"
                class="w-full h-full object-cover" alt="Background Dokumen">
        </div>
        <div class="absolute inset-0 bg-gradient-to-r from-dispora-dark to-transparent"></div>
        <div class="max-w-7xl mx-auto px-6 relative z-10" data-aos="zoom-in">
            <span class="text-dispora-light font-bold tracking-wider uppercase text-sm mb-2 block">Transparansi
                Kinerja</span>
            <h1 class="text-4xl md:text-5xl font-extrabold text-white mb-4 drop-shadow-lg">Program & Perencanaan</h1>
            <div class="w-20 h-1.5 bg-white rounded-full"></div>
            <p class="mt-6 text-gray-200 max-w-2xl text-lg drop-shadow">Akses publik terhadap dokumen perencanaan,
                pelaporan, dan target kinerja Dinas Kepemudaan dan Olahraga Provinsi Jawa Timur.</p>
        </div>
    </div>

    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-6" x-data="{ activeDoc: 'https://www.w3.org/WAI/ER/tests/xhtml/testfiles/resources/pdf/dummy.pdf', activeTitle: 'Rencana Kerja (Renja) Tahun 2026' }">
            <div class="flex items-center space-x-4 mb-10 border-b-2 border-gray-100 pb-4" data-aos="fade-up">
                <h2 class="text-3xl font-extrabold text-gray-800">Rencana Kerja (RENJA)</h2>
            </div>

            <div class="flex flex-col lg:flex-row gap-8 items-start">
                <div data-aos="fade-right"
                    class="w-full lg:w-3/5 bg-gray-100 rounded-2xl p-2 border border-gray-200 shadow-inner h-[600px] flex flex-col">
                    <div
                        class="bg-gray-800 text-white px-4 py-2 rounded-t-xl text-sm font-semibold flex justify-between items-center shrink-0">
                        <span x-text="activeTitle"></span>
                        <a :href="activeDoc" target="_blank"
                            class="bg-white/20 hover:bg-white/30 px-3 py-1 rounded text-xs transition">Buka Penuh</a>
                    </div>
                    <iframe :src="activeDoc" class="w-full flex-grow rounded-b-xl border-none bg-white"></iframe>
                </div>

                <div data-aos="fade-left" class="w-full lg:w-2/5 bg-white rounded-2xl border border-gray-200 shadow-sm flex flex-col h-[600px]">
                    <div class="p-6 border-b border-gray-100 shrink-0">
                        <h3 class="font-bold text-lg text-gray-800">Daftar Dokumen Renja</h3>
                        <p class="text-sm text-gray-500">Pilih dokumen untuk melihat isi.</p>
                    </div>
                    <div class="p-4 flex-grow overflow-y-auto doc-scroll space-y-3">
                        @forelse($renjaDocs as $doc)
                            <button
                                @click="activeDoc = '{{ route('public.file', ['folder' => 'documents', 'filename' => basename($doc->file_path)]) }}'; activeTitle = '{{ addslashes($doc->title) }}'"
                                class="w-full text-left p-4 rounded-xl border border-gray-100 hover:border-dispora hover:bg-dispora/5 transition group flex items-center justify-between"
                                :class="activeTitle === '{{ addslashes($doc->title) }}' ? 'bg-dispora/10 border-dispora ring-1 ring-dispora' :
                                    'bg-gray-50'">
                                <div class="flex items-center">
                                    <svg class="w-8 h-8 text-red-500 mr-4 group-hover:scale-110 transition shrink-0"
                                        fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-1.218 19l-1.782-1.75 5.25-5.25-5.25-5.25 1.782-1.75 6.968 7-6.968 7z" />
                                    </svg>
                                    <div>
                                        <h4 class="font-bold text-gray-800">{{ $doc->title }}</h4>
                                        <p class="text-xs text-gray-500">{{ strtoupper($doc->file_type) }} Document • {{ $doc->file_size }}</p>
                                    </div>
                                </div>
                            </button>
                        @empty
                            <div class="text-center text-gray-500 p-4">Belum ada dokumen RENJA yang dipublikasikan.</div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-20 bg-gray-50 border-y border-gray-200">
        <div class="max-w-7xl mx-auto px-6" x-data="{ activeDoc: 'https://www.w3.org/WAI/ER/tests/xhtml/testfiles/resources/pdf/dummy.pdf', activeTitle: 'Rencana Strategis (Renstra) 2024-2029' }">
            <div class="flex items-center space-x-4 mb-10 border-b-2 border-gray-200 pb-4" data-aos="fade-up">
                <h2 class="text-3xl font-extrabold text-gray-800">Rencana Strategis (RENSTRA)</h2>
            </div>

            <div class="flex flex-col lg:flex-row-reverse gap-8 items-start">

                <div data-aos="fade-left"
                    class="w-full lg:w-3/5 bg-gray-100 rounded-2xl p-2 border border-gray-200 shadow-inner h-[600px] flex flex-col">
                    <div
                        class="bg-gray-800 text-white px-4 py-2 rounded-t-xl text-sm font-semibold flex justify-between items-center shrink-0">
                        <span x-text="activeTitle"></span>
                        <a :href="activeDoc" target="_blank"
                            class="bg-white/20 hover:bg-white/30 px-3 py-1 rounded text-xs transition">Buka Penuh</a>
                    </div>
                    <iframe :src="activeDoc" class="w-full flex-grow rounded-b-xl border-none bg-white"></iframe>
                </div>

                <div data-aos="fade-right" class="w-full lg:w-2/5 bg-white rounded-2xl border border-gray-200 shadow-sm flex flex-col h-[600px]">
                    <div class="p-6 border-b border-gray-100 shrink-0">
                        <h3 class="font-bold text-lg text-gray-800">Daftar Dokumen Renstra</h3>
                        <p class="text-sm text-gray-500">Pilih dokumen untuk melihat isi.</p>
                    </div>
                    <div class="p-4 flex-grow overflow-y-auto doc-scroll space-y-3">
                        @forelse($renstraDocs as $doc)
                            <button
                                @click="activeDoc = '{{ route('public.file', ['folder' => 'documents', 'filename' => basename($doc->file_path)]) }}'; activeTitle = '{{ addslashes($doc->title) }}'"
                                class="w-full text-left p-4 rounded-xl border border-gray-100 hover:border-dispora hover:bg-dispora/5 transition group flex items-center justify-between"
                                :class="activeTitle === '{{ addslashes($doc->title) }}' ? 'bg-dispora/10 border-dispora ring-1 ring-dispora' :
                                    'bg-gray-50'">
                                <div class="flex items-center">
                                    <svg class="w-8 h-8 text-red-500 mr-4 group-hover:scale-110 transition shrink-0"
                                        fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-1.218 19l-1.782-1.75 5.25-5.25-5.25-5.25 1.782-1.75 6.968 7-6.968 7z" />
                                    </svg>
                                    <div>
                                        <h4 class="font-bold text-gray-800">{{ $doc->title }}</h4>
                                        <p class="text-xs text-gray-500">{{ strtoupper($doc->file_type) }} Document • {{ $doc->file_size }}</p>
                                    </div>
                                </div>
                            </button>
                        @empty
                            <div class="text-center text-gray-500 p-4">Belum ada dokumen RENSTRA yang dipublikasikan.</div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-6" x-data="{ activeDoc: 'https://www.w3.org/WAI/ER/tests/xhtml/testfiles/resources/pdf/dummy.pdf', activeTitle: 'LKJIP Tahun 2025' }">
            <div class="flex items-center space-x-4 mb-10 border-b-2 border-gray-100 pb-4" data-aos="fade-up">
                <h2 class="text-3xl font-extrabold text-gray-800">Laporan Kinerja (LKJIP)</h2>
            </div>

            <div class="flex flex-col lg:flex-row gap-8 items-start">
                <div data-aos="fade-right"
                    class="w-full lg:w-3/5 bg-gray-100 rounded-2xl p-2 border border-gray-200 shadow-inner h-[600px] flex flex-col">
                    <div
                        class="bg-gray-800 text-white px-4 py-2 rounded-t-xl text-sm font-semibold flex justify-between items-center shrink-0">
                        <span x-text="activeTitle"></span>
                        <a :href="activeDoc" target="_blank"
                            class="bg-white/20 hover:bg-white/30 px-3 py-1 rounded text-xs transition">Buka Penuh</a>
                    </div>
                    <iframe :src="activeDoc" class="w-full flex-grow rounded-b-xl border-none bg-white"></iframe>
                </div>

                <div data-aos="fade-left" class="w-full lg:w-2/5 bg-white rounded-2xl border border-gray-200 shadow-sm flex flex-col h-[600px]">
                    <div class="p-6 border-b border-gray-100 shrink-0">
                        <h3 class="font-bold text-lg text-gray-800">Daftar Dokumen LKJIP</h3>
                        <p class="text-sm text-gray-500">Pilih dokumen untuk melihat isi.</p>
                    </div>
                    <div class="p-4 flex-grow overflow-y-auto doc-scroll space-y-3">
                        @forelse($lkjipDocs as $doc)
                            <button
                                @click="activeDoc = '{{ route('public.file', ['folder' => 'documents', 'filename' => basename($doc->file_path)]) }}'; activeTitle = '{{ addslashes($doc->title) }}'"
                                class="w-full text-left p-4 rounded-xl border border-gray-100 hover:border-dispora hover:bg-dispora/5 transition group flex items-center justify-between"
                                :class="activeTitle === '{{ addslashes($doc->title) }}' ? 'bg-dispora/10 border-dispora ring-1 ring-dispora' :
                                    'bg-gray-50'">
                                <div class="flex items-center">
                                    <svg class="w-8 h-8 text-red-500 mr-4 group-hover:scale-110 transition shrink-0"
                                        fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-1.218 19l-1.782-1.75 5.25-5.25-5.25-5.25 1.782-1.75 6.968 7-6.968 7z" />
                                    </svg>
                                    <div>
                                        <h4 class="font-bold text-gray-800">{{ $doc->title }}</h4>
                                        <p class="text-xs text-gray-500">{{ strtoupper($doc->file_type) }} Document • {{ $doc->file_size }}</p>
                                    </div>
                                </div>
                            </button>
                        @empty
                            <div class="text-center text-gray-500 p-4">Belum ada dokumen LKJIP yang dipublikasikan.</div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-20 bg-gray-50 border-t border-gray-200">
        <div class="max-w-7xl mx-auto px-6" x-data="{ activeDoc: 'https://www.w3.org/WAI/ER/tests/xhtml/testfiles/resources/pdf/dummy.pdf', activeTitle: 'Perjanjian Kinerja Tahun 2026' }">
            <div class="flex items-center space-x-4 mb-10 border-b-2 border-gray-200 pb-4" data-aos="fade-up">
                <h2 class="text-3xl font-extrabold text-gray-800">Perjanjian Kinerja (PK)</h2>
            </div>

            <div class="flex flex-col lg:flex-row-reverse gap-8 items-start">

                <div data-aos="fade-left"
                    class="w-full lg:w-3/5 bg-gray-100 rounded-2xl p-2 border border-gray-200 shadow-inner h-[600px] flex flex-col">
                    <div
                        class="bg-gray-800 text-white px-4 py-2 rounded-t-xl text-sm font-semibold flex justify-between items-center shrink-0">
                        <span x-text="activeTitle"></span>
                        <a :href="activeDoc" target="_blank"
                            class="bg-white/20 hover:bg-white/30 px-3 py-1 rounded text-xs transition">Buka Penuh</a>
                    </div>
                    <iframe :src="activeDoc" class="w-full flex-grow rounded-b-xl border-none bg-white"></iframe>
                </div>

                <div data-aos="fade-right" class="w-full lg:w-2/5 bg-white rounded-2xl border border-gray-200 shadow-sm flex flex-col h-[600px]">
                    <div class="p-6 border-b border-gray-100 shrink-0">
                        <h3 class="font-bold text-lg text-gray-800">Daftar Dokumen PK</h3>
                        <p class="text-sm text-gray-500">Pilih dokumen untuk melihat isi.</p>
                    </div>
                    <div class="p-4 flex-grow overflow-y-auto doc-scroll space-y-3">
                        @forelse($pkDocs as $doc)
                            <button
                                @click="activeDoc = '{{ route('public.file', ['folder' => 'documents', 'filename' => basename($doc->file_path)]) }}'; activeTitle = '{{ addslashes($doc->title) }}'"
                                class="w-full text-left p-4 rounded-xl border border-gray-100 hover:border-dispora hover:bg-dispora/5 transition group flex items-center justify-between"
                                :class="activeTitle === '{{ addslashes($doc->title) }}' ? 'bg-dispora/10 border-dispora ring-1 ring-dispora' :
                                    'bg-gray-50'">
                                <div class="flex items-center">
                                    <svg class="w-8 h-8 text-red-500 mr-4 group-hover:scale-110 transition shrink-0"
                                        fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-1.218 19l-1.782-1.75 5.25-5.25-5.25-5.25 1.782-1.75 6.968 7-6.968 7z" />
                                    </svg>
                                    <div>
                                        <h4 class="font-bold text-gray-800">{{ $doc->title }}</h4>
                                        <p class="text-xs text-gray-500">{{ strtoupper($doc->file_type) }} Document • {{ $doc->file_size }}</p>
                                    </div>
                                </div>
                            </button>
                        @empty
                            <div class="text-center text-gray-500 p-4">Belum ada dokumen Perjanjian Kinerja yang dipublikasikan.</div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
