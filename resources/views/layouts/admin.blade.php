<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - MK3 Hotel</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans antialiased">
    <div class="flex h-screen overflow-hidden">
        
        <aside class="w-64 bg-slate-900 h-screen text-white flex flex-col hidden md:flex">
            <div class="p-5 text-xl font-bold tracking-wider border-b border-slate-800 text-blue-400">🏨 MK3 HOTEL</div>
            <nav class="flex-1 p-4 space-y-2">
                <a href="/admin/dashboard" class="flex items-center space-x-3 px-4 py-2.5 rounded bg-blue-600 text-white">
                    <span>📊</span> <span>Dashboard</span>
                </a>
                <a href="/admin/hotels" class="flex items-center space-x-3 px-4 py-2.5 rounded text-gray-400 hover:bg-slate-800 hover:text-white transition">
                    <span>🏢</span> <span>Kelola Hotel</span>
                </a>
                <a href="#" class="flex items-center space-x-3 px-4 py-2.5 rounded text-gray-400 hover:bg-slate-800 hover:text-white transition">
                    <span>📅</span> <span>Data Booking</span>
                </a>
            </nav>
            <div class="p-4 border-t border-slate-800">
                <a href="/" class="block w-full text-center bg-red-600 hover:bg-red-700 py-2 rounded text-sm font-semibold transition">
                    Keluar Web
                </a>
            </div>
        </aside>

        <div class="relative flex flex-1 flex-col overflow-y-auto">
            <header class="sticky top-0 bg-white py-4 px-6 flex justify-between items-center border-b border-gray-200 z-10">
                <h1 class="text-xl font-semibold text-gray-800">Overview</h1>
                <div class="flex items-center space-x-3">
                    <span class="text-sm text-gray-600">Hello, <strong>Admin MK3</strong></span>
                    <div class="w-8 h-8 rounded-full bg-slate-800 text-white flex items-center justify-center text-xs font-bold">A</div>
                </div>
            </header>
            
            <main class="p-6">
                @yield('content')
            </main>
        </div>

    </div>
</body>
</html>