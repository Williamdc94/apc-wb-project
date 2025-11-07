<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Adaptive Predictive Coding System</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-900 text-gray-100 font-sans antialiased">
    <div class="min-h-screen flex flex-col">
        <!-- Navbar -->
        <nav class="bg-slate-800 border-b border-slate-700 shadow-lg">
            <div class="max-w-7xl mx-auto px-6 py-3 flex justify-between items-center">
                <h1 class="text-2xl font-bold text-green-400">
                    APC System
                </h1>
                <div class="space-x-4">
                    <a href="{{ route('dashboard') }}" class="hover:text-green-400 transition">Dashboard</a>
                    <a href="{{ route('profile.edit') }}" class="hover:text-green-400 transition">Profile</a>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="hover:text-red-400 transition">Logout</button>
                    </form>
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="flex-1 p-6">
            {{ $slot ?? '' }}
        </main>

        <!-- Footer -->
        <footer class="bg-slate-800 py-3 text-center text-sm text-gray-500">
            © {{ date('Y') }} Adaptive Predictive Coding System | Built with ❤️ by Sammy
        </footer>
    </div>
</body>
</html>
