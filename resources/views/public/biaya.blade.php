<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Program Biaya Pendaftaran | RA An-Nuur</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Fredoka:wght@400;500;600&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
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
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        .glass { background: rgba(255, 255, 255, 0.85); backdrop-filter: blur(12px); border: 1px solid rgba(255, 255, 255, 0.3); }
        .hero-pattern { background-color: #ffffff; opacity: 0.1; background-image: radial-gradient(#10B981 2px, transparent 2px), radial-gradient(#10B981 2px, #ffffff 2px); background-size: 80px 80px; background-position: 0 0, 40px 40px; }
    </style>
</head>

<body class="font-sans antialiased text-gray-800 bg-gray-50 selection:bg-primary selection:text-white">

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
                    <a href="{{ route('public.biaya') }}" class="font-medium hover:text-secondary transition-colors {{ request()->routeIs('public.biaya') ? 'text-primary font-bold' : 'text-gray-700' }}">Biaya</a>
                    <a href="{{ route('public.kontak') }}" class="font-medium hover:text-secondary transition-colors {{ request()->routeIs('public.kontak') ? 'text-primary font-bold' : 'text-gray-700' }}">Kontak</a>
                    <a href="{{ route('pmb.tracking') }}" class="font-medium hover:text-secondary transition-colors {{ request()->routeIs('pmb.tracking') ? 'text-primary font-bold' : 'text-gray-700' }}">Cek Status</a>

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
                    class="block px-3 py-3 text-gray-800 font-medium hover:bg-gray-50 rounded-lg {{ request()->routeIs('public.biaya') ? 'text-primary bg-emerald-50' : '' }}">Biaya</a>
                <a href="{{ route('public.kontak') }}" @click="mobileMenuOpen = false"
                    class="block px-3 py-3 text-gray-800 font-medium hover:bg-gray-50 rounded-lg {{ request()->routeIs('public.kontak') ? 'text-primary bg-emerald-50' : '' }}">Kontak</a>
                <a href="{{ route('pmb.tracking') }}" @click="mobileMenuOpen = false"
                    class="block px-3 py-3 text-gray-800 font-medium hover:bg-gray-50 rounded-lg {{ request()->routeIs('pmb.tracking') ? 'text-primary bg-emerald-50' : '' }}">Cek Status</a>
                <a href="{{ route('parent.login') }}"
                    class="block w-full mt-4 bg-primary text-white px-6 py-3 rounded-full font-semibold shadow-md">
                    Portal PMB Online
                </a>
            </div>
        </div>
    </nav>

    <main class="min-h-[85vh] py-12 md:py-20 relative overflow-hidden">
        <!-- Background Decor -->
        <div class="absolute top-0 left-0 w-full h-full hero-pattern z-0 pointer-events-none"></div>
        <div class="absolute top-20 right-0 w-96 h-96 bg-primary rounded-full mix-blend-multiply filter blur-3xl opacity-10 pointer-events-none"></div>
        
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center mb-16 animate-[fadeInUp_0.5s_ease-out]">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-emerald-100 text-primary mb-4 shadow-inner">
                    <span class="material-symbols-outlined text-3xl">payments</span>
                </div>
                <h2 class="font-display text-4xl md:text-5xl font-bold text-gray-900 mb-4">Program Biaya Pendidikan</h2>
                <p class="text-gray-500 max-w-2xl mx-auto text-lg">Investasi terbaik untuk pendidikan usia dini ananda. Kami menawarkan biaya pendidikan yang transparan dan terjangkau dengan fasilitas memadai.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 animate-[fadeInUp_0.7s_ease-out]">
                
                <!-- Biaya Awal Masuk -->
                <div class="bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden relative group hover:shadow-2xl transition-all duration-300 flex flex-col">
                    <div class="absolute top-0 left-0 w-full h-2 bg-primary group-hover:h-3 transition-all"></div>
                    <div class="p-6 lg:p-8 flex-1 flex flex-col">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="font-display text-2xl font-bold text-gray-900">Biaya Awal</h3>
                            <span class="material-symbols-outlined text-3xl text-emerald-200">checkroom</span>
                        </div>
                        <p class="text-sm text-gray-500 mb-6">Dibayarkan satu kali saat masuk. Hanya untuk seragam.</p>
                        
                        <ul class="space-y-4 mb-6 flex-1">
                            <li class="flex items-start gap-3">
                                <span class="material-symbols-outlined text-primary mt-0.5 text-[18px]">check_circle</span>
                                <div>
                                    <p class="font-bold text-gray-900 text-sm">Batik Setel</p>
                                    <p class="text-xs text-gray-500">Rp {{ number_format((int)\App\Models\Setting::get('biaya_batik', 150000), 0, ',', '.') }}</p>
                                </div>
                            </li>
                            <li class="flex items-start gap-3">
                                <span class="material-symbols-outlined text-primary mt-0.5 text-[18px]">check_circle</span>
                                <div>
                                    <p class="font-bold text-gray-900 text-sm">Kaos Olahraga</p>
                                    <p class="text-xs text-gray-500">Rp {{ number_format((int)\App\Models\Setting::get('biaya_olahraga', 110000), 0, ',', '.') }}</p>
                                </div>
                            </li>
                            <li class="flex items-start gap-3">
                                <span class="material-symbols-outlined text-amber-500 mt-0.5 text-[18px]">info</span>
                                <div>
                                    <p class="font-bold text-gray-900 text-sm">Seragam Ungu</p>
                                    <p class="text-xs text-gray-500">Beli sendiri / mandiri</p>
                                </div>
                            </li>
                        </ul>

                        <div class="pt-4 border-t border-gray-100 mt-auto">
                            <p class="text-xs text-gray-500 font-bold mb-1">Total Biaya Awal</p>
                            @php $totalAwal = (int)\App\Models\Setting::get('biaya_batik', 150000) + (int)\App\Models\Setting::get('biaya_olahraga', 110000); @endphp
                            <p class="font-display text-3xl font-bold text-gray-900">Rp {{ number_format($totalAwal, 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>

                <!-- Biaya Tahunan -->
                <div class="bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden relative group hover:shadow-2xl transition-all duration-300 flex flex-col">
                    <div class="absolute top-0 left-0 w-full h-2 bg-secondary group-hover:h-3 transition-all"></div>
                    <div class="p-6 lg:p-8 flex-1 flex flex-col">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="font-display text-2xl font-bold text-gray-900">Biaya Tahunan</h3>
                            <span class="material-symbols-outlined text-3xl text-amber-200">menu_book</span>
                        </div>
                        <p class="text-sm text-gray-500 mb-6">Kebutuhan LKA, Rapot, dan Buku Pembelajaran.</p>
                        
                        <ul class="space-y-4 mb-6 flex-1">
                            <li class="flex items-start gap-3">
                                <span class="material-symbols-outlined text-secondary mt-0.5 text-[18px]">check_circle</span>
                                <div>
                                    <p class="font-bold text-gray-900 text-sm">Lembar Kerja Anak (LKA)</p>
                                    <p class="text-xs text-gray-500">Rp {{ number_format((int)\App\Models\Setting::get('biaya_lka', 120000), 0, ',', '.') }}</p>
                                </div>
                            </li>
                            <li class="flex items-start gap-3">
                                <span class="material-symbols-outlined text-secondary mt-0.5 text-[18px]">check_circle</span>
                                <div>
                                    <p class="font-bold text-gray-900 text-sm">Buku Paket (9 Buku)</p>
                                    <p class="text-xs text-gray-500">Rp {{ number_format((int)\App\Models\Setting::get('biaya_buku', 120000), 0, ',', '.') }}</p>
                                </div>
                            </li>
                            <li class="flex items-start gap-3">
                                <span class="material-symbols-outlined text-secondary mt-0.5 text-[18px]">check_circle</span>
                                <div>
                                    <p class="font-bold text-gray-900 text-sm">Sampul Rapot</p>
                                    <p class="text-xs text-gray-500">Rp {{ number_format((int)\App\Models\Setting::get('biaya_sampul', 50000), 0, ',', '.') }}</p>
                                </div>
                            </li>
                        </ul>

                        <div class="pt-4 border-t border-gray-100 mt-auto">
                            <p class="text-xs text-gray-500 font-bold mb-1">Total Biaya Tahunan</p>
                            @php $totalTahunan = (int)\App\Models\Setting::get('biaya_lka', 120000) + (int)\App\Models\Setting::get('biaya_buku', 120000) + (int)\App\Models\Setting::get('biaya_sampul', 50000); @endphp
                            <p class="font-display text-3xl font-bold text-gray-900">Rp {{ number_format($totalTahunan, 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>

                <!-- Biaya SPP Bulanan -->
                <div class="bg-gradient-to-br from-emerald-50 to-emerald-100 rounded-3xl shadow-xl border border-emerald-200 overflow-hidden relative group hover:shadow-2xl transition-all duration-300 flex flex-col">
                    <div class="absolute -right-10 -bottom-10 opacity-10 pointer-events-none">
                        <span class="material-symbols-outlined text-[100px] text-emerald-800">event_repeat</span>
                    </div>
                    <div class="p-6 lg:p-8 relative z-10 h-full flex flex-col">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="font-display text-2xl font-bold text-gray-900">Bulanan</h3>
                            <span class="bg-emerald-200 text-emerald-800 text-[10px] font-bold px-2 py-1 rounded-full uppercase tracking-wider">Rutin</span>
                        </div>
                        <p class="text-sm text-gray-600 mb-6">Biaya pendidikan bulanan dan tabungan akhir tahun.</p>
                        
                        <ul class="space-y-4 mb-6 flex-1">
                            <li class="flex items-start gap-3">
                                <span class="material-symbols-outlined text-emerald-600 mt-0.5 text-[18px]">check_circle</span>
                                <div>
                                    <p class="font-bold text-gray-900 text-sm">SPP Bulanan</p>
                                    <p class="text-xs text-gray-600">Rp {{ number_format((int)\App\Models\Setting::get('spp_bulanan', 20000), 0, ',', '.') }} / bulan</p>
                                </div>
                            </li>
                            <li class="flex items-start gap-3">
                                <span class="material-symbols-outlined text-emerald-600 mt-0.5 text-[18px]">check_circle</span>
                                <div>
                                    <p class="font-bold text-gray-900 text-sm">Biaya Akhir Tahun</p>
                                    <p class="text-xs text-gray-600">Rp {{ number_format((int)\App\Models\Setting::get('biaya_akhir_tahun', 10000), 0, ',', '.') }} / bulan</p>
                                </div>
                            </li>
                        </ul>

                        <div class="pt-4 border-t border-emerald-200 mt-auto">
                            <p class="text-xs text-emerald-700 font-bold mb-1">Total Per Bulan</p>
                            @php $totalBulanan = (int)\App\Models\Setting::get('spp_bulanan', 20000) + (int)\App\Models\Setting::get('biaya_akhir_tahun', 10000); @endphp
                            <p class="font-display text-3xl font-bold text-gray-900">Rp {{ number_format($totalBulanan, 0, ',', '.') }} <span class="text-sm text-emerald-700 font-normal">/bln</span></p>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Note section -->
            <div class="mt-12 bg-white rounded-2xl p-6 border border-gray-100 shadow-sm flex items-start gap-4">
                <span class="material-symbols-outlined text-amber-500 mt-1">info</span>
                <div>
                    <h4 class="font-bold text-gray-900">Catatan Penting:</h4>
                    <p class="text-sm text-gray-600 mt-1 leading-relaxed">
                        - Biaya pendaftaran awal/registrasi akun PMB adalah <strong>Gratis</strong>.<br>
                        - Nominal biaya di atas dapat berubah sewaktu-waktu sesuai dengan kebijakan yayasan. Rincian tagihan final akan diberikan kepada orang tua setelah calon siswa dinyatakan lulus.<br>
                        - Tersedia program keringanan biaya bagi siswa berprestasi atau yatim/piatu (syarat dan ketentuan berlaku, silakan hubungi bagian administrasi).
                    </p>
                </div>
            </div>

            <div class="mt-12 text-center">
                <a href="{{ route('parent.login') }}" class="inline-flex items-center justify-center gap-2 px-8 py-4 bg-primary text-white rounded-full font-bold text-lg hover:bg-primaryDark transition-all shadow-xl hover:-translate-y-1">
                    Daftar Sekarang <span class="material-symbols-outlined text-[20px]">arrow_forward</span>
                </a>
            </div>

        </div>
    </main>
    
    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-400 py-8 text-center text-sm border-t border-gray-800">
        <p>&copy; {{ date('Y') }} RA An-Nuur. Hak cipta dilindungi.</p>
    </footer>

    <style>
        @keyframes fadeInUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
    </style>
</body>
</html>
