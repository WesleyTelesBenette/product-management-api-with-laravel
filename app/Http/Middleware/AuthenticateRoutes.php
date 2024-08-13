<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthenticateRoutes
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try
        {
            JWTAuth::parseToken()->authenticate();
            return $next($request);
        }
        catch(\Exception $e)
        {
            if ($e instanceof TokenInvalidException)
            {
                return response()->json(['message' => 'Token inválido'], 401);
            }
            else if ($e instanceof TokenExpiredException)
            {
                return response()->json(['message' => 'Token expirado'], 401);
            }
            else
            {
                return response()->json(['message' => 'O Token não foi encontrado'], 401);
            }
        }
    }
}
