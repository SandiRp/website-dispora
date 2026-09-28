<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Kelola Logo Resmi</h2>
            <a href="{{ route('admin.official_logos.create') }}" class="bg-teal-600 hover:bg-teal-700 text-white font-bold py-2 px-4 rounded-lg text-sm transition">
                + Tambah Logo
            </a>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl">
                @if(session('success'))
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 px-6 py-4">{{ session('success') }}</div>
                @endif
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Urutan</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Preview</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Judul & Deskripsi</th>
                                <th class="px-6 py-3 text-center text-xs font-bold text-gray-500 uppercase">Status</th>
                                <th class="px-6 py-3 text-center text-xs font-bold text-gray-500 uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-100">
                            @forelse($logos as $logo)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 text-sm font-semibold text-gray-500">{{ $logo->order }}</td>
                                <td class="px-6 py-4">
                                    @if($logo->image_path)
                                        <div class="w-16 h-16 bg-gray-100 rounded-lg flex items-center justify-center p-2 border border-gray-200">
                                            <img src="{{ \App\Support\Media::url($logo->image_path) }}" alt="{{ $logo->title }}" class="max-h-full max-w-full object-contain">
                                        </div>
                                    @else
                                        <div class="w-16 h-16 bg-gray-100 rounded-lg flex items-center justify-center border border-gray-200 text-gray-400 text-xs text-center">No Image</div>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <div class="font-bold text-gray-900">{{ $logo->title }}</div>
                                    <div class="text-sm text-gray-500 mt-1 line-clamp-2 max-w-xs">{{ $logo->description }}</div>
                                    @if($logo->file_path)
                                        <a href="{{ \App\Support\Media::url($logo->file_path) }}" target="_blank" class="text-xs text-blue-600 hover:underline mt-2 inline-block">📄 File Tersedia</a>
                                    @else
                                        <p class="text-xs text-gray-500 mt-2">Berkas unduhan tidak tersedia.</p>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <span class="{{ $logo->is_active ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600' }} text-xs font-bold px-3 py-1 rounded-full">
                                        {{ $logo->is_active ? 'Aktif' : 'Tidak Aktif' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                    <a href="{{ route('admin.official_logos.edit', $logo) }}" class="text-indigo-600 hover:text-indigo-900 text-sm font-medium mr-3">Edit</a>
                                    <form action="{{ route('admin.official_logos.destroy', $logo) }}" method="POST" class="inline-block">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900 text-sm font-medium" onclick="return confirm('Yakin ingin menghapus logo ini?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center text-gray-400">Belum ada data logo. <a href="{{ route('admin.official_logos.create') }}" class="text-teal-600 hover:underline">Tambah sekarang</a></td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
