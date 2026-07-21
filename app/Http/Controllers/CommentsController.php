<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\commentRequest;

class CommentsController extends Controller
{
    public function add(commentRequest $request)
    {

        $validated = $request->validated();
        
        $comment = new Comment;
        $comment->content = $validated['content'];
        $comment->article_id = $validated['article_id'];
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
        } else {
            return back()->with('error', 'Unauthorize');
        }
    }
}
