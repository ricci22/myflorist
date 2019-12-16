<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'OnlineFlorist') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

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
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    @if (\Illuminate\Support\Facades\Auth::check())
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item m-auto">
                                <a class="nav-link" href="/profile">Profile</a>
                            </li>
                            @if(\Illuminate\Support\Facades\Auth::id() == 1)
                            <li class="nav-item dropdown active">
                                <a class="nav-link dropdown-toggle" role="button" data-toggle="dropdown" style="cursor: pointer">
                                    Admin Menu
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="/users">Manage Users</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="/flower_types">Manage Flower Types</a>
                                    <a class="dropdown-item" href="/flowers">Manage Flowers</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="/couriers">Manage Couriers</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="/transactions">Transaction History</a>
                                </div>
                            </li>
                            @endif
                        </ul>
                    @endif

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Live Clock -->
                        <li class="nav-item m-auto">
                            @include('inc.clock')
                        </li>

                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="/carts">Cart</a>
                                    <a class="dropdown-item" href="/order">Order History</a>

                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        @include('inc.message')
        <div class="container">
            <main class="py-4">
                <section class="text-center text-primary">
                    <h1>@yield('title')</h1>
                    @yield('callToActionBtn')
                </section>
                <hr>
                @yield('content')
                <hr>
            </main>
        </div>

    </div>
</body>
</html>
