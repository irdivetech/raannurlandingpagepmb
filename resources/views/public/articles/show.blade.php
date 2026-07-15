@extends('layouts.app')

@section('title', $article->title . ' | RA AN-NUUR')

@push('meta')
    <meta name="description" content="{{ $article->excerpt }}">
    <meta property="og:title" content="{{ $article->title }}">
    <meta property="og:description" content="{{ $article->excerpt }}">
    <meta property="og:image" content="{{ asset('storage/' . $article->thumbnail) }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <link rel="canonical" href="{{ url()->current() }}">
@endpush

@push('styles')
    <!-- Lightbox2 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/css/lightbox.min.css" rel="stylesheet" />
    <style>
        /* Article Content Formatting */
        .article-content h1 { font-size: 2.25rem; font-weight: 800; margin-top: 2rem; margin-bottom: 1rem; color: #111827; }
        .article-content h2 { font-size: 1.875rem; font-weight: 700; margin-top: 1.5rem; margin-bottom: 1rem; color: #111827; }
        .article-content h3 { font-size: 1.5rem; font-weight: 600; margin-top: 1.25rem; margin-bottom: 0.75rem; color: #111827; }
        .article-content p { margin-bottom: 1.25rem; color: #4B5563; line-height: 1.75; font-size: 1.125rem; }
        .article-content ul { list-style-type: disc; padding-left: 1.5rem; margin-bottom: 1.25rem; color: #4B5563; }
        .article-content ol { list-style-type: decimal; padding-left: 1.5rem; margin-bottom: 1.25rem; color: #4B5563; }
        .article-content blockquote { border-left: 4px solid #10B981; padding-left: 1rem; font-style: italic; color: #6B7280; background: #ECFDF5; padding: 1rem; border-radius: 0.5rem; margin-bottom: 1.25rem; }
        .article-content a { color: #10B981; text-decoration: underline; font-weight: 500; }
        .article-content img { max-width: 100%; height: auto; border-radius: 0.75rem; margin: 1.5rem 0; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1); }
        .article-content table { width: 100%; border-collapse: collapse; margin-bottom: 1.5rem; }
        .article-content th, .article-content td { border: 1px solid #E5E7EB; padding: 0.75rem; text-align: left; }
        .article-content th { background-color: #F9FAFB; font-weight: 600; color: #374151; }
    </style>
@endpush

@section('content')
<main class="pt-24 pb-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 md:px-8">
        
        <!-- Breadcrumbs -->
        <nav class="flex items-center text-sm text-gray-500 font-medium mb-8">
            <a href="{{ route('pmb.landing') }}" class="hover:text-emerald-500 transition-colors">Beranda</a>
            <span class="material-symbols-outlined mx-2 text-[16px]">chevron_right</span>
            <a href="{{ route('public.articles.index') }}" class="hover:text-emerald-500 transition-colors">Artikel</a>
            <span class="material-symbols-outlined mx-2 text-[16px]">chevron_right</span>
            <a href="{{ route('public.articles.category', $article->category->slug) }}" class="hover:text-emerald-500 transition-colors">{{ $article->category->name }}</a>
        </nav>

        <div class="flex flex-col lg:flex-row gap-10">
            <!-- Main Content Area -->
            <div class="lg:w-2/3">
                <article class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden mb-10">
                    <!-- Hero Image -->
                    <div class="relative w-full h-[300px] md:h-[450px] bg-gray-100">
                        <img src="{{ asset('storage/' . $article->thumbnail) }}" alt="{{ $article->title }}" class="w-full h-full object-cover">
                    </div>
                    
                    <div class="p-6 md:p-10">
                        <!-- Meta Info -->
                        <div class="flex flex-wrap items-center gap-4 text-sm text-gray-500 font-medium mb-6">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-emerald-50 text-emerald-600 rounded-lg font-bold">
                                {{ $article->category->name }}
                            </span>
                            <span class="flex items-center gap-1.5"><span class="material-symbols-outlined text-[18px]">calendar_month</span> {{ $article->published_at->format('d M Y, H:i') }}</span>
                            <span class="flex items-center gap-1.5"><span class="material-symbols-outlined text-[18px]">person</span> {{ $article->author->name }}</span>
                            <span class="flex items-center gap-1.5"><span class="material-symbols-outlined text-[18px]">visibility</span> {{ $article->views }} views</span>
                        </div>
                        
                        <!-- Title -->
                        <h1 class="font-display text-3xl md:text-4xl font-extrabold text-gray-900 mb-8 leading-tight">
                            {{ $article->title }}
                        </h1>
                        
                        <!-- Article Content (Rich Text) -->
                        <div class="article-content">
                            {!! $article->content !!}
                        </div>
                    </div>
                </article>

                <!-- Gallery Section (If Exists) -->
                @if($article->images->count() > 0)
                <div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-6 md:p-10 mb-10">
                    <h3 class="font-display text-2xl font-bold text-gray-900 mb-6 flex items-center gap-2">
                        <span class="material-symbols-outlined text-emerald-500">photo_library</span> Galeri Dokumentasi
                    </h3>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                        @foreach($article->images as $img)
                        <a href="{{ asset('storage/' . $img->image) }}" data-lightbox="article-gallery" data-title="{{ $img->caption ?? $article->title }}" class="block rounded-xl overflow-hidden group border border-gray-100 shadow-sm">
                            <div class="relative w-full h-32 md:h-40 bg-gray-100">
                                <img src="{{ asset('storage/' . $img->image) }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                <div class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                    <span class="material-symbols-outlined text-white text-3xl drop-shadow-md">zoom_in</span>
                                </div>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif
                
                <!-- Share Button -->
                <div class="flex items-center justify-between p-6 bg-emerald-50 rounded-2xl border border-emerald-100 mb-10">
                    <span class="font-bold text-emerald-800">Bagikan artikel ini:</span>
                    <div class="flex gap-2">
                        <a href="https://wa.me/?text={{ urlencode($article->title . ' ' . url()->current()) }}" target="_blank" class="w-10 h-10 rounded-full bg-white flex items-center justify-center text-emerald-600 hover:bg-emerald-600 hover:text-white transition-colors shadow-sm">
                            <span class="font-bold">WA</span>
                        </a>
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank" class="w-10 h-10 rounded-full bg-white flex items-center justify-center text-blue-600 hover:bg-blue-600 hover:text-white transition-colors shadow-sm">
                            <span class="font-bold">FB</span>
                        </a>
                    </div>
                </div>

                <!-- Related Articles (Bottom) -->
                @if($relatedArticles->count() > 0)
                <div class="mb-10">
                    <h3 class="font-display text-2xl font-bold text-gray-900 mb-6">Artikel Terkait</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        @foreach($relatedArticles as $related)
                        <a href="{{ route('public.articles.show', $related->slug) }}" class="group bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition-all flex flex-col overflow-hidden">
                            <div class="h-32 bg-gray-100 overflow-hidden">
                                <img src="{{ asset('storage/' . $related->thumbnail) }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            </div>
                            <div class="p-4 flex flex-col flex-1">
                                <span class="text-[10px] font-bold text-emerald-500 uppercase tracking-wider mb-2">{{ $related->category->name }}</span>
                                <h4 class="font-bold text-gray-900 text-sm leading-snug line-clamp-2 group-hover:text-emerald-600 transition-colors mb-2">{{ $related->title }}</h4>
                                <span class="text-xs text-gray-400 mt-auto flex items-center gap-1"><span class="material-symbols-outlined text-[14px]">calendar_month</span> {{ $related->published_at->format('d M Y') }}</span>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="lg:w-1/3 space-y-8">
                <!-- Search -->
                <div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-6">
                    <h3 class="font-bold text-gray-900 mb-4">Cari Artikel</h3>
                    <form action="{{ route('public.articles.index') }}" method="GET" class="relative">
                        <input type="text" name="search" placeholder="Kata kunci..." class="w-full px-4 py-3 pr-12 rounded-xl border border-gray-200 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 outline-none transition-all text-sm">
                        <button type="submit" class="absolute right-2 top-1/2 -translate-y-1/2 w-8 h-8 flex items-center justify-center bg-emerald-50 text-emerald-600 rounded-lg hover:bg-emerald-100 transition-colors">
                            <span class="material-symbols-outlined text-[18px]">search</span>
                        </button>
                    </form>
                </div>

                <!-- Categories -->
                <div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-6">
                    <h3 class="font-bold text-gray-900 mb-4">Kategori</h3>
                    <ul class="space-y-2">
                        @foreach($categories as $cat)
                            @if($cat->articles_count > 0)
                            <li>
                                <a href="{{ route('public.articles.category', $cat->slug) }}" class="flex items-center justify-between py-2 px-3 rounded-xl hover:bg-gray-50 transition-colors group">
                                    <span class="text-sm font-medium text-gray-600 group-hover:text-emerald-600">{{ $cat->name }}</span>
                                    <span class="text-xs font-bold bg-emerald-50 text-emerald-600 px-2 py-1 rounded-lg">{{ $cat->articles_count }}</span>
                                </a>
                            </li>
                            @endif
                        @endforeach
                    </ul>
                </div>

                <!-- Popular Articles -->
                @if($popularArticles->count() > 0)
                <div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-6">
                    <h3 class="font-bold text-gray-900 mb-4 flex items-center gap-2">
                        <span class="material-symbols-outlined text-amber-500">local_fire_department</span> Terpopuler
                    </h3>
                    <div class="space-y-4">
                        @foreach($popularArticles as $popular)
                        <a href="{{ route('public.articles.show', $popular->slug) }}" class="flex gap-4 group">
                            <div class="w-20 h-20 rounded-xl overflow-hidden bg-gray-100 flex-shrink-0">
                                <img src="{{ asset('storage/' . $popular->thumbnail) }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            </div>
                            <div class="flex flex-col justify-center">
                                <h4 class="font-bold text-gray-900 text-sm leading-snug line-clamp-2 group-hover:text-emerald-600 transition-colors mb-1">{{ $popular->title }}</h4>
                                <span class="text-xs font-medium text-gray-400">{{ $popular->published_at->format('d M Y') }} • {{ $popular->views }} views</span>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif
                
                <!-- Recent Articles -->
                @if($recentArticles->count() > 0)
                <div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-6">
                    <h3 class="font-bold text-gray-900 mb-4 flex items-center gap-2">
                        <span class="material-symbols-outlined text-blue-500">schedule</span> Terbaru
                    </h3>
                    <div class="space-y-4">
                        @foreach($recentArticles as $recent)
                        <a href="{{ route('public.articles.show', $recent->slug) }}" class="flex gap-4 group">
                            <div class="w-20 h-20 rounded-xl overflow-hidden bg-gray-100 flex-shrink-0">
                                <img src="{{ asset('storage/' . $recent->thumbnail) }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            </div>
                            <div class="flex flex-col justify-center">
                                <h4 class="font-bold text-gray-900 text-sm leading-snug line-clamp-2 group-hover:text-emerald-600 transition-colors mb-1">{{ $recent->title }}</h4>
                                <span class="text-xs font-medium text-gray-400">{{ $recent->published_at->format('d M Y') }}</span>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif

            </div>
        </div>
    </div>
</main>
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
