<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class Comments extends Controller
{
    public function add()
    {
        $validator = validator(request()->all(), [
            'article_id' => 'required',
            'content' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $comment = new Comment;
        $comment->content = request('content');
        $comment->article_id = request('article_id');
        $comment->user_id = auth()->user()->id;
        $comment->save();

        return redirect('/articles/detail/' . $comment->article_id);
    }

    public function delete($id)
    {
        $comment = Comment::find($id);

        if (Gate::allows('comment-delete', $comment)) {
            $comment->delete();
            return back();
        }else{
            return back()->with('error', 'Unauthorize');
        }
    }
}
