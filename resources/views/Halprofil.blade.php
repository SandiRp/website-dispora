@extends('layouts.main')

@section('title', 'Profil Instansi - Dispora Jatim')

@section('content')

    <!-- 1. HERO SECTION PROFIL -->
    <div class="relative bg-dispora-dark py-24 overflow-hidden">
        <div class="absolute inset-0 opacity-20">
            <img src="{{ asset('images/profilinstansi.png') }}"
                class="w-full h-full object-cover" alt="Background Profil">
        </div>
        <div class="absolute inset-0 bg-gradient-to-r from-dispora-dark to-transparent"></div>
        <div class="max-w-7xl mx-auto px-6 relative z-10" data-aos="zoom-in">
            <span class="text-dispora-light font-bold tracking-wider uppercase text-sm mb-2 block">Mengenal Lebih
                Dekat</span>
            <h1 class="text-4xl md:text-5xl font-extrabold text-white mb-4 drop-shadow-lg">Profil Dinas Kepemudaan dan
                Olahraga</h1>
            <div class="w-20 h-1.5 bg-white rounded-full"></div>
        </div>
    </div>

    <!-- 2. KEDUDUKAN & ALAMAT -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                <div data-aos="fade-right">
                    <h2 class="text-3xl font-bold text-gray-800 mb-6">Kedudukan Instansi</h2>
                    <p class="text-gray-600 leading-relaxed mb-6">
                        Dinas Kepemudaan dan Olahraga (Dispora) Provinsi Jawa Timur merupakan unsur pelaksana urusan
                        pemerintahan bidang kepemudaan dan bidang olahraga yang menjadi kewenangan daerah provinsi. Dispora
                        dipimpin oleh seorang Kepala Dinas yang berkedudukan di bawah dan bertanggung jawab kepada Gubernur
                        melalui Sekretaris Daerah.
                    </p>
                    <div class="bg-gray-50 border-l-4 border-dispora p-6 rounded-r-xl shadow-sm">
                        <h4 class="font-bold text-gray-800 mb-2 flex items-center">
                            <span class="mr-2">📍</span> Alamat Resmi
                        </h4>
                        <p class="text-gray-600 text-sm leading-relaxed">
                            Jl. Kayoon No.56, Embong Kaliasin, Kec. Genteng,<br>
                            Kota Surabaya, Jawa Timur 60271<br>
                            <strong>Telepon:</strong> (031) 5345507<br>
                            <strong>Email:</strong> dispora@jatimprov.go.id
                        </p>
                    </div>
                </div>
                <!-- Peta Mockup -->
                <div data-aos="fade-left" class="rounded-2xl overflow-hidden shadow-xl border-4 border-white h-80 bg-gray-200 relative">
                    <!-- Ganti src iframe di bawah ini dengan embed Google Maps yang asli -->
                 <iframe
                 src="https://maps.google.com/maps?q=Dinas+Kepemudaan+Dan+Olahraga+Provinsi+Jawa+Timur,+Surabaya&t=&z=16&ie=UTF8&iwloc=&output=embed"
                 width="100%" 
                 height="100%" 
                 style="border:0;" 
                 allowfullscreen="" 
                 loading="lazy"
                referrerpolicy="no-referrer-when-downgrade">
                </iframe>
                </div>
            </div>
        </div>
    </section>

    <!-- 3. VISI & MISI -->
    <section class="py-16 bg-gray-50 border-y border-gray-100">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-12" data-aos="fade-up">
                <h2 class="text-3xl font-bold text-gray-800">Visi & Misi</h2>
                <div class="w-24 h-1 bg-dispora mx-auto mt-4 rounded-full"></div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- VISI (1 Kolom) -->
                <div data-aos="fade-right"
                    class="lg:col-span-1 bg-gradient-to-br from-dispora-dark to-dispora rounded-2xl p-8 text-white shadow-lg flex flex-col justify-center text-center transform hover:-translate-y-2 transition duration-300">
                    <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold mb-4 tracking-wider">VISI</h3>
                    <p class="text-lg font-medium leading-relaxed drop-shadow-md">
                        "Terwujudnya Pemuda Jawa Timur yang Maju, Berdaya Saing, dan Berkarakter, serta Olahraga yang
                        Berprestasi di Tingkat Nasional dan Internasional."
                    </p>
                </div>
                <!-- MISI (2 Kolom) -->
                <div data-aos="fade-left" class="lg:col-span-2 bg-white rounded-2xl p-8 shadow-lg border border-gray-100">
                    <h3 class="text-2xl font-bold mb-6 text-gray-800 flex items-center">
                        <span
                            class="bg-dispora text-white w-10 h-10 rounded-lg flex items-center justify-center mr-3 text-sm">🎯</span>
                        MISI
                    </h3>
                    <ul class="space-y-4">
                        <li class="flex items-start">
                            <svg class="w-6 h-6 text-green-500 mr-3 mt-0.5 shrink-0" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                                </path>
                            </svg>
                            <p class="text-gray-600">Meningkatkan kualitas pembangunan kepemudaan melalui penyadaran,
                                pemberdayaan, dan pengembangan pemuda.</p>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-6 h-6 text-green-500 mr-3 mt-0.5 shrink-0" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                                </path>
                            </svg>
                            <p class="text-gray-600">Meningkatkan pembudayaan olahraga dan pencapaian prestasi olahraga
                                secara sistematis, berjenjang, dan berkelanjutan.</p>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-6 h-6 text-green-500 mr-3 mt-0.5 shrink-0" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                                </path>
                            </svg>
                            <p class="text-gray-600">Meningkatkan penyediaan prasarana dan sarana kepemudaan dan olahraga
                                yang memadai dan berstandar.</p>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-6 h-6 text-green-500 mr-3 mt-0.5 shrink-0" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                                </path>
                            </svg>
                            <p class="text-gray-600">Mewujudkan tata kelola pemerintahan yang baik (Good Governance) dalam
                                memberikan pelayanan publik yang berkualitas.</p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- 4. TUGAS DAN FUNGSI -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-12" data-aos="fade-up">
                <h2 class="text-3xl font-bold text-gray-800">Tugas & Fungsi</h2>
                <div class="w-24 h-1 bg-dispora mx-auto mt-4 rounded-full"></div>
            </div>

            <div data-aos="fade-up" data-aos-delay="100" class="bg-gray-50 rounded-2xl p-8 md:p-10 shadow-sm border border-gray-100">
                <p class="text-lg text-gray-700 font-medium mb-6 text-center">
                    Berdasarkan Peraturan Gubernur, Dinas Kepemudaan dan Olahraga memiliki tugas membantu Gubernur
                    melaksanakan urusan pemerintahan yang menjadi kewenangan Daerah di bidang kepemudaan dan olahraga.
                </p>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-white p-6 rounded-xl shadow-sm border-l-4 border-dispora">
                        <h4 class="font-bold text-gray-800 mb-2">Perumusan Kebijakan</h4>
                        <p class="text-sm text-gray-600">Merumuskan kebijakan teknis di bidang kepemudaan dan keolahragaan
                            sesuai dengan visi dan misi pemerintah daerah.</p>
                    </div>
                    <div class="bg-white p-6 rounded-xl shadow-sm border-l-4 border-dispora">
                        <h4 class="font-bold text-gray-800 mb-2">Pelaksanaan Kebijakan</h4>
                        <p class="text-sm text-gray-600">Melaksanakan kebijakan teknis, evaluasi, dan pelaporan di bidang
                            kepemudaan dan olahraga.</p>
                    </div>
                    <div class="bg-white p-6 rounded-xl shadow-sm border-l-4 border-dispora">
                        <h4 class="font-bold text-gray-800 mb-2">Administrasi Dinas</h4>
                        <p class="text-sm text-gray-600">Menyelenggarakan administrasi dinas yang meliputi ketatausahaan,
                            kepegawaian, keuangan, dan perlengkapan.</p>
                    </div>
                    <!-- <div class="bg-white p-6 rounded-xl shadow-sm border-l-4 border-dispora">
                        <h4 class="font-bold text-gray-800 mb-2">Pengelolaan UPT</h4>
                        <p class="text-sm text-gray-600">Melaksanakan fungsi lain yang diberikan oleh Gubernur terkait
                            tugas dan fungsinya, termasuk pembinaan Unit Pelaksana Teknis (UPT).</p>
                    </div> -->
                </div>
            </div>
        </div>
    </section>

    <!-- 5. UNIT KERJA -->
    <section class="py-16 bg-gray-50 border-t border-gray-100">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-12" data-aos="fade-up">
                <h2 class="text-3xl font-bold text-gray-800">Unit Kerja</h2>
                <div class="w-24 h-1 bg-dispora mx-auto mt-4 rounded-full"></div>
            </div>

            <div class="flex flex-wrap justify-center gap-6">

                <div data-aos="zoom-in" data-aos-delay="0"
                    class="w-full sm:w-[calc(50%-12px)] lg:w-[calc(33.333%-16px)] xl:w-[calc(20%-20px)] bg-white rounded-xl p-6 text-center shadow-sm hover:shadow-lg transition border border-gray-100 group">
                    <div
                        class="w-16 h-16 bg-gray-100 text-gray-600 mx-auto rounded-full flex items-center justify-center mb-4 group-hover:scale-110 group-hover:bg-gray-800 group-hover:text-white transition-all duration-300">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>
                        </svg>
                    </div>
                    <h4 class="font-bold text-gray-800 mb-2">Sekretariat</h4>
                    <p class="text-xs text-gray-500">Pelayanan administrasi, penyusunan program, dan pengelolaan keuangan.
                    </p>
                </div>

                <div data-aos="zoom-in" data-aos-delay="100"
                    class="w-full sm:w-[calc(50%-12px)] lg:w-[calc(33.333%-16px)] xl:w-[calc(20%-20px)] bg-white rounded-xl p-6 text-center shadow-sm hover:shadow-lg transition border border-gray-100 group">
                    <div
                        class="w-16 h-16 bg-blue-100 text-blue-600 mx-auto rounded-full flex items-center justify-center mb-4 group-hover:scale-110 group-hover:bg-blue-600 group-hover:text-white transition-all duration-300">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5.25 6.375a4.125 4.125 0 1 1 8.25 0 4.125 4.125 0 0 1-8.25 0ZM2.25 19.125a7.125 7.125 0 0 1 14.25 0v.003l-.001.119a.75.75 0 0 1-.363.63 13.067 13.067 0 0 1-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 0 1-.364-.63l-.001-.122ZM18.75 7.5a.75.75 0 0 0-1.5 0v2.25H15a.75.75 0 0 0 0 1.5h2.25v2.25a.75.75 0 0 0 1.5 0v-2.25H21a.75.75 0 0 0 0-1.5h-2.25V7.5Z">
                            </path>
                        </svg>
                    </div>
                    <h4 class="font-bold text-gray-800 mb-2">Bidang Kepemudaan</h4>
                    <p class="text-xs text-gray-500">Pemberdayaan, pengembangan kapasitas, dan kemandirian pemuda.</p>
                </div>

                <div data-aos="zoom-in" data-aos-delay="200"
                    class="w-full sm:w-[calc(50%-12px)] lg:w-[calc(33.333%-16px)] xl:w-[calc(20%-20px)] bg-white rounded-xl p-6 text-center shadow-sm hover:shadow-lg transition border border-gray-100 group">
                    <div
                        class="w-16 h-16 bg-red-100 text-red-600 mx-auto rounded-full flex items-center justify-center mb-4 group-hover:scale-110 group-hover:bg-red-600 group-hover:text-white transition-all duration-300">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16.5 18.75h-9m9 0a3 3 0 0 1 3 3h-15a3 3 0 0 1 3-3m9 0v-3.375c0-.621-.503-1.125-1.125-1.125h-.871M7.5 18.75v-3.375c0-.621.504-1.125 1.125-1.125h.872m5.007 0H9.497m5.007 0a7.454 7.454 0 0 1-.982-3.172M9.497 14.25a7.454 7.454 0 0 0 .981-3.172M5.25 4.236c-.982.143-1.954.317-2.916.52A6.003 6.003 0 0 0 7.73 9.728M5.25 4.236V4.5c0 2.108.966 3.99 2.48 5.228M5.25 4.236V2.721C7.456 2.41 9.71 2.25 12 2.25c2.291 0 4.545.16 6.75.47v1.516M7.73 9.728a6.726 6.726 0 0 0 2.748 1.35m8.272-6.842V4.5c0 2.108-.966 3.99-2.48 5.228m2.48-5.492a46.32 46.32 0 0 1 2.916.52 6.003 6.003 0 0 1-5.395 4.972m0 0a6.726 6.726 0 0 1-2.749 1.35m0 0a6.772 6.772 0 0 1-3.044 0" />
</svg>


                        </svg>
                    </div>
                    <h4 class="font-bold text-gray-800 mb-2">Bidang Olahraga Prestasi</h4>
                    <p class="text-xs text-gray-500">Pembinaan atlet, peningkatan prestasi, dan kompetisi olahraga.</p>
                </div>

                <div data-aos="zoom-in" data-aos-delay="300"
                    class="w-full sm:w-[calc(50%-12px)] lg:w-[calc(33.333%-16px)] xl:w-[calc(20%-20px)] bg-white rounded-xl p-6 text-center shadow-sm hover:shadow-lg transition border border-gray-100 group">
                    <div
                        class="w-16 h-16 bg-green-100 text-green-600 mx-auto rounded-full flex items-center justify-center mb-4 group-hover:scale-110 group-hover:bg-green-600 group-hover:text-white transition-all duration-300">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.25 7.125C2.25 6.504 2.754 6 3.375 6h6c.621 0 1.125.504 1.125 1.125v3.75c0 .621-.504 1.125-1.125 1.125h-6a1.125 1.125 0 0 1-1.125-1.125v-3.75ZM14.25 8.625c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125v8.25c0 .621-.504 1.125-1.125 1.125h-5.25a1.125 1.125 0 0 1-1.125-1.125v-8.25ZM3.75 16.125c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125v2.25c0 .621-.504 1.125-1.125 1.125h-5.25a1.125 1.125 0 0 1-1.125-1.125v-2.25Z" />
                        </svg>
                    </div>
                    <h4 class="font-bold text-gray-800 mb-2">Bidang Pembudayaan Olahraga</h4>
                    <p class="text-xs text-gray-500">Pemasalan olahraga masyarakat, rekreasi, dan olahraga pendidikan.</p>
                </div>

                <div data-aos="zoom-in" data-aos-delay="400"
                    class="w-full sm:w-[calc(50%-12px)] lg:w-[calc(33.333%-16px)] xl:w-[calc(20%-20px)] bg-white rounded-xl p-6 text-center shadow-sm hover:shadow-lg transition border border-gray-100 group">
                    <div
                        class="w-16 h-16 bg-orange-100 text-orange-600 mx-auto rounded-full flex items-center justify-center mb-4 group-hover:scale-110 group-hover:bg-orange-600 group-hover:text-white transition-all duration-300">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z">
                            </path>
                        </svg>
                    </div>
                    <h4 class="font-bold text-gray-800 mb-2">Bidang Kepramukaan</h4>
                    <p class="text-xs text-gray-500">Pengembangan gerakan pramuka dan pembentukan karakter pandu.</p>
                </div>

            </div>
        </div>
    </section>

    <!-- 6. STRUKTUR ORGANISASI -->
    <section class="py-16 bg-white border-t border-gray-200 overflow-hidden">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex justify-between items-end mb-8" data-aos="fade-up">
                <div>
                    <h2 class="text-3xl font-bold text-gray-800">Struktur Organisasi</h2>
                    <div class="w-24 h-1 bg-dispora mt-4 rounded-full"></div>
                </div>
            </div>

            <div data-aos="zoom-in" class="mb-12 bg-gray-50 p-4 rounded-2xl border border-gray-200 shadow-md">
                <div class="bg-gray-200 rounded-xl overflow-hidden relative flex items-center justify-center group w-full h-[300px] md:h-[500px]">
                    <img src="{{ asset('images/strukturOrganisasi.png') }}"
                        class="absolute inset-0 w-full h-full object-cover opacity-90 group-hover:opacity-100 transition"
                        alt="Bagan Organisasi">
                    <div class="absolute inset-0 bg-black/30 flex items-center justify-center opacity-0 group-hover:opacity-100 transition duration-300 z-10">
                        <a href="{{ asset('images/strukturOrganisasi.png') }}" target="_blank"
                            class="bg-white text-gray-800 px-6 py-3 rounded-lg font-bold shadow-lg flex items-center hover:bg-dispora hover:text-white transition">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path>
                            </svg>
                            Lihat Bagan Penuh
                        </a>
                    </div>
                </div>
            </div>

            @if($officials->count() > 0)
            <!-- Alpine JS untuk Auto Scroll Pejabat -->
            <div x-data="{
                autoPlay() {
                    setInterval(() => {
                        let slider = this.$refs.officialsSlider;
                        if (!slider) return;
                        let itemWidth = slider.querySelector('.official-item').offsetWidth;
                        let gap = 24; // gap-6 = 24px
                        let maxScroll = slider.scrollWidth - slider.clientWidth;
            
                        if (slider.scrollLeft >= maxScroll - 10) {
                            slider.scrollTo({ left: 0, behavior: 'smooth' });
                        } else {
                            slider.scrollBy({ left: itemWidth + gap, behavior: 'smooth' });
                        }
                    }, 4000); 
                }
            }" x-init="autoPlay()" class="relative w-full">

                <div x-ref="officialsSlider" class="flex gap-6 overflow-x-auto snap-x snap-mandatory hide-scrollbar pb-6">

                    @foreach($officials as $official)
                    <div data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}" class="official-item snap-start shrink-0 w-[80%] md:w-[calc(50%-12px)] lg:w-[calc(33.333%-16px)] xl:w-[calc(25%-18px)] bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 group flex flex-col text-center">
                        <div class="h-64 bg-gray-200 relative overflow-hidden shrink-0 border-b-4 border-dispora">
                            <img src="{{ $official->photo ? Storage::url($official->photo) : 'https://images.unsplash.com/photo-1560250097-0b93528c311a?q=80&w=400&auto=format&fit=crop' }}"
                                class="w-full h-full object-cover object-top group-hover:scale-110 transition duration-500"
                                alt="{{ $official->name }}">
                        </div>
                        <div class="p-6 flex-grow flex flex-col justify-center bg-gray-50 group-hover:bg-white transition-colors">
                            <h4 class="font-bold text-base text-gray-800 mb-1 group-hover:text-dispora transition">{{ $official->name }}</h4>
                            <p class="text-sm font-semibold text-dispora uppercase tracking-wider">{{ $official->position }}</p>
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>
            @else
            <div class="text-center py-12 text-gray-500 bg-gray-50 rounded-xl border border-gray-100">
                Belum ada data struktur organisasi.
            </div>
            @endif
        </div>
    </section>

@endsection
