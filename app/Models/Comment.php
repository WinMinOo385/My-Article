<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Database\Factories\CommentFactory;

class Comment extends Model
{
    use HasFactory;
    
    protected $table = 'comment';

    public function article(){
        return $this->belongsTo('App\Models\Category');
    }
}
