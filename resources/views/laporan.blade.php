@extends('layouts.main')

@section('title', 'Laporan Keuangan - Dispora Jatim')

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
            <img src="{{ asset('images/aset.png') }}"
                class="w-full h-full object-cover" alt="Background Dokumen">
        </div>
        <div class="absolute inset-0 bg-gradient-to-r from-dispora-dark to-transparent"></div>
        <div class="max-w-7xl mx-auto px-6 relative z-10" data-aos="zoom-in">
            <span class="text-dispora-light font-bold tracking-wider uppercase text-sm mb-2 block">Transparansi Kinerja</span>
            <h1 class="text-4xl md:text-5xl font-extrabold text-white mb-4 drop-shadow-lg">Laporan Keuangan</h1>
            <div class="w-20 h-1.5 bg-white rounded-full"></div>
            <p class="mt-6 text-gray-200 max-w-2xl text-lg drop-shadow">Akses publik terhadap  Laporan Keuangan dan Aset pada Dinas Kepemudaan dan Olahraga Provinsi Jawa Timur.</p>
        </div>
    </div>

    <!-- Section DPA -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-6" x-data="{ activeDoc: '', activeTitle: 'Pilih Dokumen' }">
            <div class="flex items-center space-x-4 mb-10 border-b-2 border-gray-100 pb-4" data-aos="fade-up">
                <h2 class="text-3xl font-extrabold text-gray-800">DPA (Dokumen Pelaksanaan Anggaran)</h2>
            </div>

            <div class="flex flex-col lg:flex-row gap-8 items-start">
                <div data-aos="fade-right"
                    class="w-full lg:w-3/5 bg-gray-100 rounded-2xl p-2 border border-gray-200 shadow-inner h-[600px] flex flex-col">
                    <div
                        class="bg-gray-800 text-white px-4 py-2 rounded-t-xl text-sm font-semibold flex justify-between items-center shrink-0">
                        <span x-text="activeTitle"></span>
                        <a :href="activeDoc" target="_blank" x-show="activeDoc !== ''"
                            class="bg-white/20 hover:bg-white/30 px-3 py-1 rounded text-xs transition">Buka Penuh</a>
                    </div>
                    <template x-if="activeDoc !== ''">
                        <iframe :src="activeDoc" class="w-full flex-grow rounded-b-xl border-none bg-white"></iframe>
                    </template>
                    <template x-if="activeDoc === ''">
                        <div class="w-full flex-grow rounded-b-xl border-none bg-white flex items-center justify-center text-gray-400">
                            Pilih dokumen dari daftar untuk melihat pratinjau.
                        </div>
                    </template>
                </div>

                <div data-aos="fade-left" class="w-full lg:w-2/5 bg-white rounded-2xl border border-gray-200 shadow-sm flex flex-col h-[600px]">
                    <div class="p-6 border-b border-gray-100 shrink-0">
                        <h3 class="font-bold text-lg text-gray-800">Ringkasan Dokumen DPA</h3>
                        <p class="text-sm text-gray-500">Pilih dokumen untuk melihat isi.</p>
                    </div>
                    <div class="p-4 flex-grow overflow-y-auto doc-scroll space-y-3">
                        @forelse($dpaDocs as $doc)
                            <button
                                @click="activeDoc = '{{ route('public.file', ['folder' => 'documents', 'filename' => basename($doc->file_path)]) }}'; activeTitle = '{{ addslashes($doc->title) }}'"
                                class="w-full text-left p-4 rounded-xl border border-gray-100 hover:border-dispora hover:bg-dispora/5 transition group flex items-center justify-between"
                                :class="activeTitle === '{{ addslashes($doc->title) }}' ? 'bg-dispora/10 border-dispora ring-1 ring-dispora' : 'bg-gray-50'">
                                <div class="flex items-center">
                                    <svg class="w-8 h-8 text-red-500 mr-4 group-hover:scale-110 transition shrink-0" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-1.218 19l-1.782-1.75 5.25-5.25-5.25-5.25 1.782-1.75 6.968 7-6.968 7z" />
                                    </svg>
                                    <div>
                                        <h4 class="font-bold text-gray-800">{{ $doc->title }}</h4>
                                        <p class="text-xs text-gray-500">{{ strtoupper($doc->file_type) }} Document • {{ $doc->file_size }}</p>
                                    </div>
                                </div>
                            </button>
                        @empty
                            <div class="text-center text-gray-500 p-4">Belum ada Ringkasan DPA yang dipublikasikan.</div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section ASET -->
    <section class="py-20 bg-gray-50 border-y border-gray-200">
        <div class="max-w-7xl mx-auto px-6" x-data="{ activeDoc: '', activeTitle: 'Pilih Dokumen' }">
            <div class="flex items-center space-x-4 mb-10 border-b-2 border-gray-200 pb-4" data-aos="fade-up">
                <h2 class="text-3xl font-extrabold text-gray-800">Laporan ASET</h2>
            </div>

            <div class="flex flex-col lg:flex-row-reverse gap-8 items-start">
                <div data-aos="fade-left"
                    class="w-full lg:w-3/5 bg-gray-200 rounded-2xl p-2 border border-gray-300 shadow-inner h-[600px] flex flex-col">
                    <div
                        class="bg-gray-800 text-white px-4 py-2 rounded-t-xl text-sm font-semibold flex justify-between items-center shrink-0">
                        <span x-text="activeTitle"></span>
                        <a :href="activeDoc" target="_blank" x-show="activeDoc !== ''"
                            class="bg-white/20 hover:bg-white/30 px-3 py-1 rounded text-xs transition">Buka Penuh</a>
                    </div>
                    <template x-if="activeDoc !== ''">
                        <iframe :src="activeDoc" class="w-full flex-grow rounded-b-xl border-none bg-white"></iframe>
                    </template>
                    <template x-if="activeDoc === ''">
                        <div class="w-full flex-grow rounded-b-xl border-none bg-white flex items-center justify-center text-gray-400">
                            Pilih dokumen dari daftar untuk melihat pratinjau.
                        </div>
                    </template>
                </div>

                <div data-aos="fade-right" class="w-full lg:w-2/5 bg-white rounded-2xl border border-gray-200 shadow-sm flex flex-col h-[600px]">
                    <div class="p-6 border-b border-gray-100 shrink-0">
                        <h3 class="font-bold text-lg text-gray-800">Ringkasan Laporan ASET</h3>
                        <p class="text-sm text-gray-500">Pilih dokumen untuk melihat isi.</p>
                    </div>
                    <div class="p-4 flex-grow overflow-y-auto doc-scroll space-y-3">
                        @forelse($asetDocs as $doc)
                            <button
                                @click="activeDoc = '{{ route('public.file', ['folder' => 'documents', 'filename' => basename($doc->file_path)]) }}'; activeTitle = '{{ addslashes($doc->title) }}'"
                                class="w-full text-left p-4 rounded-xl border border-gray-100 hover:border-dispora hover:bg-dispora/5 transition group flex items-center justify-between"
                                :class="activeTitle === '{{ addslashes($doc->title) }}' ? 'bg-dispora/10 border-dispora ring-1 ring-dispora' : 'bg-white'">
                                <div class="flex items-center">
                                    <svg class="w-8 h-8 text-blue-500 mr-4 group-hover:scale-110 transition shrink-0" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-1.218 19l-1.782-1.75 5.25-5.25-5.25-5.25 1.782-1.75 6.968 7-6.968 7z" />
                                    </svg>
                                    <div>
                                        <h4 class="font-bold text-gray-800">{{ $doc->title }}</h4>
                                        <p class="text-xs text-gray-500">{{ strtoupper($doc->file_type) }} Document • {{ $doc->file_size }}</p>
                                    </div>
                                </div>
                            </button>
                        @empty
                            <div class="text-center text-gray-500 p-4">Belum ada dokumen ASET yang dipublikasikan.</div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section LRA -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-6" x-data="{ activeDoc: '', activeTitle: 'Pilih Dokumen' }">
            <div class="flex items-center space-x-4 mb-10 border-b-2 border-gray-100 pb-4" data-aos="fade-up">
                <h2 class="text-3xl font-extrabold text-gray-800">LRA (Laporan Realisasi Anggaran)</h2>
            </div>

            <div class="flex flex-col lg:flex-row gap-8 items-start">
                <div data-aos="fade-right"
                    class="w-full lg:w-3/5 bg-gray-100 rounded-2xl p-2 border border-gray-200 shadow-inner h-[600px] flex flex-col">
                    <div
                        class="bg-gray-800 text-white px-4 py-2 rounded-t-xl text-sm font-semibold flex justify-between items-center shrink-0">
                        <span x-text="activeTitle"></span>
                        <a :href="activeDoc" target="_blank" x-show="activeDoc !== ''"
                            class="bg-white/20 hover:bg-white/30 px-3 py-1 rounded text-xs transition">Buka Penuh</a>
                    </div>
                    <template x-if="activeDoc !== ''">
                        <iframe :src="activeDoc" class="w-full flex-grow rounded-b-xl border-none bg-white"></iframe>
                    </template>
                    <template x-if="activeDoc === ''">
                        <div class="w-full flex-grow rounded-b-xl border-none bg-white flex items-center justify-center text-gray-400">
                            Pilih dokumen dari daftar untuk melihat pratinjau.
                        </div>
                    </template>
                </div>

                <div data-aos="fade-left" class="w-full lg:w-2/5 bg-white rounded-2xl border border-gray-200 shadow-sm flex flex-col h-[600px]">
                    <div class="p-6 border-b border-gray-100 shrink-0">
                        <h3 class="font-bold text-lg text-gray-800">Ringkasan LRA</h3>
                        <p class="text-sm text-gray-500">Pilih dokumen untuk melihat isi.</p>
                    </div>
                    <div class="p-4 flex-grow overflow-y-auto doc-scroll space-y-3">
                        @forelse($lraDocs as $doc)
                            <button
                                @click="activeDoc = '{{ route('public.file', ['folder' => 'documents', 'filename' => basename($doc->file_path)]) }}'; activeTitle = '{{ addslashes($doc->title) }}'"
                                class="w-full text-left p-4 rounded-xl border border-gray-100 hover:border-dispora hover:bg-dispora/5 transition group flex items-center justify-between"
                                :class="activeTitle === '{{ addslashes($doc->title) }}' ? 'bg-dispora/10 border-dispora ring-1 ring-dispora' : 'bg-gray-50'">
                                <div class="flex items-center">
                                    <svg class="w-8 h-8 text-green-500 mr-4 group-hover:scale-110 transition shrink-0" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-1.218 19l-1.782-1.75 5.25-5.25-5.25-5.25 1.782-1.75 6.968 7-6.968 7z" />
                                    </svg>
                                    <div>
                                        <h4 class="font-bold text-gray-800">{{ $doc->title }}</h4>
                                        <p class="text-xs text-gray-500">{{ strtoupper($doc->file_type) }} Document • {{ $doc->file_size }}</p>
                                    </div>
                                </div>
                            </button>
                        @empty
                            <div class="text-center text-gray-500 p-4">Belum ada dokumen LRA yang dipublikasikan.</div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
