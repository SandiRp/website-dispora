@extends('layouts.main')

@section('title', 'Yocopreneur - Dispora Jatim')
@section('meta_description', 'Yocopreneur: pengembangan wirausaha muda Jawa Timur melalui sosialisasi, advokasi, dan marketing sektor publik berbasis Koperasi Multi Pihak Digital.')

@section('content')
<!-- Hero Section / Banner Utama YOCO -->
<section class="relative w-full overflow-hidden bg-white">
    <div class="w-full">
        <img src="{{ asset('images/yocoawal.png') }}" 
             alt="Yocopreneur - Ekosistem Digital Kewirausahaan Pemuda" 
             class="w-full h-auto block select-none">
    </div>
</section>

<!-- Tentang Section (Komprehensif & Berbasis Warna Blueprint YOCOPRENEUR) -->
<section id="tentang" class="py-24 bg-white relative overflow-hidden">
    <!-- Subtle Background Elements Sesuai Warna YOCO (Navy & Green Soft) -->
    <div class="absolute top-0 right-0 -mr-24 -mt-24 w-96 h-96 bg-[#0c3672]/5 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-0 left-0 -ml-24 -mb-24 w-96 h-96 bg-[#16a34a]/5 rounded-full blur-3xl pointer-events-none"></div>

    <div class="relative mx-auto max-w-7xl px-6">
        
        <!-- 1. Header Pengenalan (Full Width) -->
        <div class="w-full" data-aos="fade-up">
            <!-- <span class="inline-flex items-center gap-2 rounded-full bg-[#f0fdf4] border border-[#bbf7d0] px-4 py-1.5 text-xs font-black uppercase tracking-widest text-[#15803d]">
                <span class="w-2 h-2 rounded-full bg-[#16a34a] animate-pulse"></span>
                Ekosistem Digital Kewirausahaan Pemuda
            </span> -->
            <h2 class="mt-4 text-4xl sm:text-5xl lg:text-6xl font-black tracking-tight text-[#0c3672] leading-tight">
                Menghubungkan Ide, Inkubasi, dan Pasar Menuju Kemandirian Pemuda
            </h2>
            <p class="mt-6 text-lg sm:text-xl leading-relaxed text-gray-600">
                <strong class="text-[#0c3672] font-black">YOCOPRENEUR</strong> <em>(Youth Cooperative Entrepreneur)</em> adalah program terobosan Dinas Kepemudaan dan Olahraga Provinsi Jawa Timur untuk mengatasi fenomena <em>post-training trap</em>. Kami menghadirkan ekosistem pendampingan hulu-ke-hilir berbasis <strong class="text-[#15803d] font-bold">Koperasi Multi Pihak (KMP) Digital</strong> dan kolaborasi terpadu <strong class="text-[#0c3672] font-bold">Pentahelix</strong>.
            </p>
        </div>

        <!-- 2. Barometer Tantangan Pemuda Jawa Timur (Statistik Riil Navy-Cyan Palette) -->
        <div class="mt-14" data-aos="fade-up" data-aos-delay="100">
            <div class="rounded-3xl bg-gradient-to-br from-[#081d36] via-[#0c2b50] to-[#07192f] p-8 sm:p-10 text-white shadow-xl relative overflow-hidden border border-[#1e4976]">
                <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_right,rgba(56,189,248,0.15),transparent_50%)] pointer-events-none"></div>

                <div class="relative flex flex-col lg:flex-row lg:items-center justify-between gap-8 pb-8 border-b border-white/10">
                    <div>
                        <span class="text-xs font-bold uppercase tracking-widest text-[#38bdf8]">Data & Indikator Kunci</span>
                        <h3 class="text-2xl sm:text-3xl font-black text-white mt-1">Tantangan Ketenagakerjaan & Wirausaha Pemuda</h3>
                        <p class="text-sm text-white/70 mt-1 max-w-xl">Kondisi riil pemuda Jawa Timur yang melandasi urgensi integrasi ekosistem kewirausahaan.</p>
                    </div>
                </div>

                <div class="relative grid grid-cols-1 md:grid-cols-3 gap-6 pt-8">
                    <!-- Stat 1: TPT Pemuda (Ocean Blue Sesuai PDF) -->
                    <div class="rounded-2xl bg-white/5 border border-white/10 p-6 backdrop-blur-sm transition hover:bg-white/10">
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-extrabold uppercase tracking-wider text-rose-300 bg-rose-500/20 px-2.5 py-1 rounded-md">Tantangan Kerja</span>
                        </div>
                        <div class="mt-4 text-4xl sm:text-5xl font-black text-white tracking-tight">9,26<span class="text-2xl text-[#38bdf8]">%</span></div>
                        <h4 class="mt-2 text-base font-bold text-white">TPT Pemuda Jawa Timur</h4>
                        <p class="mt-1 text-xs text-white/70 leading-relaxed">Tingkat Pengangguran Terbuka usia muda yang membutuhkan akselerasi penciptaan lapangan kerja mandiri.</p>
                    </div>

                    <!-- Stat 2: Pemuda NEET (Amber/Coral Sesuai PDF) -->
                    <div class="rounded-2xl bg-white/5 border border-white/10 p-6 backdrop-blur-sm transition hover:bg-white/10">
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-extrabold uppercase tracking-wider text-amber-300 bg-amber-500/20 px-2.5 py-1 rounded-md">Potensi Belum Terserap</span>
                        </div>
                        <div class="mt-4 text-4xl sm:text-5xl font-black text-white tracking-tight">20,13<span class="text-2xl text-[#38bdf8]">%</span></div>
                        <h4 class="mt-2 text-base font-bold text-white">Pemuda Status NEET</h4>
                        <p class="mt-1 text-xs text-white/70 leading-relaxed">Pemuda usia produktif yang belum terserap di dunia pendidikan, pekerjaan, maupun pelatihan formal.</p>
                    </div>

                    <!-- Stat 3: Rasio Wirausaha (Green Sesuai Target PDF) -->
                    <div class="rounded-2xl bg-white/5 border border-white/10 p-6 backdrop-blur-sm transition hover:bg-white/10">
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-extrabold uppercase tracking-wider text-emerald-300 bg-emerald-500/20 px-2.5 py-1 rounded-md">Target Akselerasi</span>
                        </div>
                        <div class="mt-4 text-4xl sm:text-5xl font-black text-white tracking-tight">0,81<span class="text-2xl text-[#4ade80]">%</span></div>
                        <h4 class="mt-2 text-base font-bold text-white">Rasio Wirausaha Pemuda</h4>
                        <p class="mt-1 text-xs text-white/70 leading-relaxed">Peluang besar peningkatan rasio wirausaha pemuda yang ditargetkan melampaui <strong>> 1,00%</strong>.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- 3. Solusi Terpilih: 4 Pilar Strategi Penyelesaian Masalah (Warna Asli PDF Bab 2) -->
        <div class="mt-20">
            <div class="text-center max-w-2xl mx-auto" data-aos="fade-up">
                <span class="text-xs font-black uppercase tracking-widest text-[#15803d]">Terobosan Berkelanjutan</span>
                <h3 class="mt-2 text-3xl sm:text-4xl font-black text-[#0c3672]">4 Strategi Penyelesaian Masalah</h3>
                <p class="mt-3 text-base text-gray-600">Berdasarkan Analisis Eightfold Path dan Metode USG, Ekosistem Terintegrasi YOCOPRENEUR terpilih dengan skor tertinggi (15) untuk menghadirkan dampak nyata.</p>
            </div>

            <div class="mt-12 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                <!-- Strategi 1: Penguatan Regulasi (Hijau Sesuai PDF) -->
                <div class="rounded-3xl border border-[#bbf7d0] bg-gradient-to-b from-white to-[#f0fdf4]/50 p-7 shadow-sm transition-all duration-300 hover:shadow-xl hover:border-[#16a34a] flex flex-col justify-between" data-aos="fade-up" data-aos-delay="50">
                    <div>
                        <div class="w-12 h-12 rounded-2xl bg-[#dcfce7] text-[#15803d] flex items-center justify-center text-xl font-black mb-5 shadow-sm">
                            01
                        </div>
                        <h4 class="text-xl font-black text-[#0c3672] leading-snug">Penguatan Regulasi</h4>
                        <p class="mt-3 text-sm text-gray-600 leading-relaxed">
                            Penyusunan Ranperda Kepemudaan, Pergub RAD Pelayanan Kepemudaan, serta penguatan koordinasi lintas OPD untuk landasan hukum yang kokoh.
                        </p>
                    </div>
                    <div class="mt-6 pt-4 border-t border-[#bbf7d0]/60 flex items-center gap-2 text-xs font-bold text-[#15803d]">
                        <span>Kepastian Hukum & Tata Kelola</span>
                    </div>
                </div>

                <!-- Strategi 2: Kesepakatan Pentahelix (Biru Navy Sesuai PDF) -->
                <div class="rounded-3xl border border-[#bfdbfe] bg-gradient-to-b from-white to-[#f0f9ff]/50 p-7 shadow-sm transition-all duration-300 hover:shadow-xl hover:border-[#0284c7] flex flex-col justify-between" data-aos="fade-up" data-aos-delay="100">
                    <div>
                        <div class="w-12 h-12 rounded-2xl bg-[#dbeafe] text-[#0c3672] flex items-center justify-center text-xl font-black mb-5 shadow-sm">
                            02
                        </div>
                        <h4 class="text-xl font-black text-[#0c3672] leading-snug">Kesepakatan Pentahelix</h4>
                        <p class="mt-3 text-sm text-gray-600 leading-relaxed">
                            MoU dan Perjanjian Kerja Sama (PKS) terpadu dengan akademisi, perbankan, asosiasi dunia usaha (KADIN), media, dan komunitas kreatif.
                        </p>
                    </div>
                    <div class="mt-6 pt-4 border-t border-[#bfdbfe]/60 flex items-center gap-2 text-xs font-bold text-[#0c3672]">
                        <span>Sinergi Multi-Pihak</span>
                    </div>
                </div>

                <!-- Strategi 3: KMP Digital Terpadu (Oranye Sesuai PDF) -->
                <div class="rounded-3xl border border-[#fed7aa] bg-gradient-to-b from-white to-[#fffaf5] p-7 shadow-sm transition-all duration-300 hover:shadow-xl hover:border-[#ea580c] flex flex-col justify-between" data-aos="fade-up" data-aos-delay="150">
                    <div>
                        <div class="w-12 h-12 rounded-2xl bg-[#ffedd5] text-[#ea580c] flex items-center justify-center text-xl font-black mb-5 shadow-sm">
                            03
                        </div>
                        <h4 class="text-xl font-black text-[#0c3672] leading-snug">KMP Digital Terpadu</h4>
                        <p class="mt-3 text-sm text-gray-600 leading-relaxed">
                            Koperasi Multi Pihak (KMP) sebagai kelembagaan ekonomi bersama dan platform digital untuk agregasi pasar, pembiayaan, dan mentoring.
                        </p>
                    </div>
                    <div class="mt-6 pt-4 border-t border-[#fed7aa]/60 flex items-center gap-2 text-xs font-bold text-[#ea580c]">
                        <span>Kelembagaan Ekonomi Pemuda</span>
                    </div>
                </div>

                <!-- Strategi 4: Literasi Berbasis AI (Ungu/Indigo Sesuai PDF) -->
                <div class="rounded-3xl border border-[#e9d5ff] bg-gradient-to-b from-white to-[#faf5ff] p-7 shadow-sm transition-all duration-300 hover:shadow-xl hover:border-[#9333ea] flex flex-col justify-between" data-aos="fade-up" data-aos-delay="200">
                    <div>
                        <div class="w-12 h-12 rounded-2xl bg-[#f3e8ff] text-[#7e22ce] flex items-center justify-center text-xl font-black mb-5 shadow-sm">
                            04
                        </div>
                        <h4 class="text-xl font-black text-[#0c3672] leading-snug">Literasi Berbasis AI</h4>
                        <p class="mt-3 text-sm text-gray-600 leading-relaxed">
                            Asisten pintar digital berbasis AI (WhatsApp & Chatbot) untuk konsultasi bisnis, pembukuan keuangan, sertifikasi, dan pembelajaran adaptif 24/7.
                        </p>
                    </div>
                    <div class="mt-6 pt-4 border-t border-[#e9d5ff]/60 flex items-center gap-2 text-xs font-bold text-[#7e22ce]">
                        <span>Asisten Pintar Usaha 24/7</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- 4. Alur Pendampingan Hulu ke Hilir (Dari Ide Menuju Tumbuh Berkelanjutan) -->
        <div class="mt-20 rounded-3xl bg-[#f8fafc] border border-[#e2e8f0] p-8 sm:p-12 shadow-sm" data-aos="fade-up">
            <div class="max-w-2xl">
                <span class="text-xs font-black uppercase tracking-widest text-[#0c3672]">Alur Pendampingan Terpadu</span>
                <h3 class="mt-2 text-3xl font-black text-[#0c3672]">Dari Ide Menuju Tumbuh Berkelanjutan</h3>
                <p class="mt-3 text-sm sm:text-base text-gray-600">Tiga fase pembinaan intensif yang memastikan pemuda wirausaha tidak berhenti di tahap pelatihan.</p>
            </div>

            <div class="mt-10 grid gap-6 md:grid-cols-3">
                <!-- Tahap 1: Penyadaran (Sky Blue) -->
                <div class="rounded-2xl bg-white p-6 shadow-sm border border-[#bae6fd] relative">
                    <span class="inline-block px-3 py-1 rounded-full text-xs font-black bg-[#e0f2fe] text-[#0369a1] mb-4">FASE 1 • DARI IDE</span>
                    <h4 class="text-xl font-black text-[#0c3672]">Penyadaran & Literasi</h4>
                    <p class="mt-2 text-sm text-gray-600 leading-relaxed">Pembentukan pola pikir <em>(entrepreneurial mindset)</em>, literasi digital usaha, riset pasar lokal, dan validasi ide bisnis awal.</p>
                    <ul class="mt-4 space-y-2 text-xs text-gray-600 font-medium">
                        <li class="flex items-center gap-2"><span class="text-[#0284c7] font-bold">✓</span> Business Model Canvas (BMC)</li>
                        <li class="flex items-center gap-2"><span class="text-[#0284c7] font-bold">✓</span> Validasi Kebutuhan Pasar</li>
                    </ul>
                </div>

                <!-- Tahap 2: Pematangan (Green) -->
                <div class="rounded-2xl bg-white p-6 shadow-sm border border-[#bbf7d0] relative">
                    <span class="inline-block px-3 py-1 rounded-full text-xs font-black bg-[#dcfce7] text-[#15803d] mb-4">FASE 2 • MENUJU AKSI</span>
                    <h4 class="text-xl font-black text-[#0c3672]">Pematangan & Legalitas</h4>
                    <p class="mt-2 text-sm text-gray-600 leading-relaxed">Pelatihan teknis intensif, fasilitasi legalitas (NIB, PIRT, Halal), sertifikasi kompetensi, akses pembiayaan, dan bimbingan mentor 1:1.</p>
                    <ul class="mt-4 space-y-2 text-xs text-gray-600 font-medium">
                        <li class="flex items-center gap-2"><span class="text-[#15803d] font-bold">✓</span> Legalitas & Hak Merek</li>
                        <li class="flex items-center gap-2"><span class="text-[#15803d] font-bold">✓</span> Akses Hibah & Permodalan</li>
                    </ul>
                </div>

                <!-- Tahap 3: Akselerasi (Amber/Orange) -->
                <div class="rounded-2xl bg-white p-6 shadow-sm border border-[#fed7aa] relative">
                    <span class="inline-block px-3 py-1 rounded-full text-xs font-black bg-[#ffedd5] text-[#c2410c] mb-4">FASE 3 • TUMBUH BERKELANJUTAN</span>
                    <h4 class="text-xl font-black text-[#0c3672]">Akselerasi & Pasar</h4>
                    <p class="mt-2 text-sm text-gray-600 leading-relaxed">Pembukaan akses pasar melalui kemitraan offtaker, integrasi rantai pasok industri, scale up usaha, dan pendampingan jangka panjang.</p>
                    <ul class="mt-4 space-y-2 text-xs text-gray-600 font-medium">
                        <li class="flex items-center gap-2"><span class="text-[#ea580c] font-bold">✓</span> Agregasi KMP Digital</li>
                        <li class="flex items-center gap-2"><span class="text-[#ea580c] font-bold">✓</span> Kemitraan Industri & Pasar Luas</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- 5. Arsitektur 3 Modul Platform Digital YOCO (Persis Warna Halaman 4 & 5 PDF) -->
        <div class="mt-20">
            <div class="text-center max-w-2xl mx-auto" data-aos="fade-up">
                <span class="text-xs font-black uppercase tracking-widest text-[#0c3672]">Infrastruktur Teknologi</span>
                <h3 class="mt-2 text-3xl sm:text-4xl font-black text-[#0c3672]">Arsitektur Platform Digital YOCO</h3>
                <p class="mt-3 text-base text-gray-600">Satu ekosistem terpadu yang memadukan kebutuhan pemuda wirausaha, pengelola koperasi, dan mitra kolaborator.</p>
            </div>

            <div class="mt-12 grid gap-6 lg:grid-cols-3" data-aos="fade-up">
                <!-- Modul 1: YOCO-Biz (ORANYE Sesuai Halaman 4 & 5 PDF) -->
                <div class="rounded-3xl border-2 border-[#fed7aa] bg-[#fffaf5] p-8 transition hover:border-[#ea580c] hover:shadow-xl flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-xs font-black uppercase tracking-wider text-[#ea580c] bg-[#ffedd5] px-3 py-1 rounded-lg">Aplikasi Pemuda</span>
                        </div>
                        <h4 class="text-2xl font-black text-[#0c3672]">YOCO-Biz</h4>
                        <p class="mt-2 text-sm text-gray-600 leading-relaxed">Aplikasi seluler terintegrasi untuk pemuda memulai dan mengelola usaha.</p>
                        
                        <div class="mt-6 space-y-2.5">
                            <div class="rounded-xl bg-white p-3 border border-[#fed7aa]/60 text-xs text-gray-700 font-semibold flex items-center gap-2 shadow-sm">
                                <span class="w-2 h-2 rounded-full bg-[#ea580c]"></span> Pelatihan & Sertifikasi Online/Offline
                            </div>
                            <div class="rounded-xl bg-white p-3 border border-[#fed7aa]/60 text-xs text-gray-700 font-semibold flex items-center gap-2 shadow-sm">
                                <span class="w-2 h-2 rounded-full bg-[#ea580c]"></span> Mentoring 1:1 Bersama Praktisi
                            </div>
                            <div class="rounded-xl bg-white p-3 border border-[#fed7aa]/60 text-xs text-gray-700 font-semibold flex items-center gap-2 shadow-sm">
                                <span class="w-2 h-2 rounded-full bg-[#ea580c]"></span> Marketplace Produk & Jasa Pemuda
                            </div>
                            <div class="rounded-xl bg-white p-3 border border-[#fed7aa]/60 text-xs text-gray-700 font-semibold flex items-center gap-2 shadow-sm">
                                <span class="w-2 h-2 rounded-full bg-[#ea580c]"></span> Akses Pembiayaan (Hibah & Kredit)
                            </div>
                        </div>
                    </div>
                    <div class="mt-6 text-[11px] font-bold text-[#ea580c] text-center py-2.5 bg-[#ffedd5] rounded-xl">
                        Dari Ide Menjadi Usaha Nyata
                    </div>
                </div>

                <!-- Modul 2: YOCO-Core (HIJAU KMP Sesuai Halaman 4 & 5 PDF) -->
                <div class="rounded-3xl border-2 border-[#bbf7d0] bg-[#f7fee7]/40 p-8 transition hover:border-[#16a34a] hover:shadow-xl flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-xs font-black uppercase tracking-wider text-[#15803d] bg-[#dcfce7] px-3 py-1 rounded-lg">Portal KMP & Klaster</span>
                        </div>
                        <h4 class="text-2xl font-black text-[#0c3672]">YOCO-Core</h4>
                        <p class="mt-2 text-sm text-gray-600 leading-relaxed">Sistem operasional pengelolaan Koperasi Multi Pihak (KMP) dan klaster usaha.</p>
                        
                        <div class="mt-6 space-y-2.5">
                            <div class="rounded-xl bg-white p-3 border border-[#bbf7d0]/60 text-xs text-gray-700 font-semibold flex items-center gap-2 shadow-sm">
                                <span class="w-2 h-2 rounded-full bg-[#16a34a]"></span> Manajemen Anggota & Kelembagaan
                            </div>
                            <div class="rounded-xl bg-white p-3 border border-[#bbf7d0]/60 text-xs text-gray-700 font-semibold flex items-center gap-2 shadow-sm">
                                <span class="w-2 h-2 rounded-full bg-[#16a34a]"></span> Manajemen Rantai Pasok & Distribusi
                            </div>
                            <div class="rounded-xl bg-white p-3 border border-[#bbf7d0]/60 text-xs text-gray-700 font-semibold flex items-center gap-2 shadow-sm">
                                <span class="w-2 h-2 rounded-full bg-[#16a34a]"></span> Agregasi Produksi & Skala Usaha
                            </div>
                            <div class="rounded-xl bg-white p-3 border border-[#bbf7d0]/60 text-xs text-gray-700 font-semibold flex items-center gap-2 shadow-sm">
                                <span class="w-2 h-2 rounded-full bg-[#16a34a]"></span> Laporan Keuangan & Analitik Usaha
                            </div>
                        </div>
                    </div>
                    <div class="mt-6 text-[11px] font-bold text-[#15803d] text-center py-2.5 bg-[#dcfce7] rounded-xl">
                        Efisiensi & Skala Usaha Bersama
                    </div>
                </div>

                <!-- Modul 3: YOCO-Connect (BIRU/VIOLET Kolaborator Sesuai Halaman 4 & 5 PDF) -->
                <div class="rounded-3xl border-2 border-[#bfdbfe] bg-[#f0f9ff]/50 p-8 transition hover:border-[#0284c7] hover:shadow-xl flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-xs font-black uppercase tracking-wider text-[#0c3672] bg-[#dbeafe] px-3 py-1 rounded-lg">Dashboard Kolaborator</span>
                        </div>
                        <h4 class="text-2xl font-black text-[#0c3672]">YOCO-Connect</h4>
                        <p class="mt-2 text-sm text-gray-600 leading-relaxed">Portal kemitraan multi-sektor bagi pemerintah, dunia usaha, perbankan, dan mentor.</p>
                        
                        <div class="mt-6 space-y-2.5">
                            <div class="rounded-xl bg-white p-3 border border-[#bfdbfe]/60 text-xs text-gray-700 font-semibold flex items-center gap-2 shadow-sm">
                                <span class="w-2 h-2 rounded-full bg-[#0284c7]"></span> Program Matching & Sinergi Industri
                            </div>
                            <div class="rounded-xl bg-white p-3 border border-[#bfdbfe]/60 text-xs text-gray-700 font-semibold flex items-center gap-2 shadow-sm">
                                <span class="w-2 h-2 rounded-full bg-[#0284c7]"></span> Akses Kemitraan & Penyerapan Offtaker
                            </div>
                            <div class="rounded-xl bg-white p-3 border border-[#bfdbfe]/60 text-xs text-gray-700 font-semibold flex items-center gap-2 shadow-sm">
                                <span class="w-2 h-2 rounded-full bg-[#0284c7]"></span> Monitoring Perkembangan & Evaluasi Usaha
                            </div>
                            <div class="rounded-xl bg-white p-3 border border-[#bfdbfe]/60 text-xs text-gray-700 font-semibold flex items-center gap-2 shadow-sm">
                                <span class="w-2 h-2 rounded-full bg-[#0284c7]"></span> Pengambilan Kebijakan Berbasis Data Riil
                            </div>
                        </div>
                    </div>
                    <div class="mt-6 text-[11px] font-bold text-[#0c3672] text-center py-2.5 bg-[#dbeafe] rounded-xl">
                        Sinergi Lintas Sektor Berdampak Luas
                    </div>
                </div>
            </div>
        </div>

        <!-- 6. Komitmen Bersama Quote Banner (Persis Footer PDF dengan Navy & Cyan Quotes) -->
        <div class="mt-16 pt-8" data-aos="fade-up">
            <div class="rounded-3xl bg-[#0c2340] p-8 sm:p-10 text-center relative overflow-hidden shadow-xl border border-[#1e3a5f]">
                <blockquote class="text-xl sm:text-2xl font-black text-white italic max-w-4xl mx-auto leading-relaxed">
                    "Bersama kita wujudkan pemuda berdaya, ekonomi kuat, Jawa Timur maju, Indonesia Emas 2045"
                </blockquote>
            </div>
        </div>

    </div>
</section>

<!-- Section 1: Sosialisasi (Palet Biru & Navy YOCO) -->
<section id="sosialisasi" class="py-24 bg-[#f8fafc] border-t border-[#e2e8f0]">
    <div class="mx-auto max-w-7xl px-6">

        @if($sosialisasi->isNotEmpty())
            @if($sosialisasi->count() > 3)
                {{-- Carousel / Slider Horizontal Scroll ketika konten melebihi 1 baris (> 3 item) --}}
                <div x-data="{
                    scrollEl: null,
                    canScrollLeft: false,
                    canScrollRight: true,
                    init() {
                        this.scrollEl = this.$refs.slider;
                        this.checkScroll();
                        window.addEventListener('resize', () => this.checkScroll());
                    },
                    checkScroll() {
                        if (!this.scrollEl) return;
                        this.canScrollLeft = this.scrollEl.scrollLeft > 10;
                        this.canScrollRight = this.scrollEl.scrollLeft < (this.scrollEl.scrollWidth - this.scrollEl.clientWidth - 15);
                    },
                    scrollNext() {
                        if (!this.scrollEl) return;
                        const card = this.scrollEl.querySelector('article');
                        const cardWidth = card ? card.offsetWidth : 380;
                        this.scrollEl.scrollBy({ left: cardWidth + 32, behavior: 'smooth' });
                    },
                    scrollPrev() {
                        if (!this.scrollEl) return;
                        const card = this.scrollEl.querySelector('article');
                        const cardWidth = card ? card.offsetWidth : 380;
                        this.scrollEl.scrollBy({ left: -(cardWidth + 32), behavior: 'smooth' });
                    }
                }" class="relative">

                    {{-- Header dengan Judul & Tombol Navigasi Panah --}}
                    <div class="mb-12 flex flex-col md:flex-row md:items-end justify-between gap-6" data-aos="fade-up">
                        <div class="max-w-2xl">
                            <span class="inline-flex items-center gap-2 rounded-full bg-[#e0f2fe] border border-[#bae6fd] px-3.5 py-1.5 text-xs font-black uppercase tracking-widest text-[#0369a1]">
                                <span>📣</span> Penguatan Kapasitas
                            </span>
                            <h2 class="mt-4 text-4xl font-black tracking-tight text-[#0c3672]">Sosialisasi Kewirausahaan</h2>
                            <p class="mt-3 text-lg leading-relaxed text-gray-600">Pengenalan peluang kewirausahaan, literasi usaha, akses program, dan praktik baik melalui forum yang inklusif bagi pemuda di Jawa Timur.</p>
                        </div>

                        {{-- Tombol Navigasi Scroll Geser --}}
                        <div class="flex items-center gap-3 flex-shrink-0">
                            <span class="text-xs text-[#0284c7] font-semibold hidden sm:inline-block mr-2">Geser untuk melihat lainnya →</span>
                            <button @click="scrollPrev()" 
                                    :disabled="!canScrollLeft"
                                    :class="canScrollLeft ? 'bg-white hover:bg-[#0c3672] text-[#0c3672] hover:text-white border-gray-300 hover:border-[#0c3672] cursor-pointer shadow-sm hover:shadow-md' : 'bg-gray-100 text-gray-300 border-gray-200 cursor-not-allowed'"
                                    class="w-12 h-12 rounded-2xl border flex items-center justify-center transition-all duration-200"
                                    aria-label="Geser ke kiri">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
                            </button>
                            <button @click="scrollNext()" 
                                    :disabled="!canScrollRight"
                                    :class="canScrollRight ? 'bg-[#0c3672] text-white hover:bg-[#082855] cursor-pointer shadow-lg shadow-[#0c3672]/20' : 'bg-gray-100 text-gray-300 border border-gray-200 cursor-not-allowed'"
                                    class="w-12 h-12 rounded-2xl flex items-center justify-center transition-all duration-200 font-bold"
                                    aria-label="Geser ke kanan">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                            </button>
                        </div>
                    </div>

                    {{-- Slider Container Scroll Horizontal --}}
                    <div x-ref="slider" 
                         @scroll="checkScroll()"
                         class="flex gap-8 overflow-x-auto pb-6 pt-2 snap-x snap-mandatory hide-scrollbar scroll-smooth">
                        @foreach($sosialisasi as $item)
                            <article class="group flex flex-col justify-between rounded-3xl bg-white border border-[#e2e8f0] p-6 shadow-sm transition-all duration-300 hover:-translate-y-1.5 hover:shadow-xl hover:border-[#38bdf8] flex-shrink-0 snap-start w-[85vw] sm:w-[calc((100%-2rem)/2)] lg:w-[calc((100%-4rem)/3)] max-w-md" data-aos="fade-up">
                                <div>
                                    <!-- Gambar Besar Tanpa Angka Penutup -->
                                    <div class="relative h-64 sm:h-72 w-full overflow-hidden rounded-2xl bg-[#f1f5f9] mb-6 shadow-inner">
                                        @if($item->image_path)
                                            <img src="{{ \App\Support\Media::url($item->image_path) }}" alt="{{ $item->title }}" class="h-full w-full object-cover transition duration-500 group-hover:scale-105">
                                        @else
                                            <div class="h-full w-full flex items-center justify-center bg-gradient-to-br from-[#e0f2fe] via-[#f1f5f9] to-[#dcfce7] text-[#0c3672]">
                                                <span class="text-6xl">📢</span>
                                            </div>
                                        @endif
                                    </div>

                                    <h3 class="text-2xl font-black text-[#0c3672] group-hover:text-[#0284c7] transition">{{ $item->title }}</h3>
                                    <p class="mt-3 text-sm leading-relaxed text-gray-600">{{ $item->content }}</p>
                                </div>

                                @if($item->link_url)
                                    <div class="mt-6 pt-4 border-t border-[#f1f5f9]">
                                        <a href="{{ $item->link_url }}" target="_blank" rel="noopener noreferrer" class="inline-flex w-full items-center justify-center gap-2 rounded-xl bg-[#0c3672] px-5 py-3 text-sm font-bold text-white shadow-sm transition hover:bg-[#082855] hover:shadow-md">
                                            <span>{{ $item->link_label ?: 'Selengkapnya' }}</span>
                                            <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                                        </a>
                                    </div>
                                @endif
                            </article>
                        @endforeach
                    </div>
                </div>
            @else
                {{-- Tampilan Grid 1 Baris saat hanya ada 1 s.d. 3 item --}}
                <div class="mb-14 max-w-2xl" data-aos="fade-up">
                    <span class="inline-flex items-center gap-2 rounded-full bg-[#e0f2fe] border border-[#bae6fd] px-3.5 py-1.5 text-xs font-black uppercase tracking-widest text-[#0369a1]">
                        <span>📣</span> Penguatan Kapasitas
                    </span>
                    <h2 class="mt-4 text-4xl font-black tracking-tight text-[#0c3672]">Sosialisasi Kewirausahaan</h2>
                    <p class="mt-3 text-lg leading-relaxed text-gray-600">Pengenalan peluang kewirausahaan, literasi usaha, akses program, dan praktik baik melalui forum yang inklusif bagi pemuda di Jawa Timur.</p>
                </div>

                <div class="grid gap-8 {{ $sosialisasi->count() === 1 ? 'max-w-md' : ($sosialisasi->count() === 2 ? 'sm:grid-cols-2 max-w-4xl' : 'sm:grid-cols-2 lg:grid-cols-3') }}">
                    @foreach($sosialisasi as $item)
                        <article class="group flex flex-col justify-between rounded-3xl bg-white border border-[#e2e8f0] p-6 shadow-sm transition-all duration-300 hover:-translate-y-1.5 hover:shadow-xl hover:border-[#38bdf8]" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                            <div>
                                <!-- Gambar Besar Tanpa Angka Penutup -->
                                <div class="relative h-64 sm:h-72 w-full overflow-hidden rounded-2xl bg-[#f1f5f9] mb-6 shadow-inner">
                                    @if($item->image_path)
                                        <img src="{{ \App\Support\Media::url($item->image_path) }}" alt="{{ $item->title }}" class="h-full w-full object-cover transition duration-500 group-hover:scale-105">
                                    @else
                                        <div class="h-full w-full flex items-center justify-center bg-gradient-to-br from-[#e0f2fe] via-[#f1f5f9] to-[#dcfce7] text-[#0c3672]">
                                            <span class="text-6xl">📢</span>
                                        </div>
                                    @endif
                                </div>

                                <h3 class="text-2xl font-black text-[#0c3672] group-hover:text-[#0284c7] transition">{{ $item->title }}</h3>
                                <p class="mt-3 text-sm leading-relaxed text-gray-600">{{ $item->content }}</p>
                            </div>

                            @if($item->link_url)
                                <div class="mt-6 pt-4 border-t border-[#f1f5f9]">
                                    <a href="{{ $item->link_url }}" target="_blank" rel="noopener noreferrer" class="inline-flex w-full items-center justify-center gap-2 rounded-xl bg-[#0c3672] px-5 py-3 text-sm font-bold text-white shadow-sm transition hover:bg-[#082855] hover:shadow-md">
                                        <span>{{ $item->link_label ?: 'Selengkapnya' }}</span>
                                        <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                                    </a>
                                </div>
                            @endif
                        </article>
                    @endforeach
                </div>
            @endif
        @else
            <div class="rounded-3xl border border-dashed border-[#cbd5e1] bg-white p-12 text-center text-gray-500" data-aos="fade-up">
                <p class="font-semibold text-gray-700">Belum ada konten sosialisasi yang dipublikasikan.</p>
                <p class="mt-1 text-sm text-gray-400">Konten sosialisasi dapat ditambahkan melalui panel admin.</p>
            </div>
        @endif
    </div>
</section>

<!-- Section 2: Advokasi (Midnight Navy & Cyan Sesuai Dokumen) -->
<section id="advokasi" class="py-24 bg-gradient-to-br from-[#081d36] via-[#0b2749] to-[#061527] text-white relative overflow-hidden border-t border-[#1e4976]">
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_right,rgba(56,189,248,0.12),transparent_50%)] pointer-events-none"></div>
    <div class="relative mx-auto max-w-7xl px-6">

        @if($advokasi->isNotEmpty())
            @if($advokasi->count() > 2)
                {{-- Carousel / Slider Horizontal Scroll ketika ada lebih dari 2 item --}}
                <div x-data="{
                    scrollEl: null,
                    canScrollLeft: false,
                    canScrollRight: true,
                    init() {
                        this.scrollEl = this.$refs.slider;
                        this.checkScroll();
                        window.addEventListener('resize', () => this.checkScroll());
                    },
                    checkScroll() {
                        if (!this.scrollEl) return;
                        this.canScrollLeft = this.scrollEl.scrollLeft > 10;
                        this.canScrollRight = this.scrollEl.scrollLeft < (this.scrollEl.scrollWidth - this.scrollEl.clientWidth - 15);
                    },
                    scrollNext() {
                        if (!this.scrollEl) return;
                        const card = this.scrollEl.querySelector('article');
                        const cardWidth = card ? card.offsetWidth : 400;
                        this.scrollEl.scrollBy({ left: cardWidth + 32, behavior: 'smooth' });
                    },
                    scrollPrev() {
                        if (!this.scrollEl) return;
                        const card = this.scrollEl.querySelector('article');
                        const cardWidth = card ? card.offsetWidth : 400;
                        this.scrollEl.scrollBy({ left: -(cardWidth + 32), behavior: 'smooth' });
                    }
                }" class="relative">

                    {{-- Header dengan Judul & Tombol Navigasi Panah --}}
                    <div class="mb-12 flex flex-col md:flex-row md:items-end justify-between gap-6" data-aos="fade-up">
                        <div class="max-w-2xl">
                            <h2 class="mt-4 text-4xl font-black tracking-tight text-white">Advokasi</h2>
                            <p class="mt-3 text-lg leading-relaxed text-white/80">Pendampingan aspirasi dan kebutuhan pelaku usaha muda agar terhubung dengan kebijakan, pembinaan, perizinan, permodalan, dan jejaring strategis.</p>
                        </div>

                        {{-- Tombol Navigasi Scroll Geser --}}
                        <div class="flex items-center gap-3 flex-shrink-0">
                            <span class="text-xs text-[#38bdf8] font-semibold hidden sm:inline-block mr-2">Geser untuk melihat lainnya →</span>
                            <button @click="scrollPrev()" 
                                    :disabled="!canScrollLeft"
                                    :class="canScrollLeft ? 'bg-white/10 hover:bg-white/20 text-white cursor-pointer' : 'bg-white/5 text-white/30 cursor-not-allowed'"
                                    class="w-12 h-12 rounded-2xl border border-white/10 backdrop-blur-md flex items-center justify-center transition-all duration-200"
                                    aria-label="Geser ke kiri">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
                            </button>
                            <button @click="scrollNext()" 
                                    :disabled="!canScrollRight"
                                    :class="canScrollRight ? 'bg-[#38bdf8] text-[#081d36] hover:bg-[#7dd3fc] cursor-pointer shadow-lg shadow-[#38bdf8]/20' : 'bg-white/5 text-white/30 cursor-not-allowed border border-white/10'"
                                    class="w-12 h-12 rounded-2xl flex items-center justify-center transition-all duration-200 font-bold"
                                    aria-label="Geser ke kanan">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                            </button>
                        </div>
                    </div>

                    {{-- Slider Container Scroll Horizontal --}}
                    <div x-ref="slider" 
                         @scroll="checkScroll()"
                         class="flex gap-8 overflow-x-auto pb-6 pt-2 snap-x snap-mandatory hide-scrollbar scroll-smooth">
                        @foreach($advokasi as $item)
                            <article class="group rounded-3xl border border-white/10 bg-white/5 backdrop-blur-md p-6 sm:p-8 shadow-2xl transition duration-300 hover:border-[#38bdf8]/50 hover:bg-white/[0.08] hover:-translate-y-1 flex flex-col justify-between flex-shrink-0 snap-start w-[88vw] sm:w-[70vw] md:w-[calc(50%-1rem)] max-w-xl" data-aos="fade-up">
                                <div>
                                    <!-- Gambar Besar Tanpa Angka -->
                                    <div class="relative h-64 sm:h-72 w-full overflow-hidden rounded-2xl border border-white/15 bg-black/30 mb-6 shadow-lg">
                                        @if($item->image_path)
                                            <img src="{{ \App\Support\Media::url($item->image_path) }}" alt="{{ $item->title }}" class="h-full w-full object-cover transition duration-500 group-hover:scale-105">
                                        @else
                                            <div class="h-full w-full flex items-center justify-center bg-gradient-to-br from-[#0c2b50] to-[#07192f] text-[#38bdf8]">
                                                <span class="text-6xl">🤝</span>
                                            </div>
                                        @endif
                                    </div>

                                    <h3 class="text-2xl sm:text-3xl font-black text-white leading-snug group-hover:text-[#38bdf8] transition">{{ $item->title }}</h3>
                                    <p class="mt-3 text-sm sm:text-base leading-relaxed text-white/80">{{ $item->content }}</p>
                                </div>

                                @if($item->link_url)
                                    <div class="mt-8 pt-4 border-t border-white/10">
                                        <a href="{{ $item->link_url }}" target="_blank" rel="noopener noreferrer" class="inline-flex w-full sm:w-auto items-center justify-center gap-2.5 rounded-xl bg-white px-6 py-3.5 text-sm font-bold text-[#081d36] shadow-lg transition hover:bg-[#38bdf8] hover:-translate-y-0.5">
                                            <span>{{ $item->link_label ?: 'Ajukan Pendampingan' }}</span>
                                            <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                                        </a>
                                    </div>
                                @endif
                            </article>
                        @endforeach
                    </div>
                </div>
            @else
                {{-- Tampilan Grid 2 Kolom saat hanya ada 1 atau 2 item --}}
                <div class="mb-14 max-w-2xl" data-aos="fade-up">
                    <span class="inline-flex items-center gap-2 rounded-full border border-[#38bdf8]/30 bg-[#38bdf8]/10 px-3.5 py-1.5 text-xs font-bold uppercase tracking-widest text-[#38bdf8]">
                        <span>🤝</span> Pendampingan Strategis
                    </span>
                    <h2 class="mt-4 text-4xl font-black tracking-tight text-white">Advokasi</h2>
                    <p class="mt-3 text-lg leading-relaxed text-white/80">Pendampingan aspirasi dan kebutuhan pelaku usaha muda agar terhubung dengan kebijakan, pembinaan, perizinan, permodalan, dan jejaring strategis.</p>
                </div>

                <div class="grid gap-8 {{ $advokasi->count() === 1 ? 'max-w-2xl' : 'md:grid-cols-2' }}">
                    @foreach($advokasi as $item)
                        <article class="group rounded-3xl border border-white/10 bg-white/5 backdrop-blur-md p-6 sm:p-8 shadow-2xl transition duration-300 hover:border-[#38bdf8]/50 hover:bg-white/[0.08] hover:-translate-y-1 flex flex-col justify-between" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                            <div>
                                <!-- Gambar Besar Tanpa Angka -->
                                <div class="relative h-64 sm:h-72 w-full overflow-hidden rounded-2xl border border-white/15 bg-black/30 mb-6 shadow-lg">
                                    @if($item->image_path)
                                        <img src="{{ \App\Support\Media::url($item->image_path) }}" alt="{{ $item->title }}" class="h-full w-full object-cover transition duration-500 group-hover:scale-105">
                                    @else
                                        <div class="h-full w-full flex items-center justify-center bg-gradient-to-br from-[#0c2b50] to-[#07192f] text-[#38bdf8]">
                                            <span class="text-6xl">🤝</span>
                                        </div>
                                    @endif
                                </div>

                                <h3 class="text-2xl sm:text-3xl font-black text-white leading-snug group-hover:text-[#38bdf8] transition">{{ $item->title }}</h3>
                                <p class="mt-3 text-sm sm:text-base leading-relaxed text-white/80">{{ $item->content }}</p>
                            </div>

                            @if($item->link_url)
                                <div class="mt-8 pt-4 border-t border-white/10">
                                    <a href="{{ $item->link_url }}" target="_blank" rel="noopener noreferrer" class="inline-flex w-full sm:w-auto items-center justify-center gap-2.5 rounded-xl bg-white px-6 py-3.5 text-sm font-bold text-[#081d36] shadow-lg transition hover:bg-[#38bdf8] hover:-translate-y-0.5">
                                        <span>{{ $item->link_label ?: 'Ajukan Pendampingan' }}</span>
                                        <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                                    </a>
                                </div>
                            @endif
                        </article>
                    @endforeach
                </div>
            @endif
        @else
            <div class="mb-14 max-w-2xl" data-aos="fade-up">
                <h2 class="text-4xl font-black tracking-tight text-white">Advokasi</h2>
                <p class="mt-3 text-lg leading-relaxed text-white/80">Pendampingan aspirasi dan kebutuhan pelaku usaha muda agar terhubung dengan kebijakan, pembinaan, perizinan, permodalan, dan jejaring strategis.</p>
            </div>
            <div class="rounded-3xl border border-white/10 bg-white/5 p-12 text-center text-white/70" data-aos="fade-up">
                <p class="font-semibold text-white">Belum ada konten advokasi yang dipublikasikan.</p>
                <p class="mt-1 text-sm text-white/50">Konten advokasi dapat ditambahkan melalui panel admin.</p>
            </div>
        @endif

    </div>
</section>

<!-- Section 3: Marketing Sektor Publik (Oranye & Hijau Tumbuh) -->
<section id="marketing" class="py-24 bg-white border-t border-[#e2e8f0]">
    <div class="mx-auto max-w-7xl px-6">
        <div class="mb-14 max-w-2xl" data-aos="fade-up">
            <h2 class="mt-4 text-4xl font-black tracking-tight text-[#0c3672]">Marketing Sektor Publik</h2>
            <p class="mt-3 text-lg leading-relaxed text-gray-600">Strategi terarah untuk menjembatani inovasi pemuda dengan kebutuhan pasar, mitra pemerintah, dan ekosistem industri daerah.</p>
        </div>

        @if($marketing->isNotEmpty())
            <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
                @foreach($marketing as $item)
                    <article class="group relative flex flex-col justify-between overflow-hidden rounded-3xl border border-[#fed7aa]/70 bg-gradient-to-b from-white to-[#fffaf5] p-6 sm:p-7 shadow-sm transition-all duration-300 hover:border-[#ea580c] hover:shadow-xl hover:-translate-y-1 h-full" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                        <div>
                            <!-- Gambar Besar Tanpa Angka Menutupi -->
                            <div class="relative h-56 sm:h-64 w-full overflow-hidden rounded-2xl bg-[#f1f5f9] mb-5 shadow-inner">
                                @if($item->image_path)
                                    <img src="{{ \App\Support\Media::url($item->image_path) }}" alt="{{ $item->title }}" class="h-full w-full object-cover transition duration-500 group-hover:scale-105">
                                @else
                                    <div class="h-full w-full flex items-center justify-center bg-gradient-to-br from-[#ffedd5] via-[#fffaf5] to-[#fef08a] text-[#ea580c]">
                                        <span class="text-6xl">📈</span>
                                    </div>
                                @endif
                            </div>

                            <h3 class="text-xl font-black text-[#0c3672] group-hover:text-[#ea580c] transition">{{ $item->title }}</h3>
                            <p class="mt-3 text-sm leading-relaxed text-gray-600">{{ $item->content }}</p>
                        </div>

                        @if($item->link_url)
                            <div class="mt-8 pt-4 border-t border-[#fed7aa]/50">
                                <a href="{{ $item->link_url }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 rounded-full bg-[#ea580c] px-6 py-2.5 text-xs font-bold uppercase tracking-wider text-white shadow-sm transition hover:bg-[#c2410c] hover:shadow-md">
                                    <span>{{ $item->link_label ?: 'Selengkapnya' }}</span>
                                    <svg class="w-3.5 h-3.5 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                </a>
                            </div>
                        @endif
                    </article>
                @endforeach
            </div>
        @else
            <div class="rounded-3xl border border-dashed border-[#cbd5e1] bg-[#f8fafc] p-12 text-center text-gray-500" data-aos="fade-up">
                <p class="font-semibold text-gray-700">Belum ada strategi marketing yang dipublikasikan.</p>
                <p class="mt-1 text-sm text-gray-400">Konten marketing dapat ditambahkan melalui panel admin.</p>
            </div>
        @endif
    </div>
</section>

<!-- Section Berita YOCO (Senada dengan Footer Dispora) -->
<section class="bg-gradient-to-b from-[#05302e] via-[#022b2a] to-dispora-950 py-20 text-white border-t border-dispora-800/40 relative overflow-hidden">
    <!-- Subtle Glow Elements senada Footer -->
    <div class="absolute top-0 right-1/4 w-96 h-96 bg-dispora-600/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-0 left-10 w-80 h-80 bg-dispora-500/10 rounded-full blur-3xl pointer-events-none"></div>

    <div class="relative z-10 mx-auto max-w-7xl px-6">
        <div class="mb-10 flex flex-col justify-between gap-4 md:flex-row md:items-end">
            <div>
                <p class="font-bold uppercase tracking-widest text-dispora-300">Kabar Terkini</p>
                <h2 class="mt-3 text-4xl font-black">Berita YOCO</h2>
            </div>
            <a href="{{ route('berita.index', ['category' => 'yoco']) }}" class="font-bold text-dispora-300 hover:text-white transition flex items-center gap-1.5">
                <span>Lihat semua berita</span>
                <span>→</span>
            </a>
        </div>
        <div class="grid gap-7 md:grid-cols-3">
            @forelse($yocoPosts as $post)
                <article class="overflow-hidden rounded-2xl bg-white text-gray-900 shadow-md transition hover:-translate-y-1">
                    <a href="{{ route('berita.detail', $post->slug) }}">
                        <img src="{{ $post->featured_image ? route('public.file', ['folder' => 'posts', 'filename' => basename($post->featured_image)]) : asset('images/media-placeholder.svg') }}" alt="{{ $post->title }}" class="h-48 w-full object-cover">
                    </a>
                    <div class="p-6">
                        <p class="text-xs font-bold text-dispora-700">{{ $post->display_date ? $post->display_date->translatedFormat('d F Y') : '' }}</p>
                        <h3 class="mt-2 text-lg font-extrabold line-clamp-2">
                            <a href="{{ route('berita.detail', $post->slug) }}" class="hover:text-dispora-600 transition">{{ $post->title }}</a>
                        </h3>
                    </div>
                </article>
            @empty
                <div class="rounded-2xl border border-dispora-800/40 bg-dispora-900/30 p-10 text-dispora-100/70 md:col-span-3">
                    Belum ada berita YOCO.
                </div>
            @endforelse
        </div>
    </div>
</section>
@endsection
