<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;
use Exception;

class JsonResponseMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $request->headers->set('Accept', 'application/json');

        try {
            if ($token = $request->header('Authorization')) {
                JWTAuth::parseToken()->authenticate();
            }
        } catch (Exception $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
                return response()->json([
                    'status' => false,
                    'message' => 'Token has expired'
                ], 401);
            } else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException) {
                return response()->json([
                    'status' => false,
                    'message' => 'Token is invalid'
                ], 401);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Authorization token not found'
                ], 401);
            }
        }

        return $next($request);
    }
}
