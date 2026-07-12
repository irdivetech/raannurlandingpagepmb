@extends('layouts.parent')

@section('content')
<main class="flex-1 md:ml-[280px] min-h-screen bg-gray-50">
    <!-- Top Header -->
    <header class="w-full top-0 sticky bg-white/80 backdrop-blur-md border-b border-gray-100 shadow-sm z-40">
        <div class="flex justify-between items-center px-4 md:px-8 py-4 max-w-6xl mx-auto">
            <div class="flex items-center gap-4">
                <button class="md:hidden p-2">
                    <span class="material-symbols-outlined">menu</span>
                </button>
                <div class="flex flex-col">
                    <span class="text-xs font-medium text-emerald-500 uppercase tracking-wider">RA AN-NUUR</span>
                    <h2 class="font-display text-xl md:text-2xl font-bold text-gray-900 leading-tight">Detail Pendaftaran</h2>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <span class="hidden md:block px-3 py-1.5 rounded-full bg-emerald-50 text-emerald-600 text-xs font-bold border border-emerald-100">
                    ID: {{ $registration->reg_number }}
                </span>
                <a href="{{ route('parent.status.pdf') }}" class="bg-emerald-500 text-white px-5 py-2.5 rounded-xl font-bold text-sm hover:bg-emerald-600 transition-all shadow-md shadow-emerald-500/20 flex items-center gap-2">
                    <span class="material-symbols-outlined text-lg">download</span> Unduh Bukti
                </a>
            </div>
        </div>
    </header>

    <div class="px-4 md:px-8 py-8 max-w-6xl mx-auto space-y-8">
        <!-- Summary Bento Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
            <!-- Status Card -->
            <div class="bg-white border border-gray-100 p-6 rounded-2xl shadow-sm col-span-1 md:col-span-2 flex flex-col md:flex-row gap-6 items-start md:items-center">
                <div class="w-20 h-20 rounded-2xl bg-emerald-50 flex items-center justify-center flex-shrink-0">
                    <span class="material-symbols-outlined text-emerald-500 text-4xl" style="font-variation-settings: 'FILL' 1;">verified_user</span>
                </div>
                <div>
                    <div class="flex items-center gap-2 mb-1">
                        <span class="w-2.5 h-2.5 rounded-full bg-emerald-400 animate-pulse"></span>
                        <h3 class="font-display text-xl font-bold text-gray-900">
                            @if($registration->status == 'pending') Pengisian Formulir
                            @elseif($registration->status == 'verifying') Verifikasi Dokumen
                            @elseif($registration->status == 'accepted') Diterima
                            @elseif($registration->status == 'rejected') Ditolak
                            @endif
                        </h3>
                    </div>
                    <p class="text-gray-500 max-w-md text-sm leading-relaxed">Pendaftaran Ananda <strong class="text-gray-700">{{ $registration->student->full_name ?? '-' }}</strong> sedang dalam tahap peninjauan dokumen oleh tim administrasi.</p>
                    <div class="mt-4 flex flex-wrap gap-2">
                        @if($registration->status == 'pending')
                            <span class="px-3 py-1 bg-gray-100 text-gray-600 text-[11px] font-bold rounded-full uppercase">Draft</span>
                        @elseif($registration->status == 'verifying')
                            <span class="px-3 py-1 bg-amber-100 text-amber-700 text-[11px] font-bold rounded-full uppercase">Sedang Diverifikasi</span>
                        @elseif($registration->status == 'accepted')
                            <span class="px-3 py-1 bg-emerald-100 text-emerald-700 text-[11px] font-bold rounded-full uppercase">Diterima</span>
                        @elseif($registration->status == 'rejected')
                            <span class="px-3 py-1 bg-rose-100 text-rose-700 text-[11px] font-bold rounded-full uppercase">Ditolak</span>
                        @endif
                        <span class="px-3 py-1 bg-gray-100 text-gray-500 text-[11px] font-bold rounded-full uppercase">Est. Selesai: {{ \Carbon\Carbon::parse($registration->created_at)->addDays(3)->translatedFormat('d M Y') }}</span>
                    </div>
                </div>
            </div>
            
            <!-- Admin Quick Note -->
            <div class="bg-gradient-to-br from-amber-50 to-amber-100/50 border border-amber-200/50 p-6 rounded-2xl shadow-sm flex flex-col justify-between">
                <div>
                    <div class="flex items-center gap-2 text-amber-700 text-sm font-bold mb-3">
                        <span class="material-symbols-outlined text-lg">info</span>
                        Catatan Admin
                    </div>
                @if($registration->admin_notes)
                    <p class="text-amber-800/80 text-sm italic leading-relaxed">{{ $registration->admin_notes }}</p>
                @else
                    <p class="text-amber-800/60 text-sm italic leading-relaxed">Tidak ada catatan admin.</p>
                @endif
                </div>
                <p class="text-xs text-amber-600/50 mt-4 font-medium">Diperbarui: 2 Jam yang lalu</p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            <!-- Timeline Section -->
            <div class="lg:col-span-4 space-y-4">
                <h3 class="font-display text-lg font-bold text-gray-900 px-1">Progres Pendaftaran</h3>
                <div class="bg-white border border-gray-100 p-6 rounded-2xl shadow-sm">
                    <div class="space-y-0">
                        
                        @php
                            $isVerifying = in_array($registration->status, ['verifying', 'accepted', 'rejected']);
                            $isAccepted = $registration->status == 'accepted';
                        @endphp
                        
                        <!-- Step 1: Completed -->
                        <div class="relative flex gap-4 pb-8 before:absolute before:left-[11px] before:top-[24px] before:-bottom-2 before:w-[2px] before:bg-gray-100">
                            <div class="z-10 w-6 h-6 rounded-full bg-emerald-500 flex items-center justify-center text-white shadow-md shadow-emerald-500/30">
                                <span class="material-symbols-outlined text-[14px]">check</span>
                            </div>
                            <div>
                                <h4 class="font-bold text-sm text-gray-800">Pengisian Formulir</h4>
                                <p class="text-xs text-gray-400 mt-0.5">Selesai pada {{ \Carbon\Carbon::parse($registration->created_at)->translatedFormat('d M Y') }}</p>
                            </div>
                        </div>

                        <!-- Step 2: Verifikasi -->
                        <div class="relative flex gap-4 pb-8 before:absolute before:left-[11px] before:top-[24px] before:-bottom-2 before:w-[2px] before:bg-gray-100">
                            @if($isVerifying)
                                @if($isAccepted)
                                <div class="z-10 w-6 h-6 rounded-full bg-emerald-500 flex items-center justify-center text-white shadow-md shadow-emerald-500/30">
                                    <span class="material-symbols-outlined text-[14px]">check</span>
                                </div>
                                @else
                                <div class="z-10 w-6 h-6 rounded-full bg-white border-[3px] border-amber-400 flex items-center justify-center shadow-md shadow-amber-400/30">
                                    <div class="w-2 h-2 rounded-full bg-amber-400"></div>
                                </div>
                                @endif
                            @else
                                <div class="z-10 w-6 h-6 rounded-full bg-gray-100 flex items-center justify-center text-gray-400">
                                    <span class="material-symbols-outlined text-[14px]">hourglass_empty</span>
                                </div>
                            @endif
                            <div>
                                <h4 class="font-bold text-sm {{ $isVerifying && !$isAccepted ? 'text-amber-600' : 'text-gray-800' }}">Verifikasi Dokumen</h4>
                                <p class="text-xs text-gray-400 mt-0.5">
                                    @if($isAccepted) Selesai diverifikasi
                                    @elseif($isVerifying) Sedang berlangsung
                                    @else Menunggu pendaftaran
                                    @endif
                                </p>
                            </div>
                        </div>

                        <!-- Step 3: Final -->
                        <div class="relative flex gap-4">
                            @if($isAccepted)
                            <div class="z-10 w-6 h-6 rounded-full bg-emerald-500 flex items-center justify-center text-white shadow-md shadow-emerald-500/30">
                                <span class="material-symbols-outlined text-[14px]">verified</span>
                            </div>
                            @else
                            <div class="z-10 w-6 h-6 rounded-full bg-gray-100 flex items-center justify-center text-gray-400">
                                <span class="material-symbols-outlined text-[14px]">verified</span>
                            </div>
                            @endif
                            <div>
                                <h4 class="font-bold text-sm {{ $isAccepted ? 'text-emerald-600' : 'text-gray-400' }}">Diterima</h4>
                                <p class="text-xs text-gray-400 mt-0.5">Pengumuman kelulusan</p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Document List & Details -->
            <div class="lg:col-span-8 space-y-4">
                <h3 class="font-display text-lg font-bold text-gray-900 px-1">Status Dokumen</h3>
                <div class="bg-white border border-gray-100 rounded-2xl shadow-sm overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead class="bg-gray-50/80 border-b border-gray-100">
                                <tr>
                                    <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider">Jenis Dokumen</th>
                                    <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-50">
                                @php
                                    $docs = $registration->documents->keyBy('type');
                                    $docTypes = ['akta' => 'Akte Kelahiran', 'kk' => 'Kartu Keluarga (KK)', 'ktp_ortu' => 'KTP Orang Tua', 'foto' => 'Pas Foto (3x4)'];
                                @endphp
                                @foreach($docTypes as $type => $label)
                                    @php $doc = $docs[$type] ?? null; @endphp
                                    @if($doc)
                                    <tr class="hover:bg-gray-50/50 transition-colors">
                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-3">
                                                <div class="w-8 h-8 bg-blue-50 rounded-lg flex items-center justify-center text-blue-500">
                                                    <span class="material-symbols-outlined text-lg">description</span>
                                                </div>
                                                <span class="font-medium text-sm text-gray-700">{{ $label }}</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            @if($doc->status == 'verified')
                                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-emerald-50 text-emerald-600 text-[11px] font-bold uppercase">
                                                <span class="material-symbols-outlined text-[12px]">check_circle</span> Disetujui
                                            </span>
                                            @elseif($doc->status == 'rejected')
                                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-rose-50 text-rose-600 text-[11px] font-bold uppercase">
                                                <span class="material-symbols-outlined text-[12px]">cancel</span> Ditolak
                                            </span>
                                            @else
                                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-amber-50 text-amber-600 text-[11px] font-bold uppercase">
                                                <span class="material-symbols-outlined text-[12px]">hourglass_empty</span> Menunggu
                                            </span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 text-right">
                                            <a href="{{ route('parent.documents') }}" class="text-emerald-500 hover:text-emerald-600 font-bold text-sm transition-colors">Lihat</a>
                                        </td>
                                    </tr>
                                    @else
                                    <tr class="bg-rose-50/30">
                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-3">
                                                <div class="w-8 h-8 bg-rose-50 rounded-lg flex items-center justify-center text-rose-400">
                                                    <span class="material-symbols-outlined text-lg">error</span>
                                                </div>
                                                <span class="font-medium text-sm text-gray-700">{{ $label }}</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-rose-50 text-rose-500 text-[11px] font-bold uppercase">
                                                <span class="material-symbols-outlined text-[12px]">pending</span> Belum Diunggah
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-right">
                                            <a href="{{ route('parent.documents') }}" class="bg-emerald-500 text-white px-4 py-1.5 rounded-lg text-xs font-bold shadow-sm hover:bg-emerald-600 active:scale-95 transition-all inline-block">Unggah</a>
                                        </td>
                                    </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- History Log -->
                <div class="mt-4 space-y-4">
                    <h3 class="font-display text-lg font-bold text-gray-900 px-1">Log Riwayat</h3>
                    <div class="bg-white border border-gray-100 rounded-2xl p-5 space-y-3 shadow-sm">
                        
                        <div class="flex gap-4 p-3.5 bg-emerald-50/50 rounded-xl border border-emerald-100/50">
                            <div class="w-8 h-8 rounded-full bg-emerald-100 flex items-center justify-center flex-shrink-0">
                                <span class="material-symbols-outlined text-emerald-500 text-lg">check_circle</span>
                            </div>
                            <div class="flex-1">
                                <div class="flex justify-between items-start">
                                    <p class="font-bold text-sm text-gray-800">Dokumen Diverifikasi Sebagian</p>
                                    <span class="text-[11px] text-gray-400 font-medium">Tadi, 10:45</span>
                                </div>
                                <p class="text-gray-500 text-xs mt-1 leading-relaxed">Akta Kelahiran dan KK telah disetujui. Menunggu sisa dokumen.</p>
                            </div>
                        </div>
                        
                        <div class="flex gap-4 p-3.5 rounded-xl hover:bg-gray-50 transition-colors">
                            <div class="w-8 h-8 rounded-full bg-gray-100 flex items-center justify-center flex-shrink-0 text-gray-400">
                                <span class="material-symbols-outlined text-lg">edit_document</span>
                            </div>
                            <div class="flex-1">
                                <div class="flex justify-between items-start">
                                    <p class="font-bold text-sm text-gray-800">Pendaftaran Awal</p>
                                    <span class="text-[11px] text-gray-400 font-medium">Kemarin, 09:12</span>
                                </div>
                                <p class="text-gray-500 text-xs mt-1 leading-relaxed">Formulir pendaftaran berhasil disubmit.</p>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</main>
@endsection
