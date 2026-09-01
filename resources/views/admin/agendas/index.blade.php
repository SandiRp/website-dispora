<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Kelola Kegiatan') }}
            </h2>
            <a href="{{ route('admin.agendas.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Tambah Kegiatan
            </a>
        </div>
    </x-slot>

    <div class="py-12" x-data="{ 
        loaded: false,
    }" x-init="setTimeout(() => loaded = true, 500)">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 overflow-x-auto relative">
                    
                    <!-- Skeleton Loader -->
                    <div x-show="!loaded" class="animate-pulse space-y-4">
                        <div class="h-10 bg-gray-200 rounded w-full"></div>
                        <div class="h-10 bg-gray-200 rounded w-full"></div>
                        <div class="h-10 bg-gray-200 rounded w-full"></div>
                        <div class="h-10 bg-gray-200 rounded w-full"></div>
                    </div>

                    <table x-show="loaded" style="display: none;" class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3">Nama Kegiatan</th>
                                <th scope="col" class="px-6 py-3">Waktu Pelaksanaan</th>
                                <th scope="col" class="px-6 py-3">Lokasi</th>
                                <th scope="col" class="px-6 py-3">Status</th>
                                <th scope="col" class="px-6 py-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($agendas as $agenda)
                                <tr class="bg-white border-b hover:bg-gray-50">
                                    <td class="px-6 py-4 font-medium text-gray-900">{{ $agenda->title }}</td>
                                    <td class="px-6 py-4">
                                        {{ $agenda->start_date->format('d M Y, H:i') }}
                                        @if($agenda->end_date)
                                            - {{ $agenda->end_date->format('d M Y, H:i') }}
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">{{ $agenda->location }}</td>
                                    <td class="px-6 py-4">
                                        @php
                                            $statusColors = [
                                                'upcoming' => 'bg-blue-500',
                                                'ongoing' => 'bg-green-500',
                                                'completed' => 'bg-gray-500',
                                                'cancelled' => 'bg-red-500',
                                            ];
                                        @endphp
                                        <span class="px-2 py-1 rounded text-xs text-white {{ $statusColors[$agenda->status] }}">
                                            {{ ucfirst($agenda->status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 flex space-x-2 items-center">
                                        <a href="{{ route('admin.agendas.edit', $agenda) }}" title="Edit Kegiatan" class="p-2 text-blue-600 bg-blue-100 rounded hover:bg-blue-200 transition-colors">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                              <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                                            </svg>
                                        </a>
                                        <form id="delete-form-{{ $agenda->id }}" action="{{ route('admin.agendas.destroy', $agenda) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" onclick="confirmDelete('delete-form-{{ $agenda->id }}')" title="Hapus Kegiatan" class="p-2 text-red-600 bg-red-100 rounded hover:bg-red-200 transition-colors">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                  <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                </svg>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-4 text-center">Belum ada kegiatan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    
                    <div x-show="loaded" style="display: none;" class="mt-4">
                        {{ $agendas->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
