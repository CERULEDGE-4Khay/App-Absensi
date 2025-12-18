<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>{{ config('app.name') }} - Login</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-indigo-600 to-blue-500">

    <div class="w-full max-w-md">
        {{ $slot }}
    </div>

</body>
</html>
