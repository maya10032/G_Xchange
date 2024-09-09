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


        .box {
            width: 100%;
            height: 2000px;
            /* background: linear-gradient(90deg, rgba(168, 202, 240, 1), rgba(233, 240, 250, 1)); */
            position: absolute;
            top: 0;
            left: 0;
            z-index: -2;
        }

        .box div {
            height: 120px;
            width: 120px;
            position: absolute;
            top: 8%;
            left: 8%;
            animation: animate 5s linear infinite;
            background: transparent;
            border: solid 3px #FF0000;
            z-index: 999999;
        }

        .box div:nth-child(1) {
            top: 18%;
            left: 18%;
            animation: animate 10s linear infinite;
        }

        .box div:nth-child(2) {
            top: 27%;
            left: 87%;
            animation: animate 10s linear infinite;
        }

        .box div:nth-child(3) {
            top: 80%;
            left: 90%;
            animation: animate 5s linear infinite;
        }

        .box div:nth-child(4) {
            top: 60%;
            left: 70%;
            animation: animate 9s linear infinite;
        }

        .box div:nth-child(5) {
            top: 88%;
            left: 12%;
            animation: animate 9s linear infinite;
        }

        .box div:nth-child(6) {
            top: 70%;
            left: 33%;
            animation: animate 8s linear infinite;
        }

        .box div:nth-child(7) {
            top: 33%;
            left: 66%;
            animation: animate 2s linear infinite;
        }

        .box div:nth-child(8) {
            top: 70%;
            left: 60%;
            animation: animate 16s linear infinite;
        }

        .box div:nth-child(9) {
            top: 26%;
            left: 53%;
            animation: animate 7s linear infinite;
        }

        .box div:nth-child(10) {
            top: 45%;
            left: 15%;
            animation: animate 12s linear infinite;
        }
        .box div:nth-child(11) {
            top: 45%;
            left: 15%;
            animation: animate 12s linear infinite;
        }
        .box div:nth-child(12) {
            top: 25%;
            left: 15%;
            animation: animate 3s linear infinite;
        }
        .box div:nth-child(13) {
            top: 80%;
            left: 15%;
            animation: animate 9s linear infinite;
        }


        @keyframes animate {
            0% {
                transform: scale(0) translateY(0) rotate(0);
                opacity: 1;
            }

            100% {
                transform: scale(1.5) translateY(-90px) rotate(360deg);
                opacity: 0;
            }
        }
    </style>
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm" style="padding: 0;">
            <div class="container">
                <a class="navbar-brand fuwafuwa" href="{{ url('/') }}"
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
                                    <small>goods</small>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/contact"><i class="fa fa-envelope"></i> {{ __('contact') }}
                                    <small>contact</small>
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
                                <a class="nav-link" href="/"><i class="fa fa-wpforms"></i> {{ __('item_list') }}
                                    <small>goods</small>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/contact"><i class="fa fa-envelope"></i>
                                    {{ __('contact') }}
                                    <small>contact</small>
                                </a>
                            </li>
                            <li class="nav-item success-list">
                                <a class="nav-link success-icon" href="{{ route('carts.index') }}">
                                    <i class="fa fa-shopping-cart"></i>
                                    {{ __('cart') }}
                                    @if ($cartCount > 0)
                                        <span class="badge bg-danger rounded-pill"
                                            style="vertical-align: top">{{ $cartCount }}</span>
                                    @endif
                                    <small>cart</small>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('likes.index') }}"><i class="fa fa-heart"></i>
                                    {{ __('like') }}
                                    @if (isset($likeCount) && $likeCount > 0)
                                        <span class="badge bg-danger rounded-pill"
                                            style="vertical-align: top">{{ $likeCount }}</span>
                                    @endif
                                    <small>favorites</small>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('orders.index') }}"><i class="fa fa-user-circle"></i>
                                    {{ __('マイページ') }}
                                    <small>My Page</small>
                                </a>
                            </li>

                        </ul>
                    </div>
                </div>
                <ul class="user-aicon me-auto header-nav-custom cactus-classical-serif-regular">
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="dropdown-toggle user-link" href="#" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <i class="fa fa-user" aria-hidden="true"></i>
                            {{ Auth::user()->name }}
                        </a>
                        <div class="dropdown-menu dropdown-menu-end ms-auto" aria-labelledby="navbarDropdown">
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
            @endguest
        </nav>
        <div id="myCarousel" class="carousel slide mb-1 py-1" data-bs-ride="carousel" data-bs-theme="light"
            style="height: 280px;">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active"
                    aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1"
                    aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2"
                    aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="d-flex">
                        <div class="carousel-item-box">
                            <img src="{{ asset('images/banner_child.jpg') }}" class="d-block content-hover"
                                alt="Sample Image">
                        </div>
                        <div class="carousel-item-box">
                            <img src="{{ asset('images/sale1.jpg') }}" class="d-block content-hover"
                                alt="Sample Image">
                        </div>
                        <div class="carousel-item-box">
                            <img src="{{ asset('images/banner_click.jpg') }}" class="d-block content-hover"
                                alt="Sample Image">
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="d-flex">
                        <div class="carousel-item-box">
                            <img src="{{ asset('images/sale2.jpg') }}" class="d-block content-hover"
                                alt="Sample Image">
                        </div>
                        <div class="carousel-item-box">
                            <img src="{{ asset('images/2835419.jpg') }}" class="d-block content-hover"
                                alt="Sample Image">
                        </div>
                        <div class="carousel-item-box">
                            <img src="{{ asset('images/mock1.jpg') }}" class="d-block content-hover"
                                alt="Sample Image">
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="d-flex">
                        <div class="carousel-item-box">
                            <img src="{{ asset('images/recycle-background.jpg') }}" class="d-block content-hover"
                                alt="Sample Image">
                        </div>
                        <div class="carousel-item-box">
                            <img src="{{ asset('images/recycling.jpg') }}" class="d-block content-hover"
                                alt="Sample Image">
                        </div>
                        <div class="carousel-item-box">
                            <img src="{{ asset('images/47900.jpg') }}" class="d-block content-hover"
                                alt="Sample Image">
                        </div>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

        <main>
            <div class="box">
                <div>
                </div>
                <div>
                </div>
                <div>
                </div>
                <div>
                </div>
                <div>
                </div>
                <div>
                </div>
                <div>
                </div>
                <div>
                </div>
                <div>
                </div>
                <div>
                </div>
                <div>
                </div>
                <div>
                </div>
            </div>
            @yield('content')
        </main>

        <div id="sec">
            <ul>
                <li>
                    <img src="{{ asset('images/5902585.jpg') }}" style="object-fit: cover;" width="340px"
                        height="400px" alt="Sample Image">
                </li>
                <li>
                    <img src="{{ asset('images/4952087.jpg') }}" style="object-fit: cover;" width="340px"
                        height="400px" alt="Sample Image">
                </li>
                <li>
                    <img src="{{ asset('images/10595359.jpg') }}" style="object-fit: cover;" width="340px"
                        height="400px" alt="Sample Image">
                </li>
                <li>
                    <img src="{{ asset('images/close-up.jpg') }}" style="object-fit: cover;" width="340px"
                        height="400px" alt="Sample Image">
                </li>
            </ul>
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
    </div>
</body>

</html>
