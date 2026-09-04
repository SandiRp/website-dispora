<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Kelola Pengumuman Pop-up</h2>
            <a href="{{ route('admin.announcements.create') }}" class="bg-teal-600 hover:bg-teal-700 text-white font-bold py-2 px-4 rounded-lg text-sm transition">
                + Tambah Pengumuman
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
                                <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Gambar</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Judul & Konten</th>
                                <th class="px-6 py-3 text-center text-xs font-bold text-gray-500 uppercase">Periode</th>
                                <th class="px-6 py-3 text-center text-xs font-bold text-gray-500 uppercase">Status</th>
                                <th class="px-6 py-3 text-center text-xs font-bold text-gray-500 uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-100">
                            @forelse($announcements as $item)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 text-sm font-semibold text-gray-500">{{ $item->order }}</td>
                                <td class="px-6 py-4">
                                    @if($item->image_path)
                                        <img src="{{ Storage::url($item->image_path) }}" alt="{{ $item->title }}" class="w-20 h-14 object-cover rounded-lg border border-gray-200">
                                    @else
                                        <div class="w-20 h-14 bg-gray-100 rounded-lg flex items-center justify-center border border-gray-200 text-gray-400 text-xs">No Image</div>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <div class="font-bold text-gray-900">{{ $item->title }}</div>
                                    <div class="text-sm text-gray-500 mt-1 line-clamp-2 max-w-sm">{{ $item->content }}</div>
                                    @if($item->button_text)
                                        <span class="text-xs text-blue-600 mt-1 inline-block">🔗 {{ $item->button_text }}</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-center text-xs text-gray-500">
                                    @if($item->start_date || $item->end_date)
                                        <div>{{ $item->start_date ? $item->start_date->format('d M Y') : '—' }}</div>
                                        <div class="text-gray-400">s/d</div>
                                        <div>{{ $item->end_date ? $item->end_date->format('d M Y') : 'Selamanya' }}</div>
                                    @else
                                        <span class="text-gray-400">Selalu tampil</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <span class="{{ $item->is_active ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600' }} text-xs font-bold px-3 py-1 rounded-full">
                                        {{ $item->is_active ? 'Aktif' : 'Tidak Aktif' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                    <a href="{{ route('admin.announcements.edit', $item) }}" class="text-indigo-600 hover:text-indigo-900 text-sm font-medium mr-3">Edit</a>
                                    <form action="{{ route('admin.announcements.destroy', $item) }}" method="POST" class="inline-block">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900 text-sm font-medium" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center text-gray-400">Belum ada pengumuman. <a href="{{ route('admin.announcements.create') }}" class="text-teal-600 hover:underline">Tambah sekarang</a></td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
