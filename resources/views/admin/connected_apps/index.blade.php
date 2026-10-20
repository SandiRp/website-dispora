<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Kelola Aplikasi Terhubung</h2>
            <a href="{{ route('admin.connected_apps.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg text-sm">
                + Tambah Aplikasi
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
                                <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">No</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Nama Aplikasi</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Deskripsi</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">URL</th>
                                <th class="px-6 py-3 text-center text-xs font-bold text-gray-500 uppercase tracking-wider">Urutan</th>
                                <th class="px-6 py-3 text-center text-xs font-bold text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-center text-xs font-bold text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-100">
                            @forelse($apps as $i => $item)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 text-sm text-gray-500">{{ $apps->firstItem() + $i }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        @if($item->logo_path)
                                            <img src="{{ \App\Support\Media::url($item->logo_path) }}" alt="{{ $item->name }}" class="w-9 h-9 rounded-lg object-contain border border-gray-200 p-1">
                                        @else
                                            <div class="w-9 h-9 bg-orange-100 rounded-lg flex items-center justify-center">
                                                <svg class="w-5 h-5 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3H5a2 2 0 00-2 2v4m6-6h10a2 2 0 012 2v4M9 3v18m0 0h10a2 2 0 002-2V9M9 21H5a2 2 0 01-2-2V9m0 0h18"/></svg>
                                            </div>
                                        @endif
                                        <span class="font-semibold text-gray-800 text-sm">{{ $item->name }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500 max-w-xs truncate">{{ $item->description ?? '-' }}</td>
                                <td class="px-6 py-4 text-sm">
                                    @if($item->url_link)
                                        <a href="{{ $item->url_link }}" target="_blank" class="text-blue-600 hover:underline text-xs truncate block max-w-[200px]">{{ $item->url_link }}</a>
                                    @else
                                        <span class="text-gray-400">-</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-center text-sm text-gray-600">{{ $item->order }}</td>
                                <td class="px-6 py-4 text-center">
                                    <span class="{{ $item->is_active ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-500' }} text-xs font-bold px-2 py-1 rounded-full">
                                        {{ $item->is_active ? 'Aktif' : 'Nonaktif' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                    <a href="{{ route('admin.connected_apps.edit', $item) }}" class="text-indigo-600 hover:text-indigo-900 text-sm font-medium mr-3">Edit</a>
                                    <form action="{{ route('admin.connected_apps.destroy', $item) }}" method="POST" class="inline-block">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900 text-sm font-medium" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="px-6 py-12 text-center text-gray-400">Belum ada data aplikasi. <a href="{{ route('admin.connected_apps.create') }}" class="text-blue-600 hover:underline">Tambah sekarang</a></td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="px-6 py-4 border-t border-gray-100">{{ $apps->links() }}</div>
            </div>
        </div>
    </div>
</x-app-layout>
