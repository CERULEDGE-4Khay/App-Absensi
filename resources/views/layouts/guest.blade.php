<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>{{ config('app.name') }} - Login</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen flex items-center justify-center bg-slate-50 p-6 relative">
    <div x-data="{ loaded: false }" x-init="window.onload = () => { setTimeout(() => loaded = true, 500) }">
        <div x-show="!loaded"
            class="fixed inset-0 z-[9999] flex items-center justify-center bg-white">
            <div class="flex flex-col items-center">
                <div class="w-16 h-16 border-4 border-teal-100 border-t-teal-600 rounded-full animate-spin"></div>
                <p class="mt-4 text-slate-500 font-medium animate-pulse">Tunggu Sebentar...</p>
            </div>
        </div>
    </div>
    <div class="w-full max-w-md">
        {{ $slot }}
    </div>

</body>
</html>
