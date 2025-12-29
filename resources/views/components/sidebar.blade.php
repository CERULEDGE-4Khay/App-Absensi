<aside class="w-72 bg-white min-h-screen border-r border-slate-100 flex flex-col shadow-sm">
    <div class="p-8 flex items-center gap-3">
        <div class="bg-teal-600 p-2 rounded-xl shadow-lg shadow-teal-100">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
            </svg>
        </div>
        <span class="text-xl font-black text-slate-800 tracking-tight">Magang<span class="text-teal-600">Track</span></span>
    </div>

    <div class="px-8 mb-6">
        <div class="bg-slate-50 border border-slate-100 rounded-2xl p-3 flex items-center gap-3">
            <div class="w-10 h-10 rounded-full bg-teal-100 flex items-center justify-center text-teal-700 font-bold uppercase text-xs">
                {{ substr(auth()->user()->name, 0, 2) }}
            </div>
            <div>
                <p class="text-sm font-bold text-slate-800 truncate w-32">{{ auth()->user()->name }}</p>
                <p class="text-[10px] font-black uppercase tracking-widest text-teal-600">{{ auth()->user()->role }}</p>
            </div>
        </div>
    </div>

    <nav class="flex-1 px-4 space-y-1.5 overflow-y-auto">
        
        <p class="px-4 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-2">Main Menu</p>

        {{-- ================= ADMIN MENU ================= --}}
        @if(auth()->user()->role === 'admin')
            <a href="{{ route('dashboard.admin') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-2xl font-bold transition-all duration-200
            {{ request()->routeIs('dashboard.admin') ? 'bg-teal-600 text-white shadow-lg shadow-teal-100' : 'text-slate-500 hover:bg-teal-50 hover:text-teal-600' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor font-bold">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                </svg>
                <span>Admin Dashboard</span>
                @if(request()->routeIs('dashboard.admin'))
                    <span class="ml-auto w-1.5 h-1.5 rounded-full bg-white shadow-sm"></span>
                @endif
            </a>

            <details class="group" {{ request()->routeIs('admin.users.*') ? 'open' : '' }}>
                <summary class="flex items-center justify-between gap-3 px-4 py-3 rounded-2xl font-bold text-slate-500 cursor-pointer hover:bg-teal-50 hover:text-teal-600 transition-all list-none">
                    <div class="flex items-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        <span>Kelola User</span>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transition-transform group-open:rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor font-bold">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </summary>

                <div class="ml-9 mt-1 space-y-1 border-l-2 border-slate-100 pl-4">
                    <a href="{{ route('admin.users.index') }}" class="block px-4 py-2 text-sm font-semibold text-slate-500 hover:text-teal-600 transition-colors">
                        <span>Daftar User</span>
                        @if(request()->routeIs('admin.users.index'))
                            <span class="ml-auto w-1.5 h-1.5 rounded-full bg-white shadow-sm"></span>
                        @endif
                    </a>
                    <a href="{{ route('admin.users.create') }}" class="block px-4 py-2 text-sm font-semibold text-slate-500 hover:text-teal-600 transition-colors">
                        <span>Tambah User</span>
                        @if(request()->routeIs('admin.users.create'))
                            <span class="ml-auto w-1.5 h-1.5 rounded-full bg-white shadow-sm"></span>
                        @endif
                    </a>
                </div>
            </details>

            <a href="{{ route('admin.absensi') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-2xl font-bold transition-all duration-200
            {{ request()->routeIs('admin.absensi') ? 'bg-teal-600 text-white shadow-lg shadow-teal-100' : 'text-slate-500 hover:bg-teal-50 hover:text-teal-600' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>Monitoring Absensi</span>
                @if(request()->routeIs('admin.absensi'))
                    <span class="ml-auto w-1.5 h-1.5 rounded-full bg-white shadow-sm"></span>
                @endif
            </a>

            <a href="{{ route('admin.magang.index') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-2xl font-bold transition-all duration-200
            {{ request()->routeIs('admin.magang.index') ? 'bg-teal-600 text-white shadow-lg shadow-teal-100' : 'text-slate-500 hover:bg-teal-50 hover:text-teal-600' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
                <span>Data Peserta</span>
                @if(request()->routeIs('admin.magang.*'))
                    <span class="ml-auto w-1.5 h-1.5 rounded-full bg-white shadow-sm"></span>
                @endif
            </a>

            <a href="{{ route('admin.laporan.index') }}" 
            class="flex items-center px-4 py-3 font-bold rounded-2xl transition-all {{ request()->routeIs('admin.laporan.*') ? 'bg-teal-600 text-white shadow-lg shadow-teal-100' : 'text-slate-500 hover:bg-teal-50 hover:text-teal-600' }}">
                <div class="flex items-center justify-center w-8 h-8 mr-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 {{ request()->routeIs('admin.laporan.*') ? 'text-white' : 'text-slate-400 group-hover:text-teal-600' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
                <span class="tracking-wide">Laporan</span>
                
                @if(request()->routeIs('admin.laporan.*'))
                    <span class="ml-auto w-1.5 h-1.5 rounded-full bg-white shadow-sm"></span>
                @endif
            </a>

        {{-- ================= MAGANG MENU ================= --}}
        @else
            <a href="{{ route('dashboard.magang') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-2xl font-bold transition-all duration-200 
            {{ request()->routeIs('dashboard.magang') ? 'bg-teal-600 text-white shadow-lg shadow-teal-100' : 'text-slate-500 hover:bg-teal-50 hover:text-teal-600' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor font-bold">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7m-7 7h18M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7" />
                </svg>
                <span>Dashboard</span>
            </a>

            <a href="{{ route('absensi.riwayat') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-2xl font-bold transition-all duration-200
            {{ request()->routeIs('absensi.riwayat') ? 'bg-teal-600 text-white shadow-lg shadow-teal-100' : 'text-slate-500 hover:bg-teal-50 hover:text-teal-600' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor font-bold">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 002-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                <span>Riwayat Absensi</span>
            </a>
        @endif

    </nav>

    <div class="p-4 border-t border-slate-100">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="flex items-center gap-3 w-full px-4 py-3 rounded-2xl font-bold text-red-500 hover:bg-red-50 transition-all duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                </svg>
                <span>Keluar</span>
            </button>
        </form>
    </div>
</aside>