<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kontak Kami | RA An-Nuur</title>
    <link rel="icon" type="image/jpeg" href="{{ asset('assets/img/logo/logosekolah.jpeg') }}">
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
        <div class="absolute top-20 -left-20 w-96 h-96 bg-primary rounded-full mix-blend-multiply filter blur-3xl opacity-10 pointer-events-none"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-secondary rounded-full mix-blend-multiply filter blur-3xl opacity-10 pointer-events-none"></div>
        
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center mb-16 animate-[fadeInUp_0.5s_ease-out]">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-emerald-100 text-primary mb-4 shadow-inner">
                    <span class="material-symbols-outlined text-3xl">contact_support</span>
                </div>
                <h2 class="font-display text-4xl md:text-5xl font-bold text-gray-900 mb-4">Hubungi Kami</h2>
                <p class="text-gray-500 max-w-2xl mx-auto text-lg">Punya pertanyaan seputar pendaftaran atau program sekolah? Jangan ragu untuk menghubungi kami. Tim kami siap membantu Anda.</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-8 items-start animate-[fadeInUp_0.7s_ease-out]">
                
                <!-- Info Kontak -->
                <div class="space-y-6">
                    
                    <div class="bg-white rounded-3xl p-8 border border-gray-100 shadow-sm hover:shadow-md transition-shadow flex items-start gap-5">
                        <div class="w-14 h-14 bg-emerald-50 text-primary rounded-2xl flex items-center justify-center flex-shrink-0">
                            <span class="material-symbols-outlined text-3xl">location_on</span>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-900 text-lg mb-2">Alamat Sekolah</h4>
                            <p class="text-gray-600 leading-relaxed">{{ \App\Models\Setting::get('kontak_alamat', 'Kp. Pasir Nangka RT.003/RW.001, Ds. Sukasirna, Kec. Campakamulya, Kab. Cianjur, Jawa Barat 43269') }}</p>
                        </div>
                    </div>

                    <div class="bg-white rounded-3xl p-8 border border-gray-100 shadow-sm hover:shadow-md transition-shadow flex items-start gap-5">
                        <div class="w-14 h-14 bg-blue-50 text-blue-500 rounded-2xl flex items-center justify-center flex-shrink-0">
                            <span class="material-symbols-outlined text-3xl">call</span>
                        </div>
                        <div>
                            @php $wa = \App\Models\Setting::get('kontak_wa', '628174935445'); @endphp
                            <h4 class="font-bold text-gray-900 text-lg mb-2">Telepon / WhatsApp</h4>
                            <p class="text-gray-600 mb-2">Panitia PMB: <a href="https://api.whatsapp.com/send?phone={{ $wa }}" target="_blank" class="text-blue-500 font-bold hover:underline">+{{ $wa }}</a></p>
                            <p class="text-gray-600">Jam Kerja: Senin - Sabtu (08.00 - 14.00 WIB)</p>
                            <a href="https://api.whatsapp.com/send?phone={{ $wa }}" target="_blank" class="inline-flex items-center gap-2 mt-4 px-4 py-2 bg-green-500 text-white rounded-xl text-sm font-bold shadow-sm hover:bg-green-600 transition-colors">
                                <span class="material-symbols-outlined text-[18px]">forum</span> Chat via WhatsApp
                            </a>
                        </div>
                    </div>

                    <div class="bg-white rounded-3xl p-8 border border-gray-100 shadow-sm hover:shadow-md transition-shadow flex items-start gap-5">
                        <div class="w-14 h-14 bg-rose-50 text-rose-500 rounded-2xl flex items-center justify-center flex-shrink-0">
                            <span class="material-symbols-outlined text-3xl">mail</span>
                        </div>
                        <div>
                            @php $email = \App\Models\Setting::get('kontak_email', 'info@raannuur.sch.id'); @endphp
                            <h4 class="font-bold text-gray-900 text-lg mb-2">Email</h4>
                            <p class="text-gray-600"><a href="mailto:{{ $email }}" class="text-rose-500 font-bold hover:underline">{{ $email }}</a></p>
                            <p class="text-sm text-gray-500 mt-2">Untuk keperluan administratif dan kerjasama.</p>
                        </div>
                    </div>

                </div>

                <!-- Formulir Pesan -->
                <div class="bg-white rounded-3xl p-8 md:p-10 border border-gray-100 shadow-xl">
                    <h3 class="font-display text-2xl font-bold text-gray-900 mb-6">Kirim Pesan Cepat</h3>
                    <div id="contactForm">
                        <div class="space-y-5">
                            <div>
                                <label for="name" class="block text-sm font-bold text-gray-700 mb-2">Nama Lengkap</label>
                                <input type="text" id="name" class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all" placeholder="Masukkan nama Anda">
                            </div>
                            <div>
                                <label for="phone" class="block text-sm font-bold text-gray-700 mb-2">Nomor Telepon / WhatsApp Anda</label>
                                <input type="text" id="phone" class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all" placeholder="08xxx">
                            </div>
                            <div>
                                <label for="message" class="block text-sm font-bold text-gray-700 mb-2">Pesan Anda</label>
                                <textarea id="message" rows="5" class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all resize-none" placeholder="Tuliskan pertanyaan atau pesan Anda di sini..."></textarea>
                            </div>
                            <button type="button" id="sendBtn" class="w-full bg-primary text-white py-4 rounded-xl font-bold hover:bg-primaryDark transition-all shadow-lg hover:shadow-primary/30 active:scale-[0.98] flex items-center justify-center gap-2">
                                <span class="material-symbols-outlined text-[18px]">send</span> Kirim ke WhatsApp
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </main>

    <script>
        document.getElementById('sendBtn').addEventListener('click', function() {
            const name = document.getElementById('name').value.trim();
            const phone = document.getElementById('phone').value.trim();
            const message = document.getElementById('message').value.trim();
            
            if(!name || !phone || !message) {
                alert('Mohon lengkapi semua kolom (Nama, No. WA, dan Pesan) terlebih dahulu.');
                return;
            }
            
            // Nomor WhatsApp tujuan Admin (gunakan kode negara 62)
            const waNumber = '{{ \App\Models\Setting::get("kontak_wa", "628174935445") }}'; 
            
            // Format pesan yang lebih ramah dan natural
            const waText = encodeURIComponent(`Assalamu'alaikum, Admin RA An-Nuur.\nSaya *${name}*, ingin bertanya mengenai pendaftaran siswa baru (PMB).\n\nBerikut pesan/pertanyaan saya:\n"${message}"\n\nTerima kasih.`);
            
            const waUrl = `https://api.whatsapp.com/send?phone=${waNumber}&text=${waText}`;
            
            // Langsung alihkan halaman tanpa window.open untuk menghindari bug 2 klik dan popup blocker
            window.location.href = waUrl;
        });
    </script>
    
    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-400 py-8 text-center text-sm border-t border-gray-800">
        <p>&copy; {{ date('Y') }} RA An-Nuur. Hak cipta dilindungi.</p>
    </footer>

    <style>
        @keyframes fadeInUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
    </style>
</body>
</html>
