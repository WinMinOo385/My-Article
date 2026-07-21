<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Services\CategoryCacheService;
use Illuminate\Http\Request;

class CategoryApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categoryService = new CategoryCacheService();
        return $categoryService->getCategories();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $category = new Categories;
        $category->name = request()->name;
        $category->save();

        $categoryService = new CategoryCacheService();
        $categoryService->clearCache();

        return $category;
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $categoryService = new CategoryCacheService();
        $categories = $categoryService->getCategories();
        
        $category = collect($categories)->firstWhere('id', $id);

        return $category;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id)
    {
        $category = Categories::find($id);
        $category->name = request()->name;
        $category->save();

        $categoryService = new CategoryCacheService();
        $categoryService->clearCache();

        return $category;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $category = Categories::find($id);
        $category->delete();

        $categoryService = new CategoryCacheService();
        $categoryService->clearCache();

        return $category;
    }

    
}
