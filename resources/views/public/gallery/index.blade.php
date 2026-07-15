@extends('layouts.app')

@section('title', 'Galeri Dokumentasi | RA AN-NUUR')

@push('styles')
    <!-- Lightbox2 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/css/lightbox.min.css" rel="stylesheet" />
@endpush

@section('content')
<!-- Header Section -->
<section class="pt-32 pb-16 bg-gradient-to-br from-emerald-50 via-white to-emerald-50/50 relative overflow-hidden">
    <div class="absolute inset-0 bg-[url('{{ asset('assets/img/pattern.svg') }}')] opacity-5"></div>
    <div class="max-w-7xl mx-auto px-4 md:px-8 relative z-10">
        <div class="text-center max-w-3xl mx-auto">
            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-emerald-100 text-emerald-700 text-sm font-bold mb-4 border border-emerald-200">
                <span class="material-symbols-outlined text-[16px]">photo_library</span>
                Dokumentasi RA AN-NUUR
            </span>
            <h1 class="font-display text-4xl md:text-5xl font-extrabold text-gray-900 mb-6 leading-tight">
                Galeri Kegiatan
            </h1>
            <p class="text-lg text-gray-600 mb-8 leading-relaxed">
                Kumpulan momen dan dokumentasi kegiatan dari berbagai acara di RA AN-NUUR.
            </p>
        </div>
    </div>
</section>

<!-- Main Content -->
<section class="py-16 bg-white min-h-[500px]">
    <div class="max-w-7xl mx-auto px-4 md:px-8">
        
        @if($images->count() > 0)
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 md:gap-6">
                @foreach($images as $img)
                <a href="{{ asset('storage/' . $img->image) }}" data-lightbox="main-gallery" data-title="{{ $img->article->title }}" class="block rounded-2xl overflow-hidden group border border-gray-100 shadow-sm bg-gray-50 relative">
                    <div class="relative w-full h-48 md:h-64">
                        <img src="{{ asset('storage/' . $img->image) }}" alt="Gallery Image" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-4">
                            <span class="material-symbols-outlined text-white text-3xl mb-2 drop-shadow-md self-center mt-auto">zoom_in</span>
                            <span class="text-xs font-bold text-emerald-400 uppercase tracking-wider mb-1">{{ $img->article->category->name }}</span>
                            <p class="text-white text-sm font-medium line-clamp-2 leading-snug">{{ $img->article->title }}</p>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-16 flex justify-center">
                {{ $images->links() }}
            </div>
        @else
            <div class="text-center py-16 bg-gray-50 rounded-3xl border border-gray-100">
                <span class="material-symbols-outlined text-6xl text-gray-300 mb-4">image_not_supported</span>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Belum Ada Galeri</h3>
                <p class="text-gray-500">Belum ada foto dokumentasi yang diunggah ke artikel.</p>
            </div>
        @endif
    </div>
</section>
@endsection

@push('scripts')
    <!-- Lightbox2 JS -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/js/lightbox.min.js"></script>
    <script>
        lightbox.option({
            'resizeDuration': 200,
            'wrapAround': true,
            'albumLabel': "Gambar %1 dari %2"
        })
    </script>
@endpush
