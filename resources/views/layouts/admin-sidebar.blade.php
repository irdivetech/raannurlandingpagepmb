<aside class="hidden md:flex fixed left-0 top-0 h-full w-[280px] bg-white flex-col py-8 border-r border-gray-100 z-50 shadow-[4px_0_24px_rgba(0,0,0,0.02)]">
    <!-- Logo area -->
    <div class="px-6 mb-8 flex items-center gap-3">
        <img src="{{ asset('assets/img/logo/logosekolah.jpeg') }}" class="w-10 h-10 rounded-full border border-gray-200 shadow-sm object-cover" onerror="this.src='https://ui-avatars.com/api/?name=RA&background=10B981&color=fff'">
        <div>
            <h1 class="font-display text-xl font-bold text-gray-900 leading-tight">RA AN-NUUR</h1>
            <p class="text-xs font-medium text-emerald-500 uppercase tracking-wider">Admin Panel</p>
        </div>
    </div>
    
    <!-- User Profile -->
    <div class="flex items-center gap-3 px-4 mb-10 mx-4 py-3 bg-emerald-50/50 rounded-2xl border border-emerald-100/50">
        <div class="w-12 h-12 flex-shrink-0 rounded-full overflow-hidden border-2 border-white shadow-sm bg-emerald-500 flex items-center justify-center text-white font-bold text-lg">
            A
        </div>
        <div class="flex flex-col overflow-hidden">
            <span class="font-bold text-sm text-gray-800 truncate">Admin Utama</span>
            <span class="text-xs text-gray-500 font-medium truncate">admin@raannuur.sch.id</span>
        </div>
    </div>
    
    @php $currentRoute = Route::currentRouteName(); @endphp
    
    <!-- Navigation -->
    <nav class="flex-grow space-y-1 px-4 overflow-y-auto preview-scroll">
        
        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest px-4 pb-2 pt-2">Menu Utama</p>

        <!-- Dashboard -->
        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-300 {{ $currentRoute === 'admin.dashboard' ? 'bg-emerald-500 text-white shadow-md shadow-emerald-500/20 font-bold transform scale-[1.02]' : 'text-gray-500 hover:bg-emerald-50 hover:text-emerald-600 font-medium' }}">
            <span class="material-symbols-outlined {{ $currentRoute === 'admin.dashboard' ? 'text-white' : '' }}">dashboard</span>
            <span class="text-sm">Dashboard</span>
        </a>

        <!-- Calon Siswa -->
        <a href="{{ route('admin.applicants.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-300 {{ Str::startsWith($currentRoute, 'admin.applicants') ? 'bg-emerald-500 text-white shadow-md shadow-emerald-500/20 font-bold transform scale-[1.02]' : 'text-gray-500 hover:bg-emerald-50 hover:text-emerald-600 font-medium' }}">
            <span class="material-symbols-outlined {{ Str::startsWith($currentRoute, 'admin.applicants') ? 'text-white' : '' }}">group_add</span>
            <span class="text-sm">Calon Siswa (PMB)</span>
        </a>

        <!-- Siswa Aktif -->
        <a href="{{ route('admin.students.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-300 {{ Str::startsWith($currentRoute, 'admin.students') ? 'bg-emerald-500 text-white shadow-md shadow-emerald-500/20 font-bold transform scale-[1.02]' : 'text-gray-500 hover:bg-emerald-50 hover:text-emerald-600 font-medium' }}">
            <span class="material-symbols-outlined {{ Str::startsWith($currentRoute, 'admin.students') ? 'text-white' : '' }}">school</span>
            <span class="text-sm">Siswa Aktif</span>
        </a>

        <!-- Akun Orang Tua -->
        <a href="{{ route('admin.users.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-300 {{ Str::startsWith($currentRoute, 'admin.users') ? 'bg-emerald-500 text-white shadow-md shadow-emerald-500/20 font-bold transform scale-[1.02]' : 'text-gray-500 hover:bg-emerald-50 hover:text-emerald-600 font-medium' }}">
            <span class="material-symbols-outlined {{ Str::startsWith($currentRoute, 'admin.users') ? 'text-white' : '' }}">manage_accounts</span>
            <span class="text-sm">Akun Orang Tua</span>
        </a>

        <!-- Divider -->
        <div class="my-4 border-t border-gray-100 mx-4"></div>
        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest px-4 pb-2">Konten & Data</p>

        <!-- Pengumuman -->
        <a href="{{ route('admin.announcements.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-300 {{ Str::startsWith($currentRoute, 'admin.announcements') ? 'bg-emerald-500 text-white shadow-md shadow-emerald-500/20 font-bold transform scale-[1.02]' : 'text-gray-500 hover:bg-emerald-50 hover:text-emerald-600 font-medium' }}">
            <span class="material-symbols-outlined {{ Str::startsWith($currentRoute, 'admin.announcements') ? 'text-white' : '' }}">campaign</span>
            <span class="text-sm">Pengumuman</span>
        </a>

        <!-- Laporan -->
        <a href="{{ route('admin.reports.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-300 {{ Str::startsWith($currentRoute, 'admin.reports') ? 'bg-emerald-500 text-white shadow-md shadow-emerald-500/20 font-bold transform scale-[1.02]' : 'text-gray-500 hover:bg-emerald-50 hover:text-emerald-600 font-medium' }}">
            <span class="material-symbols-outlined {{ Str::startsWith($currentRoute, 'admin.reports') ? 'text-white' : '' }}">analytics</span>
            <span class="text-sm">Laporan & Statistik</span>
        </a>

        <!-- Helpdesk -->
        @php $openTicketsCount = \App\Models\Ticket::where('status', 'open')->count(); @endphp
        <a href="{{ route('admin.helpdesk.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-300 {{ Str::startsWith($currentRoute, 'admin.helpdesk') ? 'bg-emerald-500 text-white shadow-md shadow-emerald-500/20 font-bold transform scale-[1.02]' : 'text-gray-500 hover:bg-emerald-50 hover:text-emerald-600 font-medium' }}">
            <span class="material-symbols-outlined {{ Str::startsWith($currentRoute, 'admin.helpdesk') ? 'text-white' : '' }}">headset_mic</span>
            <span class="text-sm">Helpdesk</span>
            @if($openTicketsCount > 0)
                <span class="ml-auto px-2 py-0.5 text-[10px] font-bold rounded-full {{ Str::startsWith($currentRoute, 'admin.helpdesk') ? 'bg-white/20 text-white' : 'bg-red-100 text-red-600' }}">{{ $openTicketsCount }}</span>
            @endif
        </a>

        <!-- Divider -->
        <div class="my-4 border-t border-gray-100 mx-4"></div>
        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest px-4 pb-2">Sistem</p>

        <!-- Pengaturan -->
        <a href="{{ route('admin.settings.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-300 {{ Str::startsWith($currentRoute, 'admin.settings') ? 'bg-emerald-500 text-white shadow-md shadow-emerald-500/20 font-bold transform scale-[1.02]' : 'text-gray-500 hover:bg-emerald-50 hover:text-emerald-600 font-medium' }}">
            <span class="material-symbols-outlined {{ Str::startsWith($currentRoute, 'admin.settings') ? 'text-white' : '' }}">settings</span>
            <span class="text-sm">Pengaturan</span>
        </a>
    </nav>
    
    <!-- Logout -->
    <div class="px-4 mt-auto pt-6 border-t border-gray-100">
        <form action="{{ route('logout') }}" method="POST" class="w-full">
            @csrf
            <button type="submit" class="w-full flex items-center justify-center gap-2 text-rose-500 hover:bg-rose-50 hover:text-rose-600 transition-all py-3 rounded-xl font-bold text-sm active:scale-95">
                <span class="material-symbols-outlined text-lg">logout</span>
                Keluar
            </button>
        </form>
    </div>
</aside>
