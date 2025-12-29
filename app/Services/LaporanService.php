<?php

namespace App\Services;

use App\Models\Laporan;
use App\Models\Absensi;
use App\Exports\AbsensiExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\LaporanController;

class LaporanService
{
// Tambahkan $namaFile di akhir parameter
public function generate($awal, $akhir, $format, $namaFile) 
{
    // 1. Simpan ke database
    Laporan::create([
        'periode_awal' => $awal,
        'periode_akhir' => $akhir,
        'total_hadir' => Absensi::whereBetween('tanggal', [$awal, $akhir])->count(),
        'tanggal_generate' => now()
    ]);

    // 2. Ambil data
    $dataAbsensi = Absensi::with('magang.user')
                    ->whereBetween('tanggal', [$awal, $akhir])
                    ->orderBy('tanggal', 'asc')->get();

    // 3. Logika Download
    if ($format === 'excel') {
        // Gunakan $namaFile di sini juga biar rapi
        return Excel::download(new AbsensiExport($awal, $akhir), $namaFile);
    }

    if ($format === 'pdf') {
        ini_set('memory_limit', '512M');
        set_time_limit(0);

        if($dataAbsensi->isEmpty()){
            return back()->with('error', 'Tidak ada data untuk periode ini.');
        }

        $pdf = Pdf::loadView('admin.laporan.pdf_template', [
            'data' => $dataAbsensi,
            'awal' => $awal,
            'akhir' => $akhir
        ]);

        $pdf->setPaper('a4', 'portrait')
            ->setOptions([
                'isRemoteEnabled' => false,
                'isHtml5ParserEnabled' => true,
                'isFontSubsettingEnabled' => false,
                'defaultFont' => 'sans-serif'
            ]);
        
        // Sekarang $namaFile sudah terdefinisi karena sudah diterima di parameter atas
        return $pdf->stream($namaFile);
    }
}
}