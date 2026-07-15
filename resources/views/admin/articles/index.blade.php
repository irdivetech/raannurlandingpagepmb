@extends('layouts.admin')

@section('title', 'Artikel & Berita | Admin RA AN-NUUR')

@section('content')
<main class="md:ml-[280px] min-h-screen px-4 md:px-8 py-8 bg-gray-50">
    <section class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div>
            <nav class="flex items-center text-gray-400 gap-1 mb-2">
                <a href="{{ route('admin.dashboard') }}" class="text-xs hover:text-emerald-500">Admin Panel</a>
                <span class="material-symbols-outlined text-sm">chevron_right</span>
                <span class="text-xs font-semibold text-emerald-500">Artikel & Berita</span>
            </nav>
            <h2 class="font-display text-2xl md:text-3xl font-bold text-gray-900">Kelola Artikel</h2>
        </div>
        <div>
            <a href="{{ route('admin.articles.create') }}" class="px-4 py-2 bg-emerald-500 text-white font-bold text-sm rounded-xl hover:bg-emerald-600 transition-all flex items-center gap-2 shadow-md shadow-emerald-500/20">
                <span class="material-symbols-outlined text-[18px]">add</span> Tambah Artikel
            </a>
        </div>
    </section>

    @if(session('success'))
    <div class="mb-6 p-4 text-sm text-emerald-700 rounded-2xl bg-emerald-50 border border-emerald-200 flex items-center gap-2">
        <span class="material-symbols-outlined text-emerald-500">check_circle</span> {{ session('success') }}
    </div>
    @endif

    <!-- Filters & Search -->
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-4 mb-6">
        <form action="{{ route('admin.articles.index') }}" method="GET" class="flex flex-col md:flex-row gap-4">
            <div class="flex-grow">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari judul artikel..." class="w-full px-4 py-2 rounded-xl border border-gray-200 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none text-sm">
            </div>
            <div class="w-full md:w-48">
                <select name="category_id" class="w-full px-4 py-2 rounded-xl border border-gray-200 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none text-sm">
                    <option value="">Semua Kategori</option>
                    @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="w-full md:w-40">
                <select name="status" class="w-full px-4 py-2 rounded-xl border border-gray-200 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none text-sm">
                    <option value="">Semua Status</option>
                    <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>Published</option>
                    <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                </select>
            </div>
            <div>
                <button type="submit" class="w-full md:w-auto px-6 py-2 bg-gray-900 text-white font-bold text-sm rounded-xl hover:bg-gray-800 transition-all flex items-center justify-center gap-2">
                    <span class="material-symbols-outlined text-[18px]">search</span> Filter
                </button>
            </div>
        </form>
    </div>

    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-gray-50/80 border-b border-gray-100">
                        <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider w-20">Thumbnail</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider">Judul Artikel</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider">Kategori</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider">Views</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($articles as $article)
                    <tr class="hover:bg-gray-50/50 transition-colors">
                        <td class="px-6 py-4">
                            <img src="{{ asset('storage/' . $article->thumbnail) }}" alt="Thumbnail" class="w-12 h-12 rounded-lg object-cover">
                        </td>
                        <td class="px-6 py-4">
                            <p class="font-bold text-gray-800 line-clamp-1">{{ $article->title }}</p>
                            <p class="text-xs text-gray-400">{{ $article->published_at ? $article->published_at->format('d M Y') : '-' }}</p>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500">
                            {{ $article->category->name }}
                        </td>
                        <td class="px-6 py-4">
                            @if($article->status == 'published')
                                <span class="inline-flex px-2 py-1 bg-emerald-50 text-emerald-600 text-xs font-bold rounded-lg border border-emerald-200">Published</span>
                            @else
                                <span class="inline-flex px-2 py-1 bg-amber-50 text-amber-600 text-xs font-bold rounded-lg border border-amber-200">Draft</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500 font-bold">
                            {{ number_format($article->views) }}
                        </td>
                        <td class="px-6 py-4 flex items-center justify-end gap-2">
                            <a href="{{ route('public.articles.show', $article->slug) }}" target="_blank" class="p-2 text-gray-500 bg-gray-50 hover:bg-gray-100 rounded-lg transition-colors" title="Lihat">
                                <span class="material-symbols-outlined text-[18px]">visibility</span>
                            </a>
                            <a href="{{ route('admin.articles.edit', $article->id) }}" class="p-2 text-blue-500 bg-blue-50 hover:bg-blue-100 rounded-lg transition-colors" title="Edit">
                                <span class="material-symbols-outlined text-[18px]">edit</span>
                            </a>
                            <form action="{{ route('admin.articles.destroy', $article->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus artikel ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 text-rose-500 bg-rose-50 hover:bg-rose-100 rounded-lg transition-colors" title="Hapus">
                                    <span class="material-symbols-outlined text-[18px]">delete</span>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-10 text-center text-gray-500">
                            Belum ada artikel ditemukan.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 border-t border-gray-100">
            {{ $articles->links() }}
        </div>
    </div>
</main>
@endsection
