@extends('layouts.app')

@section('title', 'Tambah Data Sub Kriteria')

@section('content')
<div class="bg-white rounded-lg shadow-sm overflow-hidden border border-gray-200 max-w-2xl mx-auto">
    <div class="p-6 border-b border-gray-200">
        <h3 class="text-lg font-semibold text-gray-800">Form Tambah Sub Kriteria</h3>
    </div>
    <div class="p-6">
        <form action="{{ route('sub_kriteria.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Kriteria</label>
                <select name="kriteria_id" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="">Pilih Kriteria</option>
                    @foreach($kriterias as $k)
                        <option value="{{ $k->id }}" {{ old('kriteria_id') == $k->id ? 'selected' : '' }}>{{ $k->kode }} - {{ $k->nama_kriteria }}</option>
                    @endforeach
                </select>
                @error('kriteria_id') <span class="text-xs text-red-600">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Sub Kriteria</label>
                <input type="text" name="nama_sub" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500" value="{{ old('nama_sub') }}" placeholder="Contoh: Sangat Baik / > 5000000">
                @error('nama_sub') <span class="text-xs text-red-600">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nilai (Angka)</label>
                <input type="number" name="nilai" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500" value="{{ old('nilai') }}" placeholder="1, 2, 3, 4, 5">
                @error('nilai') <span class="text-xs text-red-600">{{ $message }}</span> @enderror
            </div>
            
            <div class="pt-4 flex justify-end space-x-3 border-t border-gray-200 mt-6">
                <a href="{{ route('sub_kriteria.index') }}" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-md text-sm hover:bg-gray-200">Batal</a>
                <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md text-sm hover:bg-indigo-700">Simpan Data</button>
            </div>
        </form>
    </div>
</div>
@endsection
