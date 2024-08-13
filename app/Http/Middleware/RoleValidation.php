<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;

class RoleValidation
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        if (!$user = JWTAuth::user())
            return response()->json(['message' => 'Usuário não encontrado...'], 404);

        if (!$user->role == $role)
            return response()->json(['message' => 'O usuário não tem autorização para acessar esssa rota!'], 403);

        return $next($request);
    }
}
