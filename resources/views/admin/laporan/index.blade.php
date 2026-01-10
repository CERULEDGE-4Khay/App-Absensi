<x-app-layout>
<div class="py-10 px-4 sm:px-8 max-w-6xl mx-auto bg-gray-50 min-h-screen" x-data="laporanManager()">
    
    <div class="mb-10">
        <h2 class="text-3xl font-black text-slate-900 tracking-tight">Pusat <span class="text-teal-600">Laporan</span></h2>
        <p class="text-slate-500 font-medium italic">Generate dan pantau riwayat rekapitulasi absensi.</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-1 space-y-6">
            <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100">
                <form action="{{ route('admin.laporan.generate') }}" method="POST" class="space-y-6">
                    @csrf
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-4">Pilih Periode Cepat</label>
                        <div class="grid grid-cols-2 gap-2">
                            <button type="button" @click="setPeriod('today')" class="py-2 bg-slate-50 rounded-lg text-xs font-bold hover:bg-teal-50 hover:text-teal-600 transition-all">Hari Ini</button>
                            <button type="button" @click="setPeriod('weekly')" class="py-2 bg-slate-50 rounded-lg text-xs font-bold hover:bg-teal-50 hover:text-teal-600 transition-all">Minggu Ini</button>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <input type="date" name="awal" x-model="awal" @change="fetchPreview" class="w-full px-4 py-3 rounded-xl border-slate-100 bg-slate-50 font-bold text-sm">
                        <input type="date" name="akhir" x-model="akhir" @change="fetchPreview" class="w-full px-4 py-3 rounded-xl border-slate-100 bg-slate-50 font-bold text-sm">
                    </div>

                    <div class="pt-4 space-y-3">
                        <button type="submit" name="format" value="excel" class="w-full py-4 bg-emerald-500 text-white font-black rounded-2xl shadow-lg shadow-emerald-200 text-xs uppercase tracking-widest hover:-translate-y-1 transition-all">Export Excel</button>
                        <button type="submit" name="format" value="pdf" class="w-full py-4 bg-rose-500 text-white font-black rounded-2xl shadow-lg shadow-rose-200 text-xs uppercase tracking-widest hover:-translate-y-1 transition-all">Export PDF</button>
                    </div>
                </form>
            </div>

            <div class="bg-slate-900 rounded-[2.5rem] p-8 text-white">
                <h4 class="text-sm font-black uppercase tracking-widest mb-6 text-teal-400">Log Terakhir</h4>
                <div class="space-y-4">
                    @forelse($logs ?? [] as $log)
                    <div class="flex items-start gap-3 text-xs border-l-2 border-teal-800 pl-3">
                        <div>
                            <p class="font-bold">{{ $log->user->name }} mencetak laporan</p>
                            <p class="text-slate-500">{{ $log->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                    @empty
                    <p class="text-xs text-slate-500 italic">Belum ada riwayat cetak.</p>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="lg:col-span-2">
            <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden min-h-[500px]">
                <div class="p-8 border-b border-slate-50 flex justify-between items-center">
                    <h3 class="font-black text-slate-800 uppercase tracking-widest text-sm text-teal-600">Preview Data</h3>
                    <template x-if="loading">
                        <span class="flex h-2 w-2 rounded-full bg-teal-500 animate-ping"></span>
                    </template>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50/50">
                                <th class="px-8 py-4 text-[10px] font-black text-slate-400 uppercase">Peserta</th>
                                <th class="px-8 py-4 text-[10px] font-black text-slate-400 uppercase text-center">Hadir</th>
                                <th class="px-8 py-4 text-[10px] font-black text-slate-400 uppercase text-center">Telat</th>
                                <th class="px-8 py-4 text-[10px] font-black text-slate-400 uppercase text-right">Instansi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            <template x-for="item in previewData" :key="item.nama">
                                <tr class="hover:bg-teal-50/30 transition-colors">
                                    <td class="px-8 py-4">
                                        <div class="font-bold text-slate-700" x-text="item.nama"></div>
                                        <div :class="item.status === 'aktif' ? 'text-emerald-500' : 'text-slate-400'" class="text-[9px] font-black uppercase tracking-widest" x-text="item.status"></div>
                                    </td>
                                    <td class="px-8 py-4 text-center">
                                        <span class="px-3 py-1 bg-emerald-50 text-emerald-600 rounded-full text-xs font-black" x-text="item.hadir + ' Hari'"></span>
                                    </td>
                                    <td class="px-8 py-4 text-center">
                                        <span class="px-3 py-1 bg-rose-50 text-rose-500 rounded-full text-xs font-black" x-text="item.telat + ' Kali'"></span>
                                    </td>
                                    <td class="px-8 py-4 text-right text-xs font-medium text-slate-500" x-text="item.instansi"></td>
                                </tr>
                            </template>
                            
                            <template x-if="previewData.length === 0 && !loading">
                                <tr>
                                    <td colspan="4" class="p-20 text-center">
                                        <div class="flex flex-col items-center gap-3 opacity-20">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                            </svg>
                                            <p class="font-black uppercase tracking-widest text-xs">Pilih tanggal untuk melihat data</p>
                                        </div>
                                    </td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function laporanManager() {
    return {
        awal: '',
        akhir: '',
        loading: false,
        previewData: [],
        setPeriod(type) {
            const now = new Date();
            if(type === 'today') {
                this.awal = this.akhir = now.toISOString().split('T')[0];
            } else if(type === 'weekly') {
                const first = now.getDate() - now.getDay();
                this.awal = new Date(now.setDate(first)).toISOString().split('T')[0];
                this.akhir = new Date().toISOString().split('T')[0];
            }
            this.fetchPreview();
        },
        async fetchPreview() {
            if(!this.awal || !this.akhir) return;
            this.loading = true;
            
            try {
                // Tambahkan '/' di awal untuk memastikan path absolut
                const response = await fetch(`/admin/laporan/preview?awal=${this.awal}&akhir=${this.akhir}`, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                });
                
                const result = await response.json();

                if (!response.ok) {
                    throw new Error(result.error || result.message || 'Server Error');
                }
                
                this.previewData = result;
            } catch (e) {
                console.error("Preview Error:", e);
                // Alert hanya muncul jika benar-benar gagal fatal
                if(e.message !== 'Server Error') {
                    alert("Gagal memuat preview: " + e.message);
                }
            } finally {
                this.loading = false;
            }
        }
    }
}
</script>
</x-app-layout>