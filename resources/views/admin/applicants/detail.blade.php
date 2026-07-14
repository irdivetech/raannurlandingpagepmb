@extends('layouts.admin')

@section('content')
<main class="md:ml-[280px] min-h-screen px-4 md:px-8 py-8 bg-gray-50">

    <!-- Header & Breadcrumbs -->
    <section class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-8">
        <div>
            <nav class="flex items-center text-gray-400 gap-1 mb-2">
                <span class="text-xs">Admin Panel</span>
                <span class="material-symbols-outlined text-sm">chevron_right</span>
                <a href="{{ route('admin.applicants.index') }}" class="text-xs hover:text-emerald-500 transition-colors">Calon Siswa</a>
                <span class="material-symbols-outlined text-sm">chevron_right</span>
                <span class="text-xs font-semibold text-emerald-500">Detail Pendaftar</span>
            </nav>
            <div class="flex items-center gap-3">
                <h2 class="font-display text-3xl md:text-4xl font-bold text-gray-900">{{ $registration->student->full_name }}</h2>
                @if($registration->status == 'verifying')
                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg bg-amber-50 text-amber-700 text-xs font-bold border border-amber-200 mt-2">
                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span> Verifikasi
                    </span>
                @elseif($registration->status == 'accepted')
                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg bg-emerald-50 text-emerald-700 text-xs font-bold border border-emerald-200 mt-2">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Diterima
                    </span>
                @else
                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg bg-red-50 text-red-600 text-xs font-bold border border-red-200 mt-2">
                        <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span> Ditolak/Revisi
                    </span>
                @endif
            </div>
            <p class="text-sm text-gray-400 mt-1">No. Registrasi: <span class="font-mono font-semibold text-gray-600">{{ $registration->reg_number }}</span></p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.applicants.index') }}" class="flex items-center gap-2 bg-white border border-gray-200 text-gray-600 px-4 py-2.5 rounded-xl text-sm font-bold hover:bg-gray-50 transition-colors shadow-sm">
                <span class="material-symbols-outlined text-[16px]">arrow_back</span> Kembali
            </a>
        </div>
    </section>

    <!-- Page Content -->
    <div class="flex flex-col md:flex-row gap-6">
        
        <!-- Left Column: Data Details -->
        <div class="w-full md:w-5/12 lg:w-4/12 bg-white rounded-2xl border border-gray-100 shadow-sm p-6" id="print-area">
            <div class="space-y-6">
                
                <!-- Quick Actions -->
                <div class="grid grid-cols-2 gap-3 mb-6 no-print">
                    @php
                        $waNumber = preg_replace('/^0/', '62', $registration->parent->father_phone);
                    @endphp
                    <a href="https://wa.me/{{ $waNumber }}" target="_blank" class="bg-emerald-50 text-emerald-600 border border-emerald-100 py-2.5 rounded-xl text-sm font-bold hover:bg-emerald-500 hover:text-white transition-all flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined text-[18px]">mark_email_read</span> Hubungi Wali
                    </a>
                    <button onclick="window.print()" class="bg-gray-50 text-gray-600 py-2.5 rounded-xl text-sm font-bold border border-gray-200 hover:bg-gray-100 transition-all flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined text-[18px]">print</span> Cetak Form
                    </button>
                </div>

                <!-- Data Anak Section -->
                <section>
                    <h3 class="font-bold text-gray-800 mb-4 flex items-center gap-2 border-b border-gray-100 pb-3">
                        <span class="material-symbols-outlined text-[20px] text-emerald-500">child_care</span> Data Calon Siswa
                    </h3>
                    <div class="space-y-4">
                        <div>
                            <p class="text-xs text-gray-400 font-bold uppercase tracking-wider mb-1">Nama Lengkap</p>
                            <p class="text-sm font-bold text-gray-800">{{ $registration->student->full_name }}</p>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-xs text-gray-400 font-bold uppercase tracking-wider mb-1">Panggilan</p>
                                <p class="text-sm font-medium text-gray-800">{{ $registration->student->nickname ?? '-' }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-400 font-bold uppercase tracking-wider mb-1">Jenis Kelamin</p>
                                <p class="text-sm font-medium text-gray-800">{{ $registration->student->gender == 'L' ? 'Laki-laki' : 'Perempuan' }}</p>
                            </div>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 font-bold uppercase tracking-wider mb-1">NIK Siswa</p>
                            <p class="text-sm font-medium text-gray-800 font-mono">{{ $registration->student->nik }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 font-bold uppercase tracking-wider mb-1">Cita-cita</p>
                            <p class="text-sm font-medium text-gray-800">{{ $registration->student->cita_cita ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 font-bold uppercase tracking-wider mb-1">No KK</p>
                            <p class="text-sm font-medium text-gray-800 font-mono">{{ $registration->student->no_kk ?? '-' }}</p>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-xs text-gray-400 font-bold uppercase tracking-wider mb-1">Anak Ke</p>
                                <p class="text-sm font-medium text-gray-800">{{ $registration->student->child_order ?? '-' }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-400 font-bold uppercase tracking-wider mb-1">Jumlah Saudara</p>
                                <p class="text-sm font-medium text-gray-800">{{ $registration->student->siblings_count ?? '-' }}</p>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-xs text-gray-400 font-bold uppercase tracking-wider mb-1">Tempat Lahir</p>
                                <p class="text-sm font-medium text-gray-800">{{ $registration->student->birth_place }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-400 font-bold uppercase tracking-wider mb-1">Tanggal Lahir</p>
                                <p class="text-sm font-medium text-gray-800">{{ \Carbon\Carbon::parse($registration->student->birth_date)->format('d F Y') }}</p>
                            </div>
                        </div>
                        <div class="bg-emerald-50/50 border border-emerald-100 rounded-xl p-3 flex items-start gap-2 mt-2">
                            <span class="material-symbols-outlined text-emerald-500 text-[18px] mt-0.5">info</span>
                            <div>
                                @php $age = \Carbon\Carbon::parse($registration->student->birth_date)->age; @endphp
                                <p class="text-xs font-bold text-emerald-700 mb-0.5">Usia per Pendaftaran:</p>
                                <p class="text-sm text-gray-800 font-bold">{{ $age }} Tahun <span class="font-bold text-[10px] bg-white px-2 py-0.5 rounded border ml-2 text-emerald-600">{{ $age >= 5 ? 'Kelompok B' : 'Kelompok A' }}</span></p>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Data Wali Section -->
                <section>
                    <h3 class="font-bold text-gray-800 mb-4 flex items-center gap-2 border-b border-gray-100 pb-3">
                        <span class="material-symbols-outlined text-[20px] text-amber-500">family_restroom</span> Data Wali (Ayah/Ibu)
                    </h3>
                    <div class="space-y-4">
                        <div>
                            <p class="text-xs text-gray-400 font-bold uppercase tracking-wider mb-1">Nama Ayah</p>
                            <p class="text-sm font-medium text-gray-800">{{ $registration->parent->father_name }}</p>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-xs text-gray-400 font-bold uppercase tracking-wider mb-1">NIK Ayah</p>
                                <p class="text-sm font-medium text-gray-800">{{ $registration->parent->father_nik ?? '-' }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-400 font-bold uppercase tracking-wider mb-1">Tempat, Tanggal Lahir</p>
                                <p class="text-sm font-medium text-gray-800">{{ $registration->parent->father_birth_place ?? '-' }}, {{ $registration->parent->father_birth_date ? \Carbon\Carbon::parse($registration->parent->father_birth_date)->format('d F Y') : '-' }}</p>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-xs text-gray-400 font-bold uppercase tracking-wider mb-1">Pekerjaan Ayah</p>
                                <p class="text-sm font-medium text-gray-800">{{ $registration->parent->father_job }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-400 font-bold uppercase tracking-wider mb-1">No. WA Ayah</p>
                                <p class="text-sm font-medium text-emerald-600 hover:underline cursor-pointer">{{ $registration->parent->father_phone }}</p>
                            </div>
                        </div>
                        <div class="border-t border-dashed border-gray-200 my-2 pt-2"></div>
                        <div>
                            <p class="text-xs text-gray-400 font-bold uppercase tracking-wider mb-1">Nama Ibu</p>
                            <p class="text-sm font-medium text-gray-800">{{ $registration->parent->mother_name }}</p>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-xs text-gray-400 font-bold uppercase tracking-wider mb-1">NIK Ibu</p>
                                <p class="text-sm font-medium text-gray-800">{{ $registration->parent->mother_nik ?? '-' }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-400 font-bold uppercase tracking-wider mb-1">Tempat, Tanggal Lahir</p>
                                <p class="text-sm font-medium text-gray-800">{{ $registration->parent->mother_birth_place ?? '-' }}, {{ $registration->parent->mother_birth_date ? \Carbon\Carbon::parse($registration->parent->mother_birth_date)->format('d F Y') : '-' }}</p>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-xs text-gray-400 font-bold uppercase tracking-wider mb-1">Pekerjaan Ibu</p>
                                <p class="text-sm font-medium text-gray-800">{{ $registration->parent->mother_job }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-400 font-bold uppercase tracking-wider mb-1">No. WA Ibu</p>
                                <p class="text-sm font-medium text-emerald-600 hover:underline cursor-pointer">{{ $registration->parent->mother_phone }}</p>
                            </div>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 font-bold uppercase tracking-wider mb-1">No. Kartu PKH / KKS</p>
                            <p class="text-sm font-medium text-gray-800">{{ $registration->parent->no_pkh_kks ?? '-' }}</p>
                        </div>
                    </div>
                </section>

                <!-- Alamat Section -->
                <section>
                    <h3 class="font-bold text-gray-800 mb-4 flex items-center gap-2 border-b border-gray-100 pb-3">
                        <span class="material-symbols-outlined text-[20px] text-purple-500">home_pin</span> Alamat Domisili
                    </h3>
                    <div class="space-y-4">
                        <div>
                            <p class="text-xs text-gray-400 font-bold uppercase tracking-wider mb-1">Alamat Lengkap</p>
                            <p class="text-sm font-medium text-gray-800 leading-relaxed">{{ $registration->address->address_line }}</p>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-xs text-gray-400 font-bold uppercase tracking-wider mb-1">Kecamatan</p>
                                <p class="text-sm font-medium text-gray-800">{{ $registration->address->district }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-400 font-bold uppercase tracking-wider mb-1">Kota / Kabupaten</p>
                                <p class="text-sm font-medium text-gray-800">{{ $registration->address->city }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-400 font-bold uppercase tracking-wider mb-1">Provinsi</p>
                                <p class="text-sm font-medium text-gray-800">{{ $registration->address->province }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-400 font-bold uppercase tracking-wider mb-1">Kode Pos</p>
                                <p class="text-sm font-medium text-gray-800">{{ $registration->address->postal_code }}</p>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>

        <!-- Right Column: Document Verification Canvas -->
        <div class="w-full md:w-7/12 lg:w-8/12 flex flex-col gap-6 no-print">
            
            <!-- Verification Action Panel -->
            <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm">
                <h4 class="font-bold text-gray-800 mb-4 flex items-center gap-2">
                    <span class="material-symbols-outlined text-[18px] text-emerald-500">fact_check</span> Keputusan Akhir
                </h4>

                {{-- Tampilkan catatan admin yang sudah ada --}}
                @if($registration->admin_notes)
                <div class="mb-4 p-3 bg-red-50/50 border border-red-100 rounded-xl">
                    <p class="text-xs font-bold text-red-600 mb-1 flex items-center gap-1">
                        <span class="material-symbols-outlined text-[14px]">sticky_note_2</span> Catatan Terakhir:
                    </p>
                    <p class="text-sm text-gray-700 italic">{{ $registration->admin_notes }}</p>
                </div>
                @endif

                {{-- Tampilkan pesan error jika ada (misal: kuota penuh) --}}
                @if(session('error'))
                <div class="mb-4 p-3 bg-red-50 border border-red-200 rounded-xl">
                    <p class="text-xs font-bold text-red-700 mb-1 flex items-center gap-1">
                        <span class="material-symbols-outlined text-[14px]">error</span> Gagal:
                    </p>
                    <p class="text-sm text-red-700">{{ session('error') }}</p>
                </div>
                @endif

                {{-- Success message --}}
                @if(session('success'))
                <div class="mb-4 p-3 bg-emerald-50 border border-emerald-200 rounded-xl">
                    <p class="text-xs font-bold text-emerald-700 mb-1 flex items-center gap-1">
                        <span class="material-symbols-outlined text-[14px]">check_circle</span> Berhasil:
                    </p>
                    <p class="text-sm text-emerald-700">{{ session('success') }}</p>
                </div>
                @endif

                <div class="flex flex-col sm:flex-row gap-3">
                    {{-- Tombol Tolak -> Buka Modal --}}
                    <button type="button" onclick="openRegRejectModal()" class="flex-1 bg-white border border-gray-200 text-gray-700 py-3 rounded-xl font-bold text-sm hover:bg-red-50 hover:text-red-600 hover:border-red-200 transition-all flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined text-[18px]">cancel</span> Tolak & Revisi
                    </button>
                    
                    {{-- Tombol Terima -> Submit langsung --}}
                    <form action="{{ route('admin.applicants.status', $registration->id) }}" method="POST" class="flex-1 flex">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="status" value="accepted">
                        <button type="submit" class="w-full bg-emerald-500 text-white py-3 rounded-xl font-bold text-sm hover:bg-emerald-600 transition-all shadow-md active:scale-95 flex items-center justify-center gap-2">
                            <span class="material-symbols-outlined text-[18px]">check_circle</span> Dokumen Valid (Terima)
                        </button>
                    </form>
                </div>
            </div>

            <!-- Document Preview Section -->
            <div class="bg-white rounded-2xl border border-gray-100 flex flex-col flex-1 shadow-sm overflow-hidden">
                <!-- Document Tabs -->
                <div class="bg-white border-b border-gray-100 px-4 pt-4 flex gap-2 overflow-x-auto preview-scroll flex-shrink-0">
                    @forelse($registration->documents as $index => $doc)
                    @php
                        $docNorm = preg_replace('#^public/#', '', $doc->file_path);
                        $docUrl = Storage::url($docNorm);
                    @endphp
                    <button class="px-4 py-3 {{ $index == 0 ? 'bg-emerald-50 border-b-2 border-emerald-500 text-emerald-600 font-bold active-nav-border rounded-t-lg' : 'text-gray-500 hover:bg-gray-50 hover:text-gray-700 font-semibold border-b-2 border-transparent rounded-t-lg' }} text-sm flex items-center gap-2 whitespace-nowrap transition-colors" onclick="selectDocument('{{ $docUrl }}', '{{ $doc->id }}', '{{ $doc->status }}', this)">
                        <span class="material-symbols-outlined text-[18px]">description</span>
                        {{ strtoupper($doc->type) }}
                    </button>
                    @empty
                    <p class="px-4 py-3 text-sm text-gray-400">Tidak ada dokumen.</p>
                    @endforelse
                </div>

                <!-- Document Viewer Panel -->
                <div class="flex-1 bg-gray-50/50 p-4 flex flex-col items-center justify-center relative min-h-[500px]">
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-y-auto preview-scroll w-full max-w-2xl h-full flex flex-col items-center p-4">
                        @if($registration->documents->count() > 0)
                        @php
                            $firstDoc = $registration->documents->first();
                            $firstNorm = preg_replace('#^public/#', '', $firstDoc->file_path);
                            $firstUrl = Storage::url($firstNorm);
                        @endphp
                        <div class="flex-1 w-full flex items-center justify-center overflow-hidden mb-4 min-h-[300px]">
                            <img id="document-preview" src="{{ $firstUrl }}" alt="Dokumen" class="max-w-full max-h-full object-contain hover:cursor-zoom-in transition-transform duration-300 rounded-lg">
                        </div>
                        
                        <form id="verify-doc-form" action="{{ route('admin.documents.verify', $firstDoc->id) }}" method="POST" class="w-full flex gap-3 p-4 bg-gray-50 border border-gray-200 rounded-xl shadow-sm mt-auto">
                            @csrf
                            @method('PATCH')
                            <div class="flex-1 flex flex-col justify-center">
                                <p class="font-bold text-sm text-gray-800">Verifikasi Dokumen Ini</p>
                                <p class="text-xs text-gray-500">Status saat ini: <span id="doc-status-text" class="font-bold uppercase text-gray-700">{{ $firstDoc->status }}</span></p>
                            </div>
                            <button type="button" onclick="openDocRejectModal()" class="px-5 py-2 bg-red-100 text-red-700 rounded-xl text-sm font-bold hover:bg-red-200 transition-all">Tolak</button>
                            <button type="submit" name="status" value="verified" class="px-5 py-2 bg-emerald-500 text-white rounded-xl text-sm font-bold hover:bg-emerald-600 transition-all shadow-sm">Setujui</button>
                        </form>
                        @else
                        <p class="text-gray-400 m-auto text-sm font-medium">Belum ada dokumen yang diunggah.</p>
                        @endif
                    </div>
                </div>
            </div>

        </div>

    </div>

</main>

{{-- ============================================================== --}}
{{-- MODAL: Tolak Dokumen (dengan catatan)                          --}}
{{-- ============================================================== --}}
<div id="doc-reject-modal" class="hidden fixed inset-0 z-[100] items-center justify-center bg-gray-900/50 backdrop-blur-sm p-4" onclick="if(event.target===this) closeDocRejectModal()">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-md border border-gray-100 overflow-hidden animate-[fadeInUp_0.25s_ease-out]">
        {{-- Header --}}
        <div class="bg-red-50/50 border-b border-red-100 px-6 py-4 flex items-center gap-3">
            <div class="w-10 h-10 rounded-full bg-red-100 flex items-center justify-center">
                <span class="material-symbols-outlined text-red-500 text-[20px]">description_off</span>
            </div>
            <div>
                <h3 class="font-bold text-gray-900">Tolak Dokumen</h3>
                <p class="text-xs text-gray-500">Berikan alasan penolakan dokumen ini</p>
            </div>
            <button onclick="closeDocRejectModal()" class="ml-auto p-1.5 rounded-full hover:bg-gray-100 transition-colors text-gray-400">
                <span class="material-symbols-outlined text-[20px]">close</span>
            </button>
        </div>
        {{-- Body --}}
        <form id="doc-reject-form" action="{{ route('admin.documents.verify', $registration->documents->first()->id ?? 0) }}" method="POST" class="px-6 py-5 space-y-4">
            @csrf
            @method('PATCH')
            <input type="hidden" name="status" value="rejected">
            <div>
                <label for="doc-reject-notes" class="block text-sm font-bold text-gray-700 mb-2">Catatan Penolakan <span class="text-red-500">*</span></label>
                <textarea id="doc-reject-notes" name="notes" rows="4" required
                    class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 text-gray-800 text-sm focus:outline-none focus:border-red-400 focus:ring-2 focus:ring-red-400/20 resize-none transition-all"
                    placeholder="Contoh: Foto dokumen buram, tidak bisa dibaca. Mohon upload ulang dengan kualitas yang lebih baik..."></textarea>
                <p class="mt-1.5 text-xs text-gray-400">Catatan ini akan terlihat oleh orang tua/wali.</p>
            </div>
            <div class="flex gap-3 pt-2">
                <button type="button" onclick="closeDocRejectModal()" class="flex-1 py-2.5 rounded-xl border border-gray-200 text-gray-600 font-bold text-sm hover:bg-gray-50 transition-colors">Batal</button>
                <button type="submit" class="flex-1 py-2.5 rounded-xl bg-red-500 text-white font-bold text-sm hover:bg-red-600 transition-all flex items-center justify-center gap-2 shadow-sm">
                    <span class="material-symbols-outlined text-[18px]">cancel</span> Tolak Dokumen
                </button>
            </div>
        </form>
    </div>
</div>

{{-- ============================================================== --}}
{{-- MODAL: Tolak & Revisi Pendaftaran (dengan catatan)             --}}
{{-- ============================================================== --}}
<div id="reg-reject-modal" class="hidden fixed inset-0 z-[100] items-center justify-center bg-gray-900/50 backdrop-blur-sm p-4" onclick="if(event.target===this) closeRegRejectModal()">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-lg border border-gray-100 overflow-hidden animate-[fadeInUp_0.25s_ease-out]">
        {{-- Header --}}
        <div class="bg-red-50/50 border-b border-red-100 px-6 py-4 flex items-center gap-3">
            <div class="w-10 h-10 rounded-full bg-red-100 flex items-center justify-center">
                <span class="material-symbols-outlined text-red-500 text-[20px]">assignment_return</span>
            </div>
            <div>
                <h3 class="font-bold text-gray-900 text-lg">Tolak & Revisi Pendaftaran</h3>
                <p class="text-xs text-gray-500">Jelaskan kekurangan data agar orang tua/wali dapat melengkapi</p>
            </div>
            <button onclick="closeRegRejectModal()" class="ml-auto p-1.5 rounded-full hover:bg-gray-100 transition-colors text-gray-400">
                <span class="material-symbols-outlined text-[20px]">close</span>
            </button>
        </div>
        {{-- Body --}}
        <form action="{{ route('admin.applicants.status', $registration->id) }}" method="POST" class="px-6 py-5 space-y-5">
            @csrf
            @method('PATCH')
            <input type="hidden" name="status" value="rejected">
            
            <div>
                <label for="reg-reject-notes" class="block text-sm font-bold text-gray-700 mb-2">Alasan Penolakan / Kekurangan Data <span class="text-red-500">*</span></label>
                <textarea id="reg-reject-notes" name="admin_notes" rows="5" required
                    class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 text-gray-800 text-sm focus:outline-none focus:border-red-400 focus:ring-2 focus:ring-red-400/20 resize-none transition-all"
                    placeholder="Contoh:&#10;1. Foto Akta Kelahiran tidak jelas, mohon upload ulang&#10;2. Data NIK tidak sesuai dengan dokumen&#10;3. Alamat belum lengkap"></textarea>
                <p class="mt-1.5 text-xs text-gray-400">Catatan ini akan terlihat oleh orang tua/wali di halaman status pendaftaran mereka.</p>
            </div>

            {{-- Quick-select common reasons --}}
            <div>
                <p class="text-xs font-bold text-gray-500 mb-2.5">Pilih Alasan Cepat:</p>
                <div class="flex flex-wrap gap-2">
                    <button type="button" onclick="appendReason('Foto dokumen buram/tidak jelas')" class="px-3 py-1.5 text-xs font-medium rounded-full border border-gray-200 text-gray-600 hover:bg-red-50 hover:text-red-600 hover:border-red-200 transition-colors">📄 Foto buram</button>
                    <button type="button" onclick="appendReason('Data NIK tidak sesuai dengan dokumen')" class="px-3 py-1.5 text-xs font-medium rounded-full border border-gray-200 text-gray-600 hover:bg-red-50 hover:text-red-600 hover:border-red-200 transition-colors">🔢 NIK tidak sesuai</button>
                    <button type="button" onclick="appendReason('Alamat domisili belum lengkap')" class="px-3 py-1.5 text-xs font-medium rounded-full border border-gray-200 text-gray-600 hover:bg-red-50 hover:text-red-600 hover:border-red-200 transition-colors">🏠 Alamat belum lengkap</button>
                    <button type="button" onclick="appendReason('Dokumen Akta Kelahiran belum diunggah')" class="px-3 py-1.5 text-xs font-medium rounded-full border border-gray-200 text-gray-600 hover:bg-red-50 hover:text-red-600 hover:border-red-200 transition-colors">📋 Akta belum ada</button>
                    <button type="button" onclick="appendReason('Data orang tua/wali tidak lengkap')" class="px-3 py-1.5 text-xs font-medium rounded-full border border-gray-200 text-gray-600 hover:bg-red-50 hover:text-red-600 hover:border-red-200 transition-colors">👪 Data wali kurang</button>
                </div>
            </div>

            <div class="flex gap-3 pt-2">
                <button type="button" onclick="closeRegRejectModal()" class="flex-1 py-3 rounded-xl border border-gray-200 text-gray-600 font-bold text-sm hover:bg-gray-50 transition-colors">Batal</button>
                <button type="submit" class="flex-1 py-3 rounded-xl bg-red-500 text-white font-bold text-sm hover:bg-red-600 transition-all shadow-sm flex items-center justify-center gap-2">
                    <span class="material-symbols-outlined text-[18px]">cancel</span> Tolak & Revisi
                </button>
            </div>
        </form>
    </div>
</div>

@section('scripts')
<script>
    // === Document Tab Selection ===
    function selectDocument(url, id, status, el) {
        document.getElementById('document-preview').src = url;
        document.getElementById('verify-doc-form').action = '/admin/documents/' + id + '/verify';
        document.getElementById('doc-status-text').innerText = status;
        document.getElementById('doc-reject-form').action = '/admin/documents/' + id + '/verify';
        
        document.querySelectorAll('.active-nav-border').forEach(node => {
            node.classList.remove('bg-emerald-50', 'border-emerald-500', 'text-emerald-600', 'font-bold', 'active-nav-border');
            node.classList.add('text-gray-500', 'border-transparent', 'font-semibold');
        });
        
        el.classList.remove('text-gray-500', 'border-transparent', 'font-semibold');
        el.classList.add('bg-emerald-50', 'border-emerald-500', 'text-emerald-600', 'font-bold', 'active-nav-border');
    }

    // === MODAL FUNCTIONS ===
    function openDocRejectModal() {
        document.getElementById('doc-reject-modal').classList.remove('hidden');
        document.getElementById('doc-reject-modal').classList.add('flex');
        document.getElementById('doc-reject-notes').focus();
    }
    function closeDocRejectModal() {
        document.getElementById('doc-reject-modal').classList.add('hidden');
        document.getElementById('doc-reject-modal').classList.remove('flex');
        document.getElementById('doc-reject-notes').value = '';
    }

    function openRegRejectModal() {
        document.getElementById('reg-reject-modal').classList.remove('hidden');
        document.getElementById('reg-reject-modal').classList.add('flex');
        document.getElementById('reg-reject-notes').focus();
    }
    function closeRegRejectModal() {
        document.getElementById('reg-reject-modal').classList.add('hidden');
        document.getElementById('reg-reject-modal').classList.remove('flex');
        document.getElementById('reg-reject-notes').value = '';
    }

    // Append quick-select reason to textarea
    function appendReason(text) {
        const textarea = document.getElementById('reg-reject-notes');
        if (textarea.value && !textarea.value.endsWith('\n')) {
            textarea.value += '\n';
        }
        textarea.value += '• ' + text;
        textarea.focus();
    }
</script>
@endsection

@section('styles')
<style>
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    @media print {
        /* Hide everything except print area */
        aside, header, footer, .no-print, nav, section:first-of-type { display: none !important; }
        .mb-8 { display: none !important; }
        
        /* Reset layout */
        body { 
            background: white !important; 
            margin: 0 !important; 
            padding: 0 !important;
            font-family: 'Times New Roman', serif !important;
            font-size: 12pt !important;
            color: #000 !important;
        }
        
        .md\:ml-\[280px\] { margin-left: 0 !important; }
        main { background: white !important; padding: 0 !important; min-height: auto !important; }
        .flex-col.md\:flex-row { display: block !important; padding: 0 !important; }
        
        /* Make left column full width */
        #print-area {
            width: 100% !important;
            max-width: 100% !important;
            border: none !important;
            box-shadow: none !important;
            border-radius: 0 !important;
            padding: 0 !important;
        }
        
        /* Hide right column */
        .w-full.md\:w-7\/12, .w-full.lg\:w-8\/12,
        .no-print { display: none !important; }
        
        /* Print header */
        body::before {
            content: "";
            display: block;
        }
        
        #print-area::before {
            content: "FORMULIR DATA PENDAFTARAN CALON SISWA";
            display: block;
            text-align: center;
            font-size: 16pt;
            font-weight: bold;
            font-family: 'Times New Roman', serif;
            border-bottom: 3px double #000;
            padding-bottom: 8pt;
            margin-bottom: 12pt;
            margin-top: 20pt;
        }
        
        #print-area::after {
            content: "RA AN-NUUR Islamic Kindergarten — Tahun Ajaran {{ date('Y') }}/{{ date('Y') + 1 }}";
            display: block;
            text-align: center;
            font-size: 10pt;
            font-family: 'Times New Roman', serif;
            margin-top: 20pt;
            margin-bottom: 16pt;
            color: #333;
        }
        
        /* Style sections for print */
        section {
            page-break-inside: avoid;
            margin-bottom: 16pt !important;
        }
        
        section h3 {
            font-size: 12pt !important;
            font-weight: bold !important;
            color: #000 !important;
            border-bottom: 1px solid #000 !important;
            padding-bottom: 4pt !important;
            margin-bottom: 10pt !important;
        }
        
        section h3 .material-symbols-outlined { display: none !important; }
        
        .space-y-4 > div {
            margin-bottom: 6pt !important;
        }
        
        /* Labels */
        .text-xs.font-bold.uppercase {
            font-size: 10pt !important;
            color: #444 !important;
            font-weight: bold !important;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        /* Values */
        .text-sm.font-bold, .text-sm.font-medium, p {
            font-size: 12pt !important;
            color: #000 !important;
            font-weight: normal !important;
        }
        
        .font-mono { font-family: 'Courier New', Courier, monospace !important; font-size: 11pt !important; }
        
        /* Info box */
        .bg-emerald-50\/50 {
            border: 1px solid #000 !important;
            background: #fff !important;
            padding: 8pt !important;
            border-radius: 4pt !important;
        }
        
        /* Grid for print */
        .grid { display: flex !important; gap: 20pt !important; }
        .grid-cols-2 > div { flex: 1 !important; }
        
        /* Footer for print */
        @page {
            size: A4;
            margin: 2cm 2.5cm;
        }
    }
</style>
@endsection
