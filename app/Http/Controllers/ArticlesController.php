<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Services\CategoryCacheService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\articleRequest;

class ArticlesController extends Controller
{
    public function index()
    {   
        $request = request();
        if ($request && $request->has('q') && $request->q) {
            $searchTerm = $request->q;
            $data = Article::select('title', 'id', 'body', 'created_at')
                ->where(function ($query) use ($searchTerm) {
                    $query
                        ->where('title', 'LIKE', '%' . $searchTerm . '%')
                        ->orWhere('body', 'LIKE', '%' . $searchTerm . '%');
                })
                ->orderBy('id', 'desc')
                ->paginate(4)
                ->appends(['q' => $searchTerm]);
        } else {
            $data = Article::select('title', 'id', 'body', 'created_at')->orderBy('id', 'desc')->paginate(4);
        }

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
        $categoryService = new CategoryCacheService();
        $categories = $categoryService->getCategories();

        return view('articles.add', [
            'categories' => $categories
        ]);
    }

    public function create(articleRequest $request)
    {   
        // NOTE: https://laravel.com/docs/13.x/validation#available-validation-rules

        $validated = $request->validated();

        $article = new Article;
        $article->title = $validated['title'];
        $article->body = $validated['body'];
        $article->creator_id = auth()->id();
        $article->category_id = $validated['category_id'];
        $article->save();


        Log::info('Article is Created Successfully.', [
            'user_id' => auth()->id(),
            'title' => $article->title,
        ]);

        return redirect('/articles');
    }

    public function delete($id)
    {
        $article = Article::find($id);

        if (Gate::denies('article-delete', $article)) {
            return back()->with('error', 'Unauthorize');
        }

        $article->delete();
        return redirect('/articles');
    }

    public function edit(articleRequest $request, $id)
    {
        $article = Article::findOrFail($id);

        // Check authorization AFTER getting the article
        if (Gate::denies('article-edit', $article)) {
            return back()->with('error', 'Unauthorize');
        }

        if ($request->isMethod('post')) {

            $validated = $request->validated();
            $article->title = $validated['title'];
            $article->body = $validated['body'];
            $article->category_id = $validated['category_id'];
            $article->save();


            Log::info('Article is Updated Successfully.', [
                'user_id' => auth()->id(),
                'article_id' => $article->id,
                'title' => $article->title,
            ]);

            return redirect('/articles/detail/' . $article->id);
        }

        $categoryService = new CategoryCacheService();
        $categories = $categoryService->getCategories();

        return view('articles.add', [
            'categories' => $categories
        ]);
    }
}
