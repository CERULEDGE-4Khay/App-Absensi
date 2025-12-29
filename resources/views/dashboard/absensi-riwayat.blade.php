<x-app-layout>
    <div class="py-10 px-4 sm:px-6 lg:px-8 max-w-6xl mx-auto bg-gray-50 min-h-screen">
        
        <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4">
            <div>
                <nav class="flex mb-2" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-3">
                        <li class="inline-flex items-center text-sm font-medium text-slate-500">
                            <a href="{{ route('dashboard.magang') }}" class="hover:text-teal-600">Dashboard</a>
                        </li>
                        <li aria-current="page">
                            <div class="flex items-center">
                                <svg class="w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                                </svg>
                                <span class="ml-1 text-sm font-bold text-slate-900 md:ml-2">Riwayat Absensi</span>
                            </div>
                        </li>
                    </ol>
                </nav>
                <h2 class="text-3xl font-black text-slate-900 tracking-tight">
                    Log <span class="text-teal-600">Aktivitas</span>
                </h2>
            </div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="flex items-center gap-2 px-5 py-2.5 bg-red-50 text-red-600 rounded-xl font-bold border border-red-100 hover:bg-red-600 hover:text-white transition-all duration-300 shadow-sm shadow-red-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                    </svg>
                    Logout
                </button>
            </form>
        </div>

        <div class="bg-white shadow-sm border border-slate-100 rounded-3xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="bg-slate-50 border-b border-slate-100">
                        <tr>
                            <th class="px-6 py-4 font-bold text-slate-700">Tanggal</th>
                            <th class="px-6 py-4 font-bold text-slate-700">Jam Masuk</th>
                            <th class="px-6 py-4 font-bold text-slate-700">Jam Keluar</th>
                            <th class="px-6 py-4 font-bold text-slate-700 text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @forelse ($riwayatAbsensi as $absen)
                            <tr class="hover:bg-teal-50/30 transition-colors group">
                                <td class="px-6 py-4 font-medium text-slate-900 uppercase">
                                    {{ \Carbon\Carbon::parse($absen->tanggal)->translatedFormat('d F Y') }}
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        <div class="w-2 h-2 rounded-full bg-green-400"></div>
                                        <span class="text-slate-600 font-mono">{{ $absen->jam_masuk ?? '--:--' }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        <div class="w-2 h-2 rounded-full bg-orange-400"></div>
                                        <span class="text-slate-600 font-mono">{{ $absen->jam_keluar ?? '--:--' }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <span class="inline-flex px-3 py-1 rounded-full text-xs font-black tracking-wide uppercase
                                        {{ $absen->status === 'Hadir' ? 'bg-teal-100 text-teal-700' : 'bg-red-100 text-red-700' }}">
                                        {{ $absen->status }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-20">
                                    <div class="flex flex-col items-center">
                                        <div class="p-4 bg-slate-50 rounded-full mb-4">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                            </svg>
                                        </div>
                                        <p class="text-slate-500 font-medium italic">Belum ada data absensi yang tercatat.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-8 flex justify-between items-center">
            <a href="{{ route('dashboard.magang') }}" class="group inline-flex items-center font-bold text-slate-400 hover:text-teal-600 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 transition-transform group-hover:-translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18" />
                </svg>
                Kembali ke Dashboard
            </a>
            
            <p class="text-xs text-slate-400 font-medium uppercase tracking-widest italic">
                Sistem Absensi v1.0 • MagangTrack
            </p>
        </div>
    </div>
</x-app-layout>