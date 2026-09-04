<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Kelola Data SKM</h2>
            <a href="{{ route('admin.skm_data.create') }}" class="bg-teal-600 hover:bg-teal-700 text-white font-bold py-2 px-4 rounded-lg text-sm">
                + Tambah Data SKM
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
                                <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Tahun</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Periode</th>
                                <th class="px-6 py-3 text-center text-xs font-bold text-gray-500 uppercase">Nilai Indeks</th>
                                <th class="px-6 py-3 text-center text-xs font-bold text-gray-500 uppercase">Mutu</th>
                                <th class="px-6 py-3 text-center text-xs font-bold text-gray-500 uppercase">Dokumen</th>
                                <th class="px-6 py-3 text-center text-xs font-bold text-gray-500 uppercase">Status</th>
                                <th class="px-6 py-3 text-center text-xs font-bold text-gray-500 uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-100">
                            @forelse($skmData as $i => $item)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 text-sm text-gray-500">{{ $skmData->firstItem() + $i }}</td>
                                <td class="px-6 py-4 font-semibold text-gray-800">{{ $item->year }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $item->period }}</td>
                                <td class="px-6 py-4 text-center">
                                    <span class="text-2xl font-black text-teal-600">{{ number_format($item->index_value, 2) }}</span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <span class="bg-teal-100 text-teal-700 text-xs font-bold px-3 py-1 rounded-full">{{ $item->category }}</span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    @if($item->document_path)
                                        <a href="{{ Storage::url($item->document_path) }}" target="_blank" class="text-blue-600 hover:underline text-xs font-medium">📄 Lihat PDF</a>
                                    @else
                                        <span class="text-gray-400 text-xs">-</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <span class="{{ $item->is_published ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }} text-xs font-bold px-2 py-1 rounded-full mb-1 inline-block">
                                        {{ $item->is_published ? 'Dipublikasikan' : 'Draft' }}
                                    </span>
                                    @if($item->is_active)
                                    <span class="bg-dispora-100 text-dispora-700 text-[10px] font-bold px-2 py-0.5 rounded-full block mx-auto w-max mt-1 border border-dispora-200">
                                        Aktif
                                    </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                    <a href="{{ route('admin.skm_data.edit', $item) }}" class="text-indigo-600 hover:text-indigo-900 text-sm font-medium mr-3">Edit</a>
                                    <form action="{{ route('admin.skm_data.destroy', $item) }}" method="POST" class="inline-block">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900 text-sm font-medium" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="px-6 py-12 text-center text-gray-400">Belum ada data SKM. <a href="{{ route('admin.skm_data.create') }}" class="text-teal-600 hover:underline">Tambah sekarang</a></td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="px-6 py-4 border-t border-gray-100">{{ $skmData->links() }}</div>
            </div>
        </div>
    </div>
</x-app-layout>