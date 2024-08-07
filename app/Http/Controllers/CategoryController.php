<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Models\Category;
use Illuminate\Database\QueryException;
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allCategories = Category::all();

        return response()
            ->json(['data' => $allCategories], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        try
        {
            return response()->json(['data' => $category], 200);
        }
        catch(NotFoundHttpException $e)
        {
            Log::error($e);
            return response()->json(['message' => 'Erro ao buscar categoria'], 404);
        }
        catch(\Exception $e)
        {
            Log::error($e);
            return response()->json(['message' => 'Erro inesperado'], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $storeRequest)
    {
        try
        {
            $categoryValidated = $storeRequest->validated();
            $categoryCreated = Category::create($categoryValidated);

            return response()->json(['data' => $categoryCreated], 201);
        }

        catch(UniqueConstraintViolationException $e)
        {
            Log::error($e);
            return response()->json
            ([
                'message' => "Erro ao criar categoria! O valor informado para o campo Categoria já existe.",
                'error'   => $e->getMessage()
            ], 400);
        }
        catch(QueryException $e)
        {
            Log::error($e);
            return response()->json(['message' => "Erro ao criar categoria"], 400);
        }
        catch(\Exception $e)
        {
            Log::error($e);
            return response()->json(['message' => "Erro inesperado"], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreCategoryRequest $updateRequest, Category $category)
    {
        try
        {
            $categoryValidated = $updateRequest->validated();
            $category->update($categoryValidated);

            return response()->json(['data' => $category], 200);
        }
        catch(QueryException $e)
        {
            Log::error($e);
            return response()->json(['message' => "Erro ao atualizar categoria"], 400);
        }
        catch(\Exception $e)
        {
            Log::error($e);
            return response()->json(['message' => "Erro inesperado"], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        try
        {
            $category->delete();
            return response()->noContent();
        }
        catch(QueryException $e)
        {
            Log::error($e);
            return response()->json(['message' => "Erro ao excluir categoria"], 400);
        }
        catch(\Exception $e)
        {
            Log::error($e);
            return response()->json(['message' => "Erro inesperado"], 500);
        }
    }
}
