<x-app-layout title="Tambah User">

<h1 class="text-xl font-bold mb-4">Tambah User</h1>

<form method="POST" action="{{ route('admin.users.store') }}" class="bg-white p-6 rounded shadow space-y-4">
    @csrf

    <input name="name" placeholder="Nama" class="w-full border p-2 rounded">
    <input name="email" placeholder="Email" class="w-full border p-2 rounded">
    @if(old('role') === 'magang')
    <div>
        <label>Asal Instansi</label>
        <input name="asal_instansi" class="border p-2 w-full">
    </div>

    <div>
        <label>Tanggal Mulai</label>
        <input type="date" name="tanggal_mulai" class="border p-2 w-full">
    </div>

    <div>
        <label>Tanggal Selesai</label>
        <input type="date" name="tanggal_selesai" class="border p-2 w-full">
    </div>
@endif

    
    <input name="password" type="password" placeholder="Password" class="w-full border p-2 rounded">

    <select name="role" class="w-full border p-2 rounded">
        <option value="magang">Magang</option>
        <option value="admin">Admin</option>
    </select>

    <button class="bg-indigo-600 text-white px-4 py-2 rounded">
        Simpan
    </button>
</form>

</x-app-layout>
