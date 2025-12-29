<x-app-layout>
<div class="py-10 px-4 sm:px-8 max-w-3xl mx-auto bg-gray-50 min-h-screen">
    
    <div class="mb-8">
        <a href="{{ route('admin.users.index') }}" class="group inline-flex items-center text-sm font-bold text-slate-400 hover:text-teal-600 transition-colors mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 transition-transform group-hover:-translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18" />
            </svg>
            Kembali ke Daftar
        </a>
        <h2 class="text-3xl font-black text-slate-900 tracking-tight">
            {{ isset($user) ? 'Edit' : 'Tambah' }} <span class="text-teal-600">Pengguna</span>
        </h2>
        <p class="text-slate-500 font-medium italic">Silakan lengkapi informasi akun di bawah ini.</p>
    </div>

    <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden p-8 sm:p-10" 
        x-data="{ role: '{{ old('role', isset($user) ? $user->role : 'magang') }}' }">
        
@if ($errors->any())
    <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 rounded-2xl">
        <p class="text-sm font-bold text-red-700 mb-1">Terjadi kesalahan input:</p>
        <ul class="list-disc list-inside text-xs text-red-600">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
        <form method="POST" action="{{ isset($user) ? route('admin.users.update', $user) : route('admin.users.store') }}" class="space-y-6">
            @csrf
            @if(isset($user)) @method('PUT') @endif

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- NAMA --}}
                <div class="col-span-2 md:col-span-1">
                    <label class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-2 ml-1">Nama Lengkap</label>
                    <input name="name" type="text" value="{{ old('name', isset($user) ? $user->name : '') }}" required
                        class="w-full px-5 py-3 rounded-2xl border-slate-200 bg-slate-50 focus:bg-white focus:border-teal-500 focus:ring-4 focus:ring-teal-500/10 transition-all font-bold text-slate-700 placeholder:font-normal"
                        placeholder="Masukkan nama lengkap">
                </div>

                {{-- EMAIL --}}
                <div class="col-span-2 md:col-span-1">
                    <label class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-2 ml-1">Alamat Email</label>
                    <input name="email" type="email" value="{{ old('email', isset($user) ? $user->email : '') }}" {{ isset($user) ? 'disabled' : 'required' }}
                        class="w-full px-5 py-3 rounded-2xl border-slate-200 {{ isset($user) ? 'bg-slate-100 text-slate-400 cursor-not-allowed' : 'bg-slate-50 focus:bg-white' }} focus:border-teal-500 focus:ring-4 focus:ring-teal-500/10 transition-all font-bold text-slate-700 placeholder:font-normal"
                        placeholder="nama@perusahaan.com">
                </div>

                {{-- PASSWORD --}}
                <div class="col-span-2 md:col-span-1">
                    <label class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-2 ml-1">Password {{ isset($user) ? '(Kosongkan jika tidak diubah)' : '' }}</label>
                    <input name="password" type="password" {{ isset($user) ? '' : 'required' }}
                        class="w-full px-5 py-3 rounded-2xl border-slate-200 bg-slate-50 focus:bg-white focus:border-teal-500 focus:ring-4 focus:ring-teal-500/10 transition-all font-bold text-slate-700"
                        placeholder="••••••••">
                </div>

                {{-- ROLE SELECT --}}
                <div class="col-span-2 md:col-span-1">
                    <label class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-2 ml-1 text-teal-600">Hak Akses (Role)</label>
                    <select name="role" x-model="role"
                        class="w-full px-5 py-3 rounded-2xl border-slate-200 bg-teal-50/50 focus:bg-white focus:border-teal-500 focus:ring-4 focus:ring-teal-500/10 transition-all font-black text-teal-700">
                        <option value="magang">MAGANG (Peserta)</option>
                        <option value="admin">ADMIN (Pengelola)</option>
                    </select>
                </div>
            </div>

            <div x-show="role === 'magang'" 
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 -translate-y-4"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 class="p-6 bg-slate-50 rounded-[2rem] border border-dashed border-slate-200 space-y-6">
                
                <p class="text-[10px] font-black text-teal-600 uppercase tracking-[0.2em] mb-4 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Informasi Tambahan Magang
                </p>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="col-span-2">
                        <label class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-2 ml-1">Asal Instansi</label>
                        <input name="asal_instansi" type="text" value="{{ old('asal_instansi', isset($user->magang) ? $user->magang->asal_instansi : '') }}"
                            class="w-full px-5 py-3 rounded-2xl border-slate-200 bg-white focus:border-teal-500 focus:ring-4 focus:ring-teal-500/10 transition-all font-bold text-slate-700 placeholder:font-normal"
                            placeholder="Contoh: Universitas Indonesia">
                    </div>

                    <div>
                        <label class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-2 ml-1">Tanggal Mulai</label>
                        <input name="tanggal_mulai" type="date" value="{{ old('tanggal_mulai', isset($user->magang) ? $user->magang->tanggal_mulai : '') }}"
                            class="w-full px-5 py-3 rounded-2xl border-slate-200 bg-white focus:border-teal-500 focus:ring-4 focus:ring-teal-500/10 transition-all font-bold text-slate-700">
                    </div>

                    <div>
                        <label class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-2 ml-1">Tanggal Selesai</label>
                        <input name="tanggal_selesai" type="date" value="{{ old('tanggal_selesai', isset($user->magang) ? $user->magang->tanggal_selesai : '') }}"
                            class="w-full px-5 py-3 rounded-2xl border-slate-200 bg-white focus:border-teal-500 focus:ring-4 focus:ring-teal-500/10 transition-all font-bold text-slate-700">
                    </div>
                </div>
            </div>

            {{-- ACTION BUTTONS --}}
            <div class="flex items-center justify-end gap-4 pt-4">
                <a href="{{ route('admin.users.index') }}" 
                   class="px-8 py-3 rounded-2xl font-bold text-slate-400 hover:text-slate-600 transition-all">
                    Batal
                </a>
                <button type="submit" 
                        class="px-10 py-3 bg-teal-600 hover:bg-teal-700 text-white rounded-2xl font-bold shadow-lg shadow-teal-100 transition-all hover:-translate-y-1 active:scale-95">
                    {{ isset($user) ? 'Simpan Perubahan' : 'Daftarkan User' }}
                </button>
            </div>
        </form>
    </div>
</div>
</x-app-layout>