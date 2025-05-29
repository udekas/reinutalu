<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class DashboardMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();
        $currentRoute = $request->route() ? $request->route()->getName() : null;

        if ($user->is_admin && $currentRoute !== 'admin.dashboard') {
            return redirect()->route('admin.dashboard');
        } elseif (!$user->is_admin && $currentRoute !== 'dashboard') {
            return redirect()->route('dashboard');
        }

        return $next($request);
    }
}
