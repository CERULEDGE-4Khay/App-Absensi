<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Magang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    public function index()
    {
        return view('admin.users.index', [
            'users' => User::latest()->get()
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
            'tanggal_mulai' => 'required_if:role,magang|date',
            'tanggal_selesai' => 'required_if:role,magang|date|after:tanggal_mulai',
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
}
