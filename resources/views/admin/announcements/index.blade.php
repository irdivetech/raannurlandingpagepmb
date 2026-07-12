@extends('layouts.admin')

@section('title', 'Kelola Pengumuman | Admin RA AN-NUUR')

@section('content')
<main class="md:ml-[280px] min-h-screen px-4 md:px-8 py-8 bg-gray-50">

    <!-- Header & Breadcrumbs -->
    <section class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-8">
        <div>
            <nav class="flex items-center text-gray-400 gap-1 mb-2">
                <span class="text-xs">Admin Panel</span>
                <span class="material-symbols-outlined text-sm">chevron_right</span>
                <span class="text-xs font-semibold text-emerald-500">Pengumuman</span>
            </nav>
            <h2 class="font-display text-3xl md:text-4xl font-bold text-gray-900">Kelola Pengumuman</h2>
            <p class="text-gray-500 mt-1">Sampaikan informasi terbaru kepada orang tua/wali siswa</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.announcements.create') }}" class="flex items-center gap-2 bg-emerald-500 text-white px-5 py-2.5 rounded-xl text-sm font-bold hover:bg-emerald-600 transition-colors shadow-md shadow-emerald-500/20">
                <span class="material-symbols-outlined text-[16px]">add</span> Tambah Pengumuman
            </a>
        </div>
    </section>

    @if(session('success'))
    <div class="mb-6 p-4 text-sm text-emerald-700 rounded-2xl bg-emerald-50 border border-emerald-200 flex items-center gap-2">
        <span class="material-symbols-outlined text-emerald-500">check_circle</span> {{ session('success') }}
    </div>
    @endif

    <!-- Announcements Card Grid -->
    @if($announcements->count() > 0)
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($announcements as $announcement)
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition-all group flex flex-col overflow-hidden">
            <!-- Card Header color bar -->
            <div class="h-1.5 w-full {{ $announcement->is_active ? 'bg-gradient-to-r from-emerald-400 to-teal-400' : 'bg-gray-200' }}"></div>
            <div class="p-6 flex-1 flex flex-col">
                <div class="flex items-start justify-between gap-3 mb-4">
                    <div class="w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0 {{ $announcement->is_active ? 'bg-emerald-50' : 'bg-gray-50' }}">
                        <span class="material-symbols-outlined {{ $announcement->is_active ? 'text-emerald-500' : 'text-gray-400' }} text-[20px]">campaign</span>
                    </div>
                    @if($announcement->is_active)
                        <span class="text-[11px] font-bold px-2.5 py-1 rounded-lg bg-emerald-50 text-emerald-700 border border-emerald-200 flex-shrink-0">Aktif</span>
                    @else
                        <span class="text-[11px] font-bold px-2.5 py-1 rounded-lg bg-gray-50 text-gray-500 border border-gray-200 flex-shrink-0">Draft</span>
                    @endif
                </div>
                <h3 class="font-bold text-gray-900 text-base mb-2 leading-snug">{{ $announcement->title }}</h3>
                <p class="text-sm text-gray-500 leading-relaxed flex-1">{{ Str::limit($announcement->content, 100) }}</p>
                <div class="mt-5 pt-4 border-t border-gray-50 flex items-center justify-between">
                    <span class="text-xs font-medium text-gray-400 flex items-center gap-1.5">
                        <span class="material-symbols-outlined text-[14px]">schedule</span>
                        {{ $announcement->created_at->format('d M Y') }}
                    </span>
                    <div class="flex items-center gap-1">
                        <a href="{{ route('admin.announcements.edit', $announcement->id) }}"
                            class="p-2 rounded-lg hover:bg-emerald-50 text-gray-400 hover:text-emerald-500 transition-colors" title="Edit">
                            <span class="material-symbols-outlined text-[18px]">edit</span>
                        </a>
                        <form action="{{ route('admin.announcements.destroy', $announcement->id) }}" method="POST" onsubmit="return confirm('Hapus pengumuman ini?');">
                            @csrf @method('DELETE')
                            <button type="submit" class="p-2 rounded-lg hover:bg-red-50 text-gray-400 hover:text-red-500 transition-colors" title="Hapus">
                                <span class="material-symbols-outlined text-[18px]">delete</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <div class="flex-1 flex flex-col items-center justify-center bg-white rounded-2xl border border-gray-100 shadow-sm py-20">
        <div class="w-16 h-16 rounded-2xl bg-emerald-50 flex items-center justify-center mb-4">
            <span class="material-symbols-outlined text-4xl text-emerald-500">campaign</span>
        </div>
        <p class="text-gray-900 font-bold mb-1 text-lg">Belum ada pengumuman</p>
        <p class="text-gray-500 text-sm mb-6">Buat pengumuman pertama Anda untuk orang tua/wali siswa.</p>
        <a href="{{ route('admin.announcements.create') }}"
            class="flex items-center gap-2 bg-emerald-500 text-white px-6 py-3 rounded-xl text-sm font-bold hover:bg-emerald-600 transition-colors shadow-sm">
            <span class="material-symbols-outlined text-[18px]">add</span> Buat Pengumuman
        </a>
    </div>
    @endif

    @if($announcements->hasPages())
    <div class="mt-6">
        {{ $announcements->links() }}
    </div>
    @endif

</main>
@endsection
