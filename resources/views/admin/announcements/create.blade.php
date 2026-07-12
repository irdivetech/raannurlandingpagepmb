@extends('layouts.admin')

@section('title', 'Tambah Pengumuman | Admin RA AN-NUUR')

@section('content')
<main class="md:ml-[280px] min-h-screen px-4 md:px-8 py-8 bg-gray-50">

    <!-- Header & Breadcrumbs -->
    <section class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-8">
        <div>
            <nav class="flex items-center text-gray-400 gap-1 mb-2">
                <span class="text-xs">Admin Panel</span>
                <span class="material-symbols-outlined text-sm">chevron_right</span>
                <a href="{{ route('admin.announcements.index') }}" class="text-xs hover:text-emerald-500 transition-colors">Pengumuman</a>
                <span class="material-symbols-outlined text-sm">chevron_right</span>
                <span class="text-xs font-semibold text-emerald-500">Tambah</span>
            </nav>
            <h2 class="font-display text-3xl md:text-4xl font-bold text-gray-900">Tambah Pengumuman Baru</h2>
            <p class="text-gray-500 mt-1">Buat informasi yang akan dilihat oleh seluruh orang tua calon siswa</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.announcements.index') }}" class="flex items-center gap-2 bg-white border border-gray-200 text-gray-600 px-4 py-2.5 rounded-xl text-sm font-bold hover:bg-gray-50 transition-colors shadow-sm">
                <span class="material-symbols-outlined text-[16px]">arrow_back</span> Kembali
            </a>
        </div>
    </section>

    <div class="max-w-3xl">
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
            <!-- Card Header -->
            <div class="px-6 py-5 border-b border-gray-100 flex items-center gap-3 bg-gray-50/50">
                <div class="w-10 h-10 rounded-xl bg-emerald-50 flex items-center justify-center">
                    <span class="material-symbols-outlined text-emerald-500 text-[20px]">campaign</span>
                </div>
                <div>
                    <h3 class="font-bold text-gray-900 text-lg">Formulir Pengumuman</h3>
                    <p class="text-xs text-gray-500 mt-0.5">Isi detail pengumuman yang akan ditampilkan</p>
                </div>
            </div>

            <form action="{{ route('admin.announcements.store') }}" method="POST" class="p-6">
                @csrf
                <div class="space-y-6">
                    <!-- Judul -->
                    <div>
                        <label for="title" class="block text-sm font-bold text-gray-700 mb-2">Judul Pengumuman <span class="text-red-500">*</span></label>
                        <input type="text" id="title" name="title" value="{{ old('title') }}" required
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 text-gray-800 text-sm focus:outline-none focus:border-emerald-400 focus:ring-2 focus:ring-emerald-400/20 focus:bg-white transition-all"
                            placeholder="Contoh: Jadwal Wawancara Gelombang 1">
                        @error('title')
                            <p class="text-red-500 text-xs mt-1.5 flex items-center gap-1"><span class="material-symbols-outlined text-[13px]">error</span> {{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Isi Pengumuman -->
                    <div>
                        <label for="content" class="block text-sm font-bold text-gray-700 mb-2">Isi Pengumuman <span class="text-red-500">*</span></label>
                        <textarea id="content" name="content" rows="8" required
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 text-gray-800 text-sm focus:outline-none focus:border-emerald-400 focus:ring-2 focus:ring-emerald-400/20 focus:bg-white transition-all resize-y"
                            placeholder="Tuliskan detail pengumuman di sini...">{{ old('content') }}</textarea>
                        @error('content')
                            <p class="text-red-500 text-xs mt-1.5 flex items-center gap-1"><span class="material-symbols-outlined text-[13px]">error</span> {{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Status Aktif -->
                    <div class="flex items-center gap-4 bg-gray-50 p-4 rounded-xl border border-gray-200">
                        <input type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}
                            class="w-5 h-5 text-emerald-600 rounded border-gray-300 focus:ring-emerald-500 cursor-pointer">
                        <div>
                            <label for="is_active" class="text-sm font-bold text-gray-800 cursor-pointer">Tampilkan Pengumuman (Aktif)</label>
                            <p class="text-xs text-gray-500 mt-0.5">Jika tidak dicentang, pengumuman disimpan sebagai draft dan tidak terlihat orang tua.</p>
                        </div>
                    </div>
                </div>

                <div class="mt-8 pt-6 border-t border-gray-100 flex justify-end gap-3">
                    <a href="{{ route('admin.announcements.index') }}" class="px-6 py-2.5 rounded-xl border border-gray-200 text-gray-600 text-sm font-bold hover:bg-gray-50 transition-colors">
                        Batal
                    </a>
                    <button type="submit" class="flex items-center gap-2 bg-emerald-500 text-white px-6 py-2.5 rounded-xl text-sm font-bold hover:bg-emerald-600 transition-colors shadow-sm">
                        <span class="material-symbols-outlined text-[18px]">publish</span> Terbitkan
                    </button>
                </div>
            </form>
        </div>
    </div>
</main>
@endsection
