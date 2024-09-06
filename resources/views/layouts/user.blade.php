<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style>
        .nav-pills-custom {
            display: flex;
            justify-content: space-between;
            padding: 0;
        }

        .nav-pills-custom .nav-item {
            flex: 1;
        }

        .nav-pills-custom .nav-link {
            text-align: center;
            padding: 10px 0;
        }

        .nav-pills-custom .nav-link {
            border: none;
            border-radius: 0;
            padding: 10px 15px;
            text-decoration: none;
        }

        .nav-link.active {
            background-color: #CC6633 !important;
            color: white !important;
        }
    </style>
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}"
                    style="display: flex; align-items: center; padding: 0;">
                    <img src="{{ asset('images/logo2.png') }}" alt="{{ config('app.name', 'Laravel') }}"
                        style="max-height: 50px; margin: 0;">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        <li class="nav-item">
                            <a class="nav-link" href="/"><i class="fa fa-wpforms"></i>
                                {{ __('item_list') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/contact"><i class="fa fa-envelope-o"></i>
                                {{ __('contact') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('carts.index') }}"><i class="fa fa-shopping-cart"></i>
                                {{ __('cart') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('orders.index') }}"><i class="fa fa-history"></i>
                                {{ __('order') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('likes.index') }}"><i class="fa fa-heart-o"></i>
                                {{ __('like') }}</a>
                        </li>
                    </ul>
                </div>
            </div>
            <ul class="navbar-nav me-auto">
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }}
                    </a>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                            {{ __('ja.Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
        </nav>

        <nav class="py-1 container">
            <ul class="nav nav-pills nav-pills-custom py-2 mb-2">
                <li class="nav-item border">
                    <a class="nav-link link-dark link-offset-2 {{ request()->routeIs('orders.index', 'orders.show') ? 'active' : '' }}"
                        href="{{ route('orders.index') }}">{{ __('order') }}</a>
                </li>
                <li class="nav-item border">
                    <a class="nav-link link-dark link-offset-2 {{ request()->routeIs('carts.index') ? 'active' : '' }}"
                        href="{{ route('carts.index') }}">{{ __('cart') }}</a>
                </li>
                <li class="nav-item border">
                    <a class="nav-link link-dark link-offset-2 {{ request()->routeIs('likes.index') ? 'active' : '' }}"
                        href="{{ route('likes.index') }}">{{ __('like') }}</a>
                </li>
                <li class="nav-item border">
                    <a class="nav-link link-dark link-offset-2 {{ request()->routeIs('profile.edit') ? 'active' : '' }}"
                        href="{{ route('profile.edit') }}">{{ __('profile') }}</a>
                </li>
                <li class="nav-item border">
                    <a class="nav-link link-dark link-offset-2"
                        href="{{ route('users.index') }}">{{ __('withdrawal') }}</a>
                </li>
            </ul>
        </nav>
        <main class="py-1 container sticky-top" style="min-height: calc(100vh - 100px);">
            @yield('content')

        </main>
    </div>

    <footer class=" bg-white shadow-sm  expand-mdz text-gray-600 mt-auto  text-center">
        <div class=" container flex flex-wrap md:pl-20 -mb-10 md:mt-10 mt-10 md:text-left text-center ">
            <div class="row py-4 p-5">
                <div class="col-3">
                    <p class="title-font font-medium text-gray-600 tracking-widest text-sm mb-3">
                        <a class="nav-link" href="{{ route('items.index') }}"> {{ __('item_list') }} > </a>
                    </p>
                </div>
                <div class="col-3">
                    <p class="title-font font-medium text-gray-600 tracking-widest text-sm mb-3">
                        <a class="nav-link" href="{{ route('contact.show') }}"> {{ __('contact') }} > </a>
                    </p>
                </div>
                <div class="col-3">
                    <p class="title-font font-medium text-gray-600 tracking-widest text-sm mb-3">
                        <a class="nav-link" href="{{ route('login') }}"> {{ __('Login') }} > </a>
                    </p>
                </div>
                <div class="col-3">
                    <p class="title-font font-medium text-gray-600 tracking-widest text-sm mb-3">
                        <a class="nav-link" href="{{ route('register') }}"> {{ __('Register') }} > </a>
                    </p>
                </div>
            </div>
        </div>
        <div class="bg-black py-3">
            <p class="text-white text-center">© 2024 {{ config('app.name', 'Laravel') }}.inc</p>
        </div>
    </footer>
</body>

</html>
