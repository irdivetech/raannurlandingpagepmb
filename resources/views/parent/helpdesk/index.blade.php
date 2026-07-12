@extends('layouts.parent')

@section('title', 'Pusat Bantuan (Helpdesk) | RA AN-NUUR')

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
                <span class="text-xs">Portal</span>
                <span class="material-symbols-outlined text-sm">chevron_right</span>
                <span class="text-xs font-semibold text-emerald-500">Pusat Bantuan</span>
            </nav>
            <h2 class="font-display text-3xl md:text-4xl font-bold text-gray-900">Pusat Bantuan</h2>
            <p class="text-gray-500 mt-1">Sampaikan keluhan atau pertanyaan Anda terkait proses pendaftaran.</p>
        </div>
        <a href="{{ route('parent.helpdesk.create') }}" class="px-5 py-2.5 bg-emerald-500 text-white font-bold text-sm rounded-xl hover:bg-emerald-600 transition-all flex items-center gap-2 shadow-md shadow-emerald-500/20 w-fit">
            <span class="material-symbols-outlined text-lg">add_circle</span> Buat Tiket Baru
        </a>
    </section>

    {{-- Tickets Table / Grid --}}
    <section class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden fade-in" style="animation-delay:.1s">
        @if($tickets->count() > 0)
        
        <div class="hidden md:block overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-gray-100 bg-gray-50/50">
                        <th class="text-left px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider">ID</th>
                        <th class="text-left px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider">Subjek</th>
                        <th class="text-left px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider">Kategori</th>
                        <th class="text-left px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider">Status</th>
                        <th class="text-left px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider">Tanggal</th>
                        <th class="text-left px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @foreach($tickets as $ticket)
                    <tr class="hover:bg-gray-50/50 transition-colors group">
                        <td class="px-6 py-4 text-sm text-gray-400 font-medium">#{{ $ticket->id }}</td>
                        <td class="px-6 py-4">
                            <p class="font-semibold text-gray-800 text-sm line-clamp-1">{{ $ticket->subject }}</p>
                        </td>
                        <td class="px-6 py-4">
                            @php
                                $catColors = ['teknis'=>'bg-blue-100 text-blue-700','akademik'=>'bg-violet-100 text-violet-700','informasi'=>'bg-sky-100 text-sky-700','lainnya'=>'bg-gray-100 text-gray-600'];
                                $catColor = $catColors[$ticket->category] ?? 'bg-gray-100 text-gray-600';
                            @endphp
                            <span class="badge {{ $catColor }}">{{ $ticket->category_label }}</span>
                        </td>
                        <td class="px-6 py-4">
                            @if($ticket->status === 'open')
                                <span class="badge bg-red-100 text-red-600">Open</span>
                            @elseif($ticket->status === 'in_progress')
                                <span class="badge bg-amber-100 text-amber-700">In Progress</span>
                            @elseif($ticket->status === 'resolved')
                                <span class="badge bg-emerald-100 text-emerald-700">Selesai</span>
                            @else
                                <span class="badge bg-gray-100 text-gray-500">Ditutup</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-400">
                            {{ $ticket->created_at->translatedFormat('d M Y') }}
                        </td>
                        <td class="px-6 py-4">
                            <a href="{{ route('parent.helpdesk.show', $ticket) }}"
                               class="inline-flex items-center gap-1.5 px-3.5 py-1.5 bg-emerald-50 text-emerald-600 font-bold text-xs rounded-lg hover:bg-emerald-100 transition-all group-hover:shadow-sm">
                                Lihat Detail <span class="material-symbols-outlined text-sm">arrow_forward</span>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Mobile View Cards --}}
        <div class="md:hidden divide-y divide-gray-50">
            @foreach($tickets as $ticket)
            <div class="p-4">
                <div class="flex justify-between items-start mb-2">
                    <span class="text-xs font-bold text-gray-400">#{{ $ticket->id }}</span>
                    @if($ticket->status === 'open')
                        <span class="badge bg-red-100 text-red-600">Open</span>
                    @elseif($ticket->status === 'in_progress')
                        <span class="badge bg-amber-100 text-amber-700">In Progress</span>
                    @elseif($ticket->status === 'resolved')
                        <span class="badge bg-emerald-100 text-emerald-700">Selesai</span>
                    @else
                        <span class="badge bg-gray-100 text-gray-500">Ditutup</span>
                    @endif
                </div>
                <h4 class="font-bold text-gray-800 text-sm mb-3">{{ $ticket->subject }}</h4>
                <div class="flex justify-between items-center mt-3">
                    <span class="text-xs text-gray-400">{{ $ticket->created_at->translatedFormat('d M Y') }}</span>
                    <a href="{{ route('parent.helpdesk.show', $ticket) }}" class="text-emerald-500 text-sm font-bold flex items-center gap-1">
                        Lihat <span class="material-symbols-outlined text-lg">arrow_forward</span>
                    </a>
                </div>
            </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        @if($tickets->hasPages())
        <div class="px-6 py-4 border-t border-gray-100">
            {{ $tickets->links() }}
        </div>
        @endif

        @else
        {{-- Empty State --}}
        <div class="py-24 text-center px-4">
            <div class="w-24 h-24 bg-emerald-50 rounded-full flex items-center justify-center mx-auto mb-6 relative">
                <span class="material-symbols-outlined text-5xl text-emerald-300">support_agent</span>
                <div class="absolute -bottom-2 -right-2 w-10 h-10 bg-white rounded-full flex items-center justify-center shadow-sm">
                    <span class="material-symbols-outlined text-amber-400 text-xl" style="font-variation-settings:'FILL' 1;">help</span>
                </div>
            </div>
            <h3 class="font-display text-2xl font-bold text-gray-800 mb-2">Butuh Bantuan?</h3>
            <p class="text-gray-500 text-sm max-w-md mx-auto mb-6 leading-relaxed">Jika Anda mengalami kendala teknis atau memiliki pertanyaan seputar pendaftaran, jangan ragu untuk membuat tiket bantuan. Tim kami siap membantu.</p>
            <a href="{{ route('parent.helpdesk.create') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-emerald-500 text-white font-bold text-sm rounded-xl hover:bg-emerald-600 transition-all shadow-md shadow-emerald-500/20 hover:-translate-y-0.5">
                <span class="material-symbols-outlined text-lg">add_circle</span> Buat Tiket Sekarang
            </a>
        </div>
        @endif
    </section>

</main>
@endsection
