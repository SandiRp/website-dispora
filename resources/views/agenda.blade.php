@extends('layouts.main')

@section('title', 'Daftar Agenda Kegiatan - Dispora Jatim')

@section('content')

    <!-- 1. HERO SECTION AGENDA -->
    <div class="relative bg-dispora-dark py-24 overflow-hidden">
        <div class="absolute inset-0 opacity-20">
            <img src="https://images.unsplash.com/photo-1540317580384-e5d43867caa6?q=80&w=2000&auto=format&fit=crop"
                class="w-full h-full object-cover" alt="Background Agenda">
        </div>
        <div class="absolute inset-0 bg-gradient-to-r from-dispora-dark to-transparent"></div>
        <div class="max-w-7xl mx-auto px-6 relative z-10" data-aos="zoom-in">
            <!-- <nav class="text-sm text-dispora-light mb-4 font-medium flex items-center">
                <a href="{{ url('/') }}" class="hover:text-white transition">Beranda</a>
                <span class="mx-2">/</span>
                <span class="text-white">Agenda Kegiatan</span>
            </nav> -->
            <h1 class="text-4xl md:text-5xl font-extrabold text-white mb-4 drop-shadow-lg">Jadwal Kegiatan</h1>
            <div class="w-20 h-1.5 bg-white rounded-full mb-6"></div>
            <p class="text-lg text-gray-200 max-w-2xl drop-shadow">Informasi dan jadwal kegiatan terbaru di lingkungan Dinas Kepemudaan dan Olahraga Provinsi Jawa Timur.</p>
        </div>
    </div>

    <!-- MAIN CONTENT -->
    <section class="py-12 bg-gray-50 min-h-screen relative">
        <div class="max-w-7xl mx-auto px-6 relative -mt-20 z-20">
            
            <!-- ALERT INFO BOX FLOATING -->
            <div data-aos="fade-up" class="bg-white/95 backdrop-blur-md border border-white rounded-2xl p-6 mb-12 shadow-xl flex flex-col md:flex-row items-center gap-6">
                <div class="w-16 h-16 bg-gradient-to-br from-dispora to-blue-600 text-white rounded-2xl flex items-center justify-center shrink-0 shadow-lg transform -rotate-3">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div class="text-gray-700 flex-1">
                    <h3 class="text-xl font-bold text-gray-900 mb-1">Panduan Mengikuti Kegiatan</h3>
                    <p class="text-sm">Silakan pilih kegiatan yang relevan. Klik tombol <span class="bg-dispora text-white px-2 py-0.5 rounded text-xs font-bold mx-1">Daftar</span> untuk registrasi Kegiatan, atau <span class="bg-gray-600 text-white px-2 py-0.5 rounded text-xs font-bold mx-1">Unduh</span> untuk mendapatkan materi / Dokumentasi kegiatan terkait.</p>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-10 items-start">
                
                <!-- KOLOM KIRI (Daftar Kegiatan) -->
                <div class="lg:col-span-2 space-y-6" id="agenda-list-container" style="transition: opacity 0.3s ease;">
                    
                    <!-- FILTER DAN PENCARIAN -->
                    <form method="GET" action="{{ url('/agenda') }}" class="flex flex-col md:flex-row justify-between items-center gap-4 mb-8" data-aos="fade-up">
                        <div class="flex flex-wrap gap-2 w-full md:w-auto">
                            <a href="{{ url('/agenda' . (request('search') ? '?search='.request('search') : '')) }}" class="px-5 py-2.5 {{ !request('status') ? 'bg-dispora text-white shadow-md' : 'bg-white text-gray-600 shadow-sm hover:bg-gray-50 border border-gray-200' }} text-sm font-bold rounded-full text-center flex-1 md:flex-none transition">Semua</a>
                            
                            <a href="{{ url('/agenda?status=akan_datang' . (request('search') ? '&search='.request('search') : '')) }}" class="px-5 py-2.5 {{ request('status') == 'akan_datang' ? 'bg-dispora text-white shadow-md' : 'bg-white text-gray-600 shadow-sm hover:bg-gray-50 border border-gray-200' }} text-sm font-bold rounded-full transition text-center flex-1 md:flex-none">Akan Datang</a>
                            
                            <a href="{{ url('/agenda?status=selesai' . (request('search') ? '&search='.request('search') : '')) }}" class="px-5 py-2.5 {{ request('status') == 'selesai' ? 'bg-dispora text-white shadow-md' : 'bg-white text-gray-600 shadow-sm hover:bg-gray-50 border border-gray-200' }} text-sm font-bold rounded-full transition text-center flex-1 md:flex-none">Selesai</a>
                            
                            @if(request('status'))
                                <input type="hidden" name="status" value="{{ request('status') }}">
                            @endif
                        </div>
                        <div class="relative w-full md:w-64">
                            <input type="text" name="search" value="{{ request('search') }}" class="w-full pl-10 pr-4 py-2.5 bg-white border border-gray-200 rounded-full text-sm focus:ring-2 focus:ring-dispora outline-none shadow-sm" placeholder="Cari kegiatan...">
                            <button type="submit" class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-dispora transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            </button>
                        </div>
                    </form>

                    <!-- KARTU AGENDA -->
                    @forelse ($agendas as $index => $agenda)
                        @php
                            $statusColors = [
                                'upcoming' => 'bg-green-100 text-green-700 border-green-200',
                                'ongoing' => 'bg-blue-100 text-blue-700 border-blue-200',
                                'completed' => 'bg-gray-100 text-gray-600 border-gray-200',
                                'cancelled' => 'bg-red-100 text-red-600 border-red-200',
                            ];
                            $statusLabels = [
                                'upcoming' => 'Akan Datang',
                                'ongoing' => 'Sedang Berlangsung',
                                'completed' => 'Selesai',
                                'cancelled' => 'Batal',
                            ];
                        @endphp
                        <div data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}" class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-lg transition group flex flex-col md:flex-row">
                            <!-- Kiri: Tanggal (Kalender) -->
                            <div class="w-full md:w-32 bg-gray-50 border-b md:border-b-0 md:border-r border-gray-100 flex flex-col items-center justify-center py-6 md:py-0 shrink-0 group-hover:bg-dispora transition-colors duration-300">
                                <span class="text-4xl font-black text-gray-800 group-hover:text-white transition">{{ $agenda->start_date->format('d') }}</span>
                                <span class="text-sm font-bold text-gray-500 uppercase tracking-wider group-hover:text-dispora-light transition">{{ $agenda->start_date->format('M Y') }}</span>
                            </div>
                            
                            <!-- Tengah: Info -->
                            <div class="p-6 flex-1">
                                <div class="flex justify-between items-start mb-2">
                                    <h3 class="text-xl font-bold text-gray-900 group-hover:text-dispora transition leading-tight">{{ $agenda->title }}</h3>
                                </div>
                                <div class="flex flex-wrap gap-4 text-sm text-gray-500 mt-4 font-medium">
                                    <span class="flex items-center"><svg class="w-4 h-4 mr-1.5 text-dispora" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>{{ $agenda->start_date->format('H.i') }} WIB</span>
                                    <span class="flex items-center"><svg class="w-4 h-4 mr-1.5 text-dispora" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>{{ $agenda->location }}</span>
                                </div>
                            </div>

                            <!-- Kanan: Status & Aksi -->
                            <div class="p-6 bg-gray-50/50 flex flex-row md:flex-col items-center md:items-end justify-between border-t md:border-t-0 md:border-l border-gray-100 shrink-0 gap-3 w-full md:w-auto">
                                <span class="{{ $statusColors[$agenda->status] }} border px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wide text-center">{{ $statusLabels[$agenda->status] }}</span>
                                <div class="mt-auto w-full md:w-auto flex flex-col gap-2">
                                    @if(in_array($agenda->status, ['upcoming', 'ongoing']))
                                        @if($agenda->link_url)
                                            <a href="{{ route('agenda.click', ['id' => $agenda->id, 'type' => 'daftar']) }}" target="_blank" class="bg-dispora hover:bg-dispora-dark text-white px-5 py-2 rounded-lg text-sm font-bold flex items-center transition shadow-sm justify-center w-full">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path></svg> Daftar
                                            </a>
                                        @else
                                            <span class="text-xs text-gray-400 font-medium italic text-center md:text-right w-full block">Kegiatan dilaksanakan Secara Offline</span>
                                        @endif
                                    @elseif($agenda->status === 'completed')
                                        @if($agenda->attachment_path)
                                            <a href="{{ route('agenda.click', ['id' => $agenda->id, 'type' => 'materi']) }}" target="_blank" class="bg-gray-800 hover:bg-black text-white px-5 py-2 rounded-lg text-sm font-bold flex items-center transition shadow-sm justify-center w-full">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg> Unduh
                                            </a>
                                        @else
                                            <span class="text-xs text-gray-400 font-medium italic text-center md:text-right w-full block">Tidak ada materi / Dokumentasi</span>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-12 text-center text-gray-500">
                            <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            <p class="text-lg">Belum ada agenda kegiatan saat ini.</p>
                        </div>
                    @endforelse

                    <!-- Pagination -->
                    <div class="mt-8">
                        {{ $agendas->links() }}
                    </div>
                </div>

                <!-- KOLOM KANAN (Sidebar) -->
                <div class="lg:col-span-1 space-y-6" data-aos="fade-left">
                    <!-- Widget 1: Kalender Interaktif (Visual Mockup) -->
                    <div class="bg-gradient-to-br from-dispora-dark to-dispora rounded-2xl shadow-lg border border-dispora p-6 text-white text-center relative overflow-hidden">
                        <div class="absolute -right-10 -top-10 w-32 h-32 bg-white/10 rounded-full blur-2xl"></div>
                        <div class="absolute -left-10 -bottom-10 w-32 h-32 bg-black/10 rounded-full blur-2xl"></div>
                        
                        <svg class="w-16 h-16 mx-auto mb-4 opacity-90 relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        <h4 class="font-bold text-xl mb-2 relative z-10">Simpan Jadwal Anda</h4>
                        <p class="text-dispora-light text-sm mb-6 relative z-10">Jangan lewatkan event penting. Integrasikan dengan Google Calendar.</p>
                        <button class="bg-white text-dispora-dark font-bold px-6 py-2.5 rounded-full w-full hover:bg-gray-100 transition shadow-md relative z-10">Sinkronisasi Kalender</button>
                    </div>

                    <!-- Widget 2: Materi Diunduh Terbanyak -->
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                        <div class="p-5 border-b border-gray-50 flex items-center">
                            <div class="w-8 h-8 bg-orange-100 text-orange-600 rounded-lg flex items-center justify-center mr-3">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                            </div>
                            <h4 class="font-bold text-gray-800 text-sm uppercase tracking-wider">Agenda Terpopuler</h4>
                        </div>
                        <div class="p-5">
                            @if(isset($popularAgendas) && $popularAgendas->count() > 0)
                            <ul class="space-y-4 text-sm">
                                @foreach($popularAgendas as $index => $popAgenda)
                                <li class="flex items-start group {{ $index > 0 ? 'border-t border-gray-50 pt-4' : '' }}">
                                    <div class="text-dispora font-black text-lg mr-4 mt-0.5 opacity-40 group-hover:opacity-100 transition">{{ $index + 1 }}</div>
                                    <div class="flex-1">
                                        <span class="block text-gray-700 font-medium">{{ $popAgenda->title }}</span>
                                        <span class="text-xs text-gray-400 mt-1 flex items-center"><svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg> {{ number_format($popAgenda->clicks_count) }} pendaftar/unduhan</span>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                            @else
                            <div class="text-center text-gray-400 py-4">
                                <p class="text-xs italic">Belum ada data populer</p>
                            </div>
                            @endif
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <!-- AJAX Script for Seamless Filtering & Searching -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const container = document.getElementById('agenda-list-container');
            if(!container) return;

            // Define the fetch function
            function fetchAgenda(url) {
                // Visual feedback (fade out slightly)
                container.style.opacity = '0.4';

                fetch(url, {
                    headers: { 'X-Requested-With': 'XMLHttpRequest' }
                })
                .then(response => response.text())
                .then(html => {
                    // Parse the returned HTML
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(html, 'text/html');
                    
                    // Extract the new container content
                    const newContainer = doc.getElementById('agenda-list-container');
                    if (newContainer) {
                        container.innerHTML = newContainer.innerHTML;
                        
                        // Restore opacity
                        container.style.opacity = '1';

                        // Re-initialize AOS animations so the new items fade in properly
                        if (typeof AOS !== 'undefined') {
                            // Delay slightly to ensure DOM is fully updated
                            setTimeout(() => {
                                AOS.refreshHard();
                            }, 50);
                        }

                        // Update the browser's URL bar without reloading the page
                        window.history.pushState({}, '', url);
                    }
                })
                .catch(error => {
                    console.error('Error fetching agenda:', error);
                    container.style.opacity = '1';
                });
            }

            // 1. Intercept Link Clicks (Filter Tabs & Pagination)
            container.addEventListener('click', function(e) {
                const link = e.target.closest('a');
                // Only intercept links that go to /agenda and don't open in a new tab (like download links)
                if (link && link.href && link.href.includes('/agenda') && !link.hasAttribute('target')) {
                    e.preventDefault();
                    fetchAgenda(link.href);
                }
            });

            // 2. Intercept Form Submit (Search Input)
            container.addEventListener('submit', function(e) {
                const form = e.target.closest('form');
                if (form) {
                    e.preventDefault();
                    const url = new URL(form.action);
                    const formData = new FormData(form);
                    const searchParams = new URLSearchParams(formData);
                    url.search = searchParams.toString();
                    fetchAgenda(url.toString());
                }
            });

            // 3. Optional: Intercept "Enter" key on search input specifically
            let typingTimer;
            container.addEventListener('input', function(e) {
                if (e.target.name === 'search') {
                    clearTimeout(typingTimer);
                    typingTimer = setTimeout(() => {
                        const form = e.target.closest('form');
                        if(form) {
                            // Programmatically dispatch submit event
                            form.dispatchEvent(new Event('submit', { cancelable: true, bubbles: true }));
                        }
                    }, 500); // 500ms debounce
                }
            });
        });
    </script>
@endsection
