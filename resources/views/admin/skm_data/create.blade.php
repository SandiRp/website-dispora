<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Tambah Data SKM</h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl">
                <div class="p-8">
                    <form action="{{ route('admin.skm_data.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="year" class="block text-sm font-medium text-gray-700 mb-1">Tahun <span class="text-red-500">*</span></label>
                                <input type="number" name="year" id="year" class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500 sm:text-sm" value="{{ old('year', date('Y')) }}" required>
                                @error('year')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label for="period" class="block text-sm font-medium text-gray-700 mb-1">Periode <span class="text-red-500">*</span></label>
                                <input type="text" name="period" id="period" class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500 sm:text-sm" value="{{ old('period') }}" placeholder="cth: Semester I, Triwulan II" required>
                                @error('period')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label for="index_value" class="block text-sm font-medium text-gray-700 mb-1">Nilai Indeks <span class="text-red-500">*</span></label>
                                <input type="number" step="0.01" min="0" max="100" name="index_value" id="index_value" class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500 sm:text-sm" value="{{ old('index_value') }}" placeholder="cth: 88.75" required>
                                @error('index_value')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Kategori (Mutu) <span class="text-red-500">*</span></label>
                                <input type="text" name="category" id="category" class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500 sm:text-sm" value="{{ old('category') }}" placeholder="cth: A (Sangat Baik)" required>
                                @error('category')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>
                        </div>

                        <div class="mt-6">
                            <label for="document_path" class="block text-sm font-medium text-gray-700 mb-1">Dokumen Laporan PDF (Opsional)</label>
                            <input type="file" name="document_path" id="document_path" accept=".pdf" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-teal-50 file:text-teal-700 hover:file:bg-teal-100">
                            <p class="text-xs text-gray-400 mt-1">Maks. 10 MB, format PDF</p>
                            @error('document_path')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div class="mt-6 flex flex-col gap-3">
                            <div class="flex items-center gap-3">
                                <input type="checkbox" name="is_published" id="is_published" class="rounded border-gray-300 text-teal-600 focus:ring-teal-500" value="1" {{ old('is_published', true) ? 'checked' : '' }}>
                                <label for="is_published" class="text-sm font-medium text-gray-700">Publikasikan data ini (muncul di daftar riwayat modal)</label>
                            </div>
                            <div class="flex items-center gap-3">
                                <input type="checkbox" name="is_active" id="is_active" class="rounded border-gray-300 text-dispora-600 focus:ring-dispora-500" value="1" {{ old('is_active') ? 'checked' : '' }}>
                                <label for="is_active" class="text-sm font-medium text-gray-700">Jadikan Aktif (Ditampilkan paling menonjol di beranda)</label>
                            </div>
                        </div>

                        <div class="mt-8 flex justify-end gap-3">
                            <a href="{{ route('admin.skm_data.index') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold py-2 px-5 rounded-lg text-sm">Batal</a>
                            <button type="submit" class="bg-teal-600 hover:bg-teal-700 text-white font-semibold py-2 px-5 rounded-lg text-sm">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>