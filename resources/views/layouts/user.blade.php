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
    <link href="https://fonts.googleapis.com/css2?family=M+PLUS+1p:wght@100;300;400;500;700;800;900&display=swap"
        rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style>
        .navbar {
            position: relative;
            z-index: 10;
        }

        .navbar-brand img {
            max-height: 100%;
            width: auto;
            margin: 0;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm" style="padding: 0;">
            <div class="container">
                <a class="navbar-brand fuwafuwa2" href="{{ url('/') }}"
                    style="display: flex; align-items: center; padding: 0;">
                    <img src="{{ asset('images/logo2.png') }}" alt="{{ config('app.name', 'Laravel') }}">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse cactus-classical-serif-regular" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto header-nav-custom">
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="/"><i class="fa fa-wpforms"></i> {{ __('item_list') }}
                                    <small>Goods</small>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/contact"><i class="fa fa-envelope"></i> {{ __('contact') }}
                                    <small>Contact</small>
                                </a>
                            </li>
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">
                                        <i class="fa fa-sign-in me-1"></i>{{ __('Login') }}
                                        <small>Login</small>
                                    </a>
                                </li>
                            @endif
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">
                                        <i class="fa fa-user-plus me-1"></i>{{ __('Register') }}
                                        <small>sign up</small>
                                    </a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="/"><i class="fa fa-wpforms"></i>
                                    {{ __('item_list') }}
                                    <small>Goods</small>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/contact"><i class="fa fa-envelope"></i>
                                    {{ __('contact') }}
                                    <small>Contact</small>
                                </a>
                            </li>
                            <li class="nav-item success-list">
                                <a class="nav-link success-icon" href="{{ route('carts.index') }}">
                                    <i class="fa fa-shopping-cart fa-lg"></i>
                                    {{ __('cart') }}
                                    @if ($cartCount > 0)
                                        <span class="badge bg-danger rounded-pill"
                                            style="vertical-align: top">{{ $cartCount }}</span>
                                    @endif
                                    <small>Cart</small>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('likes.index') }}"><i class="fa fa-heart"></i>
                                    {{ __('like') }}
                                    @if (isset($likeCount) && $likeCount > 0)
                                        <span class="badge bg-danger rounded-pill"
                                            style="vertical-align: top">{{ $likeCount }}</span>
                                    @endif
                                    <small>Favorites</small>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('orders.index') }}"><i class="fa fa-user-circle"></i>
                                    {{ __('マイページ') }}
                                    <small>My Page</small>
                                </a>
                            </li>
                            <ul class="user-aicon me-auto header-nav-custom cactus-classical-serif-regular"
                                style="align-items: center; padding-left: 5px;;">
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="dropdown-toggle user-link" href="#" role="button"
                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        <i class="fa fa-user" aria-hidden="true"></i>
                                        {{ Auth::user()->name }}さん
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end ms-auto" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                            {{ __('ja.Logout') }}
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            </ul>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <nav class="py-1 container">
            <ul class="nav nav-pills-custom py-2 mb-2">
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
        <main>
            @yield('content')
        </main>
    </div>

    <footer class="footer-policy shadow-sm  expand-mdz text-gray-600 mt-auto text-center" style="height: 180px;">
        <div id="navBackToTop">
            <a href="#top" class="navFooterBackToTopText text-light hover-effect"
                style="text-decoration: none;">トップへ戻る</a>
        </div>
        <div class="container" style="width: 100%;">
            <div class="d-flex justify-content-between">
                <div class="d-flex text-body-secondary mb-">
                    <div class="me-1 text-white text-center py-3">
                        <a href="{{ url('/company/companyprofile') }}" class="text-white hover-effect">会社概要</a>
                    </div>
                </div>
                <div class="d-flex text-body-secondary mb-2">
                    <div class="me-1 text-white text-center py-3">
                        <a href="{{ url('/company/recruit') }}" class="text-white hover-effect">採用情報</a>
                    </div>
                </div>
                <div class="d-flex text-body-secondary mb-2">
                    <div class="me-1 text-white text-center py-3">
                        <a href="{{ url('/company/service') }}" class="text-white hover-effect">利用規約</a>
                    </div>
                </div>
                <div class="d-flex text-body-secondary mb-2">
                    <div class="me-1 text-white text-center py-3">
                        <a href="{{ url('/company/privacy') }}" class="text-white hover-effect">プライバシー規約</a>
                    </div>
                </div>
                <div class="d-flex text-body-secondary mb-2">
                    <div class="me-1 text-white text-center py-3">
                        <a href="{{ url('/company/transaction') }}" class="text-white hover-effect">特定商取引法に基づく表示</a>
                    </div>
                </div>
                <div class="d-flex text-body-secondary mb-2">
                    <div class="me-1 text-white text-center py-3">
                        <a href="{{ url('/company/funding') }}" class="text-white hover-effect">資金決済法に基づく表示</a>
                    </div>
                </div>
                <div class="d-flex text-body-secondary mb-2">
                    <div class="me-1 text-white text-center py-3">
                        <a href="{{ url('/company/law') }}" class="text-white hover-effect">法令順守と犯罪抑止のために</a>
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
