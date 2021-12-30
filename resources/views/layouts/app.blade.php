
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'DVD Shop') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.5.16/dist/vue.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://unpkg.com/vue-toasted"></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                   <span class="navbar-brand"> {{ config('app.name', 'DVD Shop') }} </span>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

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
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
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
            @if (Auth::user())
            <div class="sidebar" style="float: left">
                <ul class="nav flex-column">
                    <li class="side-menus {{ Request::is('*') ? 'active' : '' }}">
                        @if(Auth::user()->hasRole('Administrador'))
                        <a class="nav-link" href="/home">
                            <i class="fas fa-building"></i><span>Dashboard</span>
                        </a>
                        @can('ver-user')
                        <a class="nav-link" href="/users">
                            <i class="fas fa-building"></i><span>Usuarios</span>
                        </a>
                        @endcan
                        @can('ver-rol')
                        <a class="nav-link" href="/roles">
                            <i class="fas fa-building"></i><span>Roles</span>
                        </a>
                        @endcan
                        @can('ver-film')
                        <a class="nav-link" href="/films">
                            <i class="fas fa-building"></i><span>Peliculas</span>
                        </a>
                        @endcan
                            <a class="nav-link" href="/sales-list">
                                <i class="fas fa-building"></i><span>Listado Ventas</span>
                            </a>
                            <a class="nav-link" href="/sales-rent-list">
                                <i class="fas fa-building"></i><span>Listado Devoluciones</span>
                            </a>
                        @endif
                        @if(Auth::user()->hasRole('Cliente'))
                        <a class="nav-link" href="/available">
                            <i class="fas fa-building"></i><span>Peliculas Disponibles</span>
                        </a>
                        <a class="nav-link" href="/rented-films">
                            <i class="fas fa-building"></i><span>Tus peliculas</span>
                        </a>
                            @endif
                    </li>
                </ul>
            </div>
            @endif
            <div class="container">
                @yield('content')
            </div>
        </main>
    </div>
</body>
</html>
