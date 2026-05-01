<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kriteria;

class KriteriaController extends Controller
{
    public function index()
    {
        $kriterias = Kriteria::orderBy('kode', 'asc')->get();
        return view('kriteria.index', compact('kriterias'));
    }

    public function create()
    {
        return view('kriteria.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode' => 'required|unique:kriterias',
            'nama_kriteria' => 'required',
            'tipe' => 'required|in:benefit,cost',
            'bobot' => 'required|numeric',
        ]);
        Kriteria::create($validated);
        return redirect()->route('kriteria.index')->with('success', 'Kriteria created successfully.');
    }

    public function edit(Kriteria $kriterium) // Laravel uses singular 'kriterium' sometimes based on kriteria
    {
        $kriteria = $kriterium;
        return view('kriteria.edit', compact('kriteria'));
    }

    public function update(Request $request, Kriteria $kriterium)
    {
        $kriteria = $kriterium;
        $validated = $request->validate([
            'kode' => 'required|unique:kriterias,kode,'.$kriteria->id,
            'nama_kriteria' => 'required',
            'tipe' => 'required|in:benefit,cost',
            'bobot' => 'required|numeric',
        ]);
        $kriteria->update($validated);
        return redirect()->route('kriteria.index')->with('success', 'Kriteria updated successfully.');
    }

    public function destroy(Kriteria $kriterium)
    {
        $kriterium->delete();
        return redirect()->route('kriteria.index')->with('success', 'Kriteria deleted successfully.');
    }
}
