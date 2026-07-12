@extends('layouts.admin')

@section('title', 'Dashboard | Admin RA AN-NUUR')

@section('content')
<main class="md:ml-[280px] min-h-screen px-4 md:px-8 py-8 bg-gray-50">

    <!-- Header & Breadcrumbs -->
    <section class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-8">
        <div>
            <nav class="flex items-center text-gray-400 gap-1 mb-2">
                <span class="text-xs">Admin Panel</span>
                <span class="material-symbols-outlined text-sm">chevron_right</span>
                <span class="text-xs font-semibold text-emerald-500">Dashboard Utama</span>
            </nav>
            <h2 class="font-display text-3xl md:text-4xl font-bold text-gray-900">Selamat datang kembali, Admin 👋</h2>
            <p class="text-gray-500 mt-1">Berikut adalah ringkasan data Penerimaan Siswa Baru.</p>
        </div>
        <div class="flex gap-3">
            <div class="hidden md:flex items-center gap-2 bg-white border border-gray-200 rounded-xl px-4 py-2.5 text-sm text-gray-500 shadow-sm">
                <span class="material-symbols-outlined text-[18px] text-emerald-500">calendar_today</span>
                <span id="currentDate" class="font-medium"></span>
            </div>
            <a href="{{ route('admin.applicants.index') }}" class="px-5 py-2.5 bg-emerald-500 text-white font-bold text-sm rounded-xl hover:bg-emerald-600 transition-all flex items-center gap-2 shadow-md shadow-emerald-500/20">
                <span class="material-symbols-outlined text-lg">group_add</span> Calon Siswa
            </a>
        </div>
    </section>

    @if(session('error'))
    <div class="mb-6 p-4 text-sm text-red-700 rounded-2xl bg-red-50 border border-red-200 flex items-center gap-2">
        <span class="material-symbols-outlined text-red-500">error</span> {{ session('error') }}
    </div>
    @endif

    <!-- Stat Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">

        <!-- Total Pendaftar -->
        <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm hover:shadow-md transition-shadow group">
            <div class="flex items-center justify-between mb-4">
                <div class="w-11 h-11 rounded-xl flex items-center justify-center bg-emerald-50">
                    <span class="material-symbols-outlined text-emerald-600 text-[22px]">group_add</span>
                </div>
                <span class="text-xs font-bold text-gray-400 bg-gray-50 border border-gray-100 px-2 py-1 rounded-lg">Total</span>
            </div>
            <p class="text-3xl font-extrabold text-gray-800 mb-1">{{ $total }}</p>
            <p class="text-sm text-gray-400 font-medium">Total Pendaftar</p>
        </div>

        <!-- Menunggu Verifikasi -->
        <div class="bg-white rounded-2xl p-5 border border-amber-100 shadow-sm hover:shadow-md transition-shadow group relative overflow-hidden">
            <div class="absolute top-0 right-0 w-20 h-20 bg-amber-50 rounded-full -translate-y-6 translate-x-6"></div>
            <div class="flex items-center justify-between mb-4 relative">
                <div class="w-11 h-11 rounded-xl flex items-center justify-center bg-amber-50">
                    <span class="material-symbols-outlined text-amber-500 text-[22px]">hourglass_top</span>
                </div>
                @if($verifying > 0)
                <span class="text-xs font-bold text-amber-700 bg-amber-50 border border-amber-200 px-2 py-1 rounded-lg animate-pulse">Perlu Aksi</span>
                @endif
            </div>
            <p class="text-3xl font-extrabold text-gray-800 mb-1 relative">{{ $verifying }}</p>
            <p class="text-sm text-gray-400 font-medium relative">Menunggu Verifikasi</p>
        </div>

        <!-- Diterima -->
        <div class="bg-white rounded-2xl p-5 border border-emerald-100 shadow-sm hover:shadow-md transition-shadow group">
            <div class="flex items-center justify-between mb-4">
                <div class="w-11 h-11 rounded-xl flex items-center justify-center bg-emerald-50">
                    <span class="material-symbols-outlined text-emerald-600 text-[22px]">verified</span>
                </div>
            </div>
            <p class="text-3xl font-extrabold text-gray-800 mb-1">{{ $accepted }}</p>
            <p class="text-sm text-gray-400 font-medium">Siswa Diterima</p>
        </div>

        <!-- Ditolak -->
        <div class="bg-white rounded-2xl p-5 border border-red-100 shadow-sm hover:shadow-md transition-shadow group">
            <div class="flex items-center justify-between mb-4">
                <div class="w-11 h-11 rounded-xl flex items-center justify-center bg-red-50">
                    <span class="material-symbols-outlined text-red-400 text-[22px]">cancel</span>
                </div>
            </div>
            <p class="text-3xl font-extrabold text-gray-800 mb-1">{{ $rejected }}</p>
            <p class="text-sm text-gray-400 font-medium">Ditolak / Revisi</p>
        </div>
    </div>

    <!-- Main Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- Recent Applicants Table (2/3) -->
        <div class="lg:col-span-2 bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden flex flex-col">
            <div class="px-6 py-5 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-emerald-50 rounded-xl flex items-center justify-center text-emerald-500">
                        <span class="material-symbols-outlined">person_add</span>
                    </div>
                    <div>
                        <h3 class="font-bold text-gray-900 text-lg">Pendaftar Terbaru</h3>
                        <p class="text-xs text-gray-500 mt-0.5">Calon siswa yang baru saja mendaftar</p>
                    </div>
                </div>
                <a href="{{ route('admin.applicants.index') }}" class="text-emerald-500 text-sm font-bold hover:text-emerald-600 flex items-center gap-1 transition-colors">
                    Lihat Semua <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                </a>
            </div>
            <div class="overflow-x-auto flex-1">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-gray-50/80 border-b border-gray-100">
                            <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider">Nama Siswa</th>
                            <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider">No. Registrasi</th>
                            <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider">Tanggal</th>
                            <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse($recentApplicants as $applicant)
                        <tr class="hover:bg-gray-50/50 transition-colors cursor-pointer" onclick="window.location='{{ route('admin.applicants.detail', $applicant->reg_number) }}'">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 rounded-full flex items-center justify-center text-xs font-bold text-white flex-shrink-0 bg-emerald-500">
                                        {{ strtoupper(substr($applicant->student->full_name, 0, 2)) }}
                                    </div>
                                    <div>
                                        <p class="text-sm font-bold text-gray-800">{{ $applicant->student->full_name }}</p>
                                        <p class="text-xs text-gray-400">{{ $applicant->student->gender == 'L' ? 'Laki-laki' : 'Perempuan' }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500 font-mono font-medium">{{ $applicant->reg_number }}</td>
                            <td class="px-6 py-4 text-xs text-gray-500">{{ $applicant->created_at->format('d M Y') }}</td>
                            <td class="px-6 py-4">
                                @if($applicant->status == 'verifying')
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg bg-amber-50 text-amber-700 text-xs font-bold border border-amber-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span> Verifikasi
                                    </span>
                                @elseif($applicant->status == 'accepted')
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg bg-emerald-50 text-emerald-700 text-xs font-bold border border-emerald-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Diterima
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg bg-red-50 text-red-600 text-xs font-bold border border-red-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span> Ditolak
                                    </span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center text-gray-400 text-sm">
                                <span class="material-symbols-outlined text-4xl text-gray-200 block mb-3">inbox</span>
                                Belum ada pendaftar terbaru.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Right Sidebar (1/3) -->
        <div class="space-y-6">

            <!-- Quota Widget -->
            @php
                $percentage = $target_kuota > 0 ? min(100, round(($accepted / $target_kuota) * 100)) : 0;
                $remaining = max(0, $target_kuota - $accepted);
                $isAlmostFull = $percentage >= 80;
            @endphp
            <div class="rounded-2xl p-6 text-white relative overflow-hidden bg-emerald-600 shadow-md">
                <div class="absolute -right-8 -top-8 w-32 h-32 bg-white/10 rounded-full"></div>
                <div class="absolute -right-2 bottom-0 w-20 h-20 bg-white/10 rounded-full"></div>
                <div class="relative">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="font-bold text-sm text-white/90">Target Kuota Siswa</h3>
                        <span class="text-xs font-bold bg-white/20 border border-white/20 px-2 py-1 rounded-lg">{{ $percentage }}%</span>
                    </div>
                    <p class="text-4xl font-extrabold mb-1">{{ $accepted }}<span class="text-xl font-normal opacity-70">/{{ $target_kuota }}</span></p>
                    <div class="w-full bg-black/20 rounded-full h-2.5 mb-3 mt-4 overflow-hidden">
                        <div class="h-2.5 rounded-full transition-all duration-1000"
                            style="width: {{ $percentage }}%; background: {{ $isAlmostFull ? '#fbbf24' : '#a7f3d0' }};">
                        </div>
                    </div>
                    <p class="text-sm text-white/80 mt-2">
                        @if($remaining > 0) Sisa kuota: <span class="font-bold text-white">{{ $remaining }} kursi</span>
                        @else <span class="text-amber-300 font-bold">Kuota telah penuh</span>
                        @endif
                    </p>
                </div>
            </div>

            <!-- Yearly Chart Widget -->
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                <div class="flex items-center gap-3 mb-5">
                    <div class="w-10 h-10 bg-blue-50 rounded-xl flex items-center justify-center text-blue-500">
                        <span class="material-symbols-outlined">bar_chart</span>
                    </div>
                    <h3 class="font-bold text-gray-900 text-lg">Perkembangan Siswa</h3>
                </div>
                <div class="relative h-44">
                    <canvas id="yearlyChart"></canvas>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                <div class="flex items-center gap-3 mb-5">
                    <div class="w-10 h-10 bg-amber-50 rounded-xl flex items-center justify-center text-amber-500">
                        <span class="material-symbols-outlined">bolt</span>
                    </div>
                    <h3 class="font-bold text-gray-900 text-lg">Akses Cepat</h3>
                </div>
                <div class="space-y-3">
                    <a href="{{ route('admin.announcements.create') }}" class="flex items-center gap-4 p-3.5 rounded-xl hover:bg-gray-50 border border-transparent hover:border-gray-100 transition-all group">
                        <div class="w-9 h-9 rounded-lg bg-blue-50 flex items-center justify-center text-blue-500 group-hover:bg-blue-100 transition-colors">
                            <span class="material-symbols-outlined text-[20px]">campaign</span>
                        </div>
                        <span class="text-sm font-bold text-gray-700 group-hover:text-gray-900">Buat Pengumuman</span>
                        <span class="material-symbols-outlined text-gray-400 text-[18px] ml-auto group-hover:text-emerald-500 transition-colors">arrow_forward</span>
                    </a>
                    <a href="{{ route('admin.reports.index') }}" class="flex items-center gap-4 p-3.5 rounded-xl hover:bg-gray-50 border border-transparent hover:border-gray-100 transition-all group">
                        <div class="w-9 h-9 rounded-lg bg-purple-50 flex items-center justify-center text-purple-500 group-hover:bg-purple-100 transition-colors">
                            <span class="material-symbols-outlined text-[20px]">analytics</span>
                        </div>
                        <span class="text-sm font-bold text-gray-700 group-hover:text-gray-900">Lihat Laporan</span>
                        <span class="material-symbols-outlined text-gray-400 text-[18px] ml-auto group-hover:text-emerald-500 transition-colors">arrow_forward</span>
                    </a>
                    <a href="{{ route('admin.settings.index') }}" class="flex items-center gap-4 p-3.5 rounded-xl hover:bg-gray-50 border border-transparent hover:border-gray-100 transition-all group">
                        <div class="w-9 h-9 rounded-lg bg-orange-50 flex items-center justify-center text-orange-500 group-hover:bg-orange-100 transition-colors">
                            <span class="material-symbols-outlined text-[20px]">settings</span>
                        </div>
                        <span class="text-sm font-bold text-gray-700 group-hover:text-gray-900">Pengaturan Sistem</span>
                        <span class="material-symbols-outlined text-gray-400 text-[18px] ml-auto group-hover:text-emerald-500 transition-colors">arrow_forward</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@section('scripts')
<script>
    // Live Date
    document.getElementById('currentDate').textContent = new Date().toLocaleDateString('id-ID', {weekday:'long', year:'numeric', month:'long', day:'numeric'});

    // Yearly Chart
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('yearlyChart').getContext('2d');
        const labels = {!! $yearlyLabels !!};
        const data = {!! $yearlyCounts !!};

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Siswa Diterima',
                    data: data,
                    borderColor: '#10B981',
                    backgroundColor: 'rgba(16, 185, 129, 0.08)',
                    borderWidth: 2.5,
                    pointBackgroundColor: '#10B981',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointRadius: 4,
                    pointHoverRadius: 6,
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: '#111827',
                        titleFont: { family: 'Outfit', size: 12 },
                        bodyFont: { family: 'Outfit', size: 13, weight: 'bold' },
                        padding: 10,
                        displayColors: false,
                        callbacks: { label: ctx => ctx.parsed.y + ' Siswa' }
                    }
                },
                scales: {
                    x: { grid: { display: false }, ticks: { font: { family: 'Outfit', size: 11 }, color: '#9ca3af' } },
                    y: { beginAtZero: true, grid: { color: '#f3f4f6', borderDash: [4,4] }, ticks: { font: { family: 'Outfit', size: 11 }, color: '#9ca3af', precision: 0 } }
                }
            }
        });
    });
</script>
@endsection
