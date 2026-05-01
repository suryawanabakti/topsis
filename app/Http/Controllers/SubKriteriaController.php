<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubKriteria;
use App\Models\Kriteria;

class SubKriteriaController extends Controller
{
    public function index()
    {
        $subKriterias = SubKriteria::with('kriteria')->get();
        return view('sub_kriteria.index', compact('subKriterias'));
    }

    public function create()
    {
        $kriterias = Kriteria::all();
        return view('sub_kriteria.create', compact('kriterias'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kriteria_id' => 'required|exists:kriterias,id',
            'nama_sub' => 'required',
            'nilai' => 'required|integer',
        ]);
        SubKriteria::create($validated);
        return redirect()->route('sub_kriteria.index')->with('success', 'Sub Kriteria created successfully.');
    }

    public function edit(SubKriteria $subKriterium)
    {
        $sub_kriteria = $subKriterium;
        $kriterias = Kriteria::all();
        return view('sub_kriteria.edit', compact('sub_kriteria', 'kriterias'));
    }

    public function update(Request $request, SubKriteria $subKriterium)
    {
        $sub_kriteria = $subKriterium;
        $validated = $request->validate([
            'kriteria_id' => 'required|exists:kriterias,id',
            'nama_sub' => 'required',
            'nilai' => 'required|integer',
        ]);
        $sub_kriteria->update($validated);
        return redirect()->route('sub_kriteria.index')->with('success', 'Sub Kriteria updated successfully.');
    }

    public function destroy(SubKriteria $subKriterium)
    {
        $subKriterium->delete();
        return redirect()->route('sub_kriteria.index')->with('success', 'Sub Kriteria deleted successfully.');
    }
}
