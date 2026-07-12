@extends('layouts.parent')

@section('content')
<main class="md:ml-[280px] min-h-screen bg-gray-50 pb-12">
    <!-- Header Section -->
    <header class="bg-white/80 backdrop-blur-md border-b border-gray-100 shadow-sm sticky top-0 z-40">
        <div class="px-4 md:px-8 py-5 max-w-5xl mx-auto flex items-center justify-between">
            <div>
                <h2 class="font-display text-2xl font-bold text-gray-900">Pengumuman</h2>
                <p class="text-sm text-gray-500 mt-1">Informasi terbaru terkait proses PMB</p>
            </div>
            <div class="w-10 h-10 bg-emerald-50 rounded-full flex items-center justify-center text-emerald-500">
                <span class="material-symbols-outlined text-xl">campaign</span>
            </div>
        </div>
    </header>

    <div class="px-4 md:px-8 py-8 max-w-5xl mx-auto space-y-6">
        
        @forelse($announcements as $announcement)
        <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-sm hover:shadow-md transition-all duration-300 relative overflow-hidden group">
            <!-- Decorative accent line -->
            <div class="absolute left-0 top-0 h-full w-1 bg-emerald-400 opacity-0 group-hover:opacity-100 transition-opacity"></div>
            
            <div class="flex items-start justify-between gap-4 mb-4">
                <h3 class="font-display text-xl font-bold text-gray-900">{{ $announcement->title }}</h3>
                <span class="flex-shrink-0 px-3 py-1 bg-gray-50 text-gray-500 text-[11px] font-bold rounded-lg border border-gray-100 whitespace-nowrap">
                    {{ $announcement->created_at->format('d M Y') }}
                </span>
            </div>
            
            <div class="text-gray-600 text-sm leading-relaxed whitespace-pre-wrap font-body">{{ $announcement->content }}</div>
            
            <div class="mt-6 flex items-center gap-2 text-xs text-emerald-600 font-bold bg-emerald-50/50 w-fit px-3 py-1.5 rounded-lg">
                <span class="material-symbols-outlined text-[14px]">admin_panel_settings</span> Diposting oleh Admin
            </div>
        </div>
        @empty
        <div class="bg-white border border-gray-100 rounded-2xl p-12 shadow-sm text-center flex flex-col items-center">
            <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center text-gray-300 mb-4">
                <span class="material-symbols-outlined text-4xl">notifications_paused</span>
            </div>
            <h3 class="font-display text-lg font-bold text-gray-900 mb-1">Belum ada pengumuman</h3>
            <p class="text-gray-500 text-sm">Saat ini tidak ada informasi atau pengumuman terbaru untuk Anda.</p>
        </div>
        @endforelse

    </div>
</main>
@endsection
