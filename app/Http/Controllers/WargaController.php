<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Warga;

class WargaController extends Controller
{
    public function index()
    {
        $wargas = Warga::latest()->get();
        return view('warga.index', compact('wargas'));
    }

    public function create()
    {
        return view('warga.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nik' => 'required|unique:wargas',
            'nama' => 'required',
            'alamat' => 'required',
            'jenis_kelamin' => 'required',
            'pekerjaan' => 'required',
        ]);
        Warga::create($validated);
        return redirect()->route('warga.index')->with('success', 'Warga created successfully.');
    }

    public function edit(Warga $warga)
    {
        return view('warga.edit', compact('warga'));
    }

    public function update(Request $request, Warga $warga)
    {
        $validated = $request->validate([
            'nik' => 'required|unique:wargas,nik,'.$warga->id,
            'nama' => 'required',
            'alamat' => 'required',
            'jenis_kelamin' => 'required',
            'pekerjaan' => 'required',
        ]);
        $warga->update($validated);
        return redirect()->route('warga.index')->with('success', 'Warga updated successfully.');
    }

    public function destroy(Warga $warga)
    {
        $warga->delete();
        return redirect()->route('warga.index')->with('success', 'Warga deleted successfully.');
    }
}
