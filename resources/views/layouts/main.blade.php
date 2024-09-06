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
        /* .gradation { */
        /* background-image: url(images/aki_sale.jpg);
            background-repeat: no-repeat; */
        /* background-size: contain; */
        /* background: linear-gradient(#000000 80%, #ffffff 100%); */
        /* } */

        /* body {
            background: linear-gradient(#5a6268, 10%, #ffffff);
        } */
    </style>

</head>

<body>
    <div id="app">
        <div class="gradation">
            <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm" style="padding: 0;">
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
                                        <span class="badge bg-danger rounded-pill" style="vertical-align: top">14</span>
                                        <small>cart</small>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('orders.index') }}"><i class="fa fa-history"></i>
                                        {{ __('order') }}
                                        <small>history</small>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('likes.index') }}"><i class="fa fa-heart"></i>
                                        {{ __('like') }}
                                        <span class="badge bg-danger rounded-pill" style="vertical-align: top">14</span>
                                        <small>favorite</small>
                                    </a>
                                </li>

                            </ul>
                        </div>
                    </div>
                    <ul class="user-aicon me-auto header-nav-custom">
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
            <div id="myCarousel" class="carousel slide mb-6" data-bs-ride="carousel" data-bs-theme="light">
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
                        <img src="{{ asset('images/aki_sale.jpg') }}" class="bd-placeholder-img card-img-top"
                            style="object-fit: cover;" width="100%" height="400px" alt="Sample Image">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('images/recycling.jpg') }}" class="bd-placeholder-img card-img-top"
                            style="object-fit: cover;" width="100%" height="400px" alt="Sample Image">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('images/green.jpg') }}" class="bd-placeholder-img card-img-top"
                            style="object-fit: cover;" width="100%" height="400px" alt="Sample Image">
                        <div class="container">
                            <div class="carousel-caption text-start">
                                <h1><strong>リサイクル素材で作られた商品を選ぶことは、<br>地球の未来を守る選択です。</strong></h1>
                                <p><strong>これらの商品は、日常生活に取り入れやすく、環境への負荷を減らすことができます。<br>ぜひ、リサイクル素材を使用したエコアイテムで、おしゃれと地球への配慮を両立させましょう！</strong>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#myCarousel"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>

        </div>
        <main class="py-2">
            @yield('content')
        </main>

        <div id="sec">
            <ul>
                <li>
                    <img src="{{ asset('images/banner_child.jpg') }}" style="object-fit: cover;" width="320px"
                        height="150px" alt="Sample Image">
                </li>
                <li>
                    <img src="{{ asset('images/banner_sale.jpg') }}" style="object-fit: cover;" width="320px"
                        height="150px" alt="Sample Image">
                </li>
                <li>
                    <img src="{{ asset('images/banner_click.jpg') }}" style="object-fit: cover;" width="320px"
                        height="150px" alt="Sample Image">
                </li>
                <li>
                    <img src="{{ asset('images/creen.jpg') }}" style="object-fit: cover;" width="320px"
                        height="150px" alt="Sample Image">
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
