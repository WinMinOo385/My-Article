<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;

class CategoryApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Categories::all();
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
        return $category;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $category = Categories::find($id);
        $category->delete();
        return $category;
    }
}
