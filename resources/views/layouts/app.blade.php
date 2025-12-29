<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Dashboard Admin' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


</head>
<body class="bg-gray-100">
    <div x-data="{ loaded: false }" x-init="window.onload = () => { setTimeout(() => loaded = true, 500) }">
        <div x-show="!loaded"
            class="fixed inset-0 z-[9999] flex items-center justify-center bg-white">
            <div class="flex flex-col items-center">
                <div class="w-16 h-16 border-4 border-teal-100 border-t-teal-600 rounded-full animate-spin"></div>
                <p class="mt-4 text-slate-500 font-medium animate-pulse">Tunggu Sebentar...</p>
            </div>
        </div>
    </div>
<div class="flex min-h-screen">

    {{-- SIDEBAR --}}
    @auth
        <x-sidebar />
    @endauth

    {{-- MAIN CONTENT --}}
    <main class="flex-1 p-6">
        {{ $slot }}
    </main>

</div>

</body>
</html>
