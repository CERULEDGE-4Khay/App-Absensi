<x-app-layout>
    <div class="py-8 px-4 sm:px-8 max-w-7xl mx-auto">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
            <div>
                <h2 class="text-3xl font-black text-slate-900 tracking-tight">Data <span class="text-teal-600">Peserta Magang</span></h2>
                <p class="text-slate-500 font-medium">Kelola informasi lengkap seluruh peserta magang aktif maupun alumni.</p>
            </div>
        </div>

        <div class="bg-white p-6 rounded-[2rem] shadow-sm border border-slate-100 mb-6">
            <form action="{{ route('admin.magang.index') }}" method="GET" class="flex flex-col md:flex-row gap-4">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama atau instansi..." 
                    class="flex-1 px-5 py-3 rounded-2xl border-slate-200 bg-slate-50 focus:ring-4 focus:ring-teal-500/10 transition-all font-bold">
                
                <select name="status" class="px-5 py-3 rounded-2xl border-slate-200 bg-slate-50 font-bold text-slate-600">
                    <option value="">Semua Status</option>
                    <option value="aktif" {{ request('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                    <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                </select>

                <button type="submit" class="px-8 py-3 bg-slate-900 text-white rounded-2xl font-bold hover:bg-slate-800 transition-all">Cari</button>
            </form>
        </div>

        <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-slate-50 border-b border-slate-100">
                        <tr>
                            <th class="px-6 py-5 text-xs font-black text-slate-400 uppercase tracking-widest">Nama Peserta</th>
                            <th class="px-6 py-5 text-xs font-black text-slate-400 uppercase tracking-widest">Instansi</th>
                            <th class="px-6 py-5 text-xs font-black text-slate-400 uppercase tracking-widest">Periode</th>
                            <th class="px-6 py-5 text-xs font-black text-slate-400 uppercase tracking-widest text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($dataMagang as $m)
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="px-6 py-5">
                                <p class="font-bold text-slate-700">{{ $m->user->name }}</p>
                                <p class="text-xs text-slate-400">{{ $m->user->email }}</p>
                            </td>
                            <td class="px-6 py-5 font-bold text-slate-600">{{ $m->asal_instansi }}</td>
                            <td class="px-6 py-5">
                                <div class="text-xs font-bold text-slate-500">
                                    {{ \Carbon\Carbon::parse($m->tanggal_mulai)->format('d M Y') }} - 
                                    {{ \Carbon\Carbon::parse($m->tanggal_selesai)->format('d M Y') }}
                                </div>
                            </td>
                            <td class="px-6 py-5">
                                <form action="{{ route('admin.magang.update-status', $m) }}" method="POST" class="flex justify-center">
                                    @csrf @method('PATCH')
                                    <select name="status" onchange="this.form.submit()" 
                                            class="text-xs font-black uppercase tracking-tighter px-3 py-1 rounded-full border-none 
                                            {{ $m->status == 'aktif' ? 'bg-teal-100 text-teal-700' : ($m->status == 'selesai' ? 'bg-blue-100 text-blue-700' : 'bg-red-100 text-red-700') }}">
                                        <option value="aktif" {{ $m->status == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                        <option value="selesai" {{ $m->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                        <option value="nonaktif" {{ $m->status == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                                    </select>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-6 py-10 text-center text-slate-400 font-medium">Belum ada data peserta magang.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>