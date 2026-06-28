<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Hasil Perankingan TOPSIS</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 10px;
            color: #333;
            margin: 20px;
        }
        h1 {
            text-align: center;
            font-size: 16px;
            margin-bottom: 4px;
        }
        h2 {
            text-align: center;
            font-size: 12px;
            font-weight: normal;
            margin-top: 0;
            margin-bottom: 20px;
            color: #666;
        }
        h3 {
            font-size: 11px;
            margin: 15px 0 5px;
            color: #444;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
            font-size: 9px;
        }
        th, td {
            border: 1px solid #999;
            padding: 4px 6px;
            text-align: center;
        }
        th {
            background-color: #e0e7ff;
            font-weight: bold;
        }
        td.left {
            text-align: left;
        }
        .rank-1 {
            background-color: #fef9c3;
        }
        .footer {
            margin-top: 30px;
            text-align: right;
            font-size: 9px;
            color: #666;
        }
        .page-break {
            page-break-before: always;
        }
    </style>
</head>
<body>
    <h1>LAPORAN HASIL PERANGKINGAN</h1>
    <h2>Metode TOPSIS &mdash; Seleksi Penerima BLT Desa Turungan Baji</h2>

    <h3>Hasil Perankingan</h3>
    <table>
        <thead>
            <tr>
                <th>Rank</th>
                <th class="left">Nama Warga</th>
                <th class="left">NIK</th>
                <th>Jarak D+</th>
                <th>Jarak D-</th>
                <th>Nilai Preferensi (V)</th>
            </tr>
        </thead>
        <tbody>
            @foreach($preferensi as $idx => $pref)
            <tr class="{{ $idx == 0 ? 'rank-1' : '' }}">
                <td><strong>{{ $idx + 1 }}</strong></td>
                <td class="left"><strong>{{ $pref['warga']->nama }}</strong></td>
                <td class="left">{{ $pref['warga']->nik }}</td>
                <td>{{ number_format($pref['D_plus'], 4) }}</td>
                <td>{{ number_format($pref['D_min'], 4) }}</td>
                <td><strong>{{ number_format($pref['V'], 4) }}</strong></td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        Dicetak pada: {{ now()->translatedFormat('d F Y H:i') }}
    </div>
</body>
</html>
