<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        // If no roles specified, allow any authenticated user
        if (empty($roles)) {
            return $next($request);
        }

        // Check if user has one of the allowed roles
        if (!in_array(auth()->user()->role, $roles)) {
            abort(403, 'Unauthorized access');
        }

        return $next($request);
    }
}
