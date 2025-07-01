<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticateCustom
{
    public function handle(Request $request, Closure $next)
    {
        // Check if user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login first');
        }

        // Optional: Add additional checks
        // Example: Check user role
        // if (!Auth::user()->isAdmin()) {
        //     abort(403, 'Unauthorized action');
        // }

        return $next($request);
    }
}