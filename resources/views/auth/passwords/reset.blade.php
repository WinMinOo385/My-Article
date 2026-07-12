@extends('layouts.app')

@section('content')
<div class="h-screen flex items-center justify-center bg-base-200">
    <div class="card w-full max-w-md bg-base-100 shadow-xl">
        <div class="card-body">
            <h2 class="card-title text-2xl font-bold text-center mb-6">{{ __('Reset Password') }}</h2>

            <p class="text-center mb-6">{{ __('Enter your new password below.') }}</p>

            <form method="POST" action="{{ route('password.update') }}" class="space-y-4">
                @csrf

                <input type="hidden" name="token" value="{{ $token }}">

                <div class="form-control">
                    <label for="email" class="label">
                        <span class="label-text">{{ __('Email Address') }}</span>
                    </label>
                    <input 
                        id="email" 
                        type="email" 
                        class="input input-bordered w-full @error('email') input-error @enderror" 
                        name="email" 
                        value="{{ $email ?? old('email') }}" 
                        required 
                        autocomplete="email" 
                        autofocus
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
                        {{ __('Reset Password') }}
                    </button>
                </div>

                <div class="text-center mt-4">
                    <a class="link link-primary text-sm" href="{{ route('login') }}">
                        {{ __('Back to login') }}
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
