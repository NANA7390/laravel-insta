<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
{{-- config is about .env file の１でタグの名前変更 --}}
    <title>{{ config('app.name') }} | @yield('title')</title> 

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    {{-- fontawesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    {{-- <!-- Scripts -->custom css --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    {{-- vite --}}
    {{-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) --}}


<link rel="stylesheet" href="{{ asset('app-DWpGJWH7.css') }}">
<script src="{{ asset('js/app-CdQXwo7F.js') }}"></script>

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                          {{-- @auth means if the user is logged in --}}
                        @auth
                        @if(!request()->is('admin/*'))
                        <form action="{{ route('home') }}" method="get">
                            <input type="text" name="search" class="form-control form-control-sm" placeholder="Search...">
                        </form>
                        @endif
                        @endauth

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>

                                </li>
                            @endif
                        @else
                        {{-- home --}}
                        <li class="nav-item">
                            <a href="{{route('home')}}"class="nav-link">
                                <i class="fa-solid fa-house text-dark icon-sm"></i>
                            </a>
                        </li>
                            

                        {{-- create post --}}
                        <li class="nav-item">
                            <a href="{{route('post.create')}}"class="nav-link">
                                <i class="fa-solid fa-circle-plus text-dark icon-sm"></i>
                            </a>
                        </li>

                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link btn" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                  {{-- dropdown --}}
                                  @if(Auth::user()->avatar)
                                  <img src="{{ Auth::user()->avatar }}" alt="" class="image-sm rounded-circle">
                                  @else
                                  <i class="fa-solid fa-circle-user text-dark icon-sm"></i>
                                  @endif
                                  {{-- user name --}}
                                </a>
                                  
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    @can('admin')
                                    {{-- ADIMIN --}}
                                    <a href="{{ route('admin.user') }}" class="dropdown-item">
                                        <i class="fa-solid fa-user-gear"></i>Admin
                                    </a>
                                    <hr class="dropdown-divider">
                                    @endcan



                                  {{-- Profile --}}
                                    <a href="{{ route('profile.show', Auth::user()->id) }}" class="dropdown-item">
                                        <i class="fa-solid fa-circle-user"></i>Profile
                                    </a>

                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        
                                        <i class="fa-solid fa-right-from-bracket"></i>{{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            <div class="container">
                <div class="row justify-content-center">
                    {{-- ADMIN --}}
                    @if(request()->is('admin*'))
                        <div class="col-3">
                            <div class="list-group">
                                <a href="{{ route('admin.user') }}" class="list-group-item {{request()->is('admin/users*') ? 'active' : ''}}"><i class="fa-solid fa-users"></i> users
                                </a>
                                <a href="{{ route('admin.post') }}" class="list-group-item {{request()->is('admin/posts*') ? 'active' : ''}}"><i class="fa-solid fa-newspaper"></i> Posts
                                </a>
                                <a href="{{ route('admin.categories') }}" class="list-group-item {{request()->is('admin/categories*') ? 'active' : ''}}"><i class="fa-solid fa-tags"></i> Categories
                                </a>
                            </div>
                        </div>
                    @endif

                    <div class="col-9">
                       @yield('content')
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
