<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Portal PMB RA An-Nuur - Masuk</title>
    <link rel="icon" type="image/jpeg" href="{{ asset('assets/img/logo/logosekolah.jpeg') }}">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Fredoka:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />

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
            background: rgba(255, 255, 255, 0.90);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.4);
        }
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        
        /* Hide default browser eye icon for password inputs */
        input::-ms-reveal,
        input::-ms-clear {
            display: none;
        }
    </style>
</head>
<body class="font-sans antialiased text-gray-800 bg-gray-50 selection:bg-primary selection:text-white overflow-x-hidden min-h-screen flex items-center justify-center relative">
    
    <!-- Background from landing page (Hero section style) -->
    <div class="absolute inset-0 z-0">
        <img src="{{ asset('assets/img/sekolah/1.jpeg') }}" alt="Gedung RA An-Nuur" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-r from-emerald-900/95 to-emerald-800/80"></div>
    </div>
    
    <!-- Decorative floating elements -->
    <div class="absolute top-1/4 left-10 w-24 h-24 bg-yellow-400 rounded-full mix-blend-multiply filter blur-xl opacity-50 animate-pulse"></div>
    <div class="absolute bottom-1/4 right-10 w-32 h-32 bg-emerald-400 rounded-full mix-blend-multiply filter blur-xl opacity-50 animate-pulse" style="animation-delay: 1s;"></div>

    <div class="relative z-10 w-full max-w-md px-6">
        <!-- Card -->
        <div class="glass p-8 rounded-3xl shadow-2xl relative">
            <!-- Back to Home -->
            <a href="{{ url('/') }}" class="absolute -top-5 -left-5 w-12 h-12 bg-white rounded-full flex items-center justify-center shadow-lg text-primary hover:bg-gray-50 hover:scale-105 transition-all">
                <span class="material-symbols-outlined">arrow_back</span>
            </a>

            <!-- Logo -->
            <div class="flex justify-center mb-6">
                <img src="{{ asset('assets/img/logo/logosekolah.jpeg') }}" class="w-24 h-24 rounded-full border-4 border-white shadow-md object-cover">
            </div>

            <div class="text-center mb-8">
                <h1 class="font-display text-3xl font-bold text-gray-900 mb-2">Portal Orang Tua</h1>
                <p class="text-gray-500 text-sm leading-relaxed">Masuk untuk memantau status pendaftaran putra-putri Anda dan informasi lainnya.</p>
            </div>

            <form action="{{ route('parent.login') }}" method="POST" class="space-y-5">
                @csrf
                
                <div>
                    <label for="regNumber" class="block text-sm font-bold text-gray-700 mb-2">ID Pendaftaran / Email</label>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">person</span>
                        <input type="text" id="regNumber" name="regNumber" placeholder="REG-2024-XXX / email@anda.com" required
                               class="w-full pl-12 pr-4 py-3.5 rounded-xl border border-gray-200 bg-white/70 focus:bg-white focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all text-gray-800 placeholder-gray-400 shadow-sm">
                    </div>
                </div>

                <div x-data="{ showPassword: false }">
                    <div class="flex justify-between items-center mb-2">
                        <label for="password" class="block text-sm font-bold text-gray-700">Kata Sandi</label>
                        <a href="#" class="text-sm font-medium text-primary hover:text-primaryDark transition-colors">Lupa Sandi?</a>
                    </div>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">lock</span>
                        <input :type="showPassword ? 'text' : 'password'" id="password" name="password" placeholder="••••••••" required
                               class="w-full pl-12 pr-12 py-3.5 rounded-xl border border-gray-200 bg-white/70 focus:bg-white focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all text-gray-800 placeholder-gray-400 shadow-sm">
                        <button type="button" @click="showPassword = !showPassword" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-primary transition-colors focus:outline-none">
                            <span class="material-symbols-outlined" x-text="showPassword ? 'visibility' : 'visibility_off'">visibility_off</span>
                        </button>
                    </div>
                </div>

                <div class="flex items-center gap-2 pt-1">
                    <input type="checkbox" id="remember" name="remember" class="w-4 h-4 text-primary rounded border-gray-300 focus:ring-primary">
                    <label for="remember" class="text-sm text-gray-600 cursor-pointer select-none">Ingat saya di perangkat ini</label>
                </div>

                <button type="submit" class="w-full bg-primary text-white py-4 rounded-xl font-bold text-lg hover:bg-primaryDark hover:shadow-lg hover:-translate-y-0.5 transition-all active:scale-[0.98] shadow-md flex items-center justify-center gap-2 mt-2">
                    Masuk ke Portal <span class="material-symbols-outlined text-[20px]">login</span>
                </button>
            </form>

            <div class="mt-8 text-center border-t border-gray-200 pt-6">
                <p class="text-sm text-gray-500">
                    Belum mendaftar? 
                    <a href="{{ route('pmb.register') }}" class="font-bold text-primary hover:text-primaryDark transition-colors ml-1">Mulai Pendaftaran</a>
                </p>
            </div>
        </div>
    </div>
</body>
</html>
