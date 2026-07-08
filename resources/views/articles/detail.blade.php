@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card border-primary mb-3">
            <div class="card-header text-sm">
                {{ $article->category['name'] }}
            </div>
            <div class="card-body text-primary">
                <h5 class="card-title">{{ $article['title'] }}</h5>
                <p class="card-text">{{ $article['body'] }}</p>
                @auth
                <a class="btn btn-warning" href="{{ url("/articles/delete/$article->id") }}">Delete</a>
                @endauth
            </div>
            <div class="card-footer d-flex justify-content-between align0items-center   ">
                <span>Created By : {{ $article->user['name'] }}</span>
                <span>{{ $article->created_at->diffForHumans() }}</span>
            </div>


        </div>
        <ul class="list-group">
            <li class="list-group-item active">Comments</li>
            @foreach ($article->comment as $comment)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        {{ $comment['content'] }}<br>
                        by : {{ $comment->user ? $comment->user['name'] : 'Unknown' }}, {{ $comment->created_at->diffForHumans() }}
                    </div>
                    @auth
                    <a class="btn btn-outline-warning m-3" href="{{ url("/comments/delete/$comment->id") }}">x</a>
                    @endauth
                </li>
            @endforeach
        </ul>
        @if ($errors->any())
            <div class="alert alert-warning" role="alert">
                <ol>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ol>
            </div>
        @endif
        @auth
        <form class="mt-3" action="{{ url('/comments/add') }}" method="post">
            @csrf
            <input type="hidden" value="{{ $article['id'] }}" name="article_id">
            <textarea class="form-control" placeholder="Leave a Comment Here" id="content" name="content" style="height: 100px"></textarea>
            <input class="btn btn-primary mt-3" type="submit" id="submit" value="Add Comment">
        </form>
        @endauth
    </div>
    </div>
@endsection
