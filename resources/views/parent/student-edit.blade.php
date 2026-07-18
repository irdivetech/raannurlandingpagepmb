@extends('layouts.parent')

@section('content')
<main class="md:ml-[280px] min-h-screen px-4 md:px-8 py-8 bg-gray-50">
    <div class="max-w-4xl mx-auto">
        <!-- Page Header -->
        <div class="mb-8">
            <h2 class="font-display text-3xl md:text-4xl font-bold text-gray-900">Data Calon Siswa</h2>
            <p class="text-gray-500 mt-2 text-base">Kelola informasi pribadi calon siswa yang didaftarkan.</p>
        </div>

        <!-- Bento Layout for Forms -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- Left Column: Summary Info -->
            <div class="lg:col-span-1 space-y-6">
                <div class="bg-white border border-gray-200 p-6 rounded-2xl shadow-sm">
                    <div class="flex flex-col items-center text-center py-4">
                        <div class="w-24 h-24 rounded-full overflow-hidden border-4 border-emerald-50 mb-4 bg-emerald-100 flex items-center justify-center text-emerald-500">
                            <span class="material-symbols-outlined text-4xl">face</span>
                        </div>
                        <h3 class="font-bold text-gray-900 text-lg">{{ $studentData->full_name ?? 'Belum ada data' }}</h3>
                        <p class="text-gray-500 text-sm mt-1">
                            {{ ($studentData->gender ?? '') == 'L' ? 'Laki-laki' : (($studentData->gender ?? '') == 'P' ? 'Perempuan' : '-') }}
                        </p>
                        <span class="mt-3 px-3 py-1 bg-emerald-100 text-emerald-700 text-[10px] uppercase font-bold rounded-full">Calon Siswa</span>
                    </div>
                    
                    <nav class="mt-6 pt-6 border-t border-gray-100 space-y-2">
                        <a href="{{ route('parent.student.edit') }}" class="w-full text-left flex items-center gap-3 p-3 rounded-xl bg-emerald-50 text-emerald-600 font-bold transition-colors">
                            <span class="material-symbols-outlined">badge</span>
                            <span>Data Siswa</span>
                        </a>
                        <a href="{{ route('parent.profile') }}" class="w-full text-left flex items-center gap-3 p-3 rounded-xl text-gray-500 hover:bg-gray-50 hover:text-emerald-600 transition-colors">
                            <span class="material-symbols-outlined">person</span>
                            <span>Data Wali</span>
                        </a>
                    </nav>
                </div>
            </div>

            <!-- Right Column: Forms -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Profile Form Section -->
                <section class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">
                    <div class="p-6 border-b border-gray-100 bg-gray-50/50">
                        <h3 class="font-bold text-gray-900 text-lg">Informasi Calon Siswa</h3>
                    </div>
                    
                    @if(session('success'))
                    <div class="p-4 mb-2 mx-6 mt-6 text-sm text-emerald-800 bg-emerald-50 rounded-xl border border-emerald-100">
                        {{ session('success') }}
                    </div>
                    @endif
                    
                    <form action="{{ route('parent.student.update') }}" method="POST" class="p-6 space-y-6">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="font-medium text-sm text-gray-700">Nama Lengkap</label>
                                <input name="full_name" class="w-full p-3 rounded-xl border border-gray-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 outline-none transition-all text-gray-800" type="text" value="{{ old('full_name', $studentData->full_name ?? '') }}"/>
                                @error('full_name') <span class="text-rose-500 text-xs">{{ $message }}</span> @enderror
                            </div>
                            <div class="space-y-2">
                                <label class="font-medium text-sm text-gray-700">Jenis Kelamin</label>
                                <select name="gender" class="w-full p-3 rounded-xl border border-gray-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 outline-none transition-all text-gray-800 bg-white">
                                    <option value="">Pilih Jenis Kelamin</option>
                                    <option value="L" {{ old('gender', $studentData->gender ?? '') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="P" {{ old('gender', $studentData->gender ?? '') == 'P' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                                @error('gender') <span class="text-rose-500 text-xs">{{ $message }}</span> @enderror
                            </div>
                            <div class="space-y-2">
                                <label class="font-medium text-sm text-gray-700">Tempat Lahir</label>
                                <input name="birth_place" class="w-full p-3 rounded-xl border border-gray-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 outline-none transition-all text-gray-800" type="text" value="{{ old('birth_place', $studentData->birth_place ?? '') }}"/>
                                @error('birth_place') <span class="text-rose-500 text-xs">{{ $message }}</span> @enderror
                            </div>
                            <div class="space-y-2">
                                <label class="font-medium text-sm text-gray-700">Tanggal Lahir</label>
                                <input name="birth_date" class="w-full p-3 rounded-xl border border-gray-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 outline-none transition-all text-gray-800" type="date" value="{{ old('birth_date', $studentData->birth_date ?? '') }}"/>
                                @error('birth_date') <span class="text-rose-500 text-xs">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="space-y-2">
                            <label class="font-medium text-sm text-gray-700">NIK (Nomor Induk Kependudukan)</label>
                            <input name="nik" class="w-full p-3 rounded-xl border border-gray-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 outline-none transition-all text-gray-800" type="text" value="{{ old('nik', $studentData->nik ?? '') }}"/>
                            <p class="text-xs text-gray-400 mt-1">Jika belum memiliki NIK, biarkan kosong atau isi dengan NIK pada Kartu Keluarga.</p>
                            @error('nik') <span class="text-rose-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div class="space-y-2">
                            <label class="font-medium text-sm text-gray-700">Cita-cita</label>
                            <input name="cita_cita" class="w-full p-3 rounded-xl border border-gray-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 outline-none transition-all text-gray-800" type="text" value="{{ old('cita_cita', $studentData->cita_cita ?? '') }}"/>
                            @error('cita_cita') <span class="text-rose-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        
                        <div class="pt-6 border-t border-gray-100 flex justify-end">
                            <button class="px-6 py-3 bg-emerald-500 text-white font-bold rounded-xl transition-all hover:bg-emerald-600 active:scale-95 shadow-md shadow-emerald-500/20" type="submit">Simpan Perubahan</button>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </div>
</main>
@endsection
