<x-app-layout>

<div class="max-w-6xl mx-auto py-6">
    <h2 class="text-xl font-bold mb-4">Absensi Hari Ini</h2>

    <table class="w-full bg-white rounded shadow">
        <thead>
            <tr class="bg-gray-100">
                <th class="p-3 text-left">Nama</th>
                <th class="p-3">Tanggal</th>
                <th class="p-3">Jam Masuk</th>
                <th class="p-3">Jam Keluar</th>
                <th class="p-3">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($absensi as $a)
            <tr class="border-t">
                <td class="p-3">{{ $a->magang->user->name }}</td>
                <td class="p-3">{{ $a->tanggal }}</td>
                <td class="p-3">{{ $a->jam_masuk }}</td>
                <td class="p-3">{{ $a->jam_keluar ?? '-' }}</td>
                <td class="p-3">{{ $a->status }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="p-4 text-center text-gray-500">
                    Belum ada absensi hari ini
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
</x-app-layout>
