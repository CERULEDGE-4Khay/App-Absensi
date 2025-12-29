{{-- <!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        body { font-family: sans-serif; font-size: 11px; color: #333; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; table-layout: fixed; }
        th, td { border: 1px solid #ccc; padding: 6px; word-wrap: break-word; }
        th { background-color: #f3f4f6; font-weight: bold; }
        .text-center { text-align: center; }
        .header { text-align: center; margin-bottom: 20px; }
    </style>
</head>
<body>
    <div class="header">
        <h2 style="margin-bottom: 5px;">LAPORAN ABSENSI PESERTA MAGANG</h2>
        <p>Periode: {{ $awal }} s/d {{ $akhir }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th width="15%">Tanggal</th>
                <th width="25%">Nama</th>
                <th width="20%">Instansi</th>
                <th width="15%">Masuk</th>
                <th width="15%">Keluar</th>
                <th width="10%">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $a)
            <tr>
                <td class="text-center">{{ $a->tanggal }}</td>
                <td>{{ optional($a->magang->user)->name ?? 'Tanpa Nama' }}</td>
                <td>{{ optional($a->magang)->asal_instansi ?? '-' }}</td>
                <td class="text-center">{{ $a->jam_masuk ?: '-' }}</td>
                <td class="text-center">{{ $a->jam_keluar ?: '-' }}</td>
                <td class="text-center">{{ $a->status }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html> --}}

<html>
<head>
    <style>
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid black; padding: 5px; text-align: left; }
    </style>
</head>
<body>
    <h2>LAPORAN TEST</h2>
    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Nama</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $a)
            <tr>
                <td>{{ $a->tanggal }}</td>
                <td>{{ $a->magang->user->name ?? '-' }}</td>
                <td>{{ $a->status }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>