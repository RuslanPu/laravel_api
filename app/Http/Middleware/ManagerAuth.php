<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ManagerAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth()->user();
        if ($user && ($user->type === 1 || $user->type === 2)) {
            return $next($request);
        }

        return redirect()->route('login')->with('error', 'You do not have permission to access this page!');

    }
}
