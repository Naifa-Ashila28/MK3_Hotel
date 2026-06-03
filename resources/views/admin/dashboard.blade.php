<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StayIn - Admin Dashboard</title>
    <!-- Pakai Tailwind CSS CDN biar cepet & enteng -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Icon pack FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-100 font-sans antialiased">

    <div class="flex h-screen overflow-hidden">
        
        <!-- SIDEBAR UTAMA -->
        <div class="w-64 bg-slate-900 text-white flex flex-col hidden md:flex">
            <div class="h-16 flex items-center justify-center bg-slate-950 px-6">
                <span class="text-xl font-bold tracking-wider text-blue-500">STAYIN <span class="text-white text-sm font-normal">ADMIN</span></span>
            </div>
            <div class="flex-1 overflow-y-auto px-4 py-6 space-y-1">
                <a href="#" class="flex items-center px-4 py-3 text-white bg-blue-600 rounded-lg font-medium transition">
                    <i class="fa-solid fa-users mr-3 w-5"></i> Data Lokasi User
                </a>
            </div>
            <div class="p-4 border-t border-slate-800">
                <a href="#" class="flex items-center px-4 py-3 text-red-400 hover:bg-red-900/20 hover:text-red-300 rounded-lg transition">
                    <i class="fa-solid fa-right-from-bracket mr-3 w-5"></i> Keluar
                </a>
            </div>
        </div>

        <!-- KONTEN UTAMA KANAN -->
        <div class="flex-1 flex flex-col overflow-y-auto">
            
            <!-- TOPBAR -->
            <header class="h-16 bg-white shadow-sm flex items-center justify-between px-8 z-10">
                <div class="flex items-center">
                    <h1 class="text-lg font-semibold text-gray-700">Kelola Pengguna & Koordinat GPS</h1>
                </div>
                <div class="flex items-center space-x-4">
                    <span class="text-sm font-medium text-gray-600">Halo, Admin 👋</span>
                    <div class="w-10 h-10 rounded-full bg-blue-500 flex items-center justify-center text-white font-bold">A</div>
                </div>
            </header>

            <!-- ISI DASHBOARD -->
            <main class="p-8">
                
                <!-- CARD STATISTIK TOTAL USER -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-400 uppercase">Total Pengguna Terdaftar</p>
                            <h3 class="text-3xl font-bold text-gray-800 mt-1">{{ $totalUser }}</h3>
                        </div>
                        <div class="w-12 h-12 bg-purple-100 text-purple-600 rounded-xl flex items-center justify-center text-xl">
                            <i class="fa-solid fa-users"></i>
                        </div>
                    </div>
                </div>

                <!-- TABEL DATA USER & KOORDINAT GPS REALTIME -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="px-6 py-5 border-b border-gray-100">
                        <h2 class="font-semibold text-gray-800">Daftar User & Posisi GPS Terakhir</h2>
                    </div>
                    
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-gray-50 text-gray-400 text-xs font-semibold uppercase tracking-wider">
                                    <th class="px-6 py-4">ID</th>
                                    <th class="px-6 py-4">Nama Lengkap</th>
                                    <th class="px-6 py-4">Email</th>
                                    <th class="px-6 py-4">Latitude</th>
                                    <th class="px-6 py-4">Longitude</th>
                                    <th class="px-6 py-4">Status Lokasi</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-650 text-sm divide-y divide-gray-100">
                                @forelse($dataUser as $user)
                                    <tr class="hover:bg-gray-50/50">
                                        <td class="px-6 py-4 font-semibold text-gray-500">#{{ $user->id }}</td>
                                        <td class="px-6 py-4 font-medium text-gray-800">{{ $user->name }}</td>
                                        <td class="px-6 py-4 text-gray-600">{{ $user->email }}</td>
                                        
                                        <!-- KOLOM LATITUDE REALTIME -->
                                        <td class="px-6 py-4 font-mono text-blue-600">
                                            {{ $user->latitude ?? 'Belum Sinkron' }}
                                        </td>
                                        
                                        <!-- KOLOM LONGITUDE REALTIME -->
                                        <td class="px-6 py-4 font-mono text-blue-600">
                                            {{ $user->longitude ?? 'Belum Sinkron' }}
                                        </td>
                                        
                                        <!-- BADGE PENANDA APAKAH USER ADA GPS-NYA -->
                                        <td class="px-6 py-4">
                                            @if(!empty($user->latitude) && !empty($user->longitude))
                                                <span class="px-2.5 py-1 text-xs font-semibold text-green-700 bg-green-100 rounded-full">
                                                    <i class="fa-solid fa-location-dot mr-1"></i> Terlacak
                                                </span>
                                            @else
                                                <span class="px-2.5 py-1 text-xs font-semibold text-gray-500 bg-gray-100 rounded-full">
                                                    GPS Mati / Null
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-8 text-center text-gray-400">
                                            Belum ada user yang terdaftar di database lu, bro.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

            </main>
        </div>
    </div>

</body>
</html>