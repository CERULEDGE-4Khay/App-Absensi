<x-app-layout>
<div class="bg-gray-50 min-h-screen px-4 sm:px-8 py-8">
    
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10 gap-4">
        <div>
            <h1 class="text-3xl font-black text-slate-900 tracking-tight">Admin <span class="text-teal-600">Overview</span></h1>
            <p class="text-slate-500 font-medium">Monitoring aktivitas magang secara real-time.</p>
        </div>

        <div class="flex items-center gap-4 w-full md:w-auto">
            <div class="relative flex-1 md:w-64">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                    <svg class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </span>
                <input type="text" placeholder="Cari peserta..."
                    class="w-full pl-10 pr-4 py-2.5 rounded-2xl border-slate-200 bg-white text-sm focus:border-teal-500 focus:ring-teal-200 transition-all">
            </div>
            <div class="w-10 h-10 rounded-2xl bg-teal-600 text-white flex items-center justify-center font-bold shadow-lg shadow-teal-100 uppercase">
                {{ substr(auth()->user()->name, 0, 1) }}
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
        <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-100 hover:shadow-md transition-shadow">
            <div class="flex items-center gap-4 mb-3">
                <div class="p-3 bg-blue-50 text-blue-600 rounded-2xl">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                </div>
                <p class="text-sm font-bold text-slate-400 uppercase tracking-wider">Total Magang</p>
            </div>
            <h2 class="text-3xl font-black text-slate-800 tracking-tight">{{ $totalMagang }}</h2>
        </div>

        <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-100 hover:shadow-md transition-shadow">
            <div class="flex items-center gap-4 mb-3">
                <div class="p-3 bg-teal-50 text-teal-600 rounded-2xl">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                </div>
                <p class="text-sm font-bold text-slate-400 uppercase tracking-wider">Hadir Hari Ini</p>
            </div>
            <h2 class="text-3xl font-black text-teal-600 tracking-tight">{{ $hadirHariIni }}</h2>
        </div>

        <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-100 hover:shadow-md transition-shadow">
            <div class="flex items-center gap-4 mb-3">
                <div class="p-3 bg-orange-50 text-orange-600 rounded-2xl">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                </div>
                <p class="text-sm font-bold text-slate-400 uppercase tracking-wider">Belum Absen</p>
            </div>
            <h2 class="text-3xl font-black text-orange-500 tracking-tight">{{ $belumAbsen }}</h2>
        </div>

        <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-100 hover:shadow-md transition-shadow">
            <div class="flex items-center gap-4 mb-3">
                <div class="p-3 bg-red-50 text-red-600 rounded-2xl">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
                </div>
                <p class="text-sm font-bold text-slate-400 uppercase tracking-wider">Terlambat</p>
            </div>
            <h2 class="text-3xl font-black text-red-500 tracking-tight">{{ $terlambat }}</h2>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-10">
        <div class="lg:col-span-2 bg-white rounded-3xl p-8 shadow-sm border border-slate-100">
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h3 class="text-lg font-bold text-slate-800">Tren Kehadiran</h3>
                    <p class="text-xs text-slate-400 font-semibold uppercase tracking-widest">7 Hari Terakhir</p>
                </div>
                <div class="flex gap-2 text-xs">
                    <span class="flex items-center gap-1 text-slate-500"><div class="w-3 h-1 bg-teal-500 rounded-full"></div> Kehadiran</span>
                </div>
            </div>

            <div class="relative h-[250px]">
                <canvas id="absensiChart"></canvas>
            </div>
        </div>

        <div class="bg-white rounded-3xl p-8 shadow-sm border border-slate-100 flex flex-col items-center justify-center text-center">
            <h3 class="text-lg font-bold text-slate-800 mb-6">Persentase Kehadiran</h3>
            
            <div class="relative flex items-center justify-center">
                @php $percentage = $totalMagang > 0 ? round(($hadirHariIni / $totalMagang) * 100) : 0; @endphp
                <svg class="w-48 h-48 transform -rotate-90">
                    <circle cx="96" cy="96" r="80" stroke="currentColor" stroke-width="12" fill="transparent" class="text-slate-100" />
                    <circle cx="96" cy="96" r="80" stroke="currentColor" stroke-width="12" fill="transparent" 
                        stroke-dasharray="502.4"
                        stroke-dashoffset="{{ 502.4 - (502.4 * $percentage) / 100 }}"
                        class="text-teal-500 transition-all duration-1000 ease-out" stroke-linecap="round" />
                </svg>
                <div class="absolute flex flex-col items-center">
                    <span class="text-4xl font-black text-slate-800">{{ $percentage }}%</span>
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-1">Hadir Hari Ini</span>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden">
        <div class="p-8 border-b border-slate-50 flex justify-between items-center bg-white">
            <h3 class="text-lg font-bold text-slate-800">Absensi Terakhir Hari Ini</h3>
            <a href="{{ route('admin.absensi') }}" class="px-4 py-2 bg-slate-50 text-slate-600 hover:bg-teal-600 hover:text-white rounded-xl text-xs font-bold transition-all uppercase tracking-wider">
                Lihat Semua
            </a>
        </div>

        <div class="overflow-x-auto text-sm">
            <table class="w-full">
                <thead class="bg-slate-50/50">
                    <tr class="text-slate-400 font-bold uppercase tracking-widest text-[10px]">
                        <th class="px-8 py-4 text-left">Nama Peserta</th>
                        <th class="px-8 py-4 text-center">Jam Masuk</th>
                        <th class="px-8 py-4 text-center">Jam Keluar</th>
                        <th class="px-8 py-4 text-center">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @foreach ($absensiHariIni as $a)
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        <td class="px-8 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center text-[10px] font-bold text-slate-500 uppercase">
                                    {{ substr($a->magang->user->name, 0, 2) }}
                                </div>
                                <span class="font-bold text-slate-700">{{ $a->magang->user->name }}</span>
                            </div>
                        </td>
                        <td class="px-8 py-4 text-center font-mono text-slate-500 italic">{{ $a->jam_masuk }}</td>
                        <td class="px-8 py-4 text-center font-mono text-slate-500 italic">{{ $a->jam_keluar ?? '-' }}</td>
                        <td class="px-8 py-4 text-center">
                            @php $isTerlambat = $a->jam_masuk > '08:00:00'; @endphp
                            <span class="inline-flex px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-wider
                                {{ $isTerlambat ? 'bg-red-100 text-red-600' : 'bg-teal-100 text-teal-700' }}">
                                {{ $isTerlambat ? 'Terlambat' : 'Tepat Waktu' }}
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mt-8">
        
        {{-- KOLOM KIRI: MASA MAGANG BERAKHIR --}}
        <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 p-8">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-xl font-black text-slate-900">Akan <span class="text-orange-500">Selesai</span></h3>
                <span class="px-4 py-1 bg-orange-50 text-orange-600 text-xs font-bold rounded-full border border-orange-100">7 Hari Kedepan</span>
            </div>

            <div class="space-y-4">
                @forelse($pesertaMendatang as $p)
                <div class="flex items-center justify-between p-4 bg-slate-50 rounded-2xl border border-slate-100">
                    <div class="flex items-center gap-3">
                        <div class="h-10 w-10 rounded-xl bg-orange-500 flex items-center justify-center text-white font-bold">
                            {{ substr($p->user->name, 0, 1) }}
                        </div>
                        <div>
                            <p class="text-sm font-black text-slate-700">{{ $p->user->name }}</p>
                            <p class="text-[10px] font-bold text-slate-400 uppercase">{{ $p->asal_instansi }}</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-xs font-black text-orange-600">{{ \Carbon\Carbon::parse($p->tanggal_selesai)->diffForHumans() }}</p>
                        <p class="text-[10px] font-medium text-slate-400">{{ \Carbon\Carbon::parse($p->tanggal_selesai)->format('d M Y') }}</p>
                    </div>
                </div>
                @empty
                <div class="text-center py-8">
                    <p class="text-sm text-slate-400 font-medium">Tidak ada peserta yang selesai dalam waktu dekat.</p>
                </div>
                @endforelse
            </div>
        </div>

        {{-- KOLOM KANAN: LOG AKTIVITAS (ABSENSI TERBARU) --}}
        <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 p-8">
            <h3 class="text-xl font-black text-slate-900 mb-6">Aktivitas <span class="text-teal-600">Terbaru</span></h3>
            
            <div class="relative">
                <div class="absolute left-5 top-0 bottom-0 w-0.5 bg-slate-100"></div>

                <div class="space-y-8 relative">
                    @foreach($aktivitasTerbaru as $log)
                    <div class="flex items-start gap-4">
                        <div class="relative z-10">
                            <div class="h-10 w-10 rounded-full {{ $log->status === 'hadir' ? 'bg-teal-500' : 'bg-amber-500' }} border-4 border-white shadow-sm flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        </div>
                        <div class="flex-1 pt-1">
                            <p class="text-sm font-bold text-slate-700">
                                <span class="text-teal-600">{{ $log->magang->user->name }}</span> 
                                melakukan absen {{ $log->jam_keluar ? 'pulang' : 'masuk' }}
                            </p>
                            <p class="text-[10px] font-medium text-slate-400 uppercase tracking-tighter">
                                {{ $log->tanggal }} — {{ $log->jam_keluar ?? $log->jam_masuk }}
                            </p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const chartData = @json($chartData);
        const labels = chartData.map(item => item.tanggal);
        const data = chartData.map(item => item.jumlah);

        const ctx = document.getElementById('absensiChart').getContext('2d');
        
        // Gradient background
        const gradient = ctx.createLinearGradient(0, 0, 0, 400);
        gradient.addColorStop(0, 'rgba(13, 148, 136, 0.2)');
        gradient.addColorStop(1, 'rgba(13, 148, 136, 0)');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Kehadiran',
                    data: data,
                    tension: 0.45,
                    borderWidth: 4,
                    borderColor: '#0d9488',
                    fill: true,
                    backgroundColor: gradient,
                    pointRadius: 6,
                    pointHoverRadius: 8,
                    pointBackgroundColor: '#fff',
                    pointBorderColor: '#0d9488',
                    pointBorderWidth: 3
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: '#1e293b',
                        titleFont: { size: 12, weight: 'bold' },
                        padding: 12,
                        cornerRadius: 12,
                        displayColors: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { display: true, color: '#f1f5f9' },
                        ticks: { font: { size: 11 }, color: '#94a3b8' }
                    },
                    x: {
                        grid: { display: false },
                        ticks: { font: { size: 11 }, color: '#94a3b8' }
                    }
                }
            }
        });
    });
</script>
</x-app-layout>