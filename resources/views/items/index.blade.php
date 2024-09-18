@extends('layouts.main')

@section('title', '商品一覧')

@section('content')
    <nav class="subheader navbar navbar-expand-md shadow-sm" style="padding: 0;">
        <div class="container">
            <div class="collapse navbar-collapse cactus-classical-serif-regular" id="">
                <ul class="navbar-nav d-flex align-items-center w-100">
                    <li class="nav-item mx-2">
                        <a class="nav-link" href="{{ url('/') }}">すべて</a>
                    </li>
                    @foreach ($categories as $category)
                        <li class="nav-item mx-2">
                            <a class="nav-link"
                                href="{{ route('items.filterCategory', $category->id) }}">{{ $category->category_name }}</a>
                        </li>
                    @endforeach
                    <li class="d-flex flex-grow-1">
                        <form class="d-flex w-100" role="search" method="GET" action="{{ route('items.search') }}"
                            style="max-width: 700px;">
                            <input class="form-control border-light" type="search" name="search"
                                placeholder="商品名、カテゴリ、ブランドなど" aria-label="Search" value="{{ old('search', $query ?? '') }}">
                            <button class="btn btn-danger" type="submit"><i class="fa fa-search" aria-hidden="true"></i>
                                {{ __('search') }}</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="wrapper">
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
        <div id="myCarousel" class="carousel slide pt-1" data-bs-ride="carousel" data-bs-theme="light">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active"
                    aria-current="true"></button>
                <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="d-flex">
                        <div class="carousel-item-box">
                            <img src="{{ asset('images/banner_child.jpg') }}" class="d-block content-hover"
                                alt="Sample Image">
                        </div>
                        <div class="carousel-item-box">
                            <img src="{{ asset('images/sale1.jpg') }}" class="d-block content-hover" alt="Sample Image">
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
                            <img src="{{ asset('images/sale2.jpg') }}" class="d-block content-hover" alt="Sample Image">
                        </div>
                        <div class="carousel-item-box">
                            <img src="{{ asset('images/2835419.jpg') }}" class="d-block content-hover" alt="Sample Image">
                        </div>
                        <div class="carousel-item-box">
                            <img src="{{ asset('images/mock1.jpg') }}" class="d-block content-hover" alt="Sample Image">
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
                            <img src="{{ asset('images/47900.jpg') }}" class="d-block content-hover" alt="Sample Image">
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
        <div class="py-2 container">
            <div class="d-flex">
                <h2 class="fw-bold title--border">商品一覧</h2>
                {{-- <div class="container" style="width: 50%;">
                    <form class="d-flex mt-3" role="search" method="GET" action="{{ route('items.search') }}">
                        <input class="form-control me-2 border-secondary" type="search" name="search"
                            placeholder="商品名、カテゴリ、ブランドなど" aria-label="Search" value="{{ old('search', $query ?? '') }}">
                        <button class="btn btn-secondary btn-secondary" style="width: 80px;" type="submit"><i
                                class="fa fa-search" aria-hidden="true"></i> {{ __('search') }}</button>
                    </form>
                </div> --}}
            </div>
            @if (isset($query))
                @if ($items->isEmpty())
                    <h3>検索結果: {{ $query }} に該当する商品はありませんでした。</h3>
                @else
                    <h3>検索結果: ”{{ $query }}”</h3>
                @endif
            @endif
            @if (isset($selectedCategory))
                @if ($items->isEmpty())
                    <h3>絞り込み結果: {{ $selectedCategory->category_name }} に該当する商品はありませんでした。</h3>
                @else
                    <h3>絞り込み結果: ”{{ $selectedCategory->category_name }}”</h3>
                @endif
            @endif
            <div class="row row-cols- row-cols-sm-2 row-cols-md-5 g-3 mb-4">
                @foreach ($items as $item)
                    <div class="col">
                        <div class="card shadow-sm hover-effect">
                            <img alt="ecommerce" class="object-cover object-center w-full h-full block"
                                src="{{ asset('storage/images/' . $item->images[$item->thumbnail]->img_path) }}"
                                alt="サムネイル" style="width: 100%; height: 220px;"
                                onclick="window.location='{{ route('items.show', $item->id) }}'">
                            <div class="card-body" style="height: 150px;">
                                <h4 class="text-gray-900 title-font text-lg font-medium text-truncate"
                                    onclick="window.location='{{ route('items.show', $item->id) }}'">
                                    {{ $item->item_name }}
                                </h4>
                                <p class="card-text text-truncate">{{ $item->message }}
                                </p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="position-absolute bottom-0 start-0 m-2">
                                        @if ($item->tax_regular_prices === $item->tax_sales_prices)
                                            <p class="h5 fw-bold">
                                                {{ number_format($item->tax_sales_prices) }}円（税込）送料無料</p>
                                        @else
                                            {{-- 割引中の表示 --}}
                                            <p class="h5" style="margin: 0; line-height: 1.2;">
                                                <del>{{ number_format($item->tax_regular_prices) }}円</del>
                                                <span class="badge bg-danger ms-2"
                                                    style="position: relative; top: -5px;">SALE</span>
                                            </p>
                                            <p class="h5 text-danger fw-bold">{{ number_format($item->tax_sales_prices) }}
                                                円（税込）送料無料
                                            </p>
                                        @endif
                                    </div>
                                    <small class="text-body-secondary"></small>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <h2 class="fw-bold title--border">注目されている商品</h2>
            <div class="row row-cols- row-cols-sm-2 row-cols-md-5 g-3">
                @foreach ($viewItems as $viewItem)
                    <div class="col">
                        <div class="card shadow-sm hover-effect">
                            <img alt="ecommerce" class="object-cover object-center w-full h-full block"
                                src="{{ asset('storage/images/' . $viewItem->images[$viewItem->thumbnail]->img_path) }}"
                                alt="サムネイル" style="width: 100%; height: 220px;"
                                onclick="window.location='{{ route('items.show', $viewItem->id) }}'">
                            <div class="card-body" style="height: 150px;">
                                <h4 class="text-gray-900 title-font text-lg font-medium text-truncate"
                                    onclick="window.location='{{ route('items.show', $viewItem->id) }}'">
                                    {{ $viewItem->item_name }}</h4>
                                <p class="card-text text-truncate">{{ $viewItem->message }}
                                </p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="position-absolute bottom-0 start-0 m-2">
                                        @if ($viewItem->tax_regular_prices === $viewItem->tax_sales_prices)
                                            <p>{{ number_format($viewItem->tax_sales_prices) }}円（税込）送料無料</p>
                                        @else
                                            <p class="h5" style="margin: 0; line-height: 1.2;">
                                                <del>{{ number_format($viewItem->tax_regular_prices) }}円</del>
                                                <span class="badge bg-danger ms-2"
                                                    style="position: relative; top: -5px;">SALE</span>
                                            </p>
                                            <p class="h5 text-danger fw-bold">
                                                {{ number_format($viewItem->tax_sales_prices) }}
                                                円（税込）送料無料
                                            </p>
                                        @endif
                                    </div>
                                    <small class="text-body-secondary"></small>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="d-flex justify-content-center">
                {{ $items->links('pagination::default') }}
            </div>
        </div>
    </div>
    <div id="sec">
        <ul>
            <li>
                <img src="{{ asset('images/5902585.jpg') }}" style="object-fit: cover;" width="340px" height="400px"
                    alt="Sample Image">
            </li>
            <li>
                <img src="{{ asset('images/4952087.jpg') }}" style="object-fit: cover;" width="340px" height="400px"
                    alt="Sample Image">
            </li>
            <li>
                <img src="{{ asset('images/10595359.jpg') }}" style="object-fit: cover;" width="340px" height="400px"
                    alt="Sample Image">
            </li>
            <li>
                <img src="{{ asset('images/close-up.jpg') }}" style="object-fit: cover;" width="340px" height="400px"
                    alt="Sample Image">
            </li>
        </ul>
    </div>
@endsection

{{ Debugbar::log($items->toArray()) }}
