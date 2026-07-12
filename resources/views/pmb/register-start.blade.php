<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mulai Pendaftaran | PMB RA An-Nuur</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Fredoka:wght@400;500;600&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Outfit', 'sans-serif'], display: ['Fredoka', 'sans-serif'] },
                    colors: { primary: '#10B981', primaryDark: '#047857', secondary: '#F59E0B', accent: '#F43F5E' }
                }
            }
        }
    </script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <style>
        .glass { background: rgba(255, 255, 255, 0.85); backdrop-filter: blur(12px); border: 1px solid rgba(255, 255, 255, 0.3); }
        .hero-pattern { background-color: #ffffff; opacity: 0.1; background-image: radial-gradient(#10B981 2px, transparent 2px), radial-gradient(#10B981 2px, #ffffff 2px); background-size: 80px 80px; background-position: 0 0, 40px 40px; }
    </style>
</head>

<body class="font-sans antialiased text-gray-800 bg-gray-50 selection:bg-primary selection:text-white flex flex-col min-h-screen">
    
    <!-- Navbar -->
    <nav x-data="{ mobileMenuOpen: false }"
        class="bg-white/95 backdrop-blur-md shadow-sm py-3 sticky top-0 z-50 border-b border-gray-100 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center">
                <!-- Logo -->
                <a href="{{ route('pmb.landing') }}" class="flex items-center gap-3">
                    <img src="{{ asset('assets/img/logo/logosekolah.jpeg') }}" alt="Logo RA An-Nuur"
                        class="h-10 w-10 sm:h-12 sm:w-12 rounded-full border border-gray-200 shadow-sm object-cover">
                    <div>
                        <h1 class="font-display font-bold text-lg sm:text-xl leading-tight text-primaryDark">RA AN-NUUR</h1>
                        <p class="text-[10px] sm:text-xs font-medium tracking-wider uppercase text-gray-500">Cianjur, Jawa Barat</p>
                    </div>
                </a>

                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('pmb.landing') }}#beranda" class="font-medium hover:text-secondary transition-colors text-gray-700">Beranda</a>
                    <a href="{{ route('pmb.landing') }}#profil" class="font-medium hover:text-secondary transition-colors text-gray-700">Profil</a>
                    <a href="{{ route('pmb.landing') }}#akademik" class="font-medium hover:text-secondary transition-colors text-gray-700">Akademik</a>
                    <a href="{{ route('public.biaya') }}" class="font-medium hover:text-secondary transition-colors text-gray-700">Biaya</a>
                    <a href="{{ route('public.kontak') }}" class="font-medium hover:text-secondary transition-colors text-gray-700">Kontak</a>
                    <a href="{{ route('pmb.tracking') }}" class="font-medium hover:text-secondary transition-colors text-gray-700">Cek Status</a>

                    <a href="{{ route('parent.login') }}"
                        class="px-6 py-2.5 rounded-full font-semibold transition-all shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 bg-primary text-white hover:bg-primaryDark">
                        PMB Online
                    </a>
                </div>

                <!-- Mobile menu button -->
                <div class="md:hidden flex items-center">
                    <button @click="mobileMenuOpen = !mobileMenuOpen" class="focus:outline-none text-gray-800">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path x-show="!mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                            <path x-show="mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="M6 18L18 6M6 6l12 12" style="display: none;"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div x-show="mobileMenuOpen" x-transition
            class="md:hidden bg-white/95 backdrop-blur-md absolute top-full left-0 w-full shadow-lg border-t border-gray-100" style="display: none;">
            <div class="px-4 pt-2 pb-6 space-y-2 flex flex-col text-center">
                <a href="{{ route('pmb.landing') }}#beranda" @click="mobileMenuOpen = false"
                    class="block px-3 py-3 text-gray-800 font-medium hover:bg-gray-50 rounded-lg">Beranda</a>
                <a href="{{ route('pmb.landing') }}#profil" @click="mobileMenuOpen = false"
                    class="block px-3 py-3 text-gray-800 font-medium hover:bg-gray-50 rounded-lg">Profil</a>
                <a href="{{ route('pmb.landing') }}#akademik" @click="mobileMenuOpen = false"
                    class="block px-3 py-3 text-gray-800 font-medium hover:bg-gray-50 rounded-lg">Akademik</a>
                <a href="{{ route('public.biaya') }}" @click="mobileMenuOpen = false"
                    class="block px-3 py-3 text-gray-800 font-medium hover:bg-gray-50 rounded-lg">Biaya</a>
                <a href="{{ route('public.kontak') }}" @click="mobileMenuOpen = false"
                    class="block px-3 py-3 text-gray-800 font-medium hover:bg-gray-50 rounded-lg">Kontak</a>
                <a href="{{ route('pmb.tracking') }}" @click="mobileMenuOpen = false"
                    class="block px-3 py-3 text-gray-800 font-medium hover:bg-gray-50 rounded-lg">Cek Status</a>
                <a href="{{ route('parent.login') }}"
                    class="block w-full mt-4 bg-primary text-white px-6 py-3 rounded-full font-semibold shadow-md">
                    Portal PMB Online
                </a>
            </div>
        </div>
    </nav>
    
    <main class="flex-grow flex items-center justify-center py-12 md:py-20 relative overflow-hidden">
        <!-- Background Decor -->
        <div class="absolute top-0 left-0 w-full h-full hero-pattern z-0 pointer-events-none"></div>
        <div class="absolute top-20 -right-20 w-96 h-96 bg-primary rounded-full mix-blend-multiply filter blur-3xl opacity-10 pointer-events-none"></div>
        <div class="absolute bottom-20 -left-20 w-96 h-96 bg-secondary rounded-full mix-blend-multiply filter blur-3xl opacity-10 pointer-events-none"></div>

        <div class="max-w-2xl w-full px-4 relative z-10 animate-[fadeInUp_0.5s_ease-out]">
            
            <!-- Header Text -->
            <div class="text-center mb-10">
                <div class="inline-flex items-center justify-center w-20 h-20 rounded-3xl bg-emerald-100 text-primary mb-6 shadow-inner transform rotate-3">
                    <span class="material-symbols-outlined text-5xl">app_registration</span>
                </div>
                <h1 class="font-display text-4xl md:text-5xl font-bold text-gray-900 mb-3">Pendaftaran Baru</h1>
                <p class="text-lg text-gray-500 max-w-lg mx-auto">
                    Silakan masukkan data awal untuk mendapatkan Nomor Pendaftaran. Akun Portal opsional dapat dibuat setelah pengisian form.
                </p>
            </div>

            <!-- Start Form Card -->
            <div class="bg-white border border-gray-100 rounded-3xl p-8 md:p-10 shadow-xl relative overflow-hidden">
                <!-- Decorative corner -->
                <div class="absolute -top-16 -right-16 w-32 h-32 bg-yellow-400 rounded-full blur-[40px] opacity-20 pointer-events-none"></div>
                
                <form action="{{ route('pmb.steps', ['step' => 1]) }}" method="GET" class="relative z-10">
                    <div class="space-y-6">
                        <!-- Child Name -->
                        <div class="space-y-2">
                            <label for="childName" class="block font-bold text-gray-700">Nama Lengkap Calon Siswa</label>
                            <div class="relative">
                                <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">person</span>
                                <input type="text" id="childName" name="childName" placeholder="Sesuai Akta Kelahiran" required
                                    class="w-full pl-12 pr-4 py-3.5 rounded-xl border border-gray-200 bg-gray-50 focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all text-gray-800 placeholder:text-gray-400">
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="space-y-2">
                            <label for="email" class="block font-bold text-gray-700">Alamat Email Orang Tua</label>
                            <div class="relative">
                                <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">mail</span>
                                <input type="email" id="email" name="email" placeholder="contoh@email.com" required
                                    class="w-full pl-12 pr-4 py-3.5 rounded-xl border border-gray-200 bg-gray-50 focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all text-gray-800 placeholder:text-gray-400">
                            </div>
                            <p class="text-xs text-gray-500 mt-1 flex items-center gap-1"><span class="material-symbols-outlined text-[14px]">info</span> Pastikan email aktif. Bukti pendaftaran akan dikirim ke email ini.</p>
                        </div>

                        <!-- Phone -->
                        <div class="space-y-2">
                            <label for="phone" class="block font-bold text-gray-700">Nomor WhatsApp Aktif</label>
                            <div class="relative">
                                <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">phone_iphone</span>
                                <span class="absolute left-11 top-1/2 -translate-y-1/2 text-gray-500 font-bold">+62</span>
                                <input type="tel" id="phone" name="phone" placeholder="81234567890" required
                                    class="w-full pl-20 pr-4 py-3.5 rounded-xl border border-gray-200 bg-gray-50 focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all text-gray-800 placeholder:text-gray-400">
                            </div>
                        </div>
                    </div>

                    <!-- Submit Action -->
                    <div class="mt-10 pt-6 border-t border-gray-100">
                        <button type="submit" class="w-full bg-primary text-white py-4 rounded-xl font-bold text-lg hover:bg-primaryDark transition-all active:scale-[0.98] shadow-lg hover:shadow-primary/30 flex items-center justify-center gap-2 group">
                            Mulai Isi Formulir
                            <span class="material-symbols-outlined group-hover:translate-x-1 transition-transform">arrow_forward</span>
                        </button>
                        
                        <div class="text-center mt-6">
                            <p class="text-sm text-gray-500">
                                Sudah mendaftar sebelumnya? <br class="md:hidden"/>
                                <a href="{{ route('pmb.tracking') }}" class="font-bold text-primary hover:underline ml-1">Cek Status Pendaftaran</a>
                            </p>
                        </div>
                    </div>
                </form>
            </div>
            
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-400 py-8 text-center text-sm mt-auto border-t border-gray-800">
        <p>&copy; {{ date('Y') }} RA An-Nuur. Hak cipta dilindungi.</p>
    </footer>

</body>
</html>
