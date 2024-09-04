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
    <link href="https://fonts.googleapis.com/css2?family=M+PLUS+1p:wght@100;300;400;500;700;800;900&display=swap"
        rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">


    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

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
                        {{-- @endguest --}}
                    </ul>
                </div>
            </div>
        </nav>

        {{-- <main class="py-1 container sticky-top" style="min-height: calc(100vh - 100px);"> --}}
        <div class="mx-auto" style="width: 600px;">
            <ul class="nav nav-pills nav-justified py-5">
                <span class="border border-1 m-2">
                    <li class="nav-item px-3">
                        <a class="nav-link link-dark link-offset-2"
                            href="{{ route('orders.index') }}">{{ __('order') }}</a>
                    </li>
                </span>
                <span class="border border-1 m-2">
                    <li class="nav-item px-3">
                        <a class="nav-link link-dark link-offset-2"
                            href="{{ route('likes.index') }}">{{ __('like') }}</a>
                    </li>
                </span>
                <span class="border border-1 m-2">
                    <li class="nav-item px-3">
                        <a class="nav-link link-dark link-offset-2"
                            href="{{ route('profile.edit') }}">{{ __('profile') }}</a>
                    </li>
                </span>
                <span class="border border-1 m-2">
                    <li class="nav-item px-3">
                        <a class="nav-link link-dark link-offset-2"
                            href="{{ route('users.index') }}">{{ __('withdrawal') }}</a>
                    </li>
                </span>
            </ul>
        </div>
        <main>
            @yield('content')
        </main>
    </div>

    <footer class=" bg-white shadow-sm expand-mdz text-gray-600 mt-auto  text-center">
        <div class=" container flex flex-wrap md:pl-20 -mb-10 md:mt-10 mt-10 md:text-left text-center ">
            <div class="row py-4 p-5 .justify-content-center">
                <div class="col-2">
                    <p class="title-font font-medium text-gray-600 tracking-widest text-sm mb-3">
                        <a class="nav-link" href="{{ route('items.index') }}"> {{ __('item_list') }} > </a>
                    </p>
                </div>
                <div class="col-2">
                    <p class="title-font font-medium text-gray-600 tracking-widest text-sm mb-3">
                        <a class="nav-link" href="{{ route('orders.index') }}"> {{ __('order') }} > </a>
                    </p>
                </div>
                <div class="col-2">
                    <p class="title-font font-medium text-gray-600 tracking-widest text-sm mb-3">
                        <a class="nav-link" href="{{ route('likes.index') }}"> {{ __('like') }} > </a>
                    </p>
                </div>
                <div class="col-2">
                    <p class="title-font font-medium text-gray-600 tracking-widest text-sm mb-3">
                        <a class="nav-link" href="{{ route('profile.edit') }}"> {{ __('profile') }} > </a>
                    </p>
                </div>
                <div class="col-2">
                    <p class="title-font font-medium text-gray-600 tracking-widest text-sm mb-3">
                        <a class="nav-link" href="{{ route('contact.show') }}"> {{ __('contact') }} > </a>
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
<style>
    span:hover {
        background-color: #f0f0f0;
    }
</style>
