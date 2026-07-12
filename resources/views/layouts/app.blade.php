<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="dim" class="bg-base-200">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'My Articles') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Bootstrap JS for dropdown -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body class="bg-base-200">
    <div id="app">
        <nav class="navbar bg-base-100 shadow-sm">
            <div class="navbar-start">
                <a class="btn btn-ghost text-xl" href="{{ url('/') }}">
                    {{ config('app.name', 'My Articles') }}
                </a>
            </div>
            <div class="navbar-center">
                <!-- Theme Switcher using DaisyUI Dropdown -->
                <div class="dropdown dropdown-end">
                    <div tabindex="0" role="button" id="theme-switcher" class="btn btn-ghost m-1 gap-2">
                        <!-- Palette Icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01" />
                        </svg>
                        <span id="current-theme">Theme</span>
                        <!-- Dropdown Arrow -->
                        <svg
                            width="12px"
                            height="12px"
                            class="inline-block h-2 w-2 fill-current opacity-60"
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 2048 2048">
                            <path d="M1799 349l242 241-1017 1017L7 590l242-241 775 775 775-775z"></path>
                        </svg>
                    </div>
                    
                    <!-- Theme Dropdown using DaisyUI -->
                    <ul tabindex="-1" id="theme-dropdown" class="dropdown-content bg-base-300 rounded-box z-1 w-52 p-2 shadow-2xl">
                        <!-- Theme items will be populated by JavaScript -->
                    </ul>
                </div>
            </div>
            <div class="navbar-end gap-2">

                <!-- Authentication Links -->
                @auth
                    <button id="navbarDropdown" class="" href="#" role="button" popovertarget="popover-1"
                        style="anchor-name:--anchor-1">
                        {{ Auth::user()->name }}
                    </button>
                    <ul class="dropdown menu w-52 rounded-box bg-base-100 shadow-sm" popover id="popover-1"
                        style="position-anchor:--anchor-1">
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                @endauth
                <div class="dropdown dropdown-buttom dropdown-end">
                    <div tabindex="0" role="button" class="btn btn-ghost btn-circle">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h7" />
                        </svg>
                    </div>
                    <ul tabindex="-1"
                        class="menu menu-sm dropdown-content bg-base-100 rounded-box z-1 mt-3 w-52 p-2 shadow">
                        <li>
                            @auth
                                <a href="/articles/add">Add Article</a>
                            @endauth
                        </li>
                        @guest
                            <li>
                                @if (Route::has('login'))
                                    <a href="{{ route('login') }}">{{ __('Login') }}</a>
                                @endif
                            </li>
                            <li>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}">{{ __('Register') }}</a>
                                @endif
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main>
            @yield('content')
        </main>
    </div>
</body>

</html>
