@extends('layouts.admin')

@section('title', 'Tambah Artikel | Admin RA AN-NUUR')

@section('content')
<main class="md:ml-[280px] min-h-screen px-4 md:px-8 py-8 bg-gray-50">
    <section class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div>
            <nav class="flex items-center text-gray-400 gap-1 mb-2">
                <a href="{{ route('admin.dashboard') }}" class="text-xs hover:text-emerald-500">Admin Panel</a>
                <span class="material-symbols-outlined text-sm">chevron_right</span>
                <a href="{{ route('admin.articles.index') }}" class="text-xs hover:text-emerald-500">Artikel & Berita</a>
                <span class="material-symbols-outlined text-sm">chevron_right</span>
                <span class="text-xs font-semibold text-emerald-500">Tambah</span>
            </nav>
            <h2 class="font-display text-2xl md:text-3xl font-bold text-gray-900">Tulis Artikel Baru</h2>
        </div>
    </section>

    @if ($errors->any())
        <div class="mb-6 p-4 text-sm text-red-700 rounded-2xl bg-red-50 border border-red-200">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.articles.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
            <!-- Kolom Kiri: Form Utama -->
            <div class="xl:col-span-2 space-y-6">
                <!-- Data Utama -->
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                    <h3 class="font-bold text-gray-900 mb-4 border-b border-gray-100 pb-2">Informasi Utama</h3>
                    
                    <div class="mb-5">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Judul Artikel <span class="text-rose-500">*</span></label>
                        <input type="text" name="title" value="{{ old('title') }}" required class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all outline-none" placeholder="Masukkan judul artikel">
                    </div>

                    <div class="mb-5">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Kategori <span class="text-rose-500">*</span></label>
                        <select name="category_id" required class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all outline-none">
                            <option value="">Pilih Kategori</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-5">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Ringkasan Artikel (Excerpt) <span class="text-rose-500">*</span></label>
                        <textarea name="excerpt" required rows="3" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all outline-none" placeholder="Tuliskan ringkasan singkat artikel">{{ old('excerpt') }}</textarea>
                    </div>
                </div>

                <!-- Konten Editor -->
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                    <h3 class="font-bold text-gray-900 mb-4 border-b border-gray-100 pb-2">Isi Artikel <span class="text-rose-500">*</span></h3>
                    <textarea name="content" id="editor">{{ old('content') }}</textarea>
                </div>
            </div>

            <!-- Kolom Kanan: Sidebar Form -->
            <div class="space-y-6">
                <!-- Media & Publikasi -->
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                    <h3 class="font-bold text-gray-900 mb-4 border-b border-gray-100 pb-2">Media & Publikasi</h3>

                    <div class="mb-5">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Thumbnail Utama <span class="text-rose-500">*</span></label>
                        <input type="file" name="thumbnail" accept="image/*" required class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100">
                        <p class="text-xs text-gray-400 mt-1">Format: JPG, PNG, WEBP. Maks 2MB.</p>
                    </div>

                    <div class="mb-5">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Galeri Dokumentasi (Opsional)</label>
                        <input type="file" name="gallery[]" accept="image/*" multiple class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                        <p class="text-xs text-gray-400 mt-1">Bisa pilih lebih dari satu foto.</p>
                    </div>

                    <div class="mb-5">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Status <span class="text-rose-500">*</span></label>
                        <select name="status" id="statusSelect" required class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all outline-none">
                            <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Simpan sebagai Draft</option>
                            <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Publikasikan</option>
                        </select>
                    </div>

                    <div class="mb-5" id="publishDateDiv" style="display: {{ old('status') == 'published' ? 'block' : 'none' }};">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Tanggal Publikasi</label>
                        <input type="datetime-local" name="published_at" value="{{ old('published_at') }}" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all outline-none">
                        <p class="text-xs text-gray-400 mt-1">Biarkan kosong untuk publish sekarang.</p>
                    </div>
                </div>

                <div class="flex flex-col gap-3">
                    <button type="submit" class="w-full py-3 rounded-xl bg-emerald-500 text-white font-bold hover:bg-emerald-600 transition-colors shadow-md shadow-emerald-500/20 text-center">Simpan Artikel</button>
                    <a href="{{ route('admin.articles.index') }}" class="w-full py-3 rounded-xl border border-gray-200 text-gray-600 font-bold hover:bg-gray-50 transition-colors text-center">Batal</a>
                </div>
            </div>
        </div>
    </form>
</main>

<!-- CKEditor 5 -->
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#editor'), {
            toolbar: ['heading', '|', 'bold', 'italic', 'underline', 'link', 'bulletedList', 'numberedList', 'blockQuote', 'insertTable', 'undo', 'redo']
        })
        .catch(error => {
            console.error(error);
        });

    document.getElementById('statusSelect').addEventListener('change', function() {
        if(this.value === 'published') {
            document.getElementById('publishDateDiv').style.display = 'block';
        } else {
            document.getElementById('publishDateDiv').style.display = 'none';
        }
    });
</script>
<style>
    .ck-editor__editable_inline {
        min-height: 400px;
        border-radius: 0 0 12px 12px !important;
        padding: 20px !important;
    }
    .ck-toolbar {
        border-radius: 12px 12px 0 0 !important;
    }
</style>
@endsection
