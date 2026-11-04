<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h2 class="font-bold text-2xl text-gray-800 leading-tight">Kelola Konten YOCO</h2>
                <p class="text-sm text-gray-500 mt-1">Kelola konten Sosialisasi, Advokasi, dan Marketing di halaman Yocopreneur</p>
            </div>
            <a href="{{ route('admin.yoco_contents.create') }}" class="inline-flex items-center gap-2 bg-teal-600 hover:bg-teal-700 text-white font-semibold py-2.5 px-4 rounded-xl text-sm shadow-sm transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Tambah Konten
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            <!-- Tabs Filter -->
            <div class="flex flex-wrap items-center gap-2 border-b border-gray-200 pb-3">
                <a href="{{ route('admin.yoco_contents.index') }}" 
                   class="px-4 py-2 rounded-lg text-sm font-semibold transition {{ empty($type) ? 'bg-teal-600 text-white shadow-sm' : 'bg-white text-gray-600 hover:bg-gray-100 border border-gray-200' }}">
                    Semua ({{ $counts['all'] }})
                </a>
                <a href="{{ route('admin.yoco_contents.index', ['type' => 'sosialisasi']) }}" 
                   class="px-4 py-2 rounded-lg text-sm font-semibold transition {{ $type === 'sosialisasi' ? 'bg-teal-600 text-white shadow-sm' : 'bg-white text-gray-600 hover:bg-gray-100 border border-gray-200' }}">
                    📣 Sosialisasi ({{ $counts['sosialisasi'] }})
                </a>
                <a href="{{ route('admin.yoco_contents.index', ['type' => 'advokasi']) }}" 
                   class="px-4 py-2 rounded-lg text-sm font-semibold transition {{ $type === 'advokasi' ? 'bg-teal-600 text-white shadow-sm' : 'bg-white text-gray-600 hover:bg-gray-100 border border-gray-200' }}">
                    🤝 Advokasi ({{ $counts['advokasi'] }})
                </a>
                <a href="{{ route('admin.yoco_contents.index', ['type' => 'marketing']) }}" 
                   class="px-4 py-2 rounded-lg text-sm font-semibold transition {{ $type === 'marketing' ? 'bg-teal-600 text-white shadow-sm' : 'bg-white text-gray-600 hover:bg-gray-100 border border-gray-200' }}">
                    📈 Marketing ({{ $counts['marketing'] }})
                </a>
            </div>

            <!-- Table Card -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50/80">
                            <tr>
                                <th class="px-6 py-3.5 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Urutan</th>
                                <th class="px-6 py-3.5 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Tipe</th>
                                <th class="px-6 py-3.5 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Gambar</th>
                                <th class="px-6 py-3.5 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Judul & Isi</th>
                                <th class="px-6 py-3.5 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Tombol Link</th>
                                <th class="px-6 py-3.5 text-center text-xs font-bold text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3.5 text-center text-xs font-bold text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 bg-white">
                            @forelse($contents as $content)
                                <tr class="hover:bg-gray-50/70 transition">
                                    <td class="px-6 py-4 text-sm font-semibold text-gray-500 whitespace-nowrap">
                                        #{{ $content->order }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($content->type === 'sosialisasi')
                                            <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-bold bg-blue-100 text-blue-700">
                                                📣 Sosialisasi
                                            </span>
                                        @elseif($content->type === 'advokasi')
                                            <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-bold bg-purple-100 text-purple-700">
                                                🤝 Advokasi
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-bold bg-amber-100 text-amber-800">
                                                📈 Marketing
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($content->image_path)
                                            <div class="w-16 h-16 rounded-xl overflow-hidden bg-gray-100 border border-gray-200">
                                                <img src="{{ \App\Support\Media::url($content->image_path) }}" alt="{{ $content->title }}" class="w-full h-full object-cover">
                                            </div>
                                        @else
                                            <div class="w-16 h-16 rounded-xl bg-gray-50 border border-dashed border-gray-300 flex items-center justify-center text-gray-400 text-[11px] text-center p-1">
                                                Placeholder
                                            </div>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="font-bold text-gray-900 text-base max-w-sm">{{ $content->title }}</div>
                                        <p class="text-xs text-gray-500 mt-1 line-clamp-2 max-w-md leading-relaxed">{{ $content->content }}</p>
                                    </td>
                                    <td class="px-6 py-4">
                                        @if($content->link_url)
                                            <a href="{{ $content->link_url }}" target="_blank" rel="noopener noreferrer" 
                                               class="inline-flex items-center gap-1 text-xs font-medium text-teal-700 bg-teal-50 hover:bg-teal-100 border border-teal-200 px-2.5 py-1 rounded-lg transition">
                                                <span>{{ $content->link_label ?: 'Selengkapnya' }}</span>
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                                            </a>
                                            <p class="text-[11px] text-gray-400 mt-1 truncate max-w-xs">{{ $content->link_url }}</p>
                                        @else
                                            <span class="text-xs text-gray-400 italic">Tanpa tautan</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-center whitespace-nowrap">
                                        <span class="inline-block px-3 py-1 rounded-full text-xs font-bold {{ $content->is_active ? 'bg-emerald-100 text-emerald-700' : 'bg-gray-100 text-gray-500' }}">
                                            {{ $content->is_active ? 'Aktif' : 'Nonaktif' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-center whitespace-nowrap">
                                        <div class="flex items-center justify-center gap-2">
                                            <a href="{{ route('admin.yoco_contents.edit', $content) }}" class="p-1.5 text-indigo-600 hover:text-indigo-900 hover:bg-indigo-50 rounded-lg transition" title="Edit">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                            </a>
                                            <form id="delete-form-{{ $content->id }}" action="{{ route('admin.yoco_contents.destroy', $content) }}" method="POST" class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" onclick="confirmDelete('delete-form-{{ $content->id }}')" class="p-1.5 text-red-600 hover:text-red-900 hover:bg-red-50 rounded-lg transition" title="Hapus">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-12 text-center text-gray-400">
                                        <div class="flex flex-col items-center justify-center">
                                            <svg class="w-12 h-12 text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/></svg>
                                            <p class="font-medium text-gray-500">Belum ada konten YOCO.</p>
                                            <a href="{{ route('admin.yoco_contents.create') }}" class="mt-2 text-sm text-teal-600 hover:underline">Tambah konten baru sekarang</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

