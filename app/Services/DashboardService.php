<?php

use App\Models\Magang;
use App\Models\Absensi;
class DashboardService
{
    public function getData()
    {
        $hadir = Absensi::whereDate('tanggal', today())->count();
        $totalMagang = Magang::where('status','aktif')->count();

        return [
            'total_magang' => $totalMagang,
            'hadir' => $hadir,
            'belum_absen' => $totalMagang - $hadir
        ];
    }
}
