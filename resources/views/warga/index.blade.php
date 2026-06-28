@extends('layouts.app')

@section('title', 'Data Warga')

@section('content')
<div class="bg-white rounded-lg shadow-sm overflow-hidden border border-gray-200">
    <div class="p-4 lg:p-6 border-b border-gray-200 flex justify-between items-center">
        <h3 class="text-base lg:text-lg font-semibold text-gray-800">Daftar Warga</h3>
        @if(Auth::user()->isAdmin() || Auth::user()->isKepDusun())
        <a href="{{ route('warga.create') }}" class="px-3 py-2 bg-indigo-600 text-white rounded-md text-xs lg:text-sm hover:bg-indigo-700 flex items-center gap-1">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Tambah
        </a>
        @endif
    </div>

    {{-- Mobile Card View --}}
    <div class="block lg:hidden divide-y divide-gray-200">
        @forelse($wargas as $w)
        <div class="p-4">
            <div class="flex justify-between items-start mb-2">
                <div>
                    <p class="font-semibold text-gray-900 text-sm">{{ $w->nama }}</p>
                    <p class="text-xs text-gray-500 mt-0.5">NIK: {{ $w->nik }}</p>
                    <p class="text-xs text-gray-400 mt-0.5">{{ $w->alamat }}</p>
                </div>
                @if(Auth::user()->isAdmin() || Auth::user()->isKepDusun())
                <div class="flex items-center space-x-3 flex-shrink-0 ml-2">
                    <a href="{{ route('warga.edit', $w->id) }}" class="text-xs font-medium text-indigo-600 hover:text-indigo-900">Edit</a>
                    <form action="{{ route('warga.destroy', $w->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?');">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-xs font-medium text-red-600 hover:text-red-900">Hapus</button>
                    </form>
                </div>
                @endif
            </div>
            <div class="flex flex-wrap gap-2 mt-1">
                <span class="px-2 py-0.5 bg-gray-100 text-gray-600 rounded text-xs">{{ $w->pekerjaan }}</span>
                <span class="px-2 py-0.5 bg-indigo-50 text-indigo-600 rounded text-xs">{{ $w->jenis_kelamin == 'L' ? 'Laki-Laki' : 'Perempuan' }}</span>
            </div>
        </div>
        @empty
        <div class="p-6 text-center text-gray-400 text-sm">Belum ada data warga.</div>
        @endforelse
    </div>

    {{-- Desktop Table View --}}
    <div class="hidden lg:block overflow-x-auto">
        <table class="w-full text-left text-sm text-gray-500">
            <thead class="bg-gray-50 text-gray-700 uppercase text-xs">
                <tr>
                    <th class="px-6 py-3">NIK</th>
                    <th class="px-6 py-3">Nama</th>
                    <th class="px-6 py-3">Alamat</th>
                    <th class="px-6 py-3">Jenis Kelamin</th>
                    <th class="px-6 py-3">Pekerjaan</th>
                    @if(Auth::user()->isAdmin() || Auth::user()->isKepDusun())
                    <th class="px-6 py-3 text-center">Aksi</th>
                    @endif
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($wargas as $w)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4">{{ $w->nik }}</td>
                    <td class="px-6 py-4 font-medium text-gray-900">{{ $w->nama }}</td>
                    <td class="px-6 py-4 text-gray-400 max-w-xs truncate">{{ $w->alamat }}</td>
                    <td class="px-6 py-4">{{ $w->jenis_kelamin == 'L' ? 'Laki-Laki' : 'Perempuan' }}</td>
                    <td class="px-6 py-4">{{ $w->pekerjaan }}</td>
                    @if(Auth::user()->isAdmin() || Auth::user()->isKepDusun())
                    <td class="px-6 py-4 text-center">
                        <div class="flex items-center justify-center space-x-3">
                            <a href="{{ route('warga.edit', $w->id) }}" class="text-indigo-600 hover:text-indigo-900 font-medium">Edit</a>
                            <form action="{{ route('warga.destroy', $w->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?');">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900 font-medium">Hapus</button>
                            </form>
                        </div>
                    </td>
                    @endif
                </tr>
                @empty
                <tr><td colspan="{{ Auth::user()->isAdmin() || Auth::user()->isKepDusun() ? 6 : 5 }}" class="px-6 py-6 text-center text-gray-400">Belum ada data warga.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
