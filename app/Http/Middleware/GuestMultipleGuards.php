<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class GuestMultipleGuards
{
    /**
     * menangani permintaan masuk.
     *
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                if ($guard === 'web') {
                    return redirect('/admin/dashboard');
                } elseif ($guard === 'pelanggan') {
                    return redirect('/pelanggan/dashboard');
                }
            }
        }

        return $next($request);
    }
}
