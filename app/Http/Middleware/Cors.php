<?php

namespace App\Http\Middleware;

use Closure;

class Cors {
    public function handle($request, Closure $next)
    {
        return $next($request)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE')
            ->header('Referrer-Policy', 'origin')
            ->header('Access-Control-Allow-Headers', 'Accept', 'Origin', 'Content-Type, Access-Control-Allow-Headers, X-Requested-With, Authorization');
    }
}
