<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-bold text-2xl text-gray-800 leading-tight">Tambah Konten YOCO</h2>
                <p class="text-sm text-gray-500 mt-1">Tambahkan item baru untuk section Sosialisasi, Advokasi, atau Marketing</p>
            </div>
            <a href="{{ route('admin.yoco_contents.index') }}" class="text-sm font-semibold text-gray-600 hover:text-gray-900 bg-white border border-gray-200 px-4 py-2 rounded-xl hover:bg-gray-50 transition">
                ← Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-8">
                    <form action="{{ route('admin.yoco_contents.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="space-y-6">
                            <!-- Jenis Konten -->
                            <div>
                                <label for="type" class="block text-sm font-semibold text-gray-700 mb-1">
                                    Jenis / Section <span class="text-red-500">*</span>
                                </label>
                                <select name="type" id="type" class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500 text-sm" required>
                                    <option value="">-- Pilih Jenis Konten --</option>
                                    @foreach($types as $key => $label)
                                        <option value="{{ $key }}" {{ old('type', request('type')) === $key ? 'selected' : '' }}>
                                            {{ $label }}
                                        </option>
                                    @endforeach
                                </select>
                                <p class="text-xs text-gray-400 mt-1">Konten akan otomatis tampil pada section yang bersangkutan di halaman Yocopreneur.</p>
                                @error('type')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>

                            <!-- Judul -->
                            <div>
                                <label for="title" class="block text-sm font-semibold text-gray-700 mb-1">
                                    Judul <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="title" id="title" class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500 text-sm" value="{{ old('title') }}" placeholder="Contoh: Sosialisasi Kewirausahaan Pemuda" required>
                                @error('title')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>

                            <!-- Isi Konten -->
                            <div>
                                <label for="content" class="block text-sm font-semibold text-gray-700 mb-1">
                                    Isi Konten / Deskripsi <span class="text-red-500">*</span>
                                </label>
                                <textarea name="content" id="content" rows="4" class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500 text-sm" placeholder="Tuliskan uraian atau deskripsi program..." required>{{ old('content') }}</textarea>
                                @error('content')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>

                            <!-- Gambar / Foto -->
                            <div>
                                <label for="image_path" class="block text-sm font-semibold text-gray-700 mb-1">
                                    Gambar / Foto
                                </label>
                                <input type="file" name="image_path" id="image_path" accept="image/*" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-teal-50 file:text-teal-700 hover:file:bg-teal-100 transition">
                                <p class="text-xs text-gray-400 mt-1">Opsional (JPG/PNG/WEBP maks 5MB). Jika dikosongkan, halaman akan menggunakan ilustrasi / gambar placeholder.</p>
                                @error('image_path')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>

                            <!-- Link dan Tombol -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 p-4 bg-gray-50/70 rounded-xl border border-gray-200/70">
                                <div>
                                    <label for="link_url" class="block text-sm font-semibold text-gray-700 mb-1">
                                        URL Link
                                    </label>
                                    <input type="url" name="link_url" id="link_url" class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500 text-sm bg-white" value="{{ old('link_url') }}" placeholder="https://contoh.com/form">
                                    <p class="text-[11px] text-gray-400 mt-1">Tombol hanya akan muncul jika link ini diisi.</p>
                                    @error('link_url')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                                </div>
                                <div>
                                    <label for="link_label" class="block text-sm font-semibold text-gray-700 mb-1">
                                        Teks Tombol
                                    </label>
                                    <input type="text" name="link_label" id="link_label" class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500 text-sm bg-white" value="{{ old('link_label', 'Selengkapnya') }}" placeholder="Contoh: Selengkapnya">
                                    <p class="text-[11px] text-gray-400 mt-1">Label tombol (default: Selengkapnya)</p>
                                    @error('link_label')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                                </div>
                            </div>

                            <!-- Urutan & Status Aktif -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-center">
                                <div>
                                    <label for="order" class="block text-sm font-semibold text-gray-700 mb-1">
                                        Urutan Tampil
                                    </label>
                                    <input type="number" name="order" id="order" class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500 text-sm" value="{{ old('order', 0) }}">
                                    <p class="text-xs text-gray-400 mt-1">Angka lebih kecil akan tampil terlebih dahulu.</p>
                                    @error('order')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                                </div>
                                <div class="pt-2 md:pt-6">
                                    <label class="inline-flex items-center gap-3 cursor-pointer">
                                        <input type="checkbox" name="is_active" id="is_active" class="rounded-lg border-gray-300 text-teal-600 focus:ring-teal-500 w-5 h-5" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                                        <span class="text-sm font-medium text-gray-700">Tampilkan di website (Aktif)</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="mt-8 pt-6 border-t border-gray-100 flex items-center justify-end gap-3">
                            <a href="{{ route('admin.yoco_contents.index') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold py-2.5 px-5 rounded-xl text-sm transition">
                                Batal
                            </a>
                            <button type="submit" class="bg-teal-600 hover:bg-teal-700 text-white font-semibold py-2.5 px-6 rounded-xl text-sm shadow-sm transition">
                                Simpan Konten
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

