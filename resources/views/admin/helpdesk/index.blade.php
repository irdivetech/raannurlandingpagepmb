@extends('layouts.admin')

@section('title', 'Helpdesk | Admin RA AN-NUUR')

@section('styles')
<style>
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(12px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    .fade-in { animation: fadeInUp 0.4s ease both; }
    .badge { display: inline-flex; align-items: center; padding: 2px 10px; border-radius: 9999px; font-size: 11px; font-weight: 700; letter-spacing: .04em; text-transform: uppercase; }
</style>
@endsection

@section('content')
<main class="md:ml-[280px] min-h-screen px-4 md:px-8 py-8 bg-gray-50">

    {{-- Header --}}
    <section class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-8 fade-in">
        <div>
            <nav class="flex items-center text-gray-400 gap-1 mb-2">
                <span class="text-xs">Admin</span>
                <span class="material-symbols-outlined text-sm">chevron_right</span>
                <span class="text-xs font-semibold text-emerald-500">Helpdesk</span>
            </nav>
            <h2 class="font-display text-3xl font-bold text-gray-900">Helpdesk & Tiket</h2>
            <p class="text-gray-500 mt-1 text-sm">Kelola semua tiket bantuan dari orang tua siswa.</p>
        </div>
        <a href="{{ route('admin.helpdesk.dashboard') }}"
           class="inline-flex items-center gap-2 px-5 py-2.5 bg-emerald-500 text-white font-bold text-sm rounded-xl hover:bg-emerald-600 transition-all shadow-md shadow-emerald-500/20">
            <span class="material-symbols-outlined text-lg">bar_chart</span> Dashboard Statistik
        </a>
    </section>

    {{-- Stat Cards --}}
    <section class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8 fade-in" style="animation-delay:.05s">
        <div class="bg-white rounded-2xl p-4 border border-gray-100 shadow-sm text-center">
            <p class="text-2xl font-bold text-gray-900">{{ $stats['total'] }}</p>
            <p class="text-xs font-medium text-gray-400 mt-1 uppercase tracking-wider">Total Tiket</p>
        </div>
        <div class="bg-white rounded-2xl p-4 border border-red-100 shadow-sm text-center">
            <p class="text-2xl font-bold text-red-500">{{ $stats['open'] }}</p>
            <p class="text-xs font-medium text-gray-400 mt-1 uppercase tracking-wider">Open</p>
        </div>
        <div class="bg-white rounded-2xl p-4 border border-amber-100 shadow-sm text-center">
            <p class="text-2xl font-bold text-amber-500">{{ $stats['in_progress'] }}</p>
            <p class="text-xs font-medium text-gray-400 mt-1 uppercase tracking-wider">In Progress</p>
        </div>
        <div class="bg-white rounded-2xl p-4 border border-emerald-100 shadow-sm text-center">
            <p class="text-2xl font-bold text-emerald-500">{{ $stats['resolved'] }}</p>
            <p class="text-xs font-medium text-gray-400 mt-1 uppercase tracking-wider">Resolved</p>
        </div>
    </section>

    {{-- Filters & Search --}}
    <section class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5 mb-6 fade-in" style="animation-delay:.1s">
        <form method="GET" action="{{ route('admin.helpdesk.index') }}" class="flex flex-col md:flex-row gap-3 items-end">
            <div class="flex-1">
                <label class="block text-xs font-semibold text-gray-500 mb-1.5 uppercase tracking-wider">Cari Subjek</label>
                <div class="relative">
                    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-lg">search</span>
                    <input type="text" name="search" value="{{ request('search') }}"
                           placeholder="Cari berdasarkan judul tiket..."
                           class="w-full pl-10 pr-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-emerald-300 focus:border-emerald-400 outline-none transition-all">
                </div>
            </div>
            <div class="w-full md:w-40">
                <label class="block text-xs font-semibold text-gray-500 mb-1.5 uppercase tracking-wider">Status</label>
                <select name="status" class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-emerald-300 focus:border-emerald-400 outline-none">
                    <option value="">Semua Status</option>
                    <option value="open" {{ request('status') === 'open' ? 'selected' : '' }}>Open</option>
                    <option value="in_progress" {{ request('status') === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                    <option value="resolved" {{ request('status') === 'resolved' ? 'selected' : '' }}>Resolved</option>
                    <option value="closed" {{ request('status') === 'closed' ? 'selected' : '' }}>Closed</option>
                </select>
            </div>
            <div class="w-full md:w-40">
                <label class="block text-xs font-semibold text-gray-500 mb-1.5 uppercase tracking-wider">Prioritas</label>
                <select name="priority" class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-emerald-300 focus:border-emerald-400 outline-none">
                    <option value="">Semua Prioritas</option>
                    <option value="high" {{ request('priority') === 'high' ? 'selected' : '' }}>High</option>
                    <option value="medium" {{ request('priority') === 'medium' ? 'selected' : '' }}>Medium</option>
                    <option value="low" {{ request('priority') === 'low' ? 'selected' : '' }}>Low</option>
                </select>
            </div>
            <div class="w-full md:w-44">
                <label class="block text-xs font-semibold text-gray-500 mb-1.5 uppercase tracking-wider">Kategori</label>
                <select name="category" class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-emerald-300 focus:border-emerald-400 outline-none">
                    <option value="">Semua Kategori</option>
                    <option value="teknis" {{ request('category') === 'teknis' ? 'selected' : '' }}>Teknis</option>
                    <option value="akademik" {{ request('category') === 'akademik' ? 'selected' : '' }}>Akademik</option>
                    <option value="informasi" {{ request('category') === 'informasi' ? 'selected' : '' }}>Informasi</option>
                    <option value="lainnya" {{ request('category') === 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                </select>
            </div>
            <div class="flex gap-2">
                <button type="submit" class="px-5 py-2.5 bg-emerald-500 text-white font-bold text-sm rounded-xl hover:bg-emerald-600 transition-all flex items-center gap-1.5">
                    <span class="material-symbols-outlined text-lg">filter_list</span> Filter
                </button>
                @if(request()->hasAny(['search','status','priority','category']))
                <a href="{{ route('admin.helpdesk.index') }}" class="px-4 py-2.5 border border-gray-200 text-gray-500 font-bold text-sm rounded-xl hover:bg-gray-50 transition-all flex items-center gap-1.5">
                    <span class="material-symbols-outlined text-lg">close</span>
                </a>
                @endif
            </div>
        </form>
    </section>

    {{-- Tickets Table --}}
    <section class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden fade-in" style="animation-delay:.15s">
        @if($tickets->count() > 0)
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-gray-100 bg-gray-50/50">
                        <th class="text-left px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider">No</th>
                        <th class="text-left px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider">Subjek</th>
                        <th class="text-left px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider">Reporter</th>
                        <th class="text-left px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider">Kategori</th>
                        <th class="text-left px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider">Prioritas</th>
                        <th class="text-left px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider">Status</th>
                        <th class="text-left px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider">Tanggal</th>
                        <th class="text-left px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @foreach($tickets as $i => $ticket)
                    <tr class="hover:bg-gray-50/50 transition-colors group">
                        <td class="px-6 py-4 text-sm text-gray-400 font-medium">{{ $tickets->firstItem() + $i }}</td>
                        <td class="px-6 py-4">
                            <p class="font-semibold text-gray-800 text-sm line-clamp-1 max-w-[200px]">{{ $ticket->subject }}</p>
                            <p class="text-xs text-gray-400 mt-0.5">ID #{{ $ticket->id }}</p>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2">
                                <div class="w-7 h-7 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-600 text-xs font-bold flex-shrink-0">
                                    {{ strtoupper(substr($ticket->reporter->name ?? '?', 0, 1)) }}
                                </div>
                                <span class="text-sm text-gray-700 font-medium">{{ $ticket->reporter->name ?? '-' }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            @php
                                $catColors = ['teknis'=>'bg-blue-100 text-blue-700','akademik'=>'bg-violet-100 text-violet-700','informasi'=>'bg-sky-100 text-sky-700','lainnya'=>'bg-gray-100 text-gray-600'];
                                $catColor = $catColors[$ticket->category] ?? 'bg-gray-100 text-gray-600';
                            @endphp
                            <span class="badge {{ $catColor }}">{{ $ticket->category_label }}</span>
                        </td>
                        <td class="px-6 py-4">
                            @if($ticket->priority === 'high')
                                <span class="badge bg-red-100 text-red-600">High</span>
                            @elseif($ticket->priority === 'medium')
                                <span class="badge bg-amber-100 text-amber-700">Medium</span>
                            @else
                                <span class="badge bg-emerald-100 text-emerald-700">Low</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            @if($ticket->status === 'open')
                                <span class="badge bg-red-100 text-red-600">Open</span>
                            @elseif($ticket->status === 'in_progress')
                                <span class="badge bg-amber-100 text-amber-700">In Progress</span>
                            @elseif($ticket->status === 'resolved')
                                <span class="badge bg-emerald-100 text-emerald-700">Resolved</span>
                            @else
                                <span class="badge bg-gray-100 text-gray-500">Closed</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-400">
                            {{ $ticket->created_at->format('d M Y') }}
                        </td>
                        <td class="px-6 py-4">
                            <a href="{{ route('admin.helpdesk.show', $ticket) }}"
                               class="inline-flex items-center gap-1.5 px-3.5 py-1.5 bg-emerald-50 text-emerald-600 font-bold text-xs rounded-lg hover:bg-emerald-100 transition-all group-hover:shadow-sm">
                                <span class="material-symbols-outlined text-sm">visibility</span> Lihat
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{-- Pagination --}}
        @if($tickets->hasPages())
        <div class="px-6 py-4 border-t border-gray-100">
            {{ $tickets->links() }}
        </div>
        @endif
        @else
        {{-- Empty State --}}
        <div class="py-20 text-center">
            <div class="w-20 h-20 bg-emerald-50 rounded-3xl flex items-center justify-center mx-auto mb-5">
                <span class="material-symbols-outlined text-4xl text-emerald-300">inbox</span>
            </div>
            <h3 class="font-display text-xl font-bold text-gray-700 mb-2">Belum Ada Tiket</h3>
            <p class="text-gray-400 text-sm">Belum ada tiket yang masuk atau sesuai filter yang dipilih.</p>
        </div>
        @endif
    </section>

</main>
@endsection
