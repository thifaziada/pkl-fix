<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the user has the 'admin' role
        if ($request->user() && $request->user()->hasRole('admin')) {
            return $next($request);
        }

        // Jika tidak memiliki peran 'admin', mungkin bisa diarahkan ke halaman lain
        abort(403, 'Unauthorized');
    }
    
}
