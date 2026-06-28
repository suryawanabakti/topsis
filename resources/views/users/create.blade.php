@extends('layouts.app')

@section('title', 'Tambah User')

@section('content')
<div class="bg-white rounded-lg shadow-sm overflow-hidden border border-gray-200 max-w-xl mx-auto">
    <div class="p-6 border-b border-gray-200">
        <h3 class="text-lg font-semibold text-gray-800">Form Tambah User</h3>
    </div>
    <div class="p-6">
        <form action="{{ route('users.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                <input type="text" name="name" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500" value="{{ old('name') }}">
                @error('name') <span class="text-xs text-red-600">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input type="email" name="email" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500" value="{{ old('email') }}">
                @error('email') <span class="text-xs text-red-600">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Role / Jabatan</label>
                <select name="role" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="">-- Pilih Role --</option>
                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Administrator</option>
                    <option value="kepala_dusun" {{ old('role') == 'kepala_dusun' ? 'selected' : '' }}>Kepala Dusun</option>
                    <option value="kepala_desa" {{ old('role') == 'kepala_desa' ? 'selected' : '' }}>Kepala Desa</option>
                    <option value="bpd" {{ old('role') == 'bpd' ? 'selected' : '' }}>BPD</option>
                </select>
                @error('role') <span class="text-xs text-red-600">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <input type="password" name="password" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                @error('password') <span class="text-xs text-red-600">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
            </div>
            <div class="bg-gray-50 rounded-lg p-4 text-xs text-gray-500 space-y-1 border border-gray-100">
                <p class="font-semibold text-gray-700 mb-2">Keterangan Hak Akses:</p>
                <p>🔴 <b>Administrator</b>: Akses penuh ke semua fitur (CRUD semua data & manajemen user)</p>
                <p>🔵 <b>Kepala Dusun</b>: Mengelola data warga (CRUD), melihat penilaian & hasil ranking</p>
                <p>🟢 <b>Kepala Desa</b>: Hanya dapat melihat data warga, kriteria, & hasil ranking</p>
                <p>🟡 <b>BPD</b>: Hanya dapat melihat data warga, kriteria, & hasil ranking</p>
            </div>
            <div class="pt-4 flex justify-end space-x-3 border-t border-gray-200">
                <a href="{{ route('users.index') }}" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-md text-sm hover:bg-gray-200">Batal</a>
                <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md text-sm hover:bg-indigo-700">Simpan User</button>
            </div>
        </form>
    </div>
</div>
@endsection
