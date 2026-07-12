@extends('layouts.admin')

@section('title', 'Laporan & Statistik | Admin RA AN-NUUR')

@section('content')
<main class="md:ml-[280px] min-h-screen px-4 md:px-8 py-8 bg-gray-50">

    <!-- Header & Breadcrumbs -->
    <section class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-8">
        <div>
            <nav class="flex items-center text-gray-400 gap-1 mb-2">
                <span class="text-xs">Admin Panel</span>
                <span class="material-symbols-outlined text-sm">chevron_right</span>
                <span class="text-xs font-semibold text-emerald-500">Laporan</span>
            </nav>
            <h2 class="font-display text-3xl md:text-4xl font-bold text-gray-900">Laporan & Statistik</h2>
            <p class="text-gray-500 mt-1">Ringkasan data Penerimaan Siswa Baru (PMB)</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.reports.export') }}" class="flex items-center gap-2 bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-2.5 rounded-xl text-sm font-bold hover:bg-emerald-100 transition-colors shadow-sm hidden md:flex">
                <span class="material-symbols-outlined text-[16px]">download</span> Export Excel/CSV
            </a>
            <button onclick="window.print()" class="flex items-center gap-2 bg-white border border-gray-200 text-gray-600 px-4 py-2.5 rounded-xl text-sm font-bold hover:bg-gray-50 transition-colors shadow-sm">
                <span class="material-symbols-outlined text-[16px]">print</span> Cetak PDF
            </button>
        </div>
    </section>

    <!-- Stat Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5 mb-6">
        <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm flex flex-col justify-center">
            <div class="w-12 h-12 rounded-xl bg-blue-50 flex items-center justify-center mb-4">
                <span class="material-symbols-outlined text-blue-500 text-[24px]">group_add</span>
            </div>
            <p class="text-3xl font-extrabold text-gray-900 mb-1">{{ $total }}</p>
            <p class="text-sm text-gray-500 font-medium">Total Pendaftar</p>
        </div>
        <div class="bg-white rounded-2xl p-6 border border-emerald-100 shadow-sm flex flex-col justify-center relative overflow-hidden">
            <div class="absolute -right-4 -top-4 w-24 h-24 bg-emerald-50 rounded-full opacity-50"></div>
            <div class="w-12 h-12 rounded-xl bg-emerald-50 flex items-center justify-center mb-4 relative z-10">
                <span class="material-symbols-outlined text-emerald-500 text-[24px]">verified</span>
            </div>
            <p class="text-3xl font-extrabold text-gray-900 mb-1 relative z-10">{{ $statusCounts['accepted'] ?? 0 }}</p>
            <p class="text-sm text-gray-500 font-medium relative z-10">Diterima</p>
            <p class="text-xs text-emerald-600 font-bold mt-2 relative z-10 bg-emerald-50 inline-block px-2 py-0.5 rounded">{{ $total > 0 ? round((($statusCounts['accepted'] ?? 0) / $total) * 100) : 0 }}% dari total</p>
        </div>
        <div class="bg-white rounded-2xl p-6 border border-amber-100 shadow-sm flex flex-col justify-center relative overflow-hidden">
            <div class="absolute -right-4 -top-4 w-24 h-24 bg-amber-50 rounded-full opacity-50"></div>
            <div class="w-12 h-12 rounded-xl bg-amber-50 flex items-center justify-center mb-4 relative z-10">
                <span class="material-symbols-outlined text-amber-500 text-[24px]">pending_actions</span>
            </div>
            @php $proses = ($statusCounts['pending'] ?? 0) + ($statusCounts['verifying'] ?? 0); @endphp
            <p class="text-3xl font-extrabold text-gray-900 mb-1 relative z-10">{{ $proses }}</p>
            <p class="text-sm text-gray-500 font-medium relative z-10">Sedang Diproses</p>
            <p class="text-xs text-amber-600 font-bold mt-2 relative z-10 bg-amber-50 inline-block px-2 py-0.5 rounded">{{ $total > 0 ? round(($proses / $total) * 100) : 0 }}% dari total</p>
        </div>
        <div class="bg-white rounded-2xl p-6 border border-red-100 shadow-sm flex flex-col justify-center relative overflow-hidden">
            <div class="absolute -right-4 -top-4 w-24 h-24 bg-red-50 rounded-full opacity-50"></div>
            <div class="w-12 h-12 rounded-xl bg-red-50 flex items-center justify-center mb-4 relative z-10">
                <span class="material-symbols-outlined text-red-500 text-[24px]">cancel</span>
            </div>
            <p class="text-3xl font-extrabold text-gray-900 mb-1 relative z-10">{{ $statusCounts['rejected'] ?? 0 }}</p>
            <p class="text-sm text-gray-500 font-medium relative z-10">Ditolak / Batal</p>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
        <!-- Gender Doughnut -->
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 flex flex-col">
            <h3 class="font-bold text-gray-800 text-base mb-1 flex items-center gap-2">
                <span class="material-symbols-outlined text-[20px] text-emerald-500">wc</span> Demografi Jenis Kelamin
            </h3>
            <p class="text-xs text-gray-500 mb-6">Distribusi calon siswa berdasarkan jenis kelamin</p>
            <div class="relative h-64 flex-1 flex items-center justify-center">
                <canvas id="genderChart"></canvas>
            </div>
        </div>

        <!-- Age Group Doughnut -->
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 flex flex-col">
            <h3 class="font-bold text-gray-800 text-base mb-1 flex items-center gap-2">
                <span class="material-symbols-outlined text-[20px] text-blue-500">escalator_warning</span> Kategori Kelompok Usia
            </h3>
            <p class="text-xs text-gray-500 mb-6">Distribusi calon siswa berdasarkan kelompok usia</p>
            <div class="relative h-64 flex-1 flex items-center justify-center">
                <canvas id="ageChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Trend Chart (Full Width) -->
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 mb-8">
        <h3 class="font-bold text-gray-800 text-base mb-1 flex items-center gap-2">
            <span class="material-symbols-outlined text-[20px] text-purple-500">trending_up</span> Tren Pendaftaran
        </h3>
        <p class="text-xs text-gray-500 mb-6">Jumlah pendaftar baru dalam 7 hari terakhir</p>
        <div class="relative h-72 w-full">
            <canvas id="trendChart"></canvas>
        </div>
    </div>

</main>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {

        // Shared tooltip config
        const tooltipDefaults = {
            backgroundColor: '#111827',
            titleFont: { family: 'Outfit, sans-serif', size: 12 },
            bodyFont: { family: 'Outfit, sans-serif', size: 13, weight: 'bold' },
            padding: 10,
        };

        // Gender Doughnut
        new Chart(document.getElementById('genderChart'), {
            type: 'doughnut',
            data: {
                labels: ['Laki-laki', 'Perempuan'],
                datasets: [{ data: [{{ $genderCounts['L'] ?? 0 }}, {{ $genderCounts['P'] ?? 0 }}], backgroundColor: ['#10B981', '#3b82f6'], borderWidth: 0, hoverOffset: 6 }]
            },
            options: {
                responsive: true, maintainAspectRatio: false, cutout: '72%',
                plugins: {
                    legend: { position: 'bottom', labels: { font: { family: 'Outfit, sans-serif', size: 13 }, padding: 20, usePointStyle: true } },
                    tooltip: { ...tooltipDefaults, displayColors: true, callbacks: { label: ctx => ' ' + ctx.parsed + ' Siswa' } }
                }
            }
        });

        // Age Doughnut
        new Chart(document.getElementById('ageChart'), {
            type: 'doughnut',
            data: {
                labels: ['Kelompok A (<5 Thn)', 'Kelompok B (≥5 Thn)'],
                datasets: [{ data: [{{ $kelompokA }}, {{ $kelompokB }}], backgroundColor: ['#f59e0b', '#10B981'], borderWidth: 0, hoverOffset: 6 }]
            },
            options: {
                responsive: true, maintainAspectRatio: false, cutout: '72%',
                plugins: {
                    legend: { position: 'bottom', labels: { font: { family: 'Outfit, sans-serif', size: 13 }, padding: 20, usePointStyle: true } },
                    tooltip: { ...tooltipDefaults, displayColors: true, callbacks: { label: ctx => ' ' + ctx.parsed + ' Siswa' } }
                }
            }
        });

        // 7-Day Trend Bar
        const rawTrends = @json($trends);
        new Chart(document.getElementById('trendChart'), {
            type: 'bar',
            data: {
                labels: rawTrends.map(t => t.date),
                datasets: [{ label: 'Pendaftar Baru', data: rawTrends.map(t => t.count), backgroundColor: '#10B981', borderRadius: 8, borderSkipped: false, barPercentage: 0.55 }]
            },
            options: {
                responsive: true, maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: { ...tooltipDefaults, displayColors: false, callbacks: { label: ctx => ctx.parsed.y + ' Pendaftar' } }
                },
                scales: {
                    x: { grid: { display: false }, ticks: { font: { family: 'Outfit, sans-serif', size: 12 }, color: '#9ca3af' } },
                    y: { beginAtZero: true, grid: { color: '#f3f4f6', borderDash: [4, 4] }, ticks: { font: { family: 'Outfit, sans-serif', size: 12 }, color: '#9ca3af', precision: 0 } }
                }
            }
        });
    });
</script>
<style>
    @media print {
        /* Reset everything */
        * { -webkit-print-color-adjust: exact !important; print-color-adjust: exact !important; }
        
        body { 
            background: white !important; 
            margin: 0 !important; 
            padding: 0 !important;
            font-family: 'Outfit', sans-serif !important;
            font-size: 10pt !important;
            color: #111 !important;
        }
        
        /* Hide nav, sidebar, footer, buttons */
        aside, header, footer, nav, 
        .material-symbols-outlined,
        a[href], button { display: none !important; }
        
        /* Reset main content area */
        .md\:ml-\[280px\] { margin-left: 0 !important; }
        main { display: block !important; background: white !important; padding: 0 !important; margin: 20px !important;}
        
        /* Content area */
        .mb-6, .mb-8 { margin-bottom: 16pt !important; }

        /* Print header */
        main::before {
            content: "LAPORAN & STATISTIK PENDAFTARAN SISWA BARU";
            display: block;
            text-align: center;
            font-size: 16pt;
            font-weight: bold;
            font-family: 'Outfit', sans-serif;
            border-bottom: 3px double #111;
            padding-bottom: 6pt;
            margin-bottom: 4pt;
        }
        
        main::after {
            content: "RA AN-NUUR Islamic Kindergarten — Dicetak: {{ date('d F Y, H:i') }} WIB";
            display: block;
            text-align: center;
            font-size: 9pt;
            color: #555;
            margin-bottom: 20pt;
        }
        
        /* Stat cards grid */
        .grid.grid-cols-1.md\\:grid-cols-2.lg\\:grid-cols-4 {
            display: flex !important;
            flex-wrap: wrap !important;
            gap: 8pt !important;
        }
        .grid.grid-cols-1.md\\:grid-cols-2.lg\\:grid-cols-4 > div {
            flex: 1 1 22% !important;
            border: 1px solid #ccc !important;
            border-radius: 6pt !important;
            padding: 10pt !important;
            box-shadow: none !important;
            page-break-inside: avoid;
        }
        
        /* Chart row */
        .grid.grid-cols-1.lg\\:grid-cols-2 {
            display: flex !important;
            gap: 12pt !important;
        }
        .grid.grid-cols-1.lg\\:grid-cols-2 > div {
            flex: 1 !important;
            border: 1px solid #ccc !important;
            border-radius: 6pt !important;
            box-shadow: none !important;
            page-break-inside: avoid;
        }
        
        /* Chart containers */
        .h-64 { height: 200pt !important; }
        .h-72 { height: 260pt !important; }
        canvas { max-width: 100% !important; }
        
        /* Card styling */
        .bg-white { 
            background: white !important;
            box-shadow: none !important; 
        }
        .rounded-2xl { border-radius: 6pt !important; }
        
        /* Text colors for print */
        .text-3xl { font-size: 18pt !important; font-weight: 900 !important; color: #111 !important; }
        .text-gray-500 { color: #555 !important; }
        .text-emerald-600 { color: #059669 !important; }
        .text-amber-600 { color: #d97706 !important; }
        
        /* Trend chart full width */
        .mb-8 {
            border: 1px solid #ccc !important;
            box-shadow: none !important;
            page-break-inside: avoid;
        }

        @page {
            size: A4 landscape;
            margin: 1.5cm;
        }
    }
</style>
@endsection
