<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class Comments extends Controller
{

    public function add(){
        $validator = validator(request()->all(), [
            'article_id' => 'required',
            'content' => 'required',
        ]);

        if($validator->fails()){
            return back()->withErrors($validator);
        }


        $comment = new Comment;
        $comment->content = request('content');
        $comment->article_id = request('article_id');
        $comment->save();

        return redirect('/articles/detail/'.$comment->article_id);
    }

    public function delete($id){
        $comment = Comment::find($id);
        $comment->delete();
        return back();
    }

}