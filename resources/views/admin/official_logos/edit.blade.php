<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Logo Resmi</h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl">
                <div class="p-8">
                    <form action="{{ route('admin.official_logos.update', $officialLogo) }}" method="POST" enctype="multipart/form-data">
                        @csrf @method('PUT')
                        <div class="grid grid-cols-1 gap-6">
                            <div>
                                <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Judul Logo <span class="text-red-500">*</span></label>
                                <input type="text" name="title" id="title" class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500 sm:text-sm" value="{{ old('title', $officialLogo->title) }}" required>
                                @error('title')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>
                            
                            <div>
                                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                                <textarea name="description" id="description" rows="3" class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500 sm:text-sm">{{ old('description', $officialLogo->description) }}</textarea>
                                @error('description')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="image_path" class="block text-sm font-medium text-gray-700 mb-1">Gambar Preview (Ikon)</label>
                                    @if($officialLogo->image_path)
                                        <div class="mb-3 p-2 border rounded-lg inline-block bg-gray-50">
                                            <img src="{{ \App\Support\Media::url($officialLogo->image_path) }}" alt="Preview" class="h-16 w-auto object-contain">
                                        </div>
                                    @endif
                                    <input type="file" name="image_path" id="image_path" accept="image/*" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-teal-50 file:text-teal-700 hover:file:bg-teal-100">
                                    <p class="text-xs text-gray-400 mt-1">Kosongkan jika tidak ingin mengubah.</p>
                                    @error('image_path')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                                </div>
                                <div>
                                    <label for="file_path" class="block text-sm font-medium text-gray-700 mb-1">File Unduhan</label>
                                    @if($officialLogo->file_path)
                                        <div class="mb-3 text-sm">
                                            <a href="{{ \App\Support\Media::url($officialLogo->file_path) }}" target="_blank" class="text-blue-600 hover:underline">📄 Lihat File Saat Ini</a>
                                        </div>
                                    @else
                                        <p class="mb-2 text-sm text-gray-500">Berkas unduhan tidak tersedia.</p>
                                    @endif
                                    <input type="file" name="file_path" id="file_path" accept=".png,.jpg,.jpeg" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                                    <p class="text-xs text-gray-400 mt-1">Kosongkan jika tidak ingin mengubah.</p>
                                    @error('file_path')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="order" class="block text-sm font-medium text-gray-700 mb-1">Urutan Tampil</label>
                                    <input type="number" name="order" id="order" class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500 sm:text-sm" value="{{ old('order', $officialLogo->order) }}">
                                </div>
                            </div>
                        </div>

                        <div class="mt-6 flex items-center gap-3">
                            <input type="checkbox" name="is_active" id="is_active" class="rounded border-gray-300 text-teal-600 focus:ring-teal-500" value="1" {{ old('is_active', $officialLogo->is_active) ? 'checked' : '' }}>
                            <label for="is_active" class="text-sm font-medium text-gray-700">Aktifkan (Tampilkan di website)</label>
                        </div>

                        <div class="mt-8 flex justify-end gap-3">
                            <a href="{{ route('admin.official_logos.index') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold py-2 px-5 rounded-lg text-sm">Batal</a>
                            <button type="submit" class="bg-teal-600 hover:bg-teal-700 text-white font-semibold py-2 px-5 rounded-lg text-sm">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
