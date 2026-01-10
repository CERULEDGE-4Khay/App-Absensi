<x-app-layout>
    @if(session('success'))
        <div class="max-w-7xl mx-auto px-4 sm:px-8 mt-4 mb-4">
            <div class="bg-teal-100 border-l-4 border-teal-500 text-teal-700 p-4 rounded-xl shadow-sm flex justify-between items-center" x-data="{ show: true }" x-show="show">
                <div class="flex items-center">
                    <svg class="h-5 w-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <span class="font-bold">{{ session('success') }}</span>
                </div>
                <button @click="show = false" class="text-teal-500 hover:text-teal-700">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    @endif
<div class="py-10 px-4 sm:px-8 max-w-7xl mx-auto bg-gray-50 min-h-screen">

    <div class="flex flex-col md:flex-row md:items-end justify-between mb-8 gap-6">
        <div>
            <h2 class="text-3xl font-black text-slate-900 tracking-tight">
                Kelola <span class="text-teal-600">Pengguna</span>
            </h2>
            <p class="text-slate-500 font-medium italic text-sm">Total {{ $users->count() }} pengguna terdaftar dalam sistem.</p>
        </div>

        <div class="flex flex-wrap items-center gap-4">
            {{-- FORM SEARCH & FILTER --}}
            <form action="{{ route('admin.users.index') }}" method="GET" class="flex flex-wrap items-center gap-3">
                
                <div class="relative group">
                    <div class="absolute inset-y-0 left-4 flex items-center pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-slate-400 group-focus-within:text-teal-500 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <input type="text" name="search" value="{{ request('search') }}" 
                        placeholder="Cari nama atau email..." 
                        class="pl-11 pr-4 py-2.5 bg-white border border-slate-100 rounded-2xl shadow-sm focus:ring-4 focus:ring-teal-500/10 focus:border-teal-500 transition-all text-sm font-medium text-slate-700 w-64">
                </div>

                <div class="bg-white p-1 rounded-2xl shadow-sm border border-slate-100 flex items-center">
                    <select name="role" onchange="this.form.submit()" 
                            class="border-none bg-transparent text-xs font-black uppercase tracking-widest text-slate-500 focus:ring-0 cursor-pointer py-2">
                        <option value="">Semua Role</option>
                        <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="magang" {{ request('role') == 'magang' ? 'selected' : '' }}>Magang</option>
                    </select>
                </div>

                <button type="submit" class="hidden">Cari</button>
                
                @if(request('search') || request('role'))
                    <a href="{{ route('admin.users.index') }}" class="text-xs font-bold text-red-400 hover:text-red-600 transition-colors px-2">
                        Reset
                    </a>
                @endif
            </form>

            {{-- TOMBOL TAMBAH USER --}}
            <a href="{{ route('admin.users.create') }}" 
            class="inline-flex items-center gap-2 px-6 py-3 bg-teal-600 hover:bg-teal-700 text-white rounded-2xl font-bold shadow-lg shadow-teal-100 transition-all hover:-translate-y-1 active:scale-95 text-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
                Tambah User
            </a>
        </div>
    </div>

    {{-- KONTEN TABEL (SAMA SEPERTI SEBELUMNYA) --}}
    <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/50 border-b border-slate-100">
                        <th class="px-8 py-5 text-xs font-black text-slate-400 uppercase tracking-[0.15em]">Nama Pengguna</th>
                        <th class="px-8 py-5 text-xs font-black text-slate-400 uppercase tracking-[0.15em]">Email</th>
                        <th class="px-8 py-5 text-xs font-black text-slate-400 uppercase tracking-[0.15em] text-center">Role Akses</th>
                        <th class="px-8 py-5 text-xs font-black text-slate-400 uppercase tracking-[0.15em] text-right">Opsi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse($users as $u)
                    <tr class="hover:bg-teal-50/30 transition-all group">
                        <td class="px-8 py-5">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 rounded-xl bg-slate-100 flex items-center justify-center text-slate-500 font-bold group-hover:bg-teal-600 group-hover:text-white transition-all duration-300 uppercase">
                                    {{ substr($u->name, 0, 1) }}
                                </div>
                                <span class="font-bold text-slate-800 tracking-tight">{{ $u->name }}</span>
                            </div>
                        </td>
                        <td class="px-8 py-5">
                            <span class="text-slate-500 font-medium">{{ $u->email }}</span>
                        </td>
                        <td class="px-8 py-5 text-center">
                            <span class="inline-flex px-4 py-1.5 rounded-xl text-[10px] font-black uppercase tracking-widest
                                {{ $u->role === 'admin' ? 'bg-amber-100 text-amber-700 border border-amber-200' : 'bg-teal-100 text-teal-700 border border-teal-200' }}">
                                {{ ucfirst($u->role) }}
                            </span>
                        </td>
                        <td class="px-8 py-5 text-right">
                            <div class="flex justify-end gap-2 text-right">
                                <a href="{{ route('admin.users.edit', $u->id) }}" class="p-2 text-slate-400 hover:text-teal-600 hover:bg-teal-50 rounded-xl transition-all">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </a>
                                <form action="{{ route('admin.users.destroy', $u->id) }}" method="POST" onsubmit="return confirm('Hapus user {{ $u->name }}?');" class="inline">
                                    @csrf @method('DELETE')
                                    <button class="p-2 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-xl transition-all">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-8 py-20 text-center">
                            <p class="text-slate-400 font-bold italic">Tidak ada user dengan role "{{ request('role') }}"</p>
                            <a href="{{ route('admin.users.index') }}" class="text-teal-600 text-xs font-black uppercase mt-2 inline-block underline">Lihat Semua User</a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
</x-app-layout>