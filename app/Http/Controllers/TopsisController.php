<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Kriteria;
use App\Models\Warga;

class TopsisController extends Controller
{
    public function index()
    {
        $data = $this->computeTopsis();

        if (isset($data['error'])) {
            return view('topsis.index', ['error' => $data['error']]);
        }

        return view('topsis.index', $data);
    }

    public function cetakPdf()
    {
        $data = $this->computeTopsis();

        if (isset($data['error'])) {
            return back()->with('error', $data['error']);
        }

        $pdf = Pdf::loadView('topsis.cetak', $data);
        return $pdf->download('laporan-ranking-topsis.pdf');
    }

    private function computeTopsis(): array
    {
        $kriterias = Kriteria::orderBy('kode', 'asc')->get();
        $wargas = Warga::with('penilaians.subKriteria')->get();

        if ($kriterias->isEmpty() || $wargas->isEmpty()) {
            return ['error' => 'Data Kriteria atau Warga masih kosong.'];
        }

        // 1. MATRIX KEPUTUSAN (X)
        $matrixX = [];
        foreach ($wargas as $warga) {
            foreach ($kriterias as $kriteria) {
                $penilaian = $warga->penilaians
                    ->where('kriteria_id', $kriteria->id)
                    ->first();

                $nilai = $penilaian && $penilaian->subKriteria
                    ? $penilaian->subKriteria->nilai
                    : 0;

                $matrixX[$warga->id][$kriteria->id] = $nilai;
            }
        }

        // 2. NORMALISASI PEMBAGI
        $pembagi = [];
        foreach ($kriterias as $kriteria) {
            $sumSq = 0;

            foreach ($wargas as $warga) {
                $sumSq += pow($matrixX[$warga->id][$kriteria->id], 2);
            }

            $pembagi[$kriteria->id] = sqrt($sumSq);
        }

        // 3. MATRIX NORMALISASI (R)
        $matrixR = [];
        foreach ($wargas as $warga) {
            foreach ($kriterias as $kriteria) {
                $pembagiVal = $pembagi[$kriteria->id];

                $matrixR[$warga->id][$kriteria->id] = $pembagiVal == 0
                    ? 0
                    : $matrixX[$warga->id][$kriteria->id] / $pembagiVal;
            }
        }

        // 4. NORMALISASI BOBOT
        $totalBobot = $kriterias->sum('bobot');

        $bobotNormal = [];
        foreach ($kriterias as $kriteria) {
            $bobotNormal[$kriteria->id] = $totalBobot == 0
                ? 0
                : $kriteria->bobot / $totalBobot;
        }

        // 5. MATRIX TERBOBOT (Y)
        $matrixY = [];
        foreach ($wargas as $warga) {
            foreach ($kriterias as $kriteria) {
                $matrixY[$warga->id][$kriteria->id] =
                    $matrixR[$warga->id][$kriteria->id] * $bobotNormal[$kriteria->id];
            }
        }

        // 6. SOLUSI IDEAL
        $A_plus = [];
        $A_min = [];

        foreach ($kriterias as $kriteria) {
            $kolom = array_column($matrixY, $kriteria->id);

            if (empty($kolom)) continue;

            if ($kriteria->tipe == 'benefit') {
                $A_plus[$kriteria->id] = max($kolom);
                $A_min[$kriteria->id] = min($kolom);
            } else {
                $A_plus[$kriteria->id] = min($kolom);
                $A_min[$kriteria->id] = max($kolom);
            }
        }

        // 7. JARAK D+ DAN D-
        $D_plus = [];
        $D_min = [];

        foreach ($wargas as $warga) {
            $sumPlus = 0;
            $sumMin = 0;

            foreach ($kriterias as $kriteria) {
                $y = $matrixY[$warga->id][$kriteria->id];
                $aPlus = $A_plus[$kriteria->id];
                $aMin = $A_min[$kriteria->id];

                $sumPlus += pow($y - $aPlus, 2);
                $sumMin += pow($y - $aMin, 2);
            }

            $D_plus[$warga->id] = sqrt($sumPlus);
            $D_min[$warga->id] = sqrt($sumMin);
        }

        // 8. NILAI PREFERENSI (V)
        $preferensi = [];

        foreach ($wargas as $warga) {
            $dPlus = $D_plus[$warga->id];
            $dMin = $D_min[$warga->id];

            $v = ($dPlus + $dMin) == 0
                ? 0
                : $dMin / ($dPlus + $dMin);

            $preferensi[] = [
                'warga' => $warga,
                'D_plus' => $dPlus,
                'D_min' => $dMin,
                'V' => $v
            ];
        }

        // 9. RANKING
        usort($preferensi, function ($a, $b) {
            return $b['V'] <=> $a['V'];
        });

        return compact(
            'kriterias',
            'wargas',
            'matrixX',
            'matrixR',
            'matrixY',
            'A_plus',
            'A_min',
            'D_plus',
            'D_min',
            'preferensi'
        );
    }
}
