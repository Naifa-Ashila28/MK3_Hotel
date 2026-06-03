<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;

class LogUserActivity
{
    public function handle(Request $request, Closure $next)
    {
        // Jika ada user yang terdeteksi sedang login / melakukan request
        if (Auth::check()) {
            // Set penanda di cache selama 2 menit kedepan bahwa user id ini "Online"
            $expiresAt = Carbon::now()->addMinutes(2);
            Cache::put('user-is-online-' . Auth::user()->id, true, $expiresAt);
        }

        return $next($request);
    }
}