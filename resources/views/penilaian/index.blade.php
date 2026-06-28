@extends('layouts.app')

@section('title', 'Data Penilaian Warga')

@section('content')
<div class="bg-white rounded-lg shadow-sm overflow-hidden border border-gray-200">
    <div class="p-4 lg:p-6 border-b border-gray-200 flex justify-between items-center">
        <h3 class="text-base lg:text-lg font-semibold text-gray-800">Matriks Penilaian / Nilai Alternatif</h3>
        @if(Auth::user()->isAdmin())
        <a href="{{ route('penilaian.create') }}" class="px-3 py-2 bg-indigo-600 text-white rounded-md text-xs lg:text-sm hover:bg-indigo-700 flex items-center gap-1">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Isi Penilaian
        </a>
        @endif
    </div>

    {{-- Mobile: Card per warga --}}
    <div class="block lg:hidden divide-y divide-gray-200">
        @forelse($wargas as $warga)
        <div class="p-4">
            <p class="font-semibold text-gray-900 text-sm">{{ $warga->nama }}</p>
            <p class="text-xs text-gray-400 mb-3">{{ $warga->nik }}</p>
            <div class="space-y-2">
                @foreach($kriterias as $k)
                    @php $penilaian = $warga->penilaians->where('kriteria_id', $k->id)->first(); @endphp
                    <div class="flex justify-between items-center bg-gray-50 rounded px-3 py-2">
                        <span class="text-xs font-medium text-gray-600">{{ $k->kode }}</span>
                        @if($penilaian && $penilaian->subKriteria)
                            <span class="text-xs font-semibold text-indigo-700 bg-indigo-50 px-2 py-0.5 rounded">
                                {{ $penilaian->subKriteria->nama_sub }} ({{ $penilaian->nilai }})
                            </span>
                        @else
                            <span class="text-xs text-gray-300">Belum dinilai</span>
                        @endif
                    </div>
                @endforeach
                @if(Auth::user()->isAdmin())
                <div class="pt-2">
                    <a href="{{ route('penilaian.edit', $warga->id) }}" class="text-xs text-indigo-600 hover:text-indigo-800 flex items-center gap-1">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                        Edit
                    </a>
                </div>
                @endif
            </div>
        </div>
        @empty
        <div class="p-6 text-center text-gray-400 text-sm">Belum ada data penilaian.</div>
        @endforelse
    </div>

    {{-- Desktop: Matrix Table --}}
    <div class="hidden lg:block overflow-x-auto">
        <table class="w-full text-left text-sm text-gray-500">
            <thead class="bg-gray-50 text-gray-700 uppercase text-xs">
                <tr>
                    <th class="px-6 py-3 border-b border-r">Nama Warga</th>
                    @foreach($kriterias as $k)
                    <th class="px-6 py-3 border-b text-center">{{ $k->kode }}<br>
                        <span class="text-gray-400 normal-case font-normal text-xs">{{ $k->nama_kriteria }}</span>
                    </th>
                    @endforeach
                    @if(Auth::user()->isAdmin())
                    <th class="px-6 py-3 border-b text-center">Aksi</th>
                    @endif
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($wargas as $warga)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 font-medium text-gray-900 border-r">
                        {{ $warga->nama }}<br>
                        <span class="text-xs text-gray-400">{{ $warga->nik }}</span>
                    </td>
                    @foreach($kriterias as $k)
                        @php $penilaian = $warga->penilaians->where('kriteria_id', $k->id)->first(); @endphp
                        <td class="px-6 py-4 text-center">
                            @if($penilaian && $penilaian->subKriteria)
                                <span class="font-medium text-gray-900">{{ $penilaian->subKriteria->nama_sub }}</span><br>
                                <span class="text-xs px-2 py-0.5 bg-indigo-50 text-indigo-700 rounded-full">{{ $penilaian->nilai }}</span>
                            @else
                                <span class="text-gray-300">-</span>
                            @endif
                        </td>
                    @endforeach
                    @if(Auth::user()->isAdmin())
                    <td class="px-6 py-4 text-center">
                        <a href="{{ route('penilaian.edit', $warga->id) }}" class="inline-flex items-center gap-1 text-indigo-600 hover:text-indigo-800 text-xs font-medium">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                            Edit
                        </a>
                    </td>
                    @endif
                </tr>
                @empty
                <tr>
                    <td colspan="{{ $kriterias->count() + 1 + (Auth::user()->isAdmin() ? 1 : 0) }}" class="px-6 py-6 text-center text-gray-400">Belum ada data penilaian.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if(!Auth::user()->isAdmin())
    <div class="p-4 border-t border-gray-100 bg-amber-50">
        <p class="text-xs text-amber-700 flex items-center gap-1">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            Anda hanya dapat melihat data penilaian. Untuk mengubah data, hubungi Administrator.
        </p>
    </div>
    @endif
</div>
@endsection
