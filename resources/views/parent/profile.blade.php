@extends('layouts.parent')

@section('content')
<!-- Include Alpine.js for tab switching -->
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

<main class="md:ml-[280px] min-h-screen px-4 md:px-8 py-8 bg-gray-50" x-data="{ tab: 'profile' }">
    <div class="max-w-4xl mx-auto">
        <!-- Page Header -->
        <div class="mb-8">
            <h2 class="font-display text-3xl md:text-4xl font-bold text-gray-900">Pengaturan Akun Wali</h2>
            <p class="text-gray-500 mt-2 text-base">Kelola informasi profil, keamanan, dan preferensi kontak Anda.</p>
        </div>

        <!-- Bento Layout for Forms -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- Left Column: Summary Info -->
            <div class="lg:col-span-1 space-y-6">
                <div class="bg-white border border-gray-200 p-6 rounded-2xl shadow-sm">
                    <div class="flex flex-col items-center text-center py-4">
                        <div class="w-24 h-24 rounded-full overflow-hidden border-4 border-emerald-50 mb-4 bg-emerald-100 flex items-center justify-center text-emerald-500">
                            <span class="material-symbols-outlined text-4xl">person</span>
                        </div>
                        <h3 class="font-bold text-gray-900 text-lg">{{ $parentData->father_name ?? $user->name }}</h3>
                        <p class="text-gray-500 text-sm mt-1">{{ $user->email }}</p>
                        <span class="mt-3 px-3 py-1 bg-emerald-100 text-emerald-700 text-[10px] uppercase font-bold rounded-full">Orang Tua / Wali</span>
                    </div>
                    
                    <nav class="mt-6 pt-6 border-t border-gray-100 space-y-2">
                        <a href="{{ route('parent.student.edit') }}" class="w-full text-left flex items-center gap-3 p-3 rounded-xl text-gray-500 hover:bg-gray-50 hover:text-emerald-600 transition-colors">
                            <span class="material-symbols-outlined">badge</span>
                            <span>Data Siswa</span>
                        </a>
                        <button @click="tab = 'profile'" :class="tab === 'profile' ? 'bg-emerald-50 text-emerald-600 font-bold' : 'text-gray-500 hover:bg-gray-50 hover:text-emerald-600'" class="w-full text-left flex items-center gap-3 p-3 rounded-xl transition-colors">
                            <span class="material-symbols-outlined">person</span>
                            <span>Profil Pribadi</span>
                        </button>
                        <button @click="tab = 'security'" :class="tab === 'security' ? 'bg-emerald-50 text-emerald-600 font-bold' : 'text-gray-500 hover:bg-gray-50 hover:text-emerald-600'" class="w-full text-left flex items-center gap-3 p-3 rounded-xl transition-colors">
                            <span class="material-symbols-outlined">lock</span>
                            <span>Keamanan & Sandi</span>
                        </button>
                    </nav>
                </div>
                
                <!-- School Support Card -->
                <div class="bg-amber-50 border-l-4 border-amber-500 p-6 rounded-xl shadow-sm">
                    <h4 class="font-bold text-amber-900 flex items-center gap-2">
                        <span class="material-symbols-outlined text-[20px]">help_center</span>
                        Bantuan Akun
                    </h4>
                    <p class="text-amber-800/80 text-sm mt-2 leading-relaxed">Mengalami kesulitan mengubah data? Hubungi Admin RA AN-NUUR melalui WhatsApp.</p>
                </div>
            </div>

            <!-- Right Column: Forms -->
            <div class="lg:col-span-2 relative">
                
                @if(session('success'))
                <div class="p-4 mb-6 text-sm text-emerald-800 bg-emerald-50 rounded-xl border border-emerald-100 shadow-sm">
                    {{ session('success') }}
                </div>
                @endif
                
                <!-- Profile Form Section -->
                <section x-show="tab === 'profile'" x-transition.opacity.duration.300ms class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">
                    <div class="p-6 border-b border-gray-100 bg-gray-50/50">
                        <h3 class="font-bold text-gray-900 text-lg">Informasi Profil Wali</h3>
                    </div>
                    
                    <form action="{{ route('parent.profile.update') }}" method="POST" class="p-6 space-y-6">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="font-medium text-sm text-gray-700">Nama Ayah / Wali</label>
                                <input name="father_name" class="w-full p-3 rounded-xl border border-gray-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 outline-none transition-all text-gray-800" type="text" value="{{ old('father_name', $parentData->father_name ?? '') }}"/>
                                @error('father_name') <span class="text-rose-500 text-xs">{{ $message }}</span> @enderror
                            </div>
                            <div class="space-y-2">
                                <label class="font-medium text-sm text-gray-700">Pekerjaan</label>
                                <input name="father_job" class="w-full p-3 rounded-xl border border-gray-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 outline-none transition-all text-gray-800" type="text" value="{{ old('father_job', $parentData->father_job ?? '') }}"/>
                                @error('father_job') <span class="text-rose-500 text-xs">{{ $message }}</span> @enderror
                            </div>
                            <div class="space-y-2">
                                <label class="font-medium text-sm text-gray-700">Nomor Telepon (WA)</label>
                                <input name="father_phone" class="w-full p-3 rounded-xl border border-gray-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 outline-none transition-all text-gray-800" type="text" value="{{ old('father_phone', $parentData->father_phone ?? '') }}"/>
                                @error('father_phone') <span class="text-rose-500 text-xs">{{ $message }}</span> @enderror
                            </div>
                            <div class="space-y-2">
                                <label class="font-medium text-sm text-gray-700">Email</label>
                                <input class="w-full p-3 rounded-xl border border-gray-200 bg-gray-100 outline-none transition-all text-gray-500 cursor-not-allowed" type="email" value="{{ $user->email }}" readonly/>
                            </div>
                        </div>
                        <div class="space-y-2">
                            <label class="font-medium text-sm text-gray-700">Alamat Lengkap</label>
                            <textarea name="address_line" class="w-full p-3 rounded-xl border border-gray-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 outline-none transition-all text-gray-800" rows="3">{{ old('address_line', $addressData->address_line ?? '') }}</textarea>
                            @error('address_line') <span class="text-rose-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div class="pt-6 border-t border-gray-100 flex justify-end">
                            <button class="px-6 py-3 bg-emerald-500 text-white font-bold rounded-xl transition-all hover:bg-emerald-600 active:scale-95 shadow-md shadow-emerald-500/20" type="submit">Simpan Perubahan</button>
                        </div>
                    </form>
                </section>

                <!-- Change Password Section -->
                <section x-show="tab === 'security'" style="display: none;" x-transition.opacity.duration.300ms class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">
                    <div class="p-6 border-b border-gray-100 bg-gray-50/50">
                        <h3 class="font-bold text-gray-900 text-lg">Keamanan Akun</h3>
                    </div>
                    <div class="p-6">
                        <form class="space-y-6">
                            <div class="space-y-2">
                                <label class="font-medium text-sm text-gray-700">Kata Sandi Saat Ini</label>
                                <input class="w-full p-3 rounded-xl border border-gray-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 outline-none transition-all text-gray-800" placeholder="••••••••" type="password"/>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-2">
                                    <label class="font-medium text-sm text-gray-700">Kata Sandi Baru</label>
                                    <input class="w-full p-3 rounded-xl border border-gray-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 outline-none transition-all text-gray-800" placeholder="Min. 8 Karakter" type="password"/>
                                </div>
                                <div class="space-y-2">
                                    <label class="font-medium text-sm text-gray-700">Konfirmasi Sandi Baru</label>
                                    <input class="w-full p-3 rounded-xl border border-gray-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 outline-none transition-all text-gray-800" placeholder="Ulangi Sandi Baru" type="password"/>
                                </div>
                            </div>
                            <div class="pt-6 border-t border-gray-100 flex justify-end">
                                <button class="px-6 py-3 bg-white border border-emerald-500 text-emerald-600 font-bold rounded-xl transition-all hover:bg-emerald-50 active:scale-95" type="button">Ubah Sandi</button>
                            </div>
                        </form>
                    </div>
                </section>

            </div>
        </div>
    </div>
</main>
@endsection
