<aside class="w-64 bg-white shadow-lg">
    <div class="p-5 text-xl font-bold border-b">
        Sistem Magang
    </div>

    <nav class="p-4 space-y-2 text-sm">

        {{-- ================= ADMIN ================= --}}
        @if(auth()->user()->role === 'admin')

            <a href="{{ route('dashboard.admin') }}"
            class="block px-4 py-2 rounded {{ request()->routeIs('dashboard.admin') ? 'bg-indigo-600 text-white' : 'hover:bg-gray-100' }}">
                📊 Dashboard
            </a>

            <details class="group">
                <summary class="cursor-pointer px-4 py-2 rounded hover:bg-gray-100 flex justify-between items-center">
                    👥 Kelola User
                    <span class="group-open:rotate-180 transition">▾</span>
                </summary>

                <div class="ml-4 mt-2 space-y-1">
                    <a href="{{ route('admin.users.index') }}"
                    class="block px-4 py-2 rounded hover:bg-gray-100">
                        📋 Daftar User
                    </a>

                    <a href="{{ route('admin.users.create') }}"
                    class="block px-4 py-2 rounded hover:bg-gray-100">
                        ➕ Tambah User
                    </a>

                </div>
            </details>
            <a href="{{ route('admin.absensi') }}"
               class="block px-4 py-2 rounded {{ request()->routeIs('admin.absensi') ? 'bg-indigo-600 text-white' : 'hover:bg-gray-100' }}">
                🕒 Absensi
            </a>

            <a href="#"
               class="block px-4 py-2 rounded hover:bg-gray-100">
                🧑‍🎓 Data Magang
            </a>

            <a href="#"
               class="block px-4 py-2 rounded hover:bg-gray-100">
                📈 Laporan
            </a>

        {{-- ================= MAGANG ================= --}}
        @else

            <a href="{{ route('dashboard.magang') }}"
               class="block px-4 py-2 rounded hover:bg-gray-100">
                🏠 Dashboard
            </a>

            <a href="{{ route('absensi.riwayat') }}"
               class="block px-4 py-2 rounded hover:bg-gray-100">
                📅 Riwayat Absensi
            </a>

        @endif

        <hr class="my-3">

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="w-full text-left px-4 py-2 text-red-600 hover:bg-red-50 rounded">
                🚪 Logout
            </button>
        </form>

    </nav>
</aside>
