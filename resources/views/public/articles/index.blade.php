@extends('layouts.app')

@section('title', isset($category) ? 'Kategori: ' . $category->name . ' | RA AN-NUUR' : 'Artikel & Berita | RA AN-NUUR')

@section('content')
<!-- Header Section -->
<section class="pt-32 pb-16 bg-gradient-to-br from-emerald-50 via-white to-emerald-50/50 relative overflow-hidden">
    <div class="absolute inset-0 bg-[url('{{ asset('assets/img/pattern.svg') }}')] opacity-5"></div>
    <div class="max-w-7xl mx-auto px-4 md:px-8 relative z-10">
        <div class="text-center max-w-3xl mx-auto">
            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-emerald-100 text-emerald-700 text-sm font-bold mb-4 border border-emerald-200">
                <span class="material-symbols-outlined text-[16px]">newspaper</span>
                Info RA AN-NUUR
            </span>
            <h1 class="font-display text-4xl md:text-5xl font-extrabold text-gray-900 mb-6 leading-tight">
                {{ isset($category) ? 'Kategori: ' . $category->name : 'Artikel & Berita Terbaru' }}
            </h1>
            <p class="text-lg text-gray-600 mb-8 leading-relaxed">
                Temukan informasi terbaru, pengumuman, dan dokumentasi kegiatan dari RA AN-NUUR.
            </p>

            <!-- Search Bar -->
            <form action="{{ route('public.articles.index') }}" method="GET" class="max-w-xl mx-auto relative group">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari artikel..." class="w-full px-6 py-4 pr-14 rounded-2xl border-2 border-emerald-100 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 transition-all outline-none text-gray-700 shadow-sm group-hover:shadow-md bg-white/80 backdrop-blur-sm">
                <button type="submit" class="absolute right-3 top-1/2 -translate-y-1/2 w-10 h-10 flex items-center justify-center bg-emerald-500 text-white rounded-xl hover:bg-emerald-600 transition-colors shadow-sm">
                    <span class="material-symbols-outlined">search</span>
                </button>
            </form>
        </div>
    </div>
</section>

<!-- Main Content -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 md:px-8">
        
        <!-- Category Filter -->
        <div class="flex flex-wrap items-center justify-center gap-3 mb-12">
            <a href="{{ route('public.articles.index') }}" class="px-5 py-2.5 rounded-xl font-bold text-sm transition-all {{ !isset($category) ? 'bg-emerald-500 text-white shadow-md shadow-emerald-500/20' : 'bg-gray-50 text-gray-600 hover:bg-gray-100 border border-gray-100' }}">
                Semua Artikel
            </a>
            @foreach($categories as $cat)
                @if($cat->articles_count > 0)
                <a href="{{ route('public.articles.category', $cat->slug) }}" class="px-5 py-2.5 rounded-xl font-bold text-sm transition-all {{ isset($category) && $category->id == $cat->id ? 'bg-emerald-500 text-white shadow-md shadow-emerald-500/20' : 'bg-gray-50 text-gray-600 hover:bg-gray-100 border border-gray-100' }}">
                    {{ $cat->name }} <span class="ml-1 opacity-70">({{ $cat->articles_count }})</span>
                </a>
                @endif
            @endforeach
        </div>

        @if($articles->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($articles as $article)
                <a href="{{ route('public.articles.show', $article->slug) }}" class="group bg-white rounded-3xl border border-gray-100 shadow-[0_4px_20px_rgba(0,0,0,0.03)] hover:shadow-[0_8px_30px_rgba(16,185,129,0.1)] transition-all duration-300 flex flex-col overflow-hidden hover:-translate-y-1">
                    <!-- Thumbnail -->
                    <div class="relative h-56 overflow-hidden bg-gray-100">
                        <img src="{{ asset('storage/' . $article->thumbnail) }}" alt="{{ $article->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute top-4 left-4">
                            <span class="px-3 py-1 bg-white/90 backdrop-blur-sm text-emerald-600 text-xs font-bold rounded-lg shadow-sm">
                                {{ $article->category->name }}
                            </span>
                        </div>
                    </div>
                    
                    <!-- Content -->
                    <div class="p-6 flex-1 flex flex-col">
                        <div class="flex items-center gap-3 text-xs text-gray-500 font-medium mb-3">
                            <span class="flex items-center gap-1"><span class="material-symbols-outlined text-[16px]">calendar_month</span> {{ $article->published_at->format('d M Y') }}</span>
                            <span class="w-1 h-1 rounded-full bg-gray-300"></span>
                            <span class="flex items-center gap-1"><span class="material-symbols-outlined text-[16px]">visibility</span> {{ $article->views }} views</span>
                        </div>
                        
                        <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-emerald-600 transition-colors line-clamp-2 leading-snug">
                            {{ $article->title }}
                        </h3>
                        
                        <p class="text-gray-600 text-sm line-clamp-3 mb-6 flex-1">
                            {{ $article->excerpt }}
                        </p>
                        
                        <div class="flex items-center text-emerald-500 font-bold text-sm mt-auto group-hover:gap-2 transition-all">
                            Baca Selengkapnya <span class="material-symbols-outlined text-[18px] ml-1">arrow_forward</span>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-16 flex justify-center">
                {{ $articles->links() }}
            </div>
        @else
            <div class="text-center py-16 bg-gray-50 rounded-3xl border border-gray-100">
                <span class="material-symbols-outlined text-6xl text-gray-300 mb-4">article</span>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Belum Ada Artikel</h3>
                <p class="text-gray-500">Artikel tidak ditemukan atau belum ada artikel yang dipublikasikan.</p>
            </div>
        @endif
    </div>
</section>
@endsection
