<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RedirectController extends Controller
{
    public function __invoke()
    {
        $user = auth()->user();

        if ($user->role === 'admin') {
            return redirect()->route('dashboard.admin');
        }

        if ($user->role === 'magang') {
            return redirect()->route('dashboard.magang');
        }

        // fallback aman
        auth()->logout();
        return redirect('/login')
            ->withErrors(['Akun tidak memiliki akses dashboard']);
    }
}

