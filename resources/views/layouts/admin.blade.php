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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">


    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

</head>

<body>
    <div id="app">
        <!-- ヘッダーナビ -->
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <button class="navbar-toggler mx-3" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="{{ url('/') }}" style="display: flex; align-items: center; padding: 0;">
                <img src="{{ asset('images/logo2.png') }}" alt="{{ config('app.name', 'Laravel') }}"
                    style="max-height: 50px; margin: 0;">
            </a>
            <ul class="navbar-nav ms-auto">
                @if (Auth::guard('admin')->check())
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::guard('admin')->user()->name }}
                        </a>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('admin.logout') }}"
                                onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                {{ __('admin_Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.login') }}">{{ __('admin_Login') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.register') }}">{{ __('admin_Register') }}</a>
                    </li>
                @endif
            </ul>
        </nav>
    </div>

    @auth('admin')
        <!-- サイドバー -->
        <div class="d-flex" style="min-height: 100vh;">
            <nav class="sidebar navbar navbar-expand-md navbar-light shadow-sm flex-column"
                style="height: 90vh; position: sticky; top: 0;">
                <div class="container">
                    <!-- サイドバーの内容 -->
                    <div class="collapse navbar-collapse show" id="navbarSupportedContent">
                        <ul class="navbar-nav flex-column list-group list-group-flush">
                            @if (Auth::guard('admin')->check())
                                <li class="nav-item list-group-item">
                                    <div class="list-group">
                                        <a class="nav-link"
                                            href="{{ route('admin.items.index') }}">{{ __('item_list') }}</a>
                                    </div>
                                </li>
                                <li class="nav-item list-group-item">
                                    <a class="nav-link" href="{{ route('admin.items.create') }}">{{ __('new_item') }}</a>
                                </li>
                                <li class="nav-item list-group-item">
                                    <a class="nav-link"
                                        href="{{ route('admin.orders.index') }}">{{ __('order_Management') }}</a>
                                </li>
                                <li class="nav-item list-group-item">
                                    <a class="nav-link"
                                        href="{{ route('admin.users.index') }}">{{ __('user_Management') }}</a>
                                </li>
                                <li class="nav-item list-group-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::guard('admin')->user()->name }}
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('admin.logout') }}"
                                            onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                            {{ __('admin_Logout') }}
                                        </a>
                                        <form id="logout-form" action="{{ route('admin.logout') }}" method="POST"
                                            class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @else
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('admin.login') }}">{{ __('admin_Login') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link"
                                        href="{{ route('admin.register') }}">{{ __('admin_Register') }}</a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </nav>
        @endauth
        {{-- <main class="py-4 container"> --}}
        <main class="py-4 container">
            <div class="content p-4" style="flex-grow: 1;">
                @yield('content')
            </div>
        </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
</body>

</html>
<style>
    li:hover {
        background-color: #f0f0f0;
    }
</style>
