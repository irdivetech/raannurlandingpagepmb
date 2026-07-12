<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cek Status Pendaftaran | RA An-Nuur</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Fredoka:wght@400;500;600&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
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

<body class="font-sans antialiased text-gray-800 bg-gray-50 selection:bg-primary selection:text-white">

    <!-- Simple Navbar -->
    <nav class="bg-white shadow-sm border-b border-gray-100 py-3">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center">
            <a href="{{ route('pmb.landing') }}" class="flex items-center gap-3">
                <img src="{{ asset('assets/img/logo/logosekolah.jpeg') }}" alt="Logo RA An-Nuur" class="h-10 w-10 rounded-full border border-gray-200">
                <h1 class="font-display font-bold text-lg text-primaryDark hidden sm:block">RA AN-NUUR</h1>
            </a>
            <a href="{{ route('pmb.landing') }}" class="text-sm font-medium text-gray-500 hover:text-primary transition-colors flex items-center gap-2">
                <span class="material-symbols-outlined text-[18px]">arrow_back</span> Kembali ke Beranda
            </a>
        </div>
    </nav>

    <main class="min-h-[85vh] flex flex-col items-center justify-center p-4 relative overflow-hidden">
        <!-- Background Decor -->
        <div class="absolute top-0 left-0 w-full h-full hero-pattern z-0 pointer-events-none"></div>
        <div class="absolute top-20 -left-20 w-72 h-72 bg-primary rounded-full mix-blend-multiply filter blur-3xl opacity-10 pointer-events-none"></div>
        <div class="absolute bottom-20 -right-20 w-72 h-72 bg-secondary rounded-full mix-blend-multiply filter blur-3xl opacity-10 pointer-events-none"></div>
        
        <div class="w-full max-w-xl relative z-10">
            <div class="text-center mb-10">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-emerald-100 text-primary mb-4 shadow-inner">
                    <span class="material-symbols-outlined text-3xl">search</span>
                </div>
                <h2 class="font-display text-3xl md:text-4xl font-bold text-gray-900 mb-2">Cek Status Pendaftaran</h2>
                <p class="text-gray-500">Masukkan Nomor Pendaftaran (No. Registrasi) Anda untuk melihat status kelulusan dan tahapan seleksi.</p>
            </div>

            <!-- Form -->
            <div class="bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden mb-8">
                <form action="{{ route('public.check-status') }}" method="GET" class="p-6 sm:p-8">
                    <div class="mb-6">
                        <label for="reg_number" class="block text-sm font-bold text-gray-700 mb-2">Nomor Pendaftaran</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400">
                                <span class="material-symbols-outlined text-[20px]">tag</span>
                            </span>
                            <input type="text" id="reg_number" name="reg_number" value="{{ request('reg_number') }}" required
                                class="w-full pl-12 pr-4 py-4 rounded-xl border border-gray-200 bg-gray-50 text-gray-900 font-bold tracking-wider focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all uppercase placeholder:font-normal placeholder:tracking-normal"
                                placeholder="Contoh: RA24001">
                        </div>
                    </div>
                    <button type="submit" class="w-full bg-primary text-white py-4 rounded-xl font-bold hover:bg-primaryDark transition-all shadow-lg hover:shadow-primary/30 active:scale-[0.98] flex items-center justify-center gap-2">
                        <span>Cari Data Siswa</span> <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                    </button>
                </form>
                
                @if(request()->has('reg_number') && !$registration)
                <div class="bg-rose-50 border-t border-rose-100 p-6 flex items-start gap-4">
                    <div class="w-10 h-10 rounded-full bg-rose-100 text-rose-500 flex items-center justify-center flex-shrink-0">
                        <span class="material-symbols-outlined text-[20px]">error</span>
                    </div>
                    <div>
                        <h4 class="text-rose-800 font-bold mb-1">Data Tidak Ditemukan</h4>
                        <p class="text-rose-600 text-sm leading-relaxed">{{ $error ?? 'Pastikan Nomor Pendaftaran yang Anda masukkan benar.' }}</p>
                    </div>
                </div>
                @endif
            </div>

            <!-- Hasil Pencarian -->
            @if($registration)
            <div class="bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden mb-8 animate-[fadeInUp_0.5s_ease-out]">
                <div class="bg-emerald-50 border-b border-emerald-100 p-6 flex justify-between items-center">
                    <div>
                        <p class="text-emerald-600 text-xs font-bold uppercase tracking-wider mb-1">Hasil Pencarian</p>
                        <h3 class="font-display text-xl font-bold text-gray-900">{{ $registration->student->full_name }}</h3>
                    </div>
                    <span class="px-3 py-1 bg-white text-emerald-600 rounded-lg text-sm font-bold border border-emerald-200 shadow-sm">{{ $registration->reg_number }}</span>
                </div>
                <div class="p-6 sm:p-8 space-y-6">
                    <div class="flex flex-col sm:flex-row justify-between gap-6">
                        
                        <!-- Status Badge -->
                        <div class="flex-1 text-center sm:text-left">
                            <p class="text-gray-500 text-sm font-medium mb-2">Status Saat Ini:</p>
                            @if($registration->status == 'pending')
                                <div class="inline-flex items-center gap-2 px-4 py-2 bg-gray-100 text-gray-600 rounded-xl font-bold">
                                    <span class="w-2 h-2 rounded-full bg-gray-400"></span> Pengisian Formulir
                                </div>
                                <p class="text-sm text-gray-500 mt-3">Silakan selesaikan pengisian formulir di portal pendaftaran.</p>
                            @elseif($registration->status == 'verifying')
                                <div class="inline-flex items-center gap-2 px-4 py-2 bg-amber-50 border border-amber-200 text-amber-600 rounded-xl font-bold">
                                    <span class="material-symbols-outlined text-[18px]">hourglass_empty</span> Sedang Diverifikasi
                                </div>
                                <p class="text-sm text-gray-500 mt-3">Data Anda sedang ditinjau oleh panitia PMB. Mohon menunggu maksimal 3 hari kerja.</p>
                            @elseif($registration->status == 'accepted')
                                <div class="inline-flex items-center gap-2 px-4 py-2 bg-emerald-50 border border-emerald-200 text-emerald-600 rounded-xl font-bold">
                                    <span class="material-symbols-outlined text-[18px]">verified</span> Selamat, Anda Diterima!
                                </div>
                                <p class="text-sm text-emerald-600/80 mt-3">Silakan login ke portal untuk melihat langkah selanjutnya terkait daftar ulang.</p>
                            @elseif($registration->status == 'rejected')
                                <div class="inline-flex items-center gap-2 px-4 py-2 bg-rose-50 border border-rose-200 text-rose-600 rounded-xl font-bold">
                                    <span class="material-symbols-outlined text-[18px]">cancel</span> Ditolak / Revisi
                                </div>
                                <p class="text-sm text-rose-500 mt-3">Silakan cek portal pendaftaran untuk melihat catatan dari admin terkait penolakan atau revisi data.</p>
                            @endif
                        </div>
                        
                    </div>
                </div>
                <div class="bg-gray-50 p-4 border-t border-gray-100 flex justify-center">
                    <a href="{{ route('parent.login') }}" class="text-primary font-bold text-sm hover:underline flex items-center gap-1">
                        Masuk ke Portal untuk Detail <span class="material-symbols-outlined text-[16px]">open_in_new</span>
                    </a>
                </div>
            </div>
            @endif

        </div>
    </main>
    
    <style>
        @keyframes fadeInUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
    </style>
</body>
</html>
