<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penilaian;
use App\Models\Warga;
use App\Models\Kriteria;

class PenilaianController extends Controller
{
    public function index()
    {
        $wargas = Warga::with(['penilaians.kriteria', 'penilaians.subKriteria'])->get();
        $kriterias = Kriteria::orderBy('kode', 'asc')->get();
        return view('penilaian.index', compact('wargas', 'kriterias'));
    }

    public function create()
    {
        $wargas = Warga::all();
        $kriterias = Kriteria::with('subKriterias')->get();
        return view('penilaian.create', compact('wargas', 'kriterias'));
    }

    public function edit(Warga $warga)
    {
        $warga->load(['penilaians']);
        $kriterias = Kriteria::with('subKriterias')->get();
        return view('penilaian.edit', compact('warga', 'kriterias'));
    }

    public function update(Request $request, Warga $warga)
    {
        $penilaianData = $request->penilaian;

        if($penilaianData) {
            foreach($penilaianData as $kriteria_id => $sub_kriteria_id) {
                $sub = \App\Models\SubKriteria::find($sub_kriteria_id);
                if($sub) {
                    Penilaian::updateOrCreate(
                        ['warga_id' => $warga->id, 'kriteria_id' => $kriteria_id],
                        ['sub_kriteria_id' => $sub_kriteria_id, 'nilai' => $sub->nilai]
                    );
                }
            }
        }
        return redirect()->route('penilaian.index')->with('success', 'Penilaian updated successfully.');
    }

    public function store(Request $request)
    {
        $warga_id = $request->warga_id;
        $penilaianData = $request->penilaian; // array of kriteria_id => sub_kriteria_id

        if($penilaianData) {
            foreach($penilaianData as $kriteria_id => $sub_kriteria_id) {
                // Find sub kriteria value
                $sub = \App\Models\SubKriteria::find($sub_kriteria_id);
                if($sub) {
                    Penilaian::updateOrCreate(
                        ['warga_id' => $warga_id, 'kriteria_id' => $kriteria_id],
                        ['sub_kriteria_id' => $sub_kriteria_id, 'nilai' => $sub->nilai]
                    );
                }
            }
        }
        return redirect()->route('penilaian.index')->with('success', 'Penilaian saved successfully.');
    }
}
