<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Magang;
use Illuminate\Http\Request;

class MagangController extends Controller
{
    public function index(Request $request)
    {
        $query = Magang::with('user');

        // Fitur Pencarian (Nama atau Instansi)
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->whereHas('user', function($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%");
            })->orWhere('asal_instansi', 'LIKE', "%{$search}%");
        }

        // Fitur Filter Status
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        $dataMagang = $query->latest()->get();

        return view('admin.magang.index', compact('dataMagang'));
    }

    public function updateStatus(Request $request, Magang $magang)
    {
        $request->validate(['status' => 'required|in:aktif,selesai,nonaktif']);
        $magang->update(['status' => $request->status]);

        return back()->with('success', 'Status peserta berhasil diubah!');
    }
}