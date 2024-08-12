<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Database\QueryException;
use Illuminate\Database\UniqueConstraintViolationException;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allUsers = User::all();

        return response()
            ->json(['data' => $allUsers], 200);
    }

     /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        try
        {
            return response()->json(['data' => $user]);
        }
        catch(QueryException $e)
        {
            Log::error($e);
            return response()->json(['message' => 'Erro ao buscar Usuário'], 400);
        }
        catch(\Exception $e)
        {
            Log::error($e);
            return response()->json(['message' => 'Erro inesperado ao buscar Usuário'], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $storeRequest)
    {
        try
        {
            $userValidated = $storeRequest->validated();
            $userValidated['password'] = Hash::make($userValidated['password']);
            $userCreated = User::create($userValidated);

            return response()->json(['data' => $userCreated], 201);
        }
        catch(UniqueConstraintViolationException $e)
        {
            Log::error($e);
            return response()->json
            ([
                'message' => "Erro ao criar usuário! O valor informado para o campo Email já existe",
                'error'   => $e->getMessage()
            ], 400);
        }
        catch(QueryException $e)
        {
            Log::error($e);
            return response()->json(['message' => 'Erro ao criar Usuário'], 400);
        }
        catch(\Exception $e)
        {
            Log::error($e);
            return response()->json(['message' => 'Erro inesperado ao criar Usuário'], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $updateRequest, User $user)
    {
        try
        {
            $userValidated = $updateRequest->validated();
            if (!empty($userValidated['password']))
            {
                $userValidated['password'] = Hash::make($userValidated['password']);
            }
            $user->update($userValidated);

            return response()->json(['data' => $user], 200);
        }
        catch(UniqueConstraintViolationException $e)
        {
            Log::error($e);
            return response()->json
            ([
                'message' => "Erro ao atualizar usuário! O valor informado para o campo Email já existe",
                'error'   => $e->getMessage()
            ], 400);
        }
        catch(QueryException $e)
        {
            Log::error($e);
            return response()->json(['message' => 'Erro ao atualizar Usuário'], 400);
        }
        catch(\Exception $e)
        {
            Log::error($e);
            return response()->json(['message' => 'Erro inesperado ao atualizar Usuário'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        try
        {
            $user->delete();
            return response()->noContent();
        }
        catch(QueryException $e)
        {
            Log::error($e);
            return response()->json(['message' => 'Erro ao excluir Usuário'], 400);
        }
        catch(\Exception $e)
        {
            Log::error($e);
            return response()->json(['message' => 'Erro inesperado ao excluir Usuário'], 500);
        }
    }
}
