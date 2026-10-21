<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Administrasi - Dispora Jatim</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        /* Floating Orbs Animation */
        @keyframes float-slow {
            0%, 100% { transform: translate(0, 0) scale(1); }
            25% { transform: translate(30px, -50px) scale(1.1); }
            50% { transform: translate(-20px, 20px) scale(0.9); }
            75% { transform: translate(50px, 30px) scale(1.05); }
        }
        @keyframes float-slower {
            0%, 100% { transform: translate(0, 0) scale(1); }
            33% { transform: translate(-40px, 30px) scale(1.15); }
            66% { transform: translate(20px, -40px) scale(0.95); }
        }
        @keyframes pulse-glow {
            0%, 100% { opacity: 0.4; }
            50% { opacity: 0.8; }
        }
        .orb-1 { animation: float-slow 15s ease-in-out infinite; }
        .orb-2 { animation: float-slower 20s ease-in-out infinite; }
        .orb-3 { animation: float-slow 18s ease-in-out infinite reverse; }
        .orb-4 { animation: float-slower 12s ease-in-out infinite; }
        .pulse-glow { animation: pulse-glow 3s ease-in-out infinite; }

        /* Geometric Pattern */
        .geo-pattern {
            background-image: 
                linear-gradient(30deg, rgba(255,255,255,0.03) 12%, transparent 12.5%, transparent 87%, rgba(255,255,255,0.03) 87.5%, rgba(255,255,255,0.03)),
                linear-gradient(150deg, rgba(255,255,255,0.03) 12%, transparent 12.5%, transparent 87%, rgba(255,255,255,0.03) 87.5%, rgba(255,255,255,0.03)),
                linear-gradient(30deg, rgba(255,255,255,0.03) 12%, transparent 12.5%, transparent 87%, rgba(255,255,255,0.03) 87.5%, rgba(255,255,255,0.03)),
                linear-gradient(150deg, rgba(255,255,255,0.03) 12%, transparent 12.5%, transparent 87%, rgba(255,255,255,0.03) 87.5%, rgba(255,255,255,0.03)),
                linear-gradient(60deg, rgba(255,255,255,0.05) 25%, transparent 25.5%, transparent 75%, rgba(255,255,255,0.05) 75%, rgba(255,255,255,0.05)),
                linear-gradient(60deg, rgba(255,255,255,0.05) 25%, transparent 25.5%, transparent 75%, rgba(255,255,255,0.05) 75%, rgba(255,255,255,0.05));
            background-size: 80px 140px;
            background-position: 0 0, 0 0, 40px 70px, 40px 70px, 0 0, 40px 70px;
        }

        /* Form entrance animation */
        @keyframes slideUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-slide-up {
            animation: slideUp 0.8s ease-out both;
        }
        .animate-slide-up-delay-1 { animation-delay: 0.1s; }
        .animate-slide-up-delay-2 { animation-delay: 0.2s; }
        .animate-slide-up-delay-3 { animation-delay: 0.3s; }
        .animate-slide-up-delay-4 { animation-delay: 0.4s; }
        .animate-slide-up-delay-5 { animation-delay: 0.5s; }

        /* Glassmorphism card */
        .glass-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.15);
        }

        /* Input focus lift */
        .input-wrapper {
            transition: all 0.3s ease;
        }
        .input-wrapper:focus-within {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px -5px rgba(0, 82, 155, 0.15);
        }
    </style>
</head>

<body class="antialiased bg-gray-50 text-gray-900">

    <div class="min-h-screen flex" x-data="{ showPassword: false, loading: false }">

        <!-- KOLOM KIRI: Branding Panel dengan Gradient & Efek -->
        <div class="hidden md:flex md:w-1/2 relative overflow-hidden bg-gradient-to-br from-teal-700 via-teal-500 to-white">
            
            <!-- Geometric Pattern Overlay -->
            <div class="absolute inset-0 geo-pattern"></div>

            <!-- Floating Orbs -->
            <div class="orb-1 absolute top-20 left-20 w-64 h-64 bg-blue-500/20 rounded-full blur-3xl"></div>
            <div class="orb-2 absolute bottom-32 right-10 w-80 h-80 bg-cyan-400/15 rounded-full blur-3xl"></div>
            <div class="orb-3 absolute top-1/2 left-1/3 w-48 h-48 bg-indigo-500/20 rounded-full blur-3xl"></div>
            <div class="orb-4 absolute top-10 right-1/4 w-32 h-32 bg-teal-400/20 rounded-full blur-2xl"></div>

            <!-- Content -->
            <div class="relative z-10 flex flex-col justify-between p-10 lg:p-16 text-white w-full h-full">
                
                <!-- Top: Logo & Branding -->
                <div>
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-14 h-14 rounded-2xl flex items-center justify-center shadow-lg p-2">
                            <img src="{{ asset('images/logo.jpeg') }}" alt="Logo Dispora Jatim" class="w-full h-full object-contain">
                        </div>
                        <div>
                            <h3 class="font-bold text-lg leading-tight">Dinas Kepemudaan dan Olahraga</h3>
                            <span class="text-sm text-white/60 font-medium">Provinsi Jawa Timur</span>
                        </div>
                    </div>
                </div>

                <!-- Center: Shield Icon + Title -->
                <div class="flex-1 flex flex-col justify-center">
                    <!-- Glowing Shield Icon -->
                    <!-- <div class="mb-8 relative">
                        <div class="w-20 h-20 bg-gradient-to-br from-cyan-400 to-blue-600 rounded-2xl flex items-center justify-center shadow-2xl transform -rotate-6">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                            </svg>
                        </div>
                        <div class="pulse-glow absolute -inset-4 bg-cyan-400/20 rounded-3xl blur-xl -z-10"></div>
                    </div> -->

                    <h1 class="text-2xl lg:text-3xl font-black mb-4 leading-tight">
                        Login Administrasi
                    </h1>
                    <div class="w-16 h-1.5 bg-gradient-to-r from-cyan-400 to-blue-500 rounded-full mb-6"></div>
                    <p class="text-lg text-white/60 max-w-md font-medium leading-relaxed">
                        Portal resmi layanan administrasi dan informasi Dinas Kepemudaan dan Olahraga Provinsi Jawa Timur.
                    </p>
                </div>

                <!-- Bottom: Glassmorphism Stat Cards -->
                <!-- <div class="flex gap-4 mt-8">
                    <div class="glass-card rounded-2xl px-5 py-4 flex items-center gap-3 flex-1">
                        <div class="w-10 h-10 bg-cyan-400/20 rounded-xl flex items-center justify-center">
                            <svg class="w-5 h-5 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                        <div>
                            <span class="block text-2xl font-black">256</span>
                            <span class="text-xs text-white/50 font-medium">Kegiatan Aktif</span>
                        </div>
                    </div>
                    <div class="glass-card rounded-2xl px-5 py-4 flex items-center gap-3 flex-1">
                        <div class="w-10 h-10 bg-blue-400/20 rounded-xl flex items-center justify-center">
                            <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        </div>
                        <div>
                            <span class="block text-2xl font-black">1.2K</span>
                            <span class="text-xs text-white/50 font-medium">Pengguna</span>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>

        <!-- KOLOM KANAN: Form Login -->
        <div class="w-full md:w-1/2 flex items-center justify-center p-6 sm:p-12 relative overflow-hidden">
            
            <!-- Subtle background orbs for right panel -->
            <div class="orb-2 absolute -top-20 -right-20 w-64 h-64 bg-blue-100/50 rounded-full blur-3xl"></div>
            <div class="orb-3 absolute -bottom-20 -left-20 w-48 h-48 bg-cyan-100/40 rounded-full blur-3xl"></div>

            <div class="w-full max-w-md relative z-10">

                <!-- Mobile Logo -->
                <div class="md:hidden flex items-center gap-4 mb-10 animate-slide-up">
                    <div class="w-12 h-12 bg-white rounded-xl flex items-center justify-center shadow-md border border-gray-100 p-1.5">
                        <img src="{{ asset('images/logo.jpeg') }}" alt="Logo Dispora Jatim" class="w-full h-full object-contain">
                    </div>
                    <div>
                        <h2 class="text-xl font-extrabold text-gray-800 leading-none">Login Administrasi</h2>
                        <span class="text-xs font-semibold text-dispora">DISPORA JAWA TIMUR</span>
                    </div>
                </div>

                <!-- Greeting -->
                <div class="mb-10 animate-slide-up animate-slide-up-delay-1">
                    <h2 class="text-3xl font-black text-gray-900 mb-2">Selamat Datang 👋</h2>
                    <p class="text-gray-500 font-medium">Silakan masuk menggunakan kredensial Anda untuk mengakses panel administrasi.</p>
                </div>

                <!-- Login Form -->
                <form action="{{ route('login.store') }}" method="POST" class="space-y-6" x-on:submit="loading = true">
                    @csrf

                    <!-- Email Input -->
                    <div class="animate-slide-up animate-slide-up-delay-2">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Email / Username</label>
                        <div class="input-wrapper flex items-center w-full px-4 py-3.5 rounded-xl border border-gray-200 bg-gray-50/80 focus-within:bg-white focus-within:border-dispora focus-within:ring-2 focus-within:ring-dispora/20 overflow-hidden">
                            <svg class="h-5 w-5 text-gray-400 shrink-0 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            <input type="text" name="email" value="{{ old('email') }}"
                                class="w-full bg-transparent border-none p-0 focus:ring-0 text-sm font-medium text-gray-800 outline-none placeholder-gray-400"
                                placeholder="admin@dispora.jatimprov.go.id" required autofocus>
                        </div>
                        @error('email')
                            <p class="mt-2 text-xs text-red-500 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password Input -->
                    <div class="animate-slide-up animate-slide-up-delay-3">
                        <div class="flex justify-between items-center mb-2">
                            <label class="block text-sm font-bold text-gray-700">Kata Sandi</label>
                            <a href="{{ route('password.request') }}" class="text-xs font-bold text-dispora hover:text-dispora-dark hover:underline transition">Lupa sandi?</a>
                        </div>
                        <div class="input-wrapper flex items-center w-full px-4 py-3.5 rounded-xl border border-gray-200 bg-gray-50/80 focus-within:bg-white focus-within:border-dispora focus-within:ring-2 focus-within:ring-dispora/20 overflow-hidden">
                            <svg class="h-5 w-5 text-gray-400 shrink-0 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                            <input :type="showPassword ? 'text' : 'password'" name="password" id="password"
                                class="w-full bg-transparent border-none p-0 focus:ring-0 text-sm font-medium text-gray-800 outline-none placeholder-gray-400"
                                placeholder="••••••••" required>
                            <!-- Toggle Show/Hide Password -->
                            <button type="button" @click="showPassword = !showPassword" class="ml-2 text-gray-400 hover:text-dispora transition shrink-0 focus:outline-none">
                                <!-- Eye Open -->
                                <svg x-show="!showPassword" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                                <!-- Eye Closed -->
                                <svg x-show="showPassword" x-cloak class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>
                                </svg>
                            </button>
                        </div>
                        @error('password')
                            <p class="mt-2 text-xs text-red-500 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center animate-slide-up animate-slide-up-delay-4">
                        <input type="checkbox" id="remember" name="remember"
                            class="w-4 h-4 text-dispora border-gray-300 rounded focus:ring-dispora cursor-pointer">
                        <label for="remember" class="ml-2 text-sm text-gray-600 font-medium cursor-pointer">Ingat saya di perangkat ini</label>
                    </div>

                    <!-- Session Error -->
                    @if(session('error'))
                        <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl text-sm font-medium flex items-center gap-3">
                            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            {{ session('error') }}
                        </div>
                    @endif

                    <!-- Submit Button -->
                    <div class="pt-2 animate-slide-up animate-slide-up-delay-5">
                        <button type="submit" :disabled="loading"
                            class="w-full bg-gradient-to-r from-dispora to-[#0e7490] hover:from-dispora-dark hover:to-[#0c6478] disabled:opacity-70 disabled:cursor-not-allowed text-white font-bold py-3.5 px-4 rounded-xl transition-all shadow-lg hover:shadow-xl flex justify-center items-center gap-2 transform hover:-translate-y-0.5 active:translate-y-0">
                            
                            <!-- Default State -->
                            <template x-if="!loading">
                                <span class="flex items-center gap-2">
                                    Masuk ke Sistem
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                    </svg>
                                </span>
                            </template>
                            
                            <!-- Loading State -->
                            <template x-if="loading">
                                <span class="flex items-center gap-2">
                                    <svg class="animate-spin w-5 h-5" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                    Memproses...
                                </span>
                            </template>
                        </button>

                        <div class="text-center mt-6">
                            <a href="{{ url('/') }}"
                                class="inline-flex items-center justify-center text-sm font-bold text-gray-500 hover:text-dispora transition group">
                                <svg class="w-4 h-4 mr-2 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                </svg>
                                Kembali ke Beranda
                            </a>
                        </div>
                    </div>
                </form>

                <!-- Footer -->
                <div class="mt-10 pt-6 border-t border-gray-100 text-center animate-slide-up animate-slide-up-delay-5">
                    <p class="text-xs text-gray-400 font-medium leading-relaxed">
                        &copy; {{ date('Y') }} Dinas Kepemudaan dan Olahraga Prov. Jatim.<br>
                        Hanya untuk penggunaan internal pegawai teregistrasi.
                    </p>
                </div>

            </div>
        </div>

    </div>

</body>

</html>
