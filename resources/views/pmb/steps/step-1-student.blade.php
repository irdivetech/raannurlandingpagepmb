<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Formulir Pendaftaran | PMB RA An-Nuur</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Fredoka:wght@400;500;600&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Outfit', 'sans-serif'], display: ['Fredoka', 'sans-serif'] },
                    colors: { primary: '#10B981', primaryDark: '#047857', secondary: '#F59E0B', accent: '#F43F5E' }
                }
            }
        }
    </script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <style>
        .glass { background: rgba(255, 255, 255, 0.85); backdrop-filter: blur(12px); border: 1px solid rgba(255, 255, 255, 0.3); }
        .hero-pattern { background-color: #ffffff; opacity: 0.1; background-image: radial-gradient(#10B981 2px, transparent 2px), radial-gradient(#10B981 2px, #ffffff 2px); background-size: 80px 80px; background-position: 0 0, 40px 40px; }
    </style>
</head>

<body class="font-sans antialiased text-gray-800 bg-gray-50 selection:bg-primary selection:text-white flex flex-col min-h-screen">
    
    <!-- Navbar -->
    <nav x-data="{ mobileMenuOpen: false }"
        class="bg-white/95 backdrop-blur-md shadow-sm py-3 sticky top-0 z-50 border-b border-gray-100 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center">
                <!-- Logo -->
                <a href="{{ route('pmb.landing') }}" class="flex items-center gap-3">
                    <img src="{{ asset('assets/img/logo/logosekolah.jpeg') }}" alt="Logo RA An-Nuur"
                        class="h-10 w-10 sm:h-12 sm:w-12 rounded-full border border-gray-200 shadow-sm object-cover">
                    <div>
                        <h1 class="font-display font-bold text-lg sm:text-xl leading-tight text-primaryDark">RA AN-NUUR</h1>
                        <p class="text-[10px] sm:text-xs font-medium tracking-wider uppercase text-gray-500">Cianjur, Jawa Barat</p>
                    </div>
                </a>

                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('pmb.landing') }}#beranda" class="font-medium hover:text-secondary transition-colors text-gray-700">Beranda</a>
                    <a href="{{ route('pmb.landing') }}#profil" class="font-medium hover:text-secondary transition-colors text-gray-700">Profil</a>
                    <a href="{{ route('pmb.landing') }}#akademik" class="font-medium hover:text-secondary transition-colors text-gray-700">Akademik</a>
                    <a href="{{ route('public.biaya') }}" class="font-medium hover:text-secondary transition-colors text-gray-700">Biaya</a>
                    <a href="{{ route('public.kontak') }}" class="font-medium hover:text-secondary transition-colors text-gray-700">Kontak</a>
                    <a href="{{ route('pmb.tracking') }}" class="font-medium hover:text-secondary transition-colors text-gray-700">Cek Status</a>

                    <a href="{{ route('parent.login') }}"
                        class="px-6 py-2.5 rounded-full font-semibold transition-all shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 bg-primary text-white hover:bg-primaryDark">
                        PMB Online
                    </a>
                </div>
            </div>
        </div>
    </nav>
    <main class="flex-grow bg-gray-50 py-12 relative">
        <div class="max-w-4xl mx-auto px-4">
            
            <!-- Wizard Header & Stepper -->
            <div class="mb-10 bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
                <h1 class="font-display text-2xl md:text-3xl font-bold text-gray-900 mb-2">Formulir Pendaftaran Siswa Baru</h1>
                <p class="text-sm text-gray-500 mb-8">Mohon lengkapi data dengan benar sesuai dengan dokumen resmi (Kartu Keluarga/Akta Kelahiran).</p>
                
                <!-- Progress Stepper Tracker -->
                <div class="relative flex justify-between items-center z-10">
                    <!-- Background Line -->
                    <div class="absolute top-1/2 left-0 w-full h-1 bg-gray-100 -z-10 -translate-y-1/2 rounded-full"></div>
                    <!-- Active Progress Line (Changes width based on step) -->
                    <div class="absolute top-1/2 left-0 w-0 h-1 bg-primary -z-10 -translate-y-1/2 rounded-full step-transition" id="progress-line"></div>
                    
                    <!-- Step 1 Node -->
                    <div class="flex flex-col items-center gap-2 relative" id="step-node-1">
                        <div class="w-10 h-10 rounded-full flex items-center justify-center font-bold text-sm step-transition bg-primary text-white ring-4 ring-primary/20 border-2 border-white" id="step-circle-1">
                            1
                        </div>
                        <span class="font-bold text-sm text-[11px] md:text-sm text-primary absolute -bottom-6 whitespace-nowrap" id="step-label-1">Data Siswa</span>
                    </div>
                    
                    <!-- Step 2 Node -->
                    <div class="flex flex-col items-center gap-2 relative" id="step-node-2">
                        <div class="w-10 h-10 rounded-full flex items-center justify-center font-bold text-sm step-transition bg-gray-100 text-gray-400 border-2 border-white" id="step-circle-2">
                            2
                        </div>
                        <span class="font-bold text-sm text-[11px] md:text-sm text-gray-400 absolute -bottom-6 whitespace-nowrap" id="step-label-2">Orang Tua</span>
                    </div>
                    
                    <!-- Step 3 Node -->
                    <div class="flex flex-col items-center gap-2 relative" id="step-node-3">
                        <div class="w-10 h-10 rounded-full flex items-center justify-center font-bold text-sm step-transition bg-gray-100 text-gray-400 border-2 border-white" id="step-circle-3">
                            3
                        </div>
                        <span class="font-bold text-sm text-[11px] md:text-sm text-gray-400 absolute -bottom-6 whitespace-nowrap" id="step-label-3">Alamat</span>
                    </div>
                    
                    <!-- Step 4 Node -->
                    <div class="flex flex-col items-center gap-2 relative" id="step-node-4">
                        <div class="w-10 h-10 rounded-full flex items-center justify-center font-bold text-sm step-transition bg-gray-100 text-gray-400 border-2 border-white" id="step-circle-4">
                            4
                        </div>
                        <span class="font-bold text-sm text-[11px] md:text-sm text-gray-400 absolute -bottom-6 whitespace-nowrap" id="step-label-4">Dokumen</span>
                    </div>

                    <!-- Step 5 Node -->
                    <div class="flex flex-col items-center gap-2 relative" id="step-node-5">
                        <div class="w-10 h-10 rounded-full flex items-center justify-center font-bold text-sm step-transition bg-gray-100 text-gray-400 border-2 border-white" id="step-circle-5">
                            <span class="material-symbols-outlined text-[18px]">done_all</span>
                        </div>
                        <span class="font-bold text-sm text-[11px] md:text-sm text-gray-400 absolute -bottom-6 whitespace-nowrap" id="step-label-5">Review</span>
                    </div>
                </div>
            </div>

            <!-- Form Container -->
            <form id="registrationForm" action="{{ route('pmb.submit') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-2xl p-6 md:p-8 shadow-xl border border-gray-100 min-h-[400px]">
                @csrf
                
                @if ($errors->any())
                    <div class="mb-6 p-4 bg-red-50 text-red-700 rounded-xl border border-red-200">
                        <div class="flex items-center gap-2 mb-2">
                            <span class="material-symbols-outlined">error</span>
                            <h3 class="font-bold">Terjadi Kesalahan</h3>
                        </div>
                        <ul class="list-disc list-inside text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                <!-- STEP 1: Data Siswa -->
                <div id="form-step-1" class="step-content">
                    <div class="mb-6 pb-4 border-b border-gray-100">
                        <h2 class="font-display text-xl font-bold text-gray-900 flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary">face</span> Data Calon Siswa
                        </h2>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-1">
                            <label class="font-bold text-sm text-gray-500">Nama Lengkap *</label>
                            <input type="text" id="child_name" name="childName" value="{{ old('childName', $childName ?? '') }}" placeholder="Masukkan Nama Lengkap" required class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all text-gray-800">
                            <input type="hidden" name="email" value="{{ old('email', $email ?? '') }}">
                        </div>
                        <div class="space-y-1">
                            <label class="font-bold text-sm text-gray-500">Nama Panggilan</label>
                            <input type="text" name="nickname" value="{{ old('nickname') }}" placeholder="Contoh: Toni" class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all text-gray-800">
                        </div>
                        <div class="space-y-1">
                            <label class="font-bold text-sm text-gray-500">Nomor Induk Kependudukan (NIK) *</label>
                            <input type="text" name="nik" value="{{ old('nik') }}" placeholder="16 digit angka sesuai KK" required class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all text-gray-800">
                        </div>
                        <div class="space-y-1">
                            <label class="font-bold text-sm text-gray-500">Nomor Kartu Keluarga (KK)</label>
                            <input type="text" name="no_kk" value="{{ old('no_kk') }}" placeholder="16 digit angka KK" class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all text-gray-800">
                        </div>
                        <div class="space-y-1 flex gap-2">
                            <div class="w-1/2">
                                <label class="font-bold text-sm text-gray-500">Anak Ke-</label>
                                <input type="number" name="child_order" value="{{ old('child_order') }}" min="1" class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all text-gray-800">
                            </div>
                            <div class="w-1/2">
                                <label class="font-bold text-sm text-gray-500">Dari Berapa Bersaudara</label>
                                <input type="number" name="siblings_count" value="{{ old('siblings_count') }}" min="1" class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all text-gray-800">
                            </div>
                        </div>
                        <div class="space-y-1">
                            <label class="font-bold text-sm text-gray-500">Jenis Kelamin *</label>
                            <select name="gender" required class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all text-gray-800">
                                <option value="" disabled {{ old('gender') ? '' : 'selected' }}>Pilih Jenis Kelamin</option>
                                <option value="L" {{ old('gender') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="P" {{ old('gender') == 'P' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>
                        <div class="space-y-1">
                            <label class="font-bold text-sm text-gray-500">Tempat Lahir *</label>
                            <input type="text" name="birth_place" value="{{ old('birth_place') }}" placeholder="Contoh: Jakarta" required class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all text-gray-800">
                        </div>
                        <div class="space-y-1">
                            <label class="font-bold text-sm text-gray-500">Tanggal Lahir *</label>
                            <input type="date" name="birth_date" value="{{ old('birth_date') }}" required class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all text-gray-800">
                        </div>
                    </div>
                </div>

                <!-- STEP 2: Data Orang Tua (Hidden by default) -->
                <div id="form-step-2" class="step-content hidden">
                    <div class="mb-6 pb-4 border-b border-gray-100">
                        <h2 class="font-display text-xl font-bold text-gray-900 flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary">family_restroom</span> Data Orang Tua / Wali
                        </h2>
                    </div>
                    
                    <h3 class="font-bold text-secondary font-bold mb-4 bg-amber-50 inline-block px-3 py-1 rounded-md">Data Ayah</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                        <div class="space-y-1">
                            <label class="font-bold text-sm text-gray-500">Nama Ayah *</label>
                            <input type="text" name="father_name" value="{{ old('father_name') }}" required class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all text-gray-800">
                        </div>
                        <div class="space-y-1">
                            <label class="font-bold text-sm text-gray-500">Pekerjaan Ayah *</label>
                            <input type="text" name="father_job" value="{{ old('father_job') }}" required class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all text-gray-800">
                        </div>
                        <div class="space-y-1">
                            <label class="font-bold text-sm text-gray-500">No. WhatsApp Ayah *</label>
                            <input type="tel" id="parent_phone" name="father_phone" value="{{ old('father_phone', $phone ?? '') }}" required placeholder="08..." class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all text-gray-800">
                        </div>
                    </div>

                    <h3 class="font-bold text-secondary font-bold mb-4 bg-amber-50 inline-block px-3 py-1 rounded-md">Data Ibu</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-1">
                            <label class="font-bold text-sm text-gray-500">Nama Ibu *</label>
                            <input type="text" name="mother_name" value="{{ old('mother_name') }}" required class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all text-gray-800">
                        </div>
                        <div class="space-y-1">
                            <label class="font-bold text-sm text-gray-500">Pekerjaan Ibu *</label>
                            <input type="text" name="mother_job" value="{{ old('mother_job') }}" required class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all text-gray-800">
                        </div>
                        <div class="space-y-1">
                            <label class="font-bold text-sm text-gray-500">No. WhatsApp Ibu *</label>
                            <input type="tel" name="mother_phone" value="{{ old('mother_phone') }}" required class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all text-gray-800">
                        </div>
                    </div>
                </div>

                <!-- STEP 3: Alamat (Hidden by default) -->
                <div id="form-step-3" class="step-content hidden">
                    <div class="mb-6 pb-4 border-b border-gray-100">
                        <h2 class="font-display text-xl font-bold text-gray-900 flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary">home_pin</span> Alamat Domisili
                        </h2>
                    </div>
                    
                    <div class="space-y-6">
                        <div class="space-y-1">
                            <label class="font-bold text-sm text-gray-500">Alamat Lengkap (Jalan, RT/RW, Perumahan) *</label>
                            <textarea name="address_line" rows="3" required class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all text-gray-800">{{ old('address_line') }}</textarea>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-1">
                                <label class="font-bold text-sm text-gray-500">Provinsi *</label>
                                <select id="provinsi" name="province" required class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all text-gray-800" data-old="{{ old('province') }}">
                                    <option value="" disabled selected>Memuat Provinsi...</option>
                                </select>
                                <input type="hidden" id="province_name" name="province_name" value="{{ old('province_name') }}">
                            </div>
                            <div class="space-y-1">
                                <label class="font-bold text-sm text-gray-500">Kota / Kabupaten *</label>
                                <select id="kota" name="city" required class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all text-gray-800" data-old="{{ old('city') }}" disabled>
                                    <option value="" disabled selected>Pilih Provinsi Terlebih Dahulu</option>
                                </select>
                                <input type="hidden" id="city_name" name="city_name" value="{{ old('city_name') }}">
                            </div>
                            <div class="space-y-1">
                                <label class="font-bold text-sm text-gray-500">Kecamatan *</label>
                                <select id="kecamatan" name="district" required class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all text-gray-800" data-old="{{ old('district') }}" disabled>
                                    <option value="" disabled selected>Pilih Kota Terlebih Dahulu</option>
                                </select>
                                <input type="hidden" id="district_name" name="district_name" value="{{ old('district_name') }}">
                            </div>
                            <div class="space-y-1">
                                <label class="font-bold text-sm text-gray-500">Kode Pos *</label>
                                <input type="text" name="postal_code" value="{{ old('postal_code') }}" required class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all text-gray-800">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- STEP 4: Dokumen (Hidden by default) -->
                <div id="form-step-4" class="step-content hidden">
                    <div class="mb-6 pb-4 border-b border-gray-100">
                        <h2 class="font-display text-xl font-bold text-gray-900 flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary">folder_open</span> Dokumen Pendukung
                        </h2>
                        <p class="text-sm text-gray-500 mt-1">Pilih cara penyerahan dokumen pendukung pendaftaran.</p>
                    </div>
                    
                    <div class="mb-6 flex flex-col md:flex-row gap-4">
                        <label class="flex items-center gap-3 cursor-pointer bg-gray-50 p-4 rounded-xl border border-gray-200 flex-1 hover:border-primary transition-colors">
                            <input type="radio" name="doc_method" value="digital" checked class="w-5 h-5 text-primary" onchange="toggleDocMethod()">
                            <div class="flex flex-col">
                                <span class="font-bold text-gray-900">Unggah Digital</span>
                                <span class="text-xs text-gray-500">Upload file (Foto/PDF) sekarang</span>
                            </div>
                        </label>
                        <label class="flex items-center gap-3 cursor-pointer bg-gray-50 p-4 rounded-xl border border-gray-200 flex-1 hover:border-primary transition-colors">
                            <input type="radio" name="doc_method" value="manual" class="w-5 h-5 text-primary" onchange="toggleDocMethod()">
                            <div class="flex flex-col">
                                <span class="font-bold text-gray-900">Serahkan Langsung</span>
                                <span class="text-xs text-gray-500">Bawa fotokopi langsung ke sekolah</span>
                            </div>
                        </label>
                    </div>

                    <div id="doc-manual-info" class="hidden mb-6 p-4 bg-amber-50 text-amber-800 text-sm rounded-xl flex items-start gap-3 border border-amber-200">
                        <span class="material-symbols-outlined mt-0.5 text-secondary">info</span>
                        <p>Anda memilih untuk menyerahkan dokumen langsung ke sekolah. Silakan bawa fotokopi KK, Akta Kelahiran, KTP Orang Tua, dan Pas Foto Anak (3x4) saat datang ke sekolah.</p>
                    </div>

                    <div id="doc-upload-grid" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- File Upload Input Style -->
                        <div class="border-2 border-dashed border-gray-200 rounded-xl p-4 text-center hover:border-primary hover:bg-primaryDark/5 transition-colors">
                            <span class="material-symbols-outlined text-3xl text-gray-500 mb-2">upload_file</span>
                            <h4 class="font-bold text-gray-900">Akta Kelahiran</h4>
                            <input type="file" name="akta" accept=".jpg,.jpeg,.png,.pdf" class="w-full text-[12px] mt-2 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-primary/10 file:text-primary hover:file:bg-primary/20 cursor-pointer">
                        </div>
                        
                        <div class="border-2 border-dashed border-gray-200 rounded-xl p-4 text-center hover:border-primary hover:bg-primaryDark/5 transition-colors">
                            <span class="material-symbols-outlined text-3xl text-gray-500 mb-2">group</span>
                            <h4 class="font-bold text-gray-900">Kartu Keluarga (KK)</h4>
                            <input type="file" name="kk" accept=".jpg,.jpeg,.png,.pdf" class="w-full text-[12px] mt-2 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-primary/10 file:text-primary hover:file:bg-primary/20 cursor-pointer">
                        </div>
                        
                        <div class="border-2 border-dashed border-gray-200 rounded-xl p-4 text-center hover:border-primary hover:bg-primaryDark/5 transition-colors">
                            <span class="material-symbols-outlined text-3xl text-gray-500 mb-2">badge</span>
                            <h4 class="font-bold text-gray-900">KTP Orang Tua</h4>
                            <input type="file" name="ktp_ortu" accept=".jpg,.jpeg,.png,.pdf" class="w-full text-[12px] mt-2 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-primary/10 file:text-primary hover:file:bg-primary/20 cursor-pointer">
                        </div>
                        
                        <div class="border-2 border-dashed border-gray-200 rounded-xl p-4 text-center hover:border-primary hover:bg-primaryDark/5 transition-colors">
                            <span class="material-symbols-outlined text-3xl text-gray-500 mb-2">portrait</span>
                            <h4 class="font-bold text-gray-900">Pas Foto Siswa (3x4)</h4>
                            <input type="file" name="foto" accept=".jpg,.jpeg,.png" class="w-full text-[12px] mt-2 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-primary/10 file:text-primary hover:file:bg-primary/20 cursor-pointer">
                        </div>
                    </div>
                </div>

                <!-- STEP 5: Review (Hidden by default) -->
                <div id="form-step-5" class="step-content hidden">
                    <div class="mb-6 pb-4 border-b border-gray-100 text-center">
                        <div class="w-16 h-16 bg-amber-100 text-amber-800 rounded-full flex items-center justify-center mx-auto mb-3">
                            <span class="material-symbols-outlined text-3xl">fact_check</span>
                        </div>
                        <h2 class="font-display text-xl font-bold text-gray-900">Tinjauan Akhir</h2>
                        <p class="text-sm text-gray-500 mt-1">Pastikan kembali data yang diisi sudah benar sebelum mengirimkan formulir.</p>
                    </div>
                    
                    <div class="bg-gray-50 rounded-xl p-4 border border-gray-200 mb-6 text-sm">
                        <h3 class="font-bold text-primary mb-3">Data Siswa:</h3>
                        <ul class="space-y-1 text-gray-900 mb-4">
                            <li class="flex justify-between border-b border-gray-200 pb-1">
                                <span class="text-gray-500">Nama Lengkap:</span><span class="font-bold text-right" id="review_child_name">-</span>
                            </li>
                            <li class="flex justify-between border-b border-gray-200 pb-1">
                                <span class="text-gray-500">Panggilan:</span><span class="font-bold text-right" id="review_nickname">-</span>
                            </li>
                            <li class="flex justify-between border-b border-gray-200 pb-1">
                                <span class="text-gray-500">NIK / No. KK:</span><span class="font-bold text-right" id="review_nik_kk">-</span>
                            </li>
                            <li class="flex justify-between border-b border-gray-200 pb-1">
                                <span class="text-gray-500">Jenis Kelamin:</span><span class="font-bold text-right" id="review_gender">-</span>
                            </li>
                            <li class="flex justify-between border-b border-gray-200 pb-1">
                                <span class="text-gray-500">Anak Ke / Bersaudara:</span><span class="font-bold text-right" id="review_child_order">-</span>
                            </li>
                        </ul>
                        
                        <h3 class="font-bold text-primary mb-3">Data Orang Tua:</h3>
                        <ul class="space-y-1 text-gray-900 mb-4">
                            <li class="flex justify-between border-b border-gray-200 pb-1">
                                <span class="text-gray-500">Nama Ayah:</span><span class="font-bold text-right" id="review_father_name">-</span>
                            </li>
                            <li class="flex justify-between border-b border-gray-200 pb-1">
                                <span class="text-gray-500">Nama Ibu:</span><span class="font-bold text-right" id="review_mother_name">-</span>
                            </li>
                            <li class="flex justify-between border-b border-gray-200 pb-1">
                                <span class="text-gray-500">Email Terdaftar:</span><span class="font-bold text-right" id="review_email">{{ $email ?? '-' }}</span>
                            </li>
                            <li class="flex justify-between border-b border-gray-200 pb-1">
                                <span class="text-gray-500">Nomor Kontak:</span><span class="font-bold text-right" id="review_phone">-</span>
                            </li>
                        </ul>

                        <h3 class="font-bold text-primary mb-3">Alamat Domisili:</h3>
                        <p class="font-bold text-gray-900" id="review_address">-</p>

                        <h3 class="font-bold text-primary mb-3 mt-4">Status Dokumen:</h3>
                        <ul class="space-y-1 text-gray-900">
                            <li class="flex justify-between border-b border-gray-200 pb-1">
                                <span class="text-gray-500">Akta Kelahiran:</span><span class="font-bold text-right" id="review_doc_akta">-</span>
                            </li>
                            <li class="flex justify-between border-b border-gray-200 pb-1">
                                <span class="text-gray-500">Kartu Keluarga:</span><span class="font-bold text-right" id="review_doc_kk">-</span>
                            </li>
                            <li class="flex justify-between border-b border-gray-200 pb-1">
                                <span class="text-gray-500">KTP Orang Tua:</span><span class="font-bold text-right" id="review_doc_ktp">-</span>
                            </li>
                            <li class="flex justify-between pb-1">
                                <span class="text-gray-500">Pas Foto:</span><span class="font-bold text-right" id="review_doc_foto">-</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Action Buttons Footer -->
                <div class="mt-8 pt-6 border-t border-gray-100 flex justify-between items-center">
                    <button type="button" id="btn-prev" class="px-6 py-3 rounded-xl font-bold text-gray-900 border border-gray-300 hover:bg-gray-100 transition-colors hidden">
                        Kembali
                    </button>
                    <div class="flex-1"></div> <!-- Spacer -->
                    <button type="button" id="btn-next" class="px-8 py-3 bg-primary text-white rounded-xl font-bold hover:bg-primaryDark transition-colors active:scale-95 shadow-md flex items-center gap-2">
                        Selanjutnya <span class="material-symbols-outlined text-sm">arrow_forward</span>
                    </button>
                    <button type="submit" id="btn-submit" class="px-8 py-3 bg-secondary text-white rounded-xl font-bold hover:bg-[#5a4e00] transition-colors active:scale-95 shadow-md hidden flex items-center gap-2">
                        <span class="material-symbols-outlined text-sm">send</span> Kirim Pendaftaran
                    </button>
                </div>

            </form>
        </div>
    </main>

<script>
    // JS Logic for Multi-step form
    let currentStep = 1;
    const totalSteps = 5;

    const btnNext = document.getElementById('btn-next');
    const btnPrev = document.getElementById('btn-prev');
    const btnSubmit = document.getElementById('btn-submit');
    const progressLine = document.getElementById('progress-line');

    function updateUI() {
        // Hide all steps
        for(let i=1; i<=totalSteps; i++) {
            document.getElementById(`form-step-${i}`).classList.add('hidden');
        }
        // Show current step
        document.getElementById(`form-step-${currentStep}`).classList.remove('hidden');

        // Update Buttons
        if(currentStep === 1) {
            btnPrev.classList.add('hidden');
        } else {
            btnPrev.classList.remove('hidden');
        }

        if(currentStep === totalSteps) {
            btnNext.classList.add('hidden');
            btnSubmit.classList.remove('hidden');
        } else {
            btnNext.classList.remove('hidden');
            btnSubmit.classList.add('hidden');
        }

        // Update Stepper Nodes
        for(let i=1; i<=totalSteps; i++) {
            const circle = document.getElementById(`step-circle-${i}`);
            const label = document.getElementById(`step-label-${i}`);
            
            // Reset styles
            circle.className = `w-10 h-10 rounded-full flex items-center justify-center font-bold text-sm step-transition border-2 border-white ${i==5 ? '' : 'bg-gray-100 text-gray-400'}`;
            label.className = `font-bold text-sm text-[11px] md:text-sm absolute -bottom-6 whitespace-nowrap text-gray-400`;
            
            if(i < currentStep) {
                // Completed
                circle.classList.add('bg-primary', 'text-white');
                circle.classList.remove('bg-gray-100', 'text-gray-400');
                circle.innerHTML = '<span class="material-symbols-outlined text-[18px]">check</span>';
            } else if (i === currentStep) {
                // Active
                circle.classList.add('bg-primary', 'text-white', 'ring-4', 'ring-primary/20');
                circle.classList.remove('bg-gray-100', 'text-gray-400');
                label.classList.add('text-primary', 'font-bold');
                label.classList.remove('text-gray-400');
                if(i==5) {
                    circle.innerHTML = '<span class="material-symbols-outlined text-[18px]">done_all</span>';
                } else {
                    circle.innerHTML = i;
                }
            } else {
                // Pending
                if(i==5) {
                    circle.innerHTML = '<span class="material-symbols-outlined text-[18px]">done_all</span>';
                    circle.classList.add('bg-gray-100', 'text-gray-400');
                } else {
                    circle.innerHTML = i;
                }
            }
        }

        // Update Progress Line width
        // Formula: (currentStep - 1) / (totalSteps - 1) * 100
        const percentage = ((currentStep - 1) / (totalSteps - 1)) * 100;
        progressLine.style.width = `${percentage}%`;

        // Update Review Data if currentStep is 5
        if (currentStep === 5) {
            document.getElementById('review_child_name').innerText = document.getElementById('child_name').value || '-';
            document.getElementById('review_nickname').innerText = document.querySelector('input[name="nickname"]').value || '-';
            let nik = document.querySelector('input[name="nik"]').value || '-';
            let kk = document.querySelector('input[name="no_kk"]').value || '-';
            document.getElementById('review_nik_kk').innerText = nik + ' / ' + kk;
            
            let gender = document.querySelector('select[name="gender"]').value;
            document.getElementById('review_gender').innerText = gender === 'L' ? 'Laki-laki' : (gender === 'P' ? 'Perempuan' : '-');
            
            let childOrder = document.querySelector('input[name="child_order"]').value || '-';
            let siblingsCount = document.querySelector('input[name="siblings_count"]').value || '-';
            document.getElementById('review_child_order').innerText = childOrder + ' dari ' + siblingsCount;
            
            document.getElementById('review_father_name').innerText = document.querySelector('input[name="father_name"]').value || '-';
            document.getElementById('review_mother_name').innerText = document.querySelector('input[name="mother_name"]').value || '-';
            document.getElementById('review_phone').innerText = document.getElementById('parent_phone').value || '-';
            
            let address = document.querySelector('textarea[name="address_line"]').value;
            let province = document.getElementById('provinsi').options[document.getElementById('provinsi').selectedIndex]?.text || '';
            let city = document.getElementById('kota').options[document.getElementById('kota').selectedIndex]?.text || '';
            let district = document.getElementById('kecamatan').options[document.getElementById('kecamatan').selectedIndex]?.text || '';
            let postal = document.querySelector('input[name="postal_code"]').value || '';
            
            document.getElementById('review_address').innerText = address ? `${address}, Kec. ${district}, ${city}, ${province} ${postal}` : '-';

            // Documents
            let docMethod = document.querySelector('input[name="doc_method"]:checked').value;
            if (docMethod === 'manual') {
                document.getElementById('review_doc_akta').innerText = 'Diserahkan Langsung';
                document.getElementById('review_doc_kk').innerText = 'Diserahkan Langsung';
                document.getElementById('review_doc_ktp').innerText = 'Diserahkan Langsung';
                document.getElementById('review_doc_foto').innerText = 'Diserahkan Langsung';
            } else {
                document.getElementById('review_doc_akta').innerText = document.querySelector('input[name="akta"]').files.length ? 'Ada File' : 'Belum diunggah';
                document.getElementById('review_doc_kk').innerText = document.querySelector('input[name="kk"]').files.length ? 'Ada File' : 'Belum diunggah';
                document.getElementById('review_doc_ktp').innerText = document.querySelector('input[name="ktp_ortu"]').files.length ? 'Ada File' : 'Belum diunggah';
                document.getElementById('review_doc_foto').innerText = document.querySelector('input[name="foto"]').files.length ? 'Ada File' : 'Belum diunggah';
            }
        }
    }

    function validateStep() {
        let isValid = true;
        const currentContainer = document.getElementById(`form-step-${currentStep}`);
        const inputs = currentContainer.querySelectorAll('input[required], select[required], textarea[required]');
        
        // Remove previous errors
        currentContainer.querySelectorAll('.error-msg').forEach(el => el.remove());
        currentContainer.querySelectorAll('.border-red-500').forEach(el => el.classList.remove('border-red-500'));

        inputs.forEach(input => {
            // Ignore required on file inputs if method is manual
            if (input.type === 'file') {
                let docMethod = document.querySelector('input[name="doc_method"]:checked').value;
                if (docMethod === 'manual') return;
            }

            if (!input.value.trim()) {
                isValid = false;
                input.classList.add('border-red-500');
                
                let errorSpan = document.createElement('span');
                errorSpan.className = 'error-msg text-red-500 text-xs mt-1 block';
                errorSpan.innerText = 'Field ini wajib diisi';
                input.parentElement.appendChild(errorSpan);
            }
        });
        
        return isValid;
    }

    btnNext.addEventListener('click', () => {
        if(validateStep()) {
            if(currentStep < totalSteps) {
                currentStep++;
                updateUI();
                window.scrollTo({ top: 0, behavior: 'smooth' });
            }
        }
    });

    btnPrev.addEventListener('click', () => {
        if(currentStep > 1) {
            currentStep--;
            updateUI();
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }
    });

    // Toggle document method
    function toggleDocMethod() {
        let method = document.querySelector('input[name="doc_method"]:checked').value;
        let uploadGrid = document.getElementById('doc-upload-grid');
        let manualInfo = document.getElementById('doc-manual-info');
        let fileInputs = uploadGrid.querySelectorAll('input[type="file"]');
        
        if (method === 'digital') {
            uploadGrid.classList.remove('hidden');
            manualInfo.classList.add('hidden');
            fileInputs.forEach(input => input.setAttribute('required', 'required'));
        } else {
            uploadGrid.classList.add('hidden');
            manualInfo.classList.remove('hidden');
            fileInputs.forEach(input => input.removeAttribute('required'));
        }
    }

    // Initialize UI
    updateUI();
    toggleDocMethod();

    // Region Data Fetching using API
    document.addEventListener('DOMContentLoaded', function() {
        // Fetch Provinces
        fetch('https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json')
            .then(response => response.json())
            .then(provinces => {
                let options = '<option value="" disabled selected>Pilih Provinsi</option>';
                provinces.forEach(prov => {
                    options += `<option value="${prov.id}">${prov.name}</option>`;
                });
                document.getElementById('provinsi').innerHTML = options;
                
                // Set old value if exists
                let oldProv = document.getElementById('provinsi').getAttribute('data-old');
                if(oldProv) {
                    document.getElementById('provinsi').value = oldProv;
                    fetchCities(oldProv);
                }
            });

        // Event Listeners for cascading dropdowns
        document.getElementById('provinsi').addEventListener('change', function() {
            document.getElementById('province_name').value = this.options[this.selectedIndex].text;
            fetchCities(this.value);
            
            // Reset children
            document.getElementById('kota').innerHTML = '<option value="" disabled selected>Pilih Kota / Kabupaten</option>';
            document.getElementById('kota').disabled = true;
            document.getElementById('kecamatan').innerHTML = '<option value="" disabled selected>Pilih Kecamatan</option>';
            document.getElementById('kecamatan').disabled = true;
        });

        document.getElementById('kota').addEventListener('change', function() {
            document.getElementById('city_name').value = this.options[this.selectedIndex].text;
            fetchDistricts(this.value);
        });

        document.getElementById('kecamatan').addEventListener('change', function() {
            document.getElementById('district_name').value = this.options[this.selectedIndex].text;
        });
    });

    function fetchCities(provinceId) {
        let citySelect = document.getElementById('kota');
        citySelect.innerHTML = '<option value="" disabled selected>Memuat...</option>';
        citySelect.disabled = true;
        
        fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/regencies/${provinceId}.json`)
            .then(response => response.json())
            .then(cities => {
                let options = '<option value="" disabled selected>Pilih Kota / Kabupaten</option>';
                cities.forEach(city => {
                    options += `<option value="${city.id}">${city.name}</option>`;
                });
                citySelect.innerHTML = options;
                citySelect.disabled = false;

                // Set old value if exists
                let oldCity = citySelect.getAttribute('data-old');
                if(oldCity && [...citySelect.options].some(o => o.value === oldCity)) {
                    citySelect.value = oldCity;
                    fetchDistricts(oldCity);
                }
            });
    }

    function fetchDistricts(cityId) {
        let districtSelect = document.getElementById('kecamatan');
        districtSelect.innerHTML = '<option value="" disabled selected>Memuat...</option>';
        districtSelect.disabled = true;

        fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/districts/${cityId}.json`)
            .then(response => response.json())
            .then(districts => {
                let options = '<option value="" disabled selected>Pilih Kecamatan</option>';
                districts.forEach(district => {
                    options += `<option value="${district.id}">${district.name}</option>`;
                });
                districtSelect.innerHTML = options;
                districtSelect.disabled = false;

                // Set old value if exists
                let oldDistrict = districtSelect.getAttribute('data-old');
                if(oldDistrict && [...districtSelect.options].some(o => o.value === oldDistrict)) {
                    districtSelect.value = oldDistrict;
                }
            });
    }
</script>
</body>
</html>
