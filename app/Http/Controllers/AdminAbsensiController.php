<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absensi;

class AdminAbsensiController extends Controller
{
    public function index()
    {
        $absensi = Absensi::with('magang.user')
            ->latest()
            ->paginate(10);

        return view('admin.absensi', compact('absensi'));
    }
}

