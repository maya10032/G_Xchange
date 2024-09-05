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
        .navbar-expand-md {
            font-family: 'Caveat', cursive;
            font-size: 18px;
            background-color: #D2B48C !important;

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
                    <ul class="navbar-nav ms-auto">
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="/"><i class="fa fa-wpforms"></i> {{ __('item_list') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/contact"><i class="fa fa-envelope-o"></i> {{ __('contact') }}</a>
                            </li>
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">
                                        <i class="fa fa-sign-in me-1"></i>{{ __('Login') }}</a>
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
                                <a class="nav-link" href="/"><i class="fa fa-wpforms"></i> {{ __('item_list') }}</a>
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
            <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
        <div class="container" style="width: 50%;">
            <form class="d-flex mt-3" role="search">
                <input class="form-control me-2 border-success" type="search" placeholder="商品名、カテゴリ、ブランドなど"
                    aria-label="Search">
                <button class="btn btn-outline-success" style="width: 80px;"
                    type="submit">{{ __('search') }}</button>
            </form>
        </div>
        <main>
            @yield('content')
        </main>
    </div>

    <footer class=" bg-white shadow-sm  expand-mdz text-gray-600 mt-auto  text-center">
        <div class=" container flex flex-wrap md:pl-20 -mb-10 md:mt-10 mt-10 md:text-left text-center ">
            <div class="row py-4 p-5">
                @guest
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
                    @if (Route::has('login'))
                        <div class="col-3">
                            <p class="title-font font-medium text-gray-600 tracking-widest text-sm mb-3">
                                <a class="nav-link" href="{{ route('login') }}"> {{ __('Login') }} > </a>
                            </p>
                        </div>
                    @endif
                    @if (Route::has('register'))
                        <div class="col-3">
                            <p class="title-font font-medium text-gray-600 tracking-widest text-sm mb-3">
                                <a class="nav-link" href="register"> {{ __('Register') }} > </a>
                            </p>
                        </div>
                    @endif
                @else
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
                @endguest
            </div>
        </div>
        <div class="bg-black py-3">
            <p class="text-white text-center">© 2024 {{ config('app.name', 'Laravel') }}.inc</p>
        </div>
    </footer>
</body>

</html>
