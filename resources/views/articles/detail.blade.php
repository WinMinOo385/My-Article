@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8" id="article">
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
                    <div class="fab fab-flower">
                        <div tabindex="0" role="button" class="btn btn-circle btn-lg btn-primary">
                            <svg aria-label="New" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor"
                                class="size-6">
                                <path
                                    d="M8.75 3.75a.75.75 0 0 0-1.5 0v3.5h-3.5a.75.75 0 0 0 0 1.5h3.5v3.5a.75.75 0 0 0 1.5 0v-3.5h3.5a.75.75 0 0 0 0-1.5h-3.5v-3.5Z" />
                            </svg>
                        </div>
                        <div class="fab-close">
                            <span class="btn btn-circle btn-lg btn-error">✕</span>
                        </div>
                        <div class="tooltip">
                            <div class="tooltip-content">
                                <div class="animate-bounce text-content-400 -rotate-10 text-2xl font-black">Go Top</div>
                            </div>
                            <a class="btn btn-circle btn-lg btn-primary" href="#article">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="lucide lucide-arrow-up-icon lucide-arrow-up">
                                    <path d="m5 12 7-7 7 7" />
                                    <path d="M12 19V5" />
                                </svg>
                            </a>
                        </div>
                        <div class="tooltip">
                            <div class="tooltip-content">
                                <div class="animate-bounce text-content-400 -rotate-10 text-2xl font-black">Edit</div>
                            </div>
                            <a class="btn btn-circle btn-lg btn-primary" href="{{ url("/articles/edit/$article->id") }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="lucide lucide-pencil-icon lucide-pencil">
                                    <path
                                        d="M21.174 6.812a1 1 0 0 0-3.986-3.987L3.842 16.174a2 2 0 0 0-.5.83l-1.321 4.352a.5.5 0 0 0 .623.622l4.353-1.32a2 2 0 0 0 .83-.497z" />
                                    <path d="m15 5 4 4" />
                                </svg>
                            </a>
                        </div>
                        <div class="tooltip">
                            <div class="tooltip-content">
                                <div class="animate-bounce text-content-400 -rotate-10 text-2xl font-black">Delete</div>
                            </div>
                            <a class="btn btn-circle btn-primary btn-lg" href="{{ url("/articles/delete/$article->id") }}">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                </svg>
                            </a>
                        </div>

                    </div>
                @endauth
            </div>
        </div>
    </div>
@endsection
