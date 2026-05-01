@extends('layouts.app')

@section('title', 'Data Kriteria')

@section('content')
<div class="bg-white rounded-lg shadow-sm overflow-hidden border border-gray-200">
    <div class="p-4 lg:p-6 border-b border-gray-200 flex justify-between items-center">
        <h3 class="text-base lg:text-lg font-semibold text-gray-800">Daftar Kriteria</h3>
        @if(Auth::user()->isAdmin())
        <a href="{{ route('kriteria.create') }}" class="px-3 py-2 bg-indigo-600 text-white rounded-md text-xs lg:text-sm hover:bg-indigo-700 flex items-center gap-1">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Tambah
        </a>
        @endif
    </div>

    {{-- Mobile Card View --}}
    <div class="block lg:hidden divide-y divide-gray-200">
        @forelse($kriterias as $k)
        <div class="p-4">
            <div class="flex justify-between items-start mb-2">
                <div>
                    <div class="flex items-center gap-2 mb-1">
                        <span class="font-bold text-indigo-700 text-sm">{{ $k->kode }}</span>
                        <span class="px-2 py-0.5 text-xs rounded-full {{ $k->tipe == 'benefit' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">{{ ucfirst($k->tipe) }}</span>
                    </div>
                    <p class="font-medium text-gray-900 text-sm">{{ $k->nama_kriteria }}</p>
                    <p class="text-xs text-gray-500 mt-0.5">Bobot: <span class="font-semibold text-gray-700">{{ $k->bobot }}</span></p>
                </div>
                @if(Auth::user()->isAdmin())
                <div class="flex items-center space-x-3 flex-shrink-0 ml-2">
                    <a href="{{ route('kriteria.edit', $k->id) }}" class="text-xs font-medium text-indigo-600">Edit</a>
                    <form action="{{ route('kriteria.destroy', $k->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?');">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-xs font-medium text-red-600">Hapus</button>
                    </form>
                </div>
                @endif
            </div>
        </div>
        @empty
        <div class="p-6 text-center text-gray-400 text-sm">Belum ada data kriteria.</div>
        @endforelse
    </div>

    {{-- Desktop Table View --}}
    <div class="hidden lg:block overflow-x-auto">
        <table class="w-full text-left text-sm text-gray-500">
            <thead class="bg-gray-50 text-gray-700 uppercase text-xs">
                <tr>
                    <th class="px-6 py-3">Kode</th>
                    <th class="px-6 py-3">Nama Kriteria</th>
                    <th class="px-6 py-3">Tipe</th>
                    <th class="px-6 py-3">Bobot</th>
                    @if(Auth::user()->isAdmin())
                    <th class="px-6 py-3 text-center">Aksi</th>
                    @endif
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($kriterias as $k)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 font-bold text-gray-900">{{ $k->kode }}</td>
                    <td class="px-6 py-4 font-medium">{{ $k->nama_kriteria }}</td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 text-xs rounded-full {{ $k->tipe == 'benefit' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">{{ ucfirst($k->tipe) }}</span>
                    </td>
                    <td class="px-6 py-4">{{ $k->bobot }}</td>
                    @if(Auth::user()->isAdmin())
                    <td class="px-6 py-4 text-center">
                        <div class="flex items-center justify-center space-x-3">
                            <a href="{{ route('kriteria.edit', $k->id) }}" class="text-indigo-600 hover:text-indigo-900 font-medium">Edit</a>
                            <form action="{{ route('kriteria.destroy', $k->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?');">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900 font-medium">Hapus</button>
                            </form>
                        </div>
                    </td>
                    @endif
                </tr>
                @empty
                <tr><td colspan="5" class="px-6 py-6 text-center text-gray-400">Belum ada data kriteria.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
