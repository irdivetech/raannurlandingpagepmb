@extends('layouts.parent')

@section('content')
<main class="md:ml-[280px] min-h-screen px-4 md:px-8 py-8 bg-gray-50">
    <!-- Header Section -->
    <header class="mb-8 flex flex-col md:flex-row md:items-end justify-between gap-4">
        <div>
            <h2 class="font-display text-3xl md:text-4xl font-bold text-gray-900">Dokumen Calon Siswa</h2>
            <p class="text-gray-500 max-w-2xl mt-2 text-sm leading-relaxed">
                Lengkapi dokumen administrasi berikut untuk keperluan verifikasi pendaftaran. Pastikan file dalam format JPG, PNG, atau PDF.
            </p>
        </div>
    </header>

    @php
        $docs = $registration->documents->keyBy('type');
        $docTypes = [
            'akta' => ['label' => 'Akta Kelahiran', 'desc' => 'Wajib'],
            'kk' => ['label' => 'Kartu Keluarga', 'desc' => 'Wajib'],
            'ktp_ortu' => ['label' => 'KTP Orang Tua', 'desc' => 'Ayah dan Ibu'],
            'foto' => ['label' => 'Pas Foto (3x4)', 'desc' => 'Latar Merah/Biru'],
            'pkh_kks' => ['label' => 'Kartu PKH/KKS', 'desc' => 'Opsional (Jika ada)']
        ];
        $total = count($docTypes);
        $uploaded = $docs->count();
        $verified = $docs->where('status', 'verified')->count();
        $rejected = $docs->where('status', 'rejected')->count();
        $missing = $total - $uploaded;
    @endphp

    <!-- Stats Overview Row -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
        <div class="bg-white border border-gray-100 p-4 rounded-2xl shadow-sm">
            <p class="text-xs font-medium text-gray-400 uppercase tracking-wider">Total Dokumen</p>
            <p class="text-2xl font-bold text-gray-900 mt-1">{{ $total }}</p>
        </div>
        <div class="bg-white border border-gray-100 p-4 rounded-2xl shadow-sm relative overflow-hidden">
            <div class="absolute top-0 left-0 w-1 h-full bg-emerald-400 rounded-r-full"></div>
            <p class="text-xs font-medium text-gray-400 uppercase tracking-wider">Diverifikasi</p>
            <p class="text-2xl font-bold text-emerald-500 mt-1">{{ $verified }}</p>
        </div>
        <div class="bg-white border border-gray-100 p-4 rounded-2xl shadow-sm relative overflow-hidden">
            <div class="absolute top-0 left-0 w-1 h-full bg-rose-400 rounded-r-full"></div>
            <p class="text-xs font-medium text-gray-400 uppercase tracking-wider">Belum Diunggah</p>
            <p class="text-2xl font-bold text-rose-500 mt-1">{{ $missing }}</p>
        </div>
        <div class="bg-white border border-gray-100 p-4 rounded-2xl shadow-sm">
            <p class="text-xs font-medium text-gray-400 uppercase tracking-wider">Ditolak</p>
            <p class="text-2xl font-bold text-gray-900 mt-1">{{ $rejected }}</p>
        </div>
    </div>

    @if(session('success'))
    <div class="p-4 mb-6 text-sm text-emerald-800 rounded-xl bg-emerald-50 border border-emerald-100 shadow-sm flex items-center gap-2" role="alert">
        <span class="material-symbols-outlined text-emerald-500">check_circle</span>
        {{ session('success') }}
    </div>
    @endif
    @if($errors->any())
    <div class="p-4 mb-6 text-sm text-rose-800 rounded-xl bg-rose-50 border border-rose-100 shadow-sm" role="alert">
        <ul class="list-disc list-inside">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <!-- Document Bento Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
        
        @foreach($docTypes as $type => $info)
            @php $doc = $docs[$type] ?? null; @endphp
            
            @if($doc)
            {{-- ===== UPLOADED DOCUMENT CARD ===== --}}
            @php
                $filePath = $doc->file_path;
                $normalizedPath = preg_replace('#^public/#', '', $filePath);
                $displayUrl = Storage::url($normalizedPath);
                $ext = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
                $isImage = in_array($ext, ['jpg', 'jpeg', 'png', 'webp']);
            @endphp
            <div class="group relative bg-white border border-gray-100 rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition-all duration-300
                {{ $doc->status == 'rejected' ? 'ring-1 ring-rose-200' : ($doc->status == 'verified' ? 'ring-1 ring-emerald-200' : '') }}">
                
                {{-- Document Preview Area --}}
                <div class="aspect-[4/3] relative overflow-hidden bg-gray-100">
                    @if($isImage)
                        <img class="w-full h-full object-cover opacity-90 group-hover:opacity-100 group-hover:scale-105 transition-all duration-500"
                             src="{{ $displayUrl }}"
                             onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
                        />
                        <div class="hidden w-full h-full flex-col items-center justify-center bg-gray-100 text-gray-400 absolute inset-0">
                            <span class="material-symbols-outlined text-4xl mb-2 text-gray-300">broken_image</span>
                            <span class="text-sm text-center px-4">Gambar tidak dapat dimuat.<br>Coba upload ulang.</span>
                        </div>
                    @else
                        <div class="w-full h-full flex flex-col items-center justify-center bg-gray-50 text-gray-400">
                            <span class="material-symbols-outlined text-5xl mb-2 text-rose-400">picture_as_pdf</span>
                            <span class="text-sm font-medium text-gray-500">Dokumen PDF</span>
                        </div>
                    @endif

                    {{-- Status Badge --}}
                    <div class="absolute top-3 right-3">
                        @if($doc->status == 'verified')
                            <span class="bg-emerald-500 text-white text-[10px] uppercase font-bold px-3 py-1.5 rounded-full shadow-md flex items-center gap-1">
                                <span class="material-symbols-outlined text-[12px]">check_circle</span> Diverifikasi
                            </span>
                        @elseif($doc->status == 'rejected')
                            <span class="bg-rose-500 text-white text-[10px] uppercase font-bold px-3 py-1.5 rounded-full shadow-md flex items-center gap-1">
                                <span class="material-symbols-outlined text-[12px]">cancel</span> Ditolak
                            </span>
                        @else
                            <span class="bg-amber-400 text-white text-[10px] uppercase font-bold px-3 py-1.5 rounded-full shadow-md flex items-center gap-1">
                                <span class="material-symbols-outlined text-[12px]">hourglass_empty</span> Menunggu
                            </span>
                        @endif
                    </div>
                </div>

                {{-- Card Body --}}
                <div class="p-5">
                    <h3 class="font-bold text-gray-900 text-base">{{ $info['label'] }}</h3>
                    <p class="text-xs text-gray-400 mb-4 mt-0.5">
                        Diunggah: {{ $doc->updated_at->translatedFormat('d M Y, H:i') }}
                    </p>

                    {{-- Admin Notes (if rejected) --}}
                    @if($doc->status == 'rejected' && $doc->notes)
                    <div class="mb-4 p-3 bg-rose-50 border border-rose-100 rounded-xl">
                        <p class="text-xs font-bold text-rose-600 mb-1 flex items-center gap-1">
                            <span class="material-symbols-outlined text-sm">info</span> Catatan Admin:
                        </p>
                        <p class="text-sm text-gray-700 italic">{{ $doc->notes }}</p>
                    </div>
                    @endif

                    {{-- Action Buttons --}}
                    <div class="flex items-center gap-2">
                        {{-- Preview button → opens lightbox --}}
                        <button type="button"
                            onclick="openLightbox('{{ $displayUrl }}', '{{ $ext }}', '{{ $info['label'] }}')"
                            class="flex-1 bg-gray-100 text-gray-600 py-2.5 rounded-xl font-bold text-sm hover:bg-emerald-500 hover:text-white transition-all flex items-center justify-center gap-1">
                            <span class="material-symbols-outlined text-lg">visibility</span> Lihat
                        </button>

                        {{-- Upload Ulang (only for rejected or pending, not verified) --}}
                        @if($doc->status != 'verified')
                        <form action="{{ route('parent.documents.upload') }}" method="POST" enctype="multipart/form-data" class="flex-1">
                            @csrf
                            <input type="hidden" name="type" value="{{ $type }}">
                            <input type="file" id="reupload_{{ $type }}" name="file" class="hidden" accept=".jpg,.jpeg,.png,.pdf" onchange="this.form.submit()">
                            <button type="button" onclick="document.getElementById('reupload_{{ $type }}').click()"
                                class="w-full py-2.5 rounded-xl font-bold text-sm transition-all flex items-center justify-center gap-1
                                {{ $doc->status == 'rejected' ? 'bg-rose-500 text-white hover:bg-rose-600 shadow-sm' : 'bg-white border border-gray-200 text-gray-600 hover:bg-gray-50' }}">
                                <span class="material-symbols-outlined text-lg">upload</span>
                                {{ $doc->status == 'rejected' ? 'Upload Ulang' : 'Ganti File' }}
                            </button>
                        </form>
                        @endif
                    </div>
                </div>
            </div>

            @else
            {{-- ===== MISSING DOCUMENT CARD ===== --}}
            <div class="group relative bg-white border-2 border-dashed border-gray-200 rounded-2xl overflow-hidden hover:border-emerald-400 transition-all duration-300">
                <form action="{{ route('parent.documents.upload') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="type" value="{{ $type }}">
                    <input type="file" id="file_{{ $type }}" name="file" class="hidden" accept=".jpg,.jpeg,.png,.pdf" onchange="this.form.submit()">

                    {{-- Drop Zone --}}
                    <div class="aspect-[4/3] flex flex-col items-center justify-center bg-gray-50/50 group-hover:bg-emerald-50/30 transition-colors cursor-pointer p-4"
                         onclick="document.getElementById('file_{{ $type }}').click()">
                        <div class="w-16 h-16 rounded-full bg-gray-100 group-hover:bg-emerald-100 flex items-center justify-center mb-3 group-hover:scale-110 transition-all">
                            <span class="material-symbols-outlined text-gray-400 group-hover:text-emerald-500 text-3xl transition-colors">add_photo_alternate</span>
                        </div>
                        <p class="text-gray-500 group-hover:text-emerald-600 font-bold text-sm text-center transition-colors">Belum Diunggah</p>
                        <p class="text-gray-400 text-xs text-center mt-1">Klik untuk pilih file</p>
                    </div>

                    {{-- Card Body --}}
                    <div class="p-5 border-t border-gray-100">
                        <h3 class="font-bold text-gray-900 text-base">{{ $info['label'] }}</h3>
                        <p class="text-xs text-gray-400 mb-4 mt-0.5">{{ $info['desc'] }} · JPG, PNG, PDF · Max 2MB</p>
                        <button type="button" onclick="document.getElementById('file_{{ $type }}').click()"
                            class="w-full bg-emerald-500 text-white py-2.5 rounded-xl font-bold text-sm hover:bg-emerald-600 transition-all flex items-center justify-center gap-2 shadow-md shadow-emerald-500/20 active:scale-95">
                            <span class="material-symbols-outlined text-lg">upload_file</span> Unggah Dokumen
                        </button>
                    </div>
                </form>
            </div>
            @endif
        @endforeach
    </div>
</main>

{{-- ============================================================ --}}
{{-- LIGHTBOX MODAL                                               --}}
{{-- ============================================================ --}}
<div id="doc-lightbox"
     class="hidden fixed inset-0 z-[200] flex items-center justify-center bg-black/70 backdrop-blur-sm p-4"
     onclick="if(event.target===this) closeLightbox()">

    <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-3xl max-h-[90vh] flex flex-col overflow-hidden border border-gray-200"
         style="animation: fadeInUp .25s ease-out;">

        {{-- Header bar --}}
        <div class="flex items-center justify-between px-5 py-3.5 border-b border-gray-100 bg-gray-50 shrink-0">
            <div class="flex items-center gap-2 text-gray-800">
                <span class="material-symbols-outlined text-emerald-500">description</span>
                <span id="lightbox-title" class="font-bold text-sm"></span>
            </div>
            <div class="flex items-center gap-2">
                {{-- Download link --}}
                <a id="lightbox-download" href="#" download
                   class="p-2 rounded-full text-gray-400 hover:bg-gray-100 hover:text-gray-600 transition-colors"
                   title="Unduh">
                    <span class="material-symbols-outlined text-xl">download</span>
                </a>
                {{-- Close X --}}
                <button onclick="closeLightbox()"
                        class="p-2 rounded-full text-gray-400 hover:bg-rose-50 hover:text-rose-500 transition-colors"
                        title="Tutup (Esc)">
                    <span class="material-symbols-outlined text-xl font-bold">close</span>
                </button>
            </div>
        </div>

        {{-- Content area --}}
        <div class="flex-1 overflow-auto flex items-center justify-center bg-gray-50 p-4 min-h-0">
            {{-- Image preview --}}
            <img id="lightbox-img"
                 src=""
                 alt="Dokumen"
                 class="hidden max-w-full max-h-full object-contain rounded-xl shadow-lg">

            {{-- PDF preview --}}
            <iframe id="lightbox-pdf"
                    src=""
                    class="hidden w-full rounded-xl border border-gray-200"
                    style="height: 70vh;">
            </iframe>

            {{-- Unsupported --}}
            <div id="lightbox-fallback" class="hidden text-center text-gray-500">
                <span class="material-symbols-outlined text-5xl mb-3 text-emerald-400">insert_drive_file</span>
                <p class="font-bold mb-2">Format tidak bisa ditampilkan</p>
                <a id="lightbox-fallback-link" href="#" target="_blank"
                   class="inline-flex items-center gap-2 px-4 py-2 bg-emerald-500 text-white rounded-xl text-sm font-bold hover:bg-emerald-600 transition-all shadow-md">
                    <span class="material-symbols-outlined text-lg">open_in_new</span> Buka di tab baru
                </a>
            </div>
        </div>
    </div>
</div>

<style>
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(24px) scale(.97); }
        to   { opacity: 1; transform: translateY(0) scale(1); }
    }
</style>

<script>
    const imageExts = ['jpg','jpeg','png','webp','gif','bmp','svg'];
    const pdfExts   = ['pdf'];

    function openLightbox(url, ext, title) {
        const lb    = document.getElementById('doc-lightbox');
        const img   = document.getElementById('lightbox-img');
        const pdf   = document.getElementById('lightbox-pdf');
        const fb    = document.getElementById('lightbox-fallback');
        const fbLnk = document.getElementById('lightbox-fallback-link');
        const dl    = document.getElementById('lightbox-download');
        const ttl   = document.getElementById('lightbox-title');

        // Reset
        img.classList.add('hidden'); img.src = '';
        pdf.classList.add('hidden'); pdf.src = '';
        fb.classList.add('hidden');

        ttl.textContent = title;
        dl.href = url;

        ext = ext.toLowerCase();

        if (imageExts.includes(ext)) {
            img.src = url;
            img.classList.remove('hidden');
        } else if (pdfExts.includes(ext)) {
            pdf.src = url;
            pdf.classList.remove('hidden');
        } else {
            fbLnk.href = url;
            fb.classList.remove('hidden');
        }

        lb.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeLightbox() {
        const lb  = document.getElementById('doc-lightbox');
        const img = document.getElementById('lightbox-img');
        const pdf = document.getElementById('lightbox-pdf');
        lb.classList.add('hidden');
        img.src = '';
        pdf.src = '';
        document.body.style.overflow = '';
    }

    // Close on Escape
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closeLightbox();
    });
</script>
@endsection
