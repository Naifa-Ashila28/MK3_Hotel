<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StayIn - Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-100 font-sans antialiased">

    <div class="flex h-screen overflow-hidden">
        
        <div class="w-64 bg-slate-900 text-white flex flex-col hidden md:flex">
            <div class="h-16 flex items-center justify-center bg-slate-950 px-6">
                <span class="text-xl font-bold tracking-wider text-blue-500">STAYIN <span class="text-white text-sm font-normal">ADMIN</span></span>
            </div>
            
            <div class="flex-1 overflow-y-auto px-4 py-6 space-y-1">
                <button onclick="switchTab('user-tab')" id="btn-user-tab" class="w-full flex items-center px-4 py-3 text-white bg-blue-600 rounded-lg font-medium transition tab-btn">
                    <i class="fa-solid fa-users mr-3 w-5"></i> Data User
                </button>
                <button onclick="switchTab('booking-tab')" id="btn-booking-tab" class="w-full flex items-center px-4 py-3 text-gray-400 hover:bg-slate-800 hover:text-white rounded-lg font-medium transition tab-btn">
                    <i class="fa-solid fa-calendar-check mr-3 w-5"></i> Data Bookings
                </button>
                <button onclick="switchTab('payment-tab')" id="btn-payment-tab" class="w-full flex items-center px-4 py-3 text-gray-400 hover:bg-slate-800 hover:text-white rounded-lg font-medium transition tab-btn">
                    <i class="fa-solid fa-money-bill-wave mr-3 w-5"></i> Data Payments
                </button>
                <button onclick="switchTab('review-tab')" id="btn-review-tab" class="w-full flex items-center px-4 py-3 text-gray-400 hover:bg-slate-800 hover:text-white rounded-lg font-medium transition tab-btn">
                    <i class="fa-solid fa-star mr-3 w-5"></i> Data Reviews
                </button>
            </div>

            <div class="p-4 border-t border-slate-800">
                <a href="/admin/logout" class="flex items-center px-4 py-3 text-red-400 hover:bg-red-900/20 hover:text-red-300 rounded-lg transition">
                    <i class="fa-solid fa-right-from-bracket mr-3 w-5"></i> Keluar
                </a>
            </div>
        </div>

        <div class="flex-1 flex flex-col overflow-y-auto">
            
            <header class="h-16 bg-white shadow-sm flex items-center justify-between px-8 z-10 sticky top-0">
                <div class="flex items-center">
                    <h1 id="header-title" class="text-lg font-semibold text-gray-700">Kelola Pengguna & Koordinat GPS</h1>
                </div>
                <div class="flex items-center space-x-4">
                    <span class="text-sm font-medium text-gray-600">Halo, Admin 👋</span>
                    <div class="w-10 h-10 rounded-full bg-blue-500 flex items-center justify-center text-white font-bold">A</div>
                </div>
            </header>

            <main class="p-8">
                
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-400 uppercase tracking-wider">Total Pengguna</p>
                            <h3 class="text-3xl font-bold text-gray-800 mt-1">{{ is_array($dataUser ?? null) || is_object($dataUser ?? null) ? count($dataUser) : 0 }}</h3>
                        </div>
                        <div class="w-12 h-12 bg-purple-100 text-purple-600 rounded-xl flex items-center justify-center text-xl">
                            <i class="fa-solid fa-users"></i>
                        </div>
                    </div>
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-400 uppercase tracking-wider">Total Bookings</p>
                            <h3 class="text-3xl font-bold text-gray-800 mt-1">{{ is_array($dataBooking ?? null) || is_object($dataBooking ?? null) ? count($dataBooking) : 0 }}</h3>
                        </div>
                        <div class="w-12 h-12 bg-blue-100 text-blue-600 rounded-xl flex items-center justify-center text-xl">
                            <i class="fa-solid fa-calendar-day"></i>
                        </div>
                    </div>
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-400 uppercase tracking-wider">Total Pendapatan</p>
                            <h3 class="text-2xl font-bold text-green-600 mt-2">Rp {{ number_format(collect($dataPayment ?? [])->where('status', 'paid')->sum('amount') ?: collect($dataPayment ?? [])->sum('total_harga'), 0, ',', '.') }}</h3>
                        </div>
                        <div class="w-12 h-12 bg-green-100 text-green-600 rounded-xl flex items-center justify-center text-xl">
                            <i class="fa-solid fa-wallet"></i>
                        </div>
                    </div>
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-400 uppercase tracking-wider">Ulasan Masuk</p>
                            <h3 class="text-3xl font-bold text-gray-800 mt-1">{{ is_array($dataReview ?? null) || is_object($dataReview ?? null) ? count($dataReview) : 0 }}</h3>
                        </div>
                        <div class="w-12 h-12 bg-amber-100 text-amber-600 rounded-xl flex items-center justify-center text-xl">
                            <i class="fa-solid fa-star"></i>
                        </div>
                    </div>
                </div>

                <div id="user-tab" class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden content-tab">
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
                                    <th class="px-6 py-4">Status User</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-650 text-sm divide-y divide-gray-100">
                                @forelse($dataUser ?? [] as $user)
                                    <tr class="hover:bg-gray-50/50">
                                        <td class="px-6 py-4 font-semibold text-gray-500">#{{ $user->id }}</td>
                                        <td class="px-6 py-4 font-medium text-gray-800">{{ $user->name ?? $user->nama_lengkap ?? '-' }}</td>
                                        <td class="px-6 py-4 text-gray-600">{{ $user->email ?? '-' }}</td>
                                        <td class="px-6 py-4 font-mono text-blue-600">{{ $user->latitude ?? 'Null' }}</td>
                                        <td class="px-6 py-4 font-mono text-blue-600">{{ $user->longitude ?? 'Null' }}</td>
                                        <td class="px-6 py-4">
                                            @if(!empty($user->latitude) && !empty($user->longitude))
                                                <span class="px-2.5 py-1 text-xs font-semibold text-green-700 bg-green-100 rounded-full"><i class="fa-solid fa-location-dot mr-1"></i> Terlacak</span>
                                            @else
                                                <span class="px-2.5 py-1 text-xs font-semibold text-gray-500 bg-gray-100 rounded-full">Mati</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4">
                                            @if(\Illuminate\Support\Facades\Cache::has('user-is-online-' . $user->id))
                                                <span class="px-2.5 py-1 text-xs font-semibold text-green-700 bg-green-100 rounded-full inline-flex items-center">
                                                    <span class="w-2 h-2 bg-green-500 rounded-full mr-1.5 animate-pulse"></span> Online
                                                </span>
                                            @else
                                                <span class="px-2.5 py-1 text-xs font-semibold text-gray-500 bg-gray-100 rounded-full inline-flex items-center">
                                                    <span class="w-2 h-2 bg-gray-400 rounded-full mr-1.5"></span> Offline
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="7" class="px-6 py-8 text-center text-gray-400">Belum ada data user.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div id="booking-tab" class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden content-tab hidden">
                    <div class="px-6 py-5 border-b border-gray-100">
                        <h2 class="font-semibold text-gray-800">Riwayat Booking Kamar Hotel</h2>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-gray-50 text-gray-400 text-xs font-semibold uppercase tracking-wider">
                                    <th class="px-6 py-4">ID Booking</th>
                                    <th class="px-6 py-4">Email / User</th>
                                    <th class="px-6 py-4">Hotel ID</th>
                                    <th class="px-6 py-4">Tipe/Jenis Kamar</th>
                                    <th class="px-6 py-4">Tanggal Booking</th>
                                    <th class="px-6 py-4">Status</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-650 text-sm divide-y divide-gray-100">
                                @forelse($dataBooking ?? [] as $booking)
                                    <tr class="hover:bg-gray-50/50">
                                        <td class="px-6 py-4 font-semibold text-gray-500">#{{ $booking->id }}</td>
                                        <td class="px-6 py-4 font-medium text-gray-800">{{ $booking->email ?? $booking->user_name ?? $booking->user_id ?? '-' }}</td>
                                        <td class="px-6 py-4 text-gray-600">#{{ $booking->hotel_id ?? $booking->id_hotel ?? '-' }}</td>
                                        <td class="px-6 py-4 text-gray-700 font-semibold">{{ $booking->jenis_kamar ?? $booking->room_type ?? $booking->tipe_kamar ?? '-' }}</td>
                                        <td class="px-6 py-4 text-gray-600">{{ $booking->waktu_pemesanan ?? $booking->booking_date ?? $booking->created_at ?? '-' }}</td>
                                        <td class="px-6 py-4">
                                            @if(strtolower($booking->status ?? '') == 'paid' || strtolower($booking->status ?? '') == 'success')
                                                <span class="px-2.5 py-1 text-xs font-bold text-green-700 bg-green-100 rounded-full">PAID</span>
                                            @else
                                                <span class="px-2.5 py-1 text-xs font-bold text-red-700 bg-red-100 rounded-full animate-pulse">UNPAID</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="6" class="px-6 py-8 text-center text-gray-400">Belum ada transaksi booking yang masuk.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div id="payment-tab" class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden content-tab hidden">
                    <div class="px-6 py-5 border-b border-gray-100">
                        <h2 class="font-semibold text-gray-800">Catatan Transaksi Pembayaran Real</h2>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-gray-50 text-gray-400 text-xs font-semibold uppercase tracking-wider">
                                    <th class="px-6 py-4">ID Payment</th>
                                    <th class="px-6 py-4">ID Booking</th>
                                    <th class="px-6 py-4">Jumlah Bayar</th>
                                    <th class="px-6 py-4">Metode</th>
                                    <th class="px-6 py-4">Status</th>
                                    <th class="px-6 py-4">Waktu Transaksi</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-650 text-sm divide-y divide-gray-100">
                                @forelse($dataPayment ?? [] as $payment)
                                    <tr class="hover:bg-gray-50/50">
                                        <td class="px-6 py-4 font-semibold text-gray-500">#{{ $payment->id }}</td>
                                        <td class="px-6 py-4 font-medium text-blue-600">#{{ $payment->booking_id ?? $payment->id_booking ?? '-' }}</td>
                                        <td class="px-6 py-4 font-bold text-gray-800">Rp {{ number_format($payment->amount ?? $payment->total_harga ?? $payment->nominal ?? 0, 0, ',', '.') }}</td>
                                        <td class="px-6 py-4 text-gray-600"><i class="fa-solid fa-credit-card mr-1 text-gray-400"></i> {{ $payment->payment_method ?? $payment->metode_pembayaran ?? 'Manual' }}</td>
                                        <td class="px-6 py-4">
                                            <span class="px-2.5 py-1 text-xs font-bold text-green-700 bg-green-100 rounded-full">SUCCESS</span>
                                        </td>
                                        <td class="px-6 py-4 text-gray-500">{{ $payment->created_at ?? '-' }}</td>
                                    </tr>
                                @empty
                                    <tr><td colspan="6" class="px-6 py-8 text-center text-gray-400">Belum ada riwayat pembayaran kas masuk.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div id="review-tab" class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden content-tab hidden">
                    <div class="px-6 py-5 border-b border-gray-100">
                        <h2 class="font-semibold text-gray-800">Ulasan & Rating Dari Pengguna Android</h2>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-gray-50 text-gray-400 text-xs font-semibold uppercase tracking-wider">
                                    <th class="px-6 py-4">User</th>
                                    <th class="px-6 py-4">Nama Hotel</th>
                                    <th class="px-6 py-4">Rating Bintang</th>
                                    <th class="px-6 py-4">Isi Komentar Ulasan</th>
                                    <th class="px-6 py-4">Tanggal Masuk</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-650 text-sm divide-y divide-gray-100">
                                @forelse($dataReview ?? [] as $review)
                                    <tr class="hover:bg-gray-50/50">
                                        <td class="px-6 py-4 font-medium text-gray-800">{{ $review->user_name ?? '-' }}</td>
                                        <td class="px-6 py-4 text-gray-600 font-semibold">{{ $review->nama_hotel ?? '-' }}</td>
                                        <td class="px-6 py-4 text-amber-500 font-bold">
                                            <div class="flex items-center">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <i class="fa-solid fa-star text-xs {{ $i <= ($review->rating ?? 0) ? 'text-amber-400' : 'text-gray-200' }}"></i>
                                                @endfor
                                                <span class="ml-1.5 text-xs text-gray-600">({{ $review->rating ?? 0 }}.0)</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-gray-600 italic bg-gray-50/50">"{{ $review->komentar ?? '-' }}"</td>
                                        <td class="px-6 py-4 text-gray-400 text-xs">
                                            {{ is_string($review->created_at ?? '') ? ($review->created_at ?? '-') : (optional($review->created_at)->format('d M Y') ?? '-') }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="5" class="px-6 py-8 text-center text-gray-400">Belum ada feedback ulasan bintang dari aplikasi HP.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

            </main>
        </div>
    </div>

    <script>
        function switchTab(tabId) {
            // Sembunyikan semua konten tab secara merata
            document.querySelectorAll('.content-tab').forEach(tab => {
                tab.classList.add('hidden');
            });

            // Tampilkan tab yang di-klik
            document.getElementById(tabId).classList.remove('hidden');

            // Reset warna semua tombol menu sidebar
            document.querySelectorAll('.tab-btn').forEach(btn => {
                btn.classList.remove('bg-blue-600', 'text-white');
                btn.classList.add('text-gray-400', 'hover:bg-slate-800', 'hover:text-white');
            });

            // Aktifkan warna tombol yang sedang dibuka
            const activeBtn = document.getElementById('btn-' + tabId);
            if(activeBtn) {
                activeBtn.classList.remove('text-gray-400', 'hover:bg-slate-800', 'hover:text-white');
                activeBtn.classList.add('bg-blue-600', 'text-white');
            }

            // Ganti teks title header secara dinamis
            const titles = {
                'user-tab': 'Kelola Pengguna & Koordinat GPS HP Android',
                'booking-tab': 'Monitoring Antrean Data Booking Kamar',
                'payment-tab': 'Laporan Arus Kas Masuk / Transaksi Sukses',
                'review-tab': 'Daftar Kepuasan Pelanggan (Review & Feedback)'
            };
            document.getElementById('header-title').innerText = titles[tabId] || 'Admin Dashboard';
        }
    </script>
</body>
</html>