<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Categories;
use Illuminate\Http\Request;

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
        $article->category_id = request('category_id');
        $article->save();
    }

    public function delete($id)
    {
        $article = Article::find($id);
        $article->delete();
        return redirect("/articles");
    }
}
