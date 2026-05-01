@extends('layouts.app')

@section('title', 'Data Sub Kriteria')

@section('content')
<div class="bg-white rounded-lg shadow-sm overflow-hidden border border-gray-200">
    <div class="p-4 lg:p-6 border-b border-gray-200 flex justify-between items-center">
        <h3 class="text-base lg:text-lg font-semibold text-gray-800">Daftar Sub Kriteria</h3>
        <a href="{{ route('sub_kriteria.create') }}" class="px-3 py-2 bg-indigo-600 text-white rounded-md text-xs lg:text-sm hover:bg-indigo-700 flex items-center gap-1">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Tambah
        </a>
    </div>

    {{-- Mobile Card View --}}
    <div class="block lg:hidden divide-y divide-gray-200">
        @forelse($subKriterias as $sub)
        <div class="p-4">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-xs text-indigo-600 font-semibold mb-0.5">{{ $sub->kriteria->kode }} - {{ $sub->kriteria->nama_kriteria }}</p>
                    <p class="font-medium text-gray-900 text-sm">{{ $sub->nama_sub }}</p>
                    <p class="text-xs text-gray-500 mt-0.5">Nilai: <span class="font-bold text-gray-700">{{ $sub->nilai }}</span></p>
                </div>
                <div class="flex items-center space-x-3 flex-shrink-0 ml-2">
                    <a href="{{ route('sub_kriteria.edit', $sub->id) }}" class="text-xs font-medium text-indigo-600">Edit</a>
                    <form action="{{ route('sub_kriteria.destroy', $sub->id) }}" method="POST" onsubmit="return confirm('Yakin?');">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-xs font-medium text-red-600">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
        @empty
        <div class="p-6 text-center text-gray-400 text-sm">Belum ada data sub kriteria.</div>
        @endforelse
    </div>

    {{-- Desktop Table View --}}
    <div class="hidden lg:block overflow-x-auto">
        <table class="w-full text-left text-sm text-gray-500">
            <thead class="bg-gray-50 text-gray-700 uppercase text-xs">
                <tr>
                    <th class="px-6 py-3">Kriteria</th>
                    <th class="px-6 py-3">Nama Sub</th>
                    <th class="px-6 py-3">Nilai</th>
                    <th class="px-6 py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($subKriterias as $sub)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4"><span class="font-bold">{{ $sub->kriteria->kode }}</span> - {{ $sub->kriteria->nama_kriteria }}</td>
                    <td class="px-6 py-4 font-medium text-gray-900">{{ $sub->nama_sub }}</td>
                    <td class="px-6 py-4">{{ $sub->nilai }}</td>
                    <td class="px-6 py-4 text-center">
                        <div class="flex items-center justify-center space-x-3">
                            <a href="{{ route('sub_kriteria.edit', $sub->id) }}" class="text-indigo-600 font-medium">Edit</a>
                            <form action="{{ route('sub_kriteria.destroy', $sub->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?');">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-600 font-medium">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="4" class="px-6 py-6 text-center text-gray-400">Belum ada data sub kriteria.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
