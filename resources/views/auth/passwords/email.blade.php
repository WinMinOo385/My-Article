@extends('layouts.app')

@section('content')
<div class="h-screen flex items-center justify-center bg-base-200">
    <div class="card w-full max-w-md bg-base-100 shadow-xl">
        <div class="card-body">
            <h2 class="card-title text-2xl font-bold text-center mb-6">{{ __('Reset Password') }}</h2>

            @if (session('status'))
                <div class="alert alert-success shadow-lg mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>{{ session('status') }}</span>
                </div>
            @endif

            <p class="text-center mb-6">{{ __('Enter your email address and we will send you a password reset link.') }}</p>

            <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
                @csrf

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
                        autofocus
                        placeholder="name@example.com"
                    >
                    @error('email')
                        <div class="label">
                            <span class="label-text-alt text-error">{{ $message }}</span>
                        </div>
                    @enderror
                </div>

                <div class="form-control mt-6">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Send Password Reset Link') }}
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
