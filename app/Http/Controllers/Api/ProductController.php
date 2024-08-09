<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allProducts = Product::all();

        return response()
            ->json(['data' => $allProducts], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        try
        {
            return response()->json(['data' => $product], 200);
        }
        catch(QueryException $e)
        {
            Log::error($e);
            return response()->json(['message' => 'Erro ao buscar produto'], 400);
        }
        catch(\Exception $e)
        {
            Log::error($e);
            return response()->json(['message' => 'Erro inesperado ao buscar produto'], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $storeRequest)
    {
        try
        {
            $productValidated = $storeRequest->validated();
            $productCreated = Product::create($productValidated);

            return response()->json(['data' => $productCreated], 201);
        }
        catch(QueryException $e)
        {
            Log::error($e);
            return response()->json(['message' => 'Erro ao criar produto'], 400);
        }
        catch(\Exception $e)
        {
            Log::error($e);
            return response()->json(['message' => 'Erro inesperado ao criar produto'], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $updateRequest, Product $product)
    {
        try
        {
            $productValidated = $updateRequest->validated();
            $product->update($productValidated);

            return response()->json(['data' => $productValidated], 200);
        }
        catch(QueryException $e)
        {
            Log::error($e);
            return response()->json(['message' => 'Erro ao atualizar produto'], 400);
        }
        catch(\Exception $e)
        {
            Log::error($e);
            return response()->json(['message' => 'Erro inesperado ao atualizar produto'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        try
        {
            $product->delete();
            return response()->noContent();
        }
        catch(QueryException $e)
        {
            Log::error($e);
            return response()->json(['message' => 'Erro ao excluir produto'], 400);
        }
        catch(\Exception $e)
        {
            Log::error($e);
            return response()->json(['message' => 'Erro inesperado ao excluir produto'], 500);
        }
    }
}
