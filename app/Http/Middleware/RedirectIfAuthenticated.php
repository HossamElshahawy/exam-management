<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                if(Auth::user() && Auth::user()->role == 0)
                {
                    return redirect()->route('admin.dashboard');
                }
                if(Auth::user() && Auth::user()->role == 1)
                {
                    return redirect()->route('professor.dashboard');
                }
                if(Auth::user() && Auth::user()->role == 2)
                {
                    return redirect()->route('student.dashboard');
                }
            }
        }

        return $next($request);
    }
}
