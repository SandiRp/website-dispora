<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Kelola Sosial Media</h2>
            <a href="{{ route('admin.social_medias.create') }}" class="bg-pink-600 hover:bg-pink-700 text-white font-bold py-2 px-4 rounded-lg text-sm">
                + Tambah Sosial Media
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
                                <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">No</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Platform</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Nama Akun</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">URL</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Class Icon</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Logo</th>
                                <th class="px-6 py-3 text-center text-xs font-bold text-gray-500 uppercase">Status</th>
                                <th class="px-6 py-3 text-center text-xs font-bold text-gray-500 uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-100">
                            @forelse($socialMedias as $i => $item)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 text-sm text-gray-500">{{ $socialMedias->firstItem() + $i }}</td>
                                <td class="px-6 py-4 font-semibold text-gray-800">{{ $item->platform }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $item->account_name }}</td>
                                <td class="px-6 py-4 text-sm">
                                    @if($item->url)
                                        <a href="{{ $item->url }}" target="_blank" class="text-blue-600 hover:underline text-xs truncate block max-w-[220px]">{{ $item->url }}</a>
                                    @else
                                        <span class="text-gray-400">-</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-xs text-gray-500 font-mono">{{ $item->icon_class ?? '-' }}</td>
                                <td class="px-6 py-4">
                                    @if($item->custom_logo_path)
                                        <img src="{{ Storage::url($item->custom_logo_path) }}" alt="Logo" class="w-10 h-10 object-contain rounded border border-gray-200 bg-gray-50">
                                    @else
                                        <span class="text-gray-400 text-xs">-</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <span class="{{ $item->is_active ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-500' }} text-xs font-bold px-2 py-1 rounded-full">
                                        {{ $item->is_active ? 'Aktif' : 'Nonaktif' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                    <a href="{{ route('admin.social_medias.edit', $item) }}" class="text-indigo-600 hover:text-indigo-900 text-sm font-medium mr-3">Edit</a>
                                    <form action="{{ route('admin.social_medias.destroy', $item) }}" method="POST" class="inline-block">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900 text-sm font-medium" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="px-6 py-12 text-center text-gray-400">Belum ada data sosial media. <a href="{{ route('admin.social_medias.create') }}" class="text-pink-600 hover:underline">Tambah sekarang</a></td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="px-6 py-4 border-t border-gray-100">{{ $socialMedias->links() }}</div>
            </div>
        </div>
    </div>
</x-app-layout>