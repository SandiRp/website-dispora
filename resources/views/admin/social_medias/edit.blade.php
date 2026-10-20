<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Sosial Media') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @php $item = $socialMedia; @endphp
                    <form action="{{ route('admin.social_medias.update', $item) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label for="platform" class="block text-sm font-medium text-gray-700">Platform</label>
                            <input type="text" name="platform" id="platform" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" value="{{ old('platform', $item->platform) }}">
                        </div>
                        <div class="mb-4">
                            <label for="account_name" class="block text-sm font-medium text-gray-700">Nama Akun</label>
                            <input type="text" name="account_name" id="account_name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" value="{{ old('account_name', $item->account_name) }}">
                        </div>
                        <div class="mb-4">
                            <label for="url" class="block text-sm font-medium text-gray-700">URL Tautan</label>
                            <input type="url" name="url" id="url" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" value="{{ old('url', $item->url) }}" required>
                            @error('url') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-4">
                            <label for="icon_class" class="block text-sm font-medium text-gray-700">Pilih Ikon (Otomatis)</label>
                            <select name="icon_class" id="icon_class" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                <option value="">-- Gunakan Ikon Default (Link) --</option>
                                <option value="fa-brands fa-youtube" {{ old('icon_class', $item->icon_class) == 'fa-brands fa-youtube' ? 'selected' : '' }}>YouTube</option>
                                <option value="fa-brands fa-instagram" {{ old('icon_class', $item->icon_class) == 'fa-brands fa-instagram' ? 'selected' : '' }}>Instagram</option>
                                <option value="fa-brands fa-facebook" {{ old('icon_class', $item->icon_class) == 'fa-brands fa-facebook' ? 'selected' : '' }}>Facebook</option>
                                <option value="fa-brands fa-whatsapp" {{ old('icon_class', $item->icon_class) == 'fa-brands fa-whatsapp' ? 'selected' : '' }}>WhatsApp</option>
                            </select>
                            <p class="mt-1 text-xs text-gray-400">Ikon bawaan berdasarkan platform. Atau upload logo sendiri di bawah.</p>
                        </div>
                        <div class="mb-4">
                            <label for="custom_logo" class="block text-sm font-medium text-gray-700">Upload Logo Sendiri (Opsional)</label>
                            @if($item->custom_logo_path)
                                <div class="mt-2 mb-3 flex items-center gap-4">
                                    <img src="{{ Storage::url($item->custom_logo_path) }}" alt="Logo saat ini" class="w-16 h-16 object-contain rounded-lg border border-gray-200 bg-gray-50 p-1">
                                    <div>
                                        <p class="text-xs text-gray-500">Logo saat ini aktif</p>
                                        <label class="inline-flex items-center gap-2 mt-1 cursor-pointer">
                                            <input type="checkbox" name="remove_logo" value="1" class="rounded border-gray-300 text-red-600 focus:ring-red-500">
                                            <span class="text-xs text-red-600 font-medium">Hapus logo ini</span>
                                        </label>
                                    </div>
                                </div>
                            @endif
                            <input type="file" name="custom_logo" id="custom_logo" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" accept="image/*">
                            <p class="mt-1 text-xs text-gray-400">Format: JPG, PNG, SVG. Maksimal 2MB. Jika diupload, logo ini akan digunakan sebagai pengganti ikon bawaan.</p>
                            @error('custom_logo') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-4">
                            <label for="is_active" class="block text-sm font-medium text-gray-700">Aktif</label>
                            <input type="checkbox" name="is_active" id="is_active" class="mt-1" value="1" {{ old('is_active', $item->is_active) ? 'checked' : '' }}>
                        </div>
                        <div class="mb-6 flex justify-end">
                            <a href="{{ route('admin.social_medias.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2">Batal</a>
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>