<?php

use App\Models\Laporan;
use App\Models\Absensi;
class LaporanService
{
    public function generate($awal, $akhir)
    {
        $totalHadir = Absensi::whereBetween('tanggal', [$awal, $akhir])->count();

        return Laporan::create([
            'periode_awal' => $awal,
            'periode_akhir' => $akhir,
            'total_hadir' => $totalHadir,
            'tanggal_generate' => now()
        ]);
    }
}
