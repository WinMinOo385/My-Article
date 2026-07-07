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
                <a class="btn btn-warning" href="{{ url("/articles/delete/$article->id") }}">Delete</a>
            </div>
            <div class="card-footer">
                {{ $article->created_at->diffForHumans() }}
            </div>


        </div>
        <div class="card border-primary mb-3">
            <div class="card-header">
                Comments
            </div>
            <div class="card-body text-primary">
                @foreach ($article->comment as $comment)
                    <p class="card-text " aria-disabled="true">
                        {{ $comment['content'] }}
                    </p>
                @endforeach
            </div>
        </div>
        @if ($errors->any())
            <div class="alert alert-warning" role="alert">
                <ol>
                    @foreach ( $errors->all() as $error )
                        <li>{{ $error }}</li>
                    @endforeach
                </ol>
            </div>
        @endif
        <form action="{{ url('/comments/add') }}" method="post">
            @csrf
            <input type="hidden" value="{{ $article['id'] }}" name="article_id">
            <textarea class="form-control" placeholder="Leave a Comment Here" id="content" name="content" style="height: 100px" ></textarea>
            <input class="btn btn-primary mt-3" type="submit" id="submit" value="Add Comment">
        </form>
    </div>
    </div>
@endsection
