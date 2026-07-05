@extends('layouts.app')

@section('title', 'Dashboard — SISTEM PENDUKUNG KEPUTUSAN PENERIMA BANTUAN SOSIAL LANSUNG TUNAI DANA DESA')

@section('content')
<div class="space-y-6">
    <!-- Village Header Banner -->
    <div class="bg-gradient-to-r from-indigo-700 to-indigo-900 rounded-xl p-5 text-white shadow-md">
        <div class="flex items-center gap-4">
            <div class="flex-shrink-0">
                <img src="{{ asset('logo.png') }}" alt="Logo" class="w-32 h-32 object-contain">
            </div>
            <div>
                <p class="text-indigo-200 text-xs uppercase tracking-widest font-semibold">SISTEM PENDUKUNG KEPUTUSAN PENERIMA BANTUAN SOSIAL LANSUNG TUNAI - DANA DESA</p>
                <h2 class="text-xl lg:text-2xl font-bold tracking-tight">BANTUAN SOSIAL LANGSUNG TUNAI - DANA DESA</h2>
                <p class="text-indigo-300 text-sm">Desa Turungan Baji, Kec. Sinjai Barat, Kab. Sinjai</p>
            </div>
        </div>
    </div>
    <!-- Stats Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <div class="bg-white overflow-hidden shadow-sm rounded-xl border border-gray-100">
            <div class="p-5 flex items-center">
                <div class="flex-shrink-0 bg-indigo-100 rounded-md p-3">
                    <svg class="h-6 w-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500">Total Warga</p>
                    <p class="text-2xl font-bold text-gray-900">{{ \App\Models\Warga::count() }}</p>
                </div>
            </div>
        </div>
        <div class="bg-white overflow-hidden shadow-sm rounded-xl border border-gray-100">
            <div class="p-5 flex items-center">
                <div class="flex-shrink-0 bg-green-100 rounded-md p-3">
                    <svg class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" /></svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500">Total Kriteria</p>
                    <p class="text-2xl font-bold text-gray-900">{{ \App\Models\Kriteria::count() }}</p>
                </div>
            </div>
        </div>
        <div class="bg-white overflow-hidden shadow-sm rounded-xl border border-gray-100">
            <div class="p-5 flex items-center">
                <div class="flex-shrink-0 bg-purple-100 rounded-md p-3">
                    <svg class="h-6 w-6 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" /></svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500">Total Penilaian</p>
                    <p class="text-2xl font-bold text-gray-900">{{ \App\Models\Penilaian::count() }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="bg-white shadow-sm rounded-xl border border-gray-100 p-5">
        <h3 class="text-base font-semibold text-gray-700 mb-2">SISTEM PENDUKUNG KEPUTUSAN PENERIMA BANTUAN SOSIAL LANSUNG TUNAI DANA DESA - Metode TOPSIS</h3>
        <p class="text-sm text-gray-500 mb-4">Gunakan menu di sidebar untuk mengelola data warga, kriteria, sub kriteria, dan penilaian. Setelah data lengkap, lihat hasil perankingan TOPSIS.</p>
        <a href="{{ route('topsis.index') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-md hover:bg-indigo-700 transition-colors">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
            Lihat Hasil Perhitungan TOPSIS
        </a>
    </div>

    <!-- Quick Links Grid -->
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
        <a href="{{ route('warga.index') }}" class="bg-white p-4 rounded-xl border border-gray-100 shadow-sm hover:border-indigo-300 hover:shadow-md transition-all text-center">
            <svg class="w-7 h-7 mx-auto text-indigo-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1z" /></svg>
            <p class="text-xs font-semibold text-gray-600">Data Warga</p>
        </a>
        <a href="{{ route('kriteria.index') }}" class="bg-white p-4 rounded-xl border border-gray-100 shadow-sm hover:border-green-300 hover:shadow-md transition-all text-center">
            <svg class="w-7 h-7 mx-auto text-green-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3" /></svg>
            <p class="text-xs font-semibold text-gray-600">Kriteria</p>
        </a>
        <a href="{{ route('sub_kriteria.index') }}" class="bg-white p-4 rounded-xl border border-gray-100 shadow-sm hover:border-orange-300 hover:shadow-md transition-all text-center">
            <svg class="w-7 h-7 mx-auto text-orange-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16" /></svg>
            <p class="text-xs font-semibold text-gray-600">Sub Kriteria</p>
        </a>
        <a href="{{ route('penilaian.index') }}" class="bg-white p-4 rounded-xl border border-gray-100 shadow-sm hover:border-purple-300 hover:shadow-md transition-all text-center">
            <svg class="w-7 h-7 mx-auto text-purple-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10" /></svg>
            <p class="text-xs font-semibold text-gray-600">Penilaian</p>
        </a>
    </div>
</div>
@endsection
