<aside class="hidden md:flex fixed left-0 top-0 h-full w-[280px] bg-white flex-col py-8 border-r border-gray-100 z-50 shadow-[4px_0_24px_rgba(0,0,0,0.02)]">
    <!-- Logo area -->
    <div class="px-6 mb-8 flex items-center gap-3">
        <img src="{{ asset('assets/img/logo/logosekolah.jpeg') }}" class="w-10 h-10 rounded-full border border-gray-200 shadow-sm object-cover">
        <div>
            <h1 class="font-display text-xl font-bold text-gray-900 leading-tight">RA AN-NUUR</h1>
            <p class="text-xs font-medium text-emerald-500 uppercase tracking-wider">Portal Orang Tua</p>
        </div>
    </div>
    
    <!-- User Profile -->
    <div class="flex items-center gap-3 px-4 mb-10 mx-4 py-3 bg-emerald-50/50 rounded-2xl border border-emerald-100/50">
        <div class="w-12 h-12 flex-shrink-0 rounded-full overflow-hidden border-2 border-white shadow-sm">
            <img class="w-full h-full object-cover" src="https://ui-avatars.com/api/?name=Orang+Tua&background=10B981&color=fff&bold=true" />
        </div>
        <div class="flex flex-col overflow-hidden">
            <span class="font-bold text-sm text-gray-800 truncate">Orang Tua / Wali</span>
            <span class="text-xs text-gray-500 font-medium">ID: RA-2024-089</span>
        </div>
    </div>
    
    @php 
        $currentRoute = Route::currentRouteName(); 
        $isSettingsActive = in_array($currentRoute, ['parent.profile', 'parent.student.edit']);
    @endphp
    
    <!-- Navigation -->
    <nav class="flex-grow space-y-2 px-4 overflow-y-auto preview-scroll">
        <a href="{{ route('parent.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-300 {{ $currentRoute === 'parent.dashboard' ? 'bg-emerald-500 text-white shadow-md shadow-emerald-500/20 font-bold transform scale-[1.02]' : 'text-gray-500 hover:bg-emerald-50 hover:text-emerald-600 font-medium' }}">
            <span class="material-symbols-outlined {{ $currentRoute === 'parent.dashboard' ? 'text-white' : '' }}">dashboard</span>
            <span class="text-sm">Dashboard</span>
        </a>
        <a href="{{ route('parent.status') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-300 {{ $currentRoute === 'parent.status' ? 'bg-emerald-500 text-white shadow-md shadow-emerald-500/20 font-bold transform scale-[1.02]' : 'text-gray-500 hover:bg-emerald-50 hover:text-emerald-600 font-medium' }}">
            <span class="material-symbols-outlined {{ $currentRoute === 'parent.status' ? 'text-white' : '' }}">assignment</span>
            <span class="text-sm">Pendaftaran</span>
        </a>
        <a href="{{ route('parent.documents') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-300 {{ $currentRoute === 'parent.documents' ? 'bg-emerald-500 text-white shadow-md shadow-emerald-500/20 font-bold transform scale-[1.02]' : 'text-gray-500 hover:bg-emerald-50 hover:text-emerald-600 font-medium' }}">
            <span class="material-symbols-outlined {{ $currentRoute === 'parent.documents' ? 'text-white' : '' }}">folder_open</span>
            <span class="text-sm">Dokumen</span>
        </a>
        <a href="{{ route('parent.announcements') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-300 {{ $currentRoute === 'parent.announcements' ? 'bg-emerald-500 text-white shadow-md shadow-emerald-500/20 font-bold transform scale-[1.02]' : 'text-gray-500 hover:bg-emerald-50 hover:text-emerald-600 font-medium group' }}">
            <span class="material-symbols-outlined {{ $currentRoute === 'parent.announcements' ? 'text-white' : 'group-hover:text-emerald-500' }}">notifications</span>
            <span class="text-sm">Pengumuman</span>
        </a>
        @php $isHelpdeskActive = Str::startsWith($currentRoute, 'parent.helpdesk'); @endphp
        <a href="{{ route('parent.helpdesk.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-300 {{ $isHelpdeskActive ? 'bg-emerald-500 text-white shadow-md shadow-emerald-500/20 font-bold transform scale-[1.02]' : 'text-gray-500 hover:bg-emerald-50 hover:text-emerald-600 font-medium group' }}">
            <span class="material-symbols-outlined {{ $isHelpdeskActive ? 'text-white' : 'group-hover:text-emerald-500' }}">support_agent</span>
            <span class="text-sm">Pusat Bantuan</span>
        </a>
        <a href="{{ route('parent.profile') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-300 {{ $isSettingsActive ? 'bg-emerald-500 text-white shadow-md shadow-emerald-500/20 font-bold transform scale-[1.02]' : 'text-gray-500 hover:bg-emerald-50 hover:text-emerald-600 font-medium' }}">
            <span class="material-symbols-outlined {{ $isSettingsActive ? 'text-white' : '' }}">settings</span>
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
