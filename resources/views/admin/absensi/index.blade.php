<x-app-layout>
<div class="py-10 px-4 sm:px-8 max-w-7xl mx-auto bg-gray-50 min-h-screen">
    
    <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4">
        <div>
            <h2 class="text-3xl font-black text-slate-900 tracking-tight">
                Monitoring <span class="text-teal-600">Absensi</span>
            </h2>
            <p class="text-slate-500 font-medium italic">Data absensi seluruh peserta magang.</p>
        </div>
        
        <div class="flex items-center gap-3">
            <div class="px-4 py-2 bg-white border border-slate-200 rounded-2xl shadow-sm flex items-center gap-2">
                <span class="w-2 h-2 rounded-full bg-teal-500 animate-pulse"></span>
                <span class="text-sm font-bold text-slate-700 uppercase tracking-widest">Live Report</span>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/50 border-b border-slate-100">
                        <th class="px-8 py-5 text-xs font-black text-slate-400 uppercase tracking-[0.15em]">Profil Peserta</th>
                        <th class="px-8 py-5 text-xs font-black text-slate-400 uppercase tracking-[0.15em] text-center">Tanggal</th>
                        <th class="px-8 py-5 text-xs font-black text-slate-400 uppercase tracking-[0.15em] text-center text-teal-600">Jam Masuk</th>
                        <th class="px-8 py-5 text-xs font-black text-slate-400 uppercase tracking-[0.15em] text-center text-orange-600">Jam Keluar</th>
                        <th class="px-8 py-5 text-xs font-black text-slate-400 uppercase tracking-[0.15em] text-center">Status Presensi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse ($absensi as $a)
                    <tr class="hover:bg-slate-50/50 transition-all group">
                        <td class="px-8 py-5">
                            <div class="flex items-center gap-4">
                                <div class="w-11 h-11 rounded-2xl bg-teal-50 flex items-center justify-center text-teal-600 font-bold shadow-sm border border-teal-100 uppercase">
                                    {{ substr($a->magang->user->name, 0, 2) }}
                                </div>
                                <div>
                                    <p class="font-bold text-slate-800 leading-none mb-1 group-hover:text-teal-600 transition-colors">
                                        {{ $a->magang->user->name }}
                                    </p>
                                    <p class="text-xs font-medium text-slate-400 italic">
                                        {{ $a->magang->user->email }}
                                    </p>
                                </div>
                            </div>
                        </td>

                        <td class="px-8 py-5 text-center">
                            <span class="text-sm font-bold text-slate-600">
                                {{ \Carbon\Carbon::parse($a->tanggal)->format('d/m/Y') }}
                            </span>
                        </td>

                        <td class="px-8 py-5 text-center">
                            <div class="inline-flex items-center gap-1.5 px-3 py-1 bg-teal-50 rounded-lg text-teal-700 font-mono font-bold text-sm border border-teal-100">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14" />
                                </svg>
                                {{ $a->jam_masuk }}
                            </div>
                        </td>

                        <td class="px-8 py-5 text-center">
                            @if($a->jam_keluar)
                                <div class="inline-flex items-center gap-1.5 px-3 py-1 bg-orange-50 rounded-lg text-orange-700 font-mono font-bold text-sm border border-orange-100">
                                    {{ $a->jam_keluar }}
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l4 4m0 0l-4 4m4-4H3" />
                                    </svg>
                                </div>
                            @else
                                <span class="text-slate-300 font-bold italic text-xs tracking-widest">BELUM PULANG</span>
                            @endif
                        </td>

                        <td class="px-8 py-5 text-center">
                            <span class="inline-flex px-4 py-1.5 rounded-xl text-[10px] font-black uppercase tracking-widest shadow-sm
                                {{ $a->status === 'Hadir' ? 'bg-teal-600 text-white' : 'bg-red-500 text-white' }}">
                                {{ $a->status }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="py-24 text-center">
                            <div class="flex flex-col items-center">
                                <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mb-4 text-slate-200 border-4 border-dashed border-slate-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <h4 class="text-slate-800 font-bold text-lg">Hening Sekali...</h4>
                                <p class="text-slate-400 text-sm max-w-xs mx-auto">Belum ada peserta magang yang melakukan absensi nih.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-8 flex justify-between items-center px-4">
        <a href="{{ route('dashboard.admin') }}" class="group inline-flex items-center text-sm font-bold text-slate-400 hover:text-teal-600 transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 transition-transform group-hover:-translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18" />
            </svg>
            Kembali ke Dashboard
        </a>
        {{-- <div class="text-[10px] font-black text-slate-300 uppercase tracking-[0.3em]">
            MagangTrack System v1.0
        </div> --}}
    </div>
</div>
</x-app-layout>