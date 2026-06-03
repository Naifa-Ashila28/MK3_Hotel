<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StayIn - Admin Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-slate-950 flex items-center justify-center h-screen">

    <div class="w-full max-w-md bg-slate-900 rounded-2xl shadow-xl border border-slate-800 p-8 m-4">
        <div class="text-center mb-8">
            <h1 class="text-2xl font-bold tracking-wider text-blue-500">STAYIN <span class="text-white text-sm font-normal">ADMIN</span></h1>
            <p class="text-gray-400 text-sm mt-2">Silahkan masuk untuk mengelola dashboard</p>
        </div>

        @if(session('error'))
            <div class="bg-red-900/30 border border-red-500 text-red-200 text-sm p-3 rounded-lg mb-4 flex items-center">
                <i class="fa-solid fa-triangle-exclamation mr-2"></i> {{ session('error') }}
            </div>
        @endif

        <form action="/admin/login" method="POST" class="space-y-5">
            @csrf
            <div>
                <label class="block text-gray-400 text-xs uppercase font-semibold mb-2">Username</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500">
                        <i class="fa-solid fa-user"></i>
                    </span>
                    <input type="text" name="username" required autocomplete="off"
                        class="w-full bg-slate-950 text-white border border-slate-800 rounded-lg pl-10 pr-4 py-2.5 focus:outline-none focus:border-blue-500 transition" placeholder="Masukkan username">
                </div>
            </div>

            <div>
                <label class="block text-gray-400 text-xs uppercase font-semibold mb-2">Password</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500">
                        <i class="fa-solid fa-lock"></i>
                    </span>
                    <input type="password" name="password" required
                        class="w-full bg-slate-950 text-white border border-slate-800 rounded-lg pl-10 pr-4 py-2.5 focus:outline-none focus:border-blue-500 transition" placeholder="••••••••">
                </div>
            </div>

            <button type="submit" 
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-lg transition duration-200 shadow-lg shadow-blue-600/20">
                Masuk Ke Dashboard
            </button>
        </form>
    </div>

</body>
</html>