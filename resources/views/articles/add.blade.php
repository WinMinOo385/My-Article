@extends('layouts.app')

@section('content')
    @auth
    <div class="container">
        @if ($errors->any())
            <div class="alert alert-warning" role="alert">
                <ol>
                    @foreach ( $errors->all() as $error )
                        <li>{{ $error }}</li>
                    @endforeach
                </ol>
            </div>
        @endif
        {{-- NOTE: Error Handling Method --}}
        <form method="post">
            @csrf{{-- @csrf NOTE: also blade directive --}}
            <div class="form-group pt-3">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="eg : Super Brain">
            </div>
            <div class="form-group pt-3">
                <label for="body">Body</label>
                <textarea class="form-control" id="body" name="body" rows="3"></textarea>
            </div>
            <div class="form-group pt-3">
                <label for="category_id">Category</label>
                <select class="form-select" id="category_id" name="category_id">
                    @foreach ($categories as $category)
                        <option value="{{ $category['id'] }}">
                            {{ $category['name'] }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group pt-3">
                <input type="submit" class="btn btn-primary" value="Add Article">
            </div>
        </form>
    </div>
    @endauth
@endsection
