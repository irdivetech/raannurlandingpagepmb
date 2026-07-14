@extends('layouts.admin')

@section('title', 'Pengaturan Sistem | Admin RA AN-NUUR')

@section('content')
<main class="md:ml-[280px] min-h-screen px-4 md:px-8 py-8 bg-gray-50" x-data="{ tab: 'kuota' }">

    <!-- Header & Breadcrumbs -->
    <section class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-8">
        <div>
            <nav class="flex items-center text-gray-400 gap-1 mb-2">
                <span class="text-xs">Admin Panel</span>
                <span class="material-symbols-outlined text-sm">chevron_right</span>
                <span class="text-xs font-semibold text-emerald-500">Pengaturan</span>
            </nav>
            <h2 class="font-display text-3xl md:text-4xl font-bold text-gray-900">Pengaturan Sistem</h2>
            <p class="text-gray-500 mt-1">Konfigurasi parameter sistem PMB</p>
        </div>
    </section>

    @if(session('success'))
    <div class="mb-6 p-4 text-sm text-emerald-700 rounded-2xl bg-emerald-50 border border-emerald-200 flex items-center gap-2 shadow-sm">
        <span class="material-symbols-outlined text-emerald-500">check_circle</span> {{ session('success') }}
    </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">

        <!-- Left Nav -->
        <div class="md:col-span-1 space-y-2">
            <p class="text-xs font-bold text-gray-400 uppercase tracking-widest px-1 mb-3">Kategori</p>
            <button @click="tab = 'kuota'" type="button"
                class="w-full text-left flex items-center gap-3 px-4 py-3 rounded-xl font-bold text-sm transition-all"
                :class="tab === 'kuota' ? 'bg-emerald-500 text-white shadow-sm' : 'bg-white text-gray-600 hover:bg-gray-50 border border-gray-100'">
                <span class="material-symbols-outlined text-[18px]" :class="tab === 'kuota' ? 'text-white' : 'text-gray-400'">tune</span>
                Penerimaan & Kuota
            </button>
            <button @click="tab = 'biaya'" type="button"
                class="w-full text-left flex items-center gap-3 px-4 py-3 rounded-xl font-bold text-sm transition-all"
                :class="tab === 'biaya' ? 'bg-emerald-500 text-white shadow-sm' : 'bg-white text-gray-600 hover:bg-gray-50 border border-gray-100'">
                <span class="material-symbols-outlined text-[18px]" :class="tab === 'biaya' ? 'text-white' : 'text-gray-400'">payments</span>
                Program Biaya
            </button>
            <button @click="tab = 'kontak'" type="button"
                class="w-full text-left flex items-center gap-3 px-4 py-3 rounded-xl font-bold text-sm transition-all"
                :class="tab === 'kontak' ? 'bg-emerald-500 text-white shadow-sm' : 'bg-white text-gray-600 hover:bg-gray-50 border border-gray-100'">
                <span class="material-symbols-outlined text-[18px]" :class="tab === 'kontak' ? 'text-white' : 'text-gray-400'">contact_support</span>
                Informasi Kontak
            </button>
            <button @click="tab = 'formulir'" type="button"
                class="w-full text-left flex items-center gap-3 px-4 py-3 rounded-xl font-bold text-sm transition-all"
                :class="tab === 'formulir' ? 'bg-emerald-500 text-white shadow-sm' : 'bg-white text-gray-600 hover:bg-gray-50 border border-gray-100'">
                <span class="material-symbols-outlined text-[18px]" :class="tab === 'formulir' ? 'text-white' : 'text-gray-400'">picture_as_pdf</span>
                Formulir Pendaftaran
            </button>
        </div>

        <!-- Form Area -->
        <div class="md:col-span-3">
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">

                <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Tab: Kuota -->
                    <div x-show="tab === 'kuota'" x-transition>
                        <div class="px-6 py-5 border-b border-gray-100 flex items-center gap-3 bg-gray-50/50">
                            <div class="w-10 h-10 rounded-xl bg-emerald-50 flex items-center justify-center">
                                <span class="material-symbols-outlined text-emerald-500 text-[20px]">tune</span>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-900 text-lg">Penerimaan & Kuota</h3>
                                <p class="text-xs text-gray-500 mt-0.5">Atur target penerimaan siswa baru</p>
                            </div>
                        </div>
                        <div class="p-6 space-y-6">
                            <div>
                                <label for="target_kuota" class="block text-sm font-bold text-gray-700 mb-1.5">Target Kuota Siswa Baru <span class="text-red-500">*</span></label>
                                <p class="text-xs text-gray-500 mb-3">Jumlah maksimal siswa yang dapat diterima pada tahun ajaran ini. Sistem akan menolak persetujuan baru jika kuota sudah penuh.</p>
                                <div class="relative w-48">
                                    <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400">
                                        <span class="material-symbols-outlined text-[20px]">group</span>
                                    </span>
                                    <input type="number" id="target_kuota" name="target_kuota" value="{{ old('target_kuota', $target_kuota) }}" min="1" required
                                        class="w-full pl-12 pr-4 py-3 rounded-xl border border-gray-200 bg-gray-50 text-gray-800 text-sm font-bold focus:outline-none focus:border-emerald-400 focus:ring-2 focus:ring-emerald-400/20 focus:bg-white transition-all">
                                </div>
                                @error('target_kuota')<p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>@enderror
                            </div>
                        </div>
                    </div>

                    <!-- Tab: Biaya -->
                    <div x-show="tab === 'biaya'" x-transition style="display: none;">
                        <div class="px-6 py-5 border-b border-gray-100 flex items-center gap-3 bg-gray-50/50">
                            <div class="w-10 h-10 rounded-xl bg-blue-50 flex items-center justify-center">
                                <span class="material-symbols-outlined text-blue-500 text-[20px]">payments</span>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-900 text-lg">Program Biaya</h3>
                                <p class="text-xs text-gray-500 mt-0.5">Rincian biaya akan tampil di halaman publik secara otomatis</p>
                            </div>
                        </div>
                        <div class="p-6">
                            
                            <h4 class="text-sm font-bold text-gray-800 mb-4 pb-2 border-b border-gray-100 flex items-center gap-2">
                                <span class="w-6 h-6 rounded-full bg-gray-100 text-gray-600 flex items-center justify-center text-xs">1</span> Biaya Awal (Seragam)
                            </h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-8">
                                <div>
                                    <label for="biaya_batik" class="block text-xs font-bold text-gray-700 mb-2">Batik Setel (Rp) <span class="text-red-500">*</span></label>
                                    <input type="text" id="biaya_batik" name="biaya_batik" value="{{ old('biaya_batik', $biaya_batik) }}" required
                                        class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 text-gray-800 text-sm focus:outline-none focus:border-emerald-400 focus:ring-2 focus:ring-emerald-400/20 focus:bg-white transition-all">
                                    @error('biaya_batik')<p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>@enderror
                                </div>
                                <div>
                                    <label for="biaya_olahraga" class="block text-xs font-bold text-gray-700 mb-2">Kaos Olahraga (Rp) <span class="text-red-500">*</span></label>
                                    <input type="text" id="biaya_olahraga" name="biaya_olahraga" value="{{ old('biaya_olahraga', $biaya_olahraga) }}" required
                                        class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 text-gray-800 text-sm focus:outline-none focus:border-emerald-400 focus:ring-2 focus:ring-emerald-400/20 focus:bg-white transition-all">
                                    @error('biaya_olahraga')<p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>@enderror
                                </div>
                            </div>

                            <h4 class="text-sm font-bold text-gray-800 mb-4 pb-2 border-b border-gray-100 flex items-center gap-2">
                                <span class="w-6 h-6 rounded-full bg-gray-100 text-gray-600 flex items-center justify-center text-xs">2</span> Biaya Tahunan (Perlengkapan)
                            </h4>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-8">
                                <div>
                                    <label for="biaya_lka" class="block text-xs font-bold text-gray-700 mb-2">LKA (Rp) <span class="text-red-500">*</span></label>
                                    <input type="text" id="biaya_lka" name="biaya_lka" value="{{ old('biaya_lka', $biaya_lka) }}" required
                                        class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 text-gray-800 text-sm focus:outline-none focus:border-emerald-400 focus:ring-2 focus:ring-emerald-400/20 focus:bg-white transition-all">
                                    @error('biaya_lka')<p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>@enderror
                                </div>
                                <div>
                                    <label for="biaya_buku" class="block text-xs font-bold text-gray-700 mb-2">Buku Paket (Rp) <span class="text-red-500">*</span></label>
                                    <input type="text" id="biaya_buku" name="biaya_buku" value="{{ old('biaya_buku', $biaya_buku) }}" required
                                        class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 text-gray-800 text-sm focus:outline-none focus:border-emerald-400 focus:ring-2 focus:ring-emerald-400/20 focus:bg-white transition-all">
                                    @error('biaya_buku')<p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>@enderror
                                </div>
                                <div>
                                    <label for="biaya_sampul" class="block text-xs font-bold text-gray-700 mb-2">Sampul Rapot (Rp) <span class="text-red-500">*</span></label>
                                    <input type="text" id="biaya_sampul" name="biaya_sampul" value="{{ old('biaya_sampul', $biaya_sampul) }}" required
                                        class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 text-gray-800 text-sm focus:outline-none focus:border-emerald-400 focus:ring-2 focus:ring-emerald-400/20 focus:bg-white transition-all">
                                    @error('biaya_sampul')<p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>@enderror
                                </div>
                            </div>

                            <h4 class="text-sm font-bold text-gray-800 mb-4 pb-2 border-b border-gray-100 flex items-center gap-2">
                                <span class="w-6 h-6 rounded-full bg-gray-100 text-gray-600 flex items-center justify-center text-xs">3</span> Biaya Bulanan
                            </h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-2">
                                <div>
                                    <label for="spp_bulanan" class="block text-xs font-bold text-gray-700 mb-2">SPP Reguler (Rp) <span class="text-red-500">*</span></label>
                                    <input type="text" id="spp_bulanan" name="spp_bulanan" value="{{ old('spp_bulanan', $spp_bulanan) }}" required
                                        class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 text-gray-800 text-sm focus:outline-none focus:border-emerald-400 focus:ring-2 focus:ring-emerald-400/20 focus:bg-white transition-all">
                                    @error('spp_bulanan')<p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>@enderror
                                </div>
                                <div>
                                    <label for="biaya_akhir_tahun" class="block text-xs font-bold text-gray-700 mb-2">Akhir Tahun (Rp) <span class="text-red-500">*</span></label>
                                    <input type="text" id="biaya_akhir_tahun" name="biaya_akhir_tahun" value="{{ old('biaya_akhir_tahun', $biaya_akhir_tahun) }}" required
                                        class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 text-gray-800 text-sm focus:outline-none focus:border-emerald-400 focus:ring-2 focus:ring-emerald-400/20 focus:bg-white transition-all">
                                    @error('biaya_akhir_tahun')<p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>@enderror
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- Tab: Kontak -->
                    <div x-show="tab === 'kontak'" x-transition style="display: none;">
                        <div class="px-6 py-5 border-b border-gray-100 flex items-center gap-3 bg-gray-50/50">
                            <div class="w-10 h-10 rounded-xl bg-amber-50 flex items-center justify-center">
                                <span class="material-symbols-outlined text-amber-500 text-[20px]">contact_support</span>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-900 text-lg">Informasi Kontak</h3>
                                <p class="text-xs text-gray-500 mt-0.5">Data kontak akan tampil di halaman publik secara otomatis</p>
                            </div>
                        </div>
                        <div class="p-6 space-y-6">
                            <div>
                                <label for="kontak_wa" class="block text-sm font-bold text-gray-700 mb-1.5">Nomor WhatsApp Panitia <span class="text-red-500">*</span></label>
                                <p class="text-xs text-gray-500 mb-3">Gunakan format awalan kode negara 62 (contoh: <span class="font-mono bg-gray-100 px-1 py-0.5 rounded">628174935445</span>).</p>
                                <input type="text" id="kontak_wa" name="kontak_wa" value="{{ old('kontak_wa', $kontak_wa) }}" required
                                    class="w-full max-w-md px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 text-gray-800 text-sm font-mono focus:outline-none focus:border-emerald-400 focus:ring-2 focus:ring-emerald-400/20 focus:bg-white transition-all">
                                @error('kontak_wa')<p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label for="kontak_email" class="block text-sm font-bold text-gray-700 mb-1.5">Email Lembaga <span class="text-red-500">*</span></label>
                                <input type="email" id="kontak_email" name="kontak_email" value="{{ old('kontak_email', $kontak_email) }}" required
                                    class="w-full max-w-md px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 text-gray-800 text-sm focus:outline-none focus:border-emerald-400 focus:ring-2 focus:ring-emerald-400/20 focus:bg-white transition-all">
                                @error('kontak_email')<p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label for="kontak_alamat" class="block text-sm font-bold text-gray-700 mb-1.5">Alamat Sekolah <span class="text-red-500">*</span></label>
                                <textarea id="kontak_alamat" name="kontak_alamat" rows="4" required
                                    class="w-full max-w-2xl px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 text-gray-800 text-sm focus:outline-none focus:border-emerald-400 focus:ring-2 focus:ring-emerald-400/20 focus:bg-white transition-all resize-y">{{ old('kontak_alamat', $kontak_alamat) }}</textarea>
                                @error('kontak_alamat')<p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>@enderror
                            </div>
                        </div>
                    </div>

                    <!-- Tab: Formulir -->
                    <div x-show="tab === 'formulir'" x-transition style="display: none;">
                        <div class="px-6 py-5 border-b border-gray-100 flex items-center gap-3 bg-gray-50/50">
                            <div class="w-10 h-10 rounded-xl bg-purple-50 flex items-center justify-center">
                                <span class="material-symbols-outlined text-purple-500 text-[20px]">picture_as_pdf</span>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-900 text-lg">Formulir Pendaftaran Kosong</h3>
                                <p class="text-xs text-gray-500 mt-0.5">Upload file PDF yang bisa di-download pengunjung di halaman pendaftaran</p>
                            </div>
                        </div>
                        <div class="p-6 space-y-6">
                            <div>
                                <label for="formulir_pdf" class="block text-sm font-bold text-gray-700 mb-1.5">File Formulir (PDF, Max 5MB)</label>
                                @if($formulir_pdf_path)
                                    <div class="mb-3 p-3 bg-emerald-50 border border-emerald-200 rounded-xl flex items-center justify-between max-w-md">
                                        <div class="flex items-center gap-2 text-emerald-700 text-sm">
                                            <span class="material-symbols-outlined text-[18px]">check_circle</span>
                                            <span class="font-bold">File sudah tersedia</span>
                                        </div>
                                        <a href="{{ Storage::url($formulir_pdf_path) }}" target="_blank" class="text-xs font-bold text-emerald-600 hover:underline">Lihat File</a>
                                    </div>
                                @endif
                                <input type="file" id="formulir_pdf" name="formulir_pdf" accept="application/pdf"
                                    class="w-full max-w-md px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 text-gray-800 text-sm focus:outline-none focus:border-emerald-400 focus:ring-2 focus:ring-emerald-400/20 focus:bg-white transition-all">
                                <p class="text-xs text-gray-500 mt-1.5">Kosongkan jika tidak ingin mengubah file yang sudah ada.</p>
                                @error('formulir_pdf')<p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>@enderror
                            </div>
                        </div>
                    </div>

                    <!-- Save Button -->
                    <div class="px-6 py-5 border-t border-gray-100 bg-white flex justify-end">
                        <button type="submit" class="flex items-center gap-2 bg-emerald-500 text-white px-8 py-3 rounded-xl text-sm font-bold hover:bg-emerald-600 transition-colors shadow-sm">
                            <span class="material-symbols-outlined text-[18px]">save</span> Simpan Pengaturan
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</main>
@endsection
