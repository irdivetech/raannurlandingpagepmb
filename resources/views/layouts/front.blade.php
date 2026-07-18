<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'RA An-Nuur - Mewujudkan Generasi Beriman & Bertaqwa')</title>
    <link rel="icon" type="image/jpeg" href="{{ asset('assets/img/logo/logosekolah.jpeg') }}">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Fredoka:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>

    <!-- Tailwind CSS (via CDN) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Outfit', 'sans-serif'],
                        display: ['Fredoka', 'sans-serif'],
                    },
                    colors: {
                        primary: '#10B981', // Emerald 500
                        primaryDark: '#047857', // Emerald 700
                        secondary: '#F59E0B', // Amber 500
                        accent: '#F43F5E', // Rose 500
                    }
                }
            }
        }
    </script>

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        .glass {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        @yield('styles')
    </style>
</head>

<body class="font-sans antialiased text-gray-800 bg-gray-50 selection:bg-primary selection:text-white overflow-x-hidden flex flex-col min-h-screen">

    <!-- Navbar (Always Solid for Inner Pages) -->
    <nav x-data="{ mobileMenuOpen: false }" class="fixed w-full top-0 z-50 glass shadow-sm py-3 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center">
                <!-- Logo -->
                <div class="flex items-center gap-3">
                    <img src="{{ asset('assets/img/logo/logosekolah.jpeg') }}" alt="Logo RA An-Nuur"
                        class="h-12 w-12 rounded-full border-2 border-emerald-100 shadow-sm object-cover">
                    <div>
                        <h1 class="font-display font-bold text-xl leading-tight text-primaryDark">RA AN-NUUR</h1>
                        <p class="text-xs font-medium tracking-wider uppercase text-gray-500">Cianjur, Jawa Barat</p>
                    </div>
                </div>

                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('pmb.landing') }}#beranda" class="font-medium text-gray-700 hover:text-primary transition-colors">Beranda</a>
                    <a href="{{ route('pmb.landing') }}#profil" class="font-medium text-gray-700 hover:text-primary transition-colors">Profil</a>
                    <a href="{{ route('pmb.landing') }}#akademik" class="font-medium text-gray-700 hover:text-primary transition-colors">Akademik</a>
                    <a href="{{ route('public.articles.index') }}" class="font-medium text-primary hover:text-primaryDark transition-colors">Artikel</a>
                    <a href="{{ route('public.biaya') }}" class="font-medium text-gray-700 hover:text-primary transition-colors">Biaya</a>
                    <a href="{{ route('public.kontak') }}" class="font-medium text-gray-700 hover:text-primary transition-colors">Kontak</a>
                    
                    <a href="{{ route('parent.login') }}"
                        class="px-6 py-2.5 rounded-full font-semibold transition-all shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 bg-primary text-white hover:bg-primaryDark">
                        PMB Online
                    </a>
                </div>

                <!-- Mobile menu button -->
                <div class="md:hidden flex items-center">
                    <button @click="mobileMenuOpen = !mobileMenuOpen" class="focus:outline-none text-gray-800">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path x-show="!mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                            <path x-show="mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div x-show="mobileMenuOpen" x-transition class="md:hidden bg-white absolute top-full left-0 w-full shadow-lg border-t border-gray-100">
            <div class="px-4 pt-2 pb-6 space-y-2 flex flex-col text-center">
                <a href="{{ route('pmb.landing') }}#beranda" class="block px-3 py-3 text-gray-800 font-medium hover:bg-gray-50 rounded-lg">Beranda</a>
                <a href="{{ route('pmb.landing') }}#profil" class="block px-3 py-3 text-gray-800 font-medium hover:bg-gray-50 rounded-lg">Profil</a>
                <a href="{{ route('pmb.landing') }}#akademik" class="block px-3 py-3 text-gray-800 font-medium hover:bg-gray-50 rounded-lg">Akademik</a>
                <a href="{{ route('public.articles.index') }}" class="block px-3 py-3 text-primary font-bold bg-emerald-50 rounded-lg">Artikel</a>
                <a href="{{ route('public.biaya') }}" class="block px-3 py-3 text-gray-800 font-medium hover:bg-gray-50 rounded-lg">Biaya</a>
                <a href="{{ route('public.kontak') }}" class="block px-3 py-3 text-gray-800 font-medium hover:bg-gray-50 rounded-lg">Kontak</a>
                <a href="{{ route('parent.login') }}" class="block w-full mt-4 bg-primary text-white px-6 py-3 rounded-full font-semibold shadow-md">
                    Portal PMB Online
                </a>
            </div>
        </div>
    </nav>

    <!-- Main Content Area -->
    <div class="flex-grow pt-20">
        @yield('content')
    </div>

    <!-- Footer -->
    <footer id="kontak" class="bg-gray-900 text-gray-300 pt-16 pb-8 mt-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-12">
                <!-- Branding -->
                <div class="lg:col-span-2">
                    <div class="flex items-center gap-3 mb-6">
                        <img src="{{ asset('assets/img/logo/logosekolah.jpeg') }}" alt="Logo" class="w-12 h-12 rounded-full border border-gray-700">
                        <h2 class="text-2xl font-display font-bold text-white">RA AN-NUUR</h2>
                    </div>
                    <p class="text-gray-400 mb-6 max-w-md leading-relaxed">
                        Lembaga pendidikan anak usia dini yang berdedikasi menciptakan generasi cerdas, ceria, dan berakhlakul karimah di bawah naungan Yayasan An-Nuur Nurul Iman.
                    </p>
                    <div class="flex gap-4">
                        <a href="https://www.facebook.com/share/198wgDDjZs/" target="_blank"
                            class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center hover:bg-primary transition-colors text-white">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" />
                            </svg>
                        </a>
                        <a href="https://www.instagram.com/ra.an_nuur.takokak?igsh=cGVwcWppY3AwcWg=" target="_blank"
                            class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center hover:bg-primary transition-colors text-white">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Tautan -->
                <div>
                    <h3 class="text-white font-bold mb-6 uppercase tracking-wider text-sm">Tautan Cepat</h3>
                    <ul class="space-y-3">
                        <li><a href="{{ route('pmb.landing') }}#beranda" class="hover:text-primary transition-colors">Beranda</a></li>
                        <li><a href="{{ route('pmb.landing') }}#profil" class="hover:text-primary transition-colors">Profil Sekolah</a></li>
                        <li><a href="{{ route('pmb.landing') }}#akademik" class="hover:text-primary transition-colors">Akademik & Fasilitas</a></li>
                        <li><a href="{{ route('public.articles.index') }}" class="hover:text-primary transition-colors">Artikel & Berita</a></li>
                        <li><a href="{{ route('parent.login') }}" class="hover:text-primary transition-colors">Portal PMB</a></li>
                    </ul>
                </div>

                <!-- Kontak -->
                <div>
                    <h3 class="text-white font-bold mb-6 uppercase tracking-wider text-sm">Hubungi Kami</h3>
                    <ul class="space-y-4">
                        <li class="flex items-start gap-3">
                            <span class="material-symbols-outlined text-primary text-xl mt-0.5">location_on</span>
                            <span class="text-sm">KP. CIJERUK RT.04 RW.02, Desa Waringinsari, Kec. Takokak, Kab. Cianjur</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <span class="material-symbols-outlined text-primary text-xl">call</span>
                            <span class="text-sm">0813-9549-6112 (Kepala RA)</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-800 pt-8 flex flex-col md:flex-row justify-between items-center gap-4 text-sm">
                <p>&copy; {{ date('Y') }} RA An-Nuur Cianjur. All rights reserved.</p>
                <p>Designed & Developed for Penerimaan Murid Baru</p>
            </div>
        </div>
    </footer>

    @yield('scripts')
</body>
</html>
