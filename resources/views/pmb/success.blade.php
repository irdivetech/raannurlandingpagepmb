<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pendaftaran Berhasil | RA An-Nuur</title>
    <link rel="icon" type="image/jpeg" href="{{ asset('assets/img/logo/logosekolah.jpeg') }}">
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
            </div>
        </div>
    </nav>

    <main class="flex-grow flex items-center justify-center py-12 md:py-20 relative overflow-hidden bg-gray-50">
        <!-- Decorative background elements -->
        <div class="absolute top-10 right-10 w-64 h-64 bg-primary rounded-full blur-[80px] opacity-10 animate-pulse pointer-events-none"></div>
        <div class="absolute bottom-10 left-10 w-72 h-72 bg-secondary rounded-full blur-[80px] opacity-10 pointer-events-none"></div>

        <div class="max-w-2xl w-full px-4 relative z-10">
            <div class="bg-white rounded-3xl p-8 md:p-12 shadow-xl border border-gray-100 text-center relative overflow-hidden">
                <!-- Decorative corner -->
                <div class="absolute -top-16 -left-16 w-32 h-32 bg-primary rounded-full blur-[40px] opacity-10 pointer-events-none"></div>

                <!-- Success Icon Animation -->
                <div class="w-24 h-24 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-6 relative">
                    <div class="absolute inset-0 bg-primary/20 rounded-full animate-ping opacity-75"></div>
                    <span class="material-symbols-outlined text-6xl text-primary relative z-10" style="font-variation-settings: 'FILL' 1;">check_circle</span>
                </div>

                <h1 class="font-display text-3xl md:text-4xl font-bold text-gray-900 mb-4">Pendaftaran Berhasil!</h1>
                <p class="text-gray-500 mb-8 text-lg">
                    Alhamdulillah, data pendaftaran Ananda <span class="font-bold text-gray-900">{{ session('childName', 'Calon Siswa') }}</span> telah kami terima dan tersimpan di sistem.
                </p>

                <!-- Registration Number Card -->
                <div class="bg-gray-50 border border-dashed border-gray-300 rounded-xl p-6 mb-8 max-w-md mx-auto">
                    <p class="font-bold text-sm text-gray-500 uppercase tracking-wider mb-2">Nomor Pendaftaran Anda</p>
                    <div class="font-display text-3xl font-bold text-primary tracking-widest bg-gray-100 px-4 py-2 rounded-lg inline-block">
                        {{ session('regNumber', 'REG-XXXXXXXX') }}
                    </div>
                    <p class="text-sm text-gray-500 mt-3 text-xs">Simpan nomor ini untuk melakukan pengecekan status.</p>
                </div>

                <!-- Next Steps Information -->
                <div class="text-left bg-gray-50 rounded-xl p-6 mb-8 border border-gray-200">
                    <h3 class="font-bold text-gray-900 mb-3 flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary">info</span> Langkah Selanjutnya:
                    </h3>
                    <ul class="list-disc list-inside space-y-2 text-sm text-gray-600">
                        <li>Pendaftaran Anda sedang dalam status <strong>Verifikasi</strong>.</li>
                        <li>Bagi yang belum melampirkan dokumen (KK, Akta, dll), dokumen dapat disusulkan nanti secara online dengan membuat <strong>Akun Dashboard Orang Tua</strong> di bawah, atau diserahkan langsung ke sekolah.</li>
                        <li>Anda bisa selalu memantau status pendaftaran dengan Nomor Registrasi di atas melalui fitur <a href="{{ route('pmb.tracking') }}" class="text-primary hover:underline font-bold">Cek Status</a> di halaman depan.</li>
                    </ul>
                </div>

                <!-- Optional Account Creation Form -->
                <div class="text-left bg-primary/5 rounded-xl p-6 mb-8 border border-primary/20 shadow-sm relative overflow-hidden">
                    <div class="absolute top-0 right-0 p-4 opacity-5 pointer-events-none text-primary">
                        <span class="material-symbols-outlined text-6xl">account_circle</span>
                    </div>
                    
                    <h3 class="font-display text-lg font-bold text-gray-900 mb-2">Buat Akun Dashboard Orang Tua <span class="text-xs font-normal bg-secondary text-white px-2 py-1 rounded-full ml-2 align-middle">Opsional</span></h3>
                    <p class="text-sm text-gray-600 mb-6 relative z-10">
                        Miliki akses khusus ke portal untuk menyusul dokumen yang kurang, memantau detail tagihan, dan melihat perkembangan seleksi secara *real-time*.
                    </p>

                    <form action="{{ route('pmb.create_account') }}" method="POST" class="space-y-4 relative z-10">
                        @csrf
                        <input type="hidden" name="registration_id" value="{{ session('registration_id') }}">
                        
                        <div class="space-y-1">
                            <label class="font-bold text-sm text-gray-600">Email Login *</label>
                            <input type="email" name="email" value="{{ session('email') }}" required class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-white focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all text-gray-800">
                            @error('email')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="space-y-1">
                            <label class="font-bold text-sm text-gray-600">Buat Password *</label>
                            <input type="password" name="password" required minlength="6" placeholder="Minimal 6 karakter" class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-white focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all text-gray-800">
                            @error('password')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit" class="w-full bg-primary text-white py-3 rounded-xl font-bold hover:bg-primaryDark transition-all active:scale-95 shadow-md flex items-center justify-center gap-2 mt-2">
                            <span class="material-symbols-outlined text-[20px]">person_add</span> Buat Akun Sekarang
                        </button>
                    </form>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('pmb.tracking') }}" class="bg-white text-primary border border-primary px-8 py-3 rounded-xl font-bold hover:bg-primary/5 transition-all flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined text-[20px]">search</span> Cek Status Saja
                    </a>
                    <a href="{{ route('pmb.landing') }}" class="bg-white text-gray-600 border border-gray-200 px-8 py-3 rounded-xl font-bold hover:bg-gray-50 transition-all flex items-center justify-center gap-2">
                        Ke Beranda
                    </a>
                </div>

            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-400 py-8 text-center text-sm mt-auto border-t border-gray-800">
        <p>&copy; {{ date('Y') }} RA An-Nuur. Hak cipta dilindungi.</p>
    </footer>
</body>
</html>
