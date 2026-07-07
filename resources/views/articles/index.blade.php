@extends('layouts.app')

@section('content')
    <div class="container">
        {{ $articles->links() }}
        @foreach ($articles as $article)
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">{{ $article->title }}</h5>
                    <p class="card-text">{{ $article->body }}</p>
                    <p class="color-info">{{ $article->created_at->diffForHumans() }}</p>
                    <a href="/articles/detail/{{ $article->id }}" class="btn btn-warr">See More</a>
                </div>
            </div>
        @endforeach
    </div>
@endsection
