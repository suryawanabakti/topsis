@extends('layouts.app')

@section('title', 'Hasil Perhitungan TOPSIS')

@section('content')
@if(isset($error))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg">{{ $error }}</div>
@else
<div class="space-y-5">

    {{-- 1. Matrix Keputusan --}}
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
        <div class="p-4 border-b border-gray-200 bg-gray-50">
            <h3 class="text-sm font-semibold text-gray-800">1. Matriks Keputusan (X)</h3>
        </div>
        <div class="overflow-x-auto p-4">
            <table class="w-full text-sm border-collapse border border-gray-200">
                <thead class="bg-indigo-50 text-indigo-900 text-xs">
                    <tr>
                        <th class="px-3 py-2 border border-gray-200 text-left">Alternatif</th>
                        @foreach($kriterias as $k)
                            <th class="px-3 py-2 border border-gray-200 text-center">{{ $k->kode }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach($wargas as $w)
                    <tr class="hover:bg-gray-50">
                        <td class="px-3 py-2 border border-gray-200 font-medium text-gray-900 text-xs">{{ $w->nama }}</td>
                        @foreach($kriterias as $k)
                            <td class="px-3 py-2 border border-gray-200 text-center text-xs">{{ $matrixX[$w->id][$k->id] }}</td>
                        @endforeach
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- 2. Matrix Normalisasi --}}
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
        <div class="p-4 border-b border-gray-200 bg-gray-50">
            <h3 class="text-sm font-semibold text-gray-800">2. Matriks Normalisasi (R)</h3>
        </div>
        <div class="overflow-x-auto p-4">
            <table class="w-full text-sm border-collapse border border-gray-200">
                <thead class="bg-indigo-50 text-indigo-900 text-xs">
                    <tr>
                        <th class="px-3 py-2 border border-gray-200 text-left">Alternatif</th>
                        @foreach($kriterias as $k)
                            <th class="px-3 py-2 border border-gray-200 text-center">{{ $k->kode }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach($wargas as $w)
                    <tr class="hover:bg-gray-50">
                        <td class="px-3 py-2 border border-gray-200 font-medium text-gray-900 text-xs">{{ $w->nama }}</td>
                        @foreach($kriterias as $k)
                            <td class="px-3 py-2 border border-gray-200 text-center text-xs">{{ number_format($matrixR[$w->id][$k->id], 4) }}</td>
                        @endforeach
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- 3. Matrix Normalisasi Terbobot --}}
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
        <div class="p-4 border-b border-gray-200 bg-gray-50">
            <h3 class="text-sm font-semibold text-gray-800">3. Matriks Normalisasi Terbobot (Y)</h3>
        </div>
        <div class="overflow-x-auto p-4">
            <table class="w-full text-sm border-collapse border border-gray-200">
                <thead class="bg-indigo-50 text-indigo-900 text-xs">
                    <tr>
                        <th class="px-3 py-2 border border-gray-200 text-left">Alternatif</th>
                        @foreach($kriterias as $k)
                            <th class="px-3 py-2 border border-gray-200 text-center">{{ $k->kode }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach($wargas as $w)
                    <tr class="hover:bg-gray-50">
                        <td class="px-3 py-2 border border-gray-200 font-medium text-gray-900 text-xs">{{ $w->nama }}</td>
                        @foreach($kriterias as $k)
                            <td class="px-3 py-2 border border-gray-200 text-center text-xs">{{ number_format($matrixY[$w->id][$k->id], 4) }}</td>
                        @endforeach
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- 4. Solusi Ideal --}}
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
        <div class="p-4 border-b border-gray-200 bg-gray-50">
            <h3 class="text-sm font-semibold text-gray-800">4. Solusi Ideal Positif (A+) & Negatif (A-)</h3>
        </div>
        <div class="overflow-x-auto p-4">
            <table class="w-full text-sm border-collapse border border-gray-200">
                <thead class="bg-indigo-50 text-indigo-900 text-xs">
                    <tr>
                        <th class="px-3 py-2 border border-gray-200 text-left">Solusi</th>
                        @foreach($kriterias as $k)
                            <th class="px-3 py-2 border border-gray-200 text-center">{{ $k->kode }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="px-3 py-2 border border-gray-200 font-semibold text-green-700 text-xs">A+ (Positif)</td>
                        @foreach($kriterias as $k)
                            <td class="px-3 py-2 border border-gray-200 text-center text-xs">{{ number_format($A_plus[$k->id], 4) }}</td>
                        @endforeach
                    </tr>
                    <tr>
                        <td class="px-3 py-2 border border-gray-200 font-semibold text-red-700 text-xs">A- (Negatif)</td>
                        @foreach($kriterias as $k)
                            <td class="px-3 py-2 border border-gray-200 text-center text-xs">{{ number_format($A_min[$k->id], 4) }}</td>
                        @endforeach
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    {{-- 5. Hasil Perankingan --}}
    <div class="bg-white rounded-lg shadow-md border border-indigo-200 overflow-hidden">
        <div class="p-4 border-b border-indigo-200 bg-indigo-600 text-white">
            <h3 class="text-base font-bold">5. Hasil Perankingan (V)</h3>
        </div>

        {{-- Mobile Cards --}}
        <div class="block lg:hidden divide-y divide-gray-200">
            @foreach($preferensi as $idx => $pref)
            <div class="p-4 {{ $idx == 0 ? 'bg-yellow-50' : '' }}">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <span class="w-8 h-8 rounded-full flex items-center justify-center font-bold text-sm {{ $idx == 0 ? 'bg-yellow-400 text-white' : 'bg-gray-200 text-gray-600' }}">{{ $idx + 1 }}</span>
                        <div>
                            <p class="font-bold text-gray-900 text-sm">{{ $pref['warga']->nama }}</p>
                            <p class="text-xs text-gray-500">{{ $pref['warga']->nik }}</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-lg font-bold text-indigo-700">{{ number_format($pref['V'], 4) }}</p>
                        <p class="text-xs text-gray-400">Nilai Preferensi</p>
                    </div>
                </div>
                <div class="flex gap-4 mt-2 ml-11 text-xs text-gray-500">
                    <span>D+: {{ number_format($pref['D_plus'], 4) }}</span>
                    <span>D-: {{ number_format($pref['D_min'], 4) }}</span>
                </div>
            </div>
            @endforeach
        </div>

        {{-- Desktop Table --}}
        <div class="hidden lg:block overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-gray-50 text-gray-700 text-xs uppercase">
                    <tr>
                        <th class="px-4 py-3 border text-center w-16">Rank</th>
                        <th class="px-4 py-3 border">Nama Warga</th>
                        <th class="px-4 py-3 border">NIK</th>
                        <th class="px-4 py-3 border text-center">Jarak D+</th>
                        <th class="px-4 py-3 border text-center">Jarak D-</th>
                        <th class="px-4 py-3 border text-center bg-indigo-50 text-indigo-900">Nilai Preferensi (V)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($preferensi as $idx => $pref)
                    <tr class="{{ $idx == 0 ? 'bg-yellow-50' : 'hover:bg-gray-50' }}">
                        <td class="px-4 py-3 border text-center font-bold {{ $idx == 0 ? 'text-yellow-600 text-lg' : 'text-gray-500' }}">{{ $idx + 1 }}</td>
                        <td class="px-4 py-3 border font-bold text-gray-900">{{ $pref['warga']->nama }}</td>
                        <td class="px-4 py-3 border text-gray-500 text-xs">{{ $pref['warga']->nik }}</td>
                        <td class="px-4 py-3 border text-center text-gray-500">{{ number_format($pref['D_plus'], 4) }}</td>
                        <td class="px-4 py-3 border text-center text-gray-500">{{ number_format($pref['D_min'], 4) }}</td>
                        <td class="px-4 py-3 border text-center bg-indigo-50 font-bold text-indigo-700 text-base">{{ number_format($pref['V'], 4) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>
@endif
@endsection
