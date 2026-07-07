<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Database\Factories\CategoriesFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Categories extends Model
{
    //
    use HasFactory;

    public function article(){
        return $this->hasMay('App\Models\Article');
    }
}
