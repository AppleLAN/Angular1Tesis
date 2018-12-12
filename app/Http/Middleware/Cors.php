<?php

namespace App\Http\Middleware;

use Closure;

class Cors {
    public function handle($request, Closure $next)
    {
        return $next($request)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE')
            ->header('Access-Control-Allow-Headers', 'Origin, Accept, Content-Type, Access-Control-Allow-Headers, X-Requested-With, Authorization');
    }
}
