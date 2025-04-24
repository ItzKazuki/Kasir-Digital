<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckUserStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        if ($user) {
            // Redirect based on user status
            if ($user->status === 'pending') {
                return redirect()->route('account.pending');
            }

            if ($user->status === 'suspended') {
                return redirect()->route('account.suspended');
            }

            if ($user->status === 'denied') {
                return redirect()->route('account.denied');
            }
        }

        return $next($request);
    }
}
