<x-app-layout>
<head>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    @vite('resources/css/app.css')
</head>
<body>

    <div class="py-10 px-4 sm:px-6 lg:px-8 max-w-5xl mx-auto bg-gray-50 min-h-screen" x-data="{ loading: false }">
        
        <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4">
            <div>
                <h2 class="text-3xl font-black text-slate-900 tracking-tight">
                    Dashboard <span class="text-teal-600">Magang</span>
                </h2>
                <p class="text-slate-500 font-medium">Selamat bekerja, {{ auth()->user()->name }}! 👋</p>
            </div>
            
            <div class="bg-white px-6 py-3 rounded-2xl shadow-sm border border-slate-100 flex items-center gap-4">
                <div class="text-right">
                    <div id="clock" class="text-2xl font-bold text-slate-800 tabular-nums">00:00:00</div>
                    <div class="text-xs font-bold text-teal-600 uppercase tracking-widest">{{ now()->format('d F Y') }}</div>
                </div>
                <div class="p-2 bg-teal-50 rounded-lg text-teal-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="flex items-center gap-2 px-5 py-2.5 bg-red-50 text-red-600 rounded-xl font-bold border border-red-100 hover:bg-red-600 hover:text-white transition-all duration-300 shadow-sm shadow-red-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                    </svg>
                    Logout
                </button>
            </form>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    {{-- Total Hadir --}}
    <div class="bg-white p-6 rounded-[2rem] shadow-sm border border-slate-100 flex items-center gap-4">
        <div class="h-12 w-12 rounded-2xl bg-teal-50 flex items-center justify-center text-teal-600">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
        </div>
        <div>
            <p class="text-xs font-black text-slate-400 uppercase tracking-widest">Hadir Bulan Ini</p>
            <p class="text-2xl font-black text-slate-700">{{ $totalHadir }} <span class="text-xs font-bold text-slate-400">Hari</span></p>
        </div>
    </div>

    {{-- Sisa Hari --}}
    <div class="bg-white p-6 rounded-[2rem] shadow-sm border border-slate-100 flex items-center gap-4">
        <div class="h-12 w-12 rounded-2xl bg-orange-50 flex items-center justify-center text-orange-600">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </div>
        <div>
            <p class="text-xs font-black text-slate-400 uppercase tracking-widest">Sisa Masa Magang</p>
            <p class="text-2xl font-black text-slate-700">{{ $sisaHari }} <span class="text-xs font-bold text-slate-400">Hari Lagi</span></p>
        </div>
    </div>

    {{-- Progress Bar --}}
    <div class="bg-white p-6 rounded-[2rem] shadow-sm border border-slate-100 flex flex-col justify-center">
        <div class="flex justify-between items-center mb-2">
            <p class="text-xs font-black text-slate-400 uppercase tracking-widest">Progress Magang</p>
            <p class="text-xs font-black text-teal-600">{{ $persentase }}%</p>
        </div>
        <div class="w-full bg-slate-100 h-3 rounded-full overflow-hidden">
            <div class="bg-teal-500 h-full rounded-full transition-all duration-1000" style="width: {{ $persentase }}%"></div>
        </div>
    </div>
    </div>
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            
            <div class="lg:col-span-1 space-y-6">
                <div class="bg-white rounded-3xl shadow-sm border border-slate-100 p-6 relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-24 h-24 bg-teal-50 rounded-bl-full -mr-10 -mt-10 z-0"></div>
                    
                    <h3 class="text-sm font-bold text-slate-400 uppercase tracking-wider mb-4 relative z-10">Status Kehadiran</h3>
                    
                    @if ($absensiHariIni)
                        <div class="space-y-4 relative z-10">
                            <div class="flex items-center justify-between">
                                <span class="text-slate-500">Jam Masuk</span>
                                <span class="font-bold text-slate-800">{{ $absensiHariIni->jam_masuk }}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-slate-500">Jam Keluar</span>
                                <span class="font-bold text-slate-800">{{ $absensiHariIni->jam_keluar ?? '--:--' }}</span>
                            </div>
                            <div class="pt-2">
                                <span class="px-3 py-1 rounded-full text-xs font-bold {{ $absensiHariIni->status == 'Hadir' ? 'bg-green-100 text-green-600' : 'bg-orange-100 text-orange-600' }}">
                                    ● {{ $absensiHariIni->status }}
                                </span>
                            </div>
                        </div>
                    @else
                        <div class="py-4 text-center relative z-10">
                            <div class="inline-flex p-3 bg-red-50 rounded-full text-red-500 mb-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                            </div>
                            <p class="text-red-500 font-bold">Belum Absen Hari Ini</p>
                        </div>
                    @endif
                </div>

                <div class="grid grid-cols-1 gap-3">
                    <form id="absenMasukForm" action="{{ route('absen.masuk') }}" method="POST">
                        @csrf
                        <input type="hidden" name="latitude" id="lat">
                        <input type="hidden" name="longitude" id="lon">
                        <button type="button" onclick="getLocationAndSubmit('absenMasukForm')"
                            class="w-full bg-teal-600 hover:bg-teal-700 text-white py-4 rounded-2xl font-bold shadow-lg shadow-teal-100 transition-all hover:-translate-y-1 flex items-center justify-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                            </svg>
                            Absen Masuk
                        </button>
                    </form>

                    <form action="{{ route('absen.keluar') }}" method="POST">
                        @csrf
                        <button class="w-full bg-white border-2 border-slate-200 text-slate-700 hover:border-blue-500 hover:text-blue-600 py-4 rounded-2xl font-bold transition-all flex items-center justify-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M3 3a1 1 0 00-1 1v12a1 1 0 102 0V4a1 1 0 00-1-1zm10.293 9.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L14.586 9H7a1 1 0 100 2h7.586l-1.293 1.293z" clip-rule="evenodd" />
                            </svg>
                            Absen Keluar
                        </button>
                    </form>

                    <a href="{{ route('absensi.riwayat') }}" class="w-full bg-slate-800 text-white py-4 rounded-2xl font-bold text-center hover:bg-slate-900 transition-all">
                        Riwayat Absensi
                    </a>
                </div>


                @if (session('success'))
                    <div class="p-4 bg-green-100 border-l-4 border-green-500 text-green-700 rounded-r-xl text-sm font-bold">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('error'))
                    <div class="p-4 bg-red-100 border-l-4 border-red-500 text-red-700 rounded-r-xl text-sm font-bold">
                        {{ session('error') }}
                    </div>
                @endif
            </div>

            <div class="lg:col-span-2">
                <div class="bg-white rounded-3xl shadow-sm border border-slate-100 p-2 h-full">
                    @if ($absensiHariIni && $absensiHariIni->latitude)
                        <div class="p-4">
                            <h3 class="font-bold text-slate-800 flex items-center gap-2 mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-teal-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                Titik Lokasi Absensi
                            </h3>
                            <div id="map" class="h-[450px] rounded-2xl z-0 border border-slate-100"></div>
                        </div>
                    @else
                        <div class="h-full min-h-[400px] flex flex-col items-center justify-center text-center p-8 bg-slate-50 rounded-2xl border-2 border-dashed border-slate-200">
                            <div class="w-20 h-20 bg-slate-100 rounded-full flex items-center justify-center mb-4 text-slate-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                                </svg>
                            </div>
                            <h4 class="text-slate-800 font-bold">Peta Belum Tersedia</h4>
                            <p class="text-slate-500 text-sm max-w-xs mt-2">Silakan lakukan Absen Masuk terlebih dahulu untuk menampilkan lokasi pada peta.</p>
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>

    <script>
        // Real-time Clock Function
        function updateClock() {
            const now = new Date();
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const seconds = String(now.getSeconds()).padStart(2, '0');
            document.getElementById('clock').textContent = `${hours}:${minutes}:${seconds}`;
        }
        setInterval(updateClock, 1000);
        updateClock();

        // Geolocation Function
        function getLocationAndSubmit(formId) {
            if (!navigator.geolocation) {
                alert("GPS tidak didukung oleh browser Anda");
                return;
            }

            // Tambahkan loading sederhana
            const btn = event.currentTarget;
            const originalContent = btn.innerHTML;
            btn.innerHTML = '<svg class="animate-spin h-5 w-5 text-white" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Mengambil Lokasi...';
            btn.disabled = true;

            navigator.geolocation.getCurrentPosition(position => {
                document.getElementById('lat').value = position.coords.latitude;
                document.getElementById('lon').value = position.coords.longitude;
                document.getElementById(formId).submit();
            }, (error) => {
                alert("Gagal mengambil lokasi. Pastikan izin GPS aktif.");
                btn.innerHTML = originalContent;
                btn.disabled = false;
            });
        }
    </script>

    @if ($absensiHariIni && $absensiHariIni->latitude)
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const officeLat = {{ $officeLat }};
            const officeLon = {{ $officeLon }};
            const absenLat = {{ $absensiHariIni->latitude }};
            const absenLon = {{ $absensiHariIni->longitude }};

            const map = L.map('map', {
                zoomControl: false // Kita pindahkan zoom control agar lebih rapi
            }).setView([absenLat, absenLon], 15);
            
            L.control.zoom({ position: 'bottomright' }).addTo(map);

            L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', {
                attribution: '© OpenStreetMap'
            }).addTo(map);

            const officeIcon = L.divIcon({
                html: `<div class="bg-red-500 w-4 h-4 rounded-full border-2 border-white shadow-lg"></div>`,
                className: ''
            });

            const userIcon = L.divIcon({
                html: `<div class="bg-teal-500 w-4 h-4 rounded-full border-2 border-white shadow-lg"></div>`,
                className: ''
            });

            L.marker([officeLat, officeLon]).addTo(map).bindPopup("Lokasi Kantor");
            L.marker([absenLat, absenLon]).addTo(map).bindPopup("Lokasi Absen Kamu").openPopup();

            L.polyline([[officeLat, officeLon], [absenLat, absenLon]], { 
                color: '#0d9488', 
                weight: 3, 
                dashArray: '10, 10', 
                opacity: 0.6 
            }).addTo(map);
            
            map.fitBounds(L.latLngBounds([[officeLat, officeLon], [absenLat, absenLon]]), { padding: [50, 50] });
        });
    </script>
    @endif
</body>
</x-app-layout>