<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    {{-- Icons --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

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
                    <ul class="navbar-nav me-auto">
                    </ul>
                    <ul class="navbar-nav ms-auto">
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="/"><i class="fa fa-wpforms"></i> {{ __('item_list') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('contact.show') }}"><i class="fa fa-envelope-o"></i>
                                    {{ __('contact') }}</a>
                            </li>
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">
                                        <i class="fa fa-sign-in me-1"></i> {{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">
                                        <i class="fa fa-user-plus me-1"></i>{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
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
                                    <i class="fa fa-user-circle me-1"></i>{{ Auth::user()->name }}
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
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        {{-- <main class="py-1 container sticky-top" style="min-height: calc(100vh - 100px);"> --}}
        <main>
            @yield('content')
        </main>
    </div>
    <footer class="footer-policy shadow-sm  expand-mdz text-gray-600 mt-auto text-center" style="height: 150px;">
        <div class="container" style="width: 1200px;">
            <div class="d-flex justify-content-between">
                <div class="d-flex text-body-secondary mb-">
                    <div class="me-1 text-white text-center py-3">
                        <a href="{{ url('/company/companyprofile') }}" class="text-white hover-effect">会社概要</a>
                    </div>
                </div>
                <div class="d-flex text-body-secondary mb-2">
                    <div class="me-1 text-white text-center py-3">
                        <a href="" class="text-white hover-effect">採用情報</a>
                    </div>
                </div>
                <div class="d-flex text-body-secondary mb-2">
                    <div class="me-1 text-white text-center py-3">
                        <a href="" class="text-white hover-effect">利用規約</a>
                    </div>
                </div>
                <div class="d-flex text-body-secondary mb-2">
                    <div class="me-1 text-white text-center py-3">
                        <a href="" class="text-white hover-effect">プライバシー規約</a>
                    </div>
                </div>
                <div class="d-flex text-body-secondary mb-2">
                    <div class="me-1 text-white text-center py-3">
                        <a href="" class="text-white hover-effect">特定商取引法に基づく表示</a>
                    </div>
                </div>
                <div class="d-flex text-body-secondary mb-2">
                    <div class="me-1 text-white text-center py-3">
                        <a href="" class="text-white hover-effect">資金決済法に基づく表示</a>
                    </div>
                </div>
                <div class="d-flex text-body-secondary mb-2">
                    <div class="me-1 text-white text-center py-3">
                        <a href="" class="text-white hover-effect">法令順守と犯罪抑止のために</a>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <p class="text-white text-center">© 2024 {{ config('app.name', 'Laravel') }}.inc</p>
        </div>
    </footer>
</body>

</html>
