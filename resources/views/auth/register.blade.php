@extends('layouts.app')

@section('content')
<div class="h-screen flex items-center justify-center bg-base-200">
    <div class="card w-full max-w-md bg-base-100 shadow-xl">
        <div class="card-body">
            <h2 class="card-title text-2xl font-bold text-center mb-6">{{ __('Register') }}</h2>

            <form method="POST" action="{{ route('register') }}" class="space-y-4">
                @csrf

                <div class="form-control">
                    <label for="name" class="label">
                        <span class="label-text">{{ __('Name') }}</span>
                    </label>
                    <input 
                        id="name" 
                        type="text" 
                        class="input input-bordered w-full @error('name') input-error @enderror" 
                        name="name" 
                        value="{{ old('name') }}" 
                        required 
                        autocomplete="name" 
                        autofocus
                        placeholder="John Doe"
                    >
                    @error('name')
                        <div class="label">
                            <span class="label-text-alt text-error">{{ $message }}</span>
                        </div>
                    @enderror
                </div>

                <div class="form-control">
                    <label for="email" class="label">
                        <span class="label-text">{{ __('Email Address') }}</span>
                    </label>
                    <input 
                        id="email" 
                        type="email" 
                        class="input input-bordered w-full @error('email') input-error @enderror" 
                        name="email" 
                        value="{{ old('email') }}" 
                        required 
                        autocomplete="email"
                        placeholder="name@example.com"
                    >
                    @error('email')
                        <div class="label">
                            <span class="label-text-alt text-error">{{ $message }}</span>
                        </div>
                    @enderror
                </div>

                <div class="form-control">
                    <label for="password" class="label">
                        <span class="label-text">{{ __('Password') }}</span>
                    </label>
                    <input 
                        id="password" 
                        type="password" 
                        class="input input-bordered w-full @error('password') input-error @enderror" 
                        name="password" 
                        required 
                        autocomplete="new-password"
                        placeholder="••••••••"
                    >
                    @error('password')
                        <div class="label">
                            <span class="label-text-alt text-error">{{ $message }}</span>
                        </div>
                    @enderror
                </div>

                <div class="form-control">
                    <label for="password-confirm" class="label">
                        <span class="label-text">{{ __('Confirm Password') }}</span>
                    </label>
                    <input 
                        id="password-confirm" 
                        type="password" 
                        class="input input-bordered w-full" 
                        name="password_confirmation" 
                        required 
                        autocomplete="new-password"
                        placeholder="••••••••"
                    >
                </div>

                <div class="form-control mt-6">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Register') }}
                    </button>
                </div>

                <div class="divider">OR</div>

                <div class="text-center">
                    <p class="text-sm">
                        {{ __("Already have an account?") }}
                        <a class="link link-primary" href="{{ route('login') }}">
                            {{ __('Login here') }}
                        </a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
