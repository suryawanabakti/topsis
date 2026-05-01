@extends('layouts.app')

@section('title', 'Tambah Data Kriteria')

@section('content')
<div class="bg-white rounded-lg shadow-sm overflow-hidden border border-gray-200 max-w-2xl mx-auto">
    <div class="p-6 border-b border-gray-200">
        <h3 class="text-lg font-semibold text-gray-800">Form Tambah Kriteria</h3>
    </div>
    <div class="p-6">
        <form action="{{ route('kriteria.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Kode Kriteria</label>
                <input type="text" name="kode" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500" value="{{ old('kode') }}" placeholder="C1">
                @error('kode') <span class="text-xs text-red-600">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Kriteria</label>
                <input type="text" name="nama_kriteria" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500" value="{{ old('nama_kriteria') }}">
                @error('nama_kriteria') <span class="text-xs text-red-600">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Tipe</label>
                <select name="tipe" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="">Pilih Tipe</option>
                    <option value="benefit" {{ old('tipe') == 'benefit' ? 'selected' : '' }}>Benefit (Keuntungan)</option>
                    <option value="cost" {{ old('tipe') == 'cost' ? 'selected' : '' }}>Cost (Biaya)</option>
                </select>
                @error('tipe') <span class="text-xs text-red-600">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Bobot (Angka)</label>
                <input type="number" step="0.01" name="bobot" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500" value="{{ old('bobot') }}">
                @error('bobot') <span class="text-xs text-red-600">{{ $message }}</span> @enderror
            </div>
            
            <div class="pt-4 flex justify-end space-x-3 border-t border-gray-200 mt-6">
                <a href="{{ route('kriteria.index') }}" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-md text-sm hover:bg-gray-200">Batal</a>
                <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md text-sm hover:bg-indigo-700">Simpan Data</button>
            </div>
        </form>
    </div>
</div>
@endsection
