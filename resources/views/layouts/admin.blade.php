<!DOCTYPE html>
<html class="light" lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>@yield('title', 'Admin Dashboard | RA AN-NUUR')</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Use the same fonts as parent dashboard -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Fredoka:wght@400;500;600&family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <style>
        body { font-family: 'Outfit', sans-serif; background-color: #f9fafb; }
        h1, h2, h3, .headline, .font-display { font-family: 'Fredoka', sans-serif; }
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; vertical-align: middle; }
        .silk-shadow { box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05); }
        .inner-glow:hover { box-shadow: inset 0 0 0 100px rgba(255, 255, 255, 0.1); }
        .sidebar-active { position: relative; }
        .sidebar-active::after { content: ''; position: absolute; left: 0; top: 0; bottom: 0; width: 4px; background-color: #059669; }
        
        /* Step Tracker Animation */
        @keyframes pulse-soft {
            0%, 100% { transform: scale(1); opacity: 1; }
            50% { transform: scale(1.05); opacity: 0.8; }
        }
        .active-node { animation: pulse-soft 2s infinite ease-in-out; }
        
        /* Custom scrollbar */
        .preview-scroll::-webkit-scrollbar { width: 6px; }
        .preview-scroll::-webkit-scrollbar-track { background: transparent; }
        .preview-scroll::-webkit-scrollbar-thumb { background: #bdcaba; border-radius: 10px; }
        
        @yield('styles')
    </style>
    <!-- Shared tailwind config -->
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "on-error-container": "#93000a",
                        "on-primary": "#ffffff",
                        "surface-dim": "#d8dadc",
                        "background": "#f7f9fb",
                        "surface-container": "#eceef0",
                        "on-secondary-fixed": "#211b00",
                        "tertiary-container": "#6a758a",
                        "secondary-container": "#fcdf46",
                        "on-error": "#ffffff",
                        "on-secondary": "#ffffff",
                        "surface-container-highest": "#e0e3e5",
                        "inverse-on-surface": "#eff1f3",
                        "on-tertiary-fixed-variant": "#3c475a",
                        "tertiary-fixed": "#d8e3fb",
                        "on-tertiary-fixed": "#111c2d",
                        "secondary-fixed-dim": "#e2c62d",
                        "on-background": "#191c1e",
                        "on-primary-fixed": "#002109",
                        "primary-fixed-dim": "#62df7d",
                        "surface": "#f7f9fb",
                        "secondary": "#6d5e00",
                        "surface-bright": "#f7f9fb",
                        "primary-container": "#00873a",
                        "on-tertiary-container": "#fefcff",
                        "on-surface": "#191c1e",
                        "on-secondary-fixed-variant": "#524600",
                        "tertiary-fixed-dim": "#bcc7de",
                        "surface-container-high": "#e6e8ea",
                        "inverse-primary": "#62df7d",
                        "surface-variant": "#e0e3e5",
                        "outline-variant": "#bdcaba",
                        "tertiary": "#515c71",
                        "on-tertiary": "#ffffff",
                        "secondary-fixed": "#ffe24c",
                        "surface-container-low": "#f2f4f6",
                        "outline": "#6e7b6c",
                        "error-container": "#ffdad6",
                        "surface-container-lowest": "#ffffff",
                        "on-secondary-container": "#726200",
                        "surface-tint": "#006e2d",
                        "inverse-surface": "#2d3133",
                        "error": "#ba1a1a",
                        "on-surface-variant": "#3e4a3d",
                        "on-primary-container": "#f7fff2",
                        "primary": "#006b2c",
                        "on-primary-fixed-variant": "#005320",
                        "primary-fixed": "#7ffc97"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                    "spacing": {
                        "stack-lg": "32px",
                        "margin-desktop": "48px",
                        "gutter": "24px",
                        "stack-md": "16px",
                        "margin-mobile": "16px",
                        "stack-sm": "8px",
                        "container-max": "1200px"
                    },
                    "fontFamily": {
                        "headline-lg-mobile": ["Fredoka"],
                        "label-md": ["Outfit"],
                        "headline-md": ["Fredoka"],
                        "status-badge": ["Outfit"],
                        "body-md": ["Outfit"],
                        "headline-lg": ["Fredoka"],
                        "body-lg": ["Outfit"],
                        "sans": ["Outfit", "sans-serif"],
                        "display": ["Fredoka", "sans-serif"]
                    },
                    "fontSize": {
                        "headline-lg-mobile": ["30px", {"lineHeight": "36px", "fontWeight": "700"}],
                        "label-md": ["14px", {"lineHeight": "20px", "fontWeight": "600"}],
                        "headline-md": ["24px", {"lineHeight": "32px", "fontWeight": "600"}],
                        "status-badge": ["12px", {"lineHeight": "16px", "fontWeight": "700"}],
                        "body-md": ["16px", {"lineHeight": "24px", "fontWeight": "400"}],
                        "headline-lg": ["40px", {"lineHeight": "48px", "letterSpacing": "-0.02em", "fontWeight": "700"}],
                        "body-lg": ["18px", {"lineHeight": "28px", "fontWeight": "400"}]
                    }
                },
            },
        }
    </script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-background text-on-surface">

    @include('layouts.admin-sidebar')

    <!-- Top Header -->
    <header class="md:ml-[280px] sticky top-0 bg-white/80 backdrop-blur-md px-4 md:px-8 py-3 flex justify-between md:justify-end items-center z-40 border-b border-gray-100">
        <div class="flex items-center gap-3 md:hidden">
            <img src="{{ asset('assets/img/logo/logosekolah.jpeg') }}" class="w-8 h-8 rounded-full border border-gray-200">
            <h1 class="font-bold text-primary text-lg">Admin Panel</h1>
        </div>
        
        <div class="flex items-center gap-4">
            <!-- Notification Bell -->
            @php 
                $openTicketsCount = \App\Models\Ticket::where('status', 'open')->count();
            @endphp
            <a href="{{ route('admin.helpdesk.index', ['status' => 'open']) }}" class="relative p-2 text-gray-400 hover:text-emerald-500 transition-colors hover:bg-emerald-50 rounded-full flex items-center justify-center" title="Tiket Baru">
                <span class="material-symbols-outlined">notifications</span>
                @if($openTicketsCount > 0)
                <span class="absolute top-0 right-0 min-w-[18px] h-[18px] px-1 bg-red-500 text-white text-[10px] font-bold rounded-full flex items-center justify-center border-2 border-white animate-bounce">
                    {{ $openTicketsCount }}
                </span>
                @endif
            </a>
        </div>
    </header>

    @yield('content')

    <!-- Footer -->
    <footer class="md:ml-[280px] bg-surface-container-lowest border-t border-outline-variant mt-auto">
        <div class="max-w-container-max mx-auto px-gutter py-xl flex flex-col md:flex-row justify-between items-center gap-4">
            <div class="flex flex-col items-center md:items-start">
                <span class="font-label-md text-label-md font-bold text-primary">RA AN-NUUR</span>
                <p class="font-body-sm text-body-sm text-on-surface-variant text-center md:text-left">© 2024 RA AN-NUUR Islamic Kindergarten. All rights reserved.</p>
            </div>
            <div class="flex gap-gutter">
                <a class="font-body-sm text-body-sm text-on-surface-variant hover:underline" href="#">Kebijakan Privasi</a>
                <a class="font-body-sm text-body-sm text-on-surface-variant hover:underline" href="#">Syarat & Ketentuan</a>
                <a class="font-body-sm text-body-sm text-on-surface-variant hover:underline" href="#">Bantuan</a>
            </div>
        </div>
    </footer>

    <!-- Mobile Bottom Navigation (for pages that need it, can be overridden) -->
    @yield('mobile-nav')

    <!-- Bottom Navigation Bar (Mobile) -->
    <div x-data="{ mobileMoreOpen: false }">
        <nav class="md:hidden fixed bottom-0 left-0 w-full bg-white border-t border-gray-100 shadow-[0_-4px_24px_rgba(0,0,0,0.05)] z-50 px-2 pb-2 pt-2 flex justify-around items-center">
            @php 
                $currentRoute = Route::currentRouteName(); 
            @endphp
            
            <a href="{{ route('admin.dashboard') }}" class="flex flex-col items-center p-2 {{ $currentRoute === 'admin.dashboard' ? 'text-emerald-500' : 'text-gray-400 hover:text-emerald-500' }}">
                <span class="material-symbols-outlined {{ $currentRoute === 'admin.dashboard' ? 'font-bold' : '' }}" style="{{ $currentRoute === 'admin.dashboard' ? 'font-variation-settings: \'FILL\' 1;' : '' }}">dashboard</span>
                <span class="text-[10px] font-medium mt-1">Beranda</span>
            </a>
            
            <a href="{{ route('admin.applicants.index') }}" class="flex flex-col items-center p-2 {{ Str::startsWith($currentRoute, 'admin.applicants') ? 'text-emerald-500' : 'text-gray-400 hover:text-emerald-500' }}">
                <span class="material-symbols-outlined {{ Str::startsWith($currentRoute, 'admin.applicants') ? 'font-bold' : '' }}" style="{{ Str::startsWith($currentRoute, 'admin.applicants') ? 'font-variation-settings: \'FILL\' 1;' : '' }}">group_add</span>
                <span class="text-[10px] font-medium mt-1">PMB</span>
            </a>

            <a href="{{ route('admin.students.index') }}" class="flex flex-col items-center p-2 {{ Str::startsWith($currentRoute, 'admin.students') ? 'text-emerald-500' : 'text-gray-400 hover:text-emerald-500' }}">
                <span class="material-symbols-outlined {{ Str::startsWith($currentRoute, 'admin.students') ? 'font-bold' : '' }}" style="{{ Str::startsWith($currentRoute, 'admin.students') ? 'font-variation-settings: \'FILL\' 1;' : '' }}">school</span>
                <span class="text-[10px] font-medium mt-1">Siswa</span>
            </a>

            <a href="{{ route('admin.helpdesk.index') }}" class="flex flex-col items-center p-2 {{ Str::startsWith($currentRoute, 'admin.helpdesk') ? 'text-emerald-500' : 'text-gray-400 hover:text-emerald-500' }} relative">
                <span class="material-symbols-outlined {{ Str::startsWith($currentRoute, 'admin.helpdesk') ? 'font-bold' : '' }}" style="{{ Str::startsWith($currentRoute, 'admin.helpdesk') ? 'font-variation-settings: \'FILL\' 1;' : '' }}">headset_mic</span>
                <span class="text-[10px] font-medium mt-1">Helpdesk</span>
                @if($openTicketsCount > 0)
                <span class="absolute top-1.5 right-2 w-2 h-2 bg-red-500 rounded-full"></span>
                @endif
            </a>

            <button @click="mobileMoreOpen = true" class="flex flex-col items-center p-2 text-gray-400 hover:text-emerald-500">
                <span class="material-symbols-outlined">menu</span>
                <span class="text-[10px] font-medium mt-1">Lainnya</span>
            </button>
        </nav>

        <!-- More Menu Modal -->
        <div x-show="mobileMoreOpen" style="display: none;" class="md:hidden fixed inset-0 z-[60] flex items-end sm:items-center justify-center">
            <!-- Backdrop -->
            <div x-show="mobileMoreOpen" x-transition.opacity @click="mobileMoreOpen = false" class="fixed inset-0 bg-black/40 backdrop-blur-sm"></div>
            
            <!-- Menu Content -->
            <div x-show="mobileMoreOpen" 
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="transform translate-y-full"
                 x-transition:enter-end="transform translate-y-0"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="transform translate-y-0"
                 x-transition:leave-end="transform translate-y-full"
                 class="relative bg-white w-full rounded-t-3xl sm:rounded-3xl p-6 pb-10 shadow-2xl max-h-[85vh] overflow-y-auto preview-scroll">
                
                <div class="flex justify-between items-center mb-6">
                    <h3 class="font-bold text-gray-900 text-lg">Menu Lainnya</h3>
                    <button @click="mobileMoreOpen = false" class="p-2 bg-gray-100 rounded-full text-gray-500 hover:bg-gray-200">
                        <span class="material-symbols-outlined text-sm">close</span>
                    </button>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <a href="{{ route('admin.users.index') }}" class="flex flex-col items-center p-4 bg-gray-50 rounded-2xl hover:bg-emerald-50 hover:text-emerald-600 transition-colors">
                        <span class="material-symbols-outlined mb-2 text-emerald-500">manage_accounts</span>
                        <span class="text-xs font-bold text-gray-700">Akun Orang Tua</span>
                    </a>
                    
                    <a href="{{ route('admin.announcements.index') }}" class="flex flex-col items-center p-4 bg-gray-50 rounded-2xl hover:bg-emerald-50 hover:text-emerald-600 transition-colors">
                        <span class="material-symbols-outlined mb-2 text-emerald-500">campaign</span>
                        <span class="text-xs font-bold text-gray-700">Pengumuman</span>
                    </a>
                    
                    <a href="{{ route('admin.reports.index') }}" class="flex flex-col items-center p-4 bg-gray-50 rounded-2xl hover:bg-emerald-50 hover:text-emerald-600 transition-colors">
                        <span class="material-symbols-outlined mb-2 text-emerald-500">analytics</span>
                        <span class="text-xs font-bold text-gray-700">Laporan</span>
                    </a>
                    
                    <a href="{{ route('admin.settings.index') }}" class="flex flex-col items-center p-4 bg-gray-50 rounded-2xl hover:bg-emerald-50 hover:text-emerald-600 transition-colors">
                        <span class="material-symbols-outlined mb-2 text-emerald-500">settings</span>
                        <span class="text-xs font-bold text-gray-700">Pengaturan</span>
                    </a>
                </div>

                <form action="{{ route('logout') }}" method="POST" class="mt-8">
                    @csrf
                    <button type="submit" class="w-full flex items-center justify-center gap-2 text-rose-500 bg-rose-50 hover:bg-rose-100 transition-all py-3 rounded-xl font-bold text-sm">
                        <span class="material-symbols-outlined text-lg">logout</span>
                        Keluar Akun
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Spacer so content doesn't get hidden behind bottom nav on mobile -->
    <div class="h-20 md:hidden"></div>

    @yield('scripts')
</body>
</html>
