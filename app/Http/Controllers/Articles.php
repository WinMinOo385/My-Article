<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;

class Articles extends Controller
{
    public function index()
    {
        $data = Article::orderBy('id', 'desc')->paginate(4);

        return view('articles.index', [
            'articles' => $data
        ]);
    }

    public function detail($id)
    {
        $data = Article::find($id);

        return view('articles.detail', [
            'article' => $data
        ]);
    }

    public function add()
    {
        $categories = Categories::all();

        return view('articles.add', [
            'categories' => $categories
        ]);
    }

    public function create()
    {
        // NOTE: https://laravel.com/docs/13.x/validation#available-validation-rules
        $validator = validator(request()->all(), [
            'title' => 'required',
            'body' => 'required',
            'category_id' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $article = new Article;
        $article->title = request('title');
        $article->body = request('body');
        $article->creator_id = auth()->user()->id;
        $article->category_id = request('category_id');
        $article->save();

        Log::info('Articl is Created Successfully.', [
            'user_id' => auth()->id(),
           'title' => $article->title,
        ]);

        return redirect('/articles');      
    }

    public function delete($id)
    {
        $article = Article::find($id);

        if (Gate::denies('article-delete', $article)) {
            return back()->with('error', 'Unauthorize');;
        }

        $article->delete();
        return redirect('/articles');
    }
}
