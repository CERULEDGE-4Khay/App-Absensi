<x-app-layout title="Kelola User">

<h1 class="text-xl font-bold mb-4">Kelola User</h1>

<table class="w-full bg-white rounded shadow">
    <thead class="bg-gray-100">
        <tr>
            <th class="p-3 text-left">Nama</th>
            <th>Email</th>
            <th>Role</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $u)
        <tr class="border-t">
            <td class="p-3">{{ $u->name }}</td>
            <td>{{ $u->email }}</td>
            <td>
                <span class="px-2 py-1 text-xs rounded
                    {{ $u->role === 'admin' ? 'bg-indigo-100 text-indigo-700' : 'bg-green-100 text-green-700' }}">
                    {{ ucfirst($u->role) }}
                </span>
            </td>
            <td>
                <a href="{{ route('admin.users.edit', $u->id) }}"
                    class="text-indigo-600 hover:underline">
                    Edit
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

</x-app-layout>
