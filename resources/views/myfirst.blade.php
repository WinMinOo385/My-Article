@extends('layouts.app')

@section('content')
    <div class="flex flex-col justify-center items-center min-h-[calc(100vh-8rem)] px-4">
        <div class="text-center max-w-4xl mx-auto">
            <h1 class="text-3xl md:text-5xl font-bold mb-6 md:mb-8 leading-tight">
                Your daily source to get
            </h1>

            <span class="text-rotate text-4xl" >
                <span class="justify-center">
                    <span class="text-teal-500">💡 Inspired</span>
                    <span class="text-red-500">📖 Informed</span>
                    <span class="text-blue-500">⚡ Empowered</span>
                    <span class="text-green-500">🎯 Engaged</span>
                </span>
            </span>
            
            <div class="flex justify-center items-center w-full mt-8">
                <a href="/articles"
                    class="btn btn-primary btn-lg px-6 md:px-8 py-3 md:py-4 text-lg md:text-xl shadow-lg hover:shadow-xl transition-shadow duration-300">
                    Start Reading
                </a>
            </div>
        </div>
    </div>
@endsection
