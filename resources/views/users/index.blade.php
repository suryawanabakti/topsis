@extends('layouts.app')

@section('title', 'Manajemen User')

@section('content')
<div class="bg-white rounded-lg shadow-sm overflow-hidden border border-gray-200">
    <div class="p-4 lg:p-6 border-b border-gray-200 flex justify-between items-center">
        <div>
            <h3 class="text-base lg:text-lg font-semibold text-gray-800">Manajemen User</h3>
            <p class="text-xs text-gray-500 mt-0.5">Kelola akun dan hak akses pengguna sistem</p>
        </div>
        <a href="{{ route('users.create') }}" class="px-3 py-2 bg-indigo-600 text-white rounded-md text-xs lg:text-sm hover:bg-indigo-700 flex items-center gap-1">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Tambah User
        </a>
    </div>

    {{-- Mobile Card View --}}
    <div class="block lg:hidden divide-y divide-gray-200">
        @forelse($users as $u)
        <div class="p-4">
            <div class="flex justify-between items-start">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-700 font-bold text-sm flex-shrink-0">
                        {{ substr($u->name, 0, 1) }}
                    </div>
                    <div>
                        <p class="font-semibold text-gray-900 text-sm">{{ $u->name }}</p>
                        <p class="text-xs text-gray-400">{{ $u->email }}</p>
                        <span class="inline-block mt-1 px-2 py-0.5 text-xs rounded-full
                            {{ $u->role == 'admin' ? 'bg-red-100 text-red-700' :
                               ($u->role == 'kepala_dusun' ? 'bg-blue-100 text-blue-700' : 'bg-green-100 text-green-700') }}">
                            {{ $u->roleName() }}
                        </span>
                    </div>
                </div>
                @if($u->id !== auth()->id())
                <div class="flex items-center space-x-3 flex-shrink-0 ml-2">
                    <a href="{{ route('users.edit', $u->id) }}" class="text-xs font-medium text-indigo-600">Edit</a>
                    <form action="{{ route('users.destroy', $u->id) }}" method="POST" onsubmit="return confirm('Hapus user ini?');">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-xs font-medium text-red-600">Hapus</button>
                    </form>
                </div>
                @endif
            </div>
        </div>
        @empty
        <div class="p-6 text-center text-gray-400 text-sm">Belum ada data user.</div>
        @endforelse
    </div>

    {{-- Desktop Table --}}
    <div class="hidden lg:block overflow-x-auto">
        <table class="w-full text-left text-sm text-gray-500">
            <thead class="bg-gray-50 text-gray-700 uppercase text-xs">
                <tr>
                    <th class="px-6 py-3">Nama</th>
                    <th class="px-6 py-3">Email</th>
                    <th class="px-6 py-3">Role / Jabatan</th>
                    <th class="px-6 py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($users as $u)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-700 font-bold text-sm">
                                {{ substr($u->name, 0, 1) }}
                            </div>
                            <span class="font-medium text-gray-900">{{ $u->name }}</span>
                            @if($u->id === auth()->id())
                                <span class="text-xs text-gray-400">(Anda)</span>
                            @endif
                        </div>
                    </td>
                    <td class="px-6 py-4">{{ $u->email }}</td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 text-xs rounded-full
                            {{ $u->role == 'admin' ? 'bg-red-100 text-red-700' :
                               ($u->role == 'kepala_dusun' ? 'bg-blue-100 text-blue-700' : 'bg-green-100 text-green-700') }}">
                            {{ $u->roleName() }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-center">
                        @if($u->id !== auth()->id())
                        <div class="flex items-center justify-center space-x-3">
                            <a href="{{ route('users.edit', $u->id) }}" class="text-indigo-600 hover:text-indigo-900 font-medium">Edit</a>
                            <form action="{{ route('users.destroy', $u->id) }}" method="POST" onsubmit="return confirm('Hapus user ini?');">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900 font-medium">Hapus</button>
                            </form>
                        </div>
                        @else
                        <span class="text-gray-300 text-xs">—</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr><td colspan="4" class="px-6 py-6 text-center text-gray-400">Belum ada data user.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Legend -->
    <div class="p-4 border-t border-gray-100 bg-gray-50">
        <p class="text-xs text-gray-500 font-medium mb-2">Keterangan Role:</p>
        <div class="flex flex-wrap gap-3 text-xs">
            <span class="flex items-center gap-1"><span class="w-3 h-3 rounded-full bg-red-200 inline-block"></span> <b>Administrator</b>: Akses penuh ke semua fitur</span>
            <span class="flex items-center gap-1"><span class="w-3 h-3 rounded-full bg-blue-200 inline-block"></span> <b>Kepala Dusun</b>: Kelola warga, lihat penilaian & ranking</span>
            <span class="flex items-center gap-1"><span class="w-3 h-3 rounded-full bg-green-200 inline-block"></span> <b>Kepala Desa</b>: Hanya lihat data warga, kriteria, & ranking</span>
        </div>
    </div>
</div>
@endsection
