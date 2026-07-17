@extends('layouts.app')

@section('content')
    @auth
        <div class="container mx-auto px-4 py-8">
            <div class="card bg-base-100 shadow-sm w-full max-w-2xl mx-auto">
                <div class="card-body">
                    <h2 class="card-title text-2xl font-bold mb-6">Edit New Article</h2>

                    @if ($errors->any())
                        <div class="alert alert-error mb-6">
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

                    <form method="post" class="space-y-6">
                        @csrf

                        <div class="form-control">
                            <label class="label" for="title">
                                <span class="label-text font-semibold">Title</span>
                            </label>
                            <input type="text" id="title"
                                name="title"class="input input-bordered w-full focus:input-primary" value="{{ $article->title }}" />
                        </div>

                        <div class="form-control">
                            <label class="label" for="body">
                                <span class="label-text font-semibold">Body</span>
                            </label>
                            <textarea id="body" name="body" rows="5" class="textarea textarea-bordered w-full focus:textarea-primary">{{ $article->body }}</textarea>
                        </div>

                        <div class="form-control">
                            <label class="label" for="category_id">
                                <span class="label-text font-semibold">Category</span>
                            </label>
                            <select id="category_id" name="category_id"
                                class="select select-bordered w-full focus:select-primary">
                                @foreach ($categories as $category)
                                    <option value="{{ $category['id'] }}" 
                                        {{ $article->category_id == $category['id'] ? 'selected' : '' }}>
                                        {{ $category['name'] }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="flex justify-end gap-4 mt-8">
                            <a href="/articles" class="btn btn-outline">Cancel</a>
                            <button type="submit" class="btn btn-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                                Add Article
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endauth
@endsection
