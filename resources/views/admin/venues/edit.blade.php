<x-app-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white/70 backdrop-blur-xl overflow-hidden shadow-sm sm:rounded-2xl border border-white/20">
                <div class="p-8 text-gray-900">
                    <div class="flex items-center gap-4 mb-8">
                        <a href="{{ route('admin.venues.index') }}" class="p-2 text-gray-500 hover:text-gray-700 bg-gray-50 hover:bg-gray-100 rounded-xl transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                        </a>
                        <h2 class="text-2xl font-bold text-gray-800">Edit Venue: {{ $venue->name }}</h2>
                    </div>

                    <form action="{{ route('admin.venues.update', $venue->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        @method('PUT')
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="md:col-span-2">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Venue <span class="text-red-500">*</span></label>
                                <input type="text" name="name" value="{{ old('name', $venue->name) }}" required
                                    class="w-full rounded-xl border-gray-200 focus:border-teal-500 focus:ring focus:ring-teal-500/20 transition shadow-sm">
                                @error('name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>

                            <div class="md:col-span-2">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Foto / Gambar Venue</label>
                                @if($venue->image_path)
                                    <div class="mb-4">
                                        <p class="text-xs text-gray-500 mb-2">Gambar saat ini:</p>
                                        <div class="w-32 h-32 rounded-xl overflow-hidden border border-gray-200">
                                            <img src="{{ \App\Support\Media::url($venue->image_path) }}" alt="{{ $venue->name }}" class="w-full h-full object-cover">
                                        </div>
                                    </div>
                                @endif
                                <input type="file" name="image_path" accept="image/*"
                                    class="w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-teal-50 file:text-teal-700 hover:file:bg-teal-100 transition border border-gray-200 rounded-xl">
                                <p class="text-xs text-gray-500 mt-1">Kosongkan jika tidak ingin mengubah gambar.</p>
                                @error('image_path')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>

                            <div class="md:col-span-2">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi Singkat</label>
                                <textarea name="short_description" rows="2"
                                    class="w-full rounded-xl border-gray-200 focus:border-teal-500 focus:ring focus:ring-teal-500/20 transition shadow-sm">{{ old('short_description', $venue->short_description) }}</textarea>
                                @error('short_description')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>

                            <div class="md:col-span-2">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi Lengkap (Fasilitas, Jam Operasional, dll)</label>
                                <textarea name="description" rows="5"
                                    class="w-full rounded-xl border-gray-200 focus:border-teal-500 focus:ring focus:ring-teal-500/20 transition shadow-sm">{{ old('description', $venue->description) }}</textarea>
                                @error('description')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Nama PIC (Kontak Person)</label>
                                <input type="text" name="pic_name" value="{{ old('pic_name', $venue->pic_name) }}"
                                    class="w-full rounded-xl border-gray-200 focus:border-teal-500 focus:ring focus:ring-teal-500/20 transition shadow-sm">
                                @error('pic_name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">No. Telepon / WhatsApp PIC</label>
                                <input type="text" name="pic_phone" value="{{ old('pic_phone', $venue->pic_phone) }}" placeholder="Contoh: 628123456789"
                                    class="w-full rounded-xl border-gray-200 focus:border-teal-500 focus:ring focus:ring-teal-500/20 transition shadow-sm">
                                <p class="text-xs text-gray-500 mt-1">Gunakan kode negara (62) tanpa tanda + atau awalan 0.</p>
                                @error('pic_phone')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Urutan Tampil <span class="text-red-500">*</span></label>
                                <input type="number" name="order" value="{{ old('order', $venue->order) }}" required
                                    class="w-full rounded-xl border-gray-200 focus:border-teal-500 focus:ring focus:ring-teal-500/20 transition shadow-sm">
                                @error('order')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>

                            <div class="flex items-center mt-8">
                                <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $venue->is_active) ? 'checked' : '' }}
                                    class="rounded text-teal-600 focus:ring-teal-500 border-gray-300 w-5 h-5">
                                <label for="is_active" class="ml-3 text-sm font-medium text-gray-700">Aktif (Tampilkan di website)</label>
                            </div>
                        </div>

                        <div class="pt-6 border-t border-gray-100 flex justify-end">
                            <button type="submit" class="bg-gradient-to-r from-teal-500 to-teal-600 text-white px-8 py-2.5 rounded-xl font-semibold hover:from-teal-600 hover:to-teal-700 transition shadow-lg shadow-teal-500/30 flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                Perbarui Venue
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
