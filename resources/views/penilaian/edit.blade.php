@extends('layouts.app')

@section('title', 'Edit Penilaian Warga')

@section('content')
<div class="bg-white rounded-lg shadow-sm overflow-hidden border border-gray-200 max-w-4xl mx-auto">
    <div class="p-6 border-b border-gray-200">
        <h3 class="text-lg font-semibold text-gray-800">Edit Penilaian Alternatif (Warga)</h3>
        <p class="text-sm text-gray-500 mt-1">Mengubah nilai penilaian untuk: <strong class="text-indigo-700">{{ $warga->nama }}</strong> (NIK: {{ $warga->nik }})</p>
    </div>
    <div class="p-6">
        <form action="{{ route('penilaian.update', $warga->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                <label class="block text-sm font-bold text-gray-700 mb-2">Warga (Alternatif)</label>
                <input type="text" value="{{ $warga->nik }} - {{ $warga->nama }}" disabled
                       class="w-full px-3 py-2 border border-gray-300 rounded-md bg-white font-medium text-gray-700">
            </div>

            <div class="space-y-4 border-t pt-4">
                <h4 class="font-medium text-gray-700">Nilai Pada Kriteria:</h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach($kriterias as $k)
                    @php
                        $existing = $warga->penilaians->where('kriteria_id', $k->id)->first();
                    @endphp
                    <div class="bg-white border rounded-md p-4 shadow-sm hover:border-indigo-300 transition-colors">
                        <label class="block text-sm font-semibold text-indigo-900 mb-1">
                            {{ $k->kode }} - {{ $k->nama_kriteria }}
                        </label>
                        <select name="penilaian[{{ $k->id }}]" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500 text-sm">
                            <option value="">-- Pilih Nilai Sub Kriteria --</option>
                            @foreach($k->subKriterias as $sub)
                                <option value="{{ $sub->id }}" {{ $existing && $existing->sub_kriteria_id == $sub->id ? 'selected' : '' }}>
                                    {{ $sub->nama_sub }} (Nilai: {{ $sub->nilai }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="pt-4 flex justify-end space-x-3 border-t border-gray-200 mt-6">
                <a href="{{ route('penilaian.index') }}" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-md text-sm hover:bg-gray-200">Batal</a>
                <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md text-sm hover:bg-indigo-700">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
@endsection
