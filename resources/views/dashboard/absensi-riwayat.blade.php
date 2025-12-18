<x-app-layout>
    <div class="max-w-6xl mx-auto py-6">

        <h2 class="text-2xl font-bold mb-6">
            Riwayat Absensi
        </h2>

        <div class="bg-white shadow rounded-xl overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-3 text-left">Tanggal</th>
                        <th class="px-4 py-3 text-left">Jam Masuk</th>
                        <th class="px-4 py-3 text-left">Jam Keluar</th>
                        <th class="px-4 py-3 text-left">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($riwayatAbsensi as $absen)
                        <tr class="border-t">
                            <td class="px-4 py-2">
                                {{ \Carbon\Carbon::parse($absen->tanggal)->format('d F Y') }}
                            </td>
                            <td class="px-4 py-2">
                                {{ $absen->jam_masuk ?? '-' }}
                            </td>
                            <td class="px-4 py-2">
                                {{ $absen->jam_keluar ?? '-' }}
                            </td>
                            <td class="px-4 py-2">
                                <span class="px-2 py-1 rounded text-white text-xs
                                    {{ $absen->status === 'Hadir' ? 'bg-green-600' : 'bg-red-600' }}">
                                    {{ $absen->status }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-6 text-gray-500">
                                Belum ada data absensi
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            <a href="{{ route('dashboard.magang') }}"
            class="text-blue-600 hover:underline">
                ← Kembali ke Dashboard
            </a>
        </div>

    </div>
</x-app-layout>
