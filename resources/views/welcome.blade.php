<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Adaptive Predictive Coding System</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>

    <style>
        .glow {
            text-shadow: 0 0 15px rgba(34, 197, 94, 0.5);
        }
        .btn {
            background-color: #22c55e;
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            font-weight: 600;
            transition: 0.3s;
        }
        .btn:hover {
            background-color: #16a34a;
            transform: scale(1.05);
        }
        .btn-blue {
            background-color: #3b82f6;
        }
        .btn-blue:hover {
            background-color: #2563eb;
            transform: scale(1.05);
        }
        .gradient-bg {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            animation: gradientShift 10s ease infinite alternate;
        }
        @keyframes gradientShift {
            from { background-position: left; }
            to { background-position: right; }
        }
    </style>
</head>

<body class="bg-slate-900 text-gray-100 font-sans antialiased gradient-bg">
    <div class="min-h-screen flex flex-col">
        <!-- Navbar -->
        <nav class="bg-slate-800 border-b border-slate-700 shadow-lg">
            <div class="max-w-7xl mx-auto px-6 py-3 flex justify-between items-center">
                <h1 class="text-2xl font-bold text-green-400">APC System</h1>
                <div class="space-x-4">
                    <a href="{{ route('login') }}" class="hover:text-green-400 transition">Login</a>
                    <a href="{{ route('register') }}" class="hover:text-green-400 transition">Register</a>
                    <a href="{{ route('dashboard') }}" class="hover:text-green-400 transition">Dashboard</a>
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="flex-1 flex flex-col justify-center items-center text-center px-6 py-16">
            <div>
                <h1 class="text-5xl font-extrabold text-green-400 mb-6 glow">
                    Adaptive Predictive Coding System
                </h1>

                <h2 class="text-2xl text-gray-300 mb-8">
                    <span id="typed-text"></span>
                </h2>

                <p class="text-gray-400 max-w-xl mx-auto mb-10 leading-relaxed">
                    A web-based platform that intelligently compresses time-series data using adaptive predictive algorithms — 
                    optimizing storage, improving performance, and reducing redundancy for large datasets.
                </p>

                <div class="space-x-4">
                    <a href="{{ route('login') }}" class="btn">Login</a>
                    <a href="{{ route('register') }}" class="btn btn-blue">Get Started</a>
                </div>
            </div>
        </main>

        <!-- Footer -->
        <footer class="bg-slate-800 py-3 text-center text-sm text-gray-500">
            © {{ date('Y') }} Adaptive Predictive Coding System | Built with ❤️ by Sammy
        </footer>
    </div>

    <!-- Typing Animation -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            new Typed("#typed-text", {
                strings: [
                    "Optimizing Time-Series Data Storage...",
                    "Compressing Files Intelligently...",
                    "Learning and Adapting with Each Upload...",
                    "Empowering Smarter Web-Based Systems!"
                ],
                typeSpeed: 60,
                backSpeed: 30,
                backDelay: 1500,
                loop: true
            });
        });
    </script>
</body>
</html>
