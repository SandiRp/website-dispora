<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white/70 backdrop-blur-xl overflow-hidden shadow-sm sm:rounded-2xl border border-white/20">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-teal-600 to-teal-400">
                            Kelola Venue
                        </h2>
                        <a href="{{ route('admin.venues.create') }}" class="bg-gradient-to-r from-teal-500 to-teal-600 text-white px-4 py-2 rounded-xl text-sm font-semibold hover:from-teal-600 hover:to-teal-700 transition shadow-lg shadow-teal-500/30 flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                            Tambah Venue
                        </a>
                    </div>

                    @if(session('success'))
                        <div class="mb-4 bg-teal-50 border-l-4 border-teal-500 p-4 rounded-r-lg">
                            <p class="text-teal-700 text-sm font-medium">{{ session('success') }}</p>
                        </div>
                    @endif

                    <div class="overflow-x-auto bg-white rounded-xl shadow-sm border border-gray-100">
                        <table class="w-full text-sm text-left text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50/50 border-b border-gray-100">
                                <tr>
                                    <th scope="col" class="px-6 py-4 rounded-tl-xl">Urutan</th>
                                    <th scope="col" class="px-6 py-4">Venue</th>
                                    <th scope="col" class="px-6 py-4">Status</th>
                                    <th scope="col" class="px-6 py-4 rounded-tr-xl text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($venues as $venue)
                                    <tr class="bg-white border-b border-gray-50 hover:bg-gray-50/50 transition">
                                        <td class="px-6 py-4 font-medium text-gray-900">{{ $venue->order }}</td>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-3">
                                                @if($venue->image_path)
                                                    <div class="w-10 h-10 rounded-lg bg-gray-100 flex items-center justify-center shrink-0 overflow-hidden border border-gray-200">
                                                        <img src="{{ Storage::url($venue->image_path) }}" class="w-full h-full object-cover">
                                                    </div>
                                                @endif
                                                <div>
                                                    <p class="font-semibold text-gray-800">{{ $venue->name }}</p>
                                                    <p class="text-xs text-gray-500">{{ Str::limit($venue->short_description, 50) }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            @if($venue->is_active)
                                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-green-50 text-green-700 border border-green-200">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span> Aktif
                                                </span>
                                            @else
                                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-gray-50 text-gray-600 border border-gray-200">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-gray-400"></span> Nonaktif
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 text-right">
                                            <div class="flex justify-end gap-2">
                                                <a href="{{ route('admin.venues.edit', $venue->id) }}" class="p-2 text-teal-600 bg-teal-50 rounded-lg hover:bg-teal-100 transition">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                                                </a>
                                                <form action="{{ route('admin.venues.destroy', $venue->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus venue ini?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="p-2 text-red-600 bg-red-50 rounded-lg hover:bg-red-100 transition">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-8 text-center text-gray-500">Belum ada data venue.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">
                        {{ $venues->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>