@extends('layouts.parent')

@section('content')
<main class="md:ml-[280px] min-h-screen px-4 md:px-8 py-8 bg-gray-50">
    
    <!-- Header & Breadcrumbs -->
    <section class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-8">
        <div>
            <nav class="flex items-center text-gray-400 gap-1 mb-2">
                <span class="text-xs">Portal</span>
                <span class="material-symbols-outlined text-sm">chevron_right</span>
                <span class="text-xs font-semibold text-emerald-500">Dashboard Utama</span>
            </nav>
            <h2 class="font-display text-3xl md:text-4xl font-bold text-gray-900">Selamat Datang, {{ $user->name }}</h2>
            <p class="text-gray-500 mt-1">Berikut adalah ringkasan status pendaftaran Ananda.</p>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('parent.dashboard.pdf') }}" class="px-5 py-2.5 bg-white border border-gray-200 text-emerald-600 font-bold text-sm rounded-xl hover:bg-gray-50 transition-all flex items-center gap-2 shadow-sm">
                <span class="material-symbols-outlined text-lg">download</span> Unduh PDF
            </a>
            <a href="{{ route('parent.helpdesk.index') }}" class="px-5 py-2.5 bg-emerald-500 text-white font-bold text-sm rounded-xl hover:bg-emerald-600 transition-all flex items-center gap-2 shadow-md shadow-emerald-500/20">
                <span class="material-symbols-outlined text-lg">help_outline</span> Bantuan
            </a>
        </div>
    </section>

    <!-- Top Widgets Grid -->
    <section class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-8">
        <!-- Registration Number -->
        <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm flex items-center gap-4 hover:shadow-md hover:border-emerald-200 transition-all group">
            <div class="w-14 h-14 bg-emerald-50 rounded-2xl flex items-center justify-center text-emerald-500 group-hover:bg-emerald-100 transition-colors">
                <span class="material-symbols-outlined text-3xl">tag</span>
            </div>
            <div>
                <p class="text-xs font-medium text-gray-400 uppercase tracking-wider">No. Pendaftaran</p>
                <p class="text-xl font-bold text-gray-900 mt-0.5">{{ $registration->reg_number }}</p>
            </div>
        </div>

        <!-- Status Badge Widget -->
        <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm flex items-center gap-4 hover:shadow-md hover:border-amber-200 transition-all group">
            <div class="w-14 h-14 bg-amber-50 rounded-2xl flex items-center justify-center text-amber-500 group-hover:bg-amber-100 transition-colors">
                <span class="material-symbols-outlined text-3xl">hourglass_empty</span>
            </div>
            <div>
                <p class="text-xs font-medium text-gray-400 uppercase tracking-wider">Status Saat Ini</p>
                <div class="flex items-center gap-2 mt-1">
                    @if($registration->status == 'pending')
                        <span class="px-3 py-1 bg-gray-100 text-gray-600 text-[11px] font-bold rounded-full uppercase">Draft</span>
                    @elseif($registration->status == 'verifying')
                        <span class="px-3 py-1 bg-amber-100 text-amber-700 text-[11px] font-bold rounded-full uppercase">Sedang Diverifikasi</span>
                    @elseif($registration->status == 'accepted')
                        <span class="px-3 py-1 bg-emerald-100 text-emerald-700 text-[11px] font-bold rounded-full uppercase">Diterima</span>
                    @elseif($registration->status == 'rejected')
                        <span class="px-3 py-1 bg-rose-100 text-rose-700 text-[11px] font-bold rounded-full uppercase">Ditolak</span>
                    @endif
                </div>
            </div>
        </div>

        @php
            $progress = 20;
            $step_text = 'Pengisian Formulir';
            if($registration->status == 'verifying') { $progress = 50; $step_text = 'Verifikasi Dokumen'; }
            elseif($registration->status == 'accepted') { $progress = 100; $step_text = 'Diterima'; }
        @endphp
        <!-- Verification Progress Bar -->
        <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition-all">
            <div class="flex justify-between items-center mb-2">
                <p class="text-xs font-medium text-gray-400 uppercase tracking-wider">Progress</p>
                <p class="font-bold text-emerald-500 text-lg">{{ $progress }}%</p>
            </div>
            <div class="w-full bg-gray-100 rounded-full h-2.5 mb-3 overflow-hidden">
                <div class="bg-gradient-to-r from-emerald-400 to-emerald-500 h-2.5 rounded-full transition-all duration-1000" style="width: {{ $progress }}%"></div>
            </div>
            <p class="text-xs text-gray-400">Langkah: <span class="font-semibold text-emerald-600">{{ $step_text }}</span></p>
        </div>
    </section>

    <!-- Main Dashboard Layout: Bento Grid -->
    <section class="grid grid-cols-1 lg:grid-cols-12 gap-5">
        
        <!-- Left Column: Summary Cards (8 Cols) -->
        <div class="lg:col-span-8 space-y-5">
            <!-- Information Group -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <!-- Student Summary Card -->
                <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm relative overflow-hidden">
                    <div class="absolute top-0 left-0 w-1 h-full bg-amber-400 rounded-r-full"></div>
                    <div class="flex justify-between items-start mb-5">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-amber-50 rounded-xl flex items-center justify-center text-amber-500">
                                <span class="material-symbols-outlined">face</span>
                            </div>
                            <h3 class="font-bold text-gray-900 text-lg">Data Calon Siswa</h3>
                        </div>
                        <a href="{{ route('parent.student.edit') }}" class="w-8 h-8 rounded-lg bg-gray-50 flex items-center justify-center text-gray-400 hover:bg-emerald-50 hover:text-emerald-500 transition-all">
                            <span class="material-symbols-outlined text-lg">edit</span>
                        </a>
                    </div>
                    <div class="space-y-3">
                        <div class="flex justify-between border-b border-gray-50 pb-2.5">
                            <span class="text-gray-400 text-sm">Nama Lengkap</span>
                            <span class="font-semibold text-gray-800 text-sm">{{ $registration->student->full_name ?? '-' }}</span>
                        </div>
                        <div class="flex justify-between border-b border-gray-50 pb-2.5">
                            <span class="text-gray-400 text-sm">Jenis Kelamin</span>
                            <span class="font-semibold text-gray-800 text-sm">{{ ($registration->student->gender ?? '') == 'L' ? 'Laki-laki' : 'Perempuan' }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-400 text-sm">Tempat, Tgl Lahir</span>
                            <span class="font-semibold text-gray-800 text-sm text-right">{{ $registration->student->birth_place ?? '-' }}, {{ $registration->student->birth_date ? \Carbon\Carbon::parse($registration->student->birth_date)->translatedFormat('d F Y') : '-' }}</span>
                        </div>
                    </div>
                </div>

                <!-- Parent Summary Card -->
                <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm relative overflow-hidden">
                    <div class="absolute top-0 left-0 w-1 h-full bg-emerald-400 rounded-r-full"></div>
                    <div class="flex justify-between items-start mb-5">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-emerald-50 rounded-xl flex items-center justify-center text-emerald-500">
                                <span class="material-symbols-outlined">person</span>
                            </div>
                            <h3 class="font-bold text-gray-900 text-lg">Data Wali</h3>
                        </div>
                        <a href="{{ route('parent.profile') }}" class="w-8 h-8 rounded-lg bg-gray-50 flex items-center justify-center text-gray-400 hover:bg-emerald-50 hover:text-emerald-500 transition-all">
                            <span class="material-symbols-outlined text-lg">edit</span>
                        </a>
                    </div>
                    <div class="space-y-3">
                        <div class="flex justify-between border-b border-gray-50 pb-2.5">
                            <span class="text-gray-400 text-sm">Nama Ayah</span>
                            <span class="font-semibold text-gray-800 text-sm">{{ $registration->parent->father_name ?? '-' }}</span>
                        </div>
                        <div class="flex justify-between border-b border-gray-50 pb-2.5">
                            <span class="text-gray-400 text-sm">Nama Ibu</span>
                            <span class="font-semibold text-gray-800 text-sm">{{ $registration->parent->mother_name ?? '-' }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-400 text-sm">Kontak</span>
                            <span class="font-semibold text-gray-800 text-sm">{{ $registration->parent->father_phone ?? $registration->parent->mother_phone ?? '-' }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Address Summary Card -->
            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
                <div class="flex justify-between items-center mb-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-blue-50 rounded-xl flex items-center justify-center text-blue-500">
                            <span class="material-symbols-outlined">location_on</span>
                        </div>
                        <h3 class="font-bold text-gray-900 text-lg">Alamat Domisili</h3>
                    </div>
                </div>
                <p class="text-gray-600 leading-relaxed">{{ $registration->address->address_line ?? '-' }}, {{ $registration->address->district ?? '' }}, {{ $registration->address->city ?? '' }}, {{ $registration->address->province ?? '' }} {{ $registration->address->postal_code ?? '' }}</p>
            </div>

            <!-- Document Checklist Preview -->
            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
                <div class="flex justify-between items-center mb-5">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-violet-50 rounded-xl flex items-center justify-center text-violet-500">
                            <span class="material-symbols-outlined">folder_open</span>
                        </div>
                        <h3 class="font-bold text-gray-900 text-lg">Ringkasan Dokumen</h3>
                    </div>
                    <a href="{{ route('parent.documents') }}" class="text-emerald-500 font-bold text-sm hover:text-emerald-600 transition-colors flex items-center gap-1">
                        Kelola <span class="material-symbols-outlined text-lg">arrow_forward</span>
                    </a>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                    @php
                        $docs = $registration->documents->keyBy('type');
                        $docTypes = ['akta' => 'Akte Kelahiran', 'kk' => 'Kartu Keluarga (KK)', 'ktp_ortu' => 'KTP Orang Tua', 'foto' => 'Pas Foto (3x4)', 'pkh_kks' => 'Kartu PKH/KKS'];
                    @endphp
                    @foreach($docTypes as $type => $label)
                        @if(isset($docs[$type]))
                            <div class="flex items-center gap-3 p-3.5 bg-emerald-50/50 rounded-xl border border-emerald-100/50">
                                <span class="material-symbols-outlined text-emerald-500" style="font-variation-settings: 'FILL' 1;">check_circle</span>
                                <span class="font-medium text-sm text-gray-700">{{ $label }}</span>
                            </div>
                        @else
                            <div class="flex items-center gap-3 p-3.5 bg-rose-50/50 rounded-xl border border-rose-100/50">
                                <span class="material-symbols-outlined text-rose-400">pending</span>
                                <span class="font-medium text-sm text-rose-500">{{ $label }}</span>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Right Column: Notifications & Timeline (4 Cols) -->
        <div class="lg:col-span-4 space-y-5">
            
            <!-- Admin Notifications Panel -->
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm flex flex-col h-[350px]">
                <div class="p-5 border-b border-gray-100 flex justify-between items-center">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 bg-emerald-50 rounded-lg flex items-center justify-center text-emerald-500">
                            <span class="material-symbols-outlined text-lg">notifications</span>
                        </div>
                        <h3 class="font-bold text-gray-900">Pesan & Update</h3>
                    </div>
                    <span class="bg-emerald-500 text-white text-[10px] font-bold px-2.5 py-0.5 rounded-full">Baru</span>
                </div>
                <div class="p-4 space-y-3 overflow-y-auto flex-1">
                    <!-- Notification Item -->
                    <div class="p-3.5 bg-emerald-50/50 rounded-xl border-l-4 border-l-emerald-400">
                        <div class="flex justify-between items-start mb-1">
                            <span class="font-bold text-gray-800 text-sm">Verifikasi Awal Selesai</span>
                            <span class="text-[10px] text-gray-400 font-medium">10:45</span>
                        </div>
                        <p class="text-xs text-gray-500 leading-relaxed">Data dasar ananda telah disetujui. Silakan lengkapi sisa dokumen Anda.</p>
                    </div>
                    <!-- Notification Item -->
                    <div class="p-3.5 bg-gray-50/80 rounded-xl border-l-4 border-l-gray-200 opacity-70">
                        <div class="flex justify-between items-start mb-1">
                            <span class="font-bold text-gray-800 text-sm">Pendaftaran Diterima</span>
                            <span class="text-[10px] text-gray-400 font-medium">Kemarin</span>
                        </div>
                        <p class="text-xs text-gray-500 leading-relaxed">Terima kasih telah mendaftarkan ananda. Nomor registrasi Anda aktif.</p>
                    </div>
                </div>
                <div class="p-3 border-t border-gray-100">
                    <button class="text-emerald-500 font-bold text-sm w-full text-center hover:text-emerald-600 transition-all py-1">Lihat Semua Pesan</button>
                </div>
            </div>

            <!-- Quick Action / Payment info -->
            <div class="bg-gradient-to-br from-amber-50 to-amber-100/50 border border-amber-200/50 rounded-2xl p-5 shadow-sm">
                <div class="flex items-start gap-3">
                    <div class="w-10 h-10 bg-amber-200/50 rounded-xl flex items-center justify-center text-amber-600 flex-shrink-0">
                        <span class="material-symbols-outlined">account_balance_wallet</span>
                    </div>
                    <div>
                        <h4 class="font-bold text-amber-900">Informasi Pembayaran</h4>
                        <p class="text-sm text-amber-800/70 mt-1 mb-3 leading-relaxed">Tagihan pendaftaran akan aktif setelah semua dokumen diverifikasi oleh tim kami.</p>
                        <a href="{{ route('parent.status') }}" class="text-sm font-bold text-amber-700 hover:text-amber-900 transition-colors inline-flex items-center gap-1">
                            Lihat Detail Status <span class="material-symbols-outlined text-lg">arrow_forward</span>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </section>

</main>
@endsection
