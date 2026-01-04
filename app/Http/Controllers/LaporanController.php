<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\LaporanService;
use App\Models\Magang;
use App\Models\LaporanLog;
use Illuminate\Support\Facades\Auth;
class LaporanController extends Controller
{
public function __construct(
        protected LaporanService $laporanService // Hapus tanda backslash (\)
    ) {}

    public function index()
    {
    $logs = LaporanLog::with('user')->latest()->take(5)->get();
    return view('admin.laporan.index', compact('logs'));
    }
    public function generate(Request $request)
{
    $request->validate([
        'awal' => 'required|date',
        'akhir' => 'required|date|after_or_equal:awal',
        'format' => 'required|in:excel,pdf'
    ]);

    // Berikan nama file di level Controller agar browser tidak bingung
    if ($request->format === 'excel') {
        $namaFile = 'rekap-absensi-' . $request->awal . '-ke-' . $request->akhir . '.xlsx'; // TAMBAHKAN .xlsx
    } else {
        $namaFile = 'rekap-absensi-' . $request->awal . '-ke-' . $request->akhir . '.pdf'; // TAMBAHKAN .pdf
    }

    LaporanLog::create([
        'user_id' => Auth::id(),
        'format' => $request->format,
        'periode_awal' => $request->awal,
        'periode_akhir' => $request->akhir,
    ]);

    return $this->laporanService->generate(
        $request->awal,
        $request->akhir,
        $request->format,
                $namaFile // Tambahkan parameter nama file ke service
    );
    }

public function preview(Request $request)
{
    try {
        $awal = $request->awal;
        $akhir = $request->akhir;

        // Pastikan input tanggal ada
        if (!$awal || !$akhir) {
            return response()->json(['error' => 'Tanggal harus diisi'], 400);
        }

        // Ambil data Magang yang memiliki relasi User (menghindari crash)
        $data = Magang::whereHas('user')
            ->with(['user', 'absensi' => function($q) use ($awal, $akhir) {
                $q->whereBetween('tanggal', [$awal, $akhir]);
            }])
            ->get()
            ->map(function($m) {
                // Menghitung statistik dari relasi yang sudah difilter di atas
                $hadir = $m->absensi->where('status', 'Hadir')->count();
                $telat = $m->absensi->filter(function($a) {
                    return $a->jam_masuk > '08:00:00';
                })->count();

                return [
                    'nama' => $m->user->name,
                    'instansi' => $m->asal_instansi ?? '-',
                    'hadir' => $hadir,
                    'telat' => $telat,
                    'status' => $m->status
                ];
            });

        return response()->json($data);

    } catch (\Exception $e) {
        // Jika masih error, pesan ini akan muncul di tab Network > Response
        return response()->json([
            'message' => 'Terjadi kesalahan server',
            'error' => $e->getMessage()
        ], 500);
    }
}
}
