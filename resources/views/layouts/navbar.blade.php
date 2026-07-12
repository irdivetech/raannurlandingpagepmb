<!-- TopNavBar -->
<header
    class="w-full top-0 sticky z-50 bg-surface border-b border-outline-variant shadow-sm transition-all duration-200 ease-in-out"
    id="main-navbar">
    <div class="flex justify-between items-center px-gutter py-md max-w-container-max mx-auto">
        <a href="{{ route('pmb.landing') }}"
            class="font-headline-md text-headline-md font-bold text-primary flex items-center gap-2">
            <span class="material-symbols-outlined text-3xl"
                style="font-variation-settings: 'FILL' 1;">child_care</span>
            <span>RA AN-NUUR</span>
        </a>

        <!-- Desktop Nav -->
        <nav class="hidden md:flex gap-xl items-center">
            @php $currentRoute = Route::currentRouteName(); @endphp
            <a class="font-body-md text-body-md {{ $currentRoute === 'pmb.landing' ? 'text-primary border-b-2 border-primary font-bold pb-1' : 'text-on-surface-variant hover:text-primary' }} transition-colors"
                href="{{ route('pmb.landing') }}">Beranda</a>
            <a class="font-body-md text-body-md {{ $currentRoute === 'public.biaya' ? 'text-primary border-b-2 border-primary font-bold pb-1' : 'text-on-surface-variant hover:text-primary' }} transition-colors"
                href="{{ route('public.biaya') }}">Biaya</a>
            <a class="font-body-md text-body-md {{ $currentRoute === 'public.kontak' ? 'text-primary border-b-2 border-primary font-bold pb-1' : 'text-on-surface-variant hover:text-primary' }} transition-colors"
                href="{{ route('public.kontak') }}">Kontak</a>
            <a class="font-body-md text-body-md {{ $currentRoute === 'pmb.tracking' ? 'text-primary border-b-2 border-primary font-bold pb-1' : 'text-on-surface-variant hover:text-primary' }} transition-colors"
                href="{{ route('pmb.tracking') }}">Cek Status</a>
        </nav>

        <div class="flex items-center gap-4">

            <!-- Mobile Menu Toggle -->
            <button id="mobile-menu-btn" class="md:hidden text-primary p-1" onclick="toggleMobileMenu()">
                <span class="material-symbols-outlined" id="menu-icon">menu</span>
            </button>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu"
        class="hidden md:hidden border-t border-outline-variant bg-surface px-gutter py-4 flex flex-col gap-3">
        <a href="{{ route('pmb.landing') }}"
            class="font-body-md text-on-surface-variant hover:text-primary py-2 border-b border-outline-variant/40 transition-colors flex items-center gap-2">
            <span class="material-symbols-outlined text-[18px]">home</span> Beranda
        </a>
        <a href="{{ route('public.biaya') }}"
            class="font-body-md text-on-surface-variant hover:text-primary py-2 border-b border-outline-variant/40 transition-colors flex items-center gap-2">
            <span class="material-symbols-outlined text-[18px]">payments</span> Biaya
        </a>
        <a href="{{ route('public.kontak') }}"
            class="font-body-md text-on-surface-variant hover:text-primary py-2 border-b border-outline-variant/40 transition-colors flex items-center gap-2">
            <span class="material-symbols-outlined text-[18px]">call</span> Kontak
        </a>
        <a href="{{ route('pmb.tracking') }}"
            class="font-body-md text-on-surface-variant hover:text-primary py-2 border-b border-outline-variant/40 transition-colors flex items-center gap-2">
            <span class="material-symbols-outlined text-[18px]">track_changes</span> Cek Status
        </a>

    </div>
</header>

<script>
    function toggleMobileMenu() {
        const menu = document.getElementById('mobile-menu');
        const icon = document.getElementById('menu-icon');
        menu.classList.toggle('hidden');
        icon.innerText = menu.classList.contains('hidden') ? 'menu' : 'close';
    }
</script>