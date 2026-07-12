@extends('layouts.admin')

@section('content')
<main class="md:ml-[280px] min-h-screen px-4 md:px-8 py-8 bg-gray-50">

    <!-- Header & Breadcrumbs -->
    <section class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-8">
        <div>
            <nav class="flex items-center text-gray-400 gap-1 mb-2">
                <span class="text-xs">Admin Panel</span>
                <span class="material-symbols-outlined text-sm">chevron_right</span>
                <a href="{{ route('admin.applicants.index') }}" class="text-xs hover:text-emerald-500 transition-colors">Calon Siswa</a>
                <span class="material-symbols-outlined text-sm">chevron_right</span>
                <span class="text-xs font-semibold text-emerald-500">Pendaftaran Manual</span>
            </nav>
            <h2 class="font-display text-3xl md:text-4xl font-bold text-gray-900">Pendaftaran Manual</h2>
            <p class="text-gray-500 mt-1">Input data calon siswa yang mendaftar secara offline di sekolah</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.applicants.index') }}" class="flex items-center gap-2 bg-white border border-gray-200 text-gray-600 px-4 py-2.5 rounded-xl text-sm font-bold hover:bg-gray-50 transition-colors shadow-sm">
                <span class="material-symbols-outlined text-[16px]">arrow_back</span> Kembali
            </a>
        </div>
    </section>

    @if ($errors->any())
        <div class="mb-6 p-4 rounded-xl bg-red-50 border border-red-200 text-red-600 text-sm">
            <div class="font-bold mb-2 flex items-center gap-2"><span class="material-symbols-outlined text-[18px]">error</span> Terjadi kesalahan:</div>
            <ul class="list-disc pl-5 space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.applicants.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6 max-w-4xl pb-10">
        @csrf

        <!-- Email Kontak -->
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
            <h3 class="font-bold text-gray-800 text-lg mb-4 flex items-center gap-2 border-b border-gray-100 pb-3">
                <span class="material-symbols-outlined text-blue-500">contact_mail</span> Email Kontak
            </h3>
            <p class="text-sm text-gray-500 mb-4">Email ini akan digunakan sebagai identitas pendaftaran.</p>
            <div class="w-full md:w-1/2">
                <label class="block text-sm font-bold text-gray-700 mb-1.5">Email Orang Tua/Wali <span class="text-red-500">*</span></label>
                <input type="email" name="email" value="{{ old('email') }}" required class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 text-gray-800 text-sm focus:outline-none focus:border-emerald-400 focus:ring-2 focus:ring-emerald-400/20 focus:bg-white transition-all">
            </div>
        </div>

        <!-- Data Anak -->
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
            <h3 class="font-bold text-gray-800 text-lg mb-4 flex items-center gap-2 border-b border-gray-100 pb-3">
                <span class="material-symbols-outlined text-emerald-500">child_care</span> Data Calon Siswa
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1.5">Nama Lengkap Anak <span class="text-red-500">*</span></label>
                    <input type="text" name="full_name" value="{{ old('full_name') }}" required class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 text-gray-800 text-sm focus:outline-none focus:border-emerald-400 focus:ring-2 focus:ring-emerald-400/20 focus:bg-white transition-all">
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1.5">Nama Panggilan</label>
                    <input type="text" name="nickname" value="{{ old('nickname') }}" class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 text-gray-800 text-sm focus:outline-none focus:border-emerald-400 focus:ring-2 focus:ring-emerald-400/20 focus:bg-white transition-all">
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1.5">NIK Anak <span class="text-red-500">*</span></label>
                    <input type="number" name="nik" value="{{ old('nik') }}" required class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 text-gray-800 text-sm focus:outline-none focus:border-emerald-400 focus:ring-2 focus:ring-emerald-400/20 focus:bg-white transition-all">
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1.5">No. Kartu Keluarga (KK)</label>
                    <input type="number" name="no_kk" value="{{ old('no_kk') }}" class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 text-gray-800 text-sm focus:outline-none focus:border-emerald-400 focus:ring-2 focus:ring-emerald-400/20 focus:bg-white transition-all">
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1.5">Jenis Kelamin <span class="text-red-500">*</span></label>
                    <select name="gender" required class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 text-gray-800 text-sm focus:outline-none focus:border-emerald-400 focus:ring-2 focus:ring-emerald-400/20 focus:bg-white transition-all">
                        <option value="">Pilih...</option>
                        <option value="L" {{ old('gender') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="P" {{ old('gender') == 'P' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>
                <div class="flex gap-4">
                    <div class="w-1/2">
                        <label class="block text-sm font-bold text-gray-700 mb-1.5">Anak Ke-</label>
                        <input type="number" name="child_order" value="{{ old('child_order') }}" class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 text-gray-800 text-sm focus:outline-none focus:border-emerald-400 focus:ring-2 focus:ring-emerald-400/20 focus:bg-white transition-all">
                    </div>
                    <div class="w-1/2">
                        <label class="block text-sm font-bold text-gray-700 mb-1.5">Dari X Bersaudara</label>
                        <input type="number" name="siblings_count" value="{{ old('siblings_count') }}" class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 text-gray-800 text-sm focus:outline-none focus:border-emerald-400 focus:ring-2 focus:ring-emerald-400/20 focus:bg-white transition-all">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1.5">Tempat Lahir <span class="text-red-500">*</span></label>
                    <input type="text" name="birth_place" value="{{ old('birth_place') }}" required class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 text-gray-800 text-sm focus:outline-none focus:border-emerald-400 focus:ring-2 focus:ring-emerald-400/20 focus:bg-white transition-all">
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1.5">Tanggal Lahir <span class="text-red-500">*</span></label>
                    <input type="date" name="birth_date" value="{{ old('birth_date') }}" required class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 text-gray-800 text-sm focus:outline-none focus:border-emerald-400 focus:ring-2 focus:ring-emerald-400/20 focus:bg-white transition-all">
                </div>
            </div>
        </div>

        <!-- Data Orang Tua -->
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
            <h3 class="font-bold text-gray-800 text-lg mb-4 flex items-center gap-2 border-b border-gray-100 pb-3">
                <span class="material-symbols-outlined text-amber-500">family_restroom</span> Data Orang Tua / Wali
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-5 gap-y-6">
                <!-- Ayah -->
                <div class="space-y-4">
                    <h4 class="font-bold text-sm text-gray-500 uppercase tracking-wider">Data Ayah</h4>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1.5">Nama Ayah <span class="text-red-500">*</span></label>
                        <input type="text" name="father_name" value="{{ old('father_name') }}" required class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 text-gray-800 text-sm focus:outline-none focus:border-emerald-400 transition-all">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1.5">Pekerjaan Ayah</label>
                        <input type="text" name="father_job" value="{{ old('father_job') }}" class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 text-gray-800 text-sm focus:outline-none focus:border-emerald-400 transition-all">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1.5">No. Telepon / WA Ayah <span class="text-red-500">*</span></label>
                        <input type="text" name="father_phone" value="{{ old('father_phone') }}" required class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 text-gray-800 text-sm focus:outline-none focus:border-emerald-400 transition-all">
                    </div>
                </div>
                <!-- Ibu -->
                <div class="space-y-4">
                    <h4 class="font-bold text-sm text-gray-500 uppercase tracking-wider">Data Ibu</h4>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1.5">Nama Ibu <span class="text-red-500">*</span></label>
                        <input type="text" name="mother_name" value="{{ old('mother_name') }}" required class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 text-gray-800 text-sm focus:outline-none focus:border-emerald-400 transition-all">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1.5">Pekerjaan Ibu</label>
                        <input type="text" name="mother_job" value="{{ old('mother_job') }}" class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 text-gray-800 text-sm focus:outline-none focus:border-emerald-400 transition-all">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1.5">No. Telepon / WA Ibu</label>
                        <input type="text" name="mother_phone" value="{{ old('mother_phone') }}" class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 text-gray-800 text-sm focus:outline-none focus:border-emerald-400 transition-all">
                    </div>
                </div>
            </div>
        </div>

        <!-- Alamat -->
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
            <h3 class="font-bold text-gray-800 text-lg mb-4 flex items-center gap-2 border-b border-gray-100 pb-3">
                <span class="material-symbols-outlined text-purple-500">home_pin</span> Alamat Tempat Tinggal
            </h3>
            <div class="space-y-5">
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1.5">Alamat Lengkap (Jalan, RT/RW) <span class="text-red-500">*</span></label>
                    <textarea name="address_line" rows="3" required class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 text-gray-800 text-sm focus:outline-none focus:border-emerald-400 focus:ring-2 focus:ring-emerald-400/20 focus:bg-white transition-all resize-none">{{ old('address_line') }}</textarea>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1.5">Provinsi <span class="text-red-500">*</span></label>
                        <input type="text" name="province" value="{{ old('province') }}" required class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 text-gray-800 text-sm focus:outline-none focus:border-emerald-400 transition-all">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1.5">Kabupaten / Kota <span class="text-red-500">*</span></label>
                        <input type="text" name="city" value="{{ old('city') }}" required class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 text-gray-800 text-sm focus:outline-none focus:border-emerald-400 transition-all">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1.5">Kecamatan <span class="text-red-500">*</span></label>
                        <input type="text" name="district" value="{{ old('district') }}" required class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 text-gray-800 text-sm focus:outline-none focus:border-emerald-400 transition-all">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1.5">Kode Pos <span class="text-red-500">*</span></label>
                        <input type="number" name="postal_code" value="{{ old('postal_code') }}" required class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 text-gray-800 text-sm focus:outline-none focus:border-emerald-400 transition-all">
                    </div>
                </div>
            </div>
        </div>

        <!-- Dokumen (Opsional) -->
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6" x-data="{ uploadType: 'manual' }">
            <h3 class="font-bold text-gray-800 text-lg mb-4 flex items-center gap-2 border-b border-gray-100 pb-3">
                <span class="material-symbols-outlined text-indigo-500">folder_open</span> Dokumen Pendukung (Opsional)
            </h3>
            
            <div class="mb-6 flex gap-4">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="radio" x-model="uploadType" value="manual" class="w-4 h-4 text-emerald-600 focus:ring-emerald-500">
                    <span class="text-sm font-bold text-gray-700">Diserahkan Langsung (Fisik)</span>
                </label>
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="radio" x-model="uploadType" value="digital" class="w-4 h-4 text-emerald-600 focus:ring-emerald-500">
                    <span class="text-sm font-bold text-gray-700">Upload Digital</span>
                </label>
            </div>

            <div x-show="uploadType === 'digital'" class="grid grid-cols-1 md:grid-cols-2 gap-5 p-5 bg-gray-50 rounded-xl border border-gray-100" style="display: none;">
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1.5">Kartu Keluarga (KK)</label>
                    <input type="file" name="kk" accept="image/*,.pdf" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100">
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1.5">Akta Kelahiran</label>
                    <input type="file" name="akta" accept="image/*,.pdf" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100">
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1.5">KTP Orang Tua</label>
                    <input type="file" name="ktp_ortu" accept="image/*,.pdf" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100">
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1.5">Pas Foto Anak (3x4)</label>
                    <input type="file" name="foto" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100">
                </div>
            </div>
            
            <div x-show="uploadType === 'manual'" class="p-4 bg-blue-50 text-blue-700 text-sm rounded-xl flex items-start gap-3">
                <span class="material-symbols-outlined mt-0.5">info</span>
                <p>Orang tua/wali akan menyerahkan dokumen fisik (KK, Akta, KTP, Foto) secara langsung ke sekolah. Tidak perlu upload sekarang.</p>
            </div>
        </div>

        <!-- Akun Orang Tua (Opsional) -->
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6" x-data="{ createAccount: false }">
            <h3 class="font-bold text-gray-800 text-lg mb-4 flex items-center gap-2 border-b border-gray-100 pb-3">
                <span class="material-symbols-outlined text-teal-500">manage_accounts</span> Pembuatan Akun Orang Tua (Opsional)
            </h3>
            
            <label class="flex items-center gap-3 cursor-pointer p-4 rounded-xl border border-gray-200 bg-gray-50 hover:border-emerald-500 transition-colors mb-4">
                <input type="checkbox" name="create_account" value="1" x-model="createAccount" class="w-5 h-5 text-emerald-600 rounded focus:ring-emerald-500 border-gray-300">
                <div class="flex flex-col">
                    <span class="font-bold text-gray-800">Buatkan Akun Login untuk Orang Tua</span>
                    <span class="text-xs text-gray-500">Jika dicentang, orang tua bisa login menggunakan Email Kontak dan Password yang dibuat di bawah ini.</span>
                </div>
            </label>

            <div x-show="createAccount" class="p-5 bg-teal-50/50 rounded-xl border border-teal-100 space-y-4" style="display: none;">
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1.5">Password <span class="text-red-500">*</span></label>
                    <input type="password" name="password" :required="createAccount" class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-white text-gray-800 text-sm focus:outline-none focus:border-emerald-400 focus:ring-2 focus:ring-emerald-400/20 transition-all">
                    <p class="text-xs text-gray-500 mt-1">Minimal 6 karakter.</p>
                </div>
            </div>
        </div>

        <!-- Submit -->
        <div class="flex justify-end gap-3 pt-4">
            <a href="{{ route('admin.applicants.index') }}" class="px-6 py-3 rounded-xl border border-gray-200 text-gray-600 font-bold hover:bg-gray-50 transition-colors">Batal</a>
            <button type="submit" class="flex items-center gap-2 bg-emerald-500 text-white px-8 py-3 rounded-xl font-bold hover:bg-emerald-600 transition-colors shadow-sm">
                <span class="material-symbols-outlined text-[20px]">save</span> Simpan Data Pendaftar
            </button>
        </div>
    </form>
</main>
@endsection
