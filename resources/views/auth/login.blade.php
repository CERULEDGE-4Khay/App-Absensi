<x-guest-layout>
    <div class="bg-white shadow-xl rounded-2xl p-8">

        <!-- HEADER -->
        <div class="text-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">
                Sistem Absensi Magang
            </h1>
            <p class="text-gray-500 text-sm mt-1">
                Silakan login untuk melanjutkan
            </p>
        </div>

        <!-- STATUS -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf

            <!-- EMAIL -->
            <div>
                <label class="block text-sm font-medium text-gray-700">
                    Email
                </label>
                <input type="email" name="email" value="{{ old('email') }}" required autofocus
                    class="mt-1 w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                <x-input-error :messages="$errors->get('email')" class="mt-1" />
            </div>

            <!-- PASSWORD -->
            <div>
                <label class="block text-sm font-medium text-gray-700">
                    Password
                </label>
                <input type="password" name="password" required
                    class="mt-1 w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                <x-input-error :messages="$errors->get('password')" class="mt-1" />
            </div>

            <!-- REMEMBER -->
            <div class="flex items-center justify-between">
                <label class="flex items-center text-sm">
                    <input type="checkbox" name="remember"
                        class="rounded border-gray-300 text-indigo-600">
                    <span class="ml-2">Ingat saya</span>
                </label>
            </div>

            <!-- BUTTON -->
            <button type="submit"
                class="w-full bg-indigo-600 hover:bg-indigo-700 text-white py-2 rounded-lg font-semibold transition">
                Login
            </button>
        </form>
        @if (session('error'))
            <p class="mt-4 text-red-600">{{ session('error') }}</p>
        @endif
    </div>
</x-guest-layout>
