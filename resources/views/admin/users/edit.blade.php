<x-app-layout>
<div class="py-10 px-4 sm:px-8 max-w-3xl mx-auto bg-gray-50 min-h-screen">
    
    <div class="mb-8 flex justify-between items-end">
        <div>
            <a href="{{ route('admin.users.index') }}" class="group inline-flex items-center text-sm font-bold text-slate-400 hover:text-teal-600 transition-colors mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 transition-transform group-hover:-translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18" />
                </svg>
                Kembali
            </a>
            <h2 class="text-3xl font-black text-slate-900 tracking-tight">
                Update <span class="text-teal-600">Profil User</span>
            </h2>
            <p class="text-slate-500 font-medium italic">ID Pengguna: #USR-{{ $user->id }}</p>
        </div>
        
        <div class="hidden sm:block">
            <span class="px-4 py-2 bg-teal-50 text-teal-700 rounded-2xl text-xs font-black uppercase tracking-widest border border-teal-100">
                Akun Terverifikasi
            </span>
        </div>
    </div>

    <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 p-8 sm:p-10" 
         x-data="{ role: '{{ old('role', $user->role) }}' }">
        
        <form method="POST" action="{{ route('admin.users.update', $user) }}" class="space-y-8">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                {{-- NAMA --}}
                <div class="col-span-2">
                    <label class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-3 ml-1">Nama Lengkap</label>
                    <input name="name" type="text" value="{{ old('name', $user->name) }}" required
                        class="w-full px-6 py-4 rounded-2xl border-slate-200 bg-slate-50 focus:bg-white focus:border-teal-500 focus:ring-4 focus:ring-teal-500/10 transition-all font-bold text-slate-700 shadow-sm">
                </div>

                {{-- EMAIL (READ ONLY) --}}
                <div class="col-span-2 md:col-span-1">
                    <label class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-3 ml-1">Email (Tetap)</label>
                    <div class="relative">
                        <input value="{{ $user->email }}" disabled
                            class="w-full px-6 py-4 rounded-2xl border-slate-200 bg-slate-100 text-slate-400 cursor-not-allowed font-bold">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 absolute right-4 top-4 text-slate-300" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>

                {{-- ROLE SELECT --}}
                <div class="col-span-2 md:col-span-1">
                    <label class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-3 ml-1">Role Akses</label>
                    <select name="role" x-model="role"
                        class="w-full px-6 py-4 rounded-2xl border-slate-200 bg-teal-50/50 focus:bg-white focus:border-teal-500 focus:ring-4 focus:ring-teal-500/10 transition-all font-black text-teal-700">
                        <option value="magang">MAGANG</option>
                        <option value="admin">ADMIN</option>
                    </select>
                </div>

                {{-- NEW PASSWORD (OPSIONAL) --}}
                <div class="col-span-2">
                    <div class="bg-amber-50 border border-amber-100 rounded-2xl p-4 flex gap-4 items-start mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-amber-600 mt-0.5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                        </svg>
                        <p class="text-xs text-amber-700 font-medium leading-relaxed">Kosongkan kolom password di bawah jika Anda tidak ingin mengubah password user ini.</p>
                    </div>
                    <label class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-3 ml-1">Ganti Password Baru</label>
                    <input name="password" type="password"
                        class="w-full px-6 py-4 rounded-2xl border-slate-200 bg-slate-50 focus:bg-white focus:border-teal-500 focus:ring-4 focus:ring-teal-500/10 transition-all font-bold text-slate-700 shadow-sm"
                        placeholder="Masukkan password baru jika perlu">
                </div>
            </div>

            <div x-show="role === 'magang'" 
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 -translate-y-4"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 class="p-8 bg-slate-50 rounded-[2.5rem] border border-slate-100 space-y-6 shadow-inner">
                
                <h4 class="text-xs font-black text-teal-600 uppercase tracking-[0.2em] mb-4">Informasi Magang</h4>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="col-span-2">
                        <label class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-2 ml-1">Asal Instansi</label>
                        <input name="asal_instansi" type="text" value="{{ old('asal_instansi', $user->magang->asal_instansi ?? '') }}"
                            class="w-full px-5 py-3 rounded-2xl border-slate-200 bg-white focus:border-teal-500 focus:ring-4 focus:ring-teal-500/10 transition-all font-bold text-slate-700">
                    </div>

                    <div>
                        <label class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-2 ml-1">Tanggal Mulai</label>
                        <input name="tanggal_mulai" type="date" value="{{ old('tanggal_mulai', $user->magang->tanggal_mulai ?? '') }}"
                            class="w-full px-5 py-3 rounded-2xl border-slate-200 bg-white focus:border-teal-500 focus:ring-4 focus:ring-teal-500/10 transition-all font-bold text-slate-700">
                    </div>

                    <div>
                        <label class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-2 ml-1">Tanggal Selesai</label>
                        <input name="tanggal_selesai" type="date" value="{{ old('tanggal_selesai', $user->magang->tanggal_selesai ?? '') }}"
                            class="w-full px-5 py-3 rounded-2xl border-slate-200 bg-white focus:border-teal-500 focus:ring-4 focus:ring-teal-500/10 transition-all font-bold text-slate-700">
                    </div>
                </div>
            </div>

            {{-- ACTION BUTTONS --}}
            <div class="flex items-center justify-end gap-4 pt-6">
                <a href="{{ route('admin.users.index') }}" 
                   class="px-8 py-4 rounded-2xl font-bold text-slate-400 hover:text-slate-600 transition-all">
                    Batal
                </a>
                <button type="submit" 
                        class="px-10 py-4 bg-teal-600 hover:bg-teal-700 text-white rounded-2xl font-black shadow-lg shadow-teal-100 transition-all hover:-translate-y-1 active:scale-95 uppercase tracking-widest text-sm">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
</x-app-layout>