<h1>Dashboard</h1>
{{-- // tampilan umum --}}
<a href="{{ route('login') }}">Login</a>

@if (auth()->check())
    <p>Welcome, {{ auth()->user()->name }}!</p>
    <a href="{{ route('dashboard') }}">Go to Dashboard</a>
@else
    <p>Please log in to access your dashboard.</p>
@endif

@if (session('success'))
    <p class="mt-4 text-green-600">{{ session('success') }}</p>
@endif

@if (session('error'))
    <p class="mt-4 text-red-600">{{ session('error') }}</p>
@endif