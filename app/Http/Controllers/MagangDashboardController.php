<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Services\GeofenceService;


class MagangDashboardController extends Controller
{
    public function index()
    {
    $magang = auth()->user()->magang;

    if (!$magang) {
    abort(403, 'Data magang belum dibuat');
    }

    $user = auth()->user();
    if ($user->magang && $user->magang->status === 'nonaktif') {
        return back()->with('error', 'Akun kamu sudah tidak aktif lagi, silakan konfirmasi ke admin.');
    }

    // 1. Hitung Total Hadir Bulan Ini
    $totalHadir = \App\Models\Absensi::where('magang_id', $magang->id)
        ->whereMonth('tanggal', now()->month)
        ->whereYear('tanggal', now()->year)
        ->where('status', 'hadir')
        ->count();

    // 2. Hitung Progress Bar Masa Magang
    $tglMulai = \Carbon\Carbon::parse($magang->tanggal_mulai);
    $tglSelesai = \Carbon\Carbon::parse($magang->tanggal_selesai);
    $totalDurasi = $tglMulai->diffInDays($tglSelesai);
    $durasiBerjalan = $tglMulai->diffInDays(now());
    
    // Pastikan persentase tidak lebih dari 100% atau kurang dari 0%
    $persentase = ($durasiBerjalan / $totalDurasi) * 100;
    $persentase = max(0, min(100, round($persentase)));

    // 3. Sisa Hari
    $sisaHari = now()->diffInDays($tglSelesai, false);
    $sisaHari = $sisaHari < 0 ? 0 : ceil($sisaHari);
    $sisaHari = (int)$sisaHari;

    $absensiHariIni = Absensi::where('magang_id', $magang->id)
        ->whereDate('tanggal', today())
        ->first();

    return view('dashboard.magang', [
        'magang' => $magang,
        'absensiHariIni' => $absensiHariIni,
        'totalHadir' => $totalHadir,
        'persentase' => $persentase,
        'sisaHari' => $sisaHari,
        'officeLat' => config('office.latitude'),
        'officeLon' => config('office.longitude'),
    ]);
    }


    public function absenMasuk(Request $request, GeofenceService $geo)
    {
    $request->validate([
        'latitude' => 'required|numeric',
        'longitude' => 'required|numeric',
    ]);

    $magang = auth()->user()->magang;

    if (!$magang) {
        abort(403);
    }

    // Lokasi kantor
    $officeLat = config('office.latitude');
    $officeLon = config('office.longitude');
    $maxDistance = config('office.max_distance_km');

    // Hitung jarak
    $distance = $geo->calculateDistance(
        $request->latitude,
        $request->longitude,
        $officeLat,
        $officeLon
    );

    if ($distance > $maxDistance) {
        return back()->with('error', 'Kamu berada di luar area absensi');
    }

    // Validasi jam masuk (contoh: max jam 09:00)
    if (now()->format('H:i') > '22:30') {
        return back()->with('error', 'Kamu terlambat absen');
    }

    if (Absensi::where('magang_id', $magang->id)
        ->whereDate('tanggal', today())
        ->exists()) {
        return back()->with('error', 'Kamu sudah absen masuk hari ini');
    }

    $absen = new Absensi();
    $absen->magang_id = $magang->id;
    $absen->tanggal = today();
    $absen->jam_masuk = now();
    $absen->status = 'Hadir';
    $absen->latitude = $request->latitude;
    $absen->longitude = $request->longitude;
    $absen->save();


    return back()->with('success', 'Absen masuk berhasil');
    }


    public function absenKeluar()
    {
        $magang = auth()->user()->magang;

        $absensi = Absensi::where('magang_id', $magang->id)
            ->whereDate('tanggal', today())
            ->first();

        if (!$absensi || $absensi->jam_keluar) {
            return back()->with('error', 'Belum absen masuk atau sudah absen keluar');
        }

        $absensi->update([
            'jam_keluar' => now()
        ]);

        return back()->with('success', 'Absen keluar berhasil');
    }

    public function riwayat()
    {
    $magang = auth()->user()->magang;

    if (!$magang) {
        abort(403, 'Data magang tidak ditemukan');
    }

    $riwayatAbsensi = Absensi::where('magang_id', $magang->id)
        ->orderBy('tanggal', 'desc')
        ->get();

    return view('dashboard.absensi-riwayat', compact('riwayatAbsensi'));
    }


}
