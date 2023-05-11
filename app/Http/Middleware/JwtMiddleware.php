<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;

class JwtMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (\Exception $e) {
            if ($e instanceof TokenInvalidException) {
                return response()->json(['error' => 'Invalid token'], 401);
            } elseif ($e instanceof TokenExpiredException) {
                return response()->json(['error' => 'Token expired'], 401);
            } else {
                return response()->json(['error' => 'Token not provided'], 401);
            }
        }

        return $next($request);
    }
}

