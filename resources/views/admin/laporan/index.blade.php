<x-app-layout>
<div class="py-10 px-4 sm:px-8 max-w-5xl mx-auto bg-gray-50 min-h-screen">
    
    <div class="mb-10">
        <h2 class="text-3xl font-black text-slate-900 tracking-tight">
            Pusat <span class="text-teal-600">Laporan</span>
        </h2>
        <p class="text-slate-500 font-medium italic">Generate rekapitulasi absensi dalam format dokumen secara periodik.</p>
    </div>

    @if(session('success'))
        <div class="mb-6 p-4 bg-teal-50 border border-teal-100 text-teal-700 rounded-2xl font-bold flex items-center gap-3">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
            </svg>
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden" 
        x-data="{ 
            awal: '', 
            akhir: '',
            setPeriod(type) {
                const now = new Date();
                if(type === 'today') {
                    this.awal = this.akhir = now.toISOString().split('T')[0];
                } else if(type === 'weekly') {
                    const first = now.getDate() - now.getDay();
                    this.awal = new Date(now.setDate(first)).toISOString().split('T')[0];
                    this.akhir = new Date().toISOString().split('T')[0];
                } else if(type === 'monthly') {
                    this.awal = new Date(now.getFullYear(), now.getMonth(), 1).toISOString().split('T')[0];
                    this.akhir = new Date(now.getFullYear(), now.getMonth() + 1, 0).toISOString().split('T')[0];
                }
            }
        }">
        
        <div class="p-8 sm:p-12">
            <form action="{{ route('admin.laporan.generate') }}" method="POST" class="space-y-10">
                @csrf
                
                <div>
                    <label class="block text-xs font-black text-slate-400 uppercase tracking-[0.2em] mb-4">Pilih Periode Cepat</label>
                    <div class="flex flex-wrap gap-3">
                        <button type="button" @click="setPeriod('today')" class="px-6 py-3 bg-slate-50 hover:bg-teal-50 hover:text-teal-600 rounded-xl text-sm font-bold text-slate-600 transition-all border border-transparent hover:border-teal-100">Hari Ini</button>
                        <button type="button" @click="setPeriod('weekly')" class="px-6 py-3 bg-slate-50 hover:bg-teal-50 hover:text-teal-600 rounded-xl text-sm font-bold text-slate-600 transition-all border border-transparent hover:border-teal-100">Minggu Ini</button>
                        <button type="button" @click="setPeriod('monthly')" class="px-6 py-3 bg-slate-50 hover:bg-teal-50 hover:text-teal-600 rounded-xl text-sm font-bold text-slate-600 transition-all border border-transparent hover:border-teal-100">Bulan Ini</button>
                    </div>
                </div>

                <hr class="border-slate-50">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <label class="block text-xs font-black text-slate-400 uppercase tracking-[0.2em] mb-3 ml-1">Tanggal Awal</label>
                        <input type="date" name="awal" x-model="awal" required
                            class="w-full px-6 py-4 rounded-2xl border-slate-100 bg-slate-50 focus:bg-white focus:border-teal-500 focus:ring-4 focus:ring-teal-500/10 transition-all font-bold text-slate-700">
                    </div>
                    <div>
                        <label class="block text-xs font-black text-slate-400 uppercase tracking-[0.2em] mb-3 ml-1">Tanggal Akhir</label>
                        <input type="date" name="akhir" x-model="akhir" required
                            class="w-full px-6 py-4 rounded-2xl border-slate-100 bg-slate-50 focus:bg-white focus:border-teal-500 focus:ring-4 focus:ring-teal-500/10 transition-all font-bold text-slate-700">
                    </div>
                </div>

                <div class="bg-teal-900 rounded-[2.5rem] p-8 text-white shadow-xl shadow-teal-900/20">
                    <div class="flex flex-col lg:flex-row items-center justify-between gap-8">
                        <div class="flex items-center gap-5">
                            <div class="p-4 bg-teal-800 rounded-2xl hidden sm:block">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-teal-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                            <div class="text-center lg:text-left">
                                <h4 class="font-bold text-lg leading-tight">Pilih Format Laporan</h4>
                                <p class="text-teal-400 text-xs">Data akan dicatat ke sistem dan file akan segera diunduh.</p>
                            </div>
                        </div>

                        <div class="flex flex-col sm:flex-row gap-4 w-full lg:w-auto">
                            <button type="submit" name="format" value="excel"
                                    class="flex-1 inline-flex justify-center items-center gap-3 px-8 py-4 bg-emerald-500 hover:bg-emerald-400 text-emerald-950 font-black rounded-2xl transition-all shadow-lg hover:-translate-y-1 active:scale-95 uppercase tracking-widest text-xs">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                Export Excel
                            </button>

                            <button type="submit" name="format" value="pdf"
                                    class="flex-1 inline-flex justify-center items-center gap-3 px-8 py-4 bg-rose-500 hover:bg-rose-400 text-rose-950 font-black rounded-2xl transition-all shadow-lg hover:-translate-y-1 active:scale-95 uppercase tracking-widest text-xs">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                </svg>
                                Export PDF
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="mt-8 flex items-center justify-center gap-6">
        <div class="flex items-center gap-2">
            <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
            <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest italic">Excel Ready</span>
        </div>
        <div class="flex items-center gap-2">
            <span class="w-2 h-2 rounded-full bg-rose-500"></span>
            <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest italic">PDF Ready</span>
        </div>
    </div>
</div>
</x-app-layout>