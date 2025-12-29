<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absensi;
use App\Models\Magang;

class AdminDashboardController extends Controller
{
public function index()
{
    $today = now()->timezone('Asia/Jakarta');

    $chartData = [];

    // ambil 7 hari terakhir
    for ($i = 6; $i >= 0; $i--) {
        $date = $today->copy()->subDays($i)->toDateString();

        $chartData[] = [
            'tanggal' => $date,
            'jumlah' => Absensi::whereDate('tanggal', $date)->count()
        ];
    }

    // 1. Fitur: Masa Magang Akan Berakhir (dalam 7 hari ke depan)
    $mendatang = Magang::with('user')
        ->where('status', 'aktif')
        ->whereBetween('tanggal_selesai', [now(), now()->addDays(7)])
        ->orderBy('tanggal_selesai', 'asc')
        ->get();

    // 2. Fitur: Aktivitas Terbaru (Kita ambil dari absensi terbaru)
    $aktivitas = Absensi::with('magang.user')
        ->latest()
        ->take(5)
        ->get();

    return view('dashboard.admin', [
        'totalMagang' => Magang::where('status','aktif')->count(),
        'hadirHariIni' => Absensi::whereDate('tanggal',$today)->count(),
        'belumAbsen' => Magang::where('status','aktif')->count()
            - Absensi::whereDate('tanggal',$today)->count(),
        'terlambat' => Absensi::whereDate('tanggal',$today)
            ->where('jam_masuk','>', '08:00:00')->count(),
        'absensiHariIni' => Absensi::with('magang.user')
            ->whereDate('tanggal',$today)
            ->latest()->take(5)->get(),
        'chartData' => $chartData,
        'pesertaMendatang' => $mendatang,
        'aktivitasTerbaru' => $aktivitas
    ]);
}

}
