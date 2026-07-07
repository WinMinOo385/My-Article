<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;

class CategoriesApi extends Controller
{
    public function index()
    {
        return Categories::all();     
    }
}
