<x-guest-layout>
    <div class="relative">
        <div class="absolute -top-20 -right-20 w-40 h-40 bg-teal-100 rounded-full blur-3xl opacity-50"></div>
        <div class="absolute -bottom-20 -left-20 w-40 h-40 bg-blue-100 rounded-full blur-3xl opacity-50"></div>

        <div class="relative bg-white/80 backdrop-blur-sm shadow-2xl rounded-3xl p-10 border border-slate-100">
            <div class="text-center mb-10">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-teal-600 rounded-2xl mb-4 shadow-lg shadow-teal-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                    </svg>
                </div>
                <h1 class="text-3xl font-black text-slate-900 tracking-tight">
                    Welcome <span class="text-teal-600">Back.</span>
                </h1>
                <p class="text-slate-500 mt-2 font-medium">
                    Silakan login untuk mengakses sistem absensi
                </p>
            </div>

            <x-auth-session-status class="mb-6" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" class="space-y-6" x-data="{ loading: false }" @submit="loading = true">
            @csrf

                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">
                        Alamat Email
                    </label>
                    <input type="email" name="email" value="{{ old('email') }}" required autofocus
                        placeholder="nama@perusahaan.com"
                        class="w-full px-4 py-3 rounded-xl border-slate-200 bg-slate-50 text-slate-900 focus:border-teal-500 focus:ring focus:ring-teal-200 focus:ring-opacity-50 transition-all duration-200">
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-xs" />
                </div>

                <div>
                    <div class="flex justify-between mb-2">
                        <label class="text-sm font-bold text-slate-700">
                            Password
                        </label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-xs font-semibold text-teal-600 hover:text-teal-700">
                                Lupa Password?
                            </a>
                        @endif
                    </div>
                    <input type="password" name="password" required
                        placeholder="••••••••"
                        class="w-full px-4 py-3 rounded-xl border-slate-200 bg-slate-50 text-slate-900 focus:border-teal-500 focus:ring focus:ring-teal-200 focus:ring-opacity-50 transition-all duration-200">
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-xs" />
                </div>

                <div class="flex items-center">
                    <label class="flex items-center group cursor-pointer">
                        <input type="checkbox" name="remember"
                            class="rounded-md border-slate-300 text-teal-600 shadow-sm focus:ring-teal-500 cursor-pointer">
                        <span class="ml-2 text-sm text-slate-600 group-hover:text-slate-900 transition-colors font-medium">Ingat saya di perangkat ini</span>
                    </label>
                </div>

                <button type="submit" :class="loading ? 'opacity-80 cursor-not-allowed' : ''"
                    class="relative w-full bg-teal-600 hover:bg-teal-700 text-white py-4 rounded-2xl font-bold text-lg shadow-lg shadow-teal-200 transition-all hover:-translate-y-1 active:scale-95 flex items-center justify-center overflow-hidden">
                    
                    <span x-show="!loading" x-transition>Masuk Sekarang</span>

                    <span x-show="loading" class="flex items-center gap-2">
                        <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        Memproses...
                    </span>
                </button>
            </form>

            @if(session('error'))
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4 rounded shadow">
                    <p class="font-bold">Akses Ditolak</p>
                    <p>{{ session('error') }}</p>
                </div>
            @endif
        </div>

        <div class="text-center mt-8">
            <a href="/" class="text-sm font-bold text-slate-400 hover:text-teal-600 transition-colors">
                ← Kembali ke Halaman Utama
            </a>
        </div>
    </div>
</x-guest-layout>