<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Wavey\Sweetalert\Sweetalert;

class KasirMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->role === 'kasir') {
            return $next($request);
        }

        Sweetalert::error('You are not authorized to access this page', 'Unauthorized');
        return redirect()->route('dashboard.index');
    }
}
