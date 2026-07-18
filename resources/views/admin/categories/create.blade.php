@extends('layouts.admin')

@section('title', 'Tambah Kategori | Admin RA AN-NUUR')

@section('content')
<main class="md:ml-[280px] min-h-screen px-4 md:px-8 py-8 bg-gray-50">
    <section class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div>
            <nav class="flex items-center text-gray-400 gap-1 mb-2">
                <a href="{{ route('admin.dashboard') }}" class="text-xs hover:text-emerald-500">Admin Panel</a>
                <span class="material-symbols-outlined text-sm">chevron_right</span>
                <a href="{{ route('admin.categories.index') }}" class="text-xs hover:text-emerald-500">Kategori Artikel</a>
                <span class="material-symbols-outlined text-sm">chevron_right</span>
                <span class="text-xs font-semibold text-emerald-500">Tambah</span>
            </nav>
            <h2 class="font-display text-2xl md:text-3xl font-bold text-gray-900">Tambah Kategori</h2>
        </div>
    </section>

    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 md:p-8 max-w-2xl">
        <form action="{{ route('admin.categories.store') }}" method="POST">
            @csrf
            <div class="mb-5">
                <label class="block text-sm font-bold text-gray-700 mb-2">Nama Kategori <span class="text-rose-500">*</span></label>
                <input type="text" name="name" value="{{ old('name') }}" required class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all outline-none" placeholder="Masukkan nama kategori">
                @error('name')
                    <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="flex items-center gap-3 mt-8">
                <a href="{{ route('admin.categories.index') }}" class="px-5 py-2.5 rounded-xl border border-gray-200 text-gray-600 font-bold hover:bg-gray-50 transition-colors">Batal</a>
                <button type="submit" class="px-5 py-2.5 rounded-xl bg-emerald-500 text-white font-bold hover:bg-emerald-600 transition-colors shadow-md shadow-emerald-500/20">Simpan Kategori</button>
            </div>
        </form>
    </div>
</main>
@endsection
