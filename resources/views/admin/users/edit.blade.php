@extends('layouts.admin')

@section('content')
<main class="md:ml-[280px] min-h-screen px-4 md:px-8 py-8 bg-gray-50">

    <!-- Header & Breadcrumbs -->
    <section class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-8">
        <div>
            <nav class="flex items-center text-gray-400 gap-1 mb-2">
                <span class="text-xs">Admin Panel</span>
                <span class="material-symbols-outlined text-sm">chevron_right</span>
                <a href="{{ route('admin.users.index') }}" class="text-xs hover:text-emerald-500 transition-colors">Akun Orang Tua</a>
                <span class="material-symbols-outlined text-sm">chevron_right</span>
                <span class="text-xs font-semibold text-emerald-500">Edit Akun</span>
            </nav>
            <h2 class="font-display text-3xl md:text-4xl font-bold text-gray-900">Edit Akun Orang Tua</h2>
            <p class="text-gray-500 mt-1">Mengubah data login untuk akun {{ $user->name }}.</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.users.index') }}" class="flex items-center gap-2 bg-white border border-gray-200 text-gray-600 px-4 py-2.5 rounded-xl text-sm font-bold hover:bg-gray-50 transition-colors shadow-sm">
                <span class="material-symbols-outlined text-[16px]">arrow_back</span> Kembali
            </a>
        </div>
    </section>

    @if($errors->any())
        <div class="mb-6 p-4 rounded-xl bg-red-50 border border-red-200 text-red-600 text-sm">
            <div class="font-bold mb-2 flex items-center gap-2"><span class="material-symbols-outlined text-[18px]">error</span> Terjadi kesalahan:</div>
            <ul class="list-disc pl-5 space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="max-w-3xl">
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
            <div class="px-6 py-5 border-b border-gray-100 flex items-center gap-3 bg-gray-50/50">
                <div class="w-10 h-10 rounded-xl bg-blue-50 flex items-center justify-center">
                    <span class="material-symbols-outlined text-blue-500 text-[20px]">manage_accounts</span>
                </div>
                <div>
                    <h3 class="font-bold text-gray-900 text-lg">Formulir Edit Akun</h3>
                    <p class="text-xs text-gray-500 mt-0.5">Silakan ubah data yang diperlukan</p>
                </div>
            </div>

            <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="p-6">
                @csrf
                @method('PUT')
                
                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Nama Lengkap <span class="text-red-500">*</span></label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 text-gray-800 text-sm focus:outline-none focus:border-emerald-400 focus:ring-2 focus:ring-emerald-400/20 focus:bg-white transition-all" required>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Email Login <span class="text-red-500">*</span></label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 text-gray-800 text-sm focus:outline-none focus:border-emerald-400 focus:ring-2 focus:ring-emerald-400/20 focus:bg-white transition-all" required>
                    </div>
                    
                    <div class="pt-5 border-t border-gray-100">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Password Baru (Opsional)</label>
                        <input type="password" name="password" class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 text-gray-800 text-sm focus:outline-none focus:border-emerald-400 focus:ring-2 focus:ring-emerald-400/20 focus:bg-white transition-all" placeholder="Kosongkan jika tidak ingin mengubah password">
                        <p class="text-xs text-gray-500 mt-1.5">Minimal 6 karakter.</p>
                    </div>
                </div>

                <div class="mt-8 pt-6 border-t border-gray-100 flex justify-end gap-3">
                    <a href="{{ route('admin.users.index') }}" class="px-6 py-2.5 rounded-xl border border-gray-200 text-gray-600 text-sm font-bold hover:bg-gray-50 transition-colors">
                        Batal
                    </a>
                    <button type="submit" class="flex items-center gap-2 bg-emerald-500 text-white px-6 py-2.5 rounded-xl text-sm font-bold hover:bg-emerald-600 transition-colors shadow-sm">
                        <span class="material-symbols-outlined text-[18px]">save</span> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</main>
@endsection
