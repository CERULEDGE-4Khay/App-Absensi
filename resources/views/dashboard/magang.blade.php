<x-app-layout>
<link
rel="stylesheet"
href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
/>

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <div class="py-6 max-w-4xl mx-auto">

        <h2 class="text-xl font-bold mb-4">
            Dashboard Magang
        </h2>

        <!-- INFO USER -->
        <div class="bg-white rounded-xl shadow p-5 mb-4">
            <p><strong>Nama:</strong> {{ auth()->user()->name }}</p>
            <p><strong>Tanggal:</strong> {{ now()->format('d F Y') }}</p>
        </div>

        <!-- STATUS ABSENSI -->
        <div class="bg-white rounded-xl shadow p-5 mb-4">
            <h3 class="font-semibold mb-2">Status Absensi Hari Ini</h3>

            @if ($absensiHariIni)
                <p>Masuk: {{ $absensiHariIni->jam_masuk }}</p>
                <p>Keluar: {{ $absensiHariIni->jam_keluar ?? '-' }}</p>
                <p>Status: {{ $absensiHariIni->status }}</p>
            @else
                <p class="text-red-500">Belum absen hari ini</p>
            @endif
        </div>
        
        @if ($absensiHariIni && $absensiHariIni->latitude)
        <div class="bg-white rounded-xl shadow p-5 mb-4">
            <h3 class="font-semibold mb-3">Lokasi Absensi Hari Ini</h3>

            <div id="map" class="h-96 rounded-lg"></div>
        </div>
        @endif

        <!-- AKSI -->
        <div class="flex gap-4">
            <form id="absenMasukForm" action="{{ route('absen.masuk') }}" method="POST">
                @csrf
                <input type="hidden" name="latitude" id="lat">
                <input type="hidden" name="longitude" id="lon">

                <button type="button"
                    onclick="getLocationAndSubmit('absenMasukForm')"
                    class="bg-green-600 text-white px-4 py-2 rounded-lg">
                    Absen Masuk
                </button>
            </form>


            <form action="{{ route('absen.keluar') }}" method="POST">
                @csrf
                <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                    Absen Keluar
                </button>
            </form>
            <a href="{{ route('absensi.riwayat') }}"
            class="bg-gray-700 hover:bg-gray-800 text-white px-4 py-2 rounded-lg">
                Lihat Riwayat Absensi
            </a>
        </div>

        <!-- MESSAGE -->
        @if (session('success'))
            <p class="mt-4 text-green-600">{{ session('success') }}</p>
        @endif

        @if (session('error'))
            <p class="mt-4 text-red-600">{{ session('error') }}</p>
        @endif

    </div>
    <script>
    function getLocationAndSubmit(formId) {
        if (!navigator.geolocation) {
            alert("GPS tidak didukung");
            return;
        }

        navigator.geolocation.getCurrentPosition(position => {
            document.getElementById('lat').value = position.coords.latitude;
            document.getElementById('lon').value = position.coords.longitude;
            document.getElementById(formId).submit();
        }, () => {
            alert("Gagal mengambil lokasi");
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

    const map = L.map('map').setView([absenLat, absenLon], 15);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap'
    }).addTo(map);

    L.marker([officeLat, officeLon])
        .addTo(map)
        .bindPopup("Lokasi Kantor");

    L.marker([absenLat, absenLon])
        .addTo(map)
        .bindPopup("Lokasi Absensi Kamu");

    L.polyline([
        [officeLat, officeLon],
        [absenLat, absenLon]
    ], { color: 'blue' }).addTo(map);

});
</script>
@endif


</x-app-layout>
