@extends('layouts.admin')

@section('title', 'Helpdesk Dashboard | Admin RA AN-NUUR')

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
                <a href="{{ route('admin.helpdesk.index') }}" class="text-xs hover:text-emerald-500 transition-colors">Helpdesk</a>
                <span class="material-symbols-outlined text-sm">chevron_right</span>
                <span class="text-xs font-semibold text-emerald-500">Dashboard</span>
            </nav>
            <h2 class="font-display text-2xl md:text-3xl font-bold text-gray-900">Statistik Helpdesk</h2>
            <p class="text-gray-500 mt-1 text-sm">Ringkasan performa dan tiket yang membutuhkan perhatian.</p>
        </div>
        <a href="{{ route('admin.helpdesk.index') }}"
           class="inline-flex items-center gap-2 px-5 py-2.5 bg-white border border-gray-200 text-gray-600 font-bold text-sm rounded-xl hover:bg-gray-50 transition-all shadow-sm">
            <span class="material-symbols-outlined text-lg">arrow_back</span> Kembali ke Daftar Tiket
        </a>
    </section>

    {{-- Stat Cards --}}
    <section class="grid grid-cols-2 md:grid-cols-5 gap-4 mb-8 fade-in" style="animation-delay:.05s">
        <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm">
            <p class="text-xs font-medium text-gray-400 mb-1 uppercase tracking-wider">Total Tiket</p>
            <p class="text-3xl font-bold text-gray-900">{{ $stats['total'] }}</p>
        </div>
        <div class="bg-white rounded-2xl p-5 border border-red-100 shadow-sm relative overflow-hidden">
            <div class="absolute right-0 top-0 w-16 h-16 bg-red-50 rounded-bl-full flex items-start justify-end p-3 text-red-200">
                <span class="material-symbols-outlined text-3xl">mark_email_unread</span>
            </div>
            <p class="text-xs font-medium text-gray-400 mb-1 uppercase tracking-wider">Open</p>
            <p class="text-3xl font-bold text-red-500 relative z-10">{{ $stats['open'] }}</p>
        </div>
        <div class="bg-white rounded-2xl p-5 border border-amber-100 shadow-sm">
            <p class="text-xs font-medium text-gray-400 mb-1 uppercase tracking-wider">In Progress</p>
            <p class="text-3xl font-bold text-amber-500">{{ $stats['in_progress'] }}</p>
        </div>
        <div class="bg-white rounded-2xl p-5 border border-emerald-100 shadow-sm">
            <p class="text-xs font-medium text-gray-400 mb-1 uppercase tracking-wider">Resolved</p>
            <p class="text-3xl font-bold text-emerald-500">{{ $stats['resolved'] }}</p>
        </div>
        <div class="bg-white rounded-2xl p-5 border border-gray-200 shadow-sm">
            <p class="text-xs font-medium text-gray-400 mb-1 uppercase tracking-wider">Avg Response</p>
            <div class="flex items-baseline gap-1">
                <p class="text-3xl font-bold text-blue-500">{{ round($avgResponse ?? 0, 1) }}</p>
                <span class="text-sm text-gray-500 font-medium">Jam</span>
            </div>
        </div>
    </section>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 fade-in" style="animation-delay:.1s">
        {{-- Chart --}}
        <div class="lg:col-span-2 bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
            <h3 class="font-bold text-gray-900 mb-6 flex items-center gap-2">
                <span class="material-symbols-outlined text-lg text-blue-500">show_chart</span> Tren Tiket (7 Hari Terakhir)
            </h3>
            <div class="h-[300px] w-full">
                <canvas id="ticketsChart"></canvas>
            </div>
        </div>

        {{-- Recent Open Tickets --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 flex flex-col h-full">
            <h3 class="font-bold text-gray-900 mb-6 flex items-center gap-2">
                <span class="material-symbols-outlined text-lg text-red-500">warning</span> Butuh Perhatian (Open)
            </h3>
            
            <div class="space-y-4 flex-1">
                @forelse($recentTickets as $ticket)
                <a href="{{ route('admin.helpdesk.show', $ticket) }}" class="block p-4 rounded-xl border border-gray-100 hover:border-emerald-300 hover:bg-emerald-50/50 transition-all group">
                    <div class="flex justify-between items-start mb-2">
                        <span class="badge bg-red-100 text-red-600">Open</span>
                        <span class="text-xs text-gray-400">{{ $ticket->created_at->diffForHumans() }}</span>
                    </div>
                    <h4 class="font-bold text-gray-800 text-sm mb-1 line-clamp-1 group-hover:text-emerald-700 transition-colors">{{ $ticket->subject }}</h4>
                    <p class="text-xs text-gray-500 line-clamp-1">Dari: {{ $ticket->reporter->name ?? 'Unknown' }}</p>
                </a>
                @empty
                <div class="text-center py-10">
                    <div class="w-16 h-16 bg-emerald-50 rounded-full flex items-center justify-center mx-auto mb-3">
                        <span class="material-symbols-outlined text-3xl text-emerald-400">task_alt</span>
                    </div>
                    <p class="text-sm font-medium text-gray-500">Bagus! Tidak ada tiket berstatus open saat ini.</p>
                </div>
                @endforelse
            </div>
            
            @if($recentTickets->count() > 0)
            <div class="mt-4 pt-4 border-t border-gray-100">
                <a href="{{ route('admin.helpdesk.index', ['status' => 'open']) }}" class="text-sm font-bold text-emerald-500 hover:text-emerald-600 transition-colors flex items-center justify-center gap-1">
                    Lihat Semua Tiket Open <span class="material-symbols-outlined text-lg">arrow_forward</span>
                </a>
            </div>
            @endif
        </div>
    </div>

</main>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('ticketsChart').getContext('2d');
    
    // Siapkan data dari controller
    const labels = {!! json_encode($ticketsPerDay->pluck('date')->map(function($date) { return \Carbon\Carbon::parse($date)->format('d M'); })) !!};
    const data = {!! json_encode($ticketsPerDay->pluck('total')) !!};
    
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Tiket Baru',
                data: data,
                borderColor: '#10B981', // emerald-500
                backgroundColor: 'rgba(16, 185, 129, 0.1)',
                borderWidth: 3,
                tension: 0.4,
                fill: true,
                pointBackgroundColor: '#ffffff',
                pointBorderColor: '#10B981',
                pointBorderWidth: 2,
                pointRadius: 4,
                pointHoverRadius: 6
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: '#1F2937',
                    titleFont: { family: 'Outfit', size: 13 },
                    bodyFont: { family: 'Outfit', size: 14, weight: 'bold' },
                    padding: 12,
                    cornerRadius: 8,
                    displayColors: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1,
                        font: { family: 'Outfit' }
                    },
                    grid: {
                        color: '#F3F4F6',
                        drawBorder: false
                    }
                },
                x: {
                    ticks: {
                        font: { family: 'Outfit' }
                    },
                    grid: {
                        display: false,
                        drawBorder: false
                    }
                }
            },
            interaction: {
                intersect: false,
                mode: 'index',
            },
        }
    });
});
</script>
@endsection
