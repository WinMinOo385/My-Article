<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class CategoryApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Cache::rememberForever('categories', function () {
            return Categories::all()->toArray();
        });
        
        return $categories;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $category = new Categories;
        $category->name = request()->name;
        $category->save();

        Cache::forget('categories');

        return $category;
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $category = Categories::find($id);

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

        Cache::forget('categories');

        return $category;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $category = Categories::find($id);
        $category->delete();

        Cache::forget('categories');

        return $category;
    }
}
