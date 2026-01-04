@vite('resources/css/app.css')

<div class="min-h-screen bg-slate-50 flex items-center justify-center p-6">
    <div class="absolute top-0 left-0 w-full h-full overflow-hidden z-0">
        <div class="absolute -top-[10%] -left-[10%] w-[40%] h-[40%] rounded-full bg-teal-500/10 blur-3xl"></div>
        <div class="absolute -bottom-[10%] -right-[10%] w-[40%] h-[40%] rounded-full bg-blue-500/10 blur-3xl"></div>
    </div>

    <div class="relative z-10 max-w-2xl w-full text-center">
        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-teal-100 text-teal-700 text-sm font-medium mb-6">
            <span class="relative flex h-2 w-2">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-teal-400 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-2 w-2 bg-teal-500"></span>
            </span>
            Sistem Absensi Digital
        </div>

        <h1 class="text-5xl md:text-6xl font-black text-slate-900 tracking-tight mb-4">
            Manage Your <span class="text-teal-600">Internship</span> Performance.
        </h1>
        
        <p class="text-lg text-slate-600 mb-10 leading-relaxed max-w-lg mx-auto">
            Selamat datang di sistem absensi dan monitoring magang. Silakan masuk untuk mulai mencatat kehadiran atau mengelola data peserta.
        </p>

        <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
            @if (auth()->check())
                <a href="{{ route('dashboard') }}" class="group relative px-8 py-4 bg-slate-900 text-white rounded-2xl font-bold transition-all hover:scale-105 active:scale-95 shadow-xl">
                    Kembali Ke Dashboard
                    <span class="ml-2 inline-block transition-transform group-hover:translate-x-1">→</span>
                </a>
            @else
                <a href="{{ route('login') }}" class="group relative px-10 py-4 bg-teal-600 text-white rounded-2xl font-bold transition-all hover:bg-teal-700 hover:scale-105 active:scale-95 shadow-lg shadow-teal-200">
                    Masuk ke Akun
                    <span class="ml-2 inline-block transition-transform group-hover:translate-x-1">→</span>
                </a>
            @endif
        </div>

        <div class="mt-16 pt-8 border-t border-slate-200">
            <p class="text-sm text-slate-400 font-medium uppercase tracking-widest">
                Internal Management System
            </p>
        </div>
    </div>
</div>