@extends('layouts.app')

@section('content')
<main>
    <!-- Hero Section -->
    <section class="relative pt-stack-lg pb-stack-lg md:pt-margin-desktop md:pb-margin-desktop overflow-hidden">
        <div class="absolute inset-0 z-0">
            <div class="absolute top-[-10%] right-[-5%] w-[40%] h-[60%] bg-secondary-container rounded-full blur-[120px] opacity-40"></div>
            <div class="absolute bottom-[-10%] left-[-5%] w-[50%] h-[50%] bg-primary-fixed rounded-full blur-[100px] opacity-30"></div>
        </div>
        
        <div class="max-w-container-max mx-auto px-gutter relative z-10 flex flex-col md:flex-row items-center gap-margin-desktop">
            <div class="flex-1 text-center md:text-left">
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-primary-container text-on-primary-container font-label-sm mb-6 border border-primary/20">
                    <span class="w-2 h-2 rounded-full bg-primary animate-pulse"></span>
                    Pendaftaran Tahun Ajaran 2024/2025 Telah Dibuka
                </div>
                
                <h1 class="font-headline-lg text-headline-lg-mobile md:text-display-lg text-on-surface mb-6">
                    Langkah Awal Menuju <br/>
                    <span class="text-primary relative inline-block">
                        Generasi Qur'ani
                        <svg class="absolute w-full h-3 -bottom-1 left-0 text-secondary" fill="none" viewBox="0 0 100 10" preserveAspectRatio="none">
                            <path d="M0 5 Q 50 10 100 5" stroke="currentColor" stroke-width="4" stroke-linecap="round"/>
                        </svg>
                    </span>
                </h1>
                
                <p class="font-body-lg text-body-md md:text-body-lg text-on-surface-variant mb-10 max-w-xl mx-auto md:mx-0">
                    Sistem Penerimaan Murid Baru RA AN-NUUR mempermudah proses pendaftaran putra-putri Anda. Lingkungan belajar islami yang menyenangkan menanti.
                </p>
                
                <div class="flex flex-col sm:flex-row flex-wrap gap-4 justify-center md:justify-start">
                    <a href="{{ route('pmb.register') }}" class="bg-primary text-on-primary px-6 py-3 rounded-xl font-label-md text-base hover:bg-primary-container transition-all active:scale-95 shadow-[0_8px_20px_-6px_rgba(0,107,44,0.4)] flex items-center justify-center gap-2 group">
                        Mulai Pendaftaran
                        <span class="material-symbols-outlined text-lg group-hover:translate-x-1 transition-transform">arrow_forward</span>
                    </a>
                    <a href="{{ route('pmb.tracking') }}" class="bg-surface text-primary border-2 border-primary/20 px-6 py-3 rounded-xl font-label-md text-base hover:bg-surface-container-low hover:border-primary/40 transition-all flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined text-lg">search</span> Cek Status
                    </a>
                    <a href="{{ route('pmb.formulir.download') }}" class="bg-secondary-container text-on-secondary-container border-2 border-transparent px-6 py-3 rounded-xl font-label-md text-base hover:bg-secondary-container-hover transition-all flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined text-lg">download</span> Unduh Formulir Kosong
                    </a>
                </div>
                
                <div class="mt-8 flex items-center justify-center md:justify-start gap-4">
                    <div class="flex -space-x-3">
                        <div class="w-10 h-10 rounded-full border-2 border-surface bg-surface-container-high overflow-hidden"><img src="https://lh3.googleusercontent.com/aida-public/AOn4--O1qYmXzS_B-8_j9Dk-k1_Vv4_k7-tX2_l8_qYmXzS_B-8_j9Dk-k1_Vv4_k7-tX2_l8=" class="w-full h-full object-cover" alt="Parent"></div>
                        <div class="w-10 h-10 rounded-full border-2 border-surface bg-surface-container-high overflow-hidden"><img src="https://lh3.googleusercontent.com/aida-public/AOn4--O1qYmXzS_B-8_j9Dk-k1_Vv4_k7-tX2_l8_qYmXzS_B-8_j9Dk-k1_Vv4_k7-tX2_l8=" class="w-full h-full object-cover" alt="Parent"></div>
                        <div class="w-10 h-10 rounded-full border-2 border-surface bg-primary text-white flex items-center justify-center font-bold text-xs">+5k</div>
                    </div>
                    <p class="font-body-sm text-on-surface-variant text-sm">Orang tua telah mempercayakan pendidikan anaknya</p>
                </div>
            </div>
            
            <div class="flex-1 relative hidden md:block">
                <div class="absolute inset-0 bg-secondary-container/20 rounded-3xl rotate-3 scale-105 transition-transform duration-700 hover:rotate-6"></div>
                <div class="relative bg-surface rounded-3xl overflow-hidden border border-outline-variant silk-shadow z-10 animate-float">
                    <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuBCqR8t-U1Vv49q-8qYmXzS_B-8_j9Dk-k1_Vv4_k7-tX2_l8_qYmXzS_B-8_j9Dk-k1_Vv4_k7-tX2_l8=" alt="Anak TK Belajar" class="w-full h-auto object-cover"/>
                    
                    <div class="absolute bottom-6 left-6 right-6 bg-glass-effect p-4 rounded-xl border border-white/40 flex items-center gap-4 backdrop-blur-md">
                        <div class="w-12 h-12 rounded-full bg-primary flex items-center justify-center text-white">
                            <span class="material-symbols-outlined">verified_user</span>
                        </div>
                        <div>
                            <p class="font-label-md font-bold text-on-surface">Terakreditasi A</p>
                            <p class="font-body-sm text-on-surface-variant text-xs">Kementerian Agama RI</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Info Banner -->
    <section class="bg-primary text-on-primary py-stack-md border-y border-primary-fixed-dim/30">
        <div class="max-w-container-max mx-auto px-gutter flex flex-col md:flex-row justify-between items-center gap-4 text-center md:text-left">
            <div class="flex items-center gap-3">
                <span class="material-symbols-outlined text-3xl text-secondary-container">calendar_month</span>
                <div>
                    <p class="font-label-md font-bold text-lg">Gelombang 1: 1 Jan - 28 Feb 2024</p>
                    <p class="font-body-sm opacity-90 text-sm">Dapatkan potongan biaya formulir 50%</p>
                </div>
            </div>
            <a href="#biaya" class="font-label-md underline hover:text-secondary-container transition-colors">Lihat Detail Biaya</a>
        </div>
    </section>

    <!-- Steps Section -->
    <section class="py-margin-desktop bg-surface-container-lowest relative">
        <div class="max-w-container-max mx-auto px-gutter">
            <div class="text-center mb-stack-lg">
                <h2 class="font-headline-md text-headline-md font-bold text-on-surface mb-2">Alur Pendaftaran Mudah</h2>
                <p class="font-body-md text-on-surface-variant max-w-2xl mx-auto">Proses pendaftaran dirancang 100% online untuk kenyamanan Anda. Ikuti 4 langkah sederhana berikut.</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-4 gap-gutter relative">
                <!-- Desktop connecting line -->
                <div class="hidden md:block absolute top-12 left-24 right-24 h-0.5 bg-outline-variant/50"></div>
                
                <!-- Step 1 -->
                <div class="relative flex flex-col items-center text-center bento-card-hover p-4 rounded-xl bg-surface">
                    <div class="w-24 h-24 rounded-full bg-surface-container border-4 border-surface flex items-center justify-center mb-6 relative z-10 shadow-sm">
                        <span class="material-symbols-outlined text-4xl text-primary" style="font-variation-settings: 'FILL' 1;">app_registration</span>
                        <div class="absolute -top-2 -right-2 w-8 h-8 rounded-full bg-secondary text-on-secondary flex items-center justify-center font-bold border-2 border-surface">1</div>
                    </div>
                    <h3 class="font-label-md text-lg font-bold text-on-surface mb-2">Isi Formulir</h3>
                    <p class="font-body-sm text-on-surface-variant">Lengkapi data diri calon siswa dan orang tua secara online.</p>
                </div>
                
                <!-- Step 2 -->
                <div class="relative flex flex-col items-center text-center bento-card-hover p-4 rounded-xl bg-surface">
                    <div class="w-24 h-24 rounded-full bg-surface-container border-4 border-surface flex items-center justify-center mb-6 relative z-10 shadow-sm">
                        <span class="material-symbols-outlined text-4xl text-primary" style="font-variation-settings: 'FILL' 1;">upload_file</span>
                        <div class="absolute -top-2 -right-2 w-8 h-8 rounded-full bg-secondary text-on-secondary flex items-center justify-center font-bold border-2 border-surface">2</div>
                    </div>
                    <h3 class="font-label-md text-lg font-bold text-on-surface mb-2">Unggah Dokumen</h3>
                    <p class="font-body-sm text-on-surface-variant">Upload KK, Akta Kelahiran, dan dokumen pendukung lainnya.</p>
                </div>
                
                <!-- Step 3 -->
                <div class="relative flex flex-col items-center text-center bento-card-hover p-4 rounded-xl bg-surface">
                    <div class="w-24 h-24 rounded-full bg-surface-container border-4 border-surface flex items-center justify-center mb-6 relative z-10 shadow-sm">
                        <span class="material-symbols-outlined text-4xl text-primary" style="font-variation-settings: 'FILL' 1;">payments</span>
                        <div class="absolute -top-2 -right-2 w-8 h-8 rounded-full bg-secondary text-on-secondary flex items-center justify-center font-bold border-2 border-surface">3</div>
                    </div>
                    <h3 class="font-label-md text-lg font-bold text-on-surface mb-2">Pembayaran</h3>
                    <p class="font-body-sm text-on-surface-variant">Lakukan pembayaran biaya pendaftaran via transfer bank.</p>
                </div>
                
                <!-- Step 4 -->
                <div class="relative flex flex-col items-center text-center bento-card-hover p-4 rounded-xl bg-surface">
                    <div class="w-24 h-24 rounded-full bg-surface-container border-4 border-surface flex items-center justify-center mb-6 relative z-10 shadow-sm">
                        <span class="material-symbols-outlined text-4xl text-primary" style="font-variation-settings: 'FILL' 1;">task_alt</span>
                        <div class="absolute -top-2 -right-2 w-8 h-8 rounded-full bg-secondary text-on-secondary flex items-center justify-center font-bold border-2 border-surface">4</div>
                    </div>
                    <h3 class="font-label-md text-lg font-bold text-on-surface mb-2">Verifikasi & Diterima</h3>
                    <p class="font-body-sm text-on-surface-variant">Tunggu verifikasi admin dan dapatkan status penerimaan.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Requirements Bento Grid -->
    <section class="py-margin-desktop bg-surface">
        <div class="max-w-container-max mx-auto px-gutter">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-gutter">
                <!-- Syarat Utama -->
                <div class="lg:col-span-5 bg-primary-container text-on-primary-container rounded-3xl p-xl flex flex-col justify-center overflow-hidden relative shadow-lg">
                    <div class="absolute top-0 right-0 w-64 h-64 bg-white/5 rounded-full blur-[40px] -translate-y-1/2 translate-x-1/4"></div>
                    <h2 class="font-headline-md text-headline-md font-bold mb-4 relative z-10">Persyaratan Usia</h2>
                    <p class="font-body-md mb-8 opacity-90 relative z-10">Sesuai dengan ketentuan dinas pendidikan, berikut adalah batasan usia untuk pendaftaran tahun ini (Per Juli 2024):</p>
                    
                    <div class="space-y-4 relative z-10">
                        <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4 border border-white/20 flex items-center justify-between">
                            <span class="font-label-md font-bold text-lg">Kelompok A</span>
                            <span class="bg-secondary-container text-on-secondary-container px-3 py-1 rounded-full text-sm font-bold">4 - 5 Tahun</span>
                        </div>
                        <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4 border border-white/20 flex items-center justify-between">
                            <span class="font-label-md font-bold text-lg">Kelompok B</span>
                            <span class="bg-secondary-container text-on-secondary-container px-3 py-1 rounded-full text-sm font-bold">5 - 6 Tahun</span>
                        </div>
                    </div>
                </div>
                
                <!-- Dokumen Checklist -->
                <div class="lg:col-span-7 bg-surface-container-lowest rounded-3xl p-xl border border-outline-variant silk-shadow">
                    <h2 class="font-headline-md text-headline-md font-bold text-on-surface mb-2">Dokumen Pendaftaran</h2>
                    <p class="font-body-md text-on-surface-variant mb-6">Siapkan dokumen-dokumen berikut dalam format JPG/PDF untuk diunggah pada tahap kedua.</p>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="flex items-start gap-3 p-4 rounded-xl bg-surface hover:bg-surface-container-low transition-colors border border-transparent hover:border-outline-variant">
                            <div class="w-10 h-10 rounded-full bg-primary/10 flex items-center justify-center shrink-0">
                                <span class="material-symbols-outlined text-primary">description</span>
                            </div>
                            <div>
                                <h4 class="font-label-md font-bold text-on-surface">Akta Kelahiran</h4>
                                <p class="text-[12px] text-on-surface-variant mt-1">Scan asli / Fotokopi berwarna</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3 p-4 rounded-xl bg-surface hover:bg-surface-container-low transition-colors border border-transparent hover:border-outline-variant">
                            <div class="w-10 h-10 rounded-full bg-primary/10 flex items-center justify-center shrink-0">
                                <span class="material-symbols-outlined text-primary">family_history</span>
                            </div>
                            <div>
                                <h4 class="font-label-md font-bold text-on-surface">Kartu Keluarga</h4>
                                <p class="text-[12px] text-on-surface-variant mt-1">Scan asli terbaru</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3 p-4 rounded-xl bg-surface hover:bg-surface-container-low transition-colors border border-transparent hover:border-outline-variant">
                            <div class="w-10 h-10 rounded-full bg-primary/10 flex items-center justify-center shrink-0">
                                <span class="material-symbols-outlined text-primary">portrait</span>
                            </div>
                            <div>
                                <h4 class="font-label-md font-bold text-on-surface">Pas Foto 3x4</h4>
                                <p class="text-[12px] text-on-surface-variant mt-1">Latar belakang merah/biru</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3 p-4 rounded-xl bg-surface hover:bg-surface-container-low transition-colors border border-transparent hover:border-outline-variant">
                            <div class="w-10 h-10 rounded-full bg-primary/10 flex items-center justify-center shrink-0">
                                <span class="material-symbols-outlined text-primary">id_card</span>
                            </div>
                            <div>
                                <h4 class="font-label-md font-bold text-on-surface">KTP Orang Tua</h4>
                                <p class="text-[12px] text-on-surface-variant mt-1">Ayah dan Ibu</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Final CTA -->
    <section class="py-margin-desktop bg-surface-container-highest relative overflow-hidden">
        <div class="absolute -right-20 -top-20 w-96 h-96 bg-primary-container rounded-full blur-[100px] opacity-20"></div>
        <div class="max-w-3xl mx-auto px-gutter text-center relative z-10">
            <span class="material-symbols-outlined text-6xl text-primary mb-4" style="font-variation-settings: 'FILL' 1;">volunteer_activism</span>
            <h2 class="font-headline-lg text-headline-md md:text-headline-lg text-on-surface font-bold mb-4">Mulai Perjalanan Anak Anda Sekarang</h2>
            <p class="font-body-lg text-body-md text-on-surface-variant mb-8">Kuota pendaftaran terbatas. Segera daftarkan putra-putri Anda untuk mengamankan kursi di RA AN-NUUR.</p>
            <a href="{{ route('pmb.register') }}" class="inline-flex bg-primary text-on-primary px-10 py-4 rounded-xl font-label-md text-xl font-bold hover:bg-primary-container transition-all active:scale-95 shadow-lg">
                Daftar Sekarang
            </a>
            <div class="mt-4">
                <a href="{{ route('parent.login') }}" class="font-label-md text-primary hover:underline">Sudah mendaftar? Login ke Portal Orang Tua</a>
            </div>
        </div>
    </section>
</main>
@endsection
