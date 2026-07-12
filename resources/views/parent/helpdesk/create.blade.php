@extends('layouts.parent')

@section('title', 'Buat Tiket Baru | RA AN-NUUR')

@section('styles')
<style>
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(12px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    .fade-in { animation: fadeInUp 0.4s ease both; }
</style>
@endsection

@section('content')
<main class="md:ml-[280px] min-h-screen px-4 md:px-8 py-8 bg-gray-50">

    {{-- Header --}}
    <section class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-8 fade-in">
        <div>
            <nav class="flex items-center text-gray-400 gap-1 mb-2">
                <span class="text-xs">Portal</span>
                <span class="material-symbols-outlined text-sm">chevron_right</span>
                <a href="{{ route('parent.helpdesk.index') }}" class="text-xs hover:text-emerald-500 transition-colors">Pusat Bantuan</a>
                <span class="material-symbols-outlined text-sm">chevron_right</span>
                <span class="text-xs font-semibold text-emerald-500">Buat Tiket</span>
            </nav>
            <h2 class="font-display text-3xl font-bold text-gray-900">Buat Tiket Bantuan</h2>
            <p class="text-gray-500 mt-1">Jelaskan kendala Anda agar tim kami dapat membantu dengan cepat.</p>
        </div>
        <a href="{{ route('parent.helpdesk.index') }}" class="px-5 py-2.5 bg-white border border-gray-200 text-gray-600 font-bold text-sm rounded-xl hover:bg-gray-50 transition-all flex items-center gap-2 shadow-sm w-fit">
            <span class="material-symbols-outlined text-lg">arrow_back</span> Kembali
        </a>
    </section>

    <section class="max-w-3xl fade-in" style="animation-delay:.1s">
        <form action="{{ route('parent.helpdesk.store') }}" method="POST" class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 md:p-8">
            @csrf
            
            <div class="space-y-6">
                {{-- Subject --}}
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Judul Masalah <span class="text-red-500">*</span></label>
                    <input type="text" name="subject" value="{{ old('subject') }}" required autofocus
                           placeholder="Contoh: Kesulitan mengunggah dokumen KK"
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-emerald-300 focus:border-emerald-400 outline-none transition-all @error('subject') border-red-300 focus:border-red-400 focus:ring-red-200 @enderror">
                    @error('subject')
                        <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- Category --}}
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Kategori <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <select name="category" required class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-emerald-300 focus:border-emerald-400 outline-none transition-all appearance-none bg-white @error('category') border-red-300 @enderror">
                                <option value="" disabled selected>Pilih kategori yang sesuai...</option>
                                <option value="teknis" {{ old('category') == 'teknis' ? 'selected' : '' }}>Kendala Teknis Aplikasi</option>
                                <option value="akademik" {{ old('category') == 'akademik' ? 'selected' : '' }}>Pertanyaan Akademik / Sekolah</option>
                                <option value="informasi" {{ old('category') == 'informasi' ? 'selected' : '' }}>Informasi Pendaftaran</option>
                                <option value="lainnya" {{ old('category') == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                            <span class="material-symbols-outlined absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none">expand_more</span>
                        </div>
                        @error('category')
                            <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Priority --}}
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Tingkat Prioritas <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <select name="priority" required class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-emerald-300 focus:border-emerald-400 outline-none transition-all appearance-none bg-white @error('priority') border-red-300 @enderror">
                                <option value="low" {{ old('priority') == 'low' ? 'selected' : '' }}>Rendah - Hanya bertanya informasi</option>
                                <option value="medium" {{ old('priority', 'medium') == 'medium' ? 'selected' : '' }}>Sedang - Butuh bantuan tapi tidak mendesak</option>
                                <option value="high" {{ old('priority') == 'high' ? 'selected' : '' }}>Tinggi - Sangat mendesak / error fatal</option>
                            </select>
                            <span class="material-symbols-outlined absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none">expand_more</span>
                        </div>
                        @error('priority')
                            <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Description --}}
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Deskripsi Detail <span class="text-red-500">*</span></label>
                    <textarea name="description" rows="5" required
                              placeholder="Ceritakan secara detail kendala atau pertanyaan Anda di sini..."
                              class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-emerald-300 focus:border-emerald-400 outline-none transition-all resize-y min-h-[120px] @error('description') border-red-300 @enderror">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            
            <div class="mt-8 pt-6 border-t border-gray-100 flex items-center justify-end gap-3">
                <a href="{{ route('parent.helpdesk.index') }}" class="px-6 py-2.5 text-gray-500 font-bold text-sm hover:text-gray-700 transition-colors">Batal</a>
                <button type="submit" class="px-8 py-2.5 bg-emerald-500 text-white font-bold text-sm rounded-xl hover:bg-emerald-600 transition-all shadow-md shadow-emerald-500/20 active:scale-95 flex items-center gap-2">
                    <span class="material-symbols-outlined text-lg">send</span> Kirim Tiket
                </button>
            </div>
        </form>
    </section>

</main>
@endsection
