@extends('layouts.admin')

@section('content')
<main class="md:ml-[280px] min-h-screen px-4 md:px-8 py-8 bg-gray-50">

    <!-- Header & Breadcrumbs -->
    <section class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-8">
        <div>
            <nav class="flex items-center text-gray-400 gap-1 mb-2">
                <span class="text-xs">Admin Panel</span>
                <span class="material-symbols-outlined text-sm">chevron_right</span>
                <span class="text-xs font-semibold text-emerald-500">Akun Orang Tua</span>
            </nav>
            <h2 class="font-display text-3xl md:text-4xl font-bold text-gray-900">Akun Orang Tua</h2>
            <p class="text-gray-500 mt-1">Manajemen semua akun pengguna dengan peran orang tua/wali</p>
        </div>
        <div class="flex items-center gap-3">
            <div class="flex items-center gap-2 bg-white border border-gray-200 rounded-xl px-4 py-2.5 shadow-sm">
                <span class="material-symbols-outlined text-blue-500 text-[18px]">manage_accounts</span>
                <span class="text-sm font-bold text-gray-700">{{ $users->total() }} Akun</span>
            </div>
        </div>
    </section>

    @if(session('success'))
    <div class="mb-6 p-4 text-sm text-emerald-700 rounded-2xl bg-emerald-50 border border-emerald-200 flex items-center gap-2">
        <span class="material-symbols-outlined text-emerald-500">check_circle</span> {{ session('success') }}
    </div>
    @endif

    <!-- Table -->
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm flex flex-col overflow-hidden mb-6">
        <div class="overflow-x-auto flex-1">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-gray-50/80 border-b border-gray-100">
                        <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider">Nama Pemilik Akun</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider">Email Login</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider">Data Siswa Terkait</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($users as $user)
                    <tr class="hover:bg-gray-50/50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-full flex items-center justify-center text-xs font-bold text-white flex-shrink-0 bg-blue-500">
                                    {{ strtoupper(substr($user->name, 0, 2)) }}
                                </div>
                                <p class="text-sm font-bold text-gray-800">{{ $user->name }}</p>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500 font-medium">{{ $user->email }}</td>
                        <td class="px-6 py-4">
                            @if($user->registration && $user->registration->student)
                                <p class="text-sm font-bold text-gray-700">{{ $user->registration->student->full_name }}</p>
                                <p class="text-xs text-gray-400 font-mono mt-0.5">{{ $user->registration->reg_number }}</p>
                            @else
                                <span class="text-xs text-gray-400 italic bg-gray-50 border border-gray-100 px-2 py-1 rounded-lg">Belum ada data siswa</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.users.edit', $user->id) }}"
                                    class="p-2 rounded-xl hover:bg-emerald-50 text-gray-400 hover:text-emerald-500 transition-colors border border-transparent hover:border-emerald-200" title="Edit">
                                    <span class="material-symbols-outlined text-[18px]">edit</span>
                                </a>
                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="delete-form">
                                    @csrf @method('DELETE')
                                    <button type="button" onclick="confirmDelete(this, 'Akun Orang Tua', 'Apakah Anda yakin ingin menghapus akun ini secara permanen?')" class="p-2 rounded-xl hover:bg-red-50 text-gray-400 hover:text-red-500 transition-colors border border-transparent hover:border-red-200" title="Hapus">
                                        <span class="material-symbols-outlined text-[18px]">delete</span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-16 text-center">
                            <span class="material-symbols-outlined text-5xl text-gray-200 block mb-3">manage_accounts</span>
                            <p class="text-gray-400 font-medium text-sm">Tidak ada data akun orang tua.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 border-t border-gray-100 bg-gray-50/50">
            {{ $users->links() }}
        </div>
    </div>
</main>
@endsection

@section('scripts')
<script>
    function confirmDelete(button, type, text) {
        Swal.fire({
            title: `Hapus ${type}?`,
            text: text,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#9ca3af',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                button.closest('form').submit();
            }
        });
    }
</script>
@endsection
