<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>RA An-Nuur - Mewujudkan Generasi Beriman & Bertaqwa</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Fredoka:wght@400;500;600&display=swap"
        rel="stylesheet">

    <!-- Tailwind CSS (via CDN for immediate styling, assuming Vite might not be running) -->
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

    <!-- Alpine.js for interactivity -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        .glass {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .text-gradient {
            background: linear-gradient(to right, #047857, #10B981);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .hero-pattern {
            background-color: #ffffff;
            opacity: 0.1;
            background-image: radial-gradient(#10B981 2px, transparent 2px), radial-gradient(#10B981 2px, #ffffff 2px);
            background-size: 80px 80px;
            background-position: 0 0, 40px 40px;
        }

        /* Reveal Animation */
        .reveal {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.8s ease-out;
        }

        .reveal.active {
            opacity: 1;
            transform: translateY(0);
        }

        /* Floating Animation */
        @keyframes float {
            0% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-10px);
            }

            100% {
                transform: translateY(0px);
            }
        }

        .floating {
            animation: float 4s ease-in-out infinite;
        }
    </style>
</head>

<body
    class="font-sans antialiased text-gray-800 bg-gray-50 selection:bg-primary selection:text-white overflow-x-hidden">

    <!-- Navbar -->
    <nav x-data="{ scrolled: false, mobileMenuOpen: false }"
        @scroll.window="scrolled = (window.pageYOffset > 20) ? true : false"
        :class="{ 'glass shadow-md py-3': scrolled, 'bg-transparent py-5': !scrolled }"
        class="fixed w-full top-0 z-50 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center">
                <!-- Logo -->
                <div class="flex items-center gap-3">
                    <img src="{{ asset('assets/img/logo/logosekolah.jpeg') }}" alt="Logo RA An-Nuur"
                        class="h-12 w-12 rounded-full border-2 border-white shadow-sm object-cover">
                    <div>
                        <h1 class="font-display font-bold text-xl leading-tight"
                            :class="scrolled ? 'text-primaryDark' : 'text-white'">RA AN-NUUR</h1>
                        <p class="text-xs font-medium tracking-wider uppercase"
                            :class="scrolled ? 'text-gray-500' : 'text-gray-200'">Cianjur, Jawa Barat</p>
                    </div>
                </div>

                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('pmb.landing') }}#beranda" class="font-medium hover:text-secondary transition-colors"
                        :class="scrolled ? 'text-gray-700' : 'text-white'">Beranda</a>
                    <a href="{{ route('pmb.landing') }}#profil" class="font-medium hover:text-secondary transition-colors"
                        :class="scrolled ? 'text-gray-700' : 'text-white'">Profil</a>
                    <a href="{{ route('pmb.landing') }}#akademik" class="font-medium hover:text-secondary transition-colors"
                        :class="scrolled ? 'text-gray-700' : 'text-white'">Akademik</a>
                    <a href="{{ route('public.biaya') }}" class="font-medium hover:text-secondary transition-colors"
                        :class="scrolled ? 'text-gray-700' : 'text-white'">Biaya</a>
                    <a href="{{ route('public.kontak') }}" class="font-medium hover:text-secondary transition-colors"
                        :class="scrolled ? 'text-gray-700' : 'text-white'">Kontak</a>
                    <a href="{{ route('pmb.tracking') }}" class="font-medium hover:text-secondary transition-colors"
                        :class="scrolled ? 'text-gray-700' : 'text-white'">Cek Status</a>

                    <a href="{{ route('parent.login') }}"
                        class="px-6 py-2.5 rounded-full font-semibold transition-all shadow-lg hover:shadow-xl transform hover:-translate-y-0.5"
                        :class="scrolled ? 'bg-primary text-white hover:bg-primaryDark' : 'bg-white text-primary hover:bg-gray-100'">
                        PMB Online
                    </a>
                </div>

                <!-- Mobile menu button -->
                <div class="md:hidden flex items-center">
                    <button @click="mobileMenuOpen = !mobileMenuOpen" class="focus:outline-none"
                        :class="scrolled ? 'text-gray-800' : 'text-white'">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path x-show="!mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                            <path x-show="mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div x-show="mobileMenuOpen" x-transition
            class="md:hidden glass absolute top-full left-0 w-full shadow-lg border-t border-gray-100">
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

    <!-- Hero Section -->
    <section id="beranda" class="relative min-h-[90vh] flex items-center pt-20 overflow-hidden">
        <!-- Background Image with Overlay -->
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('assets/img/sekolah/1.jpeg') }}" alt="Gedung RA An-Nuur"
                class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-r from-emerald-900/90 to-emerald-800/70"></div>
        </div>

        <!-- Animated Elements -->
        <div
            class="absolute top-1/4 left-10 w-24 h-24 bg-yellow-400 rounded-full mix-blend-multiply filter blur-xl opacity-50 floating">
        </div>
        <div class="absolute bottom-1/4 right-10 w-32 h-32 bg-emerald-400 rounded-full mix-blend-multiply filter blur-xl opacity-50 floating"
            style="animation-delay: 2s;"></div>

        <div
            class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row items-center justify-between w-full">
            <div class="md:w-3/5 text-center md:text-left mb-12 md:mb-0 reveal active">
                <span
                    class="inline-block py-1 px-3 rounded-full bg-emerald-500/30 border border-emerald-400/50 text-white text-sm font-semibold tracking-wider mb-6">
                    Menerima Peserta Didik Baru Tahun Ajaran 2025/2026
                </span>
                <h1 class="font-display text-5xl md:text-7xl font-bold text-white mb-6 leading-tight">
                    Membangun Generasi <br />
                    <span class="text-secondary">Cerdas & Berakhlak</span>
                </h1>
                <p class="text-lg md:text-xl text-emerald-50 mb-8 max-w-2xl leading-relaxed">
                    MEWUJUDKAN SISTEM PENDIDIKAN YANG BERBASIS IMAN DAN TAQWA.
                    Kami siap membimbing putra-putri Anda untuk menjadi generasi yang sehat, aktif, cerdas, dan
                    berakhlakul karimah.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center md:justify-start">
                    @if (Route::has('pmb.register'))
                        <a href="{{ route('pmb.register') }}"
                            class="px-8 py-4 bg-secondary text-white rounded-full font-bold text-lg hover:bg-yellow-500 transition-all shadow-[0_0_20px_rgba(245,158,11,0.4)] hover:shadow-[0_0_30px_rgba(245,158,11,0.6)] transform hover:-translate-y-1 text-center">
                            Daftar Sekarang
                        </a>
                    @endif
                    <a href="#profil"
                        class="px-8 py-4 bg-white/10 backdrop-blur-sm border border-white/30 text-white rounded-full font-bold text-lg hover:bg-white/20 transition-all text-center">
                        Kenali Kami Lebih Dekat
                    </a>
                </div>
            </div>

            <!-- Hero Decorative Image/Card -->
            <div class="md:w-2/5 flex justify-center reveal active" style="transition-delay: 0.2s;">
                <div
                    class="glass p-4 rounded-3xl w-full max-w-sm transform rotate-3 hover:rotate-0 transition-transform duration-500 shadow-2xl relative">
                    <div class="absolute -top-6 -right-6 bg-white p-3 rounded-2xl shadow-xl z-20 floating">
                        <img src="{{ asset('assets/img/logo/logosekolah.jpeg') }}"
                            class="w-16 h-16 rounded-xl object-cover">
                    </div>
                    <img src="{{ asset('assets/img/kegiatan/new/24.jpeg') }}" alt="Kegiatan Siswa"
                        class="w-full h-80 object-cover rounded-2xl shadow-inner">
                    <div
                        class="absolute -bottom-5 left-1/2 transform -translate-x-1/2 bg-white px-6 py-2 rounded-full shadow-lg text-sm font-bold text-primary whitespace-nowrap">
                        Ayo Bergabung Bersama Kami!
                    </div>
                </div>
            </div>
        </div>

        <!-- Wave shape divider -->
        <div class="absolute bottom-0 w-full leading-none z-10">
            <svg class="w-full h-16 md:h-24 fill-current text-gray-50" viewBox="0 0 1200 120"
                preserveAspectRatio="none">
                <path
                    d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V120H0V95.8C59.71,118.08,130.83,119.25,187.39,109.43Z">
                </path>
            </svg>
        </div>
    </section>

    <!-- Stats/Highlight Bar -->
    <div class="relative z-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-8 md:-mt-12 mb-20 reveal">
        <div
            class="glass bg-white/90 rounded-2xl shadow-xl p-8 grid grid-cols-2 md:grid-cols-4 gap-6 text-center divide-x divide-gray-100">
            <div>
                <p class="text-4xl font-display font-bold text-primary mb-1">
                    <svg class="w-10 h-10 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                    </svg>
                </p>
                <p class="text-gray-500 font-medium text-sm">Sudah Terakreditasi</p>
            </div>
            <div>
                <p class="text-4xl font-display font-bold text-primary mb-1">69+</p>
                <p class="text-gray-500 font-medium text-sm">Siswa Aktif</p>
            </div>
            <div>
                <p class="text-4xl font-display font-bold text-primary mb-1">2007</p>
                <p class="text-gray-500 font-medium text-sm">Tahun Berdiri</p>
            </div>
            <div>
                <p class="text-4xl font-display font-bold text-primary mb-1">3</p>
                <p class="text-gray-500 font-medium text-sm">Tenaga Pendidik</p>
            </div>
        </div>
    </div>

    <!-- Profil Utama -->
    <section id="profil" class="py-20 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row gap-16 items-center">
                <!-- Text Content -->
                <div class="lg:w-1/2 reveal">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="h-1 w-12 bg-secondary rounded"></div>
                        <h3 class="text-secondary font-bold uppercase tracking-wider text-sm">Tentang Kami</h3>
                    </div>
                    <h2 class="text-4xl md:text-5xl font-display font-bold text-gray-900 mb-6">Membentuk Karakter Sejak
                        Usia Dini</h2>
                    <p class="text-gray-600 mb-8 text-lg leading-relaxed">
                        Di bawah naungan <strong>Yayasan An-Nuur Nurul Iman</strong>, RA An-Nuur sudah berdiri sejak
                        2007,
                        berkomitmen penuh dalam menyelenggarakan pendidikan anak usia
                        dini yang berfokus pada pengembangan akhlak mulia dan kecerdasan komprehensif.
                    </p>

                    <div class="space-y-6">
                        <!-- Misi Item -->
                        <div class="flex gap-4 items-start">
                            <div
                                class="flex-shrink-0 w-12 h-12 rounded-full bg-emerald-100 flex items-center justify-center text-primary">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="text-xl font-bold text-gray-900 mb-2">Menanamkan Aqidah Islam</h4>
                                <p class="text-gray-600">Membekali anak dengan pondasi keimanan yang kuat sejak dini.
                                </p>
                            </div>
                        </div>
                        <!-- Misi Item -->
                        <div class="flex gap-4 items-start">
                            <div
                                class="flex-shrink-0 w-12 h-12 rounded-full bg-emerald-100 flex items-center justify-center text-primary">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="text-xl font-bold text-gray-900 mb-2">Meningkatkan Keterampilan</h4>
                                <p class="text-gray-600">Mengembangkan minat, bakat, serta kreativitas melalui
                                    pembelajaran yang menyenangkan.</p>
                            </div>
                        </div>
                        <!-- Misi Item -->
                        <div class="flex gap-4 items-start">
                            <div
                                class="flex-shrink-0 w-12 h-12 rounded-full bg-emerald-100 flex items-center justify-center text-primary">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="text-xl font-bold text-gray-900 mb-2">Generasi Sehat, Cerdas, & Berakhlak
                                </h4>
                                <p class="text-gray-600">Menciptakan lingkungan yang mendukung pertumbuhan fisik,
                                    mental, dan spiritual yang seimbang.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Identity Card -->
                <div class="lg:w-1/2 reveal" style="transition-delay: 0.2s;">
                    <div class="bg-white p-8 rounded-3xl shadow-xl relative overflow-hidden border border-gray-100">
                        <!-- Decorative background -->
                        <div
                            class="absolute top-0 right-0 w-40 h-40 bg-emerald-50 rounded-full mix-blend-multiply filter blur-xl transform translate-x-10 -translate-y-10">
                        </div>

                        <div class="relative z-10">
                            <div class="flex items-center gap-4 mb-8 pb-6 border-b border-gray-100">
                                <img src="{{ asset('assets/img/logo/logoyayasan.jpeg') }}"
                                    class="w-20 h-20 rounded-lg object-contain shadow-sm border border-gray-100">
                                <div>
                                    <h3 class="text-2xl font-bold text-gray-900">Identitas Sekolah</h3>
                                    <p class="text-primary font-medium">Status: Swasta (Terakreditasi)</p>
                                </div>
                            </div>

                            <ul class="space-y-4">
                                <li
                                    class="flex justify-between items-center py-2 border-b border-gray-50 border-dashed">
                                    <span class="text-gray-500 font-medium">NPSN</span>
                                    <span
                                        class="text-gray-900 font-bold bg-gray-100 px-3 py-1 rounded-md">69734541</span>
                                </li>
                                <li
                                    class="flex justify-between items-center py-2 border-b border-gray-50 border-dashed">
                                    <span class="text-gray-500 font-medium">NSM / NSPAUD</span>
                                    <span class="text-gray-900 font-bold">101232030134</span>
                                </li>
                                <li
                                    class="flex justify-between items-center py-2 border-b border-gray-50 border-dashed">
                                    <span class="text-gray-500 font-medium">Akreditasi</span>
                                    <span class="text-emerald-600 font-bold flex items-center gap-1">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        SK No. PAUD-RA/20700/0121/12/2022
                                    </span>
                                </li>
                                <li class="flex flex-col gap-1 py-2">
                                    <span class="text-gray-500 font-medium">Yayasan Penyelenggara</span>
                                    <span class="text-gray-900 font-bold">YAYASAN AN-NUUR NURUL IMAN</span>
                                    <span class="text-xs text-gray-400">SK Menkumham: AHU-0034763.AH.01.04.TAHUN
                                        2015</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Akademik & Fasilitas -->
    <section id="akademik" class="py-20 bg-emerald-900 text-white relative overflow-hidden">
        <!-- Pattern Overlay -->
        <div class="absolute inset-0 opacity-10"
            style="background-image: radial-gradient(#fff 1px, transparent 1px); background-size: 30px 30px;"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center max-w-3xl mx-auto mb-16 reveal">
                <h2 class="text-4xl md:text-5xl font-display font-bold mb-4">Akademik & Fasilitas</h2>
                <p class="text-emerald-100 text-lg">Menciptakan lingkungan belajar yang nyaman dan kondusif untuk
                    mendukung proses tumbuh kembang anak secara optimal.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Card 1 -->
                <div
                    class="bg-emerald-800/50 backdrop-blur border border-emerald-700/50 p-8 rounded-3xl hover:bg-emerald-800 transition-colors reveal">
                    <div class="w-14 h-14 bg-secondary rounded-2xl flex items-center justify-center mb-6 shadow-lg">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold mb-3">Waktu Belajar</h3>
                    <p class="text-emerald-100 mb-4">Kegiatan belajar mengajar dilaksanakan pada <strong>pagi
                            hari</strong>.</p>
                    <div
                        class="inline-flex items-center gap-2 bg-emerald-900/80 px-4 py-2 rounded-full text-sm font-medium">
                        <svg class="w-4 h-4 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                            </path>
                        </svg>
                        6 Hari Kerja (Senin - Sabtu)
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="bg-emerald-800/50 backdrop-blur border border-emerald-700/50 p-8 rounded-3xl hover:bg-emerald-800 transition-colors reveal"
                    style="transition-delay: 0.2s;">
                    <div class="w-14 h-14 bg-accent rounded-2xl flex items-center justify-center mb-6 shadow-lg">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold mb-3">Kapasitas Siswa</h3>
                    <p class="text-emerald-100 mb-4">Pembagian rombongan belajar (rombel) yang proporsional.</p>
                    <ul class="space-y-2 text-sm">
                        <li class="flex justify-between items-center bg-emerald-900/50 p-2 rounded-lg">
                            <span>Kelas A (Usia 4-5 th)</span>
                            <span class="font-bold text-secondary">35 Siswa / 2 Rombel</span>
                        </li>
                        <li class="flex justify-between items-center bg-emerald-900/50 p-2 rounded-lg">
                            <span>Kelas B (Usia 5-6 th)</span>
                            <span class="font-bold text-accent">21 Siswa / 1 Rombel</span>
                        </li>
                    </ul>
                </div>

                <!-- Card 3 -->
                <div class="bg-emerald-800/50 backdrop-blur border border-emerald-700/50 p-8 rounded-3xl hover:bg-emerald-800 transition-colors reveal"
                    style="transition-delay: 0.4s;">
                    <div class="w-14 h-14 bg-blue-500 rounded-2xl flex items-center justify-center mb-6 shadow-lg">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold mb-3">Fasilitas Dasar</h3>
                    <p class="text-emerald-100 mb-4">Bangunan milik sendiri yang asri dan aman untuk aktivitas
                        anak-anak.</p>
                    <div class="space-y-3">
                        <div class="flex items-center gap-3">
                            <div class="w-2 h-2 rounded-full bg-secondary"></div>
                            <span>Luas Tanah: <strong>160 m²</strong></span>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="w-2 h-2 rounded-full bg-secondary"></div>
                            <span>Luas Bangunan: <strong>160 m²</strong></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Tenaga Pendidik -->
    <section class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16 reveal">
                <div class="flex items-center justify-center gap-4 mb-4">
                    <div class="h-1 w-8 bg-primary rounded"></div>
                    <h3 class="text-primary font-bold uppercase tracking-wider text-sm">Tim Pengajar</h3>
                    <div class="h-1 w-8 bg-primary rounded"></div>
                </div>
                <h2 class="text-4xl md:text-5xl font-display font-bold text-gray-900 mb-4">Tenaga Pendidik Berdedikasi
                </h2>
                <p class="text-gray-600 text-lg">Guru-guru kami siap membimbing dengan penuh kasih sayang dan kesabaran
                    untuk mengoptimalkan potensi setiap anak.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-5xl mx-auto">
                <!-- Teacher 1 -->
                <div
                    class="bg-white rounded-3xl overflow-hidden shadow-lg hover:shadow-xl transition-shadow border border-gray-100 group reveal">
                    <div class="h-32 bg-emerald-100 relative">
                        <div class="absolute -bottom-16 left-1/2 transform -translate-x-1/2">
                            <div class="w-32 h-32 bg-white rounded-full p-2">
                                <div
                                    class="w-full h-full rounded-full bg-emerald-50 border-4 border-emerald-500 flex items-center justify-center text-4xl overflow-hidden">
                                    👩‍🏫
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="pt-20 pb-8 px-6 text-center">
                        <h4 class="text-2xl font-bold text-gray-900 mb-1">UMI SALAMAH, S.Pd.I</h4>
                        <p class="text-primary font-medium mb-3">Kepala Madrasah</p>
                        <span
                            class="inline-block bg-gray-100 text-gray-600 text-xs px-3 py-1 rounded-full font-medium">Pendidikan
                            S1</span>
                    </div>
                </div>

                <!-- Teacher 2 -->
                <div class="bg-white rounded-3xl overflow-hidden shadow-lg hover:shadow-xl transition-shadow border border-gray-100 group reveal"
                    style="transition-delay: 0.2s;">
                    <div class="h-32 bg-secondary/20 relative">
                        <div class="absolute -bottom-16 left-1/2 transform -translate-x-1/2">
                            <div class="w-32 h-32 bg-white rounded-full p-2">
                                <div
                                    class="w-full h-full rounded-full bg-yellow-50 border-4 border-secondary flex items-center justify-center text-4xl overflow-hidden">
                                    👩‍🏫
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="pt-20 pb-8 px-6 text-center">
                        <h4 class="text-2xl font-bold text-gray-900 mb-1">SOLIHAH</h4>
                        <p class="text-secondary font-medium mb-3">Guru Kelas</p>
                        <span
                            class="inline-block bg-gray-100 text-gray-600 text-xs px-3 py-1 rounded-full font-medium">Pendidikan
                            SMA</span>
                    </div>
                </div>

                <!-- Teacher 3 -->
                <div class="bg-white rounded-3xl overflow-hidden shadow-lg hover:shadow-xl transition-shadow border border-gray-100 group reveal"
                    style="transition-delay: 0.4s;">
                    <div class="h-32 bg-accent/20 relative">
                        <div class="absolute -bottom-16 left-1/2 transform -translate-x-1/2">
                            <div class="w-32 h-32 bg-white rounded-full p-2">
                                <div
                                    class="w-full h-full rounded-full bg-rose-50 border-4 border-accent flex items-center justify-center text-4xl overflow-hidden">
                                    👩‍🏫
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="pt-20 pb-8 px-6 text-center">
                        <h4 class="text-2xl font-bold text-gray-900 mb-1">ROSANAH</h4>
                        <p class="text-accent font-medium mb-3">Guru Kelas</p>
                        <span
                            class="inline-block bg-gray-100 text-gray-600 text-xs px-3 py-1 rounded-full font-medium">Pendidikan
                            SMA</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Galeri & Kegiatan -->
    <section id="galeri" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-end mb-12 reveal">
                <div class="max-w-2xl">
                    <h2 class="text-4xl md:text-5xl font-display font-bold text-gray-900 mb-4">Galeri & Kegiatan</h2>
                    <p class="text-gray-600 text-lg">Intip berbagai momen ceria dan aktivitas seru siswa-siswi RA
                        An-Nuur dalam proses belajar dan bermain.</p>
                </div>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <!-- Image 1 -->
                <div class="col-span-2 row-span-2 relative rounded-3xl overflow-hidden group shadow-lg reveal">
                    <img src="{{ asset('assets/img/kegiatan/new/6.jpeg') }}"
                        class="w-full h-full object-cover aspect-square md:aspect-auto md:h-full transition-transform duration-700 group-hover:scale-110">
                    <div
                        class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/0 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end">
                        <div class="p-6">
                            <p class="text-white font-bold text-xl">Pemberian Sertifikat Siswa Berprestasi</p>
                        </div>
                    </div>
                </div>
                <!-- Image 2 -->
                <div class="relative rounded-3xl overflow-hidden group shadow-md reveal"
                    style="transition-delay: 0.1s;">
                    <img src="{{ asset('assets/img/kegiatan/new/17.jpeg') }}"
                        class="w-full h-full object-cover aspect-square transition-transform duration-700 group-hover:scale-110">
                    <div
                        class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/0 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end">
                        <div class="p-4 w-full text-left">
                            <p class="text-white font-bold text-sm">Kegiatan Senam Pagi</p>
                        </div>
                    </div>
                </div>
                <!-- Image 3 -->
                <div class="relative rounded-3xl overflow-hidden group shadow-md reveal"
                    style="transition-delay: 0.2s;">
                    <img src="{{ asset('assets/img/kegiatan/new/18.jpeg') }}"
                        class="w-full h-full object-cover aspect-square transition-transform duration-700 group-hover:scale-110">
                    <div
                        class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/0 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end">
                        <div class="p-4 w-full text-left">
                            <p class="text-white font-bold text-sm">Pentas Seni</p>
                        </div>
                    </div>
                </div>
                <!-- Image 4 -->
                <div class="relative rounded-3xl overflow-hidden group shadow-md reveal"
                    style="transition-delay: 0.3s;">
                    <img src="{{ asset('assets/img/kegiatan/new/29.jpeg') }}"
                        class="w-full h-full object-cover aspect-square transition-transform duration-700 group-hover:scale-110">
                    <div
                        class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/0 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end">
                        <div class="p-4 w-full text-left">
                            <p class="text-white font-bold text-sm">Kreativitas Anak</p>
                        </div>
                    </div>
                </div>
                <!-- Image 5 (Piala) -->
                <div class="relative rounded-3xl overflow-hidden group shadow-md reveal"
                    style="transition-delay: 0.4s;">
                    <img src="{{ asset('assets/img/piala/1.jpeg') }}"
                        class="w-full h-full object-cover aspect-square transition-transform duration-700 group-hover:scale-110">
                    <div
                        class="absolute inset-0 bg-gradient-to-t from-secondary/80 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end">
                        <div class="p-4 w-full text-center">
                            <p class="text-white font-bold text-sm">Prestasi Sekolah</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA PMB -->
    <section class="py-20 relative overflow-hidden">
        <div class="absolute inset-0 bg-primary"></div>
        <div class="absolute inset-0 opacity-20"
            style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'1\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');">
        </div>

        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center reveal">
            <h2 class="text-4xl md:text-5xl font-display font-bold text-white mb-6">Pendaftaran Murid Baru Telah Dibuka!
            </h2>
            <p class="text-emerald-100 text-xl mb-10">Mari bergabung bersama keluarga besar RA An-Nuur. Daftarkan
                putra-putri Anda secara online dengan mudah dan cepat melalui portal PMB kami.</p>
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="{{ route('parent.login') }}"
                    class="px-8 py-4 bg-white text-primary rounded-full font-bold text-lg hover:bg-gray-50 transition-all shadow-xl">
                    Masuk Portal PMB
                </a>
                @if (Route::has('pmb.register'))
                    <a href="{{ route('pmb.register') }}"
                        class="px-8 py-4 bg-secondary text-white rounded-full font-bold text-lg hover:bg-yellow-500 transition-all shadow-xl">
                        Mulai Pendaftaran
                    </a>
                @endif
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer id="kontak" class="bg-gray-900 text-gray-300 pt-20 pb-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-16">
                <!-- Branding -->
                <div class="lg:col-span-2">
                    <div class="flex items-center gap-3 mb-6">
                        <img src="{{ asset('assets/img/logo/logosekolah.jpeg') }}" alt="Logo"
                            class="w-12 h-12 rounded-full border border-gray-700">
                        <h2 class="text-2xl font-display font-bold text-white">RA AN-NUUR</h2>
                    </div>
                    <p class="text-gray-400 mb-6 max-w-md leading-relaxed">
                        Lembaga pendidikan anak usia dini yang berdedikasi menciptakan generasi cerdas, ceria, dan
                        berakhlakul karimah di bawah naungan Yayasan An-Nuur Nurul Iman.
                    </p>
                    <div class="flex gap-4">
                        <a href="#"
                            class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center hover:bg-primary transition-colors text-white">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z" />
                            </svg>
                        </a>
                        <a href="#"
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
                        <li><a href="#beranda" class="hover:text-primary transition-colors">Beranda</a></li>
                        <li><a href="#profil" class="hover:text-primary transition-colors">Profil Sekolah</a></li>
                        <li><a href="#akademik" class="hover:text-primary transition-colors">Akademik & Fasilitas</a>
                        </li>
                        <li><a href="#galeri" class="hover:text-primary transition-colors">Galeri</a></li>
                        <li><a href="{{ route('parent.login') }}" class="hover:text-primary transition-colors">Portal
                                PMB</a></li>
                    </ul>
                </div>

                <!-- Kontak -->
                <div>
                    <h3 class="text-white font-bold mb-6 uppercase tracking-wider text-sm">Hubungi Kami</h3>
                    <ul class="space-y-4">
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-primary flex-shrink-0 mt-1" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                </path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <span class="text-sm">KP. CIJERUK RT.04 RW.02, Desa Waringinsari, Kec. Takokak, Kab.
                                Cianjur, Jawa Barat 43265</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-primary flex-shrink-0" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                </path>
                            </svg>
                            <span class="text-sm">0813-9549-6112 (Kepala RA)</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-primary flex-shrink-0" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                </path>
                            </svg>
                            <span class="text-sm">raannurtakokak@gmail.com</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div
                class="border-t border-gray-800 pt-8 flex flex-col md:flex-row justify-between items-center gap-4 text-sm">
                <p>&copy; {{ date('Y') }} RA An-Nuur Cianjur. All rights reserved.</p>
                <p>Designed & Developed for Penerimaan Murid Baru</p>
            </div>
        </div>
    </footer>

    <!-- Intersection Observer for Reveal Animation -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const reveals = document.querySelectorAll(".reveal");

            const revealOnScroll = function () {
                for (let i = 0; i < reveals.length; i++) {
                    const windowHeight = window.innerHeight;
                    const elementTop = reveals[i].getBoundingClientRect().top;
                    const elementVisible = 100;

                    if (elementTop < windowHeight - elementVisible) {
                        reveals[i].classList.add("active");
                    }
                }
            };

            window.addEventListener("scroll", revealOnScroll);
            revealOnScroll(); // Trigger once on load
        });
    </script>
</body>

</html>