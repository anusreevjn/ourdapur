<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is logged in AND is an admin
        // We assume your users table has an 'is_admin' column (boolean)
        if (!auth()->check() || !auth()->user()->is_admin) {
            abort(403, 'User is not an admin.');
        }

        return $next($request);
    }
}