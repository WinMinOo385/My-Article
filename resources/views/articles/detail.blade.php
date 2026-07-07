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


    </div>
    </div>
@endsection
