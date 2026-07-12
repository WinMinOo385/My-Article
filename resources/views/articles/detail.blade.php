@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <!-- Article Card -->
        <div class="card bg-base-100 border border-base-300 shadow-xl mb-8">
            <div class="card-body">
                <div class="badge badge-primary mb-4">
                    {{ $article->category['name'] }}
                </div>

                <h1 class="card-title text-3xl font-bold mb-4 text-base-content">{{ $article['title'] }}</h1>

                <div class="prose max-w-none mb-6">
                    <p class="text-base-content">{{ $article['body'] }}</p>
                </div>

                <div class="flex justify-between items-center mt-8 pt-6 border-t">
                    <div class="flex items-center gap-4">
                        <div class="avatar placeholder">
                            <div class="bg-neutral text-neutral-content rounded-full w-10">
                                <img src="https://img.daisyui.com/images/profile/demo/yellingcat@192.webp" />

                                <span class="text-xs">{{ substr($article->user['name'], 0, 2) }}</span>
                            </div>
                        </div>
                        <div>
                            <p class="font-medium">Created by: {{ $article->user['name'] }}</p>
                            <p class="text-sm text-gray-500">{{ $article->created_at->diffForHumans() }}</p>
                        </div>
                    </div>

                    @auth
                        <a class="btn btn-neutral" href="{{ url("/articles/delete/$article->id") }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                            Delete Article
                        </a>
                    @endauth
                </div>
            </div>
        </div>

        <!-- Comments Section -->
        <div class="card bg-base-100  border border-base-300 shadow-lg">
            <div class="card-body">
                <h2 class="card-title text-2xl font-bold mb-6">Comments</h2>

                @if ($article->comment->count() > 0)
                    <div class="space-y-4">
                        @foreach ($article->comment as $comment)
                            <div class="chat chat-start">
                                <div class="chat-image avatar placeholder">
                                    <div class="w-10 rounded-full bg-neutral text-neutral-content">
                                        <img src="https://img.daisyui.com/images/profile/demo/yellingwoman@192.webp" />

                                        <span
                                            class="text-xs">{{ $comment->user ? substr($comment->user['name'], 0, 2) : '?' }}</span>
                                    </div>
                                </div>
                                <div class="chat-header mb-1">
                                    {{ $comment->user ? $comment->user['name'] : 'Unknown' }}
                                    <time class="text-xs opacity-50 ml-2">{{ $comment->created_at->diffForHumans() }}</time>
                                </div>
                                <div class="chat-bubble bg-neutral text-neutral-content">{{ $comment['content'] }}</div>
                                @auth
                                    <div class="chat-footer">
                                        <a class="btn btn-xs btn-ghost text-error"
                                            href="{{ url("/comments/delete/$comment->id") }}">
                                            Delete
                                        </a>
                                    </div>
                                @endauth
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-400 mb-4" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                        </svg>
                        <h3 class="text-lg font-medium mb-2">No comments yet</h3>
                        <p class="text-gray-600">Be the first to share your thoughts!</p>
                    </div>
                @endif

                <!-- Comment Form -->
                @auth
                    @if ($errors->any())
                        <div class="alert alert-error mt-6">
                            <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <div>
                                <h3 class="font-bold">Please fix the following errors:</h3>
                                <ul class="list-disc pl-5 mt-2">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif

                    <form class="mt-6" action="{{ url('/comments/add') }}" method="post">
                        @csrf
                        <input type="hidden" value="{{ $article['id'] }}" name="article_id">

                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-semibold">Add a Comment</span>
                            </label>
                            <textarea class="textarea textarea-bordered w-full focus:textarea-primary" placeholder="Leave a comment here..."
                                id="content" name="content" rows="4"></textarea>
                        </div>

                        <div class="flex justify-end mt-4">
                            <button type="submit" class="btn btn-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                                </svg>
                                Add Comment
                            </button>
                        </div>
                    </form>
                @endauth
            </div>
        </div>
    </div>
@endsection
