<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Authenticate
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            // User is not authenticated, redirect to the login page
            return redirect()->route('startLogin')->with('error', __('auth.login_required'));
        }

        // User is authenticated, allow the request to proceed
        return $next($request);
    }
}
