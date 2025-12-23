<x-app-layout title="Edit User">

<h1 class="text-xl font-bold mb-4">Edit User</h1>

<form method="POST"
    action="{{ route('admin.users.update', $user) }}"
    class="bg-white p-6 rounded shadow space-y-4 max-w-lg">
    @csrf
    @method('PUT')

    {{-- NAMA --}}
    <div>
        <label class="block text-sm font-medium mb-1">Nama</label>
        <input name="name"
            value="{{ old('name', $user->name) }}"
            class="w-full border p-2 rounded">
    </div>

    {{-- EMAIL (READ ONLY) --}}
    <div>
        <label class="block text-sm font-medium mb-1">Email</label>
        <input value="{{ $user->email }}"
            disabled
            class="w-full border p-2 rounded bg-gray-100">
    </div>

    {{-- ROLE --}}
    <div>
        <label class="block text-sm font-medium mb-1">Role</label>
        <select name="role" class="w-full border p-2 rounded">
            <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>
                Admin
            </option>
            <option value="magang" {{ $user->role === 'magang' ? 'selected' : '' }}>
                Magang
            </option>
        </select>
    </div>

    <div class="flex gap-3">
        <button class="bg-indigo-600 text-white px-4 py-2 rounded">
            Simpan Perubahan
        </button>

        <a href="{{ route('admin.users.index') }}"
        class="px-4 py-2 rounded border">
            Batal
        </a>
    </div>
</form>

</x-app-layout>
