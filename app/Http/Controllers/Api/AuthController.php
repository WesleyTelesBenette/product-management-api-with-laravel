<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function login(Request $loginRequest)
    {
        try
        {
            $credentials = $loginRequest->only('email', 'password');

            if ($token = auth('api')->attempt($credentials))
            {
                return response()->json
                ([
                    'data' =>
                    [
                        'token' => $token,
                        'token_type' => 'bearer',
                        'expires_in' => JWTAuth::factory()->getTTL() * 60
                    ]
                ]);
            }

            return response()->json(['message' => 'Credenciais inválidas!'], 401);
        }
        catch(\Exception $e)
        {
            Log::error($e);
            return response()->json(['message' => 'Erro inesperado ao fazer Login'], 500);
        }
    }

    public function logout()
    {
        try
        {
            $user = JWTAuth::invalidate(JWTAuth::getToken());
            return response()->json(['message' => 'Logout realizado com sucesso'], 200);
        }
        catch (TokenInvalidException $e)
        {
            Log::error($e);
            return response()->json(['message' => 'Token inválido'], 401);
        }
        catch (TokenExpiredException $e)
        {
            Log::error($e);
            return response()->json(['message' => 'Token expirado'], 401);
        }
        catch(\Exception $e)
        {
            Log::error($e);
            return response()->json(['message' => 'Erro inesperado ao fazer Logout'], 500);
        }
    }
}
