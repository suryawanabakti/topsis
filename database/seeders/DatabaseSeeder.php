<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Warga;
use App\Models\Kriteria;
use App\Models\SubKriteria;
use App\Models\Penilaian;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'name'     => 'Admin',
            'email'    => 'admin@gmail.com',
            'password' => bcrypt('password'),
            'role'     => 'admin',
        ]);

        // =============================================
        // KRITERIA (8 Kriteria SPK Bantuan Sosial)
        // =============================================
        $kriterias = [
            ['kode' => 'C1', 'nama_kriteria' => 'Lansia',                                                          'tipe' => 'benefit', 'bobot' => 15],
            ['kode' => 'C2', 'nama_kriteria' => 'Keluarga Desil 1 Sasaran P3KE',                                  'tipe' => 'benefit', 'bobot' => 20],
            ['kode' => 'C3', 'nama_kriteria' => 'Keluarga Desil 2 s.d P3KE',                                      'tipe' => 'benefit', 'bobot' => 15],
            ['kode' => 'C4', 'nama_kriteria' => 'Kehilangan Mata Pencaharian',                                    'tipe' => 'benefit', 'bobot' => 15],
            ['kode' => 'C5', 'nama_kriteria' => 'Memiliki Anggota Keluarga Rentan Sakit Menahun/Kronis/Difabel',  'tipe' => 'benefit', 'bobot' => 15],
            ['kode' => 'C6', 'nama_kriteria' => 'Tidak Menerima Bantuan Sosial Program Keluarga Harapan (PKH)',   'tipe' => 'benefit', 'bobot' => 10],
            ['kode' => 'C7', 'nama_kriteria' => 'Rumah Tangga dengan Anggota Tunggal Lanjut Usia',               'tipe' => 'benefit', 'bobot' => 5],
            ['kode' => 'C8', 'nama_kriteria' => 'Perempuan Kepala Keluarga dari Keluarga Miskin',                 'tipe' => 'benefit', 'bobot' => 5],
        ];

        $kriteriaModels = [];
        foreach ($kriterias as $k) {
            $kriteriaModels[$k['kode']] = Kriteria::create($k);
        }

        // =============================================
        // SUB KRITERIA (Semua bernilai 1 = Ya, 0 = Tidak)
        // =============================================
        $subKriteriaMap = []; // ['C1' => ['Ya' => SubKriteria, 'Tidak' => SubKriteria], ...]

        foreach ($kriteriaModels as $kode => $k) {
            $ya    = SubKriteria::create(['kriteria_id' => $k->id, 'nama_sub' => 'Ya',    'nilai' => 1]);
            $tidak = SubKriteria::create(['kriteria_id' => $k->id, 'nama_sub' => 'Tidak', 'nilai' => 0]);
            $subKriteriaMap[$kode] = ['Ya' => $ya, 'Tidak' => $tidak];
        }

        // =============================================
        // DATA WARGA (5 Alternatif)
        // =============================================
        $wargas = [
            ['nik' => '7301010101010001', 'nama' => 'Siti Aminah',      'alamat' => 'Jl. Mangga No. 1, Kec. Tamalate',          'jenis_kelamin' => 'P', 'pekerjaan' => 'Ibu Rumah Tangga'],
            ['nik' => '7301010101010002', 'nama' => 'Ahmad Sulaiman',   'alamat' => 'Jl. Nangka No. 5, Kec. Rappocini',         'jenis_kelamin' => 'L', 'pekerjaan' => 'Buruh Harian Lepas'],
            ['nik' => '7301010101010003', 'nama' => 'Hasnawati',        'alamat' => 'Jl. Cempaka No. 3, Kec. Panakkukang',      'jenis_kelamin' => 'P', 'pekerjaan' => 'Pedagang Kecil'],
            ['nik' => '7301010101010004', 'nama' => 'Baharuddin',       'alamat' => 'Jl. Melati No. 12, Kec. Bontoala',         'jenis_kelamin' => 'L', 'pekerjaan' => 'Nelayan'],
            ['nik' => '7301010101010005', 'nama' => 'Nurhaedah',        'alamat' => 'Jl. Kenanga No. 7, Kec. Makassar',         'jenis_kelamin' => 'P', 'pekerjaan' => 'Tidak Bekerja'],
        ];

        $wargaModels = [];
        foreach ($wargas as $w) {
            $wargaModels[] = Warga::create($w);
        }

        // =============================================
        // PENILAIAN
        // Format: [C1, C2, C3, C4, C5, C6, C7, C8]
        // Ya = 1, Tidak = 0
        // =============================================
        $penilaianData = [
            // Siti Aminah: Lansia, Desil1, -, Kehilangan Kerja, -, Tidak PKH, -, Perempuan Kepala Keluarga
            0 => ['C1' => 'Ya', 'C2' => 'Ya', 'C3' => 'Tidak', 'C4' => 'Ya', 'C5' => 'Tidak', 'C6' => 'Ya', 'C7' => 'Tidak', 'C8' => 'Ya'],
            // Ahmad Sulaiman: -, Desil1, -, -, Anggota Sakit, -, -, -
            1 => ['C1' => 'Tidak', 'C2' => 'Ya', 'C3' => 'Tidak', 'C4' => 'Tidak', 'C5' => 'Ya', 'C6' => 'Tidak', 'C7' => 'Tidak', 'C8' => 'Tidak'],
            // Hasnawati: -, Desil1, Desil2, Kehilangan Kerja, -, Tidak PKH, -, Perempuan Kepala Keluarga
            2 => ['C1' => 'Tidak', 'C2' => 'Ya', 'C3' => 'Ya', 'C4' => 'Ya', 'C5' => 'Tidak', 'C6' => 'Ya', 'C7' => 'Tidak', 'C8' => 'Ya'],
            // Baharuddin: Lansia, -, -, Kehilangan Kerja, Anggota Sakit, Tidak PKH, Tinggal Sendiri, -
            3 => ['C1' => 'Ya', 'C2' => 'Tidak', 'C3' => 'Tidak', 'C4' => 'Ya', 'C5' => 'Ya', 'C6' => 'Ya', 'C7' => 'Ya', 'C8' => 'Tidak'],
            // Nurhaedah: Lansia, Desil1, -, -, -, Tidak PKH, Tinggal Sendiri, Perempuan Kepala Keluarga
            4 => ['C1' => 'Ya', 'C2' => 'Ya', 'C3' => 'Tidak', 'C4' => 'Tidak', 'C5' => 'Tidak', 'C6' => 'Ya', 'C7' => 'Ya', 'C8' => 'Ya'],
        ];

        foreach ($penilaianData as $wargaIdx => $kriteriaJawaban) {
            $warga = $wargaModels[$wargaIdx];
            foreach ($kriteriaJawaban as $kode => $jawaban) {
                $kriteria = $kriteriaModels[$kode];
                $sub      = $subKriteriaMap[$kode][$jawaban];
                Penilaian::create([
                    'warga_id'       => $warga->id,
                    'kriteria_id'    => $kriteria->id,
                    'sub_kriteria_id' => $sub->id,
                    'nilai'          => $sub->nilai,
                ]);
            }
        }
    }
}
