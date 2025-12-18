<x-app-layout>
<div class="bg-[#F5F7FB] min-h-screen px-8 py-6">
    <!-- HEADER -->
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-2xl font-bold">Admin Dashboard</h1>

        <div class="flex items-center gap-4">
            <input type="text" placeholder="Search..."
                class="px-4 py-2 rounded-xl border text-sm">
            <div class="w-9 h-9 rounded-full bg-indigo-600 text-white flex items-center justify-center">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
        </div>
    </div>
</div>
<div class="grid grid-cols-4 gap-6 mb-8">

    <div class="bg-white rounded-2xl p-6 shadow-sm">
        <p class="text-sm text-gray-400">Total Magang Aktif</p>
        <h2 class="text-3xl font-bold mt-2">{{ $totalMagang }}</h2>
    </div>

    <div class="bg-white rounded-2xl p-6 shadow-sm">
        <p class="text-sm text-gray-400">Hadir Hari Ini</p>
        <h2 class="text-3xl font-bold mt-2 text-green-600">
            {{ $hadirHariIni }}
        </h2>
    </div>

    <div class="bg-white rounded-2xl p-6 shadow-sm">
        <p class="text-sm text-gray-400">Belum Absen</p>
        <h2 class="text-3xl font-bold mt-2 text-orange-500">
            {{ $belumAbsen }}
        </h2>
    </div>

    <div class="bg-white rounded-2xl p-6 shadow-sm">
        <p class="text-sm text-gray-400">Terlambat</p>
        <h2 class="text-3xl font-bold mt-2 text-red-500">
            {{ $terlambat }}
        </h2>
    </div>
</div>

<div class="grid grid-cols-3 gap-6 mb-8">

    <!-- CHART -->
    <div class="col-span-2 bg-white rounded-2xl p-6 shadow-sm">
        <div class="flex justify-between mb-4">
            <h3 class="font-semibold">Tren Kehadiran</h3>
            <span class="text-sm text-gray-400">7 Hari Terakhir</span>
        </div>

        <canvas id="absensiChart" height="120">
            <script>
                const chartData = @json($chartData);

                const labels = chartData.map(item => item.tanggal);
                const data = chartData.map(item => item.jumlah);

                const ctx = document.getElementById('absensiChart').getContext('2d');

                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Jumlah Kehadiran',
                            data: data,
                            tension: 0.4,
                            borderWidth: 3,
                            borderColor: '#6366F1',
                            fill: false,
                            pointRadius: 4,
                            pointBackgroundColor: '#6366F1'
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                display: false
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            </script>

        </canvas>
    </div>

    <!-- RING STAT -->
    <div class="bg-white rounded-2xl p-6 shadow-sm flex flex-col items-center justify-center">
        <h3 class="font-semibold mb-4">Persentase Hadir</h3>

        <div class="w-40 h-40 rounded-full border-8 border-indigo-500 flex items-center justify-center">
            <span class="text-2xl font-bold">
                {{ $totalMagang > 0 ? round(($hadirHariIni / $totalMagang) * 100) : 0 }}%
            </span>
        </div>
    </div>

</div>


<div class="bg-white rounded-2xl p-6 shadow-sm mt-10">
    <div class="flex justify-between mb-4">
        <h3 class="font-semibold">Absensi Terakhir Hari Ini</h3>
        <a href="{{ route('admin.absensi') }}"
        class="text-indigo-600 text-sm">Lihat Semua</a>
    </div>

    <table class="w-full">
        <thead class="text-gray-400 text-sm">
            <tr>
                <th class="text-left py-3">Nama</th>
                <th>Jam Masuk</th>
                <th>Jam Keluar</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($absensiHariIni as $a)
            <tr class="border-t">
                <td class="py-3">{{ $a->magang->user->name }}</td>
                <td class="text-center">{{ $a->jam_masuk }}</td>
                <td class="text-center">{{ $a->jam_keluar ?? '-' }}</td>
                <td class="text-center">
                    <span class="px-3 py-1 rounded-full text-xs
                        {{ $a->jam_masuk > '08:00:00' ? 'bg-red-100 text-red-600' : 'bg-green-100 text-green-600' }}">
                        {{ $a->jam_masuk > '08:00:00' ? 'Terlambat' : 'Tepat Waktu' }}
                    </span>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>



</x-app-layout>
