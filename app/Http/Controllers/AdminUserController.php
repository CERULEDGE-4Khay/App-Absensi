<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Magang;
use App\Models\Absensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        // Logika Search (Nama atau Email)
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                ->orWhere('email', 'LIKE', "%{$search}%");
            });
        }

        // Logika Filter Role
        if ($request->has('role') && $request->role != '') {
            $query->where('role', $request->role);
        }

        // Gunakan paginate jika datanya sudah banyak (opsional, ganti .get() jadi .paginate(10))
        $users = $query->latest()->get();

        return view('admin.users.index', [
            'users' => $users
        ]);
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role' => 'required|in:admin,magang',

             // KHUSUS MAGANG
            'asal_instansi' => 'required_if:role,magang',
            'tanggal_mulai' => 'required_if:role,magang|nullable|date',
            'tanggal_selesai' => 'required_if:role,magang|nullable|date|after:tanggal_mulai',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

    if ($request->role === 'magang') {
        Magang::create([
            'user_id' => $user->id,
            'nama' => $user->name,
            'email' => $user->email,
            'asal_instansi' => $request->asal_instansi,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'status' => 'aktif'
        ]);
    }


        return redirect()->route('admin.users.index')
            ->with('success','User berhasil dibuat');
    }

    public function edit(User $user)
    {
    return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
    $request->validate([
        'name' => 'required',
        'role' => 'required|in:admin,magang'
    ]);

    $user->update([
        'name' => $request->name,
        'role' => $request->role
    ]);

    return redirect()->route('admin.users.index')
        ->with('success', 'User berhasil diperbarui');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->back()->with('success', 'User dan semua data terkait berhasil dihapus!');
    }
}
