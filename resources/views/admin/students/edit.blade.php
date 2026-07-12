@extends('layouts.admin')

@section('content')
<main class="md:ml-[280px] min-h-screen px-4 md:px-8 py-8 bg-gray-50">

    <!-- Header & Breadcrumbs -->
    <section class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-8">
        <div>
            <nav class="flex items-center text-gray-400 gap-1 mb-2">
                <span class="text-xs">Admin Panel</span>
                <span class="material-symbols-outlined text-sm">chevron_right</span>
                <a href="{{ route('admin.students.index') }}" class="text-xs hover:text-emerald-500 transition-colors">Data Siswa</a>
                <span class="material-symbols-outlined text-sm">chevron_right</span>
                <span class="text-xs font-semibold text-emerald-500">Edit Siswa</span>
            </nav>
            <h2 class="font-display text-3xl md:text-4xl font-bold text-gray-900">Edit Data Siswa</h2>
            <p class="text-gray-500 mt-1">Registrasi: <span class="font-mono">{{ $registration->reg_number }}</span></p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.students.index') }}" class="flex items-center gap-2 bg-white border border-gray-200 text-gray-600 px-4 py-2.5 rounded-xl text-sm font-bold hover:bg-gray-50 transition-colors shadow-sm">
                <span class="material-symbols-outlined text-[16px]">arrow_back</span> Kembali
            </a>
        </div>
    </section>

    @if($errors->any())
        <div class="mb-6 p-4 rounded-xl bg-red-50 border border-red-200 text-red-600 text-sm">
            <div class="font-bold mb-2 flex items-center gap-2"><span class="material-symbols-outlined text-[18px]">error</span> Terjadi kesalahan:</div>
            <ul class="list-disc pl-5 space-y-1">
                @foreach($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.students.update', $registration->id) }}" method="POST" class="space-y-6 pb-10">
        @csrf
        @method('PUT')

        <!-- Data Siswa -->
        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
            <h3 class="font-bold text-gray-800 text-lg mb-4 flex items-center gap-2 border-b border-gray-100 pb-3">
                <span class="material-symbols-outlined text-emerald-500">child_care</span> Data Siswa
            </h3>
            @if($registration->student)
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1.5">Nama Lengkap</label>
                    <input type="text" name="full_name" value="{{ old('full_name', $registration->student->full_name) }}" class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 text-gray-800 text-sm focus:outline-none focus:border-emerald-400 focus:ring-2 focus:ring-emerald-400/20 focus:bg-white transition-all" required>
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1.5">Nama Panggilan</label>
                    <input type="text" name="nickname" value="{{ old('nickname', $registration->student->nickname) }}" class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 text-gray-800 text-sm focus:outline-none focus:border-emerald-400 focus:ring-2 focus:ring-emerald-400/20 focus:bg-white transition-all">
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1.5">NIK</label>
                    <input type="text" name="nik" value="{{ old('nik', $registration->student->nik) }}" class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 text-gray-800 text-sm focus:outline-none focus:border-emerald-400 focus:ring-2 focus:ring-emerald-400/20 focus:bg-white transition-all" required>
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1.5">No. KK</label>
                    <input type="text" name="no_kk" value="{{ old('no_kk', $registration->student->no_kk) }}" class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 text-gray-800 text-sm focus:outline-none focus:border-emerald-400 focus:ring-2 focus:ring-emerald-400/20 focus:bg-white transition-all">
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1.5">Anak Ke</label>
                    <input type="number" name="child_order" value="{{ old('child_order', $registration->student->child_order) }}" class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 text-gray-800 text-sm focus:outline-none focus:border-emerald-400 focus:ring-2 focus:ring-emerald-400/20 focus:bg-white transition-all">
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1.5">Jumlah Saudara</label>
                    <input type="number" name="siblings_count" value="{{ old('siblings_count', $registration->student->siblings_count) }}" class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 text-gray-800 text-sm focus:outline-none focus:border-emerald-400 focus:ring-2 focus:ring-emerald-400/20 focus:bg-white transition-all">
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1.5">Jenis Kelamin</label>
                    <select name="gender" class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 text-gray-800 text-sm focus:outline-none focus:border-emerald-400 focus:ring-2 focus:ring-emerald-400/20 focus:bg-white transition-all" required>
                        <option value="L" {{ old('gender', $registration->student->gender) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="P" {{ old('gender', $registration->student->gender) == 'P' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1.5">Tempat Lahir</label>
                    <input type="text" name="birth_place" value="{{ old('birth_place', $registration->student->birth_place) }}" class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 text-gray-800 text-sm focus:outline-none focus:border-emerald-400 focus:ring-2 focus:ring-emerald-400/20 focus:bg-white transition-all" required>
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1.5">Tanggal Lahir</label>
                    <input type="date" name="birth_date" value="{{ old('birth_date', $registration->student->birth_date) }}" class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 text-gray-800 text-sm focus:outline-none focus:border-emerald-400 focus:ring-2 focus:ring-emerald-400/20 focus:bg-white transition-all" required>
                </div>
            </div>
            @else
            <p class="text-red-500 text-sm font-bold">Data siswa tidak ditemukan.</p>
            @endif
        </div>

        <!-- Data Orang Tua -->
        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
            <h3 class="font-bold text-gray-800 text-lg mb-4 flex items-center gap-2 border-b border-gray-100 pb-3">
                <span class="material-symbols-outlined text-amber-500">family_restroom</span> Data Orang Tua / Wali
            </h3>
            @if($registration->parent)
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-5 gap-y-6">
                <!-- Ayah -->
                <div class="space-y-4">
                    <h4 class="font-bold text-sm text-gray-500 uppercase tracking-wider">Data Ayah</h4>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1.5">Nama Ayah</label>
                        <input type="text" name="father_name" value="{{ old('father_name', $registration->parent->father_name) }}" class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 text-gray-800 text-sm focus:outline-none focus:border-emerald-400 focus:ring-2 focus:ring-emerald-400/20 focus:bg-white transition-all" required>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1.5">Pekerjaan Ayah</label>
                        <input type="text" name="father_job" value="{{ old('father_job', $registration->parent->father_job) }}" class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 text-gray-800 text-sm focus:outline-none focus:border-emerald-400 focus:ring-2 focus:ring-emerald-400/20 focus:bg-white transition-all">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1.5">No. HP Ayah</label>
                        <input type="text" name="father_phone" value="{{ old('father_phone', $registration->parent->father_phone) }}" class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 text-gray-800 text-sm focus:outline-none focus:border-emerald-400 focus:ring-2 focus:ring-emerald-400/20 focus:bg-white transition-all" required>
                    </div>
                </div>
                
                <!-- Ibu -->
                <div class="space-y-4">
                    <h4 class="font-bold text-sm text-gray-500 uppercase tracking-wider">Data Ibu</h4>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1.5">Nama Ibu</label>
                        <input type="text" name="mother_name" value="{{ old('mother_name', $registration->parent->mother_name) }}" class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 text-gray-800 text-sm focus:outline-none focus:border-emerald-400 focus:ring-2 focus:ring-emerald-400/20 focus:bg-white transition-all" required>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1.5">Pekerjaan Ibu</label>
                        <input type="text" name="mother_job" value="{{ old('mother_job', $registration->parent->mother_job) }}" class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 text-gray-800 text-sm focus:outline-none focus:border-emerald-400 focus:ring-2 focus:ring-emerald-400/20 focus:bg-white transition-all">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1.5">No. HP Ibu</label>
                        <input type="text" name="mother_phone" value="{{ old('mother_phone', $registration->parent->mother_phone) }}" class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 text-gray-800 text-sm focus:outline-none focus:border-emerald-400 focus:ring-2 focus:ring-emerald-400/20 focus:bg-white transition-all">
                    </div>
                </div>
            </div>
            @else
            <p class="text-red-500 text-sm font-bold">Data wali tidak ditemukan.</p>
            @endif
        </div>

        <!-- Data Alamat -->
        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
            <h3 class="font-bold text-gray-800 text-lg mb-4 flex items-center gap-2 border-b border-gray-100 pb-3">
                <span class="material-symbols-outlined text-purple-500">home_pin</span> Data Alamat
            </h3>
            @if($registration->address)
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div class="md:col-span-2">
                    <label class="block text-sm font-bold text-gray-700 mb-1.5">Alamat Lengkap (Jalan/Gg/No/RT/RW)</label>
                    <textarea name="address_line" rows="2" class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 text-gray-800 text-sm focus:outline-none focus:border-emerald-400 focus:ring-2 focus:ring-emerald-400/20 focus:bg-white transition-all resize-y" required>{{ old('address_line', $registration->address->address_line) }}</textarea>
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1.5">Provinsi</label>
                    <input type="text" name="province" value="{{ old('province', $registration->address->province) }}" class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 text-gray-800 text-sm focus:outline-none focus:border-emerald-400 focus:ring-2 focus:ring-emerald-400/20 focus:bg-white transition-all">
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1.5">Kota / Kabupaten</label>
                    <input type="text" name="city" value="{{ old('city', $registration->address->city) }}" class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 text-gray-800 text-sm focus:outline-none focus:border-emerald-400 focus:ring-2 focus:ring-emerald-400/20 focus:bg-white transition-all">
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1.5">Kecamatan</label>
                    <input type="text" name="district" value="{{ old('district', $registration->address->district) }}" class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 text-gray-800 text-sm focus:outline-none focus:border-emerald-400 focus:ring-2 focus:ring-emerald-400/20 focus:bg-white transition-all">
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1.5">Kode Pos</label>
                    <input type="text" name="postal_code" value="{{ old('postal_code', $registration->address->postal_code) }}" class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 text-gray-800 text-sm focus:outline-none focus:border-emerald-400 focus:ring-2 focus:ring-emerald-400/20 focus:bg-white transition-all">
                </div>
            </div>
            @else
            <p class="text-red-500 text-sm font-bold">Data alamat tidak ditemukan.</p>
            @endif
        </div>

        <div class="flex justify-end gap-3 mt-8 border-t border-gray-200 pt-6">
            <a href="{{ route('admin.students.index') }}" class="px-6 py-2.5 rounded-xl border border-gray-200 text-gray-600 text-sm font-bold hover:bg-gray-50 transition-colors">Batal</a>
            <button type="submit" class="px-6 py-2.5 bg-emerald-500 text-white rounded-xl text-sm font-bold hover:bg-emerald-600 transition-colors shadow-sm flex items-center gap-2">
                <span class="material-symbols-outlined text-[18px]">save</span> Simpan Perubahan
            </button>
        </div>
    </form>
</main>
@endsection
