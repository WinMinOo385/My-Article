@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-8">
            @auth
            <form action="{{ url('/articles') }}" method="get" class="w-full">
                <label class="input">
                    <svg class="h-[1em] opacity-50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <g stroke-linejoin="round" stroke-linecap="round" stroke-width="2.5" fill="none" stroke="currentColor">
                            <circle cx="11" cy="11" r="8"></circle>
                            <path d="m21 21-4.3-4.3"></path>
                        </g>
                    </svg>
                    <input type="search" placeholder="Search Article" name="q" value="{{ request('q') }}" />
                </label>
            </form>
                <a href="/articles/add" class="btn btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Add New Article
                </a>
            @endauth
        </div>

        @if ($articles->count() > 0)
            <div class="grid gap-6">
                @foreach ($articles as $article)
                    <div
                        class="card bg-base-100 border border-base-300 shadow-md hover:shadow-lg transition-shadow duration-300">
                        <div class="card-body">
                            <h2 class="card-title text-xl font-bold mb-2 text-base-content">{{ $article->title }}</h2>
                            <p class="text-base-content mb-4">{{ Str::limit($article->body, 150) }}</p>
                            <div class="flex justify-between items-center">
                                <div class="badge badge-info badge-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    {{ $article->created_at->diffForHumans() }}
                                </div>
                                <a href="/articles/detail/{{ $article->id }}" class="btn btn-sm btn-neutral">
                                    Read More
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mt-8 flex justify-center">
                <div class="join">
                    @if ($articles->onFirstPage())
                        <button class="join-item btn btn-primary btn-disabled">«</button>
                    @else
                        <a href="{{ $articles->previousPageUrl() }}" class="join-item btn">«</a>
                    @endif
                    @foreach ($articles->getUrlRange(1, $articles->lastPage()) as $page => $url)
                        @if ($page == $articles->currentPage())
                            <button class="join-item btn btn-active text-base-content">{{ $page }}</button>
                        @else
                            <a href="{{ $articles->appends(request()->query())->url($page) }}" class="join-item btn">{{ $page }}</a>
                        @endif
                    @endforeach

                    @if ($articles->hasMorePages())
                        <a href="{{ $articles->nextPageUrl() }}" class="join-item btn">»</a>
                    @else
                        <button class="join-item btn btn-disabled">»</button>
                    @endif
                </div>
            </div>
        @else
            <div class="card bg-base-100 border border-base-300 shadow-md">
                <div class="card-body text-center py-12">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-400 mb-4" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <h3 class="text-xl font-semibold mb-2">No articles yet</h3>
                    <p class="text-gray-600 mb-6">Be the first to share your thoughts!</p>
                    @auth
                        <a href="/articles/add" class="btn btn-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            Create Your First Article
                        </a>
                    @endauth
                </div>
            </div>
        @endif
    </div>
@endsection
