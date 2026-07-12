@extends('layouts.admin')

@section('content')
<main class="md:ml-[280px] min-h-screen px-4 md:px-8 py-8 bg-gray-50">

    <!-- Header & Breadcrumbs -->
    <section class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-8">
        <div>
            <nav class="flex items-center text-gray-400 gap-1 mb-2">
                <span class="text-xs">Admin Panel</span>
                <span class="material-symbols-outlined text-sm">chevron_right</span>
                <span class="text-xs font-semibold text-emerald-500">Calon Siswa</span>
            </nav>
            <h2 class="font-display text-3xl md:text-4xl font-bold text-gray-900">Daftar Calon Siswa</h2>
            <p class="text-gray-500 mt-1">Kelola data pendaftaran masuk</p>
        </div>
        <div class="flex items-center gap-3">
            <form action="{{ route('admin.applicants.index') }}" method="GET" class="hidden md:flex items-center gap-2 bg-white border border-gray-200 rounded-xl px-4 py-2.5 shadow-sm">
                @if(request()->has('status'))
                    <input type="hidden" name="status" value="{{ request('status') }}">
                @endif
                @if(request()->has('sort'))
                    <input type="hidden" name="sort" value="{{ request('sort') }}">
                @endif
                <span class="material-symbols-outlined text-gray-400 text-[18px]">search</span>
                <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nama / no. reg..." class="bg-transparent border-none focus:outline-none focus:ring-0 text-sm text-gray-700 w-44 placeholder:text-gray-400 p-0">
            </form>
            <a href="{{ route('admin.applicants.export', request()->all()) }}" class="flex items-center gap-2 bg-white border border-gray-200 text-gray-600 px-4 py-2.5 rounded-xl text-sm font-bold hover:bg-gray-50 transition-colors shadow-sm">
                <span class="material-symbols-outlined text-[16px]">download</span> Export
            </a>
            <a href="{{ route('admin.applicants.create') }}" class="flex items-center gap-2 bg-emerald-500 text-white px-5 py-2.5 rounded-xl text-sm font-bold hover:bg-emerald-600 transition-colors shadow-md shadow-emerald-500/20">
                <span class="material-symbols-outlined text-[16px]">add</span> Tambah
            </a>
        </div>
    </section>

    <!-- Filter & Sort Bar -->
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-4 flex flex-col md:flex-row items-start md:items-center justify-between gap-4 mb-6">
        @php 
            $currentStatus = request('status', 'all'); 
            $qParam = request()->has('q') ? ['q' => request('q')] : [];
        @endphp
        <div class="flex items-center gap-1 bg-gray-50 border border-gray-200 rounded-xl p-1">
            <a href="{{ request()->fullUrlWithQuery(array_merge(['status' => 'all'], $qParam)) }}"
                class="px-4 py-1.5 text-sm font-semibold rounded-lg transition-colors {{ $currentStatus == 'all' ? 'bg-white text-emerald-700 shadow-sm border border-gray-200' : 'text-gray-500 hover:text-gray-700' }}">
                Semua
            </a>
            <a href="{{ request()->fullUrlWithQuery(array_merge(['status' => 'verifying'], $qParam)) }}"
                class="px-4 py-1.5 text-sm font-semibold rounded-lg transition-colors {{ $currentStatus == 'verifying' ? 'bg-white text-amber-700 shadow-sm border border-gray-200' : 'text-gray-500 hover:text-gray-700' }}">
                ⏳ Verifikasi
            </a>
            <a href="{{ request()->fullUrlWithQuery(array_merge(['status' => 'accepted'], $qParam)) }}"
                class="px-4 py-1.5 text-sm font-semibold rounded-lg transition-colors {{ $currentStatus == 'accepted' ? 'bg-white text-emerald-700 shadow-sm border border-gray-200' : 'text-gray-500 hover:text-gray-700' }}">
                ✅ Diterima
            </a>
            <a href="{{ request()->fullUrlWithQuery(array_merge(['status' => 'rejected'], $qParam)) }}"
                class="px-4 py-1.5 text-sm font-semibold rounded-lg transition-colors {{ $currentStatus == 'rejected' ? 'bg-white text-red-600 shadow-sm border border-gray-200' : 'text-gray-500 hover:text-gray-700' }}">
                ❌ Ditolak
            </a>
        </div>
        <form action="{{ url()->current() }}" method="GET">
            @if(request()->has('status'))
                <input type="hidden" name="status" value="{{ request('status') }}">
            @endif
            @if(request()->has('q'))
                <input type="hidden" name="q" value="{{ request('q') }}">
            @endif
            <select name="sort" onchange="this.form.submit()" class="px-4 py-2 rounded-xl border border-gray-200 bg-white text-sm text-gray-600 focus:outline-none focus:border-emerald-400 cursor-pointer">
                <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Terbaru</option>
                <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Terlama</option>
                <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Nama A-Z</option>
            </select>
        </form>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm flex flex-col overflow-hidden mb-6">
        <div class="overflow-x-auto flex-1">
            <table class="w-full text-left min-w-[800px]">
                <thead>
                    <tr class="bg-gray-50/80 border-b border-gray-100">
                        <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider">Calon Siswa</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider">No. Registrasi</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider">Tanggal Daftar</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider">Kelompok</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($applicants as $applicant)
                    <tr class="hover:bg-gray-50/50 transition-colors cursor-pointer group" onclick="window.location.href='{{ route('admin.applicants.detail', $applicant->reg_number) }}'">
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
                        <td class="px-6 py-4 text-sm text-gray-400">{{ $applicant->created_at->format('d M Y') }}</td>
                        <td class="px-6 py-4">
                            @php $age = \Carbon\Carbon::parse($applicant->student->birth_date)->age; @endphp
                            <span class="px-2.5 py-1 rounded-lg text-xs font-bold border {{ $age >= 5 ? 'bg-blue-50 text-blue-700 border-blue-200' : 'bg-purple-50 text-purple-700 border-purple-200' }}">
                                {{ $age >= 5 ? 'Kelompok B' : 'Kelompok A' }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            @if($applicant->status == 'verifying')
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-amber-50 text-amber-700 text-xs font-bold border border-amber-200">
                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span> Verifikasi
                                </span>
                            @elseif($applicant->status == 'accepted')
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-emerald-50 text-emerald-700 text-xs font-bold border border-emerald-200">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Diterima
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-red-50 text-red-600 text-xs font-bold border border-red-200">
                                    <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span> Ditolak
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right">
                            <a href="{{ route('admin.applicants.detail', $applicant->reg_number) }}"
                                class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg border border-gray-200 text-emerald-600 text-xs font-bold hover:bg-emerald-50 hover:border-emerald-200 transition-colors" onclick="event.stopPropagation()">
                                <span class="material-symbols-outlined text-[14px]">visibility</span> Detail
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-16 text-center">
                            <span class="material-symbols-outlined text-5xl text-gray-200 block mb-3">inbox</span>
                            <p class="text-gray-400 font-medium">Belum ada data pendaftar.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 border-t border-gray-100 bg-gray-50/50">
            {{ $applicants->links() }}
        </div>
    </div>

</main>
@endsection
